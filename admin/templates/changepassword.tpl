{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

{include file="$tpl_path/top_header.tpl"}

<script language="javascript" src='{$GENERAL.BASE_URL_ROOT}/jscript/jquery.js'></script>
<script language="javascript" src='{$GENERAL.BASE_URL_ROOT}/jscript/jscripts.js'></script>

{literal}
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
  
{/literal}

</head>
<body>

<table width="991" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
    <td height="15">
	  {include file="$tpl_path/header.tpl"}
	</td>
  </tr>
  <tr>
    <td height="15" class="boder"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" /></td>
  </tr>
  <tr>
    <td class="boder">
	{* Smarty *}
     {if $pageview eq "add" or $pageview eq "edit"}
	<!--- content area form --->
	 <form action="{$GENERAL.BASE_URL_ADMIN}/changepassword.php?action=submit&mode={$pageview}" method="post" enctype="multipart/form-data">
	<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1">
		  <table width="960" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" colspan="5" align="center"></td>
              </tr>
              <tr>
                <td width="10" height="48" align="center">&nbsp;</td>
                <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/header/icon-48-article.png" alt="" width="48" height="48" /></td>
                <td width="445"><span class="pageTitle"><span class="tableHeader">Change Password</span> </span></td>
                <td width="439" align="right" valign="top">
				<div class="toolbar" id="toolbar">
                    <table class="toolbar">
                      <tbody>
                        <tr>
                         <td class="button" id="toolbar-apply"><a href="{$GENERAL.BASE_URL_ADMIN}/profile.php" class="toolbar"> <img  value="" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-edit.png" style="border:0px;"  /> <br />
                              Profile</a> </td>

                         <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                              Save</a> </td>
                          <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/welcome.php'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />
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
        <td height="10"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
	  {if $error ne ""}
        <tr>
          <td height="10" class="errorBar">{$error}
         </td>
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
            <td width="617" valign="top" class="boderInner2" >
			<table width="100%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                      <tr height="10" >
                        <td align="left" colspan="3" class="tipbox">
						  <input type="hidden" name="id" value="{$data.id|escape}" />				        </td>
                      </tr>
					  <tr><td height="5"></td></tr>
					   <tr>
					     <td width="25%" align="right">Old Password:&nbsp; </td>
					     <td width="75%" align="left">
						 	<input type="password" name="password" value="" class="input" size="30" maxlength="30" />
				         <span class="required">*</span></td>
				      </tr>							  
					  <tr><td height="5"></td></tr>
					   <tr>
					     <td width="25%" align="right">New Password:&nbsp; </td>
					     <td width="75%" align="left"><input class="input" type="password" name="newpassword" type="text" id="newpassword" size="30" maxlength="30" />
				         <span class="required">*</span></td>
				      </tr>					  
					 			  
					 <tr><td height="5"></td></tr>
					  <tr>
					     <td width="25%" align="right">Confirm Password:&nbsp; </td>
					     <td width="75%" align="left"><input class="input" name="confirmnewpassword" type="password" id="confirmnewpassword" value="" size="30" maxlength="30" />
				         <span class="required">*</span></td>
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
      {/if}
	</td>
  </tr>
  {include file="$tpl_path/footer.tpl"}
</table>
</body>
</html>
