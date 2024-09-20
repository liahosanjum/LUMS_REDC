<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/mailinglistmanagement.lib.php');
// create Gallery Management object
$controller =& new MailingListManagement;

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
    	$controller->displayForm($controller->editEntry($_GET['nsid']));
	    break;
		
	case 'del':
        // deleting an entry
		$controller->pageview="del";
		$controller->deleteEntry($_GET['nsid']);
	    $controller->displayGrid($controller->getEntries($_start,$_POST));   
        break;		
		
    case 'submit':
		$_mode = $_REQUEST['mode'] ;
		if($_mode=="add")
		{
			// submitting an entry
			$controller->pageview="add";			
			//Validate Require Fields
			if($controller->isValidForm($_POST)) 
			{				
				if($controller->addEntry($_POST))
				{
   				     $controller->pageview="display";
				     $controller->displayGrid($controller->getEntries($_start,$_POST));
				}
				else
				{ 
    				 $controller->displayForm($_POST);
				}	
			} 
			else 
			{
				$controller->displayForm($_POST);
			}
		}
		else
		{
			// updating an entry
			$controller->pageview="edit";
			//Validate Require Fields
			if($controller->isValidForm($_POST))
			 {
				if($controller->updateEntry($_POST))
				{
					$controller->pageview="display";
					$controller->displayGrid($controller->getEntries($_start,$_POST));
				}
				else
				{
				    $controller->displayForm($_POST);
				}	
			} 
			else 
			{
				$controller->displayForm($_POST);
			}
		}
        break;
	case 'export':
        // viewing the Content
        $controller->pageview="display";
		$controller->exportMysqlToCsv();
		$controller->displayGrid($controller->getEntries($_start,$_POST));        
	    break;   

    case 'view':
    default:
         // viewing the Gallery
        $controller->pageview="display";
		$controller->displayGrid($controller->getEntries($_start,$_POST));        
	    break;		
}

?>
