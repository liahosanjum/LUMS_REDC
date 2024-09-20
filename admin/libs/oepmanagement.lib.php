<?php
/**
 * Podcast Audio Management application library
 *
 */
class oepManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tablename="redc_oep_programmes_category";
	var $sortcolumn="name ";
	var $sortdirection=" asc ";
	var $countRecords = 0;
	
    /**
     * class constructor
     */
    function oepManagement() {
     	$this->tpl =& new Smarty;
		$this->db();
    }
 
   	// check if category name already exists  
	function alreadyExists($catname)
	{
		return $this->numrows("select name from ".$this->tablename." where name = '".$catname."'");
	}

    /**
     * test if form information is valid
     *
     * @param array $formvars the form variables
     */
    function isValidForm($formvars,$_mode = "") {

		// reset error message
        $this->error = null;
        
		// test if "Title" is empty
        if(strlen(trim($formvars['name'])) == 0) {
            $this->error = 'Please provide Category Name.';
            return false;  
        }
		/*if($this->alreadyExists($formvars['name']))
		{
            $this->error = 'Category Name already exists.';
            return false;  
		}*/
        return true;
    }
  	 /**
     * add a new oep entry
     *
     * @param array $formvars the form variables
     */
    function addEntry($formvars,$files) 
	{
		$query = "select * from ".$this->tablename." where name = '".$formvars['name']."'";
		$fetch = $this->select($query);
		if($fetch!=false){
			$this->error = "Category name already exists kindly use another category name.";
			return false;
		}		
    	$record['name']=$this->mySQLSafe( $formvars['name']);
		if(strlen($files['cat_image']['name']) > 0 )
		{
			$FileName = time()."_".$files['cat_image']['name'];
			$FileName = str_replace(' ', '_', $FileName);

			$Imagepath = PHYSICAL_PATH."/uploads/programme-category/";
			
			if(move_uploaded_file($files['cat_image']['tmp_name'], $Imagepath.$FileName))
			{
				 $this->createThumbnail($FileName, $Imagepath, 153, 113);
				$record['cat_image']=$this->mySQLSafe($FileName);
			}
		}
		if($this->insert($this->tablename,$record) > 0 ) 
		{
	    	$this->error="The category has been added successfully.";
			return true;
		}
		else
		{
			$this->error="Cateogry has not been added.";
			return false;			
		}
    }
	  
	/*
	* load record from data base.
	*/
		function editEntry($oepcatid=0,$files)
	{
		$_query = "select *  from ".$this->tablename." where oepcatid=$oepcatid";
		
		$fetch=$this->select($_query);
		if($fetch!=false)
		{
			// Fill all field 
			$data["oepcatid"]=$fetch[0]["oepcatid"];
			$data["name"]=$fetch[0]["name"];
			$data['old_image'] = $fetch[0]['cat_image'];
			//h$data['cat_image'] = $fetch[0]['cat_image'];
		}
		
        return $data; 
	}  
 	/**
     * Updating Faq entry
     *
     * @param array $formvars the form variables
     */
    function updateEntry($formvars,$oepcatid,$files) {
	
		$query = "select * from ".$this->tablename." where oepcatid !=".$formvars['oepcatid']." and name = '".$formvars['name']."'";
		$fetch = $this->select($query);
		if($fetch!=false){
			$this->error = "Category name already exists kindly use another category name.";
			return false;
		}
        $record['name']=$this->mySQLSafe( $formvars['name']);
		
		if(strlen($files['cat_image']['name']) > 0 )
		{
			$FileName = time()."_".$files['cat_image']['name'];
			$FileName = str_replace(' ', '_', $FileName);

			$Imagepath = PHYSICAL_PATH."/uploads/programme-category/";
			
			if(move_uploaded_file($files['cat_image']['tmp_name'], $Imagepath.$FileName))
			{
				$this->createThumbnail($FileName, $Imagepath, 153, 113);
				$record['cat_image']=$this->mySQLSafe($FileName);
		
				$_query = "select cat_image from ".$this->tablename." where oepcatid !=".$formvars['oepcatid']." and name = '".$formvars['name']."'";
				
				$fetch=$this->select($_query);
				
				$old_filename = $fetch[0]['cat_image'];
				
				if($old_filename or $old_filename!='')
				{
					$oldImagepath = PHYSICAL_PATH."/uploads/programme-category/".$old_filename;
					$thumbnail = PHYSICAL_PATH."/uploads/programme-category/thn_".$old_filename;
					@unlink($oldImagepath);
					@unlink($thumbnail);
				}	
				
			}
		}	
		$where="oepcatid=".$formvars['oepcatid'];
		if($this->update($this->tablename,$record,$where))
		{
	    	
			$this->error="Category has been updated successfully.";
			return true;
		}
		else
		{
			$this->error="Category has not been updated.";
			return false;
			
		}
        
    }
	/*
	* Delete entry from data base.
	 * @param id for delete specific record database.
	*/
	function deleteEntry($oepcatid=0)
	{
	
			$_query = "select * from ".$this->tablename." where oepcatid = ".$oepcatid." ";
			
			$fetch=$this->select($_query);
			
			$old_filename = $fetch[0]['cat_image'];
						
			if($old_filename or $old_filename!='')
			{
				$oldImagepath = PHYSICAL_PATH."/uploads/programme-category/".$old_filename;
				$thumbnail = PHYSICAL_PATH."/uploads/programme-category/thn_".$old_filename;
				@unlink($oldImagepath);
				@unlink($thumbnail);
			}
		  /*
		  $_query = "select image from ".$this->tablename." where id = ".$id." ";
		  $fetch=$this->select($_query);
		  $old_image = $fetch[0]['image'];
		  if($old_image or $old_image!='')
		   {
			  $oldImagepath = PHYSICAL_PATH."/images/oep/".$old_image;
			  @unlink($oldImagepath);
		   }
		   */	
				 
		$_query="delete from ".$this->tablename." where oepcatid=$oepcatid";
		$recordset=$this->execute($_query);
		if($recordset) 
		{
	    	
			$this->error="Category has been deleted successfully.";
			return true;
		}
		 /*
		else
		{
			$this->error="oep has not been deleted.";
			return false;			
		}
		 */			
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
		$paging->num= $this->numrows("select oepcatid from ".$this->tablename);
		$this->countRecords = $paging->num;
		$paging->start=$_start;
		$paging->sortcolumn=$this->sortcolumn;
		$paging->sortdirection=$this->sortdirection;
		$paging->limit = PAGESIZE;
		$paging->Paginate($paging->limit,$paging->num,"?",20);
		$this->tpl->assign('paging',$paging->displayTable());
		
		
		///Sort order
		$orderby=" order by ". $this->sortcolumn ." ". $this->sortdirection;
		$where=" ";
		
		$_query = "select * from " . $this->tablename. $where . $orderby ."  Limit $paging->start,$paging->limit";
		$fetch=$this->select($_query);
		if($fetch!=false)
		 {
			$data=$fetch;
		 }
		else
		  {
		   $this->error="No existing oep found.";
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
        $this->tpl->display('oepmanagement.tpl');
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
		
	    $this->tpl->display('oepmanagement.tpl');        
    }
}
?>