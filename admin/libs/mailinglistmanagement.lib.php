<?php
/**
 * Mailing List Management application library
 *
 */
class MailingListManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_newsletter_subscribers";
	var $sortcolumn="email";
	var $sortdirection="asc";
	
    /**
     * class constructor
     */
    function MailingListManagement(){
        $this->tpl =& new Smarty;
		$this->db();
    }
	
	// function for importing data in to csv file 
	function exportMysqlToCsv($filename = 'export.csv')
{
    $csv_terminated = "\n";
    $csv_separator = ",";
    $csv_enclosed = '"';
    $csv_escaped = "\\";
   	$sql_query = "select *  from ".$this->tablename." ORDER BY nsid desc";
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
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars) {

		// reset error message
        $this->error = null;
        
		// test if "Title" is empty
        if(strlen(trim($formvars['email'])) == 0) {
            $this->error = 'Please provide email address';
            return false; 
        }
        if(strlen($formvars['email']) > 0)
		{
			if (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",$formvars['email']))
			{
            	$this->error = 'You must supply a valid email address';
	            return false; 
			}
        }

        
	    return true;
    }
  	 /**
     * add a new Gallery entry
     *
     * @param array $formvars the form variables
     */
    function addEntry($formvars) 
	{
		$_query = " select * from ".$this->tablename." where email = '".$formvars['email']."' ";
		$fetch=$this->select($_query);
		if($fetch){
			$this->error="This email address is already included in the mailing list. Please add other email address.";
			return false;
		}
    	$record['name']=$this->mySQLSafe( $formvars['name']);
		$record['email']=$this->mySQLSafe( $formvars['email']);
		$record['companyname']=$this->mySQLSafe( $formvars['companyname']);
		$record['designation']=$this->mySQLSafe( $formvars['designation']);
		$record['isactive']=$this->mySQLSafe( $formvars['isactive']);
		$record['dated']=$this->mySQLSafe( date("Y-m-d H:m:s") );
				
	  	if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="The subscriber has been added successfully.";
			return true;
		}
		else
		{
			$this->error="The subscriber has not been added successfully.";
			return false;
		}
    }  
	/*
	* load record from data base.
	*/
	function editEntry($nsid=0)
	{
		$_query = "select *  from ".$this->tablename." where nsid=$nsid";
		
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["nsid"]=$fetch[0]["nsid"];
			$data['name'] = $fetch[0]['name'];
			$data["email"]=$fetch[0]["email"];
			$data["companyname"]=$fetch[0]["companyname"];
			$data["designation"]=$fetch[0]["designation"];
			$data['isactive'] = $fetch[0]['isactive'];
		}
        return $data; 
	}  
 	/**
     * Updating mailing list entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars) {

		$_query = " select * from ".$this->tablename." where email = '".$formvars['email']."' and nsid != '".$formvars['nsid']."' ";
		$fetch=$this->select($_query);
		if($fetch){
			$this->error="This email address is already included in the mailing list. Please add another email address.";
			return false;
		}

        $record['name']=$this->mySQLSafe( $formvars['name']);
		$record['email']=$this->mySQLSafe( $formvars['email']);
		$record['companyname']=$this->mySQLSafe( $formvars['companyname']);
		$record['designation']=$this->mySQLSafe( $formvars['designation']);		
		$record['isactive']=$this->mySQLSafe( $formvars['isactive']);
				
		$where="nsid=".$formvars['nsid'];
		if($this->update($this->tablename,$record,$where))
		{
			$this->error="The subscriber has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="The subscribers has not been updated.";
			return false;
		}
    }
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($nsid=0)
	{
		$_query="delete from ".$this->tablename." where nsid=$nsid";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	
			$this->error="The subscriber has been deleted successfully.";
			return true;
		}
		else
		{
			$this->error="The subscriber has not been deleted successfully.";
			return false;
		}			
	}	
    /**
     * get the mailing list entries
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
		$paging->num= $this->numrows("select nsid from ".$this->tablename);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$where=" ";
		
		$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing record found";
		   $data=null;
		  }
	    return $data;
    }
    /**
     * display the mailing list entry form
     *
     * @param array $formvars the form variables
     */
    function displayForm($formvars = array()) {

		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('data',$formvars);
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('mailinglistmanagement.tpl');
    }
    /**
     * display the mailing list records
     *
     * @param array $data the mailing list data
     */
    function displayGrid($data = array()) {
	    global $GENERAL;		
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('mailinglistmanagement.tpl');        
    }
}
?>