<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['BASE_DIR_ROOT'].'/fckeditor/fckeditor.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/emailcontentmanagement.lib.php');
//require_once($GENERAL['ADMIN_DIR_LIB'].'/exportcsv.inc.php');
// create Content Management object
$controller =& new EmailContentManagement;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
// set the current page value 
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {

    case 'edit':
        // edit a Content entry
		$controller->pageview="edit";
    	$controller->loadEmailVariables($_GET['id']);
		$controller->displayForm($controller->editEntry($_GET['id']));
	    break;
		
    case 'submit':
		$_mode = $_REQUEST['mode'] ;
		if($_mode=="add")
		{
			// submitting a Content entry
			$controller->pageview="add";
			//Validate Require Fields
			if($controller->isValidForm($_POST)) 
			{
				$controller->addEntry($_POST);
				
				$controller->pageview="display";
				$controller->displayGird($controller->getEntries($_start,$_POST));
			} 
			else 
			{
				$controller->displayForm($_POST);
			}
		}
		else
		{
			// updating a Content entry
			$controller->pageview="edit";
			//Validate Require Fields
			if($controller->isValidForm($_POST))
			 {
				$controller->updateEntry($_POST);
				$controller->pageview="display";
				$controller->displayGird($controller->getEntries($_start,$_POST));
			} 
			else 
			{
				$controller->displayForm($_POST);
			}
		}
        break;
    case 'view':
    default:
        // viewing the Content
        $controller->pageview="display";
		$controller->displayGird($controller->getEntries($_start,$_POST));        
	    break;   
		
}

?>
