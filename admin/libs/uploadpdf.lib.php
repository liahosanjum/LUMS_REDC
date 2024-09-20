<?php
/**
 * Advertisement  Management application library
 *
 */
class fileManagement extends db{

	// database object
    var $sql = null;
	// smarty template object
    var $tpl = null;
	var $error = null;
	
	///Class varibles
	var $pageview=null;
	var $tblfile = "tblfile";
	var $sortcolumn="item_id";
	var $sortdirection="desc";
	
	
    /**
     * class constructor
     */
    function fileManagement() {
        $this->tpl =& new Smarty;
		$this->db();
    }
    
    
	
	function isValidForm($formvars,$files = "")
	{
		// reset error message
		$this->error = null;
		if(strlen($files['picture']['name']) == 0 || $files['picture']['size'] == 0)
		{
			$this->error = 'Please provide file to upload.';
			return false; 
        }
		else
		{
			$ext_arr = explode('.',$files['picture']['name']);
			$name 		= $ext_arr[0];
			$ext_pdf    = $ext_arr[1];
			if($ext_pdf !="pdf")
			{
				$this->error = 'Please uplaod only PDF document.';
				return false; 
			}
			else
			{
				if(strlen($files['picture']['name']) > 0 )
				{
					$files['picture']['name'] 	= "redc.".$ext_pdf;
					$FileName  = $files['picture']['name'];
					$Imagepath = PHYSICAL_PATH."/uploads/pdf/";
					if(move_uploaded_file($files['picture']['tmp_name'], $Imagepath.$FileName))
					{
						$file_uploaded = 'File Has been uploaded.';
						$this->tpl->assign('file_uploaded', $file_uploaded);
					}
				}
			}
		}
		return true;
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
	  
    function displayForm() {
		global $GENERAL;
		 
		$this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('error', $this->error);
		 
        $this->tpl->display('uploadpfd.tpl');
    }
    /**
     * display the records
     *
     * @param array $data the  data
     */
    function displayGird($data = array()) {
		global $GENERAL;
		
		$this->tpl->assign('GENERAL', $GENERAL);
	 
		
	    $this->tpl->display('uploadpfd.tpl');        

    }
}

?>