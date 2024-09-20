<?php
	session_start();
	$id = 0;
	if(isset($_SESSION['userid']))
		$id = $_SESSION['userid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> SimpleModal Apply Online Form </title>

<meta name='author' content='Eric Martin' />
<meta name='copyright' content='2009 - Eric Martin' />

<!-- Import jQuery and SimpleModal source files -->
<script src='js/jquery.js' type='text/javascript'></script>
<script src='js/jquery.simplemodal.js' type='text/javascript'></script>

<script language="javascript">
	var callbackurl = '<?=$_REQUEST['callback']?>';
	var uid = '<?=$id?>';
	var oepid = '<?=$_REQUEST['oepid']?>';
</script>
<!-- Contact Form JS and CSS files -->
<script src='js/applyonline.js' type='text/javascript'></script>
<link type='text/css' href='css/applyonline.css' rel='stylesheet' media='screen' />
<link type='text/css' href='css/form.css' rel='stylesheet' media='screen' />

</head>
<body>
<div id='contactForm' style="height:860px;; width:100%;">
</div>
</body>
</html>