<?php
require_once('../classlibrary/configuration.php');
require_once($GENERAL['PHYSICAL_PATH_CLASSLIB'].'/db.php');
include("../classlibrary/sendemail.php");

$db = new Db();
$tblredc_newsletter_subscribers = "redc_newsletter_subscribers";
//print_r($_REQUEST);
//exit;
if(isset($_REQUEST['email']) && trim($_REQUEST['email'])!='' && isset($_REQUEST['name']) && trim($_REQUEST['name'])!='')
{
   
	$query = "Select * from ".$tblredc_newsletter_subscribers." where email = ".$db->mySQLSafe($_REQUEST["email"]);

	if($db->numrows($query ) > 0)
	{
		$returnstring = "Email is already subscribed";
	}
	else
	{
		$record['name']=$db->mySQLSafe($_REQUEST['name']);
		$record['email']=$db->mySQLSafe($_REQUEST['email']);
		$record['companyname']=$db->mySQLSafe($_REQUEST['companyname']);
		$record['designation']=$db->mySQLSafe($_REQUEST['designation']);
		$record['dated']=$db->mySQLSafe( date("Y-m-d H:m:s") );
		if($db->insert($tblredc_newsletter_subscribers,$record) > 0 ) 
		{
			//send confirm email to subscriber
			sendEmailSubscription($_REQUEST['email'] , $_REQUEST['name'] , MAILSERVER);
			$returnstring = "You have been subscribed successfully";
		}
		else
		{
			$returnstring = "Subscription not successful";
		}
	}
}
else
{
   $returnstring = "Please fill in all required fields";
}

// send email to subscriber
function sendEmailSubscription($email , $name , $emailserver)
{
	
	// if name empty, email instead. 
	if($name == "") { $subname = $email; }
	else { $subname = $name; }	

	// object of db class
	$db = new Db();

	// object of class send email
	$mail = new SendEmail();
	
	// fetch email content
	$query= "Select * from redc_emailcontent where emailname = ".$db->mySQLSafe('Email Subscription');
	$result= $db->execute($query);
	$fetch=mysql_fetch_array($result);
	$email_body = $fetch['content'];
	//echo ($email_body);
	$email_body = str_replace('__EMAIL__', $email, $email_body);
	if(SENDEMAIL)
	{
		$send = $mail->Send_Email($fetch['fromname'],$fetch['fromemail'],$subname,$email,$fetch['subject'],$email_body,$emailserver);
	}
}
print($returnstring);

?>
