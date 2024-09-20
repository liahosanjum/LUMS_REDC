<?php /* Smarty version 2.6.22, created on 2011-05-02 04:47:04
         compiled from ofp_programme.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['pagedata']['keywords']; ?>
" />
<title><?php echo $this->_tpl_vars['pagedata']['explorertitle']; ?>
</title>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
		<div id="oep" style="display:none;padding-bottom:10px;">
			<?php $index = 0; ?>
			<ul style="padding-left:10px;">
				<?php $_from = $this->_tpl_vars['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>		
				<li class="level1">
				<?php $programmes = getProgrammes($this->_tpl_vars['category'][$index]['oepcatid']); ?>
				<a href="#"  onclick="showDiv('programmes_<?php echo $this->_tpl_vars['entry']['oepcatid']; ?>
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
			<li><a href="#" class="<?php if ($_GET['pcid'] != ''): ?>selected<?php endif; ?>" onclick="javascript:showDiv('ofp');" ><strong>Organization Focused Programmes</strong></a></li>
		</ul>
		</div>
		<div id="ofp" style="padding-left:10px; display:block; padding-bottom:10px; padding-top:0px;">
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
<div ><a href="<?php echo SITE_URL; ?>/prog_finder.php" ><img style="padding-top:20px;" src="images/program_finder.gif" alt="Programme Finder"  border="0"/></a></div>
<div class="clear" style="float:left;" ></div>
<!--<div><img style="padding-top:20px; width:198px;" src="images/logo_social.jpg" alt="logo_social"  border="0"/></div>-->
	   <div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>	  <!-- <div id="broucherrequestForm">
	    	<ul>
				<li><a href="#" >Calendar</a></li>
			</ul>	
		</div>-->
    </div>
<div class="main_heading_cms" style="background:url(<?php echo $this->_tpl_vars['GENERAL']['FRONT_UPLOAD_URL']; ?>
/homeSectionPictures/<?php echo $this->_tpl_vars['simage']['0']['sec_image']; ?>
) no-repeat; padding-bottom:26px; width:744px; "><h1><?php echo $this->_tpl_vars['pagedata']['pagetitle']; ?>
</h1></div>
	<div style="clear:right; padding:0px;">
    <div class="center_pane">
	<div class="programme_description" style="display:<?php if ($this->_tpl_vars['pagedata']['details'] == ""): ?>none<?php endif; ?>" ><?php echo $this->_tpl_vars['pagedata']['details']; ?>
</div>
    </div>
    <div class="right_pane_new">
	<div style="width:188px; height:111px; float:left" id='ofpForm'><a href="#" class='ofp'><img src="images/request-ofp.jpg" alt="Request for Organization Focused Programme" border="0" /></a></div>
	<!--<div style="width:188px; height:61px; float:left; padding-bottom:10px;"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/uploads/ofp-brochures/1253012891_brochure.pdf"><img src="images/brochuredownload.gif" alt="Brochure Download" border="0" /></a></div>
	 <div id="broucherrequestForm" ><ul><li style="height:27px;"><a href="#" class="broucherrequest level2">Request a Printed OFP Brochure</a></li></ul></div>-->
    
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