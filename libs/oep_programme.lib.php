<?php
/**
 * Content Management application library
 *
 */
class Ofp_Programme extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_ofpprogrammes";
	var $sortcolumn="pageorder";
	var $sortdirection="asc";
	
    /**
     * class constructor
     */
    function Ofp_Programme() {
        /*if(!isset($_REQUEST['section_id']) || $_REQUEST['section_id'] == "")
		{
		  header("Location:index.php");
		  exit;
		}*/
		$this->tpl = new Smarty;
	    $this->db();
    }
 	/**
     * test if form information is valid
     */
    	function getEntries($_start=0,$formvars) {

		$data=null;
		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			$this->sortcolumn=$formvars['sortcolumn'];
			$this->sortdirection=$formvars['sortdirection'];
		}else if(isset($_GET['sc']) && isset($_GET['sd']))
		{
			$this->sortcolumn=$_GET['sc'];
			$this->sortdirection=$_GET['sd'];
		}
		//$where =" where is_newsletter_broucher='Yes'";
		/// Paging for data tables
		$paging = new Paginate();
		//$paging->num= $this->numrows("select * from ".$this->tablename);
		$paging->num= $this->numrows("select ofpid from ".$this->tablename. " where ofpid ='".$formvars['ofpid']."'");
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?section_id=".$formvars['section_id'],PAGESIZE);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		
		$_where = "where ofpid = '".$formvars['ofpid']."' ";
		
		$_query = "select * from " . $this->tablename. " ".$_where." "."  Limit $paging->start,$paging->limit";
		
		$fetch=$this->select($_query);
		
		if($fetch != false)
		{
			$data=$fetch;
		}
		else
		{
		  //$this->error="No existing content page found";
		}
	return $data;   
    }
	   
	function getProgrammeName()
	{
	 $_query = "select name,ofpid from " . $this->tablename ." where enabled = 'Yes'";
	 $nu = $this->select($_query);
	 return $nu;
	}
	
	function getpagedata($pcid)
	{
	 $query ="select * from redc_page_content where pcid ='".$pcid."'";
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
	function getPage()
	{
		$_query = "select * from redc_page_content where psid = '11' and visible ='Yes'";
		$rs = $this->select($_query);
	 return $rs;
		
	}
	function getPcategory()
	{
		$_query = "select * from redc_oep_programmes_category order by sort_index";
		$rs = $this->select($_query);
	 	return $rs;
	}
	function getProgrammes()
	{
		$query = "select * from redc_oep_programmes where oepcatid = " .$this->mySQLSafe($_GET['oepcatid'])."  AND isactive = 'Yes' and (enddate >='".date('Y-m-d')."' or status = 'tba')";
		
		$rs = $this->select($query);
	 	return $rs;
	}
	function getsectionimage()
	{
		
		$query = "select sec_image from redc_page_section where psid= '14'";
		$rs=$this->select($query);
		
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
        $this->tpl->assign('section_data', $this->getSectionName());
		$this->tpl->display('oep_programme.tpl');
    }
    /**
     * list the content page records
     */
    function displayGird($data = array()) {
	    global $GENERAL;
	    $this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pname',$this->getProgrammeName());
		$this->tpl->assign('category',$this->getPcategory());
//		$this->tpl->assign('programmes',$this->getProgrammes());
		$this->tpl->assign('page',$this->getPage());
		$this->tpl->assign('pagedata', $this->getpagedata($_REQUEST['pcid']));
		$this->tpl->assign('simage', $this->getsectionimage($_REQUEST['section_id']));
		$this->tpl->assign('total_page', count($this->getEntries(0,$_REQUEST)));
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
	    $this->tpl->display('oep_programme.tpl');        
    }

 
}

function getProgrammes($catId)
{
	$db = new db();
//	 $query = "select * from redc_oep_programmes where oepcatid = " .$db->mySQLSafe($catId)."  AND iscompleted = 'N' AND isactive = 'Yes' AND deadline >'".date("Y-m-d")."' ORDER BY sort_index";
	 $query = "select * from redc_oep_programmes where oepcatid = " .$db->mySQLSafe($catId)." AND isactive = 'Yes' AND (enddate >'".date("Y-m-d")."' or status = 'tba') ORDER BY sort_index";
	$rs = $db->select($query);
	return $rs;
}
?>