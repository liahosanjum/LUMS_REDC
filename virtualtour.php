<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/virtualtour.lib.php');
//require_once($GENERAL['BASE_DIR_ROOT'].'/fckeditor/fckeditor.php');
// create Gallery Management object
$controller =& new VirtualTour;
// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
// set the current page value 
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {
		
    case 'view':
    default:
         // viewing the Gallery
        $controller->pageview="display";
		$controller->displayPage();
	    break;		
}

?>