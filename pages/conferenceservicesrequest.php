<?php
include("../classlibrary/configuration.php");		
include("../classlibrary/db.php");
include("../classlibrary/sendemail.php");
$tblconferenceservicerequests = "redc_conferenceservice_requests";
$tablename="redc_page_content";
$tblemails = "redc_emailcontent";

$years = range (date('Y'), date('Y')+1);
// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the conferenceservice form HTML
	$output = "<div style='display:none' class='conferenceservice-wraper'>
	<a href='#' title='Close' class='modalCloseX simplemodal-close' style='padding-top:10px;' ><img src='images/crossicon.jpg' alt='Close'  border='0'/></a>
	<div class='conferenceservice-top'></div>
	<div class='conferenceservice-content conferenceservice-forms'>
		<h2 class='conferenceservice-title'>Facilities and Services Rental</h2>
		<div class='conferenceservice-info'>
		Our advisors are available to assist you in your query.<br />
		Fields marked with a * are mandatory.
		</div>
		<div class='conferenceservice-loading' style='display:none'></div>
		<div class='conferenceservice-message' style='display:none'></div>
		<div class='conferenceservice-content2' id='conferenceservice-content2'>
		<div class='conferenceservice-forminputs'>
		<form action='#' style='display:none'>
		<ul>
			<li class='txt'>First Name:<span class='required'>*</span></li>
			<li><input type='text' id='conferenceservice-firstname' class='bluebar' name='firstname' tabindex='1001' maxlength='30' />
			</li>
		</ul>
		<ul>
			<li class='txt'>Last Name:<span class='required'>*</span></li>
			<li><input type='text' id='conferenceservice-lastname' class='bluebar' name='lastname' maxlength='30' tabindex='1002'  />
			</li>
		</ul>
		<ul>
			<li class='txt'>Designation:</li>
			<li><input type='text' id ='conferenceservice-designation' class='bluebar' name='designation' maxlength='50' tabindex='1003'  />
			</li>
		</ul>
		<ul>
			<li class='txt'>Organization:<span class='required'>*</span></li>
			<li><input type='text' id ='conferenceservice-organisation' class='bluebar' name='organisation' tabindex='1004' maxlength='50'/>
			</li>
		</ul>
		<ul>
			<li class='txt'>Address:</li>
			<li><input type='text' id ='conferenceservice-address' class='bluebar' name='address' tabindex='1005' maxlength='150'/>
			</li>
		</ul>
		<ul>
			<li class='txt'>Telephone:<span class='required'>*</span></li>
			<li><input type='text' id ='conferenceservice-phoneno' class='bluebar' name='phoneno' tabindex='1006' maxlength='15'/>
			</li>
		</ul>
		<ul>
			<li class='txt'>Fax:</li>
			<li><input type='text' id ='conferenceservice-fax' class='bluebar' name='fax' tabindex='1007' maxlength='15'/>
			</li>
		</ul>
		<ul>
			<li class='txt'>Mobile:</li>
			<li><input type='text' id ='conferenceservice-mobile' class='bluebar' name='mobile' tabindex='1008' maxlength='15'/>
			</li>
		</ul>
		<ul>
			<li class='txt'>Email:<span class='required'>*</span></li>
			<li><input type='text' id='conferenceservice-email' class='bluebar' name='email' tabindex='1009' maxlength='50' />
			</li>
		</ul>
		<ul>
			<li class='txt'>Date of Event:<span class='required'>*</span></li>
			<li><input type='hidden' id='currentdate' value='".date("m-d-Y")."' />
			
			<li>
			<select name='month' id='conferenceservice-month' class='bluebar_date' value=''  tabindex='1010' >
			<option value='01'>January</option>
			<option value='02'>February</option>
			<option value='03'>March</option>
			<option value='04'>April</option>
			<option value='05'>May</option>
			<option value='06'>June</option>
			<option value='07'>July</option>
			<option value='08'>August</option>
			<option value='09'>September</option>
			<option value='10'>October</option>
			<option value='11'>November</option>
			<option value='12'>December</option>
			</select>
			</li>
			<li>
			<select name='date' id='conferenceservice-date' class='bluebar_date' tabindex='1011' >
			<option value='01'>01</option>
			<option value='02'>02</option>
			<option value='03'>03</option>
			<option value='04'>04</option>
			<option value='05'>05</option>
			<option value='06'>06</option>
			<option value='07'>07</option>
			<option value='08'>08</option>
			<option value='09'>09</option>
			<option value='10'>10</option>
			<option value='11'>11</option>
			<option value='12'>12</option>
			<option value='13'>13</option>
			<option value='14'>14</option>
			<option value='15'>15</option>
			<option value='16'>16</option>
			<option value='17'>17</option>
			<option value='18'>18</option>
			<option value='19'>19</option>
			<option value='20'>20</option>
			<option value='21'>21</option>
			<option value='22'>22</option>
			<option value='23'>23</option>
			<option value='24'>24</option>
			<option value='25'>25</option>
			<option value='26'>26</option>
			<option value='27'>27</option>
			<option value='28'>28</option>
			<option value='29'>29</option>
			<option value='30'>30</option>
			<option value='31'>31</option>
			</select>
			</li>
			<li>
			<select name='year' id ='conferenceservice-year' class='bluebar_date' tabindex='1012'>";
			foreach($years as $value){
			 $output .= "<option value='$value'>$value</option>";
			  }
			 
			 $output .= "</select>
			 </li>
		</ul>
		 <ul>
			<li class='txt'>No of Participants:<span class='required'>*</span></li>
			<li><input type='text' id='conferenceservice-participants' class='bluebar' name='participants' tabindex='1013' maxlength='15' />
			</li>
		</ul>
		<ul>		
			<li class='txt_h'>Facilities Required</li>
		</ul>
		<ul>		
			<li class='txt'>Auditorium:</li>
			<li>
			<input type='radio' name='auditorium' value='65 Seats'  tabindex='1014' >&nbsp;&nbsp;65 Seats
				<input type='radio' name='auditorium' value='45 Seats'  tabindex='1015' >&nbsp;&nbsp;45 Seats
				<input type='radio' name='auditorium' value='35 Seats'  tabindex='1016' >&nbsp;&nbsp;35 Seats
			</li>
		</ul>
		<ul>
			<li class='txt'>Lounge:</li>
			<li>
				<input type='radio' name='lounge' value='15 Seats'  tabindex='1017' >&nbsp;&nbsp;15 Seats
				<input type='radio' name='lounge' value='8 Seats'  tabindex='1018' >&nbsp;&nbsp;8 Seats
			</li>
		</ul>
		<!--<ul>
			<li class='txt_h'>Residential Rooms</li>
		</ul>-->
		<ul>
			<li class='txt'>Residential Rooms:<span class='required'></span></li>
			<li>
			<input type='radio' id='conferenceservice-bedroom' name='bedroom' value='single'  tabindex='1019'>&nbsp;&nbsp;Single
				<span style='padding-left:15px;'><input  type='radio' id='conferenceservice-bedroom' name='bedroom' value='double'  tabindex='1020' >&nbsp;&nbsp;Double</span>
			</li>
		</ul>
		<ul>
			<li class='txt'>Additional Requirements:</li>
			<li><textarea id='conferenceservice-additionalrequirements' class='bluebar' name='additionalrequirements' maxlength='100' onkeyup='return ismaxlength(this)' tabindex='1021'></textarea>
			</li>
		</ul></div>";
	$output .= "
			</form>
		</div>
		<div id='button'>
		<ul>
			<li style='width:265px'>&nbsp;</li>
			<li>
			<button type='submit' class='next conferenceservice-send conferenceservice-button' tabindex='1021'>Submit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
			
			<button type='submit' class='next conferenceservice-cancel conferenceservice-button simplemodal-close' tabindex='1022'>Cancel &nbsp;&nbsp;</button>
			</li>
			</ul>
			</div>
		</div>
		
<div class='conferenceservice-info' style='margin-left:43px'>
		<strong>Privacy statement</strong><br />
		At Rausing Executive Development Centre, LUMS we care about your privacy. We do not sell, rent, or otherwise make available to third parties any personal information for marketing purposes.
		</div>
	<div class='conferenceservice-bottom'><!--<a href='http://www.ericmmartin.com/projects/simplemodal/'>Powered by SimpleModal</a>--></div>
</div>";

	echo $output;
}
else if ($action == "send") {
	// Send the email
	$firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
	$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
	$designation = isset($_POST["designation"]) ? $_POST["designation"] : "";
	$organisation = isset($_POST["organisation"]) ? $_POST["organisation"] : "";
	$address = isset($_POST["address"]) ? $_POST["address"] : "";
	$phoneno = isset($_POST["phoneno"]) ? $_POST["phoneno"] : "";
	$fax = isset($_POST["fax"]) ? $_POST["fax"] : "";
	$mobile = isset($_POST["mobile"]) ? $_POST["mobile"] : "";
	$email = isset($_POST["email"]) ? $_POST["email"] : "";
	$dated = $_POST["year"]."-".$_POST["month"]."-".$_POST["date"];
	$participants = isset($_POST["participants"]) ? $_POST["participants"] : "";	
	$auditorium = isset($_POST["auditorium"]) ? $_POST["auditorium"] : "";
	$lounge = isset($_POST["lounge"]) ? $_POST["lounge"] : "";	
	$bedroom = isset($_POST["bedroom"]) ? $_POST["bedroom"] : "";
	/*$single = isset($_POST["single"]) ? $_POST["single"] : "";
	$double = isset($_POST["double"]) ? $_POST["double"] : "";*/	
	$additionalrequirements = isset($_POST["additionalrequirements"]) ? $_POST["additionalrequirements"] : "";			
	$contactdate = date("y-m-d H:i:s");
	$status = 'Y';
	if($firstname != "" && $lastname != "" && $organisation != "" && $phoneno != "" && $email != "" && $dated != "" && $participants != "")
	{	
		$db = new db();
		$record['firstname']=$db->mySQLSafe($firstname);
		$record['lastname']=$db->mySQLSafe($lastname);
		$record['designation']=$db->mySQLSafe($designation);
		$record['organisation']=$db->mySQLSafe($organisation);
		$record['address']=$db->mySQLSafe($address);
		$record['phoneno']=$db->mySQLSafe($phoneno);
		$record['fax']=$db->mySQLSafe($fax);
		$record['mobile']=$db->mySQLSafe($mobile);
		$record['email']=$db->mySQLSafe($email);
		$record['dated']=$db->mySQLSafe($dated);
		$record['totalparticipants']=$db->mySQLSafe($participants);
		$record['auditorium']=$db->mySQLSafe($auditorium);
		$record['lounge']=$db->mySQLSafe($lounge);
		$record['bedroom']=$db->mySQLSafe($bedroom);
		/*$record['single']=$db->mySQLSafe($single);
		$record['double']=$db->mySQLSafe($double);*/
		$record['additionalrequirements']=$db->mySQLSafe($additionalrequirements);
		$record['daterequest'] = $db->mySQLSafe($contactdate);
		$record['isactive'] = $db->mySQLSafe($status);		
		/*echo "<pre>";
		print_r($record);
		echo "</pre>";
		exit;*/

/*		$message = "<table cellspacing= 15 >";
			$message .= "<tr><td>First Name</td><td>".$firstname."</td></tr>";
			$message .= "<tr><td>Last Name</td><td>".$lastname."</td></tr>";
			$message .= "<tr><td>Designation</td><td>".$designation."</td></tr>";
			$message .= "<tr><td>Organization</td><td>".$organisation."</td></tr>";
			$message .= "<tr><td>Address</td><td>".$address."</td></tr>";
			$message .= "<tr><td>Telephone</td><td>".$phoneno."</td></tr>";
			$message .= "<tr><td>Fax</td><td>".$fax."</td></tr>";
			$message .= "<tr><td>Mobile</td><td>".$mobile."</td></tr>";
			$message .= "<tr><td>Email</td><td>".$email."</td></tr>";
			$message .= "<tr><td>Date of Event</td><td>".$dated."</td></tr>";
			$message .= "<tr><td>No Of Participants</td><td>".$participants."</td></tr>";
			$message .= "<tr><td>Auditorium</td><td>".$auditorium."</td></tr>";
			$message .= "<tr><td>Lounge</td><td>".$lounge."</td></tr>";
			$message .= "<tr><td>Residential Rooms</td><td>".$bedroom."</td></tr>";
			/*$message .= "<tr><td>Single</td><td>".$single."</td></tr>";
			$message .= "<tr><td>Double</td><td>".$double."</td></tr>";*/
			/*
			$message .= "<tr><td>Additional Requirement</td><td>".$additionalrequirements."</td></tr>";
		$message .= "</table>";

		/*echo "<pre>";
		print_r($message);
		echo "</pre>";*/
		
		if($db->insert($tblconferenceservicerequests,$record) > 0) 
		{
			// send emails to admins
			$query= "Select * from ".$tblemails." where emailname = ".$db->mySQLSafe('Facility Request Email to Admin');
			$result= $db->execute($query);
			$fetch=mysql_fetch_array($result);
			
			$email_body = $fetch['content'];
			
			$email_body = str_replace('__FIRSTNAME__', $firstname, $email_body);		
			$email_body = str_replace('__LASTNAME__', $lastname, $email_body);
			$email_body = str_replace('__DESIGNATION__', $designation, $email_body);
			$email_body = str_replace('__ORGANIZATION__', $organisation, $email_body);
			$email_body = str_replace('__ADDRESS__', $address, $email_body);
			$email_body = str_replace('__TELEPHONE__', $phoneno, $email_body);
			$email_body = str_replace('__FAX__', $fax, $email_body);
			$email_body = str_replace('__MOBILE__', $mobile, $email_body);
			$email_body = str_replace('__EMAIL__', $email, $email_body);
			$email_body = str_replace('__DATEOFEVENT__', $dated, $email_body);
			$email_body = str_replace('__NOOFPARTICIPANTS__', $participants, $email_body);
			$email_body = str_replace('__AUDITORIUM__', $auditorium, $email_body);
			$email_body = str_replace('__LOUNGE__', $lounge, $email_body);
			$email_body = str_replace('__RESIDENTIALROOMS__', $bedroom, $email_body);
			$email_body = str_replace('__ADDITIONALREQUIREMENTS__', $additionalrequirements, $email_body);
				
			$query = "select email from redc_admin where usertype = 'A' or usertype = 'C'";
			$to = $db->select($query);
			$mail = new SendEmail();
		
			$i = 0;		
			for($i = 0 ; $i<count($to); $i++)
			{	
				if(SENDEMAIL)
				{
					$send = $mail->Send_Email($fetch['fromname'],$fetch['fromemail'],$to[$i]['email'],$to[$i]['email'],$fetch['subject'],$email_body,MAILSERVER);
				}
			}
			
			// send email to user
			$query= "Select * from ".$tblemails." where emailname = ".$db->mySQLSafe('Facility Request Email to User');
			$result= $db->execute($query);
			$fetch=mysql_fetch_array($result);
			
			$email_body = $fetch['content'];
			
			$email_body = str_replace('__FIRSTNAME__', $firstname, $email_body);
			
			$email_body = str_replace('__LASTNAME__', $lastname, $email_body);


			if(SENDEMAIL)
			{
				$mail->Send_Email($fetch['fromname'],$fetch['fromemail'],$firstname." ".$lastname,$email,$fetch['subject'],$email_body,MAILSERVER);
			}

			echo "<div class=\"conferenceservice-complete\">
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
			echo "<div class=\"conferenceservice-complete\">Unfortunately, your message could not be verified.</div>";
		}	
	}
	else
	{
		echo "<div class=\"conferenceservice-complete\">All the required fields were not submitted.</div>";
	}
}

exit;

?>