<?php
		include($_SERVER['DOCUMENT_ROOT']."/crud/controller/ControllerAcesso.class.php");
?>
<?php
require_once("dao/DAOFoto.class.php");
require_once("dao/DAOCadastro.class.php");
$daoCadastro = new DAOCadastro();
$cadastro = $daoCadastro->getCadastro($_GET['id']);

$daoFoto = new DAOFoto();
$listaFotos = NULL;
$listaFotos = $daoFoto->getFotosCadastro($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">


<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Responsive Shop Theme">
<meta name="keywords" content="responsive, retina ready, shop bootstrap template, html5, css3" />

<!-- page title -->
<title>Cadastro</title>
<!-- bootstrap css -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- css -->
<link href="css/style.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">
<!-- fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href='fonts/FontAwesome.otf' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/linear-icons.css">
<!--
<link rel="stylesheet" href="css/jquery.fancybox.css">
-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>

<!-- preloader -->
<div id="preloader">
    <div class="spinner spinner-round"></div>
</div>


<!-- 
       <div id="altera" style="display:none">
          <div class="modal-body" style="padding:0; margin:0;max-height:768px">
              <iframe src="" name="principal" width="100%"
               marginwidth="1" height="600px" marginheight="0" frameborder="0" id="jCropFrame"></iframe>
          </div>
        </div>

     -->


<!-- content -->

<!-- shop single-product -->
<section id="shop">
		<form action="controller/ControllerCadastro.class.php" method="POST">

    <div class="container">
        <div class="row">
        
        
            		<div class="col-sm-8 col-md-8">
				
                    <h3><?php echo $cadastro->getTitulo(); ?> - <?php echo $cadastro->getValor(); ?></h3>
					
				</div>
                
        		<div class="col-sm-4 col-md-4" align="right">
				
                            <button style="margin:0" type="submit" class="btn btn-submit btn-success-filled btn-rounded">Salvar Alterações</button>
					<a href="index.php" class="btn btn-primary-filled btn-rounded"> Voltar</span></a>
                          
					
				</div> 
                
                
                        

            <!-- product content area -->
            <div class="col-sm-5 col-md-6 content-area">
                <div class="product-content-area" id="content">

















		
	
			<div id="contentInfo" style=" height:150px; width:100%; padding:0; border:dashed 1px #b1b1b1">

              <iframe src="diversos/bibliotecas/uploadify/uploadCadastro.php?idCadastro=<?php echo $cadastro->getId(); ?>" name="principal" width="100%" marginwidth="1" height="100%" marginheight="0" frameborder="0" id="principal"></iframe>

            </div>
<h4 class="space-top-30">Fotos</h4>      
      
            <?php if(count($listaFotos) == 0){ ?>
            
		<div id="esconder" align="center"><br><br><br>
            Faça o upload das imagens...
            </div>
            
            <?php  } ?>

                  <input type="hidden" id="idFotoPrincipal" value=""/>
                  
                  
                  
                  
<?php if($listaFotos != null) foreach($listaFotos as $foto){ ?>
				
                
                    <div class="col-xs-4 col-md-4 product box-<?php echo $foto->getId(); ?>">
                        <a href="#" class="product-link"></a>
                        
                        <?php if($foto->getPrincipal()){?>
                        <img style="border:solid 1px #b1b1b1; box-shadow:7px 6px green" id="foto-<?php echo $foto->getId(); ?>" src="/crud/diversos/uploads/uploadsP/<?php echo $foto->getFotoPath(); ?>" alt="">
     <script type="text/javascript">
   		document.getElementById('idFotoPrincipal').value = <?php echo $foto->getId(); ?>;							
	</script>
     <?php }else {?> 
                        <img style="border:solid 1px #b1b1b1;" id="foto-<?php echo $foto->getId(); ?>" src="/crud/diversos/uploads/uploadsP/<?php echo $foto->getFotoPath(); ?>" alt="">     
     <?php } ?> 
                             
                        <div class="product-hover-tools" style="right:1px">
                            
                            <button type="button" style="border:none;width:120px" onClick="if(confirm('Tornar esta foto a principal para a listagem inicial?')){javascript:fotoprincipal(<?php echo $foto->getId();?>,<?php echo $cadastro->getId(); ?>)}"  class="add-to-cart">
                                <i class="lnr lnr-screen"></i> Principal
                            </button>        
      
                            <button type="button" style="border:none;width:120px" onClick="if(confirm('Tem certeza que deseja DELETAR esta foto?')){javascript:excluirFoto(<?php echo $foto->getId();?>)}"  class="add-to-cart2">
                                <i class="lnr lnr-trash"></i> Deletar
                            </button>                            							
                        </div>
                        <div class="product-details">
                        </div>
                    </div>
					
                    
                    
				<?php } ?>
                
                
                
                
           




      
                    <!-- / tab-content -->
                </div><!-- / product-content-area -->


    

            </div>
            <!-- / project-content-area -->

            <!-- project sidebar area -->
            <div class="col-sm-7 col-md-6 product-sidebar">
                <div class="product-details">
                
                <!-- add review -->
                <div id="add-review" class="space-top-100" >
                
                    <div class="row">
                        <div class="col-sm-12 review-form">
                            <input value="<?php echo $cadastro->getTitulo(); ?>" id="titulo" name="titulo" style="background-color:white" type="text" class="form-control" placeholder="Título" required>
                        </div>                     

                        <div class="col-sm-12 review-form">
                            <textarea  id="descricao" name="descricao" style="background-color:white" rows="4" class="form-control" placeholder="Descrição" required><?php echo $cadastro->getDescricao(); ?></textarea>
                        </div>
                         
                        <div class="col-sm-6 review-form">
                            <input value="<?php echo $cadastro->getValor(); ?>" id="valor" name="valor" style="background-color:white" type="text" class="form-control" placeholder="Valor" required>
                        </div>
                        
                        <div class="col-sm-6 review-form">
                            <select style="background-color:white;width:90%;height:50px;margin-top:0px" class="selectpicker" id="desativar" name="desativar">
                            	<option <?php if($cadastro->getDesativar() == 0) echo "selected"; ?> value="0">Anúncio Ativado</option>
                            	<option <?php if($cadastro->getDesativar() == 1) echo "selected"; ?> value="1">Anúncio Desativado</option>
                            </select>
                        </div>   
                                                                        
                                                 
                    </div><!-- / row -->
                </div>
                <!-- / add review -->

                        <input type="hidden" id="id" name="id" value="<?php echo $cadastro->getId(); ?>">
                        <input type="hidden" id="acao" name="acao" value="alterar">

                    
					<h4 class="space-top-30">Informações Gerais</h4>
                   
				   <div class="product-info">
                        <div class="col-sm-6 review-form">
                            <input value="<?php echo $cadastro->getAno(); ?>" id="ano" name="ano" style="background-color:white" type="text" class="form-control" placeholder="Ano" required>
                        </div>  
                        
                        <div class="col-sm-6 review-form">
                            <input value="<?php echo $cadastro->getCor(); ?>" id="cor" name="cor" style="background-color:white" type="text" class="form-control" placeholder="Cor" required>
                        </div> 
                        
                        <div class="col-sm-6 review-form">
                            <select style="background-color:white;width:90%;height:50px;margin-top:0px" class="selectpicker" id="combustivel" name="combustivel">
                            	<option <?php if($cadastro->getCombustivel() == "Gasolina") echo "selected"; ?> value="Gasolina">Gasolina</option>
                            	<option <?php if($cadastro->getCombustivel() == "Etanol") echo "selected"; ?> value="Etanol">Etanol</option>
                            	<option <?php if($cadastro->getCombustivel() == "Diesel") echo "selected"; ?> value="Diesel">Diesel</option>
                            	<option <?php if($cadastro->getCombustivel() == "Flex") echo "selected"; ?> value="Flex">Flex</option>
                            </select>
                        </div>                          
                        
                        
                        <div class="col-sm-6 review-form">
                            <input value="<?php echo $cadastro->getKm(); ?>" id="km" name="km" style="background-color:white" type="text" class="form-control" placeholder="KM" required>
                        </div> 
                        
                        
                        <div class="col-sm-6 review-form">
                            <select style="background-color:white;width:90%;height:50px;margin-top:0px" class="selectpicker" id="transmissao" name="transmissao">
                            	<option <?php if($cadastro->getTransmissao() == "Manual") echo "selected"; ?> value="Manual">Manual</option>
                            	<option <?php if($cadastro->getTransmissao() == "Automática") echo "selected"; ?> value="Automática">Automática</option>
                            	<option <?php if($cadastro->getTransmissao() == "Automática Sequencial") echo "selected"; ?> value="Automática Sequencial">Automática Sequencial</option>
                            	<option <?php if($cadastro->getTransmissao() == "Semi-Automática") echo "selected"; ?> value="Semi-Automática">Semi-Automática</option>
                            	<option <?php if($cadastro->getTransmissao() == "CVT") echo "selected"; ?> value="CVT">CVT</option>
                            </select>
                        </div> 
                        
                        <div class="col-sm-6 review-form">
                            <select style="background-color:white;width:90%;height:50px;margin-top:0px" class="selectpicker" id="placa" name="placa">

<option <?php if($cadastro->getPlaca() == "A**-****") echo "selected"; ?> value="A**-****">A**-****</option>
<option <?php if($cadastro->getPlaca() == "B**-****") echo "selected"; ?> value="B**-****">B**-****</option>
<option <?php if($cadastro->getPlaca() == "C**-****") echo "selected"; ?> value="C**-****">C**-****</option>
<option <?php if($cadastro->getPlaca() == "D**-****") echo "selected"; ?> value="D**-****">D**-****</option>
<option <?php if($cadastro->getPlaca() == "E**-****") echo "selected"; ?> value="E**-****">E**-****</option>
<option <?php if($cadastro->getPlaca() == "F**-****") echo "selected"; ?> value="F**-****">F**-****</option>
<option <?php if($cadastro->getPlaca() == "G**-****") echo "selected"; ?> value="G**-****">G**-****</option>
<option <?php if($cadastro->getPlaca() == "H**-****") echo "selected"; ?> value="H**-****">H**-****</option>
<option <?php if($cadastro->getPlaca() == "I**-****") echo "selected"; ?> value="I**-****">I**-****</option>
<option <?php if($cadastro->getPlaca() == "J**-****") echo "selected"; ?> value="J**-****">J**-****</option>
<option <?php if($cadastro->getPlaca() == "K**-****") echo "selected"; ?> value="K**-****">K**-****</option>
<option <?php if($cadastro->getPlaca() == "L**-****") echo "selected"; ?> value="L**-****">L**-****</option>
<option <?php if($cadastro->getPlaca() == "M**-****") echo "selected"; ?> value="M**-****">M**-****</option>
<option <?php if($cadastro->getPlaca() == "N**-****") echo "selected"; ?> value="N**-****">N**-****</option>
<option <?php if($cadastro->getPlaca() == "O**-****") echo "selected"; ?> value="O**-****">O**-****</option>
<option <?php if($cadastro->getPlaca() == "P**-****") echo "selected"; ?> value="P**-****">P**-****</option>
<option <?php if($cadastro->getPlaca() == "Q**-****") echo "selected"; ?> value="Q**-****">Q**-****</option>
<option <?php if($cadastro->getPlaca() == "R**-****") echo "selected"; ?> value="R**-****">R**-****</option>
<option <?php if($cadastro->getPlaca() == "S**-****") echo "selected"; ?> value="S**-****">S**-****</option>
<option <?php if($cadastro->getPlaca() == "T**-****") echo "selected"; ?> value="T**-****">T**-****</option>
<option <?php if($cadastro->getPlaca() == "U**-****") echo "selected"; ?> value="U**-****">U**-****</option>
<option <?php if($cadastro->getPlaca() == "V**-****") echo "selected"; ?> value="V**-****">V**-****</option>
<option <?php if($cadastro->getPlaca() == "W**-****") echo "selected"; ?> value="W**-****">W**-****</option>
<option <?php if($cadastro->getPlaca() == "X**-****") echo "selected"; ?> value="X**-****">X**-****</option>
<option <?php if($cadastro->getPlaca() == "Y**-****") echo "selected"; ?> value="Y**-****">Y**-****</option>
<option <?php if($cadastro->getPlaca() == "Z**-****") echo "selected"; ?> value="Z**-****">Z**-****</option>

                            </select>
                        </div>                         
                                                

                                 
                        <br>
					<h4 class="space-top-30">Informações Complementares</h4>                        
                        
                        <div class="col-sm-12 review-form">
                            <textarea  id="complementar" name="complementar" style="background-color:white" rows="4" class="form-control" placeholder="Informações Complementares" required><?php echo $cadastro->getComplementar(); ?></textarea>
                        </div>                                                                                      
												
                    </div>
			<!-- / project-info -->

                
		   
		   
		   
                </div><!-- product-details -->

            </div><!-- / col-sm-4 col-md-3 -->
            <!-- / project sidebar area -->
			
            <div class="col-sm-12 col-md-12" style="margin-top:10px">
			
			<?php 
			
			
			//se mexer aqui, tem que mexer no mesmo atributo em controllercadastro
			$possibilidades = "Tração 4x4;Ar Condicionado;CD Player;Controle de Tração;Freios ABS;Retrovisores Elétricos;AirBag;AirBag Duplo;Banco com Ajuste;IPVA Pago;Porta-Copos;Entrada USB;Controle de Estabilidade;Alarme;Ar Quente;Computador de Bordo;Direção Hidráulica;MP3 Player;Rodas de Liga Leve;Travas Elétricas;Volante com Regulagem;Encosto de Cabeça Traseiro;Farol de Neblina;Controle de Velocidade;Retrovisor Fotocrômico;Revisões em Concessionária;Aceita Troca";
			//se mexer aqui, tem que mexer no mesmo atributo em controllercadastro
			$itensA = explode(";", $possibilidades);
			$itensB = explode(";", $cadastro->getItens());
			
			for($i=0; $i<count($itensA); $i++){
				$checked = "";
				for($j=0; $j<count($itensB); $j++){
					if($itensB[$j] == $itensA[$i]){
						$checked = "checked";	
					}
				}
				
				 ?>
				<div class="col-sm-3 col-md-3">
					<div class="checkbox checkbox-primary space-bottom" style="margin-top:0">
						<label class="hide"><input type="checkbox"></label>
						<input id="itenss[<?php echo $i;?>]" name="itenss[<?php echo $i;?>]" type="checkbox" <?php echo $checked; ?>>
						<label for="itenss[<?php echo $i;?>]"><span><?php echo $itensA[$i];?></span></label>
					</div>							
				</div>	
			<?php } ?>
				

				
			</div>

			
<br>

			

        </div><!-- / row -->

        
		
		
		
    </div><!-- / container -->
                       </form>

</section>
<!-- / shop single-product -->

<!-- / content -->


<!-- javascript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<!--
<script src="js/jquery.fancybox.js"></script>
-->

<!-- scrolling-nav -->
<script src="js/scrolling-nav.js"></script>
<!-- / scrolling-nav -->

<!-- preloader -->
<script src="js/preloader.js"></script>
<!-- / preloader -->


<script type="text/javascript">
function insert(idCadastro,nome){
	jQuery.ajax({
     type: "GET",
     url: "/crud/dao/DAOFoto.class.php",
     data: "inserir="+nome+"&idCadastro="+idCadastro,
     dataType: 'JSON', 
	 success: function(data){
	 
					for (var i = 0; i < data.length; i++) {  
					var idFoto = data[i].id; 
									
					var texto = '<div class="col-xs-4 col-md-4 product box-'+idFoto+'"> <a href="#" class="product-link"></a> <img style="border:solid 1px #b1b1b1;" id="foto-'+idFoto+'" src="/crud/diversos/uploads/uploadsP/'+nome+'" alt=""> <div class="product-hover-tools" style="right:1px"> <button type="button" style="border:none;width:120px" onClick="if(confirm(\'Tornar esta foto a principal para a listagem inicial?\')){javascript:fotoprincipal('+idFoto+','+idCadastro+')}"  class="add-to-cart"><i class="lnr lnr-desktop"></i> Principal</button>  <button type="button" style="border:none;width:120px" onClick="if(confirm(\'Tem certeza que deseja DELETAR esta foto?\')){javascript:excluirFoto('+idFoto+')}" class="add-to-cart2"> <i class="lnr lnr-trash"></i> Deletar </button></div><div class="product-details"></div></div>';
					
					var novaDiv=$(texto);
				
					$('#content').append(novaDiv);	
					$('#esconder').hide();	
					
		}			
	 }         
     }).done(function( msg ) {		
 });
 }
 
 
 function fotoprincipal(idfoto, idCadastro){
	jQuery.ajax({
     	url: "/crud/dao/DAOFoto.class.php",
		data: ({id:idfoto, idCadastro:idCadastro, acao:"fotoprincipal"}),	
		type: "POST"	,
		success: function(){	
			$( "#foto-"+idfoto ).css('box-shadow', "7px 6px green");				
			$( "#foto-"+idfoto ).attr('src', $("#foto-"+idfoto).attr('src')+'?'+Math.random());			
			$( "#foto-"+document.getElementById('idFotoPrincipal').value ).css('box-shadow', "none");		
			document.getElementById('idFotoPrincipal').value = idfoto;							
		}		

	});
}
 
 
 function excluirFoto(idfoto){
	jQuery.ajax({
		url: '/crud/dao/DAOFoto.class.php',
		data: ({id:idfoto, acao:"excluir"}),	
		type: "POST",
		success: function(){
			jQuery('.box-'+idfoto).remove();
		}
	});
}

        
    
 
	/*
	function setarValores(path,id){
			document.getElementById('jCropFrame').src = 
			"/crud/diversos/bibliotecas/uploadify/cropCadastro.php?idCadastro=" + <?php echo $cadastro->getId(); ?>+"&fotoPath="+path+"&idFoto="+id; 
	}	
*/
    </script>


</body>


</html>