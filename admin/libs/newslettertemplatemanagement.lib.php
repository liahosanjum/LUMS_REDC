<?php
/**
 * Email Content Management application library
 *
 */
class NewsletterTemplateManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $emailvariable=null;
	var $tablename="site_emailcontent";
	var $sortcolumn="emailname";
	var $sortdirection="asc";
	
    /**
     * class constructor
     */
    function NewsletterTemplateManagement() {
        if($_SESSION['permission']['newsletter_manager'] == 'No')
		{
		  header("Location:welcome.php");
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
        
        if(strlen(trim($formvars['emailname'])) == 0) {
            $this->error = 'You must supply email name.';
            return false; 
        }
        if(strlen(trim($formvars['fromname'])) == 0) {
            $this->error = 'You must supply a name.';
            return false; 
        }
		
        if(strlen(trim($formvars['fromemail'])) == 0) {
            $this->error = 'You must supply an email address.';
            return false; 
        }
		 
		 if(strlen(trim($formvars['subject'])) == 0) {
            $this->error = 'You must supply a subject.';
            return false; 
        }
		 
		 if(strlen(trim($formvars['content'])) == 0) {
            $this->error = 'You must supply content.';
            return false; 
        }
        return true;
    }

    function addEntry($formvars)
	{
    	$record['emailname']=$this->mySQLSafe($formvars['emailname']);
    	$record['fromname']=$this->mySQLSafe($formvars['fromname']);
		$record['fromemail']=$this->mySQLSafe($formvars['fromemail'] );		
		$record['subject']=$this->mySQLSafe($formvars['subject']);
		$record['content']=$this->mySQLSafe($formvars['content']);
		$record['is_newsletter_template']=$this->mySQLSafe('Yes');
				
	  	if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="Newsletter template has been added successfully";
			return true;
		}
		else
		{
			$this->error="Newsletter template has not been added";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
		$_query = "select *  from ".$this->tablename." where itemid=$id";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data['itemid'] = $fetch[0]['itemid'];
			$data['emailname'] = $fetch[0]['emailname'];
			$data['fromname'] = $fetch[0]['fromname'];
    		$data['fromemail'] = $fetch[0]['fromemail'];
			$data['subject'] = $fetch[0]['subject'];
			$data['content'] = $fetch[0]['content'];
		}
        return $data;   
	}	

	function deleteEntry($id=0)
	{
		$_query="delete from ".$this->tablename." where itemid=$id";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	
			$this->error="Newsletter template has been deleted successfully";
			return true;
		}
		else
		{
			$this->error="Newsletter template has not been deleteed";
			return false;			
		}			
	}	

	/*
	* load record from data base.
	*/
	function loadEmailBody($emailname='')
	{
		$_query = "select *  from ".$this->tablename." where emailname='$emailname'";
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data["itemid"] 	= $fetch[0]["itemid"];
			$data['fromname'] 	= $fetch[0]['fromname'];
    		$data['fromemail'] 	= $fetch[0]['fromemail'];
			$data['subject'] 	= $fetch[0]['subject'];
			$data['content'] 	= $fetch[0]['content']; 
		}
		
        return $data;   
	}	
	/**
     * Updating content entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars) {

		$record['emailname']=$this->mySQLSafe($formvars['emailname']);
		$record['fromname']=$this->mySQLSafe($formvars['fromname']);
		$record['fromemail']=$this->mySQLSafe($formvars['fromemail']);
		$record['subject']=$this->mySQLSafe($formvars['subject']);
		$record['content']=$this->mySQLSafe($formvars['content']);
		
		$where="itemid=".$formvars['itemid'];
		
		if($this->update($this->tablename,$record,$where))
		{
	    	$this->error="Newsletter template has been updated successfully";
			return true;
		}
		else
		{
			$this->error="Newsletter template has not been updated";
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
		$where = " where is_newsletter_template='Yes' ";
		/// Paging for data tables  
		$paging = new Paginate();
		$paging->num= $this->numrows("select itemid from ".$this->tablename.$where);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
//		$paging->limit = PAGESIZE;
		$paging->limit = 20;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		
		$_query = "select * from " . $this->tablename.$where.$orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		
		if($fetch != false)
		{
			$data=$fetch;
		}
		else
		{
		  $this->error="No existing newsletter template found";
		}
		
        return $data;
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
        $this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('data',$formvars);
		// assign error message
		$this->tpl->assign('error', $this->error);
        $this->tpl->display('newslettertemplatemanagement.tpl');
    }
    /**
     * display the content page records
     *
     * @param array $data the Faq data
     */
    function displayGrid($data = array()) {
        global $GENERAL;
	    $this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
	    $this->tpl->display('newslettertemplatemanagement.tpl');        

    }
}

?>
