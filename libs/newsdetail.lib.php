<?php
/**
 * Podcast Audio Management application library
 *
 */
class Newsdetail extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_news";
	var $sortcolumn=" nid ";
	var $sortdirection=" asc ";
	
    /**
     * class constructor
     */
	 
	 function editEntry($nid=0)
	{
		$_query = "select *  from ".$this->tablename." where nid=$nid";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["nid"]=$fetch[0]["nid"];
			$data["title"]=$fetch[0]["title"];
			$data["dated"]=$fetch[0]["dated"];
			$data["link"]=$fetch[0]["link"];
			$data['description'] = $fetch[0]['description']; 
			$data["isactive"]=$fetch[0]["isactive"];
			$data["isfeatured"]=$fetch[0]["isfeatured"];
		}
		
        return $data; 
	}  
    function Newsdetail() {
     	$this->tpl =& new Smarty;
		$this->db();
    }
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
		$paging->num= $this->numrows("select nid from ".$this->tablename);
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
		   $this->error="No existing news found.";
		   $data=null;
		  }
	    return $data;   
    }
    /**
     * display the Faq entry form
     *
     * @param array $formvars the form variables
     */
    function displayForm($formvars = array()) {

		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		
		$this->tpl->assign('pageview',$this->pageview);
		if(count($formvars) == 0)
		{
			$formvars['pubdate'] = date('Y-m-d');
			$this->tpl->assign('data',$formvars);		
		}
		else
		{			
			$this->tpl->assign('data',$formvars);
		}
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('newsdetail.tpl');
    }
    /**
     * display the Faq records
     *
     * @param array $data the Faq data
     */
    function displayGird($data = array()) {
	
	    global $GENERAL;		
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('newsdetail.tpl');        
    }
}
?>