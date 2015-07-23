<?php

$linha_tabela_pedido_contratacaopf = siscontratLista("1",$_SESSION['idInstituicao'],0,30,"DESC");
$link = "";
?>

	
<?php include 'includes/menu.php';?>
		
	  	  
	 <!-- inicio_list -->
	<section id="list_items">
		<div class="container">
			 <div class="sub-title">PEDIDO DE CONTRATAÇÃO DE PESSOA FÍSICA</div>
			<div class="table-responsive list_info">
			<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td width="10%">Codigo do Pedido</td>
							<td width="15%">Proponente</td>
							<td width="20%">Objeto</td>
							<td width="20%">Local</td>
							<td width="10%"> Periodo</td>
							<td width="5%">Status</td>
						</tr>
					</thead>
					<tbody>
<?php
for($i = 0; $i < sizeof($linha_tabela_pedido_contratacaopf); $i++){
	$proponente = recuperaUsuario($linha_tabela_pedido_contratacaopf[$i]['Fiscal']);
?>
<tr>
<td></td>
<td><?php echo $linha_tabela_pedido_contratacaopf[$i]['Proponente'] ?></td>
<td><?php echo $linha_tabela_pedido_contratacaopf[$i]['Objeto'] ?></td>
<td><?php echo $linha_tabela_pedido_contratacaopf[$i]['Local'] ?></td>
<td><?php echo $linha_tabela_pedido_contratacaopf[$i]['Periodo'] ?></td>
<td></td>

<?php
}
?>
					
					</tbody>
				</table> 
			<p></p>
</div>
</section>