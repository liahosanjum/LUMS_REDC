<?php /* Smarty version 2.6.22, created on 2011-04-01 01:32:21
         compiled from oep_programmemanagement.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'oep_programmemanagement.tpl', 169, false),)), $this); ?>
<?php $this->assign('tpl_path', $this->_tpl_vars['GENERAL']['BASE_DIR_ADMIN_TPL']); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/top_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--<script language="javascript" src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/jscript/jquery.js'></script>
<script language="javascript" src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/jscript/jscripts.js'></script>
<script src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/jscript/CalendarPopup.js"></script>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>
<link href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/black-calender.css" rel=stylesheet type="text/css">-->
<script language="javascript" src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/jscript/jquery.js'></script>
<script language="javascript" src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/jscript/jscripts.js'></script>
<script src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/jscript/CalendarPopup.js"></script>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>
<link href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/black-calender.css" rel=stylesheet type="text/css">

<?php echo '

<script type="text/javascript">
       
 	   function controlDates(pageview)
	   {
	   		var obj = document.getElementById("status");
			if(obj.value == \'a\')
			{
				document.getElementById(\'datediv\').style.display = \'block\';
			}
			else if(obj.value == \'tba\')
			{
				if(pageview == \'add\')
				{
					document.forms[0].startdate.value = \'\';
					document.forms[0].enddate.value = \'\';
					document.forms[0].deadline.value = \'\';
				}
				document.getElementById(\'datediv\').style.display = \'none\';
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
			
			document.getElementById(\'action\').value = "export";
			document.forms[0].submit();
		}
		function submitSearch()
		{
			document.getElementById(\'action\').value = "view";
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
			window.location.href=\'oep_programme.php?action=del&oepid=\'+oepid+\'&oepcatid=\'+oepcatid;
		}	
	}
	
	function sortRecords(col, order)
	{
		document.getElementById(\'action\').value = "";
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
'; ?>

</head>
<body onload="controlDates('<?php echo $this->_tpl_vars['pageview']; ?>
');">
<table width="991" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </td>
  </tr>
  <tr>
    <td height="15" class="boder"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" /></td>
  </tr>
  <tr>
  
  <td class="boder">
  
    <?php if ($this->_tpl_vars['pageview'] == 'add' || $this->_tpl_vars['pageview'] == 'edit'): ?>
  <!--- content area form --->
  <form action="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oep_programme.php?action=submit&mode=<?php echo $this->_tpl_vars['pageview']; ?>
<?php if ($this->_tpl_vars['pageview'] == 'edit'): ?>&oepid=<?php echo $this->_tpl_vars['data']['oepid']; ?>
<?php endif; ?>" method="post"  enctype="multipart/form-data" name="frmadd">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/oep.gif" alt="" width="48" height="48" /></td>
              <td width="558"><span class="pageTitle"><span class="tableHeader">OEP Programmes Management </span></span><span class="pageTitle1"> [<?php if ($this->_tpl_vars['pageview'] == 'add'): ?>Add<?php else: ?>Edit<?php endif; ?> Programme]</span></td>
              <td width="326" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                          Save</a> </td>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oep_programme.php?oepcatid=<?php echo $this->_tpl_vars['oepcatid']['oepcatid']; ?>
'" class="toolbar"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />Cancel</a></td>
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
        <td height="10"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
      <?php if ($this->_tpl_vars['error'] != ""): ?>
      <tr>
        <td height="10" class="errorBar"><?php echo $this->_tpl_vars['error']; ?>
</td>
      </tr>
      <tr>
        <td height="10"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
      <?php endif; ?>
      <tr>
        <td class="boderInner2" style="padding-left:10px;" ><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="padding-left:10px;">
            <tr>
              <td height="10" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" align="center">&nbsp;</td>
              <td width="617" valign="top" class="boderInner2" align="center"><table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt" align="center">
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox"><input type="hidden" name="oepid" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['oepid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />  </td>
					<td align="left" colspan="2" class="tipbox"><input type="hidden" name="oepcatid" value="<?php echo $this->_tpl_vars['oepcatid']['oepcatid']; ?>
" /></td>
                  </tr>
                 <tr class="row2">
                    <td width="19%" align="right" valign="top">Category Name :&nbsp;</td>
                    <td width="81%" align="left"><select name="oepcatid" class="select_class" >
							<?php $_from = $this->_tpl_vars['pname']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id']):
?>
								<?php if ($this->_tpl_vars['data']['oepcatid'] == $this->_tpl_vars['id']['oepcatid']): ?>
									<option value="<?php echo $this->_tpl_vars['id']['oepcatid']; ?>
" selected="selected"><?php echo $this->_tpl_vars['id']['name']; ?>
</option>
								<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['id']['oepcatid']; ?>
"><?php echo $this->_tpl_vars['id']['name']; ?>
</option>
								<?php endif; ?>	
								
							<?php endforeach; endif; unset($_from); ?>
						</select>
						<span class="required">&nbsp;</span>
                     </td>
                  </tr>    
				  <tr class="row2">
                    <td width="29%" align="right" valign="top"> Programme Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="name" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="200"/>
                      <span class="required">*</span></td>
                  </tr>   
				   <tr class="row2">
				  <td align="right" width="19"> Status :&nbsp; </td>
				  <td align="left">
				  	<select class="select_class" id="status" name="status" onchange="return controlDates('<?php echo $this->_tpl_vars['pageview']; ?>
');"> 
						<option value="a" <?php if ($this->_tpl_vars['data']['status'] == 'a'): ?> selected="selected" <?php endif; ?>>Announced</option>
						<option value="tba" <?php if ($this->_tpl_vars['data']['status'] == 'tba'): ?> selected="selected"<?php endif; ?>>TBA</option>
					</select>
				</td>
				  </tr> 
				  	 <tr class='row2'>
					 	<td colspan="2" width="100%">
							<div id="datediv">
							<table width="100%" cellpadding="0" cellspacing="0">
								 <tr class="row2" height="25">
									<td align="right" valign="top" width="29%">Start Date :&nbsp;</td>
									<td width="81%" align="left"><input type="text" name="startdate" class="input" value="<?php if ($this->_tpl_vars['data']['startdate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['startdate'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php endif; ?>" readonly="" id="stamp1">
								  <input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp1);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
								  <span class="required">&nbsp;*</span><!--&nbsp;<a href="javascript:ds_hi();">Hide</a>-->
								  <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
									<tr>
									  <td id="ds_calclass"></td>
									</tr>
								  </table>
								  <?php echo '
								  <script src="scripts/black-calender.js" language="javascript"></script>
								  '; ?>

									</td>
								  </tr>
								 <tr class="row2" height="25" id="enddiv">
									<td align="right" valign="top">End Date :&nbsp;</td>
									<td width="81%" align="left"><input type="text" name="enddate" class="input" value="<?php if ($this->_tpl_vars['data']['startdate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['enddate'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php endif; ?>" readonly="" id="stamp2">
								  <input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp2);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
								  <span class="required">&nbsp;*</span><!--&nbsp;<a href="javascript:ds_hi();">Hide</a>-->
								  <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
									<tr>
									  <td id="ds_calclass"></td>
									</tr>
								  </table>
								  <?php echo '
								  <script src="scripts/black-calender.js" language="javascript"></script>
								  '; ?>

									</td>
								  </tr>
								 <tr class="row2" height="25">
									<td align="right" valign="top">Application Deadline :&nbsp;</td>
									<td width="81%" align="left"><input type="text" name="deadline" class="input" value="<?php if ($this->_tpl_vars['data']['startdate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['deadline'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php endif; ?>" readonly="" id="stamp3">
								  <input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp3);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
								  <span class="required">&nbsp;*</span><!--&nbsp;<a href="javascript:ds_hi();">Hide</a>-->
								  <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
									<tr>
									  <td id="ds_calclass"></td>
									</tr>
								  </table>
								  <?php echo '
								  <script src="scripts/black-calender.js" language="javascript"></script>
								  '; ?>

									</td>
								  </tr>
							</table>
							</div>
						</td>
					 </tr>		
					  
				  <tr class="row2" height="25">
                    <td align="right" width="19%">Venue :&nbsp;</td>
                    <td align="left"><input type="text" name="venue" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['venue'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="100"/><span class="required">&nbsp;*</span></td>
                  </tr>
                  
                  <tr class="row2" height="25">
                    <td align="right" width="19%">Programme Level :&nbsp;</td>
                    <td align="left">
                    <select name="programmelevel" class="select_class" value="<?php echo $this->_tpl_vars['data']['programmelevel']; ?>
">
							<option value="Top Management" <?php if ($this->_tpl_vars['data']['programmelevel'] == 'Top Management'): ?> selected="selected" <?php endif; ?>>Top Management</option>
							<option value="Senior Management" <?php if ($this->_tpl_vars['data']['programmelevel'] == 'Senior Management'): ?> selected="selected" <?php endif; ?>>Senior Management</option>
							<option value="Middle Management" <?php if ($this->_tpl_vars['data']['programmelevel'] == 'Middle Management'): ?> selected="selected" <?php endif; ?>>Middle Management</option>

                    <option value="First Line Manager" <?php if ($this->_tpl_vars['data']['programmelevel'] == 'First Line Manager'): ?> selected="selected" <?php endif; ?>>First Line Manager</option>
                    
					<option value="Others" <?php if ($this->_tpl_vars['data']['programmelevel'] == 'Others '): ?> selected="selected" <?php endif; ?>>Others</option>
                    
					</select>
						<span class="required">&nbsp;</span>
                       </td>
                  </tr> 	
                  <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top">Brochure :&nbsp;</td>
                    <td align="left"><input type="file" onkeypress="return false;" name="oepimage" size="25"  />
					<?php if ($this->_tpl_vars['data']['old_image'] != ''): ?>
						 <input type="hidden" name="old_image" value="<?php echo $this->_tpl_vars['data']['old_image']; ?>
" />
                         <a href="<?php echo $this->_tpl_vars['GENERAL']['FRONT_UPLOAD_URL']; ?>
/Oep-Programmes/<?php echo $this->_tpl_vars['data']['oepimage']; ?>
" target="_blank" class="link">view file</a>
					<?php endif; ?>
					 </td>                         
                  </tr>
			    <input type="hidden" name="iscompleted" value="N">
                <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top">Faculty/Director :&nbsp;</td>
                    <td align="left">
					
					
					
						 
						
						<select name="faculty" >
                        	<option value="">None</option>
							<?php $_from = $this->_tpl_vars['faculty']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fac']):
?>
								<?php if ($this->_tpl_vars['fac']['fid'] == $this->_tpl_vars['data']['faculty']): ?>
									<option value="<?php echo $this->_tpl_vars['fac']['fid']; ?>
" selected="selected"><?php echo $this->_tpl_vars['fac']['name']; ?>
</option>
								<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['fac']['fid']; ?>
"><?php echo $this->_tpl_vars['fac']['name']; ?>
</option>
								<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
						</select><span class="required">&nbsp;</span>
					</td>
                  </tr> 
				  
				
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Faculty/Director Info :&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
					<!--<textarea name="facultyinfo" id="facultyinfo" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="1000"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['facultyinfo'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>-->
                    <?php 
                        $oFCKeditor 			= new FCKeditor('facultyinfo') ;
                        $oFCKeditor->BasePath 	= SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['facultyinfo'];
                        $oFCKeditor->Create() ;
                       ?>
                    <!--<textarea name="introduction" id="introduction" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="1000"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['introduction'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>-->
					</td>
                  </tr>
				  
				  
				  
				     <tr class="row2" height="25">
                    <td align="right" width="30%" valign="top">Faculty/Director :</td>
                    <td align="left" width="70%">
					
					
					
<!--<select name="faculty[]"   multiple="multiple">
<option value="">None</option>
<?php $_from = $this->_tpl_vars['faculty']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fac']):
?>
<?php if (in_array ( $this->_tpl_vars['fac']['fid'] , $this->_tpl_vars['data']['faculty_member'] )): ?>
<option value="<?php echo $this->_tpl_vars['fac']['fid']; ?>
"  selected="selected"><?php echo $this->_tpl_vars['fac']['name']; ?>
</option>
<?php else: ?>
<option value="<?php echo $this->_tpl_vars['fac']['fid']; ?>
"><?php echo $this->_tpl_vars['fac']['name']; ?>
<?php echo $this->_tpl_vars['fac']['fid']; ?>
</option>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</select><span class="required">&nbsp;</span>-->

						
						<select name="faculty2" >
                        	<option value="">None</option>
							<?php $_from = $this->_tpl_vars['faculty']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fac']):
?>
								<?php if ($this->_tpl_vars['fac']['fid'] == $this->_tpl_vars['data']['faculty2']): ?>
									<option value="<?php echo $this->_tpl_vars['fac']['fid']; ?>
" selected="selected"><?php echo $this->_tpl_vars['fac']['name']; ?>
</option>
								<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['fac']['fid']; ?>
"><?php echo $this->_tpl_vars['fac']['name']; ?>
</option>
								<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
						</select><span class="required">&nbsp;</span>
					</td>
                  </tr> 
				  
				   <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Additional Faculty/Director Info:&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
					<!--<textarea name="facultyinfo2" id="facultyinfo2" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="1000"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['facultyinfo2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>-->
                    <?php 
                        $oFCKeditor = new FCKeditor('facultyinfo2') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['facultyinfo2'];
                        $oFCKeditor->Create() ;
                       ?>
                    <!--<textarea name="introduction" id="introduction" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="1000"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['introduction'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>-->
					</td>
                  </tr>
				  
				  
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Introduction :&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
                    <?php 
                        $oFCKeditor = new FCKeditor('introduction') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['introduction'];
                        $oFCKeditor->Create() ;
                       ?>
                    <!--<textarea name="introduction" id="introduction" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="1000"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['introduction'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>-->
					</td>
                  </tr>
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Objective :&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">                    
                    <td align="left" colspan="2">
                    <?php 
                        $oFCKeditor = new FCKeditor('objective') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['objective'];
                        $oFCKeditor->Create() ;
                       ?>
                    <!--<textarea name="objective" id="objective" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="500"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['objective'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>-->
					</td>
                  </tr> 
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Curriculum :&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
                     <?php 
                        $oFCKeditor = new FCKeditor('curriculum') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['curriculum'];
                        $oFCKeditor->Create() ;
                       ?>
                    <!--<textarea name="curriculum" id="curriculum" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="500"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['curriculum'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>-->
					</td>
                  </tr> 
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Participants :&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
                    <?php 
                        $oFCKeditor = new FCKeditor('participents') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['participents'];
                        $oFCKeditor->Create() ;
                       ?>
                    <!--<textarea name="participents" id="participents" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="500"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['participents'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>-->
					</td>
                  </tr> 
				  
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Learning Model:&nbsp;</td>
                  </tr>			 
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
                    <?php 
                        $oFCKeditor = new FCKeditor('learningmodel') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['learningmodel'];
                        $oFCKeditor->Create() ;
                       ?>
                    <!--<textarea name="learningmodel" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="500"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['learningmodel'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>-->
					</td>
                  </tr>
				  
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Testimonials:&nbsp;</td>
                  </tr>			 
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
                    <?php 
                        $oFCKeditor = new FCKeditor('testimonials') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['testimonials'];
                        $oFCKeditor->Create() ;
                       ?>
                    <!--<textarea name="testimonials" id="testimonials" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="500"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['testimonials'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>-->
					</td>
                  </tr> 
                  <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Fee And Condition:&nbsp;</td>
                  </tr>
				   <tr class="row2" height="25">
                    <td align="left" colspan="2">
                     <?php 
                        $oFCKeditor = new FCKeditor('feecondition') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['feecondition'];
                        $oFCKeditor->Create() ;
                       ?>
                    <!--<textarea name="feecondition" id="feecondition" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="500"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['feecondition'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>-->
					<span class="required">&nbsp;*</span></td>
                  </tr>
				  
				 <!--  <tr class="row2" height="25"> 
				   
                   <td align="right" width="19%">Completed :&nbsp;</td>
                    <td align="left">
						<select class="select_class" name="iscompleted">
							<option value="N" <?php if ($this->_tpl_vars['data']['iscompleted'] == 'N'): ?> selected="selected"<?php endif; ?>>No</option>
							<option value="Y" <?php if ($this->_tpl_vars['data']['iscompleted'] == 'Y'): ?> selected="selected"<?php endif; ?>>Yes</option>
						</select>
					</td>
					
                  </tr> -->
				  <tr class="row2" height="25">
                    <td align="right" width="19%">Enabled :&nbsp;</td>
                    <td align="left"><select class="select_class" name="isactive"><option value="Yes" <?php if ($this->_tpl_vars['data']['isactive'] == 'Yes'): ?> selected="selected"<?php endif; ?>>Yes</option><option value="No" <?php if ($this->_tpl_vars['data']['isactive'] == 'No'): ?> selected="selected"<?php endif; ?>>No</option></select><span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2" height="25">
				  <td align="right" width="19"> IsFeatured: </td>
				  <td align="left">
				  	<select class="select_class" name="isfeatured"> 
						<option value="N" <?php if ($this->_tpl_vars['data']['isfeatured'] == 'N'): ?> selected="selected" <?php endif; ?>>No</option>
						<option value="Y" <?php if ($this->_tpl_vars['data']['isfeatured'] == 'Y'): ?> selected="selected"<?php endif; ?>>Yes</option>
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
                      <?php echo '
                      <script>
						  //TogglePanel(\'help1\');
						  </script>
                      '; ?>
</td>
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
  <?php else: ?>
  <form action="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oep_programme.php" method="post" >
	<input type="hidden" name="action" id="action" value="" />

    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/oep.gif" alt="" width="48" height="48" /></td>
              <td width="500"><span class="pageTitle">OEP Programmes Management </span><span class="pageTitle1" style="font-size:13px;"> [<?php if ($_GET['iscompleted'] == 'Y' || $this->_tpl_vars['iscompleted'] == 'Y'): ?>Completed <?php else: ?>Active <?php endif; ?>Programmes]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
                      <td class="button" id="toolbar-apply" ><a style="toolbar" href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oep_programme.php?action=add&oepcatid=<?php echo $this->_tpl_vars['oepcatid']['oepcatid']; ?>
'><img  border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-new.png" /><br/> Add </a> </td>
                      <!--<td class="button" id="toolbar-cancel"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oep_programme.php" class="toolbar"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/restore_f2.png" border="0" alt="" /><br /> Back </a></td>-->
					 
					 <?php if ($this->_tpl_vars['iscompleted'] != ''): ?>
					 	<td class="button" id="toolbar-apply" ><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oep_programme.php?oepcatid=<?php echo $this->_tpl_vars['oepcatid']['oepcatid']; ?>
" style="toolbar">
					 <img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-default.png" border="0" title="view open programmes" /><br/> Active Programmes </a></td>	
					 <?php else: ?>
					  <td class="button" id="toolbar-apply" ><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oep_programme.php?iscompleted=Y&oepcatid=<?php echo $this->_tpl_vars['oepcatid']['oepcatid']; ?>
" style="toolbar">
					 <img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-archive.png" border="0" title="view completed programmes" /><br/> Completed Programmes </a></td>
					 <?php endif; ?>
						<td class="button" id="toolbar-apply" ><img  border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-export.png" onclick="javascript:submitExport()" style="cursor:pointer;" /><br/> Export To CSV </a> </td>
					 	<td class="button" id="toolbar-apply" ><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php" style="toolbar">
					 <img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-default.png" border="0" title="manage applicants" /><br/> Manage Applicants </a></td>	
					 
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
        <td height="10"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
      <?php if ($this->_tpl_vars['error'] != ""): ?>
      <tr>
        <td height="10" class="errorBar"> <?php echo $this->_tpl_vars['error']; ?>
 </td>
      </tr>
      <tr>
        <td height="10"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
      <?php endif; ?>
      <tr>
        <td class="boderInner2">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10" colspan="5" align="center">
			<input type="hidden" name="sortcolumn" value="<?php echo $this->_tpl_vars['sortcolumn']; ?>
" />
			<input type="hidden" name="iscompleted" value="<?php echo $this->_tpl_vars['iscompleted']; ?>
" />
                <input type="hidden" name="sortdirection" value="<?php echo $this->_tpl_vars['sortdirection']; ?>
" />
				<td align="left" colspan="2" class="tipbox"><input type="hidden" name="oepcatid" value="<?php echo $this->_tpl_vars['oepcatid']['oepcatid']; ?>
" /></td>
			</td>
          </tr>
          <tr>
			<td colspan="5" align="left">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:7px;">
				<tr>
					<td class="th" width="122" style="padding-left:12px; padding-top:5px;" align="right">Programme Name:</td>
					<td  width="20" style="padding-left:7px; padding-top:5px;"><input type="text" name="search_by_name" class="input" value="<?php echo $this->_tpl_vars['formvars']['search_by_name']; ?>
"  maxlength="100"/></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td class="th" width="122" style="padding-left:12px; padding-top:5px;" align="right">Category Name:</td>
					<td  width="20" style="padding-left:7px; padding-top:5px;">
						<select name="search_by_oepcatid" class="select_class">
							<option value="">--select category--</option>
							<?php $_from = $this->_tpl_vars['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cat']):
?>
								<?php if ($this->_tpl_vars['formvars']['search_by_oepcatid'] == $this->_tpl_vars['cat']['oepcatid']): ?>
									<option value="<?php echo $this->_tpl_vars['cat']['oepcatid']; ?>
" selected="selected"><?php echo ((is_array($_tmp=$this->_tpl_vars['cat']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</option>
								<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['cat']['oepcatid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['cat']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</option>
								<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
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
                      <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
                      <tr class="row2"  style="height:25px;">
                        <td align="center"><?php echo $this->_tpl_vars['entry']['name']; ?>
</td>
                        <td align="center"><?php if ($this->_tpl_vars['entry']['status'] != 'tba'): ?><?php echo $this->_tpl_vars['entry']['startdate']; ?>
<?php else: ?>TBA<?php endif; ?></td>
						<td align="center"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?action=parent&pid=<?php echo $this->_tpl_vars['entry']['oepid']; ?>
&iscompleted=<?php echo $this->_tpl_vars['iscompleted']; ?>
" class="th">view</a></td>
						<td align="center"><?php echo $this->_tpl_vars['entry']['isactive']; ?>
</td>
                       <td align="center" ><img  style="border:0; cursor:pointer" border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/edit_s.png"  onclick="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oep_programme.php?action=edit&oepid=<?php echo $this->_tpl_vars['entry']['oepid']; ?>
&oepcatid=<?php echo $this->_tpl_vars['oepcatid']['oepcatid']; ?>
'"  class="btnText"  /> </td>
                       <td align="center" width="10"><img  style="border:0; cursor:pointer" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('<?php echo $this->_tpl_vars['entry']['oepid']; ?>
','<?php echo $this->_tpl_vars['oepcatid']['oepcatid']; ?>
');"  class="btnText"  /> </td>
						</tr>
                      <?php endforeach; endif; unset($_from); ?>
                      <tr>
					  <?php if ($this->_tpl_vars['countRecords'] > 20): ?>
                        <td colspan="5" align="center"> <?php echo $this->_tpl_vars['paging']; ?>
 </td>
					  <?php endif; ?>	
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
							  <?php if ($_GET['iscompleted'] == 'Y'): ?>
								  <li>To View open programmes, click the 'Open Programmes' button</li>
							  <?php else: ?>
							  	  <li>To View completed programmes, click the 'Completed Programmes' button</li>
							  <?php endif; ?>
							  <li>To View applicants, click the 'Manage Applicants' button</li>
							  <li>To Edit a record, click on the 'Edit' button against the record</li>
                              <li>To Delete a record, click on the 'Delete' button against the record</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php echo '
                    <script>
						  //TogglePanel(\'help5\');
						  </script>
                    '; ?>
</td>
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
  <?php endif; ?>
  </td>
</tr>
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   <DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv2" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv3" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
</table>
</body>
</html>