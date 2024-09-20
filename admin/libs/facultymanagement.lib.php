<?php
/**
 * Podcast Audio Management application library
 *
 */
class facultyManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_faculty";
	var $sortcolumn=" fid ";
	var $sortdirection=" asc ";
	var $countRecords = 0;
	
    /**
     * class constructor
     */
    function facultyManagement() {
     	$this->tpl =& new Smarty;
		$this->db();
    }
    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars,$files,$_mode = "") {

		// reset error message
        $this->error = null;
        
		// test if "Title" is empty
        if(strlen(trim($formvars['name'])) == 0) {
            $this->error = 'Please provide Name.';
            return false; 
        }
		if (strlen(trim($formvars['designation']))==0){
         $this->error = 'Please provide Designation.';		
		 return false;
		}
         if (strlen(trim($formvars['education']))==0){
         $this->error = 'Please provide Education.';		
		 return false;
		}
		if(strlen(trim($formvars['education'])) > 300)
		{
		$this->error='please provide Education with 300 characters ';
		return false;
		}
		if(strlen(trim($formvars['areas_interest'])) > 300)
		{
		$this->error='please provide Areas of interest with 300 characters ';
		return false;
		}
         if(strlen(trim($formvars['content'])) == 0) {
            $this->error = 'Please provide Detail.';
            return false; 
        }
		
		if($_REQUEST['mode'] == 'add'){
			/*if(strlen($files['image']['name']) == 0 || $files['image']['size'] == 0) {
				$this->error = 'Please provide file.';
				return false; 
			}*/
			if(strlen (trim ($files['image']['name'])) > 0){
			  ////// 1MB
					if($files['image']['size'] > '1097152')
					{
						$this->error= "Image has large size.";
						return false;
					}
			$ImageExtensions = array("image/jpeg","image/gif","image/png","image/jpg","image/pjpeg");
					$check = $files['image']['type'];
					if(!in_array($check, $ImageExtensions)){
						$this->error= "Invalid file format.";
						return false;
					}
					}		
		}
		
		if($_REQUEST['mode'] == "edit")
		{
		    if(strlen($files['image']['name']) > 0 )
				{
					if($files['image']['size'] > '1097152')  /////// 1MB
					{
						$this->error= "File is larger than 1 MB in size";
						return false;
					}
				
					$ImageExtensions = array("image/jpeg","image/gif","image/png","image/jpg","image/pjpeg");
					$check = $files['image']['type'];
					if(!in_array($check, $ImageExtensions)){
						$this->error= "Invalid file format.";
						return false;
					}
				}
		}
		
		
	  return true;	  
    }
  	 /**
     * add a new faculty entry
     *
     * @param array $formvars the form variables
     */
	 function createThumbnail($filename, $dest, $width, $height)
	{
		$name = $dest . $filename;
		if (preg_match("/\\.jpg$/",strtolower($name))){$src_img=imagecreatefromjpeg($name);}
		if (preg_match("/\\.jpeg$/",strtolower($name))){$src_img=imagecreatefromjpeg($name);}
		if (preg_match("/\\.png$/",strtolower($name))){$src_img=imagecreatefrompng($name);}
		if (preg_match("/\\.gif$/",strtolower($name))){$src_img=imagecreatefromgif($name);}
		if (preg_match("/\\.bmp$/",strtolower($name))){require_once("bmp.php"); $src_img=imagecreatefrombmp($name);}
	
		$new_h = $height;
		$new_w = $width;
		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);
	
		if ($old_x > $old_y) 
		{
			$rat = $old_y/$old_x*100;
			$thumb_w=min($new_w,$old_x);
			$thumb_h = floor($thumb_w * $rat / 100);
		}
		else
		{
			$rat = $old_x/$old_y*100;
			$thumb_h=min($new_h,$old_y);
			$thumb_w = floor($thumb_h * $rat / 100);
		}
	
		$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
		if (preg_match("/\\.png$/",strtolower($name)))
		{
			imagepng($dst_img,$dest . 'thn_' . $filename);
		}
		else if (preg_match("/\\.jpg$/",strtolower($name)) || preg_match("/\\.jpeg$/",strtolower($name)))
		{
			imagejpeg($dst_img,$dest . 'thn_' . $filename);
		}
		else if (preg_match("/\\.gif$/",strtolower($name)))
		{
			imagegif($dst_img,$dest . 'thn_' . $filename);
		}
		else if (preg_match("/\\.bmp$/",strtolower($name))) {
			
			imagebmp($dst_img,$dest . 'thn_' . $filename); 
		}
		imagedestroy($dst_img); 
		imagedestroy($src_img); 
	}
    function addEntry($formvars,$files) 
	{
		$record['name']=$this->mySQLSafe( $formvars['name']);
		$record['designation']=$this->mySQLSafe( $formvars['designation']);
		$record['education']=$this->mySQLSafe( $formvars['education']);
		$record['areas_interest']=$this->mySQLSafe( $formvars['areas_interest']);
		$record['is_active']=$this->mySQLSafe( $formvars['enabled']);
		$record['details']=$this->mySQLSafe($formvars['content']);
		if(strlen($files['image']['name']) > 0 )
		{
			$FileName = time()."_".$files['image']['name'];
			$FileName = str_replace(' ', '_', $FileName);

			$Imagepath = PHYSICAL_PATH."/uploads/faculty-profile/";
			
			if(move_uploaded_file($files['image']['tmp_name'], $Imagepath.$FileName))
			{
				 $this->createThumbnail($FileName, $Imagepath, 153, 113);
				$record['image']=$this->mySQLSafe($FileName);
			}
		}
		
	  	if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="The profile has been added successfully.";
			return true;
		}
		else
		{
			$this->error="The profile has been not added successfully.";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	
	
	
	function editEntry($fid=0)
	{
		$_query = "select *  from ".$this->tablename." where fid=$fid";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["fid"] = $fetch[0]["fid"];
			$data["name"]=$fetch[0]["name"];
			$data["designation"]=$fetch[0]["designation"];
			$data['education'] = $fetch[0]['education']; 
			$data['areas_interest'] = $fetch[0]['areas_interest']; 
			$data["content"]=$fetch[0]["details"];
			$data["enabled"]=$fetch[0]["is_active"];
			$data['image'] = $fetch[0]['image']; 
			$data['old_image'] = $fetch[0]['image'];
			}
		
        return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
	 
	 function updateEntry($formvars,$files) {

//		print_r($formvars);
       	$where="fid=".$formvars['fid'];
		$record['name']=$this->mySQLSafe( $formvars['name']);
		$record['designation']=$this->mySQLSafe( $formvars['designation']);
		$record['education']=$this->mySQLSafe( $formvars['education']);
		$record['areas_interest']=$this->mySQLSafe( $formvars['areas_interest']);
		$record['is_active']=$this->mySQLSafe( $formvars['enabled']);
		$record['details']=$this->mySQLSafe($formvars['content']);
		//$record['image']=$this->mySQLSafe($formvars['image']);
		if(strlen($files['image']['name']) > 0 )
		{

		   $FileName = time()."_".$files['image']['name'];
			$FileName = str_replace(' ', '_', $FileName);
			$Imagepath = PHYSICAL_PATH."/uploads/faculty-profile/";
			 if(move_uploaded_file($files['image']['tmp_name'], $Imagepath.$FileName))
			{

			$this->createThumbnail($FileName,$Imagepath, 153, 113);
				$record['image']=$this->mySQLSafe($FileName);
				$_query = "select image from ".$this->tablename." where fid = ".$formvars['fid']." ";
				$fetch=$this->select($_query);
				$old_image = $fetch[0]['image'];
				 if($old_image or $old_image!='')
				{
					$oldImagepath = PHYSICAL_PATH."/uploads/faculty-profile/".$old_image;
					$thumbnail = PHYSICAL_PATH."/uploads/faculty-profile/thn_".$old_image;
					@unlink($oldImagepath);
					@unlink($thumbnail);
				}	
				
			}
		}	
		       
		if($this->update($this->tablename,$record,$where))
		{
			$this->error="The profile has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="Record has not been updated";
			return true;
		}
    }
	 
   
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($fid=0)
	{
		  $_query="delete from ".$this->tablename." where fid=$fid";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	
			$this->error="faculty profile has been deleted successfully.";
			return true;
		}
		  /*$_query = "select * from ".$this->tablename." where fid = ".$id." ";
			$fetch=$this->select($_query);
			
			$old_image = $fetch[0]['image'];
			
			if($old_image or $old_image!='')
			{
				$oldImagepath = PHYSICAL_PATH."/images/faculty/".$old_image;
				$thumbnail = PHYSICAL_PATH."/images/faculty/thn_".$old_image;
				@unlink($oldImagepath);
				@unlink($thumbnail);
			}	*/
				 
		/*$_query="delete from ".$this->tablename." where fid=$id";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	
			$this->error="faculty has been deleted successfully.";
			return true;
		}*/
		 /*
		else
		{
			$this->error="faculty has not been deleted.";
			return false;			
		}
		 */			
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
		$paging->num= $this->numrows("select fid from ".$this->tablename);
		$this->countRecords = $paging->num;
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$where=" where fid != -1 ";
		
		$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing profile found.";
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
			$this->tpl->assign('data',$formvars);		
		}
		else
		{			
			$this->tpl->assign('data',$formvars);
		}
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('facultymanagement.tpl');
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
		$this->tpl->assign('countRecords', $this->countRecords);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('facultymanagement.tpl');        
    }
}
?>