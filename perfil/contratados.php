<?php
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
								<a href="?perfil=inicio"><< Voltar evento</a>
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
		$DataNascimento = $_POST['DataNascimento'];
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
		$data = date('Y-m-d');
		$sql_insert_pf = "INSERT INTO `igsis`.`sis_pessoa_fisica` (`Id_PessoaFisica`, `Foto`, `Nome`, `NomeArtistico`, `RG`, `CPF`, `CCM`, `IdEstadoCivil`, `DataNascimento`, `LocalNascimento`, `Nacionalidade`, `IdEndereco`, `Numero`, `Complemento`, `Telefone1`, `Telefone2`, `Telefone3`, `Email`, `DRT`, `Funcao`, `InscricaoINSS`, `Pis`, `OMB`, `DataAtualizacao`, `Observacao`, `IdUsuario`) VALUES (NULL, NULL, '$Nome', '$NomeArtistico', $RG, '$CPF', '$CCM', '$IdEstadoCivil', '$DataNascimento','' , '$Nacionalidade', '$Endereco', '$Numero', '$Complemento', '$Telefone1', '$Telefone2','$Telefone3','$Email', '$DRT', '$Funcao','$InscricaoINSS', NULL, '$OMB', '$data', '$observacao', '')";
		$query_insert_pf = mysql_query($sql_insert_pf);
			//Verifica erro na string
	$mysqli = new mysqli("localhost", "root", "lic54eca","igsis");
	if (!$mysqli->query($sql_insert_pf)) {
    printf("Errormessage: %s\n", $mysqli->error);
	}
		if($query_insert_pf){
			echo "<h1>Inserido com sucesso!</h1>";
		}else{
			echo "<h1>Erro ao inserir!</h1>";
		}
	}
}
	

if(isset($_POST['insereFisica'])){ //insere pessoa física
	
}
if(isset($_POST['cadastrarJurídica'])){ //cadastra e insere pessoa jurídica
	
}
if(isset($_POST['insereJurídica'])){ //insere pessoa jurídica
	
}


?>	
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados</h2>
                     <p>Você está inserindo pessoas físicas ou jurídicas para serem contratadas para o evento <strong><?  echo $nomeEvento['nomeEvento']; ?></strong></p>
                     <p>Para inserir pessoas jurídicas, é necessário antes inserir seus <a href="?perfil=contratados&p=representante">representantes</a>.</p>
                     <p><? if(isset($mensagem)){ echo $mensagem; } ?></p>
<p><?php print_r($_SESSION); ?></p>

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

							<td width="20%"></td>
						</tr>
					</thead>
					<tbody>
                    <?php
					$idEvento = $_SESSION['idEvento'];
					$sql_busca = "SELECT * FROM igsis_pedido_contratacao WHERE idEvento = '$idEvento'";
					$query_busca = mysql_query($sql_busca);
					while($descricao = mysql_fetch_array($query_busca)){
						$recuperaPessoa = recuperaPessoa($descricao['idPessoaFisica'],$descricao['tipoPessoa']);
						echo "<tr>";
						echo "<td class='list_description'><b>".$recuperaPessoa['nome']."</b></td>";
						echo "<td class='list_description'>".$recuperaPessoa['tipo']."</td>";
						echo "<td class='list_description'>".$recuperaPessoa['numero']."</td>";
						echo "
						<td class='list_description'>
						<form method='POST' action='?perfil='>
						<input type ='submit' class='btn btn-theme btn-lg btn-block' value='carregar'></td></form>"	;
						echo "</tr>";
					}
?>
						
					</tbody>
				</table>
			</div>
		</div>
        </div>
	</section>
<? break;
case 'juridica':

 ?>    
<?php
if(isset($_POST['pesquisar'])){ // inicia a busca por Razao Social ou CNPJ
	$busca = $_POST['busca'];
	$sql_busca = "SELECT * FROM sis_pessoa_juridica WHERE RazaoSocial LIKE '%$busca%' OR CNPJ LIKE '%$busca%' ORDER BY RazaoSocial";
	$query_busca = mysql_query($sql_busca); 
	$num_busca = mysql_num_rows($query_busca);
	if($num_busca > 0){ // Se exisitr, lista a resposta.
	?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados - Pesso Jurídica</h2>
                                          <p>Você está inserindo pessoas jurídicas para serem contratadas para o evento <strong><? echo $nomeEvento['nomeEvento']; ?></strong></p>

<p><?php print_r($_SESSION); ?></p>

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
							<td width="20%"></td>
						</tr>
					</thead>
					<tbody>
                    <?php
				while($descricao = mysql_fetch_array($query_busca)){			
			echo "<tr>";
			echo "<td class='list_description'><b>".$descricao['RazaoSocial']."</b></td>";
			echo "<td class='list_description'>".$descricao['CNPJ']."</td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=$k'>
			<input type ='submit' class='btn btn-theme btn-lg btn-block' value='carregar'></td></form>"	;
			echo "</tr>";
				}
?>
						
					</tbody>
				</table>
			</div>
            		</div>
	</section>
	
    <? }else{ // Se não existe, exibe um formulario para insercao. ?>
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">CADASTRO DE PESSOA JURÍDICA</div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=contratados" method="post">
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Id:</strong><br/>
					  <input type="text" class="form-control" id="Id_PessoaJuridica"  name="Id_PessoaJuridica">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Razão Social:</strong><br/>
					  <input type="text" class="form-control" id="RazaoSocial" name="RazaoSocial" placeholder="RazaoSocial" <?php echo "value='$linha_tabelas[RazaoSocial]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>CNPJ:</strong><br/>
					  <input type="text" class="form-control" id="CNPJ" name="CNPJ" placeholder="CNPJ" <?php echo "value='$linha_tabelas[CNPJ]'";?>>
					</div>
					<div class="col-md-6"><strong>CCM:</strong><br/>
					  <input type="text" class="form-control" id="CCM" name="CCM" placeholder="CCM" <?php echo "value='$linha_tabelas[CCM]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>CEP:</strong><br/>
					  <input type="text" class="form-control" id="IdEndereco" name="IdEndereco" placeholder="CEP">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Endereço:</strong><br/>
					  <input type="text" class="form-control" id="" name="" placeholder="Endereço">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Número:</strong><br/>
					  <input type="text" class="form-control" id="Numero" name="Numero" placeholder="Numero" <?php echo "value='$linha_tabelas[Numero]'";?>>
					</div>
					<div class="col-md-6"><strong>Complemento:</strong><br/>
					  <input type="text" class="form-control" id="Complemento" name="Complemento" placeholder="Complemento" <?php echo "value='$linha_tabelas[Complemento]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone1" name="Telefone1" placeholder="Telefone" <?php echo "value='$linha_tabelas[Telefone1]'";?>>
					</div>				  
					<div class=" col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone2" name="Telefone2" placeholder="Telefone" <?php echo "value='$linha_tabelas[Telefone2]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone3" name="Telefone3" placeholder="Telefone" <?php echo "value='$linha_tabelas[Telefone3]'";?>>
					</div>				  
					<div class=" col-md-6"><strong>E-mail:</strong><br/>
					  <input type="text" class="form-control" id="Email" name="Email" placeholder="E-mail" <?php echo "value='$linha_tabelas[Email]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Representante Legal:</strong><br/>
					  <select class="form-control" id="IdRepresentanteLegal1" name="IdRepresentanteLegal1" <?php echo "value='$linha_tabelas[IdRepresentanteLegal1]'";?> ><option>Selecione</option>
					  <?php
					  do
					  {
					  echo "<option value='$linha_tabela_representante_legal[Id_RepresentanteLegal]'>$linha_tabela_representante_legal[RepresentanteLegal]</option>";
					  }
					  while ($linha_tabela_representante_legal = mysqli_fetch_assoc($consulta_tabela_representante_legal))
					  ?> 
					  </select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Representante Legal:</strong><br/>
					  <select class="form-control" id="IdRepresentanteLegal2" name="IdRepresentanteLegal2" ><option>Selecione</option>
					  <?php
					  do
					  {
					  echo "<option value='$linha_tabela_representante_legal[Id_RepresentanteLegal]'>$linha_tabela_representante_legal[RepresentanteLegal]</option>";
					  }
					  while ($linha_tabela_representante_legal = mysqli_fetch_assoc($consulta_tabela_representante_legal))
					  ?> 
					  </select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Data da Atualização do Cadastro:</strong><br/>
					  <input type="text" class="form-control" id="DataAtualizacao" name="DataAtualizacao" placeholder="Data da Atualização do Cadastro" <?php echo "value='$linha_tabelas[DataAtualizacao]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observações:</strong><br/>
					  <input type="text" class="form-control" id="Observacao" name="Observacao" placeholder="Observações" <?php echo "value='$linha_tabelas[Observacao]'";?>>
					</div>
				  </div>
				  
				  
				<!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <input type="image" alt="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

  

<?	} 
	

}else{ // Se não existe pedido de busca, exibe campo de pesquisa.
?>    
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados - Pessoa Jurídica</h2>
                    <p>Você está inserindo pessoas físicas para serem contratadas para o evento <strong><?  echo $nomeEvento['nomeEvento']; ?></strong></p>

<p><?php print_r($_SESSION); ?></p>

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            
                        <form method="POST" action="?perfil=contratados&p=juridica" class="form-horizontal" role="form">
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
<? 

break;
case 'fisica':
 ?>    
<?php
if(isset($_POST['pesquisar'])){ // inicia a busca por Razao Social ou CNPJ
	$busca = $_POST['busca'];
	$sql_busca = "SELECT * FROM sis_pessoa_fisica WHERE Nome LIKE '%$busca%' OR CPF NomeArtistico '%$busca%' OR CPF LIKE '%$busca%' ORDER BY Nome";
	$query_busca = mysql_query($sql_busca); 
	$num_busca = mysql_num_rows($query_busca);
	if($num_busca > 0){ // Se exisitr, lista a resposta.
	?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados - Pessoa Física</h2>
                                          <p>Você está inserindo pessoas jurídicas para serem contratadas para o evento <strong><? echo $nomeEvento['nomeEvento']; ?></strong></p>

<p><?php print_r($_SESSION); ?></p>

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
						</tr>
					</thead>
					<tbody>
                    <?php
				while($descricao = mysql_fetch_array($query_busca)){			
			echo "<tr>";
			echo "<td class='list_description'><b>".$descricao['Nome']."</b></td>";
			echo "<td class='list_description'>".$descricao['CPF']."</td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=$k'>
			<input type ='submit' class='btn btn-theme btn-lg btn-block' value='carregar'></td></form>"	;
			echo "</tr>";
				}
?>
						
					</tbody>
				</table>
			</div>
            		</div>
	</section>
	
    <? }else{ // Se não existe, exibe um formulario para insercao. ?>

	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">CADASTRO DE PESSOA FÍSICA</div>
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
					<div class="col-md-offset-2 col-md-6"><strong>RG *:</strong><br/>
					  <input type="text" class="form-control" id="RG" name="RG" placeholder="RG" >
					</div>				  
					<div class=" col-md-6"><strong>CPF *:</strong><br/>
					  <input type="text" class="form-control" id="cpf" name="CPF" placeholder="CPF">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>CCM:</strong><br/>
					  <input type="text" class="form-control" id="CCM" name="CCM" placeholder="CCM" >
					</div>				  
					<div class=" col-md-6"><strong>Estado Civil:</strong><br/>
					  <select class="form-control" id="IdEstadoCivil" name="IdEstadoCivil" ><option>Estado Civil</option>
					   <?php
						geraOpcao("sis_estado_civil","","");
						?>  
					  </select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Data de Nascimento:</strong><br/>
					  <input type="text" class="form-control" id="datepicker01" name="DataNascimento" placeholder="Data de Nascimento" >
					</div>				  
					<div class=" col-md-6"><strong>Nacionalidade:</strong><br/>
					  <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" placeholder="Nacionalidade">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>CEP *:</strong><br/>
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
					<div class="col-md-offset-2 col-md-6"><strong>Telefone #1 *:</strong><br/>
					  <input type="text" class="form-control" id="Telefone1" name="Telefone1" placeholder="Telefone" >
					</div>				  
					<div class="col-md-6"><strong>Telefone #2:</strong><br/>
					  <input type="text" class="form-control" id="Telefone2" name="Telefone2" placeholder="Telefone" >
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone #3:</strong><br/>
					  <input type="text" class="form-control" id="Telefone3" name="Telefone3" placeholder="Telefone">
					</div>				  
					<div class=" col-md-6"><strong>E-mail:</strong><br/>
					  <input type="text" class="form-control" id="Email" name="Email" placeholder="E-mail" >
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
					 <input type="image" alt="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

  

<?	} 
	

}else{ // Se não existe pedido de busca, exibe campo de pesquisa.
?>    
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados - Pessoa Física</h2>
                    <p>Você está inserindo pessoas físicas para serem contratadas para o evento <strong><?  echo $nomeEvento['nomeEvento']; ?></strong></p>

<p><?php print_r($_SESSION); ?></p>

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            
                        <form method="POST" action="?perfil=contratados&p=fisica" class="form-horizontal" role="form">
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

<? break;
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
                    <p>Você está inserindo representantes legais de pessoas jurídicas para serem contratadas para o evento <strong><? echo $nomeEvento['nomeEvento']; ?></strong></p>

<p><?php print_r($_SESSION); ?></p>

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
	
    <? }else{ // Se não existe, exibe um formulario para insercao. ?>
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
  

<?	} 
	

}else{ // Se não existe pedido de busca, exibe campo de pesquisa.
?>    
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados - Pessoa Jurídica - Representantes</h2>
                    <p>Você está inserindo representantes de pessoas jurídicas para serem contratadas para o evento <strong><?  echo $nomeEvento['nomeEvento']; ?></strong></p>

<p><?php print_r($_SESSION); ?></p>

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
} //fim da switch ?>