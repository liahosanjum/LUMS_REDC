<?php
require_once('../classlibrary/configuration.php');
require_once($GENERAL['PHYSICAL_PATH_CLASSLIB'].'/db.php');

$db = new Db();
$dest_text = isset($_REQUEST['text']) && $_REQUEST['text'] != '' ? $_REQUEST['text'] : 'destination';
if($_REQUEST['type'] == 'admin'){
	$returnstring = "<select name=\"city_id\" id=\"city_id\" class=\"select_class\" ";
} else {
	$returnstring = "<select name=\"city_id\" id=\"city_id\" class=\"inputclass\" ";
}
$returnstring.=$_REQUEST['from']=='addtour'?"onchange=\"javascript: checkNew();\">":">";

$returnstring.="<option value=\"\" selected=\"selected\">Please select $dest_text </option>";
if(isset($_REQUEST['country_id']) && $_REQUEST['country_id']!='')
 {
	$query = "Select city_id,city_name from travelhub_city where country_id = '".$_REQUEST["country_id"]."'";
	$data = $db->select($query); 
	if($data != false)
	{
		for($i = 0; $i < count($data); $i++ )
		{
			$returnstring.="<option value=\"".$data[$i]['city_id']."\">".$data[$i]['city_name']."</option>";
		}
	}	
	$returnstring.=$_REQUEST['from']=='addtour'?"<option value=\"Other\" >Other - Specify</option>":"";
	$returnstring.="</select>";
 }
else
{
   $returnstring.="</select>";
} 
print($returnstring);
?>