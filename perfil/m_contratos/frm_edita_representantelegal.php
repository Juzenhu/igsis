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


$id_rep=$_GET['id_rep'];


$sql_query_tabelas_representante ="SELECT * FROM representante_legal WHERE Id_RepresentanteLegal = $id_rep";

$consulta_tabelas = mysqli_query($conexao,$sql_query_tabelas_representante);
$linha_tabelas = mysqli_fetch_assoc ($consulta_tabelas);					

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

				<form class="form-horizontal" role="form" <?php echo "action='update_representantelegal.php?id_rep=$id_rep'" ;?> method="post">
				  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="Id_RepresentanteLegal" name="Id_RepresentanteLegal" <?php echo "value='$id_rep'"; ?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="RepresentanteLegal" name="RepresentanteLegal" <?php echo "value='$linha_tabelas[RepresentanteLegal]'";?>>
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6">
					  <input type="text" class="form-control" id="RG" name="RG" <?php echo "value='$linha_tabelas[RG]'";?>>
					</div>
					<div class="col-md-6">
					  <input type="text" class="form-control" id="CPF" name="CPF" <?php echo "value='$linha_tabelas[CPF]'";?>>
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6">
					  <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" <?php echo "value='$linha_tabelas[Nacionalidade]'";?>>
					</div>
					<div class="col-md-6">
					  <select class="form-control" name="IdEstadoCivil" id="IdEstadoCivil" <?php echo "value='$linha_tabelas[IdEstadoCivil]'";?>><option>Estado Civil</option>
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



<!--footer -->
<?php include 'includes/footer.html';?>

  	
</html>