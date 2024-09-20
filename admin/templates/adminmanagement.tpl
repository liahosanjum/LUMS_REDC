{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file="$tpl_path/top_header.tpl"}
<link href="{$GENERAL.BASE_URL_ROOT}/css/black-calender.css" rel=stylesheet type="text/css">

<script language="javascript" src='{$GENERAL.BASE_URL_ROOT}/jscript/jquery.js'></script>
<script language="javascript" src='{$GENERAL.BASE_URL_ROOT}/jscript/jscripts.js'></script>

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

	function deleteconfirmation(id)
	{
		if(confirm("Are you sure you want to delete this Administrator?"))
		{
			window.location.href='adminmanagement.php?action=del&id='	+ id;
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/adminmanagement.php?action=submit&mode={$pageview}{if $pageview eq 'edit'}&id={$data.user_id}{/if}" method="post"  enctype="multipart/form-data">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/header/icon-48-article.png" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle"><span class="tableHeader">Admin</span> Account Manager </span><span class="pageTitle1">[{if $pageview eq 'add'}Add{else}Edit{/if} Admin]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-save.png" style="border:0px;"  /> <br />
                          Save</a> </td>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/adminmanagement.php'" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-cancel.png" border="0" alt="" /> <br />Cancel</a></td>
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
              <td width="647" valign="top" class="boderInner2"><table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                  <tr height="25" >
                    <td align="left" colspan="2" ><input type="hidden" name="id" value="{$data.id|escape}" /></td>
                  </tr>
					 <tr><td height="5"></td></tr>
					  <!--<tr>
					     <td align="right" valign="middle">Title:&nbsp; </td>
					     <td align="left">
						 	<select name="title" style="width:175px; color:#666666;" class="select_class_large">
								<option value="Mr." {if $data.title eq 'Mr.'} selected="selected" {/if}>Mr.</option>
								<option value="Ms." {if $data.title eq 'Ms.'} selected="selected" {/if}>Ms.</option>
								<option value="Mrs." {if $data.title eq 'Mrs.'} selected="selected" {/if}>Mrs.</option>
							</select>
				         <span class="required">*</span></td>
				      </tr>			-->		  
					  <tr><td height="5"></td></tr>
					   <tr>
					     <td align="right">Select Role:&nbsp;</td>
					     <td align="left">
						 <select name="user_type" id="user_type" style="width:175px; color:#666666;" class="select_class_large">
						 	<option value="A" {if $data.user_type eq 'A'} selected="selected" {/if}>Main Administrator</option>
							<option value="M" {if $data.user_type eq 'M'} selected="selected" {/if}>Marketing Administrator</option>
							<option value="C" {if $data.user_type eq 'C'} selected="selected" {/if}>Conference Services Administrator</option>
						 </select>
						 </td>
				      </tr>		
					   <tr>
					     <td align="right">First Name:&nbsp; </td>
					     <td align="left"><input class="input" name="first_name" type="text" id="first_name" value="{$data.first_name|escape}" size="30" maxlength="20" />
				         <span class="required">*</span></td>
				      </tr>					  
					 <tr><td height="5"></td></tr>
					  <tr>
					     <td align="right">Last Name:&nbsp; </td>
					     <td align="left"><input class="input" name="last_name" type="text" id="last_name" value="{$data.last_name|escape}" size="30" maxlength="20" />
				         <span class="required">*</span></td>
				      </tr>	
					   <tr><td height="5"></td></tr>
					  <tr>
					     <td align="right">User Name:&nbsp; </td>
					     <td align="left"><input class="input" name="username" type="text" id="username" value="{$data.username|escape}" size="30" maxlength="20" />
				         <span class="required">*</span></td>
				      </tr>			
					  				  
				  <!--<tr><td colspan="2" height="5"></td></tr>
                  <tr class="row2">
                    <td  align="right">User Name :&nbsp;</td>
                    <td  align="left">
					         <table border="0" cellpadding="0" cellspacing="0">
							       <tr>
								      <td>
									  	<input class="input" name="username" type="text" id="username" {if $smarty.request.action eq 'edit' || $smarty.request.mode eq 'edit' }readonly="yes" style="background-color:#EEEEEE;"{/if} value="{$data.username|escape}" size="30" maxlength="25" />&nbsp;{if $pageview eq 'add'}<span class="required">*</span>{/if}
									 </td>
								   </tr>
							 </table>
					</td>
                  </tr>   -->
				  <tr><td colspan="2" height="5"></td></tr>              
                  <tr class="row2">
                    <td  align="right">Password :&nbsp;</td>
                    <td  align="left"><input type="password" name="password" value="{$data.password|escape}" class="input" maxlength="20"/>
                      <span class="required">*</span></td>
                  </tr>   
				  <tr><td colspan="2" height="5"></td></tr>              
                  <tr class="row2">
                    <td  align="right">Confirm Password :&nbsp;</td>
                    <td  align="left"><input type="password" name="confirm_password" class="input" value="{$data.confirm_password|escape}"  maxlength="20"/>
                      <span class="required">*</span></td>
                  </tr>   
				   <tr><td colspan="2" height="5"></td></tr>              
                  <tr class="row2">
                    <td  align="right">Email:&nbsp;</td>
                    <td  align="left"><input type="text" name="email" class="input" id="email" value="{$data.email|escape}"  maxlength="50"/>
                      <span class="required">*</span></td>
                  </tr>   
				  		<tr><td height="5"></td></tr>	
						<tr>
					     <td align="right">Address:&nbsp;</td>
					     <td align="left"><input class="input" name="address" type="text" id="address" value="{$data.address|escape}" size="500"  maxlength="500" /></td>
				      </tr>
					  <tr><td height="5"></td></tr>	
					  <tr>
					     <td align="right">Phone:&nbsp;</td>
					     <td align="left"><input class="input" name="phone_number" type="text" id="phone_number" value="{$data.phone_number|escape}" size="30" maxlength="20" /></td>
				      </tr>
					  <tr><td height="5"></td></tr>	
					  			  
					  <tr><td height="5"></td></tr>	
					  <tr>
					     <td align="right">Enabled:&nbsp;</td>
					     <td align="left">
						 <select name="status" id="status" style="width:175px; color:#666666;" class="select_class_large">
						 	<option value="Y" {if $data.status eq 'Y'} selected="selected" {/if}>Yes</option>
							<option value="N" {if $data.status eq 'N'} selected="selected" {/if}>No</option>
						 </select>
						 </td>
				      </tr>					  

				  <tr><td colspan="2" height="5"></td></tr>              
                 <tr height="25" >
                    <td align="left" colspan="2" class="tipbox"></td>
                  </tr>
                </table></td>
              <td width="8">&nbsp;</td>
              <td width="295" valign="top"><table width="295" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><div id="content-pane"  class="pane-sliders">
                        <div class="panel"> <a href="Javascript:TogglePanel('help1');">
                          <h3 class="moofx-toggler title moofx-toggler-down"><span>Help</span></h3>
                          </a>
                          <div style="overflow: hidden; display: block; visibility: visible;  height: 1%;" class="normalTxt">
                            <div style="padding: 5px;" id="help1">
                              <ul>
                                <li>Fill in the fields and click on Save button</li>
                                <li>To go back to Existing Admin, click Cancel button</li>
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
  <form action="{$GENERAL.BASE_URL_ADMIN}/adminmanagement.php" method="post">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="{$GENERAL.ADMIN_IMG_URL}/header/icon-48-article.png" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle">Admin Account Manager </span><span class="pageTitle1">[Existing Admin]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
                      <td class="button" id="toolbar-apply" ><a style="toolbar" href='{$GENERAL.BASE_URL_ADMIN}/adminmanagement.php?action=add&subcatid={$subcatid|escape}&catid={$catid|escape}'><img  border="0" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/icon-32-new.png" /><br/> Add </a> </td>
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
                        <td align="center" ><a href="javascript:sortRecords('firstname',true)" class="th" >Name</a></td>
						<td align="center" ><a href="javascript:sortRecords('email',true)"  class="th">Email</a></td>
                      	<td align="center" ><a href="javascript:sortRecords('username',true)"  class="th">Username</a></td>
						<td align="center" ><a href="javascript:sortRecords('usertype',true)"  class="th">Role</a></td>
                        <td align="center" ><a href="javascript:sortRecords('isactive',true)"  class="th">Enabled</a></td>
						<td width="10%" align="center"  class="th">Edit</td>
                        <td width="10%" align="center" class="th">Delete</td>
                      </tr>
                      <tr class="row1">
                        <td height="2" colspan="5" align="center" class="borderBtmDashed"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" width="1" height="1" /></td>
                      </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
                        <td align="center">{$entry.firstname} {$entry.lastname}</td>
						  <td align="center">{$entry.email}</td>
                       <td align="center">{$entry.username}</td>
						<td align="center">{if $entry.usertype eq 'A'}Main Administrator{elseif $entry.usertype eq 'M'}Marketing Administrator{elseif $entry.usertype eq 'C'}Conference Services Administrator{/if}</td>
						<td align="center">{if $entry.isactive eq 'Y'}Yes{elseif $entry.isactive eq 'N'}No{/if}</td>
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/edit_s.png"  onclick="javascript:location.href='{$GENERAL.BASE_URL_ADMIN}/adminmanagement.php?action=edit&id={$entry.adminid|escape}'"  class="btnText"  /> </td>
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('{$entry.adminid|escape}');"  class="btnText"  /> </td>
                      </tr>
                      {foreachelse}
                      <tr>
                        <td colspan="5">No existing admin found</td>
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
