<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/alumni.lib.php');

$controller =& new Alumni;

/*
if(!isset($_SESSION['alumniuser']))
{
 	header("Location:alumni_login.php");	
}
*/

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
