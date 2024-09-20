<?php /* Smarty version 2.6.22, created on 2011-05-16 04:49:06
         compiled from enrollment.tpl */ ?>
<?php 
		$id = 0;
		if(isset($_SESSION['userid']))
		$id = $_SESSION['userid'];
		$logged = $_REQUEST['cmd'];

 ?>

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
<script language="javascript">
	var uid 	   = '<?php  echo $id; ?>';
	var oepid 	   = '';
	var section_id = '<?php echo $_REQUEST[section_id]; ?>';
	var pcid       = '<?php echo $_REQUEST[pcid]; ?>';
	var callbackurl = '<?php echo SITE_URL; ?>/enrollment.php?section_id='+section_id+'&pcid='+pcid;
	var iflogged = '<?php echo $logged; ?>';
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link type='text/css' href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/applyonline.css' rel='stylesheet' media='screen' />
<link type='text/css' href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/form.css' rel='stylesheet' media='screen' />

<!-- Contact Form JS and CSS files -->
<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/applyonline.js' type='text/javascript'></script>
<script src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/mouseovertabs.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/animatedcollapse.js"></script>
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
 
    <div class="left_pane">
		<ul>
    	<?php $_from = $this->_tpl_vars['section_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
      <li><a class="<?php if ($_GET['pcid'] == $this->_tpl_vars['entry']['pcid']): ?>selected<?php endif; ?>" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/enrollment.php?section_id=<?php echo $this->_tpl_vars['entry']['psid']; ?>
&pcid=<?php echo $this->_tpl_vars['entry']['pcid']; ?>
"><?php echo $this->_tpl_vars['entry']['pagename']; ?>
</a></li>
	  <!--<div class="left_links"><a href="#" class="level2" >Conference</a></div>-->
	  <?php endforeach; endif; unset($_from); ?>
	  </ul>
       <div ><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/calendar.php"><img style="padding-top:20px;" src="<?php echo $this->_tpl_vars['GENERAL']['FRONT_IMG_URL']; ?>
/applyonline.gif" alt="Programme Finder"  border="0"/></a></div>
	   <div class="add1"><a href="<?php echo SITE_URL; ?>/prog_finder.php?section_id=0" ><img src="images/program_finder.gif" alt="Programme Finder"  border="0"/></a></div>
	   <!--<div id="ebroucherrequestForm"><a href="#" class="ebroucherrequest" ><img src="images/brochuredownload.gif" alt="Programme Finder"  border="0"/></a></div>-->
	   <ul><li><a href="#" class="ebroucherrequest level2">Request an OEP Printed Brochure  </a></li></ul>
	   <div class="clear"></div>
	   
		<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
	   
    </div>
    <div class="right_pane_lvl1">
        
           <div class="main_heading_cms" style="background:url(<?php echo $this->_tpl_vars['GENERAL']['FRONT_UPLOAD_URL']; ?>
/homeSectionPictures/<?php echo $this->_tpl_vars['simage']['0']['sec_image']; ?>
) no-repeat;"><h1><?php echo $this->_tpl_vars['pagedata']['pagetitle']; ?>
</h1></div>
          <div class="contents_body_cms">
		  <?php echo $this->_tpl_vars['pagedata']['details']; ?>

		  
		  
		 
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