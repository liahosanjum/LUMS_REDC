<?php
class NewsLetterManagement extends db{

    var $sql = null;
    var $tpl = null;
	var $error = null;
	var $pageview=null;
	var $tblnlsubscriber="redc_newsletter_subscribers";
	var $tableemailcontent="redc_emailcontent";
	var $tblnlalumni="redc_alumni";
	var $tblemailtemplate = "redc_email_template";
	var $tblnewsletterhistory = "redc_newsletter_histroy";
	var $sortcolumn=" id ";
	var $sortdirection=" asc ";
	var $selectedEmail=null;
	
    function NewsLetterManagement()
	{
		$this->tpl =& new Smarty;
		$this->db();
    }
	
    function isValidForm($formvars)
	{
        $this->error = null;

        if($formvars['enabled'] == 0) {
            $this->error = 'Please Select Subscribers Group.';
            return false; 
        }
		

        if(strlen($formvars['name']) == 0) {
            $this->error = 'Please provide from name.';
            return false; 
        }
        if(strlen($formvars['email']) == 0) {
            $this->error = 'Please provide email address.';
            return false; 
        }
        if(strlen($formvars['email']) > 0)
		{
			if (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",$formvars['email']))
			{
            	$this->error = 'Please provide valid email address.';
	            return false; 
			}
        }
        if(strlen($formvars['subject']) == 0)
		{
            $this->error = 'Please provide subject.';
            return false; 
        }
        if(strlen($formvars['FCKeditor1']) == 0)
		{
            $this->error = 'Please provide message.';
            return false; 
        }
        return true;
    }
	
	/*
	//Function used to send and save newsletter
	*/
	
	function sendEmail($formvars)
	{	
	$enabled = $formvars['enabled'];
	    if($enabled == "" || !isset($enabled))
		{
		  $enabled = "1";
		}
		elseif($enabled == "1")
		{
		  $_where = "where isactive = 'Yes' "; 
		  $_query = " select * from ".$this->tblnlalumni." ".$_where."  order by email asc ";
		  
		}
		 elseif($enabled == "2")
		{
		  $_where = "where isactive = 'Yes' "; 
		  $_query = " select * from ".$this->tblnlsubscriber." ".$_where."  order by email asc ";
		
		}  
		

		$recordset=$this->execute($_query);
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch['email'];
			//$bcc[]=$fetch['email'];
	        
		}

		$FromName = $formvars['name'];
		$FromEmail = $formvars['email'];
		$Subject = $formvars['subject'];
		$Body = $formvars['FCKeditor1'];
		$m= new Mail; // create the mail
		$m->From( $FromEmail );
		$m->To(" ");
		$m->Bcc( $data );
		$m->Subject( $Subject );
		$m->Body( $Body );
		$send_mail = $m->Send();			
	
$send_mail = true;
		if($send_mail) 
		{
				$FromName = $formvars['name'];
				$FromEmail = $formvars['email'];
				$Subject = $formvars['subject'];
				if($formvars['enabled'] == '1')
				{
			 	$SubscriberGroup = "Alumni";
				}
				else if($formvars['enabled'] == '2')
				{
					$SubscriberGroup = "Subscriber";
				}
				$Body = $formvars['FCKeditor1'];
				$record['from_name']=$this->mySQLSafe($FromName);
				$record['from_email']=$this->mySQLSafe($FromEmail);
				$record['send_date']='now()';
				$record['subscriber_group']=$this->mySQLSafe($SubscriberGroup);
				//$record['to_email']=$this->mySQLSafe($bcc);
				$record['email_content']=$this->mySQLSafe($Body);
				$record['subject']=$this->mySQLSafe($Subject);			
				$query=	$this->insert($this->tblnewsletterhistory,$record);
				$this->error="Email has been sent and save to the history ";
				return true;
		}
		else
		{
			$this->error="Newsletter has not been sent due to system error. Please try again.";
			return false;
		}

		return $data;  
		
	}

    function updateEntry($formvars) {

		$record['fromname']=$this->mySQLSafe($formvars['name']);
		$record['fromemail']=$this->mySQLSafe($formvars['email']);
		$record['subject']=$this->mySQLSafe($formvars['subject']);
		$record['content']=$this->mySQLSafe($formvars['FCKeditor1']);
		
		$where="itemid=".$formvars['template'];
		
		if($this->update($this->tableemailcontent,$record,$where))
		{
	    	$this->error="Newsletter template has been saved successfully";
			return true;
		}
		else
		{
			$this->error="Newsletter template has not been saved";
			return false;
		}
        
    }	
	
//function use to get the n ame of the template in dropdownlist from template table
	function getTemplateName()
	{
		$query = "Select * from " . $this->tblemailtemplate;
		
		$recordset=$this->execute($query);
		while($fetch=mysql_fetch_array($recordset))
		{
			$data[]=$fetch;
		}
        return $data;
		
	}
//function use to get the content of email from template table

	function getByEmailTemplate($template_id)
	{
		
		$query = "Select * from " . $this->tblemailtemplate. " where temp_id = " . $template_id;
		$recordset=$this->execute($query);
		if($fetch=mysql_fetch_array($recordset))
		{
			
			$data["FCKeditor1"] = $fetch["content"];
			
		}
        return $data;
	}
	
	
    function displayForm($formvars = array())
	{
        global $GENERAL;
		$this->tpl->assign('GENERAL', $GENERAL); 
		$this->tpl->assign('templates', $this->getTemplateName());
		if(isset($formvars['template']) && $formvars['template'] != $formvars['templateid'])
		 {
		    $getTemplate = $this->getByEmailTemplate($formvars['template']);
			$this->tpl->assign('data',$getTemplate);
		 }
		else
		{
			$formvars["content"]=str_replace("\r\n", " ",$formvars['content']);			
		}
		$this->tpl->assign('form',$formvars);
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('newslettermanagement.tpl');
    }
}
?>
