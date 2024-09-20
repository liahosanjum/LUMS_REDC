<?php
require_once('../classlibrary/configsmarty.php');
require_once('../classlibrary/resize.image.class.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/upload_vt_pictures.lib.php');
require_once($GENERAL['BASE_DIR_ROOT'].'/fckeditor/fckeditor.php');
// create Gallery Management object
$controller =& new upload_vt_pictures;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
// set the current page value 
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {
	case 'sortcat':
	    $controller->pageview="sortcat";
        if(isset($_REQUEST['submit']))
		{
		   if($controller->saveCats($_REQUEST))
		   {
    		   $controller->displayGird($controller->getSortedEntries());
		   }
		}
		else
		{
		   $controller->displayGird($controller->getSortedEntries());
		}  
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
				
	case 'del':
        // deleting an entry
		$controller->pageview="del";
		$controller->deleteEntry($_GET['id']);
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
				if($controller->updateEntry($_POST,$_REQUEST['id'],$_FILES))
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
         // viewing the Gallery
        $controller->pageview="display";
		if(isset($_REQUEST['mode']))
		{
			$_mode = $_REQUEST['mode'] ;
			if($_mode == "sort")
			{
				if($controller->isValidSorting($_POST))
				{
					$controller->sortListing($_POST);	
				}
			}
		}
		$controller->displayGird($controller->getEntries($_start,$_REQUEST));        
	    break;		
}
?>



