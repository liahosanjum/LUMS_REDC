<?php
/**
 * Content Management application library
 *
 */
class Calendar extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $tablepage="redc_page_content";	
	var $pageview=null;
	var $tablename="redc_oep_programmes";
	var $table_category="redc_oep_programmes_category";
	var $sortdirection="asc";
	var $programme_by_level = "";
	var $searchbyname = "";
	var $searchbyoepcatid = "";
	var $month = "";
	var $countRecords = 0;
	    /**
     * class constructor
     */
    function Calendar() 
	{
       
		$this->tpl = new Smarty;
		$this->db();
    }
 	/**
     * test if form information is valid
     */
    	
		
		
		
		function programmeFinder($_start=0,$formvars)
	   {
		   
		$this->searchbyname 	= $formvars['search_by_name'];
		$this->programme_by_level	= $formvars['programme_by_level'];
		$this->searchbyoepcatid = $formvars['search_by_oepcatid'];
		$this->month= $formvars['month'];
			
		$where.=" where 1=1 ";
		
		if($formvars['search_by_name'] != "")
		{
			$where .= " and pro.name like ".$this->mySQLSafe('%'.$formvars['search_by_name'].'%');	
		}
		
		if($formvars['programme_by_level'] != "")
		{
			$where .= " and programmelevel = ".$this->mySQLSafe($formvars['programme_by_level']);	
		}
		
		if($formvars['search_by_oepcatid'] != "")
		{
			$where .= " and cat.oepcatid = ".$this->mySQLSafe($formvars['search_by_oepcatid']);	
		}
		
		if($formvars['month'] != "")
		{
			$where .= " and month(startdate) = ".$this->mySQLSafe($formvars['month']);	
		}
		
//		$where .= " and year(startdate) = ".$this->mySQLSafe(date('Y'))." and cat.oepcatid = pro.oepcatid AND pro.deadline >'".date("Y-m-d")."' AND iscompleted = 'N' and isactive = 'Yes'";
//		$where .= " and ((year(startdate) = ".$this->mySQLSafe(date('Y'))." and pro.deadline >'".date("Y-m-d")."') or pro.status='tba') and cat.oepcatid = pro.oepcatid AND isactive = 'Yes'";

//		$where .= " and (pro.enddate > '".date("Y-m-d")."' or pro.status='tba') and cat.oepcatid = pro.oepcatid AND isactive = 'Yes'";
		
		/// Paging for data tables       
		$_query = "(select pro.*, cat.name as category_name from redc_oep_programmes as pro , redc_oep_programmes_category as cat  where 1=1  and (pro.enddate > '".date("Y-m-d")."' and pro.status='a') and cat.oepcatid = pro.oepcatid AND isactive = 'Yes' and pro.startdate is not null  )
union
(select pro.*, cat.name as category_name from redc_oep_programmes as pro , redc_oep_programmes_category as cat  where 1=1  and pro.status='tba' and cat.oepcatid = pro.oepcatid AND isactive = 'Yes')
		order by status, startdate
";

		$paging = new Frontpaginate();
		 $paging->num=$this->numrows($_query);
	 
	 	$this->countRecords = $paging->num;
	 
	$paging->start = 0;

		$paging->limit=PAGESIZEFRONT;
		$paging->Frontpaginate($paging->limit,$paging->num,"?search_by_name=".$formvars['search_by_name']."&programme_by_level=".$formvars['programme_by_level']."&search_by_oepcatid=".$formvars['search_by_oepcatid']."&month=".$formvars['month'],10);
		$this->tpl->assign('paging',$paging->displayTable());
//   $_query = "select pro.*, cat.name as category_name from " .$this->tablename . " as pro , ".$this->table_category. " as cat " .$where. " AND iscompleted = 'N' AND isactive = 'Yes' order by pro.startdate  desc Limit $paging->start,$paging->limit";
//   $_query = "select pro.*, cat.name as category_name from " .$this->tablename . " as pro , ".$this->table_category. " as cat " .$where. " order by pro.startdate  asc Limit $paging->start,$paging->limit";


//$paging->num=$this->numrows("select pro.*, cat.name as category_name from " .$this->tablename . " as pro , ".$this->table_category. " as cat " .$where." AND iscompleted = 'N' AND isactive = 'Yes'");

		$_query .= " Limit $paging->start,$paging->limit";
		$this->tpl->assign('query', $_query);
		
		$fetch=$this->select($_query);
		
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No  programme found.";
		   $data=null;
		  }

        return $data; 
	}
	
	function getCategories()
	{
	     $_query = "select * from ".$this->table_category." order by sort_index";
		  //$_query="select*from redc_oep_programmes_category order by name";
		  $fetch=$this->select($_query);
          return $fetch; 
	}
	
	 function getsectionimage()
	{
		
		$query = "select sec_image from redc_page_section where psid= '7'";
		$rs=$this->select($query);
		return $rs;
	}
	
	
	function getPageData($pagename)
	{
	 $query ="select * from ".$this->tablepage. " where pagename = ".$this->mySQLSafe($pagename);

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
	function getProgrammes()
	{
		$query = "select * from redc_oep_programmes where oepcatid = " .$this->mySQLSafe($_GET['oepcatid'])."  AND isactive = 'Yes' and (enddate >='".date('Y-m-d')."' or status = 'tba')";
		$rs = $this->select($query);
	 	return $rs;
	}
	
	function getProgrammeName()
	{
	 $_query = "select name,oepid from redc_oep_programmes  where isactive = 'Yes'";
	 $nu = $this->select($_query);
	 return $nu;
	}
	function getPcategory()
	{
		$_query = "select * from redc_oep_programmes_category order by sort_index";
		$rs = $this->select($_query);
	 	return $rs;
	}
	function getPage()
	{
		$_query = "select * from redc_page_content where psid = '11' and visible ='Yes'";
		$rs = $this->select($_query);
	 return $rs;
		
	}
	
	
    /**
     * display the Content entry form
     */
    function displayForm($formvars = array()) {
        global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('data',$formvars);			
		$this->tpl->assign('error', $this->error);
        $this->tpl->display('calendar.tpl');
    }
    /**
     * list the content page records
     */
    function displayGird($data= array()) {
	    global $GENERAL;
		$arrysearch["search_by_name"] 	= $this->searchbyname;
		$arrysearch["search"] 	= $this->programme_by_level;
		$arrysearch["search_by_oepcatid"] 		= $this->searchbyoepcatid;
		$arrysearch["month"] = $this->month;
		$this->tpl->assign('formvars', $arrysearch);
	   $this->tpl->assign('pname',$this->getProgrammeName());
		$this->tpl->assign('page',$this->getPage());
		$this->tpl->assign('category',$this->getPcategory());
		$this->tpl->assign('simage', $this->getsectionimage());
		$this->tpl->assign('pagedata', $this->getPageData('Programme Finder'));
	    $this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pagenum', $this->countRecords);
		$this->tpl->assign('count', count($data));
		$this->tpl->assign('category' , $this->getCategories ());
//		$this->tpl->assign('programmes', $this->getProgrammes($_REQUEST['oepid_']));
		//$this->tpl->assign('total_page', count($this->programmeFinder($_start,$formvars,$_REQUEST)));
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
	    $this->tpl->display('calendar.tpl');        
    }

 
}
function getProgrammes($catId)
{
	$db = new db();
	// $query = "select * from redc_oep_programmes where oepcatid = " .$db->mySQLSafe($catId)."  AND iscompleted = 'N' AND isactive = 'Yes' ORDER BY oepid DESC";
//	 $query = "select * from redc_oep_programmes where oepcatid = " .$db->mySQLSafe($catId)."  AND iscompleted = 'N' AND isactive = 'Yes'  AND deadline >'".date("Y-m-d")."' ORDER BY sort_index" ;
	 $query = "select * from redc_oep_programmes where oepcatid = " .$db->mySQLSafe($catId)."  AND isactive = 'Yes' and (enddate >='".date('Y-m-d')."' or status = 'tba') ORDER BY sort_index" ;
	$rs = $db->select($query);

	return $rs;
}

?>