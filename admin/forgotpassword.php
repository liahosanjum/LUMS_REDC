<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['PHYSICAL_PATH_CLASSLIB'].'/sendmail.class.php');
require_once($GENERAL['PHYSICAL_PATH_CLASSLIB'].'/sendemail.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/forgotpassword.lib.php');

// create Login object
$controller =& new ForgotPassword;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
 // echo($_POST['content']);
switch($_action) 
{
    case 'submit':
		if($controller->isValidForm($_POST))
		  {
		    	if(!$controller->validateUser($_POST))
				 {
				 	$controller->displayPage($_POST);
			 	 }
		  }
		 else
		  {
			  $controller->displayPage($_POST);
		  } 		
        break; ////// case: submit end
    case 'view':
    default:
        // viewing the Page
       $controller->displayPage($_POST);        
	   break;   
}

?>
