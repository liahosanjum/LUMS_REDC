<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/podcasts.lib.php');
$controller =& new Podcasts;

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
switch($_action) {
    case 'view':
    default:
//		if(isset($_GET['page']) && isset($_GET['id']) && $_GET['page'] != "" && $_GET['id'] != "")
   		$controller->displayPage();        
	   break;   
}
?>
