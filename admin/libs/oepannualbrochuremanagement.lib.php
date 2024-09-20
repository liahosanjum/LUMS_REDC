<?php
/**
 * Podcast Audio Management application library
 *
 */
class oepAnnualBroucherManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_oepannual_brochure";
	var $sortcolumn=" oepabid ";
	var $sortdirection=" asc ";
	
    /**
     * class constructor
     */
	 
    function oepAnnualBroucherManagement() {
/*
     if($_SESSION['permission']['ofpbroucher'] == 'No')
		{
		  header("Location:welcome.php");
		  exit;
		}
*/		
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
			if($files['filepath']['size'] > '10485760')  ////// 1MB
					{
						$this->error= "File is larger than 10 MB in size";
						return false;
					}
			$ImageExtensions = array("application/pdf","application/doc","application/msword");
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
					if($files['filepath']['size'] > '10485760')  /////// 1MB
					{
						$this->error= "File is larger than 10 MB in size";
						return false;
					}
				
					$ImageExtensions = array("application/pdf","application/doc","application/msword");
					$check = $files['filepath']['type'];
					if(!in_array($check, $ImageExtensions)){
						$this->error= "Invalid file format.";
						return false;
					}
				}
		}
			
        if(strlen($formvars['year']) == 0 )
		{
			$this->error= "Please select year";
			return false;
		}
		
		/*if(strlen(trim($formvars['content'])) == 0) {
            $this->error = 'Please provide detail';
            return false; 
        }*/
	
        return true;
    }
	
	function ifSameYear($year , $id)
	{
		$query = "";
		
		if($id != 0)
		{
			$query = "select * from ".$this->tablename." where year=$year and oepabid != $id";
		}
		else
		{
			$query = "select * from ".$this->tablename." where year=$year";
		}	
		
		$num = $this->numrows($query);
		
		if($num)
		{
			return true;
		}
		else
			return false;

	}
	
	function ifsomeAleardyActive($id)
	{
		$query = "";
		
		if($id != 0)
		{
			$query = "select * from ".$this->tablename." where status='Y' and oepabid != $id";
		}
		else
		{
			$query = "select * from ".$this->tablename." where status='Y'";
		}	
		
		$num = $this->numrows($query);
		
		if($num)
		{
			return true;
		}
		else
			return false;

	}
	

  	 /**
     * add a new Gallery entry
     *
     * @param array $formvars the form variables
     */
    function addEntry($formvars,$files) 
	{
    	
		if($this->ifSameYear($formvars['year'] , $id = 0))
		{
	    	$this->error="selected year already has brochure, please select another year.";
			return false;
		}
		
		
		$record['filename']=$this->mySQLSafe( $formvars['filename']);
		if(strlen($files['filepath']['name']) > 0 )
		{
			$FileName = time()."_".$files['filepath']['name'];
			$Imagepath = PHYSICAL_PATH."/uploads/oepannualbrochure/".$FileName;
			
			if(move_uploaded_file($files['filepath']['tmp_name'], $Imagepath))
			{
				 $Image = $FileName;
				 $record['filepath']=$this->mySQLSafe( $Image );
			}
			$record['year'] = $this->mySQLSafe( $formvars['year'] );
			
			if(isset($formvars['status'])&& $formvars['status'] == "on")
			{
				$record['status'] = $this->mySQLSafe( 'Y' );
				if($this->ifsomeAleardyActive($oepabid = 0))
				{
					$this->error="At a time only one record can be activated.";
					return false;
				}

			}
			else
			{
				$record['status'] = $this->mySQLSafe( 'N' );	
			}
			
		}
			
	  	if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="OEP annual brochure has been added successfully";
			return true;
		}
		else
		{
			$this->error="OEP annual brochure has not been added";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	function editEntry($oepabid=0)
	{
		$_query = "select *  from ".$this->tablename." where oepabid=$oepabid";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["oepabid"]=$fetch[0]["oepabid"];
			$data["filename"]=$fetch[0]["filename"];
			$data["filepath"]=$fetch[0]["filepath"];
			$data["old_image"]=$fetch[0]["filepath"];
			$data["status"]=$fetch[0]["status"];
			$data["year"]=$fetch[0]["year"];
		}
		
        return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$oepabid,$files) {

 		if($this->ifSameYear($formvars['year'] , $oepabid))
		{
	    	$this->error="selected year already has brochure, please select another year.";
			return false;
		}


        $record['filename']=$this->mySQLSafe( $formvars['filename']);
		if(strlen($files['filepath']['name']) > 0 )
		{		
			$FileName = time()."_".$files['filepath']['name'];
			$Imagepath = PHYSICAL_PATH."/uploads/oepannualbrochure/".$FileName;
			
			if(move_uploaded_file($files['filepath']['tmp_name'], $Imagepath))
			{
				 $Image = $FileName;
				 $record['filepath']=$this->mySQLSafe( $Image );
				 
				 $_query = "select filepath from ".$this->tablename." where oepabid = ".$formvars['oepabid']." ";
				 $fetch=$this->select($_query);
				 $old_image = $fetch[0]['filepath'];
		       	 if($old_image or $old_image!='')
				 {
				    $oldImagepath = PHYSICAL_PATH."/uploads/oepannualbrochure/".$old_image;
				    @unlink($oldImagepath);
				 }	
			}
		 
		}				
		$where="oepabid=".$oepabid;
		
		$record['year'] = $this->mySQLSafe( $formvars['year'] );
		
		if(isset($formvars['status'])&& $formvars['status'] == "on")
		{
			$record['status'] = $this->mySQLSafe( 'Y' );
			if($this->ifsomeAleardyActive($oepabid))
			{
				$this->error="At a time only one record can be activated.";
				return false;
			}

		}
		else
		{
			$record['status'] = $this->mySQLSafe( 'N' );	
		}

		if($this->update($this->tablename,$record,$where))
		{
	    	
			$this->error="OEP annual brochure has been updated successfully";
			return true;
		}
		else
		{
			$this->error="OEP annual brochure was not updated";
			return false;
			
		}
        
    }
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($oepabid=0)
	{
		  $_query = "select filepath from ".$this->tablename." where oepabid = ".$oepabid;
		  $fetch=$this->select($_query);
		  $old_image = $fetch[0]['filepath'];
		  if($old_image or $old_image!='')
		   {
			  $oldImagepath = PHYSICAL_PATH."/uploads/oepannualbrochure/".$old_image;
			  @unlink($oldImagepath);
		   }	
				 
		$_query="delete from ".$this->tablename." where oepabid=$oepabid";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	
			$this->error="OEP annual brochure has been deleted successfully";
			return true;
		}
		else
		{
			$this->error="OEP annual brochure was not deleteed";
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
		$paging->num= $this->numrows("select oepabid from ".$this->tablename);
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
		   $this->error="No existing OEP annual brochure found";
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
		
		$year [0] =  date("Y");
		$year [1] =  date("Y") +  1;
		$this->tpl->assign('years', $year);
			
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('oepannualbrochuremanagement.tpl');
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
		
	    $this->tpl->display('oepannualbrochuremanagement.tpl');        
    }
}

?>
