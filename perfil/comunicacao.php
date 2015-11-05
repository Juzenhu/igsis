<?
//include para comunicação
require "../funcoes/funcoesComunicacao.php";
 ?>
<?php

// verifica se o usuário tem acesso a página
$verifica = verificaAcesso($_SESSION['idUsuario'],$_GET['perfil']); 
if($verifica == 1){

	if(isset($_GET['p'])){
		$p = $_GET['p'];	
	}else{
		$p = "inicial";
	}

	switch($p){
	
	case "inicial":

	if(isset($_GET['order'])){
		$order = $_GET['order'];
	}else{
		$order = "";
	}
	
	if(isset($_GET['sentido'])){
		$sentido = $_GET['sentido'];
		if($sentido == "ASC"){
			$invertido = "DESC";
		}else{
			$invertido = "ASC";
		}
	}
	
	
	
	?>
<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                <h3>Comunicação</h3>
	                <h4>Escolha uma opção</h4>
                </div>
            </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?perfil=chamado&p=inserir" class="btn btn-theme btn-lg btn-block">Eventos não editados</a>
	            <a href="?perfil=chamado&p=acompanhar" class="btn btn-theme btn-lg btn-block">Eventos editados</a>
	            <a href="?perfil=chamado&p=acompanhar" class="btn btn-theme btn-lg btn-block">Eventos revisados</a>

            </div>
          </div>
        </div>
    </div>
</section>  
	<?php
	
	
	break;
	case "naoeditados":
	
		?>
	<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
		    <h1>Página Filtro - Comunicação</h1>
			
	</div>
</section> 
	<?php
	break;
	case "editados": ?>

	<?php
	break;
	case "revisados": ?>

   	<?php
	break;
	case "edicao": 

if(isset($_POST['atualizar'])){

	if(isset($_POST['editado'])){
		$editado = $_POST['editado'];
	}else{
		$editado = 0;
	}

	if(isset($_POST['revisado'])){
		$revisado = $_POST['revisado'];
	}else{
		$revisado = 0;
	}
	
	if(isset($_POST['site'])){
		$site = $_POST['site'];
	}else{
		$site = 0;
	}
	
	if(isset($_POST['publicacao'])){
		$publicacao = $_POST['publicacao'];
	}else{
		$publicacao = 0;
	}
	$nomeEvento = $_POST['nomeEvento'];
	$projetoEspecial = $_POST['projetoEspecial']; 
	$nomeEvento = $_POST['nomeEvento'];
	$projeto = $_POST['projeto'];
	$ig_tipo_evento_idTipoEvento = $_POST['ig_tipo_evento_idTipoEvento'];
	$autor = addslashes($_POST['autor']);
	$fichaTecnica = addslashes($_POST['fichaTecnica']); 
	$sinopse = addslashes($_POST['sinopse']);
	$releaseCom = addslashes($_POST['releaseCom']); 
	$observacao =  addslashes($_POST['observacao']);	
}

	$idEvento = $_GET['id'];
	$campo = recuperaDados("ig_comunicacao",$idEvento,"ig_evento_idEvento");


	
	?>


    
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Comunicação - Edição</h3>
                    <h1><?php echo $campo["nomeEvento"] ?></h1>
                    <h4><?php if(isset($mensagem)){echo $mensagem;} ?></h4>
                </div>
            </div>
    </div>
    
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
        <form method="POST" action="?perfil=evento&p=basica" class="form-horizontal" role="form">
 <div class="form-group">
	                <div class="col-md-offset-2 col-md-8">	
				<h6><a href="?perfil=busca&p=detalhe&evento=<?php echo $campo['ig_evento_idEvento'] ?>" target="_blank">Documento enviado </a> | Resumo Comunicação | SPCultura </h6>	
                 	</div>                     
                </div>

 <div class="form-group">
	                <div class="col-md-offset-2 col-md-8">
    		            <input type="checkbox" name="editado"  <?php checar($campo['editado']) ?> /><label style="padding:0 10px 0 5px;"> Editado</label>
           			    <input type="checkbox" name="revisado"  <?php checar($campo['editado']) ?>/><label  style="padding:0 10px 0 5px;"> Revisado</label>
            		    <input type="checkbox" name="site"  <?php checar($campo['site']) ?> /><label style="padding:0 10px 0 5px;"> Site</label>
            		    <input type="checkbox" name="impresso"  <?php checar($campo['publicacao']) ?>/><label style="padding:0 10px 0 5px;"> Impresso</label>
                 	</div>                     
                </div>
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Nome do Evento </label>
            		<input type="text" name="nomeEvento" class="form-control" id="inputSubject" value="<?php echo $campo['nomeEvento'] ?>"/>
            	</div> 
            </div>
           
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
            	<label>Nome do Projeto especial</label>
            	<select class="form-control" name="projetoEspecial" id="inputSubject" >
					<option value="1"></option>
					<?php echo geraOpcao("ig_projeto_especial",$campo['projetoEspecial'],$_SESSION['idInstituicao']) ?>
                </select>
        	    </div>
      	    </div>

            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Nome do Projeto </label>
            		<input type="text" name="projeto" class="form-control" id=""  value="<?php echo $campo['projeto'] ?>">
            	</div>
             </div>
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Tipo de Evento </label>
            		<select class="form-control" name="ig_tipo_evento_idTipoEvento" id="inputSubject" >
						<option value="1"></option>
						<?php echo geraOpcao("ig_tipo_evento",$campo['ig_tipo_evento_idTipoEvento'],"") ?>
                    </select>					
            	</div>
            </div>
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Autor:</strong><br/>
					 <textarea name="autor" class="form-control" rows="5"> <?php echo $campo['autor'] ?></textarea>
					</div>
				  </div>	
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Ficha Técnica:</strong><br/>
					 <textarea name="fichaTecnica" class="form-control" rows="10"> <?php echo $campo['autor'] ?></textarea>
					</div>
				  </div>	                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Sinopse:</strong><br/>
					 <textarea name="sinopse" class="form-control" rows="10" ><?php echo $campo['sinopse'] ?></textarea>
					</div>
				  </div>	
<div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Release:</strong><br/>
					 <textarea name="releaseCom" class="form-control" rows="20" ><?php echo $campo['releaseCom'] ?></textarea>
					</div>
				  </div>	
<div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					 <textarea name="observacao" class="form-control" rows="20" ><?php echo $campo['observacao'] ?></textarea>
					</div>
				  </div>	                  
            <div class="form-group">
	            <div class="col-md-offset-2 col-md-8">
                	<input type="hidden" name="atualizar" value="1" />
    		        <input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
            	</div>
            </div>
            </form>
        </div>
    </div>
</section> 





	
	<?php
	break;
	

		
	}
	
 }else{ ?>

<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
		    <h1>Você não tem acesso. Por favor, contacte o administrador do sistema.</h1>
		</div>
	</div>
</section>  
	 
 <?php } ?>