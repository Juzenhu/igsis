<?php
if($_SESSION['cinema'] == 1){ // Se for uma mostra de cinema, executa o módulo.
$evento = recuperaDados("ig_evento",$_SESSION['idEvento'],"idEvento");

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
	             <h2> <?php echo $evento['nomeEvento'];  ?></h2>
                </div>
            </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
              <h4>Escolha uma opção</h4>
	            <a href="?perfil=cinema&p=inserir" class="btn btn-theme btn-lg btn-block">Inserir um novo filme</a>
	            <a href="?perfil=cinema&p=carregar" class="btn btn-theme btn-lg btn-block">Listar filmes</a>
                <?php print_r($_SESSION); ?>
            </div>
          </div>
        </div>
    </div>
</section> 

<?php 
break;
case "inserir":
?>
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<h3>Inserir Filme</h3>
	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=cinema&p=editar" method="post">
				  
			 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Título do filme *:</strong><br/>
					  <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" >
					</div>
				  </div>

                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Título original:</strong><br/>
					  <input type="text" class="form-control" id="tituloOriginal" name="tituloOriginal" placeholder="" >
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>País de origem*:</strong><br/>
					  <select class="form-control" id="pais1" name="pais1" >
					   <?php
						geraOpcao("ig_pais","","");
						?>  
					  </select>

					</div>				  
					<div class=" col-md-6"><strong>País de origem (co-produção):</strong><br/>
                       <select class="form-control" id="pais2" name="pais2" >
                       <option value="0">Não há</option>
					   <?php
						geraOpcao("ig_pais","","");
						?>  
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Ano de produção:</strong><br/>
					  <input type="text" class="form-control" id="ano" name="ano" placeholder="" >
					</div>				  
					<div class=" col-md-6"><strong>Gênero:</strong><br/>
					  <input type="text" class="form-control" id="genero" name="genero" placeholder="" >
					</div>
				  </div>

				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Bitola:</strong><br/>
					  <input type="text" class="form-control" id="bitola" name="bitola" placeholder="" >
					</div>				  
					<div class=" col-md-6"><strong>Direção:</strong><br/>
 <input type="text" class="form-control" id="direcao" name="direcao" placeholder="direcao" >
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Sinopse:</strong><br/>
					 <textarea name="sinopse" class="form-control" rows="10" placeholder=""></textarea>
					</div>
				  </div>	
                  	 <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Elenco:</strong><br/>
					 <textarea name="elenco" class="form-control" rows="10" placeholder=""></textarea>
					</div>
				  </div>			  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Minutagem (em minutos):</strong><br/>
					   <input type="text" class="form-control" id="minutagem" name="minutagem" placeholder="">
					</div>				  
					<div class=" col-md-6"><strong>Link para trailer</strong><br/>
					 					  <input type="text" class="form-control" id="link" name="link" placeholder="link">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="inserirFilme" value="1" />
                    <input type="hidden" name="Sucesso" id="Sucesso" />
					 <input type="image" alt="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
	
    
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

<?php 
break;
case "editar":
?>

<?php 
break;
case "listar":
?>

<?php 
break;
case "inserirocorrencia":
?>

<?php 
break;
case "editarocorrencia":
?>

    <?php 
	break;
	} // fim da switch?>
    <?php }else{ // Se não for uma mostra de cinema, imprime a seguinte mensagem: ?>

	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>O evento não é uma Mostra de Cinema</h3>
<p>Antes de inserir algum filme, mude o tipo de <a href="?perfil=evento&p=basica">evento clicando aqui</a>.</p>
<p></p>


					</div>
				  </div>
			  </div>
			  
		</div>
	</section>

<?php	} ?>
	