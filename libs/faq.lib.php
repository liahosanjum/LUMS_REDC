<?php
class Faq extends db
{
    var $tpl = null;
	var $error = null;
	var $tablename  = "redc_faq_categories";
    var $tbl = "redc_faq";
	var $tablecontent = "redc_page_content";
	
      function Faq() {
       	$this->db();
	    $this->tpl =& new Smarty;
    }
	
		/*function loadfcat()
	   {
		$paging = new Frontpaginate();
		$paging->num=$this->numrows("select * from ". $this->tablename);
		$paging->start = 0;
		$paging->limit=PAGESIZEFRONT;
		$paging->Frontpaginate($paging->limit,$paging->num,"?",5);
		$this->tpl->assign('paging',$paging->displayTable());
		//$_query = "select *  from ".$this->tablename. " Limit $paging->start,$paging->limit";
		$_query ="SELECT faq . * , cat.name AS category_name,faq.question AS question,faq.answer AS answer FROM redc_faq AS faq, redc_faq_categories AS cat WHERE faq.fcatid = faq.faqid AND isactive ='Y' ";
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data=$fetch;
		}		
          
        return $data; 
	}*/
	
	
	
	
	// function for getting data across the category
	   function faqData($fcatid)
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
function getFcategory()
	{
		$_query = "select * from redc_faq_categories ";
		$rs = $this->select($_query);
	 	return $rs;
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
		$this->tpl->assign('category',$this->getFcategory());
		$this->tpl->assign('error', $this->error);
		
		$this->tpl->assign('pagedata',$this->getPageData('FAQs'));
		$this->tpl->display('faq.tpl');
	}	
}

function getFaqData($catid)
	{
		$db = new db();
	 //$query = "select * from redc_faq where faqid = $faqid" ;
		$query = "select * from redc_faq where fcatid = " .$db->mySQLSafe($catid)."AND isactive = 'Y'";
		$rs = $db->select($query);
	 	return $rs;
	}
	
	
?>