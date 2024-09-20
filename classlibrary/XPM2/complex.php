<?php
require_once 'smtp.php';

class Complex
{


	function Complex()
	{

		
	}	

	function SendSimple()
	{
		
		// send text/plain and text/html multiple e-mail messages (multipart/alternative)
		// send to multiple e-mail addresses (Cc and Bcc)
		// attach an embed HTML image (inline) and file (attachment)
		// using a relay smtp server with authentication and TLS (SSL) connection
		// notice: make sure you have OpenSSL module (extension) enable on your PHP configuration in order to use TLS/SSL connection
		
		//E_ALL -> debugging
		// false -> public
		error_reporting(E_ALL);
		// 0 -> no time limit
		set_time_limit(0);
		
		// path to smtp.php from XPM2 package
		
		
		$mail = new SMTP;
		//$mail->Delivery('relay');
		$mail->Delivery('local-client');
		//$mail->Relay('relay-hostname.net', 'username', 'password', 465, 'autodetect', 'tls');
		$mail->TimeOut(10);
		//$mail->Priority('high');
		$mail->From('raza@netrasofttech.com');
		$mail->AddTo('testing@peatfirestudios.com');
		$mail->AddCc('naumaanraza@hotmail.com');
		$mail->AddBcc('naumaanraza@gmail.com');
		$mail->Text('SMTP Complex');
		$mail->Html('<font color="red"><b><u>HTML version of the message</u></b></font><br><br><i>Powered by</i> <img src="image.gif">');
		//$mail->AttachFile('image.gif', 'photo.gif', 'autodetect', 'inline');
		//$mail->AttachFile('file.zip');
		$sent = $mail->Send('Hello World!');
		
		echo $sent ? 'Success' : 'Error';
		
		// for debugging
		echo '<br>Result: '.$mail->result;

	}


}

?>