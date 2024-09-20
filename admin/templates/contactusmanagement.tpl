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

	function deleteconfirmation(id,returnpage,status)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href='contactusmanagement.php?action=del&id='	+ id + returnpage + status; 
		}	
	}
	function closeconfirmation(id)
	{
		if(confirm("Do you really want to close the request?"))
		{
			window.location.href='contactusmanagement.php?action=close&status=O&id='+ id; 
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
    <td height="15"> {include file="$tpl_path/header.tpl" title=header} </td>
  </tr>
  <tr>
  <tr>
    <td height="15" class="boder"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" /></td>
  </tr>
  <tr>
    <td class="boder"> {* Smarty *}
      
      {if $pageview eq "reply"}
      <!-- content Area start -->
      <form action="{$GENERAL.BASE_URL_ADMIN}/contactusmanagement.php?action=submit&mode={$pageview}&page={$returnpage}&status={$smarty.get.status}"  method="post">
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" colspan="5" align="center"></td>
              </tr>
              <tr>
                <td width="10" height="48" align="center">&nbsp;</td>
                <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/header/icon-48-article.png" alt="" width="48" height="48" /></td>
                <td width="445"><span class="pageTitle"><span class="tableHeader">Contact us Requests</span> Manager </span><span class="pageTitle1">[ Send Reply ]</span></td>
                <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                    <table class="toolbar">
                      <tbody>
                        <tr>
                          <td class="button" id="toolbar-apply"><a href="#" class="toolbar" onclick="javascript:submitForm();"><!--<input type="image" value="submit" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/sendemail.png" class="send" />--><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/sendemail.png" border="0" alt="" /></a></td>
						  <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/contactusmanagement.php?status={if $smarty.get.status neq C}O{else}C{/if}'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />
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
          <td height="10" class="errorBar">{$error}</td>
        </tr>
        <tr>
          <td height="10"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
        </tr>
        {/if}
        <tr>
          <td class="boderInner2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="10" colspan="5" align="center">
					<input type="hidden" name="id" value="{$data.id|escape}"/>
					<input type="hidden" name="contact_date" value="{$data.contact_date|escape}" />
					<input type="hidden" name="title" value="{$data.title|escape}" />
					<input type="hidden" name="first_name" value="{$data.first_name|escape}" />
					<input type="hidden" name="last_name" value="{$data.last_name|escape}" />
					<input type="hidden" name="company" value="{$data.company|escape}" />
					<input type="hidden" name="mailing_address" value="{$data.mailing_address|escape}" />
					<input type="hidden" name="phone" value="{$data.phone|escape}" />
					<input type="hidden" name="fromemail" value="{$data.fromemail|escape}" />
					<input type="hidden" name="subject" value="{$data.subject|escape}" />
					
                </td>
              </tr>
              <tr>
                <td width="10" align="center">&nbsp;</td>
                <td  valign="top" class="boderInner2">
					<table border="0" width="100%" cellspacing="1" cellpadding="1"  class="normalTxt">
						<tr class="row2" >
						  <td align="right" width = "35%" class="fieldtitle">Request Date:&nbsp;</td>
						  <td align="left" colspan="3">{$data.contact_date}
						  </td>
						</tr>
						<tr><td height="8"></td></tr>
						<tr class="row2" >
						  <td align="right" class="fieldtitle">Title:&nbsp;</td>
						  <td align="left" colspan="3">{$data.title}
						  </td>
						</tr>					
						<tr class="row2" >
						  <td align="right" class="fieldtitle">First Name:&nbsp;</td>
						  <td align="left" colspan="3">{$data.first_name}
						  </td>
						</tr>
						<tr class="row2" >
						  <td align="right" class="fieldtitle">Last Name:&nbsp;</td>
						  <td align="left" colspan="3">{$data.last_name}
						  </td>
						</tr>
						<tr class="row2" >
						  <td align="right" class="fieldtitle">Organisatoin:&nbsp;</td>
						  <td align="left" colspan="3">{$data.company}
						  </td>
						</tr>
						<tr class="row2" >
						  <td align="right" class="fieldtitle">Address:&nbsp;</td>
						  <td align="left" colspan="3">{$data.mailing_address}
						  </td>
						</tr>
						<tr class="row2" >
						  <td align="right" class="fieldtitle">Telephone:&nbsp;</td>
						  <td align="left" colspan="3">{$data.phone}</td>
						</tr>
						<tr class="row2" >
						  <td align="right" class="fieldtitle">Email:&nbsp;</td>
						  <td align="left" colspan="3">{$data.email}<input type="hidden" name="email" value="{$data.email}" />
						  </td>
						</tr>
						<tr class="row2" >
						  <td align="right" valign="top" class="fieldtitle">Request Information:&nbsp;<td align="left" colspan="4">{$data.about}.</td> </td>
						  <td align="left" colspan="3"></td>
						</tr>
						<tr class="row2" >
						  <td align="right" valign="top" class="fieldtitle">Additional Information:&nbsp;<td align="left" colspan="4">{$data.additionalinfo}.</td> </td>
						  <td align="left" colspan="3"></td>
						</tr>
						
					<tr><td height="8"></td></tr>					
					<tr class="row2" >
                      <td align="right">From Email:&nbsp;</td>
                      <td align="left" colspan="3"><input type="text" name="fromemail" value="{$data.fromemail}" class="normalTxt" /><span class="required">&nbsp;*</span>
					  </td>
                    </tr>					
					<tr class="row2" >
                      <td align="right">Subject:&nbsp;</td>
                      <td align="left" colspan="3"><input type="text" name="subject" value="{$data.subject}" class="normalTxt" /><span class="required">&nbsp;*</span>
					  </td>
                    </tr>					
                    <tr><td height="8"></td></tr>
					<tr><td colspan="2">Message<span class="required">&nbsp;*</span></td></tr>
					<tr class="row1">
                      <td align="center" colspan="4" >
					  	{php}
							$oFCKeditor = new FCKeditor('rply_message') ;
							$oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
							$oFCKeditor->Width		= '100%';
							$oFCKeditor->Height		= '600px';
							$oFCKeditor->Value		= $this->_tpl_vars['data']['emailcontent'];
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
                                  <li>Fill in the fields and click on Send Email button</li>
                                  <li>To go back to Existing Requests, click on cancel button</li>
                                  <li>Fields marked with * are required</li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        <script>
						  //TogglePanel('help1');
						  </script>
                      </td>
                    </tr>
                  </table></td>
                <td width="10" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td height="10" colspan="5" align="center"></td>
              </tr>
            </table>
      </form>
	  </td>
	  </tr>
	  </table>
      {else}
      <form action="contactusmanagement.php?{if $pageview eq "viewclose"}status=C{else}status=O{/if}" method="post" >
      <input type="hidden" name="sortcolumn" value="{$sortcolumn}" />
        <input type="hidden" name="sortdirection" value="{$sortdirection}" />
        <input type="hidden" name="status" value="{$status}" />
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
                <tr>
                  <td width="10" height="48" align="center">&nbsp;</td>
                  <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/header/icon-48-article.png" alt="" width="48" height="48" /></td>
                  <td width="445"><span class="pageTitle">Contact us Requests Manager </span><span class="pageTitle1">[
				  {if $smarty.get.status eq C} Closed Request List {else} Open  Request List {/if} ]</span></td>
                  <td width="439" align="right" valign="top">
				  	<div class="toolbar" id="toolbar">
						<table class="toolbar">
                		    <tr>
							
							{if $status ne "O"}
								<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/contactusmanagement.php?status=O" style="toolbar">
									<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-default.png" border="0" title="view open requests" /><br/> view open requests </a> 
								</td>
							{else}	
								<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/contactusmanagement.php?status=C" style="toolbar">
									<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" title="view closed requests" /><br/> view closed requests </a> 								</td>
                    		{/if}
						</tr>
                  	</table>
						
					</div>
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
                  <td height="10" colspan="5" align="center">
                  	
                  </td>
                </tr>
                <tr>
                  <td width="10" align="center">&nbsp;</td>
                  <td  valign="top" class="boderInner2"><table width="100%" border="0"  class="grid">
                      <tr  height="20">
                        <td align="left" ><a href="javascript:sortRecords('firstname',true)" class="th" >Sender Name</a></td>
                        <td align="left" ><a href="javascript:sortRecords('title',true)"  class="th">Title</a></td>
                       <td align="left"><a href="javascript:sortRecords('contactdate',true)"  class="th">Date</a></td>
                        <td align="center" class="th">Reply</td>
                        {if $pageview ne "viewclose"}
                        <td align="center" class="th">Open/Close</td>
                        {/if}
                        <td align="center" class="th">Delete</td>
                      </tr>
                      <tr class="row1">
                        <td height="2" colspan="6" align="center" class="borderBtmDashed"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td >{$entry.firstname}&nbsp;{$entry.lastname}</td>
                        <td>{$entry.title} </td>
                        <td>{$entry.contactdate}</td>
                        <td valign="top" align="center">
							
							
							<img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/contactusmanagement.php?action=reply&id={$entry.cuid|escape}&status={if $smarty.get.status neq "C"}O{else}C{/if}'"  class="btnText"  /> 
							 	
							
							</td>
						<td valign="top" align="center">
						{if $entry.status eq "O" }
								<a href="javascript:closeconfirmation('{$entry.cuid|escape}');" style="color:#048DB1;">close</a>
							{else}
								closed
							{/if}
						
						</td>
                        <td valign="top" align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.cuid|escape}','&page={if $pageview ne "viewclose"}open{else}close{/if}' , '&status={$entry.status}');"  class="btnText"  /> </td>
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
                        <td colspan="6" align="right">&nbsp;</td>
                      </tr>
                    </table></td>
                  <td width="8">&nbsp;</td>
				  {if $entry.status eq "O"}
                  <td width="315" valign="top">
				  <table width="315" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><div id="content-pane" class="pane-sliders">
                            <div class="panel"> <a href="Javascript:TogglePanel('help5');">
                              <h3 class="moofx-toggler title moofx-toggler-down"><span>Help</span></h3>
                              </a>
                              <div style="overflow: hidden; display: block; visibility: visible;  height: 1%;" class="normalTxt">
                                <div style="padding: 5px;" id="help5">
                                  <ul>
                                    <li>To reply request, click reply button next to that request </li>
									 {if $pageview eq "viewclose"}
									{else}
									<li>To close a request, click close button next to that request </li>
									{/if}
									 
									
                                    <li>To delete request, click Delete button next to that request </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                          {literal}
                          <script>
						  //TogglePanel('help5');
						  </script>
                          {/literal} </td>
                      </tr>
                    </table></td>
					{/if}
					{if $entry.status eq "C"}
					<td width="315" valign="top">
				  <table width="315" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><div id="content-pane" class="pane-sliders">
                            <div class="panel"> <a href="Javascript:TogglePanel('help5');">
                              <h3 class="moofx-toggler title moofx-toggler-down"><span>Help</span></h3>
                              </a>
                              <div style="overflow: hidden; display: block; visibility: visible;  height: 1%;" class="normalTxt">
                                <div style="padding: 5px;" id="help5">
                                  <ul>
								  <li>To reply request, click reply button next to that request </li>
                
                                    <li>To delete request, click Delete button  </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                          {literal}
                          <script>
						  //TogglePanel('help5');
						  </script>
                          {/literal} </td>
                      </tr>
                    </table></td>
					{/if}
					
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
      <!-- content Area ends -->
    </td>
  </tr>
   {include file="$tpl_path/footer.tpl" title=footer}
</table>
</body>
</html>
