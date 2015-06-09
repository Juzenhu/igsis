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
	                <h2><? echo $verifica ?>Escolha uma opção</h2>
                </div>
            </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?perfil=evento&p=basica&inserir=novo" class="btn btn-theme btn-lg btn-block">Inserir um novo evento</a>
	            <a href="?p=basica"><button type="button" class="btn btn-theme btn-lg btn-block">Inserir um novo evento</button></a>
            </div>
          </div>
        </div>
    </div>
</section>    
 	

<? break;
case "basica";



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

	$sql_atualizar = "UPDATE `ig_evento` SET 
	`nomeEvento` = '$nomeEvento', 
	`projeto` = '$projeto', 
	`projetoEspecial` = '$projetoEspecial', 
	`idResponsavel` = '$idResponsavel', 
	`suplente` = '$idSuplente', 
	`ig_modalidade_IdModalidade` = 	'$ig_modalidade_IdModalidade',
	`ig_tipo_evento_idTipoEvento` = '$ig_tipo_evento_idTipoEvento' 
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
                    <h1><?php echo $campo["nomeEvento"] ?> - <?php echo $_SESSION['idEvento'];  ?></h1>
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
                    <h1><?php echo $campo["nomeEvento"] ?> - <?php echo $_SESSION['idEvento'];  ?></h1>
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
	
	$ig_comunicao_idCom = 0;


	if(isset($_POST['segunda'])){
		$segunda = $_POST['segunda'];
	}else{
		$segunda = 0;
	}
			
	if(isset($_POST['terca'])){
		$terca = $_POST['terca'];
	}else{
		$terca = 0;
	}
	
	if(isset($_POST['quarta'])){
		$quarta = $_POST['quarta'];
	}else{
		$quarta = 0;
	}
	
	if(isset($_POST['quinta'])){
		$quinta = $_POST['quinta'];
	}else{
		$quinta = 0;
	}
	
	if(isset($_POST['sexta'])){
		$sexta = $_POST['sexta'];
	}else{
		$sexta = 0;
	}
	
	if(isset($_POST['sabado'])){
		$sabado = $_POST['sabado'];
	}else{
		$sabado = 0;
	}
	
	if(isset($_POST['domingo'])){
		$domingo = $_POST['domingo'];
	}else{
		$domingo = 0;
	}


	if(isset($_POST['libras'])){
		$libras = $_POST['libras'];
	}else{
		$libras = 0;
	}

	if(isset($_POST['audiodescricao'])){
		$audiodescricao = $_POST['audiodescricao'];
	}else{
		$audiodescricao = 0;
	}

	if(isset($_POST['diaEspecial'])){
		$diaEspecial = $_POST['diaEspecial'];
	}else{
		$diaEspecial = 0;
	}

	if(isset($_POST['precoPopular'])){
		$precoPopular = $_POST['precoPopular'];
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
	$localOutros = 0;
	$lotacao = $_POST['ingressosDisponiveis'];
	$reservados = $_POST['ingressosReservados'];
	$retiradaIngresso = $_POST['retiradaIngresso'];
	$instituicao = $_POST['instituicao'];
	$local = $_POST['local'];
	$frequencia = 0;
	$idEvento = $_SESSION['idEvento'];

}

if(isset($_POST['inserir'])){
	$sql_inserir = "INSERT INTO `ig_ocorrencia` (`idOcorrencia`, `idTipoOcorrencia`, `ig_comunicao_idCom`, `local`, `idEvento`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`, `domingo`, `dataInicio`, `dataFinal`, `horaInicio`, `horaFinal`, `timezone`, `diaInteiro`, `diaEspecial`, `libras`, `audiodescricao`, `valorIngresso`, `retiradaIngresso`, `localOutros`, `lotacao`, `reservados`, `duracao`, `precoPopular`, `frequencia`) VALUES (NULL, '$tipoOcorrencia', NULL, '$local', '$idEvento', '$segunda', '$terca', '$quarta', '$quinta', '$sexta', '$sabado', '$domingo', '$dataInicio', '$dataFinal', '$horaInicio', '$horaFinal', '$timezone', '$diaInteiro', '$diaEspecial', '$libras', '$audiodescricao', '$valorIngresso', '$retiradaIngresso', '$localOutros', '$lotacao', '$reservados', '$duracao', '$precoPopular', '$frequencia');";

	if(mysql_query($sql_inserir)){
		$mensagem = "Ocorrência inserida com sucesso!";	
		gravarLog($sql_inserir);	
	}else{
		$mensagem = "Erro ao inserir. Tente novamente.";
	}


}
if(isset($_POST['duplicar'])){

}

if(isset($_POST['apagar'])){

}


// Cria um array com dados do evento
$campo = recuperaEvento($_SESSION['idEvento']);
?>
<? include "../include/menuEvento.php" ?>
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
<? include "../include/menuEvento.php" ?>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Ocorrências</h3>
                    <h1><?php echo $campo["nomeEvento"] ?> - <?php echo $_SESSION['idEvento'];  ?></h1>
                    <h4><?php if(isset($mensagem)){echo $mensagem;} ?></h4>
                </div>
            </div>
    </div>

	  		<div class="row">
            <div class="col-md-offset-2 col-md-8" style="background:#E5E5E5; padding:10px;">
            <div class="ocorrencia">
<p>Dia 23/04/05 - Quarta-feira</p>
<p>Horário: 20:00</p>
<p>Local: Sala Adoniran Barbosa</p>
<p>Ingresso: 10,00</p>
<p>Retirada de ingressos: </p>
<br />
<br />
<div class="col-md-offset-0 col-md-6">
<button type="button" class="btn btn-theme  btn-block">Apagar</button>
					</div>
				  
					<div class=" col-md-6">
                    <button type="button" class="btn btn-theme  btn-block">Editar</button>
					</div>
                    					<div class=" col-md-6">
                    <button type="button" class="btn btn-theme  btn-block">Duplicar</button>
					</div>

			</div>	


			</div>				
	  		</div>
			</div>

	  	</div>
	  </section> 

<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Inserir ocorrências</h3>
                    <h1><?php echo $campo["nomeEvento"] ?> - <?php echo $_SESSION['idEvento'];  ?></h1>
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
                    <h1><?php echo $campo["nomeEvento"] ?> - <?php echo $_SESSION['idEvento'];  ?></h1>
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
case "internos" :?>
<? include "../include/menuEvento.php" ?>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Serviços internos</h3>
                    <h1><?php echo $campo["nomeEvento"] ?> - <?php echo $_SESSION['idEvento'];  ?></h1>
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
                    <h1><?php echo $campo["nomeEvento"] ?> - <?php echo $_SESSION['idEvento'];  ?></h1>
                    <h4><?php if(isset($mensagem)){echo $mensagem;} ?></h4>
                </div>
            </div>
    </div>
    
    <div class="row">

        <div class="col-md-offset-1 col-md-10">
	       <form method="POST" action="?perfil=evento&p=basica" class="form-horizontal" role="form">

<?php



if(retornaArtesVisuais($_SESSION['idEvento'])){
$artes = retornaArtesVisuais($_SESSION['idEvento']);
}
if($campo['ig_tipo_evento_idTipoEvento'] == 2){ // Artes Visuais
?>
				<h3>Artes Visuais</h3>

                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
                    	<label>Número de contratados</label>
                    	<input type="text" class="form-control" name="ig_artes_visuais_numero" value="<?php if(isset($artes)){echo $artes['numero'];} ?>" id="" placeholder="">
                	</div>
               		<div class=" col-md-6">
                    	<label>Tipo de contratação</label>
                		<select name=type="text" class="form-control" name="ig_artes_visuais_tipo" id="" placeholder="">
                        <option value="Edital" <?php if(isset($artes)){if($artes['numero'] == "Edital"){echo "selected";}} ?> >Edital</option>
                        <option value="Selecionado" <?php if(isset($artes)){if($artes['numero'] == "Selecionado"){echo "selected";}} ?>>Selecionado</option>
                        <option value="Jurado" <?php if(isset($artes)){if($artes['numero'] == "Jurado"){echo "selected";}} ?>>Jurado</option>
                        </select>
                	</div>
                </div>

       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Valor do cachê *</label>
            		<input type="text" name="nomeEvento" class="form-control" id="ig_artes_visuais_valorTotal" value="<?php if(isset($artes)){echo $artes['valorTotal'];} ?>"/>
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
?>
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-2">
                    	<label>Estréia?</label>
                		<select name=type="text" class="form-control" name="ig_artes_visuais_tipo" id="" placeholder="">
                        <option value="1" <?php if(isset($artes)){if($artes['numero'] == "1"){echo "selected";}} ?> >Sim</option>
                        <option value="0" <?php if(isset($artes)){if($artes['numero'] == "0"){echo "selected";}} ?>>Não</option>
                        </select>
                	</div>
               		<div class=" col-md-6">
                    	<label>Gênero</label>
                    	<input type="text" class="form-control" name="ig_artes_visuais_numero" value="<?php if(isset($artes)){echo $artes['numero'];} ?>" id="" placeholder="">

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
?>

                <div class="form-group">
               		<div class="col-md-offset-2 col-md-6">
                    	<label>Gênero</label>
                    	<input type="text" class="form-control" name="ig_artes_visuais_numero" value="<?php if(isset($artes)){echo $artes['numero'];} ?>" id="" placeholder="Erudito, popular, rock, samba, experimental, etc">

                	</div>
                	<div class=" col-md-2">
                    	<label>Venda de material</label>
                		<select name=type="text" class="form-control" name="ig_artes_visuais_tipo" id="" placeholder="">
                        <option value="1" <?php if(isset($artes)){if($artes['numero'] == "1"){echo "selected";}} ?> >Sim</option>
                        <option value="0" <?php if(isset($artes)){if($artes['numero'] == "0"){echo "selected";}} ?>>Não</option>
                        </select>
                	</div>

                </div>

<? } // Fim das áreas ?>

			<h3>Sub-evento</h3>
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Nome do Sub-evento</label>
            		<input type="text" name="nomeEvento" class="form-control" id="inputSubject" value="<?php echo $campo['nomeEvento'] ?>"/>
            	</div> 
            </div>
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Tipo de Evento do Sub-evento</label>
            		<select class="form-control" name="ig_tipo_evento_idTipoEvento" id="inputSubject" >
						<option value="1"></option>
						<?php echo geraOpcao("ig_tipo_evento",$campo['ig_tipo_evento_idTipoEvento'],"") ?>
                    </select>					
            	</div>
            </div>
      		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Descrição</label>
            		<textarea name="parecerArtistico" class="form-control" rows="10" placeholder="Texto usado fins jurídicos e confecção de contratos."><?php echo $campo["parecerArtistico"] ?></textarea>
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
case "externos" :?>
<? include "../include/menuEvento.php" ?>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Evento - Previsão de demandas de serviços externos</h3>
                    <h1><?php echo $campo["nomeEvento"] ?> - <?php echo $_SESSION['idEvento'];  ?></h1>
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
case "arquivos" :?>
<? include "../include/menuEvento.php" ?>

    
    	 <section id="enviar" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Envio de Arquivos</h2>
<p>Nesta página, você envia os arquivos como o rider, mapas de cenas e luz, logos de parceiros, programação de filmes de mostras de cinema, etc. O tamanho máximo do arquivo deve ser 60MB.</p>
<p> Em caso de envio de fotografia, considerar as seguintes especificações técnicas:<br />
- formato: horizontal <br />
- tamanho: mínimo de 300dpi”</p>


<?php

if( isset( $_POST['enviar'] ) ) {

    $pathToSave = 'uploads/';

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
			include "include/conecta_mysql.php";
			$sql = "INSERT INTO ig_arquivos (id_arquivos , nome , evento_id) VALUES( NULL , '$arquivo_base' , '$id_evento' );";
			mysql_query($sql);
			
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
    <input type='submit' value='Enviar' name='enviar'>
</form>
</div>


					</div>
				  </div>
			  </div>
			  
		</div>
	</section>

	 <section id="lista" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Arquivos anexados</h2>
<p>Se na lista abaixo, o seu arquivo começar com "http://", por favor, clique, grave em seu computador, faça o upload novamente e apague a ocorrência citada.</p>
    
   <?
if(isset($_POST['apagar'])){
//página 01
$id_arquivo = $_POST["id_arquivo"];
// query para atualizar dados  os dados da página 1 a 3
$ssql = "UPDATE  `ig_arquivos` SET  `evento_id` =  'NULL' WHERE  `ig_arquivos`.`id_arquivos` = '$id_arquivo';";
 
// executa a query
if(mysql_query($ssql)){
	echo "<span class='alerta'>Arquivo deletado!</span>";
	}

}
?> 
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

