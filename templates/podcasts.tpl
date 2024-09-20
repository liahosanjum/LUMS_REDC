<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<title>{$pagedata.explorertitle}</title>
<link href="{$GENERAL.BASE_URL_ROOT}/css/style.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="{$GENERAL.BASE_URL_ROOT}/css/screen.css" type="text/css" media="screen" />
    <!--[if lt IE 7]>
    <link rel="stylesheet" href="{$GENERAL.BASE_URL_ROOT}/css/screen_ie.css" type="text/css" media="screen" />
    <![endif]-->
	
	
	
<link rel="stylesheet"type="text/css" href="{$GENERAL.BASE_URL_ROOT}/css/mouseovertabs.css" />
<link rel="stylesheet"type="text/css" href="{$GENERAL.BASE_URL_ROOT}/css/contact.css" />
<link rel="stylesheet"type="text/css" href="{$GENERAL.BASE_URL_ROOT}/css/thickbox.css" />
<script src="{$GENERAL.BASE_URL_ROOT}/js/common.js" type="text/javascript"></script>
<script src="{$GENERAL.BASE_URL_ROOT}/js/jquery.min.js" type="text/javascript"></script>
<script src="{$GENERAL.BASE_URL_ROOT}/js/thickbox.js" type="text/javascript"></script>
<script src="{$GENERAL.BASE_URL_ROOT}/js/mouseovertabs.js" type="text/javascript"></script>
<script type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/animatedcollapse.js"></script>
<script src='{$GENERAL.BASE_URL_ROOT}/js/jquery.simplemodal.js' type='text/javascript'></script>
<script src='{$GENERAL.BASE_URL_ROOT}/js/contact.js' type='text/javascript'></script>
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
    <div class="left_pane">
    	
      <div class="left_links"><a href="" class="level2" ></a></div>
	  <!--<div class="left_links"><a href="#" class="level2" >Conference</a></div>-->
	  
       <div class="add"><a href="#" ><img src="{$GENERAL.FRONT_IMG_URL}/requestafacility.gif" alt="Programme Finder"  border="0"/></a></div><div class="add1"><a href="#" ><img src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>
		<div class="clear"></div>
		<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
    </div>
    <div class="right_pane_lvl1">
	{*if $smarty.get.id ne "" && $smarty.get.page ne ""*}
	{if $smarty.get.id ne ""}
	<div class="news_date">{$news.dated|date_format:"%b"}&nbsp;&nbsp;{$news.dated|date_format:"%d"}&nbsp;&nbsp;{$news.dated|date_format:"%Y"}
	</div>
					
					 <div class="left_links"><a href="" class="level2" style="font-size:12px;" >{$news.title}</a></div>
					<div class="contents_body">{$news.description}</div>					
					<div><a class="back_new" href="{php}echo SITE_URL;{/php}/news.php"><img src="{$GENERAL.FRONT_IMG_URL}/back_new.gif" alt="" /></a></div>
				
			{else}		
        {foreach from=$podcasts item ="entry"}
		  <div class="left_links">{$entry.title}</div>
          <div class="contents_body">
		  <a href="{$GENERAL.BASE_URL_ROOT}/uploads/podcasts/{$entry.pvideo}">Download</a>
		  </div>		  
        {/foreach}
		{if $podcasts ne null}
    	<div class="page_num">{$paging}</div> 
		{/if}
	</div>
	
  </div>
  {/if}
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