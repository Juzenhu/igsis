<?php
/*
Para fazer
+ funcao que retornam os locais
+ funcao que retornam os periodos
*/
$con = bancoMysqli();
if(isset($_GET['p'])){
	$p = $_GET['p'];
}else{
	$p = 'lista';	
}
$nomeEvento = recuperaEvento($_SESSION['idEvento']);

?>
<script type="text/javascript">$(document).ready(function(){	$("#cpf").mask("999.999.999-99");});</script>
	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li>
								<a href="?perfil=evento&p=basica"><< Voltar evento</a>
							</li>
							<li><a href="?perfil=contratados">Listar contratados</a></li>
							<li><a href="?perfil=contratados&p=fisica">Inserir Pessoa Física</a></li>
							<li><a href="?perfil=contratados&p=juridica">Inserir Pessoa Jurídica</a></li>
  							<li><a href="?perfil=contratados&p=representante">Inserir Representante</a></li>
							<li>
								<a href="#">Outras opções</a>
								<ul class="dl-submenu">
                            <li><a href="?secao=inicio">Início</a></li>
                            <li><a href="../include/logoff.php">Sair do sistema</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /dl-menuwrapper -->
	</div>	

<?php switch($p){
case 'lista': 
	
if(isset($_POST['cadastrarRepresentante'])){ //cadastra e insere represenante
	$RepresentanteLegal = $_POST['RepresentanteLegal'];
	$RG = $_POST['RG'];
	$CPF = $_POST['CPF'];
	$Nacionalidade = $_POST['Nacionalidade'];
	$IdEstadoCivil = $_POST['IdEstadoCivil'];
	
	$sql_insert = "INSERT INTO `sis_representante_legal` (`Id_RepresentanteLegal`, `RepresentanteLegal`, `RG`, `CPF`, `Nacionalidade`, `IdEstadoCivil`) VALUES (NULL, '$RepresentanteLegal', '$RG', '$CPF', '$Nacionalidade', $IdEstadoCivil)";
	if(mysql_query($sql_insert)){
		gravarLog($sql_insert);
		$sql_ultimo = "SELECT * FROM `sis_representante_legal` ORDER BY Id_RepresentanteLegal DESC LIMIT 0,1"; //recupera ultimo id inserido
		$id_evento = mysql_fetch_array(mysql_query($sql_ultimo));
		$id = $id_evento['Id_RepresentanteLegal'];
		$idEvento = $_SESSION['idEvento'];	
		$sql_insert_pedido = "INSERT INTO `igsis_pedido_contratacao` (`idPedidoContratacao`, `idEvento`, `tipoPessoa`, `idPessoaJuridica`, `idPessoaFisica`, `valor`, `valorPorExtenso`, `formaPagamento`, `idVerba`, `anexo`, `observacao`, `publicado`) VALUES (NULL, '$idEvento', '3', NULL, '$id', NULL, NULL, NULL, NULL, NULL, NULL, '1')";

	if(mysql_query($sql_insert_pedido)){
		gravarLog($sql_insert_pedido);
		$mensagem = "Representante legal inserido com sucesso. Agora é possível inserir Pessoas Jurídicas.";		
	}else{
		$mensagem = "Erro ao inserir o representante legal";
	}
	
		
}else{
	$mensagem = "Erro ao inserir o representante legal";
}


	
}
if(isset($_POST['inserirRepresentante'])){ //insere represenante existente
	
}
if(isset($_POST['cadastrarFisica'])){ //cadastra e insere pessoa física
	$cpf = $_POST['CPF'];
	$verificaCPF = verificaExiste("sis_pessoa_fisica","CPF",$cpf,"");
	if($verificaCPF['numero'] > 0){ //verifica se o cpf já existe
		$mensagem = "O CPF já consta no sistema. Faça uma busca e insira diretamente";
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
		$sql_insert_pf = "INSERT INTO `sis_pessoa_fisica` (`Id_PessoaFisica`, `Foto`, `Nome`, `NomeArtistico`, `RG`, `CPF`, `CCM`, `IdEstadoCivil`, `DataNascimento`, `LocalNascimento`, `Nacionalidade`, `CEP`, `Numero`, `Complemento`, `Telefone1`, `Telefone2`, `Telefone3`, `Email`, `DRT`, `Funcao`, `InscricaoINSS`, `Pis`, `OMB`, `DataAtualizacao`, `Observacao`, `IdUsuario`) VALUES (NULL, NULL, '$Nome', '$nomeArtistico', '$RG', '$CPF', '$CCM', '$IdEstadoCivil', '$DataNascimento', NULL, '$Nacionalidade', '$CEP', '$Numero', '$Complemento', '$Telefone1', '$Telefone2', '$Telefone3', '$Email', '$DRT', '$Funcao', '$InscricaoINSS', '$Pis', '$OMB', '$data', '$Observacao', '$idUsuario');";
		$query_insert_pf = mysqli_query($con,$sql_insert_pf);
		if($query_insert_pf){
			gravarLog($sql_insert_pf);
			$sql_ultimo = "SELECT * FROM sis_pessoa_fisica ORDER BY Id_PessoaFisica DESC LIMIT 0,1"; //recupera ultimo id
			$id_evento = mysqli_query($con,$sql_ultimo);
			$id = mysqli_fetch_array($id_evento);
			$idFisica = $id['Id_PessoaFisica'];
			$idEvento = $_SESSION['idEvento'];	
			$sql_insert_pedido = "INSERT INTO `igsis_pedido_contratacao` (`idPedidoContratacao`, `idEvento`, `tipoPessoa`, `idPessoa`,  `valor`, `valorPorExtenso`, `formaPagamento`, `idVerba`, `anexo`, `observacao`, `publicado`) VALUES (NULL, '$idEvento', '1', '$idFisica', NULL, NULL, NULL, NULL, NULL, NULL, '1')";
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
	

if(isset($_POST['insereFisica'])){ //insere pessoa física
	$idPessoa = $_POST['Id_PessoaFisica'];
	$idEvento = $_SESSION['idEvento'];
	$sql_verifica_cpf = "SELECT * FROM igsis_pedido_contratacao WHERE idPessoa = '$idPessoa' AND tipoPessoa = '1' AND publicado = '1' AND idEvento = '$idEvento' ";
	$query_verifica_cpf = mysqli_query($con,$sql_verifica_cpf);
	$num_rows = mysqli_num_rows($query_verifica_cpf);
	if($num_rows > 0){
		$mensagem = "A pessoa física já está na lista de pedido de contratação.";	
	}else{
		$sql_insere_pf = "INSERT INTO igsis_pedido_contratacao (idPessoa, tipoPessoa, publicado,idEvento) VALUES ('$idPessoa','1','1','$idEvento')";
		$query_insere_pf = mysqli_query($con,$sql_insere_pf);
		if($query_insere_pf){
			$mensagem = "Pedido inserido com sucesso!";
		}else{
			$mensagem = "Erro ao criar pedido. Tente novamente.";
	}
		 	
	}
}
if(isset($_POST['cadastrarJuridica'])){ //cadastra e insere pessoa jurídica
	$verificaCNPJ = verificaExiste("sis_pessoa_juridica","CNPJ",$_POST['CNPJ'],"");
	if($verificaCNPJ['numero'] > 0){ //verifica se o cpf já existe
		$mensagem = "O CNPJ já consta no sistema. Faça uma busca e insira diretamente";
	}else{ // o CPF não existe, inserir.
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
		$IdRepresentanteLegal1 = $_POST['IdRepresentanteLegal1'];
		$IdRepresentanteLegal2 = $_POST['IdRepresentanteLegal2'];
		$Observacao = $_POST['Observacao'];
		$data = date("Y-m-d");
		$idUsuario = $_SESSION['idUsuario'];
		$sql_inserir_pj = "INSERT INTO `sis_pessoa_juridica` (`Id_PessoaJuridica` , `RazaoSocial` ,`CNPJ` ,`CCM` ,`CEP` ,`Numero` ,`Complemento` ,`Telefone1` ,`Telefone2` ,`Telefone3` ,`Email` ,`IdRepresentanteLegal1` ,`IdRepresentanteLegal2` , `DataAtualizacao` ,`Observacao` ,`IdUsuario`) VALUES ( NULL ,  '$RazaoSocial',  '$CNPJ', '$CCM' , '$CEP' , '$Numero' , '$Complemento' ,  '$Telefone1', '$Telefone2' , '$Telefone3' , '$Email' ,  '$IdRepresentanteLegal1','$IdRepresentanteLegal2', '$data', '$Observacao' ,  '$idUsuario')";
		$query_inserir_pj = mysqli_query($con,$sql_inserir_pj);
		if($query_inserir_pj){
			gravarLog($sql_inserir_pj);
			$sql_ultimo = "SELECT * FROM sis_pessoa_juridica ORDER BY Id_PessoaJuridica DESC LIMIT 0,1"; //recupera ultimo id
			$id_evento = mysqli_query($con,$sql_ultimo);
			$id = mysqli_fetch_array($id_evento);
			$idJuridica = $id['Id_PessoaJuridica'];
			$idEvento = $_SESSION['idEvento'];	
			$sql_insert_pedido = "INSERT INTO `igsis_pedido_contratacao` (`idPedidoContratacao`, `idEvento`, `tipoPessoa`, `idRepresentante01`, `idPessoa`, `valor`, `valorPorExtenso`, `formaPagamento`, `idVerba`, `anexo`, `observacao`, `publicado`, `idRepresentante02`) VALUES (NULL, '$idEvento', '2', '$IdRepresentanteLegal1', '$idJuridica', NULL, NULL, NULL, NULL, NULL, NULL, '1', '$IdRepresentanteLegal2')";
			$query_insert_pedido = mysqli_query($con,$sql_insert_pedido);
			if($query_insert_pedido){
				gravarLog($sql_insert_pedido);
				echo "<h1>Inserido com sucesso!</h1>";
			}else{
				echo "<h1>Erro ao inserir o pedido(1)!</h1>";
			}
		}else{
			echo "<h1>Erro ao inserir(2)!</h1>";
		}
	}
}
if(isset($_POST['insereJurídica'])){ //insere pessoa jurídica
	$idInstituicao = $_SESSION['idInstituicao'];
	$idPessoa = $_POST['Id_PessoaJuridica'];
	$idEvento = $_SESSION['idEvento'];
	$sql_verifica_cnpj = "SELECT * FROM igsis_pedido_contratacao WHERE idPessoa = '$idPessoa' AND tipoPessoa = '2' AND publicado = '1' AND idEvento = '$idEvento' ";
	$query_verifica_cnpj = mysqli_query($con,$sql_verifica_cpf);
	$num_rows = mysqli_num_rows($query_verifica_cnpj);
	if($num_rows > 0){
		$mensagem = "A pessoa jurídica já está na lista de pedido de contratação.";	
	}else{
		$sql_insere_cnpj = "INSERT INTO igsis_pedido_contratacao (idPessoa, tipoPessoa, publicado, idEvento, instituicao) VALUES ('$idPessoa','2','1','$idEvento','$idInstituicao')";
		$query_insere_cnpj = mysqli_query($con,$sql_insere_cnpj);
		if($query_insere_cnpj){
			$mensagem = "Pedido inserido com sucesso!";
		}else{
			$mensagem = "Erro ao criar pedido. Tente novamente.";
	}
		 	
	}
}

if(isset($_POST['apagarPedido'])){	
	$idPedidoContratacao = $_POST['idPedidoContratacao'];
	$sql_apagar_pedido = "UPDATE igsis_pedido_contratacao SET publicado = '0' WHERE idPedidoContratacao = '$idPedidoContratacao'";
	$query_apagar_pedido = mysqli_query($con,$sql_apagar_pedido);
	if($query_apagar_pedido){
		$mensagem = "Pedido apagado com sucesso.";	
	}else{
		$mensagem = "Erro ao apagar o pedido. Tente novamente.";	
	}
}
?>	
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados</h2>
                     <p>Você está inserindo pessoas físicas ou jurídicas para serem contratadas para o evento <strong><?php  echo $nomeEvento['nomeEvento']; ?></strong></p>
                     <p>Para inserir pessoas jurídicas, é necessário antes inserir seus <a href="?perfil=contratados&p=representante">representantes</a>.</p>
                     <p><?php if(isset($mensagem)){ echo $mensagem; } ?></p>
<p></p>

					</div>
				  </div>
			  </div>
		<div class="container">
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
						<td>Razão Social / Nome</td>
						<td>Tipo de Pessoa</td>
						<td>CPF/CNPJ</td>
   						<td>Valor</td>
   							<td width="10%">
							<td width="10%">
  							<td width="10%">
							<td width="10%"></td>
						</tr>
					</thead>
					<tbody>
                    <?php
					$idEvento = $_SESSION['idEvento'];
					$sql_busca = "SELECT * FROM igsis_pedido_contratacao WHERE idEvento = '$idEvento' AND publicado = '1'";
					$query_busca = mysqli_query($con,$sql_busca);
					while($descricao = mysqli_fetch_array($query_busca)){
						$recuperaPessoa = recuperaPessoa($descricao['idPessoa'],$descricao['tipoPessoa']);
						echo "<tr>";
						echo "<td class='list_description'><b>".$recuperaPessoa['nome']."</b></td>";
						echo "<td class='list_description'>".$recuperaPessoa['tipo']."</td>";
						echo "<td class='list_description'>".$recuperaPessoa['numero']."</td>";
						echo "<td class='list_description'>".dinheiroParaBr($descricao['valor'])."</td>";
						
						echo "
						<td class='list_description'>
						<form method='POST' action='?perfil=contratados&p=arquivos'>
						<input type='hidden' name='idPessoa' value='".$descricao['idPessoa']."'>
						<input type='hidden' name='tipoPessoa' value='".$descricao['tipoPessoa']."'>

						<input type ='submit' class='btn btn-theme btn-sm btn-block' value='anexos'></td></form>"	; //botão de edição
						
						echo "
						<td class='list_description'>
						<form method='POST' action='?perfil=contratados&p=edicaoPessoa'>
						<input type='hidden' name='idPedidoContratacao' value='".$descricao['idPedidoContratacao']."'>
						<input type ='submit' class='btn btn-theme btn-sm btn-block' value='editar pessoa'></td></form>"	; //botão de edição
						
						echo "
						<td class='list_description'>
						<form method='POST' action='?perfil=contratados&p=edicaoPedido'>
						<input type='hidden' name='idPedidoContratacao' value='".$descricao['idPedidoContratacao']."'>
						<input type ='submit' class='btn btn-theme btn-sm btn-block' value='editar pedido'";
						if($descricao['tipoPessoa'] == 3){ echo "disabled"; } //não permite que Representante legal faça pedido.
						echo " ></td></form>"	; //botão de edição
						
						echo "
						<td class='list_description'>
						<form method='POST' action='?perfil=contratados&p=lista'>
						<input type='hidden' name=apagarPedido value='1'>
						<input type='hidden' name='idPedidoContratacao' value='".$descricao['idPedidoContratacao']."'>
						<input type ='submit' class='btn btn-theme btn-sm btn-block'";
						apagarRepresentante($descricao['idPessoa'],$descricao['tipoPessoa'],$_SESSION['idEvento']);
						echo " value='apagar pedido'></td></form>"	; //botão de apagar

						echo "</tr>";
					}
?>
						
					</tbody>
				</table>
			</div>
		</div>
        </div>
	</section>
<?php break; 
case 'juridica':

 ?>    
<?php
if(isset($_POST['pesquisar'])){ // inicia a busca por Razao Social ou CNPJ
	$busca = $_POST['busca'];
	$sql_busca = "SELECT * FROM sis_pessoa_juridica WHERE RazaoSocial LIKE '%$busca%' OR CNPJ LIKE '%$busca%' ORDER BY RazaoSocial";
	$query_busca = mysqli_query($con,$sql_busca); 
	$num_busca = mysqli_num_rows($query_busca);
	if($num_busca > 0){ // Se exisitr, lista a resposta.
	?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados - Pesso Jurídica</h2>
                                          <p>Você está inserindo pessoas jurídicas para serem contratadas para o evento <strong><?php echo $nomeEvento['nomeEvento']; ?></strong></p>

<p>></p>

					</div>
				  </div>
			  </div>
              	<section id="list_items" class="home-section bg-white">
		<div class="container">
<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Razão Social</td>
							<td>CNPJ</td>
							<td width="15%"></td>
                            <td width="15%"></td>
						</tr>
					</thead>
					<tbody>
                    <?php
				while($descricao = mysqli_fetch_array($query_busca)){			
			echo "<tr>";
			echo "<td class='list_description'><b>".$descricao['RazaoSocial']."</b></td>";
			echo "<td class='list_description'>".$descricao['CNPJ']."</td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=contratados&p=lista'>
			<input type='hidden' name='insereJuridica' value='1'>
			<input type='hidden' name='Id_PessoaJuridica' value='".$descricao['Id_PessoaJuridica']."'>
			<input type ='submit' class='btn btn-theme btn-md btn-block' value='inserir'></td></form>"	;
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=contratados&p=lista'>
			<input type='hidden' name='detalhe' value='".$descricao['Id_PessoaJuridica']."'>
			<input type ='submit' class='btn btn-theme btn-md btn-block' value='detalhe'></td></form>"	;
			echo "</tr>";
				}
?>
						
					</tbody>
				</table>
			</div>
            		</div>
	</section>
	
    <?php }else{ // Se não existe, exibe um formulario para insercao. ?>
	 <!-- Contact -->

	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">CADASTRO DE PESSOA JURÍDICA</div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=contratados&p=lista" method="post">
				  
			  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Razão Social:</strong><br/>
					  <input type="text" class="form-control" id="RazaoSocial" name="RazaoSocial" placeholder="RazaoSocial" >
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>CNPJ:</strong><br/>
					  <input type="text" class="form-control" id="CNPJ" name="CNPJ" placeholder="CNPJ" >
					</div>
					<div class="col-md-6"><strong>CCM:</strong><br/>
					  <input type="text" class="form-control" id="CCM" name="CCM" placeholder="CCM" >
					</div>
				  </div>
				  
				  <div class="form-group">
                  					<div class="col-md-offset-2 col-md-6"><strong>CEP *:</strong><br/>
					  <input type="text" class="form-control" id="CEP" name="CEP" placeholder="Bairro">
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
					  <input type="text" class="form-control" id="Numero" name="Numero" placeholder="Numero">
					</div>				  
					<div class=" col-md-6"><strong>Complemento:</strong><br/>
					  <input type="text" class="form-control" id="Complemento" name="Complemento" placeholder="Complemento">
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
					  <input type="text" class="form-control" id="Telefone1" name="Telefone1" placeholder="Telefone">
					</div>				  
					<div class=" col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone2" name="Telefone2" placeholder="Telefone" >
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone3" name="Telefone3" placeholder="Telefone">
					</div>				  
					<div class=" col-md-6"><strong>E-mail:</strong><br/>
					  <input type="text" class="form-control" id="Email" name="Email" placeholder="E-mail">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Representante Legal #1:</strong><br/>
					  <select class="form-control" id="IdRepresentanteLegal1" name="IdRepresentanteLegal1" >
					<?php geraOpcaoLegal($_SESSION['idEvento']); ?>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Representante Legal #2:</strong><br/>
					  <select class="form-control" id="IdRepresentanteLegal2" name="IdRepresentanteLegal2">
					<?php geraOpcaoLegal($_SESSION['idEvento']); ?>
					  </select>
					</div>
				  </div>
		  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observações:</strong><br/>
					 <textarea name="Observacao" class="form-control" rows="10" placeholder=""></textarea>
					</div>
				  </div>
				  
				  
				<!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                     <input type="hidden" name="cadastrarJuridica" value="1" />
					 <input type="image" alt="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  
  

<?php	} 
	

}else{ // Se não existe pedido de busca, exibe campo de pesquisa.
?>    
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados - Pessoa Jurídica</h2>
                    <p>Você está inserindo pessoas físicas para serem contratadas para o evento <strong><?php  echo $nomeEvento['nomeEvento']; ?></strong></p>

<p></p>

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            
                        <form method="POST" action="?perfil=contratados&p=juridica" class="form-horizontal" role="form">
            		<label>Insira o CNPJ</label>
            		<input type="text" name="busca" class="form-control" id="CNPJ" placeholder="" ><br />

            	</div>
             </div>
				<br />             
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
                	<input type="hidden" name="pesquisar" value="1" />
    		        <input type="submit" class="btn btn-theme btn-lg btn-block" value="Pesquisar">
                    </form>
        	    	</div>
        	    </div>

            </div>
	</section>
<?php } ?>
<?php 

break;
case 'fisica':
 ?>    
<?php
if(isset($_POST['pesquisar'])){ // inicia a busca por Razao Social ou CNPJ
	$busca = $_POST['busca'];
	$sql_busca = "SELECT * FROM sis_pessoa_fisica WHERE CPF = '$busca' ORDER BY Nome";
	$query_busca = mysqli_query($con,$sql_busca); 
	$num_busca = mysqli_num_rows($query_busca);
	if($num_busca > 0){ // Se exisitr, lista a resposta.
	?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados - Pessoa Física</h2>
                                          
<p></p>

					</div>
				  </div>
			  </div>
              	<section id="list_items" class="home-section bg-white">
		<div class="container">
<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Nome</td>
							<td>CPF</td>
							<td width="15%"></td>
                            <td width="15%"></td>
						</tr>
					</thead>
					<tbody>
                    <?php
				while($descricao = mysqli_fetch_array($query_busca)){			
			echo "<tr>";
			echo "<td class='list_description'><b>".$descricao['Nome']."</b></td>";
			echo "<td class='list_description'>".$descricao['CPF']."</td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=contratados&p=lista'>
			<input type='hidden' name='insereFisica' value='1'>
			<input type='hidden' name='Id_PessoaFisica' value='".$descricao['Id_PessoaFisica']."'>
			<input type ='submit' class='btn btn-theme btn-md btn-block' value='inserir'></td></form>"	;
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=contratados&p=lista'>
			<input type='hidden' name='detalhe' value='".$descricao['Id_PessoaFisica']."'>
			<input type ='submit' class='btn btn-theme btn-md btn-block' value='detalhe'></td></form>"	;
			echo "</tr>";
				}
?>
						
					</tbody>
				</table>
			</div>
            		</div>
                    </div>
                    
	</section>
	
    <?php }else{ // Se não existe, exibe um formulario para insercao. ?>
	<?php
	$ultimo = cadastroPessoa($_SESSION['idEvento'],$CPF,'1'); 
	$campo = recuperaDados("sis_pessoa_fisica",$ultimo,"Id_PessoaFisica");
	?>
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<h3>CADASTRO DE PESSOA FÍSICA</h3>
                    <p> O CPF <?php echo $busca; ?> não está cadastrado no nosso sistema. <br />Por favor, insira as informações da Pessoa Física a ser contratada. </p>
                    <p><a href="?perfil=contratados&p=fisica"> Pesquisar outro CPF</a> </p>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=contratados&p=lista" method="post">
				  
			 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Nome *:</strong><br/>
					  <input type="text" class="form-control" id="Nome" name="Nome" placeholder="Nome" >
					</div>
				  </div>

                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Nome Artístico:</strong><br/>
					  <input type="text" class="form-control" id="NomeArtistico" name="NomeArtistico" placeholder="Nome Artístico" >
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Tipo de documento *:</strong><br/>
					  <select class="form-control" id="tipoDocumento" name="tipoDocumento" >
					   <?php
						geraOpcao("igsis_tipo_documento","","");
						?>  
					  </select>

					</div>				  
					<div class=" col-md-6"><strong>Documento *:</strong><br/>
                      <input type="text" class="form-control" id="RG" name="RG" placeholder="Documento" >
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>CPF *:</strong><br/>
					  <input type="text" class="form-control" id="cpf" name="CPF" placeholder="CPF" value="<?php echo $busca; ?> ">
					</div>				  
					<div class=" col-md-6"><strong>CCM *:</strong><br/>
					  <input type="text" class="form-control" id="CCM" name="CCM" placeholder="CCM" >
					</div>
				  </div>

				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Estado civil:</strong><br/>
					  <select class="form-control" id="IdEstadoCivil" name="IdEstadoCivil" >
					   <?php
						geraOpcao("sis_estado_civil","","");
						?>  
					  </select>
					</div>				  
					<div class=" col-md-6"><strong>Data de nascimento:</strong><br/>
 <input type="text" class="form-control" id="datepicker01" name="DataNascimento" placeholder="Data de Nascimento" >
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Nacionalidade:</strong><br/>
					   <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" placeholder="Nacionalidade">
					</div>				  
					<div class=" col-md-6"><strong>CEP:</strong><br/>
					 					  <input type="text" class="form-control" id="CEP" name="CEP" placeholder="CEP">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Endereço *:</strong><br/>
					  <input type="text" class="form-control" id="Endereco" name="Endereco" placeholder="Endereço">
					</div>
				  </div>
                  				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Número *:</strong><br/>
					  <input type="text" class="form-control" id="Numero" name="Numero" placeholder="Numero">
					</div>				  
					<div class=" col-md-6"><strong>Bairro:</strong><br/>
					  <input type="text" class="form-control" id="Bairro" name="Bairro" placeholder="Bairro">
					</div>
				  </div>
                  	 <div class="form-group">
                     
					<div class="col-md-offset-2 col-md-8"><strong>Complemento *:</strong><br/>
					    <input type="text" class="form-control" id="Complemento" name="Complemento" placeholder="Complemento">
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
					<input type="text" class="form-control" id="Email" name="Email" placeholder="E-mail" >
					</div>				  


					<div class=" col-md-6"><strong>Telefone #1 *:</strong><br/>

					  <input type="text" class="form-control" id="Telefone1" name="Telefone1" placeholder="Telefone" >
					</div>

				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone #2:</strong><br/>
					  <input type="text" class="form-control" id="Telefone1" name="Telefone2" placeholder="Telefone" >
					</div>				  
					<div class="col-md-6"><strong>Telefone #3:</strong><br/>
					  <input type="text" class="form-control" id="Telefone2" name="Telefone3" placeholder="Telefone" >
					</div>
				  </div>

							  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>DRT:</strong><br/>
					  <input type="text" class="form-control" id="DRT" name="DRT" placeholder="DRT" >
					</div>				  
					<div class=" col-md-6"><strong>Função:</strong><br/>
					  <input type="text" class="form-control" id="Funcao" name="Funcao" placeholder="Função">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Inscrição do INSS ou PIS/PASEP:</strong><br/>
					  <input type="text" class="form-control" id="InscricaoINSS" name="InscricaoINSS" placeholder="Inscrição no INSS ou PIS/PASEP" >
					</div>				  
					<div class=" col-md-6"><strong>OMB:</strong><br/>
					  <input type="text" class="form-control" id="OMB" name="OMB" placeholder="OMB" >
					</div>
				  </div>
				  
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					 <textarea name="Observacao" class="form-control" rows="10" placeholder=""></textarea>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="cadastrarFisica" value="1" />
                    <input type="hidden" name="Sucesso" id="Sucesso" />
					 <input type="image" alt="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
	
    
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

  

<?php	} 
	

}else{ // Se não existe pedido de busca, exibe campo de pesquisa.
?>    
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados - Pessoa Física</h2>
                    <p>Você está inserindo pessoas físicas para serem contratadas para o evento <strong><?php  echo $nomeEvento['nomeEvento']; ?></strong></p>

<p></p>

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            
                        <form method="POST" action="?perfil=contratados&p=fisica" class="form-horizontal" role="form">
            		<label>Insira o CPF</label>
            		<input type="text" name="busca" class="form-control" id="cpf" >
            	</div>
             </div>
				<br />             
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
                	<input type="hidden" name="pesquisar" value="1" />
    		        <input type="submit" class="btn btn-theme btn-lg btn-block" value="Pesquisar">
                    </form>
        	    	</div>
        	    </div>

            </div>
	</section>
<?php } ?>

<?php break;
case 'representante':
 ?>
    <?php
if(isset($_POST['pesquisar'])){ // inicia a busca por Razao Social ou CNPJ
	$busca = $_POST['busca'];
	$sql_busca = "SELECT * FROM sis_representante_legal WHERE RepresentanteLegal LIKE '%$busca%' OR CPF LIKE '%$busca%' ORDER BY RepresentanteLegal";
	$query_busca = mysql_query($sql_busca); 
	$num_busca = mysql_num_rows($query_busca);
	if($num_busca > 0){ // Se exisitr, lista a resposta.
	?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Contratados - Pesso Jurídica - Representantes Legais</h3>
                    <p>Você está inserindo representantes legais de pessoas jurídicas para serem contratadas para o evento <strong><?php echo $nomeEvento['nomeEvento']; ?></strong></p>

<p></p>

					</div>
				  </div>
			  </div>
              	<section id="list_items" class="home-section bg-white">
		<div class="container">
<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Nome</td>
							<td>CPF</td>
							<td width="20%"></td>
  							<td width="20%"></td>
						</tr>
					</thead>
					<tbody>
                    <?php
				while($descricao = mysql_fetch_array($query_busca)){			
			echo "<tr>";
			echo "<td class='list_description'><b>".$descricao['RepresentanteLegal']."</b></td>";
			echo "<td class='list_description'>".$descricao['CPF']."</td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=$k'>
			<input type ='submit' class='btn btn-theme btn-md btn-block' value='detalhe'></td></form>"	;
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=$k'>
			<input type ='submit' class='btn btn-theme btn-md btn-block' value='inserir'></td></form>"	;

			echo "</tr>";
				}
?>
						
					</tbody>
				</table>
			</div>
            		</div>
	</section>
	
    <?php }else{ // Se não existe, exibe um formulario para insercao. ?>
	 <!-- Contact -->

	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
              <p>O sistema não encontrou informações sobre representantes legais com referência a "<?php echo $busca ?>".<br />Insira um novo representante legal ou <a href="?perfil=contratados&p=representante">faça uma nova busca</a>. </p>
					<h3>CADASTRO DE REPRESENTANTE LEGAL</h3>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=contratados&p=lista" method="post">
				  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="RepresentanteLegal" name="RepresentanteLegal" placeholder="Representante Legal">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6">
					  <input type="text" class="form-control" id="RG" name="RG" placeholder="RG">
					</div>
					<div class="col-md-6">
					  <input type="text" class="form-control" id="cpf" name="CPF" placeholder="CPF">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6">
					  <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" placeholder="Nacionalidade">
					</div>
					<div class="col-md-6">
					  <select class="form-control" name="IdEstadoCivil" id="IdEstadoCivil"><option>Estado Civil</option>
                      <?php
					  $consulta_tabela_estado_civil = mysql_query("SELECT * FROM sis_estado_civil");
						$linha_tabela_estado_civil= mysql_fetch_assoc($consulta_tabela_estado_civil);
					  do
					  {
					  echo "<option value='$linha_tabela_estado_civil[Id_EstadoCivil]'>$linha_tabela_estado_civil[EstadoCivil]</option>";
					  }
					  while ($linha_tabela_estado_civil = mysql_fetch_assoc($consulta_tabela_estado_civil))
					  ?>  
                      </select>
					</div>
				  </div>
                  
                  <!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="cadastrarRepresentante" value="1" />
					 <input type="image" name="enviar" alt="CADASTRAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
                    
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  
  

<?php	} 
	

}else{ // Se não existe pedido de busca, exibe campo de pesquisa.
?>    
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados - Pessoa Jurídica - Representantes</h2>
                    <p>Você está inserindo representantes de pessoas jurídicas para serem contratadas para o evento <strong><?php  echo $nomeEvento['nomeEvento']; ?></strong></p>

<p</p>

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            
                        <form method="POST" action="?perfil=contratados&p=representante" class="form-horizontal" role="form">
            		<label>Insira o CNPJ ou a Razão social</label>
            		<input type="text" name="busca" class="form-control" id="" >
            	</div>
             </div>
				<br />             
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
                	<input type="hidden" name="pesquisar" value="1" />
    		        <input type="submit" class="btn btn-theme btn-lg btn-block" value="Pesquisar">
                    </form>
        	    	</div>
        	    </div>

            </div>
	</section>
<?php } ?>

<?php 
break;
case "edicaoPedido":

	$idPedido = $_POST['idPedidoContratacao'];
echo "<h1>$idPedido</h1>";

if(isset($_POST['atualizar'])){
	
	$Valor = dinheiroDeBr($_POST['Valor']);	
	$ValorIndividual = dinheiroDeBr($_POST['ValorIndividual']);
	$FormaPagamento = $_POST['FormaPagamento'];
	$Observacao = $_POST['Observacao'];
	$Verba = $_POST['verba'];
	$idPedidoContratacao = $_POST['idPedidoContratacao'];
	$sql_atualizar_pedido = "UPDATE  `igsis_pedido_contratacao` SET  `valor` =  '$Valor',
`formaPagamento` =  '$FormaPagamento',
`observacao` =  '$Observacao',
`idVerba` =  '$Verba',
`valorIndividual` =  '$ValorIndividual' WHERE  `igsis_pedido_contratacao`.`idPedidoContratacao` = '$idPedidoContratacao';
";
	$query_atualizar_pedido = mysqli_query($con,$sql_atualizar_pedido);
	if($query_atualizar_pedido){
		gravarLog($sql_atualizar_pedido);
		$mensagem = "Atualizado com sucesso";	
	}
	
}

$pedido = recuperaDados("igsis_pedido_contratacao",$idPedido,"idPedidoContratacao");

?>
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">PEDIDO DE CONTRTAÇÃO DE PESSOA FÍSICA</div>
                    <p><?php if(isset($mensagem)){echo $mensagem;} ?></p>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=contratados&p=edicaoPedido" method="post">
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <p class="left">
                    	<?php $evento = recuperaEvento($_SESSION['idEvento']); ?>
						<strong>Setor:</strong> <?php echo $_SESSION['instituicao']; ?> - 
						<strong>Categoria de contratação:</strong> <?php recuperaModalidade($evento['ig_modalidade_IdModalidade']); ?> <br />
						<strong>Proponente:</strong>  <?php echo $_SESSION['nomeCompleto']; ?> <br />
						<strong>Objeto:</strong> <?php echo retornaTipo($evento['ig_tipo_evento_idTipoEvento']) ?> -  <?php echo $evento['nomeEvento']; ?> <br />
						<strong>Local:</strong> <br />
                        
						<strong>Período:</strong><br /> 
                        <?php 
						$fiscal = recuperaUsuario($evento['idResponsavel']);
						$suplente = recuperaUsuario($evento['suplente']);
						 ?>
						<strong>Fiscal:</strong>  <?php echo $fiscal['nomeCompleto']; ?> - <strong>Suplente:</strong>  <?php echo $suplente['nomeCompleto']; ?> 

                    </p>
					</div>
                  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Valor:</strong><br/>
					  <input type='text' name="Valor" id="valor" class='form-control' value="<?php echo dinheiroParaBr($pedido['valor']) ?>" >
					</div>					
                    
                    <div class="col-md-6"><strong>Valor Individual:</strong><br/>
					  <input type='text' name="ValorIndividual" id="valor" class='form-control' value="<?php echo dinheiroParaBr($pedido['valorIndividual']) ?>">
					</div>

				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Forma de Pagamento:</strong><br/>
                      <textarea name="FormaPagamento" class="form-control" cols="40" rows="5"><?php echo $pedido['formaPagamento'] ?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Verba:</strong><br/>
					  	 <select class="form-control" id="verba" name="verba" >
					   <?php
						geraOpcao("sis_verba",$pedido['idVerba'],"");
						?>  
					  </select>
					</div>		

				  </div>
 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					   <textarea name="Observacao" class='form-control' cols="40" rows="5"><?php echo $pedido['observacao'] ?></textarea>
					</div>
				  </div>
                  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="atualizar" value="1" />
                    <input type="hidden" name="idPedidoContratacao" value="<?php echo $idPedido; ?>" />
					 <input type="image" alt="GRAVAR" name="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
                    
				  </div>
				</form>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <a href="?perfil=contratados" value="VOLTAR" class="btn btn-theme btn-lg btn-block">VOLTAR para area de pedidos de contratação</a>
					</div>
                    
				  </div>	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  
<?php 
break;
case "apagarPedido":

?>

<?php 
break;
case "edicaoPessoa":

	if(isset($_POST['cadastrarFisica'])){
		$idPessoaFisica = $_POST['cadastrarFisica'];
		$Nome = $_POST['Nome'];
		$NomeArtistico = $_POST['NomeArtistico'];
		$RG = $_POST['RG'];
		$CPF = $_POST['CPF'];
		$CCM = $_POST['CCM'];
		$IdEstadoCivil = $_POST['IdEstadoCivil'];
		$DataNascimento = exibirDataMysql($_POST['DataNascimento']);
		$Nacionalidade = $_POST['Nacionalidade'];
		$CEP = $_POST['CEP'];
		//$Endereco = $_POST['Endereco'];
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
		$tipoDocumento = $_POST['tipoDocumento'];
		$Pis = 0;
		$data = date('Y-m-d');
		$idUsuario = $_SESSION['idUsuario'];
		
		$sql_atualizar_pessoa = "UPDATE sis_pessoa_fisica SET
		`Nome` = '$Nome',
		`NomeArtistico` = '$NomeArtistico',
		`RG` = '$RG', 
		`CPF` = '$CPF', 
		`CCM` = '$CCM', 
		`IdEstadoCivil` = '$IdEstadoCivil' , 
		`DataNascimento` = '$DataNascimento', 
		`Nacionalidade` = '$Nacionalidade', 
		`CEP` = '$CEP', 
		`Numero` = '$Numero', 
		`Complemento` = '$Complemento', 
		`Telefone1` = '$Telefone1', 
		`Telefone2` = '$Telefone2',  
		`Telefone3` = '$Telefone3', 
		`Email` = '$Email', 
		`DRT` = '$DRT', 
		`Funcao` = '$Funcao', 
		`InscricaoINSS` = '$InscricaoINSS', 
		`Pis` = '$Pis', 
		`OMB` = '$OMB', 
		`DataAtualizacao` = '$data', 
		`Observacao` = '$Observacao', 
		`IdUsuario` = '$idUsuario', 
		`tipoDocumento` = '$tipoDocumento' 
		WHERE `Id_PessoaFisica` = '$idPessoaFisica'";	
		
		if(mysqli_query($con,$sql_atualizar_pessoa)){
			$mensagem = "Atualizado com sucesso!";	
		}else{
			$mensagem = "Erro ao atualizar! Tente novamente.";
		}
		
	}

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
		$IdRepresentanteLegal1 = $_POST['IdRepresentanteLegal1'];
		$IdRepresentanteLegal2 = $_POST['IdRepresentanteLegal2'];
		$Observacao = $_POST['Observacao'];
		$data = date("Y-m-d");
		$idUsuario = $_SESSION['idUsuario'];
		
		$sql_atualizar_juridica = "UPDATE `sis_pessoa_juridica` SET `RazaoSocial` = '$RazaoSocial', `CNPJ` = '$CNPJ', `CCM` = '$CCM', `CEP` = '$CEP', `Numero` = '$Numero', `Complemento` = '$Complemento', `Telefone1` = '$Telefone1', `Telefone2` = '$Telefone2', `Telefone3` = '$Telefone3', `Email` = '$Email', `IdRepresentanteLegal1` = '$IdRepresentanteLegal1', `IdRepresentanteLegal2` = '$IdRepresentanteLegal2', `DataAtualizacao` = '$data', `Observacao` = '$Observacao' WHERE `sis_pessoa_juridica`.`Id_PessoaJuridica` = '$idJuridica';";
				if(mysqli_query($con,$sql_atualizar_juridica)){
			$mensagem = "Atualizado com sucesso!";	
		}else{
			$mensagem = "Erro ao atualizar! Tente novamente.";
		}
		
		
		
		}


	$idPedidoContratacao = $_POST['idPedidoContratacao'];
	$pedido = recuperaDados("igsis_pedido_contratacao",$idPedidoContratacao,"idPedidoContratacao");

	switch($pedido['tipoPessoa']){
	
	case 1:
	$fisica = recuperaDados("sis_pessoa_fisica",$pedido['idPessoa'],"Id_PessoaFisica");
	 ?>
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<h3>CADASTRO DE PESSOA FÍSICA</h3>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                                        </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=contratados&p=edicaoPessoa" method="post">
				  
			 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Nome *:</strong><br/>
					  <input type="text" class="form-control" id="Nome" name="Nome" placeholder="Nome" value="<?php echo $fisica['Nome']; ?>" >
					</div>
				  </div>

                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Nome Artístico:</strong><br/>
					  <input type="text" class="form-control" id="NomeArtistico" name="NomeArtistico" placeholder="Nome Artístico" value="<?php echo $fisica['NomeArtistico']; ?>">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Tipo de documento *:</strong><br/>
					  <select class="form-control" id="tipoDocumento" name="tipoDocumento" >
					   <?php
						geraOpcao("igsis_tipo_documento",$fisica['tipoDocumento'],"");
						?>  
					  </select>

					</div>				  
					<div class=" col-md-6"><strong>Documento *:</strong><br/>
                      <input type="text" class="form-control" id="RG" name="RG" placeholder="Documento" value="<?php echo $fisica['RG']; ?>">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>CPF *:</strong><br/>
					  <input type="text" class="form-control" id="cpf" name="CPF" placeholder="CPF" value="<?php echo $fisica['CPF']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>CCM *:</strong><br/>
					  <input type="text" class="form-control" id="CCM" name="CCM" placeholder="CCM" value="<?php echo $fisica['CCM']; ?>" >
					</div>
				  </div>

				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Estado civil:</strong><br/>
					  <select class="form-control" id="IdEstadoCivil" name="IdEstadoCivil" >
					   <?php
						geraOpcao("sis_estado_civil","","");
						?>  
					  </select>
					</div>				  
					<div class=" col-md-6"><strong>Data de nascimento:</strong><br/>
 <input type="text" class="form-control" id="datepicker01" name="DataNascimento" placeholder="Data de Nascimento" value="<?php echo exibirDataBr($fisica['DataNascimento']); ?>">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Nacionalidade:</strong><br/>
					   <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" placeholder="Nacionalidade" value="<?php echo $fisica['Nacionalidade']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>CEP:</strong><br/>
					 					  <input type="text" class="form-control" id="CEP" name="CEP" placeholder="CEP" value="<?php echo $fisica['CEP']; ?>">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Endereço *:</strong><br/>
					  <input type="text" class="form-control" id="Endereco" name="Endereco" placeholder="Endereço">
					</div>
				  </div>
                  				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Número *:</strong><br/>
					  <input type="text" class="form-control" id="Numero" name="Numero" placeholder="Numero" value="<?php echo $fisica['Numero']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>Bairro:</strong><br/>
					  <input type="text" class="form-control" id="Bairro" name="Bairro" placeholder="Bairro">
					</div>
				  </div>
                  	 <div class="form-group">
                     
					<div class="col-md-offset-2 col-md-8"><strong>Complemento *:</strong><br/>
					    <input type="text" class="form-control" id="Complemento" name="Complemento" placeholder="Complemento" value="<?php echo $fisica['Complemento']; ?>">
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
					<input type="text" class="form-control" id="Email" name="Email" placeholder="E-mail" value="<?php echo $fisica['Email']; ?>" >
					</div>				  


					<div class=" col-md-6"><strong>Telefone #1 *:</strong><br/>

					  <input type="text" class="form-control" id="Telefone1" name="Telefone1" placeholder="Telefone" value="<?php echo $fisica['Telefone1']; ?>">
					</div>

				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone #2:</strong><br/>
					  <input type="text" class="form-control" id="Telefone1" name="Telefone2" placeholder="Telefone" value="<?php echo $fisica['Telefone2']; ?>">
					</div>				  
					<div class="col-md-6"><strong>Telefone #3:</strong><br/>
					  <input type="text" class="form-control" id="Telefone2" name="Telefone3" placeholder="Telefone"value="<?php echo $fisica['Telefone3']; ?>" >
					</div>
				  </div>

							  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>DRT:</strong><br/>
					  <input type="text" class="form-control" id="DRT" name="DRT" placeholder="DRT" value="<?php echo $fisica['DRT']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>Função:</strong><br/>
					  <input type="text" class="form-control" id="Funcao" name="Funcao" placeholder="Função" value="<?php echo $fisica['Funcao']; ?>">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Inscrição do INSS ou PIS/PASEP:</strong><br/>
					  <input type="text" class="form-control" id="InscricaoINSS" name="InscricaoINSS" placeholder="Inscrição no INSS ou PIS/PASEP" value="<?php echo $fisica['InscricaoINSS']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>OMB:</strong><br/>
					  <input type="text" class="form-control" id="OMB" name="OMB" placeholder="OMB" value="<?php echo $fisica['OMB']; ?>">
					</div>
				  </div>
				  
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					 <textarea name="Observacao" class="form-control" rows="10" placeholder=""></textarea>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="cadastrarFisica" value="<?php echo $fisica['Id_PessoaFisica'] ?>" />
                   <input type="hidden" name="idPedidoContratacao" value="<?php echo $_POST['idPedidoContratacao'] ?>" />
                    <input type="hidden" name="Sucesso" id="Sucesso" />
					 <input type="image" alt="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
	
    
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

	<?php
	break;
	case 2: 


	$juridica = recuperaDados("sis_pessoa_juridica",$pedido['idPessoa'],"Id_PessoaJuridica");
	?>
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">CADASTRO DE PESSOA JURÍDICA</div>
                                        <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=contratados&p=edicaoPessoa" method="post">
				  
			  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Razão Social:</strong><br/>
					  <input type="text" class="form-control" id="RazaoSocial" name="RazaoSocial" placeholder="RazaoSocial" value="<?php echo $juridica['RazaoSocial']; ?>">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>CNPJ:</strong><br/>
					  <input type="text" class="form-control" id="CNPJ" name="CNPJ" placeholder="CNPJ" value="<?php echo $juridica['CNPJ']; ?>" >
					</div>
					<div class="col-md-6"><strong>CCM:</strong><br/>
					  <input type="text" class="form-control" id="CCM" name="CCM" placeholder="CCM" value="<?php echo $juridica['CCM']; ?>">
					</div>
				  </div>
				  
				  <div class="form-group">
                  					<div class="col-md-offset-2 col-md-6"><strong>CEP *:</strong><br/>
					  <input type="text" class="form-control" id="CEP" name="CEP" placeholder="CEP" value="<?php echo $juridica['CEP']; ?>">
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
					  <input type="text" class="form-control" id="Numero" name="Numero" placeholder="Numero" value="<?php echo $juridica['Numero']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>Complemento:</strong><br/>
					  <input type="text" class="form-control" id="Complemento" name="Complemento" placeholder="Complemento" value="<?php echo $juridica['Complemento']; ?>">
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
					  <input type="text" class="form-control" id="Telefone1" name="Telefone1" placeholder="Telefone" value="<?php echo $juridica['Telefone1']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone2" name="Telefone2" placeholder="Telefone" value="<?php echo $juridica['Telefone2']; ?>" >
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone3" name="Telefone3" placeholder="Telefone" value="<?php echo $juridica['Telefone3']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>E-mail:</strong><br/>
					  <input type="text" class="form-control" id="Email" name="Email" placeholder="E-mail">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Representante Legal #1:</strong><br/>
					  <select class="form-control" id="IdRepresentanteLegal1" name="IdRepresentanteLegal1" >
					<?php geraOpcaoLegal($_SESSION['idEvento']); ?>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Representante Legal #2:</strong><br/>
					  <select class="form-control" id="IdRepresentanteLegal2" name="IdRepresentanteLegal2">
					<?php geraOpcaoLegal($_SESSION['idEvento']); ?>
					  </select>
					</div>
				  </div>
		  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observações:</strong><br/>
					 <textarea name="Observacao" class="form-control" rows="10" placeholder=""><?php echo $juridica['Observacao']; ?></textarea>
					</div>
				  </div>
				  
				  
				<!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                     <input type="hidden" name="editaJuridica" value="<?php echo $juridica['Id_PessoaJuridica'] ?>" />
                     <input type="hidden" name="idPedidoContratacao" value="<?php echo $_POST['idPedidoContratacao'] ?>" />
					 <input type="image" alt="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

	<?php
	break;
	case 3: ?>
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
            
					<h3>CADASTRO DE REPRESENTANTE LEGAL</h3>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=contratados&p=edicaoPessoa" method="post">
				  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="RepresentanteLegal" name="RepresentanteLegal" placeholder="Representante Legal">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6">
					  <input type="text" class="form-control" id="RG" name="RG" placeholder="RG">
					</div>
					<div class="col-md-6">
					  <input type="text" class="form-control" id="cpf" name="CPF" placeholder="CPF">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6">
					  <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" placeholder="Nacionalidade">
					</div>
					<div class="col-md-6">
					  <select class="form-control" name="IdEstadoCivil" id="IdEstadoCivil"><option>Estado Civil</option>
                      <?php
					  $consulta_tabela_estado_civil = mysql_query("SELECT * FROM sis_estado_civil");
						$linha_tabela_estado_civil= mysql_fetch_assoc($consulta_tabela_estado_civil);
					  do
					  {
					  echo "<option value='$linha_tabela_estado_civil[Id_EstadoCivil]'>$linha_tabela_estado_civil[EstadoCivil]</option>";
					  }
					  while ($linha_tabela_estado_civil = mysql_fetch_assoc($consulta_tabela_estado_civil))
					  ?>  
                      </select>
					</div>
				  </div>
                  
                  <!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="cadastrarRepresentante" value="1" />
					 <input type="image" name="enviar" alt="CADASTRAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
                    
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

    
    
    <?php
	break;
	}

?>




<?php
break;
case "arquivos":
if(isset($_POST["enviar"])){
$idPessoa = $_POST['idPessoa'];
$tipoPessoa = $_POST['tipoPessoa'];
$sql_arquivos = "SELECT * FROM igsis_upload_docs";
$query_arquivos = mysqli_query($con,$sql_arquivos);
while($arq = mysqli_fetch_array($query_arquivos)){ 
	$y = $arq['idTipoDoc'];
	$x = $arq['sigla'];
	$nome_arquivo = $_FILES['arquivo']['name'][$x];
	if($nome_arquivo != ""){
	$nome_temporario = $_FILES['arquivo']['tmp_name'][$x];
    //$ext = strtolower(substr($nome_arquivo[$i],-4)); //Pegando extensão do arquivo
      $new_name = date("YmdHis")."_". $nome_arquivo; //Definindo um novo nome para o arquivo
	  $hoje = date("Y-m-d H:i:s");
      $dir = '../uploadsdocs/'; //Diretório para uploads
	  
      if(move_uploaded_file($nome_temporario, $dir.$new_name)){
		  
		$sql_insere_arquivo = "INSERT INTO `igsis_arquivos_pessoa` (`idArquivosPessoa`, `idTipoPessoa`, `idPessoa`, `arquivo`, `dataEnvio`, `publicado`, `tipo`) 
		VALUES (NULL, '$tipoPessoa', '$idPessoa', '$new_name', '$hoje', '1', '$y'); ";
		$query = mysqli_query($con,$sql_insere_arquivo);
		if($query){
		$mensagem = "Arquivo recebido com sucesso";
		}else{
		$mensagem = "Erro ao gravar no banco";
		}
		
		}else{
		 $mensagem = "Erro no upload"; 
		  
	  }
	}
	
}

}


if(isset($_POST['apagar'])){
	$idArquivo = $_POST['apagar'];
	$sql_apagar_arquivo = "UPDATE igsis_arquivos_pessoa SET publicado = 0 WHERE idArquivosPessoa = '$idArquivo'";
	if(mysqli_query($con,$sql_apagar_arquivo)){
		$arq = recuperaDados("igsis_arquivos_pessoa",$idArquivo,"idArquivosPessoa");
		$mensagem =	"Arquivo ".$arq['arquivo']."apagado com sucesso!";
		gravarLog($sql_apagar_arquivo);
	}else{
		$mensagem = "Erro ao apagar o arquivo. Tente novamente!";
	}
}
$campo = recuperaPessoa($_POST['idPessoa'],$_POST['tipoPessoa']); 
?>
    
    	 <section id="enviar" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
                                        <h2><?php echo $campo["nome"] ?>  </h2>
                                        <p><?php echo $campo["tipo"] ?></p>
					 <h3>Envio de Arquivos</h3>
                     <p><?php if(isset($mensagem)){echo $mensagem;} ?></p>
<p>Nesta página, você envia documentos digitalizados. O tamanho máximo do arquivo deve ser 60MB.</p>


<br />
<div class = "center">
<form method='POST' action="?perfil=contratados&p=arquivos" enctype='multipart/form-data'>
<table>
<tr>
<td width="50%"><td>
</tr>
<?php 
$sql_arquivos = "SELECT * FROM igsis_upload_docs";
$query_arquivos = mysqli_query($con,$sql_arquivos);
while($arq = mysqli_fetch_array($query_arquivos)){ ?>

<tr>
<td><label><?php echo $arq['documento']?></label></td><td><input type='file' name='arquivo[<?php echo $arq['sigla']; ?>]'></td>
</tr>
	
<?php } ?>

  </table>
    <br>
    <input type="hidden" name="idPessoa" value="<?php echo $_POST['idPessoa']; ?>"  />
    <input type="hidden" name="tipoPessoa" value="<?php echo $_POST['tipoPessoa']; ?>"  />
    <input type="hidden" name="enviar" value="1"  />
    <input type="submit" class="btn btn-theme btn-lg btn-block" value='Enviar'>
</form>
</div>


					</div>
				  </div>
                  
			  </div>
			  
		</div>
	</section>

	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
 <h2>Arquivos anexados</h2>
<h5>Se na lista abaixo, o seu arquivo começar com "http://", por favor, clique, grave em seu computador, faça o upload novamente e apague a ocorrência citada.</h5>
					</div>
			<div class="table-responsive list_info">
                         <?php listaArquivosPessoa($_POST['idPessoa'],$_POST['tipoPessoa']); ?>
			</div>
				  </div>
			  </div>  


		</div>
	</section>


<?php
break;

} //fim da switch ?>