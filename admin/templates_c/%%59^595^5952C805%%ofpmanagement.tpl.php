<?php /* Smarty version 2.6.22, created on 2011-05-16 02:22:31
         compiled from ofpmanagement.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'ofpmanagement.tpl', 177, false),)), $this); ?>
<?php $this->assign('tpl_path', $this->_tpl_vars['GENERAL']['BASE_DIR_ADMIN_TPL']); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/top_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!--<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_DIR_ROOT']; ?>
/jscript/calendar/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_DIR_ROOT']; ?>
/jscript/calendar/jquery.datePicker.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_DIR_ROOT']; ?>
/jscript/calendar/date.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_DIR_ROOT']; ?>
/jscript/calendar/jquery.bigiframe.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_DIR_ROOT']; ?>
/jscript/calendar/jquery.datePicker.css">
-->
<script language="javascript" src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/jquery.js'></script>
<script language="javascript" src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/jscripts.js'></script>
<script src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/CalendarPopup.js"></script>
<SCRIPT LANGUAGE="JavaScript">document.write(getCalendarStyles());</SCRIPT>
<link href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/black-calender.css" rel=stylesheet type="text/css">

<?php echo '
<script type="text/javascript">
      
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

	function deleteconfirmation(id)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href=\'ofpmanagement.php?action=del&id=\'	+ id;
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
	
	function viewParticipant(id , status)
	{
		window.location.href = \'ofpparticipantmanagement.php?status=\'+status+\'&ofpid=\'+id;
	}
</script>
'; ?>

<?php echo '
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
'; ?>

</head>
<body>
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
/ofpmanagement.php?action=submit&mode=<?php echo $this->_tpl_vars['pageview']; ?>
<?php if ($this->_tpl_vars['pageview'] == 'edit'): ?>&id=<?php echo $this->_tpl_vars['data']['ofpid']; ?>
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
/ofp.gif" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle"><span class="tableHeader">OFP Manager</span></span><span class="pageTitle1">&nbsp;[<?php if ($this->_tpl_vars['pageview'] == 'add'): ?>Add<?php else: ?>Edit<?php endif; ?> programme]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                          Save</a> </td>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/ofpmanagement.php'" class="toolbar"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
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
        <td class="boderInner2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="10" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" align="center">&nbsp;</td>
              <td width="617" valign="top" class="boderInner2">
			  	<table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox"><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>
" />                    </td>
                  </tr>
                
				  <tr class="row2">
                    <td width="24%" align="right" valign="top">Client Organization Name :&nbsp;</td>
                    <td width="76%" align="left"><input type="text" name="clientorgname" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['clientorgname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="100"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="24%" align="right" valign="top">Org Address :&nbsp;</td>
                    <td width="76%" align="left"><input type="text" name="orgaddress" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['orgaddress'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="100"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr> 
 				<tr class="row2">
                    <td width="40%" align="right" valign="top">Client Contact Person :&nbsp;</td>
                    <td width="76%" align="left"><input type="text" name="clientcp" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['clientcp'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="24%" align="right" valign="top">Programme Name :&nbsp;</td>
                    <td width="76%" align="left"><input type="text" name="name" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="255"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr> 
				  
				  <?php echo '
						<script language="JavaScript" id="jscal1x">
						var cal1x = new CalendarPopup("testdiv1");
						</script>
				   '; ?>

                  <tr class="row2">
                        <td align="right" valign="top">Programme Start Date:&nbsp;</td>
                        <td align="left"><input type="text" name="startdate" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['startdate'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" readonly="" id="stamp1">
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
					  <tr class="row2">
						<td align="right" valign="top"> Programme End Date:&nbsp;</td>
						<td align="left"><input type="text" name="enddate" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['enddate'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" readonly="" id="stamp2">
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
				    
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Programme Director :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="programmedirector" class="select_class"  id="programmedirector">
							<?php $_from = $this->_tpl_vars['faculty']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fac']):
?>
								<option value="<?php echo $this->_tpl_vars['fac']['fid']; ?>
"><?php echo $this->_tpl_vars['fac']['name']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select>
						<span class="required">&nbsp;*</span>
                        <script language="javascript" type="text/javascript">
						selectDropdown('programmedirector', '<?php echo $this->_tpl_vars['data']['programmedirector']; ?>
');
						</script>
                      </td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Module Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="modulename" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['modulename'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="150"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				    <tr class="row2">
                    <td width="19%" align="right" valign="top">Module Director :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="moduledirector" class="select_class" >
							<?php $_from = $this->_tpl_vars['faculty']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fac']):
?>
								<?php if ($this->_tpl_vars['fac']['fid'] == $this->_tpl_vars['data']['moduledirector']): ?>
									<option value="<?php echo $this->_tpl_vars['fac']['fid']; ?>
" selected="selected"><?php echo $this->_tpl_vars['fac']['name']; ?>
</option>
								<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['fac']['fid']; ?>
"><?php echo $this->_tpl_vars['fac']['name']; ?>
</option>
								<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
						</select>
						<span class="required">&nbsp;*</span>
                      </td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Number of Participants :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="totalparticipants" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['totalparticipants'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="5"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				 <tr class="row2">
                    <td width="19%" align="right" valign="top">Programme Level:&nbsp;</td>
                    <td width="81%" align="left">
						<select name="programmelevel" id="programmelevel" class="select_class" >
							<option value="Senior Managers">Senior Managers</option>
							<option value="Managers">Managers</option>
							<option value="others">others</option>
						</select>
						<span class="required">&nbsp;</span>
                        <script language="javascript" type="text/javascript">
						selectDropdown('programmelevel', '<?php echo $this->_tpl_vars['data']['programmelevel']; ?>
');
						</script>
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Programme Site :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="programmesite" id="programmesite" class="select_class" >
							<option value="Offsite">Offsite</option>
							<option value="Onsite">Onsite</option>
						</select>
						<span class="required">&nbsp;*</span>
                        <script language="javascript" type="text/javascript">
						selectDropdown('programmesite', '<?php echo $this->_tpl_vars['data']['programmesite']; ?>
');
						</script>
                      </td>
                  </tr> 
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Programme Residence :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="programmeresidence" id="programmeresidence" class="select_class">
							<option value="Residential">Residential</option>
							<option value="Non-Residential">Non-Residential</option>
						</select>
						<span class="required">&nbsp;*</span>
                        <script language="javascript" type="text/javascript">
						selectDropdown('programmeresidence', '<?php echo $this->_tpl_vars['data']['programmeresidence']; ?>
');
						</script>
                      </td>
                  </tr>   
				 <tr class="row2">
                    <td width="19%" align="right" valign="top">Pre-Programme Activity :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='300' name="preprogrammeact" id="preprogrammeact" class="txtArea" onkeyup="return ismaxlength(this)"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['preprogrammeact'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
						<span class="required">&nbsp;</span></td>
                  </tr>		
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Post-Programme Activity :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='300' name="postprogrammeact" id="postprogrammeact" class="txtArea" onkeyup="return ismaxlength(this)"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['postprogrammeact'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
						<span class="required">&nbsp;</span></td>
                  </tr>						
					
					
				  
				  <!-- <tr class="row2">
                    <td width="19%" align="right" valign="top">Programme Fee :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="fee" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['fee'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="6"/><span class="required">&nbsp;*</span>
                     </td>
					 </tr>-->
                   <tr class="row2">
                    <td width="19%" align="right" valign="top">Enabled :&nbsp;</td>
                    <td width="81%" align="left">
							<select name="enabled" id="enabled" class="select_class">
						         <option value="Yes">Yes</option>
								 <option value="No" <?php if ($this->_tpl_vars['data']['enabled'] == 'No'): ?>selected="selected"<?php endif; ?>>No</option>
							</select>
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
                                <li>Fill in the fields and click on Save button</li>
                                <li>To go back to Existing alumni, click Cancel button</li>
                                <li>Fields marked with * are required</li>
								 <li>Click on clender button for choose date.  </li>
								 <li>Click on close for closing  date clender </li>
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
    </table></form>
  
  <!--- content area  --->
  <?php else: ?>
  <form action="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/ofpmanagement.php" method="post">
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
/ofp.gif" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle">OFP Manager </span><span class="pageTitle1">&nbsp;[Existing programmes]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
                      <td class="button" id="toolbar-apply" ><a style="toolbar" href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/ofpmanagement.php?action=add'><img  border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-new.png" /><br/> 
                        Add </a> </td>
						
						
		<?php if ($this->_tpl_vars['status'] != ""): ?>
								<td class="button" id="toolbar-apply" ><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/ofpmanagement.php" style="toolbar">
									<img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-default.png" border="0" title="view open programmes" /><br/> Open Programmes </a> 
								</td>
							<?php else: ?>	
								<td class="button" id="toolbar-apply" ><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/ofpmanagement.php?status=C" style="toolbar">
									<img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-cancel.png" border="0" title="view completed programmes" /><br/> Completed Programmes </a> 								</td>
                    		<?php endif; ?>				
						<td class="button" id="toolbar-apply" ><img  border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-export.png" onclick="javascript:submitExport()" style="cursor:pointer;" /><br/> Export To CSV </a> </td>
						
						
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
                <input type="hidden" name="sortdirection" value="<?php echo $this->_tpl_vars['sortdirection']; ?>
" />
				<input type="hidden" name="status" value="<?php echo $this->_tpl_vars['status']; ?>
" />
			</td>
			</tr>
			<tr>
			<td colspan="5" align="left">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:7px;">
				<tr>
					<td class="th" width="200" style="padding-left:12px; padding-top:5px; padding-right:3px;" align="right">Client Organization Name:</td>
					<td  width="164" style="padding-left:3px; padding-top:5px;"><input type="text" name="search_by_cname" class="input" value="<?php echo $this->_tpl_vars['formvars']['search_by_cname']; ?>
"  maxlength="100"/></td>
					<td>&nbsp;</td>
				</tr>
				<tr>	
				<td class="th" width="200" style="padding-top:5px; padding-left:12px; padding-right:3px;" align="right">Programme Name:</td>
				<td  width="164" style="padding-left:3px; padding-top:5px;"><input type="text" name="search_by_pname" class="input" value="<?php echo $this->_tpl_vars['formvars']['search_by_pname']; ?>
"  maxlength="150"/></td>
				<td width="660" style="padding-left:3px; padding-top:5px;"><input class="grid" type="button" name="Submit" value="Search" onclick="javascript: submitSearch();"  /></td>
				</tr>
				</table>
			</td>
			</tr>
          <tr>
          
          <td width="10" align="center" height="10"></td>
          <td width="806" valign="top" class="boderInner2" >
		  
         <table width="100%" border="0"  class="grid" style="padding-top:7px;">
                      <tr  height="20">
                        <td style="width:20%" align="center" ><a href="javascript:sortRecords('name',true)" class="th" >Programme Name</a></td>
						<td style="width:20%" align="center" ><a href="javascript:sortRecords('clientorgname',true)" class="th" >Client Name</a></td>
                        <td style="width:15%" align="center" ><a href="javascript:sortRecords('startdate',true)"  class="th">Start Date</a></td>
						<td style="width:15%" align="center" ><a href="javascript:sortRecords('enabled',true)"  class="th">Enabled</a></td>
						<td style="width:15%" align="center" ><a href="javascript:void(0)" class="th">Manage Participants</a></td>
						<!--<td style="width:15%" align="center" ><a href="javascript:sortRecords('enabled',true)"  class="th">Enabled</a></td>-->
						<td align="center" class="th">Edit</td>
                        <td align="center" class="th">Delete</td>
						 </tr>
                      <tr class="row1">
                        <td height="5" colspan="7" align="center" class="borderBtmDashed"></td>
                      </tr>
                      <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
                      <tr class="row2"  style="height:25px;" >
                        <td align="center"><?php echo $this->_tpl_vars['entry']['name']; ?>
</td>
						<td align="center"><?php echo $this->_tpl_vars['entry']['clientorgname']; ?>
</td>
                        <td align="center"><?php echo $this->_tpl_vars['entry']['startdate']; ?>
</td>
						<td align="center"><?php echo $this->_tpl_vars['entry']['enabled']; ?>
</td>
						<td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/view_S.png"  onclick="javascript:location.href='javascript:viewParticipant(<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['ofpid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 , \'<?php echo $_GET['status']; ?>
\')'"  class="btnText"  /> </td>
						<!--<td align="center"><a href="javascript:viewParticipant(<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['ofpid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)" style="color:#048DB1;">View</a></td>-->
						<!--<td align="center"><?php echo $this->_tpl_vars['entry']['enabled']; ?>
</td>-->
						<td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/edit_s.png"  onclick="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/ofpmanagement.php?action=edit&id=<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['ofpid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
'"  class="btnText"  /> </td>
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['ofpid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
');"  class="btnText"  /> </td>
                       </tr>
                      <?php endforeach; endif; unset($_from); ?>
					  
					  <?php if ($this->_tpl_vars['countRecords'] > 20): ?>
                      <tr>
                        <td colspan="7" align="center"> <?php echo $this->_tpl_vars['paging']; ?>
 </td>
                      </tr>                      
					  <?php endif; ?>
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
							  <li>To View Participants, click on the 'view' Link against the record</li>
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

</table>
</body>
</html>