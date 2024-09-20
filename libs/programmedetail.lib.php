<?php
/**
 * Content Management application library
 *
 */
    class ProgrammeDetail extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_oep_programmes";
	  /**
     * class constructor
     */
      function ProgrammeDetail() {
        /*if(!isset($_REQUEST['section_id']) || $_REQUEST['section_id'] == "")
		{
		  header("Location:index.php");
		  exit;
		}*/
		$this->tpl = new Smarty;
	    $this->db();
    }
 	function getProgrammeName()
	{
	 $_query = "select name,oepid from " . $this->tablename ." where deadline <=" .(strtotime (date ('Y-m-d')));
	 $nu = $this->select($_query);
	 return $nu;
	}
	function getDetailProgramme($oepid)
	{
		
		$query = "select faculty from ".$this->tablename." where oepid = ".$oepid;
		$fac = $this->select($query);
		
		if($fac != null && $fac[0]['faculty'] != "0")
		{
//		      $query = "SELECT oep. * , fac.name AS fa_facname FROM redc_oep_programmes AS oep, redc_faculty AS fac WHERE oep.faculty = fac.fid AND oepid=$oepid AND         (oep.deadline >'".date("Y-m-d")."' or oep.status = 'tba')";
		      $query = "SELECT oep. * , fac.name AS fa_facname FROM redc_oep_programmes AS oep, redc_faculty AS fac WHERE oep.faculty = fac.fid AND oepid=$oepid AND         (oep.enddate >'".date("Y-m-d")."' or oep.status = 'tba')";
		}
		else
		{
//			 $query = "SELECT * FROM redc_oep_programmes where oepid=$oepid AND (deadline >'".date("Y-m-d")."' or status = 'tba')" ;
			 $query = "SELECT * FROM redc_oep_programmes where oepid=$oepid AND (enddate >'".date("Y-m-d")."' or status = 'tba')";
		}
		
	 
		
		
		
		
		

	$gdp=$this->execute($query);
	 if($gdp!=false)
		{
			$fetch = mysql_fetch_array($gdp);
			// Fill all field 
			$data['name'] = $fetch['name'];
			$data['status'] = $fetch['status'];
    		$data['startdate'] = $fetch['startdate'];
			
			if($fetch['startdate'] > date("Y-m-d") && $fetch['status'] != "tba")
			{
				$this->tpl->assign('avail', 'yes');	
			}
			else
			{
				$this->tpl->assign('avail', 'no');	
			}
			$data['enddate'] = $fetch['enddate'];
			$data['introduction'] = $fetch['introduction'];
			$data['deadline'] = $fetch['deadline'];
			$data['curriculum'] = $fetch['curriculum'];
			$data['participents'] = $fetch['participents'];
			$data['testimonials'] = $fetch['testimonials'];
			$data['learningmodel'] = $fetch['learningmodel'];
			$data['programmelevel'] = $fetch['programmelevel'];
			$data['feecondition'] = $fetch['feecondition'];
			$data['objective'] = $fetch['objective'];
			$data['facultyinfo'] = $fetch['facultyinfo'];
			$data['facultyinfo2'] = $fetch['facultyinfo2'];
			$data['faculty2'] = $fetch['faculty2'];
			/*$data['faculty'] = $fetch['faculty'];*/
			$data['fa_facname'] = $fetch['fa_facname'];
			$data['venue'] = $fetch['venue'];
			$data['oepimage'] = $fetch['cat_image'];
	    }		
	 	
		######################################################################
		
	 	$faculty2 = $data['faculty2'];
		$q = "select * from redc_faculty where fid = $faculty2 ";
	 	 
		 $rs_f2 = mysql_query($q);
		 mysql_num_rows($rs_f2);
		  
	 	if(mysql_num_rows($rs_f2)>0)
	 	{
	 		$rows_f2 = mysql_fetch_array($rs_f2);
			$name = $rows_f2['name'];
			
			$this->tpl->assign('F_name2',$name);
			 
	 	}
	 	
		######################################################################
		return $data; 
	 
	}
		
	function getPcategory()
	{
		$_query = "select * from redc_oep_programmes_category order by sort_index";
		$rs = $this->select($_query);
	 	return $rs;
	}
	function getPcategory_image($catid)
	{
		 $_query = "select cat_image from redc_oep_programmes_category where oepcatid = ".$this->mySQLSafe($catid) ;
		
		$data = $this->select($_query);
		
	 	return $data;
	}
	
	function getgalleryname($oepid)
	{
	  $query="select * from redc_picture_galleries where oepid=$oepid and isactive='Y'";
	 $gal=$this->execute($query);
	 if($gal!=false)
		{
			$fetch = mysql_fetch_array($gal);
			// Fill all field 
			$gdata['name'] = $fetch['name'];
    		$gdata['pgid'] = $fetch['pgid'];
			
	    }
		return $gdata;
	}
	
	/*function getpicturegallery($oepid)
	{
	 $query="select gal .*,cat.image AS category_image From redc_picture_galleries As gal, redc_pictures AS cat where gal.oepid=$oepid AND cat.pgid=gal.pgid";	
	$rs = $this->select($query);
	 	return $rs;
	}*/
	
	function getPage()
	{
		$_query = "select * from redc_page_content where psid = '11' and visible ='Yes'";
		$rs = $this->select($_query);
	 return $rs;
		
	}

    
    function displayGird($data = array()) {
	    global $GENERAL;
	    $this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pname',$this->getProgrammeName());
		$this->tpl->assign('page',$this->getPage());
		$this->tpl->assign('category',$this->getPcategory());
		$this->tpl->assign('pdata', $this->getDetailProgramme($_REQUEST['oepid_']));
		$this->tpl->assign('image', $this->getPcategory_image($_REQUEST['oepcatid']));
		$this->tpl->assign('gdata', $this->getgalleryname($_REQUEST['oepid_']));
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->display('programmedetail.tpl');        
    }

 
}

function getProgrammes($catId)
{
	$tpl = new Smarty;
	$db = new db();
	 $query = "select * from redc_oep_programmes where oepcatid = " .$db->mySQLSafe($catId)."  AND isactive = 'Yes'  AND (enddate >'".date("Y-m-d")."' or status = 'tba' ) ORDER BY sort_index " ;
	$rs = $db->select($query);
	
	return $rs;
}
?>