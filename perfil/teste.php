<?php
require_once("../funcoes/funcoesVerifica.php");
require_once("../funcoes/funcoesSiscontrat.php");
if(isset($_GET['idEvento'])){
	$evento = verificaCampos($_GET['idEvento']);
	$ocorrencia = verificaOcorrencias($_GET['idEvento']);	
}

?>

	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Teste Array Siscontrat</h3>
<p><?php //echo $endereco; ?></p>
<p>
<?php //print_r($evento);
if($evento['total'] > 0){
	echo "Há campos obrigatórios não preenchidos.";	
}else{
	echo "Todos os campos obrigatórios foram preenchidos";
}

?></p>
<p>
<?php //print_r($evento);
if($ocorrencia > 0){
	echo "Há ocorrências cadastradas.";	
}else{
	echo "Não há ocorrências cadastradas.";
}

?></p>
<p><?php prazoContratos($_GET['idEvento']); ?></p>
<p>
<?php print_r($_SESSION);
$lista =  siscontratLista(2,$_SESSION['idInstituicao'],3,1,"DESC");

var_dump($lista);
?></p>



					</div>
				  </div>
			  </div>
			  
		</div>
	</section>