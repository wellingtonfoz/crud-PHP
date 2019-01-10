<?php
	
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug  = 2;          
		$mail->SMTPAuth   = true;       
		$mail->SMTPSecure = "tls";      
	    	$mail->Host = 'smtp.gmail.com';
		$mail->Port       = 587;        
		$mail->Username = 'email@email.com.br';
		$mail->Password = 'SENHAAAAAAAAA';
		$mail->CharSet = 'UTF-8';			
	    	$mail->From = 'email@email.com.br';
		$mail->FromName = 'Notificador de Propostas do Site';
			
?>
