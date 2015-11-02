	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li>
								<a href="?perfil=producao&p=lista">Lista de eventos</a>
							</li>
							<li><a href="?secao=perfil">Perfil de acesso</a></li>
							<li><a href="?secao=ajuda">Ajuda</a></li>
                            <li><a href="../include/logoff.php">Sair</a></li>
							<!--<li>
								<a href="#">Sub Menu</a>
								<ul class="dl-submenu">
									<li><a href="#">Sub menu</a></li>
									<li><a href="#">Sub menu</a></li>
								</ul>
							</li>-->
						</ul>
					</div><!-- /dl-menuwrapper -->
	</div>	

<?php
$con = bancoMysqli();
if(isset($_GET['p'])){
	$p = $_GET['p'];	
}else{
	$p = "inicio";
}
switch($p){
case "inicio":	
?>

<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
	                <h4>Escolha uma opção</h4>
                </div>
            </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?perfil=producao&p=lista" class="btn btn-theme btn-lg btn-block">Listar os eventos da instituição</a>
	            <a href="?perfil=evento&p=carregar" class="btn btn-theme btn-lg btn-block">Carregar um evento gravado</a>
  	            <a href="?perfil=evento&p=enviadas" class="btn btn-theme btn-lg btn-block">Acompanhar andamento de pedidos enviados</a>
            </div>
          </div>
        </div>
    </div>
</section>   

<?php 
break;
case "lista":
?>
<br />
<br />
<br />
<br />

	<section id="list_items">
		<div class="container">
             <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                <h2>Pedidos de contratação</h2>
	                <h5>Escolha uma opção</h5>
                </div>
            </div>
			<div class="table-responsive list_info">
				<table class="table table-condensed"><script type=text/javascript language=JavaScript src=../js/find2.js> </script>
					<thead>
						<tr class="list_menu">
							<td width="15%">Nome do Evento</td>
							<td>Tipo</td>
							<td width="15%">Local</td>
							<td>Data/Periodo</td>
   							<td>Status</td>
						</tr>
<?php
$ocorrencia = listaOcorrenciasInstituicao($_SESSION['idInstituicao']);
$data=date('Y');
for($i = 0; $i < count($ocorrencia); $i++)
 {
	$evento = recuperaDados("ig_evento",$ocorrencia[$i],"idEvento");	 
	echo "<tr><td class='lista'> <a href='?perfil=producao&p=detalhe&action=evento&id_ped=".$ocorrencia[$i]."'>".$evento['nomeEvento']."</a></td>";
	echo '<td class="list_description">'.retornaTipo($evento['ig_tipo_evento_idTipoEvento']).'</td> ';
	echo '<td class="list_description">'.substr(listaLocais($ocorrencia[$i]),1).'</td> ';
	echo '<td class="list_description">'.retornaPeriodo($ocorrencia[$i]).'</td> ';

	echo '<td class="list_description">OK</td> </tr>';
	}

?>
	
					
					</tbody>
				</table> 	
			</div>
		</div>
	</section>
<?php var_dump($ocorrencia); ?>

<?php
break;
case "detalhe": 
if(isset($_GET['id_ped'])){
$evento = recuperaDados("ig_evento",$_GET['id_ped'],"idEvento");
}


if(isset($_GET['action'])){
	$action = $_GET['action'];
}else{
	$action = "evento";
}
?>
 	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2><?php echo $evento['nomeEvento'] ?></h2>
					<h4></h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                 </div>
				  </div>
			  </div>  
<?php
switch($action){
case "evento":
 ?>
			  <h5>Dados do evento | <a href="?perfil=producao&p=detalhe&action=servicos&id_ped=<?php echo $_GET['id_ped']; ?>">Solicitação de serviços</a> </h5>
			<div class="table-responsive list_info" >
            <h4></h4>
            <p align="left">
              <?php descricaoEvento($_GET['id_ped']); ?>
                  </p>      
            <h5>Ocorrências</h5>
            <?php echo resumoOcorrencias($_GET['id_ped']); ?><br /><br />
            <?php listaOcorrenciasTexto($_GET['id_ped']); ?>
			<h5>Especificidades</h5>
			<div class="left">
            <?php descricaoEspecificidades($_GET['id_ped'],$evento['ig_tipo_evento_idTipoEvento']); ?>
			</div>
			<?php
break;
case "pedidos":
$pedido = listaPedidoContratacao($_GET['id_ped']);
?>
			  <h5> <a href="?perfil=producao&p=detalhe&action=pedidos&id_ped=<?php echo $_GET['id_ped']; ?>">Dados do evento </a>|<a href="?perfil=producao&p=detalhe&action=servicos&id_ped=<?php echo $_GET['id_ped']; ?>">Solicitação de serviços</a> | Pedidos de contratação</h5>
			  <div class="table-responsive list_info" >
            <h4><?php echo $evento['nomeEvento'] ?></h4>

			  <?php for($i = 0; $i < count($pedido); $i++){
			$dados = siscontrat($pedido[$i]);
			$pessoa = siscontratDocs($dados['IdProponente'],$dados['TipoPessoa']);
			?>
            <p align="left">
			Nome ou Razão Social: <b><?php echo $pessoa['Nome'] ?></b><br />
			Tipo de pessoa: <b><?php echo retornaTipoPessoa($dados['TipoPessoa']);?></b><br />
			Dotação: <b><?php echo retornaVerba($dados['Verba']);?></b><br />
			Valor:<b>R$ <?php echo dinheiroParaBr($dados['ValorGlobal']);?></b><br />		
			 </p>      
<?php } // fechamento do for ?>

 
			<?php
break;
case "servicos":

?>    
			  <h5> <a href="?perfil=producao&p=detalhe&action=evento&id_ped=<?php echo $_GET['id_ped']; ?>">Dados do evento </a>| Solicitação de serviços  </h5>
			<div class="table-responsive list_info" >
            <h4><?php echo $evento['nomeEvento'] ?></h4>
            <div class="left">
            
            <h5>Previsão de serviços externos</h5>
            <?php listaServicosExternos($_GET['id_ped']); ?><br /><br />

			<h5>Serviços Internos</h5>
			<?php listaServicosInternos($_GET['id_ped']) ?>

            </div>
<?php
break;
 } // fecha a switch action ?>	
<?php
break;
?>


<?php } ?>