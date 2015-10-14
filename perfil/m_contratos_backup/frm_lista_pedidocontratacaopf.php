<?php
$_SESSION['idPedido'] = ""; //zera a session pedido

// não precisa chamar a funcao porque o index contrato já chama.
$linha_tabela_lista = siscontratLista(1,5,10,1,"DESC"); //esse gera uma array com os pedidos

$link="index.php?perfil=contratos&p=frm_edita_pedidocontratacaopf&id_ped=";

//$link="frm_edita_pedidocontratacaopj.php";
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
for($i = 0; $i < count($linha_tabela_lista); $i++)
 {
	$linha_tabela_pedido_contratacaopf = siscontratDocs($linha_tabela_lista[$i]['IdProponente'],2);	 
	echo "<tr><td class='lista'> <a href='".$link.$linha_tabela_lista[$i]['idPedido']."'>".$linha_tabela_lista[$i]['idPedido']."</a></td>";
	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopf['Nome'].					'</td> ';
	echo '<td class="list_description">'.$linha_tabela_lista[$i]['Objeto'].						'</td> ';
	echo '<td class="list_description">'.$linha_tabela_lista[$i]['Local'].				'</td> ';
	echo '<td class="list_description">'.$linha_tabela_lista[$i]['Periodo'].						'</td> ';
	echo '<td class="list_description">'.$linha_tabela_lista[$i]['Status'].						'</td> </tr>';
	}

?>
	
					
					</tbody>
				</table>
			</div>
		</div>
	</section>
<!--fim_list-->


