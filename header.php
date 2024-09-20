<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once('libs/header.lib.php');
$controller =& new Header;

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
switch($_action) {
    case 'view':
    default:
     	$controller->displayPage();        
	   break;   
}

?>
