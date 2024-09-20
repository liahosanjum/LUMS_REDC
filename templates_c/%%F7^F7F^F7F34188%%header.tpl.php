<?php /* Smarty version 2.6.22, created on 2011-04-26 02:19:35
         compiled from header.tpl */ ?>

<div class="logo_bar">
    <div class="logo"> <a href="http://www.lums.edu.pk" target="_blank"><img src="<?php echo $this->_tpl_vars['GENERAL']['FRONT_IMG_URL']; ?>
/logo.gif" border="0" usemap="#Map" class="lums_logo" />
        <map name="Map" id="Map">
          <area shape="rect" coords="0,0,93,76" href="http://www.lums.edu.pk" target="_blank" alt="LUMS" />
          <area shape="rect" coords="101,21,316,73" href="http://sdsb.lums.edu.pk" target="_blank" alt="Suleman Dawood - School of Business" />
        </map>
    </a> <a href="index.php"><img src="<?php echo $this->_tpl_vars['GENERAL']['FRONT_IMG_URL']; ?>
/rausing_logo.gif" class="redc_logo" /></a>
      <div class="clear"></div>
    </div>
	
  </div>
  <div class="clear"></div>
  <div class="navi_bar">
    <div id="mytabsmenu" class="tabsmenuclass">
      <ul>
       <li><a class="<?php if(strpos($_SERVER['PHP_SELF'], 'index.php') !== FALSE) { echo 'active';}else{echo inactive; } ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/index.php">Home</a></li>	
        <li><a class="<?php if ($_GET['section_id'] == '1'): ?>active<?php else: ?>inactive<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/redc_unique_main.php?section_id=1&pcid=526" rel="gotsubmenu">REDC is unique</a></li>
        <li><a class="<?php if(strpos($_SERVER['PHP_SELF'], 'programme') !== FALSE or strpos($_SERVER['PHP_SELF'], 'oep_programme') !== FALSE or strpos($_SERVER['PHP_SELF'], 'ofp_programme') !== FALSE or strpos($_SERVER['PHP_SELF'], 'prog_finder') !== FALSE or $_GET[section_id] == '11' or $_GET[oepid_] != '') { echo 'active';}else{echo inactive;} ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/programme.php?section_id=0&pcid=<?php echo $this->_tpl_vars['pcontent']['programme']; ?>
" rel="gotsubmenu">Programmes</a></li>
        <li><a class="<?php if ($_GET['section_id'] == '8' || $_GET['pcid'] == $this->_tpl_vars['pcontent']['virtual']): ?>active<?php else: ?>inactive<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/conference_services.php?section_id=8&pcid=<?php echo $this->_tpl_vars['pcontent']['conference']; ?>
" rel="gotsubmenu">Conference Services</a></li>
        <li><a class="<?php if ($_GET['section_id'] == '4'): ?>active<?php else: ?>inactive<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/faculty_profiles.php?section_id=4" rel="gotsubmenu">Faculty</a></li>
        <li><a class="<?php if ($_GET['section_id'] == '3'): ?>active<?php else: ?>inactive<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/facilites.php?section_id=3&pcid=<?php echo $this->_tpl_vars['pcontent']['facility']; ?>
" rel="gotsubmenu">Facilities</a></li>
        <li><a class="<?php if ($_GET['section_id'] == '10'): ?>active<?php else: ?>inactive<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/enrollment.php?section_id=10&pcid=<?php echo $this->_tpl_vars['pcontent']['enrollment']; ?>
" rel="gotsubmenu">Enrollment</a></li>
        <li><a class="<?php if(strpos($_SERVER['PHP_SELF'], 'alumni_login') !== FALSE or strpos($_SERVER['PHP_SELF'], 'alumni_history') !== FALSE or strpos($_SERVER['PHP_SELF'], 'alumni_profile') !== FALSE or strpos($_SERVER['PHP_SELF'], 'alumni_directory') !== FALSE or $_GET[section_id] == '9') { echo 'active';}else{echo inactive;} ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/alumni.php?section_id=9&pcid=<?php echo $this->_tpl_vars['pcontent']['alumni']; ?>
" rel="gotsubmenu">REDC Alumni</a></li>
		</ul>
    </div>
    <div style="padding:0px; margin:0px; height:6px !important; border-bottom:#d3d3d3 solid 1px;" />
    <img src="<?php echo $this->_tpl_vars['GENERAL']['FRONT_IMG_URL']; ?>
/spacer.gif" /></div>
  <div class="clear"></div>
  <div id="mysubmenuarea" class="tabsmenucontentclass"> <a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/uploads/submenucontents.htm" style="visibility:hidden">Sub Menu contents</a> </div>
  <script type="text/javascript">
		mouseovertabsmenu.init("mytabsmenu", "mysubmenuarea", true)
	</script>
</div>

