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

	function deleteconfirmation(id,returnpage)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href='conferenceservicemanagement.php?action=del&id='	+ id + returnpage; 
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
	function closeconfirmation(id)
	{
		if(confirm("Do you really want to close the request?"))
		{
			window.location.href='conferenceservicemanagement.php?action=close&id='+ id; 
		}	
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
      <form action="{$GENERAL.BASE_URL_ADMIN}/conferenceservicemanagement.php?action=submit&mode={$pageview}&page=open{if $smarty.get.page eq 'close'}&isactive=N{/if}"  method="post">
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" colspan="5" align="center"></td>
              </tr>
              <tr>
                <td width="10" height="48" align="center">&nbsp;</td>
                <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/header/icon-48-article.png" alt="" width="48" height="48" /></td>
                <td width="445"><span class="pageTitle"><span class="tableHeader">Conference Services</span> Manager </span><span class="pageTitle1">[ Send Reply ]</span></td>
                <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                    <table class="toolbar">
                      <tbody>
                        <tr>
                          <td class="button" id="toolbar-apply"><a href="#" class="toolbar" onclick="javascript:submitForm();"><!--<input type="image" value="submit" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/sendemail.png" class="send" />--><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/sendemail.png" border="0" alt="" /></a></td>
						  <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/conferenceservicemanagement.php{if $smarty.get.page eq 'close'}?isactive=N{/if}'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />
                            Back</a></td>
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
                <td height="10" colspan="5" align="center"><input type="hidden" name="id" value="{$data.csid|escape}" />
                </td>
              </tr>
              <tr>
                <td width="10" align="center">&nbsp;</td>
                <td  valign="top" class="boderInner2"><table border="0" width="100%" cellspacing="1" cellpadding="1"  class="normalTxt">
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Request Date:&nbsp;</td>
                      <td align="left" colspan="3">{$data.daterequest}
					  </td>
                    </tr>
					<tr><td height="8"></td></tr>					
                    <tr class="row2" >
                      <td align="right"  class="fieldtitle">First Name:&nbsp;</td>
                      <td align="left" colspan="3">{$data.firstname}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Last Name:&nbsp;</td>
                      <td align="left" colspan="3">{$data.lastname}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Designation:&nbsp;</td>
                      <td align="left" colspan="3">{$data.designation}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Organizatoin:&nbsp;</td>
                      <td align="left" colspan="3">{$data.organisation}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Address:&nbsp;</td>
                      <td align="left" colspan="3">{$data.address}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Telephone:&nbsp;</td>
                      <td align="left" colspan="3">{$data.phoneno}</td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Fax:&nbsp;</td>
                      <td align="left" colspan="3">{$data.fax}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Mobile:&nbsp;</td>
                      <td align="left" colspan="3">{$data.mobile}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Email:&nbsp;</td>
                      <td align="left" colspan="3">{$data.email}<input type="hidden" name="email" value="{$data.email}" />
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Date of Event:&nbsp;</td>
                      <td align="left" colspan="3">{$data.dated}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">No of participants:&nbsp;</td>
                      <td align="left" colspan="3">{$data.totalparticipants}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle"><strong>Facilities Required:&nbsp;</strong></td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Auditorium:&nbsp;</td>
                      <td align="left" colspan="3">{$data.auditorium}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Lounge:&nbsp;</td>
                      <td align="left" colspan="3">{$data.lounge}
					  </td>
                    </tr>
					<!--<tr class="row2" >
                      <td align="right"  class="fieldtitle"><strong>Residential Rooms:&nbsp;</strong></td>
                    </tr>	-->
					<!--<tr class="row2" >
                      <td align="right"  class="fieldtitle">Single:&nbsp;</td>
                      <td align="left" colspan="3">{$data.single}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Double:&nbsp;</td>
                      <td align="left" colspan="3">{$data.double}
					  </td>
                    </tr>-->
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Residential Rooms:&nbsp;</td>
                      <td align="left" colspan="3">{$data.bedroom}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Additional Requirements:&nbsp;</td>
					  <td align="left" colspan="3">{$data.additionalrequirements}
					  </td>
                    </tr>				
					<tr><td height="8"></td></tr>					
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">From Email:&nbsp;</td>
                      <td align="left" colspan="3"><input type="text" name="fromemail" value="{$form.fromemail}" class="normalTxt" /><span class="required">&nbsp;*</span>
					  </td>
                    </tr>					
					<tr class="row2" >
                      <td align="right"  class="fieldtitle">Subject:&nbsp;</td>
                      <td align="left" colspan="3"><input type="text" name="subject" value="{$form.subject}" class="normalTxt" /><span class="required">&nbsp;*</span>
					  </td>
                    </tr>					
                    <tr><td height="8"></td></tr>
					<tr><td colspan="2"  class="fieldtitle">Reply Details<span class="required">&nbsp;*</span></td></tr>
					<tr class="row1">
                      <td align="center" colspan="4" class="boderInner2">
					  	{php}
							$oFCKeditor = new FCKeditor('rply_message') ;
							$oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
							$oFCKeditor->Width		= '100%';
							$oFCKeditor->Height		= '600px';
							$oFCKeditor->Value		= $this->_tpl_vars['form']['rply_message'];
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
      {else}
	 <form action="conferenceservicemanagement.php" method="post" >
       
	    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
                <tr>
                  <td width="10" height="48" align="center">&nbsp;</td>
                  <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/header/icon-48-article.png" alt="" width="48" height="48" /></td>
                  <td width="445"><span class="pageTitle">Conference Services Manager </span><span class="pageTitle1">[
                    {if $isactive eq "Y"}
                    View Open Request  
                    {elseif $isactive eq 'N'}
                    View Close Request
					{else}
					 Send Replay 
                    {/if}
                    ]</span></td>
					
                  <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
				  <table class="toolbar">
                		    <tr>
							
							{if $isactive eq "N"}
								<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/conferenceservicemanagement.php?isactive=Y" style="toolbar">
									<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-default.png" border="0" title="view open requests" /><br/> View open requests </a> 
								</td>
							{else}	
								<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/conferenceservicemanagement.php?isactive=N&page=close" style="toolbar">
									<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" title="view closed requests" /><br/> View closed requests </a> 								</td>
                    		{/if}
						</tr>
                  	</table>
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
					<input type="hidden" name="isactive" value="{$isactive}" />
                  </td>
                </tr>
				
                <tr>
                  <td width="10" align="center">&nbsp;</td>
                  <td  valign="top" class="boderInner2"><table width="100%" border="0"  class="grid">
                      <tr  height="20">
                        <td align="center" ><a href="javascript:sortRecords('firstname',true)" class="th" >Name</a></td>
						<td align="center" ><a href="javascript:sortRecords('designation',true)" class="th" >Designation</a></td>
						<td align="center" ><a href="javascript:sortRecords('organisation',true)" class="th" >Organization</a></td>
                       <td align="center"><a href="javascript:sortRecords('daterequest',true)"  class="th">Dated</a></td>
                        <td align="center" class="th">Details/Reply</td>
                        {if $pageview ne "viewclose"}
                        <td align="center" class="th">Close</td>
                        {/if}
                        <td align="center" class="th">Delete</td>
                      </tr>
                      <tr class="row1">
                        <td height="2" colspan="7" align="center" class="borderBtmDashed"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2" align="center" style="height:25px;" >
                        <td >{$entry.firstname}&nbsp;{$entry.lastname}</td>
						<td>{$entry.designation}</td>
						<td>{$entry.organisation}</td>
                        <td>{$entry.daterequest}</td>
                        <td valign="top" align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/conferenceservicemanagement.php?action=reply&id={$entry.csid|escape}&page={if $pageview ne "viewclose" and $smarty.get.isactive ne 'N'}open{else}close{/if}'"  class="btnText"  /> </td>
						<td valign="top" align="center">
							{if $entry.isactive eq "Y" }
								<a href="javascript:closeconfirmation('{$entry.csid|escape}');" style="color:#048DB1;">close</a>
							{else}
								closed
							{/if}
						</td>
                        <td valign="top" align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.csid|escape}','&page={if $pageview ne "viewclose"}open{else}close{/if}');"  class="btnText"  /> </td>
                      </tr>
                      {foreachelse}
                      <tr>
                        <td colspan="7">No existing record found</td>
                      </tr>
                      {/foreach}
                      <tr>
                        <td colspan="7" align="center"> {$paging} </td>
                      </tr>
                      <tr class="row1">
                        <td colspan="6" align="right">&nbsp;</td>
                      </tr>
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
                                    <li>To reply request, click reply button next to that request </li>
									 {if $pageview eq "viewclose"}
									
									{/if}
									 
									
                                    <li>To delete request, click Delete button next to that request </li>
									{if $isactive eq 'N'}
									<li>To view open request, click view open request button </li>
                                     {else}
									<li>To view close request, click view close request button </li>
									{/if}
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
