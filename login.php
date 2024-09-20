<?php
require_once('classlibrary/publicconfigsmarty.php');
include("classlibrary/sendemail.php");
require_once($GENERAL['FRONT_DIR_LIB'].'/login.lib.php');

$controller =& new Login;

/*
if(!isset($_SESSION['alumniuser']))
{
 	header("Location:alumni_login.php");	
}
*/

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {
    case 'loginform':
    $controller->pageview="display";
	if($controller->isValidLoginForm($_POST))
	{
		
		if($controller->validLoginUser($_POST))
		{
			$controller->redirect();
		}
		else
		{
			$controller->displayGird($_REQUEST);
		}
		// redirect to applyonline after successful login	
	}
	else
	{
		//$controller->displayGird($controller->getEntries($_start,$_REQUEST));	
		$controller->displayGird($_REQUEST);
	}
	break;
	
	case 'forgot':
		$controller->pageview="forgot";	
		
		if(isset($_POST['state']) && $_POST['state'] == 'submit')
		{
			if($controller->isValidForgotForm($_POST))
			{
				if($controller->alreadyExists($_POST['forgotuser']))
				{
					$controller->sendForgotPassMail($_POST['forgotuser'] , MAILSERVER);
					$controller->error = "Email has been sent to your email address.";	
				}
				else
				{
					$controller->error = "Email doesn't exist.";
				}
			}		
		}
		
		$controller->displayGird($_REQUEST);
	break;
	
	case 'change':
		$controller->pageview="change";	
		
		if(isset($_POST['state']) && $_POST['state'] == 'submit')
		{
			if($controller->isValidChangeForm($_POST))
			{
				if($controller->updatePassword($_POST))
				{
					$controller->error = "Your password has been changed";	
				}
				else
				{
					$controller->error = "You provided wrong email or wrong current password";
				}
			}		
		}
		
		$controller->displayGird($_REQUEST);
	break;

	case 'create':
		$controller->pageview="create";	
		
		if(isset($_POST['state']) && $_POST['state'] == 'submit')
		{
			if($controller->isValidCreateForm($_POST))
			{
				if($controller->addEntry($_POST))
				{
					$controller->sendEmail($_POST , 1 , MAILSERVER);
					$controller->redirect();
					// set session variable and redirect to applyonline page
				}
			}		
		}
		
		$controller->displayGird($_REQUEST);
	break;

	
    case 'view':
    default:
    	$controller->pageview="display";
		$controller->displayGird($_REQUEST);
	 break;   
}
?>
