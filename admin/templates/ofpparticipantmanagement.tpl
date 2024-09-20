{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file="$tpl_path/top_header.tpl"}
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
		function submitFormAlumni()
		{
			document.getElementById("action").value = "alumni";
			document.forms[0].submit();
		}
		
		function submitForm()
		{
			document.forms[0].submit();
		}

	function deleteconfirmation(id , ofpid)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href='ofpparticipantmanagement.php?action=del&id='+id+'&ofpid='+ofpid;
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

  </script>
  
  
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/ofpparticipantmanagement.php?action=submit&mode={$pageview}{if $pageview eq 'edit'}&id={$data.ofpuid}{/if}" method="post"  enctype="multipart/form-data">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/grad_profiles_icon.png" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle"><span class="tableHeader">OFP Participants Manager</span></span><span class="pageTitle1">[{if $pageview eq 'add'}Add{else}Edit{/if} participant]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                          Save</a> </td>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/ofpparticipantmanagement.php?ofpid={$ofpid|escape}&status={$status}'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />Cancel</a></td>
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
						<input type="hidden" name="ofpid" value="{$ofpid|escape}" /> 
						<input type="hidden" name="id" value="{$data.ofpuid|escape}" /> 
						<input type="hidden" name="status" value="{$status}" /> 
					 </td>
                  </tr>
                 <!-- <tr class="row2">
                    <td width="26%" align="right" valign="top">Client Name:&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="clname" class="input" value="{$data.clname|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>--> 
				  <!--<tr class="row2">
                    <td width="26%" align="right" valign="top">Email (User Name) :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="username" class="input" value="{$data.username|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr> 
                  <tr class="row2">
                    <td width="26%" align="right" valign="top">Password :&nbsp;</td>
                    <td width="74%" align="left"><input type="password" name="password" class="input" value="{$data.password|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Confirm Password :&nbsp;</td>
                    <td width="74%" align="left"><input type="password" name="confpassword" class="input" value="{$data.password|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>-->
				{if $pageview eq 'add'}  
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Select Participant :&nbsp;</td>
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
                      <span class="required">&nbsp;*</span> OR <a href="usermanagement.php">create new participant</a></td>
                  </tr>
				  {elseif $pageview eq 'edit'}
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Participant Name :&nbsp;</td>
                    <td width="81%" align="left">
							{foreach from=$users item='u'}
								{if $u.uid eq $data.uid}
										{$u.firstname} {$u.lastname}
								{/if}
							{/foreach}
					</td>
                  </tr>
				  
				  {/if}
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  

				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">General Information</span></td>
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
                  </tr>				  <tr class="row2">
                    <td width="26%" align="right" valign="top">First Name :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" id="firstname" name="firstname" class="input" value="{$data.firstname|escape}"  maxlength="30" readonly="true"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Middle Name :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="middlename" class="input" value="{$data.middlename|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Last Name :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" id="lastname" name="lastname" class="input" value="{$data.lastname|escape}"  maxlength="30" readonly="true"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Job Title :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="jobtitle" class="input" value="{$data.jobtitle|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Organization :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="organization" class="input" value="{$data.organization|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Contact Phone :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="phone" class="input" value="{$data.phone|escape}"  maxlength="15"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Email(can be same as username email) :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="email" class="input" value="{$data.oemail|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Address :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="address" class="input" value="{$data.address|escape}"  maxlength="100"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Nationality :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="nationality" class="input" value="{$data.nationality|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">City :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="city" class="input" value="{$data.city|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;</span></td>
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
                  </tr>				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Cell :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="cell" class="input" value="{$data.cell|escape}"  maxlength="20"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Fax :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="fax" class="input" value="{$data.fax|escape}"  maxlength="20"/>
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
                    <td width="26%" align="right" valign="top">Contact No :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="emergencyphone" class="input" value="{$data.emergencyphone|escape}"  maxlength="15"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				  <tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Education</span></td>
				  </tr>  
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Institution :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="institution" class="input" value="{$data.institution|escape}"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Degree :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="degree" class="input" value="{$data.degree|escape}"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Year :&nbsp;</td>
					<td width="74%" align="left">
					<select name="year" class="select_class">
				  {foreach from=$years item="entry" }
				  
				  	{if $data.year eq $entry}
					<option value="{$entry}" selected="selected">{$entry}</option>
					{else}
					<option value="{$entry}">{$entry}</option>
					{/if}
				  
				  {/foreach}
				  </select>
                   <!-- <td width="74%" align="left"><input type="text" name="year" class="input" value="{$data.year|escape}"  maxlength="4"/>-->
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">What Function Best Describe Your Position :&nbsp;</td>
				    <td width="74%" align="left">
						<select name="position" class="select_class">
							<option value="Administration" {if $data.position eq 'Administration'} selected="selected" {/if}>Administration</option>
							<option value="Finance/Accounting" {if $data.position eq 'Finance/Accounting'} selected="selected" {/if}>Finance/Accounting</option>
							<option value="General Management" {if $data.position eq 'General Management'} selected="selected" {/if}>General Management</option>
							<option value="Human Resource/Personnel" {if $data.position eq 'Human Resource/Personnel'} selected="selected" {/if}>Human Resource/Personnel</option>
							<option value="Legal, Management Information/IT" {if $data.position eq 'Legal, Management Information/IT'} selected="selected" {/if}>Legal, Management Information/IT</option>
							<option value="Operations/Logistics" {if $data.position eq 'Operations/Logistics'} selected="selected" {/if}>Operations/Logistics</option>
							<option value="Production/Manufacturing/Engineering" {if $data.position eq 'Production/Manufacturing/Engineering'} selected="selected" {/if}>Production/Manufacturing/Engineering</option>
							<option value="Sales/Marketing" {if $data.position eq 'ales/Marketing'} selected="selected" {/if}>Sales/Marketing</option>
							<option value="other" {if $data.position eq 'other'} selected="selected" {/if}>other</option>
						</select>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Management Level :&nbsp;</td>
                    <td width="74%" align="left">
						<select name="managementlevel" class="select_class">
							<option value="Senior" {if $data.managementlevel eq 'Senior'} selected="selected" {/if}>Senior</option>
							<option value="Upper Middle" {if $data.managementlevel eq 'Upper Middle'} selected="selected" {/if}>Upper Middle</option>
							<option value="Middle" {if $data.managementlevel eq 'Middle'} selected="selected" {/if}>Middle</option>
							<option value="other" {if $data.managementlevel eq 'other'} selected="selected" {/if}>other</option>
						</select>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Years of Experience :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="yearsexperience" class="input" value="{$data.yearsexperience|escape}"  maxlength="4"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Please describe your duties and responsibilities :&nbsp;</td>
                    <td width="74%" align="left">
						<textarea maxlength='300' name="responsibilities" id="responsibilities" class="txtArea" onkeyup="return ismaxlength(this)">{$data.responsibilities|escape}</textarea>
						<span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">How will this programme benefit you & your department/division :&nbsp;</td>
				  <td width="74%" align="left">
						<textarea maxlength="300" name="benefits" class="txtArea" onkeyup="return ismaxlength(this)">{$data.benefits|escape}</textarea>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td valign="top" align="right" width="42%">Would you like to receive information about our future programmes? :&nbsp;</td>
					<td width="74%" align="left">
					{if $data.receiveinformation ne ''}
					No	
					  <input type="radio" name="receiveinformation" value="no" {if $data.receiveinformation eq 'no'}  checked="checked" {/if}/>
					Yes <input type="radio" name="receiveinformation" value="yes" {if $data.receiveinformation eq 'yes'} checked="checked" {/if}/>
					{else}
					No	<input type="radio" name="receiveinformation" value="no" checked="checked" />
					Yes <input type="radio" name="receiveinformation" value="yes" />
					{/if}
                      <span class="required">&nbsp;*</span></td>
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
                                <li>To go back to Existing Participants, click Cancel button</li>
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
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/grad_profiles_icon.png" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle"><span class="tableHeader">OFP Participants Manager</span></span><span class="pageTitle1">&nbsp;[View participant]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/ofpparticipantmanagement.php?ofpid={$ofpid|escape}&status={$status}'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />Back</a></td>
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
						<input type="hidden" name="ofpid" value="{$ofpid|escape}" /> 
					 </td>
                  </tr>
<!--                  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Client Name:&nbsp;</td>
                    <td width="74%" align="left">{$data.clname|escape}
                      </td>
                  </tr> 
-->				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Email (User Name) :&nbsp;</td>
                    <td width="74%" align="left">{$data.uemail|escape}
                      </td>
                  </tr> 
                  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Password :&nbsp;</td>
                    <td width="74%" align="left">{$data.password|escape}</td>
                  </tr>
				  
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  

				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">General Information</span></td>
				</tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">First Name :&nbsp;</td>
                    <td width="74%" align="left">{$data.firstname|escape}</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Last Name :&nbsp;</td>
                    <td width="74%" align="left">{$data.lastname|escape}</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Job Title :&nbsp;</td>
                    <td width="74%" align="left">{$data.jobtitle|escape}</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Organization :&nbsp;</td>
                    <td width="74%" align="left">{$data.organization|escape}</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Contact Phone :&nbsp;</td>
                    <td width="74%" align="left">{$data.phone|escape}</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Email(can be same as username email) :&nbsp;</td>
                    <td width="74%" align="left">{$data.oemail|escape}</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td width="74%" align="left">{$data.address|escape}
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
                    <td width="74%" align="left">{$data.emergencyname|escape}</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Contact No :&nbsp;</td>
                    <td width="74%" align="left">{$data.emergencyphone|escape}</td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				  <tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Education</span></td>
				  </tr>  
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Institution :&nbsp;</td>
                    <td width="74%" align="left">{$data.institution|escape}</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Degree :&nbsp;</td>
                    <td width="74%" align="left">{$data.degree|escape}</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Year :&nbsp;</td>
                    <td width="74%" align="left">{$data.year|escape}</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">What Function Best Describe Your Position :&nbsp;</td>
				    <td width="74%" align="left">
						{$data.position}</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Management Level :&nbsp;</td>
                    <td width="74%" align="left">
						{$data.managementlevel}
					</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Years of Experience :&nbsp;</td>
                    <td width="74%" align="left">{$data.yearsexperience|escape}</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Please describe your duties and responsibilities :&nbsp;</td>
                    <td width="74%" align="left">
						{$data.responsibilities|escape}
						</td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">How will this programme benefit you & your department/division :&nbsp;</td>
				  <td width="74%" align="left">
						{$data.benefits|escape}</td>
                  </tr>
				  <tr class="row2">
                    <td valign="top" align="right" width="42%" class="fieldtitle">Would you like to receive information about our future programmes? :&nbsp;</td>
					<td width="74%" align="left">
					 {$data.receiveinformation}
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
                               
                                <li>To go back to Existing Participants, click Back button</li>
                                
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/ofpparticipantmanagement.php" method="post">
	
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/grad_profiles_icon.png" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle">OFP Participants Manager </span><span class="pageTitle1">[Existing participants]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
                   {if $smarty.get.status ne 'C'}   <td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/ofpparticipantmanagement.php?action=add&ofpid={$ofpid}&status={$status}'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png" /><br/> Add </a> </td> {/if}
					  <td class="button" id="toolbar-apply" ><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-export.png" onclick="javascript:submitExport()" style="cursor:pointer;" /><br/> Export To CSV </a> </td>
					  {if $status ne ''}
					  <td class="button" id="toolbar-apply" ><a href="javascript:submitFormAlumni()" style="toolbar">
									<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-adduser.png" border="0" title="add to alumni" /><br/> Add to Alumni </a> 
								</td>
					  
					  {/if}
					  
					  <td class="button" id="toolbar-cancel"><a href="{$GENERAL.BASE_URL_ADMIN}/ofpmanagement.php?status={$status}" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /><br /> Back </a></td>
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
				<input type="hidden" name="ofpid" value="{$ofpid}" />
				<input type="hidden" name="status" value="{$status}" />
				{if $status ne ''}
					<input type="hidden" name="action" id="action" value="" />
				{/if}
			</td>
			</tr>
			<tr>
			<td colspan="5" align="left">
			<!--<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:7px;">
				<tr>
				<td class="th" width="93" style="padding-left:12px; padding-top:5px;">Client Name:</td>
				<td  width="162" style="padding-left:7px; padding-top:5px;"><input type="text" name="search_by_cname" class="input" value="{$formvars.search_by_name}"  maxlength="100"/></td>
				<td class="th" width="133" style="padding-left:7px; padding-top:5px;">Programme Name:</td>
				<td  width="201" style="padding-left:7px; padding-top:5px;"><input type="text" name="search_by_pname" class="input" value="{$formvars.search_by_email}"  maxlength="100"/></td>
				<td width="373" style="padding-left:7px; padding-top:5px;"><input class="grid" type="button" name="Submit" value="Search" onclick="javascript: submitForm();"  /></td>
				</tr>
				</table>-->
			</td>
			</tr>
          <tr>
          
          <td width="10" align="center" height="10"></td>
          <td width="617" valign="top" class="boderInner2" >
		  
         <table width="100%" border="0"  class="grid" style="padding-top:7px;">
                      <tr  height="20">
                        <td style="width:28%" align="center" ><a href="javascript:sortRecords('firstname',true)" class="th" >Participant Name</a></td>
<!--                        <td style="width:15%" align="center" ><a href="javascript:sortRecords('username',true)" class="th">Client Name</a></td>-->
						<td style="width:15%" align="center" ><a href="javascript:sortRecords('p.name',true)"  class="th">Programme Name</a></td>
						<td style="width:15%" align="center" ><a href="javascript:sortRecords('enrollmentdate',true)"  class="th">Add Date</a></td>
						<td style="width:15%" align="center" ><a href="javascript:void(0)"  class="th">View Detail</a></td>
						{if $status ne ''}
						<td style="width:15%" align="center" ><a href="javascript:sortRecords('enabled',true)"  class="th">Completed Programme</a></td>									{/if}
						<td align="center" class="th">Edit</td>
                        <td align="center" class="th">Delete</td>
						 </tr>
                      <tr class="row1">
                        
						{if $status ne ''}
							<td height="5" colspan="8" align="center" class="borderBtmDashed"></td>
						{else}
							<td height="5" colspan="7" align="center" class="borderBtmDashed"></td>	
                      	{/if}
					  </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td align="center">{$entry.firstname} {$entry.lastname}</td>
<!--						<td align="center">{$entry.clname}</td>-->
                        <td align="center">{$entry.name}</td>
						<td align="center">{$entry.enrollmentdate}</td>
						<td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/view_S.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/ofpparticipantmanagement.php?action=detail&id={$entry.ofpuid|escape}&ofpid={$ofpid}'"  class="btnText"  /> </td>
						
						{if $status ne ''}
							<td align="center"><input type="checkbox" name="addtoalumni[]" value="{$entry.ofppid|escape}" /></td>
						{/if}	
						
						<td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/ofpparticipantmanagement.php?action=edit&id={$entry.ofpuid|escape}&ofpid={$ofpid}&status={$status}'"  class="btnText"  /> </td>
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.ofppid|escape}' , '{$ofpid}');"  class="btnText"  /> </td>
                       </tr>
                      {/foreach}
                      <tr>
                       
					  	{if $status ne '' and $countRecords gt 20}
					    	
							<td colspan="8" align="center"> {$paging} </td>
						
						{else}
							
							{if $countRecords gt 20}
								<td colspan="7" align="center"> {$paging} </td>
							{/if}	
						
                      	{/if}
					  </tr>                      
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
							  {if $status eq 'C'}
							  <li>To Add a record to alumni, click checkbox then click the 'Add to Alumni' button</li>
							  {/if}
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
  {/if}
  </td>
</tr>
   {include file="$tpl_path/footer.tpl"}
</table>
</body>
</html>
