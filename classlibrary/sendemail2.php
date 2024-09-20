<?
	require("phpmailer.php");
	class SendEmail
	{
		///Sending Email///
		
		function Send_Email($From,$FromEmail,$To,$ToEmail,$Subject,$Body,$MailServer)
		{
					$Result=false;
					$mail = new PHPMailer();
					
					$mail->IsSMTP(); // telling the class to use SMTP
					$mail->SMTPAuth = true;
					$mail->IsHTML(true);	
					$mail->Priority = 1;
					$mail->Encoding = "8bit";
					$mail->CharSet = "iso-8859-1";
					$mail->WordWrap = 50;
					$mail->Host = $MailServer;
					
/*					$mail->Host = "smtp.gmail.com";
					$mail->Username = "rehanqaisir.test@gmail.com";
					$mail->Password = "password_123";
					$mail->Port = 465;
					
*///					$mail->Mailer = "mail";					

					$mail->Host = "smtp.netrasofttech.com";
					$mail->Username = "test@netrasofttech.com";
					$mail->Password = "password";
					$mail->Port = 25;

					$mail->Mailer = "smtp";					
					
					$mail->FromName = $From;//"mailer@netrasofttech.com";
					$mail->From = $FromEmail;//"Mail manager";					
						 
					$mail->Subject=$Subject;
					$mail->Body = $Body;			  
					$mail->AddAddress($ToEmail, $To);
//					echo $Subject."<br>";
//					echo $Body;
					if($mail->Send())
					$Result=true;
//					echo $mail->ErrorInfo;
					// Clear all addresses and attachments for next loop
					$mail->ClearAddresses();

					return $Result;
		}
	
	}
	
	set_time_limit(300);
	$mail = new SendEmail();
	echo $mail->Send_Email('rehan','rehan@netrasofttech.com','rehanqaisir.test@gmail.com','rehanqaisir.test@gmail.com','testing mail server','test email','smtp.lums.edu.pk');
?>