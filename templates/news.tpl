<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>{$pagedata.explorertitle}</title>
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />

{include file="includes.tpl"}
</head>
<body>
<div id="main_container">
 {include_php file="header.php"}
<div class="contentspane">
  <div  class="content">
    <div class="left_pane">
	<ul>
	   <li><a href="site_map.php?pagename=Site Map" class="level2" >Site Index</a></li>
      <li><a href="faq.php?pagename=FAQs&section_id=0" class="level2" >FAQs</a></li>
      <li><a href="news.php?pagename=News and Events" class="{if $samrty.get.pagename eq $pagedate.pagename}selected{/if}" >News/Events</a></li>
	  </ul>
       <div><a href="virtualtour.php" ><img style="padding-top:20px;" src="{$GENERAL.FRONT_IMG_URL}/virtualtour.gif" alt="Virtual Tour"  border="0"/></a></div>
        <div class = "add1">
    <a href="{$GENERAL.BASE_URL_ROOT}/prog_finder.php?section_id=0" ><img src="{$GENERAL.FRONT_IMG_URL}/program_finder.gif" alt="Programme Finder"  border="0"/></a></div>
	<div class="clear"></div>
		<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
    </div>
    <div class="right_pane_lvl1">
			
			{if $smarty.get.id ne ""}
             <div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat;"><h1>{$pagedata.pagetitle}</h1></div>
           <!-- <div class="main_heading">{$pagedata.pagetitle}</div>-->
			<div class="news_heading123">{$news.title}</div>
			<div class="contents_body">
				<div class="news_pane_detail">
				  <div style="height:3px;">&nbsp;</div>
					<div class="date_event" style="padding-top:8px;">{$news.dated|date_format:"%e %b, %Y"}</div>
					<div style="padding-top:15px;padding-bottom:15px">{$news.description}</div>
					<div class="" align="right"><a href="{php}echo SITE_URL;{/php}/news.php?page={$entry.dated}&id={$entry.nid}&section_id=0" class="level2 left_links_news_events">View All</a></div>
				</div>
			</div>				
			{else}	
            
			  <div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat;"><h1>{$pagedata.pagetitle}</h1></div>
			<div class="contents_body_cms">
				<!--<div>{$pagedata.details}</div>-->
				{foreach from=$news item ="entry"}
				<div class="news_pane">
				  <div class="news_heading_seeall"><a href="{php}echo SITE_URL;{/php}/news.php?page={$entry.dated}&id={$entry.nid}&section_id=0">{$entry.title}</a></div>
                  <div style="height:8px;">&nbsp;</div>
					<div class="date_event">{$entry.dated|date_format:"%e %b, %Y"}</div>
					<div style="padding-top:15px;padding-bottom:15px">{$entry.description|strip_tags|truncate:300}</div>
					<div class="left_links_news_events"><a href="{php}echo SITE_URL;{/php}/news.php?page={$entry.dated}&id={$entry.nid}&section_id=0" class="level2" >Read More</a></div>
				
                </div>
				{/foreach}
				
			</div>
            
		{/if}
		
		
	</div>
	
  </div>
  
</div>

<div class="clear"></div>

<div class="tabs_bar">
<div style="width:88%; display:{if $pagenum < 10}none;{/if}">{$paging}</div>	
<div class="tabs">
		
	</div>
</div>
{include file="footer.tpl"}
</div>
{include_php file="bar.php"}
</body>
</html>