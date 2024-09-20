<?php
/**
 * Email Content Management application library
 *
 */
class brouchermanagement extends db{

	// database object
    var $sql = null;
	// smarty broucher object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $emailvariable=null;
	var $emailname = "";	
	var $tablename="redc_broucher_request";
	var $sortcolumn="bid";
	var $sortdirection="asc";
	
    /**
     * class constructor
     */
    function brouchermanagement() {
        if($_SESSION['permission']['email_content_manager'] == 'No')
		{
		  header("Location:welcome.php");
		  exit;
		}
		$this->tpl =& new Smarty;
		$this->db();
    }
    
	
	/*
	* load record from data base.
	*/
	function editEntry($bid=0)
	{
		//$_query = "select c.*,u.first_name,u.last_name,u.user_type,u.email_address from ".$this->tablename." c, ".$this->table_user." u where c.user_id = u.user_id and c.id=".$id."";
		   $_query ="select * from ".$this->tablename." where bid = $bid";
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data = $fetch[0];
			
			
		}		
        return $data;   
    }	
		
	/**
     * Updating content entry
     *
     * @param array $formvars the form variables
     */
	function updateEntry($id) {
      	$record['isactive']=$this->mySQLSafe("Y");
		$where="bid=".$id;
		if($this->update($this->tablename,$record,$where))
		{
	    	$this->error="Brochure service request has been closed successfully";
			return true;
		}
		else
		{
			$this->error="Brochure service request has been not closed";
			return false;			
		}        
    }
	
    /**
     * get the Page content entries
	  * @param start variables use for paging.
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
		$paging->num= $this->numrows("select * from ".$this->tablename);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
//		$paging->limit = PAGESIZE;
		$paging->limit = 20;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		
		$_query = "select * from " . $this->tablename. $orderby ."  Limit $paging->start,$paging->limit" ;
		
		$fetch=$this->select($_query);
		
		if($fetch != false)
		{
			$data=$fetch;
		}
		else
		{
		  $this->error="No existing content page found";
		}
	return $data;   
    }
	
	function getClosedEntries($action,$_start=0,$formvars) {

		$data = null;
		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			$this->sortcolumn=$formvars['sortcolumn'];
			$this->sortdirection=$formvars['sortdirection'];
		}else if(isset($_GET['sc']) && isset($_GET['sd']))
		{
			$this->sortcolumn=$_GET['sc'];
			$this->sortdirection=$_GET['sd'];
		}
		//$query_new = "select c.*,u.first_name,u.last_name,u.user_type,u.email_address from ".$this->tablename." c, ".$this->table_user." u where c.user_id = u.user_id and c.status='C'";
		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows("select csid from ".$this->tablename);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->extraQuerysting="action=viewclose&";
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",10);
		$this->tpl->assign('paging',$paging->displayTable());
		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			$this->sortcolumn=$formvars['sortcolumn'];
			$this->sortdirection=$formvars['sortdirection'];
		}		
		///Sort order
		//$orderby=" where c.user_id = u.user_id and c.status='C' order by ". $this->sortcolumn ." ". $this->sortdirection;
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch)
		{
			$data=$fetch;
		}
		else
		{
    		$this->error="No existing Brochure service request found";
		}
        return $data;   
    }
	
	function deleteEntry($bid=0)
	{
				 
		$_query="delete from ".$this->tablename." where bid=$bid";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	
			$this->error="Brochure request has been deleted successfully.";
			return true;
		}
		 /*
		else
		{
			$this->error="NewLetter broucher has not been deleted.";
			return false;			
		}
		 */			
	}	
     /**
     * display the Content entry form
     *
     * @param array $formvars the form variables
     */
    function displayForm($formvars = array()) {
        global $GENERAL;
		// assign the form vars
        $this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('emailname',$this->emailname);		
        $this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('data',$formvars);
		$this->tpl->assign('emailvariable', $this->emailvariable);	
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('brouchermanagement.tpl');
    }
    /**
     * display the content page records
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
	    $this->tpl->display('brouchermanagement.tpl');        

    }
}

?>
