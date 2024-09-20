<?php
/**
 * Google Map Management application library
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
        
	     if(strlen(trim($formvars['oldpassword'])) == 0) {
            $this->error = 'You must supply an old password.';
            return false; 
        }
		//===mathching old passwordk===
		$sql = "select * from ".$this->tablename." where `password` = '$formvars[oldpassword]' and adminid= '".$formvars['adminuserid']."'";
		if($this->numrows($sql)==0){
			$this->error = 'Old password is not correct.';
            return false; 
		}
		// test if "latitude" is empty
        if(strlen(trim($formvars['password'])) == 0) {
            $this->error = 'You must supply a password.';
            return false; 
        }
		// test if "latitude" is empty
        if(strlen(trim($formvars['confrimpassword'])) == 0) {
            $this->error = 'You must supply a confirm password.';
            return false; 
        }
		
		if(trim($formvars['password'])!=trim($formvars['confrimpassword'])) {
            $this->error = 'Confirm password does not match.';
            return false; 
        }
		
	  	// form passed validation
        return true;
    }
   /*
	* load record from data base.
	*/
	function editEntry()
	{
		$_where = "where username = '".$_SESSION['adminusername']."'";
        $_query = "select * from ".$this->tablename." ".$_where." ";
		$fetch=$this->select($_query);
		if($fetch)
		{
			// Fill all field 
			$data['adminuserid'] = $fetch[0]['adminid'];
			$data['password'] = $fetch[0]['password'];
			$data['confrimpassword'] = $fetch[0]['password'];
			$data['oldpassword'] = $fetch[0]['password'];
    	}
        return $data;   
	}   
	/**
     * Updating Panel entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars) {
  		/// setting update variables 
		$record['password']=$this->mySQLSafe($formvars['password']);
		$where="adminid=".$formvars['adminuserid'];
    	/// Return true if query if success
		if($this->update($this->tablename,$record,$where))
		{
	 		$_SESSION['adminuserpassword']=$formvars['password'];
			$this->error="My account has been updated successfully";
			return true;
		}
		else
		{
			$this->error="My account has not been updated";
			return false;
		}        
    }	
	 /**
     * display the Faq entry form
     *
     * @param array $formvars the form variables
     */
    function displayForm($formvars = array()) {
        global $GENERAL;
		
		$this->tpl->assign('GENERAL', $GENERAL);
		// assign the form vars
        $this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('data',$formvars);
		
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('myaccount.tpl');
    }
   
}

?>
