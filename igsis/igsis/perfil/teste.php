<?php


$teste = recuperaModulo("admin");

?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2><?php
	$con = mysql_connect( 'localhost', 'root', 'lic54eca' );
	mysql_select_db( 'igsis_beta', $con );
?>
<label for="cod_estados">Estado:</label>
<select name="cod_estados" id="cod_estados">
	<option value=""></option>
	<?php
		$sql = "SELECT cod_estados, sigla
				FROM estados
				ORDER BY sigla";
		$res = mysql_query( $sql );
		while ( $row = mysql_fetch_assoc( $res ) ) {
			echo '<option value="'.$row['cod_estados'].'">'.$row['sigla'].'</option>';
		}
	?>
</option></select>

<label for="cod_cidades">Cidade:</label>
<select name="cod_cidades" id="cod_cidades">
	<option value="">-- Escolha um estado --</option>
</select></h2>


					</div>
				  </div>
			  </div>
			  
		</div>
	</section>
