<?php
class ContactUs extends db
{
    var $tpl = null;
	var $error = null;
	var $contactus = "redc_contactus";
	var $tablename="redc_page_content";

    function ContactUs() {
       	$this->db();
	    $this->tpl =& new Smarty;
    }
	function getPageData($pagename)
	{
	 $query ="select * from ".$this->tablename. " where pagename ='".$pagename."'";
	 $rs=$this->execute($query);
		if($rs!=false)
		{
			$fetch = mysql_fetch_array($rs);
			// Fill all field 
			$data["pcid"]=$fetch["pcid"];
			$data['pagename'] = $fetch['pagename'];
    		$data['explorertitle'] = $fetch['explorertitle'];
			$data['pagetitle'] = $fetch['pagetitle'];
			$data['menutitle'] = $fetch['menutitle'];
			$data['keywords'] = $fetch['keywords'];
			$data['description'] = $fetch['description'];
			$data['details'] = $fetch['details'];
			$data['pageorder'] = $fetch['pageorder'];
			
		}			
		
       return $data; 
	
	}
	function isValidForm($formvars)
	{
		

		if(strlen($formvars['firstname']) == 0)
		{
			$this->error = "Please provide your firstname";
			return false;
		}
		if(strlen($formvars['lastname']) == 0)
		{
			$this->error = "Please provide your lastname";
			return false;
		}
		
		if(strlen($formvars['email']) == 0)
		{
			$this->error = "Please provide your email";
			return false;
		}
		
		if($formvars['email'] != "" && !eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",$formvars['email']))
		{
            $this->error = 'Please provide a valid email';
            return false; 		
		}
		
		if(strlen($formvars['company']) == 0)
		{
			$this->error = "Please provide company";
			return false;
		}
		
		if(strlen($formvars['mailaddress']) == 0)
		{
			$this->error = "Please provide mailing address";
			return false;
		}
		
		if(strlen($formvars['phone']) == 0)
		{
		 	$this->error = "Please provide phone";
			return false;
		}
		
		if(strlen($formvars['additionalinfo']) == 0)
		{
		 	$this->error = "Please provide addtional Information";
			return false;
		}
		return true;
	}
	
	function submitRequest($formvars)
	{		
		$record['firstname']=$this->mySQLSafe( $formvars['firstname']);
		$record['lastname']=$this->mySQLSafe( $formvars['lastname']);
		$record['email']=$this->mySQLSafe( $formvars['email']);
		$record['title']=$this->mySQLSafe( $formvars['title']);
		$record['company']=$this->mySQLSafe( $formvars['company']);
		$record['mailaddress']=$this->mySQLSafe( $formvars['mailaddress']);
		$record['phone']=$this->mySQLSafe( $formvars['phone']);
		//to get value from check boxes
		$arr = $_POST['about'];
		$string= "";
		for($i=0;$i<count($arr);$i++)
		{
		
			$string = $string.$arr[$i].",";
		}
		$record['about']=$this->mySQLSafe(substr($string,0,strlen($string)-1));
		$record['additionalinfo']=$this->mySQLSafe( $formvars['additionalinfo']);
		$record['contactdate'] = $this->mySQLSafe( date("y-m-d H:i:s"));
		$record['status'] = $this->mySQLSafe('O');
		$message = "<table cellspacing= 15 >";
		if($formvars['firstname']!= "")
		{	
			$message .= "<tr><td>First Name</td><td>".$formvars['title']. $formvars['firstname']."</td></tr>";
		}
		if($formvars['lastname']!= "")
		{
			$message .= "<tr><td>Last Name</td><td>".$formvars['lastname']."</td></tr>";
		}
		if($formvars['email']!= "")
		{
			$message .= "<tr><td>Email</td><td>".$formvars['email']."</td></tr>";
		}
		if($formvars['company']!= "")
		{
			$message .= "<tr><td>Company</td><td>".$formvars['company']."</td></tr>";
		}
		if($formvars['mailaddress']!= "")
		{
			$message .= "<tr><td>Mailing Address</td><td>".$formvars['mailaddress']."</td></tr>";
		}
		if($formvars['phone'] != "")
		{
			$message .= "<tr><td>Telephone</td><td>".$formvars['phone']."</td></tr>";
		}
		if(count($arr) > 0)
		{
			$message .= "<tr><td>About</td><td>".$this->mySQLSafe(substr($string,0,strlen($string)-1))."</td></tr>";
		}
		if($formvars['additionalinfo'] != "")
		{
			$message .= "<tr><td>Additional Information</td><td>".$formvars['additionalinfo']."</td></tr>";
		}
		if($formvars['contactdate']!= "")
		{	
			$message .= "<tr><td>Request Date</td><td>".date("m.d.y")."</td></tr>";
		}
		$message .= "</table>";
		/*echo "<pre>";
		print_r($message);
		echo "</pre>";
		exit;*/
		$mail = new SendEmail();
			$send = $mail->Send_Email($formvars['email'],$formvars['email'],CONTACTUSNAME,CONTACTUSEMAIL,"Contact us request",$message,MAILSERVER);
			
		//Query to insert the request
		
		if($this->insert($this->contactus,$record) > 0 ) 
		{
			$this->error="Your query has been submitted";
			return true;
		}
		else
		{
			$this->error="Your query was not submitted";
			return false;			
		}
	}
	
	function displayPage($formvars) 
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
		$this->tpl->assign('pagedata', $this->getPageData('Contact Us'));
		$this->tpl->assign('form', $formvars); 
		$this->tpl->display('contactus.tpl');
	}	
}
?>
