{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file="$tpl_path/top_header.tpl"}
<link href="{$GENERAL.BASE_URL_ROOT}/css/black-calender.css" rel=stylesheet type="text/css">
{literal}

<script type="text/javascript">
        function TogglePanel(divId)
        {
             var divPane = document.getElementById(divId);
            if(divPane.style.display == "none")
            {
                divPane.style.display = "";
            }
            else if(divPane.style.display == "block" || divPane.style.display == "")
            {
                divPane.style.display = "none";
            }
        }
		
		function submitExport()
		{
			document.getElementById('action').value = "export";
			document.forms[0].submit();
		}
		
		function submitForm()
		{
			document.forms[0].submit();
		}

	function deleteconfirmation(id)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href='alumnimanagement.php?action=del&id='	+ id;
		}	
	}
	
	function sortRecords(col, order)
	{
		document.getElementById('action').value = "";
		document.forms[0].sortcolumn.value = col;
		
		if(order == true)
		{
			if(document.forms[0].sortdirection.value == "asc")
			{
				document.forms[0].sortdirection.value = "desc";
			}
			else
			{
				document.forms[0].sortdirection.value = "asc";
			}
		}
		document.forms[0].submit();	
	}
	
	function showIndustryDiv(param)
	{
		if(param == "other")
		{
			document.getElementById('divindustryother').style.display = 'block';
		}
		else
		{
			document.getElementById('divindustryother').style.display = 'none';
		}
	}
	
	function showPositionDiv(param)
	{
		if(param == "other")
		{
			document.getElementById('divpositionother').style.display = 'block';
		}
		else
		{
			document.getElementById('divpositionother').style.display = 'none';
		}
	}
  </script>
{/literal}
</head>
<body>
<table width="991" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15"> {include file="$tpl_path/header.tpl"} </td>
  </tr>
  <tr>
    <td height="15" class="boder"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" /></td>
  </tr>
  <tr>
  
  <td class="boder">
  
  {* Smarty *}
  {if $pageview eq "add" or $pageview eq "edit"}
  <!--- content area form --->
  <form action="{$GENERAL.BASE_URL_ADMIN}/alumnimanagement.php?action=submit&mode={$pageview}{if $pageview eq 'edit'}&id={$smarty.get.id}{/if}" method="post"  enctype="multipart/form-data">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/grad_profiles_icon.png" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle"><span class="tableHeader">Alumni Manager</span></span><span class="pageTitle1">[{if $pageview eq 'add'}Add{else}Edit{/if} Alumni]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                          Save</a> </td>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/alumnimanagement.php'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />Cancel</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div></td>
              <td width="10" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="10"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
      {if $error ne ""}
      <tr>
        <td height="10" class="errorBar">{$error}</td>
      </tr>
      <tr>
        <td height="10"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
      {/if}
     
       <tr>
	    <td class="boderInner2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="10" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" align="center">&nbsp;</td>
              <td width="617" valign="top" class="boderInner2"><table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox"><input type="hidden" name="id" value="" />                    </td>
                  </tr>
				<tr>
					<td colspan="2" style="padding-left:180px;" ><span class="th">Personal Data</span></td>
				</tr>
                 
				  <tr class="row2">
                    <td width="50%" align="right" valign="top">Prefix :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="prefix" class="select_class">
							<option value="Mr." {if $data.prefix eq 'Mr.'} selected="selected" {/if}>Mr.</option>
							<option value="Mrs." {if $data.prefix eq 'Mrs.'} selected="selected" {/if}>Mrs.</option>
							<option value="Miss" {if $data.prefix eq 'Miss'} selected="selected" {/if}>Miss</option>
							<option value="Ms." {if $data.prefix eq 'Ms.'} selected="selected" {/if}>Ms.</option>
							<option value="Dr." {if $data.prefix eq 'Dr.'} selected="selected" {/if}>Dr.</option>
						</select>
                      <span class="required">&nbsp;*</span></td>
                  </tr> 

                  <tr class="row2">
                    <td width="19%" align="right" valign="top">First Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="firstname" class="input" value="{$data.firstname|escape}"  maxlength="30" readonly="true"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr> 
                  {*
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">Middle Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="middlename" class="input" value="{$data.middlename|escape}"  maxlength="30"/>&nbsp;<span class="required">&nbsp;*</span>
                    </td>
                  </tr> 
                  *}
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">Last Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="lastname" class="input" value="{$data.lastname|escape}"  maxlength="30" readonly="true"/>
					    <span class="required">&nbsp;*</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Nationality :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="nationality" class="input" value="{$data.nationality|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Business Email :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="email" class="input" value="{$data.email|escape}"  maxlength="50" readonly="true"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  

				<tr>
					<td colspan="2" style="padding-left:180px;"><span class="th">Contact Data</span></td>
				</tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Designation :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="designation" class="input" value="{$data.designation|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Company/Organization Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="companyname" class="input" value="{$data.companyname|escape}"  maxlength="50"/><span class="required">&nbsp;&nbsp;*</span>
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Parent Company Name (If different from company name) :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="companyother" class="input" value="{$data.companyother|escape}"  maxlength="50"/><span class="required">&nbsp;</span>
                      </td>
                  </tr>
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Organization Address :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="companyaddress" class="input" value="{$data.companyaddress|escape}"  maxlength="150"/><span class="required">&nbsp;&nbsp;*</span>
                     </td>
					</tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">City :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="city" class="input" value="{$data.city|escape}"  maxlength="50"/>
                    </td>
                  </tr>
				  <!--<tr class="row2">
                    <td width="19%" align="right" valign="top">Country :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="country" class="input" value="{$data.country|escape}"  maxlength="100"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>-->
				  <tr class="row2">
                        <td width="19%" align="right" valign="top">Country:&nbsp;</td>
						
                        <td width="86%" align="left"><select name="country" class="select_class" id="country">
                          
							{foreach from=$countries item="country"}
							
                          <option value="{$country.country_id}" {if $country.country_id eq $data.country} selected="selected" {/if}>{$country.countryname}</option>
                          
							{/foreach}
						
                        </select>
                          
                      </tr>
  				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Telephone :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="phone" class="input" value="{$data.phone|escape}"  maxlength="15"/>
                     <span class="required">&nbsp;*</span></td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Cell  :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="cell" class="input" value="{$data.cell|escape}"  maxlength="15"/>
                    </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Fax  :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="fax" class="input" value="{$data.fax|escape}"  maxlength="15"/>
                     </td>
                  </tr>                
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Please select your current industry :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="currentindustry" class="select_class" onchange="showIndustryDiv(this.options[this.selectedIndex].value)">
							<option value="Software/Hardware" {if $data.currentindustry eq 'Software/Hardware'} selected="selected" {/if}>Software/Hardware</option>
							<option value="Textile" {if $data.currentindustry eq 'Textile'} selected="selected" {/if}>Textile</option>
							<option value="Oil and Gas" {if $data.currentindustry eq 'Oil and Gas'} selected="selected" {/if}>Oil and Gas</option>
							<option value="Carpet" {if $data.currentindustry eq 'Carpet'} selected="selected" {/if}>Carpet</option>
							<option value="Accounting" {if $data.currentindustry eq 'Accounting'} selected="selected" {/if}>Accounting</option>
							<option value="Advocacy/Legal" {if $data.currentindustry eq 'Advocacy/Legal'} selected="selected" {/if}>Advocacy/Legal</option>
							<option value="Advertising/Media" {if $data.currentindustry eq 'Advertising/Media'} selected="selected" {/if}>Advertising/Media</option>
							<option value="Armed Forces" {if $data.currentindustry eq 'Armed Forces'} selected="selected" {/if}>Armed Forces</option>
							<option value="Banking /Financial Services" {if $data.currentindustry eq 'Banking /Financial Services'} selected="selected" {/if}>Banking /Financial Services</option>
							<option value="Computer Related Services" {if $data.currentindustry eq 'Computer Related Services'} selected="selected" {/if}>Computer Related Services</option>
							<option value="Construction" {if $data.currentindustry eq 'Construction'} selected="selected" {/if}>Construction</option>
							<option value="Consultancy" {if $data.currentindustry eq 'Consultancy'} selected="selected" {/if}>Consultancy</option>
							<option value="Education" {if $data.currentindustry eq 'Education'} selected="selected" {/if}>Education</option>
							<option value="Engineering" {if $data.currentindustry eq 'Engineering'} selected="selected" {/if}>Engineering</option>
							<option value="Entertainment/Leisure" {if $data.currentindustry eq 'Entertainment/Leisure'} selected="selected" {/if}>Entertainment/Leisure</option>
							<option value="Foundation" {if $data.currentindustry eq 'Foundation'} selected="selected" {/if}>Foundation</option>
							<option value="Government" {if $data.currentindustry eq 'Government'} selected="selected" {/if}>Government</option>
							<option value="Health Services" {if $data.currentindustry eq 'Health Services'} selected="selected" {/if}>Health Services</option>
							<option value="Hotels/Restaurants" {if $data.currentindustry eq 'Hotels/Restaurants'} selected="selected" {/if}>Hotels/Restaurants</option>
							<option value="Insurance" {if $data.currentindustry eq 'Insurance'} selected="selected" {/if}>Insurance</option>
							<option value="NGO" {if $data.currentindustry eq 'NGO'} selected="selected" {/if}>NGO</option>
							<option value="Printing & Packaging" {if $data.currentindustry eq 'Printing & Packaging'} selected="selected" {/if}>Printing & Packaging</option>
							<option value="Publishing" {if $data.currentindustry eq 'Publishing'} selected="selected" {/if}>Publishing</option>
							<option value="Real Estate" {if $data.currentindustry eq 'Real Estate'} selected="selected" {/if}>Real Estate</option>
							<option value="Retailing/Wholesaling" {if $data.currentindustry eq 'Retailing/Wholesaling'} selected="selected" {/if}>Retailing/Wholesaling</option>
							<option value="Social Services" {if $data.currentindustry eq 'Social Services'} selected="selected" {/if}>Social Services</option>
							<option value="Telecommunication" {if $data.currentindustry eq 'Telecommunication'} selected="selected" {/if}>Telecommunication</option>
							
							<option value="Trading" {if $data.currentindustry eq 'Trading'} selected="selected" {/if}>Trading</option>
							<option value="Transportation" {if $data.currentindustry eq 'Transportation'} selected="selected" {/if}>Transportation</option>
							<option value="Utilities" {if $data.currentindustry eq 'Utilities'} selected="selected" {/if}>Utilities</option>
							<option value="other" {if $data.currentindustry eq 'other'} selected="selected" {/if}>other</option>
						</select>
					<span class="required">&nbsp;*</span>
                      </td>
                  </tr>
				  <tr>
				  <td colspan="2" align="center">				  
				  <div id="divindustryother">
				  	<table width="100%" border="0" cellpadding="0" cellspacing="0">
				   <tr class="row2">
                    <td width="50%" align="right" valign="top">Specify Other :&nbsp;</td>
                    <td  align="left"><input type="text" name="industryother" class="input" value="{$data.industryother|escape}"  maxlength="30"/><span class="required">&nbsp;&nbsp;* <br />(if current industry not selected from dropdown)</span>
                      </td>
                  </tr>
				  </table>
				  </div>
				  <script language="javascript" type="text/javascript">
				  showIndustryDiv('{$data.currentindustry}');
				  </script>
				  </td>
				  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">What function best describes your position :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="position" class="select_class"  onchange="showPositionDiv(this.options[this.selectedIndex].value)">
							<option value="Accounting" {if $data.position eq 'Accounting'} selected="selected" {/if}>Accounting</option>
							<option value="Audit/Control" {if $data.position eq 'Audit/Control'} selected="selected" {/if}>Audit/Control</option>
							<option value="Administration" {if $data.position eq 'Administration'} selected="selected" {/if}>Administration</option>
							<option value="Customer Services" {if $data.position eq 'Customer Services'} selected="selected" {/if}>Customer Services</option>
						
						
						
						
						<option value="Engineering" {if $data.position eq 'Engineering'} selected="selected" {/if}>Engineering</option>
						<option value="Finance" {if $data.position eq 'Finance'} selected="selected" {/if}>Finance</option>
						<option value="Fund Raising" {if $data.position eq 'Fund Raising'} selected="selected" {/if}>Fund Raising</option>
						<option value="General Management" {if $data.position eq 'General Management'} selected="selected" {/if}>General Management</option>
						<option value="Legal" {if $data.position eq 'Legal'} selected="selected" {/if}>Legal</option>
						<option value="Human Resource/Personnel" {if $data.position eq 'Human Resource/Personnel'} selected="selected" {/if}>Human Resource/Personnel</option>
						<option value="Logistics" {if $data.position eq 'Logistics'} selected="selected" {/if}>Logistics</option>
						<option value="Manufacturing/Operations" {if $data.position eq 'Manufacturing/Operations'} selected="selected" {/if}>Manufacturing/Operations</option>
						<option value="MIS/IT" {if $data.position eq 'MIS/IT'} selected="selected" {/if}>MIS/IT</option>
						<option value="Marketing" {if $data.position eq 'Marketing'} selected="selected" {/if}>Marketing</option>
						<option value="Planning" {if $data.position eq 'Planning'} selected="selected" {/if}>Planning</option>
						<option value="Product Development" {if $data.position eq 'Product Development'} selected="selected" {/if}>Product Development</option>
						<option value="Project Management" {if $data.position eq 'Project Management'} selected="selected" {/if}>Project Management</option>
						<option value="Public Relations" {if $data.position eq 'Public Relations'} selected="selected" {/if}>Public Relations</option>
						<option value="Procurement" {if $data.position eq 'Procurement'} selected="selected" {/if}>Procurement</option>
						<option value="Research & Development" {if $data.position eq 'Research & Development'} selected="selected" {/if}>Research & Development</option>
						<option value="Sales" {if $data.position eq 'Sales'} selected="selected" {/if}>Sales</option>
						<option value="Teaching/Training" {if $data.position eq 'Teaching/Training'} selected="selected" {/if}>Teaching/Training</option>
							<option value="other" {if $data.position eq 'other'} selected="selected" {/if}>other</option>
						</select>
                   <span class="required">&nbsp;*</span> </td>
                  </tr>
				  <tr>
				  <td colspan="2" align="center">				  
				  <div id="divpositionother">
				  	<table width="100%" border="0" cellpadding="0" cellspacing="0">
				   <tr class="row2">
                    <td width="50%" align="right" valign="top">Specify Other :&nbsp;</td>
                    <td align="left"><input type="text" name="positionother" class="input" value="{$data.positionother|escape}"  maxlength="30"/><span class="required">&nbsp;&nbsp;* <br />(if function not selected from dropdown)</span>
                      </td>
                  </tr>
				  </table>
				  </div>
				  <script language="javascript" type="text/javascript">
				  showPositionDiv('{$data.position}');
				  </script>
				  </td>
				  </tr>

				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Enabled :&nbsp;</td>
                    <td width="81%" align="left"><select name="isactive" id="isactive" class="select_class">
						         <option value="Yes" {if $data.isactive eq "Yes"}selected="selected"{/if}>Yes</option>
								 <option value="No" {if $data.isactive eq "No"}selected="selected"{/if}>No</option>
							</select>
                     </td>
                  </tr>
				                             
                    </table></td>
           
		<td width="8">&nbsp;</td>
		<td width="315" valign="top"><table width="315" border="0" cellspacing="0" cellpadding="0">
			  
			  <tr>
				<td><div id="content-pane"  class="pane-sliders">
					<div class="panel"> <a href="Javascript:TogglePanel('help1');">
					  <h3 class="moofx-toggler title moofx-toggler-down"><span>Help</span></h3>
					  </a>
					  <div style="overflow: hidden; display: block; visibility: visible;  height: 1%;" class="normalTxt">
						<div style="padding: 5px;" id="help1">
						  <ul>
							<li>Fill in the fields and click on Save button</li>
							<li>To go back to Existing alumni, click Cancel button</li>
							<li>Fields marked with * are required</li>
						  </ul>
						</div>
					  </div>
					</div>
				  </div>
				  {literal}
				  <script>
					  //TogglePanel('help1');
					  </script>
				  {/literal}</td>
			  </tr>
			</table></td>
		<td width="10" valign="top">&nbsp;</td>
		</tr>
            <tr>
              <td height="10" colspan="5" align="center"></td>
            </tr>
          </table>
 </form>
  {elseif $pageview eq 'list'}
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/grad_profiles_icon.png" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle"><span class="tableHeader">Alumni Manager</span></span><span class="pageTitle1">[Programmes Attended]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                      <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/alumnimanagement.php'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />Back</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div></td>
              <td width="10" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="10"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
      {if $error ne ""}
      <tr>
        <td height="10" class="errorBar">{$error}</td>
      </tr>
      <tr>
        <td height="10"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
      {/if}
     
       <tr>
	    <td class="boderInner2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="10" colspan="5" align="center"></td>
            </tr>
            <tr >
          
          <td width="10" align="center" height="10"></td>
          <td width="617" valign="top" class="boderInner2" >
		  
         <table width="100%" border="0"  class="grid" style="padding-top:7px;">
             <tr class="row2" height="25px;	">
             	<td colspan="3" align="center">
                	<strong>{$alumniinfo.firstname} {$alumniinfo.lastname}</strong> <br />
                    [ {$alumniinfo.email} ]
                </td>
             </tr>
              <tr height="20">
				<td style="width:35%" align="center" ><a href="javascript:void(0)" class="th" >Programme Attended </a></td>
				<td style="width:28%" align="center" ><a href="javascript:void(0)"  class="th">Programme Date </a></td>
				<td style="width:37%" align="center" ><a href="javascript:void(0)"  class="th">Programme Instructor</a></td>
			  </tr>
                      <tr class="row1">
                        <td height="5" colspan="3" align="center" class="borderBtmDashed"></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td align="center">{$entry.name}</td>
                        <td align="center">{$entry.startdate} <strong>To</strong> {$entry.enddate}</td>
						<td align="center">{$entry.instructor}</td>
						
                       </tr>
                      {/foreach}
                     
					
					</table>
          </td>
          
          <td width="8">&nbsp;</td>
            <td width="315" valign="top"><table width="315" border="0" cellspacing="0" cellpadding="0">                
                <tr>
                  <td><div id="content-pane" class="pane-sliders">
                      <div class="panel"> <a href="Javascript:TogglePanel('help5');">
                        <h3 class="moofx-toggler title moofx-toggler-down"><span>Help</span></h3>
                        </a>
                        <div style="overflow: hidden; display: block; visibility: visible;  height: 1%;" class="normalTxt">
                          <div style="padding: 5px;" id="help5">
                            <ul>
                               <li>To go back to existing Alumni, click on the 'Back' button</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    {literal}
                    <script>
						  //TogglePanel('help5');
						  </script>
                    {/literal}</td>
                </tr>
              </table></td>
            <td width="10" valign="top">&nbsp;</td>
          </tr>
            <tr>
              <td height="10" colspan="5" align="center"></td>
            </tr>
          </table>
	
  <!--- content area  --->
  {else}
  <form action="{$GENERAL.BASE_URL_ADMIN}/alumnimanagement.php" method="post">

    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/grad_profiles_icon.png" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle">Alumni Manager </span><span class="pageTitle1">[Existing Alumni]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
					{*if $formvars.search_by_name neq "" or $formvars.search_by_companyname neq "" *}
					<td class="button" id="toolbar-apply" ><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-export.png" onclick="javascript:submitExport()" style="cursor:pointer;" /><br/> Export To CSV </a> </td>
					{*/if*}
					<!--<td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/alumnimanagement.php?action=add&subcatid={$subcatid|escape}&catid={$catid|escape}'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png" /><br/> Add </a> </td>-->
                    </tr>
                  </table>
                </div></td>
              <td width="10" valign="top"></td>
            </tr>
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
          </table></td>
      </tr>
	  
				

      <tr>
        <td height="10"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
      {if $error ne ""}
      <tr>
        <td height="10" class="errorBar"> {$error} </td>
      </tr>
      <tr>
        <td height="10"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
      {/if}
      <tr>
        <td class="boderInner2">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10" colspan="5" align="center">
			<input type="hidden" name="sortcolumn" value="{$sortcolumn}" />
                <input type="hidden" name="sortdirection" value="{$sortdirection}" />
				<input type="hidden" name="action" id="action" value="" />
			</td> </tr>
			<tr>
			<td colspan="3" align="left">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:7px;">
				<tr>
				<td class="th" width="20" style="padding-left:12px; padding-top:5px;">Name:</td>
				<td  width="20" style="padding-left:7px; padding-top:5px;"><input type="text" name="search_by_name" class="input" value="{$formvars.search_by_name}"  maxlength="100"/></td>
				<td class="th" width="10" style="padding-left:7px; padding-top:5px;">Organization:</td>
				<td  width="20" style="padding-left:7px; padding-top:5px;"><input type="text" name="search_by_companyname" class="input" value="{$formvars.search_by_companyname}"  maxlength="100"/></td>
				</tr>
				<tr>
				<td class="th" width="20" style="padding-left:12px; padding-top:5px;">Programme Name:</td>
				<td  width="20" style="padding-left:7px; padding-top:5px;"><input type="text" name="search_by_pname" class="input" value="{$formvars.search_by_pname}"  maxlength="100"/></td>
				
				<td style="padding-left:7px; padding-top:5px;"><input class="grid" type="button" name="Submit" value="Search" onclick="javascript: submitForm();"  /></td>
				</tr>
				</table>
			</td>
			</tr>
            
         
          <tr >
          
          <td width="10" align="center" height="10"></td>
          <td width="617" valign="top" class="boderInner2" >
		  
         <table width="100%" border="0"  class="grid" style="padding-top:7px;">
              <tr  height="20">
				<td style="width:30%" align="center" ><a href="javascript:sortRecords('1',true)" class="th" >Name</a></td>
				<td style="width:15%" align="center" ><a href="javascript:sortRecords('3',true)"  class="th">Email</a></td>
				<td style="width:15%" align="center" ><a href="javascript:sortRecords('4',true)"  class="th">Organization</a></td>
				<td style="width:15%" align="center" ><a href="javascript:sortRecords('5',true)"  class="th">Designation</a></td>
				<td style="width:15%" align="center" ><a href="javascript:sortRecords('7',true)" class="th">No of Programmes</a></td>
				<td style="width:15%" align="center" ><a href="javascript:void(0)" class="th">Programmes</a></td>					
				<!--<td style="width:15%" align="center" ><a href="javascript:sortRecords('isactive',true)"  class="th">Enabled</a></td>-->
				<td style="width:15%" align="center" ><a href="javascript:sortRecords('8',true)"  class="th">Dated</a></td>
				 <td align="center" class="th">Edit</td>
				<td align="center" class="th">Delete</td>
			 </tr>
                      <tr class="row1">
                        <td height="5" colspan="9" align="center" class="borderBtmDashed"></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td align="center">{$entry.firstname|truncate:12}</td>
                        <td align="center">{$entry.email|truncate:12}</td>
						<td align="center">{$entry.companyname|truncate:15}</td>
						<td align="center">{$entry.designation|truncate:15}</td>
						<td align="center">{$entry.numprogrammes}</td>
						<td align="center"><a href="{$GENERAL.BASE_URL_ADMIN}/alumnimanagement.php?action=listprog&aid={$entry.aid}" class="link">view</a></td>
						<!--<td align="center">{$entry.isactive}</td>-->
						<td align="center">{$entry.registrationdate}</td>
						<td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/alumnimanagement.php?action=edit&id={$entry.aid|escape}'"  class="btnText"  /> </td>
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.aid|escape}');"  class="btnText"  /> </td>
                       </tr>
                      {/foreach}
                     
					{if $countRecords gt 20}
					  <tr>
                        <td colspan="9" align="center"> {$paging} </td>
                      </tr>                      
                    {/if}
					</table>
          </td>
          
          <td width="8">&nbsp;</td>
            <td width="315" valign="top"><table width="315" border="0" cellspacing="0" cellpadding="0">                
                <tr>
                  <td><div id="content-pane" class="pane-sliders">
                      <div class="panel"> <a href="Javascript:TogglePanel('help5');">
                        <h3 class="moofx-toggler title moofx-toggler-down"><span>Help</span></h3>
                        </a>
                        <div style="overflow: hidden; display: block; visibility: visible;  height: 1%;" class="normalTxt">
                          <div style="padding: 5px;" id="help5">
                            <ul>
                              <li>To Add a new record, click the 'Add' button</li>
                              <li>To Edit a record, click on the 'Edit' button against the record</li>
                              <li>To Delete a record, click on the 'Delete' button against the record</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    {literal}
                    <script>
						  //TogglePanel('help5');
						  </script>
                    {/literal}</td>
                </tr>
              </table></td>
            <td width="10" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td height="10" colspan="5" align="center"></td>
          </tr>
        </table>
      </td>      
      </tr>     
    </table>
  </form>
  {/if}
  </td>
</tr>
   {include file="$tpl_path/footer.tpl"}
</table>
</body>
</html>