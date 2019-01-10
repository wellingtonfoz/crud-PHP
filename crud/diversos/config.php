<?php
	
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug  = 2;          
		$mail->SMTPAuth   = true;       
		$mail->SMTPSecure = "tls";      
	    $mail->Host = 'email-smtp.us-east-1.amazonaws.com:587';
		$mail->Port       = 587;        
		$mail->Username = 'AKIAJ3K6UZAREJPOS2CA';
		$mail->Password = 'Ar0aYP2EWaBW5T4V1kPI6IH5kFNx1U+0zqkA1XN7fzdv';
		$mail->CharSet = 'UTF-8';			
	    $mail->From = 'naoresponda@udc.edu.br';
		$mail->FromName = 'Notificador de Propostas do Site';
			
?>