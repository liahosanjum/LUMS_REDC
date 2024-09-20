<?php
/**
 * Podcast Audio Management application library
 *
 */
class AlumniManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_alumni";
	var $redc_alumni_applicants = "redc_alumni_applicants";
	var $usertblname = "redc_user";
	var $tableprog="redc_oep_programmes";
	var $tableofp = "redc_ofpprogrammes";
	var $tblcountries = "redc_countries";
	var $tblfaculty = "redc_faculty";
	var $sortcolumn=" aid ";
	var $sortdirection=" asc ";
	var $searchbyname = "";
	var $searchbycompany = "";
	var $searchbypname = "";
	var $countRecords = 0;
	
    /**
     * class constructor
     */
    function AlumniManagement() {
     	$this->tpl =& new Smarty;
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
        if(strlen(trim($formvars['firstname'])) == 0) {
            $this->error = 'Please provide first name';
            return false; 
        }
		
/*		if(strlen(trim($formvars['middlename'])) == 0) {
            $this->error = 'Please provide middle name';
            return false; 
        }
	*/	 
		if(strlen(trim($formvars['lastname'])) == 0) {
            $this->error = 'Please provide last name';
            return false; 
        }
		if(strlen(trim($formvars['nationality'])) == 0) {
            $this->error = 'Please provide nationality';
            return false; 
        }

		if(strlen(trim($formvars['email'])) == 0) {
            $this->error = 'Please provide the Business Email address.';
            return false; 
        }
		if(!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",trim($formvars['email'])))
		{
            $this->error = 'Please provide valid email';
            return false; 		
		}
        
		if(strlen(trim($formvars['designation'])) == 0) {
            $this->error = 'Please provide designation';
            return false; 
        }
		if(strlen(trim($formvars['companyname'])) == 0) {
            $this->error = 'Please provide company/organisation name';
            return false; 
        }
		if(strlen(trim($formvars['companyaddress'])) == 0) {
            $this->error = 'Please provide organisation address';
            return false; 
        }
		if(strlen(trim($formvars['country'])) == 0) {
            $this->error = 'Please provide country';
            return false; 
        }
		
		if(strlen(trim($formvars['phone'])) == 0) {
            $this->error = 'Please provide Telephone';
            return false; 
        }

		if(!ereg ("([0-9])", $formvars['phone'])) {
            $this->error = 'Please provide valid phone number';
            return false; 
        }

		if(strlen(trim($formvars['cell'])) != 0) {
			if(!ereg ("([0-9])", $formvars['cell'])) {
    	        $this->error = 'Please provide valid cell';
        	    return false; 
			}	
        }

		if(strlen(trim($formvars['fax'])) != 0) {
			if(!ereg ("([0-9])", $formvars['fax'])) {
    	        $this->error = 'Please provide valid fax ';
        	    return false; 
			}	
        }
	

		if($formvars['currentindustry'] == "other") {
            
			if(strlen(trim($formvars['industryother'])) == 0)
			{
				$this->error = 'Please provide current industry';
				return false; 
			}
        }
		
		if($formvars['position'] == "other") {
            
			if(strlen(trim($formvars['positionother'])) == 0)
			{
				$this->error = 'Please provide the function best describes your position';
				return false; 
			}
        }

		return true;
    }
  	 /**
     * add a new Alumni entry
     *
     * @param array $formvars the form variables
     */
    function addEntry($formvars) 
	{
    	//$record['firstname']		=	$this->mySQLSafe( $formvars['firstname']);
//		$record['middlename']		=	$this->mySQLSafe( $formvars['middlename']);
		//$record['lastname']			=	$this->mySQLSafe( $formvars['lastname']);
		$record['prefix']			=	$this->mySQLSafe( $formvars['prefix']);
		$record['nationality']		=	$this->mySQLSafe( $formvars['nationality']);
		$record['email']			=	$this->mySQLSafe( $formvars['email']);
		$record['designation']		=	$this->mySQLSafe( $formvars['designation']);
		$record['companyname']		=	$this->mySQLSafe( $formvars['companyname']);
		$record['companyother']		=	$this->mySQLSafe( $formvars['companyother']);
		$record['companyaddress']	=	$this->mySQLSafe( $formvars['companyaddress']);
		$record['city']				=	$this->mySQLSafe( $formvars['city']);
		$record['country']			=	$this->mySQLSafe( $formvars['country_id']);
		$record['phone']			=	$this->mySQLSafe( $formvars['phone']);
		$record['cell']				=	$this->mySQLSafe( $formvars['cell']);
		$record['fax']				=	$this->mySQLSafe( $formvars['fax']);
		$record['currentindustry']	=	$this->mySQLSafe( $formvars['currentindustry']);
		$record['industryother']	=	$this->mySQLSafe( $formvars['industryother']);
		$record['position']			=	$this->mySQLSafe( $formvars['position']);
		$record['positionother']	=	$this->mySQLSafe( $formvars['positionother']);
		$record['isactive']			=	$this->mySQLSafe( $formvars['isactive']);
		$record['registrationdate']	=	$this->mySQLSafe( date("Y-m-d"));


		if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="Alumni has been added successfully.";
			return true;
		}
		else
		{
			$this->error="Alumni has not been added.";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	
	
	
	function editEntry($id=0)
	{
		$_query = "select *, a.isactive as isactive from ".$this->tablename." as a, ". $this->usertblname ." as u where a.aid = $id and a.uid = u.uid";

		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data['aid']				=	$fetch[0]['aid'];
			$data['firstname']			=	$fetch[0]['firstname'];
//			$data['middlename']			=	$fetch[0]['middlename'];
			$data['lastname']			=	$fetch[0]['lastname'];
			$data['prefix']				=	$fetch[0]['prefix'];
			$data['nationality']		=	$fetch[0]['nationality'];
			$data['email']				=	$fetch[0]['email'];
			$data['designation']		=	$fetch[0]['designation'];
			$data['companyname']		=	$fetch[0]['companyname'];
			$data['companyother']		=	$fetch[0]['companyother'];
			$data['companyaddress']		=	$fetch[0]['companyaddress'];
			$data['city']				=	$fetch[0]['city'];
//			$data['country']			=	$fetch[0]['country_id'];
			$data['country']			=	$fetch[0]['country'];
			$data['phone']				=	$fetch[0]['phone'];
			$data['cell']				=	$fetch[0]['cell'];
			$data['fax']				=	$fetch[0]['fax'];
			$data['currentindustry']	=	$fetch[0]['currentindustry'];
			$data['industryother']		=	$fetch[0]['industryother'];
			$data['position']			=	$fetch[0]['position'];
			$data['positionother']		=	$fetch[0]['positionother'];
			$data['isactive']			=	$fetch[0]['isactive'];
		}
		
        return $data; 
	}  
	
	
	function getUserProgrammes($id)
	{
		 $_query = "(SELECT f.name , f.startdate , f.enddate , fa.name as instructor
					FROM redc_alumni as a , redc_alumni_applicants as aa , redc_ofpprogrammes as f , 
					redc_faculty as fa
					where a.aid = aa.aid
					and a.aid = $id
					and aa.ofpid = f.ofpid
					and f.moduledirector = fa.fid
					AND aa.ofpid != '')
					UNION
					(SELECT p.name , p.startdate , p.enddate , fa.name as instructor
					FROM redc_alumni as a , redc_alumni_applicants as aa , redc_oep_programmes as p , 
					redc_faculty as fa
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
	
	
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$id) {
			

			//$record['firstname']		=	$this->mySQLSafe( $formvars['firstname']);
//			$record['middlename']		=	$this->mySQLSafe( $formvars['middlename']);
			//$record['lastname']			=	$this->mySQLSafe( $formvars['lastname']);
			$record['prefix']			=	$this->mySQLSafe( $formvars['prefix']);
			$record['nationality']		=	$this->mySQLSafe( $formvars['nationality']);
			$record['email']			=	$this->mySQLSafe( $formvars['email']);
			$record['designation']		=	$this->mySQLSafe( $formvars['designation']);
			$record['companyname']		=	$this->mySQLSafe( $formvars['companyname']);
			$record['companyother']		=	$this->mySQLSafe( $formvars['companyother']);
			$record['companyaddress']	=	$this->mySQLSafe( $formvars['companyaddress']);
			$record['city']				=	$this->mySQLSafe( $formvars['city']);
//			$record['country']			=	$this->mySQLSafe( $formvars['country_id']);
			$record['country']			=	$this->mySQLSafe( $formvars['country']);
			$record['phone']			=	$this->mySQLSafe( $formvars['phone']);
			$record['cell']				=	$this->mySQLSafe( $formvars['cell']);
			$record['fax']				=	$this->mySQLSafe( $formvars['fax']);
			$record['currentindustry']	=	$this->mySQLSafe( $formvars['currentindustry']);
			$record['industryother']	=	$this->mySQLSafe( $formvars['industryother']);
			$record['position']			=	$this->mySQLSafe( $formvars['position']);
			$record['positionother']	=	$this->mySQLSafe( $formvars['positionother']);
			$record['isactive']			=	$this->mySQLSafe( $formvars['isactive']);
			$record['registrationdate']	=	$this->mySQLSafe( date("Y-m-d"));

			$where	=	"aid = ".$_GET['id'];
		
			if($this->update($this->tablename,$record,$where))
			{
				$this->error	=	"Alumni has been updated successfully.";
				return true;
			}
			else
			{
				$this->error	=	"Alumni has not been updated.";
				return false;
			}
    }

	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($id=0)
	{
		$query4alumni		    =	"delete from ".$this->tablename." where aid=$id";
		$query4alumniapps		=	"delete from ".$this->redc_alumni_applicants." where aid=$id";
		
		$recordset1	=	$this->execute($query4alumniapps);
		$recordset	=	$this->execute($query4alumni);
		
		
		if($recordset) 
		{
			$this->error	=	"Alumni has been deleted successfully.";
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
			$this->sortcolumn=$formvars['sortcolumn'];
			$this->sortdirection=$formvars['sortdirection'];
		}else if(isset($_GET['sc']) && isset($_GET['sd']))
		{
			$this->sortcolumn=$_GET['sc'];
			$this->sortdirection=$_GET['sd'];
		}
		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows("select aid from ".$this->tablename);
		$this->countRecords = $paging->num;
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		///Sort order
//		$orderby=" order by redc_alumni.". $this->sortcolumn ." ". $this->sortdirection;
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$whereforofp = "";
		$whereforoep = "";
		if(($formvars['search_by_name']!='') && ($formvars['search_by_companyname']!='') && ($formvars['search_by_pname']!=''))
		{
          	$this->searchbypname = $formvars['search_by_pname'];
			$this->searchbyname = $formvars['search_by_name'];
			$this->searchbycompanyname = $formvars['search_by_companyname'];
			$whereforoep .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%') AND a.companyname like '%".$formvars['search_by_companyname']."%' AND p.name like '%".$formvars['search_by_pname']."%'";
			
			$whereforofp .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%') AND a.companyname like '%".$formvars['search_by_companyname']."%' AND f.name like '%".$formvars['search_by_pname']."%'";
			
	    }
		
		
		else if(($formvars['search_by_name']!='') && ($formvars['search_by_companyname']!=''))
		{
          	$this->searchbyname = $formvars['search_by_name'];
			$this->searchbycompanyname = $formvars['search_by_companyname'];
			$whereforoep .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%') AND a.companyname like '%".$formvars['search_by_companyname']."%'";
			$whereforofp .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%') AND a.companyname like '%".$formvars['search_by_companyname']."%'";

	    }

		else if(($formvars['search_by_pname']!='') && ($formvars['search_by_companyname']!=''))
		{
          	$this->searchbypname = $formvars['search_by_pname'];
			$this->searchbycompanyname = $formvars['search_by_companyname'];
			$whereforoep .= " and p.name like '%".$formvars['search_by_pname']."%' AND a.companyname like '%".$formvars['search_by_companyname']."%'";
			$whereforofp .= " and f.name like '%".$formvars['search_by_pname']."%' AND a.companyname like '%".$formvars['search_by_companyname']."%'";
	    }
		

		else if(($formvars['search_by_name']!='') && ($formvars['search_by_pname']!=''))
		{
          	$this->searchbyname = $formvars['search_by_name'];
			$this->searchbypname = $formvars['search_by_pname'];
			$whereforoep .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%') AND p.name like '%".$formvars['search_by_pname']."%'";
			$whereforofp .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%') AND   f.name like '%".$formvars['search_by_pname']."%'";
	    }
		
		else if(($formvars['search_by_pname']) && $formvars['search_by_pname']!='')
		{
		  	$this->searchbypname = $formvars['search_by_pname'];
			$whereforoep .= " and p.name like '%".$formvars['search_by_pname']."%'";
			$whereforofp .= " and f.name like '%".$formvars['search_by_pname']."%'";
		}
	
		else if(($formvars['search_by_name']) && $formvars['search_by_name']!='')
		{
		  	$this->searchbyname = $formvars['search_by_name'];
			$whereforoep .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%')";
			$whereforofp .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%')";
		}
		else if(($formvars['search_by_companyname']) && $formvars['search_by_companyname']!='')
		{
			$this->searchbycompanyname = $formvars['search_by_companyname'];
			$whereforoep .= " and a.companyname like '%".$formvars['search_by_companyname']."%'";
			$whereforofp .= " and a.companyname like '%".$formvars['search_by_companyname']."%'";
		 //	$where.=" where companyname = '".$formvars['search_by_companyname']."'";
			
		}
		
		/* $_query = "(SELECT a.firstname,a.lastname,a.email,a.companyname,a.designation,a.aid,a.numprogrammes,a.registrationdate
					FROM redc_alumni as a , redc_alumni_applicants as aa , redc_ofpprogrammes as f
					where a.aid = aa.aid
					and aa.ofpid = f.ofpid
					AND aa.ofpid != ''
					$whereforofp
					". $orderby .") 
					UNION
					(SELECT a.firstname,a.lastname,a.email,a.companyname,a.designation,a.aid,a.numprogrammes,a.registrationdate
					FROM redc_alumni as a , redc_alumni_applicants as aa , redc_oep_programmes as p
					where a.aid = aa.aid
					and aa.oepid = p.oepid
					AND aa.oepid != '' 
					$whereforoep
					". $orderby .") 
					Limit $paging->start,$paging->limit
				  ";*/
				  
		$_query = "(SELECT u.firstname,u.lastname,u.email,a.companyname,a.designation,a.aid,a.numprogrammes,a.registrationdate
					FROM redc_alumni as a , redc_alumni_applicants as aa , redc_ofpprogrammes as f , redc_user as u
					where a.aid = aa.aid
					and a.uid = u.uid
					and aa.ofpid = f.ofpid
					AND aa.ofpid != ''
					$whereforofp) 
					UNION
					(SELECT u.firstname,u.lastname,u.email,a.companyname,a.designation,a.aid,a.numprogrammes,a.registrationdate
					FROM redc_alumni as a , redc_alumni_applicants as aa , redc_oep_programmes as p , redc_user as u
					where a.aid = aa.aid
					and a.uid = u.uid
					and aa.oepid = p.oepid
					AND aa.oepid != '' 
					$whereforoep) 
					".$orderby."
					Limit $paging->start,$paging->limit
				  ";
					
		
	/*	$_query = "select * from " . $this->tablename. " as a , ".$this->tableprog. " as p , ".$this->tableofp. " as f ,  ".$this->redc_alumni_applicants." as aa ". $where . $orderby ."  Limit $paging->start,$paging->limit";*/
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data=$fetch;
		}
		else
		{
		   $this->error="No existing Alumni found.";
		   $data=null;
		}
	    return $data;   
    }
	// function for exporting data in to csv file 
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
	
		$whereforofp = "";
		$whereforoep = "";
		if(($formvars['search_by_name']!='') && ($formvars['search_by_companyname']!='') && ($formvars['search_by_pname']!=''))
		{
          	$this->searchbypname = $formvars['search_by_pname'];
			$this->searchbyname = $formvars['search_by_name'];
			$this->searchbycompanyname = $formvars['search_by_companyname'];
			$whereforoep .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%') AND a.companyname like '%".$formvars['search_by_companyname']."%' AND p.name like '%".$formvars['search_by_pname']."%'";
			
			$whereforofp .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%') AND a.companyname like '%".$formvars['search_by_companyname']."%' AND f.name like '%".$formvars['search_by_pname']."%'";
			
	    }
		
		
		else if(($formvars['search_by_name']!='') && ($formvars['search_by_companyname']!=''))
		{
          	$this->searchbyname = $formvars['search_by_name'];
			$this->searchbycompanyname = $formvars['search_by_companyname'];
			$whereforoep .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%') AND a.companyname like '%".$formvars['search_by_companyname']."%'";
			$whereforofp .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%') AND a.companyname like '%".$formvars['search_by_companyname']."%'";

	    }

		else if(($formvars['search_by_pname']!='') && ($formvars['search_by_companyname']!=''))
		{
          	$this->searchbypname = $formvars['search_by_pname'];
			$this->searchbycompanyname = $formvars['search_by_companyname'];
			$whereforoep .= " and p.name like '%".$formvars['search_by_pname']."%' AND a.companyname like '%".$formvars['search_by_companyname']."%'";
			$whereforofp .= " and f.name like '%".$formvars['search_by_pname']."%' AND a.companyname like '%".$formvars['search_by_companyname']."%'";
	    }
		

		else if(($formvars['search_by_name']!='') && ($formvars['search_by_pname']!=''))
		{
          	$this->searchbyname = $formvars['search_by_name'];
			$this->searchbypname = $formvars['search_by_pname'];
			$whereforoep .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%') AND p.name like '%".$formvars['search_by_pname']."%'";
			$whereforofp .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%') AND   f.name like '%".$formvars['search_by_pname']."%'";
	    }
		
		else if(($formvars['search_by_pname']) && $formvars['search_by_pname']!='')
		{
		  	$this->searchbypname = $formvars['search_by_pname'];
			$whereforoep .= " and p.name like '%".$formvars['search_by_pname']."%'";
			$whereforofp .= " and f.name like '%".$formvars['search_by_pname']."%'";
		}
	
		else if(($formvars['search_by_name']) && $formvars['search_by_name']!='')
		{
		  	$this->searchbyname = $formvars['search_by_name'];
			$whereforoep .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%')";
			$whereforofp .= " and (u.firstname like '%".$formvars['search_by_name']."%' or u.lastname like '%".$formvars['search_by_name']."%')";
		}
		else if(($formvars['search_by_companyname']) && $formvars['search_by_companyname']!='')
		{
			$this->searchbycompanyname = $formvars['search_by_companyname'];
			$whereforoep .= " and a.companyname like '%".$formvars['search_by_companyname']."%'";
			$whereforofp .= " and a.companyname like '%".$formvars['search_by_companyname']."%'";
		 //	$where.=" where companyname = '".$formvars['search_by_companyname']."'";
			
		}
	
//		  $sql_query = "(SELECT u.firstname,u.lastname,u.email,a.companyname,a.designation,a.aid,a.numprogrammes,a.registrationdate FROM redc_alumni as a , redc_alumni_applicants as aa , redc_ofpprogrammes as f, redc_user as u where a.aid = aa.aid and a.uid = u.uid and aa.ofpid = f.ofpid AND aa.ofpid != '' ORDER BY redc_alumni.aid ASC) UNION (SELECT u.firstname,u.lastname,u.email,a.companyname,a.designation,a.aid,a.numprogrammes,a.registrationdate FROM redc_alumni as a , redc_alumni_applicants as aa , redc_oep_programmes as p , redc_user as u where a.aid = aa.aid and a.uid = u.uid and aa.oepid = p.oepid AND aa.oepid != '' ORDER BY redc_alumni.aid ASC)  			  ";

		  $sql_query = "(SELECT u.firstname as Name,u.email as Email,a.companyname as Organization,a.designation as Designation,a.numprogrammes as `No of Programmes`,a.registrationdate as Dated FROM redc_alumni as a , redc_alumni_applicants as aa , redc_ofpprogrammes as f, redc_user as u where a.aid = aa.aid and a.uid = u.uid and aa.ofpid = f.ofpid AND aa.ofpid != '' ORDER BY redc_alumni.aid ASC) UNION (SELECT u.firstname as Name,u.email as Email,a.companyname as Organization,a.designation as Designation,a.numprogrammes as `No of Programmes`,a.registrationdate as Dated FROM redc_alumni as a , redc_alumni_applicants as aa , redc_oep_programmes as p , redc_user as u where a.aid = aa.aid and a.uid = u.uid and aa.oepid = p.oepid AND aa.oepid != '' ORDER BY redc_alumni.aid ASC)  			  ";

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
	function getCountries()
	{
		$data = null;
		$_query = 'select * from '.$this->tblcountries." order by countryname";
		$rs = mysql_query($_query);
		if($rs != null)
		{
			while($row = mysql_fetch_array($rs))
			{
				$data[] = $row;
			}
		}
		
		return $data;
	}
	
	function alumniinfo($aid)
	{
		$userarray = array();	
		if(isset($aid) && $aid != NULL)
		{
			 $_query = "SELECT u.firstname , u.lastname , u.email , u.type
						FROM redc_user as u , redc_alumni as a 
						where a.aid = $aid
						and a.uid = u.uid
					   ";
			$fetch = $this->select($_query);
			$userarray = $fetch[0];
		}
		return $userarray;
	}
	
    /**
     * display the Faq entry form
     *
     * @param array $formvars the form variables
     */
    function displayForm($formvars = array()) {

		global $GENERAL;
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
		// assign error message
		
		
		$this->tpl->assign('countries',$this->getCountries());
		
		$this->tpl->assign('alumniinfo',$this->alumniinfo($_REQUEST['aid']));
        
		$this->tpl->assign('error', $this->error);
        $this->tpl->display('alumnimanagement.tpl');
    }
    /**
     * display the Faq records
     *
     * @param array $data the Faq data
     */
    function displayGird($data = array()) {
	    global $GENERAL;		
		
		$arrysearch["search_by_name"] = $this->searchbyname;
		$arrysearch["search_by_pname"] = $this->searchbypname;
		$arrysearch["search_by_companyname"] = $this->searchbycompanyname;
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('countRecords', $this->countRecords);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		$this->tpl->assign('formvars', $arrysearch);
		
		
	    $this->tpl->display('alumnimanagement.tpl');        
    }
}
?>