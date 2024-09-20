<?php /* Smarty version 2.6.22, created on 2011-04-26 03:16:00
         compiled from programmedetail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'programmedetail.tpl', 190, false),array('modifier', 'escape', 'programmedetail.tpl', 257, false),)), $this); ?>
<?php 
		$id = 0;
		if(isset($_SESSION['userid']))
		$id = $_SESSION['userid'];
		$logged = $_REQUEST['cmd'];
		$alreadyApplied = 0;

 ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "bilal.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php 
		
		$alreadyApplied = $_SESSION['alreadyapplied'];

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['pagedata']['keywords']; ?>
" />
<title>
<?php echo $this->_tpl_vars['pdata']['name']; ?>
</title>
<script language="javascript">
	var uid 	 = '<?php  echo $id; ?>';
	var oepid 	 = '<?php echo $_REQUEST[oepid_] ?>';
	var callbackurl = '<?php echo SITE_URL; ?>/programmedetail.php?oepid_='+oepid  + "&oepcatid=<?php echo $_GET['oepcatid']; ?>
";
	var iflogged = '<?php echo $logged; ?>';
	var alreadyApplied = '<?php echo $alreadyApplied; ?>';
	var prName = '<?php echo $this->_tpl_vars['pdata']['name']; ?>
';
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/applyonline.js' type='text/javascript'></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/animatedcollapse.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/chili-1.7.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/jquery.easing.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/jquery.dimensions.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/jquery.accordion.js"></script>
<link type='text/css' href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/applyonline.css' rel='stylesheet' media='screen' />
<link type='text/css' href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/form.css' rel='stylesheet' media='screen' />


<?php echo '
<script type="text/javascript">

animatedcollapse.addDiv(\'tabs\', \'fade=1\')
animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
}
animatedcollapse.init()
</script>
'; ?>


<?php echo '
<script type="text/javascript">
	jQuery().ready(function(){
		// simple accordion
		jQuery(\'#list1a\').accordion({     autoheight: false });
			});
			function showDiv(divId)
        		{
					 var divPane = document.getElementById(divId);
					if(divPane.style.display == "none")
					{
						divPane.style.display = "";
						if(divId == \'oep\')
						{
						window.location.href ="oep_programme.php?section_id=0&pcid=151";
						}
						if(divId == \'ofp\')
						{
						window.location.href ="ofp_programme.php?section_id=0&pcid=150";
						}
					}
					else if(divPane.style.display == "block" || divPane.style.display == "")
					{
						divPane.style.display = "none";
					}
        		}
	
	function showAll(divId)
	{
		var divPane = document.getElementById(divId);
            if(divPane.style.display == "none")
            {
                divPane.style.display = "";
				$(".oep_programmes").show();
            }
            else if(divPane.style.display == "block" || divPane.style.display == "")
            {
                divPane.style.display = "none";
            }
		//$("#oep").show();
		//$(".oep_programmes").show();
	}
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
	
    	<div class="programm_tab"><span class="showall"><a class="showall" href="javascript:showAll('oep')">Show All Programmes</a></span></div>
		<div>
		<ul>
			<li><a href="#" onclick="javascript:showDiv('oep');" class="<?php if ($_GET['pcid'] != '' || $_GET['oepid_'] != ''): ?>selected<?php endif; ?>" ><strong>Open Enrollment Programmes</strong></a></li>
		</ul>
		</div>
		<div id="oep" style="display:block;padding-bottom:10px;">
			<?php $index = 0; ?>
			<ul style="padding-left:10px;">
				<?php $_from = $this->_tpl_vars['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>		
				<li class="level1">
				<?php $programmes = getProgrammes($this->_tpl_vars['category'][$index]['oepcatid']);  ?>
				
				<a class="<?php if ($_GET['oepcatid'] == $this->_tpl_vars['entry']['oepcatid']): ?>selected<?php endif; ?>" href="#" onclick="showDiv('programmes_<?php echo $this->_tpl_vars['entry']['oepcatid']; ?>
');" ><?php echo $this->_tpl_vars['entry']['name']; ?>
</a>
				<?php if($programmes[0]['name'] != ""){ ?>
				<div id="programmes_<?php echo $this->_tpl_vars['entry']['oepcatid']; ?>
" style="display:<?php if ($_GET['oepcatid'] == $this->_tpl_vars['entry']['oepcatid']): ?>block<?php endif; ?>none;" class="oep_programmes">
					<ul style="margin-left:0px">
					<?php 
					for($i=0; $i < count($programmes); $i++)
					{
					if($i==count($programmes)-1)
						{
					 ?>
					<li class="last">
					<a class="<?php if($_REQUEST['oepid_'] == $programmes[$i]['oepid']) { echo 'selected';} ?>" href="programmedetail.php?oepid =<?php echo $programmes[$i]['oepid']; ?>&oepcatid=<?php echo $this->_tpl_vars['entry']['oepcatid']; ?>
" ><?php echo $programmes[$i]['name']; ?></a></li>
					<?php 
						}
					else
						{
					 ?>
					<li class="level2">
					<a class="<?php if($_REQUEST['oepid_'] == $programmes[$i]['oepid']) { echo 'selected';} ?>" href="programmedetail.php?oepid =<?php echo $programmes[$i]['oepid']; ?>&oepcatid=<?php echo $this->_tpl_vars['entry']['oepcatid']; ?>
" ><?php echo $programmes[$i]['name']; ?></a></li>
					<?php 
						}
					}
					 ?>
					</ul>
				</div>
				<?php } ?>
				</li>
				
<!--				</div>-->
				<?php $index++; ?>
				<?php endforeach; endif; unset($_from); ?>
			</ul>				
        </div>
		<div>
		<ul>
			<li><a href="#" onclick="javascript:showDiv('ofp');"  class="<?php if ($_GET['pcid'] != ''): ?>selected<?php endif; ?>" ><strong>Organization Focused Programmes</strong></a></li>
		</ul>
		</div>
		<div id="ofp" style="padding-left:10px; display:none; padding-bottom:10px; padding-top:0px;">
		<ul>
        <?php $_from = $this->_tpl_vars['page']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
		<li class="level1">
		<a class="<?php if ($_GET['pcid'] == $this->_tpl_vars['entry']['pcid']): ?>selected<?php endif; ?>" href="ofp_programme.php?section_id=<?php echo $this->_tpl_vars['entry']['psid']; ?>
&pcid=<?php echo $this->_tpl_vars['entry']['pcid']; ?>
" ><?php echo $this->_tpl_vars['entry']['pagename']; ?>
</a></li>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
		
		 <!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/prog_finder.php" ><img src="<?php echo $this->_tpl_vars['GENERAL']['FRONT_IMG_URL']; ?>
/program_finder.gif" alt="Programme Finder"  border="0"/></a>-->
        </div>
      <div>  
    <a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/prog_finder.php" ><img style="padding-top:20px;"  src="<?php echo $this->_tpl_vars['GENERAL']['FRONT_IMG_URL']; ?>
/program_finder.gif" alt="Programme Finder"  border="0"/></a></div>
	<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
  </div>
  <div class="main_heading_cms" style="background:url(<?php echo $this->_tpl_vars['GENERAL']['FRONT_UPLOAD_URL']; ?>
/programme-category/<?php echo $this->_tpl_vars['image']['0']['cat_image']; ?>
) no-repeat; padding-bottom:26px; width:744px; "><h1><?php echo $this->_tpl_vars['pdata']['name']; ?>
</h1></div>
  <div style="clear:right; padding:0px;">
    <div class="center_pane">
   	 <!-- <div class="program_heading_block">
        	<div class="programme_heading">
            	<img src="images/pic.gif" class="banr"><p><?php echo $this->_tpl_vars['pdata']['name']; ?>
</p></div>-->
                <div class="program_heading_block">    
            <div class="programme_details">
            	<div class="date_section">
                	<div class="date"><span class="date_heading">Date:</span>
						<?php if ($this->_tpl_vars['pdata']['status'] != 'tba'): ?>
						<span class="date_txt"><b>From:</b> <?php echo ((is_array($_tmp=$this->_tpl_vars['pdata']['startdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e %b, %Y") : smarty_modifier_date_format($_tmp, "%e %b, %Y")); ?>
</span><span class="date_txt"><b>To:</b> <?php echo ((is_array($_tmp=$this->_tpl_vars['pdata']['enddate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e %b, %Y") : smarty_modifier_date_format($_tmp, "%e %b, %Y")); ?>
</span>
						<?php else: ?>
							<span class="date_txt"><b>TBA</b></span>
						<?php endif; ?>
					</div>
                    <div class="date"><span class="date_heading1">Venue:</span><span class="date_txt"><b style="color:#f79e4d"><?php echo $this->_tpl_vars['pdata']['venue']; ?>
</b></span></div>
                </div>
                <div class="deadline_section">
                	<div class="date_heading2">Application Deadline</div>
                  
                    <div class="date_bg" align="center"><?php if ($this->_tpl_vars['pdata']['status'] != 'tba'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['pdata']['deadline'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e %b, %Y") : smarty_modifier_date_format($_tmp, "%e %b, %Y")); ?>
<?php else: ?>TBA<?php endif; ?></div>
                </div>
            </div>
            <div class="programme_details_line"> &nbsp;</div>
      </div>
      
	  <div class="clear"></div>
	 	  <div class="basic" style="float:left;"  id="list1a">
			<a style="display:<?php if ($this->_tpl_vars['pdata']['introduction'] == ""): ?>none;<?php endif; ?>">Introduction</a>
			<div class="basic_txt"><?php echo $this->_tpl_vars['pdata']['introduction']; ?>
</div>
			<a style="display:<?php if ($this->_tpl_vars['pdata']['objective'] == ""): ?>none;<?php endif; ?>">Programme Objective</a>
			<div class="basic_txt"><?php echo $this->_tpl_vars['pdata']['objective']; ?>
</div>
			<a style="display:<?php if ($this->_tpl_vars['pdata']['curriculum'] == ""): ?>none;<?php endif; ?>">Coverage</a>
            <div class="basic_txt"><?php echo $this->_tpl_vars['pdata']['curriculum']; ?>
</div>
			<a style="display:<?php if ($this->_tpl_vars['pdata']['participents'] == ""): ?>none;<?php endif; ?>">Participant Mix</a>
			<div class="basic_txt"><?php echo $this->_tpl_vars['pdata']['participents']; ?>
</div>
			<a style="display:<?php if ($this->_tpl_vars['pdata']['testimonials'] == ""): ?>none;<?php endif; ?>">Testimonials</a>
			<div class="basic_txt"><?php echo $this->_tpl_vars['pdata']['testimonials']; ?>
</div>
			<a style="display:<?php if ($this->_tpl_vars['pdata']['learningmodel'] == ""): ?>none;<?php endif; ?>">Learning Model</a>
			<div class="basic_txt"><?php echo $this->_tpl_vars['pdata']['learningmodel']; ?>
</div>
			<a style="display:<?php if ($this->_tpl_vars['pdata']['fa_facname'] == "" && $this->_tpl_vars['pdata']['facultyinfo'] == ""): ?>none;<?php endif; ?>">Programme Director(s)</a>
			 <?php if ($this->_tpl_vars['pdata']['fa_facname'] == 'TBA'): ?>
			<div class="basic_txt"><strong>TBA</strong></div>
			<?php else: ?>
			<div class="basic_txt"><?php if ($this->_tpl_vars['pdata']['fa_facname'] != ""): ?><strong><?php echo $this->_tpl_vars['pdata']['fa_facname']; ?>
</strong><br /><br /><?php endif; ?><?php echo $this->_tpl_vars['pdata']['facultyinfo']; ?>
</div>            
			<?php endif; ?>
		
			<a style="display:<?php if ($this->_tpl_vars['pdata']['fa_facname'] == "" && $this->_tpl_vars['pdata']['facultyinfo'] == ""): ?>none;<?php endif; ?>">Additional Faculty</a>
			 <?php if ($this->_tpl_vars['pdata']['fa_facname2'] == 'TBA'): ?>
			<div class="basic_txt"><strong>TBA</strong></div>
			<?php else: ?>
			<div class="basic_txt"><?php if ($this->_tpl_vars['F_name2'] != ""): ?><strong>
		 		<?php echo $this->_tpl_vars['F_name2']; ?>

			</strong><br /><br /><?php endif; ?><?php echo $this->_tpl_vars['pdata']['facultyinfo2']; ?>
</div>            
			<?php endif; ?>
			<a style="display:<?php if ($this->_tpl_vars['pdata']['feecondition'] == ""): ?>none;<?php endif; ?>">Fee and Conditions</a>
			<div class="basic_txt"><?php echo $this->_tpl_vars['pdata']['feecondition']; ?>
</div>
			
		</div>
	  	
    </div>
    
    <div class="right_pane_new">
    <?php if ($this->_tpl_vars['avail'] == 'yes'): ?>
    
	<!--<div style="width:188px; height:60px; padding-bottom:<?php if ($this->_tpl_vars['pdata']['oepimage'] == ""): ?>10px<?php endif; ?>;"><a href="#" class="apply"><img src="<?php echo $this->_tpl_vars['GENERAL']['FRONT_IMG_URL']; ?>
/applyonline-sm.gif" alt="Apply Online" border="0" /></a></div> -->
	
    <div style="width:188px; height:60px; padding-bottom:<?php if ($this->_tpl_vars['pdata']['oepimage'] == ""): ?>10px<?php endif; ?>;"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/apply.php?pid=<?php  echo encrypt($_REQUEST['oepid_']); ?>#apply"><img src="<?php echo $this->_tpl_vars['GENERAL']['FRONT_IMG_URL']; ?>
/applyonline-sm.gif" alt="Apply Online" border="0" /></a></div>
	<?php endif; ?>
    <div style="width:188px; height:60px; padding-bottom:10px;;display:<?php if ($this->_tpl_vars['pdata']['oepimage'] != ""): ?>block<?php endif; ?>none;"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/uploads/Oep-Programmes/<?php echo $this->_tpl_vars['pdata']['oepimage']; ?>
" ><img src="images/brochuredownload.gif" alt="Brochure Download" border="0" /></a></div>
    <!--<div id="broucherrequestForm"><ul><li><a href="#" class="broucherrequest level2">Request a Printed OFP Brochure  </a></li></ul></div>-->
	<div id="ebroucherrequestForm"><ul><li style="height:18px;"><a href="#" class="ebroucherrequest level2">Request a Printed Brochure</a></li></ul></div>
    <div  style="display:<?php if ($this->_tpl_vars['pdata']['oepimage'] != ""): ?>block<?php endif; ?>none" ><ul><li><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/uploads/Oep-Programmes/<?php echo $this->_tpl_vars['pdata']['oepimage']; ?>
" class="level2" >Download a PDF Brochure </a></li></ul></div>
   
   
   <div style="display:<?php if ($this->_tpl_vars['gdata']['name'] != ""): ?>block<?php endif; ?>none">
   <ul><li>
	<a  class="thickbox " href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/show-photo-gallery.php?keepThis=true&amp;catid=<?php echo ((is_array($_tmp=$this->_tpl_vars['gdata']['pgid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&amp;TB_iframe=true&amp;height=420&amp;width=724&amp;title=<?php echo $this->_tpl_vars['gdata']['name']; ?>
"/>	
        <?php echo $this->_tpl_vars['gdata']['name']; ?>

        </a>
        </li>
        </ul>	
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