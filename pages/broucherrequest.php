<?php
include("../classlibrary/configuration.php");		
include("../classlibrary/db.php");
include("../classlibrary/sendemail.php");
include_once('../libs/applyonline.lib.php');
$tblname = "redc_broucher_request";
$tbladmin     = "redc_admin";

// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the broucherrequest form HTML
	$output = "<div style='display:none' class='broucherrequest-wraper'>
	<a href='#' title='Close' class='modalCloseX simplemodal-close' style='padding-top:10px;'><img src='images/crossicon.jpg' alt='Close'  border='0'/></a>
	<div class='broucherrequest-content broucherrequest-forms'>
		<h2 class='broucherrequest-title'>OFP Brochure Request:</h2>
		<div class='broucherrequest-loading' style='display:none'></div>
		<div class='broucherrequest-message' style='display:none'></div>
		<div class='broucherrequest-content2' id='broucherrequest-content2'>
		<div class='broucherrequest-forminputs'>
		<form action='#' style='display:none'>
		<ul>
			<li class='txt'>Name:<span class='required'>*</span></li>
			<li><input type='text' id='broucherrequest-name' class='bluebar' name='name' tabindex='1001' maxlength='30' />
			</li>
		</ul>
		<ul>
			<li class='txt'>Email:<span class='required'>*</span></li>
			<li><input type='text' id='broucherrequest-email' class='bluebar' name='email' tabindex='1002' maxlength='50' />
			</li>
		</ul>
		<ul>
			<li class='txt'>Requested Programme:</li>
			<li><input type='text' id='broucherrequest-programmerequested' class='bluebar' name='programmerequested' tabindex='1003' maxlength='50' />
			</li>
		</ul></div>";
	$output .= "
		</form>
		</div>
		<div id='button'>
		<ul><li style='width:265px'>&nbsp;</li>
			<li>
			<button type='submit' class='next broucherrequest-send broucherrequest-button' tabindex='1004'>Submit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
			<button type='submit' class='next broucherrequest-cancel broucherrequest-button simplemodal-close' tabindex='1005'>Cancel &nbsp;&nbsp;</button>
	</li>
			</ul>
			</div>
	</div>
	<!--<div class='broucherrequest-bottom'><a href='http://www.ericmmartin.com/projects/simplemodal/'>Powered by SimpleModal</a></div>-->
</div>";

	echo $output;
}
else if ($action == "send") {
	// Send the email
	
	$name = isset($_POST["name"]) ? $_POST["name"] : "";
	$email = isset($_POST["email"]) ? $_POST["email"] : "";	
	$programmerequested = isset($_POST["programmerequested"]) ? $_POST["programmerequested"] : "";	
	$dated = date("y-m-d H:i:s");
	$isactive = 'y';
	

	if($name != "" && $email != "")
	{
		$db = new db();
		$record['name']=$db->mySQLSafe( $name);
		$record['email']=$db->mySQLSafe( $email);
		$record['dated']=$db->mySQLSafe( $dated);
		$record['programme_requested']=$db->mySQLSafe( $programmerequested);
		$record['isactive']=$db->mySQLSafe( $isactive);	
		/*echo "<pre>";
		print_r($record);
		echo "</pre>";
		exit;*/
		$message = "<table cellspacing= 15 >";
			$message .= "<tr><td>Name</td><td>".$name."</td></tr>";
			$message .= "<tr><td>Email</td><td>".$email."</td></tr>";
			$message .= "<tr><td>Requested Date</td><td>".$dated."</td></tr>";
			$message .= "<tr><td>Requested Programme</td><td>".$programmerequested."</td></tr>";
		$message .= "</table>";
		$query = "select email from redc_admin where usertype = 'A' or usertype = 'M'";
		$to = $db->select($query);
		$mail = new SendEmail();
		if($db->insert($tblname,$record) > 0) 
		{
			$i = 0;		
			for($i = 0 ; $i<count($to); $i++)
			{	
				$send = $mail->Send_Email($email,$email,$to[$i]['email'],$to[$i]['email'],"OFP Brochure Request",$message,MAILSERVER);
			}
			echo "<div class=\"broucherrequest-complete\">Your request for brochure has been recieved. We will get back to you soon.</div>";
			
		}
		else
		{
			echo "<div class=\"broucherrequest-complete\">Unfortunately, your message could not be verified.</div>";
		}	
	}
	else
	{
		echo "<div class=\"broucherrequest-complete\">All the required fields were not submitted.</div>";
	}
	
}


exit;

?>