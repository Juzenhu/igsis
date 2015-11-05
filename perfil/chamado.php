<?php
require_once("../funcoes/funcoesVerifica.php");
require_once("../funcoes/funcoesSiscontrat.php");
if(isset($_GET['idEvento'])){
	$evento = verificaCampos($_GET['idEvento']);
	$ocorrencia = verificaOcorrencias($_GET['idEvento']);	
}

if(isset($_GET['p'])){
	$p = $_GET['p'];
}else{
	$p= "inicio";	
}

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
<?php 

switch($p){
case "inicio":
?>

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
	            <a href="?perfil=chamado&p=inserir" class="btn btn-theme btn-lg btn-block">Abrir um chamado</a>
	            <a href="?perfil=chamado&p=acompanhar" class="btn btn-theme btn-lg btn-block">Acompanhar um chamado</a>
            </div>
          </div>
        </div>
    </div>
</section>    

<?php 
break;
case "inserir":
?>
<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Abrir um chamado.</h3>
                     <h4><?php if(isset($mensagem)){echo $mensagem;} ?></h4>
                </div>
            </div>
    </div>
    
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
        <form method="POST" action="?perfil=chamado&p=acompanha" class="form-horizontal" role="form">
       		 <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Título do chamado</label>
            		<input type="text" name="titulo" class="form-control" id="inputSubject" />
            	</div> 
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
                	<label>Tipo de chamado</label>
                	<select class="form-control" name="tipo" id="inputSubject" >
                    <option value="1"></option>
					<?php echo geraOpcao("igsis_tipo_chamado","","") ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-8">
            	<label>Evento</label>
            	<select class="form-control" name="evento" id="inputSubject" >
					<option value="0"></option>
				<?php
				$idUsuario = $_SESSION['idUsuario'];
				$con = bancoMysqli();
				$sql_lista_eventos = "SELECT * FROM ig_evento WHERE (idUsuario = '$idUsuario' OR idResponsavel = '$idUsuario' OR suplente = '$idUsuario') AND publicado = '1' AND dataEnvio IS NOT NULL ORDER BY idEvento";
				$query_lista_eventos = mysqli_query($con,$sql_lista_eventos);
				while($event = mysqli_fetch_array($query_lista_eventos)){ ?>
				<option value="<?php echo $event['idEvento'] ?>"><?php echo $event['nomeEvento'] ?></option>
				<?php					
				}				
				 ?>
                </select>
        	    </div>
      	    </div>

            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Descrição</label>
            		<textarea name="descricao" class="form-control" rows="10" placeholder="artista, banda, coletivo, companhia, palestrantes, etc"></textarea>
            	</div>
             </div>
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            		<label>Justificativa para alteração</label>
            		<textarea name="descricao" class="form-control" rows="10" placeholder="artista, banda, coletivo, companhia, palestrantes, etc"></textarea>
									
            	</div>
            </div>

            <div class="form-group">
	            <div class="col-md-offset-2 col-md-8">
                	<input type="hidden" name="inserir" value="1" />
    		        <input type="submit" class="btn btn-theme btn-lg btn-block" value="Enviar">
            	</div>
            </div>
            </form>
        </div>
    </div>
</section>  


<?php 
break;
case "acompanhar":
?>

<?php
$titulo = $_POST['titulo'];
$tipo = $_POST['tipo'];
$evento = $_POST['evento'];
$descricao = $_POST['descricao'];
$idUsuario = $_SESSION['idUsuario'];
$data = date('Y-m-d H:m:s');
 
if(isset($_POST['inserir'])){
	$sql_inserir_chamado = "INSERT INTO `igsis`.`igsis_chamado` (`idChamado`, `titulo`, `descricao`, `data`, `idUsuario`, `estado`, `tipo`) VALUES (NULL, '$titulo', '$descricao', '$data', '$idUsuario', 'aberto', '$tipo')";
}

?>



<?php } ?>