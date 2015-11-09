	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
                        	<?php
							if(isset($_SESSION['com'])){ ?>
                            <li><a href="?perfil=comunicacao&p=edicao&id=<?php echo $_SESSION['idEvento'] ?>">< Voltar</a></li>
                            <?php }else{ ?>
                           <li><a href="?perfil=evento&p=area">< Voltar</a></li>
                           <?php } ?>
                            <li><a href="?perfil=cinema&p=inserir">Inserir novo filme</a></li>
                            <li><a href="?perfil=cinema&p=listar">Listar filmes</a></li>
                            <li><a href="?perfil=cinema&p=grade">Grade de filmes</a></li>
                       </ul>
					</div><!-- /dl-menuwrapper -->
	</div>	
    