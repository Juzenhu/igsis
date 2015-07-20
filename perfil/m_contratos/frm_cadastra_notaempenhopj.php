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

$last_id=$_GET['id'];
$idContrato=$_GET['idContrato'];

?>	
    	<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">CADASTRO DE NOTA DE EMPENHO</div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" <?php echo "action='insercao_notaempenhopj.php?idContrato=$idContrato'";?> method="post">
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="Id_PedidoContratacao"  name="Id_PedidoContratacao" <?php echo " value='$last_id' ";?>>
					</div>
				  </div>
				 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="NumeroNotaEmpenho" name="NumeroNotaEmpenho" placeholder="Número da Nota de Empenho">
					</div>
				  </div>
                  
                   <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="date" class="form-control" id="DataEmissaoNotaEmpenho" name="DataEmissaoNotaEmpenho" placeholder="Data de Emissao da Nota de Empenho">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="date" class="form-control" id="DataEntregaNotaEmpenho" name="DataEntregaNotaEmpenho" placeholder="Data de Entrega da Nota de Empenho">
					</div>
				  </div>
					
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <input type="submit" value="GRAVAR" class="btn btn-theme btn-lg btn-block">
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