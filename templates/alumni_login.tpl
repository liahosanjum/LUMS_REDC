<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />
<title>REDC Alumni Login Area</title>

{include file="includes.tpl"}
<!--<script src='{$GENERAL.BASE_URL_ROOT}/js/alumnilogin.js' type='text/javascript'></script>-->
</head>
<body>
<div id="main_container">
 {include_php file="header.php"}
<div class="contentspane">
  <div  class="content">
    <div class="left_pane">
	<ul>
      <li>
	  		<!--<a class="selected" href="{$GENERAL.BASE_URL_ROOT}/alumni_login.php">REDC Alumni Login</a>-->
            <a class="selected alumnilogin" href="{$GENERAL.BASE_URL_ROOT}/alumni_login.php" >REDC Alumni Login</a>
	  </li>
	   <li>
	  <a href="{$GENERAL.BASE_URL_ROOT}/testimonial.php?section_id=9" >REDC Alumni Testimonials</a>
	  </li>
    	{foreach from=$section_data item ="entry"}
      <li>
	  	<a href="{$GENERAL.BASE_URL_ROOT}/alumni.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a>
	  </li>
	  {/foreach}
    </ul>
		<div class="clear"></div>
		<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
       <!--<div class="add"><a href="#" ><img src="{$GENERAL.FRONT_IMG_URL}/requestafacility.gif" alt="Programme Finder"  border="0"/></a></div><div class="add1"><a href="#" ><img src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>-->
    </div>
    <div class="right_pane_lvl1">
      
      <div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat;"><h1>REDC Alumni Login Area</h1></div>
         <!-- <div class="main_heading">REDC Alumni Login Area</div>-->
          <div class="contents_body_cms">
		  		<div class="forms-apply">
				<div id="msg" class="errorTxt">
					{if $error ne ""}
					   {$error}
					{/if}
				</div>	
				<form name="frm_alumni_login" method="post" id="frm_alumni_login" action="alumni_login.php?action=submit">
					 <input type="hidden" name="returnURL" id="returnURL" value="{$returnUR}" />
				    <div class="forminputs-alumni">
					<ul>
						<li class='txt'>Email (user name):<span class='required'>*</span></li>
						<li>
							<input type='text' name='username' tabindex='1001' maxlength='30' class='bluebar' />
						</li>
					</ul>
					<ul>
						<li class='txt'>Password:<span class='required'>*</span></li>
						<li>
							<input type='password' class='bluebar' name='password' maxlength='30' tabindex='1002' />
						</li>	
					</ul>
		
					<ul>
						<li style='width:269px;'>&nbsp;</li>
						<li>
							<button type='submit' class='next-apply apply-checklogin apply-button' tabindex='1003'>Login &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
						</li>	
					
					</ul>
					</div>
				</form>	 
				</div>  	
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