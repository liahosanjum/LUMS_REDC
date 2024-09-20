<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/faq.lib.php');
$controller =& new Faq;

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
switch($_action) {
    case 'view':
    default:
		
			$controller->displayPage($_start,$_REQUEST);        
		
	   break;   
}
?>
