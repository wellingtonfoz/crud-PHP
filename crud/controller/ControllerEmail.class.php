<?php

if(isset($_POST['nome']))
{
	

	require_once($_SERVER['DOCUMENT_ROOT'].'/crud/diversos/phpmailer/class.phpmailer.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/crud/diversos/config.php');
					

	$mail->AddAddress( "edrian@infoclinicainformatica.srv.br","Responsável 01");
	$mail->AddCC( "usite@volksman.com.br","Responsável 02");
	$mail->Subject    = "Proposta enviada pelo site!";
	$mail->AltBody    = ""; 
	$html = '<br>
		Nome: '.$_POST['nome'].'<br>
		Telefone: '.$_POST['telefone'].'<br>
		Email: '.$_POST['email'].'<br><br>
		'.$_POST['referente'].'<br><br>
		Proposta: '.$_POST['proposta'];
	$mail->MsgHTML($html);
			
	if(!$mail->Send()) {
	} else {
	}	
					
	echo "<script language='javaScript'>window.location.href='/crud/sucesso.php'</script>";		
}
	

	
	

?>