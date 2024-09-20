{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administrative Area</title>
{include file="$tpl_path/top_header.tpl"}

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
    <td class="boder"> 
 
		  <form name="uploadpdf" id="uploadpdf" method="post" action="uploadpdf.php?action=add"  enctype="multipart/form-data"  >
			<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td height="5" colspan="5" align="center"></td>
					</tr>
					<tr>
					  <td width="10" height="48" align="center">&nbsp;</td>
					  <td width="56"><img src="{$GENERAL.ADMIN_IMG_URL}/icon-48-frontpage.png" alt="" width="48" height="48" /></td>
					  <td width="445"><span class="pageTitle">File Manager</span></td>
					  <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
						  <table class="toolbar">
							<tbody>
							  <tr>
								<td class="button" id="toolbar-apply"><input type="image" value="submit" name="submit" src="{$GENERAL.ADMIN_IMG_URL}/toolbar/apply.png" class="apply" />
								</td>
								<td class="button" id="toolbar-cancel"><a href="{$GENERAL.BASE_URL_ADMIN}/welcome.php" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/restore_f2.png" border="0" alt="" /> <br />
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
			  
			  <tr>
				<td class="boderInner2"></td>
			  </tr>
			</table>
		  
	 
	 	
 
      
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
         
            <td height="10">
			</td>
          </tr>
          {if $error ne ""}
          <tr id="errorbox">
            <td height="10" class="errorBar" id="errorBar"> 
			  {$error}</td>
          </tr>
          <tr>
            <td height="10"><img src="images/blank.jpg" alt=" " width="1" height="1" /></td>
          </tr>
		  {else}
		  <tr id="errorbox" style="display:none">
		  	<td>
				{/if}
			</td>
		  </tr>	
		  
		   {if $file_uploaded ne ""}
          <tr id="errorbox">
            <td height="10" class="errorBar" id="errorBar"> 
			  {$file_uploaded}</td>
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
                <tr>
                  <td width="10" align="center">&nbsp;</td>
                  <td width="617" valign="top" class="boderInner2">
				  <table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">

                      <tr height="25" >
                        <td align="left" colspan="2" class="tipbox">
						
						 	</td>
                      </tr>
				 
                      <tr class="row2">
                        <td width="35%" align="right" valign="top">Upload Program Calender:&nbsp;</td>
                        <td width="65%" align="left"><input type="file" name="picture" class="normaltxt" /></td>
                      </tr>
					  
					   <tr class="row2">
                        <td align="left" colspan="2" valign="top"> <span class="required"></span></td>
                      </tr>
					  <tr>
					  	<td colspan="2">
						 
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
                                    <li>Fill in the following fields and click on Save button</li>
                                    <li>To go back to Existing Files , click Cancel button</li>
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
    <!--- content area  ---></td>
  </tr>
{include file="$tpl_path/footer.tpl"}
</table>
</body>
</html>
