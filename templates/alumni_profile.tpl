<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />
<title>REDC Alumni Profile Management</title>
{include file="includes.tpl"}
{literal}
<script type="text/javascript">
	function logoutAlumni()
	{
		document.forms["logout"].submit();
	}
	
	function selectDropdown(combo, page)
	{	
		var dropdown = document.getElementById(combo);
		if(dropdown != null)
		{
			for(i=0;i<dropdown.options.length;i++)
			{
				if(page == dropdown.options[i].value)
				{
					dropdown.selectedIndex = i;
					break;
				}
			}
		}
	}
</script>
{/literal}
</head>
<body>
<div id="main_container">
 {include_php file="header.php"}
<div class="contentspane">
  <div  class="content">
    <div class="left_pane">
	<ul>
		 <li>
	  <a href="{$GENERAL.BASE_URL_ROOT}/testimonial.php?section_id=9" >REDC Alumni Testimonials</a>
	  </li>
      <li>
	  		<a href="{$GENERAL.BASE_URL_ROOT}/alumni_directory.php">REDC Alumni Directory</a>
	  </li>
   	{foreach from=$section_data item ="entry"}
      <li>
	  	<a href="{$GENERAL.BASE_URL_ROOT}/alumni.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a>
	  </li>
	  {/foreach}
	  <li>
	  		<a href="{$GENERAL.BASE_URL_ROOT}/alumni_history.php">Attended Programmes</a>
	  </li>
	  <li>
	  		<a class="selected">REDC Alumni Profile Management</a>
	  </li>

	  {php}	
	  	if(isset($_SESSION['alumniuser'])) 
		{ {/php}
	  <li>
	  	<form name="logout" id="logout" method="post" action="alumni_login.php">
			<a href="#" onclick="logoutAlumni();">Logout</a>
			<input type="hidden" name="abc" value="logout" />
		</form>
	  </li>
	{php}  	}  {/php}
	  
	  </ul>
<div class="clear"></div>
		<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
       <!--<div class="add"><a href="#" ><img src="{$GENERAL.FRONT_IMG_URL}/requestafacility.gif" alt="Programme Finder"  border="0"/></a></div><div class="add1"><a href="#" ><img src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>-->
    </div>
	
    <div class="right_pane_lvl1">
      <div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat;"><h1>REDC Alumni Profile Management</h1></div>
          <!--<div class="main_heading">REDC Alumni Profile Management</div>-->
          <div class="contents_body_cms">
		  		<div class="forms-apply">
				<div id="msg" class="errorTxt">
					{if $error ne ""}
					   {$error}
					{/if}
				</div>	
				<form name="frm_alumni_profile" method="post" id="frm_alumni_profile" action="alumni_profile.php?action=submit">
					
				    <div class="forminputs-alumni">
					<div class="clear" ></div>
					<p>Personal Data</p>
					<ul>
						<li class='txt'>First Name:<span class='required'>*</span></li>
						<li> <input type="hidden" name="returnURL" id="returnURL" value="{$returnUR}" />
							<input type='text' name='firstname' tabindex='1001' maxlength='30' class='bluebar' value="{$data.firstname}" readonly="true" />
						</li>
					</ul>
                    {*
					<ul>
						<li class='txt'>Middle Name:<span class='required'>*</span></li>
						<li>
							<input type='text' class='bluebar' name='middlename' maxlength='30' tabindex='1002' value="{$data.middlename}" />
						</li>	
					</ul>
                    *}
					<ul>
						<li class='txt'>Last Name:<span class='required'>*</span></li>
						<li>
							<input type='text' class='bluebar' name='lastname' maxlength='30' tabindex='1003' value="{$data.lastname}" readonly="true" />
						</li>	
					</ul>
		
					<ul>
						<li class="txt">Prefix:<span class='required'>*</span></li>
						<li>
							<select name="prefix" class="bluebar" id="prefix" tabindex="1004">
								<option value='Mr.'>Mr.</option>
								<option value='Mrs.'>Mrs.</option>
								<option value='Miss'>Miss</option>
								<option value='Ms.'>Ms.</option>
								<option value='Dr.'>Dr.</option>
							</select>
						</li>
					</ul>
					<script language='javascript'>
						selectDropdown('prefix' , '{$data.prefix}');
					</script>
					<ul>
						<li class="txt">Nationality:<span class='required'>*</span></li>
						<li>
							<input type='text' class='bluebar' name='nationality' maxlength='50' tabindex='1005' value="{$data.nationality}"  />
						</li>
					</ul>
					<ul>
						<li class="txt">Business Email:<span class='required'>*</span></li>
						<li>
							<input type='text' class='bluebar' name='email' maxlength='50' tabindex='1006' value="{$data.email}" readonly="true"  />
						</li>
					</ul>
					
					<div class="clear" ></div>
					
					<p>Contact Data</p>
					
					<ul>
						<li class="txt">Designation:<span class='required'>*</span></li>
						<li>
							<input type='text' class='bluebar' name='designation' maxlength='50' tabindex='1007' value="{$data.designation}"  />
						</li>
					</ul>
					<ul>
						<li class="txt">Company/Organization Name:<span class='required'>*</span></li>
						<li>
							<input type='text' class='bluebar' name='companyname' maxlength='50' tabindex='1008' value="{$data.companyname}"  />
						</li>
					</ul>
					<ul>
						<li class="txt">Parent Company Name (If different from company name):</li>
						<li>
							<input type='text' class='bluebar' name='companyother' maxlength='50' tabindex='1009' value="{$data.companyother}"  />
						</li>
					</ul>
					<ul>
						<li class="txt">Address:<span class='required'>*</span></li>
						<li>
							<input type='text' class='bluebar' name='companyaddress' maxlength='150' tabindex='1010' value="{$data.companyaddress}"  />
						</li>
					</ul>
					<ul>
						<li class="txt">City:</li>
						<li>
							<input type='text' class='bluebar' name='city' maxlength='50' tabindex='1011' value="{$data.city}"  />
						</li>
					</ul>
					<ul>
						<li class="txt">Country:<span class='required'>*</span></li>
						<li>
							<select name="country" class="bluebar" id="country" tabindex="1012">
								<option value="">--select country--</option>
								{foreach from=$countries item='con'}
								{if $con.country_id eq $data.country}
									<option value="{$con.country_id}" selected="selected">{$con.countryname}</option>
									{else}
									<option value="{$con.country_id}">{$con.countryname}</option>
								{/if}
							{/foreach}	
							</select>
						</li>
					</ul>
					<ul>
						<li class="txt">Telephone:<span class='required'>*</span></li>
						<li>
							<input type='text' class='bluebar' name='phone' maxlength='15' tabindex='1013' value="{$data.phone}"  />
						</li>
					</ul>
					<ul>
						<li class="txt">Cell:</li>
						<li>
							<input type='text' class='bluebar' name='cell' maxlength='15' tabindex='1014' value="{$data.cell}"  />
						</li>
					</ul>
					<ul>
						<li class="txt">Fax:</li>
						<li>
							<input type='text' class='bluebar' name='fax' maxlength='15' tabindex='1015' value="{$data.fax}"  />
						</li>
					</ul>
					<ul>
						<li class="txt">Please select your current industry:<span class='required'>*</span></li>
						<li>
							<select name='currentindustry' class='bluebar' tabindex='1016' id='currentindustry'>
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
						selectDropdown('currentindustry' , '{$data.currentindustry}');
					</script>
					<ul>
						<li class="txt">Specify Other:</li>
						<li>
							<input type='text' class='bluebar' name='industryother' maxlength='30' tabindex='1017' value="{$data.industryother}"  />
						</li>
					</ul>
					<ul>
						<li class="txt">What function best describes your position:<span class='required'>*</span></li>
						<li>
							<select name='position' class='bluebar' tabindex='1018' id='position'>
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
						selectDropdown('position' , '{$data.position}');
					</script>
					<ul>
						<li class="txt">Specify Other:</li>
						<li>
							<input type='text' class='bluebar' name='positionother' maxlength='30' tabindex='1018' value="{$data.positionother}"  />
						</li>
					</ul>
					<ul>
						<li style='width:267px;'>&nbsp;</li>
						<li>
							<button type='submit' class='next-apply' tabindex='1019'>Update &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
						</li>	
					
					</ul>
					</div>
				</form>	 
				</div>  	
		  </div>
    </div>
  </div>
</div>
<div class="clear"></div>
<div class="tabs_bar">
	<div class="tabs"></div>
</div>
{include file="footer.tpl"}
</div>
{include_php file="bar.php"}
</body>
</html>