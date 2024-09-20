<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<title>{$pagedata.explorertitle}</title>
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />
<script type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/fixPNG.js"></script>
{include file="includes_faq.tpl"}
{literal}
<script type="text/javascript">
	
			function showDiv(divId)
        		{
					 var divPane = document.getElementById(divId);
					if(divPane.style.display == "none")
					{
						divPane.style.display = "";
					}
					else if(divPane.style.display == "block" || divPane.style.display == "")
					{
						divPane.style.display = "none";
					}
        		}
	
			function showQuestions(cDiv, qDiv, imgTree)
			{
				
				jQuery('#' + qDiv).toggle(); 
//				alert(document.getElementById(qDiv).style.display);
				
				if(document.getElementById(qDiv).style.display == 'none')
				{
					$('#' + cDiv).removeClass('faq_heading_active');
//					alert('<?{$GENERAL.FRONT_IMG_URL}?>');
					document.getElementById(imgTree).src = {/literal}'{$GENERAL.FRONT_IMG_URL}'{literal}+ "/plus.gif";
				}
				else
				{
					$('#' + cDiv).addClass('faq_heading_active');
					//alert({/literal}'{$GENERAL.FRONT_IMG_URL}'{literal});
					document.getElementById(imgTree).src = {/literal}'{$GENERAL.FRONT_IMG_URL}'{literal}+ "/minus.gif";
				}		

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
	<ul>
      <li><a href="site_map.php?pagename=Site Map" class="level2"  >Site Index</a></li>
      <li><a href="faq.php?pagename=FAQs&section_id=0" class="{if $smarty.get.pagename eq $pagedata.pagename}selected{/if}">FAQs</a></li>
      <li><a href="news.php?pagename=News and Events" class="level2" >News/Events</a></li>
	 </ul>
      <div><a href="virtualtour.php" ><img style="padding-top:20px;" src="{$GENERAL.FRONT_IMG_URL}/virtualtour.gif" alt="Virtual Tour"  border="0"/></a></div>
        <div class ="add1">
    <a href="{$GENERAL.BASE_URL_ROOT}/prog_finder.php" ><img src="{$GENERAL.FRONT_IMG_URL}/program_finder.gif" alt="Programme Finder"  border="0"/></a></div>
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
       {php}$index = 0;{/php}
       {foreach from=$category item="entry"}
  		<div class="news_pane_faq">
		 {php}$faqdata = getFaqData($this->_tpl_vars['category'][$index]['fcatid']); {/php}
		<div class="faq_heading"  id="category_{$entry.fcatid}"><a href="#" onclick="showQuestions('category_{$entry.fcatid}', 'questions_{$entry.fcatid}', 'imgTree_{$entry.fcatid}')"><img id="imgTree_{$entry.fcatid}" src="{$GENERAL.FRONT_IMG_URL}/plus.gif"/> &nbsp;{$entry.name}</a></div>
		{php}
			if($faqdata[0]['question'] != "")
			{
		{/php}
		 <div class="basic" style="float:left;display:none;" id="questions_{$entry.fcatid}" >
        {php}   
						
					for($i=0; $i < count($faqdata); $i++)
					{
					     if ($faqdata[$i]['question'] != ""){
							 
					{/php}
						<div class="main_faq_accor" id="question_{php}echo $faqdata[$i]['faqid'];{/php}">
                        <a class="main_faq_accor" onclick="showDiv('answer_{php}echo $faqdata[$i]['faqid'];{/php}');">{php}echo $faqdata[$i]['question'];{/php}</a></div>
						
						<div style="display:none" class="basic_txt_answer " id="answer_{php}echo $faqdata[$i]['faqid'];{/php}" >{php}echo $faqdata[$i]['answer'];{/php}</div>
					{php}
						 								}
			}
		{/php}
		</div>
		{php}}{/php}
		</div>
		{php}$index++;{/php}
		{/foreach}
  
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