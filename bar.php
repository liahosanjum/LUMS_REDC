<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once('libs/bar.lib.php');
$controller =& new Bar;

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
switch($_action) {
    case 'view':
    default:
     	$controller->displayPage();        
	   break;   
}

?>
