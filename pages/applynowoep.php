<?php
	session_start();
	//session_register("userrecord"); 

	//error_reporting(0);

// DEFINES CONSTANTS FOR DB CONNECTION
	define('HOST', 'netraserver');
	define('USERNAME', 'root');
	define('PASSWORD', 'admin');
	define('DATABASE', 'redc_db');

// INCLUDE FILES
	include_once('../classlibrary/db.php');
	include_once('../libs/applyonline.lib.php');

// OBJECT OF CLASS APPLYONLINE
	$applyonline = new ApplyOnline;

// POPULATE EXISTING RECORD IN FORM FIELDS IF USER ALREADY REGISTERED

// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";

if ($action == "create")
{
	//echo "user has been created<br />";
	
	$divnum = isset($_POST["divnum"]) ? $_POST["divnum"] : "";
	if($divnum)
	{
		
		if(!isset($_SESSION['userid']))
		{
			if($applyonline->addEntry($_POST)){
				echo "Congrates! your application has been submitted successfully.";
			}
			else
				echo "Error occured";
		}
		else
		{
			if($applyonline->updateEntry($_POST , $_SESSION['userid'])){
				echo "Congrates! your record has been updated successfully.";
			}
			else
				echo "Error occured";
			
		}
		session_destroy();		
/*		echo "<pre>";
			print_r($_POST);
		echo "</pre>";
*/	}
	
	//echo "<button type='button' class='contact-create contact-button' tabindex='1026' onclick='toggleFunc(\"2\")'>Next</button><br />";
}
else if ($action == "check")
{
	//print_r($_POST);
	if(isset($_POST['username']) && smcf_validate_email($_POST['username']))
	{
		//$query = "SELECT username from redc_user where username = '".$_POST['username']."'";
		
		if($applyonline->alreadyExists($_POST['username']))
		{
			echo "0";
		}
		else
		{
			echo "1";
		}
	}
}

else if ($action == "checklogin")
{
	if(isset($_POST['loginusername']) && smcf_validate_email($_POST['loginusername']))
	{
		if($uid = $applyonline->validUser($_POST['loginusername'] , $_POST['loginpassword']))
		{
			// get record of already registered user
			$userRecord = $applyonline->editEntry($uid);
			
			if(empty($_SESSION['userrecord']))
				$_SESSION['userrecord']   = $userRecord;
				
				$_SESSION['successlogin'] = 1;
				$_SESSION['userid'] = $uid;
			//print_r($userRecord);
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
}

// Validate email address format in case client-side validation "fails"
function smcf_validate_email($email) {
	$at = strrpos($email, "@");

	// Make sure the at (@) sybmol exists and  
	// it is not the first or last character
	if ($at && ($at < 1 || ($at + 1) == strlen($email)))
		return false;

	// Make sure there aren't multiple periods together
	if (preg_match("/(\.{2,})/", $email))
		return false;

	// Break up the local and domain portions
	$local = substr($email, 0, $at);
	$domain = substr($email, $at + 1);


	// Check lengths
	$locLen = strlen($local);
	$domLen = strlen($domain);
	if ($locLen < 1 || $locLen > 64 || $domLen < 4 || $domLen > 255)
		return false;

	// Make sure local and domain don't start with or end with a period
	if (preg_match("/(^\.|\.$)/", $local) || preg_match("/(^\.|\.$)/", $domain))
		return false;

	// Check for quoted-string addresses
	// Since almost anything is allowed in a quoted-string address,
	// we're just going to let them go through
	if (!preg_match('/^"(.+)"$/', $local)) {
		// It's a dot-string address...check for valid characters
		if (!preg_match('/^[-a-zA-Z0-9!#$%*\/?|^{}`~&\'+=_\.]*$/', $local))
			return false;
	}

	// Make sure domain contains only valid characters and at least one period
	if (!preg_match("/^[-a-zA-Z0-9\.]*$/", $domain) || !strpos($domain, "."))
		return false;	

	return true;
}

exit;

?>