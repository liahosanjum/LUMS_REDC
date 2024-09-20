<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/usermanagement.lib.php');
// create Gallery Management object
$controller =& new UserManagement;
// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
// set the current page value 
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {
    case 'add':
        // adding an  entry
		$controller->pageview="add";		
	    $controller->displayForm();
	    break;
		
	case 'edit':
        // edit an entry
		$controller->pageview="edit";
    	$controller->displayForm($controller->editEntry($_GET['id']));
	    break;
		
	case 'del':
        // deleting an entry
		$controller->pageview="del";
		$controller->deleteEntry($_GET['id']);
	    $controller->displayGrid($controller->getEntries($_start,$_REQUEST));   
        break;		
		
    case 'submit':
		$_mode = $_REQUEST['mode'] ;
		if($_mode=="add")
		{
			// submitting an entry
			$controller->pageview="add";			
			//Validate Require Fields
			if($controller->isValidForm($_POST,$_mode)) 
			{				
				if($controller->addEntry($_POST ,$record))
				{
   				     $controller->pageview="display";
				     $controller->displayGrid($controller->getEntries($_start,$_POST));
				}
				else
				{ 
    				 $controller->displayForm($_REQUEST);
				}	
			} 
			else 
			{
				$controller->displayForm($_REQUEST);
			}
		}
		else
		{
			// updating an entry
			$controller->pageview="edit";
			//Validate Require Fields
			if($controller->isValidForm($_REQUEST))
			 {
				if($controller->updateEntry($_REQUEST))
				{
					$controller->pageview="display";
					$controller->displayGrid($controller->getEntries($_start,$_REQUEST));
				}
				else
				{
				    $controller->displayForm($_REQUEST);
				}	
			} 
			else 
			{
				$controller->displayForm($_REQUEST);
			}
		}
        break;
		
    case 'view':
    default:
         // viewing the Gallery
        $controller->pageview="display";
		$controller->displayGrid($controller->getEntries($_start,$_REQUEST));        
	    break;		
}

?>
