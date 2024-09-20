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
		
		function submitForm()
		{
			document.forms[0].submit();
		}

	function deleteconfirmation(itemid)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href='newslettertemplatemanagement.php?action=del&id='	+ itemid;
		}	
	}
	
	function sortRecords(col, order)
	{
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
      {if $pageview eq "add" or $pageview eq "edit"}
      <!--- content area form --->
      <form action="{$GENERAL.BASE_URL_ADMIN}/newslettertemplatemanagement.php?action=submit&mode={$pageview}{if $pageview eq 'edit'}{/if}" $pageview method="post" enctype="multipart/form-data" >
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
                <tr>
                  <td width="10" height="48" align="center">&nbsp;</td>
                  <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/icon-48-massmail.png" alt="" width="48" height="48" /></td>
                  <td width="445"><span class="pageTitle"><span class="tableHeader">Newsletter Template</span> Manager </span><span class="pageTitle1">[{if $pageview eq 'add'}Add{else}Edit{/if} Email]</span></td>
                  <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                      <table class="toolbar">
                        <tbody>
                          <tr>
                            <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-save.png" style="border:0px;" /> <br />
                          Save</a></td>
                            <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/newslettertemplatemanagement.php'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />
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
            <td height="10" class="errorBar">
			 {$error}</td>
          </tr>
          <tr>
            <td height="10"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
          </tr>
          {/if}
          <tr>
            <td class="boderInner2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10" colspan="5" align="center">&nbsp;</td>
                </tr>
                <td width="10" align="center">&nbsp;</td>
                  <td width="617" valign="top" class="boderInner2">
				  <table width="98%" border="0" cellspacing="1" cellpadding="1"  class="grid">
                      
					  <tr height="25" >
                        <td align="left" colspan="2" class="tipbox">
						<input type="hidden" name="itemid" value="{$data.itemid|escape}" />
						</td>
                      </tr>
                      <tr class="row1">
                        <td align="right" valign="top">Email Name:&nbsp;</td>
                        <td width="84%" align="left">
						<input type="text" name="emailname" class="input" value="{$data.emailname|escape}" maxlength="50" />
                          <span class="required">&nbsp;*</span></td>
                      </tr>
                      <tr class="row1">
                        <td align="right" valign="top">From Name:&nbsp;</td>
                        <td width="84%" align="left">
						<input type="text" name="fromname" class="input" value="{$data.fromname|escape}" maxlength="50" />
                          <span class="required">&nbsp;*</span></td>
                      </tr>
					  <tr class="row1">
                        <td align="right" valign="top">From Email:&nbsp;</td>
                        <td width="84%" align="left">
						<input type="text" name="fromemail" class="input" value="{$data.fromemail|escape}" maxlength="50" />
                          <span class="required">&nbsp;*</span></td>
                      </tr>
					  <tr class="row1">
                        <td align="right" valign="top">Subject:&nbsp;</td>
                        <td width="84%" align="left">
						<input type="text" name="subject" class="input" value="{$data.subject|escape}" maxlength="100" />
                          <span class="required">&nbsp;*</span></td>
                      </tr>
					  <tr class="row1">
                        <td align="right" valign="top">&nbsp;</td>
                        <td width="84%" align="left">&nbsp;</td>
                      </tr>					   
                      
					   <tr class="row1">
                        <td align="center" colspan="2" class="boderInner2">
						 {php}
							$oFCKeditor = new FCKeditor('content') ;
							$oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
							$oFCKeditor->Width		= '100%';
							$oFCKeditor->Height		= '600px';
							$oFCKeditor->Value		= $this->_tpl_vars['data']['content'];
							$oFCKeditor->Create() ;
						  {/php}
						</td>
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
                                    <li>Fill in the following fields and click on Apply button</li>
                                    <li>To go back to Existing Emails, click Cancel button</li>
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
      <form action="{$GENERAL.BASE_URL_ADMIN}/newslettertemplatemanagement.php" method="post">
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
                <tr>
                  <td width="10" height="48" align="center">&nbsp;</td>
                  <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/icon-48-massmail.png" alt="" width="48" height="48" /></td>
                  <td width="520" ><span class="pageTitle">Newsletter Template Manager </span><span class="pageTitle1">[Existing Newsletter Templates]</span></td>
                  <td width="364" align="right" valign="top"><div class="toolbar" id="toolbar">
					  <table class="toolbar">
						<tr>
						  <td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/newslettertemplatemanagement.php?action=add'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png" /><br/> Add </a> </td>
						</tr>
					  </table></div>
				  </td>
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
            <td class="boderInner2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10" colspan="5" align="center"><input type="hidden" name="sortcolumn" value="{$sortcolumn}" />
                    <input type="hidden" name="sortdirection" value="{$sortdirection}" />
                  </td>
                </tr>
                <td width="10" align="center">&nbsp;</td>
                  <td width="617" valign="top" class="boderInner2"><table width="100%" border="0"  class="grid">
                      <tr  height="20">
                        <td style="width:20%" align="center" ><a href="javascript:sortRecords('emailname',true)" class="th" >Email Name</a></td>
                        <td style="width:20%" align="center" ><a href="javascript:sortRecords('fromname',true)" class="th" >From</a></td>
						<td style="width:20%" align="center" ><a href="javascript:sortRecords('fromemail',true)" class="th" >From Email</a></td>
						<td style="width:20%" align="center" ><a href="javascript:sortRecords('subject',true)" class="th" >Subject</a></td>
                        <td align="center" class="th">Edit</td>
                        <td align="center" class="th">Delete</td>
                      </tr>
                      <tr class="row1">
                        <td height="2" colspan="6" align="center" class="borderBtmDashed"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td align="center">{$entry.emailname|escape}</td>
                        <td align="center"> {$entry.fromname|escape} </td>
						<td align="center"> {$entry.fromemail|escape} </td>
						<td align="center"> {$entry.subject|escape} </td>
                        <td valign="top" align="center"><img style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/newslettertemplatemanagement.php?action=edit&id={$entry.itemid|escape}'"  class="btnText"  /> </td>
                        <td valign="top" align="center"><img style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.itemid|escape}');"  class="btnText"  /> </td>
                      </tr>
                      {foreachelse}
                      <tr>
                        <td colspan="5">No existing newsletter template found</td>
                      </tr>
                      {/foreach}
                    </table></td>
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
                                    <li>To Edit a record, click on the 'Edit' button against the record</li>
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
              </table></td>
          </tr>
        </table>
      </form>
      {/if} </td>
   {include file="$tpl_path/footer.tpl"}
 </table>
</body>
</html>
