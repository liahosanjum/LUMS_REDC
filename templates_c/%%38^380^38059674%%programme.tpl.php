<?php /* Smarty version 2.6.22, created on 2011-04-26 05:55:25
         compiled from programme.tpl */ ?>
<?php 
		$id = 0;
		if(isset($_SESSION['userid']))
		$id = $_SESSION['userid'];
		$logged = $_REQUEST['cmd'];
		$alreadyApplied = 0;

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
	var uid 	 = '<?php  echo $id; ?>';
	var oepid 	 = '';
	var callbackurl = '<?php echo SITE_URL; ?>/programme.php?section_id=0&pcid='+<?php echo $_GET['pcid']; ?>
;
	var iflogged = '<?php echo $logged; ?>';
	var alreadyApplied = '<?php echo $alreadyApplied; ?>';
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/applyonline.js' type='text/javascript'></script>
<script language="javascript">AC_FL_RunContent = 0;</script>
<?php echo '
<script type="text/javascript">
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
animatedcollapse.addDiv(\'tabs\', \'fade=1\')
animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
}
animatedcollapse.init()

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
			<li><a href="#" onclick="javascript:showDiv('oep');" ><strong>Open Enrollment Programmes</strong></a></li>
		</ul>
		</div>
		<div id="oep" style="display:none; padding-bottom:10px;">
			<?php $index = 0; ?>
			<ul style="padding-left:10px;">
				<?php $_from = $this->_tpl_vars['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>		
				<li class="level1">
				<?php $programmes = getProgrammes($this->_tpl_vars['category'][$index]['oepcatid']);  ?>
				<a href="#" onclick="showDiv('programmes_<?php echo $this->_tpl_vars['entry']['oepcatid']; ?>
');" ><?php echo $this->_tpl_vars['entry']['name']; ?>
</a>
				<?php if($programmes[0]['name'] != ""){ ?>
				<div id="programmes_<?php echo $this->_tpl_vars['entry']['oepcatid']; ?>
" style="display:none" class="oep_programmes">
					<ul style="margin-left:0px">
					<?php 
					for($i=0; $i < count($programmes); $i++)
					{
					if($i==count($programmes)-1)
						{
					 ?>
					<li class="last">
					<a  href="programmedetail.php?oepid =<?php echo $programmes[$i]['oepid']; ?>" ><?php echo $programmes[$i]['name']; ?></a></li>
					<?php 
						}
					else
						{
					 ?>
					<li class="level2">
					<a  href="programmedetail.php?oepid =<?php echo $programmes[$i]['oepid']; ?>" ><?php echo $programmes[$i]['name']; ?></a></li>
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
			<li><a href="#" onclick="javascript:showDiv('ofp');" ><strong>Organization Focused Programmes</strong></a></li>
		</ul>
		</div>
		<div id="ofp"  style="padding-left:10px; display:none; padding-bottom:10px; padding-bottom:0px;">
		<ul >
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
		</div>
		<div class="clear" style="float:left"></div>
       <div  ><a href="<?php echo SITE_URL; ?>/prog_finder.php?section_id=0" ><img style="padding-top:20px;" src="images/program_finder.gif" alt="Programme Finder"  border="0"/></a></div>
		<!--<div><img style="padding-top:20px; width:198px;" src="images/logo_social.jpg" alt="logo_social"  border="0"/></div>-->
	   <div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
	   <!--<div id="ebroucherrequestForm">
	   <ul>
	   		<li><a href="#" class="ebroucherrequest">Request a Printed Brochure</a></li>
			<li><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/prog_finder.php" >Programme Finder</a></li>
			<li><a href="#" >Calendar</a></li>
	   </ul>
	   </div>-->
    </div>
   	<div class="main_heading_cms" style="background:url(<?php echo $this->_tpl_vars['GENERAL']['FRONT_UPLOAD_URL']; ?>
/homeSectionPictures/<?php echo $this->_tpl_vars['simage']['0']['sec_image']; ?>
) no-repeat; padding-bottom:26px; width:744px;  "><h1><?php echo $this->_tpl_vars['pagedata']['pagetitle']; ?>
</h1></div>
	<div style="clear:right; padding:0px;">
	<div class="center_pane">
            <div class="programme_description" ><?php echo $this->_tpl_vars['pagedata']['details']; ?>
</div>
    </div>
    <div class="right_pane_new">
		<div style="width:188px; height:60px; padding-bottom:<?php if ($this->_tpl_vars['pdata']['oepimage'] == ""): ?>10px<?php endif; ?>;">
			<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/calendar.php"><img src="<?php echo $this->_tpl_vars['GENERAL']['FRONT_IMG_URL']; ?>
/applyonline-sm.gif" alt="Apply Online" border="0" /></a>
		</div>
		<div id="ebroucherrequestForm"><ul><li style="height:27px;"><a href="#" class="ebroucherrequest level2">Request an OEP Printed Brochure</a></li></ul></div>
        <div id="ebroucherrequestForm"><ul><li style="height:27px;"><a target="_blank" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/uploads/OEP Application Form (4).pdf" class="level2">Download OEP Application Form</a></li></ul></div>
    	<div  style="display:<?php if ($this->_tpl_vars['pdata']['oepimage'] != ""): ?>block<?php endif; ?>none" >
			<ul><li><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/uploads/Oep-Programmes/<?php echo $this->_tpl_vars['pdata']['oepimage']; ?>
" class="level2" >Download a PDF Brochure </a></li></ul>
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