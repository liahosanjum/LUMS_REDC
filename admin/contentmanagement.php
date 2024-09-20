<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['BASE_DIR_ROOT'].'/fckeditor/fckeditor.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/contentmanagement.lib.php');

$controller =& new ContentManagement;

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {

    case 'sortpages':
	    $controller->pageview="sortpages";
        if(isset($_REQUEST['submit_x']))
		{
			if($controller->saveOrders($_REQUEST))
		   {
    		   $controller->displayGird($controller->getEntries($_start,$_REQUEST));
			   $controller->writeHTML();        		   
		   }
		}
		else
		{
		   $controller->displayGird($controller->getEntries($_start,$_REQUEST));        
		}  
	    break;
		
	case 'del':
		$controller->deleteEntry($_REQUEST['id']);
        $controller->pageview="display";
		$controller->writeHTML();
		$controller->displayGird($controller->getEntries($_start,$_REQUEST)); 
		
       
	    break;

	case 'add':
		$controller->pageview="add";
		$controller->displayForm('');
		break;
	
    case 'edit':
		$controller->pageview="edit";
    	$controller->displayForm($controller->editEntry($_REQUEST['id']));
		$controller->writeHTML();
		break;
		
    case 'submit':
		$_mode = $_REQUEST['mode'] ;
			$controller->pageview=$_mode;
			if($controller->isValidForm($_REQUEST))
			 {
				if($_mode == 'edit')
				{
					$controller->updateEntry($_REQUEST);
				}
				else
				{
					$controller->addEntry($_REQUEST);
				}
				$controller->pageview="display";
				$controller->writeHTML();
				$controller->displayGird($controller->getEntries($_start,$_REQUEST));
				
			} 
			else 
			{
				$controller->displayForm($_REQUEST);
				//$controller->writeXML();
			}
        break;
		
    case 'view':
    default:
    $controller->pageview="display";
	$controller->displayGird($controller->getEntries($_start,$_REQUEST));
	 break;   
}
?>
