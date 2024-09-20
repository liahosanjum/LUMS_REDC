<?php
/**
 * Podcast Audio Management application library
 *
 */

class oeppodcastManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_oep_podcast";
	var $oeptblname = "redc_oep_programmes";
	var $sortcolumn="podcastid";
	var $sortdirection="desc";
	
    /**
     * class constructor
     */
    function oeppodcastManagement() {
     	$this->tpl =& new Smarty;
		$this->db();
    }
    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars ,$files=0) {

		// reset error message
        $this->error = null;
        

        if(strlen(trim($formvars['title'])) == 0) {
            $this->error = 'Please provide Podcast Title.';
            return false;  
        }
		 
		if($_REQUEST['mode'] == 'add')
		{
			if(strlen(trim($files['pvideo']['name'])) == 0 )
			{
				$this->error = 'Please upload video';
				return false;  
			}
			
			if(strlen(trim($files['pimage']['name'])) == 0 )
			{
				$this->error = 'Please upload thumbnail';
				return false;  
			}
		}
		
		if(strlen(trim($files['pvideo']['name'])) > 0 )
		{
			if($files['pvideo']['size'] > '52428800')
			{
				$this->error= "file has large size than 50 mb.";
				return false;
			}
			$ImageExtensions = array("video/flv", "video/x-flv","application/octet-stream");
			$check = $files['pvideo']['type'];
			if(!in_array($check, $ImageExtensions)){
				$this->error= "Invalid video format.";
				return false;
			}
		}
		
		/*if($_REQUEST['mode'] == 'add'){
			if(strlen($files['pimage']['name']) == 0 || $files['pimage']['size'] == 0) {
				$this->error = 'Please provide thumbnail.';
				return false; 
			}
				
		}*/
		
		if(strlen(trim($files['pvideo']['name'])) > 0 )
		{
			if($files['pimage']['size'] > '2097152')  ////// 2MB
			{
						$this->error= "Image has large size than 2 MB.";
						return false;
			}
	
			$ImageExtensions = array("image/jpg","image/png","image/jpeg","image/gif","image/bmp","image/pjpeg");
			$check = $files['pimage']['type'];
			if(!in_array($check, $ImageExtensions)){
				$this->error= "Invalid thumbnail format.";
				return false;
			}	
			
			list($width , $height) = getimagesize($files['pimage']['tmp_name']);
	//		if($width < $this->imgMinWidth && $height <  $this->imgMinHeight)
			if($width != 100 && $height !=  100)
			{
				$this->error = 'Image must have dimensions of 100px x 100px.';
				return false; 
			}
		}
		

		return true;
    }
  
  	/*function getOepInfor()
	{
		$_query = "select oepid , name from ".$this->oeptblname;
		return $this->select($_query);
	}*/
		
  
  	 /**
     * add a new Alumni entry
     *
     * @param array $formvars the form variables
     */
    function addEntry($formvars,$files) 
	{
	
		$record['title']=$this->mySQLSafe( $formvars['title']);
		//$record['oepid']=$this->mySQLSafe( $formvars['oepid']);
		if(strlen ($files ['pvideo']['name'])>0)
		{
			$fileName = time()."-".$files['pvideo']['name'];
			$fileName =str_replace (' ','-', $fileName);
			$imagepath = PHYSICAL_PATH."/uploads/podcasts/";
	
			if(move_uploaded_file($files['pvideo']['tmp_name'], $imagepath.$fileName))
			{
				$record['pvideo']=$this->mySQLSafe($fileName);
			}
		}	
		
		if(strlen ($files ['pimage']['name'])>0)
		{
			$fileName = time()."-".$files['pimage']['name'];
			$fileName =str_replace (' ','-', $fileName);
			$imagepath = PHYSICAL_PATH."/uploads/podcasts/";
	
			if(move_uploaded_file($files['pimage']['tmp_name'], $imagepath.$fileName))
			{
				$record['pimage']=$this->mySQLSafe($fileName);
			}
		}	
		
		$record['enabled']=	$this->mySQLSafe( $formvars['enabled']);
		if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="The Podcast has been added successfully.";
			return true;
		}
		else
		{
			$this->error="The Podcast was not added.";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	
	
	
	function editEntry($podcastid =0)
	{
		$_query = "select *  from ".$this->tablename." where podcastid =$podcastid ";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["podcastid"]=$fetch[0]["podcastid"];
			//$data["oepid"]=$fetch[0]["oepid"];
			$data["title"]=$fetch[0]["title"];
			$data['pvideo']=$fetch[0]['pvideo'];
			$data['pimage']=$fetch[0]['pimage'];
			$data['enabled']=$fetch[0]['enabled'];
			
		}
		
        return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$podcastid ,$files) {

// 		global $GENERAL;
		$vfilename = "";
		$pfilename = "";
		$_query		=	"select * from ".$this->tablename." where podcastid=$podcastid";
		$recordset	=	$this->execute($_query);
		if($recordset != null)
		{
			$row = mysql_fetch_array($recordset);
			$vfilename = $row['pvideo'];	
			$pfilename = $row['pimage'];	
		}

		$record['title']=$this->mySQLSafe( $formvars['title']);

		//$record['oepid']=$this->mySQLSafe( $formvars['oepid']);
		if(strlen ($files ['pvideo']['name'])>0)
		{
			$fileName = time()."-".$files['pvideo']['name'];
			$fileName =str_replace (' ','-', $fileName);
			$imagepath = PHYSICAL_PATH."/uploads/podcasts/";
			
	
			if(move_uploaded_file($files['pvideo']['tmp_name'], $imagepath.$fileName))
				{
					 //$this->createThumbnail($FileName, $Imagepath, 153, 113);
					$record['pvideo']=$this->mySQLSafe($fileName);
				}
		}	
		
		if(strlen ($files ['pimage']['name'])>0)
		{
			$fileName = time()."-".$files['pimage']['name'];
			$fileName =str_replace (' ','-', $fileName);
			$imagepath = PHYSICAL_PATH."/uploads/podcasts/";
			
	
			if(move_uploaded_file($files['pimage']['tmp_name'], $imagepath.$fileName))
				{
					 //$this->createThumbnail($FileName, $Imagepath, 153, 113);
					$record['pimage']=$this->mySQLSafe($fileName);
				}
		}	
		
		$record['enabled']=	$this->mySQLSafe( $formvars['enabled']);
        $where=" podcastid = ".$podcastid;
	
		if($this->update($this->tablename,$record,$where))
		{
			if(strlen ($files ['pvideo']['name'])>0)
			{
				if(file_exists(PHYSICAL_PATH."/uploads/podcasts/".$vfilename))
				{
					@unlink(PHYSICAL_PATH."/uploads/podcasts/".$vfilename);
				}
			}
			
			if(strlen ($files ['pimage']['name'])>0)
			{
				if(file_exists(PHYSICAL_PATH."/uploads/podcasts/".$pfilename))
				{
					@unlink(PHYSICAL_PATH."/uploads/podcasts/".$pfilename);
				}
			}
			
			$this->error="The Podcast has been updated successfully.";
			return true;
		}
		else
		{
			$this->error ="The Podcast was not updated.";
			return false;
		}
    }

	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($podcastid=0)
	{
		// delete podcast

		$_query		=	"select * from ".$this->tablename." where podcastid=$podcastid";
		$recordset	=	$this->execute($_query);

		if($recordset != null)
		{
			$row = mysql_fetch_array($recordset);
			$vfilename = $row["pvideo"];
			$pfilename = $row["pimage"];
			
			$_query		=	"delete from ".$this->tablename." where podcastid=$podcastid";
			$recordset	=	$this->execute($_query);
			if($recordset) 
			{			
				if($vfilename != "")
				{
					if(file_exists(PHYSICAL_PATH."/uploads/podcasts/".$vfilename))
					{
						@unlink(PHYSICAL_PATH."/uploads/podcasts/".$vfilename);
					}
				}
				
				if($pfilename != "")
				{
					if(file_exists(PHYSICAL_PATH."/uploads/podcasts/".$pfilename))
					{
						@unlink(PHYSICAL_PATH."/uploads/podcasts/".$pfilename);
					}
				}
				$this->error	=	"The Podcast has been deleted successfully.";
				return true;
			}
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
		/// Paging for data tables       
		$paging = new Paginate();
		$paging->num= $this->numrows("select podcastid  from ".$this->tablename);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		  $_query = "select * from ".$this->tablename." where podcastid = podcastid ".$orderby."Limit $paging->start,$paging->limit";
		
		  $fetch=$this->select($_query);
		
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing Podcast found.";
		   $data=null;
		  }
	    return $data;   
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
		
		//$this->tpl->assign('pname', $this->getOepInfor());
		
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('oeppodcastmanagement.tpl');
    }
    /**
     * display the Faq records
     *
     * @param array $data the Faq data
     */
    function displayGird($data = array()) {
	    global $GENERAL;		
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('data', $data);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('status',$this->status);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('oeppodcastmanagement.tpl');        
    }
}
?>