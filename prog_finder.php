<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/prog_finder.lib.php');

$controller =& new Progfinder;

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

/*
var_export($_REQUEST);
exit;
*/
switch($_action) {
    
	case 'view':
    default:
         // viewing the oep_programme
      		$controller->displayGird($controller->programmeFinder($_start,$_REQUEST));        
	    break;		
	
	
	/*case 'view':
    default:
	
   	$controller->displayGird($_start,$_REQUEST);
	 //$controller->programmeFinder($_REQUEST,$_start);
	 break; */  
}
?>
