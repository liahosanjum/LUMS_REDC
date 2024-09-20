{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

{include file="$tpl_path/top_header.tpl"}
{literal}
<script type="text/javascript">
function MoveOption(Id ,direction)
    {
        var List=document.forms[0].elements[Id];
		var aryTempSourceOptions = new Array();
       	var SelectedValue = 0;
		
		for (var i = 0; i < List.length; i++) 
		{
            aryTempSourceOptions [i]=List.options[i];
		    if (List.options[i].selected) 
	           SelectedValue= List.options[i].index;

     	}
				//Move UpWard direction 
			if(direction=="up" && SelectedValue >0 )
			{
				List.options.length = 0;
				for (var i = 0; i < aryTempSourceOptions.length;i++) 
				{
					if(i==SelectedValue)
					{
						List.options[i-1]=new Option(aryTempSourceOptions[i].text,aryTempSourceOptions[i].value);
						List.options[i]=new Option(aryTempSourceOptions[i-1].text,aryTempSourceOptions[i-1].value);
						List.options[i-1].selected=i;
					}
					else
					{
						List.options[i]=new Option(aryTempSourceOptions[i].text,aryTempSourceOptions[i].value);
					}
				}
			}
		//Move DownWard direction 
		if(direction=="down" && aryTempSourceOptions.length - 1 > SelectedValue)
		{
			List.options.length = 0;
			for (var i = 0; i < aryTempSourceOptions.length;i++) 
			{
					if(i==SelectedValue)
					{
						List.options[i]=new Option(aryTempSourceOptions[i+1].text,aryTempSourceOptions[i+1].value);
						List.options[i+1]=new Option(aryTempSourceOptions[i].text,aryTempSourceOptions[i].value);
						i++;		
						List.options[i].selected=i;
					}
					else
					{
						List.options[i]=new Option(aryTempSourceOptions[i].text,aryTempSourceOptions[i].value);
					}
			}
		}
			
    }
	
	function SubmitSorting(pageorders, txtorders)
	{
		pageIds = document.getElementById(pageorders);
		txtIds = document.getElementById(txtorders);
		
		if(pageIds != null && txtIds != null)
		{
			for(i =0; i< pageIds.options.length; i++)
			{
				txtIds.value += pageIds.options[i].value + "-";
			}
		}
		return true;
	}
	function sortListing()
		{
			document.forms[0].mode.value = "sort";
			document.forms[0].submit();
		}
		function validateForm()
	{
		return true;
	}

	function isPositiveInteger(val){
		  if (val.length==0){return false;}
		  for (var i = 0; i < val.length; i++) {
				var ch = val.charAt(i)
				if (ch < "0" || ch > "9") {
					return false
				}
		  }
		  return true;
	}
	function selectDropdown(combo, page)
	{	
		var dropdown = document.getElementById(combo);
		if(dropdown != null)
		{
			for(i=0;i<dropdown.options.length;i++)
			{
				if(page == dropdown.options[i].value)
				{
					dropdown.selectedIndex = i;
					break;
				}
			}
		}
	}
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
			window.location.href='homesecmanagement.php?action=del&psid='	+ psid;
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
	  <form action="{$GENERAL.BASE_URL_ADMIN}/homesecmanagement.php?action=submit&mode={$pageview}" method="post" enctype="multipart/form-data">
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
                <td width="657"><span class="pageTitle">Home Page Pictures  Manager </span><span class="pageTitle1">[{if $pageview eq 'add'}Add{else}Edit{/if} Home Page Picture]</span></td>
                <td width="399" align="right" valign="top">
				<div class="toolbar" id="toolbar">
                    <table class="toolbar">
                      <tbody>
                        <tr>
                         <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/apply.png" style="border:0px;"  /> <br />
                              </a> </td>
                          <!--<td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/homesecmanagement.php'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />Back
                            </a></td>-->
							<td class="button" id="toolbar-cancel"><a href="{$GENERAL.BASE_URL_ADMIN}/homesecmanagement.php" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />
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
					     <td width="15%" align="right"> Title :</td>
					     <td width="85%" align="left"><input class="input" name="title" type="text" id="title" value="{$data.title|escape}" maxlength="50" />
				        <span class="required">*</span></td>
				      </tr>
						<tr>
					     <td width="15%" align="right">Sub Title :</td>
					     <td width="85%" align="left"><input class="input" name="subtitle" type="text" id="subtitle" value="{$data.subtitle|escape}" maxlength="50" />
				         </td>
				      </tr>
					  <tr>
					     <td width="15%" align="right">Page Link :</td>
					     <td width="85%" align="left"><input class="input" name="pagelink" type="text" id="pagelink" value="{$data.pagelink|escape}" maxlength="200" />
				         </td>
				      </tr>
					  <tr><td colspan="3" height="5"></td></tr>
					  <tr class="row2">
                        <td align="right" valign="top" > Picture :<span class="required">&nbsp;*</span></td>
						<td align="left" valign="top" colspan="2">
						<input type="file"  onkeypress="return false;" name="filename" id="filename" size="30"/><br />(Please upload file of maximum 2Mb size.)
						</td>
							<td valign="middle">
							{if $data.old_filename ne ''}							
							 <input type="hidden" name="old_filename" value="{$data.old_filename}" />

							<img src="{$GENERAL.FRONT_UPLOAD_URL}/home-pictures/thn_{$data.old_filename}" width="100" height="70" />						
							{/if}
							{if $smarty.get.action eq 'edit'}
                          <a href="{$GENERAL.FRONT_UPLOAD_URL}/home-pictures/{$data.old_filename}" target="_blank" class="link">View full size</a>
							{/if}
                            </td>

					  </tr>
					  <tr class="row2" height="25">
                     <td align="right" width="19%">Enabled :&nbsp;</td>
                      <td align="left"><select class="select_class" name="isactive"><option value="Y" {if $data.isactive eq 'Y'} selected="selected"{/if}>Yes</option><option value="N" {if $data.isactive eq 'N'} selected="selected"{/if}>NO</option></select></td>
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
							    <td valign="middle"><img src="{$GENERAL.FRONT_IMG_URL}/montage_after/thn_{$data.old_after_image}" width="100" height="70" /></td>
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
	{elseif $pageview eq "sorthomesecs"}
		  <form action="{$GENERAL.BASE_URL_ADMIN}/homesecmanagement.php" method="post" enctype="multipart/form-data" onsubmit="javascript: return SubmitSorting('homesec_orders','homesecids');" >
			<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td height="5" colspan="5" align="center"></td>
					</tr>
					<tr>
					  <td width="10" height="48" align="center">&nbsp;</td>
					  <td width="56"><img src="{$GENERAL.ADMIN_IMG_URL}/gallery4.png" alt="" width="48" height="48" /></td>
					  <td width="445"><span class="pageTitle">Home Page Pictures Manager</span></td>
					  <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
						  <table class="toolbar">
							<tbody>
							  <tr>
								<td class="button" id="toolbar-apply"><input type="image" value="submit" name="submit" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/apply.png" class="apply" />
								</td>
								<td class="button" id="toolbar-cancel"><a href="{$GENERAL.BASE_URL_ADMIN}/homesecmanagement.php" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />
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
				<td height="10" class="errorBar">
				   {$error}
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
					<td width="10" align="center">&nbsp;</td>
					  <td width="617" valign="top" class="boderInner2">
					  <table width="98%" border="0" cellspacing="1" cellpadding="1"  class="grid">
						  <tr height="10" >
							<td align="left" colspan="2">
					             <input type="hidden" name="action" value="{$pageview}" />
								 <input type="hidden" name="section_id" value="{$section_data.section_id}" />
								 <input type="hidden" name="homesecids" id="homesecids" />
							</td>
						  </tr>
						  <tr>
							<td align="right">Pictures Order:&nbsp;</td>
							<td width="84%" align="left">
							   <table border="0" cellpadding="0" cellspacing="0">
								  <tr>
			 					    <td>	
										<select name="homesec_orders" id="homesec_orders" class="select_class" multiple="multiple" style="height:120px; width:210px;">
										  {foreach from=$data item="entry"}
											<option value="{$entry.psid}">{$entry.title}</option>
										  {/foreach}
										</select>
									</td>
									<td width="10"></td>
									<td>
									    <img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-upload.png" style="cursor:pointer;" border="0" onclick="MoveOption('homesec_orders', 'up')" /><br />
										<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-download.png" style="cursor:pointer;" border="0" onclick="MoveOption('homesec_orders', 'down')" />
									</td>
							     </tr>
							  </table>	
							</td>
						  </tr>
						  <tr><td height="5"></td></tr>
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
										<li>To move up, select value from list and click on Up button</li>
										<li>To move down, select value from list and click on Down button</li>
										<li>To save orders, click on Apply button</li>
										<li>To go back to Existing Home page Pictures, click Back button</li>
									  </ul>
									</div>
								  </div>
								</div>
							  </div>
							  {literal}
							  <script>
							  TogglePanel('help1');
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
	{else}
	
	 <form action="{$GENERAL.BASE_URL_ADMIN}/homesecmanagement.php" method="post" name="frm_general" id="frm_general">
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
                  <td width="570"><span class="pageTitle">Home Page Pictures  Manager</span> <span class="pageTitle1">[Existing Home Page Pictures &amp; Sections]</span></td>
                  <td width="314" align="right" valign="top">
				<div class="toolbar" id="toolbar">
                    <table class="toolbar">
                      <tr>
					  {if $total_homesecs gt "0"}	
						<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/homesecmanagement.php?action=sorthomesecs" class="toolbar"><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-download.png" class="btnText"  /><br />
						Sort Pictures </a></td>
						{/if}
					  <td class="button" id="toolbar-apply" ><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/homesecmanagement.php?action=add'" class="toolbar"> <img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/homesecmanagement.php?action=add'"  class="btnText"  /> <br />
                           Add</a> </td>
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
                        <td align="center" width="197" ><a href="javascript:sortRecords('title',true)" class="th" >Title </a></td>
						<td align="center" width="197" ><a href="javascript:sortRecords('subtitle',true)" class="th" >Sub Title </a></td>
						<td align="center" class="th" width="20%"><a href="javascript:sortRecords('filename',true)" class="th" >Picture </a></td>
						<td align="center" class="th">Page link </td>
						<td align="center" class="th" width="5%">Edit</td>
						<td align="center" class="th">Delete </td>
						
                      </tr>
                      <tr class="row1">
                        <td height="2" colspan="6" align="center" class="borderBtmDashed"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td align="center" width="197">{$entry.title}</td>
						<td align="center" width="197">{$entry.subtitle}</td>
						<td align="center"><img src="{$GENERAL.FRONT_UPLOAD_URL}/home-pictures/thn_{$entry.filename}" border="0" width="70" height="50" /></td>
						<!--<td align="center">{$GENERAL.BASE_URL_ROOT}/homesecmanagement.php?psid={$entry.psid|escape}&amp;title={$entry.title}</td>-->
						<td align="left" width="107">{$entry.pagelink}</td>
						<td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/homesecmanagement.php?action=edit&psid={$entry.psid|escape}'"  class="btnText"  /> </td>
						<td align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.psid|escape}');"  class="btnText"  /> </td>						
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
																			 <li>To Delete a record, click on the 'Delete' button against the record</li>
																			 <li>To sort Home page pictures, click on the 'Sort Pictures' button</li>
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
