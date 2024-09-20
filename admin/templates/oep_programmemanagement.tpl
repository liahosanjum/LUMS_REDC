{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file="$tpl_path/top_header.tpl"}
<!--<script language="javascript" src='{$GENERAL.BASE_URL_ROOT}/jscript/jquery.js'></script>
<script language="javascript" src='{$GENERAL.BASE_URL_ROOT}/jscript/jscripts.js'></script>
<script src="{$GENERAL.BASE_URL_ROOT}/jscript/CalendarPopup.js"></script>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>
<link href="{$GENERAL.BASE_URL_ROOT}/css/black-calender.css" rel=stylesheet type="text/css">-->
<script language="javascript" src='{$GENERAL.BASE_URL_ROOT}/jscript/jquery.js'></script>
<script language="javascript" src='{$GENERAL.BASE_URL_ROOT}/jscript/jscripts.js'></script>
<script src="{$GENERAL.BASE_URL_ROOT}/jscript/CalendarPopup.js"></script>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>
<link href="{$GENERAL.BASE_URL_ROOT}/css/black-calender.css" rel=stylesheet type="text/css">

{literal}

<script type="text/javascript">
       
 	   function controlDates(pageview)
	   {
	   		var obj = document.getElementById("status");
			if(obj.value == 'a')
			{
				document.getElementById('datediv').style.display = 'block';
			}
			else if(obj.value == 'tba')
			{
				if(pageview == 'add')
				{
					document.forms[0].startdate.value = '';
					document.forms[0].enddate.value = '';
					document.forms[0].deadline.value = '';
				}
				document.getElementById('datediv').style.display = 'none';
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
		function submitForm()
		{
			document.forms[0].submit();
		}

	function deleteconfirmation(oepid,oepcatid)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href='oep_programme.php?action=del&oepid='+oepid+'&oepcatid='+oepcatid;
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
<body onload="controlDates('{$pageview}');">
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/oep_programme.php?action=submit&mode={$pageview}{if $pageview eq 'edit'}&oepid={$data.oepid}{/if}" method="post"  enctype="multipart/form-data" name="frmadd">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/oep.gif" alt="" width="48" height="48" /></td>
              <td width="558"><span class="pageTitle"><span class="tableHeader">OEP Programmes Management </span></span><span class="pageTitle1"> [{if $pageview eq 'add'}Add{else}Edit{/if} Programme]</span></td>
              <td width="326" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                          Save</a> </td>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/oep_programme.php?oepcatid={$oepcatid.oepcatid}'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />Cancel</a></td>
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
        <td class="boderInner2" style="padding-left:10px;" ><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="padding-left:10px;">
            <tr>
              <td height="10" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" align="center">&nbsp;</td>
              <td width="617" valign="top" class="boderInner2" align="center"><table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt" align="center">
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox"><input type="hidden" name="oepid" value="{$data.oepid|escape}" />  </td>
					<td align="left" colspan="2" class="tipbox"><input type="hidden" name="oepcatid" value="{$oepcatid.oepcatid}" /></td>
                  </tr>
                 <tr class="row2">
                    <td width="19%" align="right" valign="top">Category Name :&nbsp;</td>
                    <td width="81%" align="left"><select name="oepcatid" class="select_class" >
							{foreach from=$pname item='id'}
								{if $data.oepcatid eq $id.oepcatid}
									<option value="{$id.oepcatid}" selected="selected">{$id.name}</option>
								{else}
									<option value="{$id.oepcatid}">{$id.name}</option>
								{/if}	
								
							{/foreach}
						</select>
						<span class="required">&nbsp;</span>
                     </td>
                  </tr>    
				  <tr class="row2">
                    <td width="29%" align="right" valign="top"> Programme Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="name" class="input" value="{$data.name|escape}"  maxlength="200"/>
                      <span class="required">*</span></td>
                  </tr>   
				   <tr class="row2">
				  <td align="right" width="19"> Status :&nbsp; </td>
				  <td align="left">
				  	<select class="select_class" id="status" name="status" onchange="return controlDates('{$pageview}');"> 
						<option value="a" {if $data.status eq 'a'} selected="selected" {/if}>Announced</option>
						<option value="tba" {if $data.status eq 'tba'} selected="selected"{/if}>TBA</option>
					</select>
				</td>
				  </tr> 
				  	 <tr class='row2'>
					 	<td colspan="2" width="100%">
							<div id="datediv">
							<table width="100%" cellpadding="0" cellspacing="0">
								 <tr class="row2" height="25">
									<td align="right" valign="top" width="29%">Start Date :&nbsp;</td>
									<td width="81%" align="left"><input type="text" name="startdate" class="input" value="{if $data.startdate ne '0000-00-00'}{$data.startdate|escape}{/if}" readonly="" id="stamp1">
								  <input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp1);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
								  <span class="required">&nbsp;*</span><!--&nbsp;<a href="javascript:ds_hi();">Hide</a>-->
								  <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
									<tr>
									  <td id="ds_calclass"></td>
									</tr>
								  </table>
								  {literal}
								  <script src="scripts/black-calender.js" language="javascript"></script>
								  {/literal}
									</td>
								  </tr>
								 <tr class="row2" height="25" id="enddiv">
									<td align="right" valign="top">End Date :&nbsp;</td>
									<td width="81%" align="left"><input type="text" name="enddate" class="input" value="{if $data.startdate ne '0000-00-00'}{$data.enddate|escape}{/if}" readonly="" id="stamp2">
								  <input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp2);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
								  <span class="required">&nbsp;*</span><!--&nbsp;<a href="javascript:ds_hi();">Hide</a>-->
								  <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
									<tr>
									  <td id="ds_calclass"></td>
									</tr>
								  </table>
								  {literal}
								  <script src="scripts/black-calender.js" language="javascript"></script>
								  {/literal}
									</td>
								  </tr>
								 <tr class="row2" height="25">
									<td align="right" valign="top">Application Deadline :&nbsp;</td>
									<td width="81%" align="left"><input type="text" name="deadline" class="input" value="{if $data.startdate ne '0000-00-00'}{$data.deadline|escape}{/if}" readonly="" id="stamp3">
								  <input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp3);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
								  <span class="required">&nbsp;*</span><!--&nbsp;<a href="javascript:ds_hi();">Hide</a>-->
								  <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
									<tr>
									  <td id="ds_calclass"></td>
									</tr>
								  </table>
								  {literal}
								  <script src="scripts/black-calender.js" language="javascript"></script>
								  {/literal}
									</td>
								  </tr>
							</table>
							</div>
						</td>
					 </tr>		
					  
				  <tr class="row2" height="25">
                    <td align="right" width="19%">Venue :&nbsp;</td>
                    <td align="left"><input type="text" name="venue" class="input" value="{$data.venue|escape}"  maxlength="100"/><span class="required">&nbsp;*</span></td>
                  </tr>
                  
                  <tr class="row2" height="25">
                    <td align="right" width="19%">Programme Level :&nbsp;</td>
                    <td align="left">
                    <select name="programmelevel" class="select_class" value="{$data.programmelevel}">
							<option value="Top Management" {if $data.programmelevel eq 'Top Management'} selected="selected" {/if}>Top Management</option>
							<option value="Senior Management" {if $data.programmelevel eq 'Senior Management'} selected="selected" {/if}>Senior Management</option>
							<option value="Middle Management" {if $data.programmelevel eq 'Middle Management'} selected="selected" {/if}>Middle Management</option>

                    <option value="First Line Manager" {if $data.programmelevel eq 'First Line Manager'} selected="selected" {/if}>First Line Manager</option>
                    
					<option value="Others" {if $data.programmelevel eq 'Others '} selected="selected" {/if}>Others</option>
                    
					</select>
						<span class="required">&nbsp;</span>
                       </td>
                  </tr> 	
                  <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top">Brochure :&nbsp;</td>
                    <td align="left"><input type="file" onkeypress="return false;" name="oepimage" size="25"  />
					{if $data.old_image ne ''}
						 <input type="hidden" name="old_image" value="{$data.old_image}" />
                         <a href="{$GENERAL.FRONT_UPLOAD_URL}/Oep-Programmes/{$data.oepimage}" target="_blank" class="link">view file</a>
					{/if}
					 </td>                         
                  </tr>
			    <input type="hidden" name="iscompleted" value="N">
                <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top">Faculty/Director :&nbsp;</td>
                    <td align="left">
					
					
					
						 
						
						<select name="faculty" >
                        	<option value="">None</option>
							{foreach from =$faculty item="fac"}
								{if $fac.fid eq $data.faculty}
									<option value="{$fac.fid}" selected="selected">{$fac.name}</option>
								{else}
									<option value="{$fac.fid}">{$fac.name}</option>
								{/if}
							{/foreach}
						</select><span class="required">&nbsp;</span>
					</td>
                  </tr> 
				  
				
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Faculty/Director Info :&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
					<!--<textarea name="facultyinfo" id="facultyinfo" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="1000">{$data.facultyinfo|escape}</textarea>-->
                    {php}
                        $oFCKeditor 			= new FCKeditor('facultyinfo') ;
                        $oFCKeditor->BasePath 	= SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['facultyinfo'];
                        $oFCKeditor->Create() ;
                      {/php}
                    <!--<textarea name="introduction" id="introduction" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="1000">{$data.introduction|escape}</textarea>-->
					</td>
                  </tr>
				  
				  
				  
				     <tr class="row2" height="25">
                    <td align="right" width="30%" valign="top">Faculty/Director :</td>
                    <td align="left" width="70%">
					
					
					
<!--<select name="faculty[]"   multiple="multiple">
<option value="">None</option>
{foreach from =$faculty item="fac"}
{if in_array( $fac.fid , $data.faculty_member)}
<option value="{$fac.fid}"  selected="selected">{$fac.name}</option>
{else}
<option value="{$fac.fid}">{$fac.name}{$fac.fid}</option>
{/if}
{/foreach}
</select><span class="required">&nbsp;</span>-->

						
						<select name="faculty2" >
                        	<option value="">None</option>
							{foreach from =$faculty item="fac"}
								{if $fac.fid eq $data.faculty2}
									<option value="{$fac.fid}" selected="selected">{$fac.name}</option>
								{else}
									<option value="{$fac.fid}">{$fac.name}</option>
								{/if}
							{/foreach}
						</select><span class="required">&nbsp;</span>
					</td>
                  </tr> 
				  
				   <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Additional Faculty/Director Info:&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
					<!--<textarea name="facultyinfo2" id="facultyinfo2" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="1000">{$data.facultyinfo2|escape}</textarea>-->
                    {php}
                        $oFCKeditor = new FCKeditor('facultyinfo2') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['facultyinfo2'];
                        $oFCKeditor->Create() ;
                      {/php}
                    <!--<textarea name="introduction" id="introduction" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="1000">{$data.introduction|escape}</textarea>-->
					</td>
                  </tr>
				  
				  
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Introduction :&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
                    {php}
                        $oFCKeditor = new FCKeditor('introduction') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['introduction'];
                        $oFCKeditor->Create() ;
                      {/php}
                    <!--<textarea name="introduction" id="introduction" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="1000">{$data.introduction|escape}</textarea>-->
					</td>
                  </tr>
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Objective :&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">                    
                    <td align="left" colspan="2">
                    {php}
                        $oFCKeditor = new FCKeditor('objective') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['objective'];
                        $oFCKeditor->Create() ;
                      {/php}
                    <!--<textarea name="objective" id="objective" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="500">{$data.objective|escape}</textarea>-->
					</td>
                  </tr> 
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Curriculum :&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
                     {php}
                        $oFCKeditor = new FCKeditor('curriculum') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['curriculum'];
                        $oFCKeditor->Create() ;
                      {/php}
                    <!--<textarea name="curriculum" id="curriculum" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="500">{$data.curriculum|escape}</textarea>-->
					</td>
                  </tr> 
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Participants :&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
                    {php}
                        $oFCKeditor = new FCKeditor('participents') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['participents'];
                        $oFCKeditor->Create() ;
                      {/php}
                    <!--<textarea name="participents" id="participents" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="500">{$data.participents|escape}</textarea>-->
					</td>
                  </tr> 
				  
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Learning Model:&nbsp;</td>
                  </tr>			 
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
                    {php}
                        $oFCKeditor = new FCKeditor('learningmodel') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['learningmodel'];
                        $oFCKeditor->Create() ;
                      {/php}
                    <!--<textarea name="learningmodel" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="500">{$data.learningmodel|escape}</textarea>-->
					</td>
                  </tr>
				  
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Testimonials:&nbsp;</td>
                  </tr>			 
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
                    {php}
                        $oFCKeditor = new FCKeditor('testimonials') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['testimonials'];
                        $oFCKeditor->Create() ;
                      {/php}
                    <!--<textarea name="testimonials" id="testimonials" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="500">{$data.testimonials|escape}</textarea>-->
					</td>
                  </tr> 
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Fee And Condition:&nbsp;</td>
                  </tr>
				   <tr class="row2" height="25">
                    <td align="left" colspan="2">
                     {php}
                        $oFCKeditor = new FCKeditor('feecondition') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['feecondition'];
                        $oFCKeditor->Create() ;
                      {/php}
                    <!--<textarea name="feecondition" id="feecondition" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="500">{$data.feecondition|escape}</textarea>-->
					<span class="required">&nbsp;*</span></td>
                  </tr>
				  
				 <!--  <tr class="row2" height="25"> 
				   
                   <td align="right" width="19%">Completed :&nbsp;</td>
                    <td align="left">
						<select class="select_class" name="iscompleted">
							<option value="N" {if $data.iscompleted eq 'N'} selected="selected"{/if}>No</option>
							<option value="Y" {if $data.iscompleted eq 'Y'} selected="selected"{/if}>Yes</option>
						</select>
					</td>
					
                  </tr> -->
				  <tr class="row2" height="25">
                    <td align="right" width="19%">Enabled :&nbsp;</td>
                    <td align="left"><select class="select_class" name="isactive"><option value="Yes" {if $data.isactive eq 'Yes'} selected="selected"{/if}>Yes</option><option value="No" {if $data.isactive eq 'No'} selected="selected"{/if}>No</option></select><span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2" height="25">
				  <td align="right" width="19"> IsFeatured: </td>
				  <td align="left">
				  	<select class="select_class" name="isfeatured"> 
						<option value="N" {if $data.isfeatured eq 'N'} selected="selected" {/if}>No</option>
						<option value="Y" {if $data.isfeatured eq 'Y'} selected="selected"{/if}>Yes</option>
					</select>
				</td>
				  </tr> 
				  <tr><td height="5"></td></tr>
                  <tr><td height="5"></td></tr>
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
                                <li>To go back to Active programmes, click Cancel button</li>
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
    </table>
  </form>
  <!--- content area  --->
  {else}
  <form action="{$GENERAL.BASE_URL_ADMIN}/oep_programme.php" method="post" >
	<input type="hidden" name="action" id="action" value="" />

    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/oep.gif" alt="" width="48" height="48" /></td>
              <td width="500"><span class="pageTitle">OEP Programmes Management </span><span class="pageTitle1" style="font-size:13px;"> [{if $smarty.get.iscompleted eq 'Y' or $iscompleted eq 'Y'}Completed {else}Active {/if}Programmes]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
                      <td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/oep_programme.php?action=add&oepcatid={$oepcatid.oepcatid}'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png" /><br/> Add </a> </td>
                      <!--<td class="button" id="toolbar-cancel"><a href="{$GENERAL.BASE_URL_ADMIN}/oep_programme.php" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /><br /> Back </a></td>-->
					 
					 {if $iscompleted ne ''}
					 	<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/oep_programme.php?oepcatid={$oepcatid.oepcatid}" style="toolbar">
					 <img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-default.png" border="0" title="view open programmes" /><br/> Active Programmes </a></td>	
					 {else}
					  <td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/oep_programme.php?iscompleted=Y&oepcatid={$oepcatid.oepcatid}" style="toolbar">
					 <img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-archive.png" border="0" title="view completed programmes" /><br/> Completed Programmes </a></td>
					 {/if}
						<td class="button" id="toolbar-apply" ><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-export.png" onclick="javascript:submitExport()" style="cursor:pointer;" /><br/> Export To CSV </a> </td>
					 	<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php" style="toolbar">
					 <img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-default.png" border="0" title="manage applicants" /><br/> Manage Applicants </a></td>	
					 
					</tr>
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
			<input type="hidden" name="iscompleted" value="{$iscompleted}" />
                <input type="hidden" name="sortdirection" value="{$sortdirection}" />
				<td align="left" colspan="2" class="tipbox"><input type="hidden" name="oepcatid" value="{$oepcatid.oepcatid}" /></td>
			</td>
          </tr>
          <tr>
			<td colspan="5" align="left">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:7px;">
				<tr>
					<td class="th" width="122" style="padding-left:12px; padding-top:5px;" align="right">Programme Name:</td>
					<td  width="20" style="padding-left:7px; padding-top:5px;"><input type="text" name="search_by_name" class="input" value="{$formvars.search_by_name}"  maxlength="100"/></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="th" width="122" style="padding-left:12px; padding-top:5px;" align="right">Category Name:</td>
					<td  width="20" style="padding-left:7px; padding-top:5px;">
						<select name="search_by_oepcatid" class="select_class">
							<option value="">--select category--</option>
							{foreach from=$category item="cat"}
								{if $formvars.search_by_oepcatid eq $cat.oepcatid}
									<option value="{$cat.oepcatid}" selected="selected">{$cat.name|escape}</option>
								{else}
									<option value="{$cat.oepcatid}">{$cat.name|escape}</option>
								{/if}
							{/foreach}
						</select>
					</td>
				<td style="padding-left:7px; padding-top:5px;"><input class="grid" type="button" name="Submit" value="Search" onclick="javascript: submitSearch();"  /></td>
				</tr>
				</table>
			</td>
			</tr>
		  <tr >
          <td width="10" align="center">&nbsp;</td>
          <td width="617" valign="top" class="boderInner2" align="center">          
         <table width="100%" border="0"  class="grid">
                      <tr  height="20">
                        <td style="width:30%" align="center" ><a href="javascript:sortRecords('name',true)" class="th" >Programme Name</a></td>
                        <td style="width:15%" align="center" ><a href="javascript:sortRecords('startdate',true)"  class="th"> Start Date</a></td>
						<td style="width:15%" align="center" ><a href="javascript:void(0)"  class="th">Applicants</a></td>
						<td style="width:15%" align="center" ><a href="javascript:sortRecords('isactive',true)"  class="th">Enabled </a></td>
						<td align="center" class="th" width="10%" >Edit</td>
                        <td align="center" class="th" width="10%">Delete</td>
						 </tr>
                      <tr class="row1">
                        <td height="5" colspan="6" align="center" class="borderBtmDashed"></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;">
                        <td align="center">{$entry.name}</td>
                        <td align="center">{if $entry.status ne 'tba'}{$entry.startdate}{else}TBA{/if}</td>
						<td align="center"><a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php?action=parent&pid={$entry.oepid}&iscompleted={$iscompleted}" class="th">view</a></td>
						<td align="center">{$entry.isactive}</td>
                       <td align="center" ><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/oep_programme.php?action=edit&oepid={$entry.oepid}&oepcatid={$oepcatid.oepcatid}'"  class="btnText"  /> </td>
                       <td align="center" width="10"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.oepid}','{$oepcatid.oepcatid}');"  class="btnText"  /> </td>
						</tr>
                      {/foreach}
                      <tr>
					  {if $countRecords gt 20}
                        <td colspan="5" align="center"> {$paging} </td>
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
							  {if $smarty.get.iscompleted eq 'Y'}
								  <li>To View open programmes, click the 'Open Programmes' button</li>
							  {else}
							  	  <li>To View completed programmes, click the 'Completed Programmes' button</li>
							  {/if}
							  <li>To View applicants, click the 'Manage Applicants' button</li>
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
   <DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv2" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv3" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
</table>
</body>
</html>
