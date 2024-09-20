<?php
/**
 *
 *
 */
class ChangePassword extends db{

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
    function ChangePassword() {
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
		if(strlen(trim($formvars['password'])) == 0) {
            $this->error = 'Please provide old password';
            return false; 
        }
		if(strlen(trim($formvars['newpassword'])) == 0) {
            $this->error = 'Please provide new password';
            return false; 
        }
		
		if(strlen(trim($formvars['newpassword'])) < 6) {
			$this->error = 'New password should be at least 6 characters long.';
			return false; 
		}
		
		if(trim($formvars['newpassword']) != trim($formvars['confirmnewpassword']) ) {
			$this->error = 'New password and confirm new password don\'t match';
			return false; 
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
/*			$data["first_name"]=$fetch["firstname"];
			$data["last_name"]=$fetch["lastname"];
			$data["email"]=$fetch["email"];
			$data["username"]=$fetch["username"];
*///			$data['password']=$fetch['password'];
//			$data['title']=$fetch['title'];
			
			
		}
		
        return $data;   
	}
	
	/**
     * Updating Country entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars) {
	
		
		$query = "select * from ".$this->tablename." where adminid = ".$formvars['id']." and password = ".$this->mySQLSafe($formvars['password']);
		//$fetch = $this->select($query);
		
		if($this->numrows($query) < 1){
			$this->error = "Incorrect old password";
			return false;
		}

		$record['password']=$this->mySQLSafe( $formvars['newpassword']);
		$where="adminid=".$formvars['id'];
		
		if($this->update($this->tablename,$record,$where))
		{
			//$_SESSION['adminemail']=$formvars['email'];
			$this->error="Your password has been changed successfully.";
			return true;
		}
		else
		{
			$this->error="Password was not changed";
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
        $this->tpl->display('changepassword.tpl');
    }
    
}
?>