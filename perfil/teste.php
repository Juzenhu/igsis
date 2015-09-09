<?php
//@ini_set('display_errors', '1');
//error_reporting(E_ALL); 

/*
$con = bancoMysqli(); //conecta o banco;

if(isset($_GET['idPedido'])){
	$idPedido = $_GET['idPedido'];
}else{
	$idPedido = "";
}

if(isset($_GET['tipoPessoa'])){
	$tipoPessoa = $_GET['tipoPessoa'];
}else{
	$tipoPessoa = "";
}

if(isset($_GET['instituicao'])){
	$instituicao = $_GET['instituicao'];
}else{
	$instituicao = "";

}
if(isset($_GET['evento'])){
	$idEvento = $_GET['evento'];	
}else{
	$idEvento = "";
}


$casa = siscontrat($idPedido,$tipoPessoa,$instituicao);
*/
require_once("../funcoes/funcoesSiscontrat.php");
$endereco = retornaEndereco($_GET['cep'],"386","casa");
$pessoa = siscontratDocs($_GET['pessoa'],$_GET['tipo']);
?>

	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Teste Array Siscontrat</h3>
<p><?php //echo $endereco; ?></p>
<p><?php print_r($pessoa) ?></p>


					</div>
				  </div>
			  </div>
			  
		</div>
	</section>