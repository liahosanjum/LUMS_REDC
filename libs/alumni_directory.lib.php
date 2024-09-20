<?php
/**
 * Podcast Audio Management application library
 *
 */
class AlumniDirectory extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $redc_alumni = "redc_alumni";
	var $country_tbl = "redc_countries";
	var $tablename="redc_page_content";
	var $usertblname = "redc_user";	
	var $countRecord = 0;
    /**
     * class constructor
     */
    function AlumniDirectory() {
     	$this->tpl =& new Smarty;
		$this->db();
    }

    ///// redirect admin to welcome page if valid or already login
	function redirectAlumni()
	{
	  header("Location:alumni_login.php");	
	}	
	

   ///// get section information
   function getSectionName($section_id)
	{
   	   $_query = "select pcid, psid, pagename, menutitle from " . $this->tablename ." where psid = '".$section_id."' and visible = 'Yes'  order by pageorder";
	   $rs=$this->select($_query);
	   
	  if(!empty($rs))
		{
		  return $rs;	
		}
		else
		{
			return null;	
		}
	}
   
   //fuction for get section image
   function getsectionimage()
	{
		
		$query = "select sec_image from redc_page_section where psid= 9";
		$rs=$this->select($query);
		return $rs;
	}

	function getAlumni($_start)
	{
		 
		 /*
		 * PAGINATION CODE	
		 */
		 
		$paging = new Frontpaginate();
		$paging->num= $this->numrows("select * from ".$this->redc_alumni." where isactive = 'Yes'");
		$this->countRecord = $paging->num;
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Frontpaginate($paging->limit,$paging->num,"?",10);
		$this->tpl->assign('paging',$paging->displayTable());

		$_query = "select * from ".$this->redc_alumni." as a , ". $this->usertblname. " as u where a.uid = u.uid and a.isactive = 'Yes' order by u.firstname asc Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data = $fetch;
		}
		
        return $data; 
		
	}
	
    /**
     * display the Index page
     */
    function displayPage($formvars = array()) {
	    global $GENERAL;
		$this->tpl->assign('returnUR',$_REQUEST['returnURL']);
		$this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('countRecord',$this->countRecord);
		$this->tpl->assign('simage', $this->getsectionimage($_REQUEST['section_id']));
		$this->tpl->assign('data',$formvars);
		$this->tpl->assign('section_data', $this->getSectionName(9));
		$this->tpl->assign('error', $this->error);		
	    $this->tpl->display('alumni_directory.tpl');        
    }
}
?>