<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/newsdetail.lib.php');

// create Gallery Management object
$controller =& new Newsdetail;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
// set the current page value 
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {
	case 'sortnews':
	    $controller->pageview="sortnews";
        if(isset($_REQUEST['submit']))
		{
		   if($controller->saveNews($_REQUEST))
		   {
    		   $controller->displayGird($controller->getSortedEntries());
		   }
		}
		else
		{
		   $controller->displayGird($controller->getSortedEntries());
		}  
	    break;
   	
	
		
		
    case 'submit':
		$_mode = $_REQUEST['mode'] ;

		if($_mode=="add")
		{
			// submitting a entry
			$controller->pageview="add";
			$controller->mungeFormData($_POST);
			
			//Validate Require Fields
			if($controller->isValidForm($_POST, $_FILES)) 
			{
				
				if($controller->addEntry($_POST, $_FILES))
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
			if($controller->isValidForm($_POST, $_FILES))
			 {
				
				if($controller->updateEntry($_POST, $_FILES))
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
		
		$controller->displayGird($controller->getEntries($_start,$_REQUEST));        
	    break;   
		
}

?>
