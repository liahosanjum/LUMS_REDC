<?php
/**
 * Podcast Audio Management application library
 *
 */
class ofpbrouchermanagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_ofp_brouchers";
	var $sortcolumn=" ofpbid ";
	var $sortdirection=" asc ";
	
    /**
     * class constructor
     */
	 
    function ofpbrouchermanagement() {
     if($_SESSION['permission']['ofpbroucher'] == 'No')
		{
		  header("Location:welcome.php");
		  exit;
		}
		$this->tpl =& new Smarty;
		$this->db();
    }
    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars,$files = "",$_mode = "") {

		// reset error message
        $this->error = null;
		
        if(strlen($formvars['filename']) == 0 )
		{
			$this->error= "Please insert file name";
			return false;
		}
		// test if "Title" is empty
       if($_REQUEST['mode'] == 'add'){
			if(strlen($files['filepath']['name']) == 0 || $files['filepath']['size'] == 0) {
				$this->error = 'Please provide file.';
				return false; 
			}
			if($files['filepath']['size'] > '2097152')  ////// 1MB
					{
						$this->error= "File is larger than 2 MB in size";
						return false;
					}
			$ImageExtensions = array("application/pdf","application/doc","application/msword","image/jpeg","image/gif","image/png","image/jpg","image/pjpeg");
					$check = $files['filepath']['type'];
					if(!in_array($check, $ImageExtensions)){
						$this->error= "Invalid file format.";
						return false;
					}		
		}
		
		if($_REQUEST['mode'] == "edit")
		{
		    if(strlen($files['filepath']['name']) > 0 )
				{
					if($files['filepath']['size'] > '2097152')  /////// 1MB
					{
						$this->error= "File is larger than 2 MB in size";
						return false;
					}
				
					$ImageExtensions = array("application/pdf","application/doc","application/msword","image/jpeg","image/gif","image/png","image/jpg","image/pjpeg");
					$check = $files['filepath']['type'];
					if(!in_array($check, $ImageExtensions)){
						$this->error= "Invalid file format.";
						return false;
					}
				}
		}
				
		
		/*if(strlen(trim($formvars['content'])) == 0) {
            $this->error = 'Please provide detail';
            return false; 
        }*/
	
        return true;
    }
  	 /**
     * add a new Gallery entry
     *
     * @param array $formvars the form variables
     */
    function addEntry($formvars,$files) 
	{
    	$record['filename']=$this->mySQLSafe( $formvars['filename']);
		if(strlen($files['filepath']['name']) > 0 )
		{
			$FileName = time()."_".$files['filepath']['name'];
			$Imagepath = PHYSICAL_PATH."/uploads/ofp-brochures/".$FileName;
			
			if(move_uploaded_file($files['filepath']['tmp_name'], $Imagepath))
			{
				 $Image = $FileName;
				 $record['filepath']=$this->mySQLSafe( $Image );
			}
		}
			
	  	if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="OFP Brochure has been added successfully";
			return true;
		}
		else
		{
			$this->error="OFP Brochure has not been added";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	function editEntry($ofpbid=0)
	{
		$_query = "select *  from ".$this->tablename." where ofpbid=$ofpbid";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["ofpbid"]=$fetch[0]["ofpbid"];
			$data["filename"]=$fetch[0]["filename"];
			$data["filepath"]=$fetch[0]["filepath"];
			$data["old_image"]=$fetch[0]["filepath"];
		}
		
        return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$ofpbid,$files) {

        $record['filename']=$this->mySQLSafe( $formvars['filename']);
		if(strlen($files['filepath']['name']) > 0 )
		{		
			$FileName = time()."_".$files['filepath']['name'];
			$Imagepath = PHYSICAL_PATH."/uploads/ofp-brochures/".$FileName;
			
			if(move_uploaded_file($files['filepath']['tmp_name'], $Imagepath))
			{
				 $Image = $FileName;
				 $record['filepath']=$this->mySQLSafe( $Image );
				 
				 $_query = "select filepath from ".$this->tablename." where ofpbid = ".$formvars['ofpbid']." ";
				 $fetch=$this->select($_query);
				 $old_image = $fetch[0]['filepath'];
		       	 if($old_image or $old_image!='')
				 {
				    $oldImagepath = PHYSICAL_PATH."/uploads/ofp-brochures/".$old_image;
				    @unlink($oldImagepath);
				 }	
			}
		 
		}				
		$where="ofpbid=".$ofpbid;
		if($this->update($this->tablename,$record,$where))
		{
	    	
			$this->error="OFP Brochure has been updated successfully";
			return true;
		}
		else
		{
			$this->error="OFP Brochure was not updated";
			return false;
			
		}
        
    }
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($ofpbid=0)
	{
		  $_query = "select filepath from ".$this->tablename." where ofpbid = ".$ofpbid." ";
		  $fetch=$this->select($_query);
		  $old_image = $fetch[0]['filepath'];
		  if($old_image or $old_image!='')
		   {
			  $oldImagepath = PHYSICAL_PATH."/uploads/ofp-brochures/".$old_image;
			  @unlink($oldImagepath);
		   }	
				 
		$_query="delete from ".$this->tablename." where ofpbid=$ofpbid";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	
			$this->error="OFP Brochure has been deleted successfully";
			return true;
		}
		else
		{
			$this->error="OFP Brochure was not deleteed";
			return false;			
		}			
	}	
    /**
     * get the Faqs entries
	  * @param start variables use for paging.
     */
    function getEntries($_start=0,$formvars) {

		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			$this->sortcolumn=$formvars['sortcolumn'];
			$this->sortdirection=$formvars['sortdirection'];
		}else if(isset($_GET['sc']) && isset($_GET['sd']))
		{
			$this->sortcolumn=$_GET['sc'];
			$this->sortdirection=$_GET['sd'];
		}
		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows("select ofpbid from ".$this->tablename);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$where=" ";
		
		$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing ofp brochure found";
		   $data=null;
		  }
	    return $data;   
    }
    /**
     * display the Faq entry form
     *
     * @param array $formvars the form variables
     */
    function displayForm($formvars = array()) {

		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		
		$this->tpl->assign('pageview',$this->pageview);
		if(count($formvars) == 0)
		{
			$formvars['pubdate'] = date('Y-m-d');
			$this->tpl->assign('data',$formvars);		
		}
		else
		{			
			$this->tpl->assign('data',$formvars);
		}
			
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('ofpbrouchermanagement.tpl');
    }
    
    /**
     * display the Faq records
     *
     * @param array $data the Faq data
     */
    function displayGird($data = array()) {
	    global $GENERAL;		
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('ofpbrouchermanagement.tpl');        
    }
}

?>
