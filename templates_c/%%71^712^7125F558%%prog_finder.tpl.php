<?php /* Smarty version 2.6.22, created on 2011-04-26 02:23:07
         compiled from prog_finder.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'prog_finder.tpl', 194, false),array('modifier', 'truncate', 'prog_finder.tpl', 299, false),array('modifier', 'date_format', 'prog_finder.tpl', 308, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['pagedata']['keywords']; ?>
" />
<title><?php echo $this->_tpl_vars['pagedata']['explorertitle']; ?>
</title>
<meta name="keywords" content="<?php echo $this->_tpl_vars['pagedata']['keywords']; ?>
" />
<meta name="description" content="<?php echo $this->_tpl_vars['pagedata']['description']; ?>
" />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '



<script type="text/javascript">

function selectDropdown(combo, page)
	{	
	
	var dropdown = document.getElementById(combo);
		if(dropdown != null)
		{
			for(i=0;i<dropdown.options.length;i++)
			{
				if(page == dropdown.options[i].value)
				{
					dropdown.selectedIndex = i;
					break;
				}
			}
		}
	}
function submitForm()
		{
			document.forms[0].submit();
		}
		</script>
        '; ?>

        <?php echo '
<script type="text/javascript">
	jQuery().ready(function(){
		// simple accordion
		jQuery(\'#list1a\').accordion();
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
			<li><a href="#" onclick="javascript:showDiv('oep');" ><strong>Open Enrollment Programmes</strong></a></li>
		</ul>
	</div>	
    
		<div id="oep" style="display:block;">
			<?php $index = 0; ?>
			<ul style="padding-left:10px">
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
					<a  href="programmedetail.php?oepid =<?php echo $programmes[$i]['oepid']; ?>&oepcatid=<?php echo $this->_tpl_vars['entry']['oepcatid']; ?>
" ><?php echo $programmes[$i]['name']; ?></a></li>
					<?php 
						}
					else
						{
					 ?>
					<li class="level2">
					<a  href="programmedetail.php?oepid =<?php echo $programmes[$i]['oepid']; ?>&oepcatid=<?php echo $this->_tpl_vars['entry']['oepcatid']; ?>
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
			<li><a href="#" onclick="javascript:showDiv('ofp');" ><strong>Organization Focused Programmes</strong></a></li>
		</ul>
		</div>
		<ul style="margin-left:5px">
		<div id="ofp" style="display:none;">
        <?php $_from = $this->_tpl_vars['page']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
		<li class="level1">
		<a href="ofp_programme.php?section_id=<?php echo $this->_tpl_vars['entry']['psid']; ?>
&pcid=<?php echo $this->_tpl_vars['entry']['pcid']; ?>
" ><?php echo $this->_tpl_vars['entry']['pagename']; ?>
</a></li>
		<?php endforeach; endif; unset($_from); ?>
        </div>
		</ul>
		<div class="clear"></div>
		<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
    	
		
	  <!-- <div id="ebroucherrequestForm">
	   <ul>
	   		<li><a href="#" class="ebroucherrequest">Request a Printed Brochure</a></li>
	   </ul>
	   </div>-->
    </div>
    <div class="center_pane_full">
   	  <div class="program_heading_prog_finder">
      <div class="main_heading_cms" style="background:url(<?php echo $this->_tpl_vars['GENERAL']['FRONT_UPLOAD_URL']; ?>
/homeSectionPictures/<?php echo $this->_tpl_vars['simage']['0']['sec_image']; ?>
) no-repeat;"><h1><?php echo $this->_tpl_vars['pagedata']['pagetitle']; ?>
</h1></div>
        	<!--<div class="main_heading" style="background:url(images/banr.gif) no-repeat;"><h1><?php echo $this->_tpl_vars['pagedata']['pagename']; ?>
</h1></div>-->
            <div class="programme_details" style="display:<?php if ($this->_tpl_vars['pagedata']['details'] == ""): ?>none<?php endif; ?>" ><?php echo $this->_tpl_vars['pagedata']['details']; ?>
</div>
    
      </div>
      <form action="prog_finder.php" method="post" name="programmefinder" >
        <div class="listing">
        	<div class="forms_listing">
        	<div class="forminputs_listing">
            <ul>
            
            	<li class="txt" style="font-family:Verdana, Arial, Helvetica, sans-serif;">Programme Name:</li>
                <!--echo $_POST["search_by_name"];--> 
               <?php if ($this->_tpl_vars['formvars']['search_by_name'] == 'Programme Name'): ?>
                
                <li><input name="search_by_name" type="text" id="search_by_name" class="bluebar" value="" style="font-family:Verdana, Arial, Helvetica, sans-serif;" /></li>
                <?php else: ?>
                 <li><input name="search_by_name" type="text" id="search_by_name" class="bluebar" value="<?php echo $this->_tpl_vars['formvars']['search_by_name']; ?>
" /></li>
               <?php endif; ?>
            </ul>
			<ul>
            	
                <li class="txt">Programme Category:</li>
                <li>
				 <select name="search_by_oepcatid" class="bluebar" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif;"  id="search_by_oepcatid">
                		<option value="">Programme Category</option>
							<?php $_from = $this->_tpl_vars['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cat']):
?>
								<?php if ($this->_tpl_vars['formvars']['search_by_oepcatid'] == $this->_tpl_vars['cat']['oepcatid']): ?>
									<option value="<?php echo $this->_tpl_vars['cat']['oepcatid']; ?>
" selected="selected"><?php echo ((is_array($_tmp=$this->_tpl_vars['cat']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</option>
								<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['cat']['oepcatid']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['cat']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</option>
								<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
						
						<!--<?php $_from = $this->_tpl_vars['pname']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cat']):
?>
								 
								<?php if ($this->_tpl_vars['data']['search_by_oepcatid'] == $this->_tpl_vars['cat']['oepcatid']): ?>
									<option value="<?php echo $this->_tpl_vars['cat']['oepcatid']; ?>
" selected="selected"><?php echo $this->_tpl_vars['cat']['name']; ?>
</option>
								<?php else: ?>
									<option value="<?php echo $this->_tpl_vars['cat']['oepcatid']; ?>
"><?php echo $this->_tpl_vars['cat']['name']; ?>
</option>
								<?php endif; ?>	
								
							<?php endforeach; endif; unset($_from); ?>-->
              	    </select>
                </li>
            </ul>
            <ul>
            	<li class="txt"> Programme Level:</li>
                <li>
				<?php if ($this->_tpl_vars['formvars']['month'] == $this->_tpl_vars['month']['month']): ?>
				<?php endif; ?>
               <select name="programme_by_level" class="bluebar" id="programme_by_level" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif;">
					<option value="">Programme Level</option>							
                            <option value="Top Management" >Top Management</option>
                            <option value="Senior Management" >Senior Management</option>
                            <option value="Middle Management">Middle Management</option>
                            <option value="First Line Managers">First Line Managers</option>
                            <option value="Others">Others</option>
                    </select>
                </li>
            </ul>
            <?php echo '<script type="text/javascript">
			selectDropdown(\'programme_by_level\',\''; ?>
<?php echo $this->_tpl_vars['formvars']['search']; ?>
<?php echo '\')
			</script>
			'; ?>

              <ul>
            	<li class="txt">Start Month:</li>
                <li>
				
               <select name="month" class="bluebar" id="month" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif;">
	               <option value="">Start Month</option>
				 <option value="01">January</option>
				 <option value="02">February</option>
				 <option value="03">March</option>
				 <option value="04">April</option>
				 <option value="05">May</option>
				 <option value="06">June</option>
				 <option value="07">July</option>
				 <option value="08">August</option>
				 <option value="09">September</option>
				 <option value="10">October</option>
				 <option value="11">November</option>
				 <option value="12">December</option>
              	    </select>
                </li>
            </ul>
            <?php echo '<script type="text/javascript">
			selectDropdown(\'month\',\''; ?>
<?php echo $this->_tpl_vars['formvars']['month']; ?>
<?php echo '\')
			</script>
			'; ?>

			
            <div class="clear"></div>
            <ul>
            	<li class="empty">&nbsp; </li>
                
            <li style="margin-left:67px;"><a href="#" class="next_listing" onclick="javascript: submitForm();">Search&nbsp;&nbsp;</a></li>
           
            </ul>

            </div>            

			            
        </div>
        
        </div>
        <div class="listing_sections">
		<div class="error_txt"><?php echo $this->_tpl_vars['error']; ?>
</div>
        	<ul>
            	<li class="blue name">
                	Programme Name
                </li>
                <li class="blue category">
                Category
                </li>
                <li class="blue date_listing_blue" style="border-right:#c0c7cd solid 1px;">
                	Date
                </li>
                 <li  class="blue detail" style="border-right:#c0c7cd solid 1px;">
                	Detail
                </li>
				<li  class="blue detail" style="">
                	Apply
                </li>
            </ul>
            
			<ul>
			   <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['entry']):
        $this->_foreach['list']['iteration']++;
?>
			<?php if (($this->_foreach['list']['iteration']-1) % 2 == 0): ?>
				<?php $this->assign('class', 'gray'); ?>	
			<?php else: ?>
				<?php $this->assign('class', 'lightblue'); ?>	
			<?php endif; ?>
            	<li class="<?php echo $this->_tpl_vars['class']; ?>
 boldtxt name"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/programmedetail.php?oepid_=<?php echo $this->_tpl_vars['entry']['oepid']; ?>
&oepcatid=<?php echo $this->_tpl_vars['entry']['oepcatid']; ?>
" class="list1">
                	<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 54) : smarty_modifier_truncate($_tmp, 54)); ?>
</a>
                </li>
                <li class="<?php echo $this->_tpl_vars['class']; ?>
 normaltxt category">
                <?php echo $this->_tpl_vars['entry']['category_name']; ?>

                </li>
				
                <li class="<?php echo $this->_tpl_vars['class']; ?>
 date_listing">

				<?php if ($this->_tpl_vars['entry']['status'] != 'tba'): ?>
                	<span class="boldtxt">From:</span><?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['startdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, " %b %e, %Y") : smarty_modifier_date_format($_tmp, " %b %e, %Y")); ?>
<br />
                    <span class="boldtxt margin_top">To:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['enddate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, " %b %e, %Y") : smarty_modifier_date_format($_tmp, " %b %e, %Y")); ?>

                <?php else: ?>
					<span class="boldtxt">TBA</span>
				<?php endif; ?>
                </li>
				
                <li class="<?php echo $this->_tpl_vars['class']; ?>
 detail ">
                 <a class="list1" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/programmedetail.php?oepid_=<?php echo $this->_tpl_vars['entry']['oepid']; ?>
&oepcatid=<?php echo $this->_tpl_vars['entry']['oepcatid']; ?>
">
                	More</a>
                 </li>
				 
				 <li class="<?php echo $this->_tpl_vars['class']; ?>
 detail ">
                 <!--<a class="list1" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/programmedetail.php?oepid_=<?php echo $this->_tpl_vars['entry']['oepid']; ?>
&oepcatid=<?php echo $this->_tpl_vars['entry']['oepcatid']; ?>
">
                	More</a>-->
                    <?php if ($this->_tpl_vars['entry']['status'] != 'tba'): ?>
					<a class="list1" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/apply.php?pid=<?php  echo encrypt($this->_tpl_vars['entry']['oepid']); ?>#apply">
                	Apply</a>
                    <?php else: ?>
                    <span style="font-weight:bold">Apply</span>
                    <?php endif; ?>
                 </li>
				<?php endforeach; endif; unset($_from); ?>
				
            </ul>
			
           <!-- <ul>
            	<li class="gray boldtxt name">
                	General Managment                </li>
                <li class="gray normaltxt category">
                General Managment                </li>
                <li class="gray date_listing">
                	<span class="boldtxt">From:</span> 08-11-2009<br />
                    <span class="boldtxt margin_top">To:&nbsp;&nbsp;&nbsp;&nbsp;</span> 18-11-2009</li>
            </ul>-->
        </div>
        
        
    </div>
    <div style="width:100%; display:<?php if ($this->_tpl_vars['pagenum'] < 10): ?>none;<?php endif; ?>"><?php echo $this->_tpl_vars['paging']; ?>
</div>
  </div>
    
</div>
</form>
<div class="clear"></div>

<div class="tabs_bar">
<!--<div class="ab_for_pro_finder" align="center"> <?php echo $this->_tpl_vars['paging']; ?>
</div>-->

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