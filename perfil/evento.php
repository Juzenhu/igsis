<?php require "../funcoes/funcoesEvento.php"; //carrega as funções específicas ?>
<?php

// verifica se o usuário tem acesso a página
$verifica = verificaAcesso($_SESSION['idUsuario'],$_GET['perfil']); 
if($verifica == 1){
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
case "area" :
$campo = recuperaEvento($_SESSION['idEvento']); //carrega os dados do evento em questão
?>

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

