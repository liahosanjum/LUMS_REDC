<?php
require_once('../classlibrary/configsmarty.php');
require_once('../classlibrary/imaging.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/pageSectionPictures.lib.php');
// create country Management object
$controller =& new pageSectionPictures;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
// set the current page value 
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {
    case 'add':
        // adding a country entry
		$controller->pageview="add";
        $controller->displayForm();
	    break;
		
	case 'edit':
        $controller->pageview="edit";
    	$controller->displayForm($controller->editEntry($_GET['psid']));
	    break;
		
	case 'del':
        // deleting a country entry
		$controller->pageview="del";
		$controller->deleteEntry($_GET['psid']);
		$controller->displayGird($controller->getEntries($_start,$_POST));   
        break;		
		
    case 'submit':
		$_mode = $_REQUEST['mode'] ;
		if($_mode=="add")
		{
			// submitting a country entry
			$controller->pageview="add";
			//Validate Require Fields
			if($controller->isValidForm($_POST,$_FILES)) 
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
			// updating a country entry
			$controller->pageview="edit";
		    //Validate Require Fields
			if($controller->isValidForm($_POST,$_FILES))
			 {
				if($controller->updateEntry($_POST,$_FILES))
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
	case 'status':
	       	$controller->updateStatus($_REQUEST);
			$controller->pageview="display";
			$controller->displayGird($controller->getEntries($_start,$_POST),$_POST);
     	break;
    case 'view':
    default:
        // viewing the country
        $controller->pageview="display";
		$controller->displayGird($controller->getEntries($_start,$_POST),$_POST);        
	    break;   
		
}

?>
