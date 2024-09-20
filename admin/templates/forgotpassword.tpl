{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file="$tpl_path/top_header.tpl"}
</head>
<body bgcolor="#ffffff" onLoad="javascript:FocusControl()">
<table width="991" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="991" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="14"><img src="{$GENERAL.ADMIN_IMG_URL}/log_top_1.jpg" alt="" width="14" height="45" /></td>
        <td width="963" class="siteName">REDC</td>
        <td width="14"><img src="{$GENERAL.ADMIN_IMG_URL}/log_top_3.jpg" alt="" width="14" height="45" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="colourBar">{* Smarty *}</td>
  </tr>
  <tr>
    <td height="15" class="boder"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
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
                <td height="95" colspan="2" class="adminLogin">Forgot Password</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="15">&nbsp;</td>
                <td width="267">
			      <table width="100%" border="0" cellspacing="0" cellpadding="0">
					 <form name="frm_admin_login" method="post" id="frm_admin_login" action="{$GENERAL.BASE_URL_ADMIN}/forgotpassword.php?action=submit">
					 <tr>
					   <td colspan="2"  height="20" class="errorTxt"> 
						   {$error}
					   </td>
					</tr>
					 <tr>
						<td width="30%" height="25" class="normalTxt"><strong>Username</strong></td>
						<td width="70%" class="normalTxt">
						   <input name="username" type="text" class="input1" value="{$data.username}" maxlength="30">
						</td>
					  </tr>
					  <tr>
						<td class="normalTxt">&nbsp;</td>
						<td height="40" class="normalTxt"><input type="image" src="{$GENERAL.ADMIN_IMG_URL}/send.gif" value="Login" class="btnText"></td>
					  </tr>
					  <tr>
						<td class="normalTxt">&nbsp;</td>
						<td class="normalTxt th"><a class="th" href="{$GENERAL.BASE_URL_ADMIN}/index.php">Click here to login</a></td>
					  </tr>
					  </form>
					</table>
					
				</td>
              </tr>
              <tr>
                <td colspan="3">&nbsp;</td>
                </tr>
            </table></td>
            <td width="588" height="245" align="center"><img src="{$GENERAL.ADMIN_IMG_URL}/log_mainpic.jpg" alt="Administrative Area" width="539" height="182" /></td>
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
        <td width="14"><img src="{$GENERAL.ADMIN_IMG_URL}/log_btm_1.jpg" alt="" width="14" height="14" /></td>
        <td width="963" class="btmLine"></td>
        <td width="14"><img src="{$GENERAL.ADMIN_IMG_URL}/log_btm_3.jpg" alt="" width="14" height="14" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>