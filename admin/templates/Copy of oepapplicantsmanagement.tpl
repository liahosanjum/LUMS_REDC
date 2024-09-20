{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file="$tpl_path/top_header.tpl"}

<!--<script type="text/javascript" src="{$GENERAL.BASE_DIR_ROOT}/jscript/calendar/jquery.js"></script>
<script type="text/javascript" src="{$GENERAL.BASE_DIR_ROOT}/jscript/calendar/jquery.datePicker.js"></script>
<script type="text/javascript" src="{$GENERAL.BASE_DIR_ROOT}/jscript/calendar/date.js"></script>
<script type="text/javascript" src="{$GENERAL.BASE_DIR_ROOT}/jscript/calendar/jquery.bigiframe.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="{$GENERAL.BASE_DIR_ROOT}/jscript/calendar/jquery.datePicker.css">
-->
<script language="javascript" src='{$GENERAL.BASE_URL_ROOT}/jscript/jquery.js'></script>
<script language="javascript" src='{$GENERAL.BASE_URL_ROOT}/jscript/jscripts.js'></script>
<script src="{$GENERAL.BASE_URL_ROOT}/jscript/CalendarPopup.js"></script>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>
<link href="{$GENERAL.BASE_URL_ROOT}/css/black-calender.css" rel=stylesheet type="text/css">

{literal}
<script type="text/javascript">
		function explode (delimiter, string, limit) {
			var emptyArray = { 0: '' };
			
			// third argument is not required
			if ( arguments.length < 2 ||
				typeof arguments[0] == 'undefined' ||
				typeof arguments[1] == 'undefined' )
			{
				return null;
			}
		 
			if ( delimiter === '' ||
				delimiter === false ||
				delimiter === null )
			{
				return false;
			}
		 
			if ( typeof delimiter == 'function' ||
				typeof delimiter == 'object' ||
				typeof string == 'function' ||
				typeof string == 'object' )
			{
				return emptyArray;
			}
		 
			if ( delimiter === true ) {
				delimiter = '1';
			}
			
			if (!limit) {
				return string.toString().split(delimiter.toString());
			} else {
				// support for limit argument
				var splitted = string.toString().split(delimiter.toString());
				var partA = splitted.splice(0, limit - 1);
				var partB = splitted.join(delimiter.toString());
				partA.push(partB);
				return partA;
			}
		}


 	   function setName(obj)
	   {
	   		var namearray = Array();
	   		if(obj.value != '')
			{
				var comboValue;
				var selIndex = obj.selectedIndex;
				comboValue = obj.options[selIndex].text;
				namearray = explode('.' , comboValue);
				document.getElementById('firstname').value = namearray[0];
				document.getElementById('lastname').value = namearray[1];
			}
			else
			{
				document.getElementById('firstname').value = "";
				document.getElementById('lastname').value = "";
			}
	   }
 
  	   function ismaxlength(obj)
	   {
			var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
			if (obj.getAttribute && obj.value.length>mlength)
			obj.value=obj.value.substring(0,mlength)
		}

	  
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
		function submitSearch()
		{
			document.getElementById('action').value = "view";
			document.forms[0].submit();
		}
		function submitFormAlumni()
		{
			document.getElementById("action").value = "alumni";
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
			window.location.href='oepapplicantsmanagement.php?action=del&id='+ id+"&iscompleted={/literal}{$smarty.get.iscompleted}{literal}";
		}	
	}
	
	function sortRecords(col, order)
	{
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
	
	function viewParticipant(id)
	{
		window.location.href = 'ofpparticipantmanagement.php?ofpid='+id;
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

 
 /*jquery calendar----------------------------------------*/
/*$(function()
{
	$('.date-pick').datePicker()
	$('#startdate').bind(
		'dpClosed',
		function(e, selectedDates)
		{
			var d = selectedDates[0];
			if (d) {
				d = new Date(d);
				$('#enddate').dpSetStartDate(d.addDays(1).asString());
			}
		}
	);
	$('#enddate').bind(
		'dpClosed',
		function(e, selectedDates)
		{
			var d = selectedDates[0];
			if (d) {
				d = new Date(d);
				$('#startdate').dpSetEndDate(d.addDays(-1).asString());
			}
		}
	);
});

*/  

</script>
{/literal}
{literal}
<style>
a.dp-choose-date {
background:transparent url(../jscript/calendar/calendar.png) no-repeat scroll 0 0;
display:block;
overflow:hidden;
padding:0;
text-indent:-2000px;
width:16px;
}

</style>
{/literal}
</head>
<body onload="return setName(document.getElementById(uid));">
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?action=submit&mode={$pageview}{if $pageview eq 'edit'}&id={$data.oepaid}{/if}&iscompleted={$smarty.get.iscompleted}" method="post"  enctype="multipart/form-data" name="frmadd">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/application_manager.gif" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle"><span class="tableHeader">OEP Applicants Manager</span></span><span class="pageTitle1">[{if $pageview eq 'add'}Add{else}Edit{/if} applicants]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        {if $programme ne ''}
						<td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                          Save</a> </td>
						  {/if}
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?pid={$pid}&iscompleted={$smarty.get.iscompleted}'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />Cancel</a></td>
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
              <td width="617" valign="top" class="boderInner2">
			  	{if $programme ne ''}
					<table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox">
						
					</td>
                  </tr>
                <!--  <tr class="row2">
                    <td width="24%" align="right" valign="top">Email (user name) :&nbsp;</td>
                    <td width="76%" align="left">
					<input type="text" name="username" class="input" value="{$data.username|escape}"  maxlength="100"/>
					<input type="hidden" name="uid" value="{$data.uid|escape}"/>
					<input type="hidden" name="prevname" value="{$oldemail}"/>
					<input type="hidden" name="oepaid" value="{$data.oepaid|escape}"/>
					<input type="hidden" name="pid" value="{$pid|escape}"/>
					
				      <span class="required">&nbsp;*</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="24%" align="right" valign="top">Password :&nbsp;</td>
                    <td width="76%" align="left"><input type="password" name="password" class="input" value="{$data.password|escape}"  maxlength="100"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="24%" align="right" valign="top">Re-type Password :&nbsp;</td>
                    <td width="76%" align="left"><input type="password" name="confpassword" class="input" value="{$confpass|escape}"  maxlength="100"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr> -->
				
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Select User :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="uid" id="uid" class="select_class" onchange="return setName(this);">
							<option value="">--select--</option>
							{foreach from=$users item='u'}
								{if $u.uid eq $data.uid and $u.firstname ne ''}
									<option value="{$u.uid}" selected="selected">{$u.firstname}.{$u.lastname}</option>
									{elseif $u.firstname ne ''}
									<option value="{$u.uid}">{$u.firstname}.{$u.lastname}</option>
								{/if}
								
							{/foreach}
						</select>
                      <span class="required">&nbsp;*</span> OR <a href="usermanagement.php">create new user</a></td>
                  </tr>
 				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  

				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Personal Data</span></td>
				</tr>
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">First Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="firstname" id="firstname" class="input" value="{$data.firstname|escape}"  maxlength="30" readonly="true"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr> 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">Middle Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="middlename" class="input" value="{$data.middlename|escape}"  maxlength="30"/>
                    </td>
                  </tr> 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">Last Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="lastname" id="lastname" class="input" value="{$data.lastname|escape}"  maxlength="30" readonly="true"/>
                    </td>
                  </tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Prefix :&nbsp;</td>
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
                    <td width="19%" align="right" valign="top">Gender :&nbsp;</td>
                    <td width="81%" align="left">
						Male: <input type="radio" name="gender" value="male" {if $data.gender eq 'male'} checked="checked" {/if} /> &nbsp;
						Female: <input type="radio" name="gender" value="female" {if $data.gender eq 'female'} checked="checked" {/if} />
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Nationality :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="nationality" class="input" value="{$data.nationality|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Business Email :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="busemail" class="input" value="{$data.busemail|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  

				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">In case of emergency, please notify</span></td>
				</tr>  
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Name :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="emergencyname" class="input" value="{$data.emergencyname|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Telephone :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="emergencyphone" class="input" value="{$data.emergencyphone|escape}"  maxlength="15"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Contact Data</span></td>
				</tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Designation :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="contactdesignation" class="input" value="{$data.contactdesignation|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Company/Organization Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="companyname" class="input" value="{$data.companyname|escape}"  maxlength="50"/><span class="required">&nbsp;*</span>
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Parent Company Name (If different from company name) :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="companyother" class="input" value="{$data.companyother|escape}"  maxlength="50"/><span class="required">&nbsp;</span>
                      </td>
                  </tr>
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Organization Address :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="companyaddress" class="input" value="{$data.companyaddress|escape}"  maxlength="150"/><span class="required">&nbsp;*</span>
                     </td>
					</tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">City :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="city" class="input" value="{$data.city|escape}"  maxlength="50"/>
                    </td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Country :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="country" class="select_class" >
							{foreach from=$countries item='con'}
								{if $con.country_id eq $data.country}
									<option value="{$con.country_id}" selected="selected">{$con.countryname}</option>
									{else}
									<option value="{$con.country_id}">{$con.countryname}</option>
								{/if}
								
							{/foreach}
						</select>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
  				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Telephone :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="ctelephone" class="input" value="{$data.ctelephone|escape}"  maxlength="15"/>
                     <span class="required">&nbsp;*</span></td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Cell Number :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="cell" class="input" value="{$data.cell|escape}"  maxlength="15"/>
                    </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Fax Number :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="fax" class="input" value="{$data.fax|escape}"  maxlength="15"/>
                     </td>
                  </tr>   
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Organisational Data</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Your Parent Company/Organization</span></td>
				</tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Products/Services :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='300' name="parentservices" id="parentservices" class="txtArea" onkeyup="return ismaxlength(this)">{$data.parentservices|escape}</textarea>
                      <span class="required">&nbsp;</span></td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">No. of Employees :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="parentnumemployees" class="input" value="{$data.parentnumemployees|escape}"  maxlength="10"/><span class="required">&nbsp;</span>
                      </td>
                  </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Your Company/Division</span></td>
				</tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Products/Services :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='300' name="services" id="services" class="txtArea" onkeyup="return ismaxlength(this)">{$data.services|escape}</textarea>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">No. of Employees :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="numemployees" class="input" value="{$data.numemployees|escape}"  maxlength="10"/><span class="required">&nbsp;*</span>
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">How many employees are under your direct supervision? :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="numemployeessupervision" class="input" value="{$data.numemployeessupervision|escape}"  maxlength="10"/><span class="required">&nbsp;*</span>
                      </td>
                  </tr>
				 
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">What is the title position of the person to whom you report? :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="reportperson" class="input" value="{$data.reportperson|escape}"  maxlength="30"/><span class="required">&nbsp;*</span>
                     </td>
					</tr> 
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Please select your current industry :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="industry" class="select_class" id="org_industry">
							<option value='Accounting'>Accounting</option>
							<option value='Advocacy/Legal'>Advocacy/Legal</option>
							<option value='Advertising/Media'>Advertising/Media</option>
							<option value='Agriculture'>Agriculture</option>
							<option value='Armed Forces'>Armed Forces</option>
							<option value='Automotive/Transport'>Automotive/Transport</option>
							<option value='Banking /Financial Services'>Banking /Financial Services</option>
							<option value='Carpet'>Carpet</option>
							<option value='Chemicals'>Chemicals</option>
							<option value='Computer Related Services'>Computer Related Services</option>
							<option value='Consumer Products'>Consumer Products</option>
							<option value='Construction'>Construction</option>
							<option value='Consultancy'>Consultancy</option>
							<option value='Education'>Education</option>
							<option value='Engineering'>Engineering</option>
							<option value='Entertainment/Leisure'>Entertainment/Leisure</option>
							<option value='Food and Beverage'>Food and Beverage</option>
							<option value='Foundation'>Foundation</option>
							<option value='Government'>Government</option>
							<option value='Health Services'>Health Services</option>
							<option value='High technology/Electronic Devices'>High technology/Electronic Devices</option>
							<option value='Hotels/Restaurants'>Hotels/Restaurants</option>
							<option value='Insurance'>Insurance</option>
							<option value='Machinery and Equipment'>Machinery and Equipment</option>
							<option value='Material Suppliers'>Material Suppliers</option>
							<option value='Medical Healthcare'>Medical Healthcare</option>
							<option value='NGO'>NGO</option>
							<option value='Oil and Gas'>Oil and Gas</option>
							<option value='Pharmaceuticals'>Pharmaceuticals</option>
							<option value='Printing & Packaging'>Printing & Packaging</option>
							<option value='Publishing'>Publishing</option>
							<option value='Real Estate'>Real Estate</option>
							<option value='Retailing/Wholesaling'>Retailing/Wholesaling</option>
							<option value='Social Services'>Social Services</option>
							<option value='Software/Hardware'>Software/Hardware</option>
							<option value='Telecommunication'>Telecommunication</option>
							<option value='Textile'>Textile</option>
							<option value='Trading'>Trading</option>
							<option value='Transportation'>Transportation</option>
							<option value='Utilities'>Utilities</option>
							<option value=''>other</option>			
						</select>
					<span class="required">&nbsp;*</span>
                      </td>
					  <script language='javascript'>
						selectDropdown('org_industry' , '{$data.industry}');
					  </script>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Specify Other :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="industryother" class="input" value="{$data.industryother|escape}"  maxlength="30"/><span class="required">&nbsp;</span>
                      </td>
                  </tr>
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">What function best describes your position :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="position" class="select_class">
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
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Specify Other :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="positionother" class="input" value="{$data.positionother|escape}"  maxlength="30"/><span class="required">&nbsp;</span>
                      </td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Professional Data</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Work Experience</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span>Please list your last three positions in reverse chronological order starting with your current one. If all are in the same company, please give the major promotional sequence.</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="company1" class="input" value="{$data.company1|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="position1" class="input" value="{$data.position1|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				 <!-- {literal}
						<script language="JavaScript" id="jscal1x">
						var cal1x = new CalendarPopup("testdiv1");
						</script>
				   {/literal}-->
				    	
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">From (MM/YYYY):&nbsp;</td>
                    <td width="81%" align="left">
						<!--<div style="float:left;"><input name="from1" id="from1" value="{$data.from1|escape}" size="25" type="text" onfocus="cal1x.select(document.frmadd.from1,'from1','dd-MM-yyyy'); return false;" onclick="cal1x.select(document.frmadd.from1,'from1','dd-MM-yyyy'); return false;" class="input" readonly="" />
                      <span class="required">&nbsp;* </span></div><div style="float:left;"><a href="javascript:void(0)" class="dp-choose-date" onclick="cal1x.select(document.frmadd.from1,'from1','dd-MM-yyyy'); return false;">choose date</a></div>-->
					  <input type="text" name="from1" class="input" value="{$data.from1|escape}"  id="stamp1"> <span class="required">&nbsp;*</span>
                      <!--<input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp1);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
					   <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                        <tr>
                          <td id="ds_calclass"></td>
                        </tr>
                      </table>-->
					  </td>
                  </tr>
				  <!--{literal}
                      <script src="scripts/black-calender.js" language="javascript"></script>
                  {/literal}-->
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">To (MM/YYYY):&nbsp;</td>
                    <td width="81%" align="left">
						<!--<div style="float:left;"><input name="to1" id="to1" value="{$data.to1|escape}" size="25" type="text" onfocus="cal1x.select(document.frmadd.to1,'to1','dd-MM-yyyy'); return false;" onclick="cal1x.select(document.frmadd.to1,'to1','dd-MM-yyyy'); return false;" class="input" readonly="" />
                      <span class="required">&nbsp;*</span></div><div style="float:left;"> <a href="javascript:void(0)" class="dp-choose-date" onclick="cal1x.select(document.frmadd.to1,'to1','dd-MM-yyyy'); return false;">choose date</a></div>-->
					 <input type="text" name="to1" class="input" value="{$data.to1|escape}" id="stamp2"> <span class="required">&nbsp;*</span>
                    <!--  <input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp2);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
                     
                      <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                        <tr>
                          <td id="ds_calclass"></td>
                        </tr>
                      </table>-->
                     <!-- {literal}
                      <script src="scripts/black-calender.js" language="javascript"></script>
                      {/literal}-->
					
					</td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="company2" class="input" value="{$data.company2|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="position2" class="input" value="{$data.position2|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">From (MM/YYYY):&nbsp;</td>
                    <td width="81%" align="left">
					
					  <input type="text" name="from2" class="input" value="{$data.from2|escape}" id="stamp3">
                     <!-- <input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp3);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
					   <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                        <tr>
                          <td id="ds_calclass"></td>
                        </tr>
                      </table>-->
					  </td>
                  </tr>
				<!--  {literal}
                      <script src="scripts/black-calender.js" language="javascript"></script>
                  {/literal}-->
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">To (MM/YYYY):&nbsp;</td>
                    <td width="81%" align="left">
						
					 <input type="text" name="to2" class="input" value="{$data.to2|escape}" id="stamp4"> 
                     <!-- <input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp4);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
                   
                      <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                        <tr>
                          <td id="ds_calclass"></td>
                        </tr>
                      </table>-->
                     <!-- {literal}
                      <script src="scripts/black-calender.js" language="javascript"></script>
                      {/literal}-->
					
					</td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="company3" class="input" value="{$data.company3|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="position3" class="input" value="{$data.position3|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">From (MM/YYYY):&nbsp;</td>
                    <td width="81%" align="left">
					
					  <input type="text" name="from3" class="input" value="{$data.from3|escape}" id="stamp5">
                      <!--<input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp5);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
					   <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                        <tr>
                          <td id="ds_calclass"></td>
                        </tr>
                      </table>-->
					  </td>
                  </tr>
				  <!--{literal}
                      <script src="scripts/black-calender.js" language="javascript"></script>
                  {/literal}-->
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">To (MM/YYYY):&nbsp;</td>
                    <td width="81%" align="left">
						
					 <input type="text" name="to3" class="input" value="{$data.to3|escape}" id="stamp6"> 
                      <!--<input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp6);return false;" align="middle" value="Calender" style="cursor:pointer" border="0">
                   
                      <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                        <tr>
                          <td id="ds_calclass"></td>
                        </tr>
                      </table>-->
                     <!-- {literal}
                      <script src="scripts/black-calender.js" language="javascript"></script>
                      {/literal}-->
					
					</td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Please estimate total number of years of professional experience :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="numyearsexp" class="input" value="{$data.numyearsexp|escape}"  maxlength="5"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Please describe your current responsibilities in the organization :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='300' name="responsibility" id="responsibility" class="txtArea" onkeyup="return ismaxlength(this)">{$data.responsibility|escape}</textarea>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Management Level :&nbsp;</td>
                    <td width="81%" align="left">
						<select name='mgtlevel' class='select_class' tabindex='' id='pro_mgtlevel'>
							<option value='Top Management'>Top Management</option>
							<option value='Senior'>Senior</option>
							<option value='Upper Middle'>Upper Middle</option>
							<option value='Middle'>Middle</option>
							<option value=''>other</option>
						</select>
                      <span class="required">&nbsp;*</span></td>
					  			<script language='javascript'>
									selectDropdown('pro_mgtlevel' , '{$data.mgtlevel}');
								</script>
                  </tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Other(Please Specify) :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="mgtlevel_other" class="input" value="{$data.mgtlevel_other|escape}"  maxlength="250"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Education</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">University :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="university" class="input" value="{$data.university|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Year :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="year" class="input" value="{$data.year|escape}"  maxlength="5"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Degree (Highest level attended) :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="degree" class="input" value="{$data.degree|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td colspan="2" style="padding-left:5px;">If you have attended other REDC programmes, please list them below.</td>
				</tr>				

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Programme :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="atndotherredcprog1" class="input" value="{$data.atndotherredcprog1|escape}"  maxlength="250"/>
                      <span class="required">&nbsp;</span></td>
                </tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Date(MM/YYYY) :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="atndotherredcprogdate1" class="input" value="{$data.atndotherredcprogdate1|escape}"  maxlength="250"/>
                      <span class="required">&nbsp;</span></td>
                </tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Programme :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="atndotherredcprog2" class="input" value="{$data.atndotherredcprog2|escape}"  maxlength="250"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Date(MM/YYYY) :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="atndotherredcprogdate2" class="input" value="{$data.atndotherredcprogdate2|escape}"  maxlength="250"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Objectives</span></td>
				</tr>
				<tr class="row2">
                    <td colspan="2" style="padding-left:5px;">What are your objectives of attending this programme? What do you expect to achieve by the end of this programme?</td>
				</tr>
				<tr>	
                    <td width="19%" align="right">&nbsp;</td>
					<td width="81%" align="left">
						<textarea maxlength='300' name="objectives" id="objectives" class="txtArea" onkeyup="return ismaxlength(this)">{$data.objectives|escape}</textarea>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				<tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Sponsorship and Invoicing</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">I have read and accepted all policies written in the brochure. I understand that upon completion and receipt of invoice, the organisation will become liable for all charges including cancellation and transfer charges, if applicable.</span></td>
				</tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Name :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="name" class="input" value="{$data.name|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="designation" class="input" value="{$data.designation|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Address :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='150' name="address" id="address" class="txtArea" onkeyup="return ismaxlength(this)">{$data.address|escape}</textarea>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="telephone" class="input" value="{$data.telephone|escape}"  maxlength="20"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="sponsorfax" class="input" value="{$data.sponsorfax|escape}"  maxlength="20"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Email :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="email" class="input" value="{$data.email|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Website :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="website" class="input" value="{$data.website|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Name and address to which invoice should be sent (if different from above)</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Name :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="invoicename" class="input" value="{$data.invoicename|escape}"  maxlength="30"/>
                      <!--<span class="required">&nbsp;*</span>--></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="invoicedesignation" class="input" value="{$data.invoicedesignation|escape}"  maxlength="30"/>
                      <!--<span class="required">&nbsp;*</span>--></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Address :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='150' name="invoiceaddress" id="invoiceaddress" class="txtArea" onkeyup="return ismaxlength(this)">{$data.invoiceaddress|escape}</textarea>
                      <!--<span class="required">&nbsp;*</span>--></td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="invoicetelephone" class="input" value="{$data.invoicetelephone|escape}"  maxlength="20"/>
                      <!--<span class="required">&nbsp;*</span>--></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="invoicefax" class="input" value="{$data.invoicefax|escape}"  maxlength="20"/>
                     <!-- <span class="required">&nbsp;</span>--></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Email :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="invoiceemail" class="input" value="{$data.invoiceemail|escape}"  maxlength="50"/>
                      <!--<span class="required">&nbsp;*</span>--></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Website :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="invoicewebsite" class="input" value="{$data.invoicewebsite|escape}"  maxlength="50"/>
                     <!-- <span class="required">&nbsp;</span>--></td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Executive Development (Person in charge of management development in your company)</span></td>
				</tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Name :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="executivename" class="input" value="{$data.executivename|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="executivedesignation" class="input" value="{$data.executivedesignation|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Address :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='150' name="executiveaddress" id="executiveaddress" class="txtArea" onkeyup="return ismaxlength(this)">{$data.executiveaddress|escape}</textarea>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="executivetelephone" class="input" value="{$data.executivetelephone|escape}"  maxlength="20"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="executivefax" class="input" value="{$data.executivefax|escape}"  maxlength="20"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Email :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="executiveemail" class="input" value="{$data.executiveemail|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Website :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="executivewebsite" class="input" value="{$data.executivewebsite|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Do you wish to be informed about our programmes via email on regular basis? :&nbsp;</td>
                    <td width="81%" align="left">
						Yes: <input type="radio" name="informemail" value="yes" {if $data.informemail eq 'yes'} checked="checked" {/if} /> &nbsp;
						No: <input type="radio" name="informemail" value="no"  {if $data.informemail eq 'no'} checked="checked" {/if}  />
                      <span class="required">&nbsp;*</span></td>
                  </tr>

				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Do you wish to avail residence at REC-LUMS during the programme? :&nbsp;</td>
                    <td width="81%" align="left">
						Yes: <input type="radio" name="availresidence" value="yes" {if $data.availresidence eq 'yes'} checked="checked" {/if} /> &nbsp;
						No: <input type="radio" name="availresidence" value="no"  {if $data.availresidence eq 'no'} checked="checked" {/if}  />
                      <span class="required">&nbsp;*</span></td>
                  </tr>

				  
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Information Source</span></td>
				</tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">How did you learn about us? :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="learnabout" class="select_class">
							<option value="" {if $data.learnabout eq ''} selected="selected" {/if}>--select--</option>
							<option value="Website" {if $data.learnabout eq 'Website'} selected="selected" {/if}>Website</option>
							<option value="Executive Alumni" {if $data.learnabout eq 'Executive Alumni'} selected="selected" {/if}>Executive Alumni</option>
							<option value="Annual Brochure" {if $data.learnabout eq 'Annual Brochure'} selected="selected" {/if}>Annual Brochure</option>
							<option value="Referred by HR Department at LUMS" {if $data.learnabout eq 'Referred by HR Department at LUMS'} selected="selected" {/if}>Referred by HR Department at LUMS</option>
						
						<option value="Referred by HR Department of My Organization" {if $data.learnabout eq 'Referred by HR Department of My Organization'} selected="selected" {/if}>Referred by HR Department of My Organization</option>
						<option value="other" {if $data.learnabout eq 'other'} selected="selected" {/if}>Other</option>
						</select>
                   <span class="required">&nbsp;*</span> </td>
                  </tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Other (Please Specify) :&nbsp;</td>
                    <td width="81%" align="left">
						<input class="input" type="text" name="learnabout_other" id="info_learnabout_other" value="{$data.learnabout_other}" maxlength="250" tabindex="" />
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr>
					<td colspan="2" height="10">&nbsp;</td>
				</tr>				  {if $pid eq 0}
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">OEP Programmes :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="oepprogrammes" class="select_class" >
							{foreach from=$programme item='prog'}
								{if $prog.oepid eq $data.oepid}
									<option value="{$prog.oepid}" selected="selected">{$prog.name}</option>
									{else}
									<option value="{$prog.oepid}">{$prog.name}</option>
								{/if}
								
							{/foreach}
						</select>
						<span class="required">&nbsp;*</span>
                      </td>
                  </tr>
				  {else}
				  	<input type="hidden" name="oepprogrammes" value="{$pid}" />
				  {/if}
				<tr>
					<td colspan="2" height="10">&nbsp;</td>
				</tr>					  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Application Status :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="applicationstatus" class="select_class" >
							<option value="" {if $data.applicationstatus eq ''} selected="selected" {/if}>select</option>
							<option value="A" {if $data.applicationstatus eq 'A'} selected="selected" {/if}>Approve</option>
							<option value="R" {if $data.applicationstatus eq 'R'} selected="selected" {/if}>Reject</option>
						</select>
						<span class="required">&nbsp;</span>
                      </td>
                  </tr>
		                        
			  <tr><td colspan="2" height="5"></td></tr>
                  <tr>
                    <td colspan="2" align="center" valign="top" >
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td>
									  
									</td>
									
								  </tr>
							</table>

        			  </td>
                    </tr>
                                    
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox"></td>
                  </tr>
                </table>
				{else}
				
				<table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox">                   </td>
                  </tr>
                
				  <tr class="row2">
                    <td width="100%" colspan="2" align="center">No Programme Available</td>
                  </tr> 
				  
				  
		                        
			  <tr><td colspan="2" height="5"></td></tr>
                  <tr>
                    <td colspan="2" align="center" valign="top" >
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td>
									  
									</td>
									
								  </tr>
							</table>

        			  </td>
                    </tr>
                                    
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox"></td>
                  </tr>
                </table>
				{/if}
			  </td>
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
                                <li>To go back to Existing applicants, click Cancel button</li>
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
          </table></td>
      </tr>
    </table></form>
  
  <!--- content area  --->
  {else}
  {if $pageview eq "detail"}
 	
	 <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/application_manager.gif" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle"><span class="tableHeader">OEP Applicants Manager</span></span><span class="pageTitle1">[{if $pageview eq 'detail'}View{/if} applicant]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        {if $data.applicationstatus eq ''}
						<td class="button" id="toolbar-apply"><a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?status=A&oepaid={$data.oepaid}&action=submit&mode=change&pid={$pid}&iscompleted={$smarty.get.iscompleted}" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-apply.png" style="border:0px;"  /> <br />
                          Approve Application</a> </td>
						 <td class="button" id="toolbar-apply"><a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?status=R&oepaid={$data.oepaid}&action=submit&mode=change&pid={$pid}&iscompleted={$smarty.get.iscompleted}" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" style="border:0px;"  /> <br />
                          Reject Application</a> </td> 
						  {/if}
						 <!-- {if $data.applicationstatus eq 'R'}
						  <td class="button" id="toolbar-apply"><a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?status=A&oepaid={$data.oepaid}&action=submit&mode=change" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-apply.png" style="border:0px;"  /> <br />
                          Approve Application</a> </td>
						  {/if}
						  {if $data.applicationstatus eq 'A'}
						  <td class="button" id="toolbar-apply"><a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?status=R&oepaid={$data.oepaid}&action=submit&mode=change" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" style="border:0px;"  /> <br />
                          Reject Application</a> </td> 
						  {/if}-->
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?status={$data.applicationstatus}&pid={$pid}&iscompleted={$smarty.get.iscompleted}'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />Back</a></td>
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
              <td width="617" valign="top" class="boderInner2">
			 
					<table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox">
						
					</td>
                  </tr>
                
				  <tr class="row2">
                    <td width="24%" align="right" valign="top" class="fieldtitle">Email (user name) :&nbsp;</td>
                    <td width="76%" align="left">
					{$data.email|escape}
					<!--<input type="hidden" name="uid" value="{$data.uid|escape}"/>
					<input type="hidden" name="prevname" value="{$oldemail}"/>
					<input type="hidden" name="oepaid" value="{$data.oepaid|escape}"/>-->
					
				      <span class="required">&nbsp;</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="24%" align="right" valign="top" class="fieldtitle">Previously Attended Programmes :&nbsp;</td>
                    <td width="76%" align="left">
                    {foreach from=$programmes item="programme"}
					{$programme.name}<br />
                    {/foreach}
					</td>
                  </tr> 
				  
				 <!-- <tr class="row2">
                    <td width="24%" align="right" valign="top" class="fieldtitle">Password :&nbsp;</td>
                    <td width="76%" align="left">{$data.password|escape}
                      <span class="required">&nbsp;</span></td>
                  </tr> -->
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Personal Data</span></td>
				</tr>
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">First Name :&nbsp;</td>
                    <td width="81%" align="left">{$data.firstname|escape}
                      <span class="required">&nbsp;</span></td>
                  </tr> 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Middle Name :&nbsp;</td>
                    <td width="81%" align="left">{$data.middlename|escape}
                    </td>
                  </tr> 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Last Name :&nbsp;</td>
                    <td width="81%" align="left">{$data.lastname|escape}
                    </td>
                  </tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Prefix :&nbsp;</td>
                    <td width="81%" align="left">
							{$data.prefix}
					</td>
                  </tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Gender :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.gender}
					</td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Natoinality :&nbsp;</td>
                    <td width="81%" align="left">{$data.nationality|escape}
                    </td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Business Email :&nbsp;</td>
                    <td width="81%" align="left">{$data.busemail|escape}
                      </td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  

				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">In case of emergency, please notify</span></td>
				</tr>  
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="74%" align="left">{$data.emergencyname|escape}
                      <span class="required">&nbsp;</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="74%" align="left">{$data.emergencyphone|escape}
                      </td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Contact Data</span></td>
				</tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td width="81%" align="left">{$data.contactdesignation|escape}
                    </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Company/Organization Name :&nbsp;</td>
                    <td width="81%" align="left">{$data.companyname|escape}
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Parent Company Name (If different from company name) :&nbsp;</td>
                    <td width="81%" align="left">{$data.companyother|escape}
                      </td>
                  </tr>
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Organization Address :&nbsp;</td>
                    <td width="81%" align="left">{$data.companyaddress|escape}
                     </td>
					</tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">City :&nbsp;</td>
                    <td width="81%" align="left">{$data.city|escape}
                    </td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Country :&nbsp;</td>
                    <td width="81%" align="left">{$data.countryname|escape}</td>
                  </tr>
  				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="81%" align="left">{$data.ctelephone|escape}</td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Cell Number :&nbsp;</td>
                    <td width="81%" align="left">{$data.cell|escape}
                    </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Fax Number :&nbsp;</td>
                    <td width="81%" align="left">{$data.fax|escape}
                     </td>
                  </tr>   
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Organisational Data</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Your Parent Company/Organization</span></td>
				</tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Products/Services :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.parentservices|escape}
                     </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">No. of Employees :&nbsp;</td>
                    <td width="81%" align="left">{$data.parentnumemployees|escape}
                      </td>
                  </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Your Company/Division</span></td>
				</tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Products/Services :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.services|escape}</td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">No. of Employees :&nbsp;</td>
                    <td width="81%" align="left">{$data.numemployees|escape}
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">How many employees are under your supervision? :&nbsp;</td>
                    <td width="81%" align="left">{$data.numemployeessupervision|escape}
                      </td>
                  </tr>
				 
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">What is the title position of the person to whom you report? :&nbsp;</td>
                    <td width="81%" align="left">{$data.reportperson|escape}
                     </td>
					</tr> 
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Please select your current industry :&nbsp;</td>
                    <td width="81%" align="left">
				
							{$data.industry} 
						
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Specify Other :&nbsp;</td>
                    <td width="81%" align="left">{$data.industryother|escape}
                      </td>
                  </tr>
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">What function best describes your position :&nbsp;</td>
                    <td width="81%" align="left">
					
						{$data.position}
				</td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Specify Other :&nbsp;</td>
                    <td width="81%" align="left">{$data.positionother|escape}
                      </td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Professional Data</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Work Experience</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span>Please list your last three positions in reverse chronological order starting with your current one. If all are in the same company, please give the major promotional sequence.</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.company1|escape}
                      </td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.position1|escape}
                      </td>
                </tr>
				
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">From :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;">{$data.from1|escape}</div></td>
                  </tr>
				 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">To :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;">{$data.to1|escape}</div></td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.company2|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.position2|escape}</td>
                </tr>
				 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">From :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;">{$data.from2|escape}</div></td>
                  </tr>
				  
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">To :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;">{$data.to2|escape}</div></td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.company3|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.position3|escape}</td>
                </tr>
				
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">From :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;">{$data.from3|escape}</div></td>
                  </tr>
				 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">To :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;">{$data.to3|escape}</div></td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Please estimate total number of years of professional experience :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.numyearsexp|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Please describe your current responsibilities including your level in the organisation :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.responsibility|escape}</td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Management Level :&nbsp;</td>
                    <td width="81%" align="left">{$data.mgtlevel|escape}
                      </td>
                  </tr>				  
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Specify Other :&nbsp;</td>
                    <td width="81%" align="left">{$data.mgtlevel_other|escape}
                      </td>
                  </tr>		
				  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Education</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">University :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.university|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Year :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.year|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Degree (Highest level attended) :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.degree|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="100%" colspan="2" align="left" valign="top" class="fieldtitle">If you have attended other REDC programmes, please list them below.&nbsp;</td>
                </tr>
				
				
				
				
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Programme :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.atndotherredcprog1|escape}</td>
                </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Date(MM/YYYY) :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.atndotherredcprogdate1|escape}</td>
                </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Programme :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.atndotherredcprog2|escape}</td>
                </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Date(MM/YYYY) :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.atndotherredcprogdate2|escape}</td>
                </tr>
				
			
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Objectives</span></td>
				</tr>
				<tr class="row2">
                    <td colspan="2" style="padding-left:5px;" class="fieldtitle">What are your objectives of attending this programme? What do you expect to achieve by the end of this programme. :&nbsp;</td>
				</tr>
				<tr>	
                    <td width="19%" align="right">&nbsp;</td>
					<td width="81%" align="left">
						{$data.objectives|escape}</td>
                  </tr>
				<tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Sponsorship and Invoicing</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">I have read and accepted all policies written in the brochure. I understand that upon completion and receipt of invoice, the organisation will become liable for all charges including cancellation and transfer charges, if applicable.</span></td>
				</tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.name|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.designation|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.address|escape}</td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.telephone|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.sponsorfax|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.email|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Website :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.website|escape}</td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Name and address to which invoice should be sent (if different from above)</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoicename|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoicedesignation|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoiceaddress|escape}</td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoicetelephone|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoicefax|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoiceemail|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Website :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoicewebsite|escape}</td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Executive Development (Person in charge of management development in your company)</span></td>
				</tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executivename|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executivedesignation|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executiveaddress|escape}</td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executivetelephone|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executivefax|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executiveemail|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Website :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executivewebsite|escape}</td>
                </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Do you wish to be informed about our programmes via email on regular basis? :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.informemail}
						</td>
                  </tr>
				  
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Do you wish to avail residence at REC-LUMS during the programme? :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.availresidence}
						</td>
                  </tr>
				  
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Information Source</span></td>
				</tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">How did you learn about us? :&nbsp;</td>
                    <td width="81%" align="left">
					{$data.learnabout}
						</td>
                  </tr>	
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Other :&nbsp;</td>
                    <td width="81%" align="left">
					{$data.learnabout_other}
						</td>
                  </tr>		
				  
				  			<!--   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">OEP Programmes :&nbsp;</td>
                    <td width="81%" align="left">
						
							{foreach from=$programme item='prog'}
								{if $prog.oepid eq $data.oepid}
									{$prog.name}
								{/if}
							{/foreach}
					  </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Application Status :&nbsp;</td>
                    <td width="81%" align="left">
					
							{if $data.applicationstatus eq ''}  {/if}
							{if $data.applicationstatus eq 'A'}Approve {/if}
							{if $data.applicationstatus eq 'R'}Reject {/if}
					
                      </td>
                  </tr>-->
		                        
			  <tr><td colspan="2" height="5"></td></tr>
                  <tr>
                    <td colspan="2" align="center" valign="top" >
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td>
									  
									</td>
									
								  </tr>
							</table>

        			  </td>
                    </tr>
                                    
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox"></td>
                  </tr>
                </table>
			
			  </td>
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
                                <li>To Approve application, click the 'Approve Application' button</li>
								<li>To Reject application, click the 'Reject Application' button</li>
                                <li>To go back to Existing applicants, click 'Back' button</li>
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
          </table></td>
      </tr>
    </table>
	
  {else}
  <form action="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?iscompleted={$smarty.get.iscompleted}&status={$status}" method="post">
    <input type="hidden" name="pid" value="{$pid}" />
	<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/application_manager.gif" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle">OEP Applicants Manager </span><span class="pageTitle1">[{if $smarty.get.status eq 'A'}Approved{elseif $smarty.get.status eq 'R'}Rejected{else}New{/if} applicants]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
				      {if $smarty.get.iscompleted ne 'Y'}
					  <td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?action=add&pid={$pid}&iscompleted={$smarty.get.iscompleted}'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png" /><br/>
                        Add </a> </td>
						{/if}
						
		{if $status ne "A" and $status ne "R"}
								<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?status=A&pid={$pid}&iscompleted={$smarty.get.iscompleted}" style="toolbar">
									<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-apply.png" border="0" title="view approved applicants" /><br/> Approved Applicants </a> 
								</td>
								
								<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?status=R&pid={$pid}&iscompleted={$smarty.get.iscompleted}" style="toolbar">
									<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" title="view rejected applicants" /><br/> Rejected Applicants </a> 								</td>
                    		<td class="button" id="toolbar-apply" ><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-export.png" onclick="javascript:submitExport()" style="cursor:pointer;" /><br/> Export To CSV </a> </td>
							{else}
								
								{ if $status eq 'A'}
							
								<td class="button" id="toolbar-apply" ><a href="javascript:submitFormAlumni()" style="toolbar">
									<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-adduser.png" border="0" title="add to alumni" /><br/> Add to Alumni </a> 
								</td>
								<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?pid={$pid}&iscompleted={$smarty.get.iscompleted}" style="toolbar">
									<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-default.png" border="0" title="view new applicants" /><br/> New Applicants </a> 
								</td>
								
								<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?status=R&pid={$pid}&iscompleted={$smarty.get.iscompleted}" style="toolbar">
									<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" title="view rejected applicants" /><br/> Rejected Applicants </a> 
									</td>
																			
							
							{else}
							
								<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?pid={$pid}&iscompleted={$smarty.get.iscompleted}" style="toolbar">
									<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-default.png" border="0" title="view new applicants" /><br/> New Applicants </a> 
								</td>
								
								<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?status=A&pid={$pid}&iscompleted={$smarty.get.iscompleted}" style="toolbar">
									<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-apply.png" border="0" title="view approved applicants" /><br/> Approved Applicants </a> 	
							</td>
							
							{/if}
							{/if}				
							{if $pid > 0}
						<td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/oep_programme.php?iscompleted={$smarty.get.iscompleted}'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" /><br/> 
                        Back </a> </td>					
						{/if}
						
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
				<input type="hidden" name="status" value="{$status}" />
				{*if $status eq 'A'*}
					<input type="hidden" name="action" id="action" value="" />
				{*/if*}
			</td>
			</tr>
			<tr>
			<td colspan="5" align="left">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:7px;">
			{if $pid eq 0}
				<tr>	
				<td class="th" width="138" style="padding-top:5px; padding-left:12px; padding-right:3px;" align="right">Programme Name:</td>
				<td  width="164" style="padding-left:3px; padding-top:5px;"><input type="text" name="search_by_pname" class="input" value="{$formvars.search_by_pname}"  maxlength="150"/></td>
				<td>&nbsp;</td>
				</tr>
			{/if}
				<tr>
					<td class="th" width="138" style="padding-left:12px; padding-top:5px; padding-right:3px;" align="right">Applicant Name:</td>
					<td  width="164" style="padding-left:3px; padding-top:5px;"><input type="text" name="search_by_uname" class="input" value="{$formvars.search_by_uname}"  maxlength="100"/></td>
					<td width="660" style="padding-left:3px; padding-top:5px;"><input class="grid" type="button" name="Submit" value="Search" onclick="javascript: submitSearch();"  /></td>
				</tr>
				</table>
			</td>
			</tr>
          <tr>
          
          <td width="10" align="center" height="10"></td>
          <td width="617" valign="top" class="boderInner2" >
		  
         <table width="100%" border="0"  class="grid" style="padding-top:7px;">
                      
					  <tr  height="20">
                        <td style="width:30%" align="center" ><a href="javascript:sortRecords('firstname',true)" class="th" >Applicant Name</a></td>
                        <td style="width:30%" align="center" ><a href="javascript:sortRecords('name',true)" class="th">Programme Name</a></td>
						<td style="width:25%" align="center" ><a href="javascript:sortRecords('registrationdate',true)"  class="th">Applied Date</a></td>
						{if $status eq 'A' and $data ne ''}
						<td style="width:15%" align="center" class="th">Programme Completed</td>
						{/if}
						<!--<td style="width:15%" align="center" ><a href="javascript:sortRecords('enabled',true)"  class="th">Enabled</a></td>-->
						<td align="center" class="th">View</td>
                        <td align="center" class="th">Delete</td>
						 </tr>
                      <tr class="row1">
                        {if $status eq 'A'}
							<td height="5" colspan="6" align="center" class="borderBtmDashed"></td>
						{else}
							<td height="5" colspan="5" align="center" class="borderBtmDashed"></td>
						{/if}
                      </tr>
					  
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td align="center">{$entry.firstname}</td>
                        <td align="center">{$entry.name}</td>
						<td align="center">{$entry.registrationdate}</td>
                        {if $status eq 'A'}
						{if $entry.enddate lt $smarty.now|date_format:"%Y-%m-%d"}
							<td align="center"><input type="checkbox" name="addtoalumni[]" value="{$entry.oepaid|escape}" /></td>
						{elseif $entry.enddate gt $smarty.now|date_format:"%Y-%m-%d"}	
							<td align="center" width="82px">&nbsp;</td>	
                        {else}
                         <td align="center" width="82px">&nbsp;</td>	
						{/if}
						{/if}
						<!--<td align="center">{$entry.enabled}</td>-->
						<td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/view_S.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?action=detail&id={$entry.oepaid|escape}&pid={$pid}&iscompleted={$smarty.get.iscompleted}'"  class="btnText"  /> </td>
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.oepaid|escape}&pid={$pid}');"  class="btnText"  /> </td>
                       </tr>
                      {/foreach}
                     
					{if $countRecords gt 20}
					  <tr>
                        <td colspan="5" align="center"> {$paging} </td>
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
							  
							  {if $status eq 'A'}
							  	<li>To Add a record to alumni, click the 'Add to Alumni' button</li>
							  	<li>To View new applicants, click the 'New Applicants' button</li>
							  	<li>To View rejected applicants, click the 'Rejected Applicants' button</li>
							  {elseif $status eq 'R'}
							  	<li>To View new applicants, click the 'New Applicants' button</li>
							  	<li>To View approved applicants, click the 'Approved Applicants' button</li>
							  {else}
							  	<li>To View approved applicants, click the 'Approved Applicants' button</li>
							  	<li>To View rejected applicants, click the 'Rejected Applicants' button</li>
							  {/if}
                              <!--<li>To Edit a record, click on the 'Edit' button against the record</li>-->
							  <li>To View a record, click on the 'View' button against the record</li>
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
  {/if}
  </td>
</tr>
   {include file="$tpl_path/footer.tpl"}
   <DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv2" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv3" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv4" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv5" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv6" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>


</table>
</body>
</html>
