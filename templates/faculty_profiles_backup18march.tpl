<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />
<title>{$pagedata.explorertitle}</title>
{include file="includes.tpl"}
<link href="{$GENERAL.BASE_URL_ROOT}/css/style.css" rel="stylesheet" type="text/css" />
{literal}
<script language="javascript" type="text/javascript">
function toTop() {
        window.scrollTo(0, 0)
}
</script>
{/literal}
</head>
<body>
<div id="main_container">
<a href="#" id="Alpha" name="Alpha"></a>
 {include_php file="header.php"}
<div class="contentspane">
  <div  class="content">

    <div class="left_pane">
		<ul>
	  	<li><a class="selected">Faculty Directory</a></li>
    	{foreach from=$section_data item ="entry"}
      	{if $entry.pagename ne ''}
	  <li><a class="{if $smarty.get.pcid eq $entry.pcid}selected{/if}" href="{$GENERAL.BASE_URL_ROOT}/faculty.php?section_id={$entry.psid}&pcid={$entry.pcid}">{$entry.pagename}</a></li>
	  	{/if}
	  {/foreach}

	  </ul>
       <div id="conferenceservicesrequestForm"><a href="#" class="conferenceservice"><img style="padding-top:20px;" src="{$GENERAL.FRONT_IMG_URL}/requestafacility.gif" alt="Programme Finder"  border="0"/></a></div><div class="add1"><a href="{$GENERAL.BASE_URL_ROOT}/virtualtour.php" ><img src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>
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
			
			<br />
			<div class="faculty_pane">
			  <div style="padding-top:10px; float:left; padding-right:0px;">
			  
			  	<a href="#A" class="generalFaculty">
				<div style="float:left">A</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="A - B"  border="0"/>
				</div>
				<a href="#B" class="generalFaculty">
				<div style="float:left">B</div>
				</a>
			  	<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="B - C"  border="0"/>
				</div>
			  	<a href="#C" class="generalFaculty">
				<div style="float:left">C</div>
				</a>
			  	<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="C - D"  border="0"/>
				</div>
			  	<a href="#D" class="generalFaculty">
				<div style="float:left">D</div>
				</a>
			  	<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="D - E"  border="0"/>
				</div>
			  	<a href="#E" class="generalFaculty">
				<div style="float:left">E</div>
				</a>
			  	<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="E - F"  border="0"/>
				</div>
			  	<a href="#F" class="generalFaculty">
				<div style="float:left">F</div>
				</a>
  			  	<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="F - G"  border="0"/>
				</div>
			  	<a href="#G" class="generalFaculty">
				<div style="float:left">G</div>
				</a>
			  	<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="G - H"  border="0"/>
				</div>
			  	<a href="#H" class="generalFaculty">
				<div style="float:left">H</div>
				</a>
			  	<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="H - I"  border="0"/>
				</div>
			  	<a href="#I" class="generalFaculty">
				<div style="float:left">I</div>
				</a>
   			  	<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="I - J"  border="0"/>
				</div>
			  	<a href="#J" class="generalFaculty">
				<div style="float:left">J</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="J - K"  border="0"/>
				</div>
			  	<a href="#K" class="generalFaculty">
				<div style="float:left">K</div>
				</a>	
		   	  
			  	<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="K - L"  border="0"/>
				</div>
			  	<a href="#L" class="generalFaculty">
				<div style="float:left">L</div>
				</a>
			  
			  	<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="L - M"  border="0"/>
				</div>
			  	<a href="#M" class="generalFaculty">
				<div style="float:left">M</div>
				</a>
			  	<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="M - N"  border="0"/>
				</div>
			  	<a href="#N" class="generalFaculty">
				<div style="float:left">N</div>
				</a>
			  	<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="N - O"  border="0"/>
				</div>
			  	<a href="#O" class="generalFaculty">
				<div style="float:left">O</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="O - P"  border="0"/>
				</div>
			  	<a href="#P" class="generalFaculty">
				<div style="float:left">P</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="P - Q"  border="0"/>
				</div>
			  	<a href="#Q" class="generalFaculty">
				<div style="float:left">Q</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="Q - R"  border="0"/>
				</div>
			  	<a href="#R" class="generalFaculty">
				<div style="float:left">R</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="R - S"  border="0"/>
				</div>
			  	<a href="#S" class="generalFaculty">
				<div style="float:left">S</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="S - T"  border="0"/>
				</div>
			  	<a href="#T" class="generalFaculty">
				<div style="float:left">T</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="T - U"  border="0"/>
				</div>
			  	<a href="#U" class="generalFaculty">
				<div style="float:left">U</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="U - V"  border="0"/>
				</div>
			  	<a href="#V" class="generalFaculty">
				<div style="float:left">V</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="V - W"  border="0"/>
				</div>
			  	<a href="#W" class="generalFaculty">
				<div style="float:left">W</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="W - X"  border="0"/>
				</div>
			  	<a href="#X" class="generalFaculty">
				<div style="float:left">X</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="X - Y"  border="0"/>
				</div>
			  	<a href="#Y" class="generalFaculty">
				<div style="float:left">Y</div>
				</a>
				<div style="float:left">
					<img src="{$GENERAL.FRONT_IMG_URL}/faculty/faculty_staff.gif" alt="Y - Z"  border="0"/>
				</div>
			  	<a href="#Z" class="generalFaculty">
				<div style="float:left">Z</div>
				</a>
			  </div>
			</div>
			{foreach from=$data item='faculty' name='list'}
			{if $smarty.foreach.list.index % 2 eq 0}
				{assign var = 'class' value='faculty_content_box'}
			{else}
				{assign var = 'class' value='faculty_content_boxalter'}
			{/if}		
			
			<div class="{$class}">
			  <div style="float:left; width:117px;">
			  	{if $faculty.image ne ""}
					<img src="{$GENERAL.FRONT_UPLOAD_URL}/faculty-profile/thn_{$faculty.image}" width="89" height="78" />
				{else}
					<span style="width:89px; height:78px;">&nbsp;</span>
				{/if}
			  </div>
			 	<div style="float:left">
					<a name="{$faculty.name.0|upper}" id="{$faculty.name.0|upper}"></a>
					<!--Get first letter of name and then show it in anchor's name-->
					<div class="faculty_heading">{$faculty.name}</div>
					<div  class="desc_box">
						<b>{$faculty.designation}</b>
						<br /><b>{$faculty.education|replace:";":"<br />"}</b>
					</div>
					{if $faculty.areas_interest ne ''}
					<div class="faculty_heading"><span style="color:#e9872f">Research Interests:</span> </div>
					<div class="faculty_txt">
						{$faculty.areas_interest|replace:";":"<br />"}
					</div>
					
					{/if}
				</div>
				<div style="float:right">
					<a class="level2" href="#Alpha">Back to top</a>
				</div>
			</div>
			{foreachelse}
				<div class="faculty_content_boxalter"><div align="center" class="required">No Faculty Profile Found</div></div>
			{/foreach}
			
		  </div>
		  {*
		  <div style="width:740px; clear:left; display:{if $totalrecords < 10}none;{/if}">{$paging}</div>
		  *}
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