<?php
/**
 * Podcast Audio Management application library
 *
 */
class AlumniLogin extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_alumni";
	var $usertblname = "redc_user";
	var $tablepgcontent="redc_page_content";
	
    /**
     * class constructor
     */
    function AlumniLogin() {
     	$this->tpl =& new Smarty;
		$this->db();
    }

    ///// redirect admin to welcome page if valid or already login
	function redirectAlumni()
	{
	  header("Location:alumni_profile.php");
	  exit;	
	}	
	 /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars) {

		// reset error message
        $this->error = null;
        
		// test if "Title" is empty
        if(strlen(trim($formvars['username'])) == 0) {
            $this->error = 'Please provide user name';
            return false; 
        }
		
		else if(!$this->validateMail($formvars['username']))
		{
			$this->error = 'Invalid user name';
			return false; 
		}

		// test if "Alt text" is empty
        else if(strlen(trim($formvars['password'])) == 0) {
            $this->error = 'Please provide Password';
            return false; 
        }
		
		// form passed validation
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
	
	
	
	/**
     * validate alumni 
     *
     * @param array $formvars the form variables
     */
    function validateUser($formvars) {
       
	   //$_query = "select * from " . $this->tablename ." where username='".$formvars['username']."' and password='".$formvars['password']."' and isactive ='Yes'";
/*	   $_query = "select * from " . $this->usertblname ." where email='".$formvars['username']."' and password='".$formvars['password']."' and isactive ='Y'";*/

	   $_query = "select u.*, a.aid from " . $this->usertblname ." u, ".$this->tablename." a where u.email='".$formvars['username']."' and u.password='".$formvars['password']."' and a.isactive ='Yes' and u.uid = a.uid";
//echo $_query;die;

	   if($this->numrows($_query) > 0 ){
			
			$fetch=$this->select($_query);
			
			if($fetch!=false)
		    {
//			  $_SESSION['alumniuser']=$fetch[0]['uid'];
			  $_SESSION['alumniuser']=$fetch[0]['aid'];
			  $this->redirectAlumni();
			}
			
			/*
			$returnURL = $formvars['returnURL'];
		
			if(isset($returnURL) && $returnURL !=''){
				header("Location:$returnURL");
				exit;
			}
			*/
			
			
		}else{
			
			$this->error="Please insert valid username or password.";
			return false;
		}
    }


   ///// get section information
   function getSectionName($section_id)
	{
   	   $_query = "select pcid, psid, pagename, menutitle from " . $this->tablepgcontent ." where  psid = '".$section_id."' order by pageorder";
	   $rs=$this->select($_query);
	   
	  return $rs;	
	}
	function getsectionimage()
	{
		
		$query = "select sec_image from redc_page_section where psid= 9";
		$rs=$this->select($query);
		return $rs;
	}


    /**
     * display the Index page
     */
    function displayPage($formvars = array()) {
	    global $GENERAL;
		$this->tpl->assign('returnUR',$_REQUEST['returnURL']);
		$this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('simage', $this->getsectionimage($_REQUEST['section_id']));
		$this->tpl->assign('section_data', $this->getSectionName(9));
		$this->tpl->assign('data',$formvars);		
		$this->tpl->assign('error', $this->error);		
	    $this->tpl->display('alumni_login.tpl');        
    }
}
?>