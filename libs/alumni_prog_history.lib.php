<?php
/**
 * Podcast Audio Management application library
 *
 */
class AlumniProfile extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $redc_alumni = "redc_alumni";
	var $country_tbl = "redc_countries";
	
    /**
     * class constructor
     */
    function AlumniProfile() {
     	$this->tpl =& new Smarty;
		$this->db();
    }

    ///// redirect admin to welcome page if valid or already login
	function redirectAlumni()
	{
	  header("Location:alumni_login.php");	
	}	
	 /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
	function isValidForm($formvars) {

		// reset error message
        $this->error = null;
	
		if(strlen(trim($formvars['nationality'])) == 0) {
            $this->error = 'Please provide nationality';
            return false; 
        }
		if(strlen(trim($formvars['email'])) == 0) {
            $this->error = 'Please provide business email';
            return false; 
        }
		if(!$this->validateMail($formvars['email']))
		{
			$this->error = 'Please provide correct business email ';
			return false; 
		}

		if(strlen(trim($formvars['designation'])) == 0) {
            $this->error = 'Please provide designation';
            return false; 
        }
		if(strlen(trim($formvars['companyname'])) == 0) {
            $this->error = 'Please provide company name';
            return false; 
        }
		if(strlen(trim($formvars['companyaddress'])) == 0) {
            $this->error = 'Please provide address';
            return false; 
        }
		if(strlen(trim($formvars['country'])) == 0) {
            $this->error = 'Please provide country';
            return false; 
        }
		if(strlen(trim($formvars['phone'])) == 0) {
            $this->error = 'Please provide telephone';
            return false; 
        }
		if (!ereg ("([0-9])", $formvars['phone'])) {
            $this->error = 'Please provide a valid value for telephone';
            return false; 
		}
		
		if($formvars['cell'] != "")
		{
			if (!ereg ("([0-9])", $formvars['cell'])) {
				$this->error = 'Please provide a valid value for cell';
				return false; 
			}
			
		}

		if($formvars['fax'] != "")
		{
			if (!ereg ("([0-9])", $formvars['fax'])) {
				$this->error = 'Please provide a valid value for fax';
				return false; 
			}
			
		}

		if($formvars['currentindustry'] == "")
		{
			if($formvars['industryother'] == "")
			{
				$this->error = 'Please provide current industry OR industry other';
				return false; 
			}
			
		}

		if($formvars['position'] == "")
		{
			if($formvars['positionother'] == "")
			{
				$this->error = 'Please provide position OR position other';
				return false; 
			}
			
		}
	


/***********************************************************************************************/
		return true;
    }	
	
	
  	// email validation
	function validateMail($mail) {
	  if($mail !== "") {
		if(ereg("^[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[.]{1}[A-Za-z]{2,5}$", $mail)) {
		  return true;
		} 
		else {
		  return false;
		}
	  } 
	  else {
		return false;
	  }
	}

	// get country list
  	function getCountries()
	{
		$query = "select country_id , countryname from ".$this->country_tbl;
		return $this->select($query);
	}

	
	
	// add to alumni
	function updateRecord($rec , $aid)
	{
			$addAlumni 	= array();
			//$addAlumni["username"] 		 	= $this->mySQLSafe( $rec['username']);
			//$addAlumni["password"]  	 	= $this->mySQLSafe( $rec['password']);
			//$addAlumni["firstname"]  		= $this->mySQLSafe( $rec['firstname']);
			//$addAlumni["middlename"]  		= $this->mySQLSafe( $rec['middlename']);
			//$addAlumni["lastname"] 			= $this->mySQLSafe( $rec['lastname']);
			$addAlumni["prefix"]  			= $this->mySQLSafe( $rec['prefix']);
			$addAlumni["nationality"]  		= $this->mySQLSafe( $rec['nationality']);
			$addAlumni["email"]  			= $this->mySQLSafe( $rec['email']);
			$addAlumni["designation"]  		= $this->mySQLSafe( $rec['designation']);
			$addAlumni["companyname"]  		= $this->mySQLSafe( $rec['companyname']);
			$addAlumni["companyother"]  	= $this->mySQLSafe( $rec['companyother']);
			$addAlumni["companyaddress"]  	= $this->mySQLSafe( $rec['companyaddress']);
			$addAlumni["city"]  			= $this->mySQLSafe( $rec['city']);
			$addAlumni["country"]  			= $this->mySQLSafe( $rec['country']);
			$addAlumni["phone"]  			= $this->mySQLSafe( $rec['phone']);
			$addAlumni["cell"]  			= $this->mySQLSafe( $rec['cell']);
			$addAlumni["fax"]  				= $this->mySQLSafe( $rec['fax']);
			$addAlumni["currentindustry"]   = $this->mySQLSafe( $rec['currentindustry']);
			$addAlumni["industryother"]  	= $this->mySQLSafe( $rec['industryother']);
			$addAlumni["position"]  		= $this->mySQLSafe( $rec['position']);
			$addAlumni["positionother"]  	= $this->mySQLSafe( $rec['positionother']);
			//$addAlumni["registrationdate"]  = $this->mySQLSafe( date("Y-m-d"));
			
			$alumniid = $aid;
			$where = " aid = $alumniid";
			$this->update($this->redc_alumni , $addAlumni , $where);
			
			$this->error = 'Record has been updated successfully.';
			
	}

	function getEntry($aid)
	{
		$qry 	= "select * from ".$this->redc_alumni ." where aid = $aid";
		$fetch 	= $this->select($qry);
		foreach($fetch as $d)
		{
			$data = $d;
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
		$this->tpl->assign('data',$formvars);
		$this->tpl->assign('countries', $this->getCountries());		
		$this->tpl->assign('error', $this->error);		
	    $this->tpl->display('alumni_profile.tpl');        
    }
}
?>