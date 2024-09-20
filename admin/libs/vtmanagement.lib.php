<?php
/**
 * Podcast Audio Management application library
 *
 */
class galleryManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_vt_galleries";
	var $table_pname="redc_oep_programmes";
	var $table_name="redc_vt_pictures";
	var $sortcolumn=" vtgid ";
	var $sortdirection=" desc ";
	
    /**
     * class constructor
     */
    function galleryManagement() {
     	$this->tpl =& new Smarty;
		$this->db();
    }
  
	/*
	* load record from data base.
	*/
	
	function getpname()
	{
//		 $_query = "select oepid , name from ".$this->table_pname." where  iscompleted ='N'";
		 $_query = "select oepid , name from ".$this->table_pname." where enddate > '".date("Y-m-d")."'";
		return $this->select($_query);
	}


	/*
		* To delete existing picture if new one is uploaded.
		* @param pic src to unlink it.
	*/
	function unlinkPicture($src)
	{
	  $oldImagepath = PHYSICAL_PATH."/images/gallery/".$src;
	  @unlink($oldImagepath);
	}





    /**
     * get the Faqs entries
	  * @param start variables use for paging.
     */
      function getEntries($_start=0,$formvars) {

		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			$this->sortcolumn=$formvars['sortcolumn'];
			$this->sortdirection=$formvars['sortdirection'];
		}else if(isset($_GET['sc']) && isset($_GET['sd']))
		{
			$this->sortcolumn=$_GET['sc'];
			$this->sortdirection=$_GET['sd'];
		}
		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows("select vtgid from ".$this->tablename);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$where=" ";
		
		$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing gallery found.";
		   $data=null;
		  }
	    return $data;   
    }
   
    function displayGird($data = array()) {
	    global $GENERAL;		
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('vtmanagement.tpl');        
    }
}
?>