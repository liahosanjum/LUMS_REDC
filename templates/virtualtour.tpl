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
  	<!--<div class="left_pane">
    	
		<div class="left_links"><a href="" class="level2" ></a></div>
	  <div class="left_links"><a href="#" class="level2" >Conference</a></div>
	  
       <div class="add"><a href="#" ><img src="{$GENERAL.FRONT_IMG_URL}/requestafacility.gif" alt="Programme Finder"  border="0"/></a></div><div class="add1"><a href="{php}echo SITE_URL;{/php}/virtualtour.php" ><img src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>
    </div>-->
    <div class="right_pane_lvl1_virtual">        
      <div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat; padding-bottom:26px; width:951px; "><h1>{$pagedata.pagetitle}</h1></div>
          <div class="contents_body_virtual">
		  {$pagedata.details}
		  <img src="{$GENERAL.FRONT_IMG_URL}/virtual.jpg" width="951" height="1836" usemap="#VirtualTour" style="border:none" />
<map name="VirtualTour" id="VirtualTour">
  <area shape="rect" coords="433,206,457,223" href="tour.php?keepThis=true&amp;catid=1&amp;TB_iframe=true&amp;height=420&amp;width=724" alt="Auditorium REC1" class="thickbox" />
<area shape="rect" coords="430,263,455,281" href="tour.php?keepThis=true&amp;catid=2&amp;TB_iframe=true&amp;height=420&amp;width=724" alt="" class="thickbox" />
<area shape="rect" coords="179,415,203,433" href="tour.php?keepThis=true&amp;catid=4&amp;TB_iframe=true&amp;height=420&amp;width=724" alt="" class="thickbox" />
<area shape="rect" coords="458,501,483,521" href="tour.php?keepThis=true&amp;catid=11&amp;TB_iframe=true&amp;height=420&amp;width=724" alt="" class="thickbox" />
<area shape="rect" coords="412,595,439,617" href="tour.php?keepThis=true&amp;catid=10&amp;TB_iframe=true&amp;height=420&amp;width=724" alt="" class="thickbox" />
<area shape="rect" coords="426,841,448,863" href="tour.php?keepThis=true&amp;catid=8&amp;TB_iframe=true&amp;height=420&amp;width=724" alt="" class="thickbox" />
<area shape="rect" coords="541,855,566,876" href="tour.php?keepThis=true&amp;catid=7&amp;TB_iframe=true&amp;height=420&amp;width=724" alt="" class="thickbox" />
<area shape="rect" coords="479,884,505,902" href="tour.php?keepThis=true&amp;catid=6&amp;TB_iframe=true&amp;height=420&amp;width=724" alt="" class="thickbox" />
<area shape="rect" coords="535,1055,558,1076" href="tour.php?keepThis=true&amp;catid=3&amp;TB_iframe=true&amp;height=420&amp;width=724" alt="" class="thickbox" />
<area shape="rect" coords="253,1066,278,1084" href="tour.php?keepThis=true&amp;catid=12&amp;TB_iframe=true&amp;height=420&amp;width=724" alt="" class="thickbox" />
<area shape="rect" coords="469,1529,494,1549" href="tour.php?keepThis=true&amp;catid=5&amp;TB_iframe=true&amp;height=420&amp;width=724" alt="" class="thickbox" />
<area shape="rect" coords="378,399,404,416" href="tour.php?keepThis=true&amp;catid=3&amp;TB_iframe=true&amp;height=420&amp;width=724" alt="" class="thickbox" />
</map>		  </div>        
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