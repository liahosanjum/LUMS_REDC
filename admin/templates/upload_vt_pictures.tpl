{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}
{assign var="title" value = $smarty.get.title}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file="$tpl_path/top_header.tpl"}
<link href="{$GENERAL.BASE_URL_ROOT}/css/black-calender.css" rel=stylesheet type="text/css">
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
		
		function submitForm(vtgid)
		{
			document.forms[0].submit();
			<!--window.location.href='upload_vt_pictures.php?vtgid='+vtgid;-->
	}


	function deleteconfirmation(id , gid, title)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href='upload_vt_pictures.php?vtgid='+gid+'&action=del&id='	+ id + "&title=" + title;
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
	 {if $pageview eq "sortcat"}
		  <form action="{$GENERAL.BASE_URL_ADMIN}/upload_vt_pictures.php?vtgid={$smarty.get.vtgid}&title={$title}" method="post" enctype="multipart/form-data" onsubmit="javascript: return SubmitSorting('cat_orders','catids');" >
			<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td height="5" colspan="5" align="center"></td>
					</tr>
					<tr>
					  <td width="10" height="48" align="center">&nbsp;</td>
					  <td width="56"><img src="{$GENERAL.ADMIN_IMG_URL}/icon-48-frontpage.png" alt="" width="48" height="48" /></td>
					  <td width="445"><span class="pageTitle">VT Pictures Order Manager</span></td>
					  <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
						  <table class="toolbar">
							<tbody>
							  <tr>
								<td class="button" id="toolbar-apply"><input type="image" value="submit" name="submit" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/apply.png" class="apply" />
								</td>
								<td class="button" id="toolbar-cancel"><a href="{$GENERAL.BASE_URL_ADMIN}/upload_vt_pictures.php?vtgid={$smarty.get.vtgid}&title={$title}" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />
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
								 <input type="hidden" name="catids" id="catids" />
							</td>
						  </tr>
						  <tr>
							<td align="right">VT Pictures Order:&nbsp;</td>
							<td width="84%" align="left">
							   <table border="0" cellpadding="0" cellspacing="0">
								  <tr>
			 					    <td>	
										<select name="cat_orders" id="cat_orders" class="select_class" multiple="multiple" style="height:120px; width:210px;">
										  {foreach from=$data item="entry"}
											<option value="{$entry.vtpid}">{$entry.imgtitle}</option>
										  {/foreach}
										</select>
									</td>
									<td width="10"></td>
									<td>
									    <img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-upload.png" style="cursor:pointer;" border="0" onclick="MoveOption('cat_orders', 'up')" /><br />
										<img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-download.png" style="cursor:pointer;" border="0" onclick="MoveOption('cat_orders', 'down')" />
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
										<li>To go back to Existing pictures, click Back button</li>
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/upload_vt_pictures.php?vtgid={$smarty.get.vtgid}&action=submit&mode={$pageview}&id={$smarty.get.vtgid}&title={$title}" method="post"  enctype="multipart/form-data">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/gallery1.png" alt="" width="48" height="48" /></td>
              <td width="564"><span class="pageTitle"><span class="tableHeader">Virtual Tours Pictures Manager </span></span><span class="pageTitle1">[{if $pageview eq 'add'}Add{else}Edit{/if} picture in <strong>{$title|capitalize}</strong>]</span></td>
              <td width="320" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/apply.png" style="border:0px;"  /> <br />
                          </a> </td>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/upload_vt_pictures.php?vtgid={$smarty.get.vtgid}&title={$title}'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />Back</a></td>
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
                    <td align="left" colspan="2" class="tipbox">
					<input type="hidden" name="id" value="{$data.id|escape}" />
					<input type="hidden" name="title" value="{$title}" />
					                    </td>
                  </tr>
                 <!-- <tr class="row2">
                    <td width="19%" align="right" valign="top">Title :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="title" class="input" value="{$data.title|escape}"  maxlength="100"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>               
                   <tr><td height="5"></td></tr>-->
				     
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Title :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="imgtitle" id="imgtitle" maxlength="50" value="{$data.imgtitle}" />
                      <span class="required">&nbsp;*</span></td>
                  </tr>               
                  <tr><td height="5"></td></tr>
				   
				  <tr class="row2">
                        <td align="right" valign="top">Image :&nbsp;</td>
                        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr valign="top">
                            <td width="55%"><input type="file" onkeypress="return false;" name="imagefile" size="25"  /><span class="required">&nbsp;*</span><br />(Please upload file of maximum 2mb size.)<br />(Image format jpg,png,jpeg,gif - Minimum Dimensions : 730px x 400px)</td>
                            <td width="1%" valign="top"></td>
							{if $data.old_image ne ''}
							    <td width="1%" valign="top">&nbsp;</td>
								 <input type="hidden" name="old_image" value="{$data.old_image}" />
							    <td valign="middle"><img src="{$GENERAL.FRONT_UPLOAD_URL}/virtualtours/thn_{$data.old_image}" width="100" height="70" />
                                <a href="{$GENERAL.FRONT_UPLOAD_URL}/virtualtours/{$data.old_image}" target="_blank" class="link">view Full size</a></td>
							{/if}                                          
						   </tr>
                        </table></td>
					  </tr>        
					  <tr><td height="5"></td></tr>
				  <!--<tr class="row2" height="25">
                    <td align="right" width="19%">Status :&nbsp;</td>
                    <td align="left"><select class="select_class" name="status"><option value="Active" {if $data.status eq 'Active'} selected="selected"{/if}>Active</option><option value="Inactive" {if $data.status eq 'Inactive'} selected="selected"{/if}>Inactive</option></select></td>
                  </tr> -->
				  <tr><td height="5"></td></tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top">Detail :&nbsp;</td>
                    <td width="81%" align="left"><textarea name="description" rows="10" cols="50" maxlength="50">{$data.description}</textarea>
                      <span class="required">&nbsp;*</span></td>
                  </tr>               
                   <tr><td height="5"></td></tr>
				   				  
				  <tr class="row2" height="25">
                    <td align="right" width="19%"></td>
                    <td align="left"><input type="hidden" name="vtgid" value="{$smarty.get.gid}" /></td>
					<td align="left"><input type="hidden" name="pgid" value="{$smarty.get.pgid}" /></td>
                  </tr> 
				  <tr><td height="5"></td></tr>
                  <tr>
                    <td colspan="2" align="center" valign="top">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td >
									 
									</td>
									<td width="1%"><span class="required">&nbsp </span></td>
								  </tr>
						  </table>

        			  </td>
                    </tr> 
					             
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
                                <li>To go back to Existing Pictures, click Cancel button</li>
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/upload_vt_pictures.php?vtgid={$smarty.get.vtgid}&title={$title}" method="post">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/gallery1.png" alt="" width="48" height="48" /></td>
              <td width="563"><span class="pageTitle"><span class="tableHeader">Virtual Tours Picture</span>s Manager </span><span class="pageTitle1">[Existing Pictures in <strong>{$title|capitalize}</strong>]</span></td>
              <td width="321" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
                      {if $total_cats gt "0"}	
						<td class="button" id="toolbar-apply" ><a href="{$GENERAL.BASE_URL_ADMIN}/upload_vt_pictures.php?vtgid={$smarty.get.vtgid}&action=sortcat&{$entry.vtgid|escape}&title={$title}" class="toolbar"><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-download.png" class="btnText"  /><br />Sort Pictures</a></td>
						{/if}	
					  <td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/upload_vt_pictures.php?vtgid={$smarty.get.vtgid}&action=add&{$entry.vtgid|escape}&title={$title}'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png" /><br/> Add </a> </td>
					  <td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/vtmanagement.php?title={$title}'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/restore_f2.png" /><br/> Back </a> </td>
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
				<input type="hidden" name="title" value="{$title}" />
			</td>
          </tr>
          <tr >
          
          <td width="10" align="center">&nbsp;</td>
          <td width="617" valign="top" class="boderInner2">          
         <table width="100%" border="0"  class="grid">
                      <tr  height="20">
                      <!--  <td style="width:28%" align="center" ><a href="#"  class="th">Title</a><a href="javascript:sortRecords('title',true)" class="th" ></a></td>-->
                       <!-- <td style="width:15%" align="center" ><a href="#"  class="th">View</a></td>-->
						<td style="width:20%" align="center" ><a href="javascript:sortRecords('imagefile',true)"  class="th">Picture Thumbnail</a></td>
						<td style="width:20%" align="center" ><a href="javascript:sortRecords('imgtitle',true)"  class="th">Title</a></td>
						<td style="width:50%" align="center" ><a href="javascript:sortRecords('description',true)"  class="th">Description</a></td>
                        <td align="center" class="th" width="5%">Edit</td>
                        <td align="center" class="th" width="5%">Delete</td>
                      </tr>
                      <tr class="row1">
                        <td height="5" colspan="5" align="center" class="borderBtmDashed"></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <!--<td align="center">{$entry.title}</td>-->
                       <!-- <td align="center"><a href="{$GENERAL.FRONT_IMG_URL}/galleries/{$entry.picture}" target="_blank">View Picture</a></td>-->
						<td align="center"><img src="{$GENERAL.FRONT_UPLOAD_URL}/virtualtours/thn_{$entry.imagefile}" border="0" width="80" height="60" /></td>
						 <td align="center" valign="top">{$entry.imgtitle}</td>
						 <td align="center" valign="top">{$entry.description|strip_tags|truncate:250}</td>
						<td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/upload_vt_pictures.php?vtgid={$smarty.get.vtgid}&action=edit&id={$entry.vtpid|escape}&title={$title}'"  class="btnText"  /> </td>
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.vtpid|escape}' , '{$smarty.get.vtgid}', '{$title}');"  class="btnText"  /> </td>
                        
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
                              <li>To go back to Gallery, click on the 'Back' button </li>
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
