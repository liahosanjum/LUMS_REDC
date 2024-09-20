<?php
/**
 *
 *
 */
class pageSectionPictures extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_page_section";
	var $sortcolumn="psid";
	var $sortdirection="asc";
	
    /**
     * class constructor
     */
    function pageSectionPictures() {
        $this->tpl =& new Smarty;
		$this->db();
    }
      
    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    
	 function isValidForm($formvars, $files) {

		// reset error message
        $this->error = null;
        
        /*if(strlen($formvars['name']) == 0) {
            $this->error = 'Please provide name';
            return false; 
        }
		
		if(strlen($formvars['price']) == 0) {
            $this->error = 'Please provide price';
            return false; 
        }

		if(!is_numeric($formvars['price']))
		{	
			$this->error = 'Price should be a number';
			return false;
		}*/
		
		if($_REQUEST['mode'] == "edit")
		{
			if(strlen($files['sec_image']['tmp_name']) == 0) {
				$this->error = 'Must provide picture';
				return false; 
			}
			else
			{
				$Imaging = new Utility();
				$isvalid = $Imaging->IsValidImage($files['sec_image']['type']);
				
				if(!$isvalid)
				{
					$this->error = 'Please upload a picture, uploaded file is not a valid image';
					return false; 
				}
				else
				{
					if($formvars['sectionname']=='Site Map' || $formvars['sectionname']=='Virtual Tour')
						{
							if(!$Imaging->CheckImageSize($files['sec_image']['tmp_name'], 951, 135))
							{
								$this->error = 'Please upload a picture with size : 928px x 135px';
								return false; 
							}
						}
					else{
					
							if(!$Imaging->CheckImageSize($files['sec_image']['tmp_name'], 744, 135))
							{
								$this->error = 'Please upload a picture with size : 744px x 135px';
								return false; 
							}
						}
				}
			}
		}
		else
		{
			// check thumbnail
			if($files['sec_image']['tmp_name'] != "")
			{
				$Imaging = new Utility();
				$isvalid = $Imaging->IsValidImage($files['sec_image']['type']);
				
				if(!$isvalid)
				{
					$this->error = 'Please upload a picture, uploaded file is not a valid image';
					return false; 
				}
				else
				{
					if($formvars['sectionname']=='Site Map' || $formvars['sectionname']=='Virtual Tour')
						{
							if(!$Imaging->CheckImageSize($files['sec_image']['tmp_name'], 951, 135))
							{
								$this->error = 'Please upload a picture with size : 928px x 135px';
								return false; 
							}
						}
					else{
					
							if(!$Imaging->CheckImageSize($files['sec_image']['tmp_name'], 744, 135))
							{
								$this->error = 'Please upload a picture with size : 744px x 135px';
								return false; 
							}
						}
				}
			}
		}
			
        
        return true;
    }
	
	function saveNews($formvars)
	{
	    $pageids = split("-",substr_replace($formvars['newsids'],"",-1));
		for($i=0; $i < count($pageids); $i++)
		{
		    $record['sort_index']=$this->mySQLSafe(($i+1));
			$where="item_id=".$pageids[$i];
	        $this->update($this->tblproducts,$record,$where);
		}
		$this->error = "News order have been saved successfully.";
		return true;	  
	}
	
	
	 /**
     * add a new guestbook entry
     * 
     * @param array $formvars the form variables
     */
      
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($psid=0)
	   {
	  		$_query = "select sec_image,title from ".$this->tablename." where psid = ".$psid." ";
			
			$fetch=$this->select($_query);
			
			$old_sec_image = $fetch[0]['sec_image'];
						
			if($old_sec_image or $old_sec_image!='')
			{
				$oldImagepath = PHYSICAL_PATH."/uploads/homeSectionPictures/".$old_sec_image;
				$thumbnail = PHYSICAL_PATH."/uploads/homeSectionPictures/thn_".$old_sec_image;
				@unlink($oldImagepath);
				@unlink($thumbnail);
			}
			if($old_after_image or $old_after_image!='')
			{
				$oldImagepath = PHYSICAL_PATH."/uploads/homeSectionPictures/".$old_after_image;
				$thumbnail = PHYSICAL_PATH."/uploads/homeSectionPictures/thn_".$old_after_image;
				@unlink($oldImagepath);
				@unlink($thumbnail);
			}	
			$_query="delete from ".$this->tablename." where psid=$psid";
		
			$recordset=$this->execute($_query);
			if($recordset) 
			{
				$this->error="Record has been deleted successfully";
				return true;
			}
			else
			{
				$this->error=$_SESSION['message'];
				return false;
				
			}		
			
	}
	
	/*
	* load record from data base.
	*/
	function editEntry($psid=0)
	{
		$_query = "select *  from ".$this->tablename." where psid=$psid";
		if($fetch=$this->select($_query))
		{			
			// Fill all field 
			$data["psid"]=$fetch[0]["psid"];
			$data["sectionname"]=$fetch[0]["sectionname"];
			$data['sec_image'] = $fetch[0]['sec_image']; 
			$data['old_sec_image'] = $fetch[0]['sec_image']; 
			}		
        return $data;   
	}
	/**
     * Updating Country entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$files) {
	  		
		 $where="psid=".$formvars['psid'];
		 $record['sectionname']=$this->mySQLSafe( $formvars['sectionname']);
		 if(strlen($files['sec_image']['name']) > 0 )
		{
			$sec_image = time()."_".$files['sec_image']['name'];
			$sec_image = str_replace(' ', '_', $sec_image);

			$Imagepath = PHYSICAL_PATH."/uploads/homeSectionPictures/";
			
			if(move_uploaded_file($files['sec_image']['tmp_name'], $Imagepath.$sec_image))
			{
				$this->createThumbnail($sec_image, $Imagepath, 153, 113);
				$record['sec_image']=$this->mySQLSafe($sec_image);
		
				$_query = "select sec_image from ".$this->tablename." where psid = ".$formvars['psid']." ";
				
				$fetch=$this->select($_query);
				
				$old_sec_image = $fetch[0]['sec_image'];
				
				if($old_sec_image or $old_sec_image!='')
				{
					$oldImagepath = PHYSICAL_PATH."/uploads/homeSectionPictures/".$old_sec_image;
					$thumbnail = PHYSICAL_PATH."/uploads/homeSectionPictures/thn_".$old_sec_image;
					@unlink($oldImagepath);
					@unlink($thumbnail);
				}	
				
			}
		}	
				if($this->update($this->tablename,$record,$where))
		{
			$this->error="The picture has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="Record has not been updated";
			return true;
		}
	  
    }
	function createThumbnail($sec_image, $dest, $width, $height)
	{
		$name = $dest . $sec_image;
		if (preg_match("/\\.jpg$/",strtolower($name))){$src_img=imagecreatefromjpeg($name);}
		if (preg_match("/\\.jpeg$/",strtolower($name))){$src_img=imagecreatefromjpeg($name);}
		if (preg_match("/\\.png$/",strtolower($name))){$src_img=imagecreatefrompng($name);}
		if (preg_match("/\\.gif$/",strtolower($name))){$src_img=imagecreatefromgif($name);}
		if (preg_match("/\\.bmp$/",strtolower($name))){
			require_once("bmp.php"); 
			$src_img=imagecreatefrombmp($name);
		}
	
		$new_h = $height;
		$new_w = $width;
		//$src_img = $name;
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
			imagepng($dst_img,$dest . 'thn_' . $sec_image);
		}
		else if (preg_match("/\\.jpg$/",strtolower($name)) || preg_match("/\\.jpeg$/",strtolower($name)))
		{
			imagejpeg($dst_img,$dest . 'thn_' . $sec_image);
		}
		else if (preg_match("/\\.gif$/",strtolower($name)))
		{
			imagegif($dst_img,$dest . 'thn_' . $sec_image);
		}
		else if (preg_match("/\\.bmp$/",strtolower($name))) {
			
			imagebmp($dst_img,$dest . 'thn_' . $sec_image); 
		}
		imagedestroy($dst_img); 
		imagedestroy($src_img); 
	}
    /**
     * get the Countrys entries
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
		$paging->num= $this->numrows("select psid from ".$this->tablename);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		
		
		$_query = "select * from ".$this->tablename." ". $orderby ."  Limit $paging->start,$paging->limit";
		
		$data=$this->select($_query);
		
		if($data == false)
	   	  {
		     $this->error="No existing record found";
		     $data = array();
     	  }
	   return $data;   
    }
      ///// change the status of account 
	function updateStatus($formvars)
	{
	
	   $record['status']=$this->mySQLSafe( $formvars['status']);
	   $where="id=".$formvars['id'];
		
		if($this->update($this->tablename,$record,$where))
		{
			$this->error="Record has been updated successfully";
			return true;
		}
		else
		{
			$this->error="Record has not been updated";
			return true;
		}
	}
	///// end change the status of account 
	function displayForm($formvars = array()) {

		// assign the form vars
        global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('data',$formvars);
		$this->tpl->assign('error', $this->error);
		
        $this->tpl->display('pageSectionPictures.tpl');
    }
    function displayGird($data = array(),$formvars = array()) {
	
		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		
		$this->tpl->assign('data', $data);
		$this->tpl->assign('formvars', $formvars);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
	
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('pageSectionPictures.tpl');        

    }
	
}
?>