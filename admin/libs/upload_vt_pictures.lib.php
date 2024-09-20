<?php
/**
 * Podcast Audio Management application library
 *
 */
class upload_vt_pictures extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_vt_pictures";
	var $sortcolumn=" vtpid ";
	var $sortdirection=" asc ";
	var $title = "";
	var $imgMinWidth  = 730;
	var $imgMinHeight = 400;	
    /**
     * class constructor
     */
    function upload_vt_pictures() {
     	$this->tpl =& new Smarty;
		$this->db();
    }



	 function isValidSorting($formvars) {
		$isvalid = true;
	  	$indexes = $formvars['sort_index'];
		for($i=0; $i<count($indexes);$i++)
		{
			if(!ereg("^[0-9]+$", $indexes[$i]))
			{			
				$isvalid = false;
				$this->error = 'Sort index should be a positive number for each record';
				break;
			}
		}
				
		return $isvalid;
	  }
	  

    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars,$files = "",$_mode = "") {

		// reset error message
     $this->error = null;
       if(strlen(trim($formvars['imgtitle'])) == 0) {
            $this->error = 'Please provide title for picture.';
            return false; 
        }

	 if($_REQUEST['mode'] == 'add'){
			if(strlen($files['imagefile']['name']) == 0 || $files['imagefile']['size'] == 0) {
				$this->error = 'Please provide image.';
				return false; 
			}
			if($files['imagefile']['size'] > '2097152')  ////// 2MB
			{
						$this->error= "Image has large size.";
						return false;
			}

			list($width , $height) = getimagesize($files['imagefile']['tmp_name']);
			if($width < $this->imgMinWidth && $height <  $this->imgMinHeight)
			{
				$this->error = 'Image must have minimum dimensions of 730px x 400px.';
				return false; 
			}

			$ImageExtensions = array("image/jpg","image/png","image/jpeg","image/gif","image/bmp","image/pjpeg");
			$check = $files['imagefile']['type'];
			if(!in_array($check, $ImageExtensions)){
				$this->error= "Invalid image format.";
				return false;
			}		
		}
		
		if($_REQUEST['mode'] == "edit")
		{
			if(strlen($files['imagefile']['name']) > 0 )
				{
					if($files['imagefile']['size'] > '2097152')  /////// 2MB
					{
						$this->error= "Image has large size.";
						return false;
					}

					list($width , $height) = getimagesize($files['imagefile']['tmp_name']);
					if($width < $this->imgMinWidth && $height <  $this->imgMinHeight)
					{
						$this->error = 'Image must have minimum dimensions of 730px x 400px.';
						return false; 
					}
					$ImageExtensions = array("image/jpg","image/png","image/jpeg","image/gif","image/bmp","image/pjpeg");
					$check = $files['imagefile']['type'];
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
	/*
		var_export(func_get_args());
		exit;
	*/	
		$name = $dest.$filename;

		if (preg_match("/\\.jpg$/",strtolower($name))){$src_img=imagecreatefromjpeg($name);}
		if (preg_match("/\\.jpeg$/",strtolower($name))){$src_img=imagecreatefromjpeg($name);}
		if (preg_match("/\\.png$/",strtolower($name))){$src_img=imagecreatefrompng($name);}
		if (preg_match("/\\.gif$/",strtolower($name))){$src_img=imagecreatefromgif($name);}
//		if (preg_match("/\\.bmp$/",strtolower($name))){require_once("bmp.php"); $src_img=imagecreatefrombmp($name);}
	
		$new_h = $height;
		$new_w = $width;
		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);
	
		
		
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
    	//$this->title = $_REQUEST['title'];
		//$record['title']=$this->mySQLSafe( $formvars['title']);
		$record['vtgid']			=	$this->mySQLSafe( $_GET['vtgid']);
		$record['imgtitle']	=	$this->mySQLSafe( $formvars['imgtitle'] );
		$record['description']	=	$this->mySQLSafe( $formvars['description'] );
		if(strlen($files['imagefile']['name']) > 0 )
		{   
			$FileName = time()."_".$files['imagefile']['name'];
			$FileName = str_replace(' ', '_', $FileName);
		
			$Imagepath = PHYSICAL_PATH."/uploads/virtualtours/";
			
			
			
			/***************************************************************************************************/
			
				$image = new Resize_Image;
	
				$image->new_width = $this->imgMinWidth;
				$image->new_height = $this->imgMinHeight;
				
				$image->image_to_resize = $files['imagefile']['tmp_name']; // Full Path to the file
				
				$image->ratio = false; // Keep Aspect Ratio?
				
				// Name of the new image (optional) - If it's not set a new will be added automatically
				
//				$image->new_image_name = $FileName;
//				echo substr($FileName, 0, strrpos($FileName, "."));die;
				$image->new_image_name = substr($FileName, 0, strrpos($FileName, "."))	;
				
				/* Path where the new image should be saved. If it's not set the script will output the image without saving it */
				
				$image->save_folder = $Imagepath;
				
				$process = $image->resize();
				
				if($process['result'] && $image->save_folder)
				{
					 $this->createThumbnail($FileName, $Imagepath, 153, 113);
					$record['imagefile']=$this->mySQLSafe($FileName);
				}

			
			/***************************************************************************************************/
/*			
			if(move_uploaded_file($files['imagefile']['tmp_name'], $Imagepath.$FileName))
			{
				 $this->createThumbnail($FileName, $Imagepath, 153, 113);
				$record['imagefile']=$this->mySQLSafe($FileName);
			}
*/			
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
	
		//$this->title = $_REQUEST['title'];
		$_query = "select *  from ".$this->tablename." where vtpid=$id";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["id"]=$fetch[0]["vtpid"];
			$data["imgtitle"]=$fetch[0]["imgtitle"];
			$data["description"]=$fetch[0]["description"];
			$data['image'] = $fetch[0]['imagefile']; 
			$data['old_image'] = $fetch[0]['imagefile'];
			 
		}
		
        return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$id,$files) {

     
		$record['imgtitle']=$this->mySQLSafe($formvars['imgtitle']);
		$record['description']=$this->mySQLSafe($formvars['description']);
		
		if(strlen($files['imagefile']['name']) > 0 )
		{
			$FileName = time()."_".$files['imagefile']['name'];
			$FileName = str_replace(' ', '_', $FileName);
			
			$fnameforthumb = $FileName;
			
			$Imagepath = PHYSICAL_PATH."/uploads/virtualtours/";
			

			/***************************************************************************************************/
			
				$image = new Resize_Image;
	
				$image->new_width = $this->imgMinWidth;
				$image->new_height = $this->imgMinHeight;
				
				$image->image_to_resize = $files['imagefile']['tmp_name']; // Full Path to the file
				
				$image->ratio = false; // Keep Aspect Ratio?
				
				// Name of the new image (optional) - If it's not set a new will be added automatically
				
				$image->new_image_name = substr($FileName, 0, strrpos($FileName, "."))	;
				
				/* Path where the new image should be saved. If it's not set the script will output the image without saving it */
				
				$image->save_folder = $Imagepath;
				
				$process = $image->resize();
				
				if($process['result'] && $image->save_folder)
				{
					$this->createThumbnail($FileName, $Imagepath, 153, 113);
					$record['imagefile']=$this->mySQLSafe($FileName);
					
					$_query = "select imagefile from ".$this->tablename." where vtpid = ".$formvars['id']." ";
					$fetch=$this->select($_query);
					
					$old_image = $fetch[0]['imagefile'];
					
					if($old_image or $old_image!='')
					{
						$oldImagepath = PHYSICAL_PATH."/uploads/virtualtours/".$old_image;
						$thumbnail = PHYSICAL_PATH."/uploads/virtualtours/thn_".$old_image;
						@unlink($oldImagepath);
						@unlink($thumbnail);
					}	
				}

			
			/***************************************************************************************************/
/*
			if(move_uploaded_file($files['imagefile']['tmp_name'], $Imagepath.$FileName))
			{
				$this->createThumbnail($FileName, $Imagepath, 153, 113);
				$record['imagefile']=$this->mySQLSafe($FileName);
				
				$_query = "select imagefile from ".$this->tablename." where vtpid = ".$formvars['id']." ";
				$fetch=$this->select($_query);
				
				$old_image = $fetch[0]['imagefile'];
				
				if($old_image or $old_image!='')
				{
					$oldImagepath = PHYSICAL_PATH."/uploads/virtualtours/".$old_image;
					$thumbnail = PHYSICAL_PATH."/uploads/virtualtours/thn_".$old_image;
					@unlink($oldImagepath);
					@unlink($thumbnail);
				}	
				
			}
*/		
		}
		
		
		$where="vtpid=".$id;
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
		$Imagepath = PHYSICAL_PATH."/uploads/virtualtours/".$FileName;
		
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
	  $oldImagepath = PHYSICAL_PATH."/uploads/virtualtours/".$src;
	  @unlink($oldImagepath);
	}
	
	
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($id=0)
	{
		 
		 //$this->title = $_REQUEST['title'];
		  $_query = "select imagefile from ".$this->tablename." where vtpid = ".$id." ";
		  $fetch=$this->select($_query);
		  $old_image = $fetch[0]['imagefile'];
		  if($old_image or $old_image!='')
		   {
		   	// delete actual image
			  $oldImagepath = PHYSICAL_PATH."/uploads/virtualtours/".$old_image;
			  @unlink($oldImagepath);
			  // delete thumbnail
  			  $oldImagepath = PHYSICAL_PATH."/uploads/virtualtours/thn_".$old_image;
			  @unlink($oldImagepath);
		   }
		   	
				 
		$_query="delete from ".$this->tablename." where vtpid=$id";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
			$this->error="Picture has been deleted successfully.";
			return true;
		}
		else
		{
			$this->error="Picture has not been deleted.";
			return false;			
		}
	}	
    /**
     * get the Faqs entries
	  * @param start variables use for paging.
     */
    function getEntries($_start=0,$formvars) {
	
     
		//$this->title = $_REQUEST['title'];
		
		$where = ' where vtgid = '.$_GET['vtgid']; 
		
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
		$paging->num= $this->numrows("select vtpid from ".$this->tablename.$where);
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
		   $this->error="No existing Picture found.";
		   $data=null;
		  }
	    return $data;   
    }


	function getSortedEntries() {

		$orderby=" order by sort_index";		
		$_query = "select * from " . $this->tablename ." where vtgid = '".$_GET['vtgid']."' " . $orderby;
		//echo($_query);
		$recordset=mysql_query($_query);
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
	
		if(!isset($data))
		{
			$this->error="No existing pictures found";
			$data=null;
		}
        return $data;   
    }
	
	function saveCats($formvars)
	{
	    $pageids = split("-",substr_replace($formvars['catids'],"",-1));
		for($i=0; $i < count($pageids); $i++)
		{
		    $record['sort_index']=$this->mySQLSafe(($i+1));
			$where="vtpid=".$pageids[$i];
	        $this->update($this->tablename,$record,$where);
		}
		$this->error = "Virtual tour pictures order have been saved successfully.";
		return true;	  
	}

	function sortListing($formvars)
	{
		$ids = $formvars['vtpid'];
		$indexes = $formvars['sort_index'];
		
		for($i=0; $i < count($ids); $i++)
		{
			$_query = "update ".$this->tablename." set sort_index = ".$indexes[$i]." where vtpid = ".$ids[$i];
			mysql_query($_query);
		}
		
		$this->error="Sorting has been saved successfully";
	}




    /**
     * display the Faq entry form
     *
     * @param array $formvars the form variables
     */
    function displayForm($formvars = array()) {

		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		
		$this->title = $_REQUEST['title'];
	
		$this->tpl->assign('title',$this->title);
				
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
        $this->tpl->display('upload_vt_pictures.tpl');
    }
    /**
     * display the Faq records
     *
     * @param array $data the Faq data
     */
    function displayGird($data = array()) {
	
	    global $GENERAL;		
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('title',$this->title);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('total_cats', count($data));
		
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		//Sort Order 
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('upload_vt_pictures.tpl');        
    }
}
?>