<?php
/**
 * Podcast Audio Management application library
 *
 */
class AlumniHistory extends db{

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
	
    /**
     * class constructor
     */
    function AlumniHistory() {
     	$this->tpl =& new Smarty;
		$this->db();
    }

    ///// redirect admin to welcome page if valid or already login
	function redirectAlumni()
	{
	  header("Location:alumni_login.php");	
	}	
	

	function getUserProgrammes($id)
	{
		 /*$_query = "(SELECT f.name , f.startdate , f.enddate , f.ofpid
					FROM redc_alumni as a , redc_alumni_applicants as aa , redc_ofpprogrammes as f
					where a.aid = aa.aid
					and a.uid = $id
					and aa.ofpid = f.ofpid
					AND aa.ofpid != '')
					UNION
					(SELECT p.name , p.startdate , p.enddate , p.oepid
					FROM redc_alumni as a , redc_alumni_applicants as aa , redc_oep_programmes as p
					where a.aid = aa.aid
					and a.uid = $id
					and aa.oepid = p.oepid
					AND aa.oepid != '') 
				  ";*/
			$_query = "(SELECT f.name , f.startdate , f.enddate , f.ofpid, fa.name as instructor
					FROM redc_alumni as a , redc_alumni_applicants as aa , redc_ofpprogrammes as f, redc_faculty as fa
					where a.aid = aa.aid
					and a.aid = $id
					and aa.ofpid = f.ofpid
					and f.moduledirector = fa.fid
					AND aa.ofpid != '')
					UNION
					(SELECT p.name , p.startdate , p.enddate , p.oepid, fa.name as instructor
					FROM redc_alumni as a , redc_alumni_applicants as aa , redc_oep_programmes as p, redc_faculty as fa
					where a.aid = aa.aid
					and a.aid = $id
					and aa.oepid = p.oepid
					and p.faculty = fa.fid
					AND aa.oepid != '') 
				  ";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data = $fetch;
		}
		
        return $data; 
		
	}

   
   function getsectionimage()
	{
		
		$query = "select sec_image from redc_page_section where psid= 9";
		$rs=$this->select($query);
		return $rs;
	}
   
   ///// get section information
   function getSectionName($section_id)
	{
   	   $_query = "select pcid, psid, pagename, menutitle from " . $this->tablename ." where psid = '".$section_id."' and visible = 'Yes' order by pageorder";
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
	
    /**
     * display the Index page
     */
    function displayPage($formvars = array()) {
	    global $GENERAL;
		$this->tpl->assign('returnUR',$_REQUEST['returnURL']);
		$this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('section_data', $this->getSectionName(9));
		$this->tpl->assign('simage', $this->getsectionimage($_REQUEST['section_id']));
		$this->tpl->assign('data',$formvars);
		$this->tpl->assign('error', $this->error);		
	    $this->tpl->display('alumni_history.tpl');        
    }
}
?>