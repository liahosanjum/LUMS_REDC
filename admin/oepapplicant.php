<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/oepapplicant.lib.php');

// create alumni Management object
$controller =& new OEPApplicant;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view'; 
// set the current page value 
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {
	
	case 'view':
	default:
	$controller->pageview="detail";
	$controller->displayForm($controller->editEntry($_GET['oepaid']));
	
	break;
	
	
}

?>
