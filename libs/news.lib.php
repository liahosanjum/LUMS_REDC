<?php
class News extends db
{
    var $tpl = null;
	var $error = null;
	var $tblpages="tblpages";
	var $tblnews  = "redc_news";
	var $tablename="redc_page_content";	
    var $countRecords = 0;
	var $sortby = " dated ";
	var $sortorder = " DESC ";
    function News() {
       	$this->db();
	    $this->tpl =& new Smarty;
    }
	function loadNews()
	{
		$paging = new Frontpaginate();
		$paging->num=$this->numrows("select * from ". $this->tblnews);
		$this->countRecords = $paging->num;
		$paging->start = 0;
		$paging->limit=PAGESIZEFRONT;
		$paging->Frontpaginate($paging->limit,$paging->num,"?",5);
		$this->tpl->assign('paging',$paging->displayTable());
		
		$_query = "select *  from ".$this->tblnews." where isactive='Y' order by ". $this->sortby . $this->sortorder ."  Limit $paging->start,$paging->limit";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data=$fetch;
		}		

        return $data; 
	}
	
	 function getsectionimage()
	{
		
		$query = "select sec_image from redc_page_section where psid= 0";
		$rs=$this->select($query);
		return $rs;
	}
	
	function loadNewsDetail($formvars)
	{
		$data = null;
		$_query = "select *  from ".$this->tblnews." where nid =  ".$formvars['id']." and isactive='Y'";
		$rs = $this->execute($_query);
		if($rs != null)
		{
			$data = mysql_fetch_array($rs);		
		}


        return $data; 
	}
	
	function getPageData($pagename)
	{
		 $query ="select * from ".$this->tablename. " where pagename =".$this->mySQLSafe($pagename);
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
	
	function displayPage() 
	{
		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('pagedata', $this->getPageData('News and Events'));
		$this->tpl->assign('pagenum', $this->countRecords);
		$this->tpl->assign('simage', $this->getsectionimage($_REQUEST['section_id']));
		if(isset($_SESSION['message']))
		{
			$this->tpl->assign('error', $_SESSION['message']);
			$_SESSION['message'] = '';
		}
		else
		{
		    $this->tpl->assign('error', $this->error);
		}

		$this->tpl->assign('news', $this->loadNews()); 
		$this->tpl->display('news.tpl');
	}	
	
	function displayNews($formvars) 
	{
		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('pagedata', $this->getPageData('News and Events'));
		$this->tpl->assign('simage', $this->getsectionimage($_REQUEST['section_id']));
		$this->tpl->assign('pagenum', $this->countRecords);
		if(isset($_SESSION['message']))
		{
			$this->tpl->assign('error', $_SESSION['message']);
			$_SESSION['message'] = '';
		}
		else
		{
		    $this->tpl->assign('error', $this->error);
		}

		$this->tpl->assign('news', $this->loadNewsDetail($formvars)); 
		$this->tpl->display('news.tpl');
	}	
}
?>