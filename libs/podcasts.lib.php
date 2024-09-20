<?php
class Podcasts extends db
{
    var $tpl = null;
	var $error = null;
	var $tblpages="tblpages";
	var $tblpodcasts = "redc_oep_podcast";

    function Podcasts() {
       	$this->db();
	    $this->tpl =& new Smarty;
    }
	function loadPodcasts()
	{
		$paging = new Frontpaginate();
		$paging->num=$this->numrows("select * from ". $this->tblpodcasts);
		$paging->start = 0;
		$paging->limit=PAGESIZEFRONT;
		$paging->Frontpaginate($paging->limit,$paging->num,"?",5);
		$this->tpl->assign('paging',$paging->displayTable());
		
		$_query = "select *  from ".$this->tblpodcasts." where enabled='Y'  "." Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			$data=$fetch;
		}		

        return $data; 
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

		$this->tpl->assign('podcasts', $this->loadPodcasts()); 
		$this->tpl->display('podcasts.tpl');
	}	
}
?>