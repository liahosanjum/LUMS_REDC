{php}
		$id = 0;
		if(isset($_SESSION['userid']))
		$id = $_SESSION['userid'];
		$logged = $_REQUEST['cmd'];

{/php}

<link href="{$GENERAL.BASE_URL_ROOT}/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{$GENERAL.BASE_URL_ROOT}/css/screen.css" type="text/css" media="screen" />
<link rel="stylesheet" href="{$GENERAL.BASE_URL_ROOT}/css/contact.css" type="text/css" media="screen" />
<link type='text/css' href='{$GENERAL.BASE_URL_ROOT}/css/broucherrequest.css' rel='stylesheet' media='screen' />
<link type='text/css' href='{$GENERAL.BASE_URL_ROOT}/css/ofprequests.css' rel='stylesheet' media='screen' />
<link type='text/css' href='{$GENERAL.BASE_URL_ROOT}/css/ebroucherrequests.css' rel='stylesheet' media='screen' />
<link rel="stylesheet"type="text/css" href="{$GENERAL.BASE_URL_ROOT}/css/mouseovertabs.css" />
<link rel="stylesheet"type="text/css" href="{$GENERAL.BASE_URL_ROOT}/css/thickbox.css" />
<link type='text/css' href='{$GENERAL.BASE_URL_ROOT}/css/conferenceservicesrequest.css' rel='stylesheet' media='screen' />
<link type='text/css' href='{$GENERAL.BASE_URL_ROOT}/css/applyonline.css' rel='stylesheet' media='screen' />
<link type='text/css' href='{$GENERAL.BASE_URL_ROOT}/css/form.css' rel='stylesheet' media='screen' />
<link rel="stylesheet"type="text/css" href="{$GENERAL.BASE_URL_ROOT}/css/accordion_faq.css" />
<link rel="stylesheet"type="text/css" href="{$GENERAL.BASE_URL_ROOT}/css/screen_ie.css" />

<script src="{$GENERAL.BASE_URL_ROOT}/js/common.js" type="text/javascript"></script>
<script src="{$GENERAL.BASE_URL_ROOT}/js/jquery.min.js" type="text/javascript"></script>
<script src='{$GENERAL.BASE_URL_ROOT}/js/jquery.simplemodal.js' type='text/javascript'></script>
<script src='{$GENERAL.BASE_URL_ROOT}/js/conferenceservicesrequest.js' type='text/javascript'></script>
<script src='{$GENERAL.BASE_URL_ROOT}/js/ofprequests.js' type='text/javascript'></script>
<script src='{$GENERAL.BASE_URL_ROOT}/js/ebroucherrequests.js' type='text/javascript'></script>
<script src='{$GENERAL.BASE_URL_ROOT}/js/broucherrequest.js' type='text/javascript'></script>
<script src="{$GENERAL.BASE_URL_ROOT}/js/thickbox.js" type="text/javascript"></script>
<script src="{$GENERAL.BASE_URL_ROOT}/js/mouseovertabs.js" type="text/javascript"></script>
<script type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/animatedcollapse.js"></script>
<script src='{$GENERAL.BASE_URL_ROOT}/js/contact.js' type='text/javascript'></script>
<script type="text/javascript">
	var uid 	 = '{php} echo $id;{/php}';
	var iflogged = '{php}echo $logged;{/php}';

</script>
<script src='{$GENERAL.BASE_URL_ROOT}/js/applyonline.js' type='text/javascript'></script>
<script src='{$GENERAL.BASE_URL_ROOT}/js/jscripts.js' type='text/javascript'></script>
<script type="text/javascript" src="{$GENERAL.BASE_URL_ROOT}/js/jquery.accordion.js"></script>
<script language="javascript">AC_FL_RunContent = 0;</script>
{literal}
<script type="text/javascript">

animatedcollapse.addDiv('tabs', 'fade=1')
animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
}
animatedcollapse.init()
</script>
{/literal}
