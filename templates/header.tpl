
<div class="logo_bar">
    <div class="logo"> <a href="http://www.lums.edu.pk" target="_blank"><img src="{$GENERAL.FRONT_IMG_URL}/logo.gif" border="0" usemap="#Map" class="lums_logo" />
        <map name="Map" id="Map">
          <area shape="rect" coords="0,0,93,76" href="http://www.lums.edu.pk" target="_blank" alt="LUMS" />
          <area shape="rect" coords="101,21,316,73" href="http://sdsb.lums.edu.pk" target="_blank" alt="Suleman Dawood - School of Business" />
        </map>
    </a> <a href="index.php"><img src="{$GENERAL.FRONT_IMG_URL}/rausing_logo.gif" class="redc_logo" /></a>
      <div class="clear"></div>
    </div>
	
  </div>
  <div class="clear"></div>
  <div class="navi_bar">
    <div id="mytabsmenu" class="tabsmenuclass">
      <ul>
       <li><a class="{php}if(strpos($_SERVER['PHP_SELF'], 'index.php') !== FALSE) { echo 'active';}else{echo inactive; }{/php}" href="{$GENERAL.BASE_URL_ROOT}/index.php">Home</a></li>	
        <li><a class="{if $smarty.get.section_id eq '1'}active{else}inactive{/if}" href="{$GENERAL.BASE_URL_ROOT}/redc_unique_main.php?section_id=1&pcid=526" rel="gotsubmenu">REDC is unique</a></li>
        <li><a class="{php}if(strpos($_SERVER['PHP_SELF'], 'programme') !== FALSE or strpos($_SERVER['PHP_SELF'], 'oep_programme') !== FALSE or strpos($_SERVER['PHP_SELF'], 'ofp_programme') !== FALSE or strpos($_SERVER['PHP_SELF'], 'prog_finder') !== FALSE or $_GET[section_id] == '11' or $_GET[oepid_] != '') { echo 'active';}else{echo inactive;}{/php}" href="{$GENERAL.BASE_URL_ROOT}/programme.php?section_id=0&pcid={$pcontent.programme}" rel="gotsubmenu">Programmes</a></li>
        <li><a class="{if $smarty.get.section_id eq '8' or $smarty.get.pcid eq $pcontent.virtual}active{else}inactive{/if}" href="{$GENERAL.BASE_URL_ROOT}/conference_services.php?section_id=8&pcid={$pcontent.conference}" rel="gotsubmenu">Conference Services</a></li>
        <li><a class="{if $smarty.get.section_id eq '4'}active{else}inactive{/if}" href="{$GENERAL.BASE_URL_ROOT}/faculty_profiles.php?section_id=4" rel="gotsubmenu">Faculty</a></li>
        <li><a class="{if $smarty.get.section_id eq '3'}active{else}inactive{/if}" href="{$GENERAL.BASE_URL_ROOT}/facilites.php?section_id=3&pcid={$pcontent.facility}" rel="gotsubmenu">Facilities</a></li>
        <li><a class="{if $smarty.get.section_id eq '10'}active{else}inactive{/if}" href="{$GENERAL.BASE_URL_ROOT}/enrollment.php?section_id=10&pcid={$pcontent.enrollment}" rel="gotsubmenu">Enrollment</a></li>
        <li><a class="{php}if(strpos($_SERVER['PHP_SELF'], 'alumni_login') !== FALSE or strpos($_SERVER['PHP_SELF'], 'alumni_history') !== FALSE or strpos($_SERVER['PHP_SELF'], 'alumni_profile') !== FALSE or strpos($_SERVER['PHP_SELF'], 'alumni_directory') !== FALSE or $_GET[section_id] == '9') { echo 'active';}else{echo inactive;}{/php}" href="{$GENERAL.BASE_URL_ROOT}/alumni.php?section_id=9&pcid={$pcontent.alumni}" rel="gotsubmenu">REDC Alumni</a></li>
		</ul>
    </div>
    <div style="padding:0px; margin:0px; height:6px !important; border-bottom:#d3d3d3 solid 1px;" />
    <img src="{$GENERAL.FRONT_IMG_URL}/spacer.gif" /></div>
  <div class="clear"></div>
  <div id="mysubmenuarea" class="tabsmenucontentclass"> <a href="{$GENERAL.BASE_URL_ROOT}/uploads/submenucontents.htm" style="visibility:hidden">Sub Menu contents</a> </div>
  <script type="text/javascript">
		mouseovertabsmenu.init("mytabsmenu", "mysubmenuarea", true)
	</script>
</div>


