<?php /* Smarty version 2.6.22, created on 2011-04-05 00:06:18
         compiled from /home/netrasof/public_html/clients/lums_redc/admin/templates/index.tpl */ ?>
<?php $this->assign('tpl_path', $this->_tpl_vars['GENERAL']['BASE_DIR_ADMIN_TPL']); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/top_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script>
function FocusControl()
{
	document.frm_admin_login.username.focus();
}
</script>
'; ?>

</head>
<body bgcolor="#ffffff" onLoad="javascript:FocusControl()">
<table width="991" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="991" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="14"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/log_top_1.jpg" alt="" width="14" height="45" /></td>
        <td width="963" class="siteName">REDC</td>
        <td width="14"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/log_top_3.jpg" alt="" width="14" height="45" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="colourBar"></td>
  </tr>
  <tr>
    <td height="15" class="boder"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" width="1" height="1" /></td>
  </tr>
  <tr>
    <td class="boder"><table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner"><table width="960" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="372" valign="top" class="key">
			  <table width="372" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="85">&nbsp;</td>
                <td height="95" colspan="2" class="adminLogin">Administration Login</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="27">&nbsp;</td>
                <td width="260">
			      <table width="100%" border="0" cellspacing="0" cellpadding="0">
					 <form name="frm_admin_login" method="post" id="frm_admin_login" action="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/index.php?action=submit">
					 <input type="hidden" name="returnURL" id="returnURL" value="<?php echo $this->_tpl_vars['returnUR']; ?>
" />
					   <?php if ($this->_tpl_vars['error'] != ""): ?>
							<tr>
							  <td  colspan="2"  height="10" class="errorTxt" > 
							   <?php echo $this->_tpl_vars['error']; ?>

							  </td>
							</tr>
						<?php endif; ?>
					 <tr>
						<td width="30%" height="25" class="normalTxt"><strong>Username</strong></td>
						<td width="70%" class="normalTxt">
						   <input name="username" type="text" class="input1" value="<?php echo $this->_tpl_vars['data']['username']; ?>
" maxlength="30">
						</td>
					  </tr>
					  <tr>
						<td height="25" class="normalTxt"><strong>Password</strong></td>
						<td class="normalTxt"><input name="password" type="password" class="input1" value="<?php echo $this->_tpl_vars['data']['password']; ?>
" maxlength="30" ></td>
					  </tr>
					  <tr>
						<td class="normalTxt">&nbsp;</td>
						<td height="35" class="normalTxt"><input type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/log_btn.jpg" value="Login" class="btnText"></td>
					  </tr>
					  <tr>
						<td class="normalTxt">&nbsp;</td>
						<td class="normalTxt"><a class="th" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/forgotpassword.php">Forgot Password</a></td>
					  </tr>
					   </form>
					</table>
					
				</td>
              </tr>
              <tr>
                <td colspan="3">&nbsp;</td>
                </tr>
            </table></td>
            <td width="588" height="245" align="center"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/log_mainpic.jpg" alt="Administrative Area" width="539" height="182" /></td>
          </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td class="boder"><table width="989" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15">&nbsp;</td>
        <td width="974" height="25" valign="bottom" class="normalTxt">Copyrights &copy; 2009 REDC. All rights reserved.</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td style="line-height:0px;"><table width="991" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="14"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/log_btm_1.jpg" alt="" width="14" height="14" /></td>
        <td width="963" class="btmLine"></td>
        <td width="14"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/log_btm_3.jpg" alt="" width="14" height="14" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>