<?php /* Smarty version 2.6.22, created on 2011-03-28 07:20:01
         compiled from gallerymanagement.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'gallerymanagement.tpl', 121, false),)), $this); ?>
<?php $this->assign('tpl_path', $this->_tpl_vars['GENERAL']['BASE_DIR_ADMIN_TPL']); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/top_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/black-calender.css" rel=stylesheet type="text/css">
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

	function deleteconfirmation(id)
	{
		if(confirm("Do you really want to delete? All pictures in this gallery will also be deleted."))
		{
			window.location.href=\'gallerymanagement.php?action=del&id=\'	+ id;
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
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </td>
  </tr>
  <tr>
    <td height="15" class="boder"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" /></td>
  </tr>
  <tr>
  
  <td class="boder">
  
    <?php if ($this->_tpl_vars['pageview'] == 'add' || $this->_tpl_vars['pageview'] == 'edit'): ?>
  <!--- content area form --->
  <form action="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/gallerymanagement.php?action=submit&mode=<?php echo $this->_tpl_vars['pageview']; ?>
<?php if ($this->_tpl_vars['pageview'] == 'edit'): ?>&id=<?php echo $this->_tpl_vars['data']['id']; ?>
<?php endif; ?>" method="post"  enctype="multipart/form-data">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/gallery4.png" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle"><span class="tableHeader">Picture Gallery</span></span><span class="pageTitle1">[<?php if ($this->_tpl_vars['pageview'] == 'add'): ?>Add<?php else: ?>Edit<?php endif; ?> gallery]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tbody>
                      <tr>
                        <td class="button" id="toolbar-apply"><a href="javascript:submitForm();" class="toolbar"> <img  value="Add" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/apply.png" style="border:0px;"  /> <br />
                          </a> </td>
                        <td class="button" id="toolbar-cancel"><a href="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/gallerymanagement.php'" class="toolbar"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/restore_f2.png" border="0" alt="" /> <br />Back</a></td>
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
        <td height="10"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/blank.jpg" alt="" width="1" height="1" /></td>
      </tr>
      <?php if ($this->_tpl_vars['error'] != ""): ?>
      <tr>
        <td height="10" class="errorBar"><?php echo $this->_tpl_vars['error']; ?>
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
              <td height="10" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" align="center">&nbsp;</td>
              <td width="617" valign="top" class="boderInner2"><table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox"><input type="hidden" name="id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />                    </td>
                  </tr>
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">Gallery Name :&nbsp;</td>
                    <td width="81%" align="left"><input type="text" name="name" class="input" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  maxlength="100"/>
                      <span class="required">&nbsp;*</span></td>
                  </tr>
				  </tr>
                  <tr class="row2">
                    <td width="19%" align="right" valign="top">Programme :&nbsp;</td>
                    <td width="81%" align="left"><select name="oepid" class="select_class">
					            <?php $_from = $this->_tpl_vars['pname']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id']):
?>
								
								<?php if ($this->_tpl_vars['id']['oepid'] == $this->_tpl_vars['data']['oepid']): ?>
								<option value="<?php echo $this->_tpl_vars['id']['oepid']; ?>
" selected="selected" ><?php echo $this->_tpl_vars['id']['name']; ?>
</option>
								<?php else: ?>
								<option value="<?php echo $this->_tpl_vars['id']['oepid']; ?>
" ><?php echo $this->_tpl_vars['id']['name']; ?>
</option>
								<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
						</select>
                      </td>
                  </tr>
				   <!--   
                    <tr class="row2" height="25">
                    <td align="right" width="19%">Visible :&nbsp;</td>
                    <td align="left"><input type="checkbox" name="visible" value="Y" <?php if ($this->_tpl_vars['data']['visible'] == 'Active'): ?> checked='checked' <?php endif; ?> /></td>
                  </tr> -->
					<tr class="row2" height="25">
                    <td align="right" width="19%">Enabled :&nbsp;</td>
                    <td align="left"><select class="select_class" name="isactive"><option value="Y" <?php if ($this->_tpl_vars['data']['isactive'] == 'Y'): ?> selected="selected"<?php endif; ?>>Yes</option><option value="N" <?php if ($this->_tpl_vars['data']['isactive'] == 'N'): ?> selected="selected"<?php endif; ?>>NO</option></select><span class="required">&nbsp;*</span></td>
                  </tr>
				  <tr><td height="5"></td></tr>
				  <!--<tr class="row2" height="25">
                    <td align="right" width="19%">Is Featured :&nbsp;</td>
                    <td align="left"><input type="checkbox" name="is_featured" value="Yes" <?php if ($this->_tpl_vars['data']['is_featured'] == 'Yes'): ?> checked='checked' <?php endif; ?> /></td>
                  </tr>--> 
				
				 <!-- <tr><td height="5"></td></tr>
                  <tr>
                    <td colspan="2" align="center" valign="top" class="boderInner2">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td >
									  <?php 
									   /*$oFCKeditor = new FCKeditor('content') ;
										$oFCKeditor->BasePath = SITE_URL.'/fckeditor/';
										$oFCKeditor->Width		= '100%';
										$oFCKeditor->Height		= '400px';
										$oFCKeditor->Value		= $this->_tpl_vars['data']['content'];
										$oFCKeditor->Create() ;*/
									   ?>
									</td>
									<td width="1%"><span class="required">&nbsp;*</span></td>
								  </tr>
							</table>

        			  </td>
                    </tr> -->
					             
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
                      <?php echo '
                      <script>
						  //TogglePanel(\'help1\');
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
  <!--- content area  --->
  <?php else: ?>
  <form action="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/gallerymanagement.php" method="post">
    <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner1"><table width="960" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5" colspan="5" align="center"></td>
            </tr>
            <tr>
              <td width="10" height="48" align="center">&nbsp;</td>
              <td width="56" valign="top"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/gallery4.png" alt="" width="48" height="48" /></td>
              <td width="445"><span class="pageTitle">Gallery Manager </span><span class="pageTitle1">[Existing Gallery]</span></td>
              <td width="439" align="right" valign="top"><div class="toolbar" id="toolbar">
                  <table class="toolbar">
                    <tr>
                      <td class="button" id="toolbar-apply" ><a style="toolbar" href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/gallerymanagement.php?action=add&subcatid=<?php echo ((is_array($_tmp=$this->_tpl_vars['subcatid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&catid=<?php echo ((is_array($_tmp=$this->_tpl_vars['catid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
'><img  border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-new.png" /><br/> Add </a> </td>
					   <td class="button" id="toolbar-apply" ><a style="toolbar" href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/homesecmanagement.php?'><img  border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-upload.png" /><br/>Home Page Pictures </a> </td>
                       <td class="button" id="toolbar-apply" ><a style="toolbar" href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/pageSectionPictures.php?'><img  border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/icon-32-upload.png" /><br/>Pages Section Pictures </a> </td>
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
        <td class="boderInner2">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10" colspan="5" align="center">
			<input type="hidden" name="sortcolumn" value="<?php echo $this->_tpl_vars['sortcolumn']; ?>
" />
                <input type="hidden" name="sortdirection" value="<?php echo $this->_tpl_vars['sortdirection']; ?>
" />
			</td>
          </tr>
          <tr >
          
          <td width="10" align="center">&nbsp;</td>
          <td width="617" valign="top" class="boderInner2">          
         <table width="100%" border="0"  class="grid">
                      <tr  height="20">
                        <td align="center" width="15%"><a href="javascript:sortRecords('name',true)" class="th" >Gallery Name</a></td>
                        <td align="center" width="15%"><a href="javascript:sortRecords('isactive',true)"  class="th">Enabled</a></td>
						 <td align="center" class="th" width="15%" >Manage Pictures </td>
						 <td align="center" class="th" width="45%">Link </td>
						<td align="center" class="th" width="5%">Edit</td>
                        <td align="center" class="th" width="5%">Delete</td>						 
                      </tr>
                      <tr class="row1">
                        <td height="5" colspan="6" align="center" class="borderBtmDashed"></td>
                      </tr>
                      <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
                      <tr class="row2"  style="height:25px;" >
                        <td align="center"><?php echo $this->_tpl_vars['entry']['name']; ?>
</td>
                        <td align="center">
						<?php if ($this->_tpl_vars['entry']['isactive'] == 'Y'): ?> 
						Yes
						<?php else: ?> 
						No
						<?php endif; ?>
						
						
						</td>

                        <td align="center" width="15%"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/upload_pictures.php?action=upload&gid=<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['pgid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&title=<?php echo $this->_tpl_vars['entry']['name']; ?>
"style="color:#048DB1;">Manage Pictures</a>  </td>
						<td align="center"><?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/show-photo-gallery.php?keepThis=true&amp;catid=<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['pgid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&amp;TB_iframe=true&amp;height=420&amp;width=724&amp;title=<?php echo $this->_tpl_vars['entry']['name']; ?>
</td>
						<td align="center" ><img  style="border:0; cursor:pointer" border="0" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/edit_s.png"  onclick="javascript:location.href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/gallerymanagement.php?action=edit&id=<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['pgid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
'"  class="btnText"  /> </td>
                        <td align="center"><img  style="border:0; cursor:pointer" type="image" src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/toolbar/delete_s.png"  onclick="javascript:deleteconfirmation('<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['pgid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
');"  class="btnText"  /> </td>						
					  </tr>
                      <?php endforeach; endif; unset($_from); ?>
                      <tr>
                        <td colspan="5" align="center"> <?php echo $this->_tpl_vars['paging']; ?>
 </td>
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
							   <li>To Manage Pictures, click on the 'Manage Pictures' button against the gallery</li>
							  <li>To view record of Home page Pictures, click on the 'Home page Pictures' button </li>
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
        </table>
      </td>      
      </tr>     
    </table>
  </form>
  <?php endif; ?>
  </td>
</tr>
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_path'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>
</body>
</html>