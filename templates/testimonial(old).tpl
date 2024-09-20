<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />
<title>Alumni Testimonials</title>
{include file="includes.tpl"}
<!--<script src='{$GENERAL.BASE_URL_ROOT}/js/alumnilogin.js' type='text/javascript'></script>-->
{literal}
<script type="text/javascript">
	function logoutAlumni()
	{
		document.forms["logout"].submit();
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
		
		 
 		{php}	
	  	if(!isset($_SESSION['alumniuser']) || $_SESSION['alumniuser'] == "") 
		{ {/php}
	  <li>
	  		<!--<a class="alumnilogin" href="javascript:void(0)">Alumni Login</a>-->
			<a href="{$GENERAL.BASE_URL_ROOT}/alumni_login.php" class="alumnilogin">Alumni Login</a>
	  </li>
	{php} } {/php}    	
		<li>
	  		<!--<a class="alumnilogin" href="javascript:void(0)">Alumni Login</a>-->
			<a href="{$GENERAL.BASE_URL_ROOT}/testimonial.php?section_id=9" class="alumnilogin">Alumni Testimonials</a>
	  </li>
 		{php}	
	  	if(isset($_SESSION['alumniuser'])) 
		{ {/php}

	  <li>
	  		<a href="{$GENERAL.BASE_URL_ROOT}/alumni_directory.php">Alumni Directory</a>
	  </li>
	{php} } {/php}

		{foreach from=$section_data item ="entry"}
      <li><a class="{if $smarty.get.pcid eq $entry.pcid}selected{/if}" href="{$GENERAL.BASE_URL_ROOT}/alumni.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a></li>
	  {/foreach}
 		{php}	
	  	if(isset($_SESSION['alumniuser'])) 
		{ {/php}

	  <li>
	  		<a href="{$GENERAL.BASE_URL_ROOT}/alumni_history.php">Attended programmes</a>
	  </li>
	  <li>
	  		<a href="{$GENERAL.BASE_URL_ROOT}/alumni_profile.php">Alumni Profile Management</a>
	  </li>
	 
	  <li>
	  	<form name="logout" id="logout" method="post" action="alumni_login.php">
			<a href="#" onclick="logoutAlumni();">Logout</a>
			<input type="hidden" name="abc" value="logout" />
		</form>
	  </li>
	{php}  	}  {/php}
	  
	  </ul>
	  
	  <div class="clear"></div>
		<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="#"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="#"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
       <!--<div class="add"><a href="#" ><img src="{$GENERAL.FRONT_IMG_URL}/requestafacility.gif" alt="Programme Finder"  border="0"/></a></div><div class="add1"><a href="#" ><img src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>-->
    </div>
    <div class="right_pane_lvl1">
          <div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat;"><h1>Alumni Testimonials</h1></div>
          <div class="contents_body_cms">
       {php}$index = 0;{/php}
       {foreach from=$category item="entry"}
  		<div class="news_pane_faq">
		 {php}$faqdata = getFaqData($this->_tpl_vars['category'][$index]['oepid']); {/php}
		<div class="faq_heading"  id="category_{$entry.oepid}"><a href="#" onclick="showQuestions('category_{$entry.oepid}', 'questions_{$entry.oepid}', 'imgTree_{$entry.oepid}')"><img id="imgTree_{$entry.oepid}" src="{$GENERAL.FRONT_IMG_URL}/plus.gif"/> &nbsp;{$entry.name}</a></div>
		{php}
			if($faqdata[0]['details'] != "")
			{
		{/php}
		 <div style="float:left;display:none;" id="questions_{$entry.oepid}" >
        {php}   
						
					for($i=0; $i < count($faqdata); $i++)
					{
					   
							 
					{/php}
					
			 
						<div  style="border-bottom:1px solid #CCCCCC;color:black;padding:10px 0px 10px 15px;font-size:10px;font-family:Verdana,Geneva,sans-serif; height:auto;width:680px;" >
						{php}echo str_replace("<p>","",str_replace("</p>","",str_replace("&nbsp;","",$faqdata[$i]['details'])));{/php}</div>
						
					{php}
						 								
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
	<div class="tabs"></div>
</div>
{include file="footer.tpl"}
</div>
{include_php file="bar.php"}
</body>
</html>