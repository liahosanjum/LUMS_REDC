<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/index.lib.php');

$controller =& new Index;

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
switch($_action) {
    case 'view':
    default:
     	$controller->displayPage();        
	   break;   
}
?>
