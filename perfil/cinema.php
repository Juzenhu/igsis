
<?php
if($_SESSION['cinema'] == 1){ // Se for uma mostra de cinema, executa o módulo.
$evento = recuperaDados("ig_evento",$_SESSION['idEvento'],"idEvento");

if(isset($_GET['p'])){
	$p = $_GET['p'];
}else{
	$p = "inicio";
}
$con = bancoMysqli();
?>

<?php
switch($p){

case "inicio":
unset($_SESSION['idCinema']);

?>
<?php include "../include/menuCinema.php"; ?>
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
	            <a href="?perfil=cinema&p=listar" class="btn btn-theme btn-lg btn-block">Listar filmes</a>
            </div>
          </div>
        </div>
    </div>
</section> 

<?php 
break;
case "inserir":
?>
<?php include "../include/menuCinema.php"; ?>
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

if(isset($_POST['idCinema'])){ // Carrega dados sobre o filme a editar
	$filme = recuperaDados($_POST['idCinema']);
}

if(isset($_POST['inserirFilme'])){ //Insere um filme
	$pais1 = $_POST['pais1'];
	$idEvento = $_SESSION['idEvento'];
	$titulo = $_POST['titulo'];
	$tituloOriginal = $_POST['tituloOriginal'];
	$anoProducao = $_POST['ano'];
	$genero = $_POST['genero'];
	$bitola = $_POST['bitola'];
	$direcao = $_POST['direcao'];
	$sinopse = $_POST['sinopse'];
	$minutagem = $_POST['minutagem'];
	$linkTrailer = $_POST['link'];
	$elenco = $_POST['elenco'];
	$pais2 = $_POST['pais2'];
	$classificao = $_POST['classificacao'];

	$sql_inserir_filme = "INSERT INTO `ig_cinema` (`idCinema`, `ig_pais_idPais`, `ig_evento_idEvento`, `titulo`, `tituloOriginal`, `anoProducao`, `genero`, `bitola`, `direcao`, `sinopse`, `minutagem`, `linkTrailer`, `elenco`, `ig_pais_IdPais_2`, `publicado`, `indicacaoEtaria`) VALUES (NULL, '$pais1', '$idEvento', '$titulo', '$tituloOriginal', '$anoProducao', '$genero', '$bitola', '$direcao', '$sinopse', '$minutagem', '$linkTrailer', '$elenco','$pais2','1', '$classificao')";
	if(mysqli_query($con,$sql_inserir_filme)){
		$mensagem = "Filme inserido com sucesso";
		$ultimo = recuperaUltimo("ig_cinema");
			
	}else{
		$mensagem = "Erro ao inserir. Tente novamente.";
	}

$filme = recuperaDados("ig_cinema",$ultimo,"idCinema");

}



if(isset($_POST['editarFilme'])){ //Atualiza um filme

	$pais1 = $_POST['pais1'];
	$idEvento = $_SESSION['idEvento'];
	$titulo = $_POST['titulo'];
	$tituloOriginal = $_POST['tituloOriginal'];
	$anoProducao = $_POST['ano'];
	$genero = $_POST['genero'];
	$bitola = $_POST['bitola'];
	$direcao = $_POST['direcao'];
	$sinopse = $_POST['sinopse'];
	$minutagem = $_POST['minutagem'];
	$linkTrailer = $_POST['link'];
	$elenco = $_POST['elenco'];
	$pais2 = $_POST['pais2'];
	$classificacao = $_POST['classificacao'];
	$idCinema = $_POST['editarFilme'];
	$sql_atualizar_filme = "UPDATE ig_cinema SET

	`ig_pais_idPais` = '$pais1' ,
	`ig_evento_idEvento` = '$idEvento' ,
	`titulo` = '$titulo' , 
	`tituloOriginal` = '$tituloOriginal' ,
	`anoProducao` = '$anoProducao' ,
	`genero` = '$genero' ,
	`bitola` = '$bitola' ,
	`direcao` = '$direcao' ,
	`sinopse` =  '$sinopse' ,
	`minutagem` = '$minutagem' ,
	`linkTrailer` = '$linkTrailer' ,
	`elenco` = '$elenco' ,
	`indicacaoEtaria` = '$classificacao' ,

	`ig_pais_IdPais_2` = '$pais2'
	WHERE `idCinema` = '$idCinema'";
	verificaMysql($sql_atualizar_filme);
	if(mysqli_query($con,$sql_atualizar_filme)){
		$mensagem = "Filme atualizado com sucesso.";
	}else{
		$mensagem = "Erro ao atualizar o filme. Tente novamente.";		
	}
$filme = recuperaDados("ig_cinema",$_POST['editarFilme'],"idCinema");
		
}

if(isset($_POST['carregarFilme'])){
$filme = recuperaDados("ig_cinema",$_POST['carregarFilme'],"idCinema");
}




?>
<?php include "../include/menuCinema.php"; ?>
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<h3>Inserir Filme</h3>
                    <p><?php if(isset($mensagem)){echo $mensagem; } ?></p>
	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=cinema&p=editar" method="post">
				  
			 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Título do filme *:</strong><br/>
					  <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" value="<?php echo $filme['titulo']; ?>" >
					</div>
				  </div>

                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Título original:</strong><br/>
					  <input type="text" class="form-control" id="tituloOriginal" name="tituloOriginal" placeholder="" value="<?php echo $filme['tituloOriginal']; ?>">
					</div>
				  </div>
                                    <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Direção:</strong><br/>
					  <input type="text" class="form-control" id="direcao" name="direcao" placeholder="" value="<?php echo $filme['direcao']; ?>" >
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>País de origem*:</strong><br/>
					  <select class="form-control" id="pais1" name="pais1" >
					   <?php
						geraOpcao("ig_pais",$filme['ig_pais_idPais'],"");
						?>  
					  </select>

					</div>				  
					<div class=" col-md-6"><strong>País de origem (co-produção):</strong><br/>
                       <select class="form-control" id="pais2" name="pais2" >
                       <option value="0">Não há</option>
					   <?php
						geraOpcao("ig_pais",$filme['id_pais_idPais_2'],"");
						?>  
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Ano de produção:</strong><br/>
					  <input type="text" class="form-control" id="ano" name="ano" placeholder="" value="<?php echo $filme['anoProducao']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>Gênero:</strong><br/>
					  <input type="text" class="form-control" id="genero" name="genero" placeholder="" value="<?php echo $filme['genero']; ?>" >
					</div>
				  </div>

				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Bitola:</strong><br/>
					  <input type="text" class="form-control" id="bitola" name="bitola" placeholder="" value="<?php echo $filme['bitola']; ?>">
					</div>				  
					<div class="col-md-6"><strong>Minutagem (em minutos):</strong><br/>
					   <input type="text" class="form-control" id="minutagem" name="minutagem" placeholder="" value="<?php echo $filme['minutagem']; ?>">
					</div>	
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Sinopse:</strong><br/>
					 <textarea name="sinopse" class="form-control" rows="10" placeholder=""><?php echo $filme['sinopse']; ?></textarea>
					</div>
				  </div>	
                  	 <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Elenco:</strong><br/>
					 <textarea name="elenco" class="form-control" rows="10" placeholder=""><?php echo $filme['elenco']; ?></textarea>
					</div>
				  </div>			  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Classificação etária (em anos; 0 para livre):</strong><br/>
					   <input type="text" class="form-control" id="classificacao" name="classificacao" placeholder="Somente numeros" value="<?php echo $filme['indicacaoEtaria']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>Link para trailer</strong><br/>
					 					  <input type="text" class="form-control" id="link" name="link" placeholder="link">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="editarFilme" value="<?php echo $filme['idCinema']; ?>" />
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
case "listar":
unset($_SESSION['idCinema']);
if(isset($_POST['apagarFilme'])){
	$idCinema = $_POST['apagarFilme'];
	$sql_apagar_filme = "UPDATE ig_cinema SET publicado = '0' WHERE idCinema = '$idCinema'";
	if(mysqli_query($con,$sql_apagar_filme)){
		$mensagem = "Filme apagado com sucesso!";	
	}else{
		$mensagem = "Erro ao apagar o filme. Tente novamente.";
	}	
	
}

?>
<?php include "../include/menuCinema.php"; ?>
	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Lista de filmes da Mostra</h2>
	                  <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                 </div>
				  </div>
			  </div>  
			
			<div class="table-responsive list_info">
                         <?php listaFilmes($_SESSION['idEvento']); ?>
			</div>
		</div>
	</section>

<?php 
break;
case "ocorrencias" :

if(isset($_POST['dataInicio'])){ //carrega as variaveis vindas do POST
	
	$dataInicio = exibirDataMysql($_POST['dataInicio']);
	
	if(isset($_POST['dataFinal'])){
		if($_POST['dataFinal'] != ""){
			$dataFinal = exibirDataMysql($_POST['dataFinal']);
		}else{
			$dataFinal = NULL;
		}
	}else{
		$dataFinal = NULL;
	}
	
	$tipoOcorrencia = 5; // Tipo de Ocorrência de cinema

	
	
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
	$idCinema = $_SESSION['idCinema'];
	$publicado = 1;
}
if(isset($_POST['inserir'])){
	$sql_inserir = "INSERT INTO `ig_ocorrencia` (`idOcorrencia`, `idTipoOcorrencia`, `ig_comunicao_idCom`, `local`, `idEvento`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`, `domingo`, `dataInicio`, `dataFinal`, `horaInicio`, `horaFinal`, `timezone`, `diaInteiro`, `diaEspecial`, `libras`, `audiodescricao`, `valorIngresso`, `retiradaIngresso`, `localOutros`, `lotacao`, `reservados`, `duracao`, `precoPopular`, `frequencia`, `publicado`,`idSubEvento`,`idCinema`) VALUES (NULL, '$tipoOcorrencia', NULL, '$local', '$idEvento', '$segunda', '$terca', '$quarta', '$quinta', '$sexta', '$sabado', '$domingo', '$dataInicio', '$dataFinal', '$horaInicio', '$horaFinal', '$timezone', '$diaInteiro', '$diaEspecial', '$libras', '$audiodescricao', '$valorIngresso', '$retiradaIngresso', '$localOutros', '$lotacao', '$reservados', '$duracao', '$precoPopular', '$frequencia', '$publicado', '$idSubEvento','$idCinema');";
	if(mysqli_query($con,$sql_inserir)){
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
						   `precoPopular` = '$precoPopular',
							`idSubEvento` = '$idSubEvento'
							 WHERE 	`idOcorrencia` = '$idOc'";
	$con = bancoMysqli();
	if(mysqli_query($con,$sql_atualizar_ocorrencia)){
		$mensagem = "Ocorrência atualizada com sucesso!";	
		gravarLog($sql_atualizar_ocorrencia);	
	}else{
		$mensagem = "Erro ao atualizar. Tente novamente.";
	}	
	
}
if(isset($_POST['duplicar'])){
	$idOc = $_POST['duplicar'];
	$sql_duplicar_ocorrencia = "INSERT INTO ig_ocorrencia (`idTipoOcorrencia`, `ig_comunicao_idCom`, `local`, `idEvento`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`, `domingo`, `dataInicio`, `dataFinal`, `horaInicio`, `horaFinal`, `timezone`, `diaInteiro`, `diaEspecial`, `libras`, `audiodescricao`, `valorIngresso`, `retiradaIngresso`, `localOutros`, `lotacao`, `reservados`, `duracao`, `precoPopular`, `frequencia`, `publicado`, `idSubEvento`, `idCinema`) SELECT `idTipoOcorrencia`, `ig_comunicao_idCom`, `local`, `idEvento`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`, `domingo`, `dataInicio`, `dataFinal`, `horaInicio`, `horaFinal`, `timezone`, `diaInteiro`, `diaEspecial`, `libras`, `audiodescricao`, `valorIngresso`, `retiradaIngresso`, `localOutros`, `lotacao`, `reservados`, `duracao`, `precoPopular`, `frequencia`, `publicado`, `idSubEvento`, `idCinema`  FROM ig_ocorrencia WHERE `idOcorrencia` = '$idOc'";
	if(mysqli_query($con,$sql_duplicar_ocorrencia)){
		$mensagem = "Ocorrência duplicada com sucesso!";	
		gravarLog($sql_duplicar_ocorrencia);	
	}else{
		$mensagem = "Erro ao duplicar. Tente novamente.";
	}
}
if(isset($_POST['apagar'])){
	$con = bancoMysqli();
	$idOc = $_POST['apagar'];
	$sql_apagar_ocorrencia = "UPDATE ig_ocorrencia SET publicado = '0' WHERE idOcorrencia = $idOc";
	if(mysqli_query($con,$sql_apagar_ocorrencia)){
		$mensagem = "Ocorrência apagada com sucesso!";	
		gravarLog($sql_apagar_ocorrencia);	
	}else{
		$mensagem = "Erro ao atualizar. Tente novamente.";
	}
}
	
// Cria um array com dados do evento
$campo = recuperaEvento($_SESSION['idEvento']);
?>


<?php 
	$action = $_GET['action'];
	switch($action){
		case "inserir":
$filme = recuperaDados('ig_cinema',$_SESSION['idCinema'],"idCinema");
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
<?php include "../include/menuCinema.php"; ?>

<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Filme - Inserir ocorrências</h3>
                    <h1><?php echo $filme["titulo"] ?> </h1>
                    <p><?php if(isset($mensagem)){echo $mensagem;} ?></p>
                </div>
            </div>
    	</div>
	
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
            <form method="POST" action="?perfil=cinema&p=ocorrencias&action=listar" class="form-horizontal" role="form">


           
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
               			<input type="text" id="duracao" name="duracao" class="form-control" id="" placeholder="em minutos" value="<?php echo $filme['minutagem']; ?>">
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
	if(isset($_POST['idCinema'])){
	$_SESSION['idCinema'] = $_POST['idCinema'];
	}
	
	$cinema = recuperaDados("ig_cinema",$_SESSION['idCinema'],"idCinema");
?>
<?php include "../include/menuCinemaOcorrencias.php"; ?> 

	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2><?php echo $cinema['titulo']; ?></h2>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                 </div>
				  </div>
			  </div>  
			
			<div class="table-responsive list_info">
                         <?php listaOcorrenciasCinema($_SESSION['idCinema']); ?>
			</div>
		</div>
	</section>

<?php
	break;
	case "editar":
	$idOcorrencia = $_POST['id'];
	$filme = recuperaDados('ig_cinema',$_SESSION['idCinema'],"idCinema");
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
<?php include "../include/menuCinema.php"; ?>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Filme - Editar ocorrências</h3>
                    <h1><?php echo $filme["titulo"] ?><?php echo $idOcorrencia; ?></h1>
                    <p><?php if(isset($mensagem)){echo $mensagem;} ?></p>
                </div>
            </div>
    	</div>
	
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
            <form method="POST" action="?perfil=cinema&p=ocorrencias&action=listar" class="form-horizontal" role="form">
                                        <div class="form-group">  
                          <div class="col-md-offset-2 col-md-8">
 						            <select class="form-control" name="idSubEvento" id="inputSubject" >
               		 <option>Selecione</option>
					<?php geraOpcaoSub($_SESSION['idEvento'],""); ?>
                	</select>
                	</div>
                </div>

                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
               			 <label>Data início *</label>
                		<input type="text" name="dataInicio" class="form-control" id="datepicker01" value="<?php echo exibirDataBr($ocor['dataInicio']) ?>" placeholder="">
               		 </div>
                	<div class=" col-md-6">
                		<label>Data encerramento</label>
                		<input type="text" name="dataFinal" class="form-control" id="datepicker02" onblur="validate()" value="<?php if($ocor['dataFinal'] != '0000-00-00'){echo exibirDataBr($ocor['dataFinal']);} ?>"placeholder="só preencha se for temporada">
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
                        <?php geraOpcao("ig_local",$ocor['local'],$inst); ?></select>
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
                    	<input type="hidden" name="atualizar" value="<?php echo $ocor['idOcorrencia']; ?>"  />
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
	}
break;
case "grade":
?>
<?php include "../include/menuCinema.php"; ?> 

	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Grade de filmes</h2>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                 </div>
				  </div>
			  </div>  
			
			<div class="table-responsive list_info">
                         <?php gradeFilmes($_SESSION['idEvento']); ?>
			</div>
		</div>
	</section>


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
	
