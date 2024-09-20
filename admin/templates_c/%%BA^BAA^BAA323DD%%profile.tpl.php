<?php /* Smarty version 2.6.22, created on 2011-04-26 03:37:23
         compiled from profile.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'profile.tpl', 113, false),)), $this); ?>
<?php $this->assign('tpl_path', $this->_tpl_vars['GENERAL']['BASE_DIR_ADMIN_TPL']); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/top_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script language="javascript" src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/jscript/jquery.js'></script>
<script language="javascript" src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/jscript/jscripts.js'></script>

<?php echo '
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
		
		function submitForm()
		{
			document.forms[0].submit();
		}

  </script>
  
'; ?>


</head>
<body>

<table width="991" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
    <td height="15">
	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
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
/profile.php?action=submit&mode=<?php echo $this->_tpl_vars['pageview']; ?>
" method="post" enctype="multipart/form-data">
	<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1">
		  <table width="960" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" colspan="5" align="center"></td>
              </tr>
              <tr>
                <td width="10" height="48" align="center">&nbsp;</td>
                <td width="56" valign="top"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/header/icon-48-article.png" alt="" width="48" height="48" /></td>
                <td width="445"><span class="pageTitle"><span class="tableHeader">Profile</span> Manager </span><span class="pageTitle1">[<?php if ($this->_tpl_vars['pageview'] == 'add'): ?>Add<?php else: ?>Edit<?php endif; ?> Profile]</span></td>
                <td width="439" align="right" valign="top">
				<div class="toolbar" id="toolbar">
                    <table class="toolbar">
                      <tbody>
                        <tr>
                         <td class="button" id="toolbar-apply"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/changepassword.php" class="toolbar"> <img  value="" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-config.png" style="border:0px;"  /> <br />
                              Change Password</a> </td>
						
                         <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                              Save</a> </td>
                          <td class="button" id="toolbar-cancel"><a href="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/welcome.php'" class="toolbar"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />
                            Cancel</a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
				  </td>
                <td width="10" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td height="5" colspan="5" align="center"></td>
              </tr>
            </table>
			</td>
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
            <td width="617" valign="top" class="boderInner2" >
			<table width="100%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                      <tr height="10" >
                        <td align="left" colspan="3" class="tipbox">
						  <input type="hidden" name="id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />				        </td>
                      </tr>
					  <tr><td height="5"></td></tr>
					   <tr>
					     <td width="25%" align="right">Title:&nbsp; </td>
					     <td width="75%" align="left">
						 	<select name="title" id="title" style="width:175px;" class="select_class_large"> 
								<option value="Mr." <?php if ($this->_tpl_vars['data']['title'] == 'Mr.'): ?> selected="selected" <?php endif; ?>>Mr.</option>
								<option value="Ms." <?php if ($this->_tpl_vars['data']['title'] == 'Ms.'): ?>selected="selected"<?php endif; ?>>Ms.</option>
								<option value="Mrs." <?php if ($this->_tpl_vars['data']['title'] == 'Mrs.'): ?> selected="selected"<?php endif; ?>>Mrs.</option>
							</select>
				         <span class="required">*</span></td>
				      </tr>							  
					  <tr><td height="5"></td></tr>
					   <tr>
					     <td width="25%" align="right">First Name:&nbsp; </td>
					     <td width="75%" align="left"><input class="input" name="first_name" type="text" id="first_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['first_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="30" maxlength="30" />
				         <span class="required">*</span></td>
				      </tr>					  
					 			  
					 <tr><td height="5"></td></tr>
					  <tr>
					     <td width="25%" align="right">Last Name:&nbsp; </td>
					     <td width="75%" align="left"><input class="input" name="last_name" type="text" id="last_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['last_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="30" maxlength="30" />
				         <span class="required">*</span></td>
				      </tr>	
					  <tr><td height="5"></td></tr>
					  <tr>
					     <td width="25%" align="right">Email:&nbsp; </td>
					     <td width="75%" align="left"><input class="input" name="email" type="text" id="email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="50" maxlength="50" />
				         </td>
				      </tr>	
					   <tr><td height="5"></td></tr>
					  <tr>
					     <td width="25%" align="right">Username:&nbsp; </td>
					     <td width="75%" align="left"><input class="input" name="username" type="text" id="username" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['username'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="30" maxlength="30" readonly="true" /><span class="required">&nbsp;*</span>
				        </td>
				      </tr>						  
					   <tr><td height="5"></td></tr>
					   					 <tr height="25" >
                        <td align="left" colspan="3" class="tipbox"></td>
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
                                  <li>Fill in the following fields and click on Save button</li>
                                  <li>To go back to home page, click Cancel button</li>
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
      <?php endif; ?>
	</td>
  </tr>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>
</body>
</html>