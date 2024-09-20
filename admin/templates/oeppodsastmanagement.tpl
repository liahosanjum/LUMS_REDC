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

	function deleteconfirmation(oeppodcastcatid)
	{
		if(confirm("Are you sure you want to delete this category?"))
		{
			window.location.href='oeppodcastmanagement.php?action=del&oeppodcastcatid='	+ oeppodcastcatid;
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/oeppodcastmanagement.php?action=submit&mode={$pageview}{if $pageview eq 'edit'}&id={$data.id}{/if}" method="post">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/podcast.gif" alt="" width="48" height="48" /></td>
              <td width="631"><span class="pageTitle"><span class="tableHeader">oeppodcast-Programme Category</span></span><span class="pageTitle1">[{if $pageview eq 'add'}Add{else}Edit{/if} oeppodcast-Programme Category]</span></td>
              <td width="253" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                          Save</a> </td>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/oeppodcastmanagement.php'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />Cancel</a></td>
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
                    <td align="left" colspan="2" class="tipbox"><input type="hidden" name="oeppodcastcatid" value="{$data.oeppodcastcatid|escape}" />                    </td>
                  </tr>
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">Podcast Title:&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="title" class="input" value="{$data.title|escape}"  maxlength="100"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>                 
                    <tr class="row2" height="25">
                    <td align="right" width="19%">Programme Name:&nbsp;</td>
                    <td align="left"><select name="programmename" class="select_class" >
							{foreach from=$pname item='id'}
								<option value="{$id.oepid}">{$id.name}</option>
							{/foreach}
						</select>
						<span class="required">&nbsp;*</span>
                       </td>
                  </tr> 
				  <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top">Upload Video:&nbsp;</td>
                    <td align="left"><input type="file" onkeypress="return false;" name="oepv" size="25"  />
					</td>
					{if $data.oepv ne ''}
						<td width="1%" valign="top">&nbsp;</td>
						 <input type="hidden" name="oepv" value="{$data.oepv}" />
						<td valign="middle"><img src="{$GENERAL.FRONT_IMG_URL}/broucher/thn_{$data.oepv}" width="100" height="70" /></td>
					{/if}                          
                  </tr>
				  <tr class="row2" height="25">
                    <td align="right" width="19%">Enabled :&nbsp;</td>
                    <td align="left"><select class="select_class" name="enabled"><option value="Yes" {if $data.enabled eq 'Yes'} selected="selected"{/if}>Yes</option><option value="No" {if $data.enabled eq 'No'} selected="selected"{/if}>NO</option></select></td>
                  </tr> 
				  <tr><td height="5"></td></tr>
                  					             
				  <tr><td height="5"></td></tr>
                  <tr>
                    <td colspan="2" align="center" valign="top" >
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td>
									  
									</td>
									
								  </tr>
							</table>

        			  </td>
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
                                <li>Fill in the fields and click on Save button</li>
                                <li>To go back to Existing oeppodcast, click Cancel button</li>
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/oeppodcastmanagement.php" method="post">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/podcast.gif" alt="" width="48" height="48" /></td>
              <td width="529"><span class="pageTitle">Programmes Category Manager </span><span class="pageTitle1">[Existing Programmes Category]</span></td>
              <td width="355" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
                       <td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/oeppodcastmanagement.php?action=add&subcatid={$subcatid|escape}&catid={$catid|escape}'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png" /><br/> Add  </a> </td>
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
                        <td style="width:28%" align="center" ><a href="javascript:sortRecords('name',true)" class="th" >Category Name:</a></td>
                        <td align="center" class="th">View Programmes</td>
						<td align="center" class="th">Edit</td>
                        <td align="center" class="th">Delete</td>
						</tr>
                      <tr class="row1">
                        <td height="5" colspan="6" align="center" class="borderBtmDashed"></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td align="center">{$entry.name}</td>
                        <td align="center"><a href="{$GENERAL.BASE_URL_ADMIN}/oeppodcast_programme.php?oeppodcastcatid={$entry.oeppodcastcatid}" class="link_emp">View Programs</a></td>
						<td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/oeppodcastmanagement.php?action=edit&oeppodcastcatid={$entry.oeppodcastcatid|escape}'"  class="btnText"  /> </td>
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.oeppodcastcatid|escape}');"  class="btnText"  /> </td>
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
                              <li>To Add a new record, click the 'Add' button</li>
                              <li>To Edit a record, click on the 'Edit' button against the record</li>
                              <li>To Delete a record, click on the 'Delete' button against the record</li>
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
