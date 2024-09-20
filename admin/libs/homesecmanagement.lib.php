<?php
/**
 *
 *
 */
class HomesecManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_home_pictures";
	var $sortcolumn="sort_index";
	var $sortdirection="asc";
	
    /**
     * class constructor
     */
    function HomesecManagement() {
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
	  function saveHomesecs($formvars)
	{
		
	    $pageids = split("-",substr_replace($formvars['homesecids'],"",-1));
		for($i=0; $i < count($pageids); $i++)
		{
		    $record['sort_index']=$this->mySQLSafe(($i+1));
			$where="psid=".$pageids[$i];
	        $this->update($this->tablename,$record,$where);
		}
		$this->error = "Home page picture order have been saved successfully.";
		return true;	  
	} 
    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars,$files=0) {

		// reset error message
        $this->error = null;
        
		// test if "Name" is empty
		if(strlen(trim($formvars['title'])) == 0) {
            $this->error = 'Please provide Title.';
            return false; 
        }

		/*if(strlen(trim($formvars['subtitle'])) == 0) {
            $this->error = 'Please provide Sub Title name.';
            return false; 
        }*/
        /*if(strlen(trim($formvars['pagelink'])) == 0) {
            $this->error = 'Please provide pagelink .';
            return false; 
        }*/
		if($_REQUEST['mode'] == 'add'){
			if(strlen($files['filename']['name']) == 0 || $files['filename']['size'] == 0) {
				$this->error = 'Please provide Picture.';
				return false; 
			}
			if($files['filename']['size'] > '2097152')  ////// 2MB
					{
						$this->error= "Picture has large size.";
						return false;
					}
			$ImageExtensions = array("image/jpg","image/png","image/jpeg","image/gif","image/bmp","image/pjpeg");
					$check = $files['filename']['type'];
					if(!in_array($check, $ImageExtensions)){
						$this->error= "Invalid sectionimage format.";
						return false;
					}
					
			/*if(strlen($files['after_image']['name']) == 0 || $files['after_image']['size'] == 0) {
				$this->error = 'Please provide after image.';
				return false; 
			}*/
			/*if($files['filename']['size'] > '2097152')  ////// 2MB
					{
						$this->error= "After image has large size.";
						return false;
					}
			$ImageExtensions = array("image/jpg","image/png","image/jpeg","image/gif","image/bmp","image/pjpeg");
					$check = $files['after_image']['type'];
					if(!in_array($check, $ImageExtensions)){
						$this->error= "Invalid after image format.";
						return false;
					}				*/
		}
		
		if($_REQUEST['mode'] == "edit")
		{
			
			
		    if(strlen($files['filename']['name']) > 0 )
				{
					if($files['filename']['size'] > '2097152')  /////// 2MB
					{
						$this->error= "section image has large size.";
						return false;
					}
				
					$ImageExtensions = array("image/jpg","image/png","image/jpeg","image/gif","image/bmp","image/pjpeg");
					$check = $files['filename']['type'];
					if(!in_array($check, $ImageExtensions)){
						$this->error= "Invalid section image format.";
						return false;
					}
				}
				
			/*if(strlen($files['after_image']['name']) > 0 )
				{
					if($files['after_image']['size'] > '2097152')  /////// 2MB
					{
						$this->error= "After image has large size.";
						return false;
					}
				
					$ImageExtensions = array("image/jpg","image/png","image/jpeg","image/gif","image/bmp","image/pjpeg");
					$check = $files['after_image']['type'];
					if(!in_array($check, $ImageExtensions)){
						$this->error= "Invalid after image format.";
						return false;
					}
				}	*/
		}
	  return true;	  
    }
	 /**
     * add a new guestbook entry
     * 
     * @param array $formvars the form variables
     */
      function addEntry($formvars,$files) {
	 $record['title']=$this->mySQLSafe( $formvars['title']);
	$record['subtitle']=$this->mySQLSafe( $formvars['subtitle']);
	  $record['pagelink']=$this->mySQLSafe( $formvars['pagelink']);
	  $record['isactive']=$this->mySQLSafe( $formvars['isactive']);
       		
    	if(strlen($files['filename']['name']) > 0 )
		{
			$FileName = time()."_".$files['filename']['name'];
			$FileName = str_replace(' ', '_', $FileName);

			$Imagepath = PHYSICAL_PATH."/uploads/home-pictures/";
			
			if(move_uploaded_file($files['filename']['tmp_name'], $Imagepath.$FileName))
			{
				 $this->createThumbnail($FileName, $Imagepath, 153, 113);
				$record['filename']=$this->mySQLSafe($FileName);
			}
		}
		
		if(strlen($files['after_image']['name']) > 0 )
		{
			$FileName = time()."_".$files['after_image']['name'];
			$FileName = str_replace(' ', '_', $FileName);

			$Imagepath = PHYSICAL_PATH."/uploads/home-pictures/";
			
			if(move_uploaded_file($files['after_image']['tmp_name'], $Imagepath.$FileName))
			{
				$this->createThumbnail($FileName, $Imagepath, 153, 113);
				$record['after_image']=$this->mySQLSafe($FileName);
			}
		}
		
		if($this->insert($this->tablename,$record) > 0 ) 
		{
			$this->error="Record has been added successfully";
			return true;
		}
		else
		{
			$this->error="Record has not been added";
			return false;
		}
    }
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($psid=0)
	   {
	  		$_query = "select filename,title from ".$this->tablename." where psid = ".$psid." ";
			
			$fetch=$this->select($_query);
			
			$old_filename = $fetch[0]['filename'];
						
			if($old_filename or $old_filename!='')
			{
				$oldImagepath = PHYSICAL_PATH."/uploads/home-pictures/".$old_filename;
				$thumbnail = PHYSICAL_PATH."/uploads/home-pictures/thn_".$old_filename;
				@unlink($oldImagepath);
				@unlink($thumbnail);
			}
			if($old_after_image or $old_after_image!='')
			{
				$oldImagepath = PHYSICAL_PATH."/uploads/home-pictures/".$old_after_image;
				$thumbnail = PHYSICAL_PATH."/uploads/home-pictures/thn_".$old_after_image;
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
			$data["title"]=$fetch[0]["title"];
			$data["subtitle"]=$fetch[0]["subtitle"];
			$data["pagelink"]=$fetch[0]["pagelink"];
			$data["isactive"]=$fetch[0]["isactive"];
			$data['filename'] = $fetch[0]['filename']; 
			$data['old_filename'] = $fetch[0]['filename']; 
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
		 $record['title']=$this->mySQLSafe( $formvars['title']);
		$record['subtitle']=$this->mySQLSafe( $formvars['subtitle']);
		 $record['pagelink']=$this->mySQLSafe( $formvars['pagelink']);
	     $record['isactive']=$this->mySQLSafe( $formvars['isactive']);
		if(strlen($files['filename']['name']) > 0 )
		{
			$FileName = time()."_".$files['filename']['name'];
			$FileName = str_replace(' ', '_', $FileName);

			$Imagepath = PHYSICAL_PATH."/uploads/home-pictures/";
			
			if(move_uploaded_file($files['filename']['tmp_name'], $Imagepath.$FileName))
			{
				$this->createThumbnail($FileName, $Imagepath, 153, 113);
				$record['filename']=$this->mySQLSafe($FileName);
		
				$_query = "select filename from ".$this->tablename." where psid = ".$formvars['psid']." ";
				
				$fetch=$this->select($_query);
				
				$old_filename = $fetch[0]['filename'];
				
				if($old_filename or $old_filename!='')
				{
					$oldImagepath = PHYSICAL_PATH."/uploads/home-pictures/".$old_filename;
					$thumbnail = PHYSICAL_PATH."/uploads/home-pictures/thn_".$old_filename;
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
	function createThumbnail($filename, $dest, $width, $height)
	{
		$name = $dest . $filename;
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
	function getSortedEntries() {

		$orderby=" order by sort_index";		
	    $_query = "select * from " . $this->tablename . $orderby;

		$recordset=mysql_query($_query);
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
	
		if(!isset($data))
		{
			$this->error="No existing home page picture found";
			$data=null;
		}
        return $data;   
    }
	function sortListing($formvars)
	{
		$ids = $formvars['item_id'];
		$indexes = $formvars['sort_index'];
		
		for($i=0; $i < count($ids); $i++)
		{
			$_query = "update ".$this->tablename." set sort_index = ".$indexes[$i]." where item_id = ".$ids[$i];
			mysql_query($_query);
		}
		
		$this->error="Sorting has been saved successfully";
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
		
        $this->tpl->display('homesecmanagement.tpl');
    }
    function displayGird($data = array(),$formvars = array()) {
	
		global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		
		$this->tpl->assign('data', $data);
		$this->tpl->assign('formvars', $formvars);
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('error', $this->error);
		$this->tpl->assign('total_homesecs', count($data));
		$this->tpl->assign('sortcolumn', $this->sortcolumn);
		$this->tpl->assign('sortdirection', $this->sortdirection);
		
	    $this->tpl->display('homesecmanagement.tpl');        

    }
	function writeXML()
	{
		 $_query = "select * from " . $this->tablename . " where isactive = 'Y' order by sort_index asc";
		
		$recordset=$this->execute($_query);
		
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
		if(!isset($data) || $data != null)
		{		
			$fullpath2 = strtolower(__FILE__);
			$fullpath2 = str_replace("\\", "/", $fullpath2);						
			$root2 = substr($fullpath2, 0, strpos($fullpath2, "/admin", 1));
			$fileName = $root2."/data/data.xml";
			if(file_exists($fileName))
			{
				@unlink($fileName);
			}
			@$fp = fopen($fileName, "w+");
			$numItems = count($data);
			$text = "";
			//print_r($data);exit;
			$text = $text."<content>\r\n";
			for($i = 0; $i < $numItems; $i++)
			{
				//if($data[$i][3] == 'Y')
				{
					//$text = $text. "<record ImageId=\"".$data[$i][0]."\" ImagePath=\"uploads/home-pictures/".$data[$i][2]."\" />\r\n";
					$text = $text. "<video>\r\n";
					//$text = $text. "<imagepath>" ImagePath=\"uploads/home-pictures/".$data[$i][3]."</imagepath>\r\n";
					$text = $text. "<title>".$data[$i][1]."</title>\r\n";
					$text = $text. "<subtitle>".$data[$i][2]."</subtitle>\r\n";
					$text = $text. "<image><img src= '".SITE_URL."/uploads/home-pictures/".$data[$i][4]." '/></image>\r\n";
					/*$text = $text."<author>" ."</author>\r\n";*/					
					$text = $text."<description>" ."</description>\r\n";
					$text = $text. "<source_path>".$data[$i][3]."</source_path>\r\n";
					$text = $text. "</video>\r\n";
				    $text = $text. "\r\n";
				}
			}
			$text = $text."</content>";
			@fwrite($fp, $text);
			@fclose($fp);
		}

	}
}
?>