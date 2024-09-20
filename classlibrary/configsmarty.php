<?php
require_once("configuration.php");

require_once($GENERAL['PHYSICAL_PATH_CLASSLIB']."/db.php");
require_once($GENERAL['PHYSICAL_PATH_CLASSLIB']."/paging.php");
require(PHYSICAL_SMARTY_DIR . 'Smarty.class.php');

	function CheckAdminAuthorization($loginURL)
	{
		
		if(!isset($_SESSION['adminusername']) )
		{
			
			if(!stristr($_SERVER["PHP_SELF"], 'index.php'))
			{
				$url = $_SERVER['PHP_SELF']  ;
				$url = urlencode($url);
				
				if(isset($_SERVER["QUERY_STRING"]))
				{
					$querystring = $_SERVER["QUERY_STRING"];
					$querystring = urlencode($querystring);
					$returnValue = "returnURL=" . $url . "?". $querystring;						
				}
				else
				{
					$returnValue = "returnURL=" . $url ;						
				}
				
				header("Location:index.php?".$returnValue);
			}
		}
	}			
	if(!strpos($_SERVER['REQUEST_URI'],"forgotpassword.php") && !strpos($_SERVER['SCRIPT_NAME'],"forgotpassword.php"))

	{
	   CheckAdminAuthorization("index.php");
	}
	
	if(preg_match('^/lums_redc/admin/^' , $_SERVER['REQUEST_URI']))
	{
		require_once("../admin/secure.php");
	}	
 	   $GENERAL['USER_TYPE'] = $_SESSION['usertype'];

?>