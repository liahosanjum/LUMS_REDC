{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administrative Area</title>
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
			if(document.forms[0].month != undefined)
			{
				if(validateForm())
				{
					document.forms[0].submit();
				}
			}
			else
			{
				document.forms[0].submit();
			}
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

	function deleteconfirmation(itemid)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href='testimonialmanagement.php?action=del&id='	+ itemid;
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
	function selectCountry(page)
	{	
		for(i=0;i<document.forms[0].countryid.options.length;i++)
		{
			if(page == document.forms[0].countryid.options[i].value)
			{
				document.forms[0].countryid.selectedIndex = i;
				break;
			}
		}
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
  </script>
{/literal}
</head>
<body>
<table width="991" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15"> {include file="$tpl_path/header.tpl" title=header} </td>
  </tr>
  <tr>
    <td height="15" class="boder"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" /></td>
  </tr>
  <tr>
    <td class="boder"> {* Smarty *}
	{if $pageview eq "sorttestimonials"}
		  <form action="{$GENERAL.BASE_URL_ADMIN}/testimonialmanagement.php" method="post" enctype="multipart/form-data" onsubmit="javascript: return SubmitSorting('testimonial_orders','testimonialids');" >
			<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td height="5" colspan="5" align="center"></td>
					</tr>
					<tr>
					  <td width="10" height="48" align="center">&nbsp;</td>
					  <td width="56"><img src="{$GENERAL.ADMIN_IMG_URL}/icon-48-frontpage.png" alt="" width="48" height="48" /></td>
					  <td width="445"><span class="pageTitle">Testimonial Manager</span></td>
					  <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
						  <table class="toolbar">
							<tbody>
							  <tr>
								<td class="button" id="toolbar-apply"><input type="image" value="submit" name="submit" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/apply.png" class="apply" />
								</td>
								<td class="button" id="toolbar-cancel"><a href="{$GENERAL.BASE_URL_ADMIN}/testimonialmanagement.php" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />
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
								 <input type="hidden" name="testimonialids" id="testimonialids" />
							</td>
						  </tr>
						  <tr>
							<td align="right">Testimonials Order:&nbsp;</td>
							<td width="84%" align="left">
							   <table border="0" cellpadding="0" cellspacing="0">
								  <tr>
			 					    <td>	
										<select name="testimonial_orders" id="testimonial_orders" class="select_class" multiple="multiple" style="height:120px; width:210px;">
										  {foreach from=$data item="entry"}
											<option value="{$entry.item_id}">{$entry.name} - {$entry.location}</option>
										  {/foreach}
										</select>
									</td>
									<td width="10"></td>
									<td>
									    <img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-upload.png" style="cursor:pointer;" border="0" onclick="MoveOption('testimonial_orders', 'up')" /><br />
										<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-download.png" style="cursor:pointer;" border="0" onclick="MoveOption('testimonial_orders', 'down')" />
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
										<li>To go back to Existing Testimonials, click Back button</li>
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
	 {elseif $pageview eq "add" or $pageview eq "edit"}
      <!--- content area form --->
      <form action="testimonialmanagement.php?action=submit&mode={$pageview}{if $pageview eq 'edit'}{/if}" $pageview method="post"  enctype="multipart/form-data">
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
                <tr>
                  <td width="10" height="48" align="center">&nbsp;</td>
                  <td width="56" valign="top"><img src="images/header/icon-48-article.png" alt=" " width="48" height="48" /></td>
                  <td width="445"><span class="pageTitle"><span class="tableHeader">Testimonial </span> Manager </span><span class="pageTitle1">[{if $pageview eq 'add'}Add{else}Edit{/if} Testimonial ]</span></td>
                  <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                      <table class="toolbar">
                        <tbody>
                          <tr>
                            <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="images/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                              Save</a> </td>
                            <td class="button" id="toolbar-cancel"><a href="javascript:location.href='testimonialmanagement.php'" class="toolbar"><img src="images/toolbar/icon-32-cancel.png" border="0" alt=" " /> <br />
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
            <td height="10"><img src="images/blank.jpg" alt=" " width="1" height="1" /></td>
          </tr>
          {if $error ne ""}
          <tr id="errorbox">
            <td height="10" class="errorBar" id="errorBar"> {if $error eq "title_empty"}You must supply a title.
              {elseif $error eq "alttext_empty"} You must supply a alternative text.
			  {elseif $error eq "link_empty"} You must supply a url.
			   {elseif $error eq "type_empty"} You must supply a advertisement type.
              {elseif $error eq "file_empty"}  You must supply a video file.
			  {else}
			  {$error}
              {/if} </td>
          </tr>
          <tr>
            <td height="10"><img src="images/blank.jpg" alt=" " width="1" height="1" /></td>
          </tr>
		  {else}
		  <tr id="errorbox" style="display:none">
		  	<td>
				<table width="100%" cellpadding="0" cellspacing="0">
				  <tr>
					<td height="10" class="errorBar" id="errorBar"></td>
				  </tr>
				  <tr>
					<td height="10"><img src="images/blank.jpg" alt=" " width="1" height="1" /></td>
				  </tr>
				</table>
          {/if}
          <tr>
            <td class="boderInner2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10" colspan="5" align="center"></td>
                </tr>
                <tr>
                  <td width="10" align="center">&nbsp;</td>
                  <td width="617" valign="top" class="boderInner2">
				  <table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">

                      <tr height="25" >
                        <td align="left" colspan="2" class="tipbox">
						<input type="hidden" name="item_id" value="{$data.item_id|escape}" />	
						<!--<input type="hidden" name="oepid" value="{$data.oepid|escape}" />-->
						</td>
                      </tr>
					  <tr class="row2">
                    <td width="19%" align="right" valign="top">Programme Name :&nbsp;</td>
                    <td width="81%" align="left"><select name="oepid" class="select_class" >
							{foreach from=$pname item='id'}
								{if $data.oepid eq $id.oepid}
									<option value="{$id.oepid}" selected="selected">{$id.name}</option>
								{else}
									<option value="{$id.oepid}">{$id.name}</option>
								{/if}	
								
							{/foreach}
						</select>
						<span class="required">&nbsp;</span>
                     </td>
                  </tr>
				  		<tr class="row2">
                    <td width="29%" align="right" valign="top"> Author :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="author" class="input" value="{$data.author|escape}"  maxlength="50"/>
                      <span class="required"></span></td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="right" width="19%">Enabled:&nbsp;</td>
                    <td align="left">
					<select class="select_class" name="is_active"><option value="Y" {if $data.is_active eq 'Y'} selected="selected"{/if}>Yes</option><option value="N" {if $data.is_active eq 'N'} selected="selected"{/if}>No</option></select>
					</td>
                  </tr>
					   <tr class="row2" height="25">
                    <td align="left" colspan="2" valign="top">Details :&nbsp;</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="left" colspan="2">
                    {php}
                        $oFCKeditor = new FCKeditor('details') ;
                        $oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
                        $oFCKeditor->ToolbarSet = 'Default' ;
                        $oFCKeditor->Width		= '100%';
                        $oFCKeditor->Height		= '300px';
                        $oFCKeditor->Value		= $this->_tpl_vars['data']['details'];
                        $oFCKeditor->Create() ;
                      {/php}
                    <!--<textarea name="introduction" id="introduction" class="txtArea" onkeyup="return ismaxlength(this)" maxlegth="1000">{$data.introduction|escape}</textarea>-->
					</td>
                  </tr>
					   <!--<tr class="row1">
                        <td align="right" valign="top">Active:&nbsp;</td>
                        <td width="84%" align="left">
							<input type="checkbox" id="is_active" name="is_active" {if $data.is_active eq 'Y'} checked="checked"{/if} />
                        </td>
                      </tr>-->
					   <tr class="row1">
                        <td valign="top" align="right">&nbsp;</td>
                        <td align="left">&nbsp;</td>
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
                                    <li>Fill in the following fields and click on Save button</li>
                                    <li>To go back to Existing Testimonial , click Cancel button</li>
                                    <li>Fields marked with * are required</li>
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
      <!--- content area  --->
      {else}
 <form action="testimonialmanagement.php" method="post">
       <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1">
		  <table width="960" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" colspan="5" align="center">
				<input type="hidden" name="sortcolumn" value="{$sortcolumn}" />
                <input type="hidden" name="sortdirection" value="{$sortdirection}" />
				<input type="hidden" name="mode" value="" />
				</td>
              </tr>
              <tr>
                <td width="10" height="48" align="center">&nbsp;</td>
                <td width="56" valign="top"><img src="images/header/icon-48-article.png" alt=" " width="48" height="48" /></td>
                  <td width="445"><span class="pageTitle">Testimonial   Manager </span><span class="pageTitle1">[Existing Testimonials]</span></td>
                  <td width="439" align="right" valign="top">
				<div class="toolbar" id="toolbar">
                    <table class="toolbar">
                      <tr>
					  	{if $total_testimonials gt "0"}	
						<!--<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/testimonialmanagement.php?action=sorttestimonials" class="toolbar"><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-download.png" class="btnText"  /><br />Sort Testimonials</a></td>-->
						{/if}	
<!--					  	<td class="button" id="toolbar-apply"><a href="javascript:sortListing();" class="toolbar"> <img  value="Add" src="images/toolbar/icon-32-save.png" style="border:0px;"  /> <br />Save Sorting</a> </td>-->
                        <td class="button" id="toolbar-apply" ><a href="javascript:location.href='testimonialmanagement.php?action=add'" class="toolbar"> <img  border="0" type="image" src="images/toolbar/icon-32-new.png"  onclick="javascript:location.href='testimonialmanagement.php?action=add'"  class="btnText"  /> <br />
                          Add </a> </td>
                      </tr>
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
        <td height="10"><img src="images/blank.jpg" alt=" " width="1" height="1" /></td>
      </tr>
		  {if $error ne ""}
          <tr>
            <td height="10" class="errorBar"> {$error} </td>
          </tr>
          <tr>
            <td height="10"><img src="images/blank.jpg" alt=" " width="1" height="1" /></td>
          </tr>
          {/if}
      <tr>
        <td class="boderInner2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10" colspan="5" align="center"></td>
            </tr>
          <tr >
            <td width="10" align="center">&nbsp;</td>
            <td width="617" valign="top" class="boderInner2">
	<table width="100%" border="0"  class="grid">
                      <tr  height="20">
                        <td style="width:68%" align="left" ><a href="javascript:sortRecords('name',true)" class="th" >Programme</a></td>
						<td style="width:15%" align="left" ><a href="javascript:sortRecords('is_active',true)" class="th" >Active</a></td>
						<!--<td style="width:20%" align="left" ><a href="javascript:sortRecords('sort_index',true)" class="th" >Sort Index</a></td>-->
                        <td align="center" ><a href="#" class="th">Edit</a></td>
                        <td align="center"><a href="#" class="th">Delete</a></td>
                      </tr>
                      <tr class="row1">
                        <td height="2" colspan="6" align="center" class="borderBtmDashed"><img src="images/blank.jpg" alt=" " width="1" height="1" /></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td > {$entry.name|escape}</td>
						<td > {if $entry.is_active eq 'Y'}Yes{else}No{/if}</td>
						<!--<td > 
						<input type="text" name="sort_index[]" value="{if $entry.sort_index ne ''}{$entry.sort_index}{else}0{/if}" class="input" style="text-align:center; width:30px" maxlength="4" />
						<input type="hidden" name="item_id[]" value="{$entry.item_id}" />
						</td>-->
                        <td valign="top" align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="images/toolbar/edit_s.png"  onclick="javascript:location.href='testimonialmanagement.php?action=edit&id={$entry.item_id|escape}'"  class="btnText"  /> </td>
                        <td valign="top" align="center"><img  style="border:0; cursor:pointer" type="image" src="images/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.item_id|escape}');"  class="btnText"  /> </td>
                      </tr>
                      {foreachelse}
                      <tr>
                        <td colspan="7">No existing Testimonial  found</td>
                      </tr>
                      {/foreach}
                      <tr>
                        <td colspan="7" align="center"> {$paging} </td>
                      </tr>
                      <tr class="row1">
                        <td colspan="7" align="right">&nbsp;</td>
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
								    <li>To sort testimonials, click 'Sort Testimonials' button </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                          {literal}
                          <script>
						  TogglePanel('help5');
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
  </tr>
{include file="$tpl_path/footer.tpl"}
</table>
</body>
</html>
