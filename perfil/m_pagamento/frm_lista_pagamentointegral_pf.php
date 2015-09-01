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
require ("../conectar.php");
$sql__tabela_pedido_contratacaopf = "SELECT
											pedido_contratacao_pf.Id_PedidoContratacaoPF, 
											pessoa_fisica.Nome,
											pedido_contratacao_pf.Objeto,
											pedido_contratacao_pf.LocalEspetaculo,
											pedido_contratacao_pf.Status,
											pedido_contratacao_pf.Periodo,
											pedido_contratacao_pf.Valor,
											contrato_pf.NumeroProcesso,
											contrato_pf.Id_ContratoPF,
											setor.Setor
										FROM
											pessoa_fisica 
										INNER JOIN pedido_contratacao_pf 
										ON 
											(pedido_contratacao_pf.IdPessoaFisica = 
											 pessoa_fisica.Id_PessoaFisica)
                                        INNER JOIN contrato_pf
										ON 
                                        (pedido_contratacao_pf.Id_PedidoContratacaoPF =
											contrato_pf.IdPedidoContratacaoPF)
										INNER JOIN setor
										ON
											(pedido_contratacao_pf.IdSetor =
											setor.Id_Setor)
											";
											 
$consulta_tabela_pedido_contratacaopf= mysqli_query($conexao, $sql__tabela_pedido_contratacaopf);
$linha_tabela_pedido_contratacaopf = mysqli_fetch_assoc($consulta_tabela_pedido_contratacaopf);

$link="rlt_pagamentointegral_pf.php";

?>

	
<?php include 'includes/menu.html';?>
		
	  	  
<!-- inicio_list -->
	<section id="list_items">
		<div class="container">
			 <div class="sub-title">CONTRATOS DE PESSOA FÍSICA</div>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Codigo do Pedido</td>
                            <td>Processo Nº</td>
							<td>Proponente</td>
							<td>Objeto</td>
                            <td>Local</td>
							<td>Periodo</td>
                            <td>Valor</td>
							<td>Status</td>
						</tr>
					</thead>
					<tbody>
<?php        
 $data=date('Y');
 do 
 {
 echo "<tr><td> <a href='$link?id=$linha_tabela_pedido_contratacaopf[Id_PedidoContratacaoPF]'>$data-$linha_tabela_pedido_contratacaopf[Id_PedidoContratacaoPF]</a></td>";
 echo '<td>'.$linha_tabela_pedido_contratacaopf['NumeroProcesso'].      '</td> ';
 echo '<td>'.$linha_tabela_pedido_contratacaopf['Nome'].                '</td> ';
 echo '<td>'.$linha_tabela_pedido_contratacaopf['Objeto'].         		'</td> ';
 echo '<td>'.$linha_tabela_pedido_contratacaopf['LocalEspetaculo'].     '</td> ';
 echo '<td>'.$linha_tabela_pedido_contratacaopf['Periodo'].      		'</td> ';
 echo '<td>'.$linha_tabela_pedido_contratacaopf['Valor'].         		'</td> ';
 echo '<td>'.$linha_tabela_pedido_contratacaopf['Status'].        		'</td></tr>';
 }
 while($linha_tabela_pedido_contratacaopf = mysqli_fetch_assoc($consulta_tabela_pedido_contratacaopf));
?>

					
					</tbody>
				</table>
			</div>
		</div>
	</section> 
<!--fim_list-->


<!--footer -->
<?php include 'includes/footer.html';?>
	
  	
</html>