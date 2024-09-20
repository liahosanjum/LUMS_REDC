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
		if(confirm("Are you sure you want to delete this request?"))
		{
			window.location.href='viewbroucherrequest.php?action=del&id=' + id ; 
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
      <form action="{$GENERAL.BASE_URL_ADMIN}/brouchermanagement.php?action=submit&mode={$pageview}&page={$returnpage}"  method="post">
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" colspan="5" align="center"></td>
              </tr>
              <tr>
                <td width="10" height="48" align="center">&nbsp;</td>
                <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/header/icon-48-article.png" alt="" width="48" height="48" /></td>
				 <td width="786"><span class="pageTitle"><span class="tableHeader">Brochure Requests</span> Manager </span><span class="pageTitle1">[ View Detail ]</span></td>
                 <td width="98" align="right" valign="top"><div class="toolbar" id="toolbar">
                    <table class="toolbar">
                      <tbody>
                        <tr>
						  <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/viewbroucherrequest.php'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />
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
                <td height="10" colspan="5" align="center"><input type="hidden" name="id" value="{$data.ebrid|escape}" />
                </td>
              </tr>
              <tr>
                <td width="10" align="center">&nbsp;</td>
                <td  valign="top" class="boderInner2"><table border="0" width="100%" cellspacing="1" cellpadding="1"  class="normalTxt">
									
					<tr class="row2" >
                    <td align="right" class="fieldtitle">Name:&nbsp;</td>
                    <td align="left" width="50%" colspan="3">{$data.prefix} {$data.firstname} {$data.lastname}  </td>
                  	<tr class="row2" >
                      <td align="right" class="fieldtitle">Company Name:&nbsp;</td>
                      <td align="left" colspan="3">{$data.companyname}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right" class="fieldtitle">Designation:&nbsp;</td>
                      <td align="left" colspan="3" >{$data.designation}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right" class="fieldtitle">Address:&nbsp;</td>
                      <td align="left" colspan="3">{$data.address}  
					   </td>
                    </tr>
					<tr class="row2" >
                      <td align="right" class="fieldtitle">City:&nbsp;</td>
                      <td align="left" colspan="3">{$data.city}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right" class="fieldtitle">Zip/Postal Code:&nbsp;</td>
                      <td align="left" colspan="3"> {$data.postalcode}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right" class="fieldtitle">Country:&nbsp;</td>
                      <td align="left" colspan="3"> {$data.country} 
					  </td>
                    </tr>
				
					<tr class="row2" >
                      <td align="right" class="fieldtitle">Telephone:&nbsp;</td>
                      <td align="left" colspan="3">{$data.telephone}
					  </td>
                    </tr>
						<tr class="row2" >
                      <td align="right" class="fieldtitle">Fax:&nbsp;</td>
                      <td align="left" colspan="3">{$data.fax}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right" class="fieldtitle">Email:&nbsp;</td>
                      <td align="left" colspan="3">{$data.email}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right" class="fieldtitle">How did you learn about programme?:&nbsp;</td>
                      <td align="left" colspan="3">{$data.learn_about}
					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right" class="fieldtitle">Programme Name:&nbsp;</td>
                      <td align="left" colspan="3">{$data.programmename}
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
                                  <li>To go back to Existing Requests, click on Back button</li>
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
      <form action="viewbroucherrequest.php{if $pageview eq "viewclose"}?action=viewclose{/if}" method="post" >
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
                <tr>
                  <td width="10" height="48" align="center">&nbsp;</td>
                  <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/header/icon-48-article.png" alt="" width="48" height="48" /></td>
                  <td width="807"><span class="pageTitle"> Brochure Requests Manager </span><span class="pageTitle1">&nbsp;[Existing Brochure Requests List]</span><!--</span><span class="pageTitle1">&nbsp;[
                    {if $pageview eq "viewclose"}
                    view  Request Detail  
                    {else}
                    Existing broucher Request List  
                    {/if}
                    ]</span>--></td>
                  <td width="77" align="right" valign="top"><div class="toolbar" id="toolbar">                  </td>
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
				
                <tr>
                  <td width="10" align="center">&nbsp;</td>
                  <td  valign="top" class="boderInner2"><table width="100%" border="0"  class="grid">
                      <tr  height="20">
                        <td align="center" ><a href="javascript:sortRecords('firstname',true)" class="th" > Name</a></td>
						<td align="center"><a href="javascript:sortRecords('companyname',true)"  class="th">Organization</a></td>
						<td align="center"><a href="javascript:sortRecords('designation',true)"  class="th">Designation</a></td>
                       <td align="center"><a href="javascript:sortRecords('email',true)"  class="th">Email</a></td>
					    <td align="center"><a href="javascript:sortRecords('programmename ',true)"  class="th">Programme</a></td>
                        <td align="center" class="th">View</td>
                        <td align="center" class="th">Delete</td>
                      </tr>
                      <tr class="row1">
                        <td height="2" colspan="6" align="center" class="borderBtmDashed"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td align="center" >{$entry.firstname} { $entry.lastname}</td>
						<td align="center" >{$entry.companyname }</td>
						<td align="center" >{$entry.designation }</td>
                        <td align="center" >{$entry.email}</td>
						 <td align="center" >{$entry.programmename}</td>
						  
						  <td valign="top" align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/viewbroucherrequest.php?action=detail&id={$entry.ebrid|escape}&page={if $pageview ne "viewclose"}open{else}close{/if}'"  class="btnText"  /> </td>
                        
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.ebrid|escape}');"  class="btnText"  /> </td>
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
                  <td width="315" valign="top"><table width="315" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><div id="content-pane" class="pane-sliders">
                            <div class="panel"> <a href="Javascript:TogglePanel('help5');">
                              <h3 class="moofx-toggler title moofx-toggler-down"><span>Help</span></h3>
                              </a>
                              <div style="overflow: hidden; display: block; visibility: visible;  height: 1%;" class="normalTxt">
                                <div style="padding: 5px;" id="help5">
                                  <ul>
                                    <li>To view request, click view button next to that request </li>
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
