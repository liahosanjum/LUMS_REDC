<?php
require_once('../classlibrary/configuration.php');
require_once($GENERAL['PHYSICAL_PATH_CLASSLIB'].'/db.php');

$db = new Db();
if(isset($_REQUEST['month']) && isset($_REQUEST['year']))
{	
//    $query = "Select oepid, oepcatid, name, startdate, enddate from redc_oep_programmes where month(startdate) = ".$db->mySQLSafe($_REQUEST['month'])." and year(startdate) = ".$db->mySQLSafe($_REQUEST['year']). " AND isactive = 'Yes' AND deadline >'".date("Y-m-d")."' ORDER BY startdate LIMIT 3" ;

    $query = "Select oepid, oepcatid, name, startdate, enddate, deadline from redc_oep_programmes where month(startdate) = ".$db->mySQLSafe($_REQUEST['month'])." and year(startdate) = ".$db->mySQLSafe($_REQUEST['year']). " AND isactive = 'Yes'  AND enddate > '".date("Y-m-d")."' and status='a' ORDER BY startdate LIMIT 3" ;

	$fetch=$db->select($query);
	if($fetch!=false)
	{
		for($i=0; $i < count($fetch); $i++)
		{
			/*
			$available = "Y";

//			if(date("d M, Y", strtotime($fetch[$i]["deadline"])) >  date("d M, Y"))
			if(strtotime(date("Y-M-d", strtotime($fetch[$i]["deadline"]))) >  strtotime(date("Y-M-d")))
			{
				$available = "Y";
			}
			else
			{
				$available = "N";
			}			
			*/
			
//			$returnstring .= $fetch[$i]["oepid"] . "~". $fetch[$i]["oepcatid"] . "~". $fetch[$i]["name"] . "~".date("d M, Y", strtotime($fetch[$i]["startdate"])). "~".date("d M, Y", strtotime($fetch[$i]["enddate"]))."~".$available.";";
			$returnstring .= $fetch[$i]["oepid"] . "~". $fetch[$i]["oepcatid"] . "~". $fetch[$i]["name"] . "~".date("d M, Y", strtotime($fetch[$i]["startdate"])). "~".date("d M, Y", strtotime($fetch[$i]["enddate"])).";";
		}
	}
}

print($returnstring);

?>
