{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file="$tpl_path/top_header.tpl"}
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
		function selectEmail(page)
		{	
			for(i=0;i<document.forms[0].ddlmember.options.length;i++)
			{
				for(j=0;j<page.length;j++){
					if(page[j] == document.forms[0].ddlmember.options[i].value)
					{
						document.forms[0].ddlmember[i].selected = true;
					}
				}
			}
		}
		function set_action(value)
		{
		    if(value == "savedraft")
			{
			  if(document.forms[0].template.value == 0)
			  {
			     alert("Please select template.");
				 return false;
			  }
			}
			document.forms[0].action.value=value;
		    document.forms[0].submit();
			
		}
		function selectAllEmail()
		{	
			for(i=0;i<document.forms[0].ddlmember.options.length;i++)
			{
				document.forms[0].ddlmember[i].selected = true;
			}
		}
		function appendTemplate()
		{
			
			document.forms[0].submit();
		}
  </script>
{/literal}
</head>
<body>
<table width="991" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15"> {include file="$tpl_path/header.tpl"} </td>
  </tr>
  <tr>
    <td height="15" class="boder"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" /></td>
  </tr>
  <tr>
    <td class="boder"> {* Smarty *}
      <!--- content area form --->
      <form action="{$GENERAL.BASE_URL_ADMIN}/newslettermanagement.php" name="frm_news" id="frm_news" method="post">
	  <input type="hidden" name="action" value="" />
	  <!--<input type="hidden" name="template" value="{$data.template}" />-->
	  <input type="hidden" name="templateid" value="{if $data.template}{$data.template}{else}0{/if}" />
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
                <tr>
                  <td width="10" height="48" align="center">&nbsp;</td>
                  <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/header/icon-48-article.png" alt="" width="48" height="48" /></td>
                  <td width="445"><span class="pageTitle"><span class="tableHeader">Send </span></span> <span class="pageTitle">Newsletter Manager </span><span class="pageTitle1">[send newsletter]</span></td>
                  <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                      <table class="toolbar">
                        <tbody>
                          <tr>
                           <!--<td class="button" id="toolbar-apply"><a href="javascript: void(0);" onclick="javascript: set_action('savedraft');" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                          Save</a> </td>-->
						   <td class="button" id="toolbar-apply"><a href="javascript: set_action('submit');" class="toolbar"><img value="submit" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-send.png" class="Send" border="0" /><br />
						  &nbsp;Send</a> </td>
                            <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/mailinglistmanagement.php'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />
                              Cancel</a></td>
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
            <td height="10" class="errorBar"> {$error }
              </td>
          </tr>
          <tr>
            <td height="10"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
          </tr>
          {/if}
          <tr>
            <td class="boderInner2"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="10" colspan="5" align="center">&nbsp;</td>
                </tr>
                <td width="10" align="center">&nbsp;</td>
                  <td width="617" align="left" valign="top" class="boderInner2"><table width="98%" border="0" cellspacing="1" cellpadding="1"  class="grid">
                      <tr height="25" >
                        <td align="left" colspan="3" class="tipbox"></td>
                      </tr>
                      <tr class="row1">
                        <td colspan="3"></td>
                      </tr>
                      <tr class="row1">
                        <td colspan="2" align="right" valign="top" nowrap="nowrap"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                           <tr>
                              <td align="right">Select Subscribers Group: </td>
                              <td align="left">
							   <select name="enabled" id="enabled" class="select_class" style="width:206px;">
									<option value="0">-Select-</option>
									<option value="1" {if $form.enabled eq "1"}selected="selected"{/if}>Alumni</option>
									<option value="2" {if $form.enabled eq "2"}selected="selected"{/if}>Subscribers</option>
									</select>
							   <span class="required">&nbsp;*</span>
							   </td>
                            </tr>
						    <tr>
                              <td width="22%" align="right" style="padding-top:17px;">Select Template :</td>
							  <td width="62%" align="left"style="padding-top:17px;">
								<select name="template" id="template" class="select_class" onchange="appendTemplate();" style="width: 206px;">
									<option value="0" >- Select -</option>
									{section name=t loop=$templates}
									
									<option value="{$templates[t].temp_id}" {if $form.template == $templates[t].temp_id}selected{/if}>{$templates[t].emailname}</option>
									{/section}
								</select>
							 <!--<span class="required">&nbsp;*</span> -->
							 </td>
                            </tr>
                            <tr>
                              <td height="20" align="right">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="right">From Name :</td>
                              <td align="left"><input type="text" name="name" class="input" value="{$form.name|escape}" style="width:200px;" />
                                <span class="required">&nbsp;*</span></td>
                            </tr>
                            <tr>
                              <td height="20" align="right">&nbsp;</td>
                              <td align="left">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="right">From Email :</td>
                              <td align="left"><input type="text" name="email" class="input" value="{$form.email|escape}" style="width:200px;" />
                                <span class="required">&nbsp;*</span></td>
                            </tr>
                            <tr>
                              <td height="20" align="right">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="right">Email Subject :</td>
                              <td align="left"><input type="text" name="subject" class="input" value="{$form.subject|escape}" style="width:200px;" />
                                <span class="required">&nbsp;*</span></td>
                            </tr>
							
							<!--<tr style="padding-top:20px;">
							<td align="right" style="padding-top:20px;">Template</td>
							<td></td>
							<td style="padding-top:20px;"><select name="template" id="template" class="select_class" onchange="appendTemplate();">
									<option value="0">-- Select --</option>
									{section name=t loop=$templates}
									    <option value="{$templates[t].itemid}" {if $data.template == $templates[t].itemid}selected{/if}>{$templates[t].emailname}</option>
									{/section}
								</select>	</td>-->
                        </table></td>
                        	                      <tr>
                        <td align="center" colspan="3" height="5"></td>
                      </tr>
                      
					   <tr >
                        <td align="left" colspan="0" style="padding-left:15px;" >&nbsp;Message:  <span class="required">&nbsp;*</span></td>
						<td align="center" colspan="2" >&nbsp;</td>
                      </tr>
                      <tr class="row1">
                        <td align="center" colspan="3" class="boderInner2">
						  {php}
							$oFCKeditor = new FCKeditor('FCKeditor1') ;
							$oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
							$oFCKeditor->Width		= '100%';
							$oFCKeditor->Height		= '600px';
							$oFCKeditor->Value		= $this->_tpl_vars['data']['FCKeditor1'];
							$oFCKeditor->Create() ;
						  {/php}
						  </td>
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
                                    <li>Fill in the following fields and click on Send button</li>
                                    <li>To go back to Control Panel, click Cancel button</li>
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
    </td>
  </tr>
   {include file="$tpl_path/footer.tpl"}
</table>
</body>
</html>
