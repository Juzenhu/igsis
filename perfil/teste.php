<?php
@ini_set('display_errors', '1');
error_reporting(E_ALL); 

// verifica se o usuário tem acesso a página
//$verifica = verificaAcesso($_SESSION['idUsuario'],$_GET['perfil']); 
//if($verifica == 1){
//	echo "<h1>".$verifica;".</h1>";
?>




<?php

if(isset($_GET['p'])){
	$p = $_GET['p'];	
}else{
	$p = "lista";
}

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
?>	
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contratados</h2>
                     <p>Você está inserindo pessoas físicas ou jurídicas para serem contratadas para o evento <strong><?php  echo $nomeEvento['nomeEvento']; ?></strong></p>
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
   						<td>Valor</td>
							<td width="12%">
  							<td width="12%">
							<td width="12%"></td>
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
						echo "<td class='list_description'>".$descricao['valor']."</td>";
						echo "
						<td class='list_description'>
						<form method='POST' action='?perfil=contratados&p=edicaoPessoa'>
						<input type='hidden' name='idPedidoContratacao' value='".$descricao['idPedidoContratacao']."'>
						<input type ='submit' class='btn btn-theme btn-md btn-block' value='editar pessoa'></td></form>"	; //botão de edição
						echo "
						<td class='list_description'>
						<form method='POST' action='?perfil=contratados&p=edicaoPedido'>
						<input type='hidden' name='idPedidoContratacao' value='".$descricao['idPedidoContratacao']."'>
						<input type ='submit' class='btn btn-theme btn-md btn-block' value='editar pedido'></td></form>"	; //botão de edição
						echo "
						<td class='list_description'>
						<form method='POST' action='?perfil=contratados&p=apagarPedido'>
						<input type='hidden' name='idPedidoContratacao' value='".$descricao['idPedidoContratacao']."'>
						<input type ='submit' class='btn btn-theme btn-md btn-block' value='apagar pedido'></td></form>"	; //botão de apagar

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
} ?>