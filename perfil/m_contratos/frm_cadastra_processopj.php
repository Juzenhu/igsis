<?php

$_SESSION['idPedido'] = $_GET['id_ped'];
$id_ped = $_GET['id_ped'];
$pedido = recuperaDados("igsis_pedido_contratacao",$id_ped,"idPedidoContratacao");

?>	
    	<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title"><h2>CADASTRO DE PROCESSO</h2></div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" <?php echo "action='?perfil=contratos&p=insercao_processopj&id=$id_ped'"; ?> method="post">
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Código do Pedido de Contratação:</strong>
					  <input type="text" class="form-control" id="Id_PedidoContratacao"  name="Id_PedidoContratacao" <?php echo " value='$id_ped' ";?>>
					</div>
				  </div>
				 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Número do Processo: *</strong>
					  <input type="text" class="form-control" id="NumeroProcesso" name="NumeroProcesso" placeholder="Número do Processo"  value="<?php echo $pedido['NumeroProcesso']; ?>" /> 
					</div>
				  </div>
                  
				  <div class="col-md-offset-2 col-md-8"><strong>Assinatura:</strong><br/>
                    <form class="form-horizontal" role="form" action="?perfil=contratos&p=insercao_proposta_pf&id_ped=<?php echo $_GET['id_ped']; ?>" method="post">
                    
					  <select class="form-control" name="Id_Assinatura" id="Id_Assinatura"><option>Selecione</option>
                      <?php
						geraOpcao("sis_assinatura",$pedido['IdAssinatura'],$_SESSION['idInstituicao']);
					  ?>  
                      </select>
                      <br />
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
