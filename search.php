<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/search.lib.php');
$controller =& new Search;

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
switch($_action) {
    case 'view':
    default:
   		$controller->displayPage($controller->searchContents($_start,$_REQUEST));        
	   break;   
}
?>
