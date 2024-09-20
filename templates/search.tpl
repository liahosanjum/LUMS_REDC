<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<title>Search Results{$pagedata.explorertitle}</title>
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
<!--      <div class="left_links"><a href="" class="level2" ></a></div>-->
	  <!--<div class="left_links"><a href="#" class="level2" >Conference</a></div>-->
	  
       <div id="conferenceservicesrequestForm"><a href="#" class="conferenceservice"><img style="padding-top:0px;" src="{$GENERAL.FRONT_IMG_URL}/requestafacility.gif" alt="Programme Finder"  border="0"/></a></div><div class="add1"><a href="{php}echo SITE_URL;{/php}/virtualtour.php" ><img src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>
		<div class="clear"></div>
		<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
    </div>
    <div class="right_pane_lvl1">
     <!--<div class="main_heading" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat; width:744px; height:110px;"><h1>{$pagedata.pagetitle} Search results for : {$smarty.get.search} Search results for : {$smarty.get.search}</h1> </div>-->
		  <div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat;"><h1>
		  Search results for : {$smarty.get.search}</h1></div>
         <!--<div class="main_heading_cms">{$pagedata.pagetitle} Search results for : {$smarty.get.search}</div>	 	-->	
		 		{$pagedata.list_search_detail}
			  <div class="contents_body_cms">
				{foreach from=$results item ="entry"}
					<div style="padding-bottom:10px">
				  <div class="left_links"><strong>{$entry.title}</strong></div>
				  <div style="padding-bottom:10px" >
				  {$entry.detail|strip_tags|truncate:300} </div>
				  <div>
				  {if $entry.type eq 'Unique'}
				  <a href="{php}echo SITE_URL;{/php}/redc_unique.php?section_id={$entry.section_id}&pcid={$entry.item_id}" class="list_search_detail ">Detail</a>
				  {elseif $entry.type eq 'Facilities'}
				  <a href="{php}echo SITE_URL;{/php}/facilites.php?section_id={$entry.section_id}&pcid={$entry.item_id}" class="list_search_detail ">Detail</a>
				  {elseif $entry.type eq 'Faculty'}
				  <a href="{php}echo SITE_URL;{/php}/faculty.php?section_id={$entry.section_id}&pcid={$entry.item_id}" class="list_search_detail ">Detail</a>
				  {elseif $entry.type eq 'Conference'}
				  <a href="{php}echo SITE_URL;{/php}/conference_services.php?section_id={$entry.section_id}&pcid={$entry.item_id}" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'Alumni'}
				  <a href="{php}echo SITE_URL;{/php}/alumni.php?section_id={$entry.section_id}&pcid={$entry.item_id}" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'Enrollments'}
				  <a href="{php}echo SITE_URL;{/php}/enrollment.php?section_id={$entry.section_id}&pcid={$entry.item_id}" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'OFP'}
				  <a href="{php}echo SITE_URL;{/php}/ofp_programme.php?section_id={$entry.section_id}&pcid={$entry.item_id}" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'CMS'}
				  <a href="{php}echo SITE_URL;{/php}/cms.php?section_id={$entry.section_id}&pcid={$entry.item_id}" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'news'}
				  <a href="{php}echo SITE_URL;{/php}/news.php?id={$entry.item_id}" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'programme'}
				  <a href="{php}echo SITE_URL;{/php}/programmedetail.php?oepid_={$entry.item_id}&oepcatid={$entry.section_id}" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'faqcategory'}
				  <a href="{php}echo SITE_URL;{/php}/faq.php?fcatid={$entry.item_id}" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'faq'}
				  <a href="{php}echo SITE_URL;{/php}/faq.php?fcatid={$entry.section_id}" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'Map'}
				  <a href="{php}echo SITE_URL;{/php}/site_map.php" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'Finder'}
				  <a href="{php}echo SITE_URL;{/php}/prog_finder.php" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'Search'}
				  <a href="{php}echo SITE_URL;{/php}/search.php" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'Virtual'}
				  <a href="{php}echo SITE_URL;{/php}/virtualtour.php" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'OFP'}
				  <a href="{php}echo SITE_URL;{/php}/ofp_programme.php?section_id={$entry.section_id}&pcid={$entry.item_id}" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'OEP'}
				  <a href="{php}echo SITE_URL;{/php}/oep_programme.php?section_id={$entry.section_id}&pcid={$entry.item_id}" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'News'}
				  <a href="{php}echo SITE_URL;{/php}/news.php" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'FAQs'}
				  <a href="{php}echo SITE_URL;{/php}/faq.php" class="list_search_detail">Detail</a>
				  {elseif $entry.type eq 'Directory'}
				  <a href="{php}echo SITE_URL;{/php}/faculty_profiles.php?section_id=4" class="list_search_detail">Detail</a>
				  {/if}
				  </div>
				  </div>
				{/foreach}
					
			    <div class="page_num">{$paging}</div> 
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