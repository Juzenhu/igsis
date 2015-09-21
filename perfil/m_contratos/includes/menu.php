<?php
//geram o insert pro framework da igsis
$pasta = "?perfil=contratos&p=";
 ?>


	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li>
								<a href="index.php">Home</a>
							</li>
							<li><a href="#">Pedido de Contratação</a>
                            	<ul class="dl-submenu">
                                <li>
									<a href="#">Pessoa Física</a>
									<ul class="dl-submenu">
										<li><a href="<?php echo $pasta ?>frm_lista_pedidocontratacaopf">Listar</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Pessoa Jurídica</a>
									<ul class="dl-submenu">
										<li><a href="<?php echo $pasta ?>frm_lista_pedidocontratacaopj">Listar</a></li>
									</ul>
								</li>
                                </ul>
                            </li>
							<li><a href="#">Cadastro de Pessoas</a>
                            	<ul class="dl-submenu">
                                <li>
									<a href="#">Pessoa Física</a>
									<ul class="dl-submenu">
										<li><a href="<?php echo $pasta ?>frm_lista_pf">Listar</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Pessoa Jurídica</a>
									<ul class="dl-submenu">
										<li><a href="<?php echo $pasta ?>frm_lista_pj">Listar</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Representante Legal</a>
									<ul class="dl-submenu">
										<li><a href="<?php echo $pasta ?>frm_cadastra_representantelegal">Cadastrar</a></li>
										<li><a href="<?php echo $pasta ?>frm_lista_representantelegal">Listar</a></li>
									</ul>
								</li>
                                </ul>
                            </li>
							<li><a href="#">Proposta</a>
                            	<ul class="dl-submenu">
                                <li>
									<a href="#">Pessoa Física</a>
									<ul class="dl-submenu">
										<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopf_cadastraproposta">Cadastrar</a></li>
										<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopf_cadastraprocesso">Inserir Processo</a></li>
										<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopf_cadastrane">Inserir N.E.</a></li>
										<li><a href="<?php echo $pasta ?>frm_lista_propostapf">Listar</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Pessoa Jurídica</a>
									<ul class="dl-submenu">
										<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopj_cadastraproposta">Cadastrar</a></li>
										<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopj_cadastraprocesso">Inserir Processo</a></li>
										<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopj_cadastrane">Inserir N.E.</a></li>
										<li><a href="<?php echo $pasta ?>frm_lista_propostapj">Listar</a></li>
									</ul>
								</li>
                                </ul>
                            </li>
							<li><a href="#">Ajuda</a></li>
                            <li><a href="<?php echo $pasta ?>frm_busca">Busca Pessoa</a></li>
                            <li><a href="<?php echo $pasta ?>frm_busca">Busca Evento</a></li>
							<li><a href="../index.php">Sair</a></li>
						</ul>
			</div>
	</div>	
