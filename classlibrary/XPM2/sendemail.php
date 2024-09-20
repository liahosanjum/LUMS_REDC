<?

	require_once('smtp.php');
	
	// send text/plain and text/html multiple e-mail messages (multipart/alternative)
	// send to multiple e-mail addresses (Cc and Bcc)
	// attach an embed HTML image (inline) and file (attachment)
	// using a relay smtp server with authentication and TLS (SSL) connection
	// notice: make sure you have OpenSSL module (extension) enable on your PHP configuration in order to use TLS/SSL connection

	// E_ALL -> debugging
	// false -> public

	class SendEmail
	{

		///Sending Email///
		
		function Send_Email($From,$FromEmail,$To,$ToEmail,$Subject,$Body,$MailServer, $Bcc='')
		{
			error_reporting(E_ALL);
			// 0 -> no time limit
			set_time_limit(0);

			$mail = new SMTP;

			$mail->Delivery('local-client');

			//$mail->Relay('relay-hostname.net', 'username', 'password', 465, 'autodetect', 'tls');

			$mail->TimeOut(10);

			//$mail->Priority('high');

			$mail->From($FromEmail, $From);

			$to_addresses = explode(',', $ToEmail);
			$to_names = explode(',', $To);
			for($i=0; $i<count($to_addresses); $i++)
			{
				$mail->AddTo($to_addresses[$i], $to_names[$i]);
			}
//			$mail->AddTo($ToEmail, $To);
			if($Bcc != '')
			{
				$mail->AddBcc($Bcc);
			}
			$Body = html_entity_decode($Body);
			$mail->Html($Body);
			
			//$mail->Html('<font color="red"><b><u>FROM XPM2456</u></b></font><br><br>');			
			//$mail->AttachFile('image.gif', 'photo.gif', 'autodetect', 'inline');
			//$mail->AttachFile();
			$sent = $mail->Send($Subject);
			
			return $sent;
			
			//echo $sent ? 'Success' : 'Error';
			
			// for debugging
			//echo '<br>Result: '.$mail->result;	
		}
	}
?>