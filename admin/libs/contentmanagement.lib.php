<?php
/**
 * Content Management application library
 *
 */
class ContentManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_page_content";
	var $table_section="redc_page_section";
	var $sortcolumn="pageorder";
	var $sortdirection="asc";
	
    /**
     * class constructor
     */
    function ContentManagement() {
        if(!isset($_REQUEST['section_id']) || $_REQUEST['section_id'] == "")
		{
		  header("Location:index.php");
		  exit;
		}
		$this->tpl = new Smarty;
		$this->db();
    }
 	/**
     * test if form information is valid
     */
    function isValidForm($formvars) {
		// reset error message
        $this->error = null;
		
        if(strlen(trim($formvars['pagename'])) == 0) {
            $this->error = 'Please provide page name';
            return false; 
        }

        if(strlen(trim($formvars['pagetitle'])) == 0) {
            $this->error = 'Please provide page title';
            return false; 
        }

        if(strlen(trim($formvars['explorertitle'])) == 0) {
            $this->error = 'Please provide explorer title';
            return false; 
        }
	
	    if(strlen(trim($formvars['menu_title'])) == 0) {
            $this->error = 'Please provide menu title';
            return false; 
        }

	   /* if(strlen(trim($formvars['content'])) == 0) {
            $this->error = 'Please provide page Details';
            return false; 
        }*/
	
	    if(strlen(trim($formvars['keywords'])) > 300) {
            $this->error = 'Please provide keywords of max 300 characters';
            return false; 
        }

	   if(strlen(trim($formvars['description'])) > 300) {
            $this->error = 'Please provide description of max 300 characters';
            return false; 
        }
	
	    return true;
    }
	/*
	* load record from data base.
	*/
	function editEntry($id=0)
	{
		$_query = "select * from ".$this->tablename." where pcid=$id";
		$fetch=$this->select($_query);
		if($fetch)
		{
			// Fill all field 
			$data["id"]=$fetch[0]["pcid"];
			$data['pagename'] = $fetch[0]['pagename'];
			$data['explorertitle'] = $fetch[0]['explorertitle'];
    		$data['pagetitle'] = $fetch[0]['pagetitle'];
    		$data['menu_title'] = $fetch[0]['menutitle'];
			$data['visible'] = $fetch[0]['visible'];
			$data['keywords'] = $fetch[0]['keywords'];
			$data['description'] = $fetch[0]['description'];
			$data['pagecontent'] = $fetch[0]['details'];
			$data['isdynamic'] = $fetch[0]['isdynamic'];
		}
		return $data;   
	}	
	/**
     * Updating content entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars) {
		$record['pagename']=$this->mySQLSafe( $formvars['pagename']);
		$record['explorertitle']=$this->mySQLSafe( $formvars['explorertitle']);
		$record['pagetitle']=$this->mySQLSafe( $formvars['pagetitle']);
		$record['menutitle']=$this->mySQLSafe( $formvars['menu_title']);
		$record['visible']=$this->mySQLSafe( $formvars['visible']);
		$record['keywords']=$this->mySQLSafe($formvars['keywords']);
		$record['description']=$this->mySQLSafe($formvars['description']);
		$record['details']=$this->mySQLSafe($formvars['content']);
		$where="pcid=".$formvars['id'];

		if($this->update($this->tablename,$record,$where))
		{
	    	$this->error="Page has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="Page has not been updated.";
			return false;
		}
        
    }
   /**
     * get the Page content entries
	  * @param start variables use for paging.
     */
	function getEntries($_start=0,$formvars) {

		$data=null;
		if(isset($formvars['sortcolumn']) && isset($formvars['sortdirection']))
		{
			$this->sortcolumn=$formvars['sortcolumn'];
			$this->sortdirection=$formvars['sortdirection'];
		}else if(isset($_GET['sc']) && isset($_GET['sd']))
		{
			$this->sortcolumn=$_GET['sc'];
			$this->sortdirection=$_GET['sd'];
		}
		//$where =" where is_newsletter_broucher='Yes'";
		/// Paging for data tables
		$paging = new Paginate();
		//$paging->num= $this->numrows("select * from ".$this->tablename);
		$paging->num= $this->numrows("select pcid from ".$this->tablename. " where psid ='".$formvars['section_id']."'");
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?section_id=".$formvars['section_id'],PAGESIZE);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		
		$_where = "where psid = '".$formvars['section_id']."' ";
		
		$_query = "select * from " . $this->tablename. " ".$_where." ". $orderby ."  Limit $paging->start,$paging->limit";
		
		$fetch=$this->select($_query);
		
		if($fetch != false)
		{
			$data=$fetch;
		}
		else
		{
		  $this->error="No existing content page found";
		}
	return $data;   
    }
	
	 /*
    function getEntries($_start=0,$formvars) {
		$data=null;
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
		$paging->num= $this->numrows("select pcid from ".$this->tablename. " where psid ='".$formvars['section_id']."'");
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$_where = "where psid = '".$formvars['section_id']."' ";
		$_query = "select * from " . $this->tablename. " ".$_where." ". $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch)
		{
		   $data=$fetch;
		}
		else
		{
			$this->error="No existing page found.";
		}
        return $data;   
    }*/
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($id=0)
	{
		$_query="delete from ".$this->tablename." where pcid=$id";
	
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	$this->error="Page has been deleted successfully.";
			return true;
		}
		else
		{
			$this->error="Page cannot not be deleted.";
			return false;			
		}		
	}
  // add record into database table
   function addEntry($formvars = array())
	{
		$record['pagename']=$this->mySQLSafe($formvars['pagename']);
		$record['explorertitle']=$this->mySQLSafe( $formvars['explorertitle']);
		$record['pagetitle']=$this->mySQLSafe( $formvars['pagetitle']);
		$record['menutitle']=$this->mySQLSafe( $formvars['menu_title']);
		$record['visible']=$this->mySQLSafe( $formvars['visible']);
		$record['keywords']=$this->mySQLSafe($formvars['keywords']);
		$record['description']=$this->mySQLSafe($formvars['description']);
		$record['details']=$this->mySQLSafe($formvars['content']);
		$record['pageorder']=$this->mySQLSafe(count($this->getEntries(0,$formvars))+1);
		$record['psid']=$this->mySQLSafe($formvars['section_id']);
		$record['isdynamic']=$this->mySQLSafe('Y');
		
		

		if($this->insert($this->tablename,$record))
		{
	    	$this->error="The page has been created successfully.";
			return true;
		}
		else
		{
			$this->error="Page has not been saved.";
			return false;
		}
    }
   
   ///// get section information
   function getSectionName($section_id)
	{
	   $_query = "select * from " . $this->table_section ." where psid = '".$section_id."' ";
	   $fetch=$this->select($_query);
	   if($fetch)
		{
		   $data=$fetch[0];
		}
		else
		{
		   header("Location: welcome.php"); 
		   exit;
		}
	  return $data;	
	}
	//// save order of pages
	function saveOrders($formvars)
	{
	    $pageids = split("-",substr_replace($formvars['pageids'],"",-1));

		for($i=0; $i < count($pageids); $i++)
		{
		    $record['pageorder']=$this->mySQLSafe(($i+1));
			
			$where="pcid=".$pageids[$i];
	        $this->update($this->tablename,$record,$where);
		}
		$this->error = "The pages have been sorted successfully.";
		return true;	  
	}
	 function writeHTML()
	{
		
        $_query_redc = "select * from " .$this->tablename . " as pc , ".$this->table_section." as ps  where pc.psid=ps.psid and ps.psid=1 AND visible='Yes' order by pageorder";
	  
		$recordset=$this->execute($_query_redc);
		
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
		if(!isset($data) || $data != null)
		{		
			$fullpath2 = strtolower(__FILE__);
			$fullpath2 = str_replace("\\", "/", $fullpath2);						
			$root2 = substr($fullpath2, 0, strpos($fullpath2, "/admin", 1));
			$fileName = $root2."/uploads/submenucontents.htm";
			if(file_exists($fileName))
			{
				@unlink($fileName);
			}
			@$fp = fopen($fileName, "w+");
			$numItems = count($data);
			$text = "";
			  //$text = $text."<div style='width:983px; margin:0px auto;'>\r\n";
			   $text = $text. "<div class='tabsmenucontent'>\r\n";
			   $text = $text. "<ul>\r\n";
//			   $text = $text."<li><a  class=\"first\" href=\"redc_unique.php?section_id=0&pcid=526\">".$d['pagename']."</a></li>\r\n";
			   foreach ($data as $d)
			   {
			 
			    $text = $text."<li><a  class=\"first\" href=\"redc_unique.php?section_id=1&pcid=".$d['pcid']."\">".$d['pagename']."</a></li>\r\n";
			   
			   }
			   $text = $text. "</ul>\r\n";
			   $text = $text. "</div>\r\n";
			   // code for Programmes
			  /*$file="test.txt";
			  $handle=fopen($file,'w');
			  fwrite($handle,$data);
			  fclose($handle);*/

			$data= null;   
		$_query_programme = "select * from " .$this->tablename . " as pc , ".$this->table_section." as ps  where pc.psid = ps.psid and ps.psid=7 AND visible='Yes' order by pageorder";
	  
		$recordset=$this->execute($_query_programme);
	     $text = $text. "<div class='tabsmenucontent'>\r\n";
		 $text = $text. "<ul>\r\n";
		 $text = $text."<li><a  class=\"first\" href=\"oep_programme.php?section_id=0&pcid=151\">Open Enrollment Programmes</a></li>\r\n";
		 $text = $text."<li><a  class=\"first\" href=\"ofp_programme.php?section_id=0&pcid=150\">Organization Focused Programmes</a></li>\r\n";
		 $text = $text."<li><a  class=\"first\" href=\"prog_finder.php?section_id=0&pcid=300\">Programme Finder</a></li>\r\n";
		 $text = $text."<li><a  class=\"first\" href=\"prog_finder.php?section_id=0&pcid=300\">Calendar</a></li>\r\n";
//		 $text = $text. "</ul>\r\n";
//		 $text = $text. "</div>\r\n";
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
		if(!isset($data) || $data != null)
		{		
			//$text = "";
			  //$text = $text."<div style='width:983px; margin:0px auto;'>\r\n";
//			   $text = $text. "<div class='tabsmenucontent'>\r\n";
//			   $text = $text. "<ul>\r\n";
			   foreach ($data as $d)
			   {
			  /* print_r($d);
			   die();*/
			    $text = $text."<li><a  class=\"first\" href=\"programme.php?section_id=7&pcid=".$d['pcid']."\">".$d['pagename']."</a></li>\r\n";
			   
			   }
	   $text = $text. "</ul>\r\n";
	   $text = $text. "</div>\r\n";
			   
		
		
		
		$data= null;   
		$_query_cs = "select * from " .$this->tablename . " as pc , ".$this->table_section." as ps  where pc.psid = ps.psid and ps.psid=8 AND visible='Yes' order by pageorder";
	  
		$recordset=$this->execute($_query_cs);
		
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
		if(!isset($data) || $data != null)
		{		
			//$text = "";
			  //$text = $text."<div style='width:983px; margin:0px auto;'>\r\n";
			   $text = $text. "<div class='tabsmenucontent'>\r\n";
			   
			   $text = $text. "<ul>\r\n";
			   foreach ($data as $d)
			   {
			  /* print_r($d);
			   die();*/
			    $text = $text."<li><a  class=\"first\" href=\"conference_services.php?section_id=8&pcid=".$d['pcid']."\">".$d['pagename']."</a></li>\r\n";            
			   }
//		        $text = $text."<li><a  class=\"first conferenceservice\" href=\"#\">Request for booking a Facility</a></li>\r\n";			   
			   $text = $text."<li><a  class=\"first\" href=\"virtualtour.php?section_id=0&pcid=323\">Virtual Tour</a></li>\r\n";				
			   
			   $text = $text. "</ul>\r\n";
			   $text = $text. "</div>\r\n";
			   
		
		$_query_fac = "select * from " .$this->tablename . " as pc , ".$this->table_section." as ps  where pc.psid = ps.psid and ps.psid=4 AND visible='Yes' order by pageorder";
	   $data= null;   
		 $recordset=$this->execute($_query_fac);
				
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
		if(!isset($data) || $data != null)
		{		
			//$text = "";
			  //$text = $text."<div style='width:983px; margin:0px auto;'>\r\n";
			   $text = $text. "<div class='tabsmenucontent'>\r\n";
			   $text = $text. "<ul>\r\n";
			  foreach ($data as $d)
			   {
			    $text = $text."<li><a  class=\"first\" href=\"faculty.php?section_id=4&pcid=".$d['pcid']."\">".$d['pagename']."</a></li>\r\n";
			   }
			   $text = $text."<li><a  class=\"first\" href=\"faculty_profiles.php?section_id=4\">Faculty Directory</a></li>\r\n";
			   $text = $text. "</ul>\r\n";
			   $text = $text. "</div>\r\n";
		$_query_facility = "select * from " .$this->tablename . " as pc , ".$this->table_section." as ps  where pc.psid = ps.psid and ps.psid=3 AND visible='Yes' order by pageorder";
	  
		$recordset=$this->execute($_query_facility);
		
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
		if(!isset($data) || $data != null)
		{		
			//$text = "";
			  //$text = $text."<div style='width:983px; margin:0px auto;'>\r\n";
			   $text = $text. "<div class='tabsmenucontent'>\r\n";
			   $text = $text. "<ul>\r\n";
			   foreach ($data as $d)
			   {
			  /* print_r($d);
			   die();*/
			   
			    $text = $text."<li><a  class=\"first\" href=\"facilites.php?section_id=3&pcid=".$d['pcid']."\">".$d['pagename']."</a></li>\r\n";			    
			   }
			  
			   $text = $text. "</ul>\r\n";
			   $text = $text. "</div>\r\n";
		   $data= null;   
		$_query_enroll = "select * from " .$this->tablename . " as pc , ".$this->table_section." as ps  where pc.psid = ps.psid and ps.psid=10 AND visible='Yes' order by pageorder";
	  
		$recordset=$this->execute($_query_enroll);
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
		if(!isset($data) || $data != null)
		{		
			//$text = "";
			  //$text = $text."<div style='width:983px; margin:0px auto;'>\r\n";
			   $text = $text. "<div class='tabsmenucontent'>\r\n";
			   $text = $text. "<ul>\r\n";
			   foreach ($data as $d)
			   {
			  /* print_r($d);
			   die();*/
			    $text = $text."<li><a  class=\"first\" href=\"enrollment.php?section_id=10&pcid=".$d['pcid']."\">".$d['pagename']."</a></li>\r\n";
			   
			   }
//			   $text = $text."<li><a  class=\"first ebroucherrequest\" href=\"#\">Request a Printed Brochure</a></li>\r\n";			   
//			   $text = $text."<li><a  class=\"first apply\" href=\"#\">Apply Online</a></li>\r\n";
			   
			   $text = $text. "</ul>\r\n";
			   $text = $text. "</div>\r\n";
			   $data = null;
		$_query_alu = "select * from " .$this->tablename . " as pc , ".$this->table_section." as ps  where pc.psid = ps.psid and ps.psid=9 AND visible='Yes' order by pageorder";
	  
		$recordset=$this->execute($_query_alu);
		
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
		if(!isset($data) || $data != null)
		{		
			//$text = "";
			  //$text = $text."<div style='width:983px; margin:0px auto;'>\r\n";
			   $text = $text. "<div class='tabsmenucontent'>\r\n";
			   $text = $text. "<ul>\r\n";
//				$text = $text."<li><a  class=\"first alumnilogin\" href=\"alumni_login.php\">REDC Alumni Login</a></li>\r\n";
				$text = $text."<li><a  class=\"first alumnilogin\" href=\"#\">REDC Alumni Login</a></li>\r\n";
				$text = $text."<li><a  class=\"first\" href=\"testimonial.php?section_id=9\">REDC Alumni Testimonials</a></li>\r\n";
			   foreach ($data as $d)
			   {
			  /* print_r($d);
			   die();*/
			    $text = $text."<li><a  class=\"first\" href=\"alumni.php?section_id=9&pcid=".$d['pcid']."\">".$d['pagename']."</a></li>\r\n";
			   
			   }
			   
			   $text = $text. "</ul>\r\n";
			   $text = $text. "</div>\r\n";
			   
			//$text = $text. "</div>\r\n";
			}
			@fwrite($fp, $text);
			@fclose($fp);
			}
			}
		}
		}
		}
		}
		}
		
     /**
     * display the Content entry form
     */
    function displayForm($formvars = array()) {
        global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('data',$formvars);			
		$this->tpl->assign('error', $this->error);
        $this->tpl->assign('section_data', $this->getSectionName($_REQUEST['section_id']));
		$this->tpl->display('contentmanagement.tpl');
    }
    /**
     * list the content page records
     */
    function displayGird($data = array()) {
	    global $GENERAL;
	    $this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('section_data', $this->getSectionName($_REQUEST['section_id']));
		$this->tpl->assign('total_page', count($this->getEntries(0,$_REQUEST)));
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
	    $this->tpl->display('contentmanagement.tpl');        
    }

 
}
?>