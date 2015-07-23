<?php

$linha_tabela_pedido_contratacaopf = siscontratLista("1",$_SESSION['idInstituicao'],0,30,"DESC");
$link = "";
?>

	
<?php include 'includes/menu.php';?>
		
	  	  
	 <!-- inicio_list -->
	 <br />
	 <br />
	 <br />
	<section id="list_items">
		<div class="container">
			 <h3>PEDIDO DE CONTRATAÇÃO DE PESSOA FÍSICA</h3>
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
<td class="list_description"></td>
<td class="list_description"><?php echo $linha_tabela_pedido_contratacaopf[$i]['Proponente'] ?></td>
<td class="list_description"><?php echo $linha_tabela_pedido_contratacaopf[$i]['Objeto'] ?></td>
<td class="list_description"><?php echo $linha_tabela_pedido_contratacaopf[$i]['Local'] ?></td>
<td class="list_description"><?php echo $linha_tabela_pedido_contratacaopf[$i]['Periodo'] ?></td>
<td class="list_description"></td>

<?php
}
?>
	
					</tbody>
				</table>
			</div>
		</div>
	</section>