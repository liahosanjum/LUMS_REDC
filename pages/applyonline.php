<?php
	include_once('../classlibrary/configuration.php');
	error_reporting(0);
//	session_register("userRecord"); 
	session_register("successlogin");
//	session_register("userid");
	session_register("alreadyapplied"); 

	

// GLOBAL VARIABLE TO RETIAN THE USER RECORD IF ALREADY REGISTERED
	//global $userRecord;
	
	$userRecord = null;
	$class1 = "apply-content1";
	$class2 = "apply-content";
	$ifregistered = 1;
	$divname = 2;
	
	$personal = '';
	$personalLink = '';
	$contact = '';
	$contactLink = '';
	$organizational = '';
	$organizationalLink = '';
	$professional = '';
	$professionalLink = '';
	$sponsor = '';
	$sponsorLink = '';
	$information = '';
	$informationLink = '';

	if(isset($_SESSION['userid']))
	{
		$userRecord = $_SESSION['userRecord'];
		
		if($userRecord["firstname"] != "")
		{
			$personal = 'sharp';	
			$personalLink = 'javascript:toggleFunc(1);';
		}
		
		if($userRecord['contactdesignation'] != "")
		{
			$contact = 'sharp';	
			$contactLink = 'javascript:toggleFunc(2);';
		}
		
		if($userRecord['industry'] != "")
		{
			$organizational = 'sharp';	
			$organizationalLink = 'javascript:toggleFunc(3);';
		}
		
		if($userRecord['company1'] != "")
		{
			$professional = 'sharp';	
			$professionalLink = 'javascript:toggleFunc(4);';
		}
		
		if($userRecord['name'] != "")
		{
			$sponsor = 'sharp';	
			$sponsorLink = 'javascript:toggleFunc(5);';
		}
		
		if($userRecord['learnabout'] != "")
		{
			$information = 'sharp';	
//			$informationLink = 'javascript:toggleFunc(6);';
		}
		//step->professional   
		$from1 = explode('-' , $userRecord['from1']);
		$fy1 = $from1[0];
		$fm1 = $from1[1];
		$fd1 = $from1[2];

		$to1 = explode('-' , $userRecord['to1']);
		$ty1 = $to1[0];
		$tm1 = $to1[1];
		$td1 = $to1[2];

	}	
	
// DEFINES CONSTANTS FOR DB CONNECTION
/*	define('HOST', 'netraserver');
	define('USERNAME', 'root');
	define('PASSWORD', 'admin');
	define('DATABASE', 'redc_db');
*/
// INCLUDE FILES
	
	include_once('../classlibrary/db.php');
	include_once('../libs/applyonline.lib.php');
	include("../classlibrary/sendemail.php");

// OBJECT OF CLASS APPLYONLINE
	$applyonline = new ApplyOnline;

// POPULATE EXISTING RECORD IN FORM FIELDS IF USER ALREADY REGISTERED

// GET COUNTRIES LIST
	$countrylist = $applyonline->getCountries();

// GET ACTIVE PROGRAMMES LIST
	if(isset($_SESSION['userid']))
	{
		$programmes  = $applyonline->getNewProgrammes($_SESSION['userid']); 
	}	


// User settings
$to = "user@yourdomain.com";
$subject = "SimpleModal apply Form";

// Include extra form fields and/or submitter data?
// false = do not include
$extra = array(
	"form_subject"	=> true,
	"form_cc"		=> true,
	"ip"			=> true,
	"user_agent"	=> true
);

		$year = range(date('Y') , 2000);
		$month = range('1' , '12');
		$day = range('1' , '31');	


// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";

if (empty($action)) {
	// Send back the apply form HTML
	$output = "<div style='display:none;' class='wraper-apply'>
	<a href='#' title='Close' class='modalCloseX simplemodal-close'><img src='images/applyonline/crossicon.jpg' border='0' /></a>
		
		<div class='applysteps'>
        	<ul>";
            	if($personalLink != ""){
				$output .= "<li>
                	<p class='".$personal."' id='p2'><a class='sharpLink' href='".$personalLink."'>Personal Data</a></p><img src='images/applyonline/2.gif' id='i2' />
                </li>";
				}else {
				
				$output .= "<li>
                	<p class='sharp' id='p2'>Personal Data</p><img src='images/applyonline/2.gif' id='i2' />
                </li>";
				}
				
				if($contactLink != "") {
				$output .= "
                <li>
                	<p class='".$contact."' id='p3'><a class='sharpLink' href='".$contactLink."'>Contact Data</a></p><img src='images/applyonline/3_trans.gif' id='i3' />
                </li>";
				}else {
				$output .= "
                <li>
                	<p class='".$contact."' id='p3'>Contact Data</p><img src='images/applyonline/3_trans.gif' id='i3' />
                </li>";
				}
				
				if($organizationalLink != "") {
                $output .= "<li>
                	<p class='".$organizational."' id='p4'><a class='sharpLink' href='".$organizationalLink."'>Organisational Data</a></p><img src='images/applyonline/4_trans.gif' id='i4' />
                </li>";
				}else {
				$output .= "<li>
                	<p class='".$organizational."' id='p4'>Organisational Data</p><img src='images/applyonline/4_trans.gif' id='i4' />
                </li>";
				}
				
				if($professionalLink != "") {				
                $output .="<li>
                	<p class='".$professional."' id='p5'><a class='sharpLink' href='".$professionalLink."'>Professional Data</a></p><img src='images/applyonline/5_trans.gif' id='i5' />
                </li>";
				}else {
				$output .="<li>
                	<p class='".$professional."' id='p5'>Professional Data</p><img src='images/applyonline/5_trans.gif' id='i5' />
                </li>";
				}
                if($sponsorLink != "") {				
				$output .="<li>
                	<p class='".$sponsor."' id='p6'><a class='sharpLink' href='".$sponsorLink."'>Sponsorship and Invoicing</a></p><img src='images/applyonline/6_trans.gif' id='i6' />
                </li>";
				}else {
				$output .="<li>
                	<p class='".$sponsor."' id='p6'>Sponsorship and Invoicing</p><img src='images/applyonline/6_trans.gif' id='i6' />
                </li>";
				}
				
                $output .= "<li>
                	<p class='".$information."' id='p7'><!--<a href='".$informationLink."'>-->Information Source<!--</a>--></p><img src='images/applyonline/7_trans.gif' id='i7' />
                </li>
            </ul>
        </div>
	<input type='hidden' name='divname' value='".$divname."' id='apply-divname'/>
	<input type='hidden' name='ifregistered' value='".$ifregistered."' id='apply-ifregistered'/>
	
	<div class='forms-apply apply-content'>
	<div id='programmename'></div>
	<form action='#' style='display:none;'>
	
	<div class='forminputs-apply'>";
	
	if($_REQUEST['pname'] != "")
	{
		$output .= "
	<span id='spnProgrammeName2' style='font-size:11px; font-weight:bolder; background-color:#d9ecf0; color:#000000;padding-top:0px; padding:5px; margin-bottom:5px'>".$_REQUEST['pname']."</span>";
	}
	$output .="
	<div id='s2' class='apply-content1'>
	<h2 class='apply-title1'>
		Personal Data:		
	</h2>
	<div class='apply-message' style='display:none;'></div>
		<div class='clear' />
		<br/>
		<div class='apply-content2'>
			<div id='oep-ul'>
			<div class='clear'></div>
			<p>Select open enrollment programme to which you want to apply.</p>	
			<ul>	
				<li class='txt'>OEP Programmes:<span class='required'>*</span></li>
				<li>
					<select name='oepprogrammes' class='bluebar' id='apply-oepprogrammes' tabindex='1001' onchange='setProgName(this.text);'>
						<option value=''>--select--</option>";
						foreach($programmes as $prog)
						$output .= "<option value='".$prog['oepid']."'>".$prog['name']."</option>";
		$output .= "</select>
				</li>	
			</ul>
			<div class='clear'></div>
			<br/>	
			</div>
			<script language='javascript'>
				ifProgrammeExists();
			</script>
			<ul>
				<li class='txt'>First Name:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-firstname' class='bluebar' name='firstname' maxlength='30' tabindex='1001' value='".$userRecord["firstname"]."' />
				</li>
			</ul>

			<ul>
				<li class='txt'>Middle Name:</li>
				<li>
					<input type='text' id='apply-middlename' class='bluebar' name='middlename' maxlength='30' tabindex='1002' value='".$userRecord["middlename"]."' />
				</li>
			</ul>

			<ul>
				<li class='txt'>Last Name:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-lastname' class='bluebar' name='lastname' maxlength='30' tabindex='1003' value='".$userRecord["lastname"]."' />
				</li>
			</ul>

			<ul>
				<li class='txt'>Prefix:</li>
				<li>
					<select id='apply-prefix' class='bluebar' name='prefix' tabindex='1004'>
						<option value='Mr.'>Mr.</option>
						<option value='Mrs.'>Mrs.</option>
						<option value='Miss'>Miss</option>
						<option value='Ms.'>Ms.</option>
						<option value='Dr.'>Dr.</option>
					</select>

				</li>
			</ul>
			<script language='javascript'>
				selectDropdown('apply-prefix' , '$userRecord[prefix]');
			</script>
			<ul>
				<li class='txt'>Gender:</li>
				<li>
					<input type='radio' name='gender' value = 'male' checked='checked' tabindex='1005' />&nbsp;&nbsp;Male&nbsp; 
					<input type='radio' name='gender' value = 'female' />&nbsp;&nbsp;Female
				</li>
			</ul>		
			<ul>
				<li class='txt'>Nationality:</li>
				<li>
					<input type='text' id='apply-nationality' class='bluebar' name='nationality' maxlength='50' tabindex='1006' value='".$userRecord["nationality"]."' />
				</li>
			</ul>
			<ul>
				<li class='txt'>Business Email:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-busemail' class='bluebar' name='busemail' tabindex='1007' maxlength='50' value='".$userRecord["busemail"]."' />
				</li>
			</ul>
			<div class='clear'></div>
			<p>In case of emergency, please notify</p>			
			<ul>
				<li class='txt'>Name:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-emergencyname' class='bluebar' name='emergencyname' tabindex='1008' maxlength='50' value='".$userRecord["emergencyname"]."' />
				</li>
			</ul>

			<ul>
				<li class='txt'>Telephone:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-emergencyphone' class='bluebar' name='emergencyphone' tabindex='1009' maxlength='20' value='".$userRecord["emergencyphone"]."' />
				</li>
			</ul>
			
		</div>	
		<div id='button'>
			<ul>
				<li style='width:270px;'>&nbsp;</li>
				<li>
					<button type='button' class='next-apply apply-create apply-button' tabindex='1011'>Save and Continue &nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>&nbsp;
					<button type='button' class='next-apply apply-exit simplemodal-close apply-button' tabindex='1011'>Exit &nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
				</li>
			</ul>	
		</div>
	</div>
	
	<div class='apply-content1' id='s3' style='display:none;'>
		<h2 class='apply-title1'>Contact Data:<!--<br />
		<span id='spnProgrammeName3' style='font-size:11px; font-weight:bolder; color:#ADB7BD;padding-top:0px; padding-bottom:5px;'>".$_REQUEST['pname']."</span>--></h2>
		<div class='apply-message' style='display:none;'></div>
		<div class='clear' />
		<br/>
		<div class='apply-content2'>		
			<ul>
				<li class='txt'>Designation:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-contactdesignation' class='bluebar' name='contactdesignation' tabindex='1001' maxlength='30' value='".$userRecord["contactdesignation"]."'  />
				</li>
			</ul>	
			<ul>
				<li class='txt'>Company/Organization Name:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-companyname' class='bluebar' name='companyname' tabindex='1002' maxlength='50' value='".$userRecord["companyname"]."'  />
				</li>
			</ul>
	
			<ul>
				<li class='txt'>Parent Company Name (If different from company name):</li>
				<li>
					<input type='text' id='apply-companyother' class='bluebar' name='companyother' tabindex='1003' maxlength='50' value='".$userRecord["companyother"]."' />
				</li>
			</ul>	
			<ul>
				<li class='txt'>Organization Address:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-companyaddress' class='bluebar' name='companyaddress' tabindex='1004' maxlength='150' value='".$userRecord["companyaddress"]."' />
				</li>
			</ul>
	
			<ul>
				<li class='txt'>City:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-city' class='bluebar' name='city' tabindex='1005' maxlength='50' value='".$userRecord["city"]."' />
				</li>
			</ul>
	
			<ul>
				<li class='txt'>Country:<span class='required'>*</span></li>
				<li>
					<select id='apply-country' name='country' tabindex='1006' class='bluebar'>
						<option value=''>--select country--</option>";
							foreach($countrylist as $country){
								if($country['country_id'] == $userRecord['country']){
									$output .= "<option value='".$country['country_id']."' selected>".$country['countryname']."</option>";
								}
								else
									$output .= "<option value='".$country['country_id']."'>".$country['countryname']."</option>";	
							}	
		$output .= "</select>
	
				</li>
			</ul>
	
			<ul>
				<li class='txt'>Telephone:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-ctelephone' class='bluebar' name='ctelephone' tabindex='1007' maxlength='20' value='".$userRecord["ctelephone"]."' />
				</li>
			</ul>
	
			<ul>
				<li class='txt'>Cell Number:</li>
				<li>
					<input type='text' id='apply-cell' class='bluebar' name='cell' tabindex='1008' maxlength='20' value='".$userRecord["cell"]."' />
				</li>
			</ul>
	
			<ul>
				<li class='txt'>Fax Number:</li>
				<li>
					<input type='text' id='apply-fax' class='bluebar' name='fax' tabindex='1009' maxlength='20' value='".$userRecord["fax"]."' />
				</li>
			</ul>

		</div>
		<div id='button'>
		<ul>
			<li class='txt1'>
				&nbsp;
			</li>
			<li>
				<button type='button' class='prev-apply apply-back apply-button' tabindex='1010'><img src='images/applyonline/prev_bullet.gif' />&nbsp;&nbsp;Prev
				</button>
				<button type='button' class='next-apply apply-create apply-button' tabindex='1011'>Save and Continue &nbsp;&nbsp;
				<img src='images/applyonline/next_bullet.gif' /></button>&nbsp;
				<button type='button' class='next-apply apply-exit simplemodal-close apply-button' tabindex='1011'>Exit &nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
			</li>
		</ul>		
		</div>
	</div>
	
	<div class='apply-content1' id='s4' style='display:none;'>
	<h2 class='apply-title1'>Organisational Data:<!--<br />
		<span id='spnProgrammeName4' style='font-size:11px; font-weight:bolder; color:#ADB7BD;padding-top:0px; padding-bottom:5px;'>".$_REQUEST['pname']."</span>--></h2>
	<div class='apply-message' style='display:none;'></div>
		<div class='clear'></div>
		<p>Your Parent Company/Organization (optional)</p>
			<div class='apply-content2'>			
				<ul>
					<li class='txt'>Products/Services:</li>
					<li>
						<textarea id='apply-parentservices' class='bluebar' name='parentservices' tabindex='1001' maxlength='300' onkeyup='return ismaxlength(this)'>".$userRecord['parentservices']."</textarea>
					</li>
				</ul>			
				<ul>
					<li class='txt'>No. of Employees:</li>
					<li>
						<input type='text' id='apply-parentnumemployees' class='bluebar' name='parentnumemployees' tabindex='1002' maxlength='10' value='".$userRecord['parentnumemployees']."' />
					</li>
				</ul>
				<div class='clear'></div>
				<p>Your Company/Division</p>
				<ul>
					<li class='txt'>Products/Services:<span class='required'>*</span></li>
					<li>
						<textarea id='apply-services' class='bluebar' name='services' tabindex='1003'>".$userRecord['services']."</textarea>
					</li>
				</ul>
				<ul>
					<li class='txt'>No. of Employees:<span class='required'>*</span></li>
					<li>
						<input type='text' id='apply-numemployees' class='bluebar' name='numemployees' tabindex='1004' maxlength='10' value='".$userRecord['numemployees']."' />
					</li>
				</ul>
				<ul>
					<li class='txt'>How many employees are under your supervision?:<span class='required'>*</span></li>
					<li>
						<input type='text' id='apply-numemployeessupervision' class='bluebar' name='numemployeessupervision' tabindex='1005' maxlength='10' value='".$userRecord['numemployeessupervision']."' />
					</li>
				</ul>
				<ul>
					<li class='txt'>What is the title position of the person to whom you report?:<span class='required'>*</span></li>
					<li>
						<input type='text' id='apply-reportperson' class='bluebar' name='reportperson' tabindex='1006' maxlength='30' value='".$userRecord['reportperson']."' />
					</li>
				</ul>
				<ul>
					<li class='txt'>Please select your current industry:<span class='required'>*</span></li>
					<li>
						<select name='industry' class='bluebar' tabindex='1007' id='apply-industry'>
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
							<option value='Insurance'>Insurance</option>
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
					</li>
				</ul>
				<script language='javascript'>
					selectDropdown('apply-industry' , '$userRecord[industry]');
				</script>
				<ul>
					<li class='txt'>Specify Other:</li>
					<li>
						<input type='text' id='apply-industryother' class='bluebar' name='industryother' tabindex='1008' maxlength='30' value='".$userRecord['industryother']."' />
					</li>
				</ul>
				<ul>
					<li class='txt'>What function best describes your position?:<span class='required'>*</span></li>
					<li>
						<select name='position' class='bluebar' tabindex='1009' id='apply-position'>
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
					</li>
				</ul>
				<script language='javascript'>
					selectDropdown('apply-position' , '$userRecord[position]');
				</script>
				<ul>
					<li class='txt'>Specify Other:</li>
					<li>
						<input type='text' id='apply-positionother' class='bluebar' name='positionother' tabindex='1010' maxlength='30' value='".$userRecord['positionother']."' />
					</li>
				</ul>			
			</div>
			<div id='button'>
			<ul>
			<li class='txt1'>
				&nbsp;
			</li>
			<li>
				<button type='button' class='prev-apply apply-back apply-button' tabindex='1011'><img src='images/applyonline/prev_bullet.gif' />&nbsp;&nbsp;Prev
				</button>
				<button type='button' class='next-apply apply-create apply-button' tabindex='1012'>Save and Continue &nbsp;&nbsp;
				<img src='images/applyonline/next_bullet.gif' /></button>&nbsp;
				<button type='button' class='next-apply apply-exit apply-button' tabindex='1011'>Exit &nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
			</li>
		</ul>		
			</div>
	</div>	
	
	<div class='apply-content1' id='s5' style='display:none;'>
	<h2 class='apply-title1'>Professional Data:<!--<br />
		<span id='spnProgrammeName5' style='font-size:11px; font-weight:bolder; color:#ADB7BD;padding-top:0px; padding-bottom:5px;'>".$_REQUEST['pname']."</span>--></h2></h2>
	<div class='apply-message' style='display:none;'></div>
	<div class='clear' />
		<div class='apply-content2'>
			
			<p>
				Please list your last three positions in reverse chronological order starting with your current one. If all are in the same company, please give the major promotional sequence.
			</p>
			
			<ul>
				<li class='txt'>Name of Company:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-company1' class='bluebar' name='company1' tabindex='1001' maxlength='30' value='".$userRecord['company1']."' />
				</li>
			</ul>
			
			<ul>
				<li class='txt'>Title / Position:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-position1' class='bluebar' name='position1' tabindex='1002' maxlength='30' value='".$userRecord['position1']."' />
				</li>
			</ul>
			
			
			<ul>
				<li class='txt'>Start Date:<span class='required'>*</span></li>
				<li>
					<div>
						<div style='float:left;'>
								<select name='ys' id='ys' class='bluebar_date'>
									<option value=''>--year--</option>";
									 foreach($year as $y)
										{
											$selected = '';
											if($y <= 9)
											{
												$y = '0'.$y; 
											}
											
											if($y == $fy1)
											{
												$selected = 'selected';
											}
													
										$output .= "<option value='$y' $selected>$y</option>";
									 }			
								$output .= "</select>	
						</div>
						<div style='float:left;'>
								<select name='ms' id='ms' class='bluebar_date'>
									<option value=''>--month--</option>";
									 foreach($month as $m)
										{
											$selected = '';
											if($m <= 9)
											{
												$m = '0'.$m; 
											}
											if($m == $fm1)
											{
												$selected = 'selected';
											}	
										$output .= "<option value='$m' $selected>$m</option>";
									 }			
								$output .= "</select>	
						</div>
						<div style='float:left;'>
								<select name='ds' id='ds' class='bluebar_date'>
									<option value=''>--day--</option>";
									 foreach($day as $d)
										{
											$selected = '';
											if($d <= 9)
											{
												$d = '0'.$d; 
											}
											if($d == $fd1)
											{
												$selected = 'selected';
											}	
										$output .= "<option value='$d' $selected>$d</option>";
									 }			
								$output .= "</select>	
						</div>
					</div>	
					<input type='hidden' id='apply-from1' name='from1' maxlength='30' value='".$userRecord['from1']."' />
				</li>
			</ul>
			
			
			<ul>

				<li class='txt'>End Date:<span class='required'>*</span></li>
				<li>
					<div>
						<div style='float:left;'>
								<select name='ye' id='ye' class='bluebar_date'>
									<option value=''>--year--</option>";
									 foreach($year as $y)
										{
											$selected = '';
											if($y <= 9)
											{
												$y = '0'.$y; 
											}
											if($y == $ty1)
											{
												$selected = 'selected';
											}	
										$output .= "<option value='$y' $selected>$y</option>";
									 }			
								$output .= "</select>	
						</div>
						<div style='float:left;'>
								<select name='me' id='me' class='bluebar_date'>
									<option value=''>--month--</option>";
									 foreach($month as $m)
										{
											$selected = '';
											if($m <= 9)
											{
												$m = '0'.$m; 
											}
											if($m == $tm1)
											{
												$selected = 'selected';
											}	
										$output .= "<option value='$m' $selected>$m</option>";
									 }			
								$output .= "</select>	
						</div>
						<div style='float:left;'>
								<select name='de' id='de' class='bluebar_date'>
									<option value=''>--day--</option>";
									 foreach($day as $d)
										{
											$selected = '';
											if($d <= 9)
											{
												$d = '0'.$d; 
											}
											if($d == $td1)
											{
												$selected = 'selected';
											}	
										$output .= "<option value='$d' $selected>$d</option>";
									 }			
								$output .= "</select>	
						</div>
					</div>	
					<input type='hidden' id='apply-to1' name='to1' maxlength='30' value='".$userRecord['to1']."' />
				</li>
			</ul>
			
			<ul>
				<li class='txt'>Name of Company:</li>
				<li>
					<input type='text' id='apply-company2' class='bluebar' name='company2' tabindex='1005' maxlength='30' value='".$userRecord['company2']."' />
				</li>
			</ul>
			
			<ul>
				<li class='txt'>Title / Position:</li>
				<li>
					<input type='text' id='apply-position2' class='bluebar' name='position2' tabindex='1006' maxlength='30' value='".$userRecord['position2']."' />
				</li>
			</ul>
			<ul>
				<li class='txt'>Start Date:</li>
				<li>
					<input type='text' id='apply-from2' class='bluebar' name='from2' tabindex='1007' maxlength='30' value='".$userRecord['from2']."' />
				</li>
			</ul>
			
			
			<ul>
				<li class='txt'>End Date:</li>
				<li>
					<input type='text' id='apply-to2' class='bluebar' name='to2' tabindex='1008' maxlength='30' value='".$userRecord['to2']."' />
				</li>
			</ul>
			
			
			<ul>
				<li class='txt'>Name of Company:</li>
				<li>
					<input type='text' id='apply-company3' class='bluebar' name='company3' tabindex='1009' maxlength='30' value='".$userRecord['company3']."' />
				</li>
			</ul>
			
			<ul>
				<li class='txt'>Title / Position:</li>
				<li>
					<input type='text' id='apply-position3' class='bluebar' name='position3' tabindex='1010' maxlength='30' value='".$userRecord['position3']."' />
				</li>
			</ul>
			
			
			<ul>
				<li class='txt'>Start Date:</li>
				<li>
					<input type='text' id='apply-from3' class='bluebar' name='from3' tabindex='1011' maxlength='30' value='".$userRecord['from3']."' />
				</li>
			</ul>
			
			
			<ul>
				<li class='txt'>End Date:</li>
				<li>
					<input type='text' id='apply-to3' class='bluebar' name='to3' tabindex='1012' maxlength='30' value='".$userRecord['to3']."' />
				</li>
			</ul>

		
			<ul>
				<li class='txt'>Please estimate total number of years of professional experience:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-numyearsexp' class='bluebar' name='numyearsexp' tabindex='1013' maxlength='5' value='".$userRecord['numyearsexp']."' />
				</li>
			</ul>
			<ul>
				<li class='txt'>Please describe your current responsibilities including your level in the organisation:<span class='required'>*</span></li>
				<li>
					<textarea id='apply-responsibility' class='bluebar' name='responsibility' tabindex='1014'  maxlength='300' onkeyup='return ismaxlength(this)'>".$userRecord['responsibility']."</textarea>
				</li>
			</ul>
			
			<div class='clear' />
			<p>Education </p>
			
			<ul>
				<li class='txt'>University:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-university' class='bluebar' name='university' tabindex='1015' maxlength='50' value='".$userRecord['university']."' />
				</li>
			</ul>
			<ul>
				<li class='txt'>Year:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-year' class='bluebar' name='year' tabindex='1016' maxlength='5' value='".$userRecord['year']."' />
				</li>
			</ul>
			<ul>
				<li class='txt'>Degree (Highest level attended):<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-degree' class='bluebar' name='degree' tabindex='1017' maxlength='30' value='".$userRecord['degree']."' />
				</li>
			</ul>
			<div class='clear'></div>
			<p>Objectives </p>	
			
			<ul>
				<li class='txt'>What are your objectives of attending this programme? What do you expect to achieve by the end of this programme:<span class='required'>*</span></li>
				<li>
					<textarea id='apply-objectives' class='bluebar' name='objectives' tabindex='1018' maxlength='300' onkeyup='return ismaxlength(this)' > ".$userRecord['objectives']."</textarea>
				</li>
			</ul>
			
		
		</div>
		<div id='button'>
		<ul>
			<li class='txt1'>
				&nbsp;
			</li>
			<li>
				<button type='button' class='prev-apply apply-back apply-button' tabindex='1019'><img src='images/applyonline/prev_bullet.gif' />&nbsp;&nbsp;Prev
				</button>
				<button type='button' class='next-apply apply-create apply-button' tabindex='1020'>Save and Continue &nbsp;&nbsp;
				<img src='images/applyonline/next_bullet.gif' /></button>&nbsp;
				<button type='button' class='next-apply apply-exit apply-button' tabindex='1011'>Exit &nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
			</li>
		</ul>		
		</div>
		
	</div>

	<div class='apply-content1' id='s6' style='display:none;'>
	<h2 class='apply-title1'>Sponsorship and Invoicing:<!--<br />
		<span id='spnProgrammeName6' style='font-size:11px; font-weight:bolder; color:#ADB7BD;padding-top:0px; padding-bottom:5px;'>".$_REQUEST['pname']."</span>--></h2>
	<div class='apply-message' style='display:none;'></div>
		<div class='apply-content2'>
		
			<p>I have read and accepted all policies written in the brochure. I understand that upon completion and receipt of invoice, the organisation will become liable for all charges including cancellation and transfer charges, if applicable.</p>
		
			<ul>
				<li class='txt'>Name:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-name' class='bluebar' name='name' tabindex='1001' maxlength='30' value='".$userRecord['name']."' />
				</li>
			</ul>
		
			<ul>
				<li class='txt'>Designation:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-designation' class='bluebar' name='designation' tabindex='1002' maxlength='30' value='".$userRecord['designation']."' />
				</li>
			</ul>			
		
			<ul>
				<li class='txt'>Address:<span class='required'>*</span></li>
				<li>
					<textarea maxlength='150' id='apply-address' class='bluebar' name='address' tabindex='1003' onkeyup='return ismaxlength(this)'> ".$userRecord['name']."</textarea>
				</li>
			</ul>
			
		
			<ul>
				<li class='txt'>Telephone:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-telephone' class='bluebar' name='telephone' tabindex='1004' maxlength='20' value='".$userRecord['telephone']."' />
				</li>
			</ul>
			
		
			<ul>
				<li class='txt'>Fax:</li>
				<li>
					<input type='text' id='apply-sponsorfax' class='bluebar' name='sponsorfax' tabindex='1005' maxlength='20' value='".$userRecord['sponsorfax']."' />
				</li>
			</ul>		
		
			<ul>
				<li class='txt'>Email:<span class='required'>*</span></li>
				<li>
					<input type='text' id='apply-email' class='bluebar' name='email' tabindex='1006' maxlength='50' value='".$userRecord['email']."' />
				</li>
			</ul>		
		
			<ul>
				<li class='txt'>Website:</li>
				<li>
					<input type='text' id='apply-website' class='bluebar' name='website' tabindex='1007' maxlength='50' value='".$userRecord['website']."' />
				</li>
			</ul>
			<div class='clear'></div>
			<p>Name and address to which invoice should be sent (if different from above).</p>
		
			<ul>
				<li class='txt'>Name:</li>
				<li>
					<input type='text' id='apply-invoicename' class='bluebar' name='invoicename' tabindex='1008' maxlength='30' value='".$userRecord['invoicename']."' />
				</li>
			</ul>
		
			<ul>
				<li class='txt'>Designation:</li>
				<li>
					<input type='text' id='apply-invoicedesignation' class='bluebar' name='invoicedesignation' tabindex='1009' maxlength='30' value='".$userRecord['invoicedesignation']."' />
				</li>
			</ul>
			
		
			<ul>
				<li class='txt'>Address:</li>
				<li>
					<textarea maxlength='150' id='apply-invoiceaddress' class='bluebar' name='invoiceaddress' tabindex='1010' onkeyup='return ismaxlength(this)'> ".$userRecord['invoiceaddress']."</textarea>
				</li>
			</ul>
			
		
			<ul>
				<li class='txt'>Telephone:</li>
				<li>
					<input type='text' id='apply-invoicetelephone' class='bluebar' name='invoicetelephone' tabindex='1011' maxlength='20' value='".$userRecord['invoicetelephone']."' />
				</li>
			</ul>
			
		
			<ul>
				<li class='txt'>Fax:</li>
				<li>
					<input type='text' id='apply-invoicefax' class='bluebar' name='invoicefax' tabindex='1012' maxlength='20' value='".$userRecord['invoicefax']."' />
				</li>
			</ul>
			
		
			<ul>
				<li class='txt'>Email:</li>
				<li>
					<input type='text' id='apply-invoiceemail' class='bluebar' name='invoiceemail' tabindex='1013' maxlength='50' value='".$userRecord['invoiceemail']."' />
				</li>
			</ul>
			
		
			<ul>
				<li class='txt'>Website:</li>
				<li>
					<input type='text' id='apply-invoicewebsite' class='bluebar' name='invoicewebsite' tabindex='1014' maxlength='50' value='".$userRecord['invoicewebsite']."' />
				</li>
			</ul>
			
			<div class='clear'></div>
			<p>Executive Development (Person in charge of management development in your company).</p>
		
			<ul>
				<li class='txt'>Name:</li>
				<li>
					<input type='text' id='apply-executivename' class='bluebar' name='executivename' tabindex='1015' maxlength='30' value='".$userRecord['executivename']."' />
				</li>
			</ul>
		
			<ul>
				<li class='txt'>Designation:</li>
				<li>
					<input type='text' id='apply-executivedesignation' class='bluebar' name='executivedesignation' tabindex='1016' maxlength='30' value='".$userRecord['executivedesignation']."' />
				</li>
			</ul>
			
		
			<ul>
				<li class='txt'>Address:</li>
				<li>
					<textarea maxlength='150' id='apply-executiveaddress' class='bluebar' name='executiveaddress' tabindex='1017' onkeyup='return ismaxlength(this)'> ".$userRecord['executiveaddress']."</textarea>
				</li>
			</ul>
			
		
			<ul>
				<li class='txt'>Telephone:</li>
				<li>
					<input type='text' id='apply-executivetelephone' class='bluebar' name='executivetelephone' tabindex='1018' maxlength='20' value='".$userRecord['executivetelephone']."' />
				</li>
			</ul>
			
		
			<ul>
				<li class='txt'>Fax:</li>
				<li>
					<input type='text' id='apply-executivefax' class='bluebar' name='executivefax' tabindex='1019' maxlength='20' value='".$userRecord['executivefax']."' />
				</li>
			</ul>
			
		
			<ul>
				<li class='txt'>Email:</li>
				<li>
					<input type='text' id='apply-executiveemail' class='bluebar' name='executiveemail' tabindex='1020' maxlength='50' value='".$userRecord['executiveemail']."' />
				</li>
			</ul>
			
		
			<ul>
				<li class='txt'>Website:</li>
				<li>
					<input type='text' id='apply-executivewebsite' class='bluebar' name='executivewebsite' tabindex='1021' maxlength='50' value='".$userRecord['executivewebsite']."' />
				</li>
			</ul>
			

			<ul>
				<li class='txt'>Do you wish to be informed about our programmes via email on regular basis?:<span class='required'>*</span></li>
				<li>
					<input type='radio' name='informemail' value = 'Yes' checked='checked' tabindex='1022' />No 
					<input type='radio' name='informemail' value = 'No' />Yes
				</li>
			</ul>


		</div>
		<div id	='button'>
		<ul>
			<li class='txt1'>
				&nbsp;
			</li>
			<li>
				<button type='button' class='prev-apply apply-back apply-button' tabindex='1023'><img src='images/applyonline/prev_bullet.gif' />&nbsp;&nbsp;Prev
				</button>
				<button type='button' class='next-apply apply-create apply-button' tabindex='1024'>Save and Continue &nbsp;&nbsp;
				<img src='images/applyonline/next_bullet.gif' /></button>&nbsp;
				<button type='button' class='next-apply apply-exit apply-button' tabindex='1011'>Exit &nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
			</li>
		</ul>		
		</div>

	</div>

	<div class='apply-content1' id='s7' style='display:none;'>
		<h2 class='apply-title1'>Information Source:<!--<br />
		<span id='spnProgrammeName7' style='font-size:11px; font-weight:bolder; color:#ADB7BD;padding-top:0px; padding-bottom:5px;'>".$_REQUEST['pname']."</span>--></h2>
		<div class='apply-message' style='display:none;'></div>
		<div class='clear'></div>
		<br/>
		<ul>
			<li class='txt'>How did you learn about us?:</li>
			<li>
				<select name='learnabout' class='bluebar' tabindex='1000' id='apply-learnabout'>
					<option value=''>--select--</option>
					<option value='Website'>Website</option>
					<option value='Executive Alumni'>Executive Alumni</option>
					<option value='Annual Brochure'>Annual Brochure</option>
					<option value='Referred by HR Department at LUMS'>Referred by HR Department at LUMS</option>
					<option value='Referred by HR Department of My Organization'>Referred by HR Department of My Organization</option>
				</select>
			</li>
		</ul>
		<script language='javascript'>
			selectDropdown('apply-learnabout' , '$userRecord[learnabout]');
		</script>				
		<div id='button'>
		<ul>
			<li class='txt1'>
				&nbsp;
			</li>
			<li>
				<button type='button' class='prev-apply apply-back apply-button' tabindex='1011'><img src='images/applyonline/prev_bullet.gif' />&nbsp;&nbsp;Prev
				</button>
				<button type='button' class='next-apply apply-create apply-button' tabindex='1012'>Submit &nbsp;&nbsp;
				<img src='images/applyonline/next_bullet.gif' /></button>
			</li>
		</ul>		
		</div>
	</div>

	<div class='apply-content1' id='s8' style='display:none;'>
		<h2 class='apply-title1'>Congratulations!</h2>
		<div class='apply-message1'></div>
		<div class='clear'></div>
		<p>Your application has been submitted successfully.</p>
				<ul>
			<li style='width:200px;'>&nbsp;</li>
			<li>
				<button type='button' class='next-apply apply-cancel apply-button simplemodal-close'>Close &nbsp;&nbsp;
				<img src='images/applyonline/next_bullet.gif' /></button>
			</li>	
		</ul>	
	</div>
</div>
</form>
</div>
<div class='apply-bottom'></div>
<img src='images/applyonline/line.gif' class='bottomline' />
</div>";

//http://www.ericmmartin.com/projects/simplemodal/
	echo $output;
}

else if ($action == "create")
{
	//echo "user has been created<br />";
	
	$divnum = isset($_POST["divnum"]) ? $_POST["divnum"] : "";
	if($divnum)
	{ 
		// save personal data
		if($divnum == 2)
		{
			if(empty($userRecord['firstname']))
			{
				if($applyonline->addEntry($_POST , $_SESSION['userid']))
				{
					$_SESSION['userRecord'] = $_POST;
				}
				else
				{
					echo "Error occured";
				}
			}
			else
			{
				if($applyonline->updateEntry($_POST , $_SESSION['userid']))
				{
					$_SESSION['userRecord'] = $_POST;
				}
				else
				{
					echo "Error occured";
				}				
			}
		}
		else if($divnum == 3)
		{
			if(empty($userRecord['contactdesignation']))
			{
				if($applyonline->addEntry($_POST , $_SESSION['userid']))
				{
					$_SESSION['userRecord'] = $_POST;
				}
				else
				{
					echo "Error occured";
				}
			}
			else
			{
				if($applyonline->updateEntry($_POST , $_SESSION['userid']))
				{
					$_SESSION['userRecord'] = $_POST;
				}
				else
				{
					echo "Error occured";
				}				
			}
		}
		else if($divnum == 4)
		{
			if(empty($userRecord['services']))
			{
				if($applyonline->addEntry($_POST , $_SESSION['userid']))
				{
					$_SESSION['userRecord'] = $_POST;
				}
				else
				{
					echo "Error occured";
				}
			}
			else
			{
				if($applyonline->updateEntry($_POST , $_SESSION['userid']))
				{
					$_SESSION['userRecord'] = $_POST;
				}
				else
				{
					echo "Error occured";
				}				
			}
		}
		else if($divnum == 5)
		{
			if(empty($userRecord['company1']))
			{
				if($applyonline->addEntry($_POST , $_SESSION['userid']))
				{
					$_SESSION['userRecord'] = $_POST;
				}
				else
				{
					echo "Error occured";
				}
			}
			else
			{
				if($applyonline->updateEntry($_POST , $_SESSION['userid']))
				{
					$_SESSION['userRecord'] = $_POST;
				}
				else
				{
					echo "Error occured";
				}				
			}
		}
		else if($divnum == 6)
		{
			if(empty($userRecord['name']))
			{
				if($applyonline->addEntry($_POST , $_SESSION['userid']))
				{
					$_SESSION['userRecord'] = $_POST;
				}
				else
				{
					echo "Error occured";
				}
			}
			else
			{
				if($applyonline->updateEntry($_POST , $_SESSION['userid']))
				{
					$_SESSION['userRecord'] = $_POST;
				}
				else
				{
					echo "Error occured";
				}				
			}
		}
		else if($divnum == 7)
		{
			if($applyonline->getInformationSource($_SESSION['userid']) == false)
			{
				if($applyonline->addEntry($_POST , $_SESSION['userid']))
				{
					$_SESSION['userRecord'] = $_POST;
					$applyonline->sendEmail($_POST , 1 , MAILSERVER);
					echo "Congrats! your application has been submitted successfully.";
				}
				else
				{
					echo "Error occured";
				}
			}
			else
			{
				if($applyonline->updateEntry($_POST , $_SESSION['userid']))
				{
					$_SESSION['userRecord'] = $_POST;
					$applyonline->sendEmail($_POST , 1 , MAILSERVER);
					echo "Congrats! your application has been submitted successfully.";
				}
				else
				{
					echo "Error occured";
				}				
			}
		}
		
		/*
		if(empty($userRecord['firstname']) && $divnum == 8)
		{
			if($applyonline->addEntry($_POST , $_SESSION['userid'])){
				$_SESSION['userRecord'] = $_POST;
				$applyonline->sendEmail($_POST , 1 , MAILSERVER);
				echo "Congrates! your application has been submitted successfully.";
			}
			else
				echo "Error occured";
		}
		else
		{
			if($applyonline->updateEntry($_POST , $_SESSION['userid'])){
				$_SESSION['userRecord'] = $_POST;
				echo "Congrates! your record has been updated successfully.";
			}
			else
				echo "Error occured";
			
		}
		*/
		//session_destroy();		
/*		echo "<pre>";
			print_r($_POST);
		echo "</pre>";
*/	}
	
	//echo "<button type='button' class='apply-create apply-button' tabindex='1026' onclick='toggleFunc(\"2\")'>Next</button><br />";
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
			// send email to user
			$applyonline->sendEmail($_POST , 1 , MAILSERVER);
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
//				echo($userRecord); exit();
			//if(empty($_SESSION['userRecord']))
				$_SESSION['userRecord']   = $userRecord;
				$_SESSION['successlogin'] = 1;
				$_SESSION['userid'] = $uid;
			//print_r($userRecord);
			
			
/*			if(isset($_POST['oepprogrammes']) && $_POST['oepprogrammes'] != "")
			{
				if($applyonline->alreadyapplied($uid , $_POST['oepprogrammes']))
				{
					$_SESSION['alreadyapplied']   = $_POST['oepprogrammes']; // incase if exist
				}
				else
					$_SESSION['alreadyapplied']   = 0; // in case if doesn't exist
			}
*/			
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
}
else if ($action == "forgotpass")
{
	//print_r($_POST);
	if(isset($_POST['forgotusername']) && smcf_validate_email($_POST['forgotusername']))
	{
		$query = "SELECT username from redc_user where username = '".$_POST['username']."'";
		if($applyonline->alreadyExists($_POST['forgotusername']))
		{
			$applyonline->sendForgotPassMail($_POST['forgotusername'] , MAILSERVER);
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
}
else if ($action == "changepassword")
{
	if(isset($_POST['username_password']) && smcf_validate_email($_POST['username_password']))
	{
		if($uid = $applyonline->validUser($_POST['username_password'] , $_POST['password_password']))
		{
			$userRecord = $applyonline->changePassword($_POST, $uid);

			if($userRecord)
			{
				echo 1;	
			}
			else
			{
				echo 0;	
			}
		}
		else
		{
			echo 0;
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
	$headers .= "X-Mailer: PHP/SimpleModalapplyForm";

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

/*function emailNotifier($adminEmail , $userArray , $progArray)
{
		$message = "<table cellspacing= 15 >";
		
		$message .= "<tr><td colspan='2' align='left'>Login Information</td></tr>";
		$message .= "<tr><td>User Name (email)</td><td>".$userArray['username']."</td></tr>";
		$message .= "<tr><td>Password</td><td>".$userArray['password']."</td></tr>";
		
		$message .= "<tr><td colspan='2' align='left'>Programme Inform</td></tr>";
		
		$message .= "</table>";
		$mail = new SendEmail();

		for($i = 0 ; $i<count($adminEmail); $i++)
		{	
		$send = $mail->Send_Email($userArray['username'],$userArray['username'],$adminEmail[$i]['email'],$adminEmail[$i]['email'],"OEP Application",$message,MAILSERVER);
		}
		
		// email to user from admin
		$send = $mail->Send_Email($userArray['username'],$userArray['username'],$adminEmail[$i]['email'],$adminEmail[$i]['email'],"OEP Application",$message,MAILSERVER);

}
*/



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