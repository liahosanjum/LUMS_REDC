<?php
require_once('classlibrary/publicconfigsmarty.php');

require_once($GENERAL['FRONT_DIR_LIB'].'/faculty_profiles.lib.php');

$controller =& new FacultyProfiles;

$_action  = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
$_start   = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';
$_groupby = isset($_REQUEST['groupby']) ? $_REQUEST['groupby'] : '';

switch($_action) {
    case 'view':
    default:
    $controller->pageview="display";
	$controller->displayGird($controller->getEntries($_start,$_REQUEST,$_groupby));
	 break;   
}
?>
