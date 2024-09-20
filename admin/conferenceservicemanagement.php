<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['BASE_DIR_ROOT'].'/fckeditor/fckeditor.php');
require_once($GENERAL['PHYSICAL_PATH_CLASSLIB'].'/sendmail.class.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/conferenceservicemanagement.lib.php');

// create Contactus Management object
$controller =& new ConferenceServiceManagement;

// set the current action
//$_isactive = (isset($_REQUEST['isactive']) && $_REQUEST['isactive'] != "") ? $_REQUEST['isactive'] : '';

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
$_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 'open';
// set the current page value 
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {
    case 'close':
     	// close a Contactus entry
			$controller->pageview="display";
			$controller->updateEntry($_GET['id']);
			$controller->displayGird($controller->getEntries($_start,$_REQUEST));  
	    break;
		
	case 'reply':
        // edit a Contactus entry
		$controller->pageview="reply";
		$controller->returnpage=$_page;
    	$controller->displayForm($controller->editEntry($_GET['id']));
	    break;
		
	case 'del':
        // deleting a guestbook entry
		$controller->pageview="del";
		$controller->deleteEntry($_GET['id']);
	    if($_page=="open")
		{
			$controller->pageview="display";
			$controller->displayGird($controller->getEntries($_start,$_REQUEST));
		}
		else
		{
		 	$controller->pageview="viewclose";
			$controller->displayGird($controller->getClosedEntries($_action,$_start,$_POST)); 
		}
        break;				
    case 'submit':
		$_mode = $_REQUEST['mode'] ;
		if($_mode=="reply")
		{
			// submitting a Contactus entry
			$controller->pageview="add";
			//Validate Require Fields
			if($controller->isValidForm($_POST)) 
			{
				$controller->sendReplyEmail($_POST, $_page);
				///check page request
				if($_page=="open")
				{
					$controller->pageview="display";
					$controller->displayGird($controller->getEntries($_start,$_REQUEST));
				}
				else
				{
				 	$controller->pageview="viewclose";
					$controller->displayGird($controller->getClosedEntries($_action,$_start,$_POST)); 
				}
			} 
			else 
			{
				$controller->pageview="reply";
				$controller->displayForm($controller->editEntry($_POST['id']), $_POST);
			}
		}
	    break;
	
	case 'viewclose':
        // viewing the Contactus
        $controller->pageview="viewclose";
		$controller->displayGird($controller->getClosedEntries($_action,$_start,$_POST));        
	    break; 	
    case 'view':
    default:
        // viewing the Contactus
        $controller->pageview="display";
		$controller->displayGird($controller->getEntries($_start,$_REQUEST));        
	    break;   
		
}

?>
