<?php
/**
 * Email Content Management application library
 *
 */
class templatemanagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $emailvariable=null;
	var $emailname = "";	
	var $tablename="redc_email_template";
	var $sortcolumn="emailname";
	var $sortdirection="asc";
	
    /**
     * class constructor
     */
    function templatemanagement() {
        if($_SESSION['permission']['email_content_manager'] == 'No')
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
    function isValidForm($formvars) {

		// reset error message
        $this->error = null;
        
		// test if "pagetitle " is empty
        if(strlen(trim($formvars['emailname'])) == 0) {
            $this->error = 'You must supply a newsletter title.';
            return false; 
        }
		
		// test if "explorer title" is empty
        	 
		 if(strlen(trim($formvars['content'])) == 0) {
            $this->error = 'You must supply description.';
            return false; 
        }
		
				
	  	// form passed validation
        return true;
    }
	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
	
		$_query = "select *  from ".$this->tablename." where temp_id=$id";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["ecid"]=$fetch[0]["temp_id"];
			$data["emailname"]=$fetch[0]["emailname"];
			$data['content'] = $fetch[0]['content'];
		}
		
        return $data;   
	}	
	/*
	* load record from data base.
	*/
	
	function addEntry($formvars) 
	{
    	$record['emailname']=$this->mySQLSafe( $formvars['emailname']);	
		$record['content']=$this->mySQLSafe($formvars['content']);
		//$record['isnewslettertemp']=$this->mySQLSafe('Yes');
		if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="Newsletter Template has been added successfully.";
			return true;
		}
		else
		{
			$this->error="Newsletter Template has not been added.";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	
		
	function loadEmailVariables($ecid=0)
	{
		
		$data=null;
		$_query = "select * from redc_emailcontent where ecid=$ecid";
			
			$fetch=$this->select($_query);
			if($fetch!=false)
			{
				$data=$fetch;
			}
		$this->emailvariable=$data;
	}
	/**
     * Updating content entry
     *
     * @param array $formvars the form variables
     */
	 
	 function updateEntry($formvars) {

      	/// setting update variables 
		$record['emailname']=$this->mySQLSafe( $formvars['emailname']);
		$record['content']=$this->mySQLSafe($formvars['content']);
		//echo($formvars['content']);
		$where="temp_id=".$formvars['ecid'];
		
		/// Return true if query if success
		if($this->update($this->tablename,$record,$where))
		{
	    	$this->error="Newsletter Template has been updated successfully";
			return true;
		}
		else
		{
			$this->error="Newsletter Template has not been updated";
			return false;
		}
        
    }
	
    /**
     * get the Page content entries
	  * @param start variables use for paging.
     */
    function getEntries($_start=0,$formvars) {

		$data=null;
		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			$this->sortcolumn=$formvars['sortcolumn'];
			$this->sortdirection=$formvars['sortdirection'];
		}else if(isset($_GET['sc']) && isset($_GET['sd']))
		{
			$this->sortcolumn=$_GET['sc'];
			$this->sortdirection=$_GET['sd'];
		}
		//$where =" where isnewslettertemp='Yes'";
		$where ="";
		/// Paging for data tables
		$paging = new Paginate();
		$paging->num= $this->numrows("select * from ".$this->tablename.$where);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
//		$paging->limit = PAGESIZE;
		$paging->limit = 20;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		
		$_query = "select * from " . $this->tablename.$where. $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		
		if($fetch != false)
		{
			$data=$fetch;
		}
		else
		{
		  $this->error="No existing Newsletter Template found";
		}
	return $data;   
    }
	function deleteEntry($ecid=0)
	{
		  /*
		  $_query = "select image from ".$this->tablename." where id = ".$id." ";
		  $fetch=$this->select($_query);
		  $old_image = $fetch[0]['image'];
		  if($old_image or $old_image!='')
		   {
			  $oldImagepath = PHYSICAL_PATH."/images/NewLetter Template/".$old_image;
			  @unlink($oldImagepath);
		   }
		   */	
				 
		$_query="delete from ".$this->tablename." where temp_id=$ecid";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	
			$this->error="Newsletter Template has been deleted successfully.";
			return true;
		}
		 /*
		else
		{
			$this->error="Newsletter Template has not been deleted.";
			return false;			
		}
		 */			
	}	
     /**
     * display the Content entry form
     *
     * @param array $formvars the form variables
     */
    function displayForm($formvars = array()) {
        global $GENERAL;
		// assign the form vars
        $this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('emailname',$this->emailname);		
        $this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('data',$formvars);
		$this->tpl->assign('emailvariable', $this->emailvariable);	
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('templatemanagement.tpl');
    }
    /**
     * display the content page records
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
	    $this->tpl->display('templatemanagement.tpl');        

    }
}

?>
