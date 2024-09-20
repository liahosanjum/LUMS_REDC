<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/news.lib.php');
$controller =& new News;

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
switch($_action) {
    case 'view':
    default:
//		if(isset($_GET['page']) && isset($_GET['id']) && $_GET['page'] != "" && $_GET['id'] != "")
		if(isset($_GET['id']) && $_GET['id'] != "")
		{		
			$controller->displayNews($_GET);
		}
		else
		{
     		$controller->displayPage();        
		}
	   break;   
}
?>
