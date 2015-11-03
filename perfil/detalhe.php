<?php 
require "../funcoes/funcoesSiscontrat.php";
?>

<?php
	if(isset($_GET['evento'])){
		$evento = recuperaDados('ig_evento',$_GET['evento'],'idEvento');
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
			<div class="table-responsive list_info" >
            <h4><?php echo $evento['nomeEvento'] ?></h4>
            <p align="left">
              <?php descricaoEvento($_GET['evento']); ?>
                  </p>      
            <h5>Ocorrências</h5>
            <?php echo resumoOcorrencias($_GET['evento']); ?><br /><br />
            <?php listaOcorrenciasTexto($_GET['evento']); ?>
			<h5>Especificidades</h5>
			<div class="left">
            <?php descricaoEspecificidades($_GET['evento'],$evento['ig_tipo_evento_idTipoEvento']); ?>
			</div>

			<?php
//require "../funcoes/funcoesSiscontrat.php";
$pedido = listaPedidoContratacao($_GET['evento']);
?>
			  <div class="table-responsive list_info" >
<?php if($pedido != NULL){ ?>

            <h4>Pedidos de contratação</h4>

			  <?php for($i = 0; $i < count($pedido); $i++){
			$dados = siscontrat($pedido[$i]);
			$pessoa = siscontratDocs($dados['IdProponente'],$dados['TipoPessoa']);
			?>
            <p align="left">
			Nome ou Razão Social: <b><?php echo $pessoa['Nome'] ?></b><br />
			Tipo de pessoa: <b><?php echo retornaTipoPessoa($dados['TipoPessoa']);?></b><br />
			Dotação: <b><?php echo retornaVerba($dados['Verba']);?></b><br />
			Valor:<b>R$ <?php echo dinheiroParaBr($dados['ValorGlobal']);?></b><br />		
			 </p>      
<?php } // fechamento do for 

}else{ ?>
	<h5> Não há pedidos de contratação. </h5>
<?php	
}
?>
			<div class="table-responsive list_info" >
            <h4></h4>
            <div class="left">
            <br />
            <br />
            <h5>Previsão de serviços externos</h5>
            <?php listaServicosExternos($_GET['evento']); ?><br /><br />

			<h5>Serviços Internos</h5>
			<?php listaServicosInternos($_GET['evento']) ?>

</div>
</div>
            </div>
</section>
<?php } ?>


<!-- Pedido de Contratação -->


<?php
	if(isset($_GET['pedido'])){
		$pedido = siscontrat($_GET['pedido']);
		$pessoa = recuperaPessoa($pedido['IdProponente'],$pedido['TipoPessoa']);
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
			<div class="table-responsive list_info" >
            <h4><?php echo $pedido['Objeto'] ?></h4>
            <p align="left">
			Protocolo do pedido: <strong>2016-<?php echo retornaProtoPedido($_GET['pedido']) ?></strong> <br />
			Tipo de pessoa: <strong><?php echo $pessoa['tipo']; ?></strong> <br />
 			Nome / Razão Social: <strong><?php echo $pessoa['nome']; ?> (<?php echo $pessoa['numero']; ?>)</strong> <br />
   			Relação Jurídica: <strong><?php echo recuperaModalidade($pedido['CategoriaContratacao']); ?> </strong> <br />
   			Período: <strong><?php echo $pedido['Periodo']; ?> </strong> <br />
   			Local: <strong><?php echo $pedido['Local']; ?> </strong> <br />
   			Verba: <strong><?php echo retornaVerba($pedido['Verba']); ?> </strong> <br />
   			Valor: <strong>R$ <?php echo dinheiroParaBr($pedido['ValorGlobal']); ?> </strong> <br />
 			
                  </p>      
			<h5>Especificidades</h5>
			<div class="left">
			</div>


			  <div class="table-responsive list_info" >
<?php 
}else{ ?>
	<h5> Não há pedidos de contratação. </h5>
<?php	
}
?>
</div>
</div>
            </div>
</section>
