<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />
<title>{$pagedata.explorertitle}Apply Online</title>
<link href="css/black-calender.css" rel=stylesheet type="text/css">
{include file="includes.tpl"}
{literal}
<script type="text/javascript">
	
	
	function preloadImages()
	{
		
		for(var i = 0; i < arrayNav.length; i++)
		{
			var j = new Image();
			var k = new Image();
			j.src = "images/"+arrayNav[i]+"_data.gif";
			k.src = "images/"+arrayNav[i]+"_data_hover.gif";
				
		}
	}
		
	var currentstep   = '{/literal}{$steps}{literal}';
	var currentform   = currentstep+"form";
	
	var arrayNav 	= ['personal' , 'contact' , 'organizational' , 'professional' , 'sponsorship' , 'information'];
	var arrayNavImg = ['personal_img' , 'contact_img' , 'organizational_img' , 'professional_img' , 'sponsorship_img' , 'information_img'];
	
	/*************************************************************************************************************************************************/
	//var personalFields   	  = ['per_nationality' , 'per_emergencyname' , 'per_emergencyphone']; // commented on 07/01/2010
	var personalFields   	  = ['per_emergencyname' , 'per_emergencyphone'];
	var personalErrors        = ['Please provide emergency name' , 'Please provide emergency phone'];
	/*************************************************************************************************************************************************/
	var contactFields         = ['con_contactdesignation' , 'con_companyname' , 'con_companyaddress' , 'con_city' , 'con_country' , 'con_ctelephone'];
	var contactotherFields    = ['con_cell' , 'con_fax'];
	var contactErrors         = ['Please provide designation' , 'Please provide company name' , 'Please provide organization address' , 'Please provide city' , 'Please provide country' , 'Please provide telephone'];
	var contactotherErrors    = ['Please provide cell number' , 'Please provide fax number'];
	/*************************************************************************************************************************************************/
	var organizationalFields         = ['org_services' , 'org_numemployees' , 'org_numemployeessupervision' , 'org_reportperson'];
	var organizationalotherFields    = ['org_industryother' , 'org_positionother'];
	var organizationalErrors         = ['Please provide services' , 'Please provide number of employees' , 'Please provide number of employees under your direct supervision' , 'Please provide report person'];
	var organizationalotherErrors    = ['Please provide other industry' , 'Please provide other position'];
	/*************************************************************************************************************************************************/
	var professionalFields         = ['pro_company1' , 'pro_position1' , 'pro_from1' , 'pro_to1' , 'pro_numyearsexp' , 'pro_responsibility' , 'pro_university' , 'pro_year' , 'pro_degree' , 'pro_objectives'];
	var professionalErrors         = ['Please provide company name' , 'Please provide position' , 'Please provide from date' , 'Please provide to date' , 'Please provide experience' , 'Please provide responsibility' , 'Please provide university name' , 'Please provide year' , 'Please provide degree' , 'Please provide objectives'];
	/*************************************************************************************************************************************************/
	var sponsorshipFields         = ['sp_name' , 'sp_designation' , 'sp_address' , 'sp_telephone' , 'sp_email' , 'sp_executivename' , 'sp_executivedesignation' , 'sp_executiveaddress' , 'sp_executivetelephone' , 'sp_executiveemail'];
	var sponsorshipErrors         = ['Please provide name' , 'Please provide designation' , 'Please provide address' , 'Please provide telephone' , 'Please provide email' , 'Please provide name' , 'Please provide designation' , 'Please provide address' , 'Please provide phone' , 'Please provide email'];
	/*************************************************************************************************************************************************/
	
	
	function toggleDiv()
	{
		
		if(document.getElementById('appdiv').style.display == 'block')
		{
			document.getElementById('appdiv').style.display = 'none';
			document.getElementById('toggleimage').src = '{/literal}{$GENERAL.BASE_URL_ROOT}/images/plus.gif{literal}';
		}
		else
		{
			document.getElementById('toggleimage').src = '{/literal}{$GENERAL.BASE_URL_ROOT}/images/minus.gif{literal}';
			document.getElementById('appdiv').style.display = 'block';
		}	
		
	}
	
	function getStepIndex(stepname)
	{
		var sindex = 0;
		for(var i = 0; i < arrayNav.length; i++)
		{
			if(stepname == arrayNav[i])
			{
				sindex = i;
				break;
			}
		}
		return sindex;
	}
	
	function goStep(stepname)
	{
		var reqStepIndex  = getStepIndex(stepname);
		var currStepIndex = getStepIndex(currentstep);
		
		if(reqStepIndex < currStepIndex)
		{
			document.forms[currentform].elements["action"].value = "back";
			document.forms[currentform].elements["steps"].value = "";
			document.forms[currentform].elements["prev_steps"].value = stepname;
			document.forms[currentform].elements["next_steps"].value = "";
			document.forms[currentform].submit();
			return true;

		}
		else if(reqStepIndex == currStepIndex)
		{
			return false;
		}
		else if(reqStepIndex > currStepIndex)
		{
			if(formValidation())
			{
				document.forms[currentform].elements["next_steps"].value = stepname;
				document.forms[currentform].submit();
			}
			else
				return false;	
		}
		else
		{
			return false;
		}
		
		
		
	}

	function topSubmit()
	{
		if(formValidation())
		{
			document.forms[currentform].submit();
			return true;
		}
		else
		{
			return false;
		}	
		
	}

	
	
	function formValidation()
	{
		var c = 0;
		
		if(currentstep == 'personal')
		{
			for(var i=0; i < personalFields.length;i++)
			{
				if(document.getElementById(personalFields[i]).value == "")
				{
					c++;
					document.getElementById("e_"+personalFields[i]).className = "form_error_message_new";
					document.getElementById("e_"+personalFields[i]).innerHTML = personalErrors[i];
				}
				else
				{
					document.getElementById("e_"+personalFields[i]).className = "";
					document.getElementById("e_"+personalFields[i]).innerHTML = "";
				}
			}
		}
		else if(currentstep == 'contact')
		{
			for(var i=0; i < contactFields.length;i++)
			{
				if(document.getElementById(contactFields[i]).value == "")
				{
					c++;
					document.getElementById("e_"+contactFields[i]).className = "form_error_message_new";
					document.getElementById("e_"+contactFields[i]).innerHTML = contactErrors[i];
				}
				else
				{
					document.getElementById("e_"+contactFields[i]).className = "";
					document.getElementById("e_"+contactFields[i]).innerHTML = "";
				}
			}
		}
		else if(currentstep == 'organizational')
		{
			for(var i=0; i < organizationalFields.length;i++)
			{
				if(document.getElementById(organizationalFields[i]).value == "")
				{
					c++;
					document.getElementById("e_"+organizationalFields[i]).className = "form_error_message_new";
					document.getElementById("e_"+organizationalFields[i]).innerHTML = organizationalErrors[i];
				}
				else
				{
					document.getElementById("e_"+organizationalFields[i]).className = "";
					document.getElementById("e_"+organizationalFields[i]).innerHTML = "";
				}
			}
		}
		else if(currentstep == 'professional')
		{
			for(var i=0; i < professionalFields.length;i++)
			{
				if(document.getElementById(professionalFields[i]).value == "")
				{
					c++;
					document.getElementById("e_"+professionalFields[i]).className = "form_error_message_new";
					document.getElementById("e_"+professionalFields[i]).innerHTML = professionalErrors[i];
				}
				else
				{
					document.getElementById("e_"+professionalFields[i]).className = "";
					document.getElementById("e_"+professionalFields[i]).innerHTML = "";
				}
			}
		}
		/*else if(currentstep == 'sponsorship')
		{
			for(var i=0; i < sponsorshipFields.length;i++)
			{
				if(document.getElementById(sponsorshipFields[i]).value == "")
				{
					c++;
					document.getElementById("e_"+sponsorshipFields[i]).className = "form_error_message_new";
					document.getElementById("e_"+sponsorshipFields[i]).innerHTML = sponsorshipErrors[i];
				}
				else
				{
					document.getElementById("e_"+sponsorshipFields[i]).className = "";
					document.getElementById("e_"+sponsorshipFields[i]).innerHTML = "";
				}
			}
		}*/
		
		if(c  > 0)
			return false;
		else 
			return true;		
	}

   function ismaxlength(obj)
   {
		var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
		if (obj.getAttribute && obj.value.length>mlength)
		obj.value=obj.value.substring(0,mlength)
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
	
	function setNavDiv()
	{
		var stepindex = 0;
		for(var i = 0; i < arrayNav.length; i++)
		{
			if(arrayNav[i] == currentstep)
			{
				stepindex = i;
				break;
			}
		}
		
		/* FOR SELECTED INDEXES**/
		for(var s = stepindex; s >= 0; s--)
		{
			document.getElementById(arrayNav[s]).innerHTML = '<a href="#" onclick="goStep('+arrayNav[s]+');"><img src="{/literal}{$GENERAL.BASE_URL_ROOT}{literal}/images/'+arrayNav[s]+'_data.gif" /></a>';	
		}
		
		/**FOR UNSELECTED INDEXES*/
		
		for(var u = (stepindex + 1); u < arrayNav.length; u++)
		{
			
			if(stepindex  < arrayNav.length)
			{
				document.getElementById(arrayNav[u]).innerHTML = '<a href="#"><img src="{/literal}{$GENERAL.BASE_URL_ROOT}{literal}/images/'+arrayNav[u]+'_data_hover.gif" /></a>';
				
			}	
		}
		
		
	}

	function setNavImg()
	{
		var stepindex = 0;
		if(currentstep != "success" && currentstep != "incomplete")
		{
				for(var i = 0; i < arrayNavImg.length; i++)
				{
					if(arrayNav[i] == currentstep)
					{
						stepindex = i;
						break;
					}
				}
				
				/* FOR SELECTED INDEXES**/
				for(var s = stepindex; s >= 0; s--)
				{
					document.getElementById(arrayNavImg[s]).src = '{/literal}{$GENERAL.BASE_URL_ROOT}{literal}/images/'+arrayNav[s]+'_data.gif';
				}
				
				/**FOR UNSELECTED INDEXES*/
				
				for(var u = (stepindex + 1); u < arrayNavImg.length; u++)
				{
					
					if(stepindex  < arrayNavImg.length)
					{
						document.getElementById(arrayNavImg[u]).src = '{/literal}{$GENERAL.BASE_URL_ROOT}{literal}/images/'+arrayNav[u]+'_data_hover.gif';
					}	
				}
		}
		else if (currentstep == 'success')
		{
			
				for(var u = stepindex; u < arrayNavImg.length; u++)
				{
					
					if(stepindex  < arrayNavImg.length)
					{
						document.getElementById(arrayNav[u]).innerHTML = '<a href="#"><img src="{/literal}{$GENERAL.BASE_URL_ROOT}{literal}/images/'+arrayNav[u]+'_data_hover.gif" /></a>';
						//document.getElementById(arrayNavImg[u]).src = '{/literal}{$GENERAL.BASE_URL_ROOT}{literal}/images/'+arrayNav[u]+'_data_hover.gif';
					}	
				}
			
		}		
	}


	function exitForm()
	{
		document.forms[currentform].elements["action"].value = "exit";
		document.forms[currentform].submit();
		return true;
	}
	
	function submitFinal()
	{
		document.forms[currentform].elements["action"].value = "submitfinal";
		document.forms[currentform].elements["steps"].value = "information";
		document.forms[currentform].elements["next_steps"].value = "success";
		document.forms[currentform].submit();
		return true;
		
	}
	
	
</script>
{/literal}

</head>
<body onload="preloadImages();">
<div id="main_container">
 {include_php file="header.php"}
<div class="contentspane">

{if $pageview eq 'display'}  
  <div  class="content">
    <div class="error_message">
      
	  {if ($complete eq '' and $incomplete ne '') or  ($complete ne '' and $incomplete eq '') or ($complete ne '' and $incomplete neq '')}
	  	<div class="error_header_strip">
        <div  style="float:left" >Application Status</div>
        <div style="float:right; height:20px; padding-right:15px; padding-top:7px; border:none;"><a style="border:none; cursor:pointer;" onclick="toggleDiv();">
		<img src="{$GENERAL.BASE_URL_ROOT}/images/plus.gif" id="toggleimage" border="0" /></a></div>
      </div>
	  
	  	<!--<div class="application_status_area" id="appdiv" style="display:none;">-->
		<div class="application_status_area" id="appdiv" style="display:block;">
        {if $incomplete ne ''}	
			<div  class="application_box">Incomplete Application:<br />
			  <br />
			  	{foreach from = $incomplete item='incomp'}
					<div class="application_information">
				<div style="float:left" class="program_link">{$incomp.name} <span style="color:#f0780b">[ {$incomp.startdate|date_format:" %B %e, %Y"} - {$incomp.enddate|date_format:" %B %e, %Y"} ] </span></div>
				<div style="float:right">
				<a href="{$GENERAL.BASE_URL_ROOT}/apply.php?pid={php}echo encrypt($this->_tpl_vars['incomp']['oepid']);{/php}{*$incomp.oepid*}&oepaid={$incomp.oepaid}#apply" style="border:none;">	
					<img src="{$GENERAL.BASE_URL_ROOT}/images/click_here_complete.gif" border="0" />
				</a>	
				</div>
				
			  </div>
			  	{/foreach}
			</div>
			<div style=" height:20px;float:left; width:888px"><img src="{$GENERAL.BASE_URL_ROOT}/images/spacer.gif" /></div>
        {/if}
		{if $complete ne ''}
			<div  class="application_box">Applications in Process:<br />
          <br />
          
		  {foreach from = $complete item='comp'}
		  	<div class="application_information">
            
			<div style="float:left"><a href="#" class="program_link" >{$comp.name} <span style="color:#f0780b">[ {$comp.startdate|date_format:" %B %e, %Y"} - {$comp.enddate|date_format:" %B %e, %Y"} ] </span></a></div> 
			
            <div style="float:right">
					
					{if $comp.applicationstatus eq ''}
						<img src="{$GENERAL.BASE_URL_ROOT}/images/inprogress.gif" border="0" />
					{elseif $comp.applicationstatus eq 'A'}
						<img src="{$GENERAL.BASE_URL_ROOT}/images/approved.gif" border="0" />
					{elseif $comp.applicationstatus eq 'R'}
						<span style="color:#993300; font-size:11px;">Rejected</span>
					
					{/if}
			</div>
            
          </div>
		  {/foreach}
        </div>
		{/if}
        </div>
	  {/if}
	  <div style=" height:20px;float:left; width:888px"><img src="{$GENERAL.BASE_URL_ROOT}/images/spacer.gif" /></div>
      <div class="error_message">
        <div class="error_header_strip">
          <div  style="float:left" >Apply Online</div>
          <div style="float:right; height:20px; padding-right:15px; padding-top:7px">
		  	{if $smarty.get.oepaid ne ""}
            <div  class="login_information1">Status: <span style="color:#FF9900">{if $steps eq 'success'}In process{elseif $steps eq 'incomplete'}  {else} Incomplete {/if}</span></div>
			{/if}
            <div  class="login_information">{$userinfo.firstname} {$userinfo.lastname}</div>
          </div>
        </div>
		<!--<a name="apply"></a> commented on 07/01/2010 -->
       <div class="application_steps_area">
         {if $steps ne 'incomplete' and $steps ne 'success'} 
		  <div  class="project_name">{$programmeinfo[0].name} <br />
            <span style="color:#f0780b; font-size:11px">[ {$programmeinfo[0].startdate|date_format:" %B %e, %Y"} - {$programmeinfo[0].enddate|date_format:" %B %e, %Y"} ] </span> </div>
          <div style="width:888px; float:left">
		  	{if $getall.0.personal ne null or $getall.0.personal ne ''}
				<div style="float:left" id="personal"><a href="#" onclick="return goStep('personal');"><img id="personal_img" src="{$GENERAL.BASE_URL_ROOT}/images/personal_data.gif" /></a></div>
			{else}
				<div style="float:left" id="personal"><a href="#" onclick="return goStep('personal');"><img  id="personal_img" src="{$GENERAL.BASE_URL_ROOT}/images/personal_data.gif" /></a></div>				
			{/if}
			{if $getall.0.contact ne null or $getall.0.contact ne ''}
            <div style="float:left" id="contact"><a href="#" onclick="return goStep('contact');"><img id="contact_img" src="{$GENERAL.BASE_URL_ROOT}/images/contact_data.gif" /></a></div>
			{else}
			<div style="float:left" id="contact"><a href="#"><img id="contact_img" src="{$GENERAL.BASE_URL_ROOT}/images/contact_data_hover.gif" /></a></div>
			{/if}
			{if $getall.0.organizational ne null or $getall.0.organizational ne ''}
            <div style="float:left" id="organizational"><a href="#" onclick="return goStep('organizational');"><img id="organizational_img" src="{$GENERAL.BASE_URL_ROOT}/images/organizational_data.gif" /></a></div>
			{else}
			<div style="float:left" id="organizational"><a href="#"><img id="organizational_img" src="{$GENERAL.BASE_URL_ROOT}/images/organizational_data_hover.gif" /></a></div>
			{/if}
			{if $getall.0.professional ne null or $getall.0.professional ne ''}
            <div style="float:left" id="professional"><a href="#" onclick="return goStep('professional');"><img id="professional_img" src="{$GENERAL.BASE_URL_ROOT}/images/professional_data.gif" /></a></div>
			{else}
			<div style="float:left" id="professional"><a href="#"><img id="professional_img" src="{$GENERAL.BASE_URL_ROOT}/images/professional_data_hover.gif" /></a></div>
			{/if}
			{if $getall.0.sponsorship ne null or $getall.0.sponsorship ne ''}
            <div style="float:left" id="sponsorship"><a href="#" onclick="return goStep('sponsorship');"><img id="sponsorship_img" src="{$GENERAL.BASE_URL_ROOT}/images/sponsorship_data.gif" /></a></div>		
			{else}
			<div style="float:left" id="sponsorship"><a href="#"><img id="sponsorship_img" src="{$GENERAL.BASE_URL_ROOT}/images/sponsorship_data_hover.gif" /></a></div>		
			{/if}
			{if $getall.0.information ne null or $getall.0.information ne ''}
            <div style="float:left" id="information"><a href="#" onclick="return goStep('information');"><img id="information_img" src="{$GENERAL.BASE_URL_ROOT}/images/information_data.gif" /></a></div>
			{else}
		<div style="float:left" id="information"><a href="#"><img id="information_img" src="{$GENERAL.BASE_URL_ROOT}/images/information_data_hover.gif" /></a></div>	
			{/if}
          </div>
		  
		  {elseif $steps eq 'incomplete'}
		  {if $complete ne ''}
				<!--you have already applied for--> Your application is in process for {$programmeinfo[0].name}
				{else}
				Your application status is incomplete for {$programmeinfo[0].name}. Please complete your application.
				{/if}
		  {elseif $steps eq 'success'}
		  		<span style="color:#000000;">Your application has been submitted successfully.</span>		
                <span style="color:#000000;">
					<img src="images/image001.gif" alt="THANK YOU" width="102" border="0" height="14" /><br /><br />
			        <img src="images/image002.gif" alt="Form successfully sent" width="166" border="0" height="15" /><br /><br />
					Thank you for applying for a programme at Rausing Executive Development Centre, LUMS.  <br /><br />
					We will process your request as soon as possible.<br /><br />
					Should you have any questions, please do not hesitate to contact Rausing Executive Development Centre, LUMS,  Marketing Team  at +92- 42- 35608119.<br /><br /><br />
					Best regards,<br />
					The REDC Team 
                </span>		
		  {/if} 
        
		</div>
      </div>
	  {if $steps ne 'incomplete' and $steps ne 'success'}
      	<div class="save_button">
				
				
				
        <div style="float:right; padding-left:10px;"><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/exit.gif" onclick="return exitForm();"  border="0" /></div>
		
					
					
        <div style="float:right; padding-left:10px;">
			{if $steps eq 'information'}
				<a href="#" onclick="return submitFinal();" style="border:none;"><img src="{$GENERAL.BASE_URL_ROOT}/images/submit.gif"  border="0" /></a>
			{else}
				<a href="#" onclick="return topSubmit();" style="border:none;"><img src="{$GENERAL.BASE_URL_ROOT}/images/saveandcontinue.gif"  border="0" /></a>
			{/if}		

		</div>
		{if $steps ne 'personal'}  	
		
			{if $steps eq 'contact'}
			<div  style="float:right; padding-right:10px;" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/back.gif" onclick="return goStep('personal');"  border="0" /></div>
			{elseif $steps eq 'organizational'}
			<div  style="float:right; padding-right:10px;" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/back.gif" onclick="return goStep('contact');"  border="0" /></div>
			{elseif $steps eq 'professional'}
			<div  style="float:right; padding-right:10px;" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/back.gif" onclick="return goStep('organizational');"  border="0" /></div>
			{elseif $steps eq 'sponsorship'}
			<div  style="float:right; padding-right:10px;" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/back.gif" onclick="return goStep('professional');"  border="0" /></div>
			{elseif $steps eq 'information'}
			<div  style="float:right; padding-right:10px;" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/back.gif" onclick="return goStep('sponsorship');"  border="0" /></div>
			{/if}									
		{/if}
		
      </div>
    	{if $steps eq 'personal'}  	
			<form name="personalform" id="personalform" method="post" action="{$GENERAL.BASE_URL_ROOT}/apply.php?pid={$smarty.get.pid}#apply">
				<div class="main_form_area">
        <div class="form_heading_online">Personal Data</div>
        <div class="simple_txt"></div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">First Name:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="firstname" id="per_firstname" value="{$userinfo.firstname}" maxlength="" tabindex=""  readonly="true"/>
			<input type="hidden" name="steps" id="steps" value="personal" />
			<input type="hidden" name="next_steps" id="next_steps" value="contact" />
			<input type="hidden" name="prev_steps" id="prev_steps" value="personal" />
			<input type="hidden" name="state" id="state" value="submit" />
			<input type="hidden" name="action" id="action" value="submit" />
			<input type="hidden" name="oepaid" id="oepaid" value="{$oepaid}" />
          </div>
          	<div id="e_per_firstname"></div> 
        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Middle Initial:</div>
          <div class="input_area">
            <input class="input" type="text" name="middlename" id="per_middlename" value="{$data.middlename}" maxlength="" tabindex="" />
          </div>
		  <div id="e_per_middlename" ></div> 
        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Last Name:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="lastname" id="per_lastname" value="{$userinfo.lastname}" maxlength="" tabindex="" readonly="true" />
          </div>
		  <div id="e_per_lastname"></div> 
        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Prefix:</div>
          <div class="input_area">
            <select id='per_prefix' name='prefix' tabindex='' class="bluebar_apply">
				<option value='Mr.'>Mr.</option>
<!--				<option value='Mrs.'>Mrs.</option>
				<option value='Miss'>Miss</option>
-->				<option value='Ms.'>Ms.</option>
				<option value='Dr.'>Dr.</option>
			</select>
			<script language='javascript'>
				selectDropdown('per_prefix' , '{$data.prefix}');
			</script>
          </div>
        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Gender:</div>
          <div class="input_area">
            <input type='radio' name='gender' value = 'male' {if $data.gender eq 'male' or $data.gender eq ''} checked="checked" {/if} tabindex='' />&nbsp;&nbsp;<span class="simple_txt_radio">Male</span>&nbsp; 
			<input type='radio' name='gender' value = 'female' {if $data.gender eq 'female'} checked="checked" {/if} />&nbsp;&nbsp;<span class="simple_txt_radio">Female</span>
          </div>
        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Nationality:<span class="required">&nbsp;</span></div>
          <div class="input_area">
            <input class="input" type="text" name="nationality" id="per_nationality" value="{$data.nationality}" maxlength="" tabindex="" />
          </div>
		  
		  {if $error.nationality ne ''}
		  		<div id="e_per_nationality" class="form_error_message_new">{*$error.nationality*}</div> 
		  {else}
		  		<div id="e_per_nationality"></div> 
		  {/if}
		  
        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Business Email:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="busemail" id="per_busemail" value="{$userinfo.email}" maxlength="" tabindex="" readonly="true" />
          </div>
		  <div id="e_per_busemail"></div> 
        </div>

        <div style="height:30px;"><img src="{$GENERAL.BASE_URL_ROOT}/images/spacer.gif" /></div>
        <div class="simple_txt">In case of emergency, please notify</div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Name:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="emergencyname" id="per_emergencyname" value="{$data.emergencyname}" maxlength="" tabindex="" />
          </div>
		  		  
		  {if $error.emergencyname ne ''}
		  		<div id="e_per_emergencyname" class="form_error_message_new">{$error.emergencyname}</div> 
		  {else}
		  		<div id="e_per_emergencyname"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Telephone:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="emergencyphone" id="per_emergencyphone" value="{$data.emergencyphone}" maxlength="" tabindex="" />
          </div>
		  		  
		  {if $error.emergencyphone ne ''}
		  		<div id="e_per_emergencyphone" class="form_error_message_new">{$error.emergencyphone}</div> 
		  {else}
		  		<div id="e_per_emergencyphone"></div> 
		  {/if}

        </div>
        
        <div style="height:30px;"><img src="{$GENERAL.BASE_URL_ROOT}/images/spacer.gif" /></div>
        <div class="button_strip_area">
          <div  style="float:left; padding-right:10px;" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/saveandcontinue.gif"  border="0" onclick="return formValidation();" /></div>
          <div  style="float:left" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/exit.gif" onclick="return exitForm();"  border="0" /></div>
        </div>
      </div>
	  		</form>
	    {elseif $steps eq 'contact'}
			<form name="contactform" id="contactform" method="post" action="{$GENERAL.BASE_URL_ROOT}/apply.php?pid={$smarty.get.pid}#apply">
				<div class="main_form_area">
        <div class="form_heading_online">Contact Data</div>
        <div class="simple_txt">Company/Organization Address</div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Designation:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="contactdesignation" id="con_contactdesignation" value="{$data.contactdesignation}" maxlength="" tabindex="" />
			<input type="hidden" name="steps" id="steps" value="contact" />
			<input type="hidden" name="next_steps" id="next_steps" value="organizational" />
			<input type="hidden" name="prev_steps" id="prev_steps" value="personal" />
			<input type="hidden" name="state" id="state" value="submit" />
			<input type="hidden" name="action" id="action" value="submit" />
			<input type="hidden" name="oepaid" id="oepaid" value="{$oepaid}" />
          </div>
          			  
		  {if $error.contactdesignation ne ''}
		  		<div id="e_con_contactdesignation" class="form_error_message_new">{$error.contactdesignation}</div> 
		  {else}
		  		<div id="e_con_contactdesignation"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Company/Organization Name:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="companyname" id="con_companyname" value="{$data.companyname}" maxlength="" tabindex="" />
          </div>
		  		  
		  {if $error.companyname ne ''}
		  		<div id="e_con_companyname" class="form_error_message_new">{$error.companyname}</div> 
		  {else}
		  		<div id="e_con_companyname"></div> 
		  {/if}

        </div>
        <div style="clear:both">
          <div class="input_txt_apply">Parent Company/Organization Name (if different from Company/Organization Name):</div>
          <div class="input_area">
            <input class="input" type="text" name="companyother" id="con_companyother" value="{$data.companyother}" maxlength="" tabindex="" />
          </div>
		  		  
		  {if $error.companyother ne ''}
		  		<div id="e_con_companyother" class="form_error_message_new">{$error.companyother}</div> 
		  {else}
		  		<div id="e_con_companyother"></div> 
		  {/if}
        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Address:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
          	<input class="input" type="text" name="companyaddress" id="con_companyaddress" value="{$data.companyaddress}" maxlength="" tabindex="" />
	      </div>
		  		  
		  {if $error.companyaddress ne ''}
		  		<div id="e_con_companyaddress" class="form_error_message_new">{$error.companyaddress}</div> 
		  {else}
		  		<div id="e_con_companyaddress"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">City:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="city" id="con_city" value="{$data.city}" maxlength="" tabindex="" />
          </div>
		  		  
		  {if $error.city ne ''}
		  		<div id="e_con_city" class="form_error_message_new">{$error.city}</div> 
		  {else}
		  		<div id="e_con_city"></div> 
		  {/if}

		  <div id="e_con_city" ></div> 
        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Country:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
		  <!--tabindex='1006'-->
            <select id='con_country' name='country'  class='bluebar_apply'>
				<option value=''>--select country--</option>";
				{foreach from = $countrylist item='country'}
					{if $country.country_id eq $data.country}
						<option value='{$country.country_id}' selected="selected">{$country.countryname}</option>
					{else}
						<option value='{$country.country_id}'>{$country.countryname}</option>	
					{/if}	
				{/foreach}	
			</select>
          </div>
		  		  
		  {if $error.country ne ''}
		  		<div id="e_con_country" class="form_error_message_new">{$error.country}</div> 
		  {else}
		  		<div id="e_con_country"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Telephone:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="ctelephone" id="con_ctelephone" value="{$data.ctelephone}" maxlength="" tabindex="" />
          </div>
		  		  
		  {if $error.ctelephone ne ''}
		  		<div id="e_con_ctelephone" class="form_error_message_new">{$error.ctelephone}</div> 
		  {else}
		  		<div id="e_con_ctelephone"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Cell:</div>
          <div class="input_area">
            <input class="input" type="text" name="cell" id="con_cell" value="{$data.cell}" maxlength="" tabindex="" />
          </div>
		  		  
		  {if $error.cell ne ''}
		  		<div id="e_con_cell" class="form_error_message_new">{$error.cell}</div> 
		  {else}
		  		<div id="e_con_cell"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Fax:</div>
          <div class="input_area">
            <input class="input" type="text" name="fax" id="con_fax" value="{$data.fax}" maxlength="" tabindex="" />
          </div>
		  		  
		  {if $error.fax ne ''}
		  		<div id="e_con_fax" class="form_error_message_new">{$error.fax}</div> 
		  {else}
		  		<div id="e_con_fax"></div> 
		  {/if}

        </div>
		
        <div style="height:30px;"><img src="{$GENERAL.BASE_URL_ROOT}/images/spacer.gif" /></div>
        <div class="button_strip_area">
		<div  style="float:left; padding-right:10px;" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/back.gif" onclick="return goStep('personal');"  border="0" /></div>
          <div  style="float:left; padding-right:10px;" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/saveandcontinue.gif"  border="0" onclick="return formValidation();" /></div>
          <div  style="float:left" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/exit.gif" onclick="return exitForm();"  border="0" /></div>
        </div>
      </div>
	  		</form>
		{elseif $steps eq 'organizational'}
			<form name="organizationalform" id="organizationalform" method="post" action="{$GENERAL.BASE_URL_ROOT}/apply.php?pid={$smarty.get.pid}#apply">
				<div class="main_form_area">
        <div class="form_heading_online">Organizational Data</div>
        <div class="simple_txt">Your Parent Company/Organization</div>
        <div style="clear:both;">
          <div class="input_txt_apply">Products/Services:</div>
          <div class="input_area_txt">
            <textarea id='org_parentservices' class='bluebar_txtarea' name='parentservices' tabindex='' maxlength='300' onkeyup='return ismaxlength(this)'>{$data.parentservices}</textarea>
			<input type="hidden" name="steps" id="steps" value="organizational" />
			<input type="hidden" name="next_steps" id="next_steps" value="professional" />
			<input type="hidden" name="prev_steps" id="prev_steps" value="contact" />
			<input type="hidden" name="state" id="state" value="submit" />
			<input type="hidden" name="action" id="action" value="submit" />
			<input type="hidden" name="oepaid" id="oepaid" value="{$oepaid}" />
          </div>
  		  {if $error.parentservices ne ''}
		  		<div id="e_org_parentservices" class="form_error_message_new">{$error.parentservices}</div> 
		  {else}
		  		<div id="e_org_parentservices"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">No. of Employees:</div>
          <div class="input_area">
            <input class="input" type="text" name="parentnumemployees" id="org_parentnumemployees" value="{$data.parentnumemployees}" maxlength="" tabindex="" />
          </div>
   		  {if $error.parentnumemployees ne ''}
		  		<div id="e_org_parentnumemployees" class="form_error_message_new">{$error.parentnumemployees}</div> 
		  {else}
		  		<div id="e_org_parentnumemployees"></div> 
		  {/if}

        </div>
		<div class="simple_txt">Your Company/Division</div>
        <div style="clear:both;">
          <div class="input_txt_apply">Products/Services:<span class="required">&nbsp;*</span></div>
          <div class="input_area_txt">
            <textarea id='org_services' class='bluebar_txtarea' name='services' tabindex='' maxlength='300' onkeyup='return ismaxlength(this)'>{$data.services}</textarea>
		  </div>
   		  {if $error.services ne ''}
		  		<div id="e_org_services" class="form_error_message_new">{$error.services}</div> 
		  {else}
		  		<div id="e_org_services"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">No. of Employees:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="numemployees" id="org_numemployees" value="{$data.numemployees}" maxlength="" tabindex="" />
          </div>
   		  {if $error.numemployees ne ''}
		  		<div id="e_org_numemployees" class="form_error_message_new">{$error.numemployees}</div> 
		  {else}
		  		<div id="e_org_numemployees"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">How many employees are under your direct supervision?:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="numemployeessupervision" id="org_numemployeessupervision" value="{$data.numemployeessupervision}" maxlength="" tabindex="" />
          </div>
   		  {if $error.numemployeessupervision ne ''}
		  		<div id="e_org_numemployeessupervision" class="form_error_message_new">{$error.numemployeessupervision}</div> 
		  {else}
		  		<div id="e_org_numemployeessupervision"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">What is the title position of the person to whom you report?:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="reportperson" id="org_reportperson" value="{$data.reportperson}" maxlength="" tabindex="" />
          </div>
   		  {if $error.reportperson ne ''}
		  		<div id="e_org_reportperson" class="form_error_message_new">{$error.reportperson}</div> 
		  {else}
		  		<div id="e_org_reportperson"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Please select your current industry:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
			<select name='industry' class='bluebar_apply' tabindex='' id='org_industry'>
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
			<script language='javascript'>
				selectDropdown('org_industry' , '{$data.industry}');
			</script>
          </div>
   		  {if $error.industry ne ''}
		  		<div id="e_org_industry" class="form_error_message_new">{$error.industry}</div> 
		  {else}
		  		<div id="e_org_industry"></div> 
		  {/if}

        </div>




		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Specify Other:</div>
          <div class="input_area">
            <input class="input" type="text" name="industryother" id="org_industryother" value="{$data.industryother}" maxlength="" tabindex="" />
          </div>
   		  {if $error.industryother ne ''}
		  		<div id="e_org_industryother" class="form_error_message_new">{$error.industryother}</div> 
		  {else}
		  		<div id="e_org_industryother"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">What function best describes your position:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
			<select name='position' class='bluebar_apply' tabindex='' id='org_position'>
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
			<script language='javascript'>
				selectDropdown('org_position' , '{$data.position}');
			</script>
          </div>
   		  {if $error.position ne ''}
		  		<div id="e_org_position" class="form_error_message_new">{$error.position}</div> 
		  {else}
		  		<div id="e_org_position"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Specify Other:</div>
          <div class="input_area">
            <input class="input" type="text" name="positionother" id="org_positionother" value="{$data.positionother}" maxlength="" tabindex="" />
          </div>
   		  {if $error.positionother ne ''}
		  		<div id="e_org_positionother" class="form_error_message_new">{$error.positionother}</div> 
		  {else}
		  		<div id="e_org_positionother"></div> 
		  {/if}

        </div>
        
        <div style="height:30px;"><img src="{$GENERAL.BASE_URL_ROOT}/images/spacer.gif" /></div>
        <div class="button_strip_area">
          <div  style="float:left; padding-right:10px;"><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/back.gif" onclick="return goStep('contact');"  border="0" /></div>
		  <div  style="float:left; padding-right:10px;" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/saveandcontinue.gif"  border="0" onclick="return formValidation();" /></div>
          <div  style="float:left" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/exit.gif" onclick="return exitForm();"  border="0" /></div>
        </div>
      </div>
	  		</form>
		{elseif $steps eq 'professional'}
			<form name="professionalform" id="professionalform" method="post" action="{$GENERAL.BASE_URL_ROOT}/apply.php?pid={$smarty.get.pid}#apply">
				<div class="main_form_area">
        <div class="form_heading_online">Professional Data</div>
        <div class="simple_txt">Work Experience<br /><br />
        Please list your last three positions in reverse chronological order starting with your current one. If all are in the same company, please give the major promotional sequence.</div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Name of Company:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="company1" id="pro_company1" value="{$data.company1}" maxlength="" tabindex="" />
			<input type="hidden" name="steps" id="steps" value="professional" />
			<input type="hidden" name="next_steps" id="next_steps" value="sponsorship" />
			<input type="hidden" name="prev_steps" id="prev_steps" value="organizational" />
			<input type="hidden" name="state" id="state" value="submit" />
			<input type="hidden" name="action" id="action" value="submit" />
			<input type="hidden" name="oepaid" id="oepaid" value="{$oepaid}" />
          </div>
   		  {if $error.company1 ne ''}
		  		<div id="e_pro_company1" class="form_error_message_new">{$error.company1}</div> 
		  {else}
		  		<div id="e_pro_company1"></div> 
		  {/if}
          	
        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Title / Position:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="position1" id="pro_position1" value="{$data.position1}" maxlength="" tabindex="" />
          </div>
   		  {if $error.position1 ne ''}
		  		<div id="e_pro_position1" class="form_error_message_new">{$error.position1}</div> 
		  {else}
		  		<div id="e_pro_position1"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">From(MM/YYYY):<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="from1" id="pro_from1" value="{$data.from1}" maxlength="" tabindex="" />
	      </div>
		  <!--<div style="float:left; padding-left:10px;">
		  	<input type="image" src="{$GENERAL.BASE_URL_ROOT}/admin/images/calender.gif"  onClick="ds_sh(pro_from1);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
			<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
				<tr>
				  <td id="ds_calclass"></td>
				</tr>
            </table>
			 {literal}
                      <script src="jscript/black-calender.js" language="javascript"></script>
              {/literal}
		  </div>-->
   		  {if $error.from1 ne ''}
		  		<div id="e_pro_from1" class="form_error_message_new">{$error.from1}</div> 
		  {else}
		  		<div id="e_pro_from1"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">To(MM/YYYY):<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="to1" id="pro_to1" value="{$data.to1}" maxlength="" tabindex="" />
          </div>
		 <!--<div style="float:left; padding-left:10px;">
					<input type="image" src="{$GENERAL.BASE_URL_ROOT}/admin/images/calender.gif"  onClick="ds_sh(pro_to1);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
					<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
						<tr>
						  <td id="ds_calclass"></td>
						</tr>
					</table>
					 {literal}
							  <script src="jscript/black-calender.js" language="javascript"></script>
					  {/literal}
		  </div>-->		  
   		  {if $error.to1 ne ''}
		  		<div id="e_pro_to1" class="form_error_message_new">{$error.to1}</div> 
		  {else}
		  		<div id="e_pro_to1"></div> 
		  {/if}

        </div>


        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Name of Company:</div>
          <div class="input_area">
            <input class="input" type="text" name="company2" id="pro_company2" value="{$data.company2}" maxlength="" tabindex="" />
          </div>
   		  {if $error.company2 ne ''}
		  		<div id="e_pro_company2" class="form_error_message_new">{$error.company2}</div> 
		  {else}
		  		<div id="e_pro_company2"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Title / Position:</div>
          <div class="input_area">
            <input class="input" type="text" name="position2" id="pro_position2" value="{$data.position2}" maxlength="" tabindex="" />
          </div>
   		  {if $error.position2 ne ''}
		  		<div id="e_pro_position2" class="form_error_message_new">{$error.position2}</div> 
		  {else}
		  		<div id="e_pro_position2"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">From(MM/YYYY):</div>
          <div class="input_area">
            <input class="input" type="text" name="from2" id="pro_from2" value="{$data.from2}" maxlength="" tabindex="" />
          </div>
		 <!--<div style="float:left; padding-left:10px;">
					<input type="image" src="{$GENERAL.BASE_URL_ROOT}/admin/images/calender.gif"  onClick="ds_sh(pro_from2);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
					<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
						<tr>
						  <td id="ds_calclass"></td>
						</tr>
					</table>
					 {literal}
							  <script src="jscript/black-calender.js" language="javascript"></script>
					  {/literal}
		  </div>-->		  
		  
   		  {if $error.from2 ne ''}
		  		<div id="e_pro_from2" class="form_error_message_new">{$error.from2}</div> 
		  {else}
		  		<div id="e_pro_from2"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">To(MM/YYYY):</div>
          <div class="input_area">
            <input class="input" type="text" name="to2" id="pro_to2" value="{$data.to2}" maxlength="" tabindex="" />
          </div>
		 <!--<div style="float:left; padding-left:10px;">
					<input type="image" src="{$GENERAL.BASE_URL_ROOT}/admin/images/calender.gif"  onClick="ds_sh(pro_to2);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
					<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
						<tr>
						  <td id="ds_calclass"></td>
						</tr>
					</table>
					 {literal}
							  <script src="jscript/black-calender.js" language="javascript"></script>
					  {/literal}
		  </div>-->		  
		  
   		  {if $error.to2 ne ''}
		  		<div id="e_pro_to2" class="form_error_message_new">{$error.to2}</div> 
		  {else}
		  		<div id="e_pro_to2"></div> 
		  {/if}

        </div>



        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Name of Company:</div>
          <div class="input_area">
            <input class="input" type="text" name="company3" id="pro_company3" value="{$data.company3}" maxlength="" tabindex="" />
          </div>
   		  {if $error.company3 ne ''}
		  		<div id="e_pro_company3" class="form_error_message_new">{$error.company3}</div> 
		  {else}
		  		<div id="e_pro_company3"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Title / Position:</div>
          <div class="input_area">
            <input class="input" type="text" name="position3" id="pro_position3" value="{$data.position3}" maxlength="" tabindex="" />
          </div>
   		  {if $error.position3 ne ''}
		  		<div id="e_pro_position3" class="form_error_message_new">{$error.position3}</div> 
		  {else}
		  		<div id="e_pro_position3"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">From(MM/YYYY):</div>
          <div class="input_area">
            <input class="input" type="text" name="from3" id="pro_from3" value="{$data.from3}" maxlength="" tabindex="" />
          </div>
		 <!--<div style="float:left; padding-left:10px;">
					<input type="image" src="{$GENERAL.BASE_URL_ROOT}/admin/images/calender.gif"  onClick="ds_sh(pro_from3);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
					<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
						<tr>
						  <td id="ds_calclass"></td>
						</tr>
					</table>
					 {literal}
							  <script src="jscript/black-calender.js" language="javascript"></script>
					  {/literal}
		  </div>-->		  
		  
   		  {if $error.from3 ne ''}
		  		<div id="e_pro_from3" class="form_error_message_new">{$error.from3}</div> 
		  {else}
		  		<div id="e_pro_from3"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">To(MM/YYYY):</div>
          <div class="input_area">
            <input class="input" type="text" name="to3" id="pro_to3" value="{$data.to3}" maxlength="" tabindex="" />
          </div>
		 <!--<div style="float:left; padding-left:10px;">
					<input type="image" src="{$GENERAL.BASE_URL_ROOT}/admin/images/calender.gif"  onClick="ds_sh(pro_to3);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
					<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
						<tr>
						  <td id="ds_calclass"></td>
						</tr>
					</table>
					 {literal}
							  <script src="jscript/black-calender.js" language="javascript"></script>
					  {/literal}
		  </div>-->		  
		  
   		  {if $error.to3 ne ''}
		  		<div id="e_pro_to3" class="form_error_message_new">{$error.to3}</div> 
		  {else}
		  		<div id="e_pro_to3"></div> 
		  {/if}

        </div>


		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Please estimate total number of years of professional experience:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="numyearsexp" id="pro_numyearsexp" value="{$data.numyearsexp}" maxlength="" tabindex="" />
          </div>
   		  {if $error.numyearsexp ne ''}
		  		<div id="e_pro_numyearsexp" class="form_error_message_new">{$error.numyearsexp}</div> 
		  {else}
		  		<div id="e_pro_numyearsexp"></div> 
		  {/if}

        </div>
		<div style="clear:both;">
          <div class="input_txt_apply">Please describe your current responsibilities in the organization:<span class="required">&nbsp;*</span></div>
          <div class="input_area_txt">
            <textarea id='pro_responsibility' class='bluebar_txtarea' name='responsibility' tabindex='' maxlength='300' onkeyup='return ismaxlength(this)'>{$data.responsibility}</textarea>
          </div>
   		  {if $error.responsibility ne ''}
		  		<div id="e_pro_responsibility" class="form_error_message_new">{$error.responsibility}</div> 
		  {else}
		  		<div id="e_pro_responsibility"></div> 
		  {/if}

        </div>
		
		<div style="clear:both;">
          <div class="input_txt_apply">Management Level:<span class="required">&nbsp;*</span></div>
          <div class="input_area_txt">
            <select name='mgtlevel' class='bluebar_apply' tabindex='' id='pro_mgtlevel'>
				<option value='Top Management'>Top Management</option>
				<option value='Senior'>Senior</option>
				<option value='Upper Middle'>Upper Middle</option>
				<option value='Middle'>Middle</option>
				<option value=''>other</option>
			</select>
			<script language='javascript'>
				selectDropdown('pro_mgtlevel' , '{$data.mgtlevel}');
			</script>
          </div>
   		  {if $error.mgtlevel ne ''}
		  		<div id="e_pro_mgtlevel" class="form_error_message_new">{$error.mgtlevel}</div> 
		  {else}
		  		<div id="e_pro_mgtlevel"></div> 
		  {/if}

        </div>		
		
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Specify other:<span class="required">&nbsp;</span></div>
          <div class="input_area">
            <input class="input" type="text" name="mgtlevel_other" id="pro_mgtlevel" value="{$data.mgtlevel_other}" maxlength="" tabindex="" />
          </div>
   		  {if $error.mgtlevel_other ne ''}
		  		<div id="e_pro_mgtlevel_other" class="form_error_message_new">{$error.mgtlevel_other}</div> 
		  {else}
		  		<div id="e_pro_mgtlevel_other"></div> 
		  {/if}

        </div>		
		
		<div class="simple_txt">Education</div>
		
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">University:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="university" id="pro_university" value="{$data.university}" maxlength="" tabindex="" />
          </div>
   		  {if $error.university ne ''}
		  		<div id="e_pro_university" class="form_error_message_new">{$error.university}</div> 
		  {else}
		  		<div id="e_pro_university"></div> 
		  {/if}

        </div>

		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Year:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="year" id="pro_year" value="{$data.year}" maxlength="" tabindex="" />
          </div>
   		  {if $error.year ne ''}
		  		<div id="e_pro_year" class="form_error_message_new">{$error.year}</div> 
		  {else}
		  		<div id="e_pro_year"></div> 
		  {/if}

        </div>

		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Degree (Highest level attained):<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="degree" id="pro_degree" value="{$data.degree}" maxlength="" tabindex="" />
          </div>
   		  {if $error.degree ne ''}
		  		<div id="e_pro_degree" class="form_error_message_new">{$error.degree}</div> 
		  {else}
		  		<div id="e_pro_degree"></div> 
		  {/if}

        </div>
		
		<!--- NEW FIELDS ENTERED ON 07/11/2010 -->
			
		<div class="simple_txt">If you have attended other REDC programmes, please list them below.</div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Programme:<span class="required">&nbsp;</span></div>
          <div class="input_area">
            <input class="input" type="text" name="atndotherredcprog1" id="pro_atndotherredcprog1" value="{$data.atndotherredcprog1}" maxlength="" tabindex="" />
	      </div>
   	    </div>
		
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Date(MM/YYYY):<span class="required">&nbsp;</span></div>
          <div class="input_area">
            <input class="input" type="text" name="atndotherredcprogdate1" id="pro_atndotherredcprogdate1" value="{$data.atndotherredcprogdate1}" maxlength="" tabindex="" />
	      </div>
   	    </div>			

        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Programme:<span class="required">&nbsp;</span></div>
          <div class="input_area">
            <input class="input" type="text" name="atndotherredcprog2" id="pro_atndotherredcprog2" value="{$data.atndotherredcprog2}" maxlength="" tabindex="" />
	      </div>
   	    </div>
		
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Date(MM/YYYY):<span class="required">&nbsp;</span></div>
          <div class="input_area">
            <input class="input" type="text" name="atndotherredcprogdate2" id="pro_atndotherredcprogdate2" value="{$data.atndotherredcprogdate2}" maxlength="" tabindex="" />
	      </div>
   	    </div>			

		
		<!--- NEW FIELDS ENTERED ON 07/11/2010 -->
		
		
		
		
		<div class="simple_txt">Objectives</div>
		
		<div style="clear:both;">
          <div class="input_txt_apply">What are your objectives of attending this programme? What do you expect to achieve by the end of this programme:<span class="required">&nbsp;* <br/>(Maximum 500 characters)</span></div>
          <div class="input_area_txt">
            <textarea id='pro_objectives' class='bluebar_txtarea' name='objectives' tabindex='' maxlength='6666' onkeyup='return ismaxlength(this)'>{$data.objectives}</textarea>
          </div>
   		  {if $error.objectives ne ''}
		  		<div id="e_pro_objectives" class="form_error_message_new">{$error.objectives}</div> 
		  {else}
		  		<div id="e_pro_objectives"></div> 
		  {/if}

        </div>

        <div style="height:30px;"><img src="{$GENERAL.BASE_URL_ROOT}/images/spacer.gif" /></div>
        <div class="button_strip_area">
		<div  style="float:left; padding-right:10px;"><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/back.gif" onclick="return goStep('organizational');"  border="0" /></div>
          <div  style="float:left; padding-right:10px;" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/saveandcontinue.gif"  border="0" onclick="return formValidation();" /></div>
          <div  style="float:left" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/exit.gif" onclick="return exitForm();"  border="0" /></div>
        </div>
      </div>
	  		</form>
		{elseif $steps eq 'sponsorship'}
			<form name="sponsorshipform" id="sponsorshipform" method="post" action="{$GENERAL.BASE_URL_ROOT}/apply.php?pid={$smarty.get.pid}#apply">
				<div class="main_form_area">
        <div class="form_heading_online">Sponsorship and Invoicing</div>
        <div class="simple_txt">I have read and accepted all policies written in the brochure. I understand that upon completion and receipt of invoice, the organization will become liable for all charges including cancellation and transfer charges, if applicable.</div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Name:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="name" id="sp_name" value="{$data.name}" maxlength="" tabindex="" />
			<input type="hidden" name="steps" id="steps" value="sponsorship" />
			<input type="hidden" name="next_steps" id="next_steps" value="information" />
			<input type="hidden" name="prev_steps" id="prev_steps" value="professional" />
			<input type="hidden" name="state" id="state" value="submit" />
			<input type="hidden" name="action" id="action" value="submit" />
			<input type="hidden" name="oepaid" id="oepaid" value="{$oepaid}" />
          </div>
   		  {if $error.name ne ''}
		  		<div id="e_sp_name" class="form_error_message_new">{$error.name}</div> 
		  {else}
		  		<div id="e_sp_name"></div> 
		  {/if}
      </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Designation:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="designation" id="sp_designation" value="{$data.designation}" maxlength="" tabindex="" />
          </div>
   		  {if $error.designation ne ''}
		  		<div id="e_sp_designation" class="form_error_message_new">{$error.designation}</div> 
		  {else}
		  		<div id="e_sp_designation"></div> 
		  {/if}
        </div>
        <div style="clear:both;">
          <div class="input_txt_apply">Address:<span class="required">&nbsp;*</span></div>
          <div class="input_area_txt">
            <textarea id='sp_address' class='bluebar_txtarea' name='address' tabindex='' maxlength='300' onkeyup='return ismaxlength(this)'>{$data.address}</textarea>
          </div>
   		  {if $error.address ne ''}
		  		<div id="e_sp_address" class="form_error_message_new">{$error.address}</div> 
		  {else}
		  		<div id="e_sp_address"></div> 
		  {/if}
        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Telephone:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="telephone" id="sp_telephone" value="{$data.telephone}" maxlength="" tabindex="" />
          </div>
   		  {if $error.telephone ne ''}
		  		<div id="e_sp_telephone" class="form_error_message_new">{$error.telephone}</div> 
		  {else}
		  		<div id="e_sp_telephone"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Fax:</div>
          <div class="input_area">
            <input class="input" type="text" name="sponsorfax" id="sp_sponsorfax" value="{$data.sponsorfax}" maxlength="" tabindex="" />
          </div>
   		  {if $error.sponsorfax ne ''}
		  		<div id="e_sp_sponsorfax" class="form_error_message_new">{$error.sponsorfax}</div> 
		  {else}
		  		<div id="e_sp_sponsorfax"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Email:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <input class="input" type="text" name="email" id="sp_email" value="{$data.email}" maxlength="" tabindex="" />
          </div>
   		  {if $error.email ne ''}
		  		<div id="e_sp_email" class="form_error_message_new">{$error.email}</div> 
		  {else}
		  		<div id="e_sp_email"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Website:</div>
          <div class="input_area">
            <input class="input" type="text" name="website" id="sp_website" value="{$data.website}" maxlength="" tabindex="" />
          </div>
   		  {if $error.website ne ''}
		  		<div id="e_sp_website" class="form_error_message_new">{$error.website}</div> 
		  {else}
		  		<div id="e_sp_website"></div> 
		  {/if}

        </div>

<!--		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Signature:</div>
          <div class="input_area">
            <input class="input" type="text" name="signature1" id="sp_signature1" value="{$data.signature1}" maxlength="" tabindex="" />
          </div>
        </div>

		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Date(MM/YYYY):</div>
          <div class="input_area">
            <input class="input" type="text" name="signaturedate1" id="sp_signaturedate1" value="{$data.signaturedate1}" maxlength="" tabindex="" />
          </div>

        </div>
-->

	<div class="simple_txt">Name and address to which invoice should be sent (if different from above).</div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Name:</div>
          <div class="input_area">
            <input class="input" type="text" name="invoicename" id="sp_invoicename" value="{$data.invoicename}" maxlength="" tabindex="" />
		  </div>
   		  {if $error.invoicename ne ''}
		  		<div id="e_sp_invoicename" class="form_error_message_new">{$error.invoicename}</div> 
		  {else}
		  		<div id="e_sp_invoicename"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Designation:</div>
          <div class="input_area">
            <input class="input" type="text" name="invoicedesignation" id="sp_invoicedesignation" value="{$data.invoicedesignation}" maxlength="" tabindex="" />
          </div>
   		  {if $error.invoicedesignation ne ''}
		  		<div id="e_sp_invoicedesignation" class="form_error_message_new">{$error.invoicedesignation}</div> 
		  {else}
		  		<div id="e_sp_invoicedesignation"></div> 
		  {/if}

        </div>
        <div style="clear:both;">
          <div class="input_txt_apply">Address:</div>
          <div class="input_area_txt">
            <textarea id='sp_invoiceaddress' class='bluebar_txtarea' name='invoiceaddress' tabindex='' maxlength='300' onkeyup='return ismaxlength(this)'>{$data.invoiceaddress}</textarea>
          </div>
   		  {if $error.invoiceaddress ne ''}
		  		<div id="e_sp_invoiceaddress" class="form_error_message_new">{$error.invoiceaddress}</div> 
		  {else}
		  		<div id="e_sp_invoiceaddress"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Telephone:</div>
          <div class="input_area">
            <input class="input" type="text" name="invoicetelephone" id="sp_invoicetelephone" value="{$data.invoicetelephone}" maxlength="" tabindex="" />
          </div>
   		  {if $error.invoicetelephone ne ''}
		  		<div id="e_sp_invoicetelephone" class="form_error_message_new">{$error.invoicetelephone}</div> 
		  {else}
		  		<div id="e_sp_invoicetelephone"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Fax:</div>
          <div class="input_area">
            <input class="input" type="text" name="invoicefax" id="sp_invoicefax" value="{$data.invoicefax}" maxlength="" tabindex="" />
          </div>
   		  {if $error.invoicefax ne ''}
		  		<div id="e_sp_invoicefax" class="form_error_message_new">{$error.invoicefax}</div> 
		  {else}
		  		<div id="e_sp_invoicefax"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Email:</div>
          <div class="input_area">
            <input class="input" type="text" name="invoiceemail" id="sp_invoiceemail" value="{$data.invoiceemail}" maxlength="" tabindex="" />
          </div>
   		  {if $error.invoiceemail ne ''}
		  		<div id="e_sp_invoiceemail" class="form_error_message_new">{$error.invoiceemail}</div> 
		  {else}
		  		<div id="e_sp_invoiceemail"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Website:</div>
          <div class="input_area">
            <input class="input" type="text" name="invoicewebsite" id="sp_invoicewebsite" value="{$data.invoicewebsite}" maxlength="" tabindex="" />
          </div>
   		  {if $error.invoicewebsite ne ''}
		  		<div id="e_sp_invoicewebsite" class="form_error_message_new">{$error.invoicewebsite}</div> 
		  {else}
		  		<div id="e_sp_invoicewebsite"></div> 
		  {/if}

        </div>
		
<!--		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Signature:</div>
          <div class="input_area">
            <input class="input" type="text" name="signature2" id="sp_signature2" value="{$data.signature2}" maxlength="" tabindex="" />
          </div>

        </div>

		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Date(MM/YYYY):</div>
          <div class="input_area">
            <input class="input" type="text" name="signaturedate2" id="sp_signaturedate2" value="{$data.signaturedate2}" maxlength="" tabindex="" />
          </div>

        </div>
-->

	<div class="simple_txt">Executive Development (Person in charge of management development in your company).</div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Name:</div>
          <div class="input_area">
            <input class="input" type="text" name="executivename" id="sp_executivename" value="{$data.executivename}" maxlength="" tabindex="" />
		  </div>
   		  {if $error.executivename ne ''}
		  		<div id="e_sp_executivename" class="form_error_message_new">{$error.executivename}</div> 
		  {else}
		  		<div id="e_sp_executivename"></div> 
		  {/if}

        </div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">Designation:</div>
          <div class="input_area">
            <input class="input" type="text" name="executivedesignation" id="sp_executivedesignation" value="{$data.executivedesignation}" maxlength="" tabindex="" />
          </div>
   		  {if $error.executivedesignation ne ''}
		  		<div id="e_sp_executivedesignation" class="form_error_message_new">{$error.executivedesignation}</div> 
		  {else}
		  		<div id="e_sp_executivedesignation"></div> 
		  {/if}

        </div>
        <div style="clear:both;">
          <div class="input_txt_apply">Address:</div>
          <div class="input_area_txt">
            <textarea id='sp_executiveaddress' class='bluebar_txtarea' name='executiveaddress' tabindex='' maxlength='300' onkeyup='return ismaxlength(this)'>{$data.executiveaddress}</textarea>
          </div>
   		  {if $error.executiveaddress ne ''}
		  		<div id="e_sp_executiveaddress" class="form_error_message_new">{$error.executiveaddress}</div> 
		  {else}
		  		<div id="e_sp_executiveaddress"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Telephone:</div>
          <div class="input_area">
            <input class="input" type="text" name="executivetelephone" id="sp_executivetelephone" value="{$data.executivetelephone}" maxlength="" tabindex="" />
          </div>
   		  {if $error.executivetelephone ne ''}
		  		<div id="e_sp_executivetelephone" class="form_error_message_new">{$error.executivetelephone}</div> 
		  {else}
		  		<div id="e_sp_executivetelephone"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Fax:</div>
          <div class="input_area">
            <input class="input" type="text" name="executivefax" id="sp_executivefax" value="{$data.executivefax}" maxlength="" tabindex="" />
          </div>
   		  {if $error.executivefax ne ''}
		  		<div id="e_sp_executivefax" class="form_error_message_new">{$error.executivefax}</div> 
		  {else}
		  		<div id="e_sp_executivefax"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Email:</div>
          <div class="input_area">
            <input class="input" type="text" name="executiveemail" id="sp_executiveemail" value="{$data.executiveemail}" maxlength="" tabindex="" />
          </div>
   		  {if $error.executiveemail ne ''}
		  		<div id="e_sp_executiveemail" class="form_error_message_new">{$error.executiveemail}</div> 
		  {else}
		  		<div id="e_sp_executiveemail"></div> 
		  {/if}

        </div>
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Website:</div>
          <div class="input_area">
            <input class="input" type="text" name="executivewebsite" id="sp_executivewebsite" value="{$data.executivewebsite}" maxlength="" tabindex="" />
          </div>
   		  {if $error.executivewebsite ne ''}
		  		<div id="e_sp_executivewebsite" class="form_error_message_new">{$error.executivewebsite}</div> 
		  {else}
		  		<div id="e_sp_executivewebsite"></div> 
		  {/if}

        </div>

<!--		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Signature:</div>
          <div class="input_area">
            <input class="input" type="text" name="signature3" id="sp_signature3" value="{$data.signature3}" maxlength="" tabindex="" />
          </div>

        </div>

		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Date(MM/YYYY):</div>
          <div class="input_area">
            <input class="input" type="text" name="signaturedate3" id="sp_signaturedate3" value="{$data.signaturedate3}" maxlength="" tabindex="" />
          </div>

        </div>
-->		

		<div style="clear:both">
          <div class="input_txt_apply">Do you wish to be informed about our programmes via email on regular basis?:</div>
          <div class="input_area">
            <input type='radio' name='informemail' value = 'No' {if $data.informemail eq 'No' or $data.informemail eq ''} checked="checked"{/if} tabindex='' />&nbsp;<span class="simple_txt_radio">No</span> 
			<input type='radio' name='informemail' value = 'Yes' {if $data.informemail eq 'Yes'} checked="checked"{/if} />&nbsp;<span class="simple_txt_radio">Yes</span>
          </div>
		 </div>

		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Do you wish to avail residence at REC-LUMS during the programme?:</div>
          <div class="input_area">
            <input type='radio' name='availresidence' value = 'No' {if $data.availresidence eq 'No' or $data.availresidence eq '' } checked="checked"{/if} tabindex='' />&nbsp;<span class="simple_txt_radio">No</span> 
			<input type='radio' name='availresidence' value = 'Yes' {if $data.availresidence eq 'Yes'} checked="checked"{/if} />&nbsp;<span class="simple_txt_radio">Yes</span>
          </div>
		  {if $error.availresidence ne ''}
		  		<div id="e_sp_availresidence" class="form_error_message_new">{$error.availresidence}</div> 
		  {else}
		  		<div id="e_sp_availresidence"></div> 
		  {/if}		  
		 </div>


        
        <div style="height:30px;"><img src="{$GENERAL.BASE_URL_ROOT}/images/spacer.gif" /></div>
        <div class="button_strip_area">
		<div  style="float:left; padding-right:10px;" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/back.gif" onclick="return goStep('professional');"  border="0" /></div>
          <div  style="float:left; padding-right:10px;" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/saveandcontinue.gif"  border="0" onclick="return formValidation();" /></div>
          <div  style="float:left" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/exit.gif" onclick="return exitForm();"  border="0" /></div>
        </div>
      </div>
	  		</form>
		{elseif $steps eq 'information'}
			<form name="informationform" id="informationform" method="post" action="{$GENERAL.BASE_URL_ROOT}/apply.php?pid={$smarty.get.pid}#apply">
				<div class="main_form_area">
        <div class="form_heading_online">Information Source</div>
        <div class="simple_txt"></div>
        <div style="height:29px; clear:both">
          <div class="input_txt_apply">How did you learn about us?:<span class="required">&nbsp;*</span></div>
          <div class="input_area">
            <select name='learnabout' class='bluebar_apply' tabindex='' id='info_learnabout'>
					<option value=''>--select--</option>
					<option value='Website'>Website</option>
					<option value='Executive Alumni'>Executive Alumni</option>
                    <option value='Brochure'>Brochure</option>
                    <option value='Referred by HR department'>Referred by HR department</option>
                    <option value='Press Advertisement'>Press Advertisement</option>
                    <option value='Web Advertisement'>Web Advertisement</option>
					<!--<option value='Annual Brochure'>Annual Brochure</option>
					<option value='Referred by HR Department at LUMS'>Referred by HR Department at LUMS</option>
					<option value='Referred by HR Department of My Organization'>Referred by HR Department of My Organization</option>-->
					<option value='other'>Other</option>
			</select>
			<script language='javascript'>
				selectDropdown('info_learnabout' , '{$data.learnabout}');
			</script>
			
			<input type="hidden" name="steps" id="steps" value="information" />
			<input type="hidden" name="next_steps" id="next_steps" value="information" />
			<input type="hidden" name="prev_steps" id="prev_steps" value="sponsorship" />
			<input type="hidden" name="state" id="state" value="submit" />
			<input type="hidden" name="action" id="action" value="submit" />
			<input type="hidden" name="oepaid" id="oepaid" value="{$oepaid}" />
          </div>
   		  {if $error.learnabout ne ''}
		  		<div id="e_info_learnabout" class="form_error_message_new">{$error.learnabout}</div> 
		  {else}
		  		<div id="e_info_learnabout"></div> 
		  {/if}

        </div>
		
		
		<div style="height:29px; clear:both">
          <div class="input_txt_apply">Specify other:</div>
          <div class="input_area">
            <input class="input" type="text" name="learnabout_other" id="info_learnabout_other" value="{$data.learnabout_other}" maxlength="" tabindex="" />
          </div>
   		  {if $error.learnabout_other ne ''}
		  		<div id="e_info_learnabout_other" class="form_error_message_new">{$error.learnabout_other}</div> 
		  {else}
		  		<div id="e_info_learnabout_other"></div> 
		  {/if}

        </div>		
        
        <div style="height:30px;"><img src="{$GENERAL.BASE_URL_ROOT}/images/spacer.gif" /></div>
        <div class="button_strip_area">
          <div  style="float:left; padding-right:10px;"><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/back.gif" onclick="return goStep('sponsorship');"  border="0" /></div>
          <div  style="float:left; padding-right:10px;"><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/exit.gif" onclick="return exitForm();"  border="0" /></div>
		  <div  style="float:left" ><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/submit.gif" onclick="return submitFinal();"  border="0" /></div>
        </div>
      </div>
	  		</form>
	  	{/if}
		
	{/if}
	</div>
  </div>
{/if}

</div>
<div class="clear"></div>
<div class="tabs_bar">
	<div class="tabs"></div>
</div>
{include file="footer.tpl"}
</div>
{include_php file="bar.php"}
{literal}
	<script type="text/javascript">
		setNavImg();
	</script>
{/literal}
</body>
</html>