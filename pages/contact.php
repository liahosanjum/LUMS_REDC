<?php
include("../classlibrary/configuration.php");		
include("../classlibrary/db.php");
include("../classlibrary/sendemail.php");
$tblcontactus = "redc_contactus";
$tbladmin     = "redc_admin";
	$tblemails="redc_emailcontent";
// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the contact form HTML
	$output = "<div style='display:none' class='wraper-contact'	>
		<a href='#' title='Close' class='modalCloseX simplemodal-close' style='padding-top:10px;' ><img src='images/crossicon.jpg' alt='Close'  border='0'/></a>
	<div class='contact-top'></div>
	<div class='contact-content contact-forms'>
		<h2 class='contact-title'>Contact Us</h2>
		<div class='contact-info'>
		Our advisors are available to assist you in your query.<br />
		Fields marked with a * are mandatory.
		</div>
		<div class='contact-loading' style='display:none'></div>
		<div class='contact-message' style='display:none'></div>
		<div class='contact-content2' id='contact-content2'>
		
		<div class='contact-forminputs'>
		<form action='#' style='display:none'>
			<ul>
				<li class='txt'>Title:</li>
				<li>
				<select id='contact-title' class='bluebar' name='title' >
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
			<input type='text' id='contact-firstname' class='bluebar' name='firstname'  maxlength='30' />
			</li>
			</ul>
			<ul>
			<li class='txt'>
			Last Name:<span class='required'>*</span></li>
			<li>
			<input type='text' id='contact-lastname' class='bluebar' name='lastname'  maxlength='30' />
			</li>
			</ul>
			<ul>
			<li class='txt'>Email:<span class='required'>*</span></li>
			<li>
			<input type='text' id='contact-email' class='bluebar' name='email'  maxlength='50' />
			</li>
			</ul>
			<ul>
			<li class='txt'>Company:<span class='required'>*</span></li>
			<li>
			<input type='text' id='contact-company' class='bluebar' name='company'  maxlength='50' /></li>
			</ul>
			<ul>
			<li class='txt'>Mailing Address:<span class='required'>*</span></li>
			<li>
			<input type='text' id='contact-mailingaddress' class='bluebar' name='mailingaddress'  maxlength='150' />		
			</li>
			</ul>
			<ul>
			<li class='txt'>
			Telephone:<span class='required'>*</span></li>
			<li>
			<input type='text' id='contact-telephone' class='bluebar' name='telephone'  maxlength='20' />			
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
			<textarea id='contact-additionalinfo' class='bluebar' name='additionalinfo' maxlength='300' onkeyup='return ismaxlength(this)' ></textarea></li>
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
	
	<div class='contact-info' style='margin-left:43px'>
		<strong>Privacy statement</strong><br />
		At Rausing Executive Development Centre, LUMS we care about your privacy. We do not sell, rent, or otherwise make available to third parties any personal information for marketing purposes.
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
		
		$contactdate = date("d-m-y H:i:s");
		
/*		$message = "<table cellspacing= 15 >";
			$message .= "<tr><td>First Name</td><td>".$title. $firstname."</td></tr>";
			$message .= "<tr><td>Last Name</td><td>".$lastname."</td></tr>";
			$message .= "<tr><td>Email</td><td>".$email."</td></tr>";
			$message .= "<tr><td>Company</td><td>".$company."</td></tr>";
			$message .= "<tr><td>Mailing Address</td><td>".$mailingaddress."</td></tr>";
			$message .= "<tr><td>Telephone</td><td>".$telephone."</td></tr>";
			$message .= "<tr><td>Request Information</td><td>".$about."</td></tr>";
			$message .= "<tr><td>Additional Information</td><td>".$additionalinfo."</td></tr>";
			$message .= "<tr><td>Request Date</td><td>".$contactdate."</td></tr>";
		$message .= "</table>";*/

		
		if($db->insert($tblcontactus,$record) > 0) 
		{
			// send email to admins
			$query= "Select * from ".$tblemails." where emailname = ".$db->mySQLSafe('Contact Request Email to Admin');
			$result= $db->execute($query);
			$fetch=mysql_fetch_array($result);
			
			$email_body = $fetch['content'];
			
			$email_body = str_replace('__FIRSTNAME__', $firstname, $email_body);		
			$email_body = str_replace('__LASTNAME__', $lastname, $email_body);
			$email_body = str_replace('__EMAIL__', $email, $email_body);
			$email_body = str_replace('__COMPANY__', $company, $email_body);
			$email_body = str_replace('__MAILINGADDRESS__', $mailingaddress, $email_body);
			$email_body = str_replace('__TELEPHONE__', $telephone, $email_body);
			$email_body = str_replace('__REQUESTINFORMATION__', $about, $email_body);
			$email_body = str_replace('__ADDITIONALINFORMATION__', $additionalinfo, $email_body);
			$email_body = str_replace('__REQUESTDATE__', $contactdate, $email_body);
			
			$query = "select email from redc_admin where usertype = 'A'";
			$to = $db->select($query);
			$mail = new SendEmail();
		
			$i = 0;		
			for($i = 0 ; $i<count($to); $i++)
			{	
				if(SENDEMAIL)
				{
					$send = $mail->Send_Email($fetch['fromname'], $fetch['fromemail'],$to[$i]['email'],$to[$i]['email'],$fetch['subject'],$email_body,MAILSERVER);
				}
			}
			
			// send email to user
			$query= "Select * from ".$tblemails." where emailname = ".$db->mySQLSafe('Contact Request Email to User');
			$result= $db->execute($query);
			$fetch=mysql_fetch_array($result);
			
			$email_body = $fetch['content'];
			
			$email_body = str_replace('__FIRSTNAME__', $firstname, $email_body);
			
			$email_body = str_replace('__LASTNAME__', $lastname, $email_body);
			
			if(SENDEMAIL)
			{

				$mail->Send_Email($fetch['fromname'],$fetch['fromemail'],$firstname." ".$lastname,$email,$fetch['subject'],$email_body,MAILSERVER);
			}

			echo "<div class=\"contact-complete\">
					<!--<img src=\"images/image001.gif\" alt=\"THANK YOU\" width=\"102\" border=\"0\" height=\"14\" /><br /><br />-->
			        <img src=\"images/image002.gif\" alt=\"Form successfully sent\" width=\"166\" border=\"0\" height=\"15\" /><br /><br />
					Thank you for your interest in Rausing Executive Development Centre, LUMS.<br /><br />
					We will process your request as soon as possible.<br /><br />
					Should you have any questions, please do not hesitate to contact Rausing Executive Development Centre, LUMS at +92- 42- 35608333.<br /><br /><br />
					Best regards,<br />
					The REDC Team 
			</div>";
			
			
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