<?php /* Smarty version 2.6.22, created on 2011-04-26 02:19:35
         compiled from includes.tpl */ ?>
<?php 
/*
		$id = 0;
		if(isset($_SESSION['userid']))
		$id = $_SESSION['userid'];
		$logged = $_REQUEST['cmd'];
*/

		if(isset($_REQUEST['exitfooter']) && $_REQUEST['exitfooter'] != "")
		{
			unset($_SESSION['userid']);
			unset($_SESSION['fname']);
			unset($_SESSION['lname']);
		 ?> <script type="text/javascript">
			window.location.href = "login.php";
		</script><?php 
		}
		
		

 ?>


<link rel="stylesheet" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/screen.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/contact.css" type="text/css" media="screen" />
<link type='text/css' href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/broucherrequest.css' rel='stylesheet' media='screen' />
<link type='text/css' href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/ofprequests.css' rel='stylesheet' media='screen' />
<link type='text/css' href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/ebroucherrequests.css' rel='stylesheet' media='screen' />
<link rel="stylesheet"type="text/css" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/mouseovertabs.css" />
<link rel="stylesheet"type="text/css" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/thickbox.css" />
<link type='text/css' href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/conferenceservicesrequest.css' rel='stylesheet' media='screen' />
<link type='text/css' href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/applyonline.css' rel='stylesheet' media='screen' />
<link type='text/css' href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/alumni.css' rel='stylesheet' media='screen' />
<link type='text/css' href='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/form.css' rel='stylesheet' media='screen' />
<link rel="stylesheet"type="text/css" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/accordion.css" />
<link href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/apply.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/common.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/jquery.min.js" type="text/javascript"></script>
<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/jquery.simplemodal.js' type='text/javascript'></script>
<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/conferenceservicesrequest.js' type='text/javascript'></script>
<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/ofprequests.js' type='text/javascript'></script>
<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/ebroucherrequests.js' type='text/javascript'></script>
<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/broucherrequest.js' type='text/javascript'></script>
<script src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/thickbox.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/mouseovertabs.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/animatedcollapse.js"></script>
<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/contact.js' type='text/javascript'></script>
<link rel="stylesheet"type="text/css" href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/css/screen_ie.css" />
<script type="text/javascript">
	var uid 	 = '<?php  echo $id; ?>';
	var iflogged = '<?php echo $logged; ?>';
</script>
<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/jscripts.js' type='text/javascript'></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/jquery.accordion.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/fixPNG.js"></script>
<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/alumnilogin.js' type='text/javascript'></script>
<script language="javascript">AC_FL_RunContent = 0;</script>
<?php echo '
<script type="text/javascript">

animatedcollapse.addDiv(\'tabs\', \'fade=1\')
animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
}
animatedcollapse.init()
</script>
'; ?>
