<?php
require_once('../classlibrary/configuration.php');
require_once($GENERAL['PHYSICAL_PATH_CLASSLIB'].'/db.php');

$db = new Db();
if(isset($_REQUEST['username']) && $_REQUEST['username']!='')
{
	if(!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",trim($_REQUEST['username'])))
	{
        $returnstring = '<span class=\"required\">Please provide valid email</span>';
    }
	else
	{
		$query = "Select * from travelhub_users where email_address = '".$_REQUEST["username"]."'";
		if($db->numrows($query ) > 0)
		{
			$returnstring = "<span class=\"required\">Email address not available</span>";
		}
		else
		{
		   $returnstring = "<span style=\"color:#009966; font-weight:normal;\">Email address available</span>";
		}
	}	
}
else
{
   $returnstring = "<span class=\"required\">Please provide email address</span>";
}
print($returnstring);

?>
