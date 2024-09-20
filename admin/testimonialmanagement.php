<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['BASE_DIR_ROOT'].'/fckeditor/fckeditor.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/testimonialmanagement.lib.php');

// create Gallery Management object
$controller =& new TestimonialManagement;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
// set the current page value 
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {
	case 'sorttestimonials':
	    $controller->pageview="sorttestimonials";
        if(isset($_REQUEST['submit']))
		{
		   if($controller->saveTestimonials($_REQUEST))
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
        // adding a entry
		$controller->pageview="add";
	    $controller->displayForm();
	    break;
		
	case 'edit':
        // edit a entry
		$controller->pageview="edit";
    	$controller->displayForm($controller->editEntry($_GET['id']));
	    break;
		
	case 'del':
        // deleting a entry
		$controller->pageview="del";
		$controller->deleteEntry($_GET['id']);
	    $controller->displayGird($controller->getEntries($_start,$_POST));   
        break;		
		
    case 'submit':
		$_mode = $_REQUEST['mode'] ;

		if($_mode=="add")
		{
			// submitting a entry
			$controller->pageview="add";
			$controller->mungeFormData($_POST);
			
			//Validate Require Fields
			if($controller->isValidForm($_POST)) 
			{
				
				if($controller->addEntry($_POST))
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
			// updating a  entry
			$controller->pageview="edit";
			$controller->mungeFormData($_POST);
			//Validate Require Fields
			if($controller->isValidForm($_POST))
			 {
				
				if($controller->updateEntry($_POST))
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
        // viewing the Records
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
		$controller->displayGird($controller->getEntries($_start,$_POST));        
	    break;   
		
}

?>
