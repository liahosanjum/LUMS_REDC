<?
//	require_once('PHPMailer_v5.1/class.phpmailer.php');
	class SendEmail
	{
		///Sending Email///
		
		function Send_Email($From,$FromEmail,$To,$ToEmail,$Subject,$Body,$MailServer)
		{
					$Result=true;
					$to      = $ToEmail;
					$subject = $Subject;
					$message = $Body;
					
					// To send HTML mail, the Content-type header must be set
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					
					$headers .= 'From: '.$FromEmail . "\r\n" .
						'Reply-To: '.$FromEmail . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
					
					$headers .= "X-Priority: 1 (Higuest)\n"; 
							$headers .= "X-MSMail-Priority: High\n"; 
							$headers .= "Importance: High\n"; 
						
						
					mail($to, $subject, $message, $headers);
					return $Result;
		}
	
	}
	
?>