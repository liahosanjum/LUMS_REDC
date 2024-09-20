{php}
		$id = 0;
		if(isset($_SESSION['userid']))
		$id = $_SESSION['userid'];
		$logged = $_REQUEST['cmd'];

{/php}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />
<title>{$pagedata.explorertitle}</title>
<script language="javascript">
	var uid 	   = '{php} echo $id;{/php}';
	var oepid 	   = '';
	var section_id = '{php}echo $_REQUEST[section_id];{/php}';
	var pcid       = '{php}echo $_REQUEST[pcid];{/php}';
	var callbackurl = '{php}echo SITE_URL;{/php}/enrollment.php?section_id='+section_id+'&pcid='+pcid;
	var iflogged = '{php}echo $logged;{/php}';
</script>

{include file="includes.tpl"}
<link type='text/css' href='{$GENERAL.BASE_URL_ROOT}/css/applyonline.css' rel='stylesheet' media='screen' />
<link type='text/css' href='{$GENERAL.BASE_URL_ROOT}/css/form.css' rel='stylesheet' media='screen' />

<!-- Contact Form JS and CSS files -->
<script src='{$GENERAL.BASE_URL_ROOT}/js/applyonline.js' type='text/javascript'></script>
<script src="{$GENERAL.BASE_URL_ROOT}/js/mouseovertabs.js" type="text/javascript"></script>
<script type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/animatedcollapse.js"></script>
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
		<ul>
    	{foreach from=$section_data item ="entry"}
      <li><a class="{if $smarty.get.pcid eq $entry.pcid}selected{/if}" href="{$GENERAL.BASE_URL_ROOT}/enrollment.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a></li>
	  <!--<div class="left_links"><a href="#" class="level2" >Conference</a></div>-->
	  {/foreach}
	  </ul>
       <div ><a href="{$GENERAL.BASE_URL_ROOT}/calendar.php"><img style="padding-top:20px;" src="{$GENERAL.FRONT_IMG_URL}/applyonline.gif" alt="Programme Finder"  border="0"/></a></div>
	   <div class="add1"><a href="{php}echo SITE_URL;{/php}/prog_finder.php?section_id=0" ><img src="images/program_finder.gif" alt="Programme Finder"  border="0"/></a></div>
	   <!--<div id="ebroucherrequestForm"><a href="#" class="ebroucherrequest" ><img src="images/brochuredownload.gif" alt="Programme Finder"  border="0"/></a></div>-->
	   <ul><li><a href="#" class="ebroucherrequest level2">Request an OEP Printed Brochure  </a></li></ul>
	   <div class="clear"></div>
	   
		<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
	   
    </div>
    <div class="right_pane_lvl1">
        
           <div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat;"><h1>{$pagedata.pagetitle}</h1></div>
          <div class="contents_body_cms">
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