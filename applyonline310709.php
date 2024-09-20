<?php
		session_start();
		session_register("userrecord"); 
		session_register("successlogin");
		session_register("userid"); 
	
		error_reporting(0);

// GLOBAL VARIABLE TO RETIAN THE USER RECORD IF ALREADY REGISTERED
	//global $userRecord;
	
	$userRecord = null;
	$class1 = "contact-content1";
	$class2 = "contact-content";
	$ifregistered = 1;
	$divname = 2;
	//$successLogin = 0;
	if(isset($_SESSION['userid']))
	{
		$userRecord = $_SESSION['userrecord'];
		$class1 = "contact-content1";
		$class2 = "contact-content";
		$ifregistered = 1;
		$divname = 2;
		//$successLogin = $_SESSION['successlogin'];
	}	

// DEFINES CONSTANTS FOR DB CONNECTION
	define('HOST', 'netraserver');
	define('USERNAME', 'root');
	define('PASSWORD', 'admin');
	define('DATABASE', 'redc_db');

// INCLUDE FILES
	include_once('../classlibrary/db.php');
	//include_once('../classlibrary/configuration.php');
	include_once('../libs/applyonline.lib.php');

// OBJECT OF CLASS APPLYONLINE
	$applyonline = new ApplyOnline;

// POPULATE EXISTING RECORD IN FORM FIELDS IF USER ALREADY REGISTERED

// GET COUNTRIES LIST
	$countrylist = $applyonline->getCountries();

// GET ACTIVE PROGRAMMES LIST
	$programmes  = $applyonline->getProgrammes(); 


// User settings
$to = "user@yourdomain.com";
$subject = "SimpleModal Contact Form";

// Include extra form fields and/or submitter data?
// false = do not include
$extra = array(
	"form_subject"	=> true,
	"form_cc"		=> true,
	"ip"			=> true,
	"user_agent"	=> true
);

// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the contact form HTML
	$output = "<div style='display:none;' class='wraper'>
	<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>
	
		<div class='steps'>
        	<ul>
            	<li>
                	<p class='sharp'>Personal Data</p><img src='images/applyonline/1.gif' />
                </li>
                <li>
                	<p>Contact Data</p><img src='images/applyonline/2_trans.gif' />
                </li>
                <li>
                	<p>Organizational Data</p><img src='images/applyonline/3_trans.gif' />
                </li>
                <li>
                	<p>Professional Data</p><img src='images/applyonline/4_trans.gif' />
                </li>
                <li>
                	<p>Sponsorship and Invocing</p><img src='images/applyonline/5_trans.gif' />
                </li>
                <li>
                	<p>Information Source</p><img src='images/applyonline/6_trans.gif' />
                </li>
            </ul>
        </div>

	<input type='hidden' name='divname' value='".$divname."' id='contact-divname'/>
	<input type='hidden' name='ifregistered' value='".$ifregistered."' id='contact-ifregistered'/>

	<div class='forms'>

	<form action='#' style='display:block;' >
	<div class='forminputs'>
	<div class='".$class1."' id='s1' style='display:none;'>
	<h2 class='contact-title'>Create Account:</h2>
	<div class='contact-loading' style='display:none;'></div>
	<div class='contact-message' style='display:none;'></div>
	<div style='height:30px;'></div>
			<ul>
            	<li class='txt'>*Email (user name):</li>
                <li>
					<input type='text' id='contact-username' name='username' tabindex='1001' maxlength='30' class='bluebar' />
				</li>
            </ul>
			<ul>
				<li class='txt'>*Password:</li>
				<li>
					<input type='password' id='contact-password' class='bluebar' name='password' maxlength='30' tabindex='1002' />
				</li>	
			</ul>
			<ul>
				<li class='txt'>*Confirm Password:</li>
				<li>
					<input type='password' id='contact-confpassword' class='bluebar' name='confpassword' maxlength='30' tabindex='1003' />
				</li>	
			</ul>

			<ul>
				<li style='width:290px;'>&nbsp;</li>
				<li>
					<button type='submit' class='next contact-check contact-button' tabindex='1004'>Save &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
				</li>	
			
			</ul>
			<br/>
		
			<div style='height:10px; cursor:pointer; padding-top:5px;' align='center' class='contact-login'>Already registered, click here to login.</div>
			
	
	</div>
	<div class='contact-content1' id='login' style='display:none;'>
	<h2 class='contact-title'>Login:</h2>
	<div class='contact-loading' style='display:none;'></div>
	<div class='contact-message' style='display:none;'></div>
	
		<label for='contact-loginusername'>*Email (user name):</label>
			<input type='text' id='contact-loginusername' class='contact-input' name='loginusername' tabindex='1001' maxlength='30' />
			<label for='contact-loginpassword'>*Password:</label>
			<input type='password' id='contact-loginpassword' class='contact-input' name='loginpassword' maxlength='30' tabindex='1002' />
			<br />";
			
	$output .= "<label>&nbsp;</label>
			<span>
			<button type='button' class='contact-checklogin contact-button' tabindex='1003'>Login</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='submit' class='contact-cancel contact-button simplemodal-close' tabindex='1004'>Cancel</button>
			</span>
			<br/>
			
	
	</div>
	<div class='".$class2."' id='s2' style='display:none;'>
	<h2 class='contact-title1'>Personal Data:</h2>
	<div class='contact-message' style='display:none;'></div>
		<div class='contact-content2'>
			<label for='contact-firstname'>*First Name:</label>
		<input type='text' id='contact-firstname' class='contact-input' name='firstname' maxlength='30' tabindex='1001' value='".$userRecord["firstname"]."' />
		<label for='contact-password'>Middle Name:</label>
		<input type='text' id='contact-middlename' class='contact-input' name='middlename' maxlength='30' tabindex='1002' value='".$userRecord["middlename"]."' />
		<label for='contact-confpassword'>*Last Name:</label>
		<input type='text' id='contact-lastname' class='contact-input' name='lastname' maxlength='30' tabindex='1003' value='".$userRecord["lastname"]."' />
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
		<input type='text' id='contact-nationality' class='contact-input' name='nationality' maxlength='50' tabindex='1006' />
		<label for='contact-busemail'>*Business Email:</label>
		<input type='text' id='contact-busemail' class='contact-input' name='busemail' tabindex='1007' maxlength='50' />
		<br />
			<span style='padding-left:10px;'>In case of emergency, please notify</span>
		<br />
		<label for='contact-emergencyname'>*Name:</label>
		<input type='text' id='contact-emergencyname' class='contact-input' name='emergencyname' tabindex='1008' maxlength='50' />
		<label for='contact-emergencyphone'>*Telephone:</label>
		<input type='text' id='contact-emergencyphone' class='contact-input' name='emergencyphone' tabindex='1009' maxlength='20' />
		<br />";
			
	$output .= "<label>&nbsp;</label>
			
		</div>	
			<span class='nextprev'>
			<button type='button' class='contact-back contact-button' tabindex='1010'>Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='button' class='contact-create contact-button' tabindex='1011'>Next</button>
			</span>
			<br/>
			
	</div>
	<div class='contact-content1' id='s3' style='display:none;'>
	<h1 class='contact-title1'>Contact Data:</h1>
	<div class='contact-message' style='display:none;'></div>
<div class='contact-content2'>
			<label for='contact-contactdesignation'>*Designation:</label>
			<input type='text' id='contact-contactdesignation' class='contact-input' name='contactdesignation' tabindex='1001' maxlength='30' />
			<label for='contact-companyname'>*Company/Organization Name:</label>
			<input type='text' id='contact-companyname' class='contact-input' name='companyname' tabindex='1002' maxlength='50' />
			<label for='contact-companyother'>Parent Company Name (If different from company name):</label>
			<input type='text' id='contact-companyother' class='contact-input' name='companyother' tabindex='1003' maxlength='50' /><br />
			<label for='contact-companyaddress'>*Organization Address:</label>
			<input type='text' id='contact-companyaddress' class='contact-input' name='companyaddress' tabindex='1004' maxlength='150' />
			<label for='contact-city'>*City:</label>
			<input type='text' id='contact-city' class='contact-input' name='city' tabindex='1005' maxlength='50' />
			<label for='contact-country'>*Country:</label>
			<select id='contact-country' class='contact-input' name='country' tabindex='1006'><option value=''>--select country--</option>";
				
				foreach($countrylist as $country)
				$output .= "<option value='".$country['country_id']."'>".$country['countryname']."</option>";
				
			$output .= "</select> <br />
			<label for='contact-ctelephone'>*Telephone:</label>
			<input type='text' id='contact-ctelephone' class='contact-input' name='ctelephone' tabindex='1007' maxlength='20' />
			<label for='contact-cell'>Cell Number:</label>
			<input type='text' id='contact-cell' class='contact-input' name='cell' tabindex='1008' maxlength='20' />
			<label for='contact-fax'>Fax Number:</label>
			<input type='text' id='contact-fax' class='contact-input' name='fax' tabindex='1009' maxlength='20'/><br />";
	
	$output .= "<label>&nbsp;</label>
	</div>
			<span class='nextprev'>
			<button type='button' class='contact-back contact-button' tabindex='1010'>Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='submit' class='contact-create contact-button' tabindex='1011'>Next</button>
			</span>
			<br/>
			
	</div>
	<div class='contact-content1' id='s4' style='display:none;'>
	<h1 class='contact-title1'>Organizational Data:</h1>
	<div class='contact-message' style='display:none;'></div>
			<div class='contact-content2'>
			<label for='contact-parentservices'>Products/Services:</label>
				<textarea id='contact-parentservices' class='contact-input' name='parentservices' tabindex='1001' maxlength='300' onkeyup='return ismaxlength(this)'></textarea>
			<label for='contact-parentnumemployees'>No. of Employees:</label>
			<input type='text' id='contact-parentnumemployees' class='contact-input' name='parentnumemployees' tabindex='1002' maxlength='10' />
			
			<label for='contact-services'>*Products/Services:</label>
			<textarea id='contact-services' class='contact-input' name='services' tabindex='1003'></textarea>
			
			<label for='contact-numemployees'>*No. of Employees:</label>
			<input type='text' id='contact-numemployees' class='contact-input' name='numemployees' tabindex='1004' maxlength='10' />

			<label for='contact-numemployeessupervision'>*How many employees are under your supervision?:</label>
			<input type='text' id='contact-numemployeessupervision' class='contact-input' name='numemployeessupervision' tabindex='1005' maxlength='10' />
			<label for='contact-reportperson'>*What is the title position of the person to whom you report?:</label>
			<input type='text' id='contact-reportperson' class='contact-input' name='reportperson' tabindex='1006' maxlength='30' />

			<label for='contact-industry'>*Please select your current industry:</label>
			<select name='industry' class='contact-input' tabindex='1007' id='contact-industry'>
				<option value='Software/Hardware'>Software/Hardware</option>
				<option value='Textile'>Textile</option>
				<option value='Oil and Gas'>Oil and Gas</option>
				<option value='Carpet'>Carpet</option>
				<option value='Accounting'>Accounting</option>
				<option value='Advocacy/Legal'>Advocacy/Legal</option>
				<option value='Advertising/Media'>Advertising/Media</option>
				<option value='Armed Forces'>Armed Forces</option>
				<option value='Banking /Financial Services'>Banking /Financial Services</option>
				<option value='Computer Related Services'>Computer Related Services</option>
				<option value='Construction'>Construction</option>
				<option value='Consultancy'>Consultancy</option>
				<option value='Education'>Education</option>
				<option value='Engineering'>Engineering</option>
				<option value='Entertainment/Leisure'>Entertainment/Leisure</option>
				<option value='Foundation'>Foundation</option>
				<option value='Government'>Government</option>
				<option value='Health Services'>Health Services</option>
				<option value='Hotels/Restaurants'>Hotels/Restaurants</option>
				<option value='Insurance'Insurance</option>
				<option value='NGO'>NGO</option>
				<option value='Printing & Packaging'>Printing & Packaging</option>
				<option value='Publishing'>Publishing</option>
				<option value='Real Estate'>Real Estate</option>
				<option value='Retailing/Wholesaling'>Retailing/Wholesaling</option>
				<option value='Social Services'>Social Services</option>
				<option value='Telecommunication'>Telecommunication</option>
				<option value='Trading'>Trading</option>
				<option value='Transportation'>Transportation</option>
				<option value='Utilities'>Utilities</option>
				<option value=''>other</option>			
			</select>
			<label for='contact-industryother'>Specify Other:</label>
			<input type='text' id='contact-industryother' class='contact-input' name='industryother' tabindex='1008' maxlength='30' />

			<label for='contact-position'>*What function best describes your position:</label>
			<select name='position' class='contact-input' tabindex='1009' id='contact-position'>
				<option value='Accounting'>Accounting</option>
				<option value='Audit/Control'>Audit/Control</option>
				<option value='Administration'>Administration</option>
				<option value='Customer Services'>Customer Services</option>
				<option value='Engineering'>Engineering</option>
				<option value='Finance'>Finance</option>
				<option value='Fund Raising'>Fund Raising</option>
				<option value='General Management'>General Management</option>
				<option value='Legal'>Legal</option>
				<option value='Human Resource/Personnel'>Human Resource/Personnel</option>
				<option value='Logistics'>Logistics</option>
				<option value='Manufacturing/Operations'>Manufacturing/Operations</option>
				<option value='MIS/IT'>MIS/IT</option>
				<option value='Marketing'>Marketing</option>
				<option value='Planning'>Planning</option>
				<option value='Product Development'>Product Development</option>
				<option value='Project Management'>Project Management</option>
				<option value='Public Relations'>Public Relations</option>
				<option value='Procurement'>Procurement</option>
				<option value='Research & Development'>Research & Development</option>
				<option value='Sales'>Sales</option>
				<option value='Teaching/Training'>Teaching/Training</option>
				<option value=''>other</option>
			</select>
			<label for='contact-positionother'>Specify Other:</label>
			<input type='text' id='contact-positionother' class='contact-input' name='positionother' tabindex='1010' maxlength='30' /><br />";
			
	$output .= "<label>&nbsp;</label></div>
			<span class='nextprev'>
			<button type='button' class='contact-back contact-button' tabindex='1011'>Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='submit' class='contact-create contact-button' tabindex='1012'>Next</button>
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
			<input type='text' id='contact-company1' class='contact-input' name='company1' tabindex='1001' maxlength='30' />
			<label for='contact-position1'>*Title / Position:</label>
			<input type='text' id='contact-position1' class='contact-input' name='position1' tabindex='1002' maxlength='30' />
			<label for='contact-from1'>*Start Date:</label>
			<input type='text' id='contact-from1' class='contact-input' name='from1' tabindex='1003' maxlength='30' />
			<label for='contact-to1'>*End Date:</label>
			<input type='text' id='contact-to1' class='contact-input' name='to1' tabindex='1004' maxlength='30' />

			<label for='contact-company2'>Name of Company:</label>
			<input type='text' id='contact-company2' class='contact-input' name='company2' tabindex='1005' maxlength='30' />
			<label for='contact-position2'>Title / Position:</label>
			<input type='text' id='contact-position2' class='contact-input' name='position2' tabindex='1006' maxlength='30' />
			<label for='contact-from2'>Start Date:</label>
			<input type='text' id='contact-from2' class='contact-input' name='from2' tabindex='1007' maxlength='30' />
			<label for='contact-to2'>End Date:</label>
			<input type='text' id='contact-to2' class='contact-input' name='to2' tabindex='1008' maxlength='30' />

			<label for='contact-company3'>Name of Company:</label>
			<input type='text' id='contact-company3' class='contact-input' name='company3' tabindex='1009' maxlength='30' />
			<label for='contact-position3'>Title / Position:</label>
			<input type='text' id='contact-position3' class='contact-input' name='position3' tabindex='1010' maxlength='30' />
			<label for='contact-from3'>Start Date:</label>
			<input type='text' id='contact-from3' class='contact-input' name='from3' tabindex='1011' maxlength='30' />
			<label for='contact-to3'>End Date:</label>
			<input type='text' id='contact-to3' class='contact-input' name='to3' tabindex='1012' maxlength='30' />
			<label for='contact-numyearsexp'>*Please estimate total number of years of professional experience:</label>
			<input type='text' id='contact-numyearsexp' class='contact-input' name='numyearsexp' tabindex='1013' maxlength='5' />
			<label for='contact-responsibility'>*Please describe your current responsibilities including your level in the organization:</label>
			<textarea id='contact-responsibility' class='contact-input' name='responsibility' tabindex='1014'  maxlength='300' onkeyup='return ismaxlength(this)'></textarea>
			<br />
			<span style='padding-left:10px;'>Education</span><br />
			<label for='contact-university'>*University:</label>
			<input type='text' id='contact-university' class='contact-input' name='university' tabindex='1015' maxlength='50' />
			<label for='contact-year'>*Year:</label>
			<input type='text' id='contact-year' class='contact-input' name='year' tabindex='1016' maxlength='5' />
			<label for='contact-degree'>*Degree (Highest level attended):</label>
			<input type='text' id='contact-degree' class='contact-input' name='degree' tabindex='1017' maxlength='30' />
			<br />
			<span style='padding-left:10px;'>Objectives</span><br />
			<span>*What are your objectives of attending this programme? What do you expect to achieve by the end of this programme:</span><br />
			<label for='contact-objectives'></label>
			<textarea id='contact-objectives' class='contact-input' name='objectives' tabindex='1018' maxlength='300' onkeyup='return ismaxlength(this)' ></textarea>
		<br />";
			
	$output .= "<label>&nbsp;</label></div>
			<span class='nextprev'>
			<button type='button' class='contact-back contact-button' tabindex='1019'>Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='submit' class='contact-create contact-button' tabindex='1020'>Next</button>
			</span>
			<br/>
		
	</div>
	<div class='contact-content1' id='s6' style='display:none;'>
	<h1 class='contact-title1'>Sponsorship and Invoicing:</h1>
	<div class='contact-message' style='display:none;'></div>
		<div class='contact-content2'>
		<span style='padding-left:10px;'>I have read and accepted all policies written in the brochure. I understand that upon completion and receipt of invoice, the organisation will become liable for all charges including cancellation and transfer charges, if applicable.</span>
			
			<label for='contact-name'>*Name:</label>
			<input type='text' id='contact-name' class='contact-input' name='name' tabindex='1001' maxlength='30' />
			<label for='contact-designation'>Designation:</label>
			<input type='text' id='contact-designation' class='contact-input' name='designation' tabindex='1002' maxlength='30' />
			<label for='contact-address'>*Address:</label>
			<textarea maxlength='150' id='contact-address' class='contact-input' name='address' tabindex='1003' onkeyup='return ismaxlength(this)'></textarea>
			<label for='contact-telephone'>*Telephone:</label>
			<input type='text' id='contact-telephone' class='contact-input' name='telephone' tabindex='1004' maxlength='20' />
			<label for='contact-sponsorfax'>Fax:</label>
			<input type='text' id='contact-sponsorfax' class='contact-input' name='sponsorfax' tabindex='1005' maxlength='20' />
			<label for='contact-email'>*Email:</label>
			<input type='text' id='contact-email' class='contact-input' name='email' tabindex='1006' maxlength='50' />
			<label for='contact-website'>Website:</label>
			<input type='text' id='contact-website' class='contact-input' name='website' tabindex='1007' maxlength='50' /><br />
		
			<span style='padding-left:10px;'>Name and address to which invoice should be sent (if different from above)</span><br />
		
			<label for='contact-invoicename'>Name:</label>
			<input type='text' id='contact-invoicename' class='contact-input' name='invoicename' tabindex='1008' maxlength='30' />
			<label for='contact-invoicedesignation'>Designation:</label>
			<input type='text' id='contact-invoicedesignation' class='contact-input' name='invoicedesignation' tabindex='1009' maxlength='30' />
			<label for='contact-invoiceaddress'>*Address:</label>
			<textarea maxlength='150' id='contact-invoiceaddress' class='contact-input' name='invoiceaddress' tabindex='1010' onkeyup='return ismaxlength(this)'></textarea>
			<label for='contact-invoicetelephone'>*Telephone:</label>
			<input type='text' id='contact-invoicetelephone' class='contact-input' name='invoicetelephone' tabindex='1011' maxlength='20' />
			<label for='contact-invoicefax'>Fax:</label>
			<input type='text' id='contact-invoicefax' class='contact-input' name='invoicefax' tabindex='1012' maxlength='20' />
			<label for='contact-invoiceemail'>*Email:</label>
			<input type='text' id='contact-invoiceemail' class='contact-input' name='invoiceemail' tabindex='1013' maxlength='50' />
			<label for='contact-invoicewebsite'>Website:</label>
			<input type='text' id='contact-invoicewebsite' class='contact-input' name='invoicewebsite' tabindex='1014' maxlength='50' />
			<br />
		
			<span style='padding-left:10px;'>Executive Development (Person in charge of management development in your company)</span><br />
		
			<label for='contact-executivename'>Name:</label>
			<input type='text' id='contact-executivename' class='contact-input' name='executivename' tabindex='1015' maxlength='30' />
			<label for='contact-executivedesignation'>Designation:</label>
			<input type='text' id='contact-executivedesignation' class='contact-input' name='executivedesignation' tabindex='1016' maxlength='30' />
			<label for='contact-executiveaddress'>*Address:</label>
			<textarea maxlength='150' id='contact-executiveaddress' class='contact-input' name='executiveaddress' tabindex='1017' onkeyup='return ismaxlength(this)'></textarea>
			<label for='contact-executivetelephone'>*Telephone:</label>
			<input type='text' id='contact-executivetelephone' class='contact-input' name='executivetelephone' tabindex='1018' maxlength='20' />
			<label for='contact-executivefax'>Fax:</label>
			<input type='text' id='contact-executivefax' class='contact-input' name='executivefax' tabindex='1019' maxlength='20' />
			<label for='contact-executiveemail'>*Email:</label>
			<input type='text' id='contact-executiveemail' class='contact-input' name='executiveemail' tabindex='1020' maxlength='50' />
			<label for='contact-executivewebsite'>Website:</label>
			<input type='text' id='contact-executivewebsite' class='contact-input' name='executivewebsite' tabindex='1021' maxlength='50' />
			
			<label for='contact-informemail'>*Do you wish to be informed about our programmes via email on regular basis?:</label>
			<span style='float:left'>
			<input type='radio' name='informemail' value = 'male' checked='checked' tabindex='1022' class='class-input' /> No <br />
			<input type='radio' name='informemail' value = 'female' class='class-input'/> Yes
			</span>

<br />";
			
	$output .= "<label>&nbsp;</label></div>
			<span class='nextprev'>
			<button type='button' class='contact-back contact-button' tabindex='1023' >Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='submit' class='contact-create contact-button' tabindex='1024'>Next</button>
			</span>
			<br/>
		

	</div>
	<div class='contact-content1' id='s7' style='display:none;'>
	<h1 class='contact-title1'>Information Source:</h1>
	<div class='contact-message' style='display:none;'></div>
		
			<label for='contact-learnabout'>How did you learn about us?:</label>
			<select name='learnabout' class='contact-input' tabindex='1000'>
				<option value=''>--select--</option>
				<option value='Website'>Website</option>
				<option value='Executive Alumni'>Executive Alumni</option>
				<option value='Annual Brochure'>Annual Brochure</option>
				<option value='Referred by HR Department at LUMS'>Referred by HR Department at LUMS</option>
				<option value='Referred by HR Department of My Organization'>Referred by HR Department of My Organization</option>
			</select>
			
			<label for='contact-oepprogrammes'>*OEP Programmes:</label>
			<input type='text' id='contact-oepprogrammes' class='contact-input' name='oepprogrammes' tabindex='1001' maxlength='50' />
			<select name='oepprogrammes1' class='contact-input' id='contact-oepprogrammes1' tabindex='1002'>
				<option value=''>--select--</option>";
				
				foreach($programmes as $prog)
				$output .= "<option value='".$prog['oepid']."'>".$prog['name']."</option>";
				
				
				
			$output .= "</select>
			

<br />";
			
	$output .= "<label>&nbsp;</label>
			<span>
			<button type='button' class='contact-back contact-button' tabindex='1006'>Prev</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='button' class='contact-create contact-button' tabindex='1007'>Submit</button>
			</span>
			<br/>
			
	</div>
	<div class='contact-content1' id='s8' style='display:none;'>
	<h1 class='contact-title1'>Congrates!</h1>
	<div class='contact-message1'></div>
		

<br />";
			
	$output .= "<label>&nbsp;</label>
			<button type='submit' class='contact-cancel contact-button simplemodal-close' tabindex='1007'>Close</button>
			
			<br/>
	</div>
	</div>
	</form>
	</div>
	<div class='contact-bottom'></div>
</div>";

//http://www.ericmmartin.com/projects/simplemodal/
	echo $output;
}
else if ($action == "send") {
	
	
	// Send the email
	$name = isset($_POST["name"]) ? $_POST["name"] : "";
	$email = isset($_POST["email"]) ? $_POST["email"] : "";
	$subject = isset($_POST["subject"]) ? $_POST["subject"] : $subject;
	$message = isset($_POST["message"]) ? $_POST["message"] : "";
	$cc = isset($_POST["cc"]) ? $_POST["cc"] : "";
	$token = isset($_POST["token"]) ? $_POST["token"] : "";

	// make sure the token matches
	if ($token === smcf_token($to)) {
		smcf_send($name, $email, $subject, $message, $cc);
		echo "Your message was successfully sent.";
	}
	else {
		echo "Unfortunately, your message could not be verified.";
		//echo "token value => ".$token."..... smcf_token value => ".smcf_token($to);
	}
}

else if ($action == "create")
{
	//echo "user has been created<br />";
	
	$divnum = isset($_POST["divnum"]) ? $_POST["divnum"] : "";
	if($divnum)
	{
		
		if(!isset($_SESSION['userRecord']))
		{
			if($applyonline->addEntry($_POST , $_SESSION['userid'])){
				echo "Congrates! your application has been submitted successfully.";
			}
			else
				echo "Error occured";
		}
		else
		{
			if($applyonline->updateEntry($_POST , $_SESSION['userid'])){
				echo "Congrates! your record has been updated successfully.";
			}
			else
				echo "Error occured";
			
		}
		//session_destroy();		
/*		echo "<pre>";
			print_r($_POST);
		echo "</pre>";
*/	}
	
	//echo "<button type='button' class='contact-create contact-button' tabindex='1026' onclick='toggleFunc(\"2\")'>Next</button><br />";
}
else if ($action == "check")
{
	//print_r($_POST);
	if(isset($_POST['username']) && smcf_validate_email($_POST['username']))
	{
		//$query = "SELECT username from redc_user where username = '".$_POST['username']."'";
		
		if($applyonline->alreadyExists($_POST['username']))
		{
			echo "0";
		}
		else
		{
			$id = $applyonline->createUser($_POST['username'] , $_POST['password']);
			$_SESSION['userid'] = $id;
			echo "1";
		}
	}
}

else if ($action == "checklogin")
{
	if(isset($_POST['loginusername']) && smcf_validate_email($_POST['loginusername']))
	{
		if($uid = $applyonline->validUser($_POST['loginusername'] , $_POST['loginpassword']))
		{
			// get record of already registered user
			$userRecord = $applyonline->editEntry($uid);
			
			//if(empty($_SESSION['userrecord']))
				$_SESSION['userrecord']   = $userRecord;
				
				$_SESSION['successlogin'] = 1;
				$_SESSION['userid'] = $uid;
			//print_r($userRecord);
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
}


/*function smcf_token($s) {
	return md5("smcf-" . $s . date("WY"));
}

// Validate and send email
function smcf_send($name, $email, $subject, $message, $cc) {
	global $to, $extra;

	// Filter and validate fields
	$name = smcf_filter($name);
	$subject = smcf_filter($subject);
	$email = smcf_filter($email);
	if (!smcf_validate_email($email)) {
		$subject .= " - invalid email";
		$message .= "\n\nBad email: $email";
		$email = $to;
		$cc = 0; // do not CC "sender"
	}

	// Add additional info to the message
	if ($extra["ip"]) {
		$message .= "\n\nIP: " . $_SERVER["REMOTE_ADDR"];
	}
	if ($extra["user_agent"]) {
		$message .= "\n\nUSER AGENT: " . $_SERVER["HTTP_USER_AGENT"];
	}

	// Set and wordwrap message body
	$body = "From: $name\n\n";
	$body .= "Message: $message";
	$body = wordwrap($body, 70);

	// Build header
	$headers = "From: $email\n";
	if ($cc == 1) {
		$headers .= "Cc: $email\n";
	}
	$headers .= "X-Mailer: PHP/SimpleModalContactForm";

	// UTF-8
	if (function_exists('mb_encode_mimeheader')) {
		$subject = mb_encode_mimeheader($subject, "UTF-8", "B", "\n");
	}
	else {
		// you need to enable mb_encode_mimeheader or risk 
		// getting emails that are not UTF-8 encoded
	}
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/plain; charset=utf-8\n";
	$headers .= "Content-Transfer-Encoding: quoted-printable\n";

	// Send email
	@mail($to, $subject, $body, $headers) or 
		die("Unfortunately, a server issue prevented delivery of your message.");
}

// Remove any un-safe values to prevent email injection
function smcf_filter($value) {
	$pattern = array("/\n/","/\r/","/content-type:/i","/to:/i", "/from:/i", "/cc:/i");
	$value = preg_replace($pattern, "", $value);
	return $value;
}*/

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