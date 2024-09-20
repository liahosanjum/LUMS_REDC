<?php
/**
 * Login  Management application library
 *
 */
class ForgotPassword extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;

	///Class varibles
	var $pageview=null;
	var $tablename="redc_admin";
	var $tablename_email="redc_emailcontent";
	/**
     * class constructor
     */
    function ForgotPassword() {
        if(isset($_SESSION['adminusername']))
		{
              header("Location:welcome.php");
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
        
		 if(strlen(trim($formvars['username'])) == 0) {
            $this->error = 'Invalid Username. Please try again.';
            return false; 
        }
		elseif(strlen(trim($formvars['username'])) < 5) {
			$this->error = 'Username should be at least 6 characters long.';
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
       
	   $subject = '';
		$content = '';
		$from_email = '';
		$from_name = '';
		$mailserver = '';
				
	    $_query = "select * from " . $this->tablename ." where username='".$formvars['username']."'";
	   	$fetch_admin=$this->select($_query);
		if($fetch_admin)
		{
			  $query = "select * from ".$this->tablename_email." where emailname = 'Forgot Password'";
 			  $fetch = $this->select($query);
			  if($fetch)
			  {
				$subject = $fetch[0]['subject'];
				$content = $fetch[0]['content'];
				$from_email = $fetch[0]['fromemail'];
				$from_name = $fetch[0]['fromname'];
			  }
			  $content = str_replace('__USERNAME__', $fetch_admin[0]['username'], $content); 
			  $content = str_replace('__PASSWORD__', $fetch_admin[0]['password'], $content); 
			   
			   /*
			  $m= new Mail; // create the mail
			  $m->From( $from_email );
			  $m->To($fetch_admin[0]['email_address']);
			  $m->Subject( $subject );
			  $m->Body( $content );
			  $send_mail = $m->Send();
			  */
			  
			$mail = new SendEmail();
			  if(SENDEMAIL)
				{
					$send = $mail->Send_Email($from_email,$from_email,$fetch_admin[0]['email'],$fetch_admin[0]['email'],$subject,$content,$mailserver);
				}
			  $this->error="An email has been sent to you containing your password.";
			  return false;	
		}
		else
		{
    		$this->error="Username does not exist.";
			return false;
		}
    }
    /**
     * display the Faq records
     *
     * @param array $data the Faq data
     */
    function displayPage($formvars = array()) {
	    global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data',$formvars);		
		$this->tpl->assign('error', $this->error);		
	    $this->tpl->display('forgotpassword.tpl');        
    }
}
?>