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

$con = bancoMysqli();

$_SESSION['idPedido'] = $_GET['id_ped'];



$ano=date('Y');

if(isset($_POST['cadastraRepresentante'])){
	$cpf = $_POST['CPF'];
	$verificaCPF = verificaExiste("sis_representante_legal","CPF",$cpf,"");
	if($verificaCPF['numero'] > 0){ //verifica se o cpf já existe
		$mensagem = "O CPF já consta no sistema. Faça uma busca e insira diretamente.";
	}else{ // o CPF não existe, inserir.
	if($_POST['numero'] == 1){
		$campo = "idRepresentante01";
	}else{
		$campo = "idRepresentante02";
	}
	$RepresentanteLegal = $_POST['RepresentanteLegal'];
	$RG = $_POST['RG'];
	$CPF = $_POST['CPF'];
	$Nacionalidade = $_POST['Nacionalidade'];
	$IdEstadoCivil = $_POST['IdEstadoCivil'];
	$idUsuario = $_SESSION['idUsuario'];
 	$sql_insert_representante = "INSERT INTO `sis_representante_legal` (`Id_RepresentanteLegal`, `RepresentanteLegal`, `RG`, `CPF`, `Nacionalidade`, `IdEstadoCivil`, `idEvento`) VALUES (NULL, '$RepresentanteLegal', '$RG', '$CPF', '$Nacionalidade', '$IdEstadoCivil', NULL);";
		$query_insert_representante = mysqli_query($con,$sql_insert_representante);
		if($query_insert_representante){
			gravarLog($sql_insert_representante);
			$sql_ultimo = "SELECT * FROM sis_representante_legal ORDER BY Id_ResponsavelLegal DESC LIMIT 0,1"; //recupera ultimo id
			$id_evento = mysqli_query($con,$sql_ultimo);
			$id = mysqli_fetch_array($id_evento);
			$idRepresentante = $id['Id_RepresentanteLegal'];
			$idPedido = $_SESSION['idPedido'];
			
			$sql_insert_pedido = "UPDATE `igsis_pedido_contratacao` SET `$campo` = '$idRepresentante' 
	WHERE `idPedidoContratacao` = '$idPedido';";
			$query_insert_pedido = mysqli_query($con,$sql_insert_pedido);
			
			if($query_insert_pedido){
				gravarLog($sql_insert_pedido);
				echo "<h1>Inserido com sucesso!</h1>";
			}else{
				echo "<h1>Erro ao inserir!</h1>";
			}
		}else{
			echo "<h1>Erro ao inserir!</h1>";
		}
	}
	
}



if(isset($_POST['insereRepresentante'])){ //insere IdExecutante
	$id_representante = $_POST['insereRepresentante'];
	if($_POST['numero'] == 1){
		$campo = "idRepresentante01";
	}else{
		$campo = "idRepresentante02";
	}
	$idPedido = $_SESSION['idPedido'];
	$sql_atualiza_representante = "UPDATE `igsis_pedido_contratacao` SET `$campo` = '$id_representante' 
	WHERE `idPedidoContratacao` = '$idPedido';";
	$query_atualiza_representante = mysqli_query($con,$sql_atualiza_representante);	
	if($query_atualiza_representante){
		$mensagem = "Representante legal $campo inserido com sucesso!";	
	}
}



if(isset($_POST['insereExecutante'])){ //insere IdExecutante
	$id_executante = $_POST['insereExecutante'];
	$idPedido = $_SESSION['idPedido'];
	$sql_atualiza_executante = "UPDATE `igsis_pedido_contratacao` SET `IdExecutante` = '$id_executante' 
	WHERE `idPedidoContratacao` = '$idPedido';";
	$query_atualiza_executante = mysqli_query($con,$sql_atualiza_executante);	
	if($query_atualiza_executante){
		$mensagem = "Executante inserido com sucesso!";	
	}
}

if(isset($_POST['cadastraExecutante'])){
	$cpf = $_POST['CPF'];
	$verificaCPF = verificaExiste("sis_pessoa_fisica","CPF",$cpf,"");
	if($verificaCPF['numero'] > 0){ //verifica se o cpf já existe
		$mensagem = "O CPF já consta no sistema. Faça uma busca e insira diretamente.";
	}else{ // o CPF não existe, inserir.
		$Nome = $_POST['Nome'];
		$NomeArtistico = $_POST['NomeArtistico'];
		$RG = $_POST['RG'];
		$CPF = $_POST['CPF'];
		$CCM = $_POST['CCM'];
		$IdEstadoCivil = $_POST['IdEstadoCivil'];
		$DataNascimento = exibirDataMysql($_POST['DataNascimento']);
		$Nacionalidade = $_POST['Nacionalidade'];
		$CEP = $_POST['CEP'];
		$Endereco = $_POST['Endereco'];
		$Numero = $_POST['Numero'];
		$Complemento = $_POST['Complemento'];
		$Bairro = $_POST['Bairro'];
		$Cidade = $_POST['Cidade'];
		$Telefone1 = $_POST['Telefone1'];
		$Telefone2 = $_POST['Telefone2'];
		$Telefone3 = $_POST['Telefone3'];
		$Email = $_POST['Email'];
		$DRT = $_POST['DRT'];
		$Funcao = $_POST['Funcao'];
		$InscricaoINSS = $_POST['InscricaoINSS'];
		$OMB = $_POST['OMB'];
		$Observacao = $_POST['Observacao'];
		$Pis = 0;
		$data = date('Y-m-d');
		$idUsuario = $_SESSION['idUsuario'];
		$sql_insert_pf = "INSERT INTO `sis_pessoa_fisica` (`Id_PessoaFisica`, `Foto`, `Nome`, `NomeArtistico`, `RG`, `CPF`, `CCM`, `IdEstadoCivil`, `DataNascimento`, `LocalNascimento`, `Nacionalidade`, `CEP`, `Numero`, `Complemento`, `Telefone1`, `Telefone2`, `Telefone3`, `Email`, `DRT`, `Funcao`, `InscricaoINSS`, `Pis`, `OMB`, `DataAtualizacao`, `Observacao`, `IdUsuario`) VALUES (NULL, NULL, '$Nome', '$NomeArtistico', '$RG', '$CPF', '$CCM', '$IdEstadoCivil', '$DataNascimento', NULL, '$Nacionalidade', '$CEP', '$Numero', '$Complemento', '$Telefone1', '$Telefone2', '$Telefone3', '$Email', '$DRT', '$Funcao', '$InscricaoINSS', '$Pis', '$OMB', '$data', '$Observacao', '$idUsuario');";
		$query_insert_pf = mysqli_query($con,$sql_insert_pf);
		if($query_insert_pf){
			gravarLog($sql_insert_pf);
			$sql_ultimo = "SELECT * FROM sis_pessoa_fisica ORDER BY Id_PessoaFisica DESC LIMIT 0,1"; //recupera ultimo id
			$id_evento = mysqli_query($con,$sql_ultimo);
			$id = mysqli_fetch_array($id_evento);
			$idFisica = $id['Id_PessoaFisica'];
			$idPedido = $_SESSION['idPedido'];
			$sql_insert_pedido = "UPDATE `igsis_pedido_contratacao` SET `IdExecutante` = '$idFisica' 
	WHERE `idPedidoContratacao` = '$idPedido';";
			$query_insert_pedido = mysqli_query($con,$sql_insert_pedido);
			
			if($query_insert_pedido){
				gravarLog($sql_insert_pedido);
				echo "<h1>Inserido com sucesso!</h1>";
			}else{
				echo "<h1>Erro ao inserir!</h1>";
			}
		}else{
			echo "<h1>Erro ao inserir!</h1>";
		}
	}
	
}


if(isset($_POST['Valor'])){ // atualiza o pedido
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
		$x = recuperaDados("igsis_pedido_contratacao",$_GET['id_ped'],"idPedidoContratacao");
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
$res01 = siscontratDocs($ped['idRepresentante01'],3);
$res02 = siscontratDocs($ped['idRepresentante02'],3);

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
					  <form class="form-horizontal" role="form"  method="post" action="?perfil=contratos&p=frm_edita_pj&id_pj=<?php echo $ped['idPessoa']; ?>">
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
		  <form class="form-horizontal" role="form" action="?perfil=contratos&p=frm_edita_executante&id_pf=<?php echo $pedido['IdExecutante']?>"  method="post">
					  <input type='text' readonly class='form-control' name='Executante' id='Executante' value="<?php echo $executante['Nome'] ?>">                    	
                    </div>
                  </div>  
                    <div class="form-group">
					<div class="col-md-offset-2 col-md-8">

                      <input type="hidden" name="idPedido" value="<?php echo $id_ped; ?>" />
                     <?php if($pedido['IdExecutante'] == NULL OR $pedido['IdExecutante'] == ""){ ?>
					 <input type="submit" class="btn btn-theme btn-med btn-block" value="Inserir executante">
                     <?php }else{ ?>
					 <input type="submit" class="btn btn-theme btn-med btn-block" value="Abrir executante">
                     <?php } ?>
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
					  <input type='text' readonly class='form-control' name='RazaoSocial' id='RazaoSocial' value="<?php echo $res01['Nome']; ?>">                    	
                    </div>
                  </div>  
                    <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <form class="form-horizontal" role="form"  method="post" action="?perfil=contratos&p=frm_edita_representantelegal&num=1&id_rep=<?php echo $ped['idRepresentante01']?>">
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
					  <input type='text' readonly class='form-control' name='Executante' id='Executante' value="<?php echo $res02['Nome']; ?>">                    	
                    </div>
                  </div>  
                    <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <form class="form-horizontal" role="form"  method="post" action="?perfil=contratos&p=frm_edita_representantelegal&num=2&id_rep=<?php echo $ped['idRepresentante02']?>">
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
                  <form class="form-horizontal" role="form" action="?perfil=contratos&p=frm_edita_pedidocontratacaopj&id_ped=<?php echo $_SESSION['idPedido']; ?>" method="post">
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
					
					<?php echo opcaoUsuario($_SESSION['idInstituicao'],$evento['idResponsavel']) ?>
                    </select>	
					</div>
					<div class="col-md-6"><strong>Suplente:</strong>

                    					   				<select class="form-control" name="Suplente" id="inputSubject" >
                        
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
var_dump($evento);
?>