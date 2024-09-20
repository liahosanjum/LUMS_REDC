{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file="$tpl_path/top_header.tpl"}
<link href="{$GENERAL.BASE_URL_ROOT}/css/black-calender.css" rel=stylesheet type="text/css">
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

	function deleteconfirmation(nsid)
	{
		if(confirm("Are you sure you want to delete this subscriber?"))
		{
			window.location.href='mailinglistmanagement.php?action=del&nsid='	+nsid;
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
  
  <td class="boder">
  
  {* Smarty *}
  {if $pageview eq "add" or $pageview eq "edit"}
  <!--- content area form --->
  <form action="{$GENERAL.BASE_URL_ADMIN}/mailinglistmanagement.php?action=submit&mode={$pageview}{if $pageview eq 'edit'}&id={$data.id}{/if}" method="post"  enctype="multipart/form-data">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/header/news1.png" alt="" width="48" height="48" /></td>
              <td width="550"><span class="pageTitle"><span class="tableHeader">Mailing List Subscribers</span> Manager </span><span class="pageTitle1">[{if $pageview eq 'add'}Add{else}Edit{/if} Mailing List Subscribers]</span></td>
              <td width="334" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/apply.png" style="border:0px;"  /> <br />
                          </a> </td>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/mailinglistmanagement.php'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />Back</a></td>
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
              <td height="10" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" align="center">&nbsp;</td>
              <td width="617" valign="top" class="boderInner2"><table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox"><input type="hidden" name="nsid" value="{$data.nsid}" />                    </td>
                  </tr>
                  <tr class="row2">
                    <td width="40%" align="right">Name:&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="name" class="input" value="{$data.name}" maxlength="30" />
                      </td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right">Email :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="email" class="input" value="{$data.email}" maxlength="50" />
                      <span class="required">&nbsp;*</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="19%" align="right">Company Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="companyname" class="input" value="{$data.companyname}" maxlength="50" />
                      </td>
                  </tr> 
				  <tr class="row2">
                    <td width="19%" align="right">Designation :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="designation" class="input" value="{$data.designation}" maxlength="50" />
                      </td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right">Enabled :&nbsp;</td>
                    <td width="81%" align="left"><select name="isactive" id="isactive" style="width:177px;" class="select_class">
						         <option value="Yes" {if $data.isactive eq "Yes"}selected="selected"{/if}>Yes</option>
								 <option value="No" {if $data.isactive eq "No"}selected="selected"{/if}>No</option>
							</select>
                      <span class="required"></span></td>
                  </tr>     
				                   
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox"></td>
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
                                <li>Fill in the fields and Click on Apply button for save the record</li>
                                <li>To go back to Existing Mailing List Subscribers, click Back button</li>
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/mailinglistmanagement.php" method="post">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/header/news1.png" alt="" width="48" height="48" /></td>
              <td width="550"><span class="pageTitle">Mailing List Subscribers Manager </span><span class="pageTitle1">[Existing Mailing List Subscribers]</span></td>
              <td width="334" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
					<td class="button" id="toolbar-apply" ><a style="toolbar"href='{$GENERAL.BASE_URL_ADMIN}/mailinglistmanagement.php?action=export'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-export.png" /><br/> Export to CSV  </a> </td>
                      <td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/newslettermanagement.php'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-send.png" /><br/> Send Email </a> </td>
                      <td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/newsletterarchive.php'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-refresh.png" /><br/> History </a> </td>
					  {if $GENERAL.USER_TYPE eq 'A'}
                      <td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/mailinglistmanagement.php?action=add'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png" /><br/> Add </a> </td>
					  {/if}
                    </tr>
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
        <td height="4"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
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
        <td class="boderInner2">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10" colspan="5" align="center">
			<input type="hidden" name="sortcolumn" value="{$sortcolumn}" />
                <input type="hidden" name="sortdirection" value="{$sortdirection}" />
			</td>
          </tr>
          <tr >
          
          <td width="10" align="center">&nbsp;</td>
          <td width="617" valign="top" class="boderInner2">
          
         <table width="100%" border="0"  class="grid">
                      <tr  height="20">
					   <td align="center" width="20%" ><a href="javascript:sortRecords('name',true)" class="th" >Name</a></td>
                        <td align="center" ><a href="javascript:sortRecords('email',true)" class="th" >Email</a></td>
						<td align="center" ><a href="javascript:sortRecords('companyname',true)" class="th" >Organization</a></td>
						<td align="right" ><a href="javascript:sortRecords('designation',true)" class="th" >Designation</a></td>
						
                        <td  align="center"  class="th">Edit</td>
                        <td style="width:15%" align="center" class="th">Delete</td>
                      </tr>
                      <tr class="row1">
                        <td height="6" colspan="6" align="center" class="borderBtmDashed"></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
					  <td align="center">{$entry.name}</td>
                        <td align="center">{$entry.email}</td>
						<td align="center">{$entry.companyname}</td>
						<td align="center">{$entry.designation}</td>
                        <td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/mailinglistmanagement.php?action=edit&nsid={$entry.nsid|escape}'"  class="btnText"  /> </td>
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.nsid|escape}');"  class="btnText"  /> </td>
                      </tr>
                      {foreachelse}
                      <tr>
                        <td colspan="5">No existing record found</td>
                      </tr>
                      {/foreach}
                      <tr>
                        <td colspan="5" align="center"> {$paging} </td>
                      </tr>                      
                    </table>
          </td>
          
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
                              <li>To Export Subscribers , click the ' Export To CSV ' button.</li>						  
							  <li>To Send Email , click the 'Send Email' button.</li>
							  <li>To View Emaiil History , click the ' History' button.</li>
							  <li>To Add New Subscriber  , click the ' Add' button.</li>
                              <li>To Edit a record, click on the 'Edit' button against the record.</li>
                              <li>To Delete a record, click on the 'Delete' button against the record.</li>
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
        </table>
      </td>      
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
