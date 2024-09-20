<?php
/**
 * Content Management application library
 *
 */
class FacultyProfiles extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview		= null;
	var $tablename		= "redc_page_content";
	var $table_faculty	= "redc_faculty";
	var $sortcolumn		= " fid ";
	var $sortdirection	=" asc ";

	
    /**
     * class constructor
     */
    function FacultyProfiles() {
        if(!isset($_REQUEST['section_id']) || $_REQUEST['section_id'] == "")
		{
		  header("Location:index.php");
		  exit;
		}
		$this->tpl = new Smarty;
		$this->db();
    }
 	
	
   function getEntries($_start=0,$formvars , $groupby = "") {

		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			$this->sortcolumn=$formvars['sortcolumn'];
			$this->sortdirection=$formvars['sortdirection'];
		}else if(isset($_GET['sc']) && isset($_GET['sd']))
		{
			$this->sortcolumn=$_GET['sc'];
			$this->sortdirection=$_GET['sd'];
		}
		
		$where = " where is_active = 'Yes' ";
		
		if($groupby != "")
		{
			if($groupby == "ad")
			{
				$where .= " and (name like 'a%' OR name like 'b%' OR name like 'c%' OR name like 'd%' )";
			}
			
			else if($groupby == "eh")
			{
				$where .= " and (name like 'E%' OR name like 'F%' OR name like 'G%' OR name like 'H%' )";
			}
			
			else if($groupby == "il")
			{
				$where .= " and (name like 'i%' OR name like 'j%' OR name like 'k%' OR name like 'l%' )";
			}
			
			else if($groupby == "mp")
			{
				$where .= " and (name like 'm%' OR name like 'n%' OR name like 'o%' OR name like 'p%' )";
			}
			
			else if($groupby == "qt")
			{
				$where .= " and (name like 'q%' OR name like 'r%' OR name like 's%' OR name like 't%' )";
			}

			else if($groupby == "uz")
			{
				$where .= " and (name like 'u%' OR name like 'v%' OR name like 'w%' OR name like 'x%' OR name like 'y%' OR name like 'z%' )";
			}

		}
		
		/// Paging for data tables       
		$paging = new Frontpaginate();
		$paging->num= $this->numrows("select fid from ".$this->table_faculty. $where);
		$this->tpl->assign('totalrecords',$paging->num);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZEFRONT;
		$paging->Frontpaginate($paging->limit,$paging->num,"?section_id=".$_GET['section_id'],3);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by name ". $this->sortdirection;
		
//		$_query = "select * from " . $this->table_faculty. $where . $orderby ."  Limit $paging->start,$paging->limit";
		$_query = "select * from " . $this->table_faculty. $where . $orderby;
		$fetch=$this->select($_query);
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing profile found.";
		   $data=null;
		  }
	    return $data;   
    }
   

   // get section information
   function getSectionName($section_id)
	{
   	   $_query = "select pcid, psid, pagename, menutitle from " . $this->tablename ." where psid = '".$section_id."' and visible ='Yes' order by pageorder";
	   $rs=$this->select($_query);
	   return $rs;	
	}

    function getsectionimage($section_id)
	{
		
		$query = "select sec_image from redc_page_section where psid= $section_id";
		$rs=$this->select($query);
		return $rs;
	}
   
   // get section information
   function getsectiondata()
	{
   	   $_query = "select pagename,pagetitle,explorertitle,description,details,keywords, menutitle from " . $this->tablename ." where psid = 0 and pagename='Faculty Directory' and visible ='Yes'";
	   $rs=$this->select($_query);
	   return $rs[0];	
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
		$this->tpl->assign('pagedata', $this->getsectiondata());
		$this->tpl->assign('total_page', count($this->getEntries(0,$_REQUEST)));
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
	    $this->tpl->display('faculty_profiles.tpl');        
    }

 
}
?>