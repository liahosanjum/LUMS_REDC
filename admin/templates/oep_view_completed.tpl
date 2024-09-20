{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file="$tpl_path/top_header.tpl"}
<script language="javascript" src='{$GENERAL.BASE_URL_ROOT}/jscript/jquery.js'></script>
<script language="javascript" src='{$GENERAL.BASE_URL_ROOT}/jscript/jscripts.js'></script>
<script src="{$GENERAL.BASE_URL_ROOT}/jscript/CalendarPopup.js"></script>
<script language="JavaScript">document.write(getCalendarStyles());</script>
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

	function deleteconfirmation(oepid,oepcatid)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href=' oep_view_completedManagement.php?action=del&oepid='+oepid+'&oepcatid='+oepcatid;
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/ oep_view_completedManagement.php?action=submit&mode={$pageview}{if $pageview eq 'edit'}&oepid={$data.oepid}{/if}" method="post"  enctype="multipart/form-data"name="frmadd">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/gallery4.png" alt="" width="48" height="48" /></td>
              <td width="558"><span class="pageTitle"><span class="tableHeader">OEP-Programme Manager</span></span><span class="pageTitle1">[{if $pageview eq 'add'}Add{else}Edit{/if} OEP-Programme]</span></td>
              <td width="326" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                          Save</a> </td>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/ oep_view_completedManagement.php?oepcatid={$oepcatid.oepcatid}'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />Cancel</a></td>
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
                    <td align="left" colspan="2" class="tipbox"><input type="hidden" name="oepid" value="{$data.oepid|escape}" />  </td>
					<td align="left" colspan="2" class="tipbox"><input type="hidden" name="oepcatid" value="{$oepcatid.oepcatid}" /></td>
                  </tr>
                 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top"> Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="name" class="input" value="{$data.name|escape}"  maxlength="100"/>
                      <span class="required">*</span></td>
                  </tr>                 
                    <tr class="row2" height="25">
                    <td align="right" width="19%"> Start Date :&nbsp;</td>
                    <td align="left">
					{literal}
						<script language="JavaScript" id="jscal1x">
						var cal1x = new CalendarPopup("testdiv1");
						</script>
					{/literal}
					<!--<input type="text" name="programme_start_date" class="input" value="{$data.programme_start_date|escape}"  maxlength="100"/><span class="required">&nbsp;*</span></td>!-->
                  <input name="startdate" id="startdate" value="{$data.startdate|escape}" size="25" type="text" onfocus="cal1x.select(document.frmadd.startdate,'startdate','dd-MM-yyyy'); return false;" onclick="cal1x.select(document.frmadd.startdate,'startdate','dd-MM-yyyy'); return false;" class="input" readonly="" />
				   <span class="required">*</span></td>
				  </tr> 
				  <tr class="row2" height="25">
                    <td align="right" width="19%"> End Date :&nbsp;</td>
                    <td align="left">
					{literal}
						<script language="javascript" id="jscallx"
						var cal1x = new CalendarPopup("testdiv2");
						</script>
					{/literal}
					<input name="enddate" id="enddate" value="{$data.enddate|escape}" size="25" type="text" onfocus="cal1x.select(document.frmadd.enddate,'enddate','dd-MM-yyyy'); return false;" onclick="cal1x.select(document.frmadd.enddate,'enddate','dd-MM-yyyy'); return false;" class="input" readonly="" />
					<span class="required">*</span></td>
                  </tr> 
				  <tr class="row2" height="25">
                    <td align="right" width="19%">Application Deadline:&nbsp;</td>
                    <td align="left">
					{literal}
						<script language="JavaScript" id="jscal1x">
						var cal1x = new CalendarPopup("testdiv3");
						</script>
					{/literal}
					<input name="deadline" id="deadline" value="{$data.deadline|escape}" size="25" type="text" onfocus="cal1x.select(document.frmadd.deadline,'deadline','dd-MM-yyyy'); return false;" onclick="cal1x.select(document.frmadd.deadline,' deadline','dd-MM-yyyy'); return false;" class="input" readonly="" />
					<span class="required">*</span></td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="right" width="19%">Venue:&nbsp;</td>
                    <td align="left"><input type="text" name="venue" class="input" value="{$data.venue|escape}"  maxlength="100"/><span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top">Inroduction:&nbsp;</td>
                    <td align="left"><textarea name="introduction" cols="29" rows="4" >{$data.introduction|escape}</textarea>
					</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top"> Objective:&nbsp;</td>
                    <td align="left"><textarea name="programme_objective" cols="29" rows="4" >{$data.programme_objective|escape}</textarea>
					</td>
                  </tr> 
				  <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top"> Curriculum:&nbsp;</td>
                    <td align="left"><textarea name="curriculum" cols="29" rows="4">{$data.curriculum|escape}</textarea>
					</td>
                  </tr> 
				  <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top"> Participants:&nbsp;</td>
                    <td align="left"><textarea name="participents" cols="29" rows="4" value="">{$data.participents|escape}</textarea>
					</td>
                  </tr> 
				  <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top">Learning Model:&nbsp;</td>
                    <td align="left"><textarea name="learningmodel" cols="29" rows="4" value="">{$data.learningmodel|escape}</textarea>
					</td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top">Faculty/Director:&nbsp;</td>
                    <td align="left"><textarea name="faculty" cols="29" rows="4">{$data.faculty|escape}</textarea>
					</td>
                  </tr> 
				  <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top">Testimonial:&nbsp;</td>
                    <td align="left"><textarea name="testimonials" cols="29" rows="4">{$data.testimonials|escape}</textarea>
					</td>
                  </tr> 
				   <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top">Fee And Condition:&nbsp;</td>
                    <td align="left"><textarea name="feecondition" cols="29" rows="4" >{$data.feecondition|escape}</textarea>
					<span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr class="row2" height="25">
                    <td align="right" width="19%" valign="top">Broucher:&nbsp;</td>
                    <td align="left"><input type="file" onkeypress="return false;" name="oepimage" size="25"  />
					</td>
					{if $data.old_image ne ''}
						<td width="1%" valign="top">&nbsp;</td>
						 <input type="hidden" name="old_image" value="{$data.old_image}" />
						<td valign="middle"><img src="{$GENERAL.FRONT_IMG_URL}/broucher/thn_{$data.old_image}" width="100" height="70" /></td>
					{/if}                          
                  </tr>
			      <tr><td height="5"></td></tr>
				  <tr><td height="5"></td></tr>
				   <tr class="row2" height="25">
                    <td align="right" width="19%">Completed :&nbsp;</td>
                    <td align="left"><select class="select_class" name="iscompleted"><option value="Y" {if $data.iscompleted eq 'Y'} selected="selected"{/if}>Yes</option><option value="N" {if $data.iscompleted eq 'N'} selected="selected"{/if}>NO</option></select></td>
                  </tr> 
				  <tr class="row2" height="25">
                    <td align="right" width="19%">Active :&nbsp;</td>
                    <td align="left"><select class="select_class" name="isactive"><option value="Yes" {if $data.isactive eq 'Yes'} selected="selected"{/if}>Yes</option><option value="No" {if $data.isactive eq 'No'} selected="selected"{/if}>NO</option></select></td>
                  </tr> 
				  <tr><td height="5"></td></tr>
                  <tr>
                    <td colspan="2" align="center" valign="top" class="boderInner2">
						 
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
                                <li>To go back to Existing gallery, click Cancel button</li>
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/ oep_view_completedManagement.php" method="post" >
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/gallery4.png" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle">OEP-Programme Manager </span><span class="pageTitle1">[Existing OEP-Programme]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
                      <td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/ oep_view_completedManagement.php?action=add&oepcatid={$oepcatid.oepcatid}'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png" /><br/> Add </a> </td>
                      <td class="button" id="toolbar-cancel"><a href="{$GENERAL.BASE_URL_ADMIN}/oepmanagement.php" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /><br /> Back </a></td>
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
				<td align="left" colspan="2" class="tipbox"><input type="hidden" name="oepcatid" value="{$oepcatid.oepcatid}" /></td>
			</td>
          </tr>
          <tr>
			<td colspan="5" align="left">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:7px;">
				<tr>
				<td class="th" width="122" style="padding-left:12px; padding-top:5px;">Programme Name:</td>
				<td  width="20" style="padding-left:7px; padding-top:5px;"><input type="text" name="search_by_name" class="input" value="{$formvars.search_by_name}"  maxlength="100"/></td>
				<td style="padding-left:7px; padding-top:5px;"><input class="grid" type="button" name="Submit" value="Search" onclick="javascript: submitForm();"  /></td>
				</tr>
				</table>
			</td>
			</tr>
		  <tr >
          <td width="10" align="center">&nbsp;</td>
          <td width="617" valign="top" class="boderInner2">          
         <table width="100%" border="0"  class="grid">
                      <tr  height="20">
                        <td style="width:28%" align="center" ><a href="javascript:sortRecords('name',true)" class="th" >Programme Name</a></td>
                        <td style="width:15%" align="center" ><a href="javascript:sortRecords('startdate',true)"  class="th"> Start Date</a></td>
						<td style="width:15%" align="center" ><a href="javascript:sortRecords('Venue',true)"  class="th">Venue</a></td>
						<td style="width:15%" align="center" ><a href="javascript:sortRecords('isactive',true)"  class="th">Active</a></td>
						<td align="center" class="th">Edit</td>
                        <td align="center" class="th">Delete</td>
						 </tr>
                      <tr class="row1">
                        <td height="5" colspan="6" align="center" class="borderBtmDashed"></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td align="center">{$entry.name}</td>
                        <td align="center">{$entry.startdate}</td>
						<td align="center">{$entry.venue}</td>
						<td align="center">{$entry.isactive}</td>
                       <td align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/ oep_view_completedManagement.php?action=edit&oepid={$entry.oepid}&oepcatid={$oepcatid.oepcatid}'"  class="btnText"  /> </td>
                       <!-- <td align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.id|escape},{$category.category_id}');"  class="btnText"  /> </td>-->
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.oepid}','{$oepcatid.oepcatid}');"  class="btnText"  /> </td>
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
   <DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv2" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
   <DIV ID="testdiv3" STYLE="position:absolute;visibility:hidden;background-color:#FBFBFB;layer-background-color:#FBFBFB;"></DIV>
</table>
</body>
</html>
