<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/oepapplicantsmanagement.lib.php');
require_once($GENERAL['BASE_DIR_ROOT'].'/fckeditor/fckeditor.php');
// create alumni Management object
$controller =& new OFPManagement;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view'; 
// set the current page value 
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {

	case 'alumni':
		/*	
		echo "<pre>";
			print_r($_REQUEST);
		echo "</pre>";*/
		$controller->makeAlumni($_REQUEST);
        $controller->pageview="display";
		$controller->displayGird($controller->getEntries($_start,$_REQUEST));        
	break;	  
	
	case 'parent':
		// if page called from programmes management
		  /*echo "<pre>";
				print_r($_REQUEST);
			echo "</pre>";
			exit;
		  */
        $controller->pageview="display";
		$controller->displayGird($controller->getEntries($_start,$_REQUEST));        
	break;
	
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
		case 'upload':
        // upload images
		$controller->pageview="upload";
    	($controller->upload($_GET['id']));
	    break;
		
	case 'detail':
	$controller->pageview="detail";
	$controller->displayForm($controller->editEntry($_GET['id']));
	
	break;
	
	case 'del':
        // deleting an entry
		$controller->pageview="del";
		$controller->deleteEntry($_GET['id']);
	    $controller->displayGird($controller->getEntries($_start,$_POST));   
        break;		
		
    case 'submit':
		$_mode = $_REQUEST['mode'] ;
		
		if($_mode=="change")
		{
			$controller->pageview="display";
			$controller->changeStatus($_REQUEST);
			$controller->displayGird($controller->getEntries($_start,$_REQUEST));  
		}
	
		else if($_mode=="add")
		{
			// submitting an entry
			$controller->pageview="add";			
			//Validate Require Fields
			if($controller->isValidForm($_POST,$_FILES,$_mode)) 
			{				
				if($controller->addEntry($_POST,$_FILES))
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
	
		else
		{
			// updating an entry
			$controller->pageview="edit";
			//Validate Require Fields
			if($controller->isValidForm($_POST,$_FILES,$_mode)) 
			 {
				if($controller->updateEntry($_REQUEST,$_REQUEST['id']))
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
		case 'export':
        // viewing the Content
        $controller->pageview="display";
		$controller->exportMysqlToCsv($_POST);       
	    break; 
    case 'view':
    default:
         // viewing the alumni
        $controller->pageview="display";
		$controller->displayGird($controller->getEntries($_start,$_REQUEST));        
	    break;		
}

?>
