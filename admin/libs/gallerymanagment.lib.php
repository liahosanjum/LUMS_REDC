<?php
/**
 * Podcast Audio Management application library
 *
 */
class galleryManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_picture_galleries";
	var $table_pname="redc_oep_programmes";
	var $table_name="redc_pictures";
	var $sortcolumn=" pgid ";
	var $sortdirection=" desc ";
	
    /**
     * class constructor
     */
    function galleryManagement() {
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
        
		// test if "Title" is empty
        if(strlen(trim($formvars['name'])) == 0) {
            $this->error = 'Please provide gallery name.';
            return false; 
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
    	$record['name']=$this->mySQLSafe( $formvars['name']);
		$record['oepid']=$this->mySQLSafe( $formvars['oepid']);
		$record['isactive']=$this->mySQLSafe( $formvars['isactive'] );
		if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="The gallery has been added successfully";
			return true;
		}
		else
		{
			$this->error="The gallery was not added";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	
	function getpname()
	{
		 $_query = "select oepid , name from ".$this->table_pname." ORDER BY name "  ;
//		 $_query = "select oepid , name from ".$this->table_pname." where isactive = 'Yes'  AND deadline >'".date("Y-m-d")."' ORDER BY name "  ;
		return $this->select($_query);
	}
	
	function editEntry($id=0)
	{	
		$_query = "select *  from ".$this->tablename." where pgid=$id";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["id"]=$fetch[0]["pgid"];
			$data["name"]=$fetch[0]["name"];
			$data["oepid"]=$fetch[0]["oepid"];
						
			$data["isactive"]=$fetch[0]["isactive"];
			}
		
        return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$id,$files) {

        $record['name']=$this->mySQLSafe( $formvars['name']);
		$record['isactive']=$this->mySQLSafe( $formvars['isactive']);
		$record['oepid']=$this->mySQLSafe( $formvars['oepid']);

		$where="pgid=".$id;
		if($this->update($this->tablename,$record,$where))
		{
	    	
			$this->error="The gallery has been updated successfully";
			return true;
		}
		else
		{
			$this->error="The gallery was not been updated.";
			return false;
			
		}
        
    }


	/*
		* To delete existing picture if new one is uploaded.
		* @param pic src to unlink it.
	*/
	function unlinkPicture($src)
	{
	  $oldImagepath = PHYSICAL_PATH."/images/gallery/".$src;
	  @unlink($oldImagepath);
	}



	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($id=0)
	{

		$qry 	= 	"select * from ".$this->table_name." where pgid = $id";
		$fetch	=	$this->select($qry);
		if($fetch)
		{
			foreach($fetch as $data)
			{
				if($data['picture'] != "")
				{
					$this->unlinkPicture($data['picture']);
				}
			}
			$this->execute("delete from ".$this->table_name." where pgid = $id");
		}
		
		$_query="delete from ".$this->tablename." where pgid=$id";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	
			$this->error="The gallery and its pictures have been removed successfully";
			return true;
		}
		 /*
		else
		{
			$this->error="gallery has not been deleted.";
			return false;			
		}
		 */			
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
		$paging->num= $this->numrows("select pgid from ".$this->tablename);
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
		   $this->error="No existing gallery found.";
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
		$this->tpl->assign('pname', $this->getpname());
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('gallerymanagement.tpl');
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
		
	    $this->tpl->display('gallerymanagement.tpl');        
    }
}
?>