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

$sql_query_tabelas_contrato_pf ="SELECT * FROM contrato_pf WHERE Id_ContratoPF = $idContrato";

$consulta_tabelas = mysqli_query($conexao,$sql_query_tabelas_contrato_pf);
$linha_tabelas = mysqli_fetch_assoc ($consulta_tabelas);

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

				<form class="form-horizontal" role="form" <?php echo "action='update_proposta_pf.php?idContrato=$idContrato?id=$last_id'";?> method="post">
				 <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Id:</strong><br/>
					  <input type="text" class="form-control" id="Id_ContratoPF" name="Id_ContratoPF" <?php echo "value='$idContrato'"; ?>>
					</div>
					<div class="col-md-6"><strong>Código do Pedido de Contratação:</strong><br/>
					  <input type="text" class="form-control" id="IdPedidoContratacaoPF" name="IdPedidoContratacaoPF" <?php echo "value='$linha_tabelas[IdPedidoContratacaoPF]'";?>>
					</div>
				  </div>
				  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Número do Processo:</strong><br/>
					  <input type="text" class="form-control" id="NumeroProcesso" name="NumeroProcesso" placeholder="Número do Processo" <?php echo "value='$linha_tabelas[NumeroProcesso]'";?>>
					</div>
				  </div>
				 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Número da Nota de Empenho:</strong><br/>
					  <input type="text" class="form-control" id="NumeroNotaEmpenho" name="NumeroNotaEmpenho" placeholder="Número da Nota de Empenho" <?php echo "value='$linha_tabelas[NumeroNotaEmpenho]'";?>>
					</div>
				  </div>
                  
                   <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Data de Emissão da Nota de Empenho:</strong><br/>
					  <input type="date" class="form-control" id="DataEmissaoNotaEmpenho" name="DataEmissaoNotaEmpenho" placeholder="Data de Emissao da Nota de Empenho" <?php echo "value='$linha_tabelas[DataEmissaoNotaEmpenho]'";?>>
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Data de Entrega da Nota de Empenho:</strong><br/>
					  <input type="date" class="form-control" id="DataEntregaNotaEmpenho" name="DataEntregaNotaEmpenho" placeholder="Data de Entrega da Nota de Empenho" <?php echo "value='$linha_tabelas[DataEntregaNotaEmpenho]'";?>>
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