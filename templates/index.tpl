<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Rausing Executive Development Centre</title>
{literal}
<SCRIPT language="JavaScript">
var i = new Image();
var j = new Image();
var k = new Image();
i.src = "images/flash_arrow1.gif";
j.src = "images/flash_arrow2.gif";
k.src = "images/tabs_arow3.gif";
<!--
function preloadImages()
{
	  document.getElementById('imgCache').src="images/tabs_bg.gif"; 
	  document.getElementById('imgCache').src="images/flash_arrow1.gif"; 
	  document.getElementById('imgCache').src="images/flash_arrow2.gif"; 
	  document.getElementById('imgCache').src="images/tabs_arow3.gif"; 	
}


//-->
</SCRIPT>
{/literal}
{include file="includes.tpl"}
<script language="javascript" type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/flash.js"></script>

{literal}
	<script type="text/javascript">
		var heightSet = 0;
		function submitProgFinderForm()
		{
			if(document.getElementById("search_by_name").value == "Programme Name")
				document.getElementById("search_by_name").value = "";
				
			document.forms['prog_finder'].submit();	
		}
		
		function setDropDownHeights()
		{
			if(heightSet == 0)
			{
//				$("#search_by_oepcatid").sSelect();
//				$("#programme_by_level").sSelect();			
//				$("#search_by_month").sSelect();
				heightSet = 1;
			}
		}
	</script>
    
    <script language="javascript" type="text/javascript">
	function FlashCheck() 
	{

	//	var f = new FlashSwapper(document.getElementById('txtReqVersion').value);
		var f = new FlashSwapper();
		if(!f.DetectFlash())
		{	
			if(confirm("You don't have flash player installed on your system, do you want to install it?"))
			{
				location.href = "http://get.adobe.com/flashplayer/";
			}
			else
			{
				$('.flash').hide();
			}
		}
	}

</script>

	{/literal}
	
	{literal}
<style type="text/css">

#popitmenu{
position: absolute;
background-color: #96a0a9;
border:1px solid black;
font: normal 12px Verdana;
line-height: 18px;
z-index: 10000;
visibility: hidden;
color:#FFFFFF;
height: 300px;
overflow:scroll;
}

#popitmenu a{
text-decoration: none;
padding-left: 6px;
color: #ffffff;
display: block;
}

#popitmenu a:hover{ /*hover background color*/
background-color: #316ac5;
}

</style>

<script type="text/javascript">

/***********************************************
* Pop-it menu- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var defaultMenuWidth="250px" //set default menu width.

var linkset=new Array()
//SPECIFY MENU SETS AND THEIR LINKS. FOLLOW SYNTAX LAID OUT

/*
linkset[0]='<a href="http://dynamicdrive.com">Dynamic Drive</a>'
linkset[0]+='<hr>' //Optional Separator
linkset[0]+='<a href="http://www.javascriptkit.com">JavaScript Kit</a>'
linkset[0]+='<a href="http://www.codingforums.com">Coding Forums</a>'
linkset[0]+='<a href="http://www.cssdrive.com">CSS Drive</a>'
linkset[0]+='<a href="http://freewarejava.com">Freewarejava</a>'
*/

{/literal}

linkset[0] = '<a href="{$GENERAL.BASE_URL_ROOT}/index.php">HOME</a>';
linkset[0] += '<a href="{$GENERAL.BASE_URL_ROOT}/redc_unique.php?section_id=1&pcid=509">REDC IS UNIQUE</a>';

{foreach from=$section_data_unique item ="entry"}
	{if $entry.pagename neq ""}
		linkset[0]+='<a href="{$GENERAL.BASE_URL_ROOT}/redc_unique.php?section_id={$entry.psid}&pcid={$entry.pcid}">&nbsp;&nbsp;{$entry.pagename|escape}</a>'
	{/if}
{/foreach}

linkset[0] += '<a href="{$GENERAL.BASE_URL_ROOT}/programme.php?section_id=0&pcid=500">PROGRAMMES</a>';
linkset[0]+='<a href="{$GENERAL.BASE_URL_ROOT}/oep_programme.php?section_id=0&pcid=151">&nbsp;&nbsp;Open Enrollment Programme</a>'
linkset[0]+='<a href="{$GENERAL.BASE_URL_ROOT}/ofp_programme.php?section_id=0&pcid=150">&nbsp;&nbsp;Organization Focused Programmes</a>'
linkset[0]+='<a href="{$GENERAL.BASE_URL_ROOT}/prog_finder.php?section_id=0&pcid=300">&nbsp;&nbsp;Programme Finder</a>'

{foreach from=$section_data_programme item ="entry"}
	{if $entry.pagename neq ""}
		linkset[0]+='<a href="{$GENERAL.BASE_URL_ROOT}/programme.php?section_id={$entry.psid}&pcid={$entry.pcid}">&nbsp;&nbsp;{$entry.pagename|escape}</a>'
	{/if}
{/foreach}
		
linkset[0] += '<a href="{$GENERAL.BASE_URL_ROOT}/conference_services.php?section_id=8&pcid=35">CONFERENCE SERVICES</a>';

{foreach from=$section_data_programme item ="entry"}
	{if $entry.pagename neq ""}
		linkset[0]+='<a href="{$GENERAL.BASE_URL_ROOT}/conference_services.php?section_id={$entry.psid}&pcid={$entry.pcid}">&nbsp;&nbsp;{$entry.pagename|escape}</a>'
	{/if}
{/foreach}
linkset[0] += '<a href="{$GENERAL.BASE_URL_ROOT}/virtualtour.php?section_id=0&pcid=323">&nbsp;&nbsp;Virtaul Tour</a>';

linkset[0] += '<a href="{$GENERAL.BASE_URL_ROOT}/faculty_profiles.php?section_id=4">FACULTY</a>';

{foreach from=$section_data_programme item ="entry"}
	{if $entry.pagename neq ""}
		linkset[0]+='<a href="{$GENERAL.BASE_URL_ROOT}/faculty_profiles.php?section_id={$entry.psid}&pcid={$entry.pcid}">&nbsp;&nbsp;{$entry.pagename|escape}</a>'
	{/if}
{/foreach}
linkset[0]+='<a href="{$GENERAL.BASE_URL_ROOT}/faculty_profiles.php?section_id=4">&nbsp;&nbsp;Faculty Directory</a>'

linkset[0] += '<a href="{$GENERAL.BASE_URL_ROOT}/facilites.php?section_id=3&pcid=511">FACILITIES</a>';

{foreach from=$section_data_facilities item ="entry"}
	{if $entry.pagename neq ""}
		linkset[0]+='<a href="{$GENERAL.BASE_URL_ROOT}/facilites.php?section_id={$entry.psid}&pcid={$entry.pcid}">&nbsp;&nbsp;{$entry.pagename|escape}</a>'
	{/if}
{/foreach}


linkset[0] += '<a href="{$GENERAL.BASE_URL_ROOT}/enrollment.php?section_id=10&pcid=523">ENROLLMENT</a>';

{foreach from=$section_data_enrollment item ="entry"}
	{if $entry.pagename neq ""}
		linkset[0]+='<a href="{$GENERAL.BASE_URL_ROOT}/enrollment.php?section_id={$entry.psid}&pcid={$entry.pcid}">&nbsp;&nbsp;{$entry.pagename|escape}</a>'
	{/if}
{/foreach}


linkset[0] += '<a href="{$GENERAL.BASE_URL_ROOT}/alumni.php?section_id=9&pcid=518">REDC ALUMNI</a>';
linkset[0]+='<a class="alumnilogin" href="javascript:showAlumniLogin()">&nbsp;&nbsp;REDC Alumni Login</a>'
linkset[0]+='<a class="alumnilogin" href="{$GENERAL.BASE_URL_ROOT}/testimonial.php?section_id=9">&nbsp;&nbsp;REDC Alumni Testimonials</a>'
{foreach from=$section_data_alumni item ="entry"}
	{if $entry.pagename neq ""}
		linkset[0]+='<a href="{$GENERAL.BASE_URL_ROOT}/alumni.php?section_id={$entry.psid}&pcid={$entry.pcid}">&nbsp;&nbsp;{$entry.pagename|escape}</a>'
	{/if}
{/foreach}

				
{literal}
////No need to edit beyond here

var ie5=document.all && !window.opera
var ns6=document.getElementById

if (ie5||ns6)
document.write('<div id="popitmenu" onMouseover="clearhidemenu();" onMouseout="dynamichide(event)"></div>')

function iecompattest(){
return (document.compatMode && document.compatMode.indexOf("CSS")!=-1)? document.documentElement : document.body
}

function showmenu(e, which, optWidth){
if (!document.all&&!document.getElementById)
return
clearhidemenu()
menuobj=ie5? document.all.popitmenu : document.getElementById("popitmenu")
menuobj.innerHTML=which
menuobj.style.width=(typeof optWidth!="undefined")? optWidth : defaultMenuWidth
menuobj.contentwidth=menuobj.offsetWidth
menuobj.contentheight=menuobj.offsetHeight
eventX=ie5? event.clientX : e.clientX
eventY=ie5? event.clientY : e.clientY
//Find out how close the mouse is to the corner of the window
var rightedge=ie5? iecompattest().clientWidth-eventX : window.innerWidth-eventX
var bottomedge=ie5? iecompattest().clientHeight-eventY : window.innerHeight-eventY
//if the horizontal distance isn't enough to accomodate the width of the context menu
if (rightedge<menuobj.contentwidth)
//move the horizontal position of the menu to the left by it's width
menuobj.style.left=ie5? iecompattest().scrollLeft+eventX-menuobj.contentwidth+"px" : window.pageXOffset+eventX-menuobj.contentwidth+"px"
else
//position the horizontal position of the menu where the mouse was clicked
menuobj.style.left=ie5? iecompattest().scrollLeft+eventX+"px" : window.pageXOffset+eventX+"px"
//same concept with the vertical position
if (bottomedge<menuobj.contentheight)
menuobj.style.top=ie5? iecompattest().scrollTop+eventY-menuobj.contentheight+"px" : window.pageYOffset+eventY-menuobj.contentheight+"px"
else
menuobj.style.top=ie5? iecompattest().scrollTop+event.clientY+"px" : window.pageYOffset+eventY+"px"
menuobj.style.visibility="visible"
return false
}

function contains_ns6(a, b) {
//Determines if 1 element in contained in another- by Brainjar.com
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

function hidemenu(){
if (window.menuobj)
menuobj.style.visibility="hidden"
}

function dynamichide(e){
if (ie5&&!menuobj.contains(e.toElement))
hidemenu()
else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
hidemenu()
}

function delayhidemenu(){
delayhide=setTimeout("hidemenu()",500)
}

function clearhidemenu(){
if (window.delayhide)
clearTimeout(delayhide)
}

//if (ie5||ns6)
//document.onclick=hidemenu

//if (ns6)
//document.onclick=hidemenu

</script>
{/literal}
</head>
<body onload="javascript:getoepprogramme('{$smarty.now|date_format:"%m"}', '{$smarty.now|date_format:"%Y"}','{$GENERAL.BASE_URL_ROOT}'); FlashCheck(); preloadImages();">
<img id="imgCache" style="display:none"  />
<script language="javascript" type="text/javascript">
preloadImages();
</script>
<div id="main_container">
{include_php file="header.php"}
<div class="flash_bar">
	<div class="flash">

        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="952" height="385">
 <param name="movie" value="carousel.swf" />
  <param name="quality" value="high" />
  <param name="allowFullScreen" value="false" />
  <param name="wmode" value="transparent">
  <embed src="carousel.swf"
         quality="high"
         type="application/x-shockwave-flash"
         WMODE="transparent"
         width="951"
         height="385"
         allowFullScreen="false"
         pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
<script type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/ieupdate.js"></script>
   	</div>
</div>
<div class="clear"></div>
<div class="tabs_bar">
	<div class="tabs">
		<ul>
			<li>
			<a href="#bottom" class="heading" onclick="javascript:jQuery('#tabs').slideToggle(50);jQuery(this).toggleClass('selected');"><!--<img src="{$GENERAL.FRONT_IMG_URL}/news_home.gif" border="0" /><br />-->NEWS AND EVENTS</a>
            <div id="tabs">
            <div style="height:3px">&nbsp;</div>
			{foreach from=$news item="entry"}
				<div style="border-bottom:#d8e6ec solid 1px; padding-bottom:10px;">
				<p>{$entry.dated|date_format:"%e %b, %Y"}</p>
					<a class="txt" href="news.php?id={$entry.nid}&section_id=0">{$entry.title|strip_tags|truncate:150:"..."}</a><br>
					<!--<a href="news.php?id={$entry.nid}" class="txt"> See All <img src="{$GENERAL.FRONT_IMG_URL}/details.gif" /></a>-->
				<a href="{php}echo SITE_URL;{/php}/news.php?page={$entry.dated}&id={$entry.nid}&section_id=0" class="details" style="color:#000">  <img src="{$GENERAL.FRONT_IMG_URL}/details.gif" /></a>
                </div>
                
			{/foreach} 
            <div align="right" ><a href="{php}echo SITE_URL;{/php}/news.php?section_id=0" style="color:#000" class="left_links_news_events" >See All</a></div>
         <!--   <div class=" align="right"><a href="{php}echo SITE_URL;{/php}/news.php?page={$entry.dated}&id={$entry.nid}" class="date_event">View All</a></div>-->                   
                
				</div>
			<a name="bottom"></a>	
			</li>	
			<li><a class="heading" href="#bottom1"  onclick="javascript:jQuery('#tabs1').slideToggle(50);jQuery(this).toggleClass('selected');"><!--<img src="{$GENERAL.FRONT_IMG_URL}/upcoming_home.gif" border="0" /><br />-->UPCOMING PROGRAMMES</a>
            	<div id="tabs1">
					<div style="height:10px">&nbsp;</div>
					<div class="monthtabs">	
						{foreach from=$dates item="date_month"}
                    	<a href="#" id="{$date_month|date_format:"%m"}" onclick="javascript:getoepprogramme('{$date_month|date_format:"%m"}', '{$date_month|date_format:"%Y"}','{$GENERAL.BASE_URL_ROOT}');">{$date_month|date_format:"%b"}</a>
						{/foreach}
                    </div>
					<!--<p>Select Month</p>
						 <a class="txt"> <select name="setmonth"  id="setmonth"class="select_class"  onchange="javascript:getoepprogramme('{$GENERAL.BASE_URL_ROOT}','siteurl');">
		                <option value="">---select---</option>
				        <option value="01">January</option>
						 <option value="02">Feubury</option>
						 <option value="03">March</option>
						 <option value="04">Aprail</option>
						 <option value="05">May</option>
						 <option value="06">June</option>
						 <option value="07">July</option>
						 <option value="08">August</option>
						 <option value="09">September</option>
						 <option value="10">October</option>
						 <option value="11">November</option>
						 <option value="12">December</option>
				 		  
		  </select> </a>-->
		  
		<!--<div class="clear"></div>-->
		<div id="programmes" style="display:none"></div>
		</div>
		<a name="bottom1"></a>
            </li>
			<li><a class="heading" href="#bottom2"  onclick="javascript:jQuery('#tabs2').slideToggle(50);jQuery(this).toggleClass('selected');setDropDownHeights(); "><!--<img src="{$GENERAL.FRONT_IMG_URL}/programe_finder_home.gif" border="0" /><br />-->PROGRAMME FINDER</a>
            	<div id="tabs2">
					<div style="height:10px">&nbsp;</div>
                   <form action="{$GENERAL.BASE_URL_ROOT}/prog_finder.php" method="post" name='prog_finder' id="prog_finder">
						<div ><input type="text" name="search_by_name" size="25" id="search_by_name" value="Programme Name" class="bluemenu" {literal}onfocus="if($('#search_by_name').val() == 'Programme Name') {$('#search_by_name').val('');}" onblur="if($('#search_by_name').val() == '') {$('#search_by_name').val('Programme Name');}"{/literal} /></div>
                        
						<div> <select name="search_by_oepcatid" id="search_by_oepcatid" class="bluemenu" >
							<option value="">Programme Category</option>
							{foreach from=$pname item='id'}
								 
								{if $data.oepcatid eq $id.oepcatid}
									<option value="{$id.oepcatid}" selected="selected">{$id.name|truncate:24:"...":true}</option>									
								{else}
									<option value="{$id.oepcatid}">{$id.name|truncate:24:"...":true}</option>
								{/if}	
								
							{/foreach}
						</select>
                        </div>
                        {literal}
                        <script language="javascript" type="text/javascript">
						//$("#search_by_oepcatid").sSelect({ddMaxHeight:'200px'});
						</script>
                        {/literal}
						 <div> <select name="programme_by_level" id="programme_by_level" class="bluemenu">
							  <option value="">Programme Level</option>							
                            <option value="Top Management" >Top Management</option>
                            <option value="Senior Management" >Senior Management</option>
                            <option value="Middle Management">Middle Management</option>
                            <option value="First Line Managers">First Line Managers</option>
                            <option value="Others">Others</option>
							</select></div>
                            <script language="javascript" type="text/javascript">
//						$("#programme_by_level").sSelect();
						</script>
						<!-- id="win-xp" -->
						 <div > <select name="month" id="search_by_month" class="bluemenu">
		                <option value="">Start Month</option>
				        <option value="01">January</option>
                         <option value="02">February</option>
                         <option value="03">March</option>
                         <option value="04">April</option>
                         <option value="05">May</option>
                         <option value="06">June</option>
                         <option value="07">July</option>
                         <option value="08">August</option>
                         <option value="09">September</option>
                         <option value="10">October</option>
                         <option value="11">November</option>
                         <option value="12">December</option>
				 		  
		  </select> </div>
          <script language="javascript" type="text/javascript">
			//$("#search_by_month").sSelect();
			</script>
		  <!--<input type="submit" value="Submit" />-->
		  <div class="clear"></div><br />
		  <a href="#" class="next_button" onclick="return submitProgFinderForm();" style="margin-top:2px; padding-top:2px">Search</a>
		  </form>
		  </div>
		  <a name="bottom2"></a>
            </li>
			<li class="last">
            <a class="heading" href="#bottom3"  onclick="javascript:jQuery('#tabs3').slideToggle(50);jQuery(this).toggleClass('selected');"><!--<img src="{$GENERAL.FRONT_IMG_URL}/email_subscription_home.gif" border="0" /><br />-->EMAIL SUBSCRIPTION</a>
            	<div id="tabs3">
						<div style="height:10px">&nbsp;</div>
                       <form action="" method="post" id="frmSubscribe" >
						
						<div id="form">
						<div><input type="text" name="name" class="bluemenu" value="Name" size="25" id="name" {literal}onfocus="if($('#name').val() == 'Name') {$('#name').val('');}" onblur="if($('#name').val() == '') {$('#name').val('Name');}"{/literal}/></div>
						<div><input type="text" name="email" class="bluemenu" value="Email Address*" size="25" id="email" {literal}onfocus="if($('#email').val() == 'Email Address*') {$('#email').val('');}" onblur="if($('#email').val() == '') {$('#email').val('Email Address*');}"{/literal}/></div>
						<div><input type="text" name="companyname" class="bluemenu" value="Company Name" size="25" id="companyname" {literal}onfocus="if($('#companyname').val() == 'Company Name') {$('#companyname').val('');}" onblur="if($('#companyname').val() == '') {$('#companyname').val('Company Name');}"{/literal}/></div>
						<div><input type="text" name="designation" class="bluemenu" value="Designation" size="25" id="designation" {literal}onfocus="if($('#designation').val() == 'Designation') {$('#designation').val('');}" onblur="if($('#designation').val() == '') {$('#designation').val('Designation');}"{/literal} /></div>
						<div id="error"></div>
						<!--<div id="error">Email is required</div> -->
						
		              <!--<div><input type="button" value="Submit" onclick="javascript:subscribe('{$GENERAL.BASE_URL_ROOT}','siteurl')" /></div>-->
					  <div class="clear"></div>
					  <br />
					  <a href="#" class="next_button" onclick="javascript:subscribe('{$GENERAL.BASE_URL_ROOT}','siteurl')">Subscribe</a>		
					  </div>
		  </form>
		  
		  </div>
		  <a name="bottom3"></a>	
            </li>
		</ul>
	</div>
</div>

<div class="clear"></div>
<div class="bottom_links_bar">
	<div class="bottom_links">
		<div class="unicon">
			<p>
				<a href="http://www.uniconexed.org/" target="_blank"><img src="{$GENERAL.FRONT_IMG_URL}/unicon.gif" style="border:none" alt="UNICON" /></a>
				LUMS is a member of the International University Consortium for Executive Education (UNICON)
			</p>
		</div>
		<div class="right_links" id="ebroucherrequestForm">
			<br />
			<form name="applylogout" method="post" action="">
			{php}
				if(isset($_SESSION['userid']) && $_SESSION['userid'] != "") { {/php}
			<ul style="float:right; border:0px solid red;">
				<li><span class="input_txt_apply_footer_welcome">Welcome</span>: <span class="input_txt_apply_footer">{php} echo $_SESSION['fname']; {/php}</span></li>
				<li class="last">
					<input type="hidden" name="exitfooter" value="1" />
					<input type="image" src="{$GENERAL.FRONT_IMG_URL}/logout.gif" border="0" />
				</li>
			</ul>
			{php}	} 	{/php}
			</form>
			<ul style="clear:both; float:right; border:0px solid red">
				<li><a href="{$GENERAL.BASE_URL_ROOT}/index.php">REDC Home</a></li>
<li><a href="uploads/pdf/redc.pdf" target="_blank">Calendar</a></li>
				<li><!--<a href="prog_finder.php">Programme Calendar</a>--><a href="map.php?keepThis=true&amp;TB_iframe=true&amp;height=600&amp;width=931" title="Direction To LUMS"  class="thickbox" rel="lightbox">Map/Directions</a></li>
                <li><a href="{$GENERAL.BASE_URL_ROOT}/brochure/index.html" target="_blank">Annual Brochure</a></li>
				<li><a href="{$GENERAL.BASE_URL_ROOT}/offer_course/annual-brochure.pdf" target="_blank">Download Annual Brochure</a></li>
				<!--<li><a href="#" class="ebroucherrequest">Request an OEP Printed Brochure</a></li> -->
			{if $annualbrochure.filename ne ''}
					
				{/if}
				<li class="last"><a href="mailto:rec@lums.edu.pk">Feedback</a></li>
			</ul>			
			<p style="clear:both;border:0px solid red">Tel: +92-42-35608333   Fax: +92-42-35722691</p>
			<p>&copy; {$smarty.now|date_format:"%Y"} Rausing Executive Development Centre</p>
			<p>This site is optimized for 1024 x 768 resolution</p>
             <a href="http://www.netrasofttech.com" target="_blank"><img style="padding-top:7px;padding-bottom:7px;" alt="Powered by Netrasoft Technologies" src="images/poweredbynetrasoft.jpg" border="0" /></a>
		</div>
		
	</div>
	<div class="clear"></div>
</div>
<a href="#" name="bottom" id="bottom"></a>
<div class="clear"></div>
</div>

<!-- bottom navigation menu starts here -->
    <div id="nav_menu_wrapper">

        <div class="nav_menu">
		    <div class="left_footer_links">
				<ul>
					<li class="first"><a href="http://www.lums.edu.pk" target="_blank">LUMS Home</a></li>
					<li><a href="javascript:void(0)" onclick="javascript:showmenu(event,linkset[0])" onMouseout="javascript:delayhidemenu()">REDC Quick Links</a></li>
					<li><a href="{$GENERAL.BASE_URL_ROOT}/site_map.php?pagename=Site Map">Site Index</a></li>
                     
					<li class="last"><span id="spnSearch" style="display:none"><input class="searchbar" type="text" name="search" onkeypress="javascript:search(event, this)" /></span><a href="#" onclick="javascript:jQuery('#spnSearch').toggle()"><img style="padding-top:4px;" src="images/mag.gif" /></a></li>
				</ul>
			</div>
			<div class="right_footer_links" id="contactForm">
				
				<ul>
					<li><a href="http://myredc.lums.edu.pk/portal" target="_blank">My REDC</a></li>
					<li><a href="playvideo.php?keepThis=true&amp;TB_iframe=true&amp;height=500&amp;width=450" class="thickbox">Podcasts</a></li>
					<li><a href="#" class="contactbar">Contact Us</a></li>
					<li><a href="prog_finder.php?section_id=0&pcid=300">Programme Calendar</a></li>
				</ul>
                <a href="{$GENERAL.BASE_URL_ROOT}/faq.php?pagename=FAQs&&section_id=0"><img src="{$GENERAL.FRONT_IMG_URL}/faq.png" onload=" fixPNG(this);" /></a>
			</div>
		</div>
    </div>
<!-- bottom navigation menu ends here --> 

</body>
</html>
