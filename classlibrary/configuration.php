<?php
session_start();
error_reporting(0);

///define application URL
define('SITE_URL', 'http://www.netrasoftclients.com/clients/lums_redc');
//define('SITE_URL', "http://".$_SERVER['SERVER_NAME']."/redc");
 
// define our application directory
$fullpath2 = strtolower(__FILE__);
$fullpath2 = str_replace("\\", "/", $fullpath2);						
$rootpath = substr($fullpath2, 0, strpos($fullpath2, "/classlibrary", 1));
$rootpath= str_replace("\\", "/", $rootpath);						


define('EDITOR_PATH',$rootpath.'/uploads/');

define('PHYSICAL_PATH', $rootpath);
define('PHYSICAL_SITE_DIR', $rootpath.'/smarty/');

// define smarty lib directory
define('PHYSICAL_SMARTY_DIR', $rootpath.'/smarty/libs/');

define('PAGINGCSS', 'th');
define('PAGESIZE', '20');
define('PAGESIZEFRONT','10');
define('PUBLICPAGESIZE', '5');


// acl
define('ACCESS_MESSAGE' , 'SORRY, YOU HAVE LIMITED ACCESS.');
if(isset($_SESSION['ACL']) && !empty($_SESSION['ACL']))
{
	$_ACL = $_SESSION['ACL'];
	$filename = explode("/admin/" , $_SERVER['SCRIPT_NAME']);
	$_SCRIPT_NAME = $filename[1];	
}
else
{
	$_ACL   = array();
	$_SCRIPT_NAME = "";
}
 
 define('HOST', 'localhost');
define('USERNAME', 'netrasof_aatif');
define('PASSWORD', 'netra_123');
define('DATABASE', 'netrasof_redc'); 
 

/*  define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'redc');  */

// email variables
define('CONTACTREPLYFROMNAME', 'lums_redc');
define('CONTACTREPLYFROMEMAIL', 'lums_redc@hotmail.com');

define('MAILSERVER', 'mail.lums_redc.com');
define('MAILPORT', '26');
define('MAILEMAIL', 'info@packageforwarding.com');
define('MAILPASSWORD', 'info');

global $GENERAL;
$GENERAL = array();

///////// front end paths///////////////
$GENERAL['BASE_DIR_ROOT'] = $rootpath;
$GENERAL['BASE_URL_ROOT'] = SITE_URL;

$GENERAL['FRONT_BASE_DIR_TPL'] = $GENERAL['BASE_DIR_ROOT'].'/templates';
$GENERAL['FRONT_IMG_DIR'] = $GENERAL['BASE_DIR_ROOT'].'/images';
$GENERAL['FRONT_IMG_URL'] = $GENERAL['BASE_URL_ROOT'].'/images';
$GENERAL['FRONT_UPLOAD_URL'] = $GENERAL['BASE_URL_ROOT'].'/uploads';
$GENERAL['FRONT_DIR_LIB'] = $GENERAL['BASE_DIR_ROOT'].'/libs';
 

/////////////// admin side paths //////////////
$GENERAL['BASE_DIR_ADMIN'] = $rootpath.'/admin';
$GENERAL['BASE_URL_ADMIN'] = SITE_URL.'/admin';

$GENERAL['BASE_DIR_ADMIN_TPL'] = $GENERAL['BASE_DIR_ADMIN'].'/templates';
$GENERAL['ADMIN_IMG_DIR'] = $GENERAL['BASE_DIR_ADMIN'].'/images';
$GENERAL['ADMIN_IMG_URL'] = $GENERAL['BASE_URL_ADMIN'].'/images';
$GENERAL['ADMIN_DIR_LIB'] = $GENERAL['BASE_DIR_ADMIN'].'/libs';


///////////////end admin side paths //////////////

$GENERAL['PHYSICAL_PATH_CLASSLIB'] = $GENERAL['BASE_DIR_ROOT'].'/classlibrary';

if(get_magic_quotes_gpc()){
	quoteOff($_POST);
	quoteOff($_REQUEST);
	quoteOff($_GET);
}

function quoteOff(&$arr){
	foreach($arr as $key=>$value){
		if(is_array($value)){
			$temArry = '';
			foreach($value as $subkey=>$subval){
				$temArry[$subkey] = stripslashes($subval);
			}
			$arr[$key] =  $temArry;
		}else{
			$arr[$key] =  stripslashes($value);
		}
	}
}
include_once("encrydecry.php");
?>