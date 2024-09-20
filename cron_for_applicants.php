<?php
	require_once('classlibrary/configuration.php');
	require_once('classlibrary/db.php');
	$tbloepprograms = "redc_oep_programmes";
	$tblapplicants  = "redc_oep_applicants";
	$tmpprogarray = array();
		
	$db = new db;
	
	$query_list_completed_programms = "select oepid from ".$tbloepprograms." where enddate <= '".date("Y-m-d")."' and isactive = 'Yes'";
	
	if($db->numrows($query_list_completed_programms))
	{
		$fetch = $db->select($query_list_completed_programms);
		$i = 0;
		
		foreach($fetch as $f)
		{
			$tmpprogarray[$i] = $f['oepid'];
			$i++;
		}
		
		$oepids = implode("," , $tmpprogarray);
		
		$update_oepapp_status = "update ".$tblapplicants." set `applicationstatus` = 'R' where oepid in ($oepids) and applicationstatus = '' ";
		$db->execute($update_oepapp_status);
	}	
	
?>
