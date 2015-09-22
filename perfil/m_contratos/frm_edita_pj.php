<?php
$con = bancoMysqli();
$id_pj = $_GET['id_pj'];
if(isset($_POST['idPedido'])){
	$_SESSION['idPedido'] = $_POST['idPedido'];
}
$idPedido = $_SESSION["idPedido"];

if(isset($_POST['editaJuridica'])){
		$idJuridica = $_POST['editaJuridica'];
		$RazaoSocial = $_POST['RazaoSocial'];
		$CNPJ = $_POST['CNPJ'];
		$CCM = $_POST['CCM'];
		$CEP = $_POST['CEP'];
		$Numero = $_POST['Numero'];
		$Complemento = $_POST['Complemento'];
		$Telefone1 = $_POST['Telefone1'];
		$Telefone2 = $_POST['Telefone2'];
		$Telefone3 = $_POST['Telefone3'];
		$Email = $_POST['Email'];
		$Observacao = $_POST['Observacao'];
		$data = date("Y-m-d");
		$idUsuario = $_SESSION['idUsuario'];
		
		$sql_atualizar_juridica = "UPDATE `sis_pessoa_juridica` SET `RazaoSocial` = '$RazaoSocial', `CNPJ` = '$CNPJ', `CCM` = '$CCM', `CEP` = '$CEP', `Numero` = '$Numero', `Complemento` = '$Complemento', `Telefone1` = '$Telefone1', `Telefone2` = '$Telefone2', `Telefone3` = '$Telefone3', `Email` = '$Email',  `DataAtualizacao` = '$data', `Observacao` = '$Observacao' WHERE `sis_pessoa_juridica`.`Id_PessoaJuridica` = '$idJuridica';";
				if(mysqli_query($con,$sql_atualizar_juridica)){
			$mensagem = "Atualizado com sucesso!";	
		}else{
			$mensagem = "Erro ao atualizar! Tente novamente.";
		}
		
}


$pj = recuperaDados("sis_pessoa_juridica",$_GET['id_pj'],"Id_PessoaJuridica");



	
	?>
    
     	<?php include 'includes/menu.php';?>   
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">CADASTRO DE PESSOA JURÍDICA</div>
                                        <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">
                
                
                
                

				<form class="form-horizontal" role="form" action="?perfil=contratos&p=frm_edita_pj&id_pj=<?php echo $_GET['id_pj'];?>" method="post">
				  
			  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Razão Social:</strong><br/>
					  <input type="text" class="form-control" id="RazaoSocial" name="RazaoSocial" placeholder="RazaoSocial" value="<?php echo $pj['RazaoSocial']; ?>">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>CNPJ:</strong><br/>
					  <input type="text" readonly class="form-control" id="CNPJ" name="CNPJ" placeholder="CNPJ" value="<?php echo $pj['CNPJ']; ?>" >
					</div>
					<div class="col-md-6"><strong>CCM:</strong><br/>
					  <input type="text" class="form-control" id="CCM" name="CCM" placeholder="CCM" value="<?php echo $pj['CCM']; ?>">
					</div>
				  </div>
				  
				  <div class="form-group">
                  					<div class="col-md-offset-2 col-md-6"><strong>CEP *:</strong><br/>
					  <input type="text" class="form-control" id="CEP" name="CEP" placeholder="CEP" value="<?php echo $pj['CEP']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>Estado *:</strong><br/>
					  <input type="text" class="form-control" id="Estado" name="Estado" placeholder="Estado">
					</div>

				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Endereço *:</strong><br/>
					  <input type="text" class="form-control" id="Endereco" name="Endereco" placeholder="Endereço">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Número *:</strong><br/>
					  <input type="text" class="form-control" id="Numero" name="Numero" placeholder="Numero" value="<?php echo $pj['Numero']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>Complemento:</strong><br/>
					  <input type="text" class="form-control" id="Complemento" name="Complemento" placeholder="Complemento" value="<?php echo $pj['Complemento']; ?>">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Bairro *:</strong><br/>
					  <input type="text" class="form-control" id="Bairro" name="Bairro" placeholder="Bairro">
					</div>				  
					<div class=" col-md-6"><strong>Cidade *:</strong><br/>
					  <input type="text" class="form-control" id="Cidade" name="Cidade" placeholder="Cidade">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone1" name="Telefone1" placeholder="Telefone" value="<?php echo $pj['Telefone1']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone2" name="Telefone2" placeholder="Telefone" value="<?php echo $pj['Telefone2']; ?>" >
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone3" name="Telefone3" placeholder="Telefone" value="<?php echo $pj['Telefone3']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>E-mail:</strong><br/>
					  <input type="text" class="form-control" id="Email" name="Email" placeholder="E-mail">
					</div>
				  </div>
				  
			  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observações:</strong><br/>
					 <textarea name="Observacao" class="form-control" rows="10" placeholder=""><?php echo $pj['Observacao']; ?></textarea>
					</div>
				  </div>
				  
				  
				<!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                     <input type="hidden" name="editaJuridica" value="<?php echo $pj['Id_PessoaJuridica'] ?>" />
                     <input type="hidden" name="idPedidoContratacao" value="<?php echo $_SESSION['idPedido']; ?>" />
					 <input type="image" alt="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
				</form>
                	</div>
				  </div>
				
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                   <form class="form-horizontal" role="form" action="?perfil=contratos&p=frm_arquivos&idPessoa=<?php echo $pj['Id_PessoaJuridica']; ?>&tipoPessoa=2" method="post">
                    <input type="hidden" name="cadastrarFisica" value="<?php echo $pj['Id_PessoaJuridica'] ?>" />
                   
                   <input type="hidden" name="juridica" value="1" />
                

                    <input type="hidden" name="Sucesso" id="Sucesso" />
					 <input type="image" alt="Anexos" value="submit" class="btn btn-theme btn-block">
				</form>         
            </div>
    
	  			</div>
		



           					<div class="form-group">
                    <div class="col-md-offset-2 col-md-8">
                    	<br />
                </div>
                    	<br />
					</div>
					 <?php if(isset($_SESSION['idPedido']) OR $_SESSION['idPedido'] == "" ){ ?>
							  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <form class="form-horizontal" role="form" action="?perfil=contratos&p=frm_edita_pedidocontratacaopj&id_ped=<?php echo $_SESSION['idPedido'];?>" method="post">
                     <input type="hidden" name="editaJuridica" value="<?php echo $pj['Id_PessoaJuridica'] ?>" />
                     <input type="hidden" name="idPedidoContratacao" value="<?php echo $_SESSION['idPedido']; ?>" />
					 <input type="image" alt="Voltar ao pedido de contratação" value="submit" class="btn btn-theme  btn-block">
					</div>
				  </div>
				</form>
				<?php } ?>

			

	  	</div>
	  </section>  

