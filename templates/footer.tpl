


{php}
	$db = new db();
	$query = "select * from redc_oepannual_brochure where status='Y' limit 1";
	$res = $db->select($query);
{/php}
<div class="clear"></div>
<div class="bottom_links_bar">
	<div class="bottom_links">
		<div class="unicon">
		  <p>
				<a href="http://www.uniconexed.org/" target="_blank"><img src="{$GENERAL.FRONT_IMG_URL}/unicon.gif" style="border:none" alt="UNICON" /></a>
				LUMS is a member of the International University Consortium for Executive Education (UNICON)</p>
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
				<li><!--<a href="prog_finder.php">Programme Calendar</a>--><a href="map.php?keepThis=true&amp;TB_iframe=true&amp;height=600&amp;width=931">Map/Directions</a></li>
                <li><a href="{$GENERAL.BASE_URL_ROOT}/brochure/index.html" target="_blank">Annual Brochure</a></li>
				<li><a href="{$GENERAL.BASE_URL_ROOT}/offer_course/annual-brochure.pdf" target="_blank">Download Annual Brochure</a></li>
			<!--	<li><a href="{$GENERAL.BASE_URL_ROOT}/offer_course/annual-brochure.pdf" target="_blank">Download Annual Brochure</a></li> -->
				<!--<li><a href="#" class="ebroucherrequest">Request an OEP Printed Brochure</a></li> -->
			{php}
			if($res[0][filename] != "")
			{
			{/php}
		
			 {php} } {/php}
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


<div class="clear"></div>
