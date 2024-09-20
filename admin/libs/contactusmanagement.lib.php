<?php
class ContactusManagement extends db{
	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	///Class varibles
	var $pageview=null;
	var $returnpage=null;
	var $tablename="redc_contactus";
	//var $table_user= "travelhub_users";
	var $tablenameemailcontent  = "site_emailcontent";
	var $sortcolumn="cuid";
	var $sortdirection="desc";
	var $status = "";
    /**
     * class constructor
     */
    function ContactusManagement() {
		if($_SESSION['permission']['contact_us_manager'] == 'No')
		{
		  header("Location:welcome.php");
		  exit;
		}
		if($_GET['status'] == "")
		{
			header("Location:contactusmanagement.php?status=O");
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
		$_query="delete from ".$this->tablename." where cuid=$id";
	
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	$this->error="Contact us has been deleted successfully";
			return true;
		}
		else
		{
			$this->error="Contact us has not been deleteed";
			return false;			
		}		
	}
	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
		//$_query = "select c.*,u.first_name,u.last_name,u.user_type,u.email_address from ".$this->tablename." c, ".$this->table_user." u where c.user_id = u.user_id and c.id=".$id."";
		$_query ="select * from ".$this->tablename." where cuid=".$id;
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["id"]					=	$fetch[0]["cuid"];
			$data["first_name"]			=	$fetch[0]["firstname"];
			$data["last_name"]			=	$fetch[0]["lastname"];
			$data ["title"] 			=	$fetch[0]["title"];
			$data ["contact_date"] 		=	$fetch[0]["contactdate"];
			$data ["phone"] 			=	$fetch[0]["phone"];
			$data ["email"] 			=	$fetch[0]["email"];
			$data ["about"] 			=	$fetch[0]["about"];
			$data ["company"] 			=	$fetch[0]["company"];
			$data ["mailing_address"] 	=	$fetch[0]["mailaddress"];
			$data ["additionalinfo"] 			=	$fetch[0]["additionalinfo"];
			
			/* for requested info*/
			$request_info = "";
			if($fetch [0]["about"] != 0)
			{
				$request_info = "About REDC";
			}

			if($fetch [0]["opt1"] != 0)
			{
				$request_info = ($request_info != "") ? $request_info.",Open Enrollment Programmes" : "Open Enrollment Programmes";
			}

			if($fetch [0]["opt2"] != 0)
			{
				$request_info = ($request_info != "") ? $request_info.",Industry Focused Programmes" : "Industry Focused Programmes";
			}

			if($fetch [0]["opt3"] != 0)
			{
				$request_info = ($request_info != "") ? $request_info.",Conferences and Services" : "Conferences and Services";
			}
			if($fetch [0]["opt4"] != 0)
			{
				$request_info = ($request_info != "") ? $request_info.",REDC Facilities" : "REDC Facilities";
			}
			if($fetch [0]["opt5"] != 0)
			{
				$request_info = ($request_info != "") ? $request_info.",Partner with us" : "Partner with us";
			}
			
			$data ["request_info"] = ($request_info != "") ? $request_info : "none";
			
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
            $this->error = 'Please provide From Email.';
            return false; 
       	}

		if(!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",trim($formvars['fromemail'])))
		{
            $this->error = 'Please provide valid from email';
            return false; 		
		}
		
		 if(strlen($formvars['subject']) == 0) {
			$this->error = 'Please provide Subject.';
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
        $this->error= "Your Message has been sent successfully";
		
		 
		//$this->updateEntry($formvars['id']);
		
		 
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
	    	$this->error="Contact us has been added successfully";
			return true;
		}
		else
		{
			$this->error="Contact us has not been added";
			return false;			
		}
    }
	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($id) {
		
      	$record['status']=$this->mySQLSafe("C");
		$where="cuid=".$id;
		if($this->update($this->tablename,$record,$where))
		{
	    	$this->error="Contact us has been closed successfully";
			return true;
		}
		else
		{
			$this->error="Contact us has not been closed";
			return false;			
		}        
    }
    /**
     * get the Faqs entries
	  * @param start variables use for paging.
     */
    function getEntries($_start=0,$formvars , $status = "") {

		$this->status = $status;
		
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
		$paging->num= $this->numrows("select cuid from ".$this->tablename);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$where=" where status = '$status'";
		
		
		$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing Record found.";
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
		$paging->num= $this->numrows("select cuid from ".$this->tablename);
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
    		$this->error="No existing contact us found";
		}
        return $data;   
    }
	
	function displayForm($formvars = array()) {
  	    global $GENERAL;
       	$this->tpl->assign('GENERAL', $GENERAL); 
		// assign the form vars
        $this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('returnpage',$this->returnpage);
		$this->tpl->assign('data',$formvars);
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('contactusmanagement.tpl');
    }
	
    function displayGird($data = array()) {
	    global $GENERAL;
        $this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('data', $data);
		$this->tpl->assign('status',$this->status);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
	    $this->tpl->display('contactusmanagement.tpl');        
   }
}
?>