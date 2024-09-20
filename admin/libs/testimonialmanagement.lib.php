<?php
/**
 * Advertisement  Management application library
 *
 */
class TestimonialManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tbltestimonials = "redc_testimonials";
	var $tablename="redc_oep_programmes";
	var $sortcolumn="t.dated";
	var $sortdirection="asc";
	
	
    /**
     * class constructor
     */
    function TestimonialManagement() {
        $this->tpl =& new Smarty;
		$this->db();
    }
    
    
    
    /**
     * fix up form data if necessary
     *
     * @param array $formvars the form variables
     */
    function mungeFormData(&$formvars) {

        $formvars['author'] = trim($formvars['author']);
		$formvars['details'] = trim($formvars['details']);		
		$formvars['is_active'] = trim($formvars['is_active']);
		$formvars['oepid'] = trim($formvars['oepid']);				
	}
	 
	 function isValidSorting($formvars) {
		$isvalid = true;
	  	$indexes = $formvars['sort_index'];
		for($i=0; $i<count($indexes);$i++)
		{
			if(!ereg("^[0-9]+$", $indexes[$i]))
			{			
				$isvalid = false;
				$this->error = 'Sort index should be a positive number for each record';
				break;
			}
		}
				
		return $isvalid;
	  }
	  
	 function isValidForm($formvars) {

		// reset error message
        $this->error = null;
        
        /*if(strlen($formvars['author']) == 0) {
            $this->error = 'Please provide author';
            return false; 
        }*/
		if(strlen($formvars['details']) == 0) {
            $this->error = 'Must provide details';
            return false; 
        }
		
		
		
        return true;
    }
	
	/**
     * add a new user
     *
     * @param array $formvars the form variables
     */
    function addEntry($formvars) {

		$record['author']=$this->mySQLSafe( $formvars['author']);
		$record['oepid']=$this->mySQLSafe( $formvars['oepid']);
		$record['details']=$this->mySQLSafe( $formvars['details']);
		$record['dated']=$this->mySQLSafe( date("Y-m-d"));
		$record['is_active']=$this->mySQLSafe($formvars['is_active']);
		if($this->insert($this->tbltestimonials,$record) > 0 ) 
		{
			$this->error="Testimonial has been added successfully";
			return true;
		}
		else
		{
			$this->error="Testimonial was not added";
			return false;
			
		}
    }

	function saveTestimonials($formvars)
	{
	    $pageids = split("-",substr_replace($formvars['testimonialids'],"",-1));
		for($i=0; $i < count($pageids); $i++)
		{
		    $record['sort_index']=$this->mySQLSafe(($i+1));
			$where="item_id=".$pageids[$i];
	        $this->update($this->tbltestimonials,$record,$where);
		}
		$this->error = "Testimonials order have been saved successfully.";
		return true;	  
	}
	
	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
		$_query = "select *  from ".$this->tbltestimonials." where item_id=$id";
		
		$recordset=$this->execute($_query);
		while($fetch=mysql_fetch_array($recordset))
		{
			// Fill all field 
			$data["item_id"]=$fetch["item_id"];
			$data["oepid"]=$fetch["oepid"];
			$data["author"]=$fetch["author"];
			$data["details"]=$fetch["details"];
			$data["is_active"]=$fetch["is_active"];						
	 	}
		
        return $data;   
	}

	/**
     * Updating Member entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars) {

		
		$record['oepid']=$this->mySQLSafe( $formvars['oepid']);
		$record['author']=$this->mySQLSafe( $formvars['author']);
		$record['details']=$this->mySQLSafe( $formvars['details']);
		$record['is_active']=$this->mySQLSafe($formvars['is_active']);
//		$record['dated']=$this->mySQLSafe( date("Y-m-d"));
		$where="item_id=".$formvars['item_id'];
		
		$members=$this->update($this->tbltestimonials,$record,$where);
		if($members)
		{
			$this->error="Testimonial has been updated successfully";
			return true;	
		}
		
	    
    }
	
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($id=0)
	{
	
    	$_query = "delete from ".$this->tbltestimonials." where item_id = ".$id;
		$recordset=$this->execute($_query);
		if($recordset) 
		{
			$this->error="Testimonial has been deleted successfully";
			return true;
		}
		else
		{
			$this->error="Testimonial was not deleteed";
			return false;
			
		}		
	}
    /**
     * get the Faqs entries
	  * @param start variables use for paging.
     */
    function getEntries($_start=0,$formvars) {

		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows("select item_id from ".$this->tbltestimonials);
		$paging->start=$_start;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			 $this->sortcolumn=$formvars['sortcolumn'];
			 $this->sortdirection=$formvars['sortdirection'];
		}
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		
		$_query = "select t.*,p.oepid,p.name from " . $this->tbltestimonials." as t left join ". $this->tablename ." as p on(t.oepid = p.oepid) group by t.item_id ". $orderby ."  Limit $paging->start,$paging->limit";
		//echo($_query);
		$recordset=mysql_query($_query);
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
		if(!isset($data))
		{
			$this->error="No existing testimonial found";
			$data=null;
		}
        return $data;   
    }
	
	 function getSortedEntries() {

		$orderby=" order by sort_index";		
		$_query = "select * from " . $this->tbltestimonials . $orderby;

		$recordset=mysql_query($_query);
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
	
		if(!isset($data))
		{
			$this->error="No existing testimonial found";
			$data=null;
		}
        return $data;   
    }
	
	function sortListing($formvars)
	{
		$ids = $formvars['item_id'];
		$indexes = $formvars['sort_index'];
		
		for($i=0; $i < count($ids); $i++)
		{
			$_query = "update ".$this->tbltestimonials." set sort_index = ".$indexes[$i]." where item_id = ".$ids[$i];
			mysql_query($_query);
		}
		
		$this->error="Sorting has been saved successfully";
	}
	function getprogramme()
	{
	      $_query = "select * from ".$this->tablename ." order by name asc ";
		  $fetch=$this->select($_query);
          return $fetch; 
	}
	/**
     * display the Faq entry form
     *
     * @param array $formvars the form variables
     */
    function displayForm($formvars = array()) {
		global $GENERAL;
		
		$this->tpl->assign('GENERAL', $GENERAL);
		// assign the form vars
	    $this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('data',$formvars);
		$this->tpl->assign('pname', $this->getprogramme());
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('testimonialmanagement.tpl');
    }
    /**
     * display the records
     *
     * @param array $data the  data
     */
    function displayGird($data = array()) {
		global $GENERAL;
		
		$this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('total_testimonials', count($data));
		
		
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('testimonialmanagement.tpl');        

    }
}

?>