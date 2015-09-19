<?php 

/*
Campos para edição:
+ valor
+ Forma de pagamento
+ Verba
+ Justificativa
+ Fiscal
+ Suplente
+ Parecer Técnico

*/

$ano=date('Y');

if(isset($_POST['Valor'])){ // atualiza o pedido
	$con = bancoMysqli();
	$pedido = $_GET['id_ped'];
	$valor = dinheiroDeBr($_POST['Valor']); 
	$valor_individual = dinheiroDeBr($_POST['ValorIndividual']);
	$forma_pagamento = addslashes($_POST['FormaPagamento']);
	$verba = $_POST['Verba'];
	$justificativa = addslashes($_POST['Justificativa']);
	$fiscal = $_POST['Fiscal'];
	$suplente  = $_POST['Suplente'];
	$parecer = addslashes($_POST['ParecerTecnico']);

	$sql_atualiza_pedido = "UPDATE igsis_pedido_contratacao SET
		valor = '$valor',
		valorIndividual = '$valor_individual',
		formaPagamento = '$forma_pagamento',
		  `parecerArtistico` = '$parecer',
		   `justificativa` = '$justificativa', 
		idVerba = '$verba'
		WHERE idPedidoContratacao = '$pedido'";
	$query_atualiza_pedido = mysqli_query($con,$sql_atualiza_pedido);
	if($query_atualiza_pedido){
		$x = recuperaDados("igsis_pedido_contratacao",$pedido,"idPedidoContratacao");
		$idEvento = $x['idEvento'];
		$sql_atualiza_evento = "UPDATE `ig_evento` SET 
		`idResponsavel` = '$fiscal',
		 `suplente` = '$suplente'

		   WHERE `idEvento` = '$idEvento'
		";
		
		$query_atualiza_evento = mysqli_query($con,$sql_atualiza_evento);
		if($query_atualiza_evento){
			$mensagem = "Pedido atualizado com sucesso!";
		}else{
			$mensagem = "Erro ao atualizar(1). Tente novamente.";	
		}
			
	}else{
			$mensagem = "Erro ao atualizar(2). Tente novamente.";	
	}	


}


$id_ped=$_GET['id_ped'];

$pedido = siscontrat($id_ped);

$juridico = siscontratDocs($pedido['IdProponente'],2);

$evento = recuperaDados("ig_evento",$pedido['idEvento'],"idEvento");

$executante = siscontratDocs($pedido['IdExecutante'],1);

$ped = recuperaDados("igsis_pedido_contratacao",$id_ped,"idPedidoContratacao");

?>

<!-- MENU -->	
<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">PEDIDO DE CONTRTAÇÃO DE PESSOA JURÍDICA</div>
                    <h5><?php if(isset($mensagem)){echo $mensagem;}?> </h5>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">


				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Código do Pedido de Contratação:</strong><br/>
					  <input  name="Id_PedidoContratacaoPJ" readonly type="text" class="form-control" id="Id_PedidoContratacaoPJ" <?php echo "value='$ano-$id_ped'"; ?> >
					</div>
                  </div>
				  <div class="form-group">                    
                    <div class=" col-md-offset-2 col-md-6"><strong>Setor:</strong> 
					  <input type="text" readonly class="form-control" value="<?php echo $pedido['Setor'];?>">
                    </div>
                    <div class="col-md-6"><strong>Categoria da Contratação:</strong> 
                     <input type="text" readonly class="form-control" value="<?php echo retornaTipo($evento['ig_tipo_evento_idTipoEvento']);?>">
					<div class="form-group">
                    <div class="col-md-offset-2 col-md-8">
                    <br />
	                </div>
					</div>

                      
                    </div>
                  </div>
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Proponente:</strong><br/>
					  <input type='text' readonly class='form-control' name='RazaoSocial' id='RazaoSocial' value="<?php echo $juridico['Nome'];?>">                    	
                    </div>
                  </div>  
                    <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <form class="form-horizontal" role="form"  method="post" action="">
                      <input type="hidden" name="idPedido" value="<?php echo $id_ped; ?>" />
                     
					 <input type="submit" class="btn btn-theme btn-med btn-block" value="Abrir proponente">
                     </form>

					</div>
				  </div>
					<div class="form-group">
                    <div class="col-md-offset-2 col-md-8">
                    <br />
	                </div>
					</div>



                                      <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Executante:</strong><br/>
					  <input type='text' readonly class='form-control' name='Executante' id='Executante' value="">                    	
                    </div>
                  </div>  
                    <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <form class="form-horizontal" role="form"  method="post">
                      <input type="hidden" name="idPedido" value="<?php echo $id_ped; ?>" />
                     
					 <input type="submit" class="btn btn-theme btn-med btn-block" value="Abrir executante">
                     </form>

					</div>
				  </div>
					<div class="form-group">
                    <div class="col-md-offset-2 col-md-8">
                    	<br />
                </div>
                    	<br />
					</div>

                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Representante legal #01:</strong><br/>
					  <input type='text' readonly class='form-control' name='RazaoSocial' id='RazaoSocial' value="">                    	
                    </div>
                  </div>  
                    <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <form class="form-horizontal" role="form"  method="post" action="">
                      <input type="hidden" name="idPedido" value="<?php echo $id_ped; ?>" />
                     
					 <input type="submit" class="btn btn-theme btn-med btn-block" value="Abrir Representante legal #01">
                     </form>

					</div>
				  </div>
					<div class="form-group">
                    <div class="col-md-offset-2 col-md-8">
                    <br />
	                </div>
					</div>



                                      <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Representante legal #02:</strong><br/>
					  <input type='text' readonly class='form-control' name='Executante' id='Executante' value="">                    	
                    </div>
                  </div>  
                    <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <form class="form-horizontal" role="form"  method="post">
                      <input type="hidden" name="idPedido" value="<?php echo $id_ped; ?>" />
                     
					 <input type="submit" class="btn btn-theme btn-med btn-block" value="Abrir Representante legal #02">
                     </form>

					</div>
				  </div>
					<div class="form-group">
                    <div class="col-md-offset-2 col-md-8">
                    	<br />
                </div>
                    	<br />
					</div>

                    				
                  <div class="form-group">
                  <form class="form-horizontal" role="form" action="?perfil=contratos&p=frm_edita_pedidocontratacaopj&id_ped=<?php echo $pedido['IdProponente']; ?>" method="post">
					<div class="col-md-offset-2 col-md-8"><strong>Objeto: (se for necessário alterar este item, contacte o administrador local)</strong><br/>
					  <input type="text" readonly name="Objeto" class="form-control" value="<?php echo $pedido['Objeto'];?>">
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Local:</strong><br/>
					 <input type='text' readonly name="LocalEspetaculo" class='form-control' value="<?php echo $pedido['Local'];?>">
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Valor:</strong><br/>
					  <input type='text' name="Valor" class='form-control' id='valor' value="<?php echo dinheiroParaBr($pedido['ValorGlobal']);?>">
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Forma de Pagamento:</strong><br/>
                      <textarea name="FormaPagamento" cols="40" rows="5"><?php echo $pedido['FormaPagamento'];?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Período:</strong><br/>
					   <input type='text' readonly name="Periodo" class='form-control'value="<?php echo $pedido['Periodo'];?>">
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Duração:  </strong>
					   <input type='text' readonly name="Duracao" class='form-control' value="<?php echo $pedido['Duracao']." minutos";?>" >
					</div>
					<div class="col-md-6"><strong>Carga Horária:</strong><br/>
					   <input type='text' readonly name="CargaHoraria" class='form-control' value="<?php echo $pedido['Horario'];?>">
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Verba:</strong><br/>
					   <select class="form-control" name="Verba" id="Verba">
                       <?php geraOpcao("sis_verba",$pedido['Verba'],""); ?>
                      </select>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Justificativa:</strong><br/>
                      <textarea name="Justificativa" cols="40" rows="5"><?php echo $ped['justificativa'];?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Fiscal:</strong>
					  <select class="form-control" name="Fiscal" id="inputSubject" >
					<option value="1"></option>	
					<?php echo opcaoUsuario($_SESSION['idInstituicao'],$evento['idResponsavel']) ?>
                    </select>	
					</div>
					<div class="col-md-6"><strong>Suplente:</strong>

                    					   				<select class="form-control" name="Suplente" id="inputSubject" >
                        <option value="1"></option>
						<?php echo opcaoUsuario($_SESSION['idInstituicao'],$evento['suplente']) ?>
                        </select>	
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Parecer Técnico:</strong><br/>
					  <textarea name="ParecerTecnico" cols="40" rows="5"><?php echo $ped['parecerArtistico'];?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					   <textarea name="Observacao" cols="40" rows="5"><?php echo $pedido['Observacao'];?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Data do Cadastro:</strong><br/>
					   <input type='text' name="DataAtual" class='form-control' <?php //echo "value='$linha_tabelas[DataAtual]'";?>>
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
	  </section>    
<?php 
var_dump($pedido);
var_dump($_SESSION);
?>