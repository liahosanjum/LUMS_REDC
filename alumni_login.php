<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/alumni_login.lib.php');
// create alumni Management object
$controller =& new AlumniLogin;

if(isset($_REQUEST['abc']) && $_REQUEST['abc'] == 'logout')
{
	$_SESSION['alumniuser'] = "";
	unset($_SESSION['alumniuser']);
	header("Location:alumni.php?section_id=0&pcid=518");
	exit;
}

if(isset($_SESSION['alumniuser']) && $_SESSION['alumniuser'] != "")
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
