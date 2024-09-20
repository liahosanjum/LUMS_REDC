<?php
/**
 * Podcast Audio Management application library
 *
 */
class Login extends db{

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
	var $tblemails="redc_emailcontent";
	var $useremail;
    /**
     * class constructor
     */
    function Login() {

        $this->redirect();
		$this->tpl = new Smarty;
		$this->db();
    }
   
   
   function redirect()
   {
   		if(isset($_SESSION['userid']) && $_SESSION['userid'] != "")
		{
		  header("Location:apply.php");
		  exit;
		}		
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

		if($formvars['action'] == 'add' or $formvars["prevname"] != $formvars['username'] or strlen(trim($formvars['username'])) == 0){
		
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
		
		if(strlen(trim($formvars['firstname'])) == 0) {
            $this->error = 'Please provide first name';
            return false; 
        }
		if(strlen(trim($formvars['gender'])) == 0) {
            $this->error = 'Please provide gender';
            return false; 
        }
		if(strlen(trim($formvars['nationality'])) == 0) {
            $this->error = 'Please provide nationality';
            return false; 
        }
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
		if(strlen(trim($formvars['companyname'])) == 0) {
            $this->error = 'Please provide company name';
            return false; 
        }
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
            $this->error = 'Please provide how many employees are under your supervision?';
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
		if(strlen(trim($formvars['company1'])) == 0) {
            $this->error = 'Please provide name of company';
            return false; 
        }
		if(strlen(trim($formvars['position1'])) == 0) {
            $this->error = 'Please provide title/position';
            return false; 
        }
		if(strlen(trim($formvars['from1'])) == 0) {
            $this->error = 'Please provide start date';
            return false; 
        }
		if(strlen(trim($formvars['to1'])) == 0) {
            $this->error = 'Please provide end date';
            return false; 
        }
		if(strtotime($formvars['to1']) < strtotime($formvars['from1']))
		{
            $this->error = 'Please provide valid end date';
            return false; 
		}
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
            $this->error = 'Please provide current responsibilities including your level in the organization';
            return false; 
        }
		if(strlen(trim($formvars['responsibility'])) > 300) {
            $this->error = 'Please provide current responsibilities with max of 300 characters';
            return false; 
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


/***********************************************************************************************/
		return true;
    }

    /**
     * test if form information is valid for login form
     *
     * @param array $formvars the form variables
     */
    function isValidLoginForm($formvars) {

		// reset error message
        $this->error = null;

	
		if(strlen(trim($formvars['loginuser'])) == 0) {
			$this->error = 'Please provide email (user name)';
			return false; 
		}
		
		if(!$this->validateMail($formvars['loginuser']))
		{
			$this->error = 'Please provide correct email (user name)';
			return false; 
		}
		
		if(strlen(trim($formvars['loginpass'])) == 0) {
            $this->error = 'Please provide password';
            return false; 
        }

		return true;
    }
	
  
    /**
     * test if form information is valid for login form
     *
     * @param array $formvars the form variables
     */
    function isValidForgotForm($formvars) {

		// reset error message
        $this->error = null;

	
		if(strlen(trim($formvars['forgotuser'])) == 0) {
			$this->error = 'Please provide email (user name)';
			return false; 
		}
		
		if(!$this->validateMail($formvars['forgotuser']))
		{
			$this->error = 'Please provide correct email (user name)';
			return false; 
		}
	
		return true;
    }
	
	function isValidChangeForm($formvars) {

		// reset error message
        $this->error = null;

	
		if(strlen(trim($formvars['email'])) == 0) {
			$this->error = 'Please provide email';
			return false; 
		}
		
		if(!$this->validateMail($formvars['email']))
		{
			$this->error = 'Please provide valid email';
			return false; 
		}
	
		if(strlen(trim($formvars['currentpassword'])) == 0) {
			$this->error = 'Please provide current password';
			return false; 
		}
		
		if(strlen(trim($formvars['newpassword'])) == 0) {
			$this->error = 'Please provide new password';
			return false; 
		}
		
		if(strlen(trim($formvars['newpassword'])) < 6) {
			$this->error = 'New Password should be at least 6 characters long.';
			return false; 
		}
		
		if(strlen(trim($formvars['confirmnewpassword'])) == 0 || trim($formvars['confirmnewpassword']) != trim($formvars['newpassword'])) {
			$this->error = 'New Password and Confirm New Password do not match';
			return false; 
		}
				
		return true;
    }
  
  
    /**
     * test if form information is valid for create new account form
     *
     * @param array $formvars the form variables
     */
    function isValidCreateForm($formvars) {

		// reset error message
        $this->error = null;
/*		if(strlen(trim($formvars['title'])) == " ") {
            $this->error = 'Please Select Title ';
            return false; 
        }*/
		if(strlen(trim($formvars['firstname'])) == 0) {
            $this->error = 'Please provide first name';
            return false; 
        }
		if(strlen(trim($formvars['lastname'])) == 0) {
            $this->error = 'Please provide last name';
            return false; 
        }
		if(strlen(trim($formvars['email'])) == 0) {
            $this->error = 'Please provide email';
            return false; 
        }
		if(!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",trim($formvars['email'])))
		{
            $this->error = 'Please provide a valid email address.';
            return false; 		
		}
		if(strlen(trim($formvars['password'])) == 0) {
			$this->error = 'Please provide the password.';
			return false; 
		}
		elseif(strlen(trim($formvars['password'])) < 6) {
			$this->error = 'Password should be at least 6 characters long.';
			return false; 
		}
		if(strlen(trim($formvars['confirm_password'])) == 0) {
			$this->error = 'Please provide the confirm password.';
			return false; 
		}
        if(trim($formvars['password']) != trim($formvars['confirm_password'])) {
            $this->error = 'Your password and confirm password do not match. Please enter the same password for verification.';
            return false; 
        }
       
		
        return true;
    }
  

  
  	// check if user name already taken  
	function alreadyExists($username)
	{
		return $this->numrows("select email from ".$this->usertblname." where email = '".$username."'");
	}


 
 	// GET FORGOT PASSWORD OF USER AND SEND MAIL TO IT
 
 	function sendForgotPassMail($uemail , $mailserver)
	{
		// GET USER NAME AND PASSWORD
		$res = $this->select("select email , password from ".$this->usertblname." where email = '".$uemail."'");
		/* SEND MAIL TO USER ALONG WITH PASSWORD */
		// object of class send email
		$mail = new SendEmail();
		// send mail to user on successful registration
		// fetch email content
		$query= "Select * from ".$this->tblemails." where emailname = ".$this->mySQLSafe('Forgot Password');
		$result= $this->execute($query);
		$fetch=mysql_fetch_array($result);
		$email_body = $fetch['content'];
		//echo ($email_body);
		$email_body = str_replace('__USERNAME__', $res[0]["email"], $email_body);
		$email_body = str_replace('__PASSWORD__', $res[0]["password"], $email_body);
		if(SENDEMAIL)
		{
			$send = $mail->Send_Email($fetch['fromname'],$fetch['fromemail'],$res[0]['email'],$res[0]['email'],$fetch['subject'],$email_body,$mailserver);
		}
	}
 
 
  	// check if user is valid user  
	function validUser($username , $password)
	{
		if($this->numrows("select username from ".$this->usertblname." where username = '".$username."' and password = '".$password."'"))
		{
			$arrid = $this->getUserId($username , $password);
			//print($arrid[0]['uid']);	
			//exit;
			return $arrid[0]['uid'];
		}
		else
		{
			return 0;
		}	
		
	}

  	// check if user is valid user  
	function validLoginUser($loginArray)
	{
		
		$username = $loginArray['loginuser'];
		$password = $loginArray['loginpass'];
		
		if($this->numrows("select uid from ".$this->usertblname." where email = '".$username."' and password = '".$password."'"))
		{
			$arrid = $this->getUserId($username , $password);
			$_SESSION['userid'] = $arrid[0]['uid'];
			$_SESSION['fname'] = $arrid[0]['firstname'];
			$_SESSION['lname'] = $arrid[0]['lastname'];
			return true;
		}
		else
		{
			$this->error = 'The username and password combination you entered is not valid. Please try again.';
			return false;
		}	
		
	}

	
	// get user id to show existing record
  	function getUserId($username , $password)
	{
		$query = "select uid , firstname , lastname from ".$this->usertblname." where email = '".$username."' and password = '".$password."'";
		return $this->select($query);
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
//		$_query = "select oepid , name from ".$this->table_name." where iscompleted = 'N' and isactive = 'Yes' and enddate > '".date("Y-m-d")."' and deadline > '".date("Y-m-d")."'";
		$_query = "select oepid , name from ".$this->table_name." where isactive = 'Yes' and enddate > '".date("Y-m-d")."' and deadline > '".date("Y-m-d")."'";
		return $this->select($_query);
	}
  



	/*
	*	GET ONLY THOSE PROGRAMMES WHICH ARE NEW FOR APPLICANT.	
	*/

	function getNewProgrammes($uid)
	{
	
		// 	GET THOSE PROGRAMMES WHICH ARE APPLIED BY APPLICANT
		$_query  = "select oepid from ".$this->tablename." where uid = $uid";
		$applied =  $this->select($_query);
		
		$appliedprogramme = "";			
		$proglist = "";
		
		if($applied != null)
		{
			$i = 0;
			foreach($applied as $ap)
			{
				$temp[$i] = $ap['oepid'];
				$i++;
			}	
			
			
			$proglist = implode("," , $temp);
		}	
		
		if($proglist != "")
		{
			$appliedprogramme = " and oepid not in (".$proglist.") ";			
		}
		
		
//		$query = "select oepid , name from ".$this->table_name." where iscompleted = 'N' and isactive = 'Yes' and enddate > '".date("Y-m-d")."' and deadline > '".date("Y-m-d")."'  $appliedprogramme ";
		$query = "select oepid , name from ".$this->table_name." where isactive = 'Yes' and (startdate > '".date("Y-m-d")."' or status='tba')  $appliedprogramme ";
		return $this->select($query);
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
			$addAlumni["username"] 		 	= $this->mySQLSafe( $rec['username']);
			$addAlumni["password"]  	 	= $this->mySQLSafe( $rec['password']);
			$addAlumni["firstname"]  		= $this->mySQLSafe( $rec['firstname']);
			$addAlumni["middlename"]  		= $this->mySQLSafe( $rec['middlename']);
			$addAlumni["lastname"] 			= $this->mySQLSafe( $rec['lastname']);
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
			
			if($aid = $this->in_Alumni($rec['username']))
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
			//$del		=	"delete from ".$this->tablename." where oepaid= ".$rec['oepaid'];
			//$this->execute($del);
		
		}	
			
	}
	
	
	// check if applicant already exists in alumni table
	function in_Alumni($uname)
	{
		$qryalumni = "select aid , numprogrammes from ".$this->redc_alumni." where username = '".$uname."'";
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


	/*
		*** returns programme name 
	*/
	function getProgrammeName($pid)
	{
		
		$query 		= "select name,startdate,enddate,venue from ".$this->table_name." where oepid = $pid" ;
		$prog_name  = $this->select($query);
		return $prog_name[0]['name'];
		
	}

	
	function getAdminEmail()
	{
		$query = "select email from redc_admin where usertype = 'M' or usertype = 'A'";
		$to = $db->select($query);
		return $to;
	}

	function getUserEmail($uid)
	{
		$query 		= "select username from ".$this->usertblname." where uid = $uid" ;
		$user_name  = $this->select($query);
		$this->useremail = $user_name[0]["username"];
	}
	

	/*
	* CHECK IF USER ALREADY APPLIED FOR A PROGRAMME..........................	
	*/
	
	function alreadyapplied($uid , $pid)
	{
		
		$qryattendprog = "select * from ".$this->tablename." where uid = $uid and oepid = $pid";
		$prevprog = $this->select($qryattendprog);
		
		if($prevprog != null)
		{
			return true;
		}
		else
		{
			return false;
		}
				
	}


	/*
	* send email to user , admin
	*/
	function sendEmail($formvars , $flag , $mailserver)
	{
	
		// object of class send email
		$mail = new SendEmail();
		
		// send mail to user on successful registration
		if($flag == 1)
		{
			// fetch email content
			$query= "Select * from ".$this->tblemails." where emailname = ".$this->mySQLSafe('User Registration');
			$result= $this->execute($query);
			$fetch=mysql_fetch_array($result);

			$email_body = $fetch['content'];
			
			$email_body = str_replace('__USERNAME__', $formvars["email"], $email_body);
			
			$email_body = str_replace('__PASSWORD__', $formvars["password"], $email_body);
			if(SENDEMAIL)
			{
				$send = $mail->Send_Email($fetch['fromname'],$fetch['fromemail'],$formvars['email'],$formvars['email'],$fetch['subject'],$email_body,$mailserver);
			}
			
		}
		
		// send email to user when apply for oep programmes as well as notify to admin 
		else if($flag == 2)
		{
			$this->getUserEmail($_SESSION['userid']);
			// fetch email content
			$query= "Select * from ".$this->tblemails." where emailname = ".$this->mySQLSafe('OEP Application Email to User');
			$result= $this->execute($query);
			$fetch=mysql_fetch_array($result);

			$email_body = $fetch['content'];
			
			$email_body = str_replace('__PROGRAMMENAME__', $this->getProgrammeName($formvars["oepprogrammes"]), $email_body);
			
			$email_body = str_replace('__APPLYDATE__', date("d-m-Y"), $email_body);
		
			if(SENDEMAIL)
			{
				$send = $mail->Send_Email($fetch['fromname'],$fetch['fromemail'],$this->useremail,$this->useremail,$fetch['subject'],$email_body,$mailserver);
			}
			
			
			// send email to admin when user apply for oep programmes
			
			// fetch email content
			$query= "Select * from ".$this->tblemails." where emailname = ".$this->mySQLSafe('OEP Application Email to Admin');
			$result= $this->execute($query);
			$fetch=mysql_fetch_array($result);

			$email_body = $fetch['content'];
			
			$email_body = str_replace('__USERNAME__', $formvars["firstname"], $email_body);
			
			$email_body = str_replace('__PROGRAMMENAME__', $this->getProgrammeName($formvars["oepprogrammes"]), $email_body);
			
			$email_body = str_replace('__APPLYDATE__', date("d-m-Y"), $email_body);
		
			
			// get market admin and super admin email
			$admin_email = $this->getAdminEmail();
			
			foreach($admin_email as $e)
			{	
				if(SENDEMAIL)
				{
					$send = $mail->Send_Email($fetch['fromname'],$fetch['fromemail'],$e['firstname'],$e['email'],$fetch['subject'],$email_body,$mailserver);
				}
			}	
			
			
		}
		
	}	
		
		



	// previously attended programmes by specific user
	function prevAttendedProgs($uid , $aid)
	{
		$str = "";
//		$qryattendprog = "select p.name , a.oepaid from ".$this->tablename." as a , ".$this->table_name." as p where a.uid = $uid and a.oepid = p.oepid and a.oepaid != $aid and p.iscompleted = 'Y'";
		$qryattendprog = "select p.name , a.oepaid from ".$this->tablename." as a , ".$this->table_name." as p where a.uid = $uid and a.oepid = p.oepid and a.oepaid != $aid and p.isactive = 'Yes'  AND p.deadline > '".date("Y-m-d")."'";
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

	function createUser($username , $password)
	{
		$userRecord['username']				=	$this->mySQLSafe( $username);
		$userRecord['password']				=	$this->mySQLSafe( $password);
		$this->insert($this->usertblname,$userRecord);
		$userid = $this->insertid();
		return $userid;
	}

    function addEntry($formvars) {
		
		$query = "select * from ".$this->usertblname." where email = '".$formvars['email']."'";
		$fetch = $this->select($query);
		if($fetch!=false){
			$this->error = "This email address is already registered, kindly use another email address.";
			return false;
		}

		$record['firstname']=$this->mySQLSafe($formvars['firstname']);
    	$record['lastname']=$this->mySQLSafe($formvars['lastname']);
    	$record['email']=$this->mySQLSafe($formvars['email']);
    	$record['password']=$this->mySQLSafe($formvars['password']);
		$record['isactive']=$this->mySQLSafe('Y');
		$record['type']=$this->mySQLSafe('oep');
		
		if($this->insert($this->usertblname,$record))
		{
			$uid = $this->insertid();
			$_SESSION['userid'] = $uid;
			$_SESSION['fname'] = $formvars['firstname'];
			$_SESSION['lname'] = $formvars['lastname'];
			//$this->error="User has been added successfully";
			return true;
		}
		else
		{
			$this->error="User was not added";
			return false;
		}
		
    }	


  	 /**
     * add a new Alumni entry
     *
     * @param array $formvars the form variables
     */
    function addEntry_old($formvars , $fk_uid) 
	{
		$fk_user_id = $fk_uid;
		if($formvars['divnum'] == 2)
		{
			// insert user record in redc user personal tbl
			$uprecord['uid']				=	$this->mySQLSafe( $fk_user_id);
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
			return true;
		}
		else
		if($formvars['divnum'] == 3)
		{
			// insert user record in redc user contact tbl
			$ucrecord['uid']					=	$this->mySQLSafe( $fk_user_id);
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
			return true;
		}
		else
		if($formvars['divnum'] == 4)
		{
			// insert user record in redc user organization tbl
			$uorecord['uid']						=	$this->mySQLSafe( $fk_user_id);
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
			return true;
		}
		else
		if($formvars['divnum'] == 5)
		{
			// insert user record in redc user professional tbl
			$uprrecord['uid']				=	$this->mySQLSafe( $fk_user_id);
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
			$uprrecord['university']		=	$this->mySQLSafe( $formvars['university']);    
			$uprrecord['year']				=	$this->mySQLSafe( $formvars['year']);      
			$uprrecord['degree']			=	$this->mySQLSafe( $formvars['degree']);    
			$uprrecord['objectives']		=	$this->mySQLSafe( $formvars['objectives']);  
			$this->insert($this->user_profess_tbl,$uprrecord);
			return true;
		}
		else
		if($formvars['divnum'] == 6)
		{
			// insert user record in redc user sponsors tbl
			$usrecord['uid']					=	$this->mySQLSafe( $fk_user_id);
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
			$usrecord['name']					=	$this->mySQLSafe( $formvars['name']);    
			$usrecord['invoicetelephone']		=	$this->mySQLSafe( $formvars['invoicetelephone']);    
			$usrecord['invoicefax']				=	$this->mySQLSafe( $formvars['invoicefax']);    
			$usrecord['invoiceemail']			=	$this->mySQLSafe( $formvars['invoiceemail']);    
			$usrecord['invoicewebsite']			=	$this->mySQLSafe( $formvars['invoicewebsite']);    			
			$usrecord['executivename']			=	$this->mySQLSafe( $formvars['executivename']);    
			$usrecord['executivedesignation']	=	$this->mySQLSafe( $formvars['executivedesignation']);    
			$usrecord['executiveaddress']		=	$this->mySQLSafe( $formvars['executiveaddress']);    
			$usrecord['executivetelephone']		=	$this->mySQLSafe( $formvars['executivetelephone']);    
			$usrecord['executivefax']			=	$this->mySQLSafe( $formvars['executivefax']);    
			$usrecord['executiveemail']			=	$this->mySQLSafe( $formvars['executiveemail']);    
			$usrecord['executivewebsite']		=	$this->mySQLSafe( $formvars['executivewebsite']);    
			$usrecord['informemail']			=	$this->mySQLSafe( $formvars['informemail']);    
			$this->insert($this->user_sponsor_tbl,$usrecord);
			return true;
		}
		else
		if($formvars['divnum'] == 7)
		{
			// insert user record in redc user information tbl
			$uirecord['uid']					=	$this->mySQLSafe( $fk_user_id);
			$uirecord['learnabout']				=	$this->mySQLSafe( $formvars['learnabout']);    
			if($this->insert($this->user_inform_tbl,$uirecord) > 0 ) 
			{				
				// insert user record in applicants table
				$record['oepid']				=	$this->mySQLSafe( $formvars['oepprogrammes']);
				$record['uid']					=	$this->mySQLSafe($fk_user_id);
				$record['iscomplete']			=	$this->mySQLSafe( "No");
				$record['applicationstatus']	=	$this->mySQLSafe( $formvars['applicationstatus']);
				$record['registrationdate']		=	$this->mySQLSafe( date("Y-m-d"));

				if($this->insert($this->tablename,$record) > 0)
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
		}
		
		/*
		// insert user record in redc user tbl
		$userRecord['username']				=	$this->mySQLSafe( $formvars['username']);
		$userRecord['password']				=	$this->mySQLSafe( $formvars['password']);
		$this->insert($this->usertblname,$userRecord);
		*/
		// insert user record in redc applicants tbl
		//$fk_user_id = $this->insertid();
		
		// COMMENTED CODE
		/*
		$record['oepid']				=	$this->mySQLSafe( $formvars['oepprogrammes']);
		$record['uid']					=	$this->mySQLSafe($fk_user_id);
		$record['iscomplete']			=	$this->mySQLSafe( "No");
		$record['applicationstatus']	=	$this->mySQLSafe( $formvars['applicationstatus']);
		$record['registrationdate']		=	$this->mySQLSafe( date("Y-m-d"));
		$this->insert($this->tablename,$record);
	
		// insert user record in redc user personal tbl
		$uprecord['uid']				=	$this->mySQLSafe( $fk_user_id);
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
		$ucrecord['uid']					=	$this->mySQLSafe( $fk_user_id);
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
		$uorecord['uid']						=	$this->mySQLSafe( $fk_user_id);
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
		$uprrecord['uid']				=	$this->mySQLSafe( $fk_user_id);
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
		$uprrecord['university']		=	$this->mySQLSafe( $formvars['university']);    
		$uprrecord['year']				=	$this->mySQLSafe( $formvars['year']);      
		$uprrecord['degree']			=	$this->mySQLSafe( $formvars['degree']);    
		$uprrecord['objectives']		=	$this->mySQLSafe( $formvars['objectives']);  
		$this->insert($this->user_profess_tbl,$uprrecord);

		// insert user record in redc user sponsors tbl
		$usrecord['uid']					=	$this->mySQLSafe( $fk_user_id);
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
		$this->insert($this->user_sponsor_tbl,$usrecord);

		// insert user record in redc user information tbl
		$uirecord['uid']					=	$this->mySQLSafe( $fk_user_id);
		$uirecord['learnabout']				=	$this->mySQLSafe( $formvars['learnabout']);    
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
		
		*/
	}  

	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
		/*
		$_query = "select * from " . $this->tablename." as a , ".$this->table_name." as p , ".$this->usertblname." as u , ".$this->user_contact_tbl." as uc , ".$this->user_personal_tbl." as upe , ".$this->user_profess_tbl." as upr , ".$this->user_org_tbl." as uog , ".$this->user_sponsor_tbl." as usp , ".$this->user_inform_tbl." as uif where u.uid = $id and a.uid = u.uid and a.oepid = p.oepid and uc.uid = u.uid and upe.uid = u.uid and upr.uid = u.uid and uog.uid = u.uid and usp.uid = u.uid and uif.uid = u.uid";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			foreach($fetch as $f)
				$data = $f;
		}
		*/
		
//		$_query = "select p.*, u.uid as userid from ".$this->user_personal_tbl ." as p, ".$this->usertblname." as u where p.uid = u.uid and p.uid = ".$id;

/*		$_query = "select * from ".$this->usertblname." u where u.uid = ".$id."
					left join ".$this->user_personal_tbl." p on u.uid = p.uid 
					left join ".$this->user_contact_tbl." c on u.uid = c.uid
					left join ".$this->user_org_tbl." o on u.uid = o.uid
					left join ".$this->user_profess_tbl." pr on u.uid = pr.uid
					left join ".$this->user_sponsor_tbl." s on u.uid = s.uid
					left join ".$this->user_inform_tbl." i on u.uid = i.uid
				  ";
*/				  
		$personal_data = array();
		$contact_data = array();
		$organizational_data = array();
		$professional_data = array();
		$sponsorship_data = array(); 
		$information_data = array();
		
		// get personal data
		$_query = "select p.* from ".$this->usertblname." u inner join ".$this->user_personal_tbl." p on u.uid = p.uid and u.uid = ".$id;
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			foreach($fetch as $f)
			{
				$personal_data = $f;
			}
		}
		// get contact data
		$_query = "select c.* from ".$this->usertblname." u inner join ".$this->user_contact_tbl." c on u.uid = c.uid and u.uid = ".$id;
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			foreach($fetch as $f)
			{
				$contact_data = $f;
			}
		}
		// get organizational data
		$_query = "select o.* from ".$this->usertblname." u inner join ".$this->user_org_tbl." o on u.uid = o.uid and u.uid = ".$id;
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			foreach($fetch as $f)
			{
				$organizational_data = $f;
			}
		}
		
		// get profressional data
		$_query = "select p.* from ".$this->usertblname." u inner join ".$this->user_profess_tbl." p on u.uid = p.uid and u.uid = ".$id;
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			foreach($fetch as $f)
			{
				$professional_data = $f;
			}
		}

		// get sponsorship data
		$_query = "select s.* from ".$this->usertblname." u inner join ".$this->user_sponsor_tbl." s on u.uid = s.uid and u.uid = ".$id;
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			foreach($fetch as $f)
			{
				$sponsorship_data = $f;
			}
		}
		// get information data
		$_query = "select i.* from ".$this->usertblname." u inner join ".$this->user_inform_tbl." i on u.uid = i.uid and u.uid = ".$id;
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			foreach($fetch as $f)
			{
				$information_data = $f;
			}
		}

		$data = array_merge($personal_data, $contact_data, $organizational_data, $professional_data, $sponsorship_data, $information_data);
        return $data; 
	}  
	
 	
	function changePassword($formvars, $id)
	{
		$w = " uid = ".$id;
		$uprecord['password']		=	$this->mySQLSafe( $formvars['newpassword_password']);
		if($this->update($this->usertblname,$uprecord , $w))
		{
			$this->error="Password has been changed";
			return true;			
		}
		else
		{
			$this->error="Password was not changed";
			return false;	
		}
	}
	
	
	
	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$id) {

		$w = " uid = ".$id;
		
		if($formvars['divnum'] == 2)
		{
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
			return true;
		}
		else
		if($formvars['divnum'] == 3)
		{
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
			return true;
		}
		else
		if($formvars['divnum'] == 4)
		{
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
			return true;
		}
		else
		if($formvars['divnum'] == 5)
		{
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
			$uprrecord['university']		=	$this->mySQLSafe( $formvars['university']);    
			$uprrecord['year']				=	$this->mySQLSafe( $formvars['year']);      
			$uprrecord['degree']			=	$this->mySQLSafe( $formvars['degree']);    
			$uprrecord['objectives']		=	$this->mySQLSafe( $formvars['objectives']);  
			$this->update($this->user_profess_tbl,$uprrecord , $w);
			return true;
		}
		else
		if($formvars['divnum'] == 6)
		{
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
			$usrecord['name']					=	$this->mySQLSafe( $formvars['name']);    
			$usrecord['invoicetelephone']		=	$this->mySQLSafe( $formvars['invoicetelephone']);    
			$usrecord['invoicefax']				=	$this->mySQLSafe( $formvars['invoicefax']);    
			$usrecord['invoiceemail']			=	$this->mySQLSafe( $formvars['invoiceemail']);    
			$usrecord['invoicewebsite']			=	$this->mySQLSafe( $formvars['invoicewebsite']);    
			$usrecord['executivename']			=	$this->mySQLSafe( $formvars['executivename']);    
			$usrecord['executivedesignation']	=	$this->mySQLSafe( $formvars['executivedesignation']);    
			$usrecord['executiveaddress']		=	$this->mySQLSafe( $formvars['executiveaddress']);    
			$usrecord['executivetelephone']		=	$this->mySQLSafe( $formvars['executivetelephone']);    
			$usrecord['executivefax']			=	$this->mySQLSafe( $formvars['executivefax']);    
			$usrecord['executiveemail']			=	$this->mySQLSafe( $formvars['executiveemail']);    
			$usrecord['executivewebsite']		=	$this->mySQLSafe( $formvars['executivewebsite']);    
			$usrecord['informemail']			=	$this->mySQLSafe( $formvars['informemail']);    
			$this->update($this->user_sponsor_tbl,$usrecord , $w);
			return true;
		}		
		else
		if($formvars['divnum'] == 7)
		{
			$uirecord['learnabout']				=	$this->mySQLSafe( $formvars['learnabout']);    
			if($this->update($this->user_inform_tbl,$uirecord , $w) > 0 ) 
			{
				$record['oepid']				=	$this->mySQLSafe( $formvars['oepprogrammes']);
				$record['uid']					=	$this->mySQLSafe($id);
				$record['iscomplete']			=	$this->mySQLSafe( "No");
				$record['applicationstatus']	=	$this->mySQLSafe( $formvars['applicationstatus']);
				$record['registrationdate']		=	$this->mySQLSafe( date("Y-m-d"));
				if($this->insert($this->tablename,$record) > 0)
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
		}
		
/*		echo "<pre>";
			print_r($_REQUEST);
		echo "</pre>";
		exit;
*/


/*		$userRecord['username']			=	$this->mySQLSafe( $formvars['username']);
		$userRecord['password']			=	$this->mySQLSafe( $formvars['password']);
		$w = " uid = ".$formvars['uid'];
		// insert user record in redc user tbl
		$this->update($this->usertblname,$userRecord , $w);
*/		
		
		// COMMENTED CODE
		/*
		$record['oepid']				=	$this->mySQLSafe( $formvars['oepprogrammes']);
		$record['uid']					=	$this->mySQLSafe($id);
		$record['iscomplete']			=	$this->mySQLSafe( "No");
		$record['applicationstatus']	=	$this->mySQLSafe( $formvars['applicationstatus']);
		$record['registrationdate']		=	$this->mySQLSafe( date("Y-m-d"));
		$this->insert($this->tablename,$record);
		
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
		$uprrecord['university']		=	$this->mySQLSafe( $formvars['university']);    
		$uprrecord['year']				=	$this->mySQLSafe( $formvars['year']);      
		$uprrecord['degree']			=	$this->mySQLSafe( $formvars['degree']);    
		$uprrecord['objectives']		=	$this->mySQLSafe( $formvars['objectives']);  
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
		$this->update($this->user_sponsor_tbl,$usrecord , $w);

		$uirecord['learnabout']				=	$this->mySQLSafe( $formvars['learnabout']);    
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
		*/
    }

	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($id=0)
	{
		
		// delete applicant programme
		$_query		=	"delete from ".$this->tablename." where oepaid=$id";
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
			if($formvars['sortcolumn'] == 'username')
				$sortfield = "u.".$formvars['sortcolumn'];
			else if($formvars['sortcolumn'] == 'name')
				$sortfield = "p.".$formvars['sortcolumn'];
			else if($formvars['sortcolumn'] == 'registrationdate')		
				$sortfield = "a.".$formvars['sortcolumn'];
			else if($formvars['sortcolumn'] == 'oepaid')
				$sortfield = "a.".$formvars['sortcolumn'];
				
			$this->sortcolumn=$sortfield;
			$orderby=" order by '". $this->sortcolumn ."' ". $this->sortdirection;
			$this->sortdirection=$formvars['sortdirection'];
		}else if(isset($_GET['sc']) && isset($_GET['sd']))
		{
			$this->sortcolumn=$_GET['sc'];
			$this->sortdirection=$_GET['sd'];
		}
		else
			$orderby=" order by a.". $this->sortcolumn ." ". $this->sortdirection;
		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows("select oepaid from ".$this->tablename);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		///Sort order
		//$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
/*		if(($formvars['search_by_cname']!='') && ($formvars['search_by_pname']!=''))
		{
          	$where.=" where name = '".$formvars['search_by_pname']."' AND director = '".$formvars['search_by_email']."'";
	    }
*/		

		$where = " where  a.uid = u.uid and a.oepid = p.oepid";
		
		if(($formvars['search_by_uname']!='') && ($formvars['search_by_pname']!=''))
		{
			$this->searchbyuname 		= $formvars['search_by_uname'];
			$tmpuname = $formvars['search_by_uname']."%";
			$this->searchbypname 	= $formvars['search_by_pname'];
			$tmppname = $formvars['search_by_pname']."%";
			$where	.= " and p.name like ".$this->mySQLSafe($tmppname)." and u.username like ".$this->mySQLSafe($tmpuname);
		}

		else if(isset($formvars['search_by_uname']) && $formvars['search_by_uname']!='')
		{
          	$this->searchbyuname 	= $formvars['search_by_uname'];
			$tmpuname = $formvars['search_by_uname']."%";
			$where .=" and u.username like ".$this->mySQLSafe($tmpuname);
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
		$_query = "select * from " . $this->tablename." as a , ".$this->table_name." as p , ".$this->usertblname." as u ". $where . $orderby ."  Limit $paging->start,$paging->limit";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data=$fetch;
		}
		else
		{
		   $this->error="No Applicants found.";
		   $data=null;
		}
	    return $data;   
    }
   
   function getEmail($id)
   {
   		$query = "select username from ".$this->usertblname." where uid = $id";
		$f = $this->select($query);
		return $f[0]['username'];
   }
   
   function getInformationSource($uid)
   {
		$_query = "select * from ".$this->user_inform_tbl." where uid = ".$uid;
		$f = $this->select($_query);
		if($f != false)
		{
			return true;	
		}
		else
		{
			return false;	
		}
   }
   
   function updatePassword($formvars)
	{
		$currentPassword = "";
		$query = "select password from ".$this->usertblname." where email = ".$this->mySQLSafe($formvars['email']);
		$f = $this->select($query);
		$currentPassword = $f[0]['password'];
		
		if($currentPassword == $formvars['currentpassword'])
		{
			$record["password"] = $this->mySQLSafe($formvars['newpassword']);
			$w = " email = ".$this->mySQLSafe($formvars['email']);
			$this->update($this->usertblname,$record, $w);
			return true;
		}		
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
		
		if($_REQUEST['action'] != 'add' && $_REQUEST['mode'] != 'add')
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
		$this->tpl->assign('pid' , $this->parentid);
		$this->tpl->assign('programme', $this->getProgrammes());
		$this->tpl->assign('countries', $this->getCountries());
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('login.tpl');
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
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('login.tpl');        
    }
}

?>