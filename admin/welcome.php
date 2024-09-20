<?php

require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/welcome.lib.php');

// create Welcome object
$controller =& new Welcome;

// set the current action
$_action = 'view';

switch($_action) {
    	
    case 'view':
    default:
        // viewing the Records
   		$controller->displayPage();        
	    break;   
		
}

?>
