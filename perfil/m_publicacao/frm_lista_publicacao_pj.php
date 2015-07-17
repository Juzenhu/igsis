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
$sql__tabela_pedido_contratacaopj = "SELECT
											pedido_contratacao_pj.Id_PedidoContratacaoPJ, 
											pessoa_juridica.RazaoSocial,
											pedido_contratacao_pj.Objeto,
											pedido_contratacao_pj.Status,
											pedido_contratacao_pj.LocalEspetaculo,
											contrato_pj.NumeroProcesso,
											contrato_pj.Id_ContratoPJ,
											setor.Setor
										FROM
											pessoa_juridica 
										INNER JOIN pedido_contratacao_pj 
										ON 
											(pedido_contratacao_pj.IdPessoaJuridica = 
											 pessoa_juridica.Id_PessoaJuridica)
                                        INNER JOIN contrato_pj
										ON 
                                        (pedido_contratacao_pj.Id_PedidoContratacaoPJ =
											contrato_pj.IdPedidoContratacaoPJ)
										INNER JOIN setor
										ON
											(pedido_contratacao_pj.IdSetor =
											setor.Id_Setor)
											";
											 
$consulta_tabela_pedido_contratacaopj= mysqli_query($conexao, $sql__tabela_pedido_contratacaopj);
$linha_tabela_pedido_contratacaopj = mysqli_fetch_assoc($consulta_tabela_pedido_contratacaopj);

$link="rlt_publicacao_pj.php";

?>

	
<?php include 'includes/menu.php';?>
		
	  	  
<!-- inicio_list -->
	<section id="list_items">
		<div class="container">
			 <div class="sub-title">DESPACHO DE PESSOA JURÍDICA</div>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Codigo do Pedido</td>
                            <td>Processo Nº</td>
							<td>Proponente</td>
							<td>Objeto</td>
							<td>Periodo</td>
							<td>Status</td>
						</tr>
					</thead>
					<tbody>
<?php        
 $data=date('Y');
 do 
 {
 echo "<tr><td> <a href='$link?id=$linha_tabela_pedido_contratacaopj[Id_PedidoContratacaoPJ]'>$data-$linha_tabela_pedido_contratacaopj[Id_PedidoContratacaoPJ]</a></td>";
 echo '<td>'.$linha_tabela_pedido_contratacaopj['NumeroProcesso'].      '</td> ';
 echo '<td>'.$linha_tabela_pedido_contratacaopj['RazaoSocial'].         '</td> ';
 echo '<td>'.$linha_tabela_pedido_contratacaopj['Objeto'].         		'</td> ';
 echo '<td>'.$linha_tabela_pedido_contratacaopj['LocalEspetaculo'].     '</td> ';
 echo '<td>'.$linha_tabela_pedido_contratacaopj['Status'].        		'</td></tr>';
 }
 while($linha_tabela_pedido_contratacaopj = mysqli_fetch_assoc($consulta_tabela_pedido_contratacaopj));
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