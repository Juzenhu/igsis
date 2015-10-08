<?php
require_once("../funcoes/funcoesVerifica.php");
require_once("../funcoes/funcoesSiscontrat.php");
if(isset($_GET['idEvento'])){
	$evento = verificaCampos($_GET['idEvento']);
	$ocorrencia = verificaOcorrencias($_GET['idEvento']);	
}

?>

	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li>
								<a href="?secao=inicio">Início</a>
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


<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                <h2>Buscas e pesquisas</h2>
	                <h5>Escolha uma opção</h5>
                </div>
            </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?perfil=busca" class="btn btn-theme btn-lg btn-block">Eventos</a>
	            <a href="?perfil=busca" class="btn btn-theme btn-lg btn-block">Pedidos de contratação</a>
  	            <a href="?perfil=busca" class="btn btn-theme btn-lg btn-block">Instituições, usuários e espaços</a>
            </div>
          </div>
        </div>
    </div>
</section>    