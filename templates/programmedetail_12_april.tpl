{php}
		$id = 0;
		if(isset($_SESSION['userid']))
		$id = $_SESSION['userid'];
		$logged = $_REQUEST['cmd'];
		$alreadyApplied = 0;

{/php}

{include_php file="bilal.php"}
{php}
		
		$alreadyApplied = $_SESSION['alreadyapplied'];

{/php}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<title>
{$pdata.name}</title>
<script language="javascript">
	var uid 	 = '{php} echo $id;{/php}';
	var oepid 	 = '{php}echo $_REQUEST[oepid_]{/php}';
	var callbackurl = '{php}echo SITE_URL;{/php}/programmedetail.php?oepid_='+oepid  + "&oepcatid={$smarty.get.oepcatid}";
	var iflogged = '{php}echo $logged;{/php}';
	var alreadyApplied = '{php}echo $alreadyApplied;{/php}';
	var prName = '{$pdata.name}';
</script>

{include file="includes.tpl"}

<script src='{$GENERAL.BASE_URL_ROOT}/js/applyonline.js' type='text/javascript'></script>
<script type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/animatedcollapse.js"></script>
<script type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/chili-1.7.pack.js"></script>
<script type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/jquery.easing.js"></script>
<script type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/jquery.dimensions.js"></script>
<script type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/jquery.accordion.js"></script>
<link type='text/css' href='{$GENERAL.BASE_URL_ROOT}/css/applyonline.css' rel='stylesheet' media='screen' />
<link type='text/css' href='{$GENERAL.BASE_URL_ROOT}/css/form.css' rel='stylesheet' media='screen' />


{literal}
<script type="text/javascript">

animatedcollapse.addDiv('tabs', 'fade=1')
animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
}
animatedcollapse.init()
</script>
{/literal}

{literal}
<script type="text/javascript">
	jQuery().ready(function(){
		// simple accordion
		jQuery('#list1a').accordion({     autoheight: false });
			});
			function showDiv(divId)
        		{
					 var divPane = document.getElementById(divId);
					if(divPane.style.display == "none")
					{
						divPane.style.display = "";
						if(divId == 'oep')
						{
						window.location.href ="oep_programme.php?section_id=0&pcid=151";
						}
						if(divId == 'ofp')
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

{/literal}


</head>
<body>
<div id="main_container">
 {include_php file="header.php"}
<div class="contentspane">
  <div  class="content">
    <div class="left_pane">
	
    	<div class="programm_tab"><span class="showall"><a class="showall" href="javascript:showAll('oep')">Show All Programmes</a></span></div>
		<div>
		<ul>
			<li><a href="#" onclick="javascript:showDiv('oep');" class="{if $smarty.get.pcid neq '' or $smarty.get.oepid_ neq '' }selected{/if}" ><strong>Open Enrollment Programmes</strong></a></li>
		</ul>
		</div>
		<div id="oep" style="display:block;padding-bottom:10px;">
			{php}$index = 0;{/php}
			<ul style="padding-left:10px;">
				{foreach from=$category item="entry"}		
				<li class="level1">
				{php}$programmes = getProgrammes($this->_tpl_vars['category'][$index]['oepcatid']); {/php}
				
				<a class="{if $smarty.get.oepcatid eq $entry.oepcatid}selected{/if}" href="#" onclick="showDiv('programmes_{$entry.oepcatid}');" >{$entry.name}</a>
				{php}if($programmes[0]['name'] != ""){{/php}
				<div id="programmes_{$entry.oepcatid}" style="display:{if $smarty.get.oepcatid eq $entry.oepcatid}block{/if}none;" class="oep_programmes">
					<ul style="margin-left:0px">
					{php}
					for($i=0; $i < count($programmes); $i++)
					{
					if($i==count($programmes)-1)
						{
					{/php}
					<li class="last">
					<a class="{php}if($_REQUEST['oepid_'] == $programmes[$i]['oepid']) { echo 'selected';}{/php}" href="programmedetail.php?oepid ={php}echo $programmes[$i]['oepid'];{/php}&oepcatid={$entry.oepcatid}" >{php}echo $programmes[$i]['name'];{/php}</a></li>
					{php}
						}
					else
						{
					{/php}
					<li class="level2">
					<a class="{php}if($_REQUEST['oepid_'] == $programmes[$i]['oepid']) { echo 'selected';}{/php}" href="programmedetail.php?oepid ={php}echo $programmes[$i]['oepid'];{/php}&oepcatid={$entry.oepcatid}" >{php}echo $programmes[$i]['name'];{/php}</a></li>
					{php}
						}
					}
					{/php}
					</ul>
				</div>
				{php}}{/php}
				</li>
				
<!--				</div>-->
				{php}$index++;{/php}
				{/foreach}
			</ul>				
        </div>
		<div>
		<ul>
			<li><a href="#" onclick="javascript:showDiv('ofp');"  class="{if $smarty.get.pcid neq ''}selected{/if}" ><strong>Organization Focused Programmes</strong></a></li>
		</ul>
		</div>
		<div id="ofp" style="padding-left:10px; display:none; padding-bottom:10px; padding-top:0px;">
		<ul>
        {foreach from=$page item="entry"}
		<li class="level1">
		<a class="{if $smarty.get.pcid eq $entry.pcid}selected{/if}" href="ofp_programme.php?section_id={$entry.psid}&pcid={$entry.pcid}" >{$entry.pagename}</a></li>
		{/foreach}
		</ul>
		
		 <!--<a href="{$GENERAL.BASE_URL_ROOT}/prog_finder.php" ><img src="{$GENERAL.FRONT_IMG_URL}/program_finder.gif" alt="Programme Finder"  border="0"/></a>-->
        </div>
      <div>  
    <a href="{$GENERAL.BASE_URL_ROOT}/prog_finder.php" ><img style="padding-top:20px;"  src="{$GENERAL.FRONT_IMG_URL}/program_finder.gif" alt="Programme Finder"  border="0"/></a></div>
	<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
  </div>
  <div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/programme-category/{$image.0.cat_image}) no-repeat; padding-bottom:26px; width:744px; "><h1>{$pdata.name}</h1></div>
  <div style="clear:right; padding:0px;">
    <div class="center_pane">
   	 <!-- <div class="program_heading_block">
        	<div class="programme_heading">
            	<img src="images/pic.gif" class="banr"><p>{$pdata.name}</p></div>-->
                <div class="program_heading_block">    
            <div class="programme_details">
            	<div class="date_section">
                	<div class="date"><span class="date_heading">Date:</span>
						{if $pdata.status ne 'tba'}
						<span class="date_txt"><b>From:</b> {$pdata.startdate|date_format:"%e %b, %Y"}</span><span class="date_txt"><b>To:</b> {$pdata.enddate|date_format:"%e %b, %Y"}</span>
						{else}
							<span class="date_txt"><b>TBA</b></span>
						{/if}
					</div>
                    <div class="date"><span class="date_heading1">Venue:</span><span class="date_txt"><b style="color:#f79e4d">{$pdata.venue}</b></span></div>
                </div>
                <div class="deadline_section">
                	<div class="date_heading2">Application Deadline</div>
                  
                    <div class="date_bg" align="center">{if $pdata.status ne 'tba'}{$pdata.deadline|date_format:"%e %b, %Y"}{else}TBA{/if}</div>
                </div>
            </div>
            <div class="programme_details_line"> &nbsp;</div>
      </div>
      
	  <div class="clear"></div>
	 	  <div class="basic" style="float:left;"  id="list1a">
			<a style="display:{if $pdata.introduction eq ""}none;{/if}">Introduction</a>
			<div class="basic_txt">{$pdata.introduction}</div>
			<a style="display:{if $pdata.objective eq ""}none;{/if}">Programme Objective</a>
			<div class="basic_txt">{$pdata.objective}</div>
			<a style="display:{if $pdata.curriculum eq ""}none;{/if}">Coverage</a>
            <div class="basic_txt">{$pdata.curriculum}</div>
			<a style="display:{if $pdata.participents eq ""}none;{/if}">Participant Mix</a>
			<div class="basic_txt">{$pdata.participents}</div>
			<a style="display:{if $pdata.testimonials eq ""}none;{/if}">Testimonials</a>
			<div class="basic_txt">{$pdata.testimonials}</div>
			<a style="display:{if $pdata.learningmodel eq ""}none;{/if}">Learning Model</a>
			<div class="basic_txt">{$pdata.learningmodel}</div>
			<a style="display:{if $pdata.fa_facname eq "" and $pdata.facultyinfo eq ""}none;{/if}">Programme Director/Faculty</a>
			 {if $pdata.fa_facname eq "TBA"}
			<div class="basic_txt"><strong>TBA</strong></div>
			{else}
			<div class="basic_txt">{if $pdata.fa_facname ne ""}<strong>{$pdata.fa_facname}</strong><br /><br />{/if}{$pdata.facultyinfo}</div>            
			{/if}
		
			<a style="display:{if $pdata.fa_facname eq "" and $pdata.facultyinfo eq ""}none;{/if}">Additional Programme Director/Faculty</a>
			 {if $pdata.fa_facname2 eq "TBA"}
			<div class="basic_txt"><strong>TBA</strong></div>
			{else}
			<div class="basic_txt">{if $F_name2 ne ""}<strong>
		 		{$F_name2}
			</strong><br /><br />{/if}{$pdata.facultyinfo2}</div>            
			{/if}
			<a style="display:{if $pdata.feecondition eq ""}none;{/if}">Fee and Conditions</a>
			<div class="basic_txt">{$pdata.feecondition}</div>
			
		</div>
	  	
    </div>
    
    <div class="right_pane_new">
    {if $avail eq 'yes'}
    
	<!--<div style="width:188px; height:60px; padding-bottom:{if $pdata.oepimage eq ""}10px{/if};"><a href="#" class="apply"><img src="{$GENERAL.FRONT_IMG_URL}/applyonline-sm.gif" alt="Apply Online" border="0" /></a></div> -->
	
    <div style="width:188px; height:60px; padding-bottom:{if $pdata.oepimage eq ""}10px{/if};"><a href="{$GENERAL.BASE_URL_ROOT}/apply.php?pid={php} echo encrypt($_REQUEST['oepid_']);{/php}#apply"><img src="{$GENERAL.FRONT_IMG_URL}/applyonline-sm.gif" alt="Apply Online" border="0" /></a></div>
	{/if}
    <div style="width:188px; height:60px; padding-bottom:10px;;display:{if $pdata.oepimage neq ""}block{/if}none;"><a href="{$GENERAL.BASE_URL_ROOT}/uploads/Oep-Programmes/{$pdata.oepimage}" ><img src="images/brochuredownload.gif" alt="Brochure Download" border="0" /></a></div>
    <!--<div id="broucherrequestForm"><ul><li><a href="#" class="broucherrequest level2">Request a Printed OFP Brochure  </a></li></ul></div>-->
	<div id="ebroucherrequestForm"><ul><li style="height:18px;"><a href="#" class="ebroucherrequest level2">Request a Printed Brochure</a></li></ul></div>
    <div  style="display:{if $pdata.oepimage neq ""}block{/if}none" ><ul><li><a href="{$GENERAL.BASE_URL_ROOT}/uploads/Oep-Programmes/{$pdata.oepimage}" class="level2" >Download a PDF Brochure </a></li></ul></div>
   
   
   <div style="display:{if $gdata.name neq ""}block{/if}none">
   <ul><li>
	<a  class="thickbox " href="{$GENERAL.BASE_URL_ROOT}/show-photo-gallery.php?keepThis=true&amp;catid={$gdata.pgid|escape}&amp;TB_iframe=true&amp;height=420&amp;width=724&amp;title={$gdata.name}"/>	
        {$gdata.name}
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
{include file="footer.tpl"}
</div>
{include_php file="bar.php"}
</body>
</html>