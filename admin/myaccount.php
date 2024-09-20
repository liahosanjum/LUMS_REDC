<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/myaccount.lib.php');

// create Google Map Management object
$controller =& new MyAccount;
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
switch($_action) {
      case 'submit':
		$_mode = $_REQUEST['mode'] ;
		if($_mode=="edit")
		{
			//Validate Require Fields
			if($controller->isValidForm($_POST))
			 {
				if($controller->updateEntry($_POST))
				{					
					$controller->displayForm($controller->editEntry()); 
				}
				else
				{
					$controller->displayForm($controller->editEntry()); 
				}
			} 
			else 
			{
				$controller->displayForm($_POST);
			}
		}
        break;
		
    case 'view':
    default:
        // viewing the Google Coordanaties
       	$controller->displayForm($controller->editEntry());        
	    break;   		
}
?>