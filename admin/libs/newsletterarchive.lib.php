<?php
/**
 * Podcast Audio Management application library
 *
 */
class NewsLetterArchive extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_newsletter_histroy";
	var $tblnlsubscriber="redc_newsletter_subscribers";
	var $tblnlalumni="redc_alumni";
	var $sortcolumn=" nhid ";
	var $sortdirection=" asc ";
	
    /**
     * class constructor
     */
    function NewsLetterArchive() {
     if($_SESSION['permission']['news_manager'] == 'No')
		{
		  header("Location:welcome.php");
		  exit;
		}
		$this->tpl =& new Smarty;
		$this->db();
    }
   function getDetail($nhid=0)
	{
		$_query = "select *  from ".$this->tablename." where nhid=$nhid";

		$fetch=$this->select($_query);
		if($fetch)
		{
			$data = $fetch[0];
		}
		return $data; 
	}  
	 function getToemail()
	{
		$enabled = $_GET['group'];
	    
		if($enabled == "1" || $enabled == "Alumni")
		{
		  $_where = "where isactive = 'Yes' "; 
		  $_query = " select * from ".$this->tblnlalumni." ".$_where."  order by email asc ";
		  
		}
		 elseif($enabled == "2" || $enabled == "Subscriber")
		{
		  $_where = "where isactive = 'Yes' "; 
		  $_query = " select * from ".$this->tblnlsubscriber." ".$_where."  order by email asc ";
		
		}  
		

		$recordset=$this->execute($_query);
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch['email'];
			//$bcc[]=$fetch['email'];
	        
		}
		return $data; 
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
		$paging->num= $this->numrows("select nhid from ".$this->tablename);
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
		if($fetch)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing newsletter archive found";
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
		$this->tpl->assign('toemail',$this->getToemail());
		$this->tpl->assign('data', $formvars);
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('newsletterarchive.tpl');
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
		
	    $this->tpl->display('newsletterarchive.tpl');        
    }
}

?>
