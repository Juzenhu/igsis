<?php



?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>
<? 
$idTabela = "ig_evento";
$idCampo = "idUsuario";
$idDado = 1;
$teste = verificaExiste($idTabela,$idCampo,$idDado,0);
//var_dump($teste);
echo $teste['numero'];

 ?>

					</div>
				  </div>
			  </div>
			  
		</div>
	</section>
