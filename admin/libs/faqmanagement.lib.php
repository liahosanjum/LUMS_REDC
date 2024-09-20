<?php
/**
 * Podcast Audio Management application library
 *
 */
class FaqManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_faq";
	var $table_category="redc_faq_categories";
	var $sortcolumn="faqid";
	var $sortdirection="asc";
	
    /**
     * class constructor
     */
    function FaqManagement(){
        if(!isset($_REQUEST['category_id']) || $_REQUEST['category_id'] == "")
		{
		    header("Location: faqcategorymanagement.php");
			exit;
		}
		$this->tpl =& new Smarty;
		$this->db();
    }
    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars) {

		// reset error message
        $this->error = null;
        
		// test if "Title" is empty
        if(strlen(trim($formvars['question'])) == 0) {
            $this->error = 'Please provide question.';
            return false; 
        }

        if(strlen(trim($formvars['answer'])) == 0) {
            $this->error = 'Please provide answer.';
            return false; 
        }
        if(strlen(trim($formvars['answer'])) > 1000) {
            $this->error = 'Please provide Answer with max 1000 length.';
            return false; 
        }
	    return true;
    }
  	 /**
     * add a new Gallery entry
     *
     * @param array $formvars the form variables
     */
    function addEntry($formvars) 
	{
    	$record['question']=$this->mySQLSafe( $formvars['question']);
		$record['fcatid']=$this->mySQLSafe( $formvars['category_id']);
		$record['answer']=$this->mySQLSafe( $formvars['answer']);
		$record['isactive']=$this->mySQLSafe($formvars['enabled']);
				
	  	if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="FAQ has been added successfully.";
			return true;
		}
		else
		{
			$this->error="FAQ has not been added.";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
		$_query = "select *  from ".$this->tablename." where faqid=$id";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["id"]=$fetch[0]["faqid"];
			$data["question"]=$fetch[0]["question"];
			$data["answer"]=$fetch[0]["answer"];
			$data['enabled'] = $fetch[0]['isactive']; 
		}
		
        return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars) {

        $record['question']=$this->mySQLSafe( $formvars['question']);
		$record['answer']=$this->mySQLSafe( $formvars['answer']);
		$record['isactive']=$this->mySQLSafe($formvars['enabled']);
				
		$where="faqid=".$formvars['id'];
		if($this->update($this->tablename,$record,$where))
		{
	    $this->error="FAQ has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="FAQ has not been updated.";
			return false;
			
		}
    }
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($id=0)
	{
		$_where = "faqid='".$id."' ";
		$result=$this->delete($this->tablename,$_where);
		if($result == 1) 
		{
	    	
			$this->error="FAQ has been deleted successfully.";
			return true;
		}
		else
		{
			$this->error="FAQ has not been deleted.";
			return false;			
		}			
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
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$where=" where fcatid = '".$formvars['category_id']."'";
		$_query = "select * from " . $this->tablename. $where ;
		
		$paging = new Paginate();
		$paging->num= $this->numrows($_query);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";
		///Sort order
		$fetch=$this->select($_query);
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing record found";
		   $data=null;
		  }
	    return $data;   
    }
	function categoryInfo($category_id)
	{
	      $_query = "select *  from ".$this->table_category." where fcatid=$category_id";
		  $fetch=$this->select($_query);
    	  if($fetch!=false)
			{
	    		$data=$fetch[0];
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
		$this->tpl->assign('data',$formvars);
		// assign error message
        $this->tpl->assign('error', $this->error);
		$this->tpl->assign('category', $this->categoryInfo($_REQUEST['category_id']));
        $this->tpl->display('faqmanagement.tpl');
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
		$this->tpl->assign('category', $this->categoryInfo($_REQUEST['category_id']));
	    $this->tpl->display('faqmanagement.tpl');        
    }
}
?>