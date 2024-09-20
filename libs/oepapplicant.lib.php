<?php
/**
 * Podcast Audio Management application library
 *
 */
class OEPApplicant extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_oep_applicants";
	var $table_name="redc_oep_programmes";
	var $usertblname = "redc_user";
	var $redc_alumni = "redc_alumni";
	var $redc_alumni_applicants = "redc_alumni_applicants";
	var $sortcolumn=" registrationdate ";
	var $sortdirection=" desc ";
	var $status = "";
	var $user_contact_tbl = "redc_user_contact";
	var $user_personal_tbl = "redc_user_personal";
	var $user_profess_tbl = "redc_user_professional";
	var $user_org_tbl = "redc_user_organizational";
	var $user_sponsor_tbl = "redc_user_sponsoship";
	var $user_inform_tbl = "redc_user_informationsrc";
	var $country_tbl = "redc_countries";
	var $searchbyuname = "";
	var $searchbypname = "";
	var $parentid = 0;
	var $countRecords = 0;
	var $tblofp="redc_ofp_users";
    /**
     * class constructor
     */
    function OEPApplicant() {
     	$this->tpl =& new Smarty;
		$this->db();
    }
   
   
   
	function editEntry($id=0)
	{
//		$_query = "select * from " . $this->tablename." as a , ".$this->table_name." as p , ".$this->usertblname." as u , ".$this->user_contact_tbl." as uc , ".$this->user_personal_tbl." as upe , ".$this->user_profess_tbl." as upr , ".$this->user_org_tbl." as uog , ".$this->user_sponsor_tbl." as usp , ".$this->user_inform_tbl." as uif where a.oepaid = $id and a.uid = u.uid and a.oepid = p.oepid and uc.uid = u.uid and upe.uid = u.uid and upr.uid = u.uid and uog.uid = u.uid and usp.uid = u.uid and uif.uid = u.uid";

			$_query = "SELECT * 
					   FROM " . $this->tablename." AS a , ".$this->table_name." AS p , ".$this->usertblname." AS u , 
					   ".$this->user_contact_tbl." AS uc , ".$this->user_personal_tbl." AS upe , ".$this->user_profess_tbl." AS upr , 
					   ".$this->user_org_tbl." AS uog , ".$this->user_sponsor_tbl." AS usp , ".$this->user_inform_tbl." AS uif 
					   WHERE a.oepaid = $id 
					   AND a.uid = u.uid 
					   AND a.oepid = p.oepid 
					   AND uc.oepaid = a.oepaid 
					   AND upe.oepaid = a.oepaid
					   AND upr.oepaid = a.oepaid
					   AND uog.oepaid = a.oepaid 
					   AND usp.oepaid = a.oepaid
					   AND uif.oepaid = a.oepaid
					   ";

		$fetch=$this->select($_query);
		
		
		if($fetch!=false)
		{
			foreach($fetch as $f)
			{
				$_query = "select * from ".$this->country_tbl." where country_id = ".$f['country'];
				$dataCountry = $this->select($_query);				
				if(dataCountry != null)
				{
					$f['countryname'] = $dataCountry[0]['countryname'];
				}
				$data = $f;
			}
		}

		if($data != null)
		{
			$_query = "select prog.name from ".$this->table_name." prog, ".$this->tablename." app where prog.oepid = app.oepid and app.applicationstatus = 'A' and app.uid = ".$data['uid'];

			$programmes=$this->select($_query);
			$this->tpl->assign('programmes',$programmes);
		}
        return $data; 
	}  
	
 	// previously attended programmes by specific user
	function prevAttendedProgs($uid , $aid)
	{
		$str = "";
//		$qryattendprog = "select p.name , a.oepaid from ".$this->tablename." as a , ".$this->table_name." as p where a.uid = $uid and a.oepid = p.oepid and a.oepaid != $aid and p.iscompleted = 'Y'";
		$qryattendprog = "select p.name , a.oepaid from ".$this->tablename." as a , ".$this->table_name." as p where a.uid = $uid and a.oepid = p.oepid and a.oepaid != $aid";
		$prevprog = $this->select($qryattendprog);
		
		//print_r($prevprog);
	
		$flag = false;

		if($prevprog){
			foreach($prevprog as $prog)
			{	$flag = true;
				$progname[] = $prog["name"];
			}	
		}		
		if($flag)	
			$str = implode("," , $progname);
		return $str;			
	}
   
    /**
     * display the Faq entry form
     *
     * @param array $formvars the form variables
     */
    function displayForm($formvars = array()) {

		global $GENERAL;

/*		echo "<pre>";
			print_r($formvars);
		echo "</pre>";
		exit;
*/
		// previously attended programmes by the user
		
		
		if($_REQUEST['pid'] != "")
			$this->parentid = $_REQUEST['pid'];
		
		if($_REQUEST['action'] != 'add' && $_REQUEST['mode'] != 'add' && $formvars['uid'] != null && $formvars["oepaid"] != null)
		{
			$progString = $this->prevAttendedProgs($formvars["uid"] , $formvars["oepaid"]);
			$this->tpl->assign('Programmes', $progString); 
		}
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
		
		$this->tpl->assign('pid' , $this->parentid);
//		$this->tpl->assign('programme', $this->getProgrammes());
//		$this->tpl->assign('users', $this->getUsers());
//		$this->tpl->assign('countries', $this->getCountries());
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display($GENERAL['FRONT_BASE_DIR_TPL'].'/oepapplicant.tpl');
    }
    
}
?>