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
											sis_pedido_contratacao_pj.Id_PedidoContratacaoPJ, 
											sis_pessoa_juridica.RazaoSocial,
											sis_pedido_contratacao_pj.Objeto,
											sis_pedido_contratacao_pj.LocalEspetaculo,
											sis_pedido_contratacao_pj.Periodo,
											sis_pedido_contratacao_pj.Status 
										FROM
											sis_pessoa_juridica 
										INNER JOIN sis_pedido_contratacao_pj 
										ON 
											(sis_pedido_contratacao_pj.IdPessoaJuridica = 
											 sis_pessoa_juridica.Id_PessoaJuridica)";
											 
$consulta_tabela_pedido_contratacaopj= mysqli_query($conexao, $sql__tabela_pedido_contratacaopj);
$linha_tabela_pedido_contratacaopj = mysqli_fetch_assoc($consulta_tabela_pedido_contratacaopj);

$link="frm_edita_pedidocontratacaopj.php";

?>
	
<?php include 'includes/menu.php';?>
		
	  	  
	 <!-- inicio_list -->
	<section id="list_items">
		<div class="container">
			 <div class="sub-title">PEDIDO DE CONTRATAÇÃO DE PESSOA JURÍDICA</div>
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
	echo "<tr><td class='lista'> <a href='$link?id_ped=$linha_tabela_pedido_contratacaopj[Id_PedidoContratacaoPJ]'>$data-$linha_tabela_pedido_contratacaopj[Id_PedidoContratacaoPJ]</a></td>";
	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopj['RazaoSocial'].					'</td> ';
	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopj['Objeto'].						'</td> ';
	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopj['LocalEspetaculo'].				'</td> ';
	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopj['Periodo'].						'</td> ';
	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopj['Status'].						'</td> </tr>';
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