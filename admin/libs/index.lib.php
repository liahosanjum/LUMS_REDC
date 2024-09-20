<?php
/**
 * Login  Management application library
 *
 */
class LoginManagement extends db{

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
    function LoginManagement() {
        $this->tpl =& new Smarty;
		$this->db();		
    }        
    ///// redirect admin to welcome page if valid or already login
	function redirectAdmin()
	{
	  header("Location:welcome.php");	
	}	
	 /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars) {

		// reset error message
        $this->error = null;
        
		// test if "Title" is empty
        if(strlen(trim($formvars['username'])) == 0) {
            $this->error = 'Please provide Username';
            return false; 
        }

		// test if "Alt text" is empty
        if(strlen(trim($formvars['password'])) == 0) {
            $this->error = 'Please provide Password';
            return false; 
        }
		
		// form passed validation
        return true;
    }
	
	/**
     * add a new Gallery entry
     *
     * @param array $formvars the form variables
     */
    function validateUser($formvars) {
       
	   $_query = "select * from " . $this->tablename ." where username='".$formvars['username']."' and password='".$formvars['password']."' and isactive ='Y'";
	   if($this->numrows($_query) > 0 ){
			
			$fetch=$this->select($_query);
			if($fetch!=false)
		    {
			  $_SESSION['adminuserid']=$fetch[0]['adminid'];
			  $_SESSION['adminusername']=$fetch[0]['username'];
			  //$_SESSION['adminemail']=$fetch[0]['email'];
			  $_SESSION['usertype']=$fetch[0]['usertype'];
			  $_SESSION['adminuserpassword']=$fetch[0]['password'];
			}
			$returnURL = $formvars['returnURL'];
		
			if(isset($returnURL) && $returnURL !=''){
				header("Location:$returnURL");
				exit;
			}
			$this->redirectAdmin();
			
		}else{
			
			$this->error="Please insert valid username or password.";
			return false;
		}
    }
    /**
     * display the Index page
     */
    function displayPage($formvars = array()) {
	    global $GENERAL;
		$this->tpl->assign('returnUR',$_REQUEST['returnURL']);
		$this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data',$formvars);		
		$this->tpl->assign('error', $this->error);		
	    $this->tpl->display($GENERAL['BASE_DIR_ADMIN_TPL'].'/index.tpl');        
    }
}
?>