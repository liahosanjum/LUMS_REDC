<?php
require_once('classlibrary/publicconfigsmarty.php');
require_once($GENERAL['FRONT_DIR_LIB'].'/alumni_directory.lib.php');
// create alumni Management object
$controller =& new AlumniDirectory;

if(!isset($_SESSION['alumniuser']))
{
   $controller->redirectAlumni();
}
// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';
 // echo($_POST['content']);
switch($_action) 
{
    case 'view':
    default:
        // viewing the Page
       $controller->displayPage($controller->getAlumni($_start));        
	   break;   
}

?>
