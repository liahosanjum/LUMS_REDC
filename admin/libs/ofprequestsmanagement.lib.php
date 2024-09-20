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
	var $tablename="redc_ofp_requests";
	//var $table_user= "travelhub_users";
	var $tablenameemailcontent  = "redc_emailcontent";
	var $sortcolumn="ofprid";
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
		$this->tpl =& new Smarty;
		$this->db();
    }
    /*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($id=0)
	{
		$_query="delete from ".$this->tablename." where ofprid=$id";
	
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	$this->error="OFP request has been deleted successfully";
			return true;
		}
		else
		{
			$this->error="OFP request has not been deleteed";
			return false;			
		}		
	}
	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
		//$_query = "select c.*,u.first_name,u.last_name,u.user_type,u.email_address from ".$this->tablename." c, ".$this->table_user." u where c.user_id = u.user_id and c.id=".$id."";
		$_query ="select * from ".$this->tablename." where ofprid=".$id;
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["id"]						=	$fetch[0]["ofprid"];
			$data["first_name"]				=	$fetch[0]["firstname"];
			$data["last_name"]				=	$fetch[0]["lastname"];
			$data ["title"] 				=	$fetch[0]["prefix"];
			$data ["contact_date"] 			=	$fetch[0]["dated"];
			$data ["phone"] 				=	$fetch[0]["phone"];
			$data ["fax"] 				=	$fetch[0]["fax"];
			$data ["email"] 				=	$fetch[0]["email"];
			$data ["company"] 				=	$fetch[0]["organization"];
			$data ["mailing_address"] 		=	$fetch[0]["address"];
			$data ["designation"] 			=	$fetch[0]["designation"];
			$data ["organizationwebsite"] 	=	$fetch[0]["organizationwebsite"];
			$data ["numemployees"] 			=	$fetch[0]["numemployees"];
			$data ["keyareas"]	 			=	$fetch[0]["keyareas"];
			$data ["traininginventions"]	=	$fetch[0]["traininginventions"];
			$data ["programmeduration"]		=	$fetch[0]["programmeduration"];
			$data ["numparticipants"]		=	$fetch[0]["numparticipants"];
			$data ["learnabout"]			=	$fetch[0]["learnabout"];
			$data ["city"]					=	$fetch[0]["city"];
			$data ["country"]				=	$fetch[0]["country"];
			$data ["email_informe"]				=	$fetch[0]["email_informe"];
			
			
		}		
        return $data;   
    }
  
  
   	// email validation
	function validateMail($mail) {
	  if($mail !== "") {
		if(ereg("^[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[.]{1}[A-Za-z]{2,5}$", $mail)) {
		  return true;
		} 
		else {
		  return false;
		}
	  } 
	  else {
		return false;
	  }
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

		if(!$this->validateMail($formvars['fromemail']))
		{
			$this->error = 'Invalid email address';
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
		/*echo "<pre>";
		print_r($formvars);
		exit;
		echo "</pre>";*/
		
		$m= new Mail; // create the mail
		$m->From( $formvars['fromemail'] );
		$m->To( $formvars['email'] );
		$m->Subject( $formvars['subject'] );
		$m->Body( $formvars['rply_message']);        // set the body
		$send = $m->Send();        // send the mail
//		echo $send;exit;
        $this->error= "Your Message has been sent successfully";
		
		 
		$this->updateEntry($formvars['id']);
		
		 
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
	    	$this->error="OFP request has been added successfully";
			return true;
		}
		else
		{
			$this->error="OFP request has not been added";
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
		$where="ofprid=".$id;
		if($this->update($this->tablename,$record,$where))
		{
	    	$this->error="OFP request has been closed successfully";
			return true;
		}
		else
		{
			$this->error="OFP request has not been closed";
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
		$paging->num= $this->numrows("select ofprid from ".$this->tablename);
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
		$paging->num= $this->numrows("select ofprid from ".$this->tablename);
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
    		$this->error="No existing ofp requests found";
		}
        return $data;   
    }
	
	function displayForm($formvars = array()) {
  	    global $GENERAL;
       	$this->tpl->assign('GENERAL', $GENERAL); 
		// assign the form vars
        $this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('returnpage',$this->returnpage);
		$this->tpl->assign('data',$this->editEntry($_REQUEST['id']));
		$this->tpl->assign('formvars',$formvars);
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('ofprequestsmanagement.tpl');
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
	    $this->tpl->display('ofprequestsmanagement.tpl');        
   }
}
?>