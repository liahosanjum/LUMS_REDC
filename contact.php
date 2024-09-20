<?php
include("../classlibrary/configuration.php");		
include("../classlibrary/db.php");
include("../classlibrary/sendemail.php");
$tblcontactus = "redc_contactus";
$tbladmin     = "redc_admin";
// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the contact form HTML
	$output = "<div style='display:none' class='wraper-contact'	>
		<a href='#' title='Close' class='modalCloseX simplemodal-close' style='padding-top:10px;' ><img src='images/crossicon.jpg' alt='Close'  border='0'/></a>
	<div class='contact-top'></div>
	<div class='contact-content contact-forms'>
		<h2 class='contact-title'>Contact us</h2>
		<div class='contact-loading' style='display:none'></div>
		<div class='contact-message' style='display:none'></div>
		<div class='contact-content2' id='contact-content2'>
		<div class='contact-forminputs'>
		<form action='#' style='display:none'>
			<ul>
				<li class='txt'>Title:</li>
				<li>
				<select id='contact-title' class='bluebar' name='title' tabindex='1001'>
					<option value='Mr.'>Mr.</option>
					<option value='Mrs.'>Mrs.</option>
					<option value='Miss'>Miss</option>
					<option value='Ms.'>Ms.</option>
					<option value='Dr.'>Dr.</option>
				</select>
				</li>
			</ul>
			<ul>
			<li class='txt'>First Name:<span class='required'>*</span></li>
			<li>
			<input type='text' id='contact-firstname' class='bluebar' name='firstname' tabindex='1001' maxlength='30' />
			</li>
			</ul>
			<ul>
			<li class='txt'>
			Last Name:<span class='required'>*</span></li>
			<li>
			<input type='text' id='contact-lastname' class='bluebar' name='lastname' tabindex='1001' maxlength='30' />
			</li>
			</ul>
			<ul>
			<li class='txt'>Email:<span class='required'>*</span></li>
			<li>
			<input type='text' id='contact-email' class='bluebar' name='email' tabindex='1002' maxlength='50' />
			</li>
			</ul>
			<ul>
			<li class='txt'>Company:<span class='required'>*</span></li>
			<li>
			<input type='text' id='contact-company' class='bluebar' name='company' tabindex='1002' maxlength='50' /></li>
			</ul>
			<ul>
			<li class='txt'>Mailing Address:<span class='required'>*</span></li>
			<li>
			<input type='text' id='contact-mailingaddress' class='bluebar' name='mailingaddress' tabindex='1002' maxlength='150' />		
			</li>
			</ul>
			<ul>
			<li class='txt'>
			Telephone:<span class='required'>*</span></li>
			<li>
			<input type='text' id='contact-telephone' class='bluebar' name='telephone' tabindex='1002' maxlength='20' />			
			</li>
			</ul>
			<ul>
			<li class='txt'>Request Information:<span class='required'>*</span></li>
			<li style='padding-top:3px;'>
			<input type='checkbox' name='about[]' value='About REDC'>&nbsp;&nbsp;About REDC<br />
			<input type='checkbox' name='about[]' value='Open Enrollment Programmes'>&nbsp;&nbsp;Open Enrollment Programmes<br />
			<input type='checkbox' name='about[]' value='Organization Focused Programmes'>&nbsp;&nbsp;Organization Focused Programmes<br />
			<input type='checkbox' name='about[]' value='Conferences and Services'>&nbsp;&nbsp;Conferences and Services<br />
			<input type='checkbox' name='about[]' value='REDC Facilities'>&nbsp;&nbsp;REDC Facilities<br />
			<input type='checkbox' name='about[]' value='Partner with us'>&nbsp;&nbsp;Partner with us
			</li>
			</ul>
			<ul>
			<li class='txt'>
			Additional Information:</li>
			<li style='padding-top:2px';>
			<textarea id='contact-additionalinfo' class='bluebar' name='additionalinfo' tabindex='1002'></textarea></li>
			</ul></div>
			";
	$output .= "
		</form>
		</div>
		<div id='button'>
		<ul><li style='width:265px'>&nbsp;</li>
			<li>
			<button type='submit' title='submit' class='next contact-send contact-button' tabindex='1006'>Submit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp</button>
			<button type='submit' title='cancel' class='next contact-cancel contact-button simplemodal-close' tabindex='1006'>Cancel &nbsp;&nbsp;</button>
		</li>
			</ul>
			</div>
	</div>
	<div class='contact-bottom'><!--<a href='http://www.ericmmartin.com/projects/simplemodal/'>Powered by SimpleModal</a>--></div>
</div>";

	echo $output;
}
else if ($action == "send") {
	// Send the email
	$title = isset($_POST["title"]) ? $_POST["title"] : "";
	$firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
	$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
	$email = isset($_POST["email"]) ? $_POST["email"] : "";	
	$company = isset($_POST["company"]) ? $_POST["company"] : "";
	$mailingaddress = isset($_POST["mailingaddress"]) ? $_POST["mailingaddress"] : "";	
	$telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";		

	//to get value from check boxes
	$arr = isset($_POST["about"]) ? $_POST["about"] : "";				
	$about= "";
	for($i=0;$i<count($arr);$i++)
	{
	
		$about = $about.$arr[$i].",";
	}
 	$about = substr($about,0,strlen($about)-1);
	/////////////////
	$additionalinfo = isset($_POST["additionalinfo"]) ? $_POST["additionalinfo"] : "";			
	$contactdate = date("y-m-d H:i:s");
	$status = 'O';

	if($firstname != "" && $lastname != "" && $email != "" && $company != "" && $mailingaddress != "" && $telephone != "" && count($arr) > 0)
	{
		$db = new db();
		$record['firstname']=$db->mySQLSafe( $firstname);
		$record['lastname']=$db->mySQLSafe( $lastname);
		$record['email']=$db->mySQLSafe( $email);
		$record['title']=$db->mySQLSafe( $title);
		$record['company']=$db->mySQLSafe( $company);
		$record['mailaddress']=$db->mySQLSafe( $mailingaddress);
		$record['phone']=$db->mySQLSafe( $telephone);
		$record['about']=$db->mySQLSafe($about);
		$record['additionalinfo']=$db->mySQLSafe( $additionalinfo);
		$record['contactdate'] = $db->mySQLSafe( $contactdate);
		$record['status'] = $db->mySQLSafe($status);		
		$message = "<table cellspacing= 15 >";
			$message .= "<tr><td>First Name</td><td>".$title. $firstname."</td></tr>";
			$message .= "<tr><td>Last Name</td><td>".$lastname."</td></tr>";
			$message .= "<tr><td>Email</td><td>".$email."</td></tr>";
			$message .= "<tr><td>Company</td><td>".$company."</td></tr>";
			$message .= "<tr><td>Mailing Address</td><td>".$mailingaddress."</td></tr>";
			$message .= "<tr><td>Telephone</td><td>".$telephone."</td></tr>";
			$message .= "<tr><td>About</td><td>".$about."</td></tr>";
			$message .= "<tr><td>Additional Information</td><td>".$additionalinfo."</td></tr>";
			$message .= "<tr><td>Request Date</td><td>".$contactdate."</td></tr>";
		$message .= "</table>";
		$query = "select email from redc_admin where usertype = 'A'";
		$to = $db->select($query);
		$mail = new SendEmail();
		if($db->insert($tblcontactus,$record) > 0) 
		{
			$i = 0;		
			for($i = 0 ; $i<count($to); $i++)
			{	
				$send = $mail->Send_Email($email,$email,$to[$i]['email'],$to[$i]['email'],"Contact us request",$message,MAILSERVER);
			}
			echo "<div class=\"contact-complete\">Thank you for contacting us. We will get back to you soon.</div>";
			
		}
		else
		{
			echo "<div class=\"contact-complete\">Unfortunately, your message could not be verified.</div>";
		}	
	}
	else
	{
		echo "<div class=\"contact-complete\">All the required fields were not submitted.</div>";
	}
	
}

exit;

?>