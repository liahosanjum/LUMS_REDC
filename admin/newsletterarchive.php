<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/newsletterarchive.lib.php');
// create Gallery Management object
$controller =& new NewsLetterArchive;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
// set the current page value 
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {
		
	case 'viewdetail':
        // edit an entry
		$controller->pageview="viewdetail";
    	$controller->displayForm($controller->getDetail($_GET['nhid']));
	    break;
		
    case 'view':
    default:
         // viewing the Gallery
        $controller->pageview="display";
		$controller->displayGird($controller->getEntries($_start,$_POST));        
	    break;		
}

?>
