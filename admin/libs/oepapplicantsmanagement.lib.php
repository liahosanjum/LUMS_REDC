<?php
/**
 * Podcast Audio Management application library
 *
 */
class OFPManagement extends db{

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
	var $sortcolumn="oepaid";
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
    function OFPManagement() {
     	$this->tpl =& new Smarty;
		$this->db();
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
  

   
    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars) {

		// reset error message
        $this->error = null;

/*		if($formvars['action'] == 'add' or $formvars["prevname"] != $formvars['username'] or strlen(trim($formvars['username'])) == 0){
		
			if(strlen(trim($formvars['username'])) == 0) {
				$this->error = 'Please provide email (user name)';
				return false; 
			}
			
			if(!$this->validateMail($formvars['username']))
			{
				$this->error = 'Please provide correct email (user name)';
				return false; 
			}
			
			if($this->alreadyExists($formvars['username']))
			{
				$this->error = 'Email (user name) already taken';
				return false; 
			}
		
		}
	
		if(strlen(trim($formvars['password'])) == 0) {
            $this->error = 'Please provide password';
            return false; 
        }

		if(strlen(trim($formvars['confpassword'])) == 0) {
            $this->error = 'Please provide confirm password';
            return false; 
        }

		if($formvars['password'] != $formvars['confpassword']) {
            $this->error = 'Your password don\'t match';
            return false; 
        }
*/		
		if(strlen(trim($formvars['uid'])) == 0) {
            $this->error = 'Please select user';
            return false; 
        }
		
		if(strlen(trim($formvars['firstname'])) == 0) {
            $this->error = 'Please provide first name';
            return false; 
        }

		if(strlen(trim($formvars['lastname'])) == 0) {
            $this->error = 'Please provide last name';
            return false; 
        }		
		
		if(strlen(trim($formvars['gender'])) == 0) {
            $this->error = 'Please provide gender';
            return false; 
        }
		
		/*
		if(strlen(trim($formvars['nationality'])) == 0) {
            $this->error = 'Please provide nationality';
            return false; 
        }
		*/
		
		if(strlen(trim($formvars['busemail'])) == 0) {
            $this->error = 'Please provide business email';
            return false; 
        }
		
		if(!$this->validateMail($formvars['busemail']))
		{
			$this->error = 'Please provide correct business email ';
			return false; 
		}
		
		if(strlen(trim($formvars['emergencyname'])) == 0) {
            $this->error = 'Please provide emergency name';
            return false; 
        }
		if(strlen(trim($formvars['emergencyphone'])) == 0) {
            $this->error = 'Please provide emergency phone';
            return false; 
        }

		if(strlen(trim($formvars['contactdesignation'])) == 0) {
            $this->error = 'Please provide designation';
            return false; 
        }
		if(strlen(trim($formvars['contactdesignation'])) == 0) {
            $this->error = 'Please provide designation';
            return false; 
        }
		/*if(strlen(trim($formvars['industryother'])) == 0 && $formvars['industry'] == 'other') {
            $this->error = 'Please provide specify other current industry';
            return false; 
        }
		if(strlen(trim($formvars['positionother'])) == 0 && $formvars['position'] == 'other') {
            $this->error = 'Please provide specify other position';
            return false; 
        }*/
		if(strlen(trim($formvars['companyaddress'])) == 0) {
            $this->error = 'Please provide company address';
            return false; 
        }
		if(strlen(trim($formvars['country'])) == 0) {
            $this->error = 'Please provide country';
            return false; 
        }
		if(strlen(trim($formvars['ctelephone'])) == 0) {
            $this->error = 'Please provide telephone';
            return false; 
        }
		if(strlen(trim($formvars['parentservices'])) > 300) {
            $this->error = 'Please provide Products/Services with max 300 characters';
            return false; 
        }
	
		if(strlen(trim($formvars['parentnumemployees'])) > 0) {

			if(!ereg("^[0-9]+$", trim($formvars['parentnumemployees']))) {
			  $this->error = 'Please provide an integer value for number of employees';
        	  return false; 
			} 
		} 
		
		if(strlen(trim($formvars['services'])) == 0) {
            $this->error = 'Please provide Products/Services';
            return false; 
        }
		
		if(strlen(trim($formvars['services'])) > 300) {
            $this->error = 'Please provide Products/Services with max 300 characters';
            return false; 
        }
		
		if(strlen(trim($formvars['numemployees'])) == 0) {
            $this->error = 'Please provide number of employees';
            return false; 
        }
		
		if(!ereg("^[0-9]+$", trim($formvars['numemployees']))) {
		  $this->error = 'Please provide an integer value for number of employees';
            return false; 
		} 
		
		if(strlen(trim($formvars['numemployeessupervision'])) == 0) {
            $this->error = 'Please provide how many employees are under your direct supervision?';
            return false; 
        }
		
		if(!ereg("^[0-9]+$", trim($formvars['numemployeessupervision']))) {
		  $this->error = 'Please provide a number value for number of employees';
            return false; 
		} 
		
		if(strlen(trim($formvars['reportperson'])) == 0) {
            $this->error = 'Please provide what is the title position of the person to whom you report?';
            return false; 
        }
		
		if($formvars['industry'] == "other" && $formvars['industryother'] == "")
		{
			$this->error = 'Please provide your current industry';
            return false; 
		}
		
		if($formvars['position'] == "other" && $formvars['positionother'] == "")
		{
			$this->error = 'Please provide what function best describes your position';
            return false; 
		}
		
		if(strlen(trim($formvars['company1'])) == 0) {
            $this->error = 'Please provide name of company';
            return false; 
        }
		if(strlen(trim($formvars['position1'])) == 0) {
            $this->error = 'Please provide title/position';
            return false; 
        }
		if(strlen(trim($formvars['from1'])) == 0) {
            $this->error = 'Please provide from date';
            return false; 
        }
		if(strlen(trim($formvars['to1'])) == 0) {
            $this->error = 'Please provide to date';
            return false; 
        }
	/*	if(strtotime($formvars['to1']) < strtotime($formvars['from1']))
		{
            $this->error = 'Please provide valid end date';
            return false; 
		}*/
		if(strlen(trim($formvars['numyearsexp'])) == 0) {
            $this->error = 'Please provide total number of years of professional experience';
            return false; 
        }

		if(!ereg("^[0-9]+$", trim($formvars['numyearsexp']))) {
		  $this->error = 'Please provide a number value for total number of years of professional experience';
            return false; 
		}
/*******************************************************************************************************/
		if(strlen(trim($formvars['responsibility'])) == 0) {
            $this->error = 'Please provide current responsibilities including your level in the organisation';
            return false; 
        }
		if(strlen(trim($formvars['responsibility'])) > 300) {
            $this->error = 'Please provide current responsibilities with max of 300 characters';
            return false; 
        }
		if(strlen(trim($formvars['mgtlevel'])) == 0) {
			if(strlen(trim($formvars['mgtlevel_other'])) == 0) {
				$this->error = 'Please specify other';	
				return false;
			}
		}
		
		if(strlen(trim($formvars['university'])) == 0) {
            $this->error = 'Please provide university name';
            return false; 
        }
		if(strlen(trim($formvars['year'])) == 0) {
            $this->error = 'Please provide year';
            return false; 
        }
		if(strlen(trim($formvars['degree'])) == 0) {
            $this->error = 'Please provide degree (Highest level attended)';
            return false; 
        }
		if(strlen(trim($formvars['objectives'])) == 0) {
            $this->error = 'Please provide objectives of attending this programme';
            return false; 
        }
		if(strlen(trim($formvars['objectives'])) > 300) {
            $this->error = 'Please provide objectives with max of 300 characters';
            return false; 
        }

		if(strlen(trim($formvars['name'])) == 0) {
            $this->error = 'Please provide name';
            return false; 
        }
		if(strlen(trim($formvars['designation'])) == 0) {
            $this->error = 'Please provide designation';
            return false; 
        }
		if(strlen(trim($formvars['address'])) == 0) {
            $this->error = 'Please provide address';
            return false; 
        }
		if(strlen(trim($formvars['address'])) > 300) {
            $this->error = 'Please provide address with max 300 characters';
            return false; 
        }

		if(strlen(trim($formvars['telephone'])) == 0) {
            $this->error = 'Please provide telephone';
            return false; 
        }
		if(strlen(trim($formvars['email'])) == 0) {
            $this->error = 'Please provide email';
            return false; 
        }
		if(!$this->validateMail($formvars['email']))
		{
			$this->error = 'Please provide correct email ';
			return false; 
		}
		
		/*if(strlen(trim($formvars['invoicename'])) == 0) {
            $this->error = 'Please provide name';
            return false; 
        }
		if(strlen(trim($formvars['invoicedesignation'])) == 0) {
            $this->error = 'Please provide designation';
            return false; 
        }
		if(strlen(trim($formvars['invoiceaddress'])) == 0) {
            $this->error = 'Please provide address';
            return false; 
        }
		if(strlen(trim($formvars['invoiceaddress'])) > 300) {
            $this->error = 'Please provide address with max 300 characters';
            return false; 
        }

		if(strlen(trim($formvars['invoicetelephone'])) == 0) {
            $this->error = 'Please provide telephone';
            return false; 
        }
		if(strlen(trim($formvars['invoiceemail'])) == 0) {
            $this->error = 'Please provide email';
            return false; 
        }
		if(!$this->validateMail($formvars['invoiceemail']))
		{
			$this->error = 'Please provide correct email ';
			return false; 
		}*/
		/*
		if(strlen(trim($formvars['executivename'])) == 0) {
            $this->error = 'Please provide name';
            return false; 
        }
		if(strlen(trim($formvars['executivedesignation'])) == 0) {
            $this->error = 'Please provide designation';
            return false; 
        }
		if(strlen(trim($formvars['executiveaddress'])) == 0) {
            $this->error = 'Please provide address';
            return false; 
        }
		if(strlen(trim($formvars['executiveaddress'])) > 300) {
            $this->error = 'Please provide address with max 300 characters';
            return false; 
        }

		if(strlen(trim($formvars['executivetelephone'])) == 0) {
            $this->error = 'Please provide telephone';
            return false; 
        }
		if(strlen(trim($formvars['executiveemail'])) == 0) {
            $this->error = 'Please provide email';
            return false; 
        }
		if(!$this->validateMail($formvars['executiveemail']))
		{
			$this->error = 'Please provide correct email ';
			return false; 
		}
		
		if(!isset($formvars['informemail']))
		{
			$this->error = 'Please select, do you wish to be informed about our programmes via email on regular basis?';
			return false; 
		}
		if(!isset($formvars['availresidence']) or empty($formvars['availresidence'])) {
			$this->error = 'Please select, do you wish to avail residence at REC-LUMS during the programme?';
			return false; 
		}
		*/
		if(strlen(trim($formvars['learnabout'])) == 0) {
			$this->error = 'Please specify how did you learn about us.';	
			return false;
		}
		if($formvars['learnabout'] == 'other') {
			if(strlen(trim($formvars['learnabout_other'])) == 0) {
				$this->error = 'Please specify other';
				return false;	
			}
		}
		
/***********************************************************************************************/
		return true;
    }
	
  
  	// check if user name already taken  
	function alreadyExists($username)
	{
		return $this->numrows("select username from ".$this->usertblname." where username = '".$username."'");
	}


	// get country list
  	function getCountries()
	{
		$query = "select country_id , countryname from ".$this->country_tbl;
		return $this->select($query);
	}


	// get all opened programmes  
  	function getProgrammes()
	{
		
//		$_query = "select oepid , name from ".$this->table_name." where iscompleted = 'N' and isactive = 'Yes' and enddate > '".date("Y-m-d")."'";
		$_query = "select oepid , name from ".$this->table_name." where isactive = 'Yes' and (enddate > '".date("Y-m-d")."' and status = 'a') order by name";
		return $this->select($_query);
	}
 
 	// get all enabled users  
  	function getUsers()
	{
		
//		$_query = "select oepid , name from ".$this->table_name." where iscompleted = 'N' and isactive = 'Yes' and enddate > '".date("Y-m-d")."'";
		//$_query = "select uid , firstname , lastname from ".$this->usertblname." where isactive = 'Y' and uid not in( select uid from ". $this->tblofp .")";
		$_query = "select uid , firstname , lastname , email from ".$this->usertblname." where isactive = 'Y' and type = 'oep' order by firstname asc ";
		return $this->select($_query);
	}
  

  	 /**
     * change user status
     *
     * @param array $formvars the form variables
     */
	function changeStatus($formvars)
	{
		$status = (isset($formvars['status'])) ? (($formvars['status'] == 'A') ? 'A' : (($formvars['status'] == 'R') ? 'R' : "")) : "";
		$this->status = $status;
		
		$changestauts["applicationstatus"] = $this->mySQLSafe($this->status);
		$w = " oepaid = ".$formvars['oepaid'];
		$this->update($this->tablename,$changestauts, $w);
		$this->error = "Applicant status has been changed successfully.";
	}	


	// make alumni to applicants if porgramm is completed
	function makeAlumni($formvars)
	{
		if(empty($formvars['addtoalumni']))
		{
			$this->error	=	"Please select applicants to add to alumni.";
		}
		else
		{
			$this->addToAlumni($formvars['addtoalumni']);
			$this->error	=	"Applicant has been added to alumni.";
		}
	}


	// add to alumni
	function addToAlumni($addtoalumni)
	{
		foreach($addtoalumni as $alum)
		{
			$rec = $this->editEntry($alum);
			$addAlumni 	= array();
			$addAlumni["uid"] 			 	= $this->mySQLSafe( $rec['uid']);
			$addAlumni["middlename"]  		= $this->mySQLSafe( $rec['middlename']);
			$addAlumni["prefix"]  			= $this->mySQLSafe( $rec['prefix']);
			$addAlumni["nationality"]  		= $this->mySQLSafe( $rec['nationality']);
			$addAlumni["email"]  			= $this->mySQLSafe( $rec['busemail']);
			$addAlumni["designation"]  		= $this->mySQLSafe( $rec['contactdesignation']);
			$addAlumni["companyname"]  		= $this->mySQLSafe( $rec['companyname']);
			$addAlumni["companyother"]  	= $this->mySQLSafe( $rec['companyother']);
			$addAlumni["companyaddress"]  	= $this->mySQLSafe( $rec['companyaddress']);
			$addAlumni["city"]  			= $this->mySQLSafe( $rec['city']);
			$addAlumni["country"]  			= $this->mySQLSafe( $rec['country']);
			$addAlumni["phone"]  			= $this->mySQLSafe( $rec['ctelephone']);
			$addAlumni["cell"]  			= $this->mySQLSafe( $rec['cell']);
			$addAlumni["fax"]  				= $this->mySQLSafe( $rec['fax']);
			$addAlumni["currentindustry"]   = $this->mySQLSafe( $rec['industry']);
			$addAlumni["industryother"]  	= $this->mySQLSafe( $rec['industryother']);
			$addAlumni["position"]  		= $this->mySQLSafe( $rec['position']);
			$addAlumni["positionother"]  	= $this->mySQLSafe( $rec['positionother']);
			$addAlumni["isactive"]  		= $this->mySQLSafe( "Yes");
			//$addAlumni["registrationdate"]  = $this->mySQLSafe( date("Y-m-d"));
			
			if($aid = $this->in_Alumni($rec['uid']))
			{
				$alumniid = $aid["aid"];
				$where = " aid = $alumniid";
				if(!$this->sameProgramme($alumniid , $rec['oepid']))
				{
					$addAlumni["numprogrammes"]  	= (int)$aid["numprogrammes"] + 1;
					// add to alumni applicant table
					$addAlumniApp = array();
					$addAlumniApp["aid"]   = $this->mySQLSafe( $alumniid);
					$addAlumniApp["oepid"] = $this->mySQLSafe( $rec['oepid']);
					$this->insert($this->redc_alumni_applicants , $addAlumniApp);
			
				}	
				
				$this->update($this->redc_alumni , $addAlumni , $where);
			}
			else
			{
				$addAlumni["registrationdate"]  = $this->mySQLSafe( date("Y-m-d"));
				$addAlumni["numprogrammes"]  	= 1;
				$this->insert($this->redc_alumni , $addAlumni);
				$alumniid = $this->insertid();
				// add to alumni applicant table
				$addAlumniApp = array();
				$addAlumniApp["aid"]   = $this->mySQLSafe( $alumniid);
				$addAlumniApp["oepid"] = $this->mySQLSafe( $rec['oepid']);
				$this->insert($this->redc_alumni_applicants , $addAlumniApp);
			
			}
			
			// delete applicant from applicant table after being added as alumni
			$del	=	"delete from ".$this->tablename." where oepaid= ".$alum;
			$this->execute($del);
		
		}	
			
	}
	
	
	// check if applicant already exists in alumni table
	function in_Alumni($uid)
	{
		$qryalumni = "select aid , numprogrammes from ".$this->redc_alumni." where uid = ".$uid;
		$array = $this->select($qryalumni);
		if($array[0]["aid"])
		{
			$numandid["aid"] 		   = $array[0]["aid"];
			$numandid["numprogrammes"] = $array[0]["numprogrammes"];
			return $numandid;
		}
		else
			return false;
	}
	
	// check if alumni already exist with same programme in alumni programme table
	function sameProgramme($aid , $oepid)
	{
		$qryalumni = "select aid from ".$this->redc_alumni_applicants." where aid = $aid and oepid = $oepid";
		if($this->numrows($qryalumni))
		{
			return true;
		}
		else
			return false;
		
	}
	
/*	// get applicant existing record 
	function getApplicantRecord($alum)
	{
		$qry = "select * from ".$this->tablename." as a , ".$this->usertblname." as u where a.oepaid = $alum and a.uid = u.uid";
	}

*/

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


	function checkIfUserAlreadyApplied($recArray)
	{
		$query = "SELECT oepaid
				  FROM ". $this->tablename ."
				  WHERE oepid = ".$recArray['oepprogrammes']."
				  AND uid = ".$recArray['uid']
				  ;
		$num = $this->numrows($query);
		return $num;		  
	}	
 
 
  	 /**
     * add a new Alumni entry
     *
     * @param array $formvars the form variables
     */
    function addEntry($formvars) 
	{
		/*
		// insert user record in redc user tbl
		$userRecord['username']				=	$this->mySQLSafe( $formvars['username']);
		$userRecord['password']				=	$this->mySQLSafe( $formvars['password']);
		$this->insert($this->usertblname,$userRecord);
		*/
		
		// insert user record in redc applicants tbl
		//$fk_user_id = $this->insertid();
		$fk_user_id = $formvars['uid'];
		
		if($this->checkIfUserAlreadyApplied($formvars))
		{
			$this->error="Applicant has already applied for this programme.";
			return false;			
		}
		
		$record['oepid']				=	$this->mySQLSafe( $formvars['oepprogrammes']);
		$record['uid']					=	$this->mySQLSafe($fk_user_id);
		$record['iscomplete']			=	$this->mySQLSafe( "Yes");
		$record['applicationstatus']	=	$this->mySQLSafe( $formvars['applicationstatus']);
		$record['registrationdate']		=	$this->mySQLSafe( date("Y-m-d"));
		$this->insert($this->tablename,$record);
		
		// primary key of redc applicants tbl as foreign key for following tables:
		$fk_oepa_id = $this->insertid();
		
	
		// insert user record in redc user personal tbl
		$uprecord['oepaid']				=	$this->mySQLSafe( $fk_oepa_id);
		//$uprecord['uid']				=	$this->mySQLSafe( $fk_user_id);
		$uprecord['firstname']			=	$this->mySQLSafe( $formvars['firstname']);
		$uprecord['middlename']			=	$this->mySQLSafe( $formvars['middlename']);
		$uprecord['lastname']			=	$this->mySQLSafe( $formvars['lastname']);
		$uprecord['prefix']				=	$this->mySQLSafe( $formvars['prefix']);
		$uprecord['gender']				=	$this->mySQLSafe( $formvars['gender']);
		$uprecord['nationality']		=	$this->mySQLSafe( $formvars['nationality']);
		$uprecord['busemail']			=	$this->mySQLSafe( $formvars['busemail']);
		$uprecord['emergencyname']		=	$this->mySQLSafe( $formvars['emergencyname']);
		$uprecord['emergencyphone']		=	$this->mySQLSafe( $formvars['emergencyphone']);
		$this->insert($this->user_personal_tbl,$uprecord);

		// insert user record in redc user contact tbl
		$ucrecord['oepaid']					=	$this->mySQLSafe( $fk_oepa_id);
		//$ucrecord['uid']					=	$this->mySQLSafe( $fk_user_id);
		$ucrecord['contactdesignation']		=	$this->mySQLSafe( $formvars['contactdesignation']);    
		$ucrecord['companyname']			=	$this->mySQLSafe( $formvars['companyname']);    
		$ucrecord['companyother']			=	$this->mySQLSafe( $formvars['companyother']);    
		$ucrecord['companyaddress']			=	$this->mySQLSafe( $formvars['companyaddress']);    
		$ucrecord['city']					=	$this->mySQLSafe( $formvars['city']);    
		$ucrecord['country']				=	$this->mySQLSafe( $formvars['country']);    
		$ucrecord['ctelephone']				=	$this->mySQLSafe( $formvars['ctelephone']);    
		$ucrecord['cell']					=	$this->mySQLSafe( $formvars['cell']);    
		$ucrecord['fax']					=	$this->mySQLSafe( $formvars['fax']);    
		$this->insert($this->user_contact_tbl,$ucrecord);

		// insert user record in redc user organization tbl
		$uorecord['oepaid']						=	$this->mySQLSafe( $fk_oepa_id);
		//$uorecord['uid']						=	$this->mySQLSafe( $fk_user_id);
		$uorecord['parentservices']				=	$this->mySQLSafe( $formvars['parentservices']);    
		$uorecord['parentnumemployees']			=	$this->mySQLSafe( $formvars['parentnumemployees']);    
		$uorecord['services']					=	$this->mySQLSafe( $formvars['services']);    
		$uorecord['numemployees']				=	$this->mySQLSafe( $formvars['numemployees']);    
		$uorecord['numemployeessupervision']	=	$this->mySQLSafe( $formvars['numemployeessupervision']);    
		$uorecord['reportperson']				=	$this->mySQLSafe( $formvars['reportperson']);    
		$uorecord['industry']					=	$this->mySQLSafe( $formvars['industry']);    
		$uorecord['industryother']				=	$this->mySQLSafe( $formvars['industryother']);    
		$uorecord['position']					=	$this->mySQLSafe( $formvars['position']);    
		$uorecord['positionother']				=	$this->mySQLSafe( $formvars['positionother']);    
		$this->insert($this->user_org_tbl,$uorecord);

		// insert user record in redc user professional tbl
		$uprrecord['oepaid']			=	$this->mySQLSafe( $fk_oepa_id);
		//$uprrecord['uid']				=	$this->mySQLSafe( $fk_user_id);
		$uprrecord['company1']			=	$this->mySQLSafe( $formvars['company1']);    
		$uprrecord['position1']			=	$this->mySQLSafe( $formvars['position1']);  
		$uprrecord['from1']				=	$this->mySQLSafe( $formvars['from1']);    
		$uprrecord['to1']				=	$this->mySQLSafe( $formvars['to1']);      
		$uprrecord['company2']			=	$this->mySQLSafe( $formvars['company2']);    
		$uprrecord['position2']			=	$this->mySQLSafe( $formvars['position2']);  
		$uprrecord['from2']				=	$this->mySQLSafe( $formvars['from2']);    
		$uprrecord['to2']				=	$this->mySQLSafe( $formvars['to2']);      
		$uprrecord['company3']			=	$this->mySQLSafe( $formvars['company3']);    
		$uprrecord['position3']			=	$this->mySQLSafe( $formvars['position3']);  
		$uprrecord['from3']				=	$this->mySQLSafe( $formvars['from3']);    
		$uprrecord['to3']				=	$this->mySQLSafe( $formvars['to3']);      
		$uprrecord['numyearsexp']		=	$this->mySQLSafe( $formvars['numyearsexp']);    
		$uprrecord['responsibility']	=	$this->mySQLSafe( $formvars['responsibility']); 

	/*
	** NEW FIELDS WERE ADDED ON 07/01/2010 **
	*/
		
		$uprrecord['mgtlevel']			=	$this->mySQLSafe( $formvars['mgtlevel']);    
		$uprrecord['mgtlevel_other']	=	$this->mySQLSafe( $formvars['mgtlevel_other']);    
		 
		$uprrecord['university']		=	$this->mySQLSafe( $formvars['university']);    
		$uprrecord['year']				=	$this->mySQLSafe( $formvars['year']);      
		$uprrecord['degree']			=	$this->mySQLSafe( $formvars['degree']);

	/*
	** NEW FIELDS WERE ADDED ON 07/01/2010 **
	*/
		$uprrecord['atndotherredcprog1']	=	$this->mySQLSafe( $formvars['atndotherredcprog1']);
		$uprrecord['atndotherredcprogdate1']=	$this->mySQLSafe( $formvars['atndotherredcprogdate1']);
		$uprrecord['atndotherredcprog2']	=	$this->mySQLSafe( $formvars['atndotherredcprog2']);
		$uprrecord['atndotherredcprogdate2']=	$this->mySQLSafe( $formvars['atndotherredcprogdate2']);
		 
		$uprrecord['objectives']		=	$this->mySQLSafe( $formvars['objectives']);  
		$this->insert($this->user_profess_tbl,$uprrecord);

		// insert user record in redc user sponsors tbl
		$usrecord['oepaid']					=	$this->mySQLSafe( $fk_oepa_id);
		//$usrecord['uid']					=	$this->mySQLSafe( $fk_user_id);
		$usrecord['name']					=	$this->mySQLSafe( $formvars['name']);    
		$usrecord['designation']			=	$this->mySQLSafe( $formvars['designation']);    
		$usrecord['address']				=	$this->mySQLSafe( $formvars['address']);    
		$usrecord['telephone']				=	$this->mySQLSafe( $formvars['telephone']);    
		$usrecord['sponsorfax']				=	$this->mySQLSafe( $formvars['sponsorfax']);    
		$usrecord['email']					=	$this->mySQLSafe( $formvars['email']);    
		$usrecord['website']				=	$this->mySQLSafe( $formvars['website']);    
		$usrecord['invoicename']			=	$this->mySQLSafe( $formvars['invoicename']);    
		$usrecord['invoicedesignation']		=	$this->mySQLSafe( $formvars['invoicedesignation']);    
		$usrecord['invoiceaddress']			=	$this->mySQLSafe( $formvars['invoiceaddress']);    
		$usrecord['invoicewebsite']			=	$this->mySQLSafe( $formvars['invoicewebsite']);    		
		$usrecord['name']					=	$this->mySQLSafe( $formvars['name']);    
		$usrecord['invoicetelephone']		=	$this->mySQLSafe( $formvars['invoicetelephone']);    
		$usrecord['invoicefax']				=	$this->mySQLSafe( $formvars['invoicefax']);    
		$usrecord['invoiceemail']			=	$this->mySQLSafe( $formvars['invoiceemail']);    
		$usrecord['executivename']			=	$this->mySQLSafe( $formvars['executivename']);    
		$usrecord['executivedesignation']	=	$this->mySQLSafe( $formvars['executivedesignation']);    
		$usrecord['executiveaddress']		=	$this->mySQLSafe( $formvars['executiveaddress']);    
		$usrecord['executivetelephone']		=	$this->mySQLSafe( $formvars['executivetelephone']);    
		$usrecord['executivefax']			=	$this->mySQLSafe( $formvars['executivefax']);    
		$usrecord['executiveemail']			=	$this->mySQLSafe( $formvars['executiveemail']);    
		$usrecord['executivewebsite']		=	$this->mySQLSafe( $formvars['executivewebsite']);    
		$usrecord['informemail']			=	$this->mySQLSafe( $formvars['informemail']);
		$usrecord['availresidence']			=	$this->mySQLSafe( $formvars['availresidence']);    			  		    
		$this->insert($this->user_sponsor_tbl,$usrecord);

		// insert user record in redc user information tbl
		$uirecord['oepaid']					=	$this->mySQLSafe( $fk_oepa_id);
		//$uirecord['uid']					=	$this->mySQLSafe( $fk_user_id);
		$uirecord['learnabout']				=	$this->mySQLSafe( $formvars['learnabout']); 
		$uirecord['learnabout_other']		=	$this->mySQLSafe( $formvars['learnabout_other']); 
		   		   
		if($this->insert($this->user_inform_tbl,$uirecord) > 0 ) 
		{
	    	$this->error="Applicant has been added successfully.";
			return true;
		}
		else
		{
			$this->error="Applicant has not been added.";
			return false;			
		}
		
	
	}  

	/*
	* load record from data base.
	*/
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
	
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$id) {
		/*
		echo $id;
		echo "<br />";
		echo "<pre>";
			print_r($_REQUEST);
		echo "</pre>";
		exit;

		
		$userRecord['username']			=	$this->mySQLSafe( $formvars['username']);
		$userRecord['password']			=	$this->mySQLSafe( $formvars['password']);
		*/
		$w = "oepaid = ".$id;
		// insert user record in redc user tbl
		//$this->update($this->usertblname,$userRecord , $w);
		
		//$record['oepid']				=	$this->mySQLSafe( $formvars['oepprogrammes']);
/*		$record['applicationstatus']	=	$this->mySQLSafe( $formvars['applicationstatus']);
		$where	=	"oepaid = ".$id;
		$this->update($this->tablename,$record,$where);*/
		
		$uprecord['firstname']			=	$this->mySQLSafe( $formvars['firstname']);
		$uprecord['middlename']			=	$this->mySQLSafe( $formvars['middlename']);
		$uprecord['lastname']			=	$this->mySQLSafe( $formvars['lastname']);
		$uprecord['prefix']				=	$this->mySQLSafe( $formvars['prefix']);
		$uprecord['gender']				=	$this->mySQLSafe( $formvars['gender']);
		$uprecord['nationality']		=	$this->mySQLSafe( $formvars['nationality']);
		$uprecord['busemail']			=	$this->mySQLSafe( $formvars['busemail']);
		$uprecord['emergencyname']		=	$this->mySQLSafe( $formvars['emergencyname']);
		$uprecord['emergencyphone']		=	$this->mySQLSafe( $formvars['emergencyphone']);
		$this->update($this->user_personal_tbl,$uprecord , $w);
		
		$ucrecord['contactdesignation']		=	$this->mySQLSafe( $formvars['contactdesignation']);    
		$ucrecord['companyname']			=	$this->mySQLSafe( $formvars['companyname']);    
		$ucrecord['companyother']			=	$this->mySQLSafe( $formvars['companyother']);    
		$ucrecord['companyaddress']			=	$this->mySQLSafe( $formvars['companyaddress']);    
		$ucrecord['city']					=	$this->mySQLSafe( $formvars['city']);    
		$ucrecord['country']				=	$this->mySQLSafe( $formvars['country']);    
		$ucrecord['ctelephone']				=	$this->mySQLSafe( $formvars['ctelephone']);    
		$ucrecord['cell']					=	$this->mySQLSafe( $formvars['cell']);    
		$ucrecord['fax']					=	$this->mySQLSafe( $formvars['fax']);    
		$this->update($this->user_contact_tbl,$ucrecord , $w);

		$uorecord['parentservices']				=	$this->mySQLSafe( $formvars['parentservices']);    
		$uorecord['parentnumemployees']			=	$this->mySQLSafe( $formvars['parentnumemployees']);    
		$uorecord['services']					=	$this->mySQLSafe( $formvars['services']);    
		$uorecord['numemployees']				=	$this->mySQLSafe( $formvars['numemployees']);    
		$uorecord['numemployeessupervision']	=	$this->mySQLSafe( $formvars['numemployeessupervision']);    
		$uorecord['reportperson']				=	$this->mySQLSafe( $formvars['reportperson']);    
		$uorecord['industry']					=	$this->mySQLSafe( $formvars['industry']);    
		$uorecord['industryother']				=	$this->mySQLSafe( $formvars['industryother']);    
		$uorecord['position']					=	$this->mySQLSafe( $formvars['position']);    
		$uorecord['positionother']				=	$this->mySQLSafe( $formvars['positionother']);    
		$this->update($this->user_org_tbl,$uorecord , $w);
		
		$uprrecord['company1']			=	$this->mySQLSafe( $formvars['company1']);    
		$uprrecord['position1']			=	$this->mySQLSafe( $formvars['position1']);  
		$uprrecord['from1']				=	$this->mySQLSafe( $formvars['from1']);    
		$uprrecord['to1']				=	$this->mySQLSafe( $formvars['to1']);      
		$uprrecord['company2']			=	$this->mySQLSafe( $formvars['company2']);    
		$uprrecord['position2']			=	$this->mySQLSafe( $formvars['position2']);  
		$uprrecord['from2']				=	$this->mySQLSafe( $formvars['from2']);    
		$uprrecord['to2']				=	$this->mySQLSafe( $formvars['to2']);      
		$uprrecord['company3']			=	$this->mySQLSafe( $formvars['company3']);    
		$uprrecord['position3']			=	$this->mySQLSafe( $formvars['position3']);  
		$uprrecord['from3']				=	$this->mySQLSafe( $formvars['from3']);    
		$uprrecord['to3']				=	$this->mySQLSafe( $formvars['to3']);      
		$uprrecord['numyearsexp']		=	$this->mySQLSafe( $formvars['numyearsexp']);    
		$uprrecord['responsibility']	=	$this->mySQLSafe( $formvars['responsibility']);  
		
		$uprrecord['mgtlevel']	=	$this->mySQLSafe( $formvars['mgtlevel']);  
		$uprrecord['mgtlevel_other']	=	$this->mySQLSafe( $formvars['mgtlevel_other']);  
		
		$uprrecord['university']		=	$this->mySQLSafe( $formvars['university']);    
		$uprrecord['year']				=	$this->mySQLSafe( $formvars['year']);      
		$uprrecord['degree']			=	$this->mySQLSafe( $formvars['degree']);    
		$uprrecord['objectives']		=	$this->mySQLSafe( $formvars['objectives']);  
		$uprrecord['atndotherredcprog1']		=	$this->mySQLSafe( $formvars['atndotherredcprog1']);  
		$uprrecord['atndotherredcprogdate1']		=	$this->mySQLSafe( $formvars['atndotherredcprogdate1']);  
		$uprrecord['atndotherredcprog2']		=	$this->mySQLSafe( $formvars['atndotherredcprog2']);  
		$uprrecord['atndotherredcprogdate2']		=	$this->mySQLSafe( $formvars['atndotherredcprogdate2']);  
		$this->update($this->user_profess_tbl,$uprrecord , $w);

		$usrecord['name']					=	$this->mySQLSafe( $formvars['name']);    
		$usrecord['designation']			=	$this->mySQLSafe( $formvars['designation']);    
		$usrecord['address']				=	$this->mySQLSafe( $formvars['address']);    
		$usrecord['telephone']				=	$this->mySQLSafe( $formvars['telephone']);    
		$usrecord['sponsorfax']				=	$this->mySQLSafe( $formvars['sponsorfax']);    
		$usrecord['email']					=	$this->mySQLSafe( $formvars['email']);    
		$usrecord['website']				=	$this->mySQLSafe( $formvars['website']);    
		$usrecord['invoicename']			=	$this->mySQLSafe( $formvars['invoicename']);    
		$usrecord['invoicedesignation']		=	$this->mySQLSafe( $formvars['invoicedesignation']);    
		$usrecord['invoiceaddress']			=	$this->mySQLSafe( $formvars['invoiceaddress']);    
		$usrecord['invoicewebsite']			=	$this->mySQLSafe( $formvars['invoicewebsite']);    		
		$usrecord['name']					=	$this->mySQLSafe( $formvars['name']);    
		$usrecord['invoicetelephone']		=	$this->mySQLSafe( $formvars['invoicetelephone']);    
		$usrecord['invoicefax']				=	$this->mySQLSafe( $formvars['invoicefax']);    
		$usrecord['invoiceemail']			=	$this->mySQLSafe( $formvars['invoiceemail']);    
		$usrecord['executivename']			=	$this->mySQLSafe( $formvars['executivename']);    
		$usrecord['executivedesignation']	=	$this->mySQLSafe( $formvars['executivedesignation']);    
		$usrecord['executiveaddress']		=	$this->mySQLSafe( $formvars['executiveaddress']);    
		$usrecord['executivetelephone']		=	$this->mySQLSafe( $formvars['executivetelephone']);    
		$usrecord['executivefax']			=	$this->mySQLSafe( $formvars['executivefax']);    
		$usrecord['executiveemail']			=	$this->mySQLSafe( $formvars['executiveemail']);    
		$usrecord['executivewebsite']		=	$this->mySQLSafe( $formvars['executivewebsite']);    
		$usrecord['informemail']			=	$this->mySQLSafe( $formvars['informemail']);    
		$usrecord['availresidence']			=	$this->mySQLSafe( $formvars['availresidence']);    
		$this->update($this->user_sponsor_tbl,$usrecord , $w);

		$uirecord['learnabout']				=	$this->mySQLSafe( $formvars['learnabout']);    
		$uirecord['learnabout_other']				=	$this->mySQLSafe( $formvars['learnabout_other']);    
		if($this->update($this->user_inform_tbl,$uirecord , $w) > 0 ) 
		{
	    	$this->error="The applicant has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="The applicant has not been updated.";
			return false;			
		}

    }

	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($id=0)
	{
		
		// delete applicant programme
	 		$_query = "DELETE a, uc, upe, upr, uog, usp, uif 
					   FROM " . $this->tablename." AS a 
					   LEFT JOIN ".$this->user_contact_tbl." AS uc ON uc.oepaid = a.oepaid 
					   LEFT JOIN ". $this->user_personal_tbl." AS upe ON upe.oepaid = a.oepaid
					   LEFT JOIN ".$this->user_profess_tbl." AS upr ON upr.oepaid = a.oepaid
					   LEFT JOIN ".$this->user_org_tbl." AS uog ON uog.oepaid = a.oepaid
					   LEFT JOIN ".$this->user_sponsor_tbl." AS usp ON usp.oepaid = a.oepaid
					   LEFT JOIN ".$this->user_inform_tbl." AS uif ON uif.oepaid = a.oepaid 
					   WHERE a.oepaid = $id 
					   ";
		$recordset	=	$this->execute($_query);
		if($recordset) 
		{
			$this->error	=	"Record has been deleted successfully.";
			return true;
		}
	}	

    /**
     * get the Faqs entries
	  * @param start variables use for paging.
     */
    function getEntries($_start=0,$formvars) {


		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			if($formvars['sortcolumn'] == 'firstname')
				$sortfield = "u.".$formvars['sortcolumn'];
			else if($formvars['sortcolumn'] == 'name')
				$sortfield = "p.".$formvars['sortcolumn'];
			else if($formvars['sortcolumn'] == 'oepaid')		
				$sortfield = "a.".$formvars['sortcolumn'];
			else if($formvars['sortcolumn'] == 'oepaid')
				$sortfield = "a.".$formvars['sortcolumn'];
				
			if($sortfield != "")
			{
				$this->sortcolumn=$sortfield;
			}
			$this->sortdirection=$formvars['sortdirection'];
			$orderby=" order by ".$this->sortcolumn ." ". $this->sortdirection;
			
		}
		else if(isset($_GET['sc']) && isset($_GET['sd']))
		{
			$this->sortcolumn=$_GET['sc'];
			$this->sortdirection=$_GET['sd'];
			$orderby=" order by ".$this->sortcolumn ." ". $this->sortdirection;
		}
		else
		{
			$orderby=" order by a.".$this->sortcolumn ." ". $this->sortdirection;
		}	
		///Sort order
		//$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
/*		if(($formvars['search_by_cname']!='') && ($formvars['search_by_pname']!=''))
		{
          	$where.=" where name = '".$formvars['search_by_pname']."' AND director = '".$formvars['search_by_email']."'";
	    }
*/		

		//$where = " where  a.uid = u.uid and a.oepid = p.oepid";
		$where = " where  a.uid = u.uid and a.oepid = p.oepid";
		
		if(($formvars['search_by_uname']!='') && ($formvars['search_by_pname']!=''))
		{
			$this->searchbyuname 		= $formvars['search_by_uname'];
			$tmpuname = $formvars['search_by_uname']."%";
			$this->searchbypname 	= $formvars['search_by_pname'];
			$tmppname = $formvars['search_by_pname']."%";
			$where	.= " and p.name like ".$this->mySQLSafe($tmppname)." and u.firstname like ".$this->mySQLSafe($tmpuname);
		}

		else if(isset($formvars['search_by_uname']) && $formvars['search_by_uname']!='')
		{
          	$this->searchbyuname 	= $formvars['search_by_uname'];
			$tmpuname = $formvars['search_by_uname']."%";
			$where .=" and u.firstname like ".$this->mySQLSafe($tmpuname);
		}
		else if(isset($formvars['search_by_pname']) && $formvars['search_by_pname']!='')
		{
		 	$this->searchbypname 	= $formvars['search_by_pname'];
			$tmppname = $formvars['search_by_pname']."%";
			$where	.= " and p.name like ".$this->mySQLSafe($tmppname);
		}
		
		if(isset($_REQUEST['pid']) && $_REQUEST['pid'] != 0)
		{
			$this->parentid = $_REQUEST['pid'];
			$where	.= " and a.oepid = ".$this->parentid;
		}	
		
		
		$status = (isset($formvars['status'])) ? (($formvars['status'] == 'A') ? 'A' : (($formvars['status'] == 'R') ? 'R' : "")) : "";
		$this->status = $status;
		$where	.=" and a.applicationstatus = '".$status."' ";
		$where	.=" and a.iscomplete = 'Yes' ";


		// query for paging
		$qry_for_page = "select a.oepaid from " . $this->tablename." as a , ".$this->table_name." as p , ".$this->usertblname." as u ". $where;
//		echo $qry_for_page;
		
		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows($qry_for_page);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?status=$this->status",20);
		$this->tpl->assign('paging',$paging->displayTable());
		$this->countRecords = $paging->num;	
		
		
		
		$_query = "select * from " . $this->tablename." as a , ".$this->table_name." as p , ".$this->usertblname." as u ". $where . $orderby ."  Limit $paging->start,$paging->limit";
		
//		echo $_query;
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data=$fetch;
		}
		else
		{
		   if(empty($this->error))
		   	$this->error="No Applicants found.";
		   
		   $data=null;
		}
	    return $data;   
    }
   	function exportMysqlToCsv($formvars = array() , $filename = 'export.csv')
				{
	/*echo "<pre>";
		print_r($_REQUEST);
	echo "</pre>";
	
	exit;*/
		
    $csv_terminated = "\n";
    $csv_separator = ",";
    $csv_enclosed = '"';
    $csv_escaped = "\\";
$where = "";
		$where = " where  a.uid = u.uid and a.oepid = p.oepid";
		
		if(($formvars['search_by_uname']!='') && ($formvars['search_by_pname']!=''))
		{
			$this->searchbyuname 		= $formvars['search_by_uname'];
			$tmpuname = $formvars['search_by_uname']."%";
			$this->searchbypname 	= $formvars['search_by_pname'];
			$tmppname = $formvars['search_by_pname']."%";
			$where	.= " and p.name like ".$this->mySQLSafe($tmppname)." and u.firstname like ".$this->mySQLSafe($tmpuname);
		}

		else if(isset($formvars['search_by_uname']) && $formvars['search_by_uname']!='')
		{
          	$this->searchbyuname 	= $formvars['search_by_uname'];
			$tmpuname = $formvars['search_by_uname']."%";
			$where .=" and u.firstname like ".$this->mySQLSafe($tmpuname);
		}
		else if(isset($formvars['search_by_pname']) && $formvars['search_by_pname']!='')
		{
		 	$this->searchbypname 	= $formvars['search_by_pname'];
			$tmppname = $formvars['search_by_pname']."%";
			$where	.= " and p.name like ".$this->mySQLSafe($tmppname);
		}
		
		if(isset($_REQUEST['pid']) && $_REQUEST['pid'] != 0)
		{
			$this->parentid = $_REQUEST['pid'];
			$where	.= " and a.oepid = ".$this->parentid;
		}	
		
		
		$status = (isset($formvars['status'])) ? (($formvars['status'] == 'A') ? 'A' : (($formvars['status'] == 'R') ? 'R' : "")) : "";
		$this->status = $status;
		$where	.=" and a.applicationstatus = '".$status."'";

		
		// query for paging
//		$sql_query = "select a.*, p.* , u.* from redc_oep_applicants as a , redc_oep_programmes as p , redc_user as u ". $where;
//		$sql_query = "SELECT a.registrationdate, a.iscomplete, p.name, u.email, u.firstname, u.lastname from redc_oep_applicants as a , redc_oep_programmes as p , redc_user as u ". $where;
		
		$sql_query = "SELECT p.name as `Programme Name`, p.startdate as 'Programme Date',up.prefix as Prefix, up.firstname as `Participant First Name`, up.middlename as `Participant Middle Name`, up.lastname as `Participant Last Name`, up.busemail as `Business Email`, uc.companyname as `Company/organization name`, 

uc.contactdesignation as Designation, uc.ctelephone as Telephone, uc.cell as `Cell Number`, upr.company1 as `Name of company`, upr.position1 as `Title/position`, upr.from1 as   `From (mm/yyyy)`, upr.to1 as `To (mm/yyyy)`,upr.numyearsexp as   `Total years of work experience`, upr.university as University, 

upr.year as Year, upr.degree as `Degree (Highest level attended)`, upr.objectives as Objectives, concat(upr.mgtlevel, upr.mgtlevel_other) as `Management level`, concat(uo.industry, uo.industryother) as Industry, concat(uo.position, 

uo.positionother) as `What function best describe your position?`, us.availresidence as `Do you wish to avail residence at REDC-LUMS during the programme?` FROM redc_oep_applicants as a , redc_oep_programmes as p , redc_user as u, 

redc_user_personal as up, redc_user_professional as upr, redc_user_contact as uc, redc_user_organizational uo, 

redc_user_sponsoship as us where uo.oepaid = a.oepaid and up.oepaid= a.oepaid and a.uid = u.uid and a.oepid = 

p.oepid and upr.oepaid = a.oepaid and uc.oepaid = a.oepaid and us.oepaid = a.oepaid and a.applicationstatus = '' and a.iscomplete = 'Yes'";

	if(isset($_REQUEST['pid']) && $_REQUEST['pid'] != "" && $_REQUEST['pid'] != "0")
	{	
		$sql_query = $sql_query." and a.oepid = ".$_REQUEST['pid'];	
	}
		
	$sql_query .= " order by a.$this->sortcolumn  $this->sortdirection";
	
	
	
	//$sql_query = "select *  from ".$this->tablename.$where." ORDER BY a.aid asc";
    //$sql_query = "select *  from ".$this->tablename;
    // Gets the data from the database
    $result = mysql_query($sql_query);
    $fields_cnt = mysql_num_fields($result);
     $schema_insert = '';
     for ($i = 0; $i < $fields_cnt; $i++)
    {
        $l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed,
            stripslashes(mysql_field_name($result, $i))) . $csv_enclosed;
        $schema_insert .= $l;
        $schema_insert .= $csv_separator;
    } // end for
 
    $out = trim(substr($schema_insert, 0, -1));
    $out .= $csv_terminated;
 
    // Format the data
    while ($row = mysql_fetch_array($result))
    {
        $schema_insert = '';
        for ($j = 0; $j < $fields_cnt; $j++)
        {
            if ($row[$j] == '0' || $row[$j] != '')
            {
 
                if ($csv_enclosed == '')
                {
                    $schema_insert .= $row[$j];
                } else
                {
                    $schema_insert .= $csv_enclosed . 
					str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $row[$j]) . $csv_enclosed;
                }
            } else
            {
                $schema_insert .= '';
            }
 
            if ($j < $fields_cnt - 1)
            {
                $schema_insert .= $csv_separator;
            }
        } // end for
 
        $out .= $schema_insert;
        $out .= $csv_terminated;
    } // end while
 
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Length: " . strlen($out));
    // Output to browser with appropriate mime type, you choose ;)
    header("Content-type: text/x-csv");
    //header("Content-type: text/csv");
    //header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=$filename");
    echo $out;

	//return $out;
   }
   function getEmail($id)
   {
   		$query = "select username from ".$this->usertblname." where uid = $id";
		$f = $this->select($query);
		return $f[0]['username'];
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
		
/*
		if(isset($formvars['confpassword']))
		{
			$this->tpl->assign('confpass',$formvars['confpassword']);
		}
		else
		{
			$this->tpl->assign('confpass',$formvars['password']);
		}
		
		if(isset($formvars['oepaid']) && $formvars['oepaid'] != "")
		{
			$this->tpl->assign('oldemail', $this->getEmail($formvars['uid']));
		}	
*/
		$this->tpl->assign('pid' , $this->parentid);
		$this->tpl->assign('programme', $this->getProgrammes());
		$this->tpl->assign('users', $this->getUsers());
		$this->tpl->assign('countries', $this->getCountries());
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('oepapplicantsmanagement.tpl');
    }
    /**
     * display the Faq records
     *
     * @param array $data the Faq data
     */
    function displayGird($data = array()) {
	    global $GENERAL;		
		$arrysearch["search_by_uname"] 	= $this->searchbyuname;
		$arrysearch["search_by_pname"] 	= $this->searchbypname;
		$this->tpl->assign('formvars', $arrysearch);
		$this->tpl->assign('pid' , $this->parentid);
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('status',$this->status);
		$this->tpl->assign('countRecords' , $this->countRecords);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('oepapplicantsmanagement.tpl');        
    }
}
?>