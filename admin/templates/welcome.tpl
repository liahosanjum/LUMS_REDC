{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file="$tpl_path/top_header.tpl"}
  <link href="{$GENERAL.BASE_URL_ADMIN}/css/icon.css" rel="stylesheet" type="text/css" />
{literal}
<script type="text/javascript">

        function TogglePanel(divId)
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
  </script>
{/literal}
</head>
<body>

<table width="991" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15"> {include file="$tpl_path/header.tpl"} </td>
  </tr>
  <tr>
    <td height="15" class="boder"><img src="{$GENERAL.ADMIN_IMG_URL}/blank.jpg" alt="" /></td>
  </tr>
  <tr>
    <td class="boder"> {* Smarty *}
      <!--- content area form --->
      <table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="boderInner"><table width="960" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10" colspan="5" align="center"></td>
            </tr>
          <tr>
            <td width="10" align="center">&nbsp;</td>
            <td width="480" align="center" valign="top">
			  {if $GENERAL.USER_TYPE eq 'A'}
			  <div id="cpanel">
                  <div style="float: left;">
					<div class="icon"><a href="{$GENERAL.BASE_URL_ADMIN}/profile.php"><img  src="{$GENERAL.ADMIN_IMG_URL}/icon-48-config.png"  alt="Profile Manager" align="top" border="0" /><span>Profile Manager</span></a></div>
				  </div>
			 	  <!--<div style="float: left;">
					<div class="icon"><a href="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php?section_id=1"><img src="{$GENERAL.ADMIN_IMG_URL}/icon-48-frontpage.png" alt="REDC is Unique Manager" align="top" border="0" /><span>REDC is Unique Manager</span></a></div>
				  </div>
			 	  <div style="float: left;">
					<div class="icon"><a href="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php?section_id=2"><img src="{$GENERAL.ADMIN_IMG_URL}/icon-48-cpanel.png" alt="Services Manager" align="top" border="0" /><span>Services Manager</span></a></div>
				  </div>
			 	  <div style="float: left;">
					<div class="icon"><a href="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php?section_id=3"><img src="{$GENERAL.ADMIN_IMG_URL}/facilities.jpg" alt="Facilities Manager" align="top" border="0" /><span>Facilities Manager</span></a></div>
				  </div>
				  <div style="float: left;">
					<div class="icon"><a href="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php?section_id=4"><img src="{$GENERAL.ADMIN_IMG_URL}/admission2.png" alt="Admissions Manager" align="top" border="0" /><span>Admissions Manager</span></a></div>
				  </div>-->
			 	  <!--<div style="float: left;">
					<div class="icon"><a href="{$GENERAL.BASE_URL_ADMIN}/emailcontentmanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/icon-48-massmail.png" alt="Email Content Manager" align="top" border="0" /> <span>Email Content Manager</span> </a></div>
				  </div>-->
			 	  <!--<div style="float: left;">
					<div class="icon"><a href="{$GENERAL.BASE_URL_ADMIN}/blogmanagement.php"><img  src="{$GENERAL.ADMIN_IMG_URL}/icon_blog.png"  alt="Blogs" align="top" border="0" /><span>Blogs</span></a></div>
				  </div>-->
			 	  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/mailinglistmanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/mail-48x48.png" alt="Mailing List Manager" align="top" border="0" /> <span>Mailing List </span> </a> </div>
				  </div>
			 	  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/newsmanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/news2.png" alt="News Manager" align="top" border="0" /> <span>News </span> </a> </div>
				  </div>
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/faqcategorymanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/faq2.png" alt="FAQs Manager" align="top" border="0" /> <span>FAQs </span> </a> </div>
				  </div>
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/gallerymanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/gallery4.png" alt="Gallery  Manager" align="top" border="0" /> <span>Picture Gallery  </span> </a> </div>
				  </div>
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/adminmanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/user.png" alt="Gallery  Manager" align="top" border="0" /> <span>Admin Manager</span> </a> </div>
				  </div>
				 <!-- <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php?section_id=5"> <img src="{$GENERAL.ADMIN_IMG_URL}/news1.png" alt="content  Manager" align="top" border="0" /> <span>Content </span> </a> </div>
				  </div>-->
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/alumnimanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/alumni_manager.gif" alt="template  Manager" align="top" border="0" /> <span>Alumni </span> </a> </div>
				  </div>

				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/viewbroucherrequest.php?section_id=8"> <img src="{$GENERAL.ADMIN_IMG_URL}/enrollment_manager.gif" alt="Conference Services  Manager" align="top" border="0" /> <span>OEP Brochure Requests   </span> </a> </div>
				  </div>
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/facultymanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/icon_community_48X48.png" alt="template  Manager" align="top" border="0" /> <span>Faculty Profile </span> </a> </div>
				  </div>
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/templatemanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/letter_48x48.gif" alt="template  Manager" align="top" border="0" /> <span>NewsLetter Template </span> </a> </div>
				  </div>
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/vtmanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/gallery1.png" alt="template  Manager" align="top" border="0" /> <span>Virtual Tour  </span> </a> </div>
				  </div>
				  				  
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/oeppodcastmanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/podcast.gif" alt="template  Manager" align="top" border="0" /> <span>OEP Podcast </span> </a> </div>
				  </div>
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/oep_programme.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/oep.gif" alt="template  Manager" align="top" border="0" /> <span>OEP Programmes </span> </a> </div>
				  </div>
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/oepapplicantsmanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/application_manager.gif" alt="template  Manager" align="top" border="0" /> <span>OEP Applicants </span> </a> </div>
				  </div>
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/oepbrochuremanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/broucher_manager.gif" alt="template  Manager" align="top" border="0" /> <span>OEP Brochure </span> </a> </div>
				  </div>
				   <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/ofpmanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/ofp.gif" alt="template  Manager" align="top" border="0" /> <span>OFP Programmes </span> </a> </div>
				  </div>
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/brouchermanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/broucher_request_manager.gif" alt="template  Manager" align="top" border="0" /> <span>OFP Brochure Requests </span> </a> </div>
				  </div>
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/ofprequestsmanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/programe_request_manager.gif" alt="template  Manager" align="top" border="0" /> <span>OFP Programme Requests </span> </a> </div>
				  </div>
				  
		      </div>
			  
			  {elseif $GENERAL.USER_TYPE eq 'M'}
			  <div id="cpanel">
                  <div style="float: left;">
					<div class="icon"><a href="{$GENERAL.BASE_URL_ADMIN}/profile.php"><img  src="{$GENERAL.ADMIN_IMG_URL}/icon-48-config.png"  alt="Profile Manager" align="top" border="0" /><span>Profile Manager</span></a></div>
				  </div>
				 <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/ofprequestsmanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/programe_request_manager.gif" alt="template  Manager" align="top" border="0" /> <span>OFP Programme Requests </span> </a> </div>
				  </div>
				   <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/oep_programme.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/oep.gif" alt="template  Manager" align="top" border="0" /> <span>OEP Programmes </span> </a> </div>
				  </div>
			 	  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/oeppodcastmanagement.php"> <img src="{$GENERAL.ADMIN_IMG_URL}/icon_community_48X48.png" alt="template  Manager" align="top" border="0" /> <span>OEP Podcast </span> </a> </div>
				  </div>
		      </div>
			  {elseif $GENERAL.USER_TYPE eq 'C'}
			  <div id="cpanel">
				 <div style="float: left;">
									<div class="icon"><a href="{$GENERAL.BASE_URL_ADMIN}/profile.php"><img  src="{$GENERAL.ADMIN_IMG_URL}/icon-48-config.png"  alt="Profile Manager" align="top" border="0" /><span>Profile Manager</span></a></div>
				  </div>			 	  <div style="float: left;">
					<div class="icon"><a href="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php?section_id=3"><img src="{$GENERAL.ADMIN_IMG_URL}/facilities.jpg" alt="Facilities Manager" align="top" border="0" /><span>Facilities </span></a></div>
				  </div>
				  <div style="float: left;">
					<div class="icon"> <a href="{$GENERAL.BASE_URL_ADMIN}/contentmanagement.php?section_id=8"> <img src="{$GENERAL.ADMIN_IMG_URL}/news3.jpg" alt="Conference Services  Manager" align="top" border="0" /> <span>Conference Services  </span> </a> </div>
				  </div>
				  
		      </div>
			  {/if}
			</td>
            <td width="21">&nbsp;</td>
            <td width="439" valign="top">
			<div id="content-pane" class="pane-sliders">
              <div   class="panel"  >
                <a href="Javascript:TogglePanel('welcome');"> <h3 class="moofx-toggler title moofx-toggler-down"><span>Welcome Administrator !</span> </h3></a>
                <div  id="welcome"  style="overflow: hidden; display: block; visibility: visible; opacity: 0.9999; height: 1%;" class="normalTxt">
                  <div style="padding: 5px;" >
                    <p>Congratulations
                      We hope you are able to create a successful website with our program and maybe, you are able to give something back to the community later.</p>
                  </div>
                </div>
              </div>
              <div class="panel">
                <a href="Javascript:TogglePanel('con');"> <h3 class="moofx-toggler title moofx-toggler-down"><span>Logged in As  {$username}</span></h3></a>
                <div style="overflow: hidden; display: block; visibility: visible; opacity: 0.9999; height: 1%;" class="normalTxt">
                  <div style="padding: 5px;" id="con">
                     <p>
						If you choose Content Management System in the left column, you will be presented
						with a number of options to manage the site's content
						<br />
						<br />
						If you have any problems with this tool, please send an email to: <a href="" class="orangeLink" >
							{$smarty.session.adminemail}info@netrasofttech.com</a>
					</p>
                  </div>
                </div>
              </div>
            </div>
			<script>
				//used to close div
				//Javascript:TogglePanel('welcome');
				//Javascript:TogglePanel('con');
			</script>
			</td>
            <td width="10" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td height="10" colspan="5" align="center"></td>
            </tr>
        </table></td>
      </tr>
    </table>
      <!--- content area  --->
	  </td>
  </tr>
   {include file="$tpl_path/footer.tpl"}
</table>
</body>
</html>