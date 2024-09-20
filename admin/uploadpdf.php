<?php
require_once('../classlibrary/configsmarty.php');
require_once($GENERAL['BASE_DIR_ROOT'].'/fckeditor/fckeditor.php');
require_once($GENERAL['ADMIN_DIR_LIB'].'/uploadpdf.lib.php');

$controller =& new fileManagement;
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
if($_action == "add")
{
	if($controller->isValidForm($_POST,$_FILES)) 
	{
		$controller->displayForm(); 
	}	 
	else 
	{
		$controller->displayForm();
	}
	
}
else
{
	$controller->displayForm();
} 

?>
