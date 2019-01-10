<?php
include("../../../controller/ControllerAcesso.class.php");

if (!empty($_FILES)) {
	
				$campoFile = "Filedata";
				$allowedExts = array("gif", "jpeg", "jpg", "png","JPG");
				$extension = end(explode(".", $_FILES[$campoFile]["name"]));
				if (!($_FILES[$campoFile]['name'] == "") && in_array($extension, $allowedExts)
				) {	
	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'].'/crud/diversos/uploads/uploadsN/';
	$targetPath4 = $_SERVER['DOCUMENT_ROOT'].'/crud/diversos/uploads/uploadsP/';
	$targetFile =  str_replace('//','/',$targetPath).$_REQUEST['timestamp'].$_FILES[$campoFile]['name'];
	$targetFile4 =  str_replace('//','/',$targetPath4).$_REQUEST['timestamp'].$_FILES[$campoFile]['name'];
		require_once($_SERVER['DOCUMENT_ROOT'].'/crud/diversos/bibliotecas/uploadify/wideimage-11.02.19/WideImage.inc.php');
		
		$image2 = wiImage::load($tempFile);
		$image2 = $image2->resize(470, 600,'inside');
		$image2->saveToFile($targetFile);
		
		$image4 = wiImage::load($targetFile);
		$image4 = $image4->resize(175, 175,'outside');
		$image4 = $image4->crop(0, 0, 175, 175);
		$image4->saveToFile($targetFile4);		
						

		
		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile4);
		
		
	include( $_SERVER['DOCUMENT_ROOT'].'/crud/diversos/bibliotecas/jcrop/m2brimagem.class.php' );
	$oImg = new m2brimagem( $_SERVER['DOCUMENT_ROOT']."/crud/diversos/uploads/uploadsN/".$_REQUEST['timestamp'].$_FILES[$campoFile]['name'] );
	if( $oImg->valida() == 'OK' )
	{
		$oImg->posicaoCrop(0,0 );
		$oImg->redimensiona( 400, 400, 'crop' );
		$oImg->redimensiona( '400', '', '' );		
		$oImg->grava( $_SERVER['DOCUMENT_ROOT']."/crud/diversos/uploads/uploadsG/".$_REQUEST['timestamp'].$_FILES[$campoFile]['name'] );
		
		
		}
		
	
}
}
?>