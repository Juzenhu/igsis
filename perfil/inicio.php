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


<?php
if(isset($_GET['secao'])){
	$secao = $_GET['secao'];
}else{
	$secao = "inicio";
}
?>
<?php switch($secao){
	
case "inicio":
?>	
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Olá! Bem-vindo a nova versão da IGSIS!</h2>
					<p>Aqui você poderá começar os processos internos para a realização de seu evento.</p>
<p>A nova IGCCSP é um projeto que teve a colaboração de muitas areas do CCSP. Por isso, antes de tudo, a IGCCSP pode ser considerada como o resultado de longas conversas e montagem de quebra-cabeças.</p>
<p>Você pode imaginar que muitas rotinas podem mudar no seu cotidiano, mas lembre-se que muitas outras pessoas também vão passar pela mesma situação. O que podemos afirmar é que há muito mais consenso porque todos queremmos um CCSP mais unido, mais amigável e mais plural.</p>
<p>Por isso, opiniões, críticas, sugestões são muito bem-vindas. Elas melhoram o sistema, mas também fomentam a discussão dos processos e conceitos internos. </p>
<p>Um grande abraço de agradecimento e um bom trabalho!</p>
<p>&nbsp;</p>
<p>Equipe IGSIS / DEC / CCSPLab / Julho de 2015</p>
<p>igccsp2015@gmail.com</p>
					</div>
				  </div>
			  </div>
			  
		</div>
	</section>

<?php
break;
case "perfil";
 ?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Perfil</h2>
					<p>Selecione o perfil de trabalho.</p>
					</div>
				  </div>
			  </div>
			  <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<div class="service-box wow bounceInDown" data-wow-delay="0.1s">
						<a href="?perfil=evento"><i class="fa fa-code fa-4x"></i></a>
						<h4>Programador/Curador</h4>
						<p>Lorem ipsum dolor sit amet, ut decore iracundia urbanitas sit.</p>
						<a class="btn btn-primary">Learn more</a>
					</div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" data-wow-delay="0.3s">
					<div class="service-box wow bounceInDown" data-wow-delay="0.1s">
						<i class="fa fa-cog fa-4x"></i>
						<h4>Finanças/orçamento</h4>
						<p>Lorem ipsum dolor sit amet, ut decore iracundia urbanitas sit.</p>
						<a class="btn btn-primary">Learn more</a>
					</div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" data-wow-delay="0.5s">
					<div class="service-box wow bounceInDown" data-wow-delay="0.1s">
						<i class="fa fa-desktop fa-4x"></i>
						<h4>Contratos</h4>
						<p>Lorem ipsum dolor sit amet, ut decore iracundia urbanitas sit.</p>
						<a class="btn btn-primary">Learn more</a>
					</div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" data-wow-delay="0.7s">
					<div class="service-box wow bounceInDown" data-wow-delay="0.1s">
						<i class="fa fa-dropbox fa-4x"></i>
						<h4>Comunnicação</h4>
						<p>Lorem ipsum dolor sit amet, ut decore iracundia urbanitas sit.</p>
						<a class="btn btn-primary">Learn more</a>
					</div>
                </div>
			  </div>	
		</div>
	</section>

<?php
break;
case "ajuda";
 ?>
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Contato</h2>
					 <p>Dúvidas, sugestões e comunicação de bugs, fale conosco! </p>
					</div>
				  </div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form">
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="inputName" placeholder="Nome">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="email" class="form-control" id="inputEmail" placeholder="Email">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="inputSubject" placeholder="Assunto">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <textarea name="message" class="form-control" rows="3" placeholder="Mensagem"></textarea>
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <button type="button" class="btn btn-theme btn-lg btn-block">Enviar</button>
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  
 
<?php 
break;
} ?>