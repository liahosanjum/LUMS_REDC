<?php
/**
 * Content Management application library
 *
 */
class ConferenceServices extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_page_content";
	var $table_section="redc_page_section";
	var $sortcolumn="pageorder";
	var $sortdirection="asc";
	
    /**
     * class constructor
     */
    function ConferenceServices() {
        if(!isset($_REQUEST['section_id']) || $_REQUEST['section_id'] == "")
		{
		  header("Location:index.php");
		  exit;
		}
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
		$paging->num= $this->numrows("select pcid from ".$this->tablename. " where pcid ='".$formvars['pcid']."'");
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?section_id=".$formvars['section_id'],PAGESIZE);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		
		$_where = "where pcid = '".$formvars['pcid']."' ";
		
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
	
	 function getsectionimage($section_id)
	{
		
		$query = "select sec_image from redc_page_section where psid= $section_id";
		$rs=$this->select($query);
		return $rs;
	}
	   ///// get section information
   function getSectionName($section_id)
	{
   	   $_query = "select pcid, psid, pagename, menutitle from " . $this->tablename ." where psid = '".$section_id."' and visible ='Yes' order by pageorder";
	   $rs=$this->select($_query);
	   
	  return $rs;	
	}
	
	function getpagedata($pcid)
	{
	 $query ="select * from ".$this->tablename. " where pcid ='".$pcid."'";
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
			      /**
     * display the Content entry form
     */
    function displayForm($formvars = array()) {
        global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('data',$formvars);			
		$this->tpl->assign('error', $this->error);
        $this->tpl->assign('section_data', $this->getSectionName($_REQUEST['section_id']));
		$this->tpl->display('conference_services.tpl');
    }
    /**
     * list the content page records
     */
    function displayGird($data = array()) {
	    global $GENERAL;
	    $this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('section_data', $this->getSectionName($_REQUEST['section_id']));
		$this->tpl->assign('simage', $this->getsectionimage($_REQUEST['section_id']));
		$this->tpl->assign('pagedata', $this->getpagedata($_REQUEST['pcid']));
		$this->tpl->assign('total_page', count($this->getEntries(0,$_REQUEST)));
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
	    $this->tpl->display('conference_services.tpl');        
    }

 
}
?>