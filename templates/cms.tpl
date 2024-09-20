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
 {include file="header.tpl"}
<div class="contentspane">
  <div  class="content">
    <div class="left_pane">
    	{foreach from=$section_data item ="entry"}
      <div class="left_links"><a href="{$GENERAL.BASE_URL_ROOT}/cms.php?section_id={$entry.psid}&pcid={$entry.pcid}" class="level2" >{$entry.pagename}</a></div>
	  <!--<div class="left_links"><a href="#" class="level2" >Conference</a></div>-->
	  {/foreach}
       <div class="add"><a href="#" ><img src="{$GENERAL.FRONT_IMG_URL}/requestafacility.gif" alt="Programme Finder"  border="0"/></a></div><div class="add1"><a href="#" ><img src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>
    </div>
    <div class="right_pane_lvl1">
        
          <div class="main_heading">{$pagedata.pagetitle}</div>
          <div class="contents_body">
		  {$pagedata.details}
		  
		  <!--For those of us that have been through the times of bubble bursts and easy credit in the late 1980s and the early 1990s, the current economic scenario is a bit surreal, but there is no denying the fact that in today¿s business environment, risk management skills are becoming increasingly important for managers across all levels in the organization. The subprime phenomena have raised some very poignant questions about the ability or, all too frequently the inability of corporate giants to manage their risk. More and more managers are concluding that creating value for their organizations involves.<br />
          <br />
          <img src="{$GENERAL.FRONT_IMG_URL}/bodyimage.jpg" border="0" alt="Conference" /> <br /><br />For those of us that have been through the times of bubble bursts and easy credit in the late 1980s and the early 1990s, the current economic scenario is a bit surreal, but there is no denying the fact that in today¿s business environment, risk management skills are becoming increasingly important for managers across all levels in the organization. The subprime phenomena have raised some very poignant questions about the ability or, all too frequently the inability of corporate giants to manage their risk. More and more managers are concluding that creating value for their organizations involves.For those of us that have been through the times of bubble bursts and easy credit in the late 1980s and the early 1990s, the current economic scenario is a bit surreal, but there is no denying the fact that in today¿s business environment, risk management skills are becoming increasingly important for managers across all levels in the organization. The subprime phenomena have raised some very poignant questions about the ability or, all too frequently the inability of corporate giants to manage their risk. More and more managers are concluding that creating value for their organizations involves.For those of us that have been through the times of bubble bursts and easy credit in the late 1980s and the early 1990s, the current economic scenario is a bit surreal, but there is no denying the fact that in today¿s business environment, risk management skills are becoming increasingly important for managers across all levels in the organization. The subprime phenomena have raised some very poignant questions about the ability or, all too frequently the inability of corporate giants to manage their risk. More and more managers are concluding that creating value for their organizations involves.For those of us that have been through the times of bubble bursts and easy credit in the late 1980s and the early 1990s, the current economic scenario is a bit surreal, but there is no denying the fact that in today¿s business environment, risk management skills are becoming increasingly important for managers across all levels in the organization. The subprime phenomena have raised some very poignant questions about the ability or, all too frequently the inability of corporate giants to manage their risk. More and more managers are concluding that creating value for their organizations involves.-->
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