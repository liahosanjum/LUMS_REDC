<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/alumni_history.lib.php');
// create alumni Management object
$controller =& new AlumniHistory;

if(!isset($_SESSION['alumniuser']))
{
   $controller->redirectAlumni();
}
// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
 // echo($_POST['content']);
switch($_action) 
{
    case 'view':
    default:
        // viewing the Page
       $controller->displayPage($controller->getUserProgrammes($_SESSION['alumniuser']));        
	   break;   
}

?>
