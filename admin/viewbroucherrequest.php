<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/viewbroucherrequest.lib.php');
// create Gallery Management object
$controller =& new brouchermanagement;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
$_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 'open';
// set the current page value 
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {
    case 'add':
        // adding an  entry
		$controller->pageview="add";		
	    $controller->displayForm();
	    break;
		case 'detail':
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
			$controller->displayGird($controller->getEntries($_start,$_POST));
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
					$controller->displayGird($controller->getEntries($_start,$_POST));
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
		
	
		
	
    case 'view':
    default:
         // viewing the Gallery
        $controller->pageview="display";
		$controller->displayGird($controller->getEntries($_start,$_POST));        
	    break;		
}

?>
