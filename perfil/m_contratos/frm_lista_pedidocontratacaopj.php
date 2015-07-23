<?php include 'includes/menu.php';

$linha_tabela_pedido_contratacaopj = siscontratLista(2,$_SESSION['idInstituicao'],0,30,"DESC");
?>
		
	  	  
	 <!-- inicio_list -->
	 <br />
	 <br />
	 <br />
	<section id="list_items">
		<div class="container">
			 <h3>PEDIDO DE CONTRATAÇÃO DE PESSOA JURÍDICA</h3>
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
for($i = 0; $i < sizeof($linha_tabela_pedido_contratacaopj); $i++){
	?>
<tr>
<td class="list_description"></td>
<td class="list_description"><?php echo $linha_tabela_pedido_contratacaopj[$i]['Proponente']; ?></td>
<td class="list_description"><?php echo $linha_tabela_pedido_contratacaopj[$i]['Objeto'] ?></td>
<td class="list_description"><?php echo $linha_tabela_pedido_contratacaopj[$i]['Local'] ?></td>
<td class="list_description"><?php echo $linha_tabela_pedido_contratacaopj[$i]['Periodo'] ?></td>
<td class="list_description"></td>

<?php
}
?>
	
					</tbody>
				</table>
			</div>
		</div>
	</section>