<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/changepassword.lib.php');

$controller =& new ChangePassword;

/*
if(!isset($_SESSION['alumniuser']))
{
 	header("Location:alumni_login.php");	
}
*/

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {

	case 'submit':
		//Validate Require Fields
		if($controller->isValidForm($_POST))
		 {
			if($controller->updateEntry($_POST))
			{					
				$controller->displayForm($_POST); 
			}
			else
			{
				$controller->displayForm($_POST); 
			}
		} 
		else 
		{
			$controller->displayForm($_POST);
		}		
        break;
	
    case 'view':
    default:
    	$controller->pageview="display";
		$controller->displayForm($_REQUEST);
	 break;   
}
?>
