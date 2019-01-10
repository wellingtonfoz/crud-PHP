<?php

include($_SERVER['DOCUMENT_ROOT']."/crud/controller/ControllerAcesso.class.php");

if( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
						include( $_SERVER['DOCUMENT_ROOT'].'/crud/diversos/bibliotecas/jcrop/m2brimagem.class.php' );
	$oImg = new m2brimagem( $_SERVER['DOCUMENT_ROOT']."/crud/diversos/uploads/uploadsN/".$_POST['img'] );
	$oImg2 = new m2brimagem($_SERVER['DOCUMENT_ROOT']. "/crud/diversos/uploads/uploadsN/".$_POST['img'] );
	if( $oImg->valida() == 'OK' )
	{
		$oImg->posicaoCrop( $_POST['x'], $_POST['y'] );
		$oImg->redimensiona( $_POST['w'], $_POST['h'], 'crop' );
		$oImg->redimensiona( '307', '', '' );		
		$oImg->grava( $_SERVER['DOCUMENT_ROOT']."/crud/diversos/uploads/uploadsG/".$_POST['img'] );
		$oImg->redimensiona( '185', '', '' );		
		$oImg->grava( $_SERVER['DOCUMENT_ROOT']."/crud/diversos/uploads/uploadsM/".$_POST['img'] );

		$oImg2->posicaoCrop( $_POST['x'], $_POST['y'] );
		$oImg2->redimensiona( $_POST['h'], $_POST['h'], 'crop' );
		$oImg2->redimensiona( '125', '', '' );		
		$oImg2->grava( $_SERVER['DOCUMENT_ROOT']."/crud/diversos/uploads/uploadsP/".$_POST['img'] );

		

				
	}else{
	}
}
exit; 