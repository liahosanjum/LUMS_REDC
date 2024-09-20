<?php
include("../classlibrary/configuration.php");		
include("../classlibrary/db.php");
include("../classlibrary/sendemail.php");
include_once('../libs/applyonline.lib.php');
$tblname="redc_ofp_requests";
$tblredcnewslettersubscribers = "redc_newsletter_subscribers";
$tbladmin     = "redc_admin";
$tblemails = "redc_emailcontent";
$applyonline = new ApplyOnline;
$countrylist = $applyonline->getCountries();

// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the ofp form HTML
	$output = "<div style='display:none' class='ofp-wraper'>
	<a href='#' title='Close' class='modalCloseX simplemodal-close' style='padding-top:10px;' ><img src='images/crossicon.jpg' alt='Close'  border='0'/></a>
	<div class='ofp-top'></div>
	<div class='ofp-content ofp-forms'>
		<h2 class='ofp-title' style='width:650px;'>Enquiry about Organization Focused Programmes</h2>
		<div class='ofp-info' >
		Our advisors are available to assist you in your query.<br />
		Fields marked with a * are mandatory.
		</div>
		<!--<span style='line-height:20px;' id='msg'>Please fill in the form below so that we can better understand your training initiative. Our Executive  Education <br /> Representative will contact you regarding your initiative within three business days of receiving your request.</span>-->
		<div class='ofp-loading' style='display:none'></div>
		<div class='ofp-message' style='display:none'></div>
			<div class='ofp-content2' id = 'ofp-content2'>
		<div class='ofp-forminputs' id='formdata'>
		
		<form action='#' style='display:none'>
		<ul>		
			<li class='txt' >Contact Prefix:</li>
			<li ><select id='ofp-prefix' class='bluebar' name='prefix' tabindex='1001'>
				<option value='Mr.'>Mr.</option>
				<option value='Mrs.'>Mrs.</option>
				<option value='Miss'>Miss</option>
				<option value='Ms.'>Ms.</option>
				<option value='Dr.'>Dr.</option>
			</select>
			</li>
		</ul>
		<ul>
			<li class='txt'>Contact First Name:<span class='required'>*</span></li>
			<li><input type='text' id='ofp-firstname' class='bluebar' name='firstname' tabindex='1002' maxlength='30' />
			</li>
		</ul>
		<ul>
			<li class='txt'>Contact Last Name:<span class='required'>*</span></li>
			<li><input type='text' id='ofp-lastname' class='bluebar' name='lastname' tabindex='1003' maxlength='30' />
			</li>
		</ul>
		<ul>
			<li class='txt'>Designation:</li>
			<li><input type='text' id ='ofp-designation' class='bluebar' name='designation' tabindex='1004' maxlength='50' />
			</li>
		</ul>
		<ul>
			<li class='txt'>Organization Name:<span class='required'>*</span></li>
			<li><input type='text' id ='ofp-organisation' class='bluebar' name='organisation' tabindex='1005' maxlength='50'/>
			</li>
		</ul>
		<ul>
			<li class='txt'>Organization Website:</li>
			<li><input type='text' id='ofp-Organisationwebsite' class='bluebar' name='Organisationwebsite' tabindex='1006' maxlength='50' />
			</li>
		</ul>
		<ul>
			<li class='txt'>Number of Employees in Organization:</li>
			<li><select id='ofp-numemployees' class='bluebar' name='numemployees' tabindex='1007'>
				<option value=''> --Select Number-- </option>
				<option value='1-99'>1-99</option>
				<option value='100-499'>100-499</option>
				<option value='500-1999'>500-1999</option>
				<option value='2000-4999'>2000-4999</option>
				<option value='5000-9999'>5000-9999</option>
				<option value='10000-29999'>10000-29999</option>
				<option value='30000+'>30000+</option>
			</select>
			</li>
		</ul>
		<ul>
			<li class='txt'>Address:</li>
			<li><input type='text' id ='ofp-address' class='bluebar' name='address' tabindex='1008' maxlength='150'/>
			</li>
		</ul>
		<ul>
			<li class='txt'>City:</li>
			<li><input type='text' id ='ofp-city' class='bluebar' name='city' tabindex='1009' maxlength='50'/>
			</li>
		</ul>
		<ul>
			<li class='txt'>Country:</li>
			<li><select id='ofp-country' class='bluebar' name='country' tabindex='1010'>
				<option value=''>--Select Country--</option>";
				foreach($countrylist as $country)
				$output .= "<option value='".$country['countryname']."'>".$country['countryname']."</option>";
				
			$output .= "</select> <br />
			</li>
		</ul>
		<ul>
			<li class='txt'>Phone:<span class='required'>*</span></li>
			<li><input type='text' id ='ofp-phone' class='bluebar' name='phone' tabindex='1011' maxlength='15'/>
			</li>
		</ul>
		<ul>
			<li class='txt'>Fax:</li>
			<li><input type='text' id ='ofp-fax' class='bluebar' name='fax' tabindex='1012' maxlength='15'/>
			</li>
		</ul>
		<ul>
			<li class='txt'>Email:<span class='required'>*</span></li>
			<li><input type='text' id='ofp-email' class='bluebar' name='email' tabindex='1013' maxlength='50' />
			</li>
		</ul>
		<ul>
			<li class='txt'>Key Areas that you want to focus on:</li>
			<li><select id='ofp-keyareas' class='bluebar' name='keyareas' tabindex='1014'>
				<option value=''>-</option>
				<option value='Sales & Marketing'>Sales & Marketing</option>
				<option value='Organisational Behavior & HRM'>Organisational Behavior & HRM</option>
				<option value='Personal Development'>Personal Development</option>
				<option value='Operations Management'>Operations Management</option>
				<option value='IT/MIS'>IT/MIS</option>
				<option value='General Management'>General Management</option>
				<option value='Case Teaching'>Case Teaching</option>
				<option value='Finance & Accounting/Banking'>Finance & Accounting/Banking</option>
				<option value='Leading and Managing Change'>Leading and Managing Change</option>
				<option value='Team Building'>Team Building</option>
				<option value='Any Other'>Any Other</option>
			</select>
			</li>
		</ul>
		<ul>
			<li class='txt'>Please list down last training intervention that your organization has undertaken:</li>
			<li><select id='ofp-traininginventions' class='bluebar' name='traininginventions' tabindex='1015'>
				<option value=''>-</option>
				<option value='In House Training'>In-house Training</option>
				<option value='Offside Training'>Offsite Training</option>
				<option value='Through Foreign Consultations'>Through Foreign Consultations</option>
				<option value='Partnerships with Private Trainers'>Partnerships with Private Trainers</option>
				<option value='Through Public/Government Training Institutions'>Through Public/Government Training Institutions</option>
				<option value='Never Organized a Training Course'>Never Organized a Training Course</option>
			</select>
			</li>
		</ul>
		<ul>
			<li class='txt'>Preferred Programme Duration:</li>
			<li><select id='ofp-programmeduration' class='bluebar' name='programmeduration' tabindex='1016'>
				<option value=''>-</option>
				<option value='2 Days'>2 Days</option>
				<option value='3-4 Days'>3-4 Days</option>
				<option value='4-5 Days'>4-5 Days</option>
				<option value='1 Week'>1 Week</option>
				<option value='2 Weeks'>2 Weeks</option>
				<option value='>2Weeks'> >2 Weeks</option>
			</select>
			</li>
		</ul>
		<ul>		
			<li class='txt'>Number of Participants:</li>
			<li><select id='ofp-numparticipants' class='bluebar' name='numparticipants' tabindex='1017'>
				<option value=''>-</option>
				<option value='0-10'>0-10</option>
				<option value='11-20'>11-20</option>
				<option value='21-30'>21-30</option>
				<option value='31-40'>31-40</option>
				<option value='41-50'>41-50</option>
				<option value='>50'> >50</option>
			</select>
			</li>
		</ul>
		<ul>
			<li class='txt'>How did you learn about our Organization focused programmes:</li>
			<li><select id='ofp-learnabout' class='bluebar' name='learnabout' tabindex='1018'>
				<option value=''>-</option>
				<option value='Website'>Website</option>
				<option value='Executive Alumni'>Executive Alumni</option>
				<option value='Annual Brochure'>Annual Brochure</option>
				<option value='Organization Focused Brochure'>Organization Focused Brochure</option>
				<option value='Referred by HR Department at LUMS'>Referred by HR Department at LUMS</option>
				<option value='Referred by HR Department of my Organization'>Referred by HR Department of my Organization</option>
			</select>
			</li>
		</ul>
		<ul>
			<li class='txt_t' >Do you wish to be informed about our future courses via email on a regular basis?:<span class='required'>*</span></li>
			<li>
			<span style='float:left; padding-top:10px;padding-left:75px;'>
			<input type='radio' name='email_inform' value='Yes'  tabindex='1019' checked ='checked' >&nbsp;&nbsp;Yes
				<input type='radio' name='email_inform' value='No'  tabindex='1020' >&nbsp;&nbsp;No<br>
				</span> 
				</li>
				</ul></div>";
	$output .= "
		</form>
		</div>
		<div id='button'>
		<ul>
			<li style='width:342px'>&nbsp;</li>
			<li>
			<button type='submit' class='next ofp-send ofp-button' tabindex='1021'>Submit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
			
			<button type='submit' class='next ofp-cancel ofp-button simplemodal-close' tabindex='1022'>Cancel &nbsp;&nbsp;</button>
			</li>
			</ul>
			</div>
	</div>
	
			<div class='ofp-info' style='clear:left; padding-top:70px;margin-left:43px'>
		<strong>Privacy statement</strong><br />
		At Rausing Executive Development Centre, LUMS we care about your privacy. We do not sell, rent, or <br />otherwise make available to third parties any personal information for marketing purposes.
		</div>
	<div class='ofp-bottom'><!--<a href='http://www.ericmmartin.com/projects/simplemodal/'>Powered by SimpleModal</a>--></div>
</div>";

	echo $output;
}
else if ($action == "send") {
	// Send the email
	$prefix = isset($_POST["prefix"]) ? $_POST["prefix"] : "";
	$firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
	$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
	$designation = isset($_POST["designation"]) ? $_POST["designation"] : "";
	$organisation = isset($_POST["organisation"]) ? $_POST["organisation"] : "";
	$Organisationwebsite = isset($_POST["Organisationwebsite"]) ? $_POST["Organisationwebsite"] : "";
	$numemployees = isset($_POST["numemployees"]) ? $_POST["numemployees"] : "";
	$address = isset($_POST["address"]) ? $_POST["address"] : "";
	$city = isset($_POST["city"]) ? $_POST["city"] : "";
	$country = isset($_POST["country"]) ? $_POST["country"] : "";
	$phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
	$fax = isset($_POST["fax"]) ? $_POST["fax"] : "";
	$email = isset($_POST["email"]) ? $_POST["email"] : "";	
	$keyareas = isset($_POST["keyareas"]) ? $_POST["keyareas"] : "";
	$traininginventions = isset($_POST["traininginventions"]) ? $_POST["traininginventions"] : "";	
	$programmeduration = isset($_POST["programmeduration"]) ? $_POST["programmeduration"] : "";	
	$numparticipants = isset($_POST["numparticipants"]) ? $_POST["numparticipants"] : "";
	$learnabout = isset($_POST["learnabout"]) ? $_POST["learnabout"] : "";		
	$dated = date("y-m-d H:i:s");
	$email_inform = isset($_POST["email_inform"]) ? $_POST["email_inform"] : "";

	if($firstname != "" && $lastname != "" && $organisation != "" && $phone != "" && $email != "")
	{	
		$db = new db();
		$record['prefix']=$db->mySQLSafe($prefix);
		$record['firstname']=$db->mySQLSafe($firstname);
		$record['lastname']=$db->mySQLSafe($lastname);
		$record['designation']=$db->mySQLSafe($designation);
		$record['organization']=$db->mySQLSafe($organisation);
		$record['organizationwebsite']=$db->mySQLSafe($Organisationwebsite);
		$record['numemployees']=$db->mySQLSafe($numemployees);
		$record['address']=$db->mySQLSafe($address);
		$record['city']=$db->mySQLSafe($city);
		$record['country']=$db->mySQLSafe($country);
		$record['phone']=$db->mySQLSafe($phone);
		$record['fax']=$db->mySQLSafe($fax);
		$record['email']=$db->mySQLSafe($email);
		$record['keyareas']=$db->mySQLSafe($keyareas);
		$record['traininginventions']=$db->mySQLSafe($traininginventions);
		$record['traininginventions']=$db->mySQLSafe($traininginventions);
		$record['programmeduration']=$db->mySQLSafe($programmeduration);
		$record['numparticipants']=$db->mySQLSafe($numparticipants);
		$record['learnabout']=$db->mySQLSafe($learnabout);
		$record['status'] = $db->mySQLSafe("");
		$record['dated']=$db->mySQLSafe($dated);
		$record['email_informe']=$db->mySQLSafe($email_inform);
		
		$record_newsletter['name']=$db->mySQLSafe($firstname);
		$record_newsletter['email']=$db->mySQLSafe($email);
		$record_newsletter['companyname']=$db->mySQLSafe($organisation);
		$record_newsletter['designation']=$db->mySQLSafe($designation);
		$record_newsletter['isactive']=$db->mySQLSafe($email_inform);
		$record_newsletter['dated']= $db->mySQLSafe($dated);
		
		$dated = date("d-m-y H:i:s");
		/*
		$message = "<table cellspacing= 15 >";
			$message .= "<tr><td>Contact Prefix</td><td>".$prefix."</td></tr>";
			$message .= "<tr><td>Contact First Name</td><td>".$firstname."</td></tr>";
			$message .= "<tr><td>Contact Last Name</td><td>".$lastname."</td></tr>";
			$message .= "<tr><td>Designation</td><td>".$designation."</td></tr>";
			$message .= "<tr><td>Organization Name</td><td>".$organisation."</td></tr>";
			$message .= "<tr><td>Organization Website</td><td>".$Organisationwebsite."</td></tr>";
			$message .= "<tr><td>Number of Employees in Organization</td><td>".$numemployees."</td></tr>";
			$message .= "<tr><td>Address</td><td>".$address."</td></tr>";
			$message .= "<tr><td>City</td><td>".$city."</td></tr>";
			$message .= "<tr><td>Country</td><td>".$country."</td></tr>";
			$message .= "<tr><td>Phone</td><td>".$phone."</td></tr>";
			$message .= "<tr><td>Fax</td><td>".$fax."</td></tr>";
			$message .= "<tr><td>Email</td><td>".$email."</td></tr>";
			$message .= "<tr><td>Key Areas that you want to focus on</td><td>".$keyareas."</td></tr>";
			$message .= "<tr><td>Please list down last training intervention that your organization has undertaken</td><td>".$traininginventions."</td></tr>";
			$message .= "<tr><td>Preferred Programme Duration</td><td>".$programmeduration."</td></tr>";
			$message .= "<tr><td>Number of Participants</td><td>".$numparticipants."</td></tr>";
			$message .= "<tr><td>How did you learn about our Organization focused programmes</td><td>".$learnabout."</td></tr>";
			$message .= "<tr><td>Do you wish to be informed about our future courses via email on a regular basis?</td><td>".$email_inform."</td></tr>";
			$message .= "<tr><td>Dated</td><td>".$dated."</td></tr>";
		$message .= "</table>";
		/*echo "<pre>";
		print_r($message);
		echo "</pre>";*/
		
		
			if($db->insert($tblname,$record) > 0) 
			{
				// send emails to admins
				$query= "Select * from ".$tblemails." where emailname = ".$db->mySQLSafe('OFP Request Email to Admin');
				$result= $db->execute($query);
				$fetch=mysql_fetch_array($result);
				
				$email_body = $fetch['content'];
				
				$email_body = str_replace('__CONTACTPREFIX__', $prefix, $email_body);		
				$email_body = str_replace('__CONTACTFIRSTNAME__', $firstname, $email_body);
				$email_body = str_replace('__CONTACTLASTNAME__', $lastname, $email_body);
				$email_body = str_replace('__DESIGNATION__', $designation, $email_body);
				$email_body = str_replace('__ORGANIZATIONNAME__', $organisation, $email_body);
				$email_body = str_replace('__ORGANIZATIONWEBSITE__', $Organisationwebsite, $email_body);
				$email_body = str_replace('__NUMOFEMPLOYEESINORGANIZATION__', $numemployees, $email_body);
				$email_body = str_replace('__ADDRESS__', $address, $email_body);
				$email_body = str_replace('__CITY__', $city, $email_body);
				$email_body = str_replace('__COUNTRY__', $country, $email_body);
				$email_body = str_replace('__PHONE__', $phone, $email_body);
				$email_body = str_replace('__FAX__', $fax, $email_body);		
				$email_body = str_replace('__EMAIL__', $email, $email_body);
				$email_body = str_replace('__KEYAREAS__', $keyareas, $email_body);
				$email_body = str_replace('__TRAININGINVENTION__', $traininginventions, $email_body);
				$email_body = str_replace('__PREFERREDPROGRAMMEDURATION__', $programmeduration, $email_body);
				$email_body = str_replace('__NUMOFPARTICIPANTS__', $numparticipants, $email_body);
				$email_body = str_replace('__LEARNABOUT__', $learnabout, $email_body);
				$email_body = str_replace('__WISHTOINFORM__', $email_inform, $email_body);
				$email_body = str_replace('__DATED__', $dated, $email_body);
				
				$query = "select email from redc_admin where usertype = 'A' or usertype = 'M'";
				$to = $db->select($query);
				$mail = new SendEmail();
		
				$db->insert($tblredcnewslettersubscribers,$record_newsletter);
				$i = 0;		
				for($i = 0 ; $i<count($to); $i++)
				{	
					if(SENDEMAIL)
					{
						$send = $mail->Send_Email($fetch['fromname'], $fetch['fromemail'],$to[$i]['email'],$to[$i]['email'],$fetch['subject'],$email_body,MAILSERVER);
					}
				}
				
				// send email to user
				$query= "Select * from ".$tblemails." where emailname = ".$db->mySQLSafe('OFP Request Email to User');
				$result= $db->execute($query);
				$fetch=mysql_fetch_array($result);
				
				$email_body = $fetch['content'];
				
				$email_body = str_replace('__FIRSTNAME__', $firstname, $email_body);
				
				$email_body = str_replace('__LASTNAME__', $lastname, $email_body);
				
				if(SENDEMAIL)
				{
					$mail->Send_Email($fetch['fromname'],$fetch['fromemail'],$firstname." ".$lastname,$email,$fetch['subject'],$email_body,MAILSERVER);
				}
			

				echo "<div class=\"ofp-complete\">
						<!--<img src=\"images/image001.gif\" alt=\"THANK YOU\" width=\"102\" border=\"0\" height=\"14\" /><br /><br />-->
						<img src=\"images/image002.gif\" alt=\"Form successfully sent\" width=\"166\" border=\"0\" height=\"15\" /><br /><br />
						Thank you for your interest in Rausing Executive Development Centre, LUMS.<br /><br />
						We will process your request as soon as possible.<br /><br />
						Should you have any questions, please do not hesitate to contact Rausing Executive Development Centre, LUMS,  Marketing Team at +92- 42- 35608242.<br /><br /><br />
						Best regards,<br />
						The REDC Team 
				</div>";
			
			}
			else
			{
				echo "<div class=\"ofp-complete\">Unfortunately, your message could not be verified.</div>";
			}	
	}
	else
	{
		echo "<div class=\"ofp-complete\">All the required fields were not submitted.</div>";
	}
	
}
exit;

?>