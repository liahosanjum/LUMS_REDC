<?php
class ConferenceServiceManagement extends db{
	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	///Class varibles
	var $pageview=null;
	var $returnpage=null;
	var $tablename="redc_conferenceservice_requests";
	var $table_user= "travelhub_users";
	var $tablenameemailcontent  = "site_emailcontent";
	var $sortcolumn="csid";
	var $sortdirection="desc";
	var $isactive="Y";
    /**
     * class constructor
     */
    function ConferenceServiceManagement() {
		if($_SESSION['permission']['conference_service_manager'] == 'No')
		{
		  header("Location:welcome.php");
		  exit;
		}
		$this->tpl =& new Smarty;
		$this->db();
    }
    /*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($id=0)
	{
		$_query="delete from ".$this->tablename." where csid=$id";
	
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	$this->error="Conference service request has been deleted successfully";
			return true;
		}
		else
		{
			$this->error="Conference service request has not been deleteed";
			return false;			
		}		
	}
	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
		//$_query = "select c.*,u.first_name,u.last_name,u.user_type,u.email_address from ".$this->tablename." c, ".$this->table_user." u where c.user_id = u.user_id and c.id=".$id."";
		   $_query ="select * from ".$this->tablename." where csid = $id";
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data = $fetch[0];
			/*
			// Fill all field 
			$data["id"]=$fetch[0]["id"];
			//$data["name"]=$fetch[0]["first_name"]." ".$fetch[0]["last_name"];
			$data["name"]=$fetch[0]["name"];
			$data ["title"] =$fetch[0]["title"];
			$data ["dated"] =$fetch [0] ["dated"];
			$data ["phone"] =$fetch [0] ["phone"];
			$data ["email"] =$fetch [0] ["email"];
			$data ["content"] =$fetch [0]["content"];
			// get mail content
			/*$_query = "select *  from ".$this->tablenameemailcontent." where emailname='Personal Email'";
			$rs=$this->select($_query);
			if($rs)
			{
				$data['emailcontent'] = $rs[0]['content'];
				$data['fromemail'] = $rs[0]['fromemail'];
			}*/
			
		}		
        return $data;   
    }
    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars) {
		// reset error message
        $this->error = null;

		// test if "Name" is empty
		if(strlen($formvars['fromemail']) == 0) {
            $this->error = 'Please provide From email.';
            return false; 
		}
		
		if(strlen($formvars['fromemail']) > 0)
		{
			if (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",$formvars['fromemail']))
			{
            	$this->error = 'Please provide valid from email address.';
	            return false; 
			}
        }
	
		if(strlen($formvars['subject']) == 0) {
            $this->error = 'Please provide subject.';
            return false; 
		}	
        if(strlen($formvars['rply_message']) == 0) {
            $this->error = 'Please provide Message.';
            return false; 
        }

		// form passed validation
        return true;
    }
   		 
	function sendReplyEmail($formvars, $_page) 
	{
		$m= new Mail; // create the mail
		$m->From( $formvars['fromemail'] );
		$m->To( $formvars['email'] );
		$m->Subject( $formvars['subject'] );
		$m->Body( $formvars['rply_message']);        // set the body
		$send = $m->Send();        // send the mail
//         if($send)
		 {
		   $this->error= "Your Message has been sent successfully";
		 
		 }
		 
}
    /**
     * add a new guestbook entry
     *
     * @param array $formvars the form variables
     */
    function addEntry($formvars) {
        
		$record['name']=$this->mySQLSafe( $formvars['name']);
		$record['email']=$this->mySQLSafe($formvars['email']);
		$record['subject']=$this->mySQLSafe( $formvars['subject']);
		$record['message']=$this->mySQLSafe($formvars['message']);				
		$status=(isset($formvars['status']))?"Y":"N";
		$record['status']=$this->mySQLSafe($status);
      	if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="Conference service request has been added successfully";
			return true;
		}
		else
		{
			$this->error="Conference service request has not been added";
			return false;			
		}
    }
	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($id) {
      	$record['isactive']=$this->mySQLSafe("N");
		$where="csid=".$id;
		if($this->update($this->tablename,$record,$where))
		{
	    	$this->error="Conference service request has been closed successfully";
			return true;
		}
		else
		{
			$this->error="Conference service request has been not closed";
			return false;			
		}        
    }
    /**
     * get the Faqs entries
	  * @param start variables use for paging.
     */
	 
	 
	 
    function getEntries($_start=0,$formvars) {
	   
	   	$isactive = isset($formvars['isactive']) ? $formvars['isactive'] : "Y";
		$this->isactive = $isactive;

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
		$paging->num= $this->numrows("select csid from ".$this->tablename);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$where=" where isactive = '".$isactive."'";
		$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing Conference service request found.";
		   $data=null;
		  }
	    return $data;   
    }
     //this function is used for when click on close button .
    function getClosedEntries($action,$_start=0,$formvars) {

		$data = null;
		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			$this->sortcolumn=$formvars['sortcolumn'];
			$this->sortdirection=$formvars['sortdirection'];
		}else if(isset($_GET['sc']) && isset($_GET['sd']))
		{
			$this->sortcolumn=$_GET['sc'];
			$this->sortdirection=$_GET['sd'];
		}
		//$query_new = "select c.*,u.first_name,u.last_name,u.user_type,u.email_address from ".$this->tablename." c, ".$this->table_user." u where c.user_id = u.user_id and c.status='C'";
		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows("select csid from ".$this->tablename);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->extraQuerysting="action=viewclose&";
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",10);
		$this->tpl->assign('paging',$paging->displayTable());
		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			$this->sortcolumn=$formvars['sortcolumn'];
			$this->sortdirection=$formvars['sortdirection'];
		}		
		///Sort order
		//$orderby=" where c.user_id = u.user_id and c.status='C' order by ". $this->sortcolumn ." ". $this->sortdirection;
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch)
		{
			$data=$fetch;
		}
		else
		{
    		$this->error="No existing Conference service request found";
		}
        return $data;   
    }
	
	function displayForm($formvars = array(), $form = array()) {
  	    global $GENERAL;
       	$this->tpl->assign('GENERAL', $GENERAL); 
		// assign the form vars
        $this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('returnpage',$this->returnpage);
		$this->tpl->assign('data',$formvars);
		$this->tpl->assign('form',$form);
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('conferenceservicemanagement.tpl');
    }
	
    function displayGird($data = array()) {
	    global $GENERAL;
        $this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('data', $data);
		$this->tpl->assign('isactive',$this->isactive);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
	    $this->tpl->display('conferenceservicemanagement.tpl');        
   }
}
?>