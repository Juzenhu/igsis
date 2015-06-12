<?php require "../funcoes/funcoesEvento.php"; //carrega as funções específicas ?>
<?php

// verifica se o usuário tem acesso a página
$verifica = verificaAcesso($_SESSION['idUsuario'],$_GET['perfil']); 
if($verifica == 1){
?>




<?php
@ini_set('display_errors', '1');
error_reporting(E_ALL);

if(isset($_GET['p'])){
	$p = $_GET['p'];	
}else{
	$p = "inicio";
}

switch($p){

case "inicio":
?>
	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?perfil=inicio">Início</a> </li>
							<li><a href="#lista">Quadro geral</a></li>
                            <li><a href="#lista">Inserir novo pedido</a>
                          		<ul class="dl-submenu">
                                 <li><a href="#">Evento</a>
                                    <ul class="dl-submenu">
                                        <li selected><a href="?perfil=evento&p=basica">Apresentação básica</a></li>
                                        <li><a href="#">Detalhamento</a></li>
                                        <li><a href="#">Ocorrências</a></li>
                                        <li><a href="#">Conteúdo</a></li>
                                        <li><a href="#">Serviços internos</a></li>
                                        <li><a href="#">Especificidades de área</a></li>
                                        <li><a href="#">Previsão de serviços externos</a></li>
                                    </ul>
                                </li>
                                <li><a href="#enviar">Contratado</a> 
                                    <ul class="dl-submenu">
                                        <li><a href="#">Inserir contratado</a></li>
                                        <li><a href="#">Lista de contratados</a></li>
                                    </ul>
                                </li>    
                                <li><a href="#enviar">Anexar arquivos</a> </li>
                                <?php //criar um if para o módulo cinema ?>
                                <li><a href="#enviar">Módulo Cinema</a> 
    
                                    <ul class="dl-submenu">
                                        <li><a href="#">Inserir novo filme</a></li>
                                        <li><a href="#">Lista de filmes</a></li>
                                    </ul>
                                </li>
                                <li><a href="#enviar">Enviar</a> </li>
							</ul>
                            </li>
  							<li><a href="#lista">Carregar evento em aberto</a></li> 
                            <li><a href="#lista">Pedidos enviados</a>   

    
                                    <ul class="dl-submenu">
                                        <li><a href="#">Relatório de alterações</a></li>
                                        <li><a href="#">Enviar alteraçãos</a></li>
                                        <li><a href="#">Enviar anexo</a></li>
                                    </ul>
                                </li>                      
                        </ul>
					</div><!-- /dl-menuwrapper -->
	</div>	
<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
	                <h4>Escolha uma opção</h4>
                </div>
            </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?perfil=evento&p=basica&inserir=novo" class="btn btn-theme btn-lg btn-block">Inserir um novo evento</a>
	            <a href="?perfil=evento&p=carregar" class="btn btn-theme btn-lg btn-block">Carregar um evento gravado</a>
  	            <a href="?perfil=evento&p=enviadas" class="btn btn-theme btn-lg btn-block">Acompanhar andamento de pedidos enviados</a>
            </div>
          </div>
        </div>
    </div>
</section>    

<? break;
case "carregar":
if(isset($_POST['apagar'])){
	$idApagar = $_POST['apagar'];
	$sql_apagar_registro = "UPDATE ig_evento SET publicado = 0 WHERE idEvento = $idApagar";

	if(mysql_query($sql_apagar_registro)){	
		$mensagem = "Evento apagado com sucesso!";
		gravarLog($sql_apagar_registro);
	}else{
		$mensagem = "Erro ao apagar o evento...";	
	}
}
?>
	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?perfil=inicio">Início</a> </li>
							<li><a href="#lista">Quadro geral</a></li>
                            <li><a href="#lista">Inserir novo pedido</a>
                          		<ul class="dl-submenu">
                                 <li><a href="#">Evento</a>
                                    <ul class="dl-submenu">
                                        <li selected><a href="?perfil=evento&p=basica">Apresentação básica</a></li>
                                        <li><a href="#">Detalhamento</a></li>
                                        <li><a href="#">Ocorrências</a></li>
                                        <li><a href="#">Conteúdo</a></li>
                                        <li><a href="#">Serviços internos</a></li>
                                        <li><a href="#">Especificidades de área</a></li>
                                        <li><a href="#">Previsão de serviços externos</a></li>
                                    </ul>
                                </li>
                                <li><a href="#enviar">Contratado</a> 
                                    <ul class="dl-submenu">
                                        <li><a href="#">Inserir contratado</a></li>
                                        <li><a href="#">Lista de contratados</a></li>
                                    </ul>
                                </li>    
                                <li><a href="#enviar">Anexar arquivos</a> </li>
                                <?php //criar um if para o módulo cinema ?>
                                <li><a href="#enviar">Módulo Cinema</a> 
    
                                    <ul class="dl-submenu">
                                        <li><a href="#">Inserir novo filme</a></li>
                                        <li><a href="#">Lista de filmes</a></li>
                                    </ul>
                                </li>
                                <li><a href="#enviar">Enviar</a> </li>
							</ul>
                            </li>
  							<li><a href="#lista">Carregar evento em aberto</a></li> 
                            <li><a href="#lista">Pedidos enviados</a>   

    
                                    <ul class="dl-submenu">
                                        <li><a href="#">Relatório de alterações</a></li>
                                        <li><a href="#">Enviar alteraçãos</a></li>
                                        <li><a href="#">Enviar anexo</a></li>
                                    </ul>
                                </li>                      
                        </ul>
					</div><!-- /dl-menuwrapper -->
	</div>	
	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Eventos gravados mas não enviados</h2>
					<h4>Selecione o evento para carregar.</h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
					</div>
				  </div>
			  </div>  

			<div class="table-responsive list_info">
                         <?php listaEventosGravados($_SESSION['perfil']); ?>
			</div>
		</div>
	</section> <!--/#list_items-->

<? break;
case "enviadas";
 ?>
 	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?perfil=inicio">Início</a> </li>
							<li><a href="#lista">Quadro geral</a></li>
                            <li><a href="#lista">Inserir novo pedido</a>
                          		<ul class="dl-submenu">
                                 <li><a href="#">Evento</a>
                                    <ul class="dl-submenu">
                                        <li selected><a href="?perfil=evento&p=basica">Apresentação básica</a></li>
                                        <li><a href="#">Detalhamento</a></li>
                                        <li><a href="#">Ocorrências</a></li>
                                        <li><a href="#">Conteúdo</a></li>
                                        <li><a href="#">Serviços internos</a></li>
                                        <li><a href="#">Especificidades de área</a></li>
                                        <li><a href="#">Previsão de serviços externos</a></li>
                                    </ul>
                                </li>
                                <li><a href="#enviar">Contratado</a> 
                                    <ul class="dl-submenu">
                                        <li><a href="#">Inserir contratado</a></li>
                                        <li><a href="#">Lista de contratados</a></li>
                                    </ul>
                                </li>    
                                <li><a href="#enviar">Anexar arquivos</a> </li>
                                <?php //criar um if para o módulo cinema ?>
                                <li><a href="#enviar">Módulo Cinema</a> 
    
                                    <ul class="dl-submenu">
                                        <li><a href="#">Inserir novo filme</a></li>
                                        <li><a href="#">Lista de filmes</a></li>
                                    </ul>
                                </li>
                                <li><a href="#enviar">Enviar</a> </li>
							</ul>
                            </li>
  							<li><a href="#lista">Carregar evento em aberto</a></li> 
                            <li><a href="#lista">Pedidos enviados</a>   

    
                                    <ul class="dl-submenu">
                                        <li><a href="#">Relatório de alterações</a></li>
                                        <li><a href="#">Enviar alteraçãos</a></li>
                                        <li><a href="#">Enviar anexo</a></li>
                                    </ul>
                                </li>                      
                        </ul>
					</div><!-- /dl-menuwrapper -->
	</div>	
 	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Pedidos enviados</h2>
					<h5>Selecione para saber detalhes do pedido.</h5>
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

<? break;
case "basica";

if(isset($_POST['carregar'])){
	$_SESSION['idEvento'] = $_POST['carregar'];
}

// Insere um novo evento em branco
if(isset($_GET["inserir"])){
	iniciaFormulario($_SESSION['idUsuario']);
}

// Atualiza o banco com as informações do post
if(isset($_POST['atualizar'])){

		
	// Atualiza o banco
	$ig_modalidade_IdModalidade = $_POST['ig_modalidade_IdModalidade'];
	$projetoEspecial = $_POST['projetoEspecial']; 
	$nomeEvento = $_POST['nomeEvento'];
	$projeto = $_POST['projeto'];
	$ig_tipo_evento_idTipoEvento = $_POST['ig_tipo_evento_idTipoEvento'];
	$idResponsavel = $_POST['nomeResponsavel'];
	$idSuplente = $_POST['suplente'];
	if(isset($_POST['subEvento'])){
		$subEvento = 1;	
	}else{
		$subEvento = 0;	
	}

	$sql_atualizar = "UPDATE `ig_evento` SET 
	`nomeEvento` = '$nomeEvento', 
	`projeto` = '$projeto', 
	`projetoEspecial` = '$projetoEspecial', 
	`idResponsavel` = '$idResponsavel', 
	`suplente` = '$idSuplente', 
	`ig_modalidade_IdModalidade` = 	'$ig_modalidade_IdModalidade',
	`ig_tipo_evento_idTipoEvento` = '$ig_tipo_evento_idTipoEvento',
	`subEvento` = '$subEvento',
	 `publicado` = 1
	WHERE `ig_evento`.`idEvento` = ".$_SESSION['idEvento'].";";

	/*
	$sql_atualizar = "UPDATE ig_evento SET
	ig_modalidade_IdModadlidade = '$ig_modalidade_IdModadlidade',
	projetoEspecial = '$projetoEspecial',
	nomeEvento = '$nomeEvento',
	projeto = '$projeto',
	ig_tipo_evento_idTipoEvento = '$ig_tipo_evento_idTipoEvento'
	WHERE idEvento = ".$_SESSION['idEvento'].";";
	*/
	
	if(mysql_query($sql_atualizar)){
		$mensagem = "Atualizado com sucesso!";
		gravarLog($sql_atualizar);	
	}else{
		$mensagem = "Erro ao atualizar... tente novamente";
	}
	
}

// Cria um array com dados do evento
$campo = recuperaEvento($_SESSION['idEvento']);
?>
<? include "../include/menuEvento.php" ?>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Apresentação Básica</h3>
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
            		<label>Nome do Evento *</label>
            		<input type="text" name="nomeEvento" class="form-control" id="inputSubject" value="<?php echo $campo['nomeEvento'] ?>"/>
            	</div> 
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
                	<label>Tipo de relação jurídica</label>
                	<select class="form-control" name="ig_modalidade_IdModalidade" id="inputSubject" >
                    <option value="1"></option>
					<?php echo geraOpcao("ig_modalidade",$campo['ig_modalidade_IdModalidade'],"") ?>
                    </select>
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
            		<input type="text" name="projeto" class="form-control" id=""  value="<? echo $campo['projeto'] ?>">
            	</div>
             </div>
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Tipo de Evento *</label>
            		<select class="form-control" name="ig_tipo_evento_idTipoEvento" id="inputSubject" >
						<option value="1"></option>
						<?php echo geraOpcao("ig_tipo_evento",$campo['ig_tipo_evento_idTipoEvento'],"") ?>
                    </select>					
            	</div>
            </div>
            <div class="form-group">
            <br />
       <p>O responsável e suplente devem estar cadastrado como usuários do sistema.</p>
	            <div class="col-md-offset-2 col-md-8">
    	        <label>Primeiro responsável</label>
					<select class="form-control" name="nomeResponsavel" id="inputSubject" >
					<option value="1"></option>	
					<?php echo opcaoUsuario($_SESSION['idInstituicao'],$campo['idResponsavel']) ?>
                    </select>	                
            	</div>
            </div>
        
            <div class="form-group">
	            <div class="col-md-offset-2 col-md-8">
    		        <label>Segundo responsável (Fiscal)</label>
						<select class="form-control" name="suplente" id="inputSubject" >
                        <option value="1"></option>
						<?php echo opcaoUsuario($_SESSION['idInstituicao'],$campo['suplente']) ?>
                        </select>	
        		  </div>
            </div>
                        <div class="form-group">
	            <div class="col-md-offset-2 col-md-8">
    		          <input type="checkbox" name="subEvento" id="subEvento" <?php checar($campo['subEvento']) ?>/><label style="padding:0 10px 0 5px;"> Haverá um evento complementar (sub-evento)?</label>
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
case "detalhe" :

if(isset($_POST['atualizar'])){

		
	// Atualiza o banco
	$autor = addslashes($_POST['autor']);
	$fichaTecnica = addslashes($_POST['fichaTecnica']); 
	$faixaEtaria = $_POST['faixaEtaria'];
	$sql_inserir = "INSERT INTO ";

	$sql_atualizar = "UPDATE `ig_evento` SET 
	`autor` = '$autor', 
	`fichaTecnica` = '$fichaTecnica', 
	`faixaEtaria` = '$faixaEtaria' 
	WHERE `ig_evento`.`idEvento` = ".$_SESSION['idEvento'].";";



	if(mysql_query($sql_atualizar)){
		$mensagem = "Atualizado com sucesso!";
		gravarLog($sql_atualizar);	
	}else{
		$mensagem = "Erro ao atualizar... tente novamente";
		
	}

}
$campo = recuperaEvento($_SESSION['idEvento']); //carrega os dados do evento em questão
?>
<? include "../include/menuEvento.php" ?>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Detalhamento</h3>
                    <h1><?php echo $campo["nomeEvento"] ?> </h1>
                    <h4><?php if(isset($mensagem)){echo $mensagem;} ?></h4>
                </div>
            </div>
    </div>
    
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
        <form method="POST" action="?perfil=evento&p=detalhe" class="form-horizontal" role="form">
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Autor*</label>
            		<textarea name="autor" class="form-control" rows="10" placeholder="artista, banda, coletivo, companhia, palestrantes, etc"><?php echo $campo["autor"] ?></textarea>
            	</div> 
            </div>
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Ficha técnica completa*</label>
            		<textarea name="fichaTecnica" class="form-control" rows="10" placeholder="elenco, técnicos, programa do concerto, outros profissionais envolvidos."><?php echo $campo["fichaTecnica"] ?></textarea>
            	</div> 
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
            	<label>Classificação/indicação etária</label>
            	<select class="form-control" name="faixaEtaria" id="inputSubject" >
					<option value="0"></option>
					<?php echo geraOpcao("ig_etaria",$campo['faixaEtaria'],"") ?>
                </select>
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
case "ocorrencias" :

if(isset($_POST['dataInicio'])){ //carrega as variaveis vindas do POST
	
	$dataInicio = $_POST['dataInicio'];
	$dataFinal = $_POST['dataFinal'];
	if(($dataFinal == "") OR ($dataFinal == '0000-00-00')) {
		$tipoOcorrencia = 3; // Tipo de Ocorrência data única
	}else{
		$tipoOcorrencia = 4; // Tipo de Ocorrência por temporada
	}
	
	if(isset($_POST['subEvento'])){ //Tipo de Ocorrência de Sub-evento
		$tipoOcorrencia = 6;	
	}
	
	$ig_comunicao_idCom = 0;


	if(isset($_POST['segunda'])){
		$segunda = 1;
	}else{
		$segunda = 0;
	}
			
	if(isset($_POST['terca'])){
		$terca = 1;
	}else{
		$terca = 0;
	}
	
	if(isset($_POST['quarta'])){
		$quarta = 1;
	}else{
		$quarta = 0;
	}
	
	if(isset($_POST['quinta'])){
		$quinta = 1;
	}else{
		$quinta = 0;
	}
	
	if(isset($_POST['sexta'])){
		$sexta = 1;
	}else{
		$sexta = 0;
	}
	
	if(isset($_POST['sabado'])){
		$sabado = 1;
	}else{
		$sabado = 0;
	}
	
	if(isset($_POST['domingo'])){
		$domingo = 1;
	}else{
		$domingo = 0;
	}


	if(isset($_POST['libras'])){
		$libras = 1;
	}else{
		$libras = 0;
	}

	if(isset($_POST['audiodescricao'])){
		$audiodescricao = 1;
	}else{
		$audiodescricao = 0;
	}

	if(isset($_POST['diaEspecial'])){
		$diaEspecial = 1;
	}else{
		$diaEspecial = 0;
	}

	if(isset($_POST['precoPopular'])){
		$precoPopular = 1;
	}else{
		$precoPopular = 0;
	}
	
	if(isset($_POST['duracao'])){
		$duracao = $_POST['duracao'];
	}else{
		$duracao = 0;
	}

	
	$hora = $_POST['hora'];
	$horaInicio = $hora.":00"; //completa os segundos
	$valorIngresso = $_POST['valorIngresso'];
	$horaFinal = "00:00:00";
	$timezone = -3;
	$diaInteiro = 0;
	$localOutros = "";
	$lotacao = $_POST['ingressosDisponiveis'];
	$reservados = $_POST['ingressosReservados'];
	$retiradaIngresso = $_POST['retiradaIngresso'];
	$instituicao = $_POST['instituicao'];
	$local = $_POST['local'];
	$frequencia = 0;
	$idEvento = $_SESSION['idEvento'];
	$publicado = 1;

}

if(isset($_POST['inserir'])){
	$sql_inserir = "INSERT INTO `ig_ocorrencia` (`idOcorrencia`, `idTipoOcorrencia`, `ig_comunicao_idCom`, `local`, `idEvento`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`, `domingo`, `dataInicio`, `dataFinal`, `horaInicio`, `horaFinal`, `timezone`, `diaInteiro`, `diaEspecial`, `libras`, `audiodescricao`, `valorIngresso`, `retiradaIngresso`, `localOutros`, `lotacao`, `reservados`, `duracao`, `precoPopular`, `frequencia`, `publicado`) VALUES (NULL, '$tipoOcorrencia', NULL, '$local', '$idEvento', '$segunda', '$terca', '$quarta', '$quinta', '$sexta', '$sabado', '$domingo', '$dataInicio', '$dataFinal', '$horaInicio', '$horaFinal', '$timezone', '$diaInteiro', '$diaEspecial', '$libras', '$audiodescricao', '$valorIngresso', '$retiradaIngresso', '$localOutros', '$lotacao', '$reservados', '$duracao', '$precoPopular', '$frequencia', '$publicado');";

	if(mysql_query($sql_inserir)){
		$mensagem = "Ocorrência inserida com sucesso!";	
		gravarLog($sql_inserir);	
	}else{
		$mensagem = "Erro ao inserir. Tente novamente.";
	}


}
if(isset($_POST['atualizar'])){
	$idOc = $_POST['atualizar'];
	$sql_atualizar_ocorrencia = "UPDATE ig_ocorrencia SET
`idTipoOcorrencia` = '$tipoOcorrencia',
   `local` = '$local' ,
	 `segunda` = '$segunda',
	  `terca` = '$terca',
	   `quarta` = '$quarta',
	    `quinta` = '$quinta',
		 `sexta` = '$sexta',
		  `sabado` = '$sabado',
		   `domingo` = '$domingo',
		    `dataInicio` = '$dataInicio',
			 `dataFinal` = '$dataFinal',
			  `horaInicio` = '$horaInicio',
			   `diaEspecial` = '$diaEspecial',
				   `libras` = '$libras',
				    `audiodescricao` = '$audiodescricao',
					 `valorIngresso` = '$valorIngresso',
					  `retiradaIngresso` = '$retiradaIngresso',
					   `localOutros` = '$localOutros',
					    `lotacao` = '$lotacao',
						 `reservados` = '$reservados',
						  `duracao` = '$duracao',
						   `precoPopular` = '$precoPopular'

							 WHERE 	`idOcorrencia` = '$idOc'";
	
	if(mysql_query($sql_atualizar_ocorrencia)){
		$mensagem = "Ocorrência atualizada com sucesso!";	
		gravarLog($sql_atualizar_ocorrencia);	
	}else{
		$mensagem = "Erro ao atualizar. Tente novamente.";
	}	
	


}

if(isset($_POST['duplicar'])){
	$idOc = $_POST['duplicar'];
	$sql_duplicar_ocorrencia = "INSERT INTO ig_ocorrencia (`idTipoOcorrencia`, `ig_comunicao_idCom`, `local`, `idEvento`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`, `domingo`, `dataInicio`, `dataFinal`, `horaInicio`, `horaFinal`, `timezone`, `diaInteiro`, `diaEspecial`, `libras`, `audiodescricao`, `valorIngresso`, `retiradaIngresso`, `localOutros`, `lotacao`, `reservados`, `duracao`, `precoPopular`, `frequencia`, `publicado`) SELECT `idTipoOcorrencia`, `ig_comunicao_idCom`, `local`, `idEvento`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`, `domingo`, `dataInicio`, `dataFinal`, `horaInicio`, `horaFinal`, `timezone`, `diaInteiro`, `diaEspecial`, `libras`, `audiodescricao`, `valorIngresso`, `retiradaIngresso`, `localOutros`, `lotacao`, `reservados`, `duracao`, `precoPopular`, `frequencia`, `publicado` FROM ig_ocorrencia WHERE `idOcorrencia` = '$idOc'";


	if(mysql_query($sql_duplicar_ocorrencia)){
		$mensagem = "Ocorrência duplicada com sucesso!";	
		gravarLog($sql_duplicaragar_ocorrencia);	
	}else{
		$mensagem = "Erro ao duplicar. Tente novamente.";
	}

}

if(isset($_POST['apagar'])){
	$idOc = $_POST['apagar'];
	$sql_apagar_ocorrencia = "UPDATE ig_ocorrencia SET publicado = '0' WHERE idOcorrencia = $idOc";
	if(mysql_query($sql_apagar_ocorrencia)){
		$mensagem = "Ocorrência apagada com sucesso!";	
		gravarLog($sql_apagar_ocorrencia);	
	}else{
		$mensagem = "Erro ao atualizar. Tente novamente.";
	}

}

	

// Cria um array com dados do evento
$campo = recuperaEvento($_SESSION['idEvento']);
?>


<? include "../include/menuEvento.php" ?>
<? 
	$action = $_GET['action'];
	switch($action){
		case "inserir":
?>
<script type="application/javascript">
$(function(){
	$('#instituicao').change(function(){
		if( $(this).val() ) {
			$('#local').hide();
			$('.carregando').show();
			$.getJSON('local.ajax.php?instituicao=',{instituicao: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].idEspaco + '">' + j[i].espaco + '</option>';
				}	
				$('#local').html(options).show();
				$('.carregando').hide();
			});
		} else {
			$('#local').html('<option value="">-- Escolha uma instituição --</option>');
		}
	});
});
</script>
<script type="text/javascript">
$(document).ready(function (){
    validate();
    $('#datepicker02').change(validate);
});

function validate(){
    if ($('#datepicker02').val().length > 0) {
        $("#diasemana01").prop("disabled", false);
        $("#diasemana02").prop("disabled", false);
        $("#diasemana03").prop("disabled", false);
        $("#diasemana04").prop("disabled", false);
        $("#diasemana05").prop("disabled", false);
        $("#diasemana06").prop("disabled", false);
        $("#diasemana07").prop("disabled", false);
    }
    else {
        $("#diasemana01").prop("disabled", true);
        $("#diasemana02").prop("disabled", true);
        $("#diasemana03").prop("disabled", true);
        $("#diasemana04").prop("disabled", true);
        $("#diasemana05").prop("disabled", true);
        $("#diasemana06").prop("disabled", true);
        $("#diasemana07").prop("disabled", true);

    }
}
</script>

<script type="text/javascript">
function habilitar(){  
    if(document.getElementById('diaEspecial').checked){  
        document.getElementById('especial01').disabled = false;  
        document.getElementById('especial02').disabled = false;  
        document.getElementById('especial03').disabled = false;  
    } else {  
        document.getElementById('especial01').disabled = true;  
        document.getElementById('especial02').disabled = true;  
        document.getElementById('especial03').disabled = true;  

    }  
} 
</script>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Inserir ocorrências</h3>
                    <h1><?php echo $campo["nomeEvento"] ?> </h1>
                    <p><?php if(isset($mensagem)){echo $mensagem;} ?></p>
                </div>
            </div>
    	</div>
	
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
            <form method="POST" action="?perfil=evento&p=ocorrencias&action=listar" class="form-horizontal" role="form">
           
                            <div class="form-group">  
                                          	<div class="col-md-offset-2 col-md-6">
  <input type="checkbox" name="subEvento" id="subEvento" /><label style="padding:0 10px 0 5px;"> Ocorrência para sub-evento?</label>
                	</div>
                </div>
           
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
               			 <label>Data início *</label>
                		<input type="text" name="dataInicio" class="form-control" id="datepicker01" placeholder="">
               		 </div>
                	<div class=" col-md-6">
                		<label>Data encerramento</label>
                		<input type="text" name="dataFinal" class="form-control" id="datepicker02" onblur="validate()" placeholder="só preencha se for temporada">
               		</div>
                </div>
                <div class="form-group">
	                <div class="col-md-offset-2 col-md-8">
    		            <input type="checkbox" name="segunda" id="diasemana01" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Segunda</label>
           			    <input type="checkbox" name="terca" id="diasemana02" disabled="disabled"/><label  style="padding:0 10px 0 5px;"> Terça</label>
            		    <input type="checkbox" name="quarta" id="diasemana03" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Quarta</label>
            		    <input type="checkbox" name="quinta" id="diasemana04" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Quinta</label>
           				<input type="checkbox" name="sexta" id="diasemana05" disabled="disabled"/><label  style="padding:0 10px 0 5px;"> Sexta</label>
          		      	<input type="checkbox" name="sabado" id="diasemana06" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Sábado</label>
            		    <input type="checkbox" name="domingo" id="diasemana07" disabled="disabled"/><label  style="padding:0 10px 0 5px;"> Domingo</label>
                	</div>                     
                </div>
                <div class="form-group">
                    
           			
	            	<div class="col-md-offset-2 col-md-8">
                    <input type="checkbox" name="diaEspecial" id="diaEspecial" onclick="habilitar()"/><label  style="padding:0 20px 0 5px;">Dia especial?</label>
    		            <input type="checkbox" name="audiodescricao" id="especial01" disabled="disabled"/><label  style="padding:0 10px 0 5px;">Audiodescricão</label>
           			    <input type="checkbox" name="libras" id="especial02" disabled="disabled"/><label  style="padding:0 10px 0 5px;">Libras</label>
            		    <input type="checkbox" name="precoPopular" id="especial03" disabled="disabled"/><label  style="padding:0 10px 0 5px;">Preço popular</label>
                	</div>                     
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-2">
                		<label>Horário de início</label>
                		<input type="text" name="hora" class="form-control"id="hora" placeholder="hh:mm"/>
                	</div> 
                	<div class="col-md-3">
                		<label>Valor ingresso *</label>
                		<input type="text" name="valorIngresso" class="form-control" id="valor" placeholder="em reais">
               		</div>
             	   <div class=" col-md-3">
                		<label>Duração *</label>
               			<input type="text" id="duracao" name="duracao" class="form-control" id="" placeholder="em minutos">
                	</div>
                </div>
                       
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
               		 <label>Sistema de retirada de ingressos</label>
               		 <select class="form-control" name="retiradaIngresso" id="inputSubject" >
               		 <option>Selecione</option>
					<?php geraOpcao("ig_retirada","","") ?>
                	</select>
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
                		<label>Local / instituição *</label><img src="images/loading.gif" class="loading" style="display:none" />
                		<select class="form-control" name="instituicao" id="instituicao" >
                		<option>Selecione</option>
                		<?php geraOpcao("ig_instituicao","","") ?>
                		</select>
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
               		 	<label>Sala / espaço (antes selecione a instituição)</label>
                		<select class="form-control" name="local" id="local" ></select>
                	</div>
                </div>	
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
                    	<label>Ingressos disponíveis</label>
                    	<input type="text" class="form-control" name="ingressosDisponiveis" id="" placeholder="">
                	</div>
               		<div class=" col-md-6">
                    	<label>Ingressos reservados</label>
                		<input type="text" class="form-control" name="ingressosReservados" id="" placeholder="">
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
                    	<input type="hidden" name="inserir" value="1"  />
                		<input type="submit" class="btn btn-theme btn-lg btn-block" value="Inserir ocorrência"  />
               		 </div>
                </div>
                </form>
                </div>
            </div>
        </div>
	</div>
</section>  

<?php
	break;
	case "listar":
?>
 

	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Eventos gravados mas não enviados</h2>
					<h4>Selecione o evento para carregar.</h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                 </div>
				  </div>
			  </div>  
			
			<div class="table-responsive list_info">
                         <?php listaOcorrencias($_SESSION['idEvento']); ?>
			</div>
		</div>
	</section>

<?php
	break;
	case "editar":
	$idOcorrencia = $_POST['id'];
	
	$ocor = recuperaDados("ig_ocorrencia",$idOcorrencia,"idOcorrencia");
?>
<script type="application/javascript">
$(function(){
	$('#instituicao').change(function(){
		if( $(this).val() ) {
			$('#local').hide();
			$('.carregando').show();
			$.getJSON('local.ajax.php?instituicao=',{instituicao: $(this).val(), ajax: 'true'}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].idEspaco + '">' + j[i].espaco + '</option>';
				}	
				$('#local').html(options).show();
				$('.carregando').hide();
			});
		} else {
			$('#local').html('<option value="">-- Escolha uma instituição --</option>');
		}
	});
});
</script>
<script type="text/javascript">
$(document).ready(function (){
    validate();
    $('#datepicker02').change(validate);
});

function validate(){
    if ($('#datepicker02').val().length > 0) {
        $("#diasemana01").prop("disabled", false);
        $("#diasemana02").prop("disabled", false);
        $("#diasemana03").prop("disabled", false);
        $("#diasemana04").prop("disabled", false);
        $("#diasemana05").prop("disabled", false);
        $("#diasemana06").prop("disabled", false);
        $("#diasemana07").prop("disabled", false);
    }
    else {
        $("#diasemana01").prop("disabled", true);
        $("#diasemana02").prop("disabled", true);
        $("#diasemana03").prop("disabled", true);
        $("#diasemana04").prop("disabled", true);
        $("#diasemana05").prop("disabled", true);
        $("#diasemana06").prop("disabled", true);
        $("#diasemana07").prop("disabled", true);

    }
}
</script>

<script type="text/javascript">
function habilitar(){  
    if(document.getElementById('diaEspecial').checked){  
        document.getElementById('especial01').disabled = false;  
        document.getElementById('especial02').disabled = false;  
        document.getElementById('especial03').disabled = false;  
    } else {  
        document.getElementById('especial01').disabled = true;  
        document.getElementById('especial02').disabled = true;  
        document.getElementById('especial03').disabled = true;  

    }  
} 
</script>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Inserir ocorrências</h3>
                    <h1><?php echo $campo["nomeEvento"] ?><? echo $idOcorrencia; ?></h1>
                    <p><?php if(isset($mensagem)){echo $mensagem;} ?></p>
                </div>
            </div>
    	</div>
	
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
            <form method="POST" action="?perfil=evento&p=ocorrencias&action=listar" class="form-horizontal" role="form">
             	<div class="form-group">  
                	<div class="col-md-offset-2 col-md-6">
  <input type="checkbox" name="subEvento" id="subEvento" <? if($ocor['idTipoOcorrencia'] == 6){ echo "checked"; } ?>/><label style="padding:0 10px 0 5px;"> Ocorrência para sub-evento?</label>
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
               			 <label>Data início *</label>
                		<input type="text" name="dataInicio" class="form-control" id="datepicker01" value="<? echo $ocor['dataInicio'] ?>" placeholder="">
               		 </div>
                	<div class=" col-md-6">
                		<label>Data encerramento</label>
                		<input type="text" name="dataFinal" class="form-control" id="datepicker02" onblur="validate()" value="<? echo $ocor['dataFinal'] ?>"placeholder="só preencha se for temporada">
               		</div>
                </div>
                <div class="form-group">
	                <div class="col-md-offset-2 col-md-8">
    		            <input type="checkbox" name="segunda" id="diasemana01" disabled="disabled" <?php checar($ocor['segunda']) ?> /><label style="padding:0 10px 0 5px;"> Segunda</label>
           			    <input type="checkbox" name="terca" id="diasemana02" disabled="disabled" <?php checar($ocor['terca']) ?>/><label  style="padding:0 10px 0 5px;"> Terça</label>
            		    <input type="checkbox" name="quarta" id="diasemana03" disabled="disabled" <?php checar($ocor['quarta']) ?>/><label style="padding:0 10px 0 5px;"> Quarta</label>
            		    <input type="checkbox" name="quinta" id="diasemana04" disabled="disabled" <?php checar($ocor['quinta']) ?> /><label style="padding:0 10px 0 5px;"> Quinta</label>
           				<input type="checkbox" name="sexta" id="diasemana05" disabled="disabled" <?php checar($ocor['sexta']) ?>/><label  style="padding:0 10px 0 5px;"> Sexta</label>
          		      	<input type="checkbox" name="sabado" id="diasemana06" disabled="disabled" <?php checar($ocor['sabado']) ?>/><label style="padding:0 10px 0 5px;"> Sábado</label>
            		    <input type="checkbox" name="domingo" id="diasemana07" disabled="disabled" <?php checar($ocor['domingo']) ?>/><label  style="padding:0 10px 0 5px;"> Domingo</label>
                	</div>                     
                </div>
                <div class="form-group">
                    
           			
	            	<div class="col-md-offset-2 col-md-8">
                    <input type="checkbox" name="diaEspecial" id="diaEspecial" onclick="habilitar()" <?php checar($ocor['diaEspecial']) ?>/><label  style="padding:0 20px 0 5px;">Dia especial?</label>
    		            <input type="checkbox" name="audiodescricao" id="especial01" disabled="disabled" <?php checar($ocor['audiodescricao']) ?>/><label  style="padding:0 10px 0 5px;">Audiodescricão</label>
           			    <input type="checkbox" name="libras" id="especial02" disabled="disabled" <?php checar($ocor['libras']) ?>/><label  style="padding:0 10px 0 5px;">Libras</label>
            		    <input type="checkbox" name="precoPopular" id="especial03" disabled="disabled" <?php checar($ocor['precoPopular']) ?>/><label  style="padding:0 10px 0 5px;">Preço popular</label>
                	</div>                     
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-2">
                		<label>Horário de início</label>
                		<input type="text" name="hora" class="form-control"id="hora" placeholder="hh:mm" value="<?php echo $ocor['horaInicio'] ?>"/>
                	</div> 
                	<div class="col-md-3">
                		<label>Valor ingresso *</label>
                		<input type="text" name="valorIngresso" class="form-control" id="valor" value="<?php echo $ocor['valorIngresso'] ?>" placeholder="em reais">
               		</div>
             	   <div class=" col-md-3">
                		<label>Duração *</label>
              			<input type="text" id="duracao" name="duracao" class="form-control" value="<?php echo $ocor['duracao'] ?>" placeholder="em minutos">
                	</div>
                </div>
                       
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
               		 <label>Sistema de retirada de ingressos</label>
               		 <select class="form-control" name="retiradaIngresso" id="inputSubject" >
               		 <option>Selecione</option>
					<?php geraOpcao("ig_retirada",$ocor['retiradaIngresso'],"") ?>
                	</select>
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
                		<label>Local / instituição *</label><img src="images/loading.gif" class="loading" style="display:none" />
                		<select class="form-control" name="instituicao" id="instituicao" >
                		<option>Selecione</option>
                		<?php 
						$inst = retornaInstituicao($ocor['local']);
						geraOpcao("ig_instituicao",$inst,"") 
						?>
                		</select>
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
               		 	<label>Sala / espaço (antes selecione a instituição)</label>
                		<select class="form-control" name="local" id="local" >
                        <? geraOpcao("ig_local",$ocor['local'],$inst); ?></select>
                	</div>
                </div>	
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
                    	<label>Ingressos disponíveis</label>
                    	<input type="text" class="form-control" name="ingressosDisponiveis" value="<?php echo $ocor['lotacao'] ?>" id="" placeholder="">
                	</div>
               		<div class=" col-md-6">
                    	<label>Ingressos reservados</label>
                		<input type="text" class="form-control" name="ingressosReservados" value="<?php echo $ocor['reservados'] ?>" id="" placeholder="">
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
                    	<input type="hidden" name="atualizar" value="<? echo $ocor['idOcorrencia']; ?>"  />
                		<input type="submit" class="btn btn-theme btn-lg btn-block" value="Atualizar ocorrência"  />
               		 </div>
                </div>
                </form>
                </div>
            </div>
        </div>
	</div>
</section>  

<?php
	break;
	case "inserirsub":
	
?>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Inserir ocorrências</h3>
                    <h1><?php echo $campo["nomeEvento"] ?> </h1>
                    <p><?php if(isset($mensagem)){echo $mensagem;} ?></p>
                </div>
            </div>
    	</div>
	
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
            <form method="POST" action="?perfil=evento&p=ocorrencias" class="form-horizontal" role="form">
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
               			 <label>Data início *</label>
                		<input type="text" name="dataInicio" class="form-control" id="datepicker01" placeholder="">
               		 </div>
                	<div class=" col-md-6">
                		<label>Data encerramento</label>
                		<input type="text" name="dataFinal" class="form-control" id="datepicker02" onblur="validate()" placeholder="só preencha se for temporada">
               		</div>
                </div>
                <div class="form-group">
	                <div class="col-md-offset-2 col-md-8">
    		            <input type="checkbox" name="segunda" id="diasemana01" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Segunda</label>
           			    <input type="checkbox" name="terca" id="diasemana02" disabled="disabled"/><label  style="padding:0 10px 0 5px;"> Terça</label>
            		    <input type="checkbox" name="quarta" id="diasemana03" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Quarta</label>
            		    <input type="checkbox" name="quinta" id="diasemana04" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Quinta</label>
           				<input type="checkbox" name="sexta" id="diasemana05" disabled="disabled"/><label  style="padding:0 10px 0 5px;"> Sexta</label>
          		      	<input type="checkbox" name="sabado" id="diasemana06" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Sábado</label>
            		    <input type="checkbox" name="domingo" id="diasemana07" disabled="disabled"/><label  style="padding:0 10px 0 5px;"> Domingo</label>
                	</div>                     
                </div>
                <div class="form-group">
                    
           			
	            	<div class="col-md-offset-2 col-md-8">
                    <input type="checkbox" name="diaEspecial" id="diaEspecial" onclick="habilitar()"/><label  style="padding:0 20px 0 5px;">Dia especial?</label>
    		            <input type="checkbox" name="audiodescricao" id="especial01" disabled="disabled"/><label  style="padding:0 10px 0 5px;">Audiodescricão</label>
           			    <input type="checkbox" name="libras" id="especial02" disabled="disabled"/><label  style="padding:0 10px 0 5px;">Libras</label>
            		    <input type="checkbox" name="precoPopular" id="especial03" disabled="disabled"/><label  style="padding:0 10px 0 5px;">Preço popular</label>
                	</div>                     
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-2">
                		<label>Horário de início</label>
                		<input type="text" name="hora" class="form-control"id="hora" placeholder="hh:mm"/>
                	</div> 
                	<div class="col-md-3">
                		<label>Valor ingresso *</label>
                		<input type="text" name="valorIngresso" class="form-control" id="valor" placeholder="em reais">
               		</div>
             	   <div class=" col-md-3">
                		<label>Duração *</label>
               			<input type="text" id="duracao" name="duracao" class="form-control" id="" placeholder="em minutos">
                	</div>
                </div>
                       
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
               		 <label>Sistema de retirada de ingressos</label>
               		 <select class="form-control" name="retiradaIngresso" id="inputSubject" >
               		 <option>Selecione</option>
					<?php geraOpcao("ig_retirada","","") ?>
                	</select>
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
                		<label>Local / instituição *</label><img src="images/loading.gif" class="loading" style="display:none" />
                		<select class="form-control" name="instituicao" id="instituicao" >
                		<option>Selecione</option>
                		<?php geraOpcao("ig_instituicao","","") ?>
                		</select>
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
               		 	<label>Sala / espaço (antes selecione a instituição)</label>
                		<select class="form-control" name="local" id="local" ></select>
                	</div>
                </div>	
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
                    	<label>Ingressos disponíveis</label>
                    	<input type="text" class="form-control" name="ingressosDisponiveis" id="" placeholder="">
                	</div>
               		<div class=" col-md-6">
                    	<label>Ingressos reservados</label>
                		<input type="text" class="form-control" name="ingressosReservados" id="" placeholder="">
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
                    	<input type="hidden" name="inserir" value="1"  />
                		<input type="submit" class="btn btn-theme btn-lg btn-block" value="Inserir ocorrência"  />
               		 </div>
                </div>
                </form>
                </div>
            </div>
        </div>
	</div>
</section>  

<?php
	break; // fecha a switch action
	}
	?>


<?php 
break;
case "conteudo" :
if(isset($_POST['atualizar'])){

		
	// Atualiza o banco
	$sinopse = addslashes($_POST['sinopse']);
	$releaseCom = addslashes($_POST['releaseCom']); 
	$parecerArtistico = addslashes($_POST['parecerArtistico']); 
	$linksCom = addslashes($_POST['linksCom']); 

	$sql_atualizar = "UPDATE `ig_evento` SET 
	`sinopse` = '$sinopse', 
	`releaseCom` = '$releaseCom', 
	`parecerArtistico` = '$parecerArtistico', 
	`linksCom` = '$linksCom'
	WHERE `ig_evento`.`idEvento` = ".$_SESSION['idEvento'].";";


	if(mysql_query($sql_atualizar)){
		$mensagem = "Atualizado com sucesso!";
		gravarLog($sql_atualizar);	
	}else{
		$mensagem = "Erro ao atualizar... tente novamente";
		
	}

}
$campo = recuperaEvento($_SESSION['idEvento']); //carrega os dados do evento em questão


?>
<? include "../include/menuEvento.php" ?>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Conteúdo</h3>
                    <h1><?php echo $campo["nomeEvento"] ?></h1>
                    <h4><?php if(isset($mensagem)){echo $mensagem;} ?></h4>
                </div>
            </div>
    </div>
    
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
        <form method="POST" action="?perfil=evento&p=conteudo" class="form-horizontal" role="form">
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Sinopse *</label>
            		<textarea name="sinopse" class="form-control" rows="10" placeholder="Texto para divulgação e sob editoria da area de comunicação. Não ultrapassar 400 caracteres."><?php echo $campo["sinopse"] ?></textarea>
            	</div> 
            </div>
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Release *</label>
            		<textarea name="releaseCom" class="form-control" rows="10" placeholder="Texto auxiliar para as ações de comunicação. Releases do trabalho, pequenas biografias, currículos, etc"><?php echo $campo["releaseCom"] ?></textarea>
            	</div> 
            </div>
      		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Parecer artístico*</label>
            		<textarea name="parecerArtistico" class="form-control" rows="10" placeholder="Texto usado fins jurídicos e confecção de contratos."><?php echo $campo["parecerArtistico"] ?></textarea>
            	</div> 
            </div>
      		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Links *</label>
            		<textarea name="linksCom" class="form-control" rows="10" placeholder="Links para auxiliar a divulgação e o jurídico. Site oficinal, vídeos, clipping, artigos, etc "><?php echo $campo["linksCom"] ?></textarea>
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
case "internos" :

if(isset($_POST['atualizar'])){
	//gera as variáveis

	$ig_produtor_nome = $_POST['ig_produtor_nome'];
	$ig_produtor_telefone = $_POST['ig_produtor_telefone'];
	$ig_produtor_email = $_POST['ig_produtor_email'];
	$ig_producao_equipe = addslashes($_POST['ig_producao_equipe']);		
	$ig_producao_infraestrutura = addslashes($_POST['ig_producao_infraestrutura']);

	if(isset($_POST['ig_comunicacao_registroFotografia'])){
		$ig_comunicacao_registroFotografia = 1;
	}else{
		$ig_comunicacao_registroFotografia = 0;
	}
	
	if(isset($_POST['ig_comunicacao_registroVideo'])){
		$ig_comunicacao_registroVideo = 1;
	}else{
		$ig_comunicacao_registroVideo = 0;
	}

	if(isset($_POST['ig_comunicacao_registroAudio'])){
		$ig_comunicacao_registroAudio = 1;
	}else{
		$ig_comunicacao_registroAudio = 0;
	}
	$idEvento = $_SESSION['idEvento'];
	
	//Produtor
	
	//verifica se há produtor
	$ver = recuperaEvento($_SESSION['idEvento']);
	if($ver['ig_produtor_idProdutor'] == 0){
	
		$sql_inserir_produtor = "INSERT INTO  `ig_produtor` (`idProdutor` ,`nome` ,`email` ,`telefone` ,`idSpCultura`
) VALUES ( NULL ,  '$ig_produtor_nome',  '$ig_produtor_email',  '$ig_produtor_telefone',  '' )";

		if(mysql_query($sql_inserir_produtor)){		
			$mensagem = "Produtor inserido com sucesso! ";	
			$idProdutor = mysql_insert_id(); //recupera o idProdutor inserido
			mysql_query("UPDATE ig_evento SET ig_produtor_idProdutor = '$idProdutor' WHERE idEvento = $idEvento");
			gravarLog($sql_inserir_produtor); //grava log
		}else{
			$mensagem = "Erro ao atualizar!";
		}
	}else{
		$sql_atualizar_produtor = "UPDATE ig_produtor SET `nome` = '$ig_produtor_nome' ,`email` = '$ig_produtor_email' ,`telefone` = '$ig_produtor_telefone' WHERE idProdutor = ".$ver['ig_produtor_idProdutor'];
		if(mysql_query($sql_atualizar_produtor)){		
			$mensagem = "Produtor inserido com sucesso! ";	
			gravarLog($sql_atualizar_produtor); //grava log
		}else{
			$mensagem = "Erro ao atualizar!";
		}
			
	}
	
	//Produção
	//Verifica se já existe o registro na tabela
	$ver = verificaExiste("ig_producao","ig_evento_idEvento",$_SESSION['idEvento'],0);
	if($ver['numero'] == 0){
		$idEvento = $_SESSION['idEvento'];
		$sql_inserir_producao = "INSERT INTO  `ig_producao` (`idProducao` ,`ig_evento_idEvento` ,`carros` ,`equipe` ,`infraestrutura`, `registroAudio`, `registroVideo`, `registroFotografia` ) VALUES ( NULL ,  '$idEvento',  '',  '$ig_producao_equipe',  '$ig_producao_infraestrutura', '$ig_comunicacao_registroAudio', '$ig_comunicacao_registroVideo', '$ig_comunicacao_registroFotografia' )";
		if(mysql_query($sql_inserir_producao)){		
			$mensagem02 = "Informações de produção inseridas com sucesso! ";	
			gravarLog($sql_inserir_producao); //grava log
		}else{
			$mensagem02 = "Erro ao atualizar!";
		}
	}else{
		$sql_atualizar_producao = "UPDATE ig_producao SET  `equipe` = '$ig_producao_equipe' ,`infraestrutura` = '$ig_producao_infraestrutura', `registroAudio` = '$ig_comunicacao_registroAudio', `registroVideo` = '$ig_comunicacao_registroVideo' , `registroFotografia` = '$ig_comunicacao_registroFotografia' WHERE 
`ig_evento_idEvento` = $idEvento";
		if(mysql_query($sql_atualizar_producao)){		
			$mensagem02 = "Informações de produção inseridas com sucesso! ";	
			gravarLog($sql_atualizar_producao); //grava log
		}else{
			$mensagem02 = "Erro ao atualizar!";
		}
	}
}



$campo = recuperaEvento($_SESSION['idEvento']); //carrega os dados do evento em questão
$interno = recuperaDados("ig_servico",$_SESSION['idEvento'],"ig_evento_idEvento"); // recupera os dados dos serviços internos do evento em questão
$com = recuperaDados("ig_comunicaco",$_SESSION['idEvento'],"ig_evento_idEvento"); // recupera os dados de comunicação do evento em questão
$produtor = recuperaProdutor($campo['ig_produtor_idProdutor']); // recupera dados do produtor
$producao = recuperaDados("ig_producao",$campo['idEvento'],"ig_evento_idEvento"); // recupera dados da produção
?>
<? include "../include/menuEvento.php" ?>

<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Serviços internos</h3>
                    <h1><?php echo $campo["nomeEvento"] ?></h1>
                    <h4><?php if(isset($mensagem)){echo $mensagem;} ?></h4>
                    <h4><?php if(isset($mensagem02)){echo $mensagem02;} ?></h4>
                </div>
            </div>
    </div>
    
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
        <form method="POST" action="?perfil=evento&p=internos" class="form-horizontal" role="form">
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Nome do produtor do evento</label>
            		<input type="text" name="ig_produtor_nome" class="form-control" id="ig_produtor_nome" value="<?php echo $produtor['nome'] ?>"/>
            	</div> 
            </div>
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Telefones</label>
            		<input type="text" name="ig_produtor_telefone" class="form-control" id="inputSubject" value="<?php echo $produtor['telefone'] ?>"/>
            	</div> 
            </div>       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Email</label>
            		<input type="text" name="ig_produtor_email" class="form-control" id="inputSubject" value="<?php echo $produtor['email'] ?>"/>
            	</div> 
            </div>            

       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Equipe</label>
            		<textarea name="ig_producao_equipe" class="form-control" rows="10" placeholder="Texto auxiliar para as ações de comunicação. Releases do trabalho, pequenas biografias, currículos, etc"><?php echo $producao["equipe"] ?></textarea>
            	</div> 
            </div>
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Infraestrutura</label>
            		<textarea name="ig_producao_infraestrutura" class="form-control" rows="10" placeholder="Texto auxiliar para as ações de comunicação. Releases do trabalho, pequenas biografias, currículos, etc"><?php echo $producao["infraestrutura"] ?></textarea>
            	</div> 
            </div>            
                <div class="form-group">
                    
           			<h5>Pedido de documentação</h5>
	            	<div class="col-md-offset-2 col-md-8">

    		            <input type="checkbox" name="ig_comunicacao_registroFotografia" id="especial01" <? checar($producao['registroFotografia']) ?> /><label  style="padding:0 10px 0 5px;">Fotografia</label>
           			    <input type="checkbox" name="ig_comunicacao_registroAudio" id="especial02" <? checar($producao['registroAudio']) ?>/><label  style="padding:0 10px 0 5px;">Áudio</label>
            		    <input type="checkbox" name="ig_comunicacao_registroVideo" id="especial03" <? checar($producao['registroVideo']) ?>/><label  style="padding:0 10px 0 5px;">Vídeo</label>
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
case "area" :
$campo = recuperaEvento($_SESSION['idEvento']); //carrega os dados do evento em questão
?>
<? include "../include/menuEvento.php" ?>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Espeficidades de Área</h3>
                    <h1><?php echo $campo["nomeEvento"] ?></h1>
                    <h4><?php if(isset($mensagem)){echo $mensagem;} ?></h4>
                </div>
            </div>
    </div>
    
    <div class="row">

        <div class="col-md-offset-1 col-md-10">
	       <form method="POST" action="?perfil=evento&p=area" class="form-horizontal" role="form">

<?php




if($campo['ig_tipo_evento_idTipoEvento'] == 2){ // Artes Visuais

	$idTabela = "ig_artes_visuais";
	$idCampo = "idEvento";
	$idDado = $_SESSION['idEvento'];
	$st = 0;
	
	if(isset($_POST['atualizar'])){
		
		$ig_artesvisuais_numero = $_POST['ig_artesvisuais_numero'];
		$ig_artesvisuais_tipo = $_POST['ig_artesvisuais_tipo'];
		$ig_artesvisuais_valorTotal = dinheiroDeBr($_POST['ig_artesvisuais_valorTotal']);
		//verifica se existe um registro na tabela
		$ver = verificaExiste($idTabela,$idCampo,$idDado,$st);
		
			if($ver['numero'] == 0){ // insere um registro novo
				$sql_insere_artes = "INSERT INTO  `ig_artes_visuais` (`idArtes` ,`idEvento` ,`numero` ,`tipo` ,`valorTotal`)VALUES (NULL ,  '$idDado',  '$ig_artesvisuais_numero',  '$ig_artesvisuais_tipo',  '$ig_artesvisuais_valorTotal');";
				if(mysql_query($sql_insere_artes)){		
					$mensagem = "Atualizado com sucesso! ";	
					gravarLog($sql_insere_artes); //grava log
				}else{
					$mensagem = "Erro ao atualizar!";
				}
			}else{ //atualiza o registro existente
				$sql_atualiza_artes = "UPDATE ig_artes_visuais SET numero = '$ig_artesvisuais_numero', tipo = '$ig_artesvisuais_tipo', valorTotal = '$ig_artesvisuais_valorTotal'";
				if(mysql_query($sql_atualiza_artes)){		
					$mensagem = "Atualizado com sucesso! ";	
					gravarLog($sql_atualiza_artes); //grava log
				}else{
					$mensagem = "Erro ao atualizar!";
				}
		}
}

$artes = recuperaDados($idTabela,$_SESSION['idEvento'],$idCampo);
?>
				<h3>Artes Visuais</h3>
                <h4><? if(isset($mensagem)){echo $mensagem;} ?><? echo $ver['numero'] ?></h4>

                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
                    	<label>Número de contratados</label>
                    	<input type="text" class="form-control" name="ig_artesvisuais_numero" value="<?php if(isset($artes)){echo $artes['numero'];} ?>" id="" placeholder="">
                	</div>
               		<div class=" col-md-6">
                    	<label>Tipo de contratação</label>
                		 <select class="form-control" name="ig_artesvisuais_tipo" id="inputSubject" >
                        <option value="Edital" <?php if(isset($artes)){if($artes['tipo'] == "Edital"){echo "selected";}} ?> >Edital</option>
                        <option value="Selecionado" <?php if(isset($artes)){if($artes['tipo'] == "Selecionado"){echo "selected";}} ?>>Selecionado</option>
                        <option value="Jurado" <?php if(isset($artes)){if($artes['tipo'] == "Jurado"){echo "selected";}} ?>>Jurado</option>
                        </select>
                	</div>
                </div>

       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Valor do cachê *</label>
            		<input type="text" name="ig_artesvisuais_valorTotal" class="form-control" id="valor" value="<?php if(isset($artes)){echo $artes['valorTotal'];} ?>"/>
            	</div> 
            </div>
<?
}else if(($campo['ig_tipo_evento_idTipoEvento'] == 3) OR // Teatro e Dança
		($campo['ig_tipo_evento_idTipoEvento'] == 7) OR
		($campo['ig_tipo_evento_idTipoEvento'] == 8) OR
		($campo['ig_tipo_evento_idTipoEvento'] == 14) OR
		($campo['ig_tipo_evento_idTipoEvento'] == 15) OR
		($campo['ig_tipo_evento_idTipoEvento'] == 16) OR
		($campo['ig_tipo_evento_idTipoEvento'] == 17))
{ 

	$idTabela = "ig_teatro_danca";
	$idCampo = "ig_evento_idEvento";
	$idDado = $_SESSION['idEvento'];
	$st = 0;
	
	if(isset($_POST['atualizar'])){
		
		$ig_teatro_danca_estreia = $_POST['ig_teatro_danca_estreia'];
		$ig_teatro_danca_genero = $_POST['ig_teatro_danca_genero'];
		
		//verifica se existe um registro na tabela
		$ver = verificaExiste($idTabela,$idCampo,$idDado,$st);
		
			if($ver['numero'] == 0){ // insere um registro novo
				$sql_insere_teatro = "INSERT INTO  `ig_teatro_danca` (`idTeatro` ,`ig_evento_idEvento` ,`estreia` ,`genero`)VALUES (NULL ,  '$idDado',  '$ig_teatro_danca_estreia',  '$ig_teatro_danca_genero');";
				if(mysql_query($sql_insere_teatro)){		
					$mensagem = "Atualizado com sucesso! ";	
					gravarLog($sql_insere_teatro); //grava log
				}else{
					$mensagem = "Erro ao atualizar!";
				}
			}else{ //atualiza o registro existente
				$sql_atualiza_teatro = "UPDATE ig_teatro_danca SET estreia = '$ig_teatro_danca_estreia', genero = '$ig_teatro_danca_genero' WHERE ig_evento_idEvento = $idDado";
				if(mysql_query($sql_atualiza_teatro)){		
					$mensagem = "Atualizado com sucesso! ";	
					gravarLog($sql_atualiza_teatro); //grava log
				}else{
					$mensagem = "Erro ao atualizar!";
				}
		}
}

$artes = recuperaDados($idTabela,$_SESSION['idEvento'],$idCampo);


?>
				<h3>Teatro / Dança</h3>
                <h4><? if(isset($mensagem)){echo $mensagem;} ?></h4>

                <div class="form-group">
                	<div class="col-md-offset-2 col-md-2">
                    	<label>Estréia?</label>
                		 <select class="form-control" name="ig_teatro_danca_estreia" id="inputSubject" >
                        <option value="1" <?php if(isset($artes)){if($artes['estreia'] == "1"){echo "selected";}} ?> >Sim</option>
                        <option value="0" <?php if(isset($artes)){if($artes['estreia'] == "0"){echo "selected";}} ?>>Não</option>
                        </select>
                	</div>
               		<div class=" col-md-6">
                    	<label>Gênero</label>
                    	<input type="text" class="form-control" name="ig_teatro_danca_genero" value="<?php if(isset($artes)){echo $artes['genero'];} ?>" id="" placeholder="">

                	</div>
                </div>

<?
}else if(($campo['ig_tipo_evento_idTipoEvento'] == 4) OR // Oficinas e Palestras
	($campo['ig_tipo_evento_idTipoEvento'] == 5))
{ 
?>
			<h1>Módulo do Siscontrat</h1>
<!--                <div class="form-group">
                	<div class="col-md-offset-2 col-md-2">
                		<label>Certificado</label>
                		<input type="text" name="hora" class="form-control"id="hora" placeholder="hh:mm"/>
                	</div> 
                	<div class="col-md-3">
                		<label>Vagas *</label>
                		<input type="text" name="valorIngresso" class="form-control" id="valor" placeholder="em reais">
               		</div>
             	   <div class=" col-md-3">
                		<label>Forma de inscrição *</label>
               			<input type="text" id="duracao" name="duracao" class="form-control" id="" placeholder="em minutos">
                	</div>
                </div>
                
                <div class="form-group">
                <h4>Período de Inscrição</h4>
                	<div class="col-md-offset-2 col-md-6">
               			 <label>Início</label>
                		<input type="text" name="dataInicio" class="form-control" id="datepicker01" placeholder="">
               		 </div>
                	<div class=" col-md-6">
                		<label>Encerramento</label>
                		<input type="text" name="dataFinal" class="form-control" id="datepicker02" placeholder="só preencha se for temporada">
               		</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
               			 <label>Resultado</label>
                		<input type="text" name="dataInicio" class="form-control" id="datepicker01" placeholder="">
               		 </div>
                	<div class=" col-md-6">
                		<label>Material requisitado</label>
                		<input type="text" name="dataFinal" class="form-control" id="datepicker02"  placeholder="só preencha se for temporada">
               		</div>
				</div>
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Público-alvo</label>
            		<textarea name="releaseCom" class="form-control" rows="10" placeholder="Texto auxiliar para as ações de comunicação. Releases do trabalho, pequenas biografias, currículos, etc"><?php echo $campo["releaseCom"] ?></textarea>
            	</div> 
            </div> 
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Formas de pagamento do oficineiro</label>
            		<textarea name="releaseCom" class="form-control" rows="10" placeholder="Texto auxiliar para as ações de comunicação. Releases do trabalho, pequenas biografias, currículos, etc"><?php echo $campo["releaseCom"] ?></textarea>
            	</div> 
            </div>                                
                <div class="form-group">
	                <div class="col-md-offset-2 col-md-8">
    		            <input type="checkbox" name="segunda" id="diasemana01" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Segunda</label>
           			    <input type="checkbox" name="terca" id="diasemana02" disabled="disabled"/><label  style="padding:0 10px 0 5px;"> Terça</label>
            		    <input type="checkbox" name="quarta" id="diasemana03" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Quarta</label>
            		    <input type="checkbox" name="quinta" id="diasemana04" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Quinta</label>
           				<input type="checkbox" name="sexta" id="diasemana05" disabled="disabled"/><label  style="padding:0 10px 0 5px;"> Sexta</label>
          		      	<input type="checkbox" name="sabado" id="diasemana06" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Sábado</label>
            		    <input type="checkbox" name="domingo" id="diasemana07" disabled="disabled"/><label  style="padding:0 10px 0 5px;"> Domingo</label>
                	</div>                     
                </div>
                <div class="form-group">
                    
           			
	            	<div class="col-md-offset-2 col-md-8">
                    <input type="checkbox" name="diaEspecial" id="diaEspecial" onclick="habilitar()"/><label  style="padding:0 20px 0 5px;">Dia especial?</label>
    		            <input type="checkbox" name="audiodescricao" id="especial01" disabled="disabled"/><label  style="padding:0 10px 0 5px;">Audiodescricão</label>
           			    <input type="checkbox" name="libras" id="especial02" disabled="disabled"/><label  style="padding:0 10px 0 5px;">Libras</label>
            		    <input type="checkbox" name="precoPopular" id="especial03" disabled="disabled"/><label  style="padding:0 10px 0 5px;">Preço popular</label>
                	</div>                     
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-2">
                		<label>Horário de início</label>
                		<input type="text" name="hora" class="form-control"id="hora" placeholder="hh:mm"/>
                	</div> 
                	<div class="col-md-3">
                		<label>Valor ingresso *</label>
                		<input type="text" name="valorIngresso" class="form-control" id="valor" placeholder="em reais">
               		</div>
             	   <div class=" col-md-3">
                		<label>Duração *</label>
               			<input type="text" id="duracao" name="duracao" class="form-control" id="" placeholder="em minutos">
                	</div>
                </div>
                       
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
               		 <label>Sistema de retirada de ingressos</label>
               		 <select class="form-control" name="retiradaIngresso" id="inputSubject" >
               		 <option>Selecione</option>
					<?php geraOpcao("ig_retirada","","") ?>
                	</select>
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
                		<label>Local / instituição *</label><img src="images/loading.gif" class="loading" style="display:none" />
                		<select class="form-control" name="instituicao" id="instituicao" >
                		<option>Selecione</option>
                		<?php geraOpcao("ig_instituicao","","") ?>
                		</select>
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
               		 	<label>Sala / espaço (antes selecione a instituição)</label>
                		<select class="form-control" name="local" id="local" ></select>
                	</div>
                </div>	
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
                    	<label>Ingressos disponíveis</label>
                    	<input type="text" class="form-control" name="ingressosDisponiveis" id="" placeholder="">
                	</div>
               		<div class=" col-md-6">
                    	<label>Ingressos reservados</label>
                		<input type="text" class="form-control" name="ingressosReservados" id="" placeholder="">
                	</div>
                </div>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
                    	<input type="hidden" name="inserir" value="1"  />
                		<input type="submit" class="btn btn-theme btn-lg btn-block" value="Inserir ocorrência"  />
               		 </div>
                </div>-->


<?
}else if(($campo['ig_tipo_evento_idTipoEvento'] == 11) OR // Música
		($campo['ig_tipo_evento_idTipoEvento'] == 12))
{ 

	$idTabela = "ig_musica";
	$idCampo = "ig_evento_idEvento";
	$idDado = $_SESSION['idEvento'];
	$st = 0;
	
	if(isset($_POST['atualizar'])){
		
		$ig_musica_genero = $_POST['ig_musica_genero'];
		$ig_musica_venda = $_POST['ig_musica_venda'];
		$ig_musica_material = addslashes($_POST['ig_musica_material']);
		//verifica se existe um registro na tabela
		$ver = verificaExiste($idTabela,$idCampo,$idDado,$st);
		
			if($ver['numero'] == 0){ // insere um registro novo
				$sql_insere_musica = "INSERT INTO  `ig_musica` (`idMusica` ,`ig_evento_idEvento` ,`genero` ,`venda` ,`material`)VALUES (NULL ,  '$idDado',  '$ig_musica_genero',  '$ig_musica_venda','$ig_musica_material');";
				if(mysql_query($sql_insere_musica)){		
					$mensagem = "Atualizado com sucesso! ";	
					gravarLog($sql_insere_musica); //grava log
				}else{
					$mensagem = "Erro ao atualizar(3)!";
				}
			}else{ //atualiza o registro existente
				$sql_atualiza_musica = "UPDATE ig_musica SET genero = '$ig_musica_genero', venda = '$ig_musica_venda', material = '$ig_musica_material' WHERE ig_evento_idEvento = $idDado";
				if(mysql_query($sql_atualiza_musica)){		
					$mensagem = "Atualizado com sucesso! ";	
					gravarLog($sql_atualiza_musica); //grava log
				}else{
					$mensagem = "Erro ao atualizar(4)!";
				}
		}
}

$artes = recuperaDados($idTabela,$_SESSION['idEvento'],$idCampo);



?>
				<h3>Música</h3>
                <h4><? if(isset($mensagem)){echo $mensagem;} ?></h4>
                <div class="form-group">
               		<div class="col-md-offset-2 col-md-6">
                    	<label>Gênero</label>
                    	<input type="text" class="form-control" name="ig_musica_genero" value="<?php if(isset($artes)){echo $artes['genero'];} ?>" id="" placeholder="Erudito, popular, rock, samba, experimental, etc">

                	</div>
                	<div class=" col-md-2">
                    	<label>Venda de material</label>
                		 <select class="form-control" name="ig_musica_venda" id="inputSubject" >
                        <option value="1" <?php if(isset($artes)){if($artes['venda'] == "1"){echo "selected";}} ?> >Sim</option>
                        <option value="0" <?php if(isset($artes)){if($artes['venda'] == "0"){echo "selected";}} ?>>Não</option>
                        </select>
                	</div>

                </div>
      		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Descrição o material</label>
            		<textarea name="ig_musica_material" class="form-control" rows="10" placeholder="Livro, camiseta, CD, DVD, etc"><?php echo $artes["material"] ?></textarea>
            	</div> 
            </div>                

<? } 
else if ($campo['ig_tipo_evento_idTipoEvento'] == 1){
	if(isset($_GET['filme'])){
		$filme = $_GET['filme'];
	}else{
		$filme = "listar";	
	}
	if($filme == 'listar'){		
		
		 ?>
         <h1>Listar filmes</h1>
         <?php 
	}else if($filme == 'inserir'){
		 ?>
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Inserir um filme</h3>
                    <h1><?php echo $campo["cinema"] ?></h1>
                    <h4><?php if(isset($mensagem)){echo $mensagem;} ?></h4>
                </div>
            </div>
             <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Título</label>
            		<input type="text" name="ig_cinema_titulo" class="form-control" id="ig_cinema_titulo" value=""/>
            	</div> 
            </div>
			 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Título Original</label>
            		<input type="text" name="ig_cinema_tituloOriginal" class="form-control" id="ig_cinema_tituloOriginal" value=""/>
            	</div> 
            </div>
            <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
               			 <label>País de origem</label>
                		<select class="form-control" name="ig_pais_idPais">
                		<option>Selecione</option>
                		<?php geraOpcao("ig_pais","","") ?>
                		</select>
               		 </div>
                	<div class=" col-md-6">
                		<label>País de origem (co-produção)</label>
                		<select class="form-control" name="ig_pais_idPais_2">
                		<option>Selecione</option>
                		<?php geraOpcao("ig_pais","","") ?>
                		</select>
               		</div>
             </div>
            <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
            		<label>Ano de Produção</label>
            		<input type="text" name="ig_cinema_anoProducao" class="form-control" id="ig_cinema_anoProducao" value=""/>
               		 </div>
                	<div class=" col-md-6">
            		<label>Bitola</label>
            		<input type="text" name="ig_cinema_bitola" class="form-control" id="ig_cinema_bitola" value=""/>
               		</div>
            </div>
            <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
            		<label>Gênero</label>
            		<input type="text" name="ig_cinema_genero" class="form-control" id="ig_cinema_genero" value=""/>
               		 </div>
                	<div class=" col-md-6">
            		<label>Minutagem</label>
            		<input type="text" name="ig_cinema_minutagem" class="form-control" id="ig_cinema_minutagem" value=""/>
               		</div>
            </div>
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Direção</label>
            		<textarea name="ig_cinema_direcao" class="form-control" rows="10" placeholder="Listagem de diretores do filme."></textarea>
            	</div> 
            </div>
			<div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Sinopse</label>
            		<textarea name="ig_cinema_sinopse" class="form-control" rows="10" placeholder="Texto para divulgação. Não ultrapassar 400 caracteres."></textarea>
            	</div> 
            </div>
			<div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Link do Trailer</label>
            		<input type="text" name="ig_cinema_linkTrailer" class="form-control" id="ig_cinema_linkTrailer" value="" placeholder="http://"/>
            	</div> 
			</div>
			<div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Elenco</label>
            		<textarea name="ig_cinema_elenco" class="form-control" rows="10" placeholder="Listagem de todos os componentes do elenco."></textarea>
            	</div> 
            </div>

         <?php 
	}else if($filme == 'editar'){
		 ?>
         
             <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Inserir um filme</h3>
                    <h1><?php echo $campo["cinema"] ?></h1>
                    <h4><?php if(isset($mensagem)){echo $mensagem;} ?></h4>
                </div>
            </div>
             <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Título</label>
            		<input type="text" name="ig_cinema_titulo" class="form-control" id="ig_cinema_titulo" value="<?php echo $sub['ig_cinema_titulo'] ?>"/>
            	</div> 
            </div>
			 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Título Original</label>
            		<input type="text" name="ig_cinema_tituloOriginal" class="form-control" id="ig_cinema_tituloOriginal" value="<?php echo $sub['ig_cinema_tituloOriginal'] ?>"/>
            	</div> 
            </div>
            <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
               			 <label>País de origem</label>
                		<select class="form-control" name="ig_pais_idPais">
                		<option>Selecione</option>
                		<?php geraOpcao("ig_pais","","") ?>
                		</select>
               		 </div>
                	<div class=" col-md-6">
                		<label>País de origem (co-produção)</label>
                		<select class="form-control" name="ig_pais_idPais_2">
                		<option>Selecione</option>
                		<?php geraOpcao("ig_pais","","") ?>
                		</select>
               		</div>
             </div>
            <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
            		<label>Ano de Produção</label>
            		<input type="text" name="ig_cinema_anoProducao" class="form-control" id="ig_cinema_anoProducao" value="<?php echo $sub['ig_cinema_anoProducao'] ?>"/>
               		 </div>
                	<div class=" col-md-6">
            		<label>Bitola</label>
            		<input type="text" name="ig_cinema_bitola" class="form-control" id="ig_cinema_bitola" value="<?php echo $sub['ig_cinema_bitola'] ?>"/>
               		</div>
            </div>
            <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
            		<label>Gênero</label>
            		<input type="text" name="ig_cinema_genero" class="form-control" id="ig_cinema_genero" value="<?php echo $sub['ig_cinema_genero'] ?>"/>
               		 </div>
                	<div class=" col-md-6">
            		<label>Minutagem</label>
            		<input type="text" name="ig_cinema_minutagem" class="form-control" id="ig_cinema_minutagem" value="<?php echo $sub['ig_cinema_minutagem'] ?>"/>
               		</div>
            </div>
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Direção</label>
            		<textarea name="ig_cinema_direcao" class="form-control" rows="10" placeholder="Listagem de diretores do filme."><?php echo $campo["ig_cinema_direcao"] ?></textarea>
            	</div> 
            </div>
			<div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Sinopse</label>
            		<textarea name="ig_cinema_sinopse" class="form-control" rows="10" placeholder="Texto para divulgação. Não ultrapassar 400 caracteres."><?php echo $campo["ig_cinema_sinopse"] ?></textarea>
            	</div> 
            </div>
			<div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Link do Trailer</label>
            		<input type="text" name="ig_cinema_linkTrailer" class="form-control" id="ig_cinema_linkTrailer" value="<?php echo $sub['ig_cinema_linkTrailer'] ?>"/>
            	</div> 
			</div>
			<div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Elenco</label>
            		<textarea name="ig_cinema_elenco" class="form-control" rows="10" placeholder="Listagem de todos os componentes do elenco."><?php echo $campo["ig_cinema_elenco"] ?></textarea>
            	</div> 
            </div>        
         <? } //fim da área de cinema ?>
         





	<?php
	
} // Fim das áreas 

?>

<?php
	if($campo['subEvento'] == 1){

	$idTabela = "ig_sub_evento";
	$idCampo = "ig_evento_idEvento";
	$idDado = $_SESSION['idEvento'];
	$st = 0;
	
	if(isset($_POST['atualizar'])){
		
		$ig_sub_evento_titulo = $_POST['ig_sub_evento_titulo'];
		$ig_sub_evento_idTipo = $_POST['ig_sub_evento_idTipo'];
		$ig_sub_evento_descricao = addslashes($_POST['ig_sub_evento_descricao']);
		//verifica se existe um registro na tabela
		$ver = verificaExiste($idTabela,$idCampo,$idDado,$st);
		
			if($ver['numero'] == 0){ // insere um registro novo
				$sql_insere_sub = "INSERT INTO  `ig_sub_evento` (`idSubEvento` ,`idTipo` ,`ig_evento_idEvento` , `titulo` ,`descricao`)VALUES (NULL ,    '$ig_sub_evento_idTipo', '$idDado', '$ig_sub_evento_titulo','$ig_sub_evento_descricao');";
				if(mysql_query($sql_insere_sub)){		
					$mensagem_s = "Atualizado com sucesso! ";	
					gravarLog($sql_insere_sub); //grava log
				}else{
					$mensagem_s = "Erro ao atualizar(1)!";
				}
			}else{ //atualiza o registro existente
				$sql_atualiza_sub = "UPDATE `ig_sub_evento` SET `idTipo` = '$ig_sub_evento_idTipo', `titulo` = '$ig_sub_evento_titulo', `descricao` = '$ig_sub_evento_descricao' WHERE ig_evento_idEvento = '$idDado'";
				if(mysql_query($sql_atualiza_sub)){		
					$mensagem_s = "Atualizado com sucesso! ";	
					gravarLog($sql_atualiza_sub); //grava log
				}else{
					$mensagem_s = "Erro ao atualizar(2)!";
				}
		}
}

$sub = recuperaDados($idTabela,$_SESSION['idEvento'],$idCampo);
?>


			<h3>Sub-evento</h3>
                            <h4><? if(isset($mensagem_s)){echo $mensagem_s;} ?></h4>
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Nome do Sub-evento</label>
            		<input type="text" name="ig_sub_evento_titulo" class="form-control" id="inputSubject" value="<?php echo $sub['titulo'] ?>"/>
            	</div> 
            </div>
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Tipo de Evento do Sub-evento</label>
            		<select class="form-control" name="ig_sub_evento_idTipo" id="inputSubject" >
						<option value="1"></option>
						<?php echo geraOpcao("ig_tipo_evento",$sub['idTipo'],"") ?>
                    </select>					
            	</div>
            </div>
      		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Descrição</label>
            		<textarea name="ig_sub_evento_descricao" class="form-control" rows="10" placeholder="Descreva a atividade complementar ao evento."><?php echo $sub["descricao"] ?></textarea>
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
<? 	} //fim do subevento ?>
</section>  

<?php 

break;
case "externos" :?>
<? include "../include/menuEvento.php" ?>

<?
	$idTabela = "ig_servico";
	$idCampo = "ig_evento_idEvento";
	$idDado = $_SESSION['idEvento'];
	$st = 0;
	
	if(isset($_POST['atualizar'])){
		
		//carrega as variáveis
	$ig_servico_legenda = $_POST['ig_servico_legenda'];
	$ig_servico_traducao = $_POST['ig_servico_traducao'];
	$ig_servico_seguro = $_POST['ig_servico_seguro'];
	$ig_servico_transporte = $_POST['ig_servico_transporte'];
	$ig_servico_montagem = $_POST['ig_servico_montagem'];
	$ig_servico_passagens = $_POST['ig_servico_passagens'];
	$ig_servico_itinerario = $_POST['ig_servico_itinerario'];
	$ig_servico_hospedagem = $_POST['ig_servico_hospedagem'];
	$ig_servico_locacao = $_POST['ig_servico_locacao'];
	$ig_servico_bilhetagem = $_POST['ig_servico_bilhetagem'];
		
	//verifica se existe um registro na tabela
	$ver = verificaExiste($idTabela,$idCampo,$idDado,$st);
		
	if($ver['numero'] == 0){ // insere um registro novo
		$sql_insere_ext = "INSERT INTO `ig_servico` (`idServico`, `ig_evento_idEvento`, `legenda`, `traducao`, `graficos`, `passagens`, `itinerario`, `libras`, `audiodescricao`, `montagem`, `hospedagem`, `seguro`, `transporte`, `razaoSocial`, `cpfCnpj`, `banco`, `agencia`, `conta`, `bilhetagem`, `locacao`) VALUES (NULL, '$idDado', '$ig_servico_legenda', '$ig_servico_traducao', NULL, '$ig_servico_passagens', '$ig_servico_itinerario', NULL, NULL, '$ig_servico_montagem', '$ig_servico_hospedagem', '$ig_servico_seguro', '$ig_servico_transporte', NULL, NULL, NULL, NULL, NULL, '$ig_servico_bilhetagem', '$ig_servico_locacao');";
				if(mysql_query($sql_insere_ext)){		
					$mensagem_s = "Atualizado com sucesso! ";	
					gravarLog($sql_insere_ext); //grava log
				}else{
					$mensagem_s = "Erro ao atualizar(1)!";
				}
			}else{ //atualiza o registro existente
				$sql_atualiza_ext = "UPDATE `ig_sub_evento` SET `legenda` = '$ig_servico_legenda', traducao` = '$ig_servico_traducao', `seguro` = '$ig_servico_seguro', `transporte` = '$ig_servico_transporte',`montagem` = '$ig_servico_montagem', `passagens`= '$ig_servico_passagens', `itinerario`= '$ig_servico_itinerario',`hospedagem` = '$ig_servico_hospedagem',`locacao` = '$ig_servico_locacao',`bilhetagem` = '$ig_servico_bilhetagem'  WHERE ig_evento_idEvento = '$idDado'";
				if(mysql_query($sql_atualiza_ext)){		
					$mensagem_s = "Atualizado com sucesso! ";	
					gravarLog($sql_atualiza_ext); //grava log
				}else{
					$mensagem_s = "Erro ao atualizar(2)!";
				}
		}
}

$externo = recuperaDados($idTabela,$_SESSION['idEvento'],$idCampo); 
$campo = recuperaEvento($_SESSION['idEvento']); //carrega os dados do evento em questão
?>

<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Previsão de demandas de serviços externos</h3>
                    <h1><?php echo $campo["nomeEvento"] ?>  </h1>
                    <h4><?php if(isset($mensagem_s)){echo $mensagem_s;} ?></h4>
                </div>
            </div>
    </div>
    
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
        <form method="POST" action="?perfil=evento&p=externos" class="form-horizontal" role="form">
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            	</div> 
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
             		<label>Legenda / legendagem *</label>
            		<input type="text" name="ig_servico_legenda" class="form-control" id="inputSubject" value="<?php echo $externo['legenda'] ?>"/>
                </div>
            </div>
            <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
            		<label>Tradução *</label>
            		<input type="text" name="ig_servico_traducao" class="form-control" id="inputSubject" value="<?php echo $externo['traducao'] ?>"/>
        	    </div>
      	    </div>

            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Seguro *</label>
            		<input type="text" name="ig_servico_seguro" class="form-control" id="inputSubject" value="<?php echo $externo['seguro'] ?>"/>
            	</div>
             </div>
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
              		<label>Transporte *</label>
            		<input type="text" name="ig_servico_transporte" class="form-control" id="inputSubject" value="<?php echo $externo['transporte'] ?>"/>
          	</div>
            </div>
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
              		<label>Montagem fina*</label>
            		<input type="text" name="ig_servico_montagem" class="form-control" id="inputSubject" value="<?php echo $externo['montagem'] ?>"/>
          	</div>
            </div>

            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
              		<label>Passagem aérea *</label>
            		<input type="text" name="ig_servico_passagens" class="form-control" id="inputSubject" value="<?php echo $externo['passagens'] ?>"/>
          	</div>
            </div>
      		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Descrição das passagens aéreas</label>
            		<textarea name="ig_servico_itinerario" class="form-control" rows="10" placeholder="Descreva as datas, locais de ida e volta para as passagens aéreas."><?php echo $externo["itinerario"] ?></textarea>
            	</div> 
            </div>

            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
              		<label>Hospedagem</label>
            		<input type="text" name="ig_servico_hospedagem" class="form-control" id="inputSubject" value="<?php echo $externo['hospedagem'] ?>"/>
          	</div>
            </div>
      		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Equipamentos para locação</label>
            		<textarea name="ig_servico_locacao" class="form-control" rows="10" placeholder="Descreva equipamentos para locação."><?php echo $externo["locacao"] ?></textarea>
            	</div> 
            </div>
            
           <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Bilhetagem</label>
            		<textarea name="ig_servico_bilhetagem" class="form-control" rows="10" placeholder="Ingresso rápido: Nome/Razão Social, CPF/CNPJ, Banco, Agência, Conta"><?php echo $externo["bilhetagem"] ?></textarea>
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
case "arquivos" :
if(isset($_POST['apagar'])){
	$idArquivo = $_POST['apagar'];
	$sql_apagar_arquivo = "UPDATE ig_arquivo SET publicado = 0 WHERE idArquivo = '$idArquivo'";
	if(mysql_query($sql_apagar_arquivo)){
		$arq = recuperaDados("ig_arquivo",$idArquivo,"idArquivo");
		$mensagem =	"Arquivo ".$arq['arquivo']."apagado com sucesso!";
		gravarLog($sql_apagar_arquivo);
	}else{
		$mensagem = "Erro ao apagar o arquivo. Tente novamente!";
	}
}
$campo = recuperaEvento($_SESSION['idEvento']); //carrega os dados do evento em questão
?>
<? include "../include/menuEvento.php" ?>

    
    	 <section id="enviar" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
                                        <h1><?php echo $campo["nomeEvento"] ?>  </h1>

					 <h3>Envio de Arquivos</h3>
<p>Nesta página, você envia os arquivos como o rider, mapas de cenas e luz, logos de parceiros, programação de filmes de mostras de cinema, etc. O tamanho máximo do arquivo deve ser 60MB.</p>
<p> Em caso de envio de fotografia, considerar as seguintes especificações técnicas:<br />
- formato: horizontal <br />
- tamanho: mínimo de 300dpi”</p>


<?php

if( isset( $_POST['enviar'] ) ) {

    $pathToSave = '../uploads/';

    // A variavel $_FILES é uma variável do PHP, e é ela a responsável
    // por tratar arquivos que sejam enviados em um formulário
    // Nesse caso agora, a nossa variável $_FILES é um array com 3 dimensoes
    // e teremos de trata-lo, para realizar o upload dos arquivos
    // Quando é definido o nome de um campo no form html, terminado por []
    // ele é tratado como se fosse um array, e por isso podemos ter varios
    // campos com o mesmo nome
    $i = 0;
    $msg = array( );
    $arquivos = array( array( ) );
    foreach(  $_FILES as $key=>$info ) {
        foreach( $info as $key=>$dados ) {
            for( $i = 0; $i < sizeof( $dados ); $i++ ) {
                // Aqui, transformamos o array $_FILES de:
                // $_FILES["arquivo"]["name"][0]
                // $_FILES["arquivo"]["name"][1]
                // $_FILES["arquivo"]["name"][2]
                // $_FILES["arquivo"]["name"][3]
                // para
                // $arquivo[0]["name"]
                // $arquivo[1]["name"]
                // $arquivo[2]["name"]
                // $arquivo[3]["name"]
                // Dessa forma, fica mais facil trabalharmos o array depois, para salvar
                // o arquivo
                $arquivos[$i][$key] = $info[$key][$i];
            }
        }
    }

    $i = 1;

    // Fazemos o upload normalmente, igual no exemplo anterior
    foreach( $arquivos as $file ) {

        // Verificar se o campo do arquivo foi preenchido
        if( $file['name'] != '' ) {
            $arquivoTmp = $file['tmp_name'];
            $arquivo = $pathToSave.$file['name'];
			$arquivo_base = $file['name'];
			if(file_exists($arquivo)){
				echo "O arquivo ".$arquivo_base." já existe! Renomeie e tente novamente<br />";
			}else{
				$idEvento = $_SESSION['idEvento'];
			include "../include/conecta_mysql.php";
			$sql = "INSERT INTO ig_arquivo (idArquivo , arquivo , ig_evento_idEvento, publicado) VALUES( NULL , '$arquivo_base' , '$idEvento', '1' );";
			mysql_query($sql);
			gravarLog($sql);
			
            if( !move_uploaded_file( $arquivoTmp, $arquivo ) ) {
                $msg[$i] = 'Erro no upload do arquivo '.$i;
            } else {
                $msg[$i] = sprintf('Upload do arquivo %s foi um sucesso!',$i);
            }
			}
       } 
        $i++;
    }

    // Imprimimos as mensagens geradas pelo sistema

 foreach( $msg as $e ) {
	 	echo " <div id = 'mensagem_upload'>";
        printf('%s<br>', $e);
		echo " </div>";
    }

}

?>

<br />
<div class = "center">
<form method='POST' action="?perfil=evento&p=arquivos" enctype='multipart/form-data'>
<p><input type='file' name='arquivo[]'></p>
<p><input type='file' name='arquivo[]'></p>
 <p><input type='file' name='arquivo[]'></p>
 <p><input type='file' name='arquivo[]'></p>
 <p><input type='file' name='arquivo[]'></p>
 <p><input type='file' name='arquivo[]'></p>
 <p><input type='file' name='arquivo[]'></p>
  <p><input type='file' name='arquivo[]'></p>
  <p><input type='file' name='arquivo[]'></p>
    <br>
    <input type="submit" class="btn btn-theme btn-lg btn-block" value='Enviar' name='enviar'>
</form>
</div>


					</div>
				  </div>
                  
			  </div>
			  
		</div>
	</section>

	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
 <h2>Arquivos anexados</h2>
<h5>Se na lista abaixo, o seu arquivo começar com "http://", por favor, clique, grave em seu computador, faça o upload novamente e apague a ocorrência citada.</h5>
					</div>
			<div class="table-responsive list_info">
                         <?php listaArquivos($_SESSION['idEvento']); ?>
			</div>
				  </div>
			  </div>  


		</div>
	</section>

<?php
break;
case "enviar" :
$campo = recuperaEvento($_SESSION['idEvento']); //carrega os dados do evento em questão
?>
<? include "../include/menuEvento.php" ?>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Finalizar e enviar o pedido</h3>
                    <h1><?php echo $campo["nomeEvento"] ?>  </h1>
                    <h4><?php if(isset($mensagem_s)){echo $mensagem_s;} ?></h4>
                </div>
            </div>

		</div>
        <div class="col-md-offset-2 col-md-8">
   			<div class="section-heading">
               <div class="left">
					 <h4>Descrição</h4>
					 <?php descricaoEvento($_SESSION['idEvento']);  ?>
				</div>
		</div>
		</div>
    </div>
</section>

<?php 
break;
} //fim da switch ?>

<?php }else{ //verificacao ?>

<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
	                <h1>Acesso negado.</h1>
	                <h2>Contacte o administração do sistema.</h2>
                </div>
            </div>
        </div>
	</div>
</section>                
<?php } ?>

