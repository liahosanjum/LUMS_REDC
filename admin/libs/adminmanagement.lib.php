<?php
/**
 *
 *
 */
class AdminManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_admin";
	var $sortcolumn=" adminid ";
	var $sortdirection=" asc ";
	
    /**
     * class constructor
     */
    function AdminManagement() {
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
/*		if(strlen(trim($formvars['title'])) == " ") {
            $this->error = 'Please Select Title ';
            return false; 
        }*/
		if(strlen(trim($formvars['first_name'])) == 0) {
            $this->error = 'Please provide first name';
            return false; 
        }
		if(strlen(trim($formvars['last_name'])) == 0) {
            $this->error = 'Please provide last name';
            return false; 
        }
        if(strlen(trim($formvars['username'])) == 0) {
            $this->error = 'Please provide the username.';
            return false; 
        }
		if(strpos(trim($formvars['username'])," "))
		{
            $this->error = 'Space is not allowed in username field.';
            return false; 		
		}
		/*if(strlen(trim($formvars['username'])) < 6) {
			$this->error = 'Username should be at least 6 characters long.';
			return false; 
		}*/
		if(strlen(trim($formvars['password'])) == 0) {
			$this->error = 'Please provide the password.';
			return false; 
		}
		elseif(strlen(trim($formvars['password'])) < 6) {
			$this->error = 'Password should be at least 6 characters long.';
			return false; 
		}
		if(strlen(trim($formvars['confirm_password'])) == 0) {
			$this->error = 'Please provide the confirm password.';
			return false; 
		}
        if(trim($formvars['password']) != trim($formvars['confirm_password'])) {
            $this->error = 'Your password and confirm password do not match. Please enter the same password for verification.';
            return false; 
        }
		if(strlen(trim($formvars['email'])) == 0) {
            $this->error = 'Please provide email';
            return false; 
        }
		if(!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",trim($formvars['email'])))
		{
            $this->error = 'Please provide a valid email address.';
            return false; 		
		}

		if(!eregi("^[0-9]+$",trim($formvars['phone_number'])))
		{
            $this->error = 'Please provide a valid phone.';
            return false; 		
		}
        
		
        return true;
    }

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

		$where = " where username != 'admin'";
		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows("select adminid from ".$this->tablename.$where );
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		
		$_query = "select * from " . $this->tablename.$where. $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		    $this->error="No existing record found";
		    $data=null;
		  }
	    return $data;   
    }

	function deleteEntry($id=0)
	{
		$_query="delete from ".$this->tablename." where adminid=$id";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
			$this->error="Administrator has been deleted successfully.";
			return true;
		}
		else
		{
			$this->error="Administrator was not deleted";
			return false;			
		}			
	}	

	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
		$_query = "select * from ".$this->tablename." where adminid=$id";
		//$recordset=$this->execute($_query);
		if($fetch=$this->select($_query))
		{
			// Fill all field  
			$data["id"]=$fetch[0]["adminid"];
			$data["first_name"]=$fetch[0]["firstname"];
			$data["last_name"]=$fetch[0]["lastname"];
			$data['address']=$fetch[0]["address"];
			$data["username"]=$fetch[0]["username"];
			$data["password"]=$fetch[0]["password"];
			$data["confirm_password"]=$fetch[0]["password"];
			$data["email"]=$fetch[0]["email"];
			$data['address']=$fetch[0]['address'];
			$data['phone_number']=$fetch[0]['phoneno'];
			$data['status']=$fetch[0]['isactive'];
//			$data['title']=$fetch[0]['title'];
			$data['user_type']=$fetch[0]['usertype'];
						
		}
		 //print_r($data);
		//die();
		
        return $data;   
	}
	
	/**
     * Updating Country entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars) {

		$query = "select * from ".$this->tablename." where adminid !=".$formvars['id']." and username = '".$formvars['username']."'";
		$fetch = $this->select($query);
		if($fetch!=false){
			$this->error = "This user name is already registered kindly use another user name.";
			return false;
		}
		
		$query = "select * from ".$this->tablename." where adminid !=".$formvars['id']." and email = '".$formvars['email']."'";
		$fetch = $this->select($query);
		if($fetch!=false){
			$this->error = "This email address is already registered kindly use another email address.";
			return false;
		}

		$record['firstname']=$this->mySQLSafe( $formvars['first_name']);
		$record['lastname']=$this->mySQLSafe( $formvars['last_name']);
    	$record['username']=$this->mySQLSafe( $formvars['username']);
		$record['password']=$this->mySQLSafe($formvars['password']);
//		$record['title']=$this->mySQLSafe($formvars['title']);
		$record['isactive']=$this->mySQLSafe($formvars['status']);
		$record['phoneno']=$this->mySQLSafe( $formvars['phone_number']);
		$record['usertype']=$this->mySQLSafe( $formvars['user_type']);
		$record['email']=$this->mySQLSafe( $formvars['email']);
		$record['address']=$this->mySQLSafe( $formvars['address']);
	
		$where="adminid=".$formvars['id'];
		
		if($this->update($this->tablename,$record,$where))
		{
			$this->error="Administrator has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="Administrator was not updated";
			return true;
		}
	
		
    }
    function addEntry($formvars) {
		
		$query = "select * from ".$this->tablename." where username = '".$formvars['username']."'";
		$fetch = $this->select($query);
		if($fetch!=false){
			$this->error = "User name already exists kindly use another username.";
			return false;
		}
		$query = "select * from ".$this->tablename." where email = '".$formvars['email']."'";
		$fetch = $this->select($query);
		if($fetch!=false){
			$this->error = "This email address is already registered kindly use another email address.";
			return false;
		}

		$record['firstname']=$this->mySQLSafe($formvars['first_name']);
    	$record['lastname']=$this->mySQLSafe($formvars['last_name']);
    	$record['username']=$this->mySQLSafe($formvars['username']);
    	$record['password']=$this->mySQLSafe($formvars['password']);
//		$record['title']=$this->mySQLSafe($formvars['title']);
		$record['isactive']=$this->mySQLSafe($formvars['status']);
		$record['email']=$this->mySQLSafe( $formvars['email']);
		$record['address']=$this->mySQLSafe( $formvars['address']);
		$record['phoneno']=$this->mySQLSafe( $formvars['phone_number']);

		$record['usertype']=$this->mySQLSafe( $formvars['user_type']);
		
		if($this->insert($this->tablename,$record))
		{
			$this->error="Administrator has been added successfully";
			return true;
		}
		else
		{
			$this->error="Administrator was not added";
			return true;
		}
		
    }	
	/**
	* Displaying the form
	* @param mixed $formvars the array of post vars
	*/
	function displayForm($formvars = array()) {

		// assign the form vars
        global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('data',$formvars);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('SITE_URL',SITE_URL);
        $this->tpl->display('adminmanagement.tpl');
    }

    function displayGrid($data = array()) {
	    global $GENERAL;		
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		if($_SESSION['message']!=''){
			$this->tpl->assign('error', $_SESSION['message']);
			$_SESSION['message'] = '';
		}
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('adminmanagement.tpl');        
    }
    
}
?>