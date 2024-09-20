<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/profile.lib.php');
//print_r($_SESSION);
//exit;
//fdf
// create country Management object
$controller =& new Profile;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
// Getting user_id
$adminuserid = $_SESSION['adminuserid'];

switch($_action) {
    case 'submit':
		$_mode = $_REQUEST['mode'] ;
		// updating a country entry
		$controller->pageview="edit";
		//Validate Require Fields
		if($controller->isValidForm($_POST))
		 {
			if($controller->updateEntry($_POST))
			{
				$controller->pageview="edit";
				$controller->displayForm($controller->editEntry($adminuserid));
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
        // viewing the country
        $controller->pageview="edit";
    	$controller->displayForm($controller->editEntry($adminuserid));
	    break;   
		
}

?>
