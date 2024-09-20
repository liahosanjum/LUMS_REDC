<?php
include("../classlibrary/configuration.php");		
include("../classlibrary/db.php");
include("../classlibrary/sendemail.php");
include_once('../libs/applyonline.lib.php');
$tblname="redc_ofp_requests";
$tblredcnewslettersubscribers = "redc_newsletter_subscribers";
$tbladmin     = "redc_admin";
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
		<h2 class='ofp-title'>Request For Organization Focused Programme</h2>
		<div class='ofp-loading' style='display:none'></div>
		<div class='ofp-message' style='display:none'></div>
			<div class='ofp-content2' id = 'ofp-content2'>
		<div class='ofp-forminputs' id='formdata'>
		<form action='#' style='display:none'>
		<ul>		
			<li class='txt'>Prefix:</li>
			<li><select id='ofp-prefix' class='bluebar' name='prefix' tabindex='1001'>
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
			<li><input type='text' id='ofp-firstname' class='bluebar' name='firstname' tabindex='1002' maxlength='30' />
			</li>
		</ul>
		<ul>
			<li class='txt'>Last Name:<span class='required'>*</span></li>
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
			<li><select id='ofp-country' class='bluebar' name='country' tabindex='1010'><option value=''>--select country--</option>";
				
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
			<li class='txt'>Key areas that you want to focus on:</li>
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
			<li class='txt'>Past three training interventions :</li>
			<li><select id='ofp-traininginventions' class='bluebar' name='traininginventions' tabindex='1015'>
				<option value=''>-</option>
				<option value='In House Training'>In House Training</option>
				<option value='Offside Training'>Offside Training</option>
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
				<option value='>2Weeks'> >2Weeks</option>
			</select>
			</li>
		</ul>
		<ul>		
			<li class='txt'>Number of Participants:</li>
			<li><select id='ofp-numparticipants' class='bluebar' name='numparticipants' tabindex='1017'>
				<option value=''>-</option>
				<option value='1-10'>1-10</option>
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
				<option value='Referred by HR Department of My'>Referred by HR Department of My</option>
			</select>
			</li>
		</ul>
		<ul>
			<li class='txt_t' >Do you wish to be informed about our future courses via email on a regular basis?:<span class='required'>*</span></li>
			<li>
			<span style='float:left; padding-top:10px;'>
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
			<li style='width:265px'>&nbsp;</li>
			<li>
			<button type='submit' class='next ofp-send ofp-button' tabindex='1021'>Submit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
			
			<button type='submit' class='next ofp-cancel ofp-button simplemodal-close' tabindex='1022'>Cancel &nbsp;&nbsp;</button>
			</li>
			</ul>
			</div>
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
		
		$message = "<table cellspacing= 15 >";
			$message .= "<tr><td>Title</td><td>".$prefix."</td></tr>";
			$message .= "<tr><td>First Name</td><td>".$firstname."</td></tr>";
			$message .= "<tr><td>Last Name</td><td>".$lastname."</td></tr>";
			$message .= "<tr><td>Designation</td><td>".$designation."</td></tr>";
			$message .= "<tr><td>Organization</td><td>".$organisation."</td></tr>";
			$message .= "<tr><td>Organization Website</td><td>".$Organisationwebsite."</td></tr>";
			$message .= "<tr><td>Num of employees</td><td>".$numemployees."</td></tr>";
			$message .= "<tr><td>Address</td><td>".$address."</td></tr>";
			$message .= "<tr><td>City</td><td>".$city."</td></tr>";
			$message .= "<tr><td>Country</td><td>".$country."</td></tr>";
			$message .= "<tr><td>Phone</td><td>".$phone."</td></tr>";
			$message .= "<tr><td>Fax</td><td>".$fax."</td></tr>";
			$message .= "<tr><td>Email</td><td>".$email."</td></tr>";
			$message .= "<tr><td>Key areas</td><td>".$keyareas."</td></tr>";
			$message .= "<tr><td>Training inventions</td><td>".$traininginventions."</td></tr>";
			$message .= "<tr><td>Programme duration</td><td>".$programmeduration."</td></tr>";
			$message .= "<tr><td>Num of participants</td><td>".$numparticipants."</td></tr>";
			$message .= "<tr><td>Learn about</td><td>".$learnabout."</td></tr>";
			$message .= "<tr><td>Do you wish to be informed about our future courses via email on a regular basis?</td><td>".$email_inform."</td></tr>";
			$message .= "<tr><td>Dated</td><td>".$dated."</td></tr>";
		$message .= "</table>";
		/*echo "<pre>";
		print_r($message);
		echo "</pre>";*/
		$query = "select email from redc_admin where usertype = 'A' or usertype = 'M'";
		$to = $db->select($query);
		$mail = new SendEmail();
			if($db->insert($tblname,$record) > 0) 
			{
				$db->insert($tblredcnewslettersubscribers,$record_newsletter);
				$i = 0;		
				for($i = 0 ; $i<count($to); $i++)
				{	
					$send = $mail->Send_Email($email,$email,$to[$i]['email'],$to[$i]['email'],"Organization focused programmes request",$message,MAILSERVER);
				}
echo "<div class=\"ofp-complete\">Thank you for placing a request for an Organization Focused Programme. Our Executive Education Representative will contact you regarding your initiative soon.</div>";
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