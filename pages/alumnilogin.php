<?php
	include_once('../classlibrary/configuration.php');
	//error_reporting(0);

// INCLUDE FILES
	
	include_once('../classlibrary/db.php');
	include_once('../libs/alumni_login1.lib.php');

// OBJECT OF CLASS ALUMNILOGIN
	$alumnilogin = new AlumniLogin1;

// POPULATE EXISTING RECORD IN FORM FIELDS IF USER ALREADY REGISTERED


// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";

if (empty($action)) {
	// Send back the apply form HTML
	$output = "<div style='display:none;' class='wraper_login' id='alumni-container'>
	<div align='right' style='padding:10px 10px 0 0;'><a href='#' title='Close' class='modalCloseX simplemodal-close'><img src='images/applyonline/crossicon.jpg' border='0' /></a></div>
	<div class='forms-apply alumni-content'>
	<form action='#' style='display:block;' >
	<div class='forminputs-apply'>

	<div class='alumni-content' id='login'>
	<h2 class='contact-title'>Login</h2>
	<div class='alumni-loading' style='display:none;'></div>
	<div class='alumni-message' style='display:none;'></div>
	
	<div style='height:10px;'></div>
			<ul>
            	<li class='txt'>Email (user name):<span class='required'>*</span></li>
                <li>
					<input type='text' id='alumni-loginusername' name='loginusername' tabindex='1001' maxlength='50' class='bluebar' />
				</li>
            </ul>
			<ul>
				<li class='txt'>Password:<span class='required'>*</span></li>
				<li>
					<input type='password' id='alumni-loginpassword' class='bluebar' name='loginpassword' maxlength='30' tabindex='1002' />
				</li>	
			</ul>

			<ul>
				<li class='txt1'>&nbsp;</li>
				<li>
					<button type='submit' class='next-apply alumni-checklogin alumni-button' tabindex='1003'>Login &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
				</li>	
			
			</ul>
	</div>
	

	</div>
	</form>
	</div>
	<div class='apply-bottom'></div>
</div>";

//http://www.ericmmartin.com/projects/simplemodal/
	echo $output;
}

else if ($action == "checklogin")
{
	if(isset($_POST['loginusername']) && smcf_validate_email($_POST['loginusername']))
	{
		
		if($uid = $alumnilogin->ifAlumni(array("username" => $_POST['loginusername'] , "password" => $_POST['loginpassword'])))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	else
		echo 2;
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