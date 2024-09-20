<?php
/**
 * Podcast Audio Management application library
 *
 */
class oep_programmeManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $table_category="redc_oep_programmes_category";
	var $tablename="redc_oep_programmes";
	var $facultytblname = "redc_faculty";
	var $redc_oep_applicants = "redc_oep_applicants";
	var $redc_alumni_applicants = "redc_alumni_applicants";
	var $sortcolumn=" startdate ";
	var $sortdirection=" desc ";
	var $iscompleted = "N";
	var $searchbyname = "";
	var $searchbyoepcatid = "";
	var $countRecords = 0;
    /**
     * class constructor
     */
    function oep_programmeManagement() {
	 /*if(!isset($_REQUEST['oepcatid']) || $_REQUEST['oepcatid'] == "" )
		{
		    header("Location: oep_programme.php");
			
		}*/
     	$this->tpl =& new Smarty;
		$this->db();
    }
    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
   function isValidForm($formvars,$files=0) {

		// reset error message
        $this->error = null;
        
		// test if "Name" is empty
        if(strlen(trim($formvars['name'])) == 0) {
            $this->error = 'Please provide Programme Name';
            return false; 
        }
		
/*		if($formvars['status'] == 'a') {
			if(strlen(trim($formvars['startdate'])) ==0){
			  $this->error = 'Please provide  future date for Programme start date' ;
			  return false;
			}
			
			if(strtotime($formvars['startdate']) < (strtotime (date("Y-m-d"))))
			{
				$this->error ='Start date should be greater than Today date';
				 return false;
			}
			
			if(strlen(trim($formvars['enddate'])) == 0) {
				$this->error = 'Please provide programme end date';
				return false; 
			}
			
			if(strtotime($formvars['enddate']) < strtotime($formvars['startdate']))
			{
				$this->error = 'Please provide End date greater than start date';
				return false; 
			}
			
			if (strlen(trim($formvars['deadline']))==0){
			  $this->error ='Please provide Application Deadline';
			  return false;
			}
			if(strtotime($formvars['deadline']) > strtotime($formvars['startdate']))
			{
				$this->error = 'Application deadline date should be less than or equal to  start date.';
				return false; 
			}
		} */
		if(strlen(trim ($formvars['venue']))==0){
		$this->error ='Please provide Venue for OEP Programme';
		return false;
		}
		
		if(strlen(trim($files['oepimage']['name'])) > 0 )
				{
					if($files['oepimage']['size'] > '10416640')
					{
						$this->error= "File has large size.";
						return false;
					}
					$ImageExtensions = array("application/pdf","application/doc","image/jpeg","image/pjpeg","image/gif","image/png");
					$check = $files['oepimage']['type'];
					if(!in_array($check, $ImageExtensions)){
						$this->error= "Invalid file format.";
						return false;
					}
				}
		
	  return true;
    }
  	 /**
     * add a new oep_programme entry
     *
     * @param array $formvars the form variables
     */
	 
	 function addEntry($formvars,$files) 
	 {
    	$record['name']=$this->mySQLSafe( $formvars['name']);
		$record['oepcatid']=$this->mySQLsafe ($formvars['oepcatid']);
		
		if($formvars['status'] == 'a')
		{
			$record['startdate']=$this->mySQLSafe($formvars['startdate']);
			$record['enddate']=$this->mySQLSafe( $formvars['enddate']);
			$record['deadline']=$this->mySQLSafe( $formvars['deadline']);
		}
		else if($formvars['status'] == 'tba')
		{
			/*
			$record['startdate']='';
			$record['enddate']='';
			$record['deadline']='';
			*/
		}	
		
		//FOR MULTIPLE FACULTY MEMBERS
		/*for($i=0; $i< count($formvars['faculty']); $i++)
		{
			$all_members .=$formvars['faculty'][$i].",";
		}
		$all_members = substr_replace($all_members,'',-1);*/
		
		$record['venue']=$this->mySQLSafe($formvars['venue']);
		$record['introduction']=$this->mySQLSafe($formvars['introduction']);
		$record['objective']=$this->mySQLSafe($formvars['objective']);
		$record['curriculum']=$this->mySQLSafe($formvars['curriculum']);
		$record['participents']=$this->mySQLSafe($formvars['participents']);
		$record['learningmodel']=$this->mySQLSafe($formvars['learningmodel']);
		$record['faculty']=$this->mySQLSafe($formvars['faculty']);
		$record['faculty2']=$this->mySQLSafe($formvars['faculty2']);
		//$record['faculty_member']=$this->mySQLSafe($all_members);
		$record['facultyinfo']=$this->mySQLSafe($formvars['facultyinfo']);
		$record['facultyinfo2']=$this->mySQLSafe($formvars['facultyinfo2']);
		$record['testimonials']=$this->mySQLSafe($formvars['testimonials']);
		$record['feecondition']=$this->mySQLSafe($formvars['feecondition']);
		//$record['Enabled']=$this->mySQLSafe(formvars['Enabled']);
		$record['isactive']=$this->mySQLSafe ($formvars['isactive']);
		$record['programmelevel']=$this->mySQLSafe ($formvars['programmelevel']);
		$record['iscompleted']=$this->mySQLSafe ($formvars['iscompleted']);
		$record['status']=$this->mySQLSafe ($formvars['status']);
		if(strlen ($files ['oepimage']['name'])>0){
		$fileName = time()."-".$files['oepimage']['name'];
		$fileName =str_replace (' ','-', $fileName);
		$imagepath = PHYSICAL_PATH."/uploads/Oep-Programmes/";
	    if(move_uploaded_file($files['oepimage']['tmp_name'], $imagepath.$fileName))
			{
				 //$this->createThumbnail($FileName, $Imagepath, 153, 113);
				$record['oepimage']=$this->mySQLSafe($fileName);
			}	
		}
		
						
	  	if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="Programme has been added successfully.";
			return true;
		}
		else
		{
			$this->error="Programme has not been added.";
			return false;			
		}
    }  

	/*
	* get faculty profiles.
	*/
  	function getFacultyProfile()
	{
		$_query = "select fid , name from ".$this->facultytblname." order by fid desc";
		return $this->select($_query);
	}


	/*
	* if end date met the current date, programmes will be marked as completed.
	*/
	function markCompletedProgrammes()
	{
		$rec['iscompleted'] = $this->mySQLSafe("Y");
		//$where=" STR_TO_DATE(enddate , '%Y-%m-%d') = '".date("Y-m-d")."'";
		$where=" enddate < '".date("Y-m-d")."' and status != 'tba'";
		$this->update($this->tablename,$rec,$where);
	}


	/*
		** if programme enrolled in by any applicant or alumni then don't delete programme
	*/
	function ifEnrolledProgramme($oepid)
	{
		$return = false;
		$qryoepapplicants = "select oepaid from ".$this->redc_oep_applicants." where oepid = $oepid";
		$return = $this->numrows($qryoepapplicants);
		if(!$return)
		{
			$qryalumni = "select oepid from ".$this->redc_alumni_applicants." where oepid = $oepid";
			$return = $this->numrows($qryalumni);
		}
		return $return;
	}


	/*
	* get all categories.
	*/
	function getCategories()
	{
	      $_query = "select * from ".$this->table_category;
		  $fetch=$this->select($_query);
          return $fetch; 
	}



	/*
	* load record from data base.
	*/
	function categoryInfo($oepcatid)
	{
	      $_query = "select *  from ".$this->table_category." where oepcatid=$oepcatid";
		  $fetch=$this->select($_query);
    	  if($fetch!=false)
			{
	    		$data=$fetch[0];
			}		
        return $data; 
	}
	
	function editEntry($oepid=0)
	{
		$_query = "select *  from ".$this->tablename." where oepid=$oepid";
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["oepcatid"]=$fetch[0]["oepcatid"];
			$data["oepid"]=$fetch[0]["oepid"];
			$data["name"]=$fetch[0]["name"];
			$data['startdate'] = $fetch[0]['startdate'];
			$data['enddate']=$fetch[0]['enddate'];
			$data['deadline']=$fetch[0]['deadline'];
			$data['venue']=$fetch[0]['venue'];
			$data['introduction']=$fetch[0]['introduction'];
			$data['objective']=$fetch[0]['objective'];
			$data['curriculum']=$fetch[0]['curriculum'];
			$data['participents']=$fetch[0]['participents'];
			$data['learningmodel']=$fetch[0]['learningmodel'];
			$data['faculty']=$fetch[0]['faculty'];
			$data['faculty2']=$fetch[0]['faculty2'];
			 
			$data['facultyinfo']=$fetch[0]['facultyinfo'];
			
			$data['facultyinfo2']=$fetch[0]['facultyinfo2'];
			
			$data['testimonials']=$fetch[0]['testimonials'];
			$data['programmelevel']=$fetch[0]['programmelevel'];
			$data['isactive']=$fetch[0]['isactive'];
			$data['iscompleted']=$fetch[0]['iscompleted'];
			$data['feecondition']=$fetch[0]['feecondition'];
			$data['old_image'] = $fetch[0]['oepimage'];
			$data['oepimage'] = $fetch[0]['oepimage'];
			$data['isfeatured'] = $fetch[0]['isfeatured'];
			$data['status']= $fetch[0]['status'];
		}
			/*$arra_faculty = explode('-',$data['faculty_member']);
			$data['faculty_member'] = $arra_faculty;*/
		return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$oepid,$files) {
		$record['name']=$this->mySQLSafe( $formvars['name']);
		$record['oepcatid']=$this->mySQLsafe ($formvars['oepcatid']);
		
		if($formvars['status'] == 'a')
		{
			$record['startdate']=$this->mySQLSafe($formvars['startdate']);
			$record['enddate']=$this->mySQLSafe( $formvars['enddate']);
			$record['deadline']=$this->mySQLSafe( $formvars['deadline']);
		}
		else if($formvars['status'] == 'tba')
		{
			
			$record['startdate']='NULL';
			$record['enddate']='NULL';
			$record['deadline']='NULL';
			
		}
			
		//FOR MULTIPLE FACULTY MEMBERS
		
		/*for($i=0; $i< count($formvars['faculty']); $i++)
		{
			$all_members .=$formvars['faculty'][$i]."-";
		}*/
		
		$all_members = substr_replace($all_members,'',-1);
		$record['venue']=$this->mySQLSafe($formvars['venue']);
		$record['introduction']=$this->mySQLSafe($formvars['introduction']);
		$record['objective']=$this->mySQLSafe($formvars['objective']);
		$record['curriculum']=$this->mySQLSafe($formvars['curriculum']);
		$record['participents']=$this->mySQLSafe($formvars['participents']);
		$record['learningmodel']=$this->mySQLSafe($formvars['learningmodel']);
		$record['faculty']= $this->mySQLSafe($formvars['faculty']);
		$record['faculty2']= $this->mySQLSafe($formvars['faculty2']);
		//$record['faculty_member'] = $this->mySQLSafe ($all_members);
		$record['facultyinfo']=$this->mySQLSafe($formvars['facultyinfo']);
		
		$record['facultyinfo2']=$this->mySQLSafe($formvars['facultyinfo2']);
		
		$record['testimonials']=$this->mySQLSafe($formvars['testimonials']);
		$record['feecondition']=$this->mySQLSafe($formvars['feecondition']);
		//$record['Enabled']=$this->mySQLSafe(formvars['Enabled']);
		$record['isactive']=$this->mySQLSafe ($formvars['isactive']);
		$record['isfeatured']=$this->mySQLSafe ($formvars['isfeatured']);
	    $record['programmelevel']=$this->mySQLSafe ($formvars['programmelevel']);
		$record['iscompleted']=$this->mySQLSafe ($formvars['iscompleted']);
		$record['status']=$this->mySQLSafe ($formvars['status']);
		if(strlen ($files ['oepimage']['name'])>0){
		$fileName = time()."-".$files['oepimage']['name'];
		$fileName =str_replace (' ','-', $fileName);
		$imagepath = PHYSICAL_PATH."/uploads/Oep-Programmes/";
	   
	    if(move_uploaded_file($files['oepimage']['tmp_name'], $imagepath.$fileName))
			{
				 //$this->createThumbnail($FileName, $Imagepath, 153, 113);
				$record['oepimage']=$this->mySQLSafe($fileName);
			}	
		}
		$where = " oepid = $oepid";
		if($this->update($this->tablename,$record,$where))
		{
			$this->error="Programme has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="Programme can't be updated.";
			return false;
			
		}
        
    }
	
	function deleteEntry($oepid=0)
	{
		
		if(!$result = $this->ifEnrolledProgramme($oepid))
		{
			$_where = 	"oepid='".$oepid."' ";
			$this->delete($this->tablename,$_where);
			$result = true;
		}
		else
		{
			$result = false;
		}
		
		if($result) 
		{
			$this->error="Programme has been deleted successfully.";
			return true;
		}
		else
		{
			$this->error="Programme can't be deleted because some applicants & alumni exist for this programme";
			return false;			
		}			
	}
	 /**
     * get the Faqs entries
	  * @param start variables use for paging.
     */
      function getEntries($_start=0,$formvars) {

		// mark programmes as completed when programme's end date meet.
		$this->markCompletedProgrammes();
		
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
		
		$where = "";
		if(($formvars['search_by_name']!='') && ($formvars['search_by_oepcatid']!=''))
		{
          	$this->searchbyname 	= $formvars['search_by_name'];
			$tmpname = $formvars['search_by_name']."%";
			$this->searchbyoepcatid = $formvars['search_by_oepcatid'];
          	$where = " where name like ".$this->mySQLSafe($tmpname)." AND oepcatid = '".$formvars['search_by_oepcatid']."'";
	    }
		
		if(isset($formvars['iscompleted']) && $formvars['iscompleted'] == 'Y')
		{
			if($where == "")
			{
				//$where =" where iscompleted ='".$formvars['iscompleted']."'";
				$where =" where enddate <='".date("Y-m-d")."' and status != 'tba' ";
			}
			else
			{
				//$where .=" and iscompleted ='".$formvars['iscompleted']."'";
				$where .=" and enddate <='".date("Y-m-d")."' and status != 'tba' ";
			}	
			$this->iscompleted = $formvars['iscompleted'];
		}
		
		else
		{
			if($where == "")
			{
				if($this->iscompleted == 'Y')
				{
					$where =" where enddate <'".date("Y-m-d")."' and status != 'tba' ";		
				}
				else if($this->iscompleted == 'N')
				{
					$where =" where (enddate >='".date("Y-m-d")."' or status = 'tba') ";		
				}
				
			}
			else
			{
				if($this->iscompleted == 'Y')
				{
					$where .=" and enddate <'".date("Y-m-d")."' and status != 'tba' ";		
				}
				else if($this->iscompleted == 'N')
				{
					$where .=" and (enddate >='".date("Y-m-d")."' or status = 'tba') ";		
				}
				
			}	
			$this->iscompleted = $formvars['iscompleted'];
		}
		
		if(($formvars['search_by_name']) && $formvars['search_by_name']!='')
		{
          	$this->searchbyname 	= $formvars['search_by_name'];
		  	$tmpname = $formvars['search_by_name']."%";
			if($where == "")
			{
				$where =" where name like ".$this->mySQLSafe($tmpname);
			}
			else
			{
				$where .=" and name like ".$this->mySQLSafe($tmpname);
			}	
		}

		if(($formvars['search_by_oepcatid']) && $formvars['search_by_oepcatid']!='')
		{
			$this->searchbyoepcatid = $formvars['search_by_oepcatid'];
		  	if($where == "")
			{
				$where =" where oepcatid = '".$formvars['search_by_oepcatid']."'";
			}
			else
			{
				$where .=" and oepcatid = '".$formvars['search_by_oepcatid']."'";
			}	
		}
        $where .= "";  
		
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		//$where=" ";
		
		
		/// query for paging
		
		$qry_for_paging = "select * from " . $this->tablename. $where ;


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

		$_query = " select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";

		$fetch=$this->select($_query);
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing Programmes found.";
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
		if(($formvars['search_by_name']!='') && ($formvars['search_by_oepcatid']!=''))
		{
          	$this->searchbyname 	= $formvars['search_by_name'];
			$tmpname = $formvars['search_by_name']."%";
			$this->searchbyoepcatid = $formvars['search_by_oepcatid'];
          	$where = " where a.name like ".$this->mySQLSafe($tmpname)." AND a.oepcatid = '".$formvars['search_by_oepcatid']."'";
	    }
		
		if(isset($formvars['iscompleted']) && $formvars['iscompleted'] == 'Y')
		{
			if($where == "")
			{
				//$where =" where iscompleted ='".$formvars['iscompleted']."'";
				$where =" where a.enddate <='".date("Y-m-d")."' and a.status != 'tba' ";
			}
			else
			{
				//$where .=" and iscompleted ='".$formvars['iscompleted']."'";
				$where .=" and a.enddate <='".date("Y-m-d")."' and a.status != 'tba' ";
			}	
			$this->iscompleted = $formvars['iscompleted'];
		}
		
		else
		{
			if($where == "")
			{
				if($this->iscompleted == 'Y')
				{
					$where =" where a.enddate <'".date("Y-m-d")."' and a.status != 'tba' ";		
				}
				else if($this->iscompleted == 'N')
				{
					$where =" where (a.enddate >='".date("Y-m-d")."' or a.status = 'tba') ";		
				}
				
			}
			else
			{
				if($this->iscompleted == 'Y')
				{
					$where .=" and a.enddate <'".date("Y-m-d")."' and a.status != 'tba' ";		
				}
				else if($this->iscompleted == 'N')
				{
					$where .=" and (a.enddate >='".date("Y-m-d")."' or a.status = 'tba') ";		
				}
				
			}	
			$this->iscompleted = $formvars['iscompleted'];
		}
		
		if(($formvars['search_by_name']) && $formvars['search_by_name']!='')
		{
          	$this->searchbyname 	= $formvars['search_by_name'];
		  	$tmpname = $formvars['search_by_name']."%";
			if($where == "")
			{
				$where =" where a.name like ".$this->mySQLSafe($tmpname);
			}
			else
			{
				$where .=" and a.name like ".$this->mySQLSafe($tmpname);
			}	
		}

		if(($formvars['search_by_oepcatid']) && $formvars['search_by_oepcatid']!='')
		{
			$this->searchbyoepcatid = $formvars['search_by_oepcatid'];
		  	if($where == "")
			{
				$where =" where a.oepcatid = '".$formvars['search_by_oepcatid']."'";
			}
			else
			{
				$where .=" and a.oepcatid = '".$formvars['search_by_oepcatid']."'";
			}	
		}
			$sql_query = "select a.name, a.startdate, a.enddate, a.deadline, a.venue, a.programmelevel, a.isactive from redc_oep_programmes as a  $where "; 
		
			$sql_query .= " order by a.startdate desc ";
	
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
		$this->tpl->assign('pname', $this->getCategories());
		$this->tpl->assign('faculty', $this->getFacultyProfile());
        $this->tpl->assign('error', $this->error);
		//$this->tpl->assign('oepcatid', $this->categoryInfo($_REQUEST['oepcatid']));
        $this->tpl->display('oep_programmemanagement.tpl');
    }
    /**
     * display the Faq records
     *
     * @param array $data the Faq data
     */
    function displayGird($data = array()) {
	    global $GENERAL;		
		$arrysearch["search_by_name"] 	= $this->searchbyname;
		$arrysearch["search_by_oepcatid"] 		= $this->searchbyoepcatid;
		$this->tpl->assign('formvars', $arrysearch);
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('data', $data);
		$this->tpl->assign('category', $this->getCategories());
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('iscompleted',$this->iscompleted);
		$this->tpl->assign('countRecords', $this->countRecords);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		//$this->tpl->assign('oepcatid', $this->categoryInfo($_REQUEST['oepcatid']));
	    $this->tpl->display('oep_programmemanagement.tpl');        
    }
}
?>