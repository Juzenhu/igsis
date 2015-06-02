	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?perfil=evento&p=basica">Apresentação básica</a></li>
                            <li><a href="?perfil=evento&p=detalhe">Detalhamento</a></li>
                            <li><a href="?perfil=evento&p=conteudo">Conteúdo</a> </li>
                            <li><a href="?perfil=evento&p=internos">Serviços internos</a></li>
                            <li><a href="?perfil=evento&p=area">Espeficidades</a></li>
                            <li><a href="?perfil=evento&p=externos">Serviços externos</a></li>
                            <li><a href="?perfil=evento&p=arquivos">Anexar arquivos</a></li>
                            <li><a href="#">Contratados - Siscontrat</a></li>
                            <li><a href="#">Ocorrências</a>
                             		<ul class="dl-submenu">
                                    	<li><a href="?perfil=evento&p=ocorrencias&action=listar">Listar ocorrências</a>
                                        <li><a href="?perfil=evento&p=ocorrencias&action=inserir">Inserir nova ocorrência</a></li>
 										<?php
											$ver_sub = verificaExiste("ig_sub_evento","ig_evento_idEvento",$_SESSION['idEvento'],0);
											if($ver_sub['numero'] > 0){
										 ?>
                                        <li><a href="?perfil=evento&p=ocorrencias&action=inserirsub">Inserir ocorrência em sub-evento</a></li>
                                        <?php } ?>
                                    </ul>
                            </li>
                            <li><a href="?perfil=evento&p=enviar">Enviar</a> </li>
 							<li><a href="#">Outras opções</a> 
    
                                    <ul class="dl-submenu">
                                        <li><a href="?perfil=inicio">Voltar a página inicial</a></li>
                                        <li><a href="../include/logoff.php">Sair do sistema</a></li>
                                    </ul>
                                </li>
                       </ul>
					</div><!-- /dl-menuwrapper -->
	</div>	
    