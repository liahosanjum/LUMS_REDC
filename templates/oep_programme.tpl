{php}
		$id = 0;
		if(isset($_SESSION['userid']))
		$id = $_SESSION['userid'];
		$logged = $_REQUEST['cmd'];
		$alreadyApplied = 0;

{/php}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<title>{$pagedata.explorertitle}</title>

<script language="javascript">
	var uid 	 = '{php} echo $id;{/php}';
	var oepid 	 = '';
	var callbackurl = '{php}echo SITE_URL;{/php}/oep_programme.php?section_id=0&pcid='+{$smarty.get.pcid};
	var iflogged = '{php}echo $logged;{/php}';
	var alreadyApplied = '{php}echo $alreadyApplied;{/php}';
</script>

{include file="includes.tpl"}
<script src='{$GENERAL.BASE_URL_ROOT}/js/applyonline.js' type='text/javascript'></script>
{literal}
<script type="text/javascript">

animatedcollapse.addDiv('tabs', 'fade=1')
animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
}
animatedcollapse.init()

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
			<li><a href="#" class="{if $smarty.get.pcid neq ''}selected{/if}" onclick="javascript:showDiv('oep');" ><strong>Open Enrollment Programmes</strong></a></li>
		</ul>
		</div>
		<div id="oep" style="display:block; padding-bottom:10px;">
			{php}$index = 0;{/php}
			<ul style="padding-left:10px;">
				{foreach from=$category item="entry"}		
				<li class="level1">
				{php}$programmes = getProgrammes($this->_tpl_vars['category'][$index]['oepcatid']); {/php}
				<a href="#" onclick="showDiv('programmes_{$entry.oepcatid}');" >{$entry.name}</a>
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
								<a  href="programmedetail.php?oepid ={php}echo $programmes[$i]['oepid'];{/php}&oepcatid={$entry.oepcatid}" >{php}echo $programmes[$i]['name'];{/php}</a></li>
					{php}
						}
					else
						{	
					{/php}
								<li class="level2">
								<a  href="programmedetail.php?oepid ={php}echo $programmes[$i]['oepid'];{/php}&oepcatid={$entry.oepcatid}" >{php}echo $programmes[$i]['name'];{/php}</a></li>
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
			<li><a href="#" onclick="javascript:showDiv('ofp');" ><strong>Organization Focused Programmes</strong></a></li>
		</ul>
		</div>
		<div id="ofp"  style="padding-left:10px; display:none; padding-bottom:10px; padding-bottom:0px;">
		<ul >
        {foreach from=$page item="entry"}
		<li class="level1">
		<a class="{if $smarty.get.pcid eq $entry.pcid}selected{/if}" href="ofp_programme.php?section_id={$entry.psid}&pcid={$entry.pcid}" >{$entry.pagename}</a></li>
		{/foreach}
		</ul>
		</div>
		<div class="clear" style="float:left"></div>
       <div  ><a href="{php}echo SITE_URL;{/php}/prog_finder.php" ><img style="padding-top:20px;" src="images/program_finder.gif" alt="Programme Finder"  border="0"/></a>  {$pageimage.new_image}</div>
		<!--<div><img style="padding-top:20px; width:198px;" src="images/logo_social.jpg" alt="logo_social"  border="0"/></div>-->
	   <div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/search/?ref=search&q=redc&init=quick#/group.php?v=wall&gid=235217154393" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
	   <!--<div id="ebroucherrequestForm">
	   <ul>
	   		<li><a href="#" class="ebroucherrequest">Request a Printed Brochure</a></li>
			<li><a href="{$GENERAL.BASE_URL_ROOT}/prog_finder.php" >Programme Finder</a></li>
			<li><a href="#" >Calendar</a></li>
	   </ul>
	   </div>-->
    </div>
	<div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat; padding-bottom:26px; width:744px;  "><h1>{$pagedata.pagetitle}</h1></div>
	<div style="clear:right; padding:0px;">
	<div class="center_pane">
            <div class="programme_description" >{$pagedata.details}</div>
    </div>
    <div class="right_pane_new">
		<div style="width:188px; height:60px; padding-bottom:{if $pdata.oepimage eq ""}10px{/if};">
			<a href="{$GENERAL.BASE_URL_ROOT}/calendar.php"><img src="{$GENERAL.FRONT_IMG_URL}/applyonline-sm.gif" alt="Apply Online" border="0" /></a>
		</div>
		<div id="ebroucherrequestForm"><ul><li style="height:27px;"><a href="#" class="ebroucherrequest level2">Request an OEP Printed Brochure</a></li></ul></div>
        <div id="ebroucherrequestForm"><ul><li style="height:27px;"><a target="_blank" href="{$GENERAL.BASE_URL_ROOT}/uploads/OEP Application Form (4).pdf" class="level2">Download OEP Application Form</a></li></ul></div>
    	<div  style="display:{if $pdata.oepimage neq ""}block{/if}none" >
			<ul><li><a href="{$GENERAL.BASE_URL_ROOT}/uploads/Oep-Programmes/{$pdata.oepimage}" class="level2" >Download a PDF Brochure </a></li></ul>
		</div>
    </div>
	</div>
  </div>
</div>
<div class="clear"> </div>
<div class="tabs_bar">
	<div class="tabs"></div>
</div>
{include file="footer.tpl"}
{if $smarty.get.mdp eq 'true'}
<a style="display:none" href="playmdpvideo.php?keepThis=true&amp;TB_iframe=true&amp;height=370&amp;width=450" alt="Management Development Programme" class="thickbox" id="thickBoxLink"></a>
{literal}
<script language="javascript" type="text/javascript">
$(document).ready( function() { 
    $("#thickBoxLink").trigger("click"); 
} );
</script>
{/literal}
{/if}
</div>
{include_php file="bar.php"}


</body>
</html>