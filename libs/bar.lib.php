<?php
class Bar extends db
{
    var $tpl = null;
	var $error = null;
	var $tablename = "redc_page_content";

    function Bar() {
       	$this->db();
	    $this->tpl =& new Smarty;
    }

	function getSectionName($section_id)
	{
   	   $_query = "select pcid, psid, pagename, menutitle from " . $this->tablename ." where psid = '".$section_id."' and visible ='Yes' order by pageorder";
	   $rs=$this->select($_query);
	   
	  return $rs;	
	}
	
	function displayPage() 
	{
	
		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		
		$this->tpl->assign('section_data_unique', $this->getSectionName(1));
		$this->tpl->assign('section_data_programme', $this->getSectionName(7));
		$this->tpl->assign('section_data_conference', $this->getSectionName(8));
		$this->tpl->assign('section_data_faculty', $this->getSectionName(4));
		$this->tpl->assign('section_data_facilities', $this->getSectionName(3));
		$this->tpl->assign('section_data_enrollment', $this->getSectionName(10));
		$this->tpl->assign('section_data_alumni', $this->getSectionName(9));
		
		$this->tpl->display('bar.tpl');
	}	
}
?>