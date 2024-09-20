<?php
/**
 *
 *
 */
class Profile extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_admin";
	var $tbl_country="site_countries";
	var $tbl_states="site_states";
	
    /**
     * class constructor
     */
    function Profile() {
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
		if(strlen(trim($formvars['first_name'])) == 0) {
            $this->error = 'Please provide first name';
            return false; 
        }
		if(strlen(trim($formvars['last_name'])) == 0) {
            $this->error = 'Please provide last name';
            return false; 
        }
/*		if(strlen(trim($formvars['username'])) == 0) {
            $this->error = 'Please provide the username.';
            return false; 
        }
		if(strlen(trim($formvars['username'])) < 6) {
			$this->error = 'Username should be at least 6 characters long.';
			return false; 
		}
*/		
		/*if($formvars['password'!= 0]) {
            
			$this->error= "Please provide the password";
        }
		if(strlen(trim($formvars['password'])) < 6) {
			$this->error = 'Password should be at least 6 characters long.';
			return false; 
		}*/
/*		if(strlen($formvars['email']) == 0) {
            $this->error = 'Must provide email';
            return false; 
        }
*/		
		if(strlen($formvars['email']) > 0) {
			if($formvars['email'] != "" && !eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",$formvars['email']))
			{
				$this->error = 'Invalid email';
				return false; 		
			}
		}


        return true;
    }
	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
		$_query = "select * from ".$this->tablename." where adminid=$id";
		
		$recordset=$this->execute($_query);
		if($fetch=mysql_fetch_array($recordset))
		{
			
			// Fill all field 
			$data["id"]=$fetch["adminid"];
			$data["first_name"]=$fetch["firstname"];
			$data["last_name"]=$fetch["lastname"];
			$data["email"]=$fetch["email"];
			$data["username"]=$fetch["username"];
//			$data['password']=$fetch['password'];
			$data['title']=$fetch['title'];
			
			
		}
		
        return $data;   
	}
	
	/**
     * Updating Country entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars) {
	
		
/*		$query = "select * from ".$this->tablename." where adminid !=".$formvars['id']." and username = '".$formvars['username']."'";
		$fetch = $this->select($query);
		if($fetch!=false){
			$this->error = "This user name is already registered kindly use another user name.";
			return false;
		}
*/		
		$record['firstname']=$this->mySQLSafe( $formvars['first_name']);
		$record['lastname']=$this->mySQLSafe( $formvars['last_name']);
		$record['email']=$this->mySQLSafe( $formvars['email']);
	//	$record['username']=$this->mySQLSafe( $formvars['username']);
//		$record['password']=$this->mySQLSafe( $formvars['password']);
		$record['title']=$this->mySQLSafe( $formvars['title']);
		//$record['zip_code']=$this->mySQLSafe( $formvars['zip_code']);

		$where="adminid=".$formvars['id'];
		
		if($this->update($this->tablename,$record,$where))
		{
			//$_SESSION['adminemail']=$formvars['email'];
			$this->error="Your profile information has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="Profile has not been updated";
			return true;
		}
	
		
    }
	
	
	function getStates() {

		$_query = " select * from ".$this->tbl_states." order by statename asc ";
		
		$states=$this->select($_query);
	    if($states == false)
		{
			$states = array();
		}
		
        return $states;   
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
		$this->tpl->assign('states', $this->getStates());
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('SITE_URL',SITE_URL);
        $this->tpl->display('profile.tpl');
    }
    
}
?>