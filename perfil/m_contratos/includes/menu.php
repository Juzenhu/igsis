<?php
//geram o insert pro framework da igsis
$pasta = "?perfil=contratos&p=";
 ?>


<div class="menu-area">
  <div id="dl-menu" class="dl-menuwrapper">
	<button class="dl-trigger">Open Menu</button>
	<ul class="dl-menu">
		<li><a href="index.php">Home</a></li>
		<li><a href="#">Cadastro de Pessoas</a>
			<ul class="dl-submenu">
				<li><a href="<?php echo $pasta ?>frm_lista_pf">Pessoa Física</a></li>
				<li><a href="<?php echo $pasta ?>frm_lista_pj">Pessoa Jurídica</a></li>
			</ul>
        </li>
		<li><a href="#">Contratos Pessoa Física</a>
			<ul class="dl-submenu">
				<li><a href="<?php echo $pasta ?>frm_lista_pedidocontratacaopf">Pedido de Contratação</a></li>
                <li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopf_cadastraproposta">Proposta</a></li>
				<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopf_cadastraprocesso">Processo</a></li>
				<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopf_cadastrane">Nota de Empenho</a></li>
				<li><a href="<?php echo $pasta ?>frm_lista_propostapf">Listar Todos</a></li>
			</ul>
		</li>
		<li><a href="#">Contratos Pessoa Jurídica</a>
			<ul class="dl-submenu">
				<li><a href="<?php echo $pasta ?>frm_lista_pedidocontratacaopj">Pedido de Contratação</a></li>
				<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopj_cadastraproposta">Cadastrar</a></li>
				<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopj_cadastraprocesso">Inserir Processo</a></li>
				<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopj_cadastrane">Inserir N.E.</a></li>
				<li><a href="<?php echo $pasta ?>frm_lista_propostapj">Listar Todos</a></li>
			</ul>
		</li>
		<li><a href="#">Ajuda</a></li>
        <li><a href="<?php echo $pasta ?>frm_busca">Busca Pessoa</a></li>
        <li><a href="<?php echo $pasta ?>frm_busca_evento">Busca Evento</a></li>
		<li><a href="../index.php">Sair</a></li>
			</ul>
  </div>
</div>	
