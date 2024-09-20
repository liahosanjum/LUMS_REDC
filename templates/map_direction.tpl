<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />
<title>{$pagedata.explorertitle}</title>
{include file="includes.tpl"}

</head>
<body>
<div id="main_container">
 {include_php file="header.php"}
<div class="contentspane">
  <div  class="content">
    
	
	
	<div class="left_pane">
	<ul>
      <li><a href="site_map.php?pagename=Site Map" class="{if $smarty.get.pagename eq $pagedata.pagename}selected{/if}" >Site Index</a></li>
      <li><a href="{$GENERAL.BASE_URL_ROOT}/faq.php?pagename=FAQs&section_id=0" class="level2" >FAQ</a></li>
      <li><a href="{$GENERAL.BASE_URL_ROOT}/news.php?pagename=News and Events" class="level2" >News/Events</a></li>
	 </ul>
		<!--<ul>
    	{foreach from=$section_data item ="entry"}
      <li><a class="{if $smarty.get.pcid eq $entry.pcid}selected{/if}" href="{$GENERAL.BASE_URL_ROOT}/facilites.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a></li>
	 
	  {/foreach}
	  </ul>-->
       <div class="add1"><a href="{$GENERAL.BASE_URL_ROOT}/virtualtour.php" ><img style="padding-top:20px;" src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>
	<div class="clear"></div>
		<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
    </div>
<div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat; padding-bottom:26px; width:744px; "><h1>{$pagedata.pagetitle}</h1></div>
    <div class="right_pane_lvl1">
        
          <!--<div class="main_heading">{$pagedata.pagetitle}</div>-->
          <div class="contents_body">
		  {$pagedata.details}
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