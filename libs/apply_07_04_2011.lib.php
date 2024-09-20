<?php

/**
 * Podcast Audio Management application library
 *
 */
class Apply extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = array();
	
	///Class varibles
	var $pageview=null;
	var $steps=null;
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
	var $userfirstname;
	var $userlastname;	
	var $oepaid = null;
	var $pid = null;
	var $userid = null;
    /**
     * class constructor
     */
    function Apply() {
		
        if(isset($_REQUEST['oepaid']) && $_REQUEST['oepaid'] != "")
		{
			$this->oepaid = $_REQUEST['oepaid'];
		}
		
		if(!isset($_SESSION['userid']) || $_SESSION['userid'] == "")
		{
		  if(isset($_REQUEST['pid']) && $_REQUEST['pid'] != "")
		  {
		  		$_SESSION['pid'] = $_REQUEST['pid'];	
		  }
		  
		  header("Location:login.php");
		  exit;
		}
		else
		{
			$this->userid = $_SESSION['userid'];
		}
		if(!isset($_REQUEST['pid']) || $_REQUEST['pid'] == "")
		{
			if(isset($_SESSION['pid']) && $_SESSION['pid'] != "")
			{
				header("Location:apply.php?pid=$_SESSION[pid]#apply");
				unset($_SESSION['pid']);
				exit;	
			}
			else
			{
				header("Location:calendar.php");
				exit;
			}	
		}
		else
		{
			$this->pid  = decrypt($_REQUEST['pid']);
			
			if(!is_numeric($this->pid))
			{
				header("Location:calendar.php?action=error");
				exit;
			}
			
		}
		
		$this->tpl = new Smarty;
		$this->db();
		if(!$this->isvalidProgramme($this->pid))
		{
			header("Location:calendar.php?action=error");	
			exit;
		}
    }
   
   
   function redirect()
   {
   		if(isset($_SESSION['userid']) && $_SESSION['userid'] != "")
		{
		  header("Location:index.php");
		  exit;
		}		
   }
   
   function sess_exp_redirect()
   {
   		unset($_SESSION['userid']);
		unset($_SESSION['fname']);
		unset($_SESSION['lname']);
		unset($_SESSION['pid']);
		header("Location:login.php");
		exit;
   }
   
   function isvalidProgramme($pid)
   {
	   	$pdata = $this->getProgrammeData($pid);
		if($pdata[0]['isactive'] == 'Yes' /*&&  $pdata[0]['deadline'] > date("Y-m-d")*/ && $pdata[0]['enddate'] > date("Y-m-d"))
		{ 
			return true;
		}
		else
		{
			return false;   
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
        $this->error = array();
		
		if($formvars["steps"] == "personal")
		{
			if(strlen(trim($formvars['gender'])) == 0) {
            	$this->error["gender"] = 'Please provide gender';
            	//return false; 
        	}
			/*
			if(strlen(trim($formvars['nationality'])) == 0) {
				$this->error["nationality"] = 'Please provide nationality';
				//return false; 
			}
			*/
			if(strlen(trim($formvars['emergencyname'])) == 0) {
				$this->error["emergencyname"] = 'Please provide emergency name';
				//return false; 
			}
			if(strlen(trim($formvars['emergencyphone'])) == 0) {
				$this->error["emergencyphone"] = 'Please provide emergency phone';
				//return false; 
			}
		}
		
		else if($formvars["steps"] == "contact")
		{
			if(strlen(trim($formvars['contactdesignation'])) == 0) {
            	$this->error["contactdesignation"] = 'Please provide designation';
            	//return false; 
       		}
			if(strlen(trim($formvars['companyname'])) == 0) {
				$this->error["companyname"] = 'Please provide company name';
				//return false; 
			}
			if(strlen(trim($formvars['companyaddress'])) == 0) {
				$this->error["companyaddress"] = 'Please provide company address';
				//return false; 
			}
			if(strlen(trim($formvars['country'])) == 0) {
				$this->error["country"] = 'Please provide country';
				//return false; 
			}
			if(strlen(trim($formvars['ctelephone'])) == 0) {
				$this->error["ctelephone"] = 'Please provide telephone';
				//return false; 
			}
		}

		else if($formvars["steps"] == "organizational")
		{	
			if(strlen(trim($formvars['parentservices'])) > 300) {
				$this->error["parentservices"] = 'Please provide Products/Services with max 300 characters';
				//return false; 
			}
		
			if(strlen(trim($formvars['parentnumemployees'])) > 0) {
	
				if(!ereg("^[0-9]+$", trim($formvars['parentnumemployees']))) {
				  $this->error["parentnumemployees"] = 'Please provide an integer value for number of employees';
				  //return false; 
				} 
			} 
			
			
			if(strlen(trim($formvars['services'])) > 300) {
				$this->error["services"] = 'Please provide Products/Services with max 300 characters';
				//return false; 
			}
			
			if(strlen(trim($formvars['numemployees'])) == 0) {
				$this->error["numemployees"] = 'Please provide number of employees';
				//return false; 
			}
			
			if(!ereg("^[0-9]+$", trim($formvars['numemployees']))) {
			  $this->error["numemployees"] = 'Please provide an integer value for number of employees';
				//return false; 
			} 
			
			if(strlen(trim($formvars['numemployeessupervision'])) == 0) {
				$this->error["numemployeessupervision"] = 'Please provide how many employees are under your direct supervision?';
				//return false; 
			}
			
			if(!ereg("^[0-9]+$", trim($formvars['numemployeessupervision']))) {
			  $this->error["numemployeessupervision"] = 'Please provide a number value for number of employees';
				//return false; 
			} 
			
			if(strlen(trim($formvars['reportperson'])) == 0) {
				$this->error["reportperson"] = 'Please provide what is the title position of the person to whom you report?';
				//return false; 
			}

			if(strlen(trim($formvars['industry'])) == 0) {
				if(strlen(trim($formvars['industryother'])) == 0)
				{
					$this->error["industryother"] = 'Please select your current industry or spcify other';
					//return false; 
				}	
			}

			if(strlen(trim($formvars['position'])) == 0) {
				if(strlen(trim($formvars['positionother'])) == 0)
				{
					$this->error["positionother"] = 'Please select your current position or spcify other';
					//return false; 
				}	
			}

			
		}
		
		else if($formvars["steps"] == "professional")
		{	
			if(strlen(trim($formvars['company1'])) == 0) {
				$this->error["company1"] = 'Please provide name of company';
				//return false; 
			}
			if(strlen(trim($formvars['position1'])) == 0) {
				$this->error["position1"] = 'Please provide title/position';
				//return false; 
			}
			if(strlen(trim($formvars['from1'])) == 0) {
				$this->error["from1"] = 'Please provide from date';
				//return false; 
			}
			if(strlen(trim($formvars['to1'])) == 0) {
				$this->error["to1"] = 'Please provide to date';
				//return false; 
			}
			
			
			/* commnented on 07/01/2010
			if(strtotime($formvars['to1']) < strtotime($formvars['from1']))
			{
				$this->error["to1"] = 'Please provide valid end date';
				//return false; 
			}
			*/
			if(strlen(trim($formvars['numyearsexp'])) == 0) {
				$this->error["numyearsexp"] = 'Please provide total number of years of professional experience';
				//return false; 
			}
	
			if(!ereg("^[0-9]+$", trim($formvars['numyearsexp']))) {
			  $this->error["numyearsexp"] = 'Please provide a number value for total number of years of professional experience';
				//return false; 
			}
	/*******************************************************************************************************/
			if(strlen(trim($formvars['responsibility'])) == 0) {
				$this->error["responsibility"] = 'Please provide current responsibilities including your level in the organization';
				//return false; 
			}
			if(strlen(trim($formvars['responsibility'])) > 300) {
				$this->error["responsibility"] = 'Please provide current responsibilities with max of 300 characters';
				//return false; 
			}
			
			if(strlen(trim($formvars['mgtlevel'])) == 0) {
				if(strlen(trim($formvars['mgtlevel_other'])) == 0) {
					$this->error["mgtlevel_other"] = 'Please specify other';	
				}
				//return false; 
			}
			
			if(strlen(trim($formvars['university'])) == 0) {
				$this->error["university"] = 'Please provide university name';
				//return false; 
			}
			if(strlen(trim($formvars['year'])) == 0) {
				$this->error["year"] = 'Please provide year';
				//return false; 
			}
			if(strlen(trim($formvars['degree'])) == 0) {
				$this->error["degree"] = 'Please provide degree (Highest level attended)';
				//return false; 
			}
			if(strlen(trim($formvars['objectives'])) == 0) {
				$this->error["objectives"] = 'Please provide objectives of attending this programme';
				//return false; 
			}
			if(strlen(trim($formvars['objectives'])) > 300) {
				$this->error["objectives"] = 'Please provide objectives with max of 300 characters';
				//return false; 
			}
		}

		else if($formvars["steps"] == "sponsorship")
		{	
			if(strlen(trim($formvars['name'])) == 0) {
            $this->error["name"] = 'Please provide name';
            //return false; 
			}
			if(strlen(trim($formvars['designation'])) == 0) {
				$this->error["designation"] = 'Please provide designation';
				//return false; 
			}
			if(strlen(trim($formvars['address'])) == 0) {
				$this->error["address"] = 'Please provide address';
				//return false; 
			}
			if(strlen(trim($formvars['address'])) > 300) {
				$this->error["address"] = 'Please provide address with max 300 characters';
				//return false; 
			}
	
			if(strlen(trim($formvars['telephone'])) == 0) {
				$this->error["telephone"] = 'Please provide telephone';
				//return false; 
			}
			if(strlen(trim($formvars['email'])) == 0) {
				$this->error["email"] = 'Please provide email';
				//return false; 
			}
			if(!$this->validateMail($formvars['email']))
			{
				$this->error["email"] = 'Please provide correct email ';
				//return false; 
			}
			
			/*if(strlen(trim($formvars['invoicename'])) == 0) {
				$this->error[""] = 'Please provide name';
				return false; 
			}
			if(strlen(trim($formvars['invoicedesignation'])) == 0) {
				$this->error[""] = 'Please provide designation';
				return false; 
			}
			if(strlen(trim($formvars['invoiceaddress'])) == 0) {
				$this->error[""] = 'Please provide address';
				return false; 
			}
			if(strlen(trim($formvars['invoiceaddress'])) > 300) {
				$this->error[""] = 'Please provide address with max 300 characters';
				return false; 
			}
	
			if(strlen(trim($formvars['invoicetelephone'])) == 0) {
				$this->error[""] = 'Please provide telephone';
				return false; 
			}
			if(strlen(trim($formvars['invoiceemail'])) == 0) {
				$this->error[""] = 'Please provide email';
				return false; 
			}
			if(!$this->validateMail($formvars['invoiceemail']))
			{
				$this->error[""] = 'Please provide correct email ';
				return false; 
			}*/
			/*
			if(strlen(trim($formvars['executivename'])) == 0) {
				$this->error["executivename"] = 'Please provide name';
				//return false; 
			}
			if(strlen(trim($formvars['executivedesignation'])) == 0) {
				$this->error["executivedesignation"] = 'Please provide designation';
				//return false; 
			}
			if(strlen(trim($formvars['executiveaddress'])) == 0) {
				$this->error["executiveaddress"] = 'Please provide address';
				//return false; 
			}
			if(strlen(trim($formvars['executiveaddress'])) > 300) {
				$this->error["executiveaddress"] = 'Please provide address with max 300 characters';
				//return false; 
			}
	
			if(strlen(trim($formvars['executivetelephone'])) == 0) {
				$this->error["executivetelephone"] = 'Please provide telephone';
				//return false; 
			}
			if(strlen(trim($formvars['executiveemail'])) == 0) {
				$this->error["executiveemail"] = 'Please provide email';
				//return false; 
			}
			if(!$this->validateMail($formvars['executiveemail']))
			{
				$this->error["executiveemail"] = 'Please provide correct email ';
				//return false; 
			}
			if(!isset($formvars['availresidence']) or empty($formvars['availresidence'])) {
				$this->error["availresidence"] = 'Please provide this field';
				//return false; 
			}
			*/
			if(!$this->validateMail($formvars['executiveemail']) && strlen($formvars['executiveemail']) > 0)
			{
				$this->error["executiveemail"] = 'Please provide correct email ';
				//return false; 
			}
		}
		else if($formvars["steps"] == "information")
		{
			if(strlen(trim($formvars['learnabout'])) == 0) {
				$this->error["learnabout"] = 'Please specify how did you learn about us.';	
			}
			else if($formvars['learnabout'] == 'other') {
				if(strlen(trim($formvars['learnabout_other'])) == 0) {
					$this->error["learnabout_other"] = 'Please specify other';	
				}
				//return false; 
			}
		}
		else
		{
			return true;
		}	
		
		
			if($this->error != null or !empty($this->error))
			{
				return false;
			}
			else
			{
				return true;
			}	

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

	// load user incomplete application data
	function loadIncompleteData($formvars)
	{
		// here will be a code for user incomplete data
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
		$email_body = str_replace('$$UserName$$', $res[0]["email"], $email_body);
		$email_body = str_replace('$$Password$$', $res[0]["password"], $email_body);
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
		$query = "select uid from ".$this->usertblname." where email = '".$username."' and password = '".$password."'";
		return $this->select($query);
	}
	

	// get user incomplete application
  	function getUserIncompleteApplication()
	{		
		$query = "select p.name, p.startdate, p.enddate , p .oepid ,  a.oepaid , a.iscomplete , a.applicationstatus from ".$this->table_name." as p , ".$this->tablename." as a where a.oepid = p.oepid and a.iscomplete = 'No' and a.uid = '".$this->userid."'";	

		return $this->select($query);
	}

	// get user incomplete application
  	function countUserIncompleteApplication()
	{
		$query = "select oepaid from ".$this->tablename." where uid = $this->userid and iscomplete = 'No' ";
		return $this->numrows($query);
	}

  	function getUserIncomplete()
	{
		$query = "select oepaid from ".$this->tablename." where iscomplete = 'No' and uid = '".$this->userid."' order by registrationdate ASC limit 1 ";
		return $this->select($query);
	}



  	function getUserIncompleteWithoutCurrent()
	{
		$query = "select oepaid from ".$this->tablename." where iscomplete = 'No' and uid = '".$this->userid."' and oepaid != $this->oepaid";	
		return $this->select($query);
	}


	function countUserIncompleteWithoutCurrent()
	{
		$query = "select oepaid from ".$this->tablename." where uid = $this->userid and iscomplete = 'No' and oepaid != $this->oepaid";
		return $this->numrows($query);
	}

	// get user completed application
  	function getUserCompleteApplication()
	{
		$query = "select p.name, p.startdate, p.enddate , p .oepid ,  a.oepaid , a.iscomplete , a.applicationstatus from ".$this->table_name." as p , ".$this->tablename." as a where a.oepid = p.oepid and a.iscomplete = 'Yes' and a.uid = '".$this->userid."'";	
		return $this->select($query);
	}

	// get user general information
	function getUserInfo()
	{
		$query 		= "select * from ".$this->usertblname." where uid = '".$this->userid."'" ;
		$user_info  = $this->select($query);
		foreach($user_info as $uinfo)
		{
			$user = $uinfo;
		}
		return $user;
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

	/*
		*** returns programme data 
	*/
	function getProgrammeData($pid)
	{
		
		$query 		= "select name,startdate,enddate,venue,isactive,deadline from ".$this->table_name." where oepid = $pid" ;
		$prog_name  = $this->select($query);
		return $prog_name;
		
	}


	
	function getAdminEmail()
	{
		$query = "select email from redc_admin where usertype = 'M' or usertype = 'A'";
		$to = $this->select($query);
		return $to;
	}

	function getUserEmail($uid)
	{
		$query 		= "select email from ".$this->usertblname." where uid = $uid" ;
		$user_name  = $this->select($query);
		$this->useremail = $user_name[0]["email"];
	}
	
	function getUserName($uid)
	{
		$query 		= "select firstname, lastname from ".$this->usertblname." where uid = $uid" ;
		$user_name  = $this->select($query);
		$this->userfirstname = $user_name[0]["firstname"];
		$this->userlastname = $user_name[0]["lastname"];		
	}
	

	/*
	* CHECK IF USER ALREADY APPLIED FOR A PROGRAMME..........................	
	*/
	
	function alreadyapplied()
	{
		
		$qryattendprog = "select * from ".$this->tablename." where uid = $this->userid and oepid = $this->pid";
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
			$this->getUserName($_SESSION['userid']);
			// fetch email content
			
			$query= "Select * from ".$this->tblemails." where emailname = ".$this->mySQLSafe('OEP Application Email to User');
			$result= $this->execute($query);
			$fetch=mysql_fetch_array($result);
			
			$email_body = $fetch['content'];
			
			$email_body = str_replace('__FIRSTNAME__', $this->userfirstname, $email_body);
			
			$email_body = str_replace('__LASTNAME__', $this->userlastname, $email_body);
			

		
			
			//echo $fetch['fromname'].$fetch['fromemail'].$this->useremail.$this->useremail.$fetch['subject'].$email_body.$mailserver;
			//$send = $mail->Send_Email($fetch['fromname'],$fetch['fromemail'],$this->useremail,$this->useremail,$fetch['subject'],$email_body,$mailserver);
			

			if(SENDEMAIL)
			{
				$send = $mail->Send_Email($fetch['fromname'], $fetch['fromemail'],$this->useremail,$this->useremail,$fetch['subject'],$email_body,$mailserver);
			}
			
			// send email to admin when user apply for oep programmes
			
			// fetch email content
			$query= "Select * from ".$this->tblemails." where emailname = ".$this->mySQLSafe('OEP Application Email to Admin');
			$result= $this->execute($query);
			$fetch=mysql_fetch_array($result);

			$email_body = $fetch['content'];
			
			$email_body = str_replace('__USERNAME__', $this->useremail, $email_body);
			
			$email_body = str_replace('__PROGRAMMENAME__', $this->getProgrammeName($this->pid), $email_body);
			
			$email_body = str_replace('__APPLYDATE__', date("d-m-Y"), $email_body);
		
			$email_body = str_replace('__APPLICATIONDETAIL__', file_get_contents(SITE_URL."/oepapplicant.php?oepaid=".$formvars['oepaid']), $email_body);
//				echo $email_body;exit;
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


 	function recordExists($tbl)
	{
		if($this->numrows("select oepaid from ".$tbl." where oepaid = '".$this->oepaid."'"))
		{
			return true;
		}
		else
			return false;
	}
 
 	function getAppID()
	{
		$qry = "select oepaid from ".$tbl." where oepid = '".$this->pid."' and uid = '".$this->userid."' and iscomplete != 'Yes'";
		if($this->numrows($qry))
		{
			$arr = $this->select($qry);
			return $arr[0]['oepaid'];
		}
		else
			return false;
	}
 
  	 /**
     * add a new Alumni entry
     *
     * @param array $formvars the form variables
     */
    function addEntry($formvars) 
	{
		$fk_oepaid = $this->oepaid;
		if(!$fk_oepaid)
		{
			
			if($this->getAppID())
			{
				$this->oepaid = $this->getAppID();
			}
			else
			{
				$oeprecord["oepid"] = $this->mySQLSafe( $this->pid);
				$oeprecord["uid"] = $this->mySQLSafe( $this->userid);
				$oeprecord["iscomplete"] = $this->mySQLSafe(" No ");
				$oeprecord["registrationdate"] = $this->mySQLSafe(date("Y-m-d"));
				$this->insert($this->tablename,$oeprecord);
				$fk_oepaid = $this->insertid();
				//$_SESSION['oepaid'] = $fk_oepaid;
				
				$this->oepaid = $fk_oepaid;
				
			}
		}
		
		$where = $this->oepaid;
		
		if($formvars["steps"] == "personal")
		{
			if($this->recordExists($this->user_personal_tbl))
			{
				$this->updateEntry($formvars , $where);
				return true;
			}
			else
			{
				// insert user record in redc user personal tbl
			$uprecord['oepaid']				=	$this->mySQLSafe( $this->oepaid);
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
		}
				
		
		else if($formvars["steps"] == "contact")
		{
			if($this->recordExists($this->user_contact_tbl))
			{
				$this->updateEntry($formvars , $where);
				return true;
			}
			else
			{
				// insert user record in redc user contact tbl
			$ucrecord['oepaid']					=	$this->mySQLSafe( $this->oepaid);
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
		}
		
		else if($formvars["steps"] == "organizational")
		{
			if($this->recordExists($this->user_org_tbl))
			{
				$this->updateEntry($formvars , $where);
				return true;
			}
			else
			{
				// insert user record in redc user organization tbl
			$uorecord['oepaid']						=	$this->mySQLSafe( $this->oepaid);
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
		}
		else if($formvars["steps"] == "professional")
		{
			if($this->recordExists($this->user_profess_tbl))
			{
				$this->updateEntry($formvars , $where);
				return true;
			}
			else
			{
				// insert user record in redc user professional tbl
				$uprrecord['oepaid']			=	$this->mySQLSafe( $this->oepaid);
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
				return true;
			}
		}
		
		else if($formvars["steps"] == "sponsorship")
		{
			if($this->recordExists($this->user_sponsor_tbl))
			{
				$this->updateEntry($formvars , $where);
				return true;
			}
			else
			{
				// insert user record in redc user sponsors tbl
			$usrecord['oepaid']					=	$this->mySQLSafe( $this->oepaid);
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
			$usrecord['availresidence']			=	$this->mySQLSafe( $formvars['availresidence']);    			  
			$this->insert($this->user_sponsor_tbl,$usrecord);
			return true;
			}
		}
		
		else if($formvars["steps"] == "information")
		{
			if($this->recordExists($this->user_inform_tbl))
			{
				$this->updateEntry($formvars , $where);
				return true;
			}
			else
			{
				// insert user record in redc user information tbl
				$uirecord['oepaid']					=	$this->mySQLSafe( $this->oepaid);
				$uirecord['learnabout']				=	$this->mySQLSafe( $formvars['learnabout']);    
				$uirecord['learnabout_other']		=	$this->mySQLSafe( $formvars['learnabout_other']);    
				if($this->insert($this->user_inform_tbl,$uirecord) > 0 ) 
				{				
					// update complete status in applicants table
					/*
					$record['iscomplete']			=	$this->mySQLSafe( "Yes");
					$where = "oepaid = ".$this->oepaid;
					if($this->update($this->tablename,$record , $where) > 0)
					{
						$this->error["message"]	= "Applicant has been added successfully.";
						return true;
					}
					else
					{
						$this->error["message"]="Applicant has not been added.";
						return false;			
					}
					*/
					return true;	
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
	function editEntry()
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
		$prevoepaid = 0;
		$curroepaid = ($this->oepaid) ? $this->oepaid : 0;

/*		$_qry_prev_app = "select oepaid from ".$this->tablename." where uid = '".$this->userid."' and iscomplete='Yes' order by registrationdate DESC limit 1";
		if($this->numrows($_qry_prev_app))
		{
			$array = $this->select($_qry_prev_app);
			$prevoepaid = $array[0]["oepaid"];
		}
*/		
			$_query = "select * from ".$this->user_personal_tbl." where oepaid = ".$curroepaid;
			$fetch=$this->select($_query);
			if($fetch!=false)
			{
				foreach($fetch as $f)
				{
					$personal_data = $f;
				}
			}
			else
			{
				$_query = "select * from ".$this->user_personal_tbl." where oepaid = ".$prevoepaid;
				$fetch=$this->select($_query);
				if($fetch!=false)
				{
					foreach($fetch as $f)
					{
						$personal_data = $f;
					}
				}
			}
			
			$_query = "select * from ".$this->user_contact_tbl." where oepaid = ".$curroepaid;
			$fetch=$this->select($_query);
			if($fetch!=false)
			{
				foreach($fetch as $f)
				{
					$contact_data = $f;
				}
			}
			else
			{
				$_query = "select * from ".$this->user_contact_tbl." where oepaid = ".$prevoepaid;
				$fetch=$this->select($_query);
				if($fetch!=false)
				{
					foreach($fetch as $f)
					{
						$contact_data = $f;
					}
				}
			}
			
			$_query = "select * from ".$this->user_org_tbl." where oepaid = ".$curroepaid;
			$fetch=$this->select($_query);
			if($fetch!=false)
			{
				foreach($fetch as $f)
				{
					$organizational_data = $f;
				}
			}
			else
			{
				$_query = "select * from ".$this->user_org_tbl." where oepaid = ".$prevoepaid;
				$fetch=$this->select($_query);
				if($fetch!=false)
				{
					foreach($fetch as $f)
					{
						$organizational_data = $f;
					}
				}
			}
			
			$_query = "select * from ".$this->user_profess_tbl." where oepaid = ".$curroepaid;
			$fetch=$this->select($_query);
			if($fetch!=false)
			{
				foreach($fetch as $f)
				{
					$professional_data = $f;
				}
			}
			else
			{
				$_query = "select * from ".$this->user_profess_tbl." where oepaid = ".$prevoepaid;
				$fetch=$this->select($_query);
				if($fetch!=false)
				{
					foreach($fetch as $f)
					{
						$professional_data = $f;
					}
				}
			}
			
			$_query = "select * from ".$this->user_sponsor_tbl." where oepaid = ".$curroepaid;
			$fetch=$this->select($_query);
			if($fetch!=false)
			{
				foreach($fetch as $f)
				{
					$sponsorship_data = $f;
				}
			}
			else
			{
				$_query = "select * from ".$this->user_sponsor_tbl." where oepaid = ".$prevoepaid;
				$fetch=$this->select($_query);
				if($fetch!=false)
				{
					foreach($fetch as $f)
					{
						$sponsorship_data = $f;
					}
				}
			}

			$_query = "select * from ".$this->user_inform_tbl." where oepaid = ".$curroepaid;
			$fetch=$this->select($_query);
			if($fetch!=false)
			{
				foreach($fetch as $f)
				{
					$information_data = $f;
				}
			}
			else
			{
				$_query = "select * from ".$this->user_inform_tbl." where oepaid = ".$prevoepaid;
				$fetch=$this->select($_query);
				if($fetch!=false)
				{
					foreach($fetch as $f)
					{
						$information_data = $f;
					}
				}
			}
			
	
		

/*
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
*/
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

		$w = " oepaid = ".$id;
		
		if($formvars["steps"] == "personal")
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
		else if($formvars["steps"] == "contact")
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
		else if($formvars["steps"] == "organizational")
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
		else if($formvars["steps"] == "professional")
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
			$this->update($this->user_profess_tbl,$uprrecord , $w);
			return true;
		}
		else if($formvars["steps"] == "sponsorship")
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
			$usrecord['availresidence']			=	$this->mySQLSafe( $formvars['availresidence']);    
			$this->update($this->user_sponsor_tbl,$usrecord , $w);
			return true;
		}		
		else if($formvars["steps"] == "information")
		{
			$uirecord['learnabout']				=	$this->mySQLSafe( $formvars['learnabout']);
			$uirecord['learnabout_other']		=	$this->mySQLSafe( $formvars['learnabout_other']);        
			$this->update($this->user_inform_tbl,$uirecord , $w); 
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
	
	function updateAppstatusToComplete()
	{
		$record['iscomplete']	=	$this->mySQLSafe( "Yes");
		$where = "oepaid = ".$this->oepaid;
		$this->update($this->tablename,$record , $where);
	}
	
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
			$this->error["message"]	=	"Record has been deleted successfully.";
			return true;
		}
	}	


	function deleteIncompleteApp()
	{
		
		// delete applicant programme
	 		$_query = "DELETE uc, upe, upr, uog, usp, uif 
					   FROM " . $this->user_personal_tbl." AS p 
					   LEFT JOIN ".$this->user_contact_tbl." AS uc ON uc.oepaid = p.oepaid 
					   LEFT JOIN ".$this->user_profess_tbl." AS upr ON upr.oepaid = p.oepaid
					   LEFT JOIN ".$this->user_org_tbl." AS uog ON uog.oepaid = p.oepaid
					   LEFT JOIN ".$this->user_sponsor_tbl." AS usp ON usp.oepaid = p.oepaid
					   LEFT JOIN ".$this->user_inform_tbl." AS uif ON uif.oepaid = p.oepaid 
					   WHERE p.oepaid in (select oepaid from ".$this->tablename." where uid = $this->userid and iscomplete = 'No' order by registrationdate ASC limit 1 ) 
					   ";
		$recordset	=	$this->execute($_query);
		
		
		$idzArray = $this->getUserIncomplete();

		foreach($idzArray as $id)
		{
			$qry7 	= "DELETE FROM " . $this->tablename." 
					   WHERE oepaid = $id[oepaid]
					  ";
			$recordset	=	$this->execute($qry7);	
		}

		
		
		
		
	}	

	function deleteIncompleteAppWithoutCurrent()
	{
		
/*		// delete applicant programme
	 		echo $_query = "DELETE a, uc, upe, upr, uog, usp, uif 
					   FROM " . $this->tablename." AS a 
					   LEFT JOIN ".$this->user_contact_tbl." AS uc ON uc.oepaid = a.oepaid 
					   LEFT JOIN ". $this->user_personal_tbl." AS upe ON upe.oepaid = a.oepaid
					   LEFT JOIN ".$this->user_profess_tbl." AS upr ON upr.oepaid = a.oepaid
					   LEFT JOIN ".$this->user_org_tbl." AS uog ON uog.oepaid = a.oepaid
					   LEFT JOIN ".$this->user_sponsor_tbl." AS usp ON usp.oepaid = a.oepaid
					   LEFT JOIN ".$this->user_inform_tbl." AS uif ON uif.oepaid = a.oepaid 
					   WHERE a.oepaid in (select oepaid from ".$this->tablename." where uid = $this->userid and iscomplete = 'No' and oepaid != $this->oepaid ) 
					   ";
			exit;
			
			$recordset	=	$this->execute($_query);	
*/
	 		$qry1 	= "DELETE FROM " . $this->user_contact_tbl."
					   WHERE oepaid in (select oepaid from ".$this->tablename." where uid = $this->userid and iscomplete = 'No' and oepaid != $this->oepaid ) 
					   ";
					   
			$recordset	=	$this->execute($qry1);			   
					   
			$qry2 	= "DELETE FROM " . $this->user_personal_tbl." 
					   WHERE oepaid in (select oepaid from ".$this->tablename." where uid = $this->userid and iscomplete = 'No' and oepaid != $this->oepaid ) 
					   ";
					   
			$recordset	=	$this->execute($qry2);			   
					   
			$qry3 	= "DELETE FROM " . $this->user_profess_tbl." 
					   WHERE oepaid in (select oepaid from ".$this->tablename." where uid = $this->userid and iscomplete = 'No' and oepaid != $this->oepaid ) 
					   ";
					   
			$recordset	=	$this->execute($qry3);	
					   
			$qry4 	= "DELETE FROM " . $this->user_org_tbl." 
					   WHERE oepaid in (select oepaid from ".$this->tablename." where uid = $this->userid and iscomplete = 'No' and oepaid != $this->oepaid ) 
					   ";
					   
			$recordset	=	$this->execute($qry4);			   

			$qry5 	= "DELETE FROM " . $this->user_sponsor_tbl." 
					   WHERE oepaid in (select oepaid from ".$this->tablename." where uid = $this->userid and iscomplete = 'No' and oepaid != $this->oepaid ) 
					   ";
					   
			$recordset	=	$this->execute($qry5);			   

			$qry6 	= "DELETE FROM " . $this->user_inform_tbl." 
					   WHERE oepaid in (select oepaid from ".$this->tablename." where uid = $this->userid and iscomplete = 'No' and oepaid != $this->oepaid ) 
					   ";
					   
			$recordset	=	$this->execute($qry6);			   
					    		   		   
			
			$idzArray = $this->getUserIncompleteWithoutCurrent();
			
			foreach($idzArray as $id)
			{
				$qry7 	= "DELETE FROM " . $this->tablename." 
						   WHERE oepaid = $id[oepaid]
						  ";
				$recordset	=	$this->execute($qry7);	
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
        $this->tpl->display('apply.tpl');
    }
	
	function getAllData()
	{
		$res = array();
		if($this->oepaid != null)
		{	
			$_query = "SELECT p.oepaid as personal , c.oepaid as contact , o.oepaid as organizational ,
					   pr.oepaid as professional , s.oepaid as sponsorship , i.oepaid as information 
					   FROM ".$this->tablename." a 
					   left join ".$this->user_personal_tbl." p on a.oepaid = p.oepaid 
					   left join ".$this->user_contact_tbl." c on a.oepaid = c.oepaid
					   left join ".$this->user_org_tbl." o on a.oepaid = o.oepaid
					   left join ".$this->user_profess_tbl." pr on a.oepaid = pr.oepaid
					   left join ".$this->user_sponsor_tbl." s on a.oepaid = s.oepaid
					   left join ".$this->user_inform_tbl." i on a.oepaid = i.oepaid
					   where a.oepaid = $this->oepaid
				      ";
		$res = $this->select($_query);
		}
		return $res;		  
	}
	
    /**
     * display the Faq records
     *
     * @param array $data the Faq data
     */
    function displayGird($data = array()) {
	    global $GENERAL;		
		
		$this->tpl->assign('pid' , $this->parentid);
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('steps',$this->steps);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('status',$this->status);
		$this->tpl->assign('oepaid',$this->oepaid);
		$this->tpl->assign('getall',$this->getAllData());
		$this->tpl->assign('countrylist', $this->getCountries());
		$this->tpl->assign('programmeinfo',$this->getProgrammeData($this->pid));
		$this->tpl->assign('userinfo',$this->getUserInfo());
		$this->tpl->assign('incomplete',$this->getUserIncompleteApplication());
		$this->tpl->assign('complete',$this->getUserCompleteApplication());
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		$this->tpl->display('apply.tpl');        
    }
}

?>