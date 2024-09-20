<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>News Detail</title>

</head>
<body>
<table width="991" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15"> {include_php file="header.php" title=header} </td>
  </tr>
  <tr>
    <td height="15" class="boder"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" /></td>
  </tr>
  <tr>
    <td class="boder"> {* Smarty *}
	{if $pageview eq "sortnews"}
		  <form action="{$GENERAL.BASE_URL_ADMIN}/newsmanagement.php" method="post" enctype="multipart/form-data" onsubmit="javascript: return SubmitSorting('news_orders','newsids');" >
			<table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td height="5" colspan="5" align="center"></td>
					</tr>
					<tr>
					  <td width="10" height="48" align="center">&nbsp;</td>
					  <td width="56"><img src="{$GENERAL.ADMIN_IMG_URL}/icon-48-frontpage.png" alt="" width="48" height="48" /></td>
					  <td width="445"><span class="pageTitle"></span></td>
					  <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
						  <table class="toolbar">
							<tbody>
							  <tr>
								</td>
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
								 <input type="hidden" name="newsids" id="newsids" />
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
										<li>To go back to Existing News, click Back button</li>
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
      <form action="newsmanagement.php?action=submit&mode={$pageview}{if $pageview eq 'edit'}{/if}" $pageview method="post"  enctype="multipart/form-data">
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
                <tr>
                  
                      <table class="toolbar">
                        <tbody>
                          <tr>
                           
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
                        <tr class="row1">
                        <td align="right" valign="top">&nbsp;</td>
                        <td width="84%" align="left">
							
                        </td>
                      </tr>
					   <tr class="row1">
                        <td align="right" valign="top">&nbsp;</td>
                        <td width="84%" align="left">
							
                        </td>
                      </tr>
					 
					   <tr class="row1">
                        <td valign="top" align="right">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr height="25" >
                        <td align="left" colspan="2" class="tipbox"></td>
                      </tr>
                      <tr height="25" >
                        <td align="left" colspan="2" class="tipbox">
						<input type="hidden" name="item_id" value="{$data.item_id|escape}" />						</td>
                      </tr>
					  <tr class="row2">
                        <td width="24%" align="right" valign="top">Headline:&nbsp;</td>
                        <td width="76%" align="left">
                        <span class="required">&nbsp;*</span></td>
                      </tr>
					   <tr class="row2">
                        <td align="left" colspan="2" valign="top">Details:&nbsp;<span class="required">&nbsp;*</span></td>
                      </tr>
					  <tr>
					  	<td colspan="2">
						{$data.description}
						</td>
					  </tr>
					   
                    </table></td>
                  <td width="8">&nbsp;</td>
                  <td width="315" valign="top"><table width="315" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td></td>
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
 <form action="newsmanagement.php" method="post" >
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
                  <td width="445"><span class="pageTitle"> </span><span class="pageTitle1"></span></td>
                  <td width="439" align="right" valign="top">
				<div class="toolbar" id="toolbar">
                    <table class="toolbar">
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
                        
						
						<!--<td style="width:20%" align="left" ><a href="javascript:sortRecords('sort_index',true)" class="th" >Sort Index</a></td>-->
                        
                      </tr>
                      <tr class="row1">
                        <td height="2" colspan="6" align="center" class="borderBtmDashed"><img src="images/blank.jpg" alt=" " width="1" height="1" /></td>
                      </tr>
					  <tr class="row2">
                        <td align="left" colspan="2" valign="top">Details:&nbsp;<span class="required">&nbsp;*</span></td>
                      </tr>
					  <tr>
					  	<td colspan="2">
						{$data.description}
						</td>
					  </tr>
                      {foreach from=$data item="entry"}
                      <tr class="row2"  style="height:25px;" >
					
						<td > </td>
						<td > </td>
						<td > </td>
						<!--<td > 
						
                      </tr>
                      {foreachelse}
                      <tr>
                        <td colspan="7">No existing News  found</td>
                      </tr>
                      {/foreach}
                      <tr>
                        <td colspan="7" align="center">  </td>
                      </tr>
                      <tr class="row1">
                        <td colspan="7" align="right">&nbsp;</td>
                      </tr>
                    </table>
			
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
      {/if} </td>
  </tr>
{include file="footer.tpl"}
</table>
</body>
</html>
