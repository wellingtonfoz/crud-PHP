
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="jquery.min.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
.Msg {
	font-family: Georgia, "Times New Roman", Times, serif;
}
</style>
</head>

<body>
<span style="font-size:12px;">
* Caso o botão de envio não apareça! Ative o Flash Player em seu navegador!<br><br>
</span>
<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple>
	</form>
     
    <script type="text/javascript">
		<?php 
					$timestamp = time();
					$abc  = "";
					$abc = date('dmYHis').trim($abc);
					$abcd = $_GET['idCadastro'];
		?>
		
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $abc;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
				},
				'buttonText' : 'Enviar Fotos...',
				'swf'      : 'uploadify.swf',
				'uploader' : 'uploadify.php',
				'fileTypeExts' : '*.gif; *.jpg; *.png; *.jpeg',
				'fileTypeDesc' : 'Image Files',
				'onUploadSuccess' : function(file, data, response) {
					var a = "<?php echo $abc;?>";
					  window.parent.insert(<?php echo $abcd; ?>,a+file.name);
					  
				}
			});
		});
		
		$('input').hide();
		
	</script>
</body>
</html>