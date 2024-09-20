<?php /* Smarty version 2.6.22, created on 2011-04-01 01:31:41
         compiled from d:/xampp/htdocs/redc/admin/templates/header.tpl */ ?>
<table width="991" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  style="background-color:#1f1f1f;" >
		<table width="991" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/log_top_1.jpg" alt="" width="14" height="45" /></td>
              <td width="963" class="siteName">REDC</td>
              <td width="14"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/log_top_3.jpg" alt="" width="14" height="45" /></td>
            </tr>
        </table>
		</td>
      </tr>
      <tr>
        <td class="colourBar"></td>
      </tr>
      <tr>
        <td class="boder boderBtm">
		<table width="989" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="808" align="left">
	<div class="chromestyle" id="chromemenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            
			<td width="7%" align="center" class="topDevider"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/welcome.php"  class="topLinks">Home</a></td>
        	<?php if ($this->_tpl_vars['GENERAL']['USER_TYPE'] == 'A'): ?>
			<td width="7%" align="center" class="topDevider"><a href="javascript: void(0);" rel="dropmenu1" class="topLinks">Pages</a></td>
    		
			<td width="7%" align="center" class="topDevider"><a href="javascript: void(0);" rel="dropmenu2" class="topLinks">Alumni</a></td>
			<td width="11%" align="center" class="topDevider"><a href="javascript: void(0);"  rel="dropmenu6" class="topLinks">Enrollments</a></td>
			<td width="7%" align="center" class="topDevider"><a href="javascript: void(0);" rel="dropmenu3" class="topLinks">Site</a></td>			
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['GENERAL']['USER_TYPE'] == 'A' || $this->_tpl_vars['GENERAL']['USER_TYPE'] == 'C'): ?>
			<td align="center" width="17%" class="topDevider"><a href="javascript: void(0);" rel="dropmenu8" class="topLinks">Conference Service</a></td>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['GENERAL']['USER_TYPE'] == 'A'): ?>
			<td width="14%" align="center" class="topDevider"><a href="javascript: void(0);" rel="dropmenu4" class="topLinks">Communication</a></td>			
	        <?php endif; ?>
			
			<?php if ($this->_tpl_vars['GENERAL']['USER_TYPE'] == 'A' || $this->_tpl_vars['GENERAL']['USER_TYPE'] == 'M'): ?>
			<td width="15%" align="center" class="topDevider"><a href="javascript: void(0);" rel="dropmenu5" class="topLinks">OEP Programmes </a></td>
		    <td width="16%" align="center" class="topDevider"><a href="javascript: void(0);" rel="dropmenu7" class="topLinks">OFP Programmes </a></td>
			<?php endif; ?>
            <td align="center">&nbsp;</td>
          </tr>
        </table>
</div>
<!--1st drop down menu -->                                                   
<div id="dropmenu1" class="dropmenudiv">
	
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=1">REDC is Unique </a>
		<!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=2">Services </a>-->
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=3">Facilities </a>
		<!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=5">Content </a>-->
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=7">Programmes</a>
		<!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=4">Faculty</a>-->
        <a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=0">Other Pages</a>

		
	
		<!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=11">OFP Programmes </a>-->
	
		<!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=8">Conference Services </a>-->
	
</div>
<!--2nd drop down menu -->                                                   
<div id="dropmenu2" class="dropmenudiv">
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=9">Pages</a>
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/alumnimanagement.php">Alumni</a>
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/testimonialmanagement.php">Alumni Testimonials</a>
</div>

<div id="dropmenu8" class="dropmenudiv">
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=8">Pages</a>
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/conferenceservicemanagement.php">Conference Service Requests</a>
</div>
<!--3rd drop down menu -->                                                   
<div id="dropmenu3" class="dropmenudiv">
    
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/adminmanagement.php">Admins</a>
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/newsmanagement.php">News</a>
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/faqcategorymanagement.php">FAQs</a>
		<!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/templatemanagement.php">NewsLetter Template</a>-->
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/usermanagement.php">User Manager</a>
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/facultymanagement.php">Faculty Profiles</a>
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/vtmanagement.php">Virtual Tours</a>
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/gallerymanagement.php">Picture Galleries</a>
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/uploadpdf.php">Upload Program Calender</a>
		
		<!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepmanagement.php">0EP Programmes Manager</a>
		<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php">0EP Applicants Manager</a>		-->		
		<!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/ofpbrouchermanagement.php">OFP Broucher Manager </a>-->
		<!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oeppodcastmanagement.php">OEP Podcast Manager </a>-->
</div>
<!--3rd drop down menu -->
<!--<div id="dropmenu3" class="dropmenudiv" style="width: 150px;">
</div>-->
<!--4rd drop down menu -->                                                   
<div id="dropmenu4" class="dropmenudiv" style="width: 200px;">
	
	
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contactusmanagement.php?status=O">Contact Us Requests</a>
<!--	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/ofprequestsmanagement.php">OFP Applicants Requests</a>-->
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/emailcontentmanagement.php">Email Contents</a>
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/templatemanagement.php">Newletter Template Manager </a>
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/mailinglistmanagement.php">Mailing List</a>
	</div>
	
	<div id="dropmenu5" class="dropmenudiv" style="width: 200px;">
	
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepmanagement.php">Categories</a>
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oep_programme.php">Programmes</a>
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepapplicantsmanagement.php">Applicants</a>
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oeppodcastmanagement.php">Podcasts</a>
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepannualbrochuremanagement.php">Annual Brochures</a>	
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/oepbrochuremanagement.php">Brochures</a>	
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/viewbroucherrequest.php">Brochure Requests</a>			
	
	</div>
	<div id="dropmenu6" class="dropmenudiv" style="width: 200px;">
	<!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/brouchermanagement.php">OFP Broucher Request</a>-->
	
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=10">Pages</a>
	<!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/viewbroucherrequest.php">Brochure Requests</a>-->
	
	</div>
	<div id="dropmenu7" class="dropmenudiv" style="width: 200px;">
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=11">Pages</a>
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/brouchermanagement.php">Brochure Requests</a>
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/ofprequestsmanagement.php">OFP Requests</a>
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/ofpmanagement.php">Programmes</a>
	<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/ofpbrouchermanagement.php">Brochures</a>	
	
	<!--<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/contentmanagement.php?section_id=10">Manage CMS Pages</a>-->
	
	</div>
	
<!--5rd drop down menu --> 
<!--<div id="dropmenu5" class="dropmenudiv" style="width: 150px;">
<a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/configmanagement.php">Configuration</a>
</div>-->
<!--6 drop down menu -->   
<!--                                                
<div id="dropmenu6" class="dropmenudiv" style="width: 180px;">
<a href="userdesignmanager.php">User Design Manager</a>
</div>
-->
<?php echo '
	<script type="text/javascript">
      cssdropdown.startchrome("chromemenu")
    </script>
'; ?>

    </td>
    <!--<td width="18"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/adm_preview.jpg" alt="My Account" width="14" height="14" style="padding-top:4px;" /></td>-->
    <!--<td width="50"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/profile.php" class="normalTxt">Profile</a></td>-->
    <td width="18"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/adm_preview.jpg" alt="My Account" width="14" height="14" style="padding-top:4px;" /></td>
    <td width="50"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/profile.php" class="normalTxt">Profile</a></td>
    <td width="19"><img src="<?php echo $this->_tpl_vars['GENERAL']['ADMIN_IMG_URL']; ?>
/adm_logout.jpg" alt="logout" width="14" height="14" style="padding-top:4px;" /></td>
    <td width="67"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ADMIN']; ?>
/logout.php" class="normalTxt">Logout</a></td>
  </tr>
</table>
		</td>
      </tr>
</table>