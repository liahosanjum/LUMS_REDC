<?php
/**
 * OFP Participant Management application library
 *
 */
class OFPParticipantManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_ofp_participants";
	var $table_name="redc_ofp_users";
	var $tbl_name = "redc_ofpprogrammes";
	var $redc_alumni = "redc_alumni";
	var $redc_alumni_applicants = "redc_alumni_applicants";
	var $country_tbl = "redc_countries";
	var $usertblname = "redc_user";
	var $sortcolumn=" ofppid ";
	var $sortdirection=" asc ";
	var $fpid = null;
	var $status = "";
	var $countRecords = 0;
	var $tbloep="redc_oep_applicants";
	
    /**
     * class constructor
     */
    function OFPParticipantManagement() {
		if(!isset($_REQUEST['ofpid']) || $_REQUEST['ofpid'] == "")
		{
			header("ofpmanagement.php");
		}
		
     	$this->tpl =& new Smarty;
		$this->db();
    }
  
	// check if user name already taken  
	function alreadyExists($username)
	{
		return $this->numrows("select username from ".$this->table_name." where username = '".$username."'");
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
       * Check if a number is a counting number by checking if it
       * is an integer primitive type, or if the string represents
       * an integer as a string
       */

      function is_int_val($data) {
		  if (is_int($data) === true) return true;
		  elseif (is_string($data) === true && is_numeric($data) === true) {
			  return (strpos($data, '.') === false);
		  }
			  return false;
      }  
	  
	  
		function validateint($inData) {
		  $intRetVal = -1;
		
		  $IntValue = intval($inData);
		  $StrValue = strval($IntValue);
		  if($StrValue == $inData) {
			$intRetVal = $IntValue;
		  }
		
		  return $intRetVal;
		}
	  
  
    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars) {

	/*
	echo "<pre>";
		print_r($formvars);
	echo "</pre>";
	*/
	
	
	
	// reset error message
    $this->error = null;
        
		
	/*if(strlen(trim($formvars['clname'])) == 0) {
		$this->error = 'Please provide Client name ';
		return false; 
	}*/
/*	if(strlen(trim($formvars['username'])) == 0) {
		$this->error = 'Please provide email (user name)';
		return false; 
	}
	
	if(!$this->validateMail($formvars['username']))
	{
		$this->error = 'Invalid email (user name)';
		return false; 
	}
*/
/*     if($this->pageview != 'edit')
	 {
		if($this->alreadyExists($formvars['username']))
		{
			$this->error = 'Email (user name) already taken';
			return false; 
		}
	 }
	 else
	 {
	 	$array = $this->editEntry($_REQUEST['id']);
		if($formvars['username'] != $array["username"])
		{
			if($this->alreadyExists($formvars['username']))
			{
				$this->error = 'Email (user name) already taken';
				return false; 
			}
		}
	 }
*/		
/*		if(strlen(trim($formvars['password'])) == 0) {
            $this->error = 'Please provide password';
            return false; 
        }

		if(strlen(trim($formvars['password'])) < 6) {
            $this->error = 'Password must be atleast 6 characters long';
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

        if(strlen(trim($formvars['firstname'])) == 0) {
            $this->error = 'Please provide first name';
            return false; 
        }

        if(strlen(trim($formvars['lastname'])) == 0) {
            $this->error = 'Please provide last name';
            return false; 
        }
*/

        if(strlen(trim($formvars['firstname'])) == 0) {
            $this->error = 'Please select participant';
            return false; 
        }

        if(strlen(trim($formvars['lastname'])) == 0) {
            $this->error = 'Please select participant';
            return false; 
        }


        if(strlen(trim($formvars['jobtitle'])) == 0) {
            $this->error = 'Please provide job title';
            return false; 
        }

		if(strlen(trim($formvars['organization'])) == 0) {
            $this->error = 'Please provide organisation name';
            return false; 
        }

		if(strlen(trim($formvars['phone'])) == 0) {
            $this->error = 'Please provide contact phone';
            return false; 
        }
		
		if (!ereg ("([0-9])", $formvars['phone'])) {
            $this->error = 'Please provide a valid value for contact phone';
            return false; 
		}
/*		if(strlen(trim($formvars['phone'])) < 8 )
		{
			$this->error = ' Please provide a valid value for contact phone';
			return false;
		}
*/		if(strlen(trim($formvars['email'])) == 0) {
            $this->error = 'Please provide email';
            return false; 
        }

		if(!$this->validateMail($formvars['email'])) {
            $this->error = 'Please provide valid email address';
            return false; 
        }

		if(strlen(trim($formvars['address'])) == 0) {
            $this->error = 'Please provide address';
            return false; 
        }
		if(strlen(trim($formvars['nationality'])) == 0) {
            $this->error = 'Please provide nationality';
            return false; 
        }
		if(strlen(trim($formvars['country'])) == 0) {
            $this->error = 'Please provide country';
            return false; 
        }
		if(strlen(trim($formvars['cell'])) == 0) {
            $this->error = 'Please provide cell number';
            return false; 
        }

		if (!ereg ("([0-9])", $formvars['cell'])) {
            $this->error = 'Please provide only integer value for cell';
            return false; 
		}
		
		if(strlen(trim($formvars['fax'])) == 0) {
            $this->error = 'Please provide fax number';
            return false; 
        }

		if (!ereg ("([0-9])", $formvars['fax'])) {
            $this->error = 'Please provide only integer value for fax';
            return false; 
		}
		
		if(strlen(trim($formvars['emergencyname'])) == 0) {
            $this->error = 'Please provide name in case of emergency';
            return false; 
        }
		if(strlen(trim($formvars['emergencyphone'])) == 0) {
            $this->error = 'Please provide contact no in case of emergency';
            return false; 
        }
		//(!ereg ("([0-9])", $formvars['emergencyphone']))
		if (!ereg ("([0-9])" , $formvars['emergencyphone']))
		{
         $this->error = 'Please provide only integer value for contact no';		
		  return false;
		}
/*		if(strlen(trim($formvars['emergencyphone'])) < 8)
		{
			$this->error = 'Please provide valid format for contact no ';
			return false;
		}
*/		/*if(trim($formvars['emergencyphone']) < 0)
		{
		$this->error = 'Please provide posotive value for contact no';
		return flase;
		}*/
		if(strlen(trim($formvars['institution'])) == 0) {
            $this->error = 'Please provide institution';
            return false; 
        }
		if(strlen(trim($formvars['degree'])) == 0) {
            $this->error = 'Please provide degree';
            return false; 
        }
		if($formvars['year'] == "") {
            $this->error = 'Please provide year';
            return false; 
        }
		if (!ereg ("([0-9]+)", $formvars['year'])) {
            $this->error = 'Year must be an integer value';
            return false; 
        }
		
		if (strlen(trim($formvars['year'])) < 4) {
            $this->error = 'Year must be in valid format e.g 2009';
            return false; 
        }

		
		if($formvars['yearsexperience'] == "") {
            $this->error = 'Please provide years experience';
            return false; 
        }

/*		if (!ereg ("([0-9])", $formvars['yearsexperience'])) {
            $this->error = 'experience years must be an integer value';
            return false; 
        }
*/		
		if (!$this->is_int_val($formvars['yearsexperience'])) {
            $this->error = 'Experience years must be an integer value';
            return false; 
        }
		if (trim($formvars['yearsexperience']) < 0) 
		{
            $this->error = 'Please provide positive  integer value for  years experience';
            return false; 
        }
		
		if(strlen(trim($formvars['responsibilities'])) == 0) {
            $this->error = 'Please provide responsibilities';
            return false; 
        }
		if(strlen(trim($formvars['responsibilities'])) > 300) {
            $this->error = 'Please provide responsibilities with max 300 characters';
            return false; 
        }

		if(strlen(trim($formvars['benefits'])) == 0) {
            $this->error = 'Please provide benefits';
            return false; 
        }
		if(strlen(trim($formvars['benefits'])) > 300) {
            $this->error = 'Please provide benefits with max 300 characters';
            return false; 
        }


		return true;
    }
 
 
	// make alumni to applicants if porgramm is completed
	function makeAlumni($formvars)
	{
		if(empty($formvars['addtoalumni']))
		{
			$this->error	=	"Please select participant(s) to add to alumni.";
		}
		else
		{
			$this->addToAlumni($formvars['addtoalumni']);
			$this->error	=	"Participant(s) has been added to alumni.";
		}
	}




	// add to alumni
	function addToAlumni($addtoalumni)
	{
		foreach($addtoalumni as $alum)
		{
			$rec = $this->getParticipantData($alum);
			$addAlumni 	= array();
			$addAlumni["uid"] 		 	= $this->mySQLSafe( $rec['uid']);
			//$addAlumni["username"] 		 	= $this->mySQLSafe( $rec['username']);
			//$addAlumni["password"]  	 	= $this->mySQLSafe( $rec['password']);
			//$addAlumni["firstname"]  		= $this->mySQLSafe( $rec['firstname']);
			$addAlumni["middlename"]  		= $this->mySQLSafe( $rec['middlename']);
			//$addAlumni["lastname"] 			= $this->mySQLSafe( $rec['lastname']);
			$addAlumni["prefix"]  			= $this->mySQLSafe( $rec['prefix']);
			$addAlumni["nationality"]  		= $this->mySQLSafe( $rec['nationality']);
			$addAlumni["email"]  			= $this->mySQLSafe( $rec['email']);
			$addAlumni["designation"]  		= $this->mySQLSafe( $rec['jobtitle']);
			$addAlumni["companyname"]  		= $this->mySQLSafe( $rec['organization']);
			//$addAlumni["companyother"]  	= $this->mySQLSafe( $rec['companyother']);
			$addAlumni["companyaddress"]  	= $this->mySQLSafe( $rec['address']);
			$addAlumni["city"]  			= $this->mySQLSafe( $rec['city']);
			$addAlumni["country"]  			= $this->mySQLSafe( $rec['country']);
			$addAlumni["phone"]  			= $this->mySQLSafe( $rec['phone']);
			$addAlumni["cell"]  			= $this->mySQLSafe( $rec['cell']);
			$addAlumni["fax"]  				= $this->mySQLSafe( $rec['fax']);
			$addAlumni["currentindustry"]   = $this->mySQLSafe( $rec['organization']);
			//$addAlumni["industryother"]  	= $this->mySQLSafe( $rec['industryother']);
			$addAlumni["position"]  		= $this->mySQLSafe( $rec['position']);
			//$addAlumni["positionother"]  	= $this->mySQLSafe( $rec['positionother']);
			$addAlumni["isactive"]  		= $this->mySQLSafe( "Yes");
			//$addAlumni["registrationdate"]  = $this->mySQLSafe( date("Y-m-d"));
			
			if($aid = $this->in_Alumni($rec['uid']))
			{
				$alumniid = $aid["aid"];
				$where = " aid = $alumniid";
				if(!$this->sameProgramme($alumniid , $rec['ofpid']))
				{
					$addAlumni["numprogrammes"]  	= (int)$aid["numprogrammes"] + 1;
					// add to alumni applicant table
					$addAlumniApp = array();
					$addAlumniApp["aid"]   = $this->mySQLSafe( $alumniid);
					$addAlumniApp["ofpid"] = $this->mySQLSafe( $rec['ofpid']);
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
				$addAlumniApp["ofpid"] = $this->mySQLSafe( $rec['ofpid']);
				$this->insert($this->redc_alumni_applicants , $addAlumniApp);
			
			}
			
			
			// delete applicant from applicant table after being added as alumni
			//$del		=	"delete from ".$this->tablename." where oepaid= ".$rec['oepaid'];
			//$this->execute($del);
		
		}	
			
	}
 
	// check if applicant already exists in alumni table
	function in_Alumni($uid)
	{
		$qryalumni = "select aid , numprogrammes from ".$this->redc_alumni." where uid = '".$uid."'";
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
	function sameProgramme($aid , $ofpid)
	{
		$qryalumni = "select aid from ".$this->redc_alumni_applicants." where aid = $aid and ofpid = $ofpid";
		if($this->numrows($qryalumni))
		{
			return true;
		}
		else
			return false;
		
	}
 
	// it will return participant data in array
	function getParticipantData($ofppid)
	{
		$_query = "select * from " . $this->tablename." as p , ".$this->table_name." as u , ". $this->usertblname ." as ru where p.ofppid = $ofppid and p.ofpuid = u.ofpuid and u.uid = ru.uid";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			foreach($fetch as $f)
				$data = $f;
		}
		
        return $data; 
	}

 	// get all enabled users  
  	function getUsers()
	{
		
//		$_query = "select oepid , name from ".$this->table_name." where iscompleted = 'N' and isactive = 'Yes' and enddate > '".date("Y-m-d")."'";
		
		//$_query = "select uid , firstname , lastname from ".$this->usertblname." where isactive = 'Y' and uid not in( select uid from ". $this->tbloep .")";
		$_query = "select uid , firstname , lastname from ".$this->usertblname." where isactive = 'Y' and type = 'ofp'";
		return $this->select($_query);
	}

	// get country list
  	function getCountries()
	{
		$query = "select country_id , countryname from ".$this->country_tbl;
		return $this->select($query);
	}
 

	function checkIfUserAlreadyApplied($recArray)
	{
		$query = "SELECT ofpp.ofppid
				  FROM ". $this->tablename ."
				  AS ofpp , ". $this->table_name ." AS ofpu 
				  WHERE ofpp.ofpuid = ofpu.ofpuid
				  AND ofpp.ofpid = ".$recArray['ofpid']."
				  AND ofpu.uid = ".$recArray['uid']
				  ;
		$num = $this->numrows($query);
		return $num;		  
	}	
 
 
  	 /**
     * @param array $formvars the form variables
     */
    function addEntry($formvars) 
	{

		if($this->checkIfUserAlreadyApplied($formvars))
		{
			$this->error="Participant has already applied for this programme.";
			return false;			
		}

		$record['uid']					=	$this->mySQLSafe( $formvars['uid']);
		//$record['username']				=	$this->mySQLSafe( $formvars['username']);
		//$record['password']				=	$this->mySQLSafe( $formvars['password']);
		$record['prefix']				=	$this->mySQLSafe( $formvars['prefix']);
		//$record['firstname']			=	$this->mySQLSafe( $formvars['firstname']);
		$record['middlename']			=	$this->mySQLSafe( $formvars['middlename']);
		//$record['lastname']				=	$this->mySQLSafe( $formvars['lastname']);
		$record['jobtitle']				=	$this->mySQLSafe( $formvars['jobtitle']);
		$record['organization']			=	$this->mySQLSafe( $formvars['organization']);
		$record['phone']				=	$this->mySQLSafe( $formvars['phone']);
		$record['email']				=	$this->mySQLSafe( $formvars['email']);
		$record['address']				=	$this->mySQLSafe( $formvars['address']);
		$record['nationality']			=	$this->mySQLSafe( $formvars['nationality']);
		$record['city']					=	$this->mySQLSafe( $formvars['city']);
		$record['country']				=	$this->mySQLSafe( $formvars['country']);
		$record['cell']					=	$this->mySQLSafe( $formvars['cell']);
		$record['fax']					=	$this->mySQLSafe( $formvars['fax']);
		$record['emergencyname']		=	$this->mySQLSafe( $formvars['emergencyname']);
		$record['emergencyphone']		=	$this->mySQLSafe( $formvars['emergencyphone']);
		$record['institution']			=	$this->mySQLSafe( $formvars['institution']);
		$record['degree']				=	$this->mySQLSafe( $formvars['degree']);
		$record['year']					=	$this->mySQLSafe( $formvars['year']);
		$record['position']				=	$this->mySQLSafe( $formvars['position']);
		$record['managementlevel']		=	$this->mySQLSafe( $formvars['managementlevel']);
		$record['yearsexperience']		=	$this->mySQLSafe( $formvars['yearsexperience']);
		$record['responsibilities']		=	$this->mySQLSafe( $formvars['responsibilities']);
		$record['benefits']				=	$this->mySQLSafe( $formvars['benefits']);
		$record['receiveinformation']	=	$this->mySQLSafe( $formvars['receiveinformation']);
		$record['registrationdate']		=	$this->mySQLSafe( date("Y-m-d"));
		
		
		if($formvars['ofpid'] != "")
		{

			if($this->insert($this->table_name,$record) > 0 ) 
			{
				$participate['ofpid'] 			= $this->mySQLSafe($formvars['ofpid']);
				$participate['ofpuid'] 			= $this->mySQLSafe($this->insertid());
				$participate['enrollmentdate'] 	= $this->mySQLSafe(date("Y-m-d"));
//				$participate['clname']				=	$this->mySQLSafe( $formvars['clname']);
				$participate['enabled'] 		= $this->mySQLSafe($formvars['enabled']);
				
				$this->insert($this->tablename,$participate);
				$this->error="The Participant has been added successfully.";
				return true;
			}
			else
			{
				$this->error="The Participant has not been added.";
				return false;			
			}
			
		}	
    }  
	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
		$this->status = $_REQUEST['status'];
		$_query = "SELECT * , ofpu.email as oemail , u.email as uemail  
				   FROM ".$this->table_name." AS ofpu , " . $this->usertblname . " AS u 
				   WHERE ofpu.uid = u.uid
				   AND ofpu.ofpuid = ".$id;
		$fetch=$this->select($_query);
		
		if($fetch!=false)
		{
			// Fill all field 
			foreach($fetch as $da)
				$data = $da;
		}
		
        return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$id) {

    	//$record['username']				=	$this->mySQLSafe( $formvars['username']);
		//$record['password']				=	$this->mySQLSafe( $formvars['password']);
//		$record['clname']				=	$this->mySQLSafe( $formvars['clname']);
		$record['prefix']				=	$this->mySQLSafe( $formvars['prefix']);
		//$record['firstname']			=	$this->mySQLSafe( $formvars['firstname']);
		$record['middlename']			=	$this->mySQLSafe( $formvars['middlename']);	
		//$record['lastname']				=	$this->mySQLSafe( $formvars['lastname']);
		$record['jobtitle']				=	$this->mySQLSafe( $formvars['jobtitle']);
		$record['organization']			=	$this->mySQLSafe( $formvars['organization']);
		$record['phone']				=	$this->mySQLSafe( $formvars['phone']);
		$record['email']				=	$this->mySQLSafe( $formvars['email']);
		$record['address']				=	$this->mySQLSafe( $formvars['address']);
		$record['nationality']			=	$this->mySQLSafe( $formvars['nationality']);
		$record['city']					=	$this->mySQLSafe( $formvars['city']);
		$record['country']				=	$this->mySQLSafe( $formvars['country']);
		$record['cell']					=	$this->mySQLSafe( $formvars['cell']);
		$record['fax']					=	$this->mySQLSafe( $formvars['fax']);
		$record['emergencyname']		=	$this->mySQLSafe( $formvars['emergencyname']);
		$record['emergencyphone']		=	$this->mySQLSafe( $formvars['emergencyphone']);
		$record['institution']			=	$this->mySQLSafe( $formvars['institution']);
		$record['degree']				=	$this->mySQLSafe( $formvars['degree']);
		$record['year']					=	$this->mySQLSafe( $formvars['year']);
		$record['position']				=	$this->mySQLSafe( $formvars['position']);
		$record['managementlevel']		=	$this->mySQLSafe( $formvars['managementlevel']);
		$record['yearsexperience']		=	$this->mySQLSafe( $formvars['yearsexperience']);
		$record['responsibilities']		=	$this->mySQLSafe( $formvars['responsibilities']);
		$record['benefits']				=	$this->mySQLSafe( $formvars['benefits']);
		$record['receiveinformation']	=	$this->mySQLSafe( $formvars['receiveinformation']);
		//$record['registrationdate']		=	$this->mySQLSafe( $formvars['registrationdate']);

/*		
		echo "<pre>";
			print_r($_REQUEST);
		echo "</pre>";


*/
		$where	=	"ofpuid = ".$id;
	
		if($this->update($this->table_name,$record,$where))
		{	
			$this->error	=	"The Record has been updated successfully.";
			return true;
		}
		else
		{
			$this->error	=	"The Record has not been updated.";
			return false;
		}
    }

	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($id=0)
	{
		
		// delete programmes participants before deleting programme
		$del_participants = "delete from ".$this->table_name." where ofpuid = $id";
		$this->execute($del_participants);

		// delete programme
		$_query		=	"delete from ".$this->tablename." where ofpuid=$id";
		$recordset	=	$this->execute($_query);
		if($recordset) 
		{
			$this->error	=	"The Record has been deleted successfully.";
			return true;
		}
	}	

    /**
     * get the Faqs entries
	  * @param start variables use for paging.
     */
    function getEntries($_start=0,$formvars) {

		$this->ofpid = $formvars['ofpid'];
		$this->status = $formvars['status'];
		
		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			$this->sortcolumn=$formvars['sortcolumn'];
			$this->sortdirection=$formvars['sortdirection'];
		}else if(isset($_GET['sc']) && isset($_GET['sd']))
		{
			$this->sortcolumn=$_GET['sc'];
			$this->sortdirection=$_GET['sd'];
		}
	
		///Sort order
		
		if($this->sortcolumn == "enabled")
			$orderby=" order by pp.". $this->sortcolumn ." ". $this->sortdirection;
		else if($this->sortcolumn == "firstname")
			$orderby=" order by ru.". $this->sortcolumn ." ". $this->sortdirection;	
		else
			$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;	

	  	//$where =" where ofpuid =".$formvars['ofpid'];
		
		$where = " where pp.ofpid = ".$formvars['ofpid']." and pp.ofpuid = u.ofpuid and u.uid = ru.uid and p.ofpid = ".$formvars['ofpid'];
		
		//$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";

		
		
		// query for paging
		$qry_for_paging = "select * from ".$this->tablename." as pp , ".$this->table_name." as u ,".$this->tbl_name." as p , " . $this->usertblname ." as ru ". $where ;			


		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows($qry_for_paging);
		$this->countRecords = $paging->num;
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());


		$_query = "select * from ".$this->tablename." as pp , 
		".$this->table_name." as u ,
		".$this->tbl_name." as p , 
		".$this->usertblname." as ru   
		". $where . $orderby ." Limit $paging->start,$paging->limit";

		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data=$fetch;
		}
		else
		{
		   $this->error="No registered participants found.";
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
		$where = " where pp.ofpid = ".$formvars['ofpid']." and pp.ofpuid = u.ofpuid and u.uid = ru.uid and p.ofpid = ".$formvars['ofpid'];
			$sql_query = "select * from ".$this->tablename." as pp , ".$this->table_name." as u ,".$this->tbl_name." as p , ". $this->usertblname ." as ru ". $where ;			
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
    /**
     * display the Faq entry form
     *
     * @param array $formvars the form variables
     */
    function displayForm($formvars = array()) {

		global $GENERAL;
		$this->status = $_REQUEST['status'];
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->ofpid = $_REQUEST['ofpid'];
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('ofpid' , $this->ofpid);
		$this->tpl->assign('status', $this->status);
		$this->tpl->assign('data',$formvars);
		$this->tpl->assign('users', $this->getUsers());
		$years = range (date('Y'), 1970);
		$this->tpl->assign('years',$years);
		$this->tpl->assign('countries', $this->getCountries());
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('ofpparticipantmanagement.tpl');
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
		$this->tpl->assign('status', $this->status);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('ofpid' , $this->ofpid);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('countRecords', $this->countRecords);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('ofpparticipantmanagement.tpl');        
    }
}
?>
