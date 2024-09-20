<?php /* Smarty version 2.6.22, created on 2011-04-26 02:28:18
         compiled from site_map.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['pagedata']['keywords']; ?>
" />
<meta name="description" content="<?php echo $this->_tpl_vars['pagedata']['description']; ?>
" />
<title><?php echo $this->_tpl_vars['pagedata']['explorertitle']; ?>
</title>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/alumnilogin.js' type='text/javascript'></script>-->
<script language="javascript">AC_FL_RunContent = 0;</script>
<?php echo '
<script type="text/javascript">

animatedcollapse.addDiv(\'tabs\', \'fade=1\')
animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
}
animatedcollapse.init()
</script>
'; ?>


</head>
<body>
<div id="main_container">
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "header.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<div class="contentspane">
  <div  class="content">
  	<!--<div class="left_pane">
    	
		<div class="left_links"><a href="" class="level2" ></a></div>
	  <div class="left_links"><a href="#" class="level2" >Conference</a></div>
	  
       <div class="add"><a href="#" ><img src="<?php echo $this->_tpl_vars['GENERAL']['FRONT_IMG_URL']; ?>
/requestafacility.gif" alt="Programme Finder"  border="0"/></a></div><div class="add1"><a href="<?php echo SITE_URL; ?>/virtualtour.php" ><img src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>
    </div>-->
    <div class="right_pane_lvl1_virtual"> 
		<div class="main_heading_cms" style="background:url(<?php echo $this->_tpl_vars['GENERAL']['FRONT_UPLOAD_URL']; ?>
/homeSectionPictures/<?php echo $this->_tpl_vars['simage']['0']['sec_image']; ?>
) no-repeat; padding-bottom:26px; width:951px; "><h1><?php echo $this->_tpl_vars['pagedata']['pagetitle']; ?>
</h1></div>       
          <!--<div class="main_heading_virtual"><?php echo $this->_tpl_vars['pagedata']['pagetitle']; ?>
</div>-->
           <div class="contents_body_siteindex">
		  <?php echo $this->_tpl_vars['pagedata']['details']; ?>

		  <div style="float:center; width:950px">
          <div class="link_box_pane">
				<div class="links_box">
				  <div class="link_box_heading">REDC is Unique</div>
						<?php $_from = $this->_tpl_vars['section_data_unique']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
						<?php if ($this->_tpl_vars['entry']['pagename'] != ""): ?>
							<div class="left_links_sitemap"><a class="<?php if ($_GET['pcid'] == $this->_tpl_vars['entry']['pcid']): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/redc_unique.php?section_id=<?php echo $this->_tpl_vars['entry']['psid']; ?>
&pcid=<?php echo $this->_tpl_vars['entry']['pcid']; ?>
"><?php echo $this->_tpl_vars['entry']['pagename']; ?>
</a></div>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					  
				 </div>
				<div style="margin-bottom:20px;">
				  <div class="link_box_heading">Programme</div>
					  <div class="left_links_sitemap"><a class="<?php if ($_GET['pcid'] == '151'): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/oep_programme.php?section_id=0&pcid=151">Open Enrollment Programme</a></div>
					    <div class="left_links_sitemap"><a class="<?php if ($_GET['pcid'] == '150'): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/ofp_programme.php?section_id=0&pcid=150">Organization Focused Programmes</a></div>
						  <div class="left_links_sitemap"><a class="<?php if ($_GET['url'] == 'prog_finder'): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/prog_finder.php">Programme Finder</a></div>
						  <div class="left_links_sitemap"><a class="level2_sitemap" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/prog_finder.php">Calendar</a></div>
						  <?php $_from = $this->_tpl_vars['section_data_programme']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
						  <?php if ($this->_tpl_vars['entry']['pagename'] != ""): ?>
					    <div class="left_links_sitemap"><a class="<?php if ($_GET['pcid'] == $this->_tpl_vars['entry']['pcid']): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/programme.php?section_id=<?php echo $this->_tpl_vars['entry']['psid']; ?>
&pcid=<?php echo $this->_tpl_vars['entry']['pcid']; ?>
"><?php echo $this->_tpl_vars['entry']['pagename']; ?>
</a></div>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</div>
				
         </div>
          <div class="link_box_pane">
		  <div class="links_box">
				  <div class="link_box_heading">REDC Alumni</div>
						<div class="left_links_sitemap"><a class="<?php if ($_GET['url'] == 'alumni_directory'): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?> alumnilogin" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/alumni_login.php">REDC Alumni Login</a></div>
                        <div class="left_links_sitemap"><a class="<?php if ($_GET['url'] == 'alumni_directory'): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/testimonial.php?section_id=9">REDC Alumni Testimonials</a></div>
						<?php $_from = $this->_tpl_vars['section_data_alumni']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
						<?php if ($this->_tpl_vars['entry']['pagename'] != ""): ?>
							<div class="left_links_sitemap"><a class="<?php if ($_GET['pcid'] == $this->_tpl_vars['entry']['pcid']): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/alumni.php?section_id=<?php echo $this->_tpl_vars['entry']['psid']; ?>
&pcid=<?php echo $this->_tpl_vars['entry']['pcid']; ?>
"><?php echo $this->_tpl_vars['entry']['pagename']; ?>
</a></div>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
				 </div>
				<div class="links_box">
				  <div class="link_box_heading">Conference Services</div>
						<?php $_from = $this->_tpl_vars['section_data_conference']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
						<?php if ($this->_tpl_vars['entry']['pagename'] != ""): ?>
							<div class="left_links_sitemap"><a class="<?php if ($_GET['pcid'] == $this->_tpl_vars['entry']['pcid']): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/conference_services.php?section_id=<?php echo $this->_tpl_vars['entry']['psid']; ?>
&pcid=<?php echo $this->_tpl_vars['entry']['pcid']; ?>
"><?php echo $this->_tpl_vars['entry']['pagename']; ?>
</a></div>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
						<div class="left_links_sitemap"><a class="<?php if ($_GET['url'] == 'virtualtour'): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="virtualtour.php?section_id=0&pcid=323">Virtaul Tour</a></div>
				</div>
				<div class="links_box" >
					<div class="link_box_heading">Faculty </div>
					<?php $_from = $this->_tpl_vars['section_data_faculty']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
					<?php if ($this->_tpl_vars['entry']['pagename'] != ""): ?>
						<div class="left_links_sitemap"><a class="<?php if ($_GET['pcid'] == $this->_tpl_vars['entry']['pcid']): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/faculty_profiles.php?section_id=<?php echo $this->_tpl_vars['entry']['psid']; ?>
&pcid=<?php echo $this->_tpl_vars['entry']['pcid']; ?>
"><?php echo $this->_tpl_vars['entry']['pagename']; ?>
</a> </div>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
					<div class="left_links_sitemap"><a class="<?php if ($_GET['url'] == 'faculty_profiles'): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="faculty_profiles.php?section_id=4">Faculty Directory</a></div>
					
			   </div>
          </div>
          <div class="link_box_pane1">
				<div class="links_box">
					  <div class="link_box_heading">Facilities</div>
						<?php $_from = $this->_tpl_vars['section_data_facilities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
						<?php if ($this->_tpl_vars['entry']['pagename'] != ""): ?>
							<div class="left_links_sitemap"><a class="<?php if ($_GET['pcid'] == $this->_tpl_vars['entry']['pcid']): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/facilites.php?section_id=<?php echo $this->_tpl_vars['entry']['psid']; ?>
&pcid=<?php echo $this->_tpl_vars['entry']['pcid']; ?>
"><?php echo $this->_tpl_vars['entry']['pagename']; ?>
</a></div>
							<?php endif; ?>
					   <?php endforeach; endif; unset($_from); ?>
				</div>
				<div class="links_box">
				  <div class="link_box_heading">Enrollment</div>
					<?php $_from = $this->_tpl_vars['section_data_enrollment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
					<?php if ($this->_tpl_vars['entry']['pagename'] != ""): ?>
						<div class="left_links_sitemap"><a class="<?php if ($_GET['pcid'] == $this->_tpl_vars['entry']['pcid']): ?>selected_sitemap<?php else: ?>level2_sitemap<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/enrollment.php?section_id=<?php echo $this->_tpl_vars['entry']['psid']; ?>
&pcid=<?php echo $this->_tpl_vars['entry']['pcid']; ?>
"><?php echo $this->_tpl_vars['entry']['pagename']; ?>
</a> </div>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
			   </div>
          </div>
        </div>
		  
		</div>        
    </div>
  </div>
</div>
<div class="clear"></div>

<div class="tabs_bar">
	<div class="tabs">
		
	</div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "bar.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</body>
</html>