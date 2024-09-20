<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Rausing Exacutive Development Centre</title>
<link href="{$GENERAL.BASE_URL_ROOT}/css/style.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="{$GENERAL.BASE_URL_ROOT}/css/screen.css" type="text/css" media="screen" />
    <!--[if lt IE 7]>
    <link rel="stylesheet" href="{$GENERAL.BASE_URL_ROOT}/css/screen_ie.css" type="text/css" media="screen" />
    <![endif]-->
	
<link rel="stylesheet"type="text/css" href="{$GENERAL.BASE_URL_ROOT}/css/mouseovertabs.css" />

<link rel="stylesheet"type="text/css" href="{$GENERAL.BASE_URL_ROOT}/css/thickbox.css" />
<script src="{$GENERAL.BASE_URL_ROOT}/js/common.js" type="text/javascript"></script>
<script src="{$GENERAL.BASE_URL_ROOT}/js/jquery.min.js" type="text/javascript"></script>
<script src="{$GENERAL.BASE_URL_ROOT}/js/thickbox.js" type="text/javascript"></script>
<script src="{$GENERAL.BASE_URL_ROOT}/js/mouseovertabs.js" type="text/javascript"></script>
<script type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/animatedcollapse.js"></script>
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="{$GENERAL.BASE_URL_ROOT}/uploads/home-pictures/AC_RunActiveContent.js" language="javascript"></script>
{literal}
<script type="text/javascript">

animatedcollapse.addDiv('tabs', 'fade=1')
animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
}
animatedcollapse.init()
	function submitForm()
		{
			if(document.forms[0].month != undefined)
			{
				if(validateForm())
				{
					document.forms[0].submit();
				}
			}
			else
			{
				document.forms[0].submit();
			}
		}


	function validateForm()
	{
		return true;
	}
	
	function selectDropdown(combo, page)
	{	
		var dropdown = document.getElementById(combo);
		if(dropdown != null)
		{
			for(i=0;i<dropdown.options.length;i++)
			{
				if(page == dropdown.options[i].value)
				{
					dropdown.selectedIndex = i;
					break;
				}
			}
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
	<div class="add"><a href="#" ><img src="{$GENERAL.FRONT_IMG_URL}/requestafacility.gif" alt="Programme Finder"  border="0"/></a></div><div class="add1"><a href="#" ><img src="images/virtualtour.gif" alt="Programme Finder"  border="0"/></a></div>
	  </div>
	  <div class="right_pane_lvl1">
        
          <div class="main_heading">{$pagedata.pagetitle}</div>
		  <div class="contents_body">
				<form method="post" name="frmContact">
				<div class="form_div">				
				<input type="hidden" name="form_action" value="submit" />
				<ul>
				<li class="txt">Title : </li>
				<li class="txt">
				<select name="title" class="normaltxt" id="title">
						<option value="Mr.">Mr.</option>
						<option value="Miss">Mrs</option>
						<option value="Mrs.">Miss.</option>
						<option value="Ms.">Ms.</option>
						<option value="Dr.">Dr.</option>
					</select>
					<script language="javascript" type="text/javascript">
					selectDropdown('title', '{$data.title}');
					</script>
				</li>			
				<li class="txt">First Name<span class="required">&nbsp;*</span> </li>
				<li>
				<input type="text" name="firstname" class="input_bar" maxlength="30" value="{$form.firstname}" />
				</li>
				<li class="txt">Last Name<span class="required">&nbsp;*</span> </li>
				<li>
				<input type="text" name="lastname" class="input_bar" maxlength="30" value="{$form.lastname}" />
				</li>
				<li class="txt">Email<span class="required">&nbsp;*</span></li>
				<li><input class="input_bar" type="text" name="email" maxlength="50" value="{$form.email}" /></li>
				<li class="txt">Company<span class="required">&nbsp;*</span> </li>
				<li>
				<input type="text" name="company" class="input_bar" maxlength="50" value="{$form.company}" />
				</li>
				<li class="txt">Mailing Address<span class="required">&nbsp;*</span> </li>
				<li>
				<input type="text" name="mailaddress" class="input_bar" maxlength="150" value="{$form.mailaddress}" />
				</li>
				<li class="txt">Telephone<span class="required">&nbsp;*</span> </li>
				<li>
				<input type="text" name="phone" class="input_bar" maxlength="20" value="{$form.phone}" />
				</li>
				<!-- ckech box-->
				<li class="txt">Requested Infomation<span class="required">&nbsp;*</span> </li>
				<li>
				<input type="checkbox" name="about[]" value="About REDC">About REDC<br>
				<input type="checkbox" name="about[]" value="Open Enrollment Programmes">Open Enrollment Programmes<br>
				<input type="checkbox" name="about[]" value="Organization Focused Programmes">Organization Focused Programmes<br>
				<input type="checkbox" name="about[]" value="Conferences and Services">Conferences and Services<br>
				<input type="checkbox" name="about[]" value="REDC Facilities">REDC Facilities<br>
				<input type="checkbox" name="about[]" value="Partner with us">Partner with us<br>
				
				</li>
				<li class="txt">Addtional Information</li>
				<li><input type="text" name="additionalinfo" maxlength="300" value="{$form.additionalinfo}" class="input_bar" /></li>
				<li><input type="submit" />	<li>			
				</ul>
				</div>
				</form>
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