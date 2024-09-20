<?php /* Smarty version 2.6.22, created on 2011-03-28 07:03:57
         compiled from brouchermanagement.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'brouchermanagement.tpl', 121, false),)), $this); ?>
<?php $this->assign('tpl_path', $this->_tpl_vars['GENERAL']['BASE_DIR_ADMIN_TPL']); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/top_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '

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

	function deleteconfirmation(bid,returnpage)
	{
		if(confirm("Do you really want to delete?"))
		{
			window.location.href=\'brouchermanagement.php?action=del&bid=\' + bid ; 
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
'; ?>

</head>
<body>

<table width="991" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/header.tpl", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </td>
  </tr>
  <tr>
  <tr>
    <td height="15" class="boder"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" /></td>
  </tr>
  <tr>
    <td class="boder">       
      <?php if ($this->_tpl_vars['pageview'] == 'reply'): ?>
      <!-- content Area start -->
      
	  <form action="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/brouchermanagement.php?action=submit&mode=<?php echo $this->_tpl_vars['pageview']; ?>
&page=<?php echo $this->_tpl_vars['returnpage']; ?>
"  method="post">
	  
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
                <tr>
                  <td width="10" height="48" align="center">&nbsp;</td>
                 <td width="56" valign="top"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/broucher_request_manager.gif" alt="" width="48" height="48" /></td>
                <td width="10" height="48" align="center">&nbsp;</td>
				 <td width="786"><span class="pageTitle"><span class="tableHeader">Brochure Request</span> Manager </span><span class="pageTitle1">[ View Detail ]</span></td>
                  <td width="77" align="right" valign="top"><div class="toolbar" id="toolbar">                  
				   <table class="toolbar">
                      <tbody>
                        <tr>
						  <td class="button" id="toolbar-cancel"><a href="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/brouchermanagement.php'" class="toolbar"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/restore_f2.png" border="0" alt="" /> <br />
                            Back</a></td>
                        </tr>
                      </tbody>
                    </table>
					</td>
                  <td width="10" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="10"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" width="1" height="1" /></td>
          </tr>		  
          <?php if ($this->_tpl_vars['error'] != ""): ?>
          <tr>
            <td height="10" class="errorBar"> <?php echo $this->_tpl_vars['error']; ?>
 </td>
          </tr>
          <tr>
            <td height="10"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" width="1" height="1" /></td>
          </tr>
          <?php endif; ?>
          <tr>
            <td class="boderInner2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="10" colspan="5" align="center"><input type="hidden" name="id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
                </td>
              </tr>
              <tr>
                <td width="10" align="center">&nbsp;</td>
                <td  valign="top" class="boderInner2">
				<table border="0" width="100%" cellspacing="1" cellpadding="1"  class="normalTxt">
									
					<tr class="row2" >
                    <td align="right"class="fieldtitle">Sender Name:&nbsp;</td>
                    <td align="left" colspan="3"><?php echo $this->_tpl_vars['data']['name']; ?>
 </td>
                  </tr>
                    <tr class="row2" >
                      <td align="right"class="fieldtitle">Email:&nbsp;</td>
                      <td align="left" colspan="3"><?php echo $this->_tpl_vars['data']['email']; ?>

					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"class="fieldtitle">Dated:&nbsp;</td>
                      <td align="left" colspan="3"><?php echo $this->_tpl_vars['data']['dated']; ?>

					  </td>
                    </tr>
					<tr class="row2" >
                      <td align="right"class="fieldtitle">Programme Request:&nbsp;</td>
                      <td align="left" colspan="3"><?php echo $this->_tpl_vars['data']['programme_requested']; ?>

					  </td>
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
                                    <li>This is the Detail of the requested brochure</li>
                                  <li>To go back to Existing Requests, click on Back button</li>
								 </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php echo '
                          <script>
						  //TogglePanel(\'help5\');
						  </script>
                          '; ?>
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
	  
      <?php else: ?>
      
	  <form action="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/brouchermanagement.php" method="post">
	  
        <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
                <tr>
                  <td width="10" height="48" align="center">&nbsp;</td>
                  <td width="56" valign="top"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/broucher_request_manager.gif" alt="" width="48" height="48" /></td>
                  <td width="807"><span class="pageTitle">View/Delete Brochure Request </span><span class="pageTitle1">&nbsp;[
                    <?php if ($this->_tpl_vars['pageview'] == 'viewclose'): ?>
                    view  Request Detail  
                    <?php else: ?>
                    Existing brochure Request List  
                    <?php endif; ?>
                    ]</span></td>
                  <td width="77" align="right" valign="top"><div class="toolbar" id="toolbar">                  </td>
                  <td width="10" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td height="5" colspan="5" align="center"></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="10"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" width="1" height="1" /></td>
          </tr>		  
          <?php if ($this->_tpl_vars['error'] != ""): ?>
          <tr>
            <td height="10" class="errorBar"> <?php echo $this->_tpl_vars['error']; ?>
 </td>
          </tr>
          <tr>
            <td height="10"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" width="1" height="1" /></td>
          </tr>
          <?php endif; ?>
          <tr>
            <td class="boderInner2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10" colspan="5" align="center">
				  <input type="hidden" name="sortcolumn" value="<?php echo $this->_tpl_vars['sortcolumn']; ?>
" />
                    <input type="hidden" name="sortdirection" value="<?php echo $this->_tpl_vars['sortdirection']; ?>
" />
                  </td>
                </tr>
				
                <tr>
                  <td width="10" align="center">&nbsp;</td>
                  <td  valign="top" class="boderInner2"><table width="100%" border="0"  class="grid">
                      <tr  height="20">
                        <td align="center" ><a href="javascript:sortRecords('name',true)"  class="th">Sender Name</a></td>
                       <td align="center"><a href="javascript:sortRecords('email',true)"  class="th">Email</a></td>
					    <td align="center"><a href="javascript:sortRecords('programme_requested',true)"  class="th">programme Request</a></td>
						  <td align="center"><a href="javascript:sortRecords('dated',true)"  class="th">Dated</a></td>
                        <td align="center" class="th">View</td>
                        <!--<?php if ($this->_tpl_vars['pageview'] != 'viewclose'): ?>
                        <td align="center" class="th">Close</td>
                        <?php endif; ?>-->
                        <td align="center" class="th">Delete</td>
                      </tr>
                      <tr class="row1">
                        <td height="2" colspan="6" align="center" class="borderBtmDashed"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" width="1" height="1" /></td>
                      </tr>
                      <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
                      <tr class="row2"  style="height:25px;" >
                        <td align="center" ><?php echo $this->_tpl_vars['entry']['name']; ?>
</td>
                        <td align="center" ><?php echo $this->_tpl_vars['entry']['email']; ?>
</td>
						 <td align="center" ><?php echo $this->_tpl_vars['entry']['programme_requested']; ?>
</td>
						  <td align="center" ><?php echo $this->_tpl_vars['entry']['dated']; ?>
</td>
						  
                        <td valign="top" align="center"><img  style="border:0; cursor:pointer" border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/edit_s.png"  onclick="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/brouchermanagement.php?action=detail&id=<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['bid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&page=<?php if ($this->_tpl_vars['pageview'] != 'viewclose'): ?>open<?php else: ?>close<?php endif; ?>'"  class="btnText"  /> </td>
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['bid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
');"  class="btnText"  /> </td>
                      </tr>
                      <?php endforeach; else: ?>
                      <tr>
                        <td colspan="6">No existing record found</td>
                      </tr>
                      <?php endif; unset($_from); ?>
                      <tr>
                        <td colspan="6" align="center"> <?php echo $this->_tpl_vars['paging']; ?>
 </td>
                      </tr>
                      <tr class="row1">
                        <td colspan="6" align="right">&nbsp;</td>
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
                                    <li>To view request, click view button next to that request </li>
									 <?php if ($this->_tpl_vars['pageview'] == 'viewclose'): ?>
									
									<?php endif; ?>
									 
									
                                    <li>To delete request, click Delete button next to that request </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php echo '
                          <script>
						  //TogglePanel(\'help5\');
						  </script>
                          '; ?>
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
	  
      <?php endif; ?>
      <!-- content Area ends -->
    </td>
  </tr>
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/footer.tpl", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>

</body>
</html>