<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />
<title>{$pagedata.explorertitle}</title>

{include file ="includes.tpl"}
<!--<script src='{$GENERAL.BASE_URL_ROOT}/js/alumnilogin.js' type='text/javascript'></script>-->
<script language="javascript">AC_FL_RunContent = 0;</script>
{literal}
<script type="text/javascript">

animatedcollapse.addDiv('tabs', 'fade=1')
animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
}
animatedcollapse.init()
</script>
{/literal}

</head>
<body>
<div id="main_container">
 {include_php file="header.php"}
<div class="contentspane">
  <div  class="content">
  	<!--<div class="left_pane">
    	
		<div class="left_links"><a href="" class="level2" ></a></div>
	  <div class="left_links"><a href="#" class="level2" >Conference</a></div>
	  
       <div class="add"><a href="#" ><img src="{$GENERAL.FRONT_IMG_URL}/requestafacility.gif" alt="Programme Finder"  border="0"/></a></div><div class="add1"><a href="{php}echo SITE_URL;{/php}/virtualtour.php" ><img src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>
    </div>-->
    <div class="right_pane_lvl1_virtual"> 
		<div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat; padding-bottom:26px; width:951px; "><h1>{$pagedata.pagetitle}</h1></div>       
          <!--<div class="main_heading_virtual">{$pagedata.pagetitle}</div>-->
           <div class="contents_body_siteindex">
		  {$pagedata.details}
		  <div style="float:center; width:950px">
          <div class="link_box_pane">
				<div class="links_box">
				  <div class="link_box_heading">REDC is Unique</div>
						{foreach from=$section_data_unique item ="entry"}
						{if $entry.pagename neq ""}
							<div class="left_links_sitemap"><a class="{if $smarty.get.pcid eq $entry.pcid}selected_sitemap{else}level2_sitemap{/if}" href="{$GENERAL.BASE_URL_ROOT}/redc_unique.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a></div>
							{/if}
						{/foreach}
					  
				 </div>
				<div style="margin-bottom:20px;">
				  <div class="link_box_heading">Programme</div>
					  <div class="left_links_sitemap"><a class="{if $smarty.get.pcid eq '151'}selected_sitemap{else}level2_sitemap{/if}" href="{$GENERAL.BASE_URL_ROOT}/oep_programme.php?section_id=0&pcid=151">Open Enrollment Programme</a></div>
					    <div class="left_links_sitemap"><a class="{if $smarty.get.pcid eq '150'}selected_sitemap{else}level2_sitemap{/if}" href="{$GENERAL.BASE_URL_ROOT}/ofp_programme.php?section_id=0&pcid=150">Organization Focused Programmes</a></div>
						  <div class="left_links_sitemap"><a class="{if $smarty.get.url eq 'prog_finder'}selected_sitemap{else}level2_sitemap{/if}" href="{$GENERAL.BASE_URL_ROOT}/prog_finder.php">Programme Finder</a></div>
						  <div class="left_links_sitemap"><a class="level2_sitemap" href="{$GENERAL.BASE_URL_ROOT}/prog_finder.php">Calendar</a></div>
						  {foreach from=$section_data_programme item ="entry"}
						  {if $entry.pagename neq ""}
					    <div class="left_links_sitemap"><a class="{if $smarty.get.pcid eq $entry.pcid}selected_sitemap{else}level2_sitemap{/if}" href="{$GENERAL.BASE_URL_ROOT}/programme.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a></div>
						{/if}
					{/foreach}
				</div>
				
         </div>
          <div class="link_box_pane">
		  <div class="links_box">
				  <div class="link_box_heading">REDC Alumni</div>
						<div class="left_links_sitemap"><a class="{if $smarty.get.url eq 'alumni_directory'}selected_sitemap{else}level2_sitemap{/if} alumnilogin" href="{$GENERAL.BASE_URL_ROOT}/alumni_login.php">REDC Alumni Login</a></div>
                        <div class="left_links_sitemap"><a class="{if $smarty.get.url eq 'alumni_directory'}selected_sitemap{else}level2_sitemap{/if}" href="{$GENERAL.BASE_URL_ROOT}/testimonial.php?section_id=9">REDC Alumni Testimonials</a></div>
						{foreach from=$section_data_alumni item ="entry"}
						{if $entry.pagename neq ""}
							<div class="left_links_sitemap"><a class="{if $smarty.get.pcid eq $entry.pcid}selected_sitemap{else}level2_sitemap{/if}" href="{$GENERAL.BASE_URL_ROOT}/alumni.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a></div>
							{/if}
						{/foreach}
				 </div>
				<div class="links_box">
				  <div class="link_box_heading">Conference Services</div>
						{foreach from=$section_data_conference item ="entry"}
						{if $entry.pagename neq ""}
							<div class="left_links_sitemap"><a class="{if $smarty.get.pcid eq $entry.pcid}selected_sitemap{else}level2_sitemap{/if}" href="{$GENERAL.BASE_URL_ROOT}/conference_services.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a></div>
							{/if}
						{/foreach}
						<div class="left_links_sitemap"><a class="{if $smarty.get.url eq 'virtualtour'}selected_sitemap{else}level2_sitemap{/if}" href="virtualtour.php?section_id=0&pcid=323">Virtaul Tour</a></div>
				</div>
				<div class="links_box" >
					<div class="link_box_heading">Faculty </div>
					{foreach from=$section_data_faculty item ="entry"}
					{if $entry.pagename neq ""}
						<div class="left_links_sitemap"><a class="{if $smarty.get.pcid eq $entry.pcid}selected_sitemap{else}level2_sitemap{/if}" href="{$GENERAL.BASE_URL_ROOT}/faculty_profiles.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a> </div>
						{/if}
					{/foreach}
					<div class="left_links_sitemap"><a class="{if $smarty.get.url eq 'faculty_profiles'}selected_sitemap{else}level2_sitemap{/if}" href="faculty_profiles.php?section_id=4">Faculty Directory</a></div>
					
			   </div>
          </div>
          <div class="link_box_pane1">
				<div class="links_box">
					  <div class="link_box_heading">Facilities</div>
						{foreach from=$section_data_facilities item ="entry"}
						{if $entry.pagename neq ""}
							<div class="left_links_sitemap"><a class="{if $smarty.get.pcid eq $entry.pcid}selected_sitemap{else}level2_sitemap{/if}" href="{$GENERAL.BASE_URL_ROOT}/facilites.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a></div>
							{/if}
					   {/foreach}
				</div>
				<div class="links_box">
				  <div class="link_box_heading">Enrollment</div>
					{foreach from=$section_data_enrollment item ="entry"}
					{if $entry.pagename neq ""}
						<div class="left_links_sitemap"><a class="{if $smarty.get.pcid eq $entry.pcid}selected_sitemap{else}level2_sitemap{/if}" href="{$GENERAL.BASE_URL_ROOT}/enrollment.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a> </div>
						{/if}
					{/foreach}
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
{include file="footer.tpl"}
</div>
{include_php file="bar.php"}
</body>
</html>