<?php
/**
 * Home Page Management application library
 *
 */
class Index extends db{

	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $tablename="redc_page_content";
	var $table_section="redc_page_section";
	var $table_oepprog="redc_oep_programmes";
	var $table_category="redc_oep_programmes_category";
	/**
     * class constructor
     */
    function Index() {
       	$this->db();
	    $this->tpl =& new Smarty;
    }
	function loadContent($page)
	{
		$data=null;
		$_query = "select *  from ".$this->tablecontent." where pagename='".$page."'";
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["itemid"]=$fetch[0]["itemid"];
			$data['explorertitle'] = $fetch[0]['explorertitle'];
    		$data['pagename'] = $fetch[0]['pagename'];
			$data['pagetitle'] = $fetch[0]['pagetitle'];
			$data['keywords'] = $fetch[0]['keywords'];
			$data['description'] = $fetch[0]['description'];
			$data['pagecontent'] = $fetch[0]['pagecontent']; 				
		}		
       return $data; 
	}
	
	function getCategories()
	{
	      $_query = "select * from ".$this->table_category." order by name";
		  $fetch=$this->select($_query);
          return $fetch; 
	}
	
	// function for taking ope Programme name for ajax function 
	function progName ($formvars)
	{
	  $where="";
	  $where =" where month(startdate) = '".$formvars['month']."' and year(startdate) = ".$this->mySQLSafe(date('Y'));
	  $query ="select name from ".$this->table_oepprog.$where;
	   $fetch =$this->select($query);
	   return $fetch; 
	
	} 
	function loadProcess()
	{
		$_query = "select * from process";
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$process=$fetch;
		}		
        return $process; 
	}
	
	function loadNews()
	{
		$_query = "SELECT * FROM redc_news  where isactive = 'Y' and isfeatured = 'Y' ORDER BY  dated DESC LIMIT 2"; 
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$news=$fetch;
		}		
        return $news; 
	}
	
	function getMonths()
	{
		$arr = array();

		for($i =0; $i < 6; $i++)
		{
			$year = date('Y');
			$month = date('m') + $i;
			
			if($month > 12)
			{
				$month = $month - 12;
				$year = $year + 1;
			}
			
//			$arr[$i]	 = date('M', mktime(0,0,0, $month, 1, $year));
			$arr[$i]	 = date('Y-m-d', mktime(0,0,0, $month, 1, $year));
		}
//		print_r($arr);
		return ($arr);
	}
	function getPcontent()
	{
			$pages = array();
			
		$_query = "select pcid from redc_page_content where psid=1 and visible='Yes' order by pageorder limit 1";
		$rs = $this->execute($_query);
			if($rs!=false)
			{
				$fetch = mysql_fetch_array($rs);
				$pages["unique"]=$fetch["pcid"];
			}

		$_query = "select pcid from redc_page_content where psid=3  and visible='Yes' order by pageorder limit 1";
		$rs = $this->execute($_query);
		if($rs!=false)
		{
			$fetch = mysql_fetch_array($rs);
			$pages["facility"]=$fetch["pcid"];
		}


		$_query = "select pcid from redc_page_content where psid=8  and visible='Yes' order by pageorder limit 1";
		$rs = $this->execute($_query);
		if($rs!=false)
		{
			$fetch = mysql_fetch_array($rs);
			$pages["conference"]=$fetch["pcid"];
		}	 
		$_query = "select pcid from redc_page_content where psid=10  and visible='Yes' order by pageorder limit 1";
		$rs = $this->execute($_query);
		if($rs!=false)
		{
			$fetch = mysql_fetch_array($rs);
			$pages["enrollment"]=$fetch["pcid"];
		}
		
		return $pages;
		
	}
	
	function getOEPAnnualBrochure()
	{
		$query = "select * from redc_oepannual_brochure where status='Y' limit 1";

		$res = $this->select($query);
		
		if($res != NULL)
		{
			return $res[0];
		}
		else
			return null;

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
		$this->tpl->assign('pname' , $this->getCategories ());
		$this->tpl->assign('oepname' , $this->progName ($formvars));
		$this->tpl->assign('news',$this->loadNews());
		$this->tpl->assign('pcontent',$this->getPcontent());
		$this->tpl->assign('dates',$this->getMonths());
	    $this->tpl->assign('error', $this->error);
		$this->tpl->assign('annualbrochure', $this->getOEPAnnualBrochure());
		
		$this->tpl->assign('section_data_unique', $this->getSectionName(1));
		$this->tpl->assign('section_data_programme', $this->getSectionName(7));
		$this->tpl->assign('section_data_conference', $this->getSectionName(8));
		$this->tpl->assign('section_data_faculty', $this->getSectionName(4));
		$this->tpl->assign('section_data_facilities', $this->getSectionName(3));
		$this->tpl->assign('section_data_enrollment', $this->getSectionName(10));
		$this->tpl->assign('section_data_alumni', $this->getSectionName(9));
		
		$this->tpl->display('index.tpl');
	}	
}
?>	