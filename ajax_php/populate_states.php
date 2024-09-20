<?php
require_once('../classlibrary/configuration.php');
require_once($GENERAL['PHYSICAL_PATH_CLASSLIB'].'/db.php');

$db = new Db();

if($_REQUEST['type'] == 'admin')
{
  $returnstring = "<select name=\"state\" id=\"state\" class=\"select_class\">";
}
else
{
 $returnstring = "<select name=\"state\" id=\"state\" class=\"select_class\">";
}
 	 $returnstring.="<option value=\"\" selected=\"selected\">Please select state</option>"; 	
 if(isset($_REQUEST['country']) && $_REQUEST['country']!='')
 {
     if($_REQUEST['country']=='USA')
	  {
	     $query = "Select * from site_states where country = '".$_REQUEST["country"]."'";
	     $data = $db->select($query); 
		 	
		 if($data != false)
		 {
		     for($i = 0; $i < count($data); $i++ )
			   {
			      $returnstring.="<option value=\"".$data[$i]['statename']."\">".$data[$i]['statename']."</option>";   
			   }
		 }
	 }	
 }
 $returnstring.="</select>"; 	    	  
print($returnstring);

?>
