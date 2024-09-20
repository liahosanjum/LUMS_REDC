<?php
class Header extends db
{
    var $tpl = null;
	var $error = null;
	var $tablename = "redc_page_content";

    function Header() {
       	$this->db();
	    $this->tpl =& new Smarty;
    }
	function getPcontent()
	{
		$pages = array();
			
		$_query = "select pcid from redc_page_content where psid=1 and visible='Yes' order by pageorder limit 1";
		$rs = $this->execute($_query);
			if($rs!=false)
			{
				$fetch = mysql_fetch_array($rs);
				$pages["unique"]=$fetch["pcid"];
			}

		$_query = "select pcid from redc_page_content where psid=3  and visible='Yes' order by pageorder limit 1";
		$rs = $this->execute($_query);
		if($rs!=false)
		{
			$fetch = mysql_fetch_array($rs);
			$pages["facility"]=$fetch["pcid"];
		}
		$_query = "select pcid from redc_page_content where pagename ='Virtual Tour' order by pageorder limit 1";
		$rs = $this->execute($_query);
		if($rs!=false)
		{
			$fetch = mysql_fetch_array($rs);
			$pages["virtual"]=$fetch["pcid"];
		}
		$_query = "select pcid from redc_page_content where pagename ='Programme'  and visible='Yes' order by pageorder limit 1";
		$rs = $this->execute($_query);
		if($rs!=false)
		{
			$fetch = mysql_fetch_array($rs);
			$pages["programme"]=$fetch["pcid"];
		}
		$_query = "select pcid from redc_page_content where pagename ='Enrollment'  and visible='Yes' order by pageorder limit 1";
		$rs = $this->execute($_query);
		if($rs!=false)
		{
			$fetch = mysql_fetch_array($rs);
			$pages["enrollment"]=$fetch["pcid"];
		}
		$_query = "select pcid from redc_page_content where pagename ='Alumni'  and visible='Yes' order by pageorder limit 1";
		$rs = $this->execute($_query);
		if($rs!=false)
		{
			$fetch = mysql_fetch_array($rs);
			$pages["alumni"]=$fetch["pcid"];
		}
		
		$_query = "select pcid from redc_page_content where psid=8  and visible='Yes' order by pageorder limit 1";
		$rs = $this->execute($_query);
		if($rs!=false)
		{
			$fetch = mysql_fetch_array($rs);
			$pages["conference"]=$fetch["pcid"];
		}
		
		return $pages;
	}
	
	
	function displayPage() 
	{
	
		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		if(isset($_SESSION['message']))
		{
			$this->tpl->assign('error', $_SESSION['message']);
			$_SESSION['message'] = '';
		}
		else
		{
		    $this->tpl->assign('error', $this->error);
		}
		
		$this->tpl->assign('pcontent',$this->getPcontent());
		$this->tpl->display('header.tpl');
	}	
}
?>