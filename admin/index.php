<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/index.lib.php');

// create Login object
$controller =& new LoginManagement;
if(isset($_SESSION['adminusername']))
{
   $controller->redirectAdmin();
}
// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
 // echo($_POST['content']);
switch($_action) 
{
    case 'submit':
		if($controller->isValidForm($_POST))
		  {
		    	if(!$controller->validateUser($_POST))
				 {
				 	$controller->displayPage($_POST);
			 	 }
		  }
		 else
		  {
			  $controller->displayPage($_POST);
		  } 		
        break; ////// case: submit end
    case 'view':
    default:
        // viewing the Page
       $controller->displayPage($_POST);        
	   break;   
}

?>
