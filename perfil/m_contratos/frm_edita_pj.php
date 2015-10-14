<?php

$ultimo = $_GET['id_pj']; //recupera o id da pessoa

if(isset($_POST['idPedido'])){
	$id_pedido = $_POST['idPedido']; //recupera o id do pedido
	$mensagem = $id_pedido;
}


$con = bancoMysqli();

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




$pj = recuperaDados("sis_pessoa_juridica",$ultimo,"Id_PessoaJuridica");

?>

<?php include 'includes/menu.php';?>


	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<h3>CADASTRO DE PESSOA JURÍDICA</h3>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                                        </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=contratos&p=frm_edita_pj&id_pj=<?php echo $ultimo ?>" method="post">
				  
			 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Razão Social *:</strong><br/>
					  <input type="text" class="form-control" id="RazaoSocial" name="RazaoSocial" placeholder="RazaoSocial" value="<?php echo $pj['RazaoSocial']; ?>">
					</div>
				  </div>

                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>CNPJ *:</strong><br/>
					  <input type="text" class="form-control" id="CNPJ" name="CNPJ" placeholder="CNPJ" value="<?php echo $pj['CNPJ']; ?>" >
					</div>
					<div class="col-md-6"><strong>CCM:</strong><br/>
					  <input type="text" class="form-control" id="CCM" name="CCM" placeholder="CCM" value="<?php echo $pj['CCM']; ?>">
					</div>
				  </div>
				  
				  <div class="form-group">				  
					<div class="col-md-offset-2 col-md-8"><strong>CEP *:</strong><br/>
					 					  <input type="text" class="form-control" id="CEP" name="CEP" placeholder="CEP" value="<?php echo $pj['CEP']; ?>">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Endereço:</strong><br/>
					  <input type="text" class="form-control" id="Endereco" name="Endereco" placeholder="Endereço">
					</div>
				  </div>
                  				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Número *:</strong><br/>
					  <input type="text" class="form-control" id="Numero" name="Numero" placeholder="Numero" value="<?php echo $pj['Numero']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>Bairro:</strong><br/>
					  <input type="text" class="form-control" id="Bairro" name="Bairro" placeholder="Bairro">
					</div>
				  </div>
                  	 <div class="form-group">
                     
					<div class="col-md-offset-2 col-md-8"><strong>Complemento *:</strong><br/>
					    <input type="text" class="form-control" id="Complemento" name="Complemento" placeholder="Complemento" value="<?php echo $pj['Complemento']; ?>">
					</div>
				  </div>		
                  				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Cidade *:</strong><br/>
										  <input type="text" class="form-control" id="Cidade" name="Cidade" placeholder="Cidade">

					</div>				  
					<div class=" col-md-6"><strong>Estado *:</strong><br/>
					  <input type="text" class="form-control" id="Estado" name="Estado" placeholder="Estado">
					</div>
				  </div>		  
				  <div class="form-group">
                  					<div class="col-md-offset-2 col-md-6"><strong>E-mail *:</strong><br/>
					<input type="text" class="form-control" id="Email" name="Email" placeholder="E-mail" value="<?php echo $pj['Email']; ?>" >
					</div>				  


					<div class=" col-md-6"><strong>Telefone #1 *:</strong><br/>

					  <input type="text" class="form-control" id="Telefone1" name="Telefone1" placeholder="Telefone" value="<?php echo $pj['Telefone1']; ?>">
					</div>

				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone #2:</strong><br/>
					  <input type="text" class="form-control" id="Telefone1" name="Telefone2" placeholder="Telefone" value="<?php echo $pj['Telefone2']; ?>">
					</div>				  
					<div class="col-md-6"><strong>Telefone #3:</strong><br/>
					  <input type="text" class="form-control" id="Telefone2" name="Telefone3" placeholder="Telefone"value="<?php echo $pj['Telefone3']; ?>" >
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					 <textarea name="Observacao" class="form-control" rows="10" placeholder=""></textarea>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="editaJuridica" value="<?php echo $pj['Id_PessoaJuridica'] ?>" />
                    <?php if(isset($id_pedido)){ ?>
                   <input type="hidden" name="idPedido" value="<?php echo $id_pedido ?>" />
                   <?php } ?>
                    <input type="hidden" name="Sucesso" id="Sucesso" />
					 <input type="submit" value="GRAVAR" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
                
                <!-- Botão para verificar arquivos da pessoa -->
				  <div class="form-group">
               	<div class="col-md-offset-2 col-md-6">
                <form class="form-horizontal" role="form" action="?perfil=contratos&p=frm_arquivos&idPessoa=<?php echo $ultimo; ?>&tipoPessoa=2" method="post">
                    <input type="hidden" name="editaJuridica" value="<?php echo $pj['Id_PessoaJuridica'] ?>" />
                   <input type="hidden" name="Juridica" value="<?php echo $pj['Id_PessoaJuridica'] ?>" />
                    <?php if(isset($id_pedido)){ ?>
                   <input type="hidden" name="idPedido" value="<?php echo $id_pedido ?>" />
                   <?php } ?>

                    <input type="hidden" name="Sucesso" id="Sucesso" />
					 <input type="submit" value="Anexos" class="btn btn-theme btn-block">
				</form>
					</div>
					<div class=" col-md-6">
                    <?php if(isset($id_pedido)){ ?>
                     <a href="?perfil=contratos&p=frm_edita_pedidocontratacaopj&id_ped=<?php echo $id_pedido ?>"><input type="submit" value="Voltar ao pedido" class="btn btn-theme btn-block"></a>
                   <?php } ?>

					</div>
				  </div>
    
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  
