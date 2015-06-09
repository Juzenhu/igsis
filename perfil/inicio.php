﻿	<div class="menu-area">
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
					 <h2>Bem-vindo à IGSIS!</h2>
					<p>Aqui inicia o processo interno para a realização de seu evento.</p>
<p>Este sistema é desenvolvido pela colaboração de diversas áreas, incluindo a sua.</p>
<p>A nova IGSIS é um diálogo interdisciplinar resultando na montagem de um grande quebra-cabeça:</p> <p>Um CCSP melhor.</p>
<p>Compartilhe sua opinião conosco. Envie para igccsp2015@gmail.com</p>
<p>Toda sugestão será bem-vinda</p>
<p>&nbsp;</p>
<p>Equipe IGSIS / DEC / CCSPLab / Julho de 2015</p>
<p>igccsp2015@gmail.com</p>
<p><?php print_r($_SESSION); ?>

					</div>
				  </div>
			  </div>
			  
		</div>
	</section>

<?php
break;
case "perfil";

 ?>
	<!-- <section id="services" class="home-section bg-white">
		<div class="container">


		</div>
	</section>-->
	 <!-- list -->
	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Perfil</h2>
					<p>Selecione o perfil de trabalho.</p>
					</div>
				  </div>
			  </div>  

			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Perfil</td>
							<td>Descrição</td>
							<td width="20%"></td>
						</tr>
					</thead>
					<tbody>
						
                         <?php listaModulos($_SESSION['perfil']); ?>
                        

						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#list_items-->
<?php
break;
case "ajuda";
 ?>

 <?php
if(isset($_POST['nome'])){ ?>
 	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Sua mensagem foi enviada!</h2>
					 <p>Dúvidas, sugestões e comunicação de bugs, fale conosco! </p>
					</div>
				  </div>
			  </div>
        </div>
        </section>
<?php
 $conteudo_email = $_POST['mensagem'];	
 $subject = $_POST['assunto'];
 $email = $_POST['email'];
 $usuario = $_POST['nome']; 	
 enviarEmailSimples($conteudo_email, $subject, $email, $usuario );
}else{ 
 
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

				<form method="POST" action="index.php?secao=ajuda" class="form-horizontal" role="form">
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" name="nome" class="form-control" id="inputName" placeholder="Nome">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" name="assunto" class="form-control" id="inputSubject" placeholder="Assunto">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <textarea name="mensagem" class="form-control" rows="3" placeholder="Mensagem"></textarea>
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <button type="submit" class="btn btn-theme btn-lg btn-block">Enviar</button>
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  
 
<?php 
}
break;
} ?>