<!DOCTYPE html>
<html>
  <head>
    <title>IGSIS</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/style.css" rel="stylesheet" media="screen">
	<link href="../color/default.css" rel="stylesheet" media="screen">
	<script src="../js/modernizr.custom.js"></script>
      </head>
  <body>

<?php 
require("../conectar.php");

$consulta_tabela_estado_civil = mysqli_query ($conexao,"SELECT * FROM estado_civil");
$linha_tabela_estado_civil= mysqli_fetch_assoc($consulta_tabela_estado_civil);

?>

<!-- MENU -->	
<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">CADASTRO DE REPRESENTANTE LEGAL</div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="frm_cadastra_representantelegal.php" method="post">
				  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="RepresentanteLegal" name="RepresentanteLegal" placeholder="Representante Legal">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6">
					  <input type="text" class="form-control" id="RG" name="RG" placeholder="RG">
					</div>
					<div class="col-md-6">
					  <input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6">
					  <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" placeholder="Nacionalidade">
					</div>
					<div class="col-md-6">
					  <select class="form-control" name="IdEstadoCivil" id="IdEstadoCivil"><option>Estado Civil</option>
                      <?php
					  do
					  {
					  echo "<option value='$linha_tabela_estado_civil[Id_EstadoCivil]'>$linha_tabela_estado_civil[EstadoCivil]</option>";
					  }
					  while ($linha_tabela_estado_civil = mysqli_fetch_assoc($consulta_tabela_estado_civil))
					  ?>  
                      </select>
					</div>
				  </div>
                  
                  <!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <input type="image" name="enviar" alt="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
                    
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

<!-- para inserir -->

<?php

if(isset($_POST['enviar']))
{
	
$representanteLegal=$_POST['RepresentanteLegal'];
$rg=$_POST['RG'];
$cpf=$_POST['CPF'];
$nacionalidade=$_POST['Nacionalidade'];
$idEstadoCivil=$_POST['IdEstadoCivil'];





$incluir_tabela_representante_legal = "INSERT INTO representante_legal
		(
		RepresentanteLegal,
		RG,
		CPF,
		Nacionalidade,
		IdEstadoCivil
		)
		VALUES
		(
		'$representanteLegal',
		'$rg',
		'$cpf',
		'$nacionalidade',
		'$idEstadoCivil'
		)";
	
$stmt = mysqli_prepare($conexao,$incluir_tabela_representante_legal);		
if (mysqli_stmt_execute($stmt)) { echo "Dados inseridos com sucesso";};
}

?>

<!--footer -->
<?php include 'includes/footer.html';?>

  	
</html>