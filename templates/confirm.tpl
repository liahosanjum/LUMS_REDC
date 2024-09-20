<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$pagedata.browser_title}</title>
<meta name="keywords" content="{$pagedata.meta_keywords}" />
<meta name="description" content="{$pagedata.meta_description}" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="jscript/blendtrans.js"></script>
</head>
<body>
<div id="wrapper">
  {include_php file="header.php"}
  <div class="main_contentpane">
    
	{include_php file="inner-left.navi.php"}
    <div class="main_content_inner_right">
      <div class="banner_inner"></div>
      <div class="right_box1">
        <div><img src="images/white_area_top.gif" /></div>
        <div class="innpage_bg_right1">
          <div class="inner_right_area">
            <div class="breadcrumb_area">
              <div class="breadcrumb"><a href="{$GENERAL.BASE_URL_ROOT}" class="bread">Home</a></div>
              <div class="breadcrumb">></div>
              <div class="breadcrumb"><span class="bread_select">{$pagedata.page_title}</span></div>
            </div>
            <div class="clear"></div>
            <div class="list_area">
              <div class="cms_box"><span class="list_heading">{$pagedata.page_title}</span><br />
                <!--<span class="submit">SUBMITTED BY:  Cheri Weiner</span>--><br />
                <p>{$pagedata.page_content}</p>
                </div>
              <div style="clear:both; padding-top:15px; padding-bottom:5px;"></div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
        <div style="clear:both; float:left"><img src="images/white_area_bottom.gif" /></div>
      </div>
    </div>
  </div>
  <div style="width:962px; padding-top:"></div>
  <div class="clear"></div>
</div>
{include file="footer.tpl"}
</body>
</html>
