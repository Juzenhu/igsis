<!DOCTYPE html>
<html>
  <head>
    <title>IGSIS</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/style.css" rel="stylesheet" media="screen">
	<link href="../color/default.css" rel="stylesheet" media="screen">
	<script src="../js/modernizr.custom.js"></script>
  </head>
  <body>
<?php

$linha_tabela_pedido_contratacaopf = recuperaSiscontratArray($tipoPessoa,0);
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
	while($linha_tabela_pedido_contratacaopf);
?>
					
					</tbody>
				</table>
			</div>
		</div>
	</section>
<!--fim_list-->


