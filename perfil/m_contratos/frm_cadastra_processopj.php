<?php

$_SESSION['idPedido'] = $_GET['id_ped'];

?>	
    	<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">CADASTRO DE PROCESSO</div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" <?php echo "action='?perfil=contratos&p=insercao_processopj&id=$id_ped'"; ?> method="post">
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="Id_PedidoContratacao"  name="Id_PedidoContratacao" <?php echo " value='$id_ped' ";?>>
					</div>
				  </div>
				 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="NumeroProcesso" name="NumeroProcesso" placeholder="Número do Processo">
					</div>
				  </div>
					
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
					</div>
				  </div>
				</form>
	
	  			</div>
			
	  		</div>
			

	  	</div>
	  </section>  
