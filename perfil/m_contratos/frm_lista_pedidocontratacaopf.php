
<?php

$$linha_tabela_pedido_contratacaopf = siscontratLista($tipoPessoa,$instituicao,$registro,$limite,$ordem);

$link="index.php?perfil=contratos&p=frm_edita_pedidocontratacaopf&";

?>

	
<?php include 'includes/menu.php';?>
		
	  	  
	 <!-- inicio_list -->
	<section id="list_items">
		<div class="container">
			 <div class="sub-title">PEDIDO DE CONTRATAÇÃO DE PESSOA FÍSICA</div>
			<div class="table-responsive list_info">
				<table class="table table-condensed"><script type=text/javascript language=JavaScript src=../js/find2.js> </script>
					<thead>
						<tr class="list_menu">
							<td>Codigo do Pedido</td>
							<td>Proponente</td>
							<td>Objeto</td>
							<td>Local</td>
							<td> Periodo</td>
							<td>Status</td>
						</tr>
					</thead>
					<tbody>
<?php
	$data=date('Y');
 do 
 {
	echo "<tr><td class='lista'> <a href='$link?id_ped=$linha_tabela_pedido_contratacaopf[Id_PedidoContratacaoPF]'>$data-$linha_tabela_pedido_contratacaopf[Id_PedidoContratacaoPF]</a></td>";

	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopf['Nome'].									'</td> ';
	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopf['Objeto'].									'</td> ';
	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopf['LocalEspetaculo'].						'</td> ';
	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopf['Periodo'].								'</td> ';
	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopf['Status'].									'</td> </tr>';
	}
	while($linha_tabela_pedido_contratacaopf = mysqli_fetch_assoc($consulta_tabela_pedido_contratacaopf));
?>
					
					</tbody>
				</table>
			</div>
		</div>
	</section>
<!--fim_list-->


