<?php
/**
 * Email Content Management application library
 *
 */
class EmailContentManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $emailvariable=null;
	var $emailname = "";	
	var $tablename="redc_emailcontent";
	var $sortcolumn="emailname";
	var $sortdirection="asc";
	
    /**
     * class constructor
     */
    function EmailContentManagement() {
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
        if(strlen(trim($formvars['fromname'])) == 0) {
            $this->error = 'You must supply a name.';
            return false; 
        }
		
		// test if "explorer title" is empty
        if(strlen(trim($formvars['fromemail'])) == 0) {
            $this->error = 'You must supply an email address.';
            return false; 
        }
		 if(!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",trim($formvars['fromemail'])))
		{
            $this->error = 'Please provide a valid email address.';
            return false; 		
		}
		 if(strlen(trim($formvars['subject'])) == 0) {
            $this->error = 'You must supply a subject.';
            return false; 
        }
		 
		 if(strlen(trim($formvars['content'])) == 0) {
            $this->error = 'You must supply an email content.';
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
		$_query = "select *  from ".$this->tablename." where ecid=$id";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["ecid"]=$fetch[0]["ecid"];
			$this->emailname = $fetch[0]['emailname'];
			$data['fromname'] = $fetch[0]['fromname'];
    		$data['fromemail'] = $fetch[0]['fromemail'];
			$data['subject'] = $fetch[0]['subject'];
			$data['content'] = $fetch[0]['content'];
		}
		
        return $data;   
	}	
	/*
	* load record from data base.
	*/
	function loadEmailBody($emailname='')
	{
		$_query = "select *  from ".$this->tablename." where emailname='$emailname'";
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data["ecid"]=$fetch[0]["ecid"];
			$data['fromname'] = $fetch[0]['fromname'];
    		$data['fromemail'] = $fetch[0]['fromemail'];
			$data['subject'] = $fetch[0]['subject'];
			$data['content'] = $fetch[0]['content']; 
		}
		
        return $data;   
	}	
	function loadEmailVariables($id=0)
	{
		
		$data=null;
		$_query = "select *  from redc_emailvariable where emailid=$id";
			
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
		$record['fromname']=$this->mySQLSafe( $formvars['fromname']);
		$record['fromemail']=$this->mySQLSafe( $formvars['fromemail']);
		$record['subject']=$this->mySQLSafe($formvars['subject']);
		$record['content']=$this->mySQLSafe($formvars['content']);
		
		
		//echo($formvars['content']);
		$where="ecid=".$formvars['ecid'];
		
		/// Return true if query if success
		if($this->update($this->tablename,$record,$where))
		{
	    	$this->error="Email Content has been updated successfully";
			return true;
		}
		else
		{
			$this->error="Email Content has not been updated";
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
		$where =" ";
		/// Paging for data tables
		$paging = new Paginate();
		$paging->num= $this->numrows("select ecid from ".$this->tablename.$where);
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
		  $this->error="No existing content page found";
		}
		
        return $data;   
    }
     /**
     * display the Content entry form
     *
     * @param array $formvars the form variables
     */
    function displayForm($formvars = array()) {
        global $GENERAL;
		// assign the form vars
		$this->loadEmailVariables($formvars['ecid']);
        $this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('emailname',$this->emailname);		
        $this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('data',$formvars);
		$this->tpl->assign('emailvariable', $this->emailvariable);	
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('emailcontentmanagement.tpl');
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
	    $this->tpl->display('emailcontentmanagement.tpl');        

    }
}

?>
