<?php 

/*
igSmc v0.1 - 2015
ccsplab.org - centro cultural são paulo
*/

// Esta é a página de login do usuário ou de contato com administrador do sistema.

//Imprime erros com o banco


@ini_set('display_errors', '1');
error_reporting(E_ALL);

if(isset($_POST['usuario'])){
	include "funcoes/funcoesGerais.php";
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	autenticaUsuario($usuario,$senha);	

}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IGSMC - v0.1 - 2015</title>
    <link href="visual/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="visual/css/style.css" rel="stylesheet" media="screen">
	<link href="visual/color/default.css" rel="stylesheet" media="screen">
	<script src="visual/js/modernizr.custom.js"></script>
</head>


<body>
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="text-hide">
					 <h2>IGSIS - SMC</h2>
					 <p>É preciso ter um login válido. Dúdivas: igccsp2015@gmail.com </p>
					</div>
				  </div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form method="POST" action="index.php"class="form-horizontal" role="form">
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6">
					  <input type="text" name="usuario" class="form-control" id="inputName" placeholder="Usuário">
					</div>
				  
					<div class=" col-md-6">
					  <input type="password" name="senha" class="form-control" id="inputEmail" placeholder="Senha">
					</div>
				  </div>

				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <button type="submit" class="btn btn-theme btn-lg btn-block">Entrar</button>
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  


	 
	 <!-- js -->
    <script src="visual/js/jquery.js"></script>
    <script src="visual/js/bootstrap.min.js"></script>
	<script src="visual/js/jquery.smooth-scroll.min.js"></script>
	<script src="visual/jquery.dlmenu.js"></script>
	<script src="visual/wow.min.js"></script>
	<script src="visual/custom.js"></script>
    


</body>
</html>
