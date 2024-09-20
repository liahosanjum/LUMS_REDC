<?php
class PhotoGallery extends db
{
    var $tpl = null;
	var $error = null;
	var $tblpages="tblpages";
	var $tblpicgalleries  = "redc_picture_galleries";

    function PhotoGallery() {
       	$this->db();
	    $this->tpl =& new Smarty;
    }
	function loadGalleries()
	{
		$paging = new Frontpaginate();
		$paging->num=$this->numrows("select * from ". $this->tblpicgalleries." where isactive='Y' ");
		$paging->start = 0;
		$paging->limit=PAGESIZEFRONT;
		$paging->Frontpaginate($paging->limit,$paging->num,"?",5);
		$this->tpl->assign('paging',$paging->displayTable());
		
		$_query = "select *  from ".$this->tblpicgalleries." where isactive='Y'  "." Limit $paging->start,$paging->limit";
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

		$this->tpl->assign('galleries', $this->loadGalleries()); 
		$this->tpl->display('photogallery.tpl');
	}	
}
?>