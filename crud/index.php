<?php

$soativos = true;

@session_start();
if(isset($_SESSION["admin"]))
{
	$soativos = false;
}  

require_once("dao/DAOCadastro.class.php");
require_once("dao/DAOFoto.class.php");


$daoCadastro = new DAOCadastro();
$daoFoto = new DAOFoto();

$listaCadastros = $daoCadastro->getCadastros($soativos);

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
<link href="css/style.css?2" rel="stylesheet">
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

<!-- shop 3col -->
<section id="shop">
    <div class="container">
        <div class="row">

            <div class="col-sm-12 content-area">
                <p class="shop-results">CADASTRO DE VEÍCULOS 
			
                    <span class="pull-right">


                    <?php if($soativos){ ?>
					<a href="admin.php" class="btn btn-md btn-primary-filled btn-log btn-rounded">
					    Logar
					</a>
                    <?php }else{ ?>    
					<a href="controller/ControllerCadastro.class.php?acao=novo" class="btn btn-success-filled btn-rounded"><i class="lnr lnr-plus-circle"></i>
						Incluir
					</a>                                    
					<a href="controller/logout.php" class="btn btn-md btn-danger-filled btn-log btn-rounded">
					    Deslogar
					</a>        
                    <?php } ?>                                					
					
                    </span>
                </p>
                <div id="grid" class="row">
				
				
				
				
				
				
				
				<?php foreach($listaCadastros as $cadastro){ ?>
				
                    <!-- product -->
                    <div class="col-xs-6 col-md-3 product">
                        <a href="item.php?id=<?php echo $cadastro->getId(); ?>" class="product-link"></a>


                            <?php
							$aux = $daoFoto->getFotoPrincipal( $cadastro->getId() );
							 if($aux != ""){ ?>
                                <img style="border:solid 1px #b1b1b1;" src="/crud/diversos/uploads/uploadsG/<?php echo $aux; ?>">
                           <?php } else{ ?>
                                <img style="border:solid 1px #b1b1b1;" src="/crud/images/semimagem.jpg">                           
                           <?php } ?>


                        <!-- product-hover-tools -->
                        <div class="product-hover-tools">
                            <a href="item.php?id=<?php echo $cadastro->getId(); ?>" class="view-btn">
                                <i class="lnr lnr-eye"></i>
                            </a>
                            <?php if(!$soativos){ ?>
                            <a href="edit.php?id=<?php echo $cadastro->getId(); ?>" class="add-to-cart">
                                <i class="lnr lnr-pencil"></i>
                            </a>
                            <button style="border:none" onClick="if(confirm('Tem certeza que deseja DELETAR este cadastro e todas as fotos?')){location. href= '/crud/controller/ControllerCadastro.class.php?acao=deletar&id=<?php echo $cadastro->getId(); ?>'}"  class="add-to-cart2">
                                <i class="lnr lnr-trash"></i>
                            </button>		
                            <?php } ?>					
                        </div><!-- / product-hover-tools -->
                        <!-- product-details -->
                        <div class="product-details">
                            <h3 class="product-title" style="width:100%;margin-bottom:0"><?php if($cadastro->getDesativar() == 1) echo "<b style='color:red'>[OFF] </b>"; ?>
                            <?php echo $cadastro->getTitulo(); ?></h3><h3 class="product-title" align="right" style="width:100%;text-align:right"><b><?php echo $cadastro->getValor(); ?></b></h3>
                        </div><!-- / product-details -->
                    </div><!-- / product -->
					
				<?php } ?>

					
					
					
					
					
					

                    <!-- grid-resizer -->
                    <div class="col-xs-6 col-md-3 shuffle_sizer"></div>
                    <!-- / grid-resizer -->

                </div><!-- / row -->

            </div><!-- / content-area -->

        </div><!-- / row -->
    </div><!-- / container -->
</section>
<!-- / shop 3col -->

<!-- / content -->









<!-- javascript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js"></script>

<!-- shuffle grid-resizer -->
<script src="js/jquery.shuffle.min.js"></script>
<script src="js/custom.js"></script>
<!-- / shuffle grid-resizer -->

<!-- preloader -->
<script src="js/preloader.js"></script>
<!-- / preloader -->

<!-- / javascript -->
</body>


</html>