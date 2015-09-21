<?php

if(isset($_POST['Valor'])){ // atualiza o pedido
	$con = bancoMysqli();
	$ped = $_GET['id_ped'];
	$valor = $_POST['Valor']; 
	$valor_individual = $_POST['ValorIndividual'];
	$forma_pagamento = $_POST['FormaPagamento'];
	$verba = $_POST['Verba'];
	$justificativa = $_POST['Justificativa'];
	$fiscal = $_POST['Fiscal'];
	$suplente  = $_POST['Suplente'];
	$parecer = $_POST['ParecerTecnico'];

	$sql_atualiza_pedido = "UPDATE igsis_pedido_contratacao SET
		valor = '$valor',
		valorIndividual = '$valor_individual',
		formaPagamento = '$forma_pagamento',
		idVerba = '$verba',
		justificativa = '$justificativa',
		parecerArtistico = '$parecerArtistico'
		WHERE idPedidoContratacao = '$ped'";
	$query_atualiza_pedido = mysqli_query($con,$sql_atualiza_pedido);
	if($query_atualiza_pedido){
		$mensagem = "Pedido atualizado com sucesso.";
	}else{
		$mensagem = "Erro ao atualizar pedido.";
	}


}
$ano=date('Y');
$id_ped = $_GET['id_ped'];	
$linha_tabelas = siscontrat($id_ped);
$fisico = siscontratDocs($linha_tabelas['IdProponente'],1);		
$evento = recuperaDados("ig_evento",$linha_tabelas['idEvento'],"idEvento");
$pedido = recuperaDados("igsis_pedido_contratacao",$_GET['id_ped'],"idPedidoContratacao");
?>

<!-- MENU -->	
<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<h2>PEDIDO DE CONTRTAÇÃO DE PESSOA JURÍDICA</h2>
                    <h4><?php if(isset($mensagem)){ echo $mensagem; } ?></h4>
                     </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Código do Pedido de Contratação:</strong><br/>
					</div>
                  </div>
				  <div class="form-group">                    
                    <div class=" col-md-offset-2 col-md-6"><strong>Setor:</strong> 
					  <input type="text" readonly class="form-control" value="<?php echo $linha_tabelas['Setor'];?>">
                    </div>
                    <div class="col-md-6"><strong>Categoria da Contratação:</strong> 
                    <input type="text" readonly class="form-control" value="<?php echo retornaTipo($evento['ig_tipo_evento_idTipoEvento']);?>">
                      
                    </div>
                  </div>
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Proponente:</strong><br/>
					  <input type='text' readonly class='form-control' name='nome' id='nome' value='<?php echo $fisico['Nome'];?>'>                    	
                    </div>
                  </div>  
					<div class="form-group">
                    <div class="col-md-offset-2 col-md-8">
                    	<br />
                </div>
                    	<br />
					</div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Objeto:</strong><br/>
					  <input type="text" readonly name="Objeto" class="form-control"  value="<?php echo $linha_tabelas['Objeto'];?>">
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Local:</strong><br/>
					 <input type='text' readonly name="LocalEspetaculo" class='form-control' value="<?php echo $linha_tabelas['Local'];?>">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Valor Global:</strong><br/>
					  <input type='text' readonly name="Valor" class='form-control' id='valor' value='<?php echo dinheiroParaBr($linha_tabelas['ValorGlobal']);?>'>
					</div>
					<div class="col-md-6"><strong>Valor Individual:</strong><br/>
					  <input type='text' readonly name="ValorIndividual" class='form-control' id='valor' value='<?php echo dinheiroParaBr($linha_tabelas['ValorIndividual']);?>'>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Forma de Pagamento:</strong><br/>
                      <textarea name="FormaPagamento" readonly cols="40" rows="5"><?php echo "$linha_tabelas[FormaPagamento]";?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Período:</strong><br/>
					   <input type='text' readonly name="Periodo" class='form-control' <?php echo "value='$linha_tabelas[Periodo]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Duração: </strong>
					   <input type='text' readonly name="Duracao" class='form-control' <?php echo "value='$linha_tabelas[Duracao]'";?>>
					</div>
					<div class="col-md-6"><strong>Carga Horária:</strong><br/>
					   <input type='text' readonly name="CargaHoraria" class='form-control' <?php //echo "value='$linha_tabelas[CargaHoraria]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Verba:</strong><br/>
					   <select readonly class="form-control" name="Verba" id="Verba">
                       <?php geraOpcao("sis_verba",$linha_tabelas['Verba'],"") ?>
                      </select>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Justificativa:</strong><br/>
                      <textarea name="Justificativa" readonly cols="40" rows="5"><?php echo $pedido['justificativa']; ?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Fiscal:</strong>
					   <input type='text' name="Fiscal" readonly class='form-control' value="<?php echo $linha_tabelas['Fiscal'];?>">
					</div>
					<div class="col-md-6"><strong>Suplente:</strong>
					   <input type='text' name="Suplente" readonly class='form-control' value="<?php echo $linha_tabelas['Suplente'];?>">
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Parecer Técnico:</strong><br/>
					  <textarea name="ParecerTecnico" readonly cols="40" rows="5"><?php echo $pedido['parecerArtistico']; ?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					   <input type='text' name="Observacao" readonly class='form-control' <?php echo "value='$linha_tabelas[Observacao]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Data do Cadastro:</strong><br/>
					   <input type='text' name="DataAtual" readonly class='form-control' value="<?php echo $linha_tabelas['DataCadastro'];?>">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Assinatura:</strong><br/>
                    <form class="form-horizontal" role="form" action="?perfil=contratos&p=insercao_propostapj&id_ped=<?php echo $_GET['id_ped']; ?>" method="post">
                    
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

