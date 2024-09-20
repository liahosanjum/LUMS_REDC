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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	<script src='js/jquery.js' type='text/javascript'></script>
	<!-- Contact Form JS and CSS files -->
	<script src='js/a1.js' type='text/javascript'></script>
	<link type='text/css' href='css/form.css' rel='stylesheet' media='screen' />	
</head>

<body>

    <div class="wraper">
		<div class="steps">
        	<ul>
            	<li>
                	<p class="sharp">Personal Data</p><img src="images/applyonline/1.gif" />
                </li>
                <li>
                	<p>Contact Data</p><img src="images/applyonline/2_trans.gif" />
                </li>
                <li>
                	<p>Organizational Data</p><img src="images/applyonline/3_trans.gif" />
                </li>
                <li>
                	<p>Professional Data</p><img src="images/applyonline/4_trans.gif" />
                </li>
                <li>
                	<p>Sponsorship and Invocing</p><img src="images/applyonline/5_trans.gif" />
                </li>
                <li>
                	<p>Information Source</p><img src="images/applyonline/6_trans.gif" />
                </li>
            </ul>
        </div>
		<div class="forms" id="login" style="display:none;">
			<h2>Login Form</h2>
            <div class="forminputs">
            <div id='contact-message' style='display:none;' align="center"></div>
			<ul>
            	<li class="txt">*Email (user name):</li>
                <li>
					<input type='text' id='contact-loginusername' class='contact-input' name='loginusername' tabindex='1001' maxlength='30' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Password:</li>
                <li>
					<input type='password' id='contact-loginpassword' class='contact-input' name='loginpassword' maxlength='30' tabindex='1002' />
				</li>
            </ul>
            <div class="clear"></div>
			<a href="#" class="next" onclick="ifValidLogin()">Next &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/applyonline/applyonline/next_bullet.gif" /></a>            
       	 	</div>
		</div>
		<div class="forms" id="s1" style="display:none;">
			<h2>Create Account</h2>
            <div class="forminputs">
            <div id='contact-message' style='display:none;' align="center"></div>
			<ul>
            	<li class="txt">Email (user name):</li>
                <li>
					<input type='text' id='contact-username' class='contact-input' name='username' tabindex='1001' maxlength='30' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Password:</li>
                <li>
					<input type='password' id='contact-password' class='contact-input' name='password' maxlength='30' tabindex='1002' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Confirm Password:</li>
                <li>
					<input type='password' id='contact-confpassword' class='contact-input' name='confpassword' maxlength='30' tabindex='1003' />
				</li>
            </ul>
			
            <div class="clear"></div>
			<a href="#" class="next" onclick="checkAvailability()">Next &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/applyonline/applyonline/next_bullet.gif" /></a>            
        	</div>
		</div>
        <div class="forms" id="s2" style="display:none;">
        	<input type='hidden' name='divname' value='1' id='contact-divname'/>
			<input type='hidden' name='ifregistered' value='<?=$successLogin?>' id='contact-ifregistered'/>
			<h2>Personal Data</h2>
            <div class="forminputs">
            <div id='contact-message' style='display:none;' align="center"></div>
			<ul>
            	<li class="txt">First Name:</li>
                <li>
					<input type='text' id='contact-firstname' class='bluebar' name='firstname' maxlength='30' tabindex='1001' value='<?=$userRecord['firstname']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Middle Name:</li>
                <li>
					<input type='text' id='contact-middlename' class='bluebar' name='middlename' maxlength='30' tabindex='1002' value='<?=$userRecord['middlename']?>' />
				</li>
            </ul>
          <ul>
            	<li class="txt">Last Name:</li>
                <li>
					<input type='text' id='contact-lastname' class='bluebar' name='lastname' maxlength='30' tabindex='1003' value='<?=$userRecord['lastname']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Prefix:</li>
                <li>
					<select id='contact-prefix' class='bluebar' name='prefix' tabindex='1004'>
			
						<option value='Mr.'>Mr.</option>
						<option value='Mrs.'>Mrs.</option>
						<option value='Miss'>Miss</option>
						<option value='Ms.'>Ms.</option>
						<option value='Dr.'>Dr.</option>
					</select>
                </li>
            </ul>
            <ul>
           	  <li class="txt">Gender:</li>
                <li>
               	  <input type='radio' name='gender' value = 'male' checked='checked' tabindex='1005' /> Male
                  <input type='radio' name='gender' value = 'female' /> Female
                </li>
          </ul>
            <ul>
       	    <li class="txt">Nationality:</li>
                <li>
					<input type='text' id='contact-nationality' class='bluebar' name='nationality' maxlength='50' tabindex='1006' value='<?=$userRecord['nationality']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Business Email:</li>
                <li>
					<input type='text' id='contact-busemail' class='bluebar' name='busemail' tabindex='1007' maxlength='50' value='<?=$userRecord['busemail']?>' />
				</li>
            </ul>
            <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <p>
            	In case of emergency, please notify
            </p>
              <ul>
       	    <li class="txt">Name:</li>
                <li>
					<input type='text' id='contact-emergencyname' class='bluebar' name='emergencyname' tabindex='1008' maxlength='50' value='<?=$userRecord['emergencyname']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Telephone:</li>
                <li>
					<input type='text' id='contact-emergencyphone' class='bluebar' name='emergencyphone' tabindex='1009' maxlength='20' value='<?=$userRecord['emergencyphone']?>' />
				</li>
            </ul>
          	<div class="clear"></div>
			<a href="#" class="next" onclick="showNextDiv()">Next &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/applyonline/applyonline/next_bullet.gif" /></a>            
        </div>
		<div class="forms" id="s3" style="display:none;">
        	<h2>Contact Data</h2>
            <div class="forminputs">
            <div id='contact-message' style='display:none;' align="center"></div>
			<ul>
            	<li class="txt">Designation:</li>
                <li>
					<input type='text' id='contact-contactdesignation' class='bluebar' name='contactdesignation' tabindex='1001' maxlength='30' value='<?=$userRecord['contactdesignation']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Company/Organization Name:</li>
                <li>
					<input type='text' id='contact-companyname' class='bluebar' name='companyname' tabindex='1002' maxlength='50' value='<?=$userRecord['companyname']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">Parent Company Name (If different from company name):</li>
                <li>
					<input type='text' id='contact-companyother' class='bluebar' name='companyother' tabindex='1003' maxlength='50' value='<?=$userRecord['companyother']?>' />
				</li>
            </ul>


          	<ul>
            	<li class="txt">Organization Address:</li>
                <li>
					<input type='text' id='contact-companyaddress' class='bluebar' name='companyaddress' tabindex='1004' maxlength='150' value='<?=$userRecord['companyaddress']?>' />
				</li>
            </ul>


          	<ul>
            	<li class="txt">City:</li>
                <li>
					<input type='text' id='contact-city' class='bluebar' name='city' tabindex='1005' maxlength='50' value='<?=$userRecord['city']?>' />
				</li>
            </ul>

            
			<ul>
            	<li class="txt">Country:</li>
                <li>
					<select id='contact-country' class='bluebar' name='country' tabindex='1006'>
						<option value=''>--select country--</option>
						<?php  
							foreach($countrylist as $country)
								if($userRecord['country'] == $country['country_id'])
									echo "<option value='".$country['country_id']."' selected>".$country['countryname']."</option>";	
								else
									echo "<option value='".$country['country_id']."'>".$country['countryname']."</option>";	
						?>
					</select> 
                </li>
            </ul>



          	<ul>
            	<li class="txt">Telephone:</li>
                <li>
					<input type='text' id='contact-ctelephone' class='bluebar' name='ctelephone' tabindex='1007' maxlength='20' value='<?=$userRecord['ctelephone']?>' />
				</li>
            </ul>

            <ul>
       	    <li class="txt">Cell Number:</li>
                <li>
					<input type='text' id='contact-cell' class='bluebar' name='cell' tabindex='1008' maxlength='20' value='<?=$userRecord['cell']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Fax Number:</li>
                <li>
					<input type='text' id='contact-fax' class='bluebar' name='fax' tabindex='1009' maxlength='20' value='<?=$userRecord['fax']?>'/>
				</li>
            </ul>
            <div class="clear"></div>
			<a href="#" class="next" onclick="showNextDiv()">Next &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/applyonline/applyonline/next_bullet.gif" /></a>            
        </div>
       
    </div>
		<div class="forms" id="s4" style="display:none;">
        	<h2>Organizational Data</h2>
            <div class="forminputs">
            <div id='contact-message' style='display:none;' align="center"></div>
			<ul>
            	<li class="txt">Products/Services:</li>
                <li>
					<textarea id='contact-parentservices' class='bluebar' name='parentservices' tabindex='1001' maxlength='300' onkeyup='return ismaxlength(this)'><?=$userRecord['parentservices']?></textarea>
				</li>
            </ul>
            <ul>
            	<li class="txt">No. of Employees:</li>
                <li>
					<input type='text' id='contact-parentnumemployees' class='bluebar' name='parentnumemployees' tabindex='1002' maxlength='10' value='<?=$userRecord['parentnumemployees']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">Products/Services:</li>
                <li>
					<textarea id='contact-services' class='bluebar' name='services' tabindex='1003'> <?=$userRecord['services']?></textarea>
				</li>
            </ul>


          	<ul>
            	<li class="txt">No. of Employees:</li>
                <li>
					<input type='text' id='contact-numemployees' class='bluebar' name='numemployees' tabindex='1004' maxlength='10' value='<?=$userRecord['numemployees']?>' />
				</li>
            </ul>


          	<ul>
            	<li class="txt">How many employees are under your supervision?:</li>
                <li>
					<input type='text' id='contact-numemployeessupervision' class='bluebar' name='numemployeessupervision' tabindex='1005' maxlength='10'  value='<?=$userRecord['numemployeessupervision']?>' />
				</li>
            </ul>

          	<ul>
            	<li class="txt">What is the title position of the person to whom you report?:</li>
                <li>
					<input type='text' id='contact-reportperson' class='bluebar' name='reportperson' tabindex='1006' maxlength='30' value='<?=$userRecord['reportperson']?>' />
				</li>
            </ul>


            
			<ul>
            	<li class="txt">Please select your current industry:</li>
                <li>
					<select name='industry' class='bluebar' tabindex='1007' id='contact-industry'>
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
			    </li>
            </ul>



          	<ul>
            	<li class="txt">Specify Other:</li>
                <li>
					<input type='text' id='contact-industryother' class='bluebar' name='industryother' tabindex='1008' maxlength='30' value='<?=$userRecord['industryother']?>' />
				</li>
            </ul>

            <ul>
       	    <li class="txt">What function best describes your position:</li>
                <li>
					<select name='position' class='bluebar' tabindex='1009' id='contact-position'>
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
				</li>
            </ul>
            <ul>
            	<li class="txt">Specify Other:</li>
                <li>
					<input type='text' id='contact-positionother' class='bluebar' name='positionother' tabindex='1010' maxlength='30' value='<?=$userRecord['positionother']?>' />
				</li>
            </ul>
            <div class="clear"></div>
			<a href="#" class="next" onclick="showNextDiv()">Next &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/applyonline/applyonline/next_bullet.gif" /></a>            
        </div>
      
    	</div>
		<div class="forms" id="s5" style="display:block;">
        	<h2>Professional Data</h2>
            <div class="forminputs">
            <div class='contact-message' style='display:none;' align="center"></div>
            <div class="clear"></div>
            <p class="form_caption">
            	Please list your last three positions in reverse chronological order starting with your current one. If all are in the same company, please give the major promotional sequence
            </p>
			<ul>
            	<li class="txt">Name of Company:</li>
                <li>
					<input type='text' id='contact-company2' class='bluebar' name='company2' tabindex='1005' maxlength='30' value='<?=$userRecord['company2']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Title / Position:</li>
                <li>
					<input type='text' id='contact-position2' class='bluebar' name='position2' tabindex='1006' maxlength='30' value='<?=$userRecord['position2']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">Start Date:</li>
                <li>
					<input type='text' id='contact-from2' class='bluebar' name='from2' tabindex='1007' maxlength='30' value='<?=$userRecord['from2']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">End Date:</li>
                <li>
					<input type='text' id='contact-to2' class='bluebar' name='to2' tabindex='1008' maxlength='30' value='<?=$userRecord['to2']?>' />
				</li>
            </ul>
			<ul>
            	<li class="txt">Name of Company:</li>
                <li>
					<input type='text' id='contact-company3' class='bluebar' name='company3' tabindex='1009' maxlength='30' value='<?=$userRecord['company3']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Title / Position:</li>
                <li>
					<input type='text' id='contact-position3' class='bluebar' name='position3' tabindex='1010' maxlength='30' value='<?=$userRecord['position3']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">Start Date:</li>
                <li>
					<input type='text' id='contact-from3' class='bluebar' name='from3' tabindex='1011' maxlength='30' value='<?=$userRecord['from3']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">End Date:</li>
                <li>
					<input type='text' id='contact-to3' class='bluebar' name='to3' tabindex='1012' maxlength='30' value='<?=$userRecord['to3']?>' />
				</li>
            </ul>
          	
			<ul>
            	<li class="txt">Please estimate total number of years of professional experience:</li>
                <li>
					<input type='text' id='contact-numyearsexp' class='bluebar' name='numyearsexp' tabindex='1013' maxlength='5' value='<?=$userRecord['numyearsexp']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">Please describe your current responsibilities including your level in the organization:</li>
                <li>
					<textarea id='contact-responsibility' class='bluebar' name='responsibility' tabindex='1014'  maxlength='300' onkeyup='return ismaxlength(this)'> <?=$userRecord['responsibility']?></textarea>
				</li>
            </ul>
			<ul>
            	<li class="txt">University:</li>
                <li>
					<input type='text' id='contact-university' class='bluebar' name='university' tabindex='1015' maxlength='50' value='<?=$userRecord['university']?>' />
			    </li>
            </ul>
          	<ul>
            	<li class="txt">Year:</li>
                <li>
					<input type='text' id='contact-year' class='bluebar' name='year' tabindex='1016' maxlength='5' value='<?=$userRecord['year']?>' />
				</li>
            </ul>
            <ul>
       	    <li class="txt">Degree (Highest level attended):</li>
                <li>
					<input type='text' id='contact-degree' class='bluebar' name='degree' tabindex='1017' maxlength='30' value='<?=$userRecord['degree']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">What are your objectives of attending this programme? What do you expect to achieve by the end of this programme:</li>
                <li>
					<textarea id='contact-objectives' class='bluebar' name='objectives' tabindex='1018' maxlength='300' onkeyup='return ismaxlength(this)' > <?=$userRecord['objectives']?></textarea>
				</li>
            </ul>
            <div class="clear"></div>
			<a href="#" class="next" onclick="showNextDiv()">Next &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/applyonline/next_bullet.gif" /></a>            
        </div>
      
		</div>
		<div class="forms" id="s6" style="display:none;">
        	<h2>Sponsorship and Invoicing</h2>
            <div class="forminputs">
            <div id='contact-message' style='display:none;' align="center"></div>
            <div class="clear"></div>
            <p class="form_caption">
            	I have read and accepted all policies written in the brochure. I understand that upon completion and receipt of invoice, the organisation will become liable for all charges including cancellation and transfer charges, if applicable.
            </p>
			<ul>
            	<li class="txt">Name:</li>
                <li>
					<input type='text' id='contact-name' class='bluebar' name='name' tabindex='1001' maxlength='30' value='<?=$userRecord['name']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Designation:</li>
                <li>
					<input type='text' id='contact-designation' class='bluebar' name='designation' tabindex='1002' maxlength='30' value='<?=$userRecord['designation']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">Address:</li>
                <li>
					<textarea maxlength='150' id='contact-address' class='bluebar' name='address' tabindex='1003' onkeyup='return ismaxlength(this)'> <?=$userRecord['address']?></textarea>
				</li>
            </ul>
          	<ul>
            	<li class="txt">Telephone:</li>
                <li>
					<input type='text' id='contact-telephone' class='bluebar' name='telephone' tabindex='1004' maxlength='20' value='<?=$userRecord['telephone']?>' />
				</li>
            </ul>
			<ul>
            	<li class="txt">Fax:</li>
                <li>
					<input type='text' id='contact-sponsorfax' class='bluebar' name='sponsorfax' tabindex='1005' maxlength='20' value='<?=$userRecord['sponsorfax']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Email:</li>
                <li>
					<input type='text' id='contact-email' class='bluebar' name='email' tabindex='1006' maxlength='50' value='<?=$userRecord['email']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">Website:</li>
                <li>
					<input type='text' id='contact-website' class='bluebar' name='website' tabindex='1007' maxlength='50' value='<?=$userRecord['website']?>' />
				</li>
            </ul>
          	
			<ul>
            	<li class="txt">Name:</li>
                <li>
					<input type='text' id='contact-invoicename' class='bluebar' name='invoicename' tabindex='1008' maxlength='30' value='<?=$userRecord['invoicename']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Designation:</li>
                <li>
					<input type='text' id='contact-invoicedesignation' class='bluebar' name='invoicedesignation' tabindex='1009' maxlength='30' value='<?=$userRecord['invoicedesignation']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">Address:</li>
                <li>
					<textarea maxlength='150' id='contact-invoiceaddress' class='bluebar' name='invoiceaddress' tabindex='1010' onkeyup='return ismaxlength(this)'> <?=$userRecord['invoiceaddress']?></textarea>
				</li>
            </ul>
          	<ul>
            	<li class="txt">Telephone:</li>
                <li>
					<input type='text' id='contact-invoicetelephone' class='bluebar' name='invoicetelephone' tabindex='1011' maxlength='20' value='<?=$userRecord['invoicetelephone']?>' />
				</li>
            </ul>
			<ul>
            	<li class="txt">Fax:</li>
                <li>
					<input type='text' id='contact-invoicefax' class='bluebar' name='invoicefax' tabindex='1012' maxlength='20' value='<?=$userRecord['invoicefax']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Email:</li>
                <li>
					<input type='text' id='contact-invoiceemail' class='bluebar' name='invoiceemail' tabindex='1013' maxlength='50' value='<?=$userRecord['invoiceemail']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">Website:</li>
                <li>
					<input type='text' id='contact-invoicewebsite' class='bluebar' name='invoicewebsite' tabindex='1014' maxlength='50' value='<?=$userRecord['invoicewebsite']?>' />
				</li>
            </ul>
			
          	
			<ul>
            	<li class="txt">Name:</li>
                <li>
					<input type='text' id='contact-executivename' class='bluebar' name='executivename' tabindex='1015' maxlength='30' value='<?=$userRecord['executivename']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Designation:</li>
                <li>
					<input type='text' id='contact-executivedesignation' class='bluebar' name='executivedesignation' tabindex='1016' maxlength='30' value='<?=$userRecord['executivedesignation']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">Address:</li>
                <li>
					<textarea maxlength='150' id='contact-executiveaddress' class='bluebar' name='executiveaddress' tabindex='1017' onkeyup='return ismaxlength(this)'> <?=$userRecord['executiveaddress']?></textarea>
				</li>
            </ul>
          	<ul>
            	<li class="txt">Telephone:</li>
                <li>
				<input type='text' id='contact-executivetelephone' class='bluebar' name='executivetelephone' tabindex='1018' maxlength='20' value='<?=$userRecord['executivetelephone']?>' />
				</li>
            </ul>
			<ul>
            	<li class="txt">Fax:</li>
                <li>
				<input type='text' id='contact-executivefax' class='bluebar' name='executivefax' tabindex='1019' maxlength='20' value='<?=$userRecord['executivefax']?>' />
				</li>
            </ul>
            <ul>
            	<li class="txt">Email:</li>
                <li>
					<input type='text' id='contact-executiveemail' class='bluebar' name='executiveemail' tabindex='1020' maxlength='50' value='<?=$userRecord['executiveemail']?>' />
				</li>
            </ul>
          	<ul>
            	<li class="txt">Website:</li>
                <li>
					<input type='text' id='contact-executivewebsite' class='bluebar' name='executivewebsite' tabindex='1021' maxlength='50' value='<?=$userRecord['executivewebsite']?>' />
				</li>
            </ul>
			
			<ul>
            	<li class="txt">Do you wish to be informed about our programmes via email on regular basis?:</li>
                <li>
					<input type='radio' name='informemail' value = 'male' checked='checked' tabindex='1022' /> No
					<input type='radio' name='informemail' value = 'female' /> Yes
				</li>
            </ul>
            <div class="clear"></div>
			<a href="#" class="next" onclick="showNextDiv()">Next &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/applyonline/applyonline/next_bullet.gif" /></a>            
        </div>
		</div>
		<div class="forms" id="s7" style="display:none;">
			<h2>Information Source</h2>
            <div class="forminputs">
            <div id='contact-message' style='display:none;' align="center"></div>
			<ul>
            	<li class="txt">How did you learn about us?:</li>
                <li>
					<select name='learnabout' class='contact-input' tabindex='1000'>
						<option value='' <? if ($userRecord['learnabout'] == '') echo 'selected';?>>--select--</option>
						<option value='Website' <? if ($userRecord['learnabout'] == 'Website') echo 'selected';?>>Website</option>
						<option value='Executive Alumni' <? if ($userRecord['learnabout'] == 'Executive Alumni') echo 'selected';?>>Executive Alumni</option>
						<option value='Annual Brochure' <? if ($userRecord['learnabout'] == 'Annual Brochure') echo 'selected';?>>Annual Brochure</option>
						<option value='Referred by HR Department at LUMS' <? if ($userRecord['learnabout'] == 'Referred by HR Department at LUMS') echo 'selected';?>>Referred by HR Department at LUMS</option>
		
						<option value='Referred by HR Department of My Organization' <? if ($userRecord['learnabout'] == '') echo 'selected';?>>Referred by HR Department of My Organization</option>
					</select>
				</li>
            </ul>
            <ul>
            	<li class="txt">OEP Programmes:</li>
                <li>
					<select name='oepprogrammes' class='contact-input' id='contact-oepprogrammes' tabindex='1001'>
						<option value=''>--select--</option>
						<?php
							foreach($programmes as $prog)
								echo "<option value='".$prog['oepid']."'>".$prog['name']."</option>";
						?>	
					</select>
				</li>
            </ul>
        	 <div class="clear"></div>
			<a href="#" class="next" onclick="showNextDiv()">Next &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/applyonline/applyonline/next_bullet.gif" /></a>            
        </div>
		
	</div>
		<div class="forms" id="s8" style="display:none;">
			<h2>Success</h2>
            <div class="forminputs">
            <div id='contact-message' style='display:none;' align="center"></div>
			<ul>
            	<li class="txt">Congrates, your application has been submitted successfully.</li>
                <li>
				
				</li>
            </ul>
           
    		<div class="clear"></div>
			<a href="#" class="next" onclick="showNextDiv()">Next &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/applyonline/applyonline/next_bullet.gif" /></a>            
        </div>
	
	</div>
		<img src="images/applyonline/line.gif" class="bottomline" />
	</div>

	<script language="javascript">
		//defaultDiv();
	</script>

</body>

</html>
