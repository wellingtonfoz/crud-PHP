<?php

$logado = false;

@session_start();
if(isset($_SESSION["admin"]))
{
	$logado = true;
}  

require_once("dao/DAOCadastro.class.php");
require_once("dao/DAOFoto.class.php");

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





  <meta property="og:url"           content="http://200.195.178.52/crud/item.php?id=<?php echo $cadastro->getId(); ?>" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="<?php echo $cadastro->getTitulo(); ?> - <?php echo $cadastro->getValor(); ?>" />
  <meta property="og:description"   content="<?php echo $cadastro->getDescricao(); ?>" />
  <meta property="og:image"         content="http://200.195.178.52/crud/diversos/uploads/uploadsG/<?php echo $daoFoto->getFotoPrincipal( $cadastro->getId() ); ?>" />
  
  
  
  
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
<!-- / preloader -->


<!-- content -->

<!-- shop single-product -->
<section id="shop">
    <div class="container">
            		<div class="col-sm-8 col-md-8">
				
                    <h3><?php echo $cadastro->getTitulo(); ?> - <?php echo $cadastro->getValor(); ?></h3>
					
				</div>
                
                
        		<div class="col-sm-4 col-md-4" align="right">
                

<?php if($logado){ ?>

 <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/pt_BR/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <!-- Your share button code -->
  <div class="fb-share-button" 
    data-href="http://200.195.178.52/crud/item.php?id=<?php echo $cadastro->getId(); ?>" 
    data-layout="button"
    data-size="large"
    >
  </div>
  
  <?php } ?>

  
  
					<a href="index.php" class="btn btn-primary-filled btn-rounded"> Voltar</span></a>
					
				</div> 
        <div class="row">
        
        
               

            <!-- product content area -->
            <div class="col-sm-4 col-md-5 content-area">
                <div class="product-content-area">
                    <div id="product-slider" class="carousel slide" data-ride="carousel">
                        <!-- wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                        
                        <?php for($i=0; $i<count($listaFotos); $i++){ ?>
                            <div class="item <?php if($i == 0) echo "active"; ?>">
                                <img src="/crud/diversos/uploads/uploadsN/<?php echo $listaFotos[$i]->getFotoPath(); ?>" alt="">
                            </div>
                        <?php } ?>
                        <?php if(count($listaFotos) == 0){ ?>
                            <div class="item active">
                                <img src="/crud/images/semimagemitem.jpg" alt="">
                            </div>
                        <?php } ?>                        
                            
                        </div>
                        <!-- / wrapper for slides -->

                        <!-- controls -->
                        <a class="left carousel-control" href="#product-slider" role="button" data-slide="prev">
                            <span class="lnr lnr-chevron-left" aria-hidden="true"></span>
                        </a>
                        <a class="right carousel-control" href="#product-slider" role="button" data-slide="next">
                            <span class="lnr lnr-chevron-right" aria-hidden="true"></span>
                        </a>
                        <!-- / controls -->
                    </div><!-- / product-slider -->

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#description" role="tab" data-toggle="tab" aria-expanded="true">Informações Complementares</a></li>
                    </ul>
                    <!-- / nav-tabs -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane animated fadeIn active" id="description">
                            <p><?php echo $cadastro->getComplementar(); ?></p>
                        </div>
                        <!-- / description-tab -->

                    </div>
                    <!-- / tab-content -->
                </div><!-- / product-content-area -->


    

            </div>
            <!-- / project-content-area -->

            <!-- project sidebar area -->
            <div class="col-sm-8 col-md-7 product-sidebar">
                <div class="product-details">
                    <h4><?php echo $cadastro->getTitulo(); ?> - <?php echo $cadastro->getValor(); ?></h4>
                    <p><?php echo $cadastro->getDescricao(); ?></p>
                    
					<h4 class="space-top-30">Informações Gerais</h4>
                   
				   <div class="product-info">
						<div class="col-md-6">
							<div class="info">
								<p><i style="color:#1187a9;font-size:25px" class="lnr lnr-calendar-full"></i>
								<span style="color:#1187a9;font-size:15px">Ano: <b><?php echo $cadastro->getAno(); ?></b></span></p>
							</div>
							<div class="info">
								<p><i style="color:#1187a9;font-size:25px" class="lnr lnr-earth"></i>
								<span style="color:#1187a9;font-size:15px">Combustível: <b><?php echo $cadastro->getCombustivel(); ?></b></span></p>
							</div>
							<div class="info">
								<p><i style="color:#1187a9;font-size:25px" class="lnr lnr-car"></i>
								<span style="color:#1187a9;font-size:15px">Transmissão: <b><?php echo $cadastro->getTransmissao(); ?></b></span></p>
							</div>
							<br>							
                        </div>
						<div class="col-md-6">
							<div class="info">
								<p><i style="color:#1187a9;font-size:25px" class="lnr lnr-car"></i>
								<span style="color:#1187a9;font-size:15px">Cor: <b><?php echo $cadastro->getCor(); ?></b></span></p>
							</div>
							<div class="info">
								<p><i style="color:#1187a9;font-size:25px" class="lnr lnr-map"></i>
								<span style="color:#1187a9;font-size:15px">KM: <b><?php echo $cadastro->getKm(); ?></b></span></p>
							</div>
							<div class="info">
								<p><i style="color:#1187a9;font-size:25px" class="lnr lnr-keyboard"></i>
								<span style="color:#1187a9;font-size:15px">Placa: <b><?php echo $cadastro->getPlaca(); ?></b></span></p>
							</div>		
<br>							
                        </div>						
                    </div>
			<!-- / project-info -->

                <!-- add review -->
                <div id="add-review" class="space-top-100" >
		<form action="controller/ControllerEmail.class.php" method="POST">
                
                    <h4 style="border-bottom:2px solid #ebebeb;padding-bottom:20px">Faça Sua Proposta</h4>
                    <div class="row">
                        <div class="col-sm-4 review-form">
                            <input id="nome" name="nome" style="background-color:white" type="text" class="form-control" placeholder="Nome" required>
                        </div>
                        <div class="col-sm-4 review-form">
                            <input id="email" name="email" style="background-color:white" type="text" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="col-sm-4 review-form">
                            <input id="telefone" name="telefone" style="background-color:white" type="text" class="form-control" placeholder="Telefone" required>
                        </div>
                        <input type="hidden" id="referente" name="referente" value="Referente a este veículo: http://200.195.178.52/crud/item.php?id=<?php echo $cadastro->getId(); ?>">
                        <div class="col-sm-12 review-form">
                            <textarea id="proposta" name="proposta" style="background-color:white" rows="4" class="form-control" placeholder="Proposta" required></textarea>
                            <button type="submit" class="btn btn-submit btn-primary-filled btn-rounded">Enviar Proposta</button>
                        </div>
                    </div><!-- / row -->
                   </form>
                </div>
                <!-- / add review -->
		   
		   
		   
                </div><!-- product-details -->

            </div><!-- / col-sm-4 col-md-3 -->
            <!-- / project sidebar area -->
			
            <div class="col-sm-12 col-md-12" style="margin-top:10px">
			
			<?php 
			$itens = explode(";", $cadastro->getItens());
			
			for($i=0; $i<count($itens); $i++){ ?>
				<div class="col-sm-3 col-md-3">
					<div class="checkbox checkbox-primary space-bottom" style="margin-top:0">
						<label class="hide"><input type="checkbox"></label>
						<input id="checkbox<?php echo $i;?>" type="checkbox" checked="">
						<label for="checkbox<?php echo $i;?>"><span><?php echo $itens[$i];?></span></label>
					</div>							
				</div>	
			<?php } ?>
				

				
			</div>

			
<br>

			

        </div><!-- / row -->

        
		
		
		
    </div><!-- / container -->
</section>
<!-- / shop single-product -->

<!-- / content -->


<!-- javascript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js"></script>

<!-- scrolling-nav -->
<script src="js/scrolling-nav.js"></script>
<!-- / scrolling-nav -->

<!-- preloader -->
<script src="js/preloader.js"></script>
<!-- / preloader -->

<script>
$("input:checkbox").click(function() { return false; });
</script>




  
  

<!-- / javascript -->
</body>


</html>