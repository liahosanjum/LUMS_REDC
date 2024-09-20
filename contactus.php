<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once('classlibrary/sendemail.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/contactus.lib.php');
$controller =& new ContactUs;

$_action = isset($_REQUEST['form_action']) ? $_REQUEST['form_action'] : 'view';

switch($_action) {
	case 'submit':
		if($controller->isValidForm($_POST))
		{
			if($controller->submitRequest($_POST))
			{
			
				header('location: '.SITE_URL."/index.php");
			}
			else
			{
				$controller->displayPage($_POST);
			}
		}
		else
		{
			$controller->displayPage($_POST);
		}     	
	   break;   
    case 'view':
    default:

     	$controller->displayPage($_POST);        
	   break;   
}
?>
