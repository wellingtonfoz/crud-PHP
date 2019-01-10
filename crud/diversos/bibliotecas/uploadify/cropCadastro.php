<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="../jcrop/js/jquery.min.js"></script>
		<script type="text/javascript" src="../jcrop/js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="../jcrop/css/exemplo.css?2" type="text/css" />
		<link rel="stylesheet" href="../jcrop/css/jquery.Jcrop.css" type="text/css" />
	</head>
	<body>
				
		<?php
		include($_SERVER['DOCUMENT_ROOT']."/crud/controller/ControllerAcesso.class.php");

		
						// memory limit (nem todo server aceita)
						ini_set("memory_limit","50M");
						set_time_limit(0);
						
						// processa arquivo
						$img		= '';
						$idCadastro		= $_GET['idCadastro'];
						$idFoto		= $_GET['idFoto'];
						$fotoPath		= $_GET['fotoPath'];
						include( $_SERVER['DOCUMENT_ROOT'].'/crud/diversos/bibliotecas/jcrop/m2brimagem.class.php' );
						$oImg = new m2brimagem( $_SERVER['DOCUMENT_ROOT']."/crud/diversos/uploads/uploadsN/".$_GET['fotoPath'] );
						if( $oImg->valida() == 'OK' )
						{
							//$oImg->redimensiona( '400', '', '' );
							//$oImg->grava( $imagem['name'] );
							$imagesize 	= getimagesize( $_SERVER['DOCUMENT_ROOT']."/crud/diversos/uploads/uploadsN/".$_GET['fotoPath'] );
							$img		= '<img src="'."/crud/diversos/uploads/uploadsN/".$_GET['fotoPath'].'" id="jcrop" '.$imagesize[3].' />';
							$preview	= '<img src="'."/crud/diversos/uploads/uploadsN/".$_GET['fotoPath'].'" id="preview" '.$imagesize[3].' />';
						}else{
							$preview = "notok";						
							}
		?>
		
			<div id="div-jcrop" style="text-align:center">             
				<div id="div-preview2"><br>
                --------------------------------------
				<p style="font-size:12px; font-weight:bold; font-family:Verdana, Geneva, sans-serif;color:#06C">
                Miniatura para cadastro destaque:
                </p>
                --------------------------------------
                <br>
				  <div id="div-preview">
						<?php echo $preview; ?>
					</div><br>
                    --------------------------------------
				<p style="font-size:12px; font-weight:bold; font-family:Verdana, Geneva, sans-serif;color:#06C">
                Miniatura:
                </p>
                --------------------------------------
                <br>
					<div><img src="/crud/diversos/uploads/uploadsP/<?php echo $_GET['fotoPath']; ?>" width="125" height="125"> </div>                    
                <br>  <input type="button" value="Salvar" id="btn-crop" style="width:100px;height:30px" />                    
				</div>             

				<?php echo $img; ?>
				
			</div>
			<div id="debug" style="display:none">
				<p><strong>X</strong> 
                <input type="text" id="x" size="5" disabled /> x 
                <input type="text" id="x2" size="5" disabled /> </p>
				<p><strong>Y</strong> 
                <input type="text" id="y" size="5" disabled /> x 
                <input type="text" id="y2" size="5" disabled /> </p>
				<p><strong>Dimensões</strong> 
                <input type="text" id="h" size="5" disabled /> x 
                <input type="text" id="w" size="5" disabled /></p>
			</div>            

			<script type="text/javascript">
				var img = '<?php echo $fotoPath; ?>';
			
				$(function(){
					$('#jcrop').Jcrop({
						onChange: exibePreview,
						onSelect: exibePreview,
						aspectRatio: 1,
						boxWidth: 800,
						boxHeight: 800,						
					});
					$('#btn-crop').click(function(){
						$.post( 'crop.php', {
							img:img, 
							x: $('#x').val(), 
							y: $('#y').val(), 
							w: $('#w').val(), 
							h: $('#h').val()
						}, function(){
							$('#div-jcrop').html( '<br>As miniaturas ficaram assim: <br><br><img src="/crud/diversos/uploads/uploadsG/' + img + '?' + Math.random() + '" width="307" height="307" /><br><br><img src="/crud/diversos/uploads/uploadsP/' + img + '?' + Math.random() + '" width="125" height="125" /><br><br><br><br>Foto principal definida com sucesso!<br><br><br><br><br><br><br><br>' );
							$('#debug').hide();
							 window.parent.fotoprincipal(<?php echo $idFoto ?>,<?php echo $idCadastro ?>);
						});
						return false;
					});					
				});
				
				function exibePreview(c)
				{
					var rx = 185 / c.w;
					var ry = 185 / c.h;
				
					$('#preview').css({
						width: Math.round(rx * <?php echo $imagesize[0]; ?>) + 'px',
						height: Math.round(ry * <?php echo $imagesize[1]; ?>) + 'px',
						marginLeft: '-' + Math.round(rx * c.x) + 'px',
						marginTop: '-' + Math.round(ry * c.y) + 'px'
					});	
					
					$('#x').val(c.x);
					$('#y').val(c.y);
					$('#x2').val(c.x2);
					$('#y2').val(c.y2);
					$('#w').val(c.w);
					$('#h').val(c.h);					
				};
			</script>
	</body>
</html>