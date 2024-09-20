<?php
class Faq extends db
{
    var $tpl = null;
	var $error = null;
	var $tablename  = "redc_oep_programmes";
    var $tbl = "redc_testimonial";
	var $tablecontent = "redc_page_content";
	
      function Faq() {
       	$this->db();
	    $this->tpl =& new Smarty;
    }
	// function for getting data across the category
	   function testimonialData($fcatid)
	   {
	   $data = null;
	      $_query = "select *  from ".$this->tbl." where fcatid = ".$fcatid['fcatid']." and isactive='Y'";
		  $fe =$this->select($_query);
		 return $fe;
	   }
	   
	   /*function faqData($formvars)
	{
		$data = null;
		$_query = "select *  from ".$this->tblnews." where nid =  ".$formvars['id']." and isactive='Y'";
		$rs = $this->execute($_query);
		if($rs != null)
		{
			$data = mysql_fetch_array($rs);		
		}


        return $data; 
	}*/
	
	
	/*function getFaqDate($catId)
{
	$db = new db();
	$query = "select * from redc_faq where faqid = " .$db->mySQLSafe($catId);
	$rs = $db->select($query);

	return $rs;
}*/
 function getsectionimage($section_id)
	{
		
		$query = "select sec_image from redc_page_section where psid= $section_id";
		$rs=$this->select($query);
		return $rs;
	}
function getprogramme()
	{
	      $_query = "select oepid,name from ".$this->tablename ." order by name asc ";
		  $fetch=$this->select($_query);
          return $fetch; 
	}
	
	
	function getPageData($pagename)
	{
	 $query ="select * from ".$this->tablecontent. " where pagename = ".$this->mySQLSafe($pagename);

	 $rs=$this->execute($query);
		if($rs!=false)
		{
			$fetch = mysql_fetch_array($rs);
			// Fill all field 
			$data["pcid"]=$fetch["pcid"];
			$data['pagename'] = $fetch['pagename'];
    		$data['explorertitle'] = $fetch['explorertitle'];
			$data['pagetitle'] = $fetch['pagetitle'];
			$data['menutitle'] = $fetch['menutitle'];
			$data['keywords'] = $fetch['keywords'];
			$data['description'] = $fetch['description'];
			$data['details'] = $fetch['details'];
			$data['pageorder'] = $fetch['pageorder'];			
		}			
      
	   return $data; 
	
	}
	
	
	/*function displayPage($data= array()) 
	{
		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('pagedata',$this->getPageData('FAQs'));
		if(isset($_SESSION['message']))
		{
			$this->tpl->assign('faq', $this->loadfcat()); 
			 
		}
		
		
		    $this->tpl->assign('error', $this->error);
		
		$this->tpl->assign('faq', $this->loadfcat()); 
		$this->tpl->display('faq.tpl');
	}*/
	
	
		
	function displayPage($data= array()) 
	{
		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		//$this->tpl->assign('faq', $this->loadfcat()); 
		//$this->tpl->assign('fdata', $this->faqData($_REQUEST['fcatid']));
		//$this->tpl->assign('faqdata',$this->getFaqDate());
		$this->tpl->assign('simage', $this->getsectionimage($_REQUEST['section_id']));
		$this->tpl->assign('category',$this->getprogramme());
		$this->tpl->assign('error', $this->error);
		
		$this->tpl->assign('pagedata',$this->getPageData('Alumni'));
		$this->tpl->display('testimonial.tpl');
	}	
}

function getFaqData($catid)
	{
		$db = new db();
	 //$query = "select * from redc_testimonial where testimonialid = $testimonialid" ;
		$query = "select * from redc_testimonials where oepid = " .$db->mySQLSafe($catid)."AND is_active = 'Y'";
		$rs = $db->select($query);
	 	return $rs;
	}
	
	
?>