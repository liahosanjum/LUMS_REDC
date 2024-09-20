<?php
/**
 * Podcast Audio Management application library
 *
 */
class  oep_view_completedManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $table_category="redc_oep_programmes_category";
	var $tablename="redc_oep_programmes";
	var $sortcolumn=" startdate ";
	var $sortdirection=" desc ";
	
    /**
     * class constructor
     */
    function  oep_view_completedManagement() {
	 if(!isset($_REQUEST['oepcatid']) || $_REQUEST['oepcatid'] == "")
		{
		    header("Location:  oep_view_completedManagement.php");
			
		}
	
	
     	$this->tpl =& new Smarty;
		$this->db();
    }
    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
   function isValidForm($formvars,$files=0) {

		// reset error message
        $this->error = null;
        
		// test if "Name" is empty
        if(strlen(trim($formvars['name'])) == 0) {
            $this->error = 'Please provide Programme Name';
            return false; 
        }
		if(strlen(trim($formvars['startdate'])) ==0){
		  $this->error = 'Please Provide Programmer Start date';
		  return false;
		}
		if(strlen(trim($formvars['enddate'])) ==0){
		 $this->error ='Please Provide Programme End Date';
		 return false;
		}
		
		if (strlen(trim($formvars['deadline']))==0){
		  $this->error ='Please provide Application Deadline';
		  return false;
		}
		else{
		   $ad = explode('-' , $formvars['startdate']);
		   if(($ad[2] . $ad[1] . $ad[0]) >=('Ymd'))
		   {
		    $this-> error ='Application deadline should not be past then Programme Start date';
		     return false;
		   }
		}
		if(strlen(trim ($formvars['venue']))==0){
		$this->error ='Please provide Venue for OEP Programme';
		return false;
		}
		
	  return true;
    }
  	 /**
     * add a new  oep_view_completedManagement entry
     *
     * @param array $formvars the form variables
     */
	 
	 function addEntry($formvars,$files) 
	{
    	$record['name']=$this->mySQLSafe( $formvars['name']);
		$record['oepcatid']=$this->mySQLsafe ($formvars['oepcatid']);
		$record['startdate']=$this->mySQLSafe($formvars['startdate']);
		$record['enddate']=$this->mySQLSafe( $formvars['enddate']);
		$record['deadline']=$this->mySQLSafe( $formvars['deadline']);
		$record['venue']=$this->mySQLSafe($formvars['venue']);
		$record['introduction']=$this->mySQLSafe($formvars['introduction']);
		$record['objective']=$this->mySQLSafe($formvars['objective']);
		$record['curriculum'] =$this->mySQLSafe($formsvars['curriculum']);
		$record['participents']=$this->mySQLSafe($formvars['participents']);
		$record['learningmodel']=$this->mySQLSafe($formvars['learningmodel']);
		$record['faculty']=$this->mySQLSafe($formvars['faculty']);
		$record['testimonials']=$this->mySQLSafe($formvars['testimonials']);
		$record['feecondition']=$this->mySQLSafe($formvars['feecondition']);
		//$record['Enabled']=$this->mySQLSafe(formvars['Enabled']);
		$record['isactive']=$this->mySQLSafe ($formvars['isactive']);
		$record['iscompleted']=$this->mySQLSafe ($formvars['iscompleted']);
		if(strlen ($files ['oepimage']['name'])>0){
		$fileName = time()."-".$files['oepimage']['name'];
		$fileName =str_replace (' ','-', $fileName);
		$imagepath = PHYSICAL_PATH."/images/broucher/";
	    if(move_uploaded_file($files['oepimage']['tmp_name'], $imagepath.$fileName))
			{
				 //$this->createThumbnail($FileName, $Imagepath, 153, 113);
				$record['oepimage']=$this->mySQLSafe($fileName);
			}	
		}
		
						
	  	if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error=" oep_view_completedManagement has been added successfully.";
			return true;
		}
		else
		{
			$this->error=" oep_view_completedManagement has not been added.";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	
	function categoryInfo($oepcatid)
	{
	      $_query = "select *  from ".$this->table_category." where oepcatid=$oepcatid";
		  $fetch=$this->select($_query);
    	  if($fetch!=false)
			{
	    		$data=$fetch[0];
			}		
        return $data; 
	}
	
	function editEntry($oepid=0)
	{
		$_query = "select *  from ".$this->tablename." where oepid=$oepid";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["oepcatid"]=$fetch[0]["oepcatid"];
			$data["oepid"]=$fetch[0]["oepid"];
			$data["name"]=$fetch[0]["name"];
			$data['startdate'] = $fetch[0]['startdate'];
			$data['enddate']=$fetch[0]['startdate'];
			$data['deadline']=$fetch[0]['deadline'];
			$data['venue']=$fetch[0]['venue'];
			$data['introduction']=$fetch[0]['introduction'];
			$data['objective']=$fetch[0]['objective'];
			$data['curriculum']=$fetch[0]['curriculum'];
			$data['participents']=$fetch[0]['participents'];
			$data['learningmodel']=$fetch[0]['learningmodel'];
			$data['faculty']=$fetch[0]['faculty'];
			$data['testimonials']=$fetch[0]['testimonials'];
			$data['isactive']=$fetch[0]['isactive'];
			$data['iscompleted']=$fetch[0]['iscompleted'];
			$data['feecondition']=$fetch[0]['feecondition'];
			$data['eopimage'] = $fetch[0]['eopimage'];
							}
		
        return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$oepid,$files) {

        $record['name']=$this->mySQLSafe( $formvars['name']);
		$record['oepcatid']=$this->mySQLsafe ($formvars['oepcatid']);
		$record['startdate']=$this->mySQLSafe($formvars['startdate']);
		$record['enddate']=$this->mySQLSafe( $formvars['enddate']);
		$record['deadline']=$this->mySQLSafe( $formvars['deadline']);
		$record['venue']=$this->mySQLSafe($formvars['venue']);
		$record['introduction']=$this->mySQLSafe($formvars['introduction']);
		$record['objective']=$this->mySQLSafe($formvars['objective']);
		$record['curriculum'] =$this->mySQLSafe($formsvars['curriculum']);
		$record['participents']=$this->mySQLSafe($formvars['participents']);
		$record['learningmodel']=$this->mySQLSafe($formvars['learningmodel']);
		$record['faculty']=$this->mySQLSafe($formvars['faculty']);
		$record['testimonials']=$this->mySQLSafe($formvars['testimonials']);
		$record['feecondition']=$this->mySQLSafe($formvars['feecondition']);
		//$record['Enabled']=$this->mySQLSafe(formvars['Enabled']);
		$record['isactive']=$this->mySQLSafe ($formvars['isactive']);
		$record['iscompleted']=$this->mySQLSafe ($formvars['iscompleted']);
		if(strlen ($files ['oepimage']['name'])>0){
		$fileName = time()."-".$files['oepimage']['name'];
		$fileName =str_replace (' ','-', $fileName);
		$imagepath = PHYSICAL_PATH."/images/broucher/";
	    if(move_uploaded_file($files['oepimage']['tmp_name'], $imagepath.$fileName))
			{
				 //$this->createThumbnail($FileName, $Imagepath, 153, 113);
				$record['oepimage']=$this->mySQLSafe($fileName);
			}	
		}
		
		
		$where="oepid=".$oepid;
		if($this->update($this->tablename,$record,$where))
		{
	    	
			$this->error=" oep_view_completedManagement has been updated successfully.";
			return true;
		}
		else
		{
			$this->error=" oep_view_completedManagement has not been updated.";
			return false;
			
		}
        
    }
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($oepid=0)
	{
		$_where = "oepid='".$oepid."' ";
		$result=$this->delete($this->tablename,$_where);
		if($result == 1) 
		{
	    	
			$this->error="Programme has been deleted successfully.";
			return true;
		}
		else
		{
			$this->error="Programme has not been deleted.";
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
		$where=" where iscopleted = 'Y'";
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
		$this->tpl->assign('oepcatid', $this->categoryInfo($_REQUEST['oepcatid']));
        $this->tpl->display(' oep_view_completedManagement.tpl');
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
		$this->tpl->assign('oepcatid', $this->categoryInfo($_REQUEST['oepcatid']));
	    $this->tpl->display(' oep_view_completedManagement.tpl');        
    }
}
?>