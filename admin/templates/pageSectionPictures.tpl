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

	function deleteconfirmation(psid)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href='pageSectionPictures.php?action=del&psid='	+ psid;
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
   function submit_status(id,status)
   {
      document.forms[0].action.value = "status";
	  document.forms[0].id.value = id;
	  document.forms[0].status.value = status;
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
	  <form action="{$GENERAL.BASE_URL_ADMIN}/pageSectionPictures.php?action=submit&mode={$pageview}" method="post" enctype="multipart/form-data">
	<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1">
		  <table width="960" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" colspan="5" align="center"></td>
              </tr>
              <tr>
                <td width="10" height="48" align="center">&nbsp;</td>
                <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/gallery4.png" alt="" width="48" height="48" /></td>
                <td width="657"><span class="pageTitle">Pages Section Pictures  Manager</span><span class="pageTitle1">[{if $pageview eq 'add'}Add{else}Edit{/if} <span class="pageTitle">Pages Section Pictures  Manager</span>]</span></td>
                <td width="399" align="right" valign="top">
				<div class="toolbar" id="toolbar">
                    <table class="toolbar">
                      <tbody>
                        <tr>
                         <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/apply.png" style="border:0px;"  /> <br />
                              </a> </td>
                          <!--<td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/pageSectionPictures.php'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />Back
                            </a></td>-->
							<td class="button" id="toolbar-cancel"><a href="{$GENERAL.BASE_URL_ADMIN}/pageSectionPictures.php" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />
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
            <td width="617" valign="top" class="boderInner2">
			<table width="100%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                      <tr height="10" >
                        <td align="left" colspan="3" class="tipbox">
						  <input type="hidden" name="psid" value="{$data.psid|escape}" /> </td>
                      </tr>
					  <tr>
					    <td colspan="3">&nbsp;</td>
					   </tr>
					   <tr>
					     <td width="15%" align="right"> Section Name:</td>
					     <td width="85%" align="left"><input class="input" name="sectionname" type="text" id="sectionname" value="{$data.sectionname|escape}" maxlength="50" readonly="true" /></td>
				      </tr>
					  <tr>
					     <td width="15%" align="right">&nbsp;</td>
					     <td width="85%" align="left">&nbsp;</td>
				      </tr>
					  <tr><td colspan="3" height="5"></td></tr>
					  <tr class="row2">
                        <td align="right" valign="top" > Picture :<span class="required">&nbsp;</span></td>
						<td align="left" valign="top" colspan="2">
						<input type="file"  onkeypress="return false;" name="sec_image" id="sec_image" size="30"/><br />{if $data.sectionname|escape eq 'Site Map' or $data.sectionname|escape eq 'Virtual Tour'}(Please upload Picture of 951px x 135px size.){else}(Please upload Picture of 744px x 135px size.){/if}
						</td>
							<td valign="middle">
							{if $data.old_sec_image ne ''}							
							 <input type="hidden" name="old_sec_image" value="{$data.old_sec_image}" />

							<img src="{$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/thn_{$data.old_sec_image}" width="100" height="70" />						{/if}                          <a href="{$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$data.old_sec_image}" target="_blank" class="link">view Full size</a>
                            </td>

					  </tr>
					  <tr class="row2" height="25">
                     <td align="right" width="19%">&nbsp;</td>
                      <td align="left">&nbsp;</td>
                  </tr>
					  <tr><td colspan="3" height="5"></td></tr>
					  <tr class="row2">
                       <!-- <td align="right" valign="right">After Image :</td>-->
 				        <td align="right">&nbsp;</td>
						<td align="left" valign="top" colspan="2">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <!--<td width="58%"><input type="file"  onkeypress="return false;" name="after_image" id="after_image" size="30"/><span class="required">&nbsp;*</span>
							<br />(Please upload file of maximum 2Mb size.)</td>-->
                        	{if $data.old_after_image ne ''}
							    <td valign="middle">&nbsp;</td>
							{/if}                          
						   </tr>
                        </table></td>
						
					  </tr>
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
                                  <li>Fill in the following fields and click on Apply button</li>
                                  <li>To go back to Existing Records, click Cancel button</li>
                                  <li></li>
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
	
	 <form action="{$GENERAL.BASE_URL_ADMIN}/pageSectionPictures.php" method="post" name="frm_general" id="frm_general">
       <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1">
		  <table width="960" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" colspan="5" align="center"></td>
              </tr>
              <tr>
                <td width="10" height="48" align="center">&nbsp;</td>
                <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/gallery4.png" alt="" width="48" height="48" /></td>
                  <td width="570"><span class="pageTitle"> Pages Section Pictures  Manager</span> <span class="pageTitle1">[Existing  Pages  Section Pictures]</span></td>
                  <td width="314" align="right" valign="top">
				<div class="toolbar" id="toolbar">
                    <table class="toolbar">
                      <tr>
					  <!--<td class="button" id="toolbar-apply" ><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/pageSectionPictures.php?action=add'" class="toolbar"> <img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/pageSectionPictures.php?action=add'"  class="btnText"  /> <br />
                           </a> </td>-->
					  <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/gallerymanagement.php'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />Back
                            </a></td>
                     
                      </tr>
                    </table>
                  </div>				  </td>
                <td width="10" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td height="5" colspan="5" align="center"></td>
              </tr>
            </table>			</td>
      </tr>
      <tr>
        <td height="10"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
 	   {if $error ne ""}
          <tr>
            <td height="10" class="errorBar"> {$error} </td>
          </tr>
       {/if}
	  <tr>
        <td class="boderInner2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10" colspan="5" align="center">
				<input type="hidden" name="action" value="view" />
			    <input type="hidden" name="psid" value="psid" />
			    <input type="hidden" name="status" value="" />
				<input type="hidden" name="sortcolumn" value="{$sortcolumn}" />
				<input type="hidden" name="sortdirection" value="{$sortdirection}" />
			</td>
          </tr>
          <tr >
            <td width="10" align="center">&nbsp;</td>
            <td width="617" valign="top" class="boderInner2">
	     <table width="100%" border="0"  class="grid">
                      <tr  height="20">
                        <td align="left" width="150" ><a href="javascript:sortRecords('sectionname',true)" class="th" >Section Name</a></td>
						<td align="left" class="th" width=""> Picture </td>
						<td align="center" class="th" width="5%">Edit</td>
										
                      </tr>
                      <tr class="row1">
                        <td height="2" colspan="6" align="center" class="borderBtmDashed"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td align="left" width="197">{$entry.sectionname}</td>
						<td align="left"><img src="{$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/thn_{$entry.sec_image}" border="0" width="371" height="70" /></td>
						<!--<td align="center">{$GENERAL.BASE_URL_ROOT}/pageSectionPictures.php?psid={$entry.psid|escape}&amp;title={$entry.title}</td>-->
						<td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/pageSectionPictures.php?action=edit&psid={$entry.psid|escape}'"  class="btnText"  /> </td>
												
					    </tr>
                      {foreachelse}
                      <tr>
                        <td colspan="6">No existing record found</td>
                      </tr>
                      {/foreach}
                      <tr>
                        <td colspan="6" align="center"> {$paging} </td>
                      </tr>
                      <tr class="row1">
                        <td  align="right">&nbsp;</td>
                      </tr>
                    </table>			</td>
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
                                                                            <li>To go back to gallery manager, click on the 'Back' button</li>
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
      {/if}
	</td>
  </tr>
	{include file="$tpl_path/footer.tpl"}
</table>
</body>
</html>
