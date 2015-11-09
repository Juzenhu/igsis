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
	$idInstituicao = $_SESSION['idInstituicao'];
?>
<?php include "../include/menuCom.php"; ?>
<?php
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
	            <a href="?perfil=comunicacao&p=all" class="btn btn-theme btn-lg btn-block">Todos os eventos</a>
	            <a href="?perfil=comunicacao&p=editados" class="btn btn-theme btn-lg btn-block">Eventos editados</a>
	            <a href="?perfil=comunicacao&p=revisados" class="btn btn-theme btn-lg btn-block">Eventos revisados</a>

            </div>
          </div>
        </div>
    </div>
</section>  

	<?php
	
	
	break;
	case "all":
	
		?>


	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Comunicação</h2>
					<h4></h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                 </div>
				  </div>
			  </div>  
			
			<div class="table-responsive list_info">
                  <table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td width='10%'>Numero IG</td>
							<td>Nome de Evento</td>
							<td>Enviador por</td>
							<td>Data/Início</td>
						</tr>
					</thead>
					<tbody>
					<?php
					$con = bancoMysqli();
					$sql_busca_dic = "SELECT * FROM ig_comunicacao WHERE editado IS NULL AND idInstituicao = '$idInstituicao' ORDER BY idCom DESC";
					$query_busca_dic = mysqli_query($con,$sql_busca_dic);
						while($evento = mysqli_fetch_array($query_busca_dic)){ 
						$event = recuperaDados("ig_evento",$evento['ig_evento_idEvento'],"idEvento");
						$nome = recuperaUsuario($event['idUsuario']);
						
						
						?>
						
					<tr>
					<td><?php echo retornaProtoEvento($evento['ig_evento_idEvento']) ?></td>
					<td><a href="?perfil=comunicacao&p=edicao&id=<?php echo $evento['ig_evento_idEvento']  ?>"><?php echo $evento['nomeEvento'] ?></a></td>
					<td><?php echo $nome['nomeCompleto'] ?></td>
					<td><?php echo retornaPeriodo($evento['ig_evento_idEvento']) ?></td>
					</tr>					
					<?php
						}
					?>
					
					
					</tbody>
					</table>
				   
			</div>
		</div>
	</section>
		<?php
	break;
	case "editados": ?>

	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Comunicação</h2>
					<h4></h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                 </div>
				  </div>
			  </div>  
			
			<div class="table-responsive list_info">
                  <table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td width='10%'>Numero IG</td>
							<td>Nome de Evento</td>
							<td>Enviador por</td>
							<td>Data/Início</td>
						</tr>
					</thead>
					<tbody>
					<?php
					$con = bancoMysqli();
					$sql_busca_dic = "SELECT * FROM ig_comunicacao WHERE editado = '1' AND idInstituicao = '$idInstituicao' ORDER BY idCom DESC";
					$query_busca_dic = mysqli_query($con,$sql_busca_dic);
						while($evento = mysqli_fetch_array($query_busca_dic)){ 
						$event = recuperaDados("ig_evento",$evento['ig_evento_idEvento'],"idEvento");
						$nome = recuperaUsuario($event['idUsuario']);
						
						
						?>
						
					<tr>
					<td><?php echo retornaProtoEvento($evento['ig_evento_idEvento']) ?></td>
					<td><a href="?perfil=comunicacao&p=edicao&id=<?php echo $evento['ig_evento_idEvento']  ?>"><?php echo $evento['nomeEvento'] ?></a></td>
					<td><?php echo $nome['nomeCompleto'] ?></td>
					<td><?php echo retornaPeriodo($evento['ig_evento_idEvento']) ?></td>
					</tr>					
					<?php
						}
					?>
					
					
					</tbody>
					</table>
				   
			</div>
		</div>
	</section>

	<?php
	break;
	case "revisados": ?>

	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Comunicação</h2>
					<h4></h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                 </div>
				  </div>
			  </div>  
			
			<div class="table-responsive list_info">
                  <table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td width='10%'>Numero IG</td>
							<td>Nome de Evento</td>
							<td>Enviador por</td>
							<td>Data/Início</td>
						</tr>
					</thead>
					<tbody>
					<?php
					$con = bancoMysqli();
					$sql_busca_dic = "SELECT * FROM ig_comunicacao WHERE revisado = '1'  AND idInstituicao = '$idInstituicao' ORDER BY idCom DESC";
					$query_busca_dic = mysqli_query($con,$sql_busca_dic);
						while($evento = mysqli_fetch_array($query_busca_dic)){ 
						$event = recuperaDados("ig_evento",$evento['ig_evento_idEvento'],"idEvento");
						$nome = recuperaUsuario($event['idUsuario']);
						
						
						?>
						
					<tr>
					<td><?php echo retornaProtoEvento($evento['ig_evento_idEvento']) ?></td>
					<td><a href="?perfil=comunicacao&p=edicao&id=<?php echo $evento['ig_evento_idEvento']  ?>"><?php echo $evento['nomeEvento'] ?></a></td>
					<td><?php echo $nome['nomeCompleto'] ?></td>
					<td><?php echo retornaPeriodo($evento['ig_evento_idEvento']) ?></td>
					</tr>					
					<?php
						}
					?>
					
					
					</tbody>
					</table>
				   
			</div>
		</div>
	</section>


		<?php
	break;
	case "agenda": 
	if(isset($_POST['inicio']) AND $_POST['inicio'] != ""){
		if($_POST['final'] == ""){
			$mensagem = "É preciso informar a data final do filtro";	
		}else{
			$inicio = exibirDataMysql($_POST['inicio']);
			$final = exibirDataMysql($_POST['final']);
			if($_POST['inicio'] > $_POST['final']){
				$mensagem = "A data final do filtro deve ser maior que a data inicio";		
			}else{
				$data_inicio = exibirDataMysql($_POST['inicio']);
				$data_final = exibirDataMysql($_POST['final']);
				$mensagem = "Filtro aplicado: eventos entre ".$_POST['inicio']." e ".$_POST['final'];
			}
		
		}
		
		
		
	}else{
		$mes = date("m");      // Mês desejado, pode ser por ser obtido por POST, GET, etc.
		$ano = date("Y"); // Ano atual
		$dia = date("t", mktime(0,0,0,$mes,'01',$ano)); // Mágica, plim!
		$data_inicio = "$ano-$mes-01";
		$data_final = "$ano-$mes-$dia";
		$nome_mes = retornaMes($mes);	
		$mensagem = "Filtro aplicado: eventos de $nome_mes de $ano.";
	
	}
	
	
	
	
	?>
	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Comunicação - Agenda</h2>
					<h4></h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                 </div>
				  </div>
			  </div>  
            <form method="POST" action="?perfil=comunicacao&p=agenda" class="form-horizontal" role="form">
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
               			 <label>Data início *</label>
                		<input type="text" name="inicio" class="form-control" id="datepicker01" placeholder="">
               		 </div>
                	<div class=" col-md-6">
                		<label>Data encerramento *</label>
                		<input type="text" name="final" class="form-control" id="datepicker02"  placeholder="">
               		</div>
                </div>
                  <div class="form-group">
	            <div class="col-md-offset-2 col-md-8">
                <br />
                	<input type="submit" class="btn btn-theme btn-lg btn-block" value="Filtrar">
                    <br >
					</form>
            	</div>
            </div>
            </form>
			<div class="table-responsive list_info">
                  <table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td width='10%'>Numero IG</td>
							<td>Nome de Evento</td>
							<td>Enviador por</td>
							<td>Data/Início</td>
						</tr>
					</thead>
					<tbody>
					<?php
					

					$con = bancoMysqli();
					$sql_busca_dic = "SELECT DISTINCT idEvento FROM ig_ocorrencia WHERE 
					(".
					"(dataInicio >= '$data_inicio' AND dataInicio <= '$data_final' AND dataFinal = '0000-00-00')". // data única
					" OR (dataInicio <= '$data_inicio' AND dataFinal >= '$data_final') ". // temporada se inicia no período
					" OR ((dataFinal BETWEEN '$data_inicio' AND $data_final) AND dataInicio <= '$data_inicio') ". // temporada se inicia antes do periodo e termina durante o  periodo
					" OR (dataInicio <= '$data_inicio' AND dataFinal >= '$data_final') ". // temporada se inicia antes do periodo e termina depois periodo

					") AND publicado = '1' ".
					
					"  ORDER BY dataInicio ASC";
					  
					$query_busca_dic = mysqli_query($con,$sql_busca_dic);
						while($evento = mysqli_fetch_array($query_busca_dic)){ 
						$event = recuperaDados("ig_evento",$evento['idEvento'],"idEvento");
						$nome = recuperaUsuario($event['idUsuario']);
						
						if($event['dataEnvio'] != NULL AND $event['idInstituicao'] == $_SESSION['idInstituicao']){ // só as enviadas
						?>
						
					<tr>
					<td><?php echo retornaProtoEvento($evento['idEvento']) ?></td>
					<td><a href="?perfil=comunicacao&p=edicao&id=<?php echo $evento['idEvento']  ?>"><?php echo $event['nomeEvento'] ?></a></td>
					<td><?php echo $nome['nomeCompleto'] ?></td>
					<td><?php echo retornaPeriodo($event['idEvento']) ?></td>
					</tr>					
					<?php
						}
						}
					?>
					
					
					</tbody>
					</table>
				   
			</div>
		</div>
	</section>


   	<?php
	break;
	case "edicao": 
	$idEvento = $_GET['id'];
	
if(isset($_POST['atualizar'])){

	if(isset($_POST['editado'])){
		$editado = 1;
	}else{
		$editado = 0;
	}

	if(isset($_POST['revisado'])){
		$revisado = 1;
	}else{
		$revisado = 0;
	}
	
	if(isset($_POST['site'])){
		$site = 1;
	}else{
		$site = 0;
	}
	
	if(isset($_POST['publicacao'])){
		$publicacao = 1;
	}else{
		$publicacao = 0;
	}

	$projetoEspecial = $_POST['projetoEspecial']; 
	$nomeEvento = $_POST['nomeEvento'];
	$projeto = $_POST['projeto'];
	$ig_tipo_evento_idTipoEvento = $_POST['ig_tipo_evento_idTipoEvento'];
	$autor = addslashes($_POST['autor']);
	$fichaTecnica = addslashes($_POST['fichaTecnica']); 
	$sinopse = addslashes($_POST['sinopse']);
	$releaseCom = addslashes($_POST['releaseCom']); 
	$observacao =  addslashes($_POST['observacao']);	
	$idCom = $_POST['atualizar'];

	$sql_atualiza_com = "UPDATE `igsis`.`ig_comunicacao` SET 
	`sinopse` = '$sinopse', 
	`fichaTecnica` = '$fichaTecnica',
	`autor` = '$autor',
	`releaseCom` = '$releaseCom',
	`revisado` = '$revisado',
	`editado` = '$editado',
	
	`site` = '$site',
	`publicacao` = '$publicacao',
	`ig_tipo_evento_idTipoEvento` = '$ig_tipo_evento_idTipoEvento',
	`projeto` = '$projeto',
	`nomeEvento` = '$nomeEvento',
	`observacao` = '$observacao' WHERE `ig_comunicacao`.`idCom` = '$idCom'";

	$con = bancoMysqli();
		
	$query_atualiza_com = mysqli_query($con,$sql_atualiza_com);
	if($query_atualiza_com){
		$mensagem = "Atualizado com sucesso";	
	}else{
		$mensagem = "Erro ao atualizar.";
	}
	
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
        <form method="POST" action="?perfil=comunicacao&p=edicao&id=<?php echo $_GET['id'] ?>" class="form-horizontal" role="form">
 <div class="form-group">
	                <div class="col-md-offset-2 col-md-8">	
				<h6><a href="?perfil=busca&p=detalhe&evento=<?php echo $campo['ig_evento_idEvento'] ?>" target="_blank">Documento enviado </a> | Edição | <a href="?perfil=comunicacao&p=spcultura&id=<?php echo $_GET['id']; ?>" >SPCultura</a> 
				<?php 
				if($campo['ig_tipo_evento_idTipoEvento'] == 1){ //edição cinema
					$_SESSION['cinema'] = 1;
					$_SESSION['idEvento'] = $_GET['id'];
					$_SESSION['com'] = 1;
				
				?>
                | <a href="?perfil=cinema" >Filmes </a>
                <?php
				}
				
				?></h6>	
                 	</div>                     
                </div>

 <div class="form-group">
	                <div class="col-md-offset-2 col-md-8">
    		            <input type="checkbox" name="editado"  <?php checar($campo['editado']) ?> /><label style="padding:0 10px 0 5px;"> Editado</label>
           			    <input type="checkbox" name="revisado"  <?php checar($campo['revisado']) ?>/><label  style="padding:0 10px 0 5px;"> Revisado</label>
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
					 <textarea name="fichaTecnica" class="form-control" rows="10"><?php echo $campo['autor'] ?></textarea>
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
                  <?php if($_SESSION['idInstituicao'] == 5){ // Mostra Gerador de formatação ?>
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Gerador de Diagramação</strong><br/>
                    <div class="left">
					 <h5><?php echo $campo['nomeEvento']; ?></h5>
                     <p><?php echo resumoOcorrencias($idEvento); ?></p>
                     <p><?php echo nl2br($campo['sinopse']); ?></p>
					
	
                     <p></p>
                     
					</div>
                	</div>
				  </div>	


                  <?php } ?>

                  
<div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					 <textarea name="observacao" class="form-control" rows="20" ><?php echo $campo['observacao'] ?></textarea>
					</div>
				  </div>	                  
            <div class="form-group">
	            <div class="col-md-offset-2 col-md-8">
                	<input type="hidden" name="atualizar" value="<?php echo $campo['idCom'] ?>" />
    		        <input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
					</form>
            	</div>
            </div>
            </form>
        </div>
    </div>
</section> 

<?php
break;
case "spcultura": 
$mapas = recuperaDados("ig_comunicacao",$_GET['id'],"ig_evento_idEvento");
$evento = recuperaDados("ig_evento",$_GET['id'],"idEvento");
$usuario = recuperaDados("ig_usuario",$_SESSION['idUsuario'],"idUsuario");
$instituicao = recuperaDados("ig_instituicao",$usuario['idInstituicao'],"idInstituicao");
?>


	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					                     

					</div>
				  </div>
			  </div>
			  
	       <div class="row">
            	                <div class="col-md-offset-2 col-md-8">	
				<h6><a href="?perfil=busca&p=detalhe&evento=<?php echo $_GET['id']; ?>" target="_blank">Documento enviado </a> |  <a href="?perfil=comunicacao&p=edicao&id=<?php echo $_GET['id']; ?>" >Edição </a> | SPCultura </h6>	
                 	</div>                     
                </div>

			<div class="table-responsive list_info" >
            <h4><?php echo $mapas['nomeEvento'] ?></h4>
            <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><br/>
                    <div class="left">
            <p>* Habilitar logo da SMC</p>        
			<p>Nome de exibição: <strong><?php echo $mapas['nomeEvento']; ?></strong></p>
			<p>Descrição curta:<br /> <?php echo $mapas['sinopse']; ?></p>
			<p>Inscrições: <strong>(tabela oficinas)</strong> </p>
			<p>Site: <strong><?php echo $instituicao['site']; ?></strong> </p>
			<p>Mais informações: <strong><?php echo $instituicao['telefone']; ?></strong> </p>
            
            <p>Descrição:<br />
            <?php echo $mapas['observacao']; ?>
            </p>			            
					</div>
                	</div>
				  </div>	
            <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Ocorrências</strong><br/>
                    <div class="left">
            <?php listaOcorrenciasTexto($_GET['id']); ?>		            
					</div>
                	</div>
				  </div>	

			  
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