<?php
/**
 *
 *
 */
class UserManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tblusers="redc_user";
	var $tbloepusers="redc_oep_applicants";
	var $tblofpusers="redc_ofp_users";
	var $sortcolumn=" uid ";
	var $sortdirection=" desc ";
	
    /**
     * class constructor
     */
    function UserManagement() {
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
		if(strlen(trim($formvars['firstname'])) == 0) {
            $this->error = 'Please provide first name';
            return false; 
        }
		if(strlen(trim($formvars['lastname'])) == 0) {
            $this->error = 'Please provide last name';
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
		if(strlen(trim($formvars['type'])) == 0) {
            $this->error = 'Please provide user type';
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


		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows("select uid from ".$this->tblusers.$where );
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		
		$_query = "select * from " . $this->tblusers.$where. $orderby ."  Limit $paging->start,$paging->limit";
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
		$recordset = true;
		$flag = true;
		
		//check user type
		$_qry_type = "select type from ".$this->tblusers." where uid=$id";		
		$type = $this->select($_qry_type);
		
		if($type[0]['type'] == "oep")
		{
			// check if user record exists in oep applicants tbl
			$_qry_oep = "select uid from ".$this->tbloepusers." where uid=$id";
			if($this->numrows($_qry_oep))
			{
				$flag = false;	
			}
			
		}
		else if($type[0]['type'] == "ofp")
		{
			// check if user record exists in oep applicants tbl
			$_qry_ofp = "select uid from ".$this->tblofpusers." where uid=$id";
			if($this->numrows($_qry_ofp))
			{
				$flag = false;	
			}
		}
		

		if($flag) {
			$_query="delete from ".$this->tblusers." where uid=$id";
			$recordset=$this->execute($_query);
			if($recordset) 
			{
				$this->error="User has been deleted successfully.";
				return true;
			}
			else
			{
				$this->error="User was not deleted";
				return false;			
			}			
		}// check flag value
		else
		{
				$this->error="Foreign Key Constraint: User can't be not deleted.";
				return false;			
			
		}		
	}	

	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
		$_query = "select * from ".$this->tblusers." where uid=$id";
		//$recordset=$this->execute($_query);
		if($fetch=$this->select($_query))
		{
			// Fill all field  
			$data["uid"]=$fetch[0]["uid"];
			$data["firstname"]=$fetch[0]["firstname"];
			$data["lastname"]=$fetch[0]["lastname"];
			$data["password"]=$fetch[0]["password"];
			$data["confirm_password"]=$fetch[0]["password"];
			$data["email"]=$fetch[0]["email"];						
			$data["isactive"]=$fetch[0]["isactive"];
			$data["type"]=$fetch[0]["type"];
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

		$query = "select * from ".$this->tblusers." where uid !=".$formvars['id']." and email = '".$formvars['email']."'";
		$fetch = $this->select($query);
		if($fetch!=false){
			$this->error = "This email address is already registered, kindly use another email address.";
			return false;
		}

		$record['firstname']=$this->mySQLSafe( $formvars['firstname']);
		$record['lastname']=$this->mySQLSafe( $formvars['lastname']);
		$record['password']=$this->mySQLSafe($formvars['password']);
		$record['email']=$this->mySQLSafe( $formvars['email']);
		$record['isactive']=$this->mySQLSafe($formvars['isactive']);
		$record['type']=$this->mySQLSafe($formvars['type']);
		$where=" uid=".$formvars['id'];
		
		if($this->update($this->tblusers,$record,$where))
		{
			$this->error="User has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="User was not updated";
			return true;
		}
	
		
    }
    function addEntry($formvars) {
		
		$query = "select * from ".$this->tblusers." where email = '".$formvars['email']."'";
		$fetch = $this->select($query);
		if($fetch!=false){
			$this->error = "This email address is already registered, kindly use another email address.";
			return false;
		}

		$record['firstname']=$this->mySQLSafe($formvars['firstname']);
    	$record['lastname']=$this->mySQLSafe($formvars['lastname']);
    	$record['email']=$this->mySQLSafe($formvars['email']);
    	$record['password']=$this->mySQLSafe($formvars['password']);
		$record['isactive']=$this->mySQLSafe($formvars['isactive']);
		$record['type']=$this->mySQLSafe($formvars['type']);
		
		if($this->insert($this->tblusers,$record))
		{
			$this->error="User has been added successfully";
			return true;
		}
		else
		{
			$this->error="User was not added";
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
        $this->tpl->display('usermanagement.tpl');
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
		
	    $this->tpl->display('usermanagement.tpl');        
    }
    
}
?>