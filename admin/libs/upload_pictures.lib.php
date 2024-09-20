<?php
/**
 * Podcast Audio Management application library
 *
 */
class upload_pictures extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_pictures";
	var $sortcolumn=" pid ";
	var $sortdirection=" asc ";
	
    /**
     * class constructor
     */
    function upload_pictures() {
     	$this->tpl =& new Smarty;
		$this->db();
   
   }
	
    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars,$files = "",$_mode = "") {

		// reset error message
        $this->error = null;
        
		// test if "Title" is empty
		
        
		  if($_REQUEST['mode'] == 'add'){
			if(strlen($files['image']['name']) == 0 || $files['image']['size'] == 0) {
				$this->error = 'Please provide image.';
				return false; 
			}
			if($files['image']['size'] > '2097152')  ////// 2MB
					{
						$this->error= "Image has large size.";
						return false;
					}
			$ImageExtensions = array("image/jpg","image/png","image/jpeg","image/gif","image/pjpeg");
					$check = $files['image']['type'];
					if(!in_array($check, $ImageExtensions)){
						$this->error= "Invalid image format.";
						return false;
					}
					/*$Imaging = new Utility();
					if(!$Imaging->CheckImageSize($files['image']['tmp_name'], 696, 400))
					{
						$this->error = 'Please upload a picture with size : 696px x 400px';
						return false; 
					}*/
		}
		
		if($_REQUEST['mode'] == "edit")
		{
		    if(strlen($files['image']['name']) > 0 )
				{
					if($files['image']['size'] > '2097152')  /////// 2MB
					{
						$this->error= "Image has large size.";
						return false;
					}
				
					$ImageExtensions = array("image/jpg","image/png","image/jpeg","image/gif","image/pjpeg");
					$check = $files['image']['type'];
					if(!in_array($check, $ImageExtensions)){
						$this->error= "Invalid image format.";
						return false;
					}
				}
		}
       if(strlen(trim($formvars['description'])) == 0) {
            $this->error = 'Please provide details for picture.';
            return false; 
        }
           	
        return true;
    }
  	 /**
     * add a new Pictureentry
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
//		if (preg_match("/\\.bmp$/",strtolower($name))){require_once("bmp.php"); $src_img=imagecreatefrombmp($name);}
	
		$new_h = $height;
		$new_w = $width;
		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);
	
		if($old_x > $new_w || $old_y > $new_h)
		{
			/*
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

			$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);			*/
			
			$thumb_w = $new_w;
			$thumb_h = $new_h;
			
			$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
			imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
			if (preg_match("/\\.png$/",strtolower($name)))
			{
				imagepng($dst_img,$dest . $filename);
			}
			else if (preg_match("/\\.jpg$/",strtolower($name)) || preg_match("/\\.jpeg$/",strtolower($name)))
			{
				imagejpeg($dst_img,$dest . $filename);
			}
			else if (preg_match("/\\.gif$/",strtolower($name)))
			{
				imagegif($dst_img,$dest . $filename);
			}
			else if (preg_match("/\\.bmp$/",strtolower($name))) {
				
				imagebmp($dst_img,$dest . $filename); 
			}			
		}
		
		// create thumbnails
		$thumb_w = 80;
		$thumb_h = 60;
		
		$dst_img = null;
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
			
		// destroy images
		imagedestroy($dst_img); 
		imagedestroy($src_img); 
	}
	
	function addEntry($formvars,$files) 
	{
    	//$record['title']=$this->mySQLSafe( $formvars['title']);
		$record['pgid']			=	$this->mySQLSafe( $formvars['gid']);
		$record['description']	=	$this->mySQLSafe( $formvars['description'] );
		if(strlen($files['image']['name']) > 0 )
		{
			$FileName = time()."_".$files['image']['name'];
			$FileName = str_replace(' ', '_', $FileName);

			$Imagepath = PHYSICAL_PATH."/uploads/galleries/";
			
			if(move_uploaded_file($files['image']['tmp_name'], $Imagepath.$FileName))
			{
				// resize the image
				$this->createThumbnail($FileName, $Imagepath, 800, 600);
				$record['image']=$this->mySQLSafe($FileName);
			}
		}
				
	  	if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="Picture has been added successfully.";
			return true;
		}
		else
		{
			$this->error="Picture has not been added.";
			return false;			
		}
    }  
	/*
	* load record from data base.
	*/
	
	
	
	function editEntry($id=0)
	{
		$_query = "select *  from ".$this->tablename." where pid=$id";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["id"]=$fetch[0]["pid"];
			$data["description"]=$fetch[0]["description"];
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
    function updateEntry($formvars,$id,$files) {

        //$record['title']=$this->mySQLSafe( $formvars['title']);
		$record['description']=$this->mySQLSafe($formvars['description']);
		//$visible=(isset($formvars['visible']))?"Y":"N";
		//$record['is_featured']=$this->mySQLSafe(isset($formvars['is_featured'])?$formvars['is_featured']:"No");
		if(strlen($files['image']['name']) > 0 )
		{
			$FileName = time()."_".$files['image']['name'];
			$FileName = str_replace(' ', '_', $FileName);

			$Imagepath = PHYSICAL_PATH."/uploads/galleries/";
			
			if(move_uploaded_file($files['image']['tmp_name'], $Imagepath.$FileName))
			{
				$this->createThumbnail($FileName, $Imagepath, 800, 600);
				$record['image']=$this->mySQLSafe($FileName);
				
				$_query = "select image from ".$this->tablename." where pid = ".$formvars['id']." ";
				$fetch=$this->select($_query);
				
				$old_image = $fetch[0]['image'];
				
				if($old_image or $old_image!='')
				{
					$oldImagepath = PHYSICAL_PATH."/uploads/galleries/".$old_image;
					$thumbnail = PHYSICAL_PATH."/uploads/galleries/thn_".$old_image;
					@unlink($oldImagepath);
					@unlink($thumbnail);
				}	
				
			}
		}
		
		
		$where="pid=".$id;
		if($this->update($this->tablename,$record,$where))
		{
			$this->error="Picture has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="Picture has not been updated.";
			return false;
		}
        
    }


	/*
		* To upload new picture.
		* @param filearray src to unlink it.
	*/
	function uploadPicture($files)
	{
		$FileName = time()."_".$files['image_file']['name'];
		$Imagepath = PHYSICAL_PATH."/uploads/galleries/".$FileName;
		
		if(move_uploaded_file($files['image_file']['tmp_name'], $Imagepath))
		{
			return $FileName;
		}
		else
			return false;
	}



	/*
		* To delete existing picture if new one is uploaded.
		* @param pic src to unlink it.
	*/
	function unlinkPicture($src)
	{
	  $oldImagepath = PHYSICAL_PATH."/images/gallery/".$src;
	  @unlink($oldImagepath);
	}
	
	
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($id=0)
	{
		 
		  $_query = "select image from ".$this->tablename." where pid = ".$id." ";

		  $fetch=$this->select($_query);
		  $old_image = $fetch[0]['image'];
		  if($old_image or $old_image!='')
		   {
		   		// delete actual image
			  $oldImagepath = PHYSICAL_PATH."/uploads/galleries/".$old_image;
			  @unlink($oldImagepath);
			  // delete thumbnail
  			  $oldImagepath = PHYSICAL_PATH."/uploads/galleries/thn_".$old_image;
			  @unlink($oldImagepath);
		   }
		   	
				 
		$_query="delete from ".$this->tablename." where pid=$id";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
			$this->error="Picture has been deleted successfully.";
			return true;
		}
		else
		{
			$this->error="Picture was not deleted.";
			return false;			
		}
	}	
    /**
     * get the Faqs entries
	  * @param start variables use for paging.
     */
    function getEntries($_start=0,$formvars) {
        $where = ' where pgid = '.$formvars['gid']; 
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
		$paging->num= $this->numrows("select pid from ".$this->tablename.$where);
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;

		$_query = "select * from " . $this->tablename. $where  . $orderby ."  Limit $paging->start,$paging->limit " ;

		$fetch=$this->select($_query);
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing picture found.";
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
		// assign error message
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('upload_pictures.tpl');
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
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('upload_pictures.tpl');        
    }
}
?>