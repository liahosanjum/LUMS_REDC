<?php
/**
 * Podcast Audio Management application library
 *
 */
class AlumniLogin1 extends db{

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
    function AlumniLogin1() {
		$this->db();
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
//	   $_query = "select * from " . $this->usertblname ." where email='".$formvars['username']."' and password='".$formvars['password']."' and isactive ='Y'";

	   $_query = "select u.*, a.aid from " . $this->usertblname ." u, ".$this->tablename." a where u.email='".$formvars['username']."' and u.password='".$formvars['password']."' and a.isactive ='Yes' and u.uid = a.uid";
	   
	   if($this->numrows($_query) > 0 ){
			
			$fetch=$this->select($_query);
			if($fetch!=false)
		    {
			  $_SESSION['alumniuser']=$fetch[0]['aid'];
			}
			$returnURL = $formvars['returnURL'];
		
			if(isset($returnURL) && $returnURL !=''){
				header("Location:$returnURL");
				exit;
			}
			$this->redirectAlumni();
			
		}else{
			
			$this->error="Please insert valid username or password.";
			return false;
		}
    }
	/**
     * validate alumni 
     *
     * @param array $formvars the form variables
     */
    function ifAlumni($formvars) {
       
	   $_query = "select * from " . $this->usertblname ." where email='".$formvars['username']."' and password='".$formvars['password']."' and isactive ='Y'";
	   if($this->numrows($_query) > 0 ){
			
			$fetch=$this->select($_query);
			if($fetch!=false)
		    {
			
    		  $qry = "select aid from " . $this->tablename ." where uid='".$fetch[0]['uid']."' and isactive ='Yes'";
			  $aid = $this->select($qry);	
				
			  $_SESSION['alumniuser']=$aid[0]['aid'];
			  return $fetch[0]['uid'];
			}
			
		}
		else{
				return 0;
		}
    }

}
?>