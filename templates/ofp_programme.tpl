<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<title>{$pagedata.explorertitle}</title>
{include file="includes.tpl"}
{literal}
<script type="text/javascript">
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
			<li><a href="#" onclick="javascript:showDiv('oep');" ><strong>Open Enrollment Programmes</strong></a></li>
		</ul>
		</div>
		<div id="oep" style="display:none;padding-bottom:10px;">
			{php}$index = 0;{/php}
			<ul style="padding-left:10px;">
				{foreach from=$category item="entry"}		
				<li class="level1">
				{php}$programmes = getProgrammes($this->_tpl_vars['category'][$index]['oepcatid']);{/php}
				<a href="#"  onclick="showDiv('programmes_{$entry.oepcatid}');" >{$entry.name}</a>
				{php}if($programmes[0]['name'] != ""){{/php}
				<div id="programmes_{$entry.oepcatid}" style="display:none" class="oep_programmes">
					<ul style="margin-left:0px">
					{php}
					for($i=0; $i < count($programmes); $i++)
					{
						if($i==count($programmes)-1)
						{
					{/php}
								<li class="last">
								<a  href="programmedetail.php?oepid ={php}echo $programmes[$i]['oepid'];{/php}" >{php}echo $programmes[$i]['name'];{/php}</a></li>
					{php}
						}
					else
						{	
					{/php}
								<li class="level2">
								<a  href="programmedetail.php?oepid ={php}echo $programmes[$i]['oepid'];{/php}" >{php}echo $programmes[$i]['name'];{/php}</a></li>
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
			<li><a href="#" class="{if $smarty.get.pcid neq ''}selected{/if}" onclick="javascript:showDiv('ofp');" ><strong>Organization Focused Programmes</strong></a></li>
		</ul>
		</div>
		<div id="ofp" style="padding-left:10px; display:block; padding-bottom:10px; padding-top:0px;">
		<ul >
        {foreach from=$page item="entry"}
		<li class="level1">
		<a class="{if $smarty.get.pcid eq $entry.pcid}selected{/if}" href="ofp_programme.php?section_id={$entry.psid}&pcid={$entry.pcid}" >{$entry.pagename}</a></li>
		{/foreach}
		</ul>
		</div>
<div ><a href="{php}echo SITE_URL;{/php}/prog_finder.php" ><img style="padding-top:20px;" src="images/program_finder.gif" alt="Programme Finder"  border="0"/></a></div>
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
<div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat; padding-bottom:26px; width:744px; "><h1>{$pagedata.pagetitle}</h1></div>
	<div style="clear:right; padding:0px;">
    <div class="center_pane">
	<div class="programme_description" style="display:{if $pagedata.details eq ""}none{/if}" >{$pagedata.details}</div>
    </div>
    <div class="right_pane_new">
	<div style="width:188px; height:111px; float:left" id='ofpForm'><a href="#" class='ofp'><img src="images/request-ofp.jpg" alt="Request for Organization Focused Programme" border="0" /></a></div>
	<!--<div style="width:188px; height:61px; float:left; padding-bottom:10px;"><a href="{$GENERAL.BASE_URL_ROOT}/uploads/ofp-brochures/1253012891_brochure.pdf"><img src="images/brochuredownload.gif" alt="Brochure Download" border="0" /></a></div>
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
{include file="footer.tpl"}
</div>
{include_php file="bar.php"}
</body>
</html>