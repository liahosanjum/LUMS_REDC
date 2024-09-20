<?php
class Search extends db
{
    var $tpl = null;
	var $error = null;
	var $tablename="redc_page_content";	
	var $tblpages = "redc_page_content";
	var $tblnews  = "redc_news";
	var $tbloepprogrammes  = "redc_oep_programmes";
	var $tbloepprogrammescategory  = "redc_oep_programmes_category";
	var $tblfaqcategory  = "redc_faq_categories";
	var $tblfaqs  = "redc_faq";

    function Search() {
       	$this->db();
	    $this->tpl =& new Smarty;
    }
	
	function getsectionimage()
	{
		
		$query = "select sec_image from redc_page_section where psid= 0";
		$rs=$this->select($query);
		return $rs;
	}
	
	function searchContents($_start, $formvars)
	{
		$search = $this->mySQLSafe('%'.$formvars['search'].'%');

		$results = null;
//		$results = array();
		
		// search pages
		$_query = "select distinct * from ".$this->tblpages." where pagename like ".$search." or explorertitle like ".$search." or pagetitle like ".$search." or menutitle like ".$search." or keywords like ".$search." or description like ".$search." or details like ".$search;		
		
		$rs = $this->execute($_query);
		if($rs != null)
		{
			while($fetch = mysql_fetch_array($rs))
			{
				$index = count($results);
				$results[$index]['item_id'] = $fetch['pcid'];
				$results[$index]['section_id'] = $fetch['psid'];
				$results[$index]['title'] = $fetch['pagetitle'];
				$results[$index]['detail'] = $fetch['details'];				
//				$results[$index]['type'] = 'page';
				if($fetch['psid'] == 1)
				{
					$results[$index]['type'] = 'Unique';
				}
				else if($fetch['psid'] == 3)
				{
					$results[$index]['type'] = 'Facilities';
				}
				else if($fetch['psid'] == 4)
				{
					$results[$index]['type'] = 'Faculty';
				}
				else if($fetch['psid'] == 8)
				{
					$results[$index]['type'] = 'Conference';
				}
				else if($fetch['psid'] == 9)
				{
					$results[$index]['type'] = 'Alumni';
				}
				else if($fetch['psid'] == 10)
				{
					$results[$index]['type'] = 'Enrollments';
				}
				else if($fetch['psid'] == 11)
				{
					$results[$index]['type'] = 'OFP';
				}
				else if($fetch['psid'] == 0)
				{
					if($fetch['pagename'] == "Site Map")
					{
						$results[$index]['type'] = 'Map';
					}
					else if($fetch['pagename'] == "Programme Finder")
					{
						$results[$index]['type'] = 'Finder';
					}
					else if($fetch['pagename'] == "Open Enrollment Programme")
					{
						$results[$index]['type'] = 'OEP';
					}
					else if($fetch['pagename'] == "Organisation Focused Programmes")
					{
						$results[$index]['type'] = 'OFP';
					}
					else if($fetch['pagename'] == "Virtual Tour")
					{
						$results[$index]['type'] = 'Virtual';
					}
					else if($fetch['pagename'] == "Search")
					{
						$results[$index]['type'] = 'Search';
					}
					else if($fetch['pagename'] == "News and Events")
					{
						$results[$index]['type'] = 'News';
					}
					else if($fetch['pagename'] == "FAQs")
					{
						$results[$index]['type'] = 'faq';
					}
					else if($fetch['pagename'] == "Faculty Directory")
					{
						$results[$index]['type'] = 'Directory';
					}
					else
					{
						$results[$index]['type'] = 'CMS';
					}
				}
			}
		}
		
		// search news/events
		$_query = "select distinct * from ".$this->tblnews." where title like ".$search." or description like ".$search." or link like ".$search;		
		
		$rs = $this->execute($_query);
		if($rs != null)
		{
			while($fetch = mysql_fetch_array($rs))
			{
				$index = count($results);
				$results[$index]['item_id'] = $fetch['nid'];
				$results[$index]['section_id'] = 0;
				$results[$index]['title'] = $fetch['title'];
				$results[$index]['detail'] = $fetch['description'];
				$results[$index]['type'] = 'news';
			}
		}
		
		// search oep programmes category
		$_query = "select distinct * from ".$this->tbloepprogrammescategory." where name like ".$search;		

		$rs = $this->execute($_query);
		if($rs != null)
		{
			while($fetch = mysql_fetch_array($rs))
			{
				$index = count($results);
				$results[$index]['item_id'] = $fetch['oepcatid'];
				$results[$index]['section_id'] = 0;
				$results[$index]['title'] = $fetch['name'];
				$results[$index]['detail'] = '';
				$results[$index]['type'] = 'programmecategory';
			}
		}
		
		// search oep programmes
		$_query = "select distinct * from ".$this->tbloepprogrammes." where name like ".$search." or introduction like ".$search." or objective like ".$search." or venue like ".$search." or curriculum like ".$search." or participents like ".$search." or learningmodel like ".$search." or faculty like ".$search." or testimonials like ".$search." or feecondition like ".$search." or programmelevel like ".$search;		

		$rs = $this->execute($_query);
		if($rs != null)
		{
			while($fetch = mysql_fetch_array($rs))
			{
				$index = count($results);
				$results[$index]['item_id'] = $fetch['oepid'];
				$results[$index]['section_id'] = $fetch['oepcatid'];
				$results[$index]['title'] = $fetch['name'];
				$results[$index]['detail'] = $fetch['introduction'];
				$results[$index]['type'] = 'programme';
			}
		}
		
		// search faq category
		$_query = "select distinct * from ".$this->tblfaqcategory." where name like ".$search;		

		$rs = $this->execute($_query);
		if($rs != null)
		{
			while($fetch = mysql_fetch_array($rs))
			{
				$index = count($results);
				$results[$index]['item_id'] = $fetch['fcatid'];
				$results[$index]['section_id'] = 0;
				$results[$index]['title'] = $fetch['name'];
				$results[$index]['detail'] = '';
				$results[$index]['type'] = 'faqcategory';
			}
		}
		
		if($faqfound == false)
		{
			// search faqs
			$_query = "select distinct * from ".$this->tblfaq." where question like ".$search." or answer like ".$search;		
	
			$rs = $this->execute($_query);
			if($rs != null && mysql_num_rows($rs) > 0)
			{
				$faqfound = true;
				while($fetch = mysql_fetch_array($rs))
				{
					$index = count($results);
					$results[$index]['item_id'] = $fetch['faqid'];
					$results[$index]['section_id'] = $fetch['fcatid'];
					$results[$index]['title'] = $fetch['question'];
					$results[$index]['detail'] = $fetch['answer'];
					$results[$index]['type'] = 'faq';
				}
			}		
		}		
		
//		print_r($results);

		return $results;
	}
	
	function getPageData($pagename)
	{
	 $query ="select * from ".$this->tablename. " where pagename = ".$this->mySQLSafe($pagename);

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
	
	function displayPage($results) 
	{
		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('simage', $this->getsectionimage($_REQUEST['section_id']));
		if(isset($_SESSION['message']))
		{
			$this->tpl->assign('error', $_SESSION['message']);
			$_SESSION['message'] = '';
		}
		else
		{
		    $this->tpl->assign('error', $this->error);
		}

		$this->tpl->assign('pagedata', $this->getPageData('Search'));
		
		$this->tpl->assign('results', $results);
		$this->tpl->display('search.tpl');
	}		
}
?>