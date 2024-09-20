<?php
	session_start();
	session_register("userrecord"); 
	session_register("successlogin");
	session_register("userid"); 

// DEFINES CONSTANTS FOR DB CONNECTION
	define('HOST', 'netraserver');
	define('USERNAME', 'root');
	define('PASSWORD', 'admin');
	define('DATABASE', 'redc_db');


// GLOBAL VARIABLE TO RETIAN THE USER RECORD IF ALREADY REGISTERED
	global $userRecord;
	$userRecord = null;
	$successLogin = 0;
	if(isset($_SESSION['userrecord']) && $_SESSION['userrecord'] != "")
	{
		$userRecord   = $_SESSION['userrecord'];
		$successLogin = $_SESSION['successlogin'];
	}	

	//print_r($userRecord);

// INCLUDE FILES
	include_once('classlibrary/db.php');
	include_once('libs/applyonline.lib.php');

// OBJECT OF CLASS APPLYONLINE
	$applyonline = new ApplyOnline;

// POPULATE EXISTING RECORD IN FORM FIELDS IF USER ALREADY REGISTERED

// GET COUNTRIES LIST
	$countrylist = $applyonline->getCountries();

// GET ACTIVE PROGRAMMES LIST
	$programmes  = $applyonline->getProgrammes(); 

?>
<html>
<head>
	<script src='js/jquery.js' type='text/javascript'></script>
	<!-- Contact Form JS and CSS files -->
	<script src='js/a1.js' type='text/javascript'></script>
	<link type='text/css' href='css/applyonline.css' rel='stylesheet' media='screen' />	
	<link type='text/css' href='css/applynew.css' rel='stylesheet' media='screen' />	
</head>
<body>
<div id="contact-container" style="padding-left:350px; padding-top:50px;">
	<div class='contact-top'></div>
	<div align='center' style='display:none;'>
		<a href='javascript:void(0)' onclick='toggleFunc("1")'>Step 1</a>&nbsp;

		<a href='javascript:void(0)' onclick='toggleFunc("2")'>Step 2</a>&nbsp;
		<a href='javascript:void(0)' onclick='toggleFunc("3")'>Step 3</a>&nbsp;
		<a href='javascript:void(0)' onclick='toggleFunc("4")'>Step 4</a>&nbsp;
	</div>
	<input type='hidden' name='divname' value='1' id='contact-divname'/>
	<input type='hidden' name='ifregistered' value='<?=$successLogin?>' id='contact-ifregistered'/>
	<form action='#'>
	<div class='contact-content' id='s1' style="display:none;">
	<h1 class='contact-title'>Create Account:</h1>
	<div class='contact-loading' style='display:none;'></div>
	<div class='contact-message' style='display:none;'></div>
	
		<label for='contact-username'>*Email (user name):</label>
			<input type='text' id='contact-username' class='contact-input' name='username' tabindex='1001' maxlength='30' />
			<label for='contact-password'>*Password:</label>

			<input type='password' id='contact-password' class='contact-input' name='password' maxlength='30' tabindex='1002' />
			<label for='contact-confpassword'>*Confirm Password:</label>
			<input type='password' id='contact-confpassword' class='contact-input' name='confpassword' maxlength='30' tabindex='1003' /><br /><label>&nbsp;</label>
			<span>
			<button type='button' class='contact-check contact-button' tabindex='1004' onClick="checkAvailability()">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='button' class='contact-cancel contact-button simplemodal-close' tabindex='1005'>Cancel</button>
			</span>

			<br/>
		
			<div style='height:10px; cursor:pointer; padding-top:5px;' align='center' class='contact-login' onClick="showLoginDiv()">Already registered, click here to login.</div>
			
	
	</div>
	<div class='contact-content1' id='login' style='display:none;'>
	<h1 class='contact-title'>Login:</h1>
	<div class='contact-loading' style='display:none;'></div>
	<div class='contact-message' style='display:none;'></div>
	
		<label for='contact-loginusername'>*Email (user name):</label>

			<input type='text' id='contact-loginusername' class='contact-input' name='loginusername' tabindex='1001' maxlength='30' />
			<label for='contact-loginpassword'>*Password:</label>
			<input type='password' id='contact-loginpassword' class='contact-input' name='loginpassword' maxlength='30' tabindex='1002' />
			<br /><label>&nbsp;</label>
			<span>
			<button type='button' class='contact-checklogin contact-button' tabindex='1003' onClick="ifValidLogin();">Login</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='button' class='contact-cancel contact-button simplemodal-close' tabindex='1004' onClick="toggleFunc(0);">Cancel</button>

			</span>
			<br/>
			
	
	</div>
	<div class='contact-content1' id='s2' style='display:none;'>
	<h1 class='contact-title1'>Personal Data:</h1>
	<div class='contact-message' style='display:none;'></div>
		<div class='contact-content2'>
			<label for='contact-firstname'>*First Name:</label>

		<input type='text' id='contact-firstname' class='contact-input' name='firstname' maxlength='30' tabindex='1001' value='<?=$userRecord['firstname']?>' />
		<label for='contact-password'>Middle Name:</label>
		<input type='text' id='contact-middlename' class='contact-input' name='middlename' maxlength='30' tabindex='1002' value='<?=$userRecord['middlename']?>' />
		<label for='contact-confpassword'>*Last Name:</label>
		<input type='text' id='contact-lastname' class='contact-input' name='lastname' maxlength='30' tabindex='1003' value='<?=$userRecord['lastname']?>' />
		<label for='contact-prefix'>*Prefix:</label>
		<select id='contact-prefix' class='contact-input' name='prefix' tabindex='1004'>

			<option value='Mr.'>Mr.</option>
			<option value='Mrs.'>Mrs.</option>
			<option value='Miss'>Miss</option>
			<option value='Ms.'>Ms.</option>
			<option value='Dr.'>Dr.</option>
		</select>

		<label for='contact-gender'>*Gender:</label>
		<span style='float:left'>
		<input type='radio' name='gender' value = 'male' checked='checked' tabindex='1005' class='class-input' /> Male <br />
		<input type='radio' name='gender' value = 'female' class='class-input'/> Female
		</span>
		<label for='contact-nationality'>Nationality:</label>
		<input type='text' id='contact-nationality' class='contact-input' name='nationality' maxlength='50' tabindex='1006' value='<?=$userRecord['nationality']?>' />

		<label for='contact-busemail'>*Business Email:</label>
		<input type='text' id='contact-busemail' class='contact-input' name='busemail' tabindex='1007' maxlength='50' value='<?=$userRecord['busemail']?>' />
		<br />
			<span style='padding-left:10px;'>In case of emergency, please notify</span>
		<br />
		<label for='contact-emergencyname'>*Name:</label>
		<input type='text' id='contact-emergencyname' class='contact-input' name='emergencyname' tabindex='1008' maxlength='50' value='<?=$userRecord['emergencyname']?>' />

		<label for='contact-emergencyphone'>*Telephone:</label>
		<input type='text' id='contact-emergencyphone' class='contact-input' name='emergencyphone' tabindex='1009' maxlength='20' value='<?=$userRecord['emergencyphone']?>' />
		<br /><label>&nbsp;</label>
			
		</div>	
			<span class='nextprev'>
			<button type='button' class='contact-back contact-button' tabindex='1010' onClick="showPrevDiv()">Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='button' class='contact-create contact-button' tabindex='1011' onClick="showNextDiv()">Next</button>
			</span>

			<br/>
			
	</div>
	<div class='contact-content1' id='s3' style='display:none;'>
	<h1 class='contact-title1'>Contact Data:</h1>
	<div class='contact-message' style='display:none;'></div>
<div class='contact-content2'>
			<label for='contact-contactdesignation'>*Designation:</label>
			<input type='text' id='contact-contactdesignation' class='contact-input' name='contactdesignation' tabindex='1001' maxlength='30' value='<?=$userRecord['contactdesignation']?>' />

			<label for='contact-companyname'>*Company/Organization Name:</label>
			<input type='text' id='contact-companyname' class='contact-input' name='companyname' tabindex='1002' maxlength='50' value='<?=$userRecord['companyname']?>' />
			<label for='contact-companyother'>Parent Company Name (If different from company name):</label>
			<input type='text' id='contact-companyother' class='contact-input' name='companyother' tabindex='1003' maxlength='50' value='<?=$userRecord['companyother']?>' /><br />
			<label for='contact-companyaddress'>*Organization Address:</label>
			<input type='text' id='contact-companyaddress' class='contact-input' name='companyaddress' tabindex='1004' maxlength='150' value='<?=$userRecord['companyaddress']?>' />
			<label for='contact-city'>*City:</label>

			<input type='text' id='contact-city' class='contact-input' name='city' tabindex='1005' maxlength='50' value='<?=$userRecord['city']?>' />
			<label for='contact-country'>*Country:</label>
			<select id='contact-country' class='contact-input' name='country' tabindex='1006'>
				<option value=''>--select country--</option>
				<?php  
					foreach($countrylist as $country)
						if($userRecord['country'] == $country['country_id'])
							echo "<option value='".$country['country_id']."' selected>".$country['countryname']."</option>";	
						else
							echo "<option value='".$country['country_id']."'>".$country['countryname']."</option>";	
				?>
			</select> 
			<br />

			<label for='contact-ctelephone'>*Telephone:</label>
			<input type='text' id='contact-ctelephone' class='contact-input' name='ctelephone' tabindex='1007' maxlength='20' value='<?=$userRecord['ctelephone']?>' />
			<label for='contact-cell'>Cell Number:</label>
			<input type='text' id='contact-cell' class='contact-input' name='cell' tabindex='1008' maxlength='20' value='<?=$userRecord['cell']?>' />
			<label for='contact-fax'>Fax Number:</label>
			<input type='text' id='contact-fax' class='contact-input' name='fax' tabindex='1009' maxlength='20' value='<?=$userRecord['fax']?>'/><br /><label>&nbsp;</label>
	</div>

			<span class='nextprev'>
			<button type='button' class='contact-back contact-button' tabindex='1010' onClick="showPrevDiv()">Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='button' class='contact-create contact-button' tabindex='1011' onClick="showNextDiv()">Next</button>
			</span>
			<br/>
			
	</div>
	<div class='contact-content1' id='s4' style='display:none;'>
	<h1 class='contact-title1'>Organizational Data:</h1>

	<div class='contact-message' style='display:none;'></div>
			<div class='contact-content2'>
			<label for='contact-parentservices'>Products/Services:</label>
				<textarea id='contact-parentservices' class='contact-input' name='parentservices' tabindex='1001' maxlength='300' onkeyup='return ismaxlength(this)'><?=$userRecord['parentservices']?></textarea>
			<label for='contact-parentnumemployees'>No. of Employees:</label>
			<input type='text' id='contact-parentnumemployees' class='contact-input' name='parentnumemployees' tabindex='1002' maxlength='10' value='<?=$userRecord['parentnumemployees']?>' />
			
			<label for='contact-services'>*Products/Services:</label>

			<textarea id='contact-services' class='contact-input' name='services' tabindex='1003'> <?=$userRecord['services']?></textarea>
			
			<label for='contact-numemployees'>*No. of Employees:</label>
			<input type='text' id='contact-numemployees' class='contact-input' name='numemployees' tabindex='1004' maxlength='10' value='<?=$userRecord['numemployees']?>' />

			<label for='contact-numemployeessupervision'>*How many employees are under your supervision?:</label>
			<input type='text' id='contact-numemployeessupervision' class='contact-input' name='numemployeessupervision' tabindex='1005' maxlength='10'  value='<?=$userRecord['numemployeessupervision']?>' />
			<label for='contact-reportperson'>*What is the title position of the person to whom you report?:</label>

			<input type='text' id='contact-reportperson' class='contact-input' name='reportperson' tabindex='1006' maxlength='30' value='<?=$userRecord['reportperson']?>' />

			<label for='contact-industry'>*Please select your current industry:</label>
			<select name='industry' class='contact-input' tabindex='1007' id='contact-industry'>
				<option value='Software/Hardware' <? if ($userRecord['industry'] == 'Software/Hardware') echo 'selected'; ?>>Software/Hardware</option>
				<option value='Textile' <? if ($userRecord['industry'] == 'Textile') echo 'selected'; ?>>Textile</option>
				<option value='Oil and Gas' <? if ($userRecord['industry'] == 'Oil and Gas') echo 'selected'; ?>>Oil and Gas</option>

				<option value='Carpet' <? if ($userRecord['industry'] == 'Carpet') echo 'selected'; ?>>Carpet</option>
				<option value='Accounting' <? if ($userRecord['industry'] == 'Accounting') echo 'selected'; ?>>Accounting</option>
				<option value='Advocacy/Legal' <? if ($userRecord['industry'] == 'Advocacy/Legal') echo 'selected'; ?>>Advocacy/Legal</option>
				<option value='Advertising/Media' <? if ($userRecord['industry'] == 'Advertising/Media') echo 'selected'; ?>>Advertising/Media</option>
				<option value='Armed Forces' <? if ($userRecord['industry'] == 'Armed Forces') echo 'selected'; ?>>Armed Forces</option>
				<option value='Banking /Financial Services' <? if ($userRecord['industry'] == 'Banking /Financial Services') echo 'selected'; ?>>Banking /Financial Services</option>

				<option value='Computer Related Services' <? if ($userRecord['industry'] == 'Computer Related Services') echo 'selected'; ?>>Computer Related Services</option>
				<option value='Construction' <? if ($userRecord['industry'] == 'Construction') echo 'selected'; ?>>Construction</option>
				<option value='Consultancy' <? if ($userRecord['industry'] == 'Consultancy') echo 'selected'; ?>>Consultancy</option>
				<option value='Education' <? if ($userRecord['industry'] == 'Education') echo 'selected'; ?>>Education</option>
				<option value='Engineering' <? if ($userRecord['industry'] == 'Engineering') echo 'selected'; ?>>Engineering</option>
				<option value='Entertainment/Leisure' <? if ($userRecord['industry'] == 'Entertainment/Leisure') echo 'selected'; ?>>Entertainment/Leisure</option>

				<option value='Foundation' <? if ($userRecord['industry'] == 'Foundation') echo 'selected'; ?>>Foundation</option>
				<option value='Government' <? if ($userRecord['industry'] == 'Government') echo 'selected'; ?>>Government</option>
				<option value='Health Services' <? if ($userRecord['industry'] == 'Health Services') echo 'selected'; ?>>Health Services</option>
				<option value='Hotels/Restaurants' <? if ($userRecord['industry'] == 'Hotels/Restaurants') echo 'selected'; ?>>Hotels/Restaurants</option>
				<option value='Insurance' <? if ($userRecord['industry'] == 'Insurance') echo 'selected'; ?>>Insurance</option>
				<option value='NGO' <? if ($userRecord['industry'] == 'NGO') echo 'selected'; ?>>NGO</option>

				<option value='Printing & Packaging' <? if ($userRecord['industry'] == 'Printing & Packaging') echo 'selected'; ?>>Printing & Packaging</option>
				<option value='Publishing' <? if ($userRecord['industry'] == 'Publishing') echo 'selected'; ?>>Publishing</option>
				<option value='Real Estate' <? if ($userRecord['industry'] == 'Real Estate') echo 'selected'; ?>>Real Estate</option>
				<option value='Retailing/Wholesaling' <? if ($userRecord['industry'] == 'Retailing/Wholesaling') echo 'selected'; ?>>Retailing/Wholesaling</option>
				<option value='Social Services' <? if ($userRecord['industry'] == 'Social Services') echo 'selected'; ?>>Social Services</option>
				<option value='Telecommunication' <? if ($userRecord['industry'] == 'Telecommunication') echo 'selected'; ?>>Telecommunication</option>

				<option value='Trading' <? if ($userRecord['industry'] == 'Trading') echo 'selected'; ?>>Trading</option>
				<option value='Transportation' <? if ($userRecord['industry'] == 'Transportation') echo 'selected'; ?>>Transportation</option>
				<option value='Utilities' <? if ($userRecord['industry'] == 'Utilities') echo 'selected'; ?>>Utilities</option>
				<option value='' <? if ($userRecord['industry'] == '') echo 'selected'; ?>>other</option>			
			</select>
			<label for='contact-industryother'>Specify Other:</label>
			<input type='text' id='contact-industryother' class='contact-input' name='industryother' tabindex='1008' maxlength='30' value='<?=$userRecord['industryother']?>' />

			<label for='contact-position'>*What function best describes your position:</label>
			<select name='position' class='contact-input' tabindex='1009' id='contact-position'>
				<option value='Accounting'<? if($userRecord['position'] == 'Accounting') echo 'selected'; ?>>Accounting</option>
				<option value='Audit/Control'<? if($userRecord['position'] == 'Audit/Control') echo 'selected'; ?>>Audit/Control</option>
				<option value='Administration'<? if($userRecord['position'] == 'Administration') echo 'selected'; ?>>Administration</option>
				<option value='Customer Services'<? if($userRecord['position'] == 'Customer Services') echo 'selected'; ?>>Customer Services</option>

				<option value='Engineering'<? if($userRecord['position'] == 'Engineering') echo 'selected'; ?>>Engineering</option>
				<option value='Finance'<? if($userRecord['position'] == 'Finance') echo 'selected'; ?>>Finance</option>
				<option value='Fund Raising'<? if($userRecord['position'] == 'Fund Raising') echo 'selected'; ?>>Fund Raising</option>
				<option value='General Management'<? if($userRecord['position'] == 'General Management') echo 'selected'; ?>>General Management</option>
				<option value='Legal'<? if($userRecord['position'] == 'Legal') echo 'selected'; ?>>Legal</option>
				<option value='Human Resource/Personnel'<? if($userRecord['position'] == 'Human Resource/Personnel') echo 'selected'; ?>>Human Resource/Personnel</option>

				<option value='Logistics'<? if($userRecord['position'] == 'Logistics') echo 'selected'; ?>>Logistics</option>
				<option value='Manufacturing/Operations'<? if($userRecord['position'] == 'Manufacturing/Operations') echo 'selected'; ?>>Manufacturing/Operations</option>
				<option value='MIS/IT'<? if($userRecord['position'] == 'MIS/IT') echo 'selected'; ?>>MIS/IT</option>
				<option value='Marketing'<? if($userRecord['position'] == 'Marketing') echo 'selected'; ?>>Marketing</option>
				<option value='Planning'<? if($userRecord['position'] == 'Planning') echo 'selected'; ?>>Planning</option>
				<option value='Product Development'<? if($userRecord['position'] == 'Product Development') echo 'selected'; ?>>Product Development</option>

				<option value='Project Management'<? if($userRecord['position'] == 'Project Management') echo 'selected'; ?>>Project Management</option>
				<option value='Public Relations'<? if($userRecord['position'] == 'Public Relations') echo 'selected'; ?>>Public Relations</option>
				<option value='Procurement'<? if($userRecord['position'] == 'Procurement') echo 'selected'; ?>>Procurement</option>
				<option value='Research & Development'<? if($userRecord['position'] == 'Research & Development') echo 'selected'; ?>>Research & Development</option>
				<option value='Sales'<? if($userRecord['position'] == 'Sales') echo 'selected'; ?>>Sales</option>
				<option value='Teaching/Training'<? if($userRecord['position'] == 'Teaching/Training') echo 'selected'; ?>>Teaching/Training</option>

				<option value=''<? if($userRecord['position'] == '') echo 'selected'; ?>>other</option>
			</select>
			<label for='contact-positionother'>Specify Other:</label>
			<input type='text' id='contact-positionother' class='contact-input' name='positionother' tabindex='1010' maxlength='30' value='<?=$userRecord['positionother']?>' /><br /><label>&nbsp;</label></div>
			<span class='nextprev'>
			<button type='button' class='contact-back contact-button' tabindex='1011' onClick="showPrevDiv()">Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='button' class='contact-create contact-button' tabindex='1012' onClick="showNextDiv()">Next</button>

			</span>
			<br/>
			
	</div>
	<div class='contact-content1' id='s5' style='display:none;'>
	<h1 class='contact-title1'>Professional Data:</h1>
	<div class='contact-message' style='display:none;'></div>
			<div class='contact-content2'>
			<span> Please list your last three positions in reverse chronological order starting with your current one. If all are in the same company, please give the major promotional sequence.</span>

			<br />		
			<label for='contact-company1'>*Name of Company:</label>
			<input type='text' id='contact-company1' class='contact-input' name='company1' tabindex='1001' maxlength='30' value='<?=$userRecord['company1']?>' />
			<label for='contact-position1'>*Title / Position:</label>
			<input type='text' id='contact-position1' class='contact-input' name='position1' tabindex='1002' maxlength='30' value='<?=$userRecord['position1']?>' />
			<label for='contact-from1'>*Start Date:</label>
			<input type='text' id='contact-from1' class='contact-input' name='from1' tabindex='1003' maxlength='30' value='<?=$userRecord['from1']?>' />
			<label for='contact-to1'>*End Date:</label>

			<input type='text' id='contact-to1' class='contact-input' name='to1' tabindex='1004' maxlength='30' value='<?=$userRecord['to1']?>' />

			<label for='contact-company2'>Name of Company:</label>
			<input type='text' id='contact-company2' class='contact-input' name='company2' tabindex='1005' maxlength='30' value='<?=$userRecord['company2']?>' />
			<label for='contact-position2'>Title / Position:</label>
			<input type='text' id='contact-position2' class='contact-input' name='position2' tabindex='1006' maxlength='30' value='<?=$userRecord['position2']?>' />
			<label for='contact-from2'>Start Date:</label>
			<input type='text' id='contact-from2' class='contact-input' name='from2' tabindex='1007' maxlength='30' value='<?=$userRecord['from2']?>' />

			<label for='contact-to2'>End Date:</label>
			<input type='text' id='contact-to2' class='contact-input' name='to2' tabindex='1008' maxlength='30' value='<?=$userRecord['to2']?>' />

			<label for='contact-company3'>Name of Company:</label>
			<input type='text' id='contact-company3' class='contact-input' name='company3' tabindex='1009' maxlength='30' value='<?=$userRecord['company3']?>' />
			<label for='contact-position3'>Title / Position:</label>
			<input type='text' id='contact-position3' class='contact-input' name='position3' tabindex='1010' maxlength='30' value='<?=$userRecord['position3']?>' />
			<label for='contact-from3'>Start Date:</label>

			<input type='text' id='contact-from3' class='contact-input' name='from3' tabindex='1011' maxlength='30' value='<?=$userRecord['from3']?>' />
			<label for='contact-to3'>End Date:</label>
			<input type='text' id='contact-to3' class='contact-input' name='to3' tabindex='1012' maxlength='30' value='<?=$userRecord['to3']?>' />
			<label for='contact-numyearsexp'>*Please estimate total number of years of professional experience:</label>
			<input type='text' id='contact-numyearsexp' class='contact-input' name='numyearsexp' tabindex='1013' maxlength='5' value='<?=$userRecord['numyearsexp']?>' />
			<label for='contact-responsibility'>*Please describe your current responsibilities including your level in the organization:</label>
			<textarea id='contact-responsibility' class='contact-input' name='responsibility' tabindex='1014'  maxlength='300' onkeyup='return ismaxlength(this)'> <?=$userRecord['responsibility']?></textarea>

			<br />
			<span style='padding-left:10px;'>Education</span><br />
			<label for='contact-university'>*University:</label>
			<input type='text' id='contact-university' class='contact-input' name='university' tabindex='1015' maxlength='50' value='<?=$userRecord['university']?>' />
			<label for='contact-year'>*Year:</label>
			<input type='text' id='contact-year' class='contact-input' name='year' tabindex='1016' maxlength='5' value='<?=$userRecord['year']?>' />
			<label for='contact-degree'>*Degree (Highest level attended):</label>

			<input type='text' id='contact-degree' class='contact-input' name='degree' tabindex='1017' maxlength='30' value='<?=$userRecord['degree']?>' />
			<br />
			<span style='padding-left:10px;'>Objectives</span><br />
			<span>*What are your objectives of attending this programme? What do you expect to achieve by the end of this programme:</span><br />
			<label for='contact-objectives'></label>
			<textarea id='contact-objectives' class='contact-input' name='objectives' tabindex='1018' maxlength='300' onkeyup='return ismaxlength(this)' > <?=$userRecord['objectives']?></textarea>
		<br /><label>&nbsp;</label></div>

			<span class='nextprev'>
			<button type='button' class='contact-back contact-button' tabindex='1019' onClick="showPrevDiv()">Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='button' class='contact-create contact-button' tabindex='1020' onClick="showNextDiv()">Next</button>
			</span>
			<br/>
		
	</div>
	<div class='contact-content1' id='s6' style='display:none;'>
	<h1 class='contact-title1'>Sponsorship and Invoicing:</h1>

	<div class='contact-message' style='display:none;'></div>
		<div class='contact-content2'>
		<span style='padding-left:10px;'>I have read and accepted all policies written in the brochure. I understand that upon completion and receipt of invoice, the organisation will become liable for all charges including cancellation and transfer charges, if applicable.</span>
			
			<label for='contact-name'>*Name:</label>
			<input type='text' id='contact-name' class='contact-input' name='name' tabindex='1001' maxlength='30' value='<?=$userRecord['name']?>' />
			<label for='contact-designation'>Designation:</label>
			<input type='text' id='contact-designation' class='contact-input' name='designation' tabindex='1002' maxlength='30' value='<?=$userRecord['designation']?>' />

			<label for='contact-address'>*Address:</label>
			<textarea maxlength='150' id='contact-address' class='contact-input' name='address' tabindex='1003' onkeyup='return ismaxlength(this)'> <?=$userRecord['address']?></textarea>
			<label for='contact-telephone'>*Telephone:</label>
			<input type='text' id='contact-telephone' class='contact-input' name='telephone' tabindex='1004' maxlength='20' value='<?=$userRecord['telephone']?>' />
			<label for='contact-sponsorfax'>Fax:</label>
			<input type='text' id='contact-sponsorfax' class='contact-input' name='sponsorfax' tabindex='1005' maxlength='20' value='<?=$userRecord['sponsorfax']?>' />
			<label for='contact-email'>*Email:</label>

			<input type='text' id='contact-email' class='contact-input' name='email' tabindex='1006' maxlength='50' value='<?=$userRecord['email']?>' />
			<label for='contact-website'>Website:</label>
			<input type='text' id='contact-website' class='contact-input' name='website' tabindex='1007' maxlength='50' value='<?=$userRecord['website']?>' /><br />
		
			<span style='padding-left:10px;'>Name and address to which invoice should be sent (if different from above)</span><br />
		
			<label for='contact-invoicename'>Name:</label>
			<input type='text' id='contact-invoicename' class='contact-input' name='invoicename' tabindex='1008' maxlength='30' value='<?=$userRecord['invoicename']?>' />
			<label for='contact-invoicedesignation'>Designation:</label>

			<input type='text' id='contact-invoicedesignation' class='contact-input' name='invoicedesignation' tabindex='1009' maxlength='30' value='<?=$userRecord['invoicedesignation']?>' />
			<label for='contact-invoiceaddress'>*Address:</label>
			<textarea maxlength='150' id='contact-invoiceaddress' class='contact-input' name='invoiceaddress' tabindex='1010' onkeyup='return ismaxlength(this)'> <?=$userRecord['invoiceaddress']?></textarea>
			<label for='contact-invoicetelephone'>*Telephone:</label>
			<input type='text' id='contact-invoicetelephone' class='contact-input' name='invoicetelephone' tabindex='1011' maxlength='20' value='<?=$userRecord['invoicetelephone']?>' />
			<label for='contact-invoicefax'>Fax:</label>
			<input type='text' id='contact-invoicefax' class='contact-input' name='invoicefax' tabindex='1012' maxlength='20' value='<?=$userRecord['invoicefax']?>' />

			<label for='contact-invoiceemail'>*Email:</label>
			<input type='text' id='contact-invoiceemail' class='contact-input' name='invoiceemail' tabindex='1013' maxlength='50' value='<?=$userRecord['invoiceemail']?>' />
			<label for='contact-invoicewebsite'>Website:</label>
			<input type='text' id='contact-invoicewebsite' class='contact-input' name='invoicewebsite' tabindex='1014' maxlength='50' value='<?=$userRecord['invoicewebsite']?>' />
			<br />
		
			<span style='padding-left:10px;'>Executive Development (Person in charge of management development in your company)</span><br />
		
			<label for='contact-executivename'>Name:</label>

			<input type='text' id='contact-executivename' class='contact-input' name='executivename' tabindex='1015' maxlength='30' value='<?=$userRecord['executivename']?>' />
			<label for='contact-executivedesignation'>Designation:</label>
			<input type='text' id='contact-executivedesignation' class='contact-input' name='executivedesignation' tabindex='1016' maxlength='30' value='<?=$userRecord['executivedesignation']?>' />
			<label for='contact-executiveaddress'>*Address:</label>
			<textarea maxlength='150' id='contact-executiveaddress' class='contact-input' name='executiveaddress' tabindex='1017' onkeyup='return ismaxlength(this)'> <?=$userRecord['executiveaddress']?></textarea>
			<label for='contact-executivetelephone'>*Telephone:</label>
			<input type='text' id='contact-executivetelephone' class='contact-input' name='executivetelephone' tabindex='1018' maxlength='20' value='<?=$userRecord['executivetelephone']?>' />

			<label for='contact-executivefax'>Fax:</label>
			<input type='text' id='contact-executivefax' class='contact-input' name='executivefax' tabindex='1019' maxlength='20' value='<?=$userRecord['executivefax']?>' />
			<label for='contact-executiveemail'>*Email:</label>
			<input type='text' id='contact-executiveemail' class='contact-input' name='executiveemail' tabindex='1020' maxlength='50' value='<?=$userRecord['executiveemail']?>' />
			<label for='contact-executivewebsite'>Website:</label>
			<input type='text' id='contact-executivewebsite' class='contact-input' name='executivewebsite' tabindex='1021' maxlength='50' value='<?=$userRecord['executivewebsite']?>' />
			
			<label for='contact-informemail'>*Do you wish to be informed about our programmes via email on regular basis?:</label>

			<span style='float:left'>
			<input type='radio' name='informemail' value = 'male' checked='checked' tabindex='1022' class='class-input' /> No <br />
			<input type='radio' name='informemail' value = 'female' class='class-input'/> Yes
			</span>

<br /><label>&nbsp;</label></div>
			<span class='nextprev'>
			<button type='button' class='contact-back contact-button' tabindex='1023' onClick="showPrevDiv()">Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='button' class='contact-create contact-button' tabindex='1024' onClick="showNextDiv()">Next</button>
			</span>
			<br/>
		

	</div>
	<div class='contact-content1' id='s7' style='display:none;'>
	<h1 class='contact-title1'>Information Source:</h1>
	<div class='contact-message' style='display:none;'></div>
		
			<label for='contact-learnabout'>How did you learn about us?:</label>

			<select name='learnabout' class='contact-input' tabindex='1000'>
				<option value='' <? if ($userRecord['learnabout'] == '') echo 'selected';?>>--select--</option>
				<option value='Website' <? if ($userRecord['learnabout'] == 'Website') echo 'selected';?>>Website</option>
				<option value='Executive Alumni' <? if ($userRecord['learnabout'] == 'Executive Alumni') echo 'selected';?>>Executive Alumni</option>
				<option value='Annual Brochure' <? if ($userRecord['learnabout'] == 'Annual Brochure') echo 'selected';?>>Annual Brochure</option>
				<option value='Referred by HR Department at LUMS' <? if ($userRecord['learnabout'] == 'Referred by HR Department at LUMS') echo 'selected';?>>Referred by HR Department at LUMS</option>

				<option value='Referred by HR Department of My Organization' <? if ($userRecord['learnabout'] == '') echo 'selected';?>>Referred by HR Department of My Organization</option>
			</select>
			
			<label for='contact-oepprogrammes'>*OEP Programmes:</label>
			<select name='oepprogrammes' class='contact-input' id='contact-oepprogrammes' tabindex='1001'>
				<option value=''>--select--</option>
				<?php
					foreach($programmes as $prog)
						echo "<option value='".$prog['oepid']."'>".$prog['name']."</option>";
				?>	
			</select>

			

<br /><label>&nbsp;</label>
			<span>
			<button type='button' class='contact-back contact-button' tabindex='1006' onClick="showPrevDiv()">Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='button' class='contact-create contact-button' tabindex='1007' onClick="showNextDiv()">Submit</button>
			</span>
			<br/>
			
	</div>
	
	<div class='contact-content1' id='s8' style='display:none;'>

	<h1 class='contact-title1'>Congrates!</h1>
	<div class='contact-message1'></div>
		

<br /><label>&nbsp;</label>
			<button type='button' class='contact-cancel contact-button simplemodal-close' tabindex='1007'>Close</button>
			
			<br/>
	</div>
	</form>
	<div class='contact-bottom'></div>
</div>

	<script language="javascript">
		defaultDiv();
	</script>

</body>
</html>