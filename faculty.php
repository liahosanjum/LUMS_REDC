<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/faculty.lib.php');

$controller =& new Faculty;

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {
    case 'view':
    default:
    $controller->pageview="display";
	$controller->displayGird($controller->getEntries($_start,$_REQUEST));
	 break;   
}
?>
