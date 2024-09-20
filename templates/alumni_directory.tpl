<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />
<title>REDC Alumni Directory</title>
{include file="includes.tpl"}
{literal}
<script type="text/javascript">
	function logoutAlumni()
	{
		document.forms["logout"].submit();
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
	 <li>
	  <a href="{$GENERAL.BASE_URL_ROOT}/testimonial.php?section_id=9" >REDC Alumni Testimonials</a>
	  </li>
      <li>
	  		<a class="selected">REDC Alumni Directory</a>
	  </li>
   	  {foreach from=$section_data item ="entry"}
      <li>
	  	<a href="{$GENERAL.BASE_URL_ROOT}/alumni.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a>
	  </li>
	  {/foreach}
      <li>
	  		<a href="{$GENERAL.BASE_URL_ROOT}/alumni_history.php">Attended programmes</a>
	  </li>
	  <li>
	  		<a href="{$GENERAL.BASE_URL_ROOT}/alumni_profile.php" >REDC Alumni Profile Management</a>
	  </li>
	  
	  {php}	
	  	if(isset($_SESSION['alumniuser'])) 
		{ {/php}
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
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
       <!--<div class="add"><a href="#" ><img src="{$GENERAL.FRONT_IMG_URL}/requestafacility.gif" alt="Programme Finder"  border="0"/></a></div><div class="add1"><a href="#" ><img src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>-->
    </div>
    <div class="right_pane_lvl1">
      <div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat;"><h1>REDC Alumni Directory</h1></div>
          <!--<div class="main_heading">REDC Alumni Directory</div>-->
          <div class="contents_body_cms_alumni">
				<div class="list_cont">
						  <table cellpadding="0" cellspacing="1" border="0" width="100%" bgcolor="#ffffff">
								<tr><td width="140" class="alumni_dir_list"><span style="width:73px">Name</span></td>
								<td width="200" class="alumni_dir_list"><span style="width:73px">Organization</span></td>
								<td width="130" class="alumni_dir_list"><span style="width:73px">Designation</span></td>
								</tr>
								
						   {foreach from=$data item="entry" name=list}
								{if $smarty.foreach.list.index % 2 eq 0}
									{assign var="class" value="alumni_dir_list1"}	
								{else}
									{assign var="class" value="alumni_dir_list2"}	
								{/if}

								
								
								<tr><td width="140" class="{$class}"><span style="width:73px">{$entry.prefix} {$entry.firstname}</span></td>
								<td width="200" class="{$class}"><span style="width:73px">{$entry.companyname}</span></td>
								<td width="130" class="{$class}"><span style="width:73px">{$entry.designation}</span></td>
								</tr>
							
							{/foreach}
							
							</table>
							   
								   
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