<?php
	include_once('../classlibrary/configuration.php');
	include_once('../classlibrary/db.php');
	include_once('../libs/applyonline.lib.php');

// OBJECT OF CLASS APPLYONLINE
	$applyonline = new ApplyOnline;

	
	$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != "") ? $_REQUEST['action'] : "";
	
	
	if (empty($action))
	{
		
	// Send back the apply form HTML
	$output = "<div style='display:none;' class='wraper_login'>
	<div align='right'><a href='#' title='Close' class='modalCloseX simplemodal-close'><img src='images/applyonline/crossicon.jpg' border='0' /></a></div>
	<input type='hidden' name='divname' value='1' id='apply-divname'/>
	<input type='hidden' name='ifregistered' value='".$ifregistered."' id='apply-ifregistered'/>
	<div class='forms-apply apply-content'>
	<form action='#' style='display:block;' >
	<div class='forminputs-apply'>
	<div id='s1'>
	<h2 class='apply-title'>Application Rejected:</h2>
		<div class='clear' />
		<p>
			<div style='color:#FF0000;' align='center'>Sorry, You have already applied for this programme.</div>
		</p>
	
	</div>
	</div>
	</form>
	</div>
	<div class='apply-bottom'></div>
</div>";

//http://www.ericmmartin.com/projects/simplemodal/
	echo $output;
	}

	else if(!empty($action))
	{
		$uid = $_REQUEST['uidcheck'];
		if($applyonline->alreadyapplied($uid))
		{
			echo 0; // incase if exist
		}
		else
			echo 1; // in case if doesn't exist
	}
	
	exit;
?>