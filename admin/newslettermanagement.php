<?php
require_once('../classlibrary/configsmarty.php');
require_once('../fckeditor/fckeditor.php');
require_once($GENERAL['PHYSICAL_PATH_CLASSLIB'].'/sendmail.class.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/newslettermanagement.lib.php');

// create Gallery Management object
$controller =& new NewsLetterManagement;

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
switch($_action) {
    case 'savedraft':
			if($controller->isValidForm($_POST) )
			{
				if($controller->updateEntry($_POST)){
					$controller->displayForm($_POST);
				}
			} 
			else 
			{
				$controller->displayForm($_POST);
			}
		
        break;
	case 'submit':
			if($controller->isValidForm($_POST) )
			{
				if($controller->sendEmail($_POST))
					{
						
						$controller->displayForm();
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
		
        break;
	case 'delete':

	       $controller->unsubscribe($_POST);
		   $controller->displayForm($_POST);
	    break;	
	case 'view':
    default:
        // viewing the Form
       	$controller->displayForm($_POST);        
	    break; 
}

?>
