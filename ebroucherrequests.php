<?php
include("../classlibrary/configuration.php");		
include("../classlibrary/db.php");
include("../classlibrary/sendemail.php");
include_once('../libs/applyonline.lib.php');
$tblname = "redc_enrollments_broucher_requests";
$tbladmin     = "redc_admin";
$applyonline = new ApplyOnline;
$countrylist = $applyonline->getCountries();


// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the ebroucherrequest form HTML
	$output = "<div style='display:none' class='ebroucherrequest-wraper'>
	<a href='#' title='Close' class='modalCloseX simplemodal-close' style='padding-top:10px;' ><img src='images/crossicon.jpg' alt='Close'  border='0'/></a>
	<div class='ebroucherrequest-top'></div>
	<div class='ebroucherrequest-content ebroucherrequest-forms'>
		<h2 class='ebroucherrequest-title'>Enrollments Brochure Request</h2>
		<div class='ebroucherrequest-loading' style='display:none'></div>
		<div class='ebroucherrequest-message' style='display:none'></div>
		<div class='ebroucherrequest-content2' id='ebroucherrequest-content2'>
		<div class='ebroucherrequest-forminputs'>
		<form action='#' style='display:none'>
			<ul>
			<li class='txt'>Title:</li>
			<li>
			<select id='ebroucherrequest-prefix' class='bluebar' name='prefix' tabindex='1001'>
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
			<input type='text' id='ebroucherrequest-firstname' class='bluebar' name='firstname' tabindex='1002' maxlength='30' />
			</li>
			</ul>
			<ul>
				<li class='txt'>Last Name:<span class='required'>*</span></li>
				<li>
				<input type='text' id='ebroucherrequest-lastname' class='bluebar' name='lastname' tabindex='1003' maxlength='30' />
				</li>
			</ul>
			<ul>
				<li class='txt'>Company Name:</li>
				<li>
				<input type='text' id ='ebroucherrequest-companyname' class='bluebar' name='companyname' tabindex='1004' max='50'/>
				</li>
			</ul>
			<ul>
				<li class='txt'>Designation:</li>
				<li>
				<input type='text' id ='ebroucherrequest-designation' class='bluebar' name='designation' tabindex='1005' max='50' />
				</li>
			</ul>
			
			<ul>
				<li class='txt'>Address:<span class='required'>*</span></li>
					<li><input type='text' id ='ebroucherrequest-address' class='bluebar' name='address' tabindex='1006' max='150'/>
					</li>
			</ul>
			<ul>
				<li class='txt'>City:<span class='required'>*</span></li>
				<li><input type='text' id ='ebroucherrequest-city' class='bluebar' name='city' tabindex='1007' max='50'/>
				</li>
			</ul>
			<ul>
				<li class='txt'>Postal Code:<span class='required'>*</span></li>
				<li><input type='text' id ='ebroucherrequest-postalcode' class='bluebar' name='postalcode' tabindex='1008' max='50'/>
				</li>
			</ul>
			<ul>
				<li class='txt'>Country:</li>				
					<li><select id='ebroucherrequest-country' class='bluebar' name='country' tabindex='1009'><option value=''>--select country--</option>
					";
				
				foreach($countrylist as $country)
				$output .= "<option value='".$country['countryname']."'>".$country['countryname']."</option>";
				
			$output .= "</select> </li></ul><br />
			<ul>
			<li class='txt'>Telephone:<span class='required'>*</span></li>
			<li><input type='text' id ='ebroucherrequest-telephone' class='bluebar' name='telephone' tabindex='1010' max='15'/>
			</li>
			</ul>
			<ul>
				<li class='txt'>Fax:</li>
				<li><input type='text' id ='ebroucherrequest-fax' class='bluebar' name='fax' tabindex='1011' max='15'/>
				</li>
			</ul>
			<ul>
				<li class='txt'>Email:<span class='required'>*</span></li>
				<li><input type='text' id='ebroucherrequest-email' class='bluebar' name='email' tabindex='1012' maxlength='50' />
				</li>
			</ul>
			<ul>
				<li class='txt'>How did you learn about programme?:</li>
				<li><select id='ebroucherrequest-learn_about' class='bluebar' name='learn_about' tabindex='1013'>
				<option value=''>-</option>
				<option value='LUMS Website'>LUMS Website</option>
				<option value='Print Advertisement'>Print Advertisement</option>
				<option value='Direct Mail Package'>Direct Mail Package</option>
				<option value='Email Notification'>Email Notification</option>
				<option value='Online Advertisement'>Online Advertisement</option>
				<option value='Internet Search'>Internet Search</option>
				<option value='Other'>Other</option>
			</select>
				</li>
			</ul>
			<ul>
				<li class='txt'>Programme Name:</li>
				<li><input type='text' id ='ebroucherrequest-programmename' class='bluebar' name='programmename' tabindex='1014' max='50'/>
				</li>
				</ul></div>
			";
	$output .= "
		</form>
		</div>
		<div id='button'>
		<ul>
			<li style='width:265px'>&nbsp;</li>
			<li>
			<button type='submit' class='next ebroucherrequest-send ebroucherrequest-button' tabindex='1015'>Submit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
			
			<button type='submit' class='next ebroucherrequest-cancel ebroucherrequest-button simplemodal-close' tabindex='1016'>Cancel &nbsp;&nbsp;</button>
			</li>
			</ul>
			</div>
	</div>
	<div class='ebroucherrequest-bottom'><!--<a href='http://www.ericmmartin.com/projects/simplemodal/'>Powered by SimpleModal</a>--></div>
</div>";

	echo $output;
}
else if ($action == "send") {
	// Send the email
	$prefix = isset($_POST["prefix"]) ? $_POST["prefix"] : "";
	$firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
	$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
	$designation = isset($_POST["designation"]) ? $_POST["designation"] : "";
	$companyname = isset($_POST["companyname"]) ? $_POST["companyname"] : "";
	$address = isset($_POST["address"]) ? $_POST["address"] : "";
	$city = isset($_POST["city"]) ? $_POST["city"] : "";
	$postalcode = isset($_POST["postalcode"]) ? $_POST["postalcode"] : "";
	$country = isset($_POST["country"]) ? $_POST["country"] : "";
	$telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
	$fax = isset($_POST["fax"]) ? $_POST["fax"] : "";
	$email = isset($_POST["email"]) ? $_POST["email"] : "";	
	$learn_about = isset($_POST["learn_about"]) ? $_POST["learn_about"] : "";		
	$programmename = isset($_POST["programmename"]) ? $_POST["programmename"] : "";

	if($firstname != "" && $lastname != "" && $address != "" && $city != "" && $postalcode != ""  && $telephone != "" && $email != "")
	{	
		$db = new db();
		$record['prefix']=$db->mySQLSafe($prefix);
		$record['firstname']=$db->mySQLSafe($firstname);
		$record['lastname']=$db->mySQLSafe($lastname);
		$record['designation']=$db->mySQLSafe($designation);
		$record['companyname']=$db->mySQLSafe($companyname);
		$record['address']=$db->mySQLSafe($address);
		$record['city']=$db->mySQLSafe($city);
		$record['postalcode']=$db->mySQLSafe($postalcode);
		$record['country']=$db->mySQLSafe($country);
		$record['telephone']=$db->mySQLSafe($telephone);
		$record['fax']=$db->mySQLSafe($fax);
		$record['email']=$db->mySQLSafe($email);
		$record['learn_about']=$db->mySQLSafe($learn_about);
		$record['programmename']=$db->mySQLSafe($programmename);
		/*echo "<pre>";
		print_r($record);
		echo "</pre>";
		exit;*/
		$message = "<table cellspacing= 15 >";
			$message .= "<tr><td>Title</td><td>".$prefix."</td></tr>";
			$message .= "<tr><td>First Name</td><td>".$firstname."</td></tr>";
			$message .= "<tr><td>Last Name</td><td>".$lastname."</td></tr>";
			$message .= "<tr><td>Designation</td><td>".$designation."</td></tr>";
			$message .= "<tr><td>Organization</td><td>".$companyname."</td></tr>";
			$message .= "<tr><td>Address</td><td>".$address."</td></tr>";
			$message .= "<tr><td>City</td><td>".$city."</td></tr>";
			$message .= "<tr><td>Postalcode</td><td>".$postalcode."</td></tr>";
			$message .= "<tr><td>Country</td><td>".$country."</td></tr>";
			$message .= "<tr><td>Phone</td><td>".$phone."</td></tr>";
			$message .= "<tr><td>Fax</td><td>".$fax."</td></tr>";
			$message .= "<tr><td>Email</td><td>".$email."</td></tr>";
			$message .= "<tr><td>Learn about</td><td>".$learn_about."</td></tr>";
			$message .= "<tr><td>Programme Name</td><td>".$programmename."</td></tr>";
		$message .= "</table>";
		/*echo "<pre>";
		print_r($message);
		echo "</pre>";*/
		$query = "select email from redc_admin where usertype = 'A' or usertype = 'M'";
		$to = $db->select($query);
		$mail = new SendEmail();
			if($db->insert($tblname,$record) > 0) 
			{
				$i = 0;		
				for($i = 0 ; $i<count($to); $i++)
				{	
					$send = $mail->Send_Email($email,$email,$to[$i]['email'],$to[$i]['email'],"Organization focused programmes request",$message,MAILSERVER);
				}
				echo "<div class=\"ebroucherrequest-complete\">Thank you for placing a request for Brochure. Our Executive Education Representative will contact you regarding your initiative within three business days of receiving your request.</div>";
			}
			else
			{
				echo "<div class=\"ebroucherrequest-complete\">Unfortunately, your message could not be verified.</div>";
			}
	}
	else
	{
		echo "<div class=\"ebroucherrequest-complete\">All the required fields were not submitted.</div>";
	}
	
}
exit;

?>