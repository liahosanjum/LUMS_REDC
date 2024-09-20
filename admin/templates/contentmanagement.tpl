{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

{include file="$tpl_path/top_header.tpl"}

{literal}

<script type="text/javascript">
      
  	   function ismaxlength(obj)
	   {
			var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
			if (obj.getAttribute && obj.value.length>mlength)
			obj.value=obj.value.substring(0,mlength)
		}

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
		
//		alert(txtIds.value);return false;
		return true;
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
		
	function deleteconfirmation(id,section_id)
	{
		if(confirm("Are you sure you want to delete this page?"))
		{
			window.location.href='contentmanagement.php?action=del&id='+id+'&section_id='+section_id;
		}	
	}

		function submitForm()
		{
			document.forms[0].submit();
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
      {if $pageview eq "sortpages"}
		  <form action="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php" method="post" enctype="multipart/form-data" onsubmit="javascript: return SubmitSorting('page_orders','pageids');" >
			<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td height="5" colspan="5" align="center"></td>
					</tr>
					<tr>
					  <td width="10" height="48" align="center">&nbsp;</td>
					  <td width="56"><img src="{$GENERAL.ADMIN_IMG_URL}/icon-48-frontpage.png" alt="" width="48" height="48" /></td>
					  <td width="524"><span class="pageTitle">{$section_data.sectionname} Manager</span> <span class="pageTitle1">[ Existing CMS Pages ]</span></td>
					  <td width="360" align="right" valign="top"><div class="toolbar" id="toolbar">
						  <table class="toolbar">
							<tbody>
							  <tr>
								<td class="button" id="toolbar-apply"><input type="image" value="submit" name="submit" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/apply.png" class="apply" />
								</td>
								<td class="button" id="toolbar-cancel"><a href="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php?section_id={$section_data.psid}" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />
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
								 <input type="hidden" name="section_id" value="{$section_data.psid}" />
								 <input type="hidden" name="pageids" id="pageids" />
							</td>
						  </tr>
						  <tr>
							<td align="right">Page Orders:&nbsp;</td>
							<td width="84%" align="left">
							   <table border="0" cellpadding="0" cellspacing="0">
								  <tr>
			 					    <td>	
										<select name="page_orders" id="page_orders" class="select_class" multiple="multiple" style="height:120px; width:210px;">
										  {foreach from=$data item="entry"}
											<option value="{$entry.pcid}">{$entry.pagename}</option>
										  {/foreach}
										</select>
									</td>
									<td width="10"></td>
									<td>
									    <img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-upload.png" style="cursor:pointer;" border="0" onclick="MoveOption('page_orders', 'up')" /><br />
										<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-download1.png" style="cursor:pointer;" border="0" onclick="MoveOption('page_orders', 'down')" />
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
										<li>To go back to Existing Pages, click Back button</li>
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
	  {elseif $pageview eq "add" or $pageview eq "edit"}
      <!--- content area form --->
      <form action="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php?action=submit&mode={$pageview}{if $pageview eq 'edit'}{/if}" $pageview method="post" enctype="multipart/form-data" >
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
                <tr>
                  <td width="10" height="48" align="center">&nbsp;</td>
                  <td width="56"><img src="{$GENERAL.ADMIN_IMG_URL}/icon-48-frontpage.png" alt="" width="48" height="48" /></td>
                  <td width="524"><span class="pageTitle">{$section_data.sectionname} Manager</span><span class="pageTitle1">[{if $pageview eq 'add'} Add{else} Edit{/if} New CMS Page ]</span></td>
                  <td width="360" align="right" valign="top"><div class="toolbar" id="toolbar">
                      <table class="toolbar">
                        <tbody>
                          <tr>
                            <td class="button" id="toolbar-apply"><input type="image" value="submit" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/apply.png" class="apply" />
                            </td>
                            <td class="button" id="toolbar-cancel"><a href="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php?section_id={$section_data.psid}" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />
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
							<input type="hidden" name="id" value="{$data.id}" />
							<input type="hidden" name="section_id" value="{$section_data.psid}" />
						</td>
                      </tr>
                      <tr>
                        <td align="right">Page Name:&nbsp;</td>
                        <td width="80%" align="left">
						<input type="text" name="pagename" class="input_large" value="{$data.pagename}" maxlength="100" {if $smarty.get.section_id eq '0'and $pageview eq 'edit'} readonly="true"{/if} />
                          <span class="required">*</span></td>
                      </tr>
					  <tr><td height="5"></td></tr>
					  <tr>
                        <td align="right">Page Title:&nbsp;</td>
                        <td align="left">
						<input type="text" name="pagetitle" class="input_large" value="{$data.pagetitle}" maxlength="100" />
                          <span class="required">*</span></td>
                      </tr>
					  <tr><td height="5"></td></tr>
					  <tr>
                        <td align="right">Explorer Title:&nbsp;</td>
                        <td align="left">
						<input type="text" name="explorertitle" class="input_large" value="{$data.explorertitle}" maxlength="100" />
                          <span class="required">*</span></td>
                      </tr>
					  <tr><td height="5"></td></tr>
					  <tr>
                        <td align="right">Menu Title:&nbsp;</td>
                        <td align="left">
						<input type="text" name="menu_title" class="input_large" value="{$data.menu_title}" maxlength="100" />
                          <span class="required">*</span></td>
                      </tr>
					  <tr><td height="5"></td></tr>
					  <tr>
                        <td align="right">Visible:&nbsp;</td>
                        <td align="left">
						    <select name="visible" id="visible" class="select_class_large">
						         <option value="Yes">Yes</option>
								 <option value="No" {if $data.visible eq "No"}selected="selected"{/if}>No</option>
							</select>
						</td>
                      </tr>
					  <tr><td colspan="2" height="5"></td></tr>
					  <tr>
					    <td align="right">Details:</td>
					    <td align="left"></td></tr>
					  <tr>
                        <td align="center" colspan="2" class="boderInner2">
						 {php}
							$oFCKeditor = new FCKeditor('content') ;
							$oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
							$oFCKeditor->ToolbarSet = 'Default' ;
							$oFCKeditor->Width		= '100%';
							$oFCKeditor->Height		= '600px';
							$oFCKeditor->Value		= $this->_tpl_vars['data']['pagecontent'];
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
                                    <li>To go back to Existing Pages, click Cancel button</li>
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
					  <tr>
					     <td>
						  <div id="content-pane"  class="pane-sliders">
                             <div class="panel"> <a href="Javascript:TogglePanel('meta_info');">
                               <h3 class="moofx-toggler title moofx-toggler-down"><span>Meta Information</span></h3></a>
                              <div style="overflow: hidden; display: block; visibility: visible;  height: 1%;" class="normalTxt">
                                <div style="padding: 5px;" id="meta_info">
                                  <table width="99%" align="center" border="0" cellpadding="0" cellspacing="0">
								           <tr><td height="5"></td></tr>
											  <tr>
												 <td class="grid">
													Keywords :
												 </td>
											  </tr>
											  <tr>
												<td><textarea maxlength='300' name="keywords" class="txtArea" onkeyup="return ismaxlength(this)">{$data.keywords}</textarea></td>
											  </tr>
											  <tr><td height="5"></td></tr>
											  <tr>
												 <td class="grid">
													Description :
												 </td>
											  </tr>
											  <tr>
												<td><textarea maxlength='300' name="description" class="txtArea" onkeyup="return ismaxlength(this)">{$data.description}</textarea></td>
											  </tr>
								  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          {if $data.keywords eq "" && $data.description eq ""}
							  {literal}
							  <script>
							  //TogglePanel('meta_info');
							  </script>
							  {/literal}
						  {/if}
						 </td>
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
      <form action="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php" method="post">
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
                <tr>
                  <td width="10" height="48" align="center">&nbsp;</td>
                  <td width="56"><img src="{$GENERAL.ADMIN_IMG_URL}/icon-48-frontpage.png" alt="" width="48" height="48" /></td>
                  <td width="524"><span class="pageTitle">{$section_data.sectionname} Manager </span><span class="pageTitle1">[ Existing CMS Pages ]</span></td>
                  <td width="360" align="right" valign="top"><div class="toolbar" id="toolbar">
					<table class="toolbar">
						<tr>
        	                <td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php?action=add&section_id={$section_data.psid}" class="toolbar"><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png" class="btnText"  /><br />Add</a></td>
						{if $total_page gt "0" and $section_data.sectionname ne "Others"}	
							<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php?action=sortpages&section_id={$section_data.psid}" class="toolbar"><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-download.png" class="btnText"  /><br />Sort Pages</a></td>
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
				    <input type="hidden" name="sortcolumn" value="{$sortcolumn}" />
                    <input type="hidden" name="sortdirection" value="{$sortdirection}" />
					<input type="hidden" name="section_id" value="{$section_data.psid}" />
                  </td>
                </tr>
                <td width="10" align="center">&nbsp;</td>
                  <td width="100%" valign="top" class="boderInner2"><table width="100%" border="0"  class="grid">
                      <tr  height="20">
                        <td align="center" ><a href="javascript:sortRecords('pagename',true)" class="th" >Page Name</a></td>
                        <td align="center" ><a href="javascript:sortRecords('pagetitle',true)" class="th" >Page Title</a></td>
						<td align="center" ><a href="javascript:sortRecords('visible',true)" class="th" >Visible</a></td>
						{if $section_data.sectionname eq 'Others'} 
						<td align="center" >Link</td>
						{/if}
					    <td align="center" class="th">Edit</td>
                        <td align="center" class="th">Delete</td>
                     </tr>
                      <tr>
                        <td height="2" colspan="6" align="center" class="borderBtmDashed"></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td align="center">{$entry.pagename}</td>
                        <td align="center">{$entry.pagetitle}</td>
						<td align="center">{$entry.visible}</td>
						{if $section_data.sectionname eq 'Others'} 
							{if $entry.pagename eq 'Site Map'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/site_map.php</td>
							{elseif $entry.pagename eq 'Programme Finder'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/prog_finder.php</td>
							{elseif $entry.pagename eq 'Open Enrollment Programme'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/oep_programme.php?section_id=0&pcid={$entry.pcid}</td>
							{elseif $entry.pagename eq 'Organisation Focused Programmes'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/ofp_programme.php?section_id=0&pcid={$entry.pcid}</td>
							{elseif $entry.pagename eq 'Programme'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/programme.php?section_id=0&pcid={$entry.pcid}</td>
							{elseif $entry.pagename eq 'Virtual Tour'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/virtualtour.php</td>
							{elseif $entry.pagename eq 'Search'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/search.php</td>
							{elseif $entry.pagename eq 'News and Events'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/news.php</td>
							{elseif $entry.pagename eq 'FAQs'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/faq.php</td>
							{elseif $entry.pagename eq 'Faculty Directory'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/faculty_profiles.php?section_id=4</td>
							{elseif $entry.pagename eq 'Map Direction'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/map_direction.php</td>
							{elseif $entry.pagename eq 'Quick Links'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/quick_links.php</td>
							{elseif $entry.pagename eq 'Enrollment'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/enrollment.php?section_id=0&pcid={$entry.pcid}</td>
							{elseif $entry.pagename eq 'Alumni'}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/alumni.php?section_id=0&pcid={$entry.pcid}</td>
							{else}
							<td align="center" >{$GENERAL.BASE_URL_ROOT}/cms.php?section_id=0&pcid={$entry.pcid}</td>
							{/if}
						{/if}
					    <td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='contentmanagement.php?action=edit&id={$entry.pcid}&section_id={$section_data.psid}'"  class="btnText"  /> </td>
						
                        <td align="center">
						{if $entry.isdynamic eq 'Y'} 
						<img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation({$entry.pcid},{$section_data.psid});"  class="btnText"  />
						{/if}
						</td>

                      </tr>
					  {/foreach}
                      <tr>
					      <td colspan="6" align="center">{$paging}</td>
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
										<li>To Add a new record, click the 'Add' button</li>
										<li>To Edit a record, click on the 'Edit' button against the record</li>
										<li>To Delete a record, click on the 'Delete' button against the record</li>
										<li>To Sort pages , click on the 'Sort pages' button </li>
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
    {/if}</td>
  {include file="$tpl_path/footer.tpl"}
</table>
</body>
</html>
