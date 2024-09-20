<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/ oep_view_completed.lib.php');
require_once($GENERAL['BASE_DIR_ROOT'].'/fckeditor/fckeditor.php');
// create  oep_view_completedManagement Management object
$controller =& new  oep_view_completedManagement;

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
    	$controller->displayForm($controller->editEntry($_GET['oepid']));
	    break;
		case 'upload':
        // upload images
		$controller->pageview="upload";
    	($controller->upload($_GET['oepid']));
	    break;
		
	case 'del':
        // deleting an entry
		$controller->pageview="del";
		$controller->deleteEntry($_GET['oepid']);
	    $controller->displayGird($controller->getEntries($_start,$_REQUEST));   
        break;		
		
    case 'submit':
		$_mode = $_REQUEST['mode'] ;
		if($_mode=="add")
		{
			// submitting an entry
			$controller->pageview="add";			
			//Validate Require Fields
			if($controller->isValidForm($_POST,$_FILES,$_mode)) 
			{				
				if($controller->addEntry($_POST,$_FILES))
				{
   				     $controller->pageview="display";
				     $controller->displayGird($controller->getEntries($_start,$_REQUEST));
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
			if($controller->isValidForm($_POST,$_FILES,$_mode)) 
			 {
				if($controller->updateEntry($_POST,$_GET['oepid'],$_FILES))
				{
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
				$controller->displayForm($_POST);
			}
		}
        break;
		
    case 'view':
    default:
         // viewing the  oep_view_completedManagement
        $controller->pageview="display";
		$controller->displayGird($controller->getEntries($_start,$_REQUEST));        
	    break;		
}

?>
