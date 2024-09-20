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
	var $tablename="redc_ofpprogrammes";
	var $table_name="redc_ofp_participants";
	var $facultytblname = "redc_faculty";
	var $sortcolumn=" ofpid ";
	var $sortdirection=" asc ";
	var $status = "";
	var $searchbycname = "";
	var $searchbypname = "";
	var $countRecords = 0;
	
    /**
     * class constructor
     */
    function OFPManagement() {
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
        

        if(strlen(trim($formvars['clientorgname'])) == 0) {
            $this->error = 'Please provide client organisation name';
            return false; 
        }

        if(strlen(trim($formvars['orgaddress'])) == 0) {
            $this->error = 'Please provide organisation address';
            return false; 
        }

        if(strlen(trim($formvars['clientcp'])) == 0) {
            $this->error = 'Please provide client contact person';
            return false; 
        }


		// test if "Title" is empty
        if(strlen(trim($formvars['name'])) == 0) {
            $this->error = 'Please provide programme name';
            return false; 
        }

		if(strlen(trim($formvars['startdate'])) == 0) {
            $this->error = 'Please provide programme start date';
            return false; 
        }
	
	/*	if (!ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $formvars['startdate'], $regs)) {
            $this->error = 'invalid start date format [yyyy-mm-dd]';
            return false; 
		}
	*/

		if(strlen(trim($formvars['enddate'])) == 0) {
            $this->error = 'Please provide programme end date';
            return false; 
        }
		
		if(strtotime($formvars['enddate']) < strtotime($formvars['startdate']))
		{
            $this->error = 'End date should be after or on the same date as the start date';
            return false; 
		}
		
	/*	
		if (!ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $formvars['enddate'], $regs)) {
            $this->error = 'invalid end date format [yyyy-mm-dd]';
            return false; 
		}
	*/	

        if(strlen(trim($formvars['modulename'])) == 0) {
            $this->error = 'Please provide module name';
            return false; 
        }

        if(strlen(trim($formvars['totalparticipants'])) == 0) {
            $this->error = 'Please provide no of participants';
            return false; 
        }

        if (!ereg ("([0-9])", $formvars['totalparticipants'])) {
            $this->error = 'Please provide positive integer value for number of participants ';
            return false; 
        }
		
		if (trim($formvars['totalparticipants']) < 0) 
		{
            $this->error = 'Please provide positive integer value for number of participants';
            return false; 
        }
		/*if (!ereg ("([-0--9])", $formvars['totalparticipants'])) {
            $this->error = 'Please provide positive integer value for number of participants ';
            return false; 
        }*/

        if(strlen(trim($formvars['preprogrammeact'])) > 300) {
            $this->error = 'Please provide pre programme activities with max 300 characters';
            return false; 
        }

        if(strlen(trim($formvars['postprogrammeact'])) > 300) {
            $this->error = 'Please provide post programme activities with max 300 characters';
            return false; 
        }


/*		if(strlen(trim($formvars['details'])) == 0) {
            $this->error = 'Please provide programme details';
            return false; 
        }
		if(strlen(trim($formvars['venue'])) == 0) {
            $this->error = 'Please provide programme venue';
            return false; 
        }
		if(strlen(trim($formvars['director'])) == 0) {
            $this->error = 'Please provide facult/director';
            return false; 
        }
		if($formvars['fee'] == "") {
            $this->error = 'Please provide programme fee';
            return false; 
        }
		if (!ereg ("([0-9])", $formvars['fee'])) {
            $this->error = 'Programme fee must be an integer value';
            return false; 
        }
*/

		return true;
    }
  

  	function getFacultyProfile()
	{
		$_query = "select fid , name from ".$this->facultytblname;
		return $this->select($_query);
	}
  
  	 /**
     * add a new Alumni entry
     *
     * @param array $formvars the form variables
     */
    function addEntry($formvars) 
	{
    	
		$record['clientorgname']		=	$this->mySQLSafe( $formvars['clientorgname']);
		$record['orgaddress']			=	$this->mySQLSafe( $formvars['orgaddress']);
		$record['clientcp']				=	$this->mySQLSafe( $formvars['clientcp']);
		$record['name']					=	$this->mySQLSafe( $formvars['name']);
		$record['startdate']			=	$this->mySQLSafe( $formvars['startdate']);
		$record['enddate']				=	$this->mySQLSafe( $formvars['enddate']);
		$record['programmedirector']	=	$this->mySQLSafe( $formvars['programmedirector']);
		$record['modulename']			=	$this->mySQLSafe( $formvars['modulename']);
		$record['moduledirector']		=	$this->mySQLSafe( $formvars['moduledirector']);
		$record['totalparticipants']	=	$this->mySQLSafe( $formvars['totalparticipants']);
		$record['programmelevel']		=	$this->mySQLSafe( $formvars['programmelevel']);
		$record['programmesite']		=	$this->mySQLSafe( $formvars['programmesite']);
		$record['programmeresidence']	=	$this->mySQLSafe( $formvars['programmeresidence']);
		$record['preprogrammeact']		=	$this->mySQLSafe( $formvars['preprogrammeact']);
		$record['postprogrammeact']		=	$this->mySQLSafe( $formvars['postprogrammeact']);
		$record['enabled']				=	$this->mySQLSafe( $formvars['enabled']);
		
		/*$record['venue']		=	$this->mySQLSafe( $formvars['venue']);
		$record['details']		=	$this->mySQLSafe( $formvars['details']);
		$record['director']		=	$this->mySQLSafe( $formvars['director']);
		$record['fee']			=	$this->mySQLSafe( $formvars['fee']);
		$record['enabled']		=	$this->mySQLSafe( $formvars['enabled']);
		$record['status']		=	1;
*/
		if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="The Programme has been added successfully.";
			return true;
		}
		else
		{
			$this->error="The Programme has not been added.";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	
	
	
	function editEntry($id=0)
	{
		$_query = "select * from ".$this->tablename." where ofpid = $id";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
/*			$data['ofpid']			=	$fetch[0]['ofpid'];
			$data['name']			=	$fetch[0]['name'];
			$data['startdate']		=	$fetch[0]['startdate'];
			$data['enddate']		=	$fetch[0]['enddate'];
			$data['venue']			=	$fetch[0]['venue'];
			$data['details']		=	$fetch[0]['details'];
			$data['director']		=	$fetch[0]['director'];
			$data['fee']			=	$fetch[0]['fee'];
			$data['enabled']		=	$fetch[0]['enabled'];
*/		
			foreach($fetch as $f)
				$data = $f;
		}
		
        return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$id) {

		$record['clientorgname']		=	$this->mySQLSafe( $formvars['clientorgname']);
		$record['orgaddress']			=	$this->mySQLSafe( $formvars['orgaddress']);
		$record['clientcp']				=	$this->mySQLSafe( $formvars['clientcp']);
		$record['name']					=	$this->mySQLSafe( $formvars['name']);
		$record['startdate']			=	$this->mySQLSafe( $formvars['startdate']);
		$record['enddate']				=	$this->mySQLSafe( $formvars['enddate']);
		$record['programmedirector']	=	$this->mySQLSafe( $formvars['programmedirector']);
		$record['modulename']			=	$this->mySQLSafe( $formvars['modulename']);
		$record['moduledirector']		=	$this->mySQLSafe( $formvars['moduledirector']);
		$record['totalparticipants']	=	$this->mySQLSafe( $formvars['totalparticipants']);
		$record['programmelevel']		=	$this->mySQLSafe( $formvars['programmelevel']);
		$record['programmesite']		=	$this->mySQLSafe( $formvars['programmesite']);
		$record['programmeresidence']	=	$this->mySQLSafe( $formvars['programmeresidence']);
		$record['preprogrammeact']		=	$this->mySQLSafe( $formvars['preprogrammeact']);
		$record['postprogrammeact']		=	$this->mySQLSafe( $formvars['postprogrammeact']);
		$record['enabled']				=	$this->mySQLSafe( $formvars['enabled']);

		$where	=	"ofpid = ".$id;
	
		if($this->update($this->tablename,$record,$where))
		{
			$this->error	=	"The Programme has been updated successfully.";
			return true;
		}
		else
		{
			$this->error	=	"The Programme has been updated.";
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
		$del_participants = "delete from ".$this->table_name." where ofpid = $id";
		$this->execute($del_participants);

		// delete programme
		$_query		=	"delete from ".$this->tablename." where ofpid=$id";
		$recordset	=	$this->execute($_query);
		if($recordset) 
		{
			$this->error	=	"The Programme has been deleted successfully.";
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
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
/*		if(($formvars['search_by_cname']!='') && ($formvars['search_by_pname']!=''))
		{
          	$where.=" where name = '".$formvars['search_by_pname']."' AND director = '".$formvars['search_by_email']."'";
	    }
*/		$where = "";
		//STR_TO_DATE(enddate , '%d-%m-%Y') > '".date("Y-m-d")."'
		if(($formvars['search_by_pname']!='') && ($formvars['search_by_cname']!=''))
		{
          	$this->searchbypname = $formvars['search_by_pname'];
			$this->searchbycname = $formvars['search_by_cname'];
			$where = " where name like '".$formvars['search_by_pname']."%' AND clientorgname like '".$formvars['search_by_cname']."%'";
			
	    }
		
		else if(($formvars['search_by_pname']) && $formvars['search_by_pname']!='')
		{
		  	$this->searchbypname=$formvars['search_by_pname'];
			$where =" where name like '".$formvars['search_by_pname']."%'";
		}

		else if(($formvars['search_by_cname']) && $formvars['search_by_cname']!='')
		{
		  	$this->searchbycname=$formvars['search_by_cname'];
			if($where == "")
			{
				$where =" where clientorgname like '".$formvars['search_by_cname']."%'";
			}
			else
			{
				$where .=" and clientorgname like '".$formvars['search_by_cname']."%'";
			}	
		}
		
		
		if(isset($formvars['status']) && $formvars['status'] == 'C')
		{
			$this->searchbypname = $formvars['search_by_pname'];
			$this->searchbycname = $formvars['search_by_cname'];
			
			if($where == "")
			{
				//$where = " where STR_TO_DATE(enddate , '%d-%m-%Y') < '".date("Y-m-d")."'";
				$where = " where enddate < '".date("Y-m-d")."'";
			}
			else
			{
				//$where .= " and STR_TO_DATE(enddate , '%d-%m-%Y') < '".date("Y-m-d")."'";
				$where .= " and enddate < '".date("Y-m-d")."'";
			}	
			$this->status = $formvars['status'];
			
		}
		else
		{
			if($where == "")
			{
				//$where = " where STR_TO_DATE(enddate , '%d-%m-%Y') >= '".date("Y-m-d")."'";
				$where = " where enddate >= '".date("Y-m-d")."'";
			}
			else
			{
				//$where .= " and STR_TO_DATE(enddate , '%d-%m-%Y') >= '".date("Y-m-d")."'";
				$where .= " and enddate >= '".date("Y-m-d")."'";
			}	
		}
/*		elseif(($formvars['search_by_email']) && $formvars['search_by_email']!='')
		{
		 	$where.=" where email = '".$formvars['search_by_email']."'";
		}
*/		
		
	
		// query for paging
		$qry_for_paging = "select * from " . $this->tablename. $where ;
		
		
		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows($qry_for_paging);
		$this->countRecords = $paging->num;
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?status=$this->status",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data=$fetch;
		}
		else
		{
		   $this->error="No programmes found.";
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
		//STR_TO_DATE(enddate , '%d-%m-%Y') > '".date("Y-m-d")."'
		if(($formvars['search_by_pname']!='') && ($formvars['search_by_cname']!=''))
		{
          	$this->searchbypname = $formvars['search_by_pname'];
			$this->searchbycname = $formvars['search_by_cname'];
			$where = " where name like '".$formvars['search_by_pname']."%' AND clientorgname like '".$formvars['search_by_cname']."%'";
			
	    }
		
		else if(($formvars['search_by_pname']) && $formvars['search_by_pname']!='')
		{
		  	$this->searchbypname=$formvars['search_by_pname'];
			$where =" where name like '".$formvars['search_by_pname']."%'";
		}

		else if(($formvars['search_by_cname']) && $formvars['search_by_cname']!='')
		{
		  	$this->searchbycname=$formvars['search_by_cname'];
			if($where == "")
			{
				$where =" where clientorgname like '".$formvars['search_by_cname']."%'";
			}
			else
			{
				$where .=" and clientorgname like '".$formvars['search_by_cname']."%'";
			}	
		}
		
		
		if(isset($formvars['status']) && $formvars['status'] == 'C')
		{
			$this->searchbypname = $formvars['search_by_pname'];
			$this->searchbycname = $formvars['search_by_cname'];
			
			if($where == "")
			{
				//$where = " where STR_TO_DATE(enddate , '%d-%m-%Y') < '".date("Y-m-d")."'";
				$where = " where enddate < '".date("Y-m-d")."'";
			}
			else
			{
				//$where .= " and STR_TO_DATE(enddate , '%d-%m-%Y') < '".date("Y-m-d")."'";
				$where .= " and enddate < '".date("Y-m-d")."'";
			}	
			$this->status = $formvars['status'];
			
		}
		else
		{
			if($where == "")
			{
				//$where = " where STR_TO_DATE(enddate , '%d-%m-%Y') >= '".date("Y-m-d")."'";
				$where = " where enddate >= '".date("Y-m-d")."'";
			}
			else
			{
				//$where .= " and STR_TO_DATE(enddate , '%d-%m-%Y') >= '".date("Y-m-d")."'";
				$where .= " and enddate >= '".date("Y-m-d")."'";
			}	
		}

			$sql_query = "select a.* from redc_ofpprogrammes as a  $where "; 

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
		
		$this->tpl->assign('faculty', $this->getFacultyProfile());
		
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('ofpmanagement.tpl');
    }
    /**
     * display the Faq records
     *
     * @param array $data the Faq data
     */
    function displayGird($data = array()) {
	    global $GENERAL;		
		$this->tpl->assign('GENERAL', $GENERAL);
		$arrysearch["search_by_cname"] = $this->searchbycname;
		$arrysearch["search_by_pname"] = $this->searchbypname;
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('status',$this->status);
		$this->tpl->assign('countRecords', $this->countRecords);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		$this->tpl->assign('formvars',$arrysearch);
	    $this->tpl->display('ofpmanagement.tpl');        
    }
}
?>