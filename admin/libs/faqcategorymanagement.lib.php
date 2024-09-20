<?php
/**
 * Podcast Audio Management application library
 *
 */
class FaqCategoryManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_faq_categories";
	var $table_name="redc_faq";
	var $sortcolumn="fcatid";
	var $sortdirection="asc";
	
    /**
     * class constructor
     */
    function FaqCategoryManagement(){
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
        if(strlen(trim($formvars['category_name'])) == 0) {
            $this->error = 'Please provide category name.';
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
		$query = "select * from ".$this->tablename." where name = '".$formvars['category_name']."'";
		$fetch = $this->select($query);
		if($fetch!=false){
			$this->error = "Category name already exists kindly use another category name.";
			return false;
		}
    	$record['name']=$this->mySQLSafe( $formvars['category_name']);
		if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="The category has been added successfully.";
			return true;
		}
		else
		{
			$this->error="The category has not been added.";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	function editEntry($category_id=0)
	{
		$_query = "select *  from ".$this->tablename." where fcatid=$category_id";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["category_id"]=$fetch[0]["fcatid"];
			$data["category_name"]=$fetch[0]["name"];
		}
		
        return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars) {
	
	$query = "select * from ".$this->tablename." where fcatid !=".$formvars['category_id']." and name = '".$formvars['category_name']."'";
	
		$fetch = $this->select($query);
		if($fetch!=false){
			$this->error = "Category name already exists kindly use another category name.";
			return false;
		}
        $record['name']=$this->mySQLSafe($formvars['category_name']);
		$where="fcatid=".$formvars['category_id'];
		if($this->update($this->tablename,$record,$where))
		{
	    	
			$this->error="The category has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="The category has not been updated.";
			return false;			
		}
    }
	/*
	* Delete entry from data base.
	 * @param category_id for delete specific record database.
	*/
	function deleteEntry($category_id=0)
	{

		$qry 	= 	"select * from ".$this->table_name." where fcatid = $category_id";
		$fetch	=	$this->select($qry);
		if($fetch)
		{
			$this->execute("delete from ".$this->table_name." where fcatid = $category_id");
		}

		$_where = "fcatid='".$category_id."' ";
		$result=$this->delete($this->tablename,$_where);
		if($result == 1) 
		{
	    	$this->error="The category has been removed successfully.";
			return true;
		}
		else
		{
			$this->error="Category has not been deleted. Because there are some FAQ exist in this category.";
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
		$paging = new Paginate();
		$paging->num= $this->numrows("select * from ".$this->tablename);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$where="";
		
		$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";
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
        $this->tpl->display('faqcategorymanagement.tpl');
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
		
	    $this->tpl->display('faqcategorymanagement.tpl');        
    }
}
?>