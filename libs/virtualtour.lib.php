<?php
/**
 * Podcast Audio Management application library
 *
 */
class VirtualTour extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_page_content";
	var $sortcolumn=" vtgid ";
	var $sortdirection=" desc ";
	
    /**
     * class constructor
     */
    function VirtualTour() {
     	$this->tpl =& new Smarty;
		$this->db();
    }
  
	function getPageData($pagename)
	{
	 $query ="select * from ".$this->tablename. " where pagename = ".$this->mySQLSafe($pagename);

	 $rs=$this->execute($query);
		if($rs!=false)
		{
			$fetch = mysql_fetch_array($rs);
			// Fill all field 
			$data["pcid"]=$fetch["pcid"];
			$data['pagename'] = $fetch['pagename'];
    		$data['explorertitle'] = $fetch['explorertitle'];
			$data['pagetitle'] = $fetch['pagetitle'];
			$data['menutitle'] = $fetch['menutitle'];
			$data['keywords'] = $fetch['keywords'];
			$data['description'] = $fetch['description'];
			$data['details'] = $fetch['details'];
			$data['pageorder'] = $fetch['pageorder'];			
		}			
       return $data; 
	
	}
	 function getsectionimage()
	{
		
		$query = "select sec_image from redc_page_section where sectionname= 'Virtual Tour'";
		$rs=$this->select($query);
		return $rs;
	}
	
    function displayPage($data = array()) {
	    global $GENERAL;		
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('pagedata', $this->getPageData('Virtual Tour'));
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('simage', $this->getsectionimage());
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('virtualtour.tpl');        
    }
}
?>