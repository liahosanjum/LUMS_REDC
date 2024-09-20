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
height: 300px;
overflow: scroll;
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

<script type="text/javascript" language="javascript">

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
</script>

<script type="text/javascript" language="javascript">
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

</script>
{/literal}

<!-- bottom navigation menu starts here -->
    <div id="nav_menu_wrapper">

        <div class="nav_menu">
		    <div class="left_footer_links">
				<ul>
					<li class="first"><a href="http://www.lums.edu.pk" target="_blank">LUMS Home</a></li>
					<li>					
					<a href="javascript:void(0)" onclick="javascript:showmenu(event,linkset[0])" onMouseout="javascript:delayhidemenu()">REDC Quick Links</a></li>
					<li><a href="{$GENERAL.BASE_URL_ROOT}/site_map.php?pagename=Site Map&pcid={$smarty.get.pcid}&url={php} echo URL;{/php}">Site Index</a></li>
					<li class="last"><span id="spnSearch" style="display:none"><input class="searchbar" type="text" name="search" onkeypress="javascript:search(event, this)" /></span><a href="#" onclick="javascript:jQuery('#spnSearch').toggle()"><img style="padding-top:4px;" src="images/mag.gif" /></a></li>
				</ul>
			</div>
			<div class="right_footer_links" id="contactForm">
				<ul>
					<li><a href="http://myredc.lums.edu.pk/portal" target="_blank">My REDC</a></li>
					<li><a href="playvideo.php?keepThis=true&amp;TB_iframe=true&amp;height=500&amp;width=450" alt="{$d.title}" class="thickbox">Podcasts</a></li>	
					<li><a href="#" class="contact">Contact Us</a></li>
					<li><a href="map.php?keepThis=true&amp;TB_iframe=true&amp;height=600&amp;width=931" title="Direction To LUMS"  class="thickbox" rel="lightbox">Map/Directions</a></li>
                    </ul>

                <a href="{php} echo SITE_URL;{/php}/faq.php?pagename=FAQs&section_id=0"><img src="{$GENERAL.FRONT_IMG_URL}/faq.png" onload=" fixPNG(this);" /></a>
			</div>
		</div>
    </div>
<!-- bottom navigation menu ends here -->