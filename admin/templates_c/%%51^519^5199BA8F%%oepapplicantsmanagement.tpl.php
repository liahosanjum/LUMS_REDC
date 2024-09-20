<?php /* Smarty version 2.6.22, created on 2011-04-05 00:06:58
         compiled from oepapplicantsmanagement.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'oepapplicantsmanagement.tpl', 298, false),array('modifier', 'date_format', 'oepapplicantsmanagement.tpl', 2044, false),)), $this); ?>
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
		function explode (delimiter, string, limit) {
			var emptyArray = { 0: \'\' };
			
			// third argument is not required
			if ( arguments.length < 2 ||
				typeof arguments[0] == \'undefined\' ||
				typeof arguments[1] == \'undefined\' )
			{
				return null;
			}
		 
			if ( delimiter === \'\' ||
				delimiter === false ||
				delimiter === null )
			{
				return false;
			}
		 
			if ( typeof delimiter == \'function\' ||
				typeof delimiter == \'object\' ||
				typeof string == \'function\' ||
				typeof string == \'object\' )
			{
				return emptyArray;
			}
		 
			if ( delimiter === true ) {
				delimiter = \'1\';
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
	   		if(obj.value != \'\')
			{
				var comboValue;
				var selIndex = obj.selectedIndex;
				comboValue = obj.options[selIndex].text;
				namearray = explode(\'.\' , comboValue);
				document.getElementById(\'firstname\').value = namearray[0];
				document.getElementById(\'lastname\').value = namearray[1];
			}
			else
			{
				document.getElementById(\'firstname\').value = "";
				document.getElementById(\'lastname\').value = "";
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
			window.location.href=\'oepapplicantsmanagement.php?action=del&id=\'+ id+"&iscompleted='; ?>
<?php echo $_GET['iscompleted']; ?>
<?php if ($_GET['start'] > 0): ?>&sc=<?php echo $_GET['sc']; ?>
&sd=<?php echo $_GET['sd']; ?>
&start=<?php echo $_GET['start']; ?>
<?php endif; ?>&status=<?php echo $_GET['status']; ?>
<?php echo '";
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
	
	function viewParticipant(id)
	{
		window.location.href = \'ofpparticipantmanagement.php?ofpid=\'+id;
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
	$(\'.date-pick\').datePicker()
	$(\'#startdate\').bind(
		\'dpClosed\',
		function(e, selectedDates)
		{
			var d = selectedDates[0];
			if (d) {
				d = new Date(d);
				$(\'#enddate\').dpSetStartDate(d.addDays(1).asString());
			}
		}
	);
	$(\'#enddate\').bind(
		\'dpClosed\',
		function(e, selectedDates)
		{
			var d = selectedDates[0];
			if (d) {
				d = new Date(d);
				$(\'#startdate\').dpSetEndDate(d.addDays(-1).asString());
			}
		}
	);
});

*/  

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
<body onload="return setName(document.getElementById(uid));">
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
/oepapplicantsmanagement.php?action=submit&mode=<?php echo $this->_tpl_vars['pageview']; ?>
<?php if ($this->_tpl_vars['pageview'] == 'edit'): ?>&id=<?php echo $_GET['id']; ?>
<?php endif; ?>&iscompleted=<?php echo $_GET['iscompleted']; ?>
<?php if ($_GET['start'] > 0): ?>&sc=<?php echo $_GET['sc']; ?>
&sd=<?php echo $_GET['sd']; ?>
&start=<?php echo $_GET['start']; ?>
<?php endif; ?>&status=<?php echo $_GET['status']; ?>
" method="post"  enctype="multipart/form-data" name="frmadd">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>
" />  
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/application_manager.gif" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle"><span class="tableHeader">OEP Applicants Manager</span></span><span class="pageTitle1">[<?php if ($this->_tpl_vars['pageview'] == 'add'): ?>Add<?php else: ?>Edit<?php endif; ?> applicants]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <?php if ($this->_tpl_vars['programme'] != ''): ?>
						<td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                          Save</a> </td>
						  <?php endif; ?>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
<?php if ($_GET['start'] > 0): ?>&sc=<?php echo $_GET['sc']; ?>
&sd=<?php echo $_GET['sd']; ?>
&start=<?php echo $_GET['start']; ?>
<?php endif; ?>&status=<?php echo $_GET['status']; ?>
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
        <td class="boderInner2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="10" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" align="center">&nbsp;</td>
              <td width="617" valign="top" class="boderInner2">
			  	<?php if ($this->_tpl_vars['programme'] != ''): ?>
					<table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox">
						
					</td>
                  </tr>
                <!--  <tr class="row2">
                    <td width="24%" align="right" valign="top">Email (user name) :&nbsp;</td>
                    <td width="76%" align="left">
					<input type="text" name="username" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['username'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="100"/>
					<input type="hidden" name="uid" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['uid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
					<input type="hidden" name="prevname" value="<?php echo $this->_tpl_vars['oldemail']; ?>
"/>
					<input type="hidden" name="oepaid" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['oepaid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
					<input type="hidden" name="pid" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
					
				      <span class="required">&nbsp;*</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="24%" align="right" valign="top">Password :&nbsp;</td>
                    <td width="76%" align="left"><input type="password" name="password" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['password'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="100"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="24%" align="right" valign="top">Re-type Password :&nbsp;</td>
                    <td width="76%" align="left"><input type="password" name="confpassword" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['confpass'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="100"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr> -->
				<?php if ($this->_tpl_vars['pageview'] == 'add'): ?>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Select User :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="uid" id="uid" class="select_class" onchange="return setName(this);">
							<option value="">--select--</option>
							<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['u']):
?>
								<?php if ($this->_tpl_vars['u']['uid'] == $this->_tpl_vars['data']['uid'] && $this->_tpl_vars['u']['firstname'] != ''): ?>
									<option value="<?php echo $this->_tpl_vars['u']['uid']; ?>
" selected="selected"><?php echo $this->_tpl_vars['u']['firstname']; ?>
.<?php echo $this->_tpl_vars['u']['lastname']; ?>
.[<?php echo $this->_tpl_vars['u']['email']; ?>
]</option>
									<?php elseif ($this->_tpl_vars['u']['firstname'] != ''): ?>
									<option value="<?php echo $this->_tpl_vars['u']['uid']; ?>
"><?php echo $this->_tpl_vars['u']['firstname']; ?>
.<?php echo $this->_tpl_vars['u']['lastname']; ?>
.[<?php echo $this->_tpl_vars['u']['email']; ?>
]</option>
								<?php endif; ?>
								
							<?php endforeach; endif; unset($_from); ?>
						</select>
                      <span class="required">&nbsp;*</span> OR <a href="usermanagement.php">create new user</a></td>
                  </tr>
                  
 				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>
                  <?php else: ?>
                  	<input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['data']['uid']; ?>
" />  
				<?php endif; ?>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Personal Data</span></td>
				</tr>
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">First Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="firstname" id="firstname" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['firstname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30" readonly="true"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr> 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">Middle Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="middlename" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['middlename'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                    </td>
                  </tr> 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">Last Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="lastname" id="lastname" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['lastname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30" readonly="true"/>
                    <span class="required">&nbsp;*</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Prefix :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="prefix" class="select_class">
							<option value="Mr." <?php if ($this->_tpl_vars['data']['prefix'] == 'Mr.'): ?> selected="selected" <?php endif; ?>>Mr.</option>
							<option value="Mrs." <?php if ($this->_tpl_vars['data']['prefix'] == 'Mrs.'): ?> selected="selected" <?php endif; ?>>Mrs.</option>
							<option value="Miss" <?php if ($this->_tpl_vars['data']['prefix'] == 'Miss'): ?> selected="selected" <?php endif; ?>>Miss</option>
							<option value="Ms." <?php if ($this->_tpl_vars['data']['prefix'] == 'Ms.'): ?> selected="selected" <?php endif; ?>>Ms.</option>
							<option value="Dr." <?php if ($this->_tpl_vars['data']['prefix'] == 'Dr.'): ?> selected="selected" <?php endif; ?>>Dr.</option>
						</select>
                      <span class="required">&nbsp;*</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Gender :&nbsp;</td>
                    <td width="81%" align="left">
						Male: <input type="radio" name="gender" value="male" <?php if ($this->_tpl_vars['data']['gender'] == 'male'): ?> checked="checked" <?php endif; ?> /> &nbsp;
						Female: <input type="radio" name="gender" value="female" <?php if ($this->_tpl_vars['data']['gender'] == 'female'): ?> checked="checked" <?php endif; ?> />
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Nationality :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="nationality" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['nationality'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/>
                      <span class="required">&nbsp;</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Business Email :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="busemail" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['busemail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/>
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
                    <td width="74%" align="left"><input type="text" name="emergencyname" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['emergencyname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top">Telephone :&nbsp;</td>
                    <td width="74%" align="left"><input type="text" name="emergencyphone" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['emergencyphone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="15"/>
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
                    <td width="81%" align="left"><input type="text" name="contactdesignation" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['contactdesignation'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Company/Organisation Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="companyname" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['companyname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/><span class="required">&nbsp;*</span>
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Parent Company Name (If different from company name) :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="companyother" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['companyother'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/><span class="required">&nbsp;</span>
                      </td>
                  </tr>
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Organisation Address :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="companyaddress" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['companyaddress'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="150"/><span class="required">&nbsp;*</span>
                     </td>
					</tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">City :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="city" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['city'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/>
                    </td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Country :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="country" class="select_class" >
							<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['con']):
?>
								<?php if ($this->_tpl_vars['con']['country_id'] == $this->_tpl_vars['data']['country']): ?>
									<option value="<?php echo $this->_tpl_vars['con']['country_id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['con']['countryname']; ?>
</option>
									<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['con']['country_id']; ?>
"><?php echo $this->_tpl_vars['con']['countryname']; ?>
</option>
								<?php endif; ?>
								
							<?php endforeach; endif; unset($_from); ?>
						</select>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
  				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Telephone :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="ctelephone" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['ctelephone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="15"/>
                     <span class="required">&nbsp;*</span></td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Cell Number :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="cell" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['cell'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="15"/>
                    </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Fax Number :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="fax" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['fax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="15"/>
                     </td>
                  </tr>   
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Organisational Data</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Your Parent Company/Organisation</span></td>
				</tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Products/Services :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='300' name="parentservices" id="parentservices" class="txtArea" onkeyup="return ismaxlength(this)"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['parentservices'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
                      <span class="required">&nbsp;</span></td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">No. of Employees :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="parentnumemployees" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['parentnumemployees'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="10"/><span class="required">&nbsp;</span>
                      </td>
                  </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Your Company/Division</span></td>
				</tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Products/Services :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='300' name="services" id="services" class="txtArea" onkeyup="return ismaxlength(this)"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['services'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">No. of Employees :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="numemployees" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['numemployees'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="10"/><span class="required">&nbsp;*</span>
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">How many employees are under your direct supervision? :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="numemployeessupervision" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['numemployeessupervision'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="10"/><span class="required">&nbsp;*</span>
                      </td>
                  </tr>
				 
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">What is the title position of the person to whom you report? :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="reportperson" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['reportperson'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/><span class="required">&nbsp;*</span>
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
						selectDropdown('org_industry' , '<?php echo $this->_tpl_vars['data']['industry']; ?>
');
					  </script>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Specify Other :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="industryother" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['industryother'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/><span class="required">&nbsp;</span>
                      </td>
                  </tr>
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">What function best describes your position :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="position" class="select_class">
							<option value="Accounting" <?php if ($this->_tpl_vars['data']['position'] == 'Accounting'): ?> selected="selected" <?php endif; ?>>Accounting</option>
							<option value="Audit/Control" <?php if ($this->_tpl_vars['data']['position'] == 'Audit/Control'): ?> selected="selected" <?php endif; ?>>Audit/Control</option>
							<option value="Administration" <?php if ($this->_tpl_vars['data']['position'] == 'Administration'): ?> selected="selected" <?php endif; ?>>Administration</option>
							<option value="Customer Services" <?php if ($this->_tpl_vars['data']['position'] == 'Customer Services'): ?> selected="selected" <?php endif; ?>>Customer Services</option>
						
						
						
						
						<option value="Engineering" <?php if ($this->_tpl_vars['data']['position'] == 'Engineering'): ?> selected="selected" <?php endif; ?>>Engineering</option>
						<option value="Finance" <?php if ($this->_tpl_vars['data']['position'] == 'Finance'): ?> selected="selected" <?php endif; ?>>Finance</option>
						<option value="Fund Raising" <?php if ($this->_tpl_vars['data']['position'] == 'Fund Raising'): ?> selected="selected" <?php endif; ?>>Fund Raising</option>
						<option value="General Management" <?php if ($this->_tpl_vars['data']['position'] == 'General Management'): ?> selected="selected" <?php endif; ?>>General Management</option>
						<option value="Legal" <?php if ($this->_tpl_vars['data']['position'] == 'Legal'): ?> selected="selected" <?php endif; ?>>Legal</option>
						<option value="Human Resource/Personnel" <?php if ($this->_tpl_vars['data']['position'] == 'Human Resource/Personnel'): ?> selected="selected" <?php endif; ?>>Human Resource/Personnel</option>
						<option value="Logistics" <?php if ($this->_tpl_vars['data']['position'] == 'Logistics'): ?> selected="selected" <?php endif; ?>>Logistics</option>
						<option value="Manufacturing/Operations" <?php if ($this->_tpl_vars['data']['position'] == 'Manufacturing/Operations'): ?> selected="selected" <?php endif; ?>>Manufacturing/Operations</option>
						<option value="MIS/IT" <?php if ($this->_tpl_vars['data']['position'] == 'MIS/IT'): ?> selected="selected" <?php endif; ?>>MIS/IT</option>
						<option value="Marketing" <?php if ($this->_tpl_vars['data']['position'] == 'Marketing'): ?> selected="selected" <?php endif; ?>>Marketing</option>
						<option value="Planning" <?php if ($this->_tpl_vars['data']['position'] == 'Planning'): ?> selected="selected" <?php endif; ?>>Planning</option>
						<option value="Product Development" <?php if ($this->_tpl_vars['data']['position'] == 'Product Development'): ?> selected="selected" <?php endif; ?>>Product Development</option>
						<option value="Project Management" <?php if ($this->_tpl_vars['data']['position'] == 'Project Management'): ?> selected="selected" <?php endif; ?>>Project Management</option>
						<option value="Public Relations" <?php if ($this->_tpl_vars['data']['position'] == 'Public Relations'): ?> selected="selected" <?php endif; ?>>Public Relations</option>
						<option value="Procurement" <?php if ($this->_tpl_vars['data']['position'] == 'Procurement'): ?> selected="selected" <?php endif; ?>>Procurement</option>
						<option value="Research & Development" <?php if ($this->_tpl_vars['data']['position'] == 'Research & Development'): ?> selected="selected" <?php endif; ?>>Research & Development</option>
						<option value="Sales" <?php if ($this->_tpl_vars['data']['position'] == 'Sales'): ?> selected="selected" <?php endif; ?>>Sales</option>
						<option value="Teaching/Training" <?php if ($this->_tpl_vars['data']['position'] == 'Teaching/Training'): ?> selected="selected" <?php endif; ?>>Teaching/Training</option>
							<option value="other" <?php if ($this->_tpl_vars['data']['position'] == 'other'): ?> selected="selected" <?php endif; ?>>other</option>
						</select>
                   <span class="required">&nbsp;*</span> </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">Specify Other :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="positionother" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['positionother'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/><span class="required">&nbsp;</span>
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
						<input type="text" name="company1" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['company1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="position1" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['position1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				 <!-- <?php echo '
						<script language="JavaScript" id="jscal1x">
						var cal1x = new CalendarPopup("testdiv1");
						</script>
				   '; ?>
-->
				    	
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">From (MM/YYYY):&nbsp;</td>
                    <td width="81%" align="left">
						<!--<div style="float:left;"><input name="from1" id="from1" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['from1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="25" type="text" onfocus="cal1x.select(document.frmadd.from1,'from1','dd-MM-yyyy'); return false;" onclick="cal1x.select(document.frmadd.from1,'from1','dd-MM-yyyy'); return false;" class="input" readonly="" />
                      <span class="required">&nbsp;* </span></div><div style="float:left;"><a href="javascript:void(0)" class="dp-choose-date" onclick="cal1x.select(document.frmadd.from1,'from1','dd-MM-yyyy'); return false;">choose date</a></div>-->
					  <input type="text" name="from1" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['from1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  id="stamp1"> <span class="required">&nbsp;*</span>
                      <!--<input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp1);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
					   <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                        <tr>
                          <td id="ds_calclass"></td>
                        </tr>
                      </table>-->
					  </td>
                  </tr>
				  <!--<?php echo '
                      <script src="scripts/black-calender.js" language="javascript"></script>
                  '; ?>
-->
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">To (MM/YYYY):&nbsp;</td>
                    <td width="81%" align="left">
						<!--<div style="float:left;"><input name="to1" id="to1" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['to1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="25" type="text" onfocus="cal1x.select(document.frmadd.to1,'to1','dd-MM-yyyy'); return false;" onclick="cal1x.select(document.frmadd.to1,'to1','dd-MM-yyyy'); return false;" class="input" readonly="" />
                      <span class="required">&nbsp;*</span></div><div style="float:left;"> <a href="javascript:void(0)" class="dp-choose-date" onclick="cal1x.select(document.frmadd.to1,'to1','dd-MM-yyyy'); return false;">choose date</a></div>-->
					 <input type="text" name="to1" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['to1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" id="stamp2"> <span class="required">&nbsp;*</span>
                    <!--  <input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp2);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
                     
                      <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                        <tr>
                          <td id="ds_calclass"></td>
                        </tr>
                      </table>-->
                     <!-- <?php echo '
                      <script src="scripts/black-calender.js" language="javascript"></script>
                      '; ?>
-->
					
					</td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="company2" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['company2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="position2" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['position2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">From (MM/YYYY):&nbsp;</td>
                    <td width="81%" align="left">
					
					  <input type="text" name="from2" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['from2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" id="stamp3">
                     <!-- <input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp3);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
					   <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                        <tr>
                          <td id="ds_calclass"></td>
                        </tr>
                      </table>-->
					  </td>
                  </tr>
				<!--  <?php echo '
                      <script src="scripts/black-calender.js" language="javascript"></script>
                  '; ?>
-->
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">To (MM/YYYY):&nbsp;</td>
                    <td width="81%" align="left">
						
					 <input type="text" name="to2" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['to2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" id="stamp4"> 
                     <!-- <input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp4);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
                   
                      <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                        <tr>
                          <td id="ds_calclass"></td>
                        </tr>
                      </table>-->
                     <!-- <?php echo '
                      <script src="scripts/black-calender.js" language="javascript"></script>
                      '; ?>
-->
					
					</td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="company3" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['company3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="position3" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['position3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">From (MM/YYYY):&nbsp;</td>
                    <td width="81%" align="left">
					
					  <input type="text" name="from3" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['from3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" id="stamp5">
                      <!--<input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp5);return false;" align="middle" value="Calender" style="cursor:pointer" border="0" >
					   <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                        <tr>
                          <td id="ds_calclass"></td>
                        </tr>
                      </table>-->
					  </td>
                  </tr>
				  <!--<?php echo '
                      <script src="scripts/black-calender.js" language="javascript"></script>
                  '; ?>
-->
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">To (MM/YYYY):&nbsp;</td>
                    <td width="81%" align="left">
						
					 <input type="text" name="to3" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['to3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" id="stamp6"> 
                      <!--<input type="image"  src="images/calender.gif"  onClick="ds_sh(stamp6);return false;" align="middle" value="Calender" style="cursor:pointer" border="0">
                   
                      <table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
                        <tr>
                          <td id="ds_calclass"></td>
                        </tr>
                      </table>-->
                     <!-- <?php echo '
                      <script src="scripts/black-calender.js" language="javascript"></script>
                      '; ?>
-->
					
					</td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Please estimate total number of years of professional experience :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="numyearsexp" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['numyearsexp'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="5"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Please describe your current responsibilities in the organization :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='300' name="responsibility" id="responsibility" class="txtArea" onkeyup="return ismaxlength(this)"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['responsibility'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
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
									selectDropdown('pro_mgtlevel' , '<?php echo $this->_tpl_vars['data']['mgtlevel']; ?>
');
								</script>
                  </tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Other(Please Specify) :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="mgtlevel_other" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['mgtlevel_other'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="250"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Education</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">University :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="university" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['university'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Year :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="year" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['year'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="5"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Degree (Highest level attended) :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="degree" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['degree'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td colspan="2" style="padding-left:5px;">If you have attended other REDC programmes, please list them below.</td>
				</tr>				

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Programme :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="atndotherredcprog1" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['atndotherredcprog1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="250"/>
                      <span class="required">&nbsp;</span></td>
                </tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Date(MM/YYYY) :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="atndotherredcprogdate1" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['atndotherredcprogdate1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="250"/>
                      <span class="required">&nbsp;</span></td>
                </tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Programme :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="atndotherredcprog2" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['atndotherredcprog2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="250"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Date(MM/YYYY) :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="atndotherredcprogdate2" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['atndotherredcprogdate2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="250"/>
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
						<textarea maxlength='300' name="objectives" id="objectives" class="txtArea" onkeyup="return ismaxlength(this)"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['objectives'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
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
						<input type="text" name="name" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="designation" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['designation'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Address :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='150' name="address" id="address" class="txtArea" onkeyup="return ismaxlength(this)"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['address'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="telephone" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['telephone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="20"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="sponsorfax" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['sponsorfax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="20"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Email :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="email" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/>
                      <span class="required">&nbsp;*</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Website :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="website" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Name and address to which invoice should be sent (if different from above)</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Name :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="invoicename" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicename'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <!--<span class="required">&nbsp;*</span>--></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="invoicedesignation" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicedesignation'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <!--<span class="required">&nbsp;*</span>--></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Address :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='150' name="invoiceaddress" id="invoiceaddress" class="txtArea" onkeyup="return ismaxlength(this)"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoiceaddress'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
                      <!--<span class="required">&nbsp;*</span>--></td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="invoicetelephone" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicetelephone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="20"/>
                      <!--<span class="required">&nbsp;*</span>--></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="invoicefax" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicefax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="20"/>
                     <!-- <span class="required">&nbsp;</span>--></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Email :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="invoiceemail" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoiceemail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/>
                      <!--<span class="required">&nbsp;*</span>--></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Website :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="invoicewebsite" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicewebsite'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/>
                     <!-- <span class="required">&nbsp;</span>--></td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Executive Development (Person in charge of management development in your company)</span></td>
				</tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Name :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="executivename" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivename'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="executivedesignation" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivedesignation'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="30"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Address :&nbsp;</td>
                    <td width="81%" align="left">
						<textarea maxlength='150' name="executiveaddress" id="executiveaddress" class="txtArea" onkeyup="return ismaxlength(this)"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executiveaddress'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
                      <span class="required">&nbsp;</span></td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="executivetelephone" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivetelephone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="20"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="executivefax" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivefax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="20"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Email :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="executiveemail" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executiveemail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top">Website :&nbsp;</td>
                    <td width="81%" align="left">
						<input type="text" name="executivewebsite" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivewebsite'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="50"/>
                      <span class="required">&nbsp;</span></td>
                </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Do you wish to be informed about our programmes via email on regular basis? :&nbsp;</td>
                    <td width="81%" align="left">
						Yes: <input type="radio" name="informemail" value="Yes" <?php if ($this->_tpl_vars['data']['informemail'] == 'Yes'): ?> checked="checked" <?php endif; ?> /> &nbsp;
						No: <input type="radio" name="informemail" value="No"  <?php if ($this->_tpl_vars['data']['informemail'] == 'No'): ?> checked="checked" <?php endif; ?>  />
                      <span class="required">&nbsp;</span></td>
                  </tr>

				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Do you wish to avail residence at REC-LUMS during the programme? :&nbsp;</td>
                    <td width="81%" align="left">
						Yes: <input type="radio" name="availresidence" value="Yes" <?php if ($this->_tpl_vars['data']['availresidence'] == 'Yes'): ?> checked="checked" <?php endif; ?> /> &nbsp;
						No: <input type="radio" name="availresidence" value="No"  <?php if ($this->_tpl_vars['data']['availresidence'] == 'No'): ?> checked="checked" <?php endif; ?>  />
                      <span class="required">&nbsp;</span></td>
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
							<option value="" <?php if ($this->_tpl_vars['data']['learnabout'] == ''): ?> selected="selected" <?php endif; ?>>--select--</option>
							<option value="Website" <?php if ($this->_tpl_vars['data']['learnabout'] == 'Website'): ?> selected="selected" <?php endif; ?>>Website</option>
							<option value="Executive Alumni" <?php if ($this->_tpl_vars['data']['learnabout'] == 'Executive Alumni'): ?> selected="selected" <?php endif; ?>>Executive Alumni</option>
							<option value="Brochure" <?php if ($this->_tpl_vars['data']['learnabout'] == 'Brochure'): ?> selected="selected" <?php endif; ?>>Brochure</option>
							<option value="Referred by HR department" <?php if ($this->_tpl_vars['data']['learnabout'] == 'Referred by HR department'): ?> selected="selected" <?php endif; ?>>Referred by HR department</option>
						
						<option value="Press Advertisement" <?php if ($this->_tpl_vars['data']['learnabout'] == 'Press Advertisement'): ?> selected="selected" <?php endif; ?>>Press Advertisement</option>
                        <option value="Web Advertisement" <?php if ($this->_tpl_vars['data']['learnabout'] == 'Web Advertisement'): ?> selected="selected" <?php endif; ?>>Web Advertisement</option>
						<option value="other" <?php if ($this->_tpl_vars['data']['learnabout'] == 'other'): ?> selected="selected" <?php endif; ?>>Other</option>
						</select>
                   <span class="required">&nbsp;*</span> </td>
                  </tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top">Other (Please Specify) :&nbsp;</td>
                    <td width="81%" align="left">
						<input class="input" type="text" name="learnabout_other" id="info_learnabout_other" value="<?php echo $this->_tpl_vars['data']['learnabout_other']; ?>
" maxlength="250" tabindex="" />
                      <span class="required">&nbsp;</span></td>
                </tr>
				<tr>
					<td colspan="2" height="10">&nbsp;</td>
				</tr>		
                <?php if ($this->_tpl_vars['pageview'] == 'add'): ?>
                  <?php if ($this->_tpl_vars['pid'] == 0): ?>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top">OEP Programmes :&nbsp;</td>
                    <td width="81%" align="left">
						<select name="oepprogrammes" class="select_class" >
							<?php $_from = $this->_tpl_vars['programme']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prog']):
?>
								<?php if ($this->_tpl_vars['prog']['oepid'] == $this->_tpl_vars['data']['oepid']): ?>
									<option value="<?php echo $this->_tpl_vars['prog']['oepid']; ?>
" selected="selected"><?php echo $this->_tpl_vars['prog']['name']; ?>
</option>
									<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['prog']['oepid']; ?>
"><?php echo $this->_tpl_vars['prog']['name']; ?>
</option>
								<?php endif; ?>
								
							<?php endforeach; endif; unset($_from); ?>
						</select>
						<span class="required">&nbsp;*</span>
                      </td>
                  </tr>
				  <?php else: ?>
				  	<input type="hidden" name="oepprogrammes" value="<?php echo $this->_tpl_vars['pid']; ?>
" />
				  <?php endif; ?>
				<tr>
					<td colspan="2" height="10">&nbsp;</td>
				</tr>		
                <?php else: ?>
                	<input type="hidden" name="oepprogrammes" value="<?php echo $this->_tpl_vars['data']['oepid']; ?>
" />
					<input type="hidden" name="status" value="<?php echo $this->_tpl_vars['data']['applicationstatus']; ?>
" />
                <?php endif; ?>			  
				              
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
				<?php else: ?>
				
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
				<?php endif; ?>
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
  <?php if ($this->_tpl_vars['pageview'] == 'detail'): ?>
 	
	 <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/application_manager.gif" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle"><span class="tableHeader">OEP Applicants Manager</span></span><span class="pageTitle1">[<?php if ($this->_tpl_vars['pageview'] == 'detail'): ?>View<?php endif; ?> applicant]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                      	<td class="button" id="toolbar-cancel"><a target="_blank" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicant.php?oepaid=<?php echo $this->_tpl_vars['data']['oepaid']; ?>
" class="toolbar"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/Print-icon.png" border="0" alt=""  /> <br />Print Application</a></td>
                        <?php if ($this->_tpl_vars['data']['applicationstatus'] == ''): ?>
						<td class="button" id="toolbar-apply"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?status=A&oepaid=<?php echo $this->_tpl_vars['data']['oepaid']; ?>
&action=submit&mode=change&pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
" class="toolbar"> <img  value="Add" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-apply.png" style="border:0px;"  /> <br />
                          Approve Application</a> </td>
						 <td class="button" id="toolbar-apply"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?status=R&oepaid=<?php echo $this->_tpl_vars['data']['oepaid']; ?>
&action=submit&mode=change&pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
" class="toolbar"> <img  value="Add" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-cancel.png" style="border:0px;"  /> <br />
                          Reject Application</a> </td> 
						  <?php endif; ?>
						 
                         <?php if ($this->_tpl_vars['data']['applicationstatus'] != ''): ?>
                         	<td class="button" id="toolbar-apply"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?status=&oepaid=<?php echo $this->_tpl_vars['data']['oepaid']; ?>
&action=submit&mode=change&pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
" class="toolbar"> <img  value="Add" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-default.png" style="border:0px;"  /> <br />
                          Renew Application</a> </td> 
                         <?php endif; ?>
                         
                         <!-- <?php if ($this->_tpl_vars['data']['applicationstatus'] == 'R'): ?>
						  <td class="button" id="toolbar-apply"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?status=A&oepaid=<?php echo $this->_tpl_vars['data']['oepaid']; ?>
&action=submit&mode=change" class="toolbar"> <img  value="Add" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-apply.png" style="border:0px;"  /> <br />
                          Approve Application</a> </td>
						  <?php endif; ?>
						  <?php if ($this->_tpl_vars['data']['applicationstatus'] == 'A'): ?>
						  <td class="button" id="toolbar-apply"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?status=R&oepaid=<?php echo $this->_tpl_vars['data']['oepaid']; ?>
&action=submit&mode=change" class="toolbar"> <img  value="Add" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-cancel.png" style="border:0px;"  /> <br />
                          Reject Application</a> </td> 
						  <?php endif; ?>-->
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?status=<?php echo $this->_tpl_vars['data']['applicationstatus']; ?>
&pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
<?php if ($_GET['start'] > 0): ?>&sc=<?php echo $_GET['sc']; ?>
&sd=<?php echo $_GET['sd']; ?>
&start=<?php echo $_GET['start']; ?>
<?php endif; ?>'" class="toolbar"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/restore_f2.png" border="0" alt="" /> <br />Back</a></td>
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
                    <td align="left" colspan="2" class="tipbox">
						
					</td>
                  </tr>
                
				  <tr class="row2">
                    <td width="24%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="76%" align="left">
					<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['firstname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['lastname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

					<!--<input type="hidden" name="uid" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['uid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
					<input type="hidden" name="prevname" value="<?php echo $this->_tpl_vars['oldemail']; ?>
"/>
					<input type="hidden" name="oepaid" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['oepaid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>-->
					
				      <span class="required">&nbsp;</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="24%" align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td width="76%" align="left">
					<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['busemail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

					<!--<input type="hidden" name="uid" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['uid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
					<input type="hidden" name="prevname" value="<?php echo $this->_tpl_vars['oldemail']; ?>
"/>
					<input type="hidden" name="oepaid" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['oepaid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>-->
					
				      <span class="required">&nbsp;</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="24%" align="right" valign="top" class="fieldtitle">Previously Attended Programmes :&nbsp;</td>
                    <td width="76%" align="left">
                    <?php $_from = $this->_tpl_vars['programmes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['programme']):
?>
					<?php echo $this->_tpl_vars['programme']['name']; ?>
<br />
                    <?php endforeach; endif; unset($_from); ?>
					</td>
                  </tr> 
				  
				 <!-- <tr class="row2">
                    <td width="24%" align="right" valign="top" class="fieldtitle">Password :&nbsp;</td>
                    <td width="76%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['password'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

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
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['firstname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      <span class="required">&nbsp;</span></td>
                  </tr> 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Middle Name :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['middlename'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr> 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Last Name :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['lastname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Prefix :&nbsp;</td>
                    <td width="81%" align="left">
							<?php echo $this->_tpl_vars['data']['prefix']; ?>

					</td>
                  </tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Gender :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo $this->_tpl_vars['data']['gender']; ?>

					</td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Natoinality :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['nationality'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Business Email :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['busemail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

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
                    <td width="74%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['emergencyname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      <span class="required">&nbsp;</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="74%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['emergencyphone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

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
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['contactdesignation'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Company/Organisation Name :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['companyname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Parent Company Name (If different from company name) :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['companyother'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      </td>
                  </tr>
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Organisation Address :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['companyaddress'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
					</tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">City :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['city'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Country :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['countryname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
  				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['ctelephone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Cell Number :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['cell'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Fax Number :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['fax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
                  </tr>   
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Organisational Data</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Your Parent Company/Organisation</span></td>
				</tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Products/Services :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['parentservices'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">No. of Employees :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['parentnumemployees'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      </td>
                  </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Your Company/Division</span></td>
				</tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Products/Services :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['services'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">No. of Employees :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['numemployees'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">How many employees are under your supervision? :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['numemployeessupervision'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      </td>
                  </tr>
				 
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">What is the title position of the person to whom you report? :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['reportperson'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
					</tr> 
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Please select your current industry :&nbsp;</td>
                    <td width="81%" align="left">
				
							<?php echo $this->_tpl_vars['data']['industry']; ?>
 
						
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Specify Other :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['industryother'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      </td>
                  </tr>
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">What function best describes your position :&nbsp;</td>
                    <td width="81%" align="left">
					
						<?php echo $this->_tpl_vars['data']['position']; ?>

				</td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Specify Other :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['positionother'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

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
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['company1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      </td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['position1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      </td>
                </tr>
				
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">From :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['from1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</div></td>
                  </tr>
				 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">To :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['to1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</div></td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['company2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['position2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">From :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['from2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</div></td>
                  </tr>
				  
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">To :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['to2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</div></td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['company3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['position3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">From :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['from3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</div></td>
                  </tr>
				 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">To :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['to3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</div></td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Please estimate total number of years of professional experience :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['numyearsexp'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Please describe your current responsibilities including your level in the organisation :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['responsibility'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Management Level :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['mgtlevel'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      </td>
                  </tr>				  
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Specify Other :&nbsp;</td>
                    <td width="81%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['mgtlevel_other'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      </td>
                  </tr>		
				  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Education</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">University :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['university'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Year :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['year'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Degree (Highest level attended) :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['degree'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="100%" colspan="2" align="left" valign="top" class="fieldtitle">If you have attended other REDC programmes, please list them below.&nbsp;</td>
                </tr>
				
				
				
				
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Programme :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['atndotherredcprog1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Date(MM/YYYY) :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['atndotherredcprogdate1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Programme :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['atndotherredcprog2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Date(MM/YYYY) :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['atndotherredcprogdate2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
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
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['objectives'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
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
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['designation'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['address'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['telephone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['sponsorfax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Website :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Name and address to which invoice should be sent (if different from above)</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicename'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicedesignation'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoiceaddress'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicetelephone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicefax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoiceemail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Website :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicewebsite'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Executive Development (Person in charge of management development in your company)</span></td>
				</tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivename'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivedesignation'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executiveaddress'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivetelephone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivefax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executiveemail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Website :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivewebsite'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Do you wish to be informed about our programmes via email on regular basis? :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo $this->_tpl_vars['data']['informemail']; ?>

						</td>
                  </tr>
				  
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Do you wish to avail residence at REC-LUMS during the programme? :&nbsp;</td>
                    <td width="81%" align="left">
						<?php echo $this->_tpl_vars['data']['availresidence']; ?>

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
					<?php echo $this->_tpl_vars['data']['learnabout']; ?>

						</td>
                  </tr>	
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Other :&nbsp;</td>
                    <td width="81%" align="left">
					<?php echo $this->_tpl_vars['data']['learnabout_other']; ?>

						</td>
                  </tr>		
				  
				  			<!--   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">OEP Programmes :&nbsp;</td>
                    <td width="81%" align="left">
						
							<?php $_from = $this->_tpl_vars['programme']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prog']):
?>
								<?php if ($this->_tpl_vars['prog']['oepid'] == $this->_tpl_vars['data']['oepid']): ?>
									<?php echo $this->_tpl_vars['prog']['name']; ?>

								<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
					  </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Application Status :&nbsp;</td>
                    <td width="81%" align="left">
					
							<?php if ($this->_tpl_vars['data']['applicationstatus'] == ''): ?>  <?php endif; ?>
							<?php if ($this->_tpl_vars['data']['applicationstatus'] == 'A'): ?>Approve <?php endif; ?>
							<?php if ($this->_tpl_vars['data']['applicationstatus'] == 'R'): ?>Reject <?php endif; ?>
					
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
                                
								<?php if ($this->_tpl_vars['data']['applicationstatus'] != 'A' && $this->_tpl_vars['data']['applicationstatus'] != 'R'): ?>
									<li>To Approve application, click the 'Approve Application' button</li>
									<li>To Reject application, click the 'Reject Application' button</li>
								
                                <?php endif; ?>
								<li>To print application, click 'Print Application' button</li>
								<?php if ($this->_tpl_vars['data']['applicationstatus'] == 'R'): ?>
								<li>To Renew application, click the 'Renew Application' button</li>
								<?php endif; ?>
								<li>To go back to Existing applicants, click 'Back' button</li>
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
	
  <?php else: ?>
  <form action="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?iscompleted=<?php echo $_GET['iscompleted']; ?>
&status=<?php echo $this->_tpl_vars['status']; ?>
" method="post">
    <input type="hidden" name="pid" value="<?php echo $this->_tpl_vars['pid']; ?>
" />
	<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/application_manager.gif" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle">OEP Applicants Manager </span><span class="pageTitle1">[<?php if ($_GET['status'] == 'A'): ?>Approved<?php elseif ($_GET['status'] == 'R'): ?>Rejected<?php else: ?>New<?php endif; ?> applicants]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
				      <?php if ($_GET['iscompleted'] != 'Y'): ?>
					  <td class="button" id="toolbar-apply" ><a style="toolbar" href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?action=add&pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
'><img  border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-new.png" /><br/>
                        Add </a> </td>
						<?php endif; ?>
						
		<?php if ($this->_tpl_vars['status'] != 'A' && $this->_tpl_vars['status'] != 'R'): ?>
								<td class="button" id="toolbar-apply" ><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?status=A&pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
" style="toolbar">
									<img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-apply.png" border="0" title="view approved applicants" /><br/> Approved Applicants </a> 
								</td>
								
								<td class="button" id="toolbar-apply" ><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?status=R&pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
" style="toolbar">
									<img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-cancel.png" border="0" title="view rejected applicants" /><br/> Rejected Applicants </a> 								</td>
                    		<td class="button" id="toolbar-apply" ><img  border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-export.png" onclick="javascript:submitExport()" style="cursor:pointer;" /><br/> Export To CSV </a> </td>
							<?php else: ?>
								
								<?php if ($this->_tpl_vars['status'] == 'A'): ?>
							
								<td class="button" id="toolbar-apply" ><a href="javascript:submitFormAlumni()" style="toolbar">
									<img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-adduser.png" border="0" title="add to alumni" /><br/> Add to Alumni </a> 
								</td>
								<td class="button" id="toolbar-apply" ><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
" style="toolbar">
									<img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-default.png" border="0" title="view new applicants" /><br/> New Applicants </a> 
								</td>
								
								<td class="button" id="toolbar-apply" ><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?status=R&pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
" style="toolbar">
									<img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-cancel.png" border="0" title="view rejected applicants" /><br/> Rejected Applicants </a> 
									</td>
																			
							
							<?php else: ?>
							
								<td class="button" id="toolbar-apply" ><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
" style="toolbar">
									<img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-default.png" border="0" title="view new applicants" /><br/> New Applicants </a> 
								</td>
								
								<td class="button" id="toolbar-apply" ><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?status=A&pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
" style="toolbar">
									<img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-apply.png" border="0" title="view approved applicants" /><br/> Approved Applicants </a> 	
							</td>
							
							<?php endif; ?>
							<?php endif; ?>				
							<?php if ($this->_tpl_vars['pid'] > 0): ?>
						<td class="button" id="toolbar-apply" ><a style="toolbar" href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oep_programme.php?iscompleted=<?php echo $_GET['iscompleted']; ?>
'><img  border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/restore_f2.png" /><br/> 
                        Back </a> </td>					
						<?php endif; ?>
						
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
									<input type="hidden" name="action" id="action" value="" />
							</td>
			</tr>
			<tr>
			<td colspan="5" align="left">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:7px;">
			<?php if ($this->_tpl_vars['pid'] == 0): ?>
				<tr>	
				<td class="th" width="138" style="padding-top:5px; padding-left:12px; padding-right:3px;" align="right">Programme Name:</td>
				<td  width="164" style="padding-left:3px; padding-top:5px;"><input type="text" name="search_by_pname" class="input" value="<?php echo $this->_tpl_vars['formvars']['search_by_pname']; ?>
"  maxlength="150"/></td>
				<td>&nbsp;</td>
				</tr>
			<?php endif; ?>
				<tr>
					<td class="th" width="138" style="padding-left:12px; padding-top:5px; padding-right:3px;" align="right">Applicant First Name:</td>
					<td  width="164" style="padding-left:3px; padding-top:5px;"><input type="text" name="search_by_uname" class="input" value="<?php echo $this->_tpl_vars['formvars']['search_by_uname']; ?>
"  maxlength="100"/></td>
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
						<td style="width:25%" align="center" ><a href="javascript:sortRecords('oepaid',true)"  class="th">Applied Date</a></td>
						<?php if ($this->_tpl_vars['status'] == 'A' && $this->_tpl_vars['data'] != ''): ?>
						<td style="width:15%" align="center" class="th">Programme Completed</td>
						<?php endif; ?>
						<!--<td style="width:15%" align="center" ><a href="javascript:sortRecords('enabled',true)"  class="th">Enabled</a></td>-->
						<td align="center" class="th">View</td>
                        <td align="center" class="th">Edit</td>
                        <td align="center" class="th">Delete</td>
						 </tr>
                      <tr class="row1">
                        <?php if ($this->_tpl_vars['status'] == 'A'): ?>
							<td height="5" colspan="7" align="center" class="borderBtmDashed"></td>
						<?php else: ?>
							<td height="5" colspan="6" align="center" class="borderBtmDashed"></td>
						<?php endif; ?>
                      </tr>
					  
                      <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
                      <tr class="row2"  style="height:25px;" >
                        <td align="center"><?php echo $this->_tpl_vars['entry']['firstname']; ?>
&nbsp;<?php echo $this->_tpl_vars['entry']['lastname']; ?>
</td>
                        <td align="center"><?php echo $this->_tpl_vars['entry']['name']; ?>
</td>
						<td align="center"><?php echo $this->_tpl_vars['entry']['registrationdate']; ?>
</td>
                        <?php if ($this->_tpl_vars['status'] == 'A'): ?>
						<?php if ($this->_tpl_vars['entry']['enddate'] < ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d"))): ?>
							<td align="center"><input type="checkbox" name="addtoalumni[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['oepaid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td>
						<?php elseif ($this->_tpl_vars['entry']['enddate'] > ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d"))): ?>	
							<td align="center" width="82px">&nbsp;</td>	
                        <?php else: ?>
                         <td align="center" width="82px">&nbsp;</td>	
						<?php endif; ?>
						<?php endif; ?>
						<!--<td align="center"><?php echo $this->_tpl_vars['entry']['enabled']; ?>
</td>-->
						<td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/view_S.png"  onclick="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?action=detail&id=<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['oepaid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
<?php if ($_GET['start'] > 0): ?>&sc=<?php echo $_GET['sc']; ?>
&sd=<?php echo $_GET['sd']; ?>
&start=<?php echo $_GET['start']; ?>
<?php endif; ?>&status=<?php echo $_GET['status']; ?>
'"  class="btnText"  /> </td>
                        
                        <td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/edit_s.png"  onclick="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php?action=edit&id=<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['oepaid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&pid=<?php echo $this->_tpl_vars['pid']; ?>
&iscompleted=<?php echo $_GET['iscompleted']; ?>
<?php if ($_GET['start'] > 0): ?>&sc=<?php echo $_GET['sc']; ?>
&sd=<?php echo $_GET['sd']; ?>
&start=<?php echo $_GET['start']; ?>
<?php endif; ?>&status=<?php echo $_GET['status']; ?>
'"  class="btnText"  /> </td>
                        
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['oepaid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&pid=<?php echo $this->_tpl_vars['pid']; ?>
');"  class="btnText"  /> </td>
                       </tr>
                      <?php endforeach; endif; unset($_from); ?>
                     
					<?php if ($this->_tpl_vars['countRecords'] > 20): ?>
					  <tr>
                        <td colspan="6" align="center"> <?php echo $this->_tpl_vars['paging']; ?>
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
							  
							  <?php if ($this->_tpl_vars['status'] == 'A'): ?>
							  	<li>To Add a record to alumni, check the checkbox against the record and click the 'Add to Alumni' button</li>
							  	<li>To View new applicants, click the 'New Applicants' button</li>
							  	<li>To View rejected applicants, click the 'Rejected Applicants' button</li>
							  <?php elseif ($this->_tpl_vars['status'] == 'R'): ?>
							  	<li>To View new applicants, click the 'New Applicants' button</li>
							  	<li>To View approved applicants, click the 'Approved Applicants' button</li>
							  <?php else: ?>
							  	<li>To View approved applicants, click the 'Approved Applicants' button</li>
							  	<li>To View rejected applicants, click the 'Rejected Applicants' button</li>
							  <?php endif; ?>
                              <!--<li>To Edit a record, click on the 'Edit' button against the record</li>-->
							  <li>To View a record, click on the 'View' button against the record</li>
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
   <DIV ID="testdiv4" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv5" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv6" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>


</table>
</body>
</html>