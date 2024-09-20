<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/alumni_profile.lib.php');
// create alumni Management object
$controller =& new AlumniProfile;

if(!isset($_SESSION['alumniuser']))
{
   $controller->redirectAlumni();
}
// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
 // echo($_POST['content']);
switch($_action) 
{
    case 'submit':
		if($controller->isValidForm($_POST))
		  {
		    	$controller->updateRecord($_POST , $_SESSION['alumniuser']);
				$controller->displayPage($_POST);
			 	
		  }
		 else
		  {
			  $controller->displayPage($_POST);
		  } 		
        break; ////// case: submit end
    case 'view':
    default:
        // viewing the Page
       $controller->displayPage($controller->getEntry($_SESSION['alumniuser']));        
	   break;   
}

?>
