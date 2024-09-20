<?php
include("../classlibrary/configuration.php");		
include("../classlibrary/db.php");
$tblalumni = "redc_alumni";
/*
 * SimpleModal Contact Form
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2009 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: contact-dist.php 204 2009-06-09 22:43:28Z emartin24 $
 *
 */

// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the contact form HTML
	$output = "<div style='display:none' class='wraper_login' id='apply-container'>
	<div align='right'><a href='#' title='Close' class='modalCloseX simplemodal-close'><img src='images/applyonline/crossicon.jpg' border='0' /></a></div>
	<div class='forms-apply apply-content'>
	<form action='#' style='display:block;' >
	<div class='forminputs-apply'>
	
	<h2 class='apply-title'>Alumni Login:</h2>
	<div class='apply-loading' style='display:none;'></div>
	<div class='apply-message' style='display:none;'><div class='apply-error'></div></div>
	<div style='height:30px;'></div>
		<ul>
            	<li class='txt'>Email (user name):<span class='required'>*</span></li>
                <li>
					<input type='text' id='apply-username' name='username' tabindex='1001' maxlength='30' class='bluebar' />
				</li>
            </ul>
			<ul>
				<li class='txt'>Password:<span class='required'>*</span></li>
				<li>
					<input type='password' id='apply-password' class='bluebar' name='password' maxlength='30' tabindex='1002' />
				</li>	
			</ul>
			<ul>
				<li class='txt1'>&nbsp;</li>
				<li>
					<button type='button' class='next-apply  apply-check apply-button' tabindex='1004'>Login &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
				</li>	
			</ul>
	
	</div>	
	";

	echo $output;
}
else if ($action == "send") {
	// Send the email
	$username = isset($_POST["username"]) ? $_POST["username"] : "";
	$password = isset($_POST["password"]) ? $_POST["password"] : "";

	if($username != "" && $password != "")
	{
		$db = new db();
		$rs = $db->execute('select * from '.$tblalumni.' where username = '.$db->mySQLSafe($username).' and password='.$db->mySQLSafe($password).' and isactive = '.$db->mySQLSafe('Yes'));
		
		if($rs != null && mysql_num_rows($rs) > 0)
		{
			//echo "Login successful";
			echo 1;
		}
		else
		{
			//echo "Invalid username or password";
			echo 0;
		}
	}
	else
	{
		//echo "All the required fields were not submitted";
		echo 2;
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