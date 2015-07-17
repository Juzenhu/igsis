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
$sql_tabela_pedido_contratacaopf = "SELECT
											pedido_contratacao_pf.Id_PedidoContratacaoPF, 
											pessoa_fisica.Nome,
											pedido_contratacao_pf.Objeto,
											pedido_contratacao_pf.LocalEspetaculo,
											pedido_contratacao_pf.Periodo
										FROM
											pessoa_fisica 
										INNER JOIN pedido_contratacao_pf 
										ON 
											(pedido_contratacao_pf.IdPessoaFisica = 
											 pessoa_fisica.Id_PessoaFisica)";
											 
$consulta_tabela_pedido_contratacaopf= mysqli_query($conexao, $sql_tabela_pedido_contratacaopf);
$linha_tabela_pedido_contratacaopf = mysqli_fetch_assoc($consulta_tabela_pedido_contratacaopf);

$link="frm_cadastra_propostapf.php";

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
							<td>Periodo</td>
						</tr>
					</thead>
					<tbody>
<?php        
 $data=date('Y');
 do 
 {
 echo "<tr><td class='lista'> <a href='$link?id=$linha_tabela_pedido_contratacaopf[Id_PedidoContratacaoPF]'>$data-$linha_tabela_pedido_contratacaopf[Id_PedidoContratacaoPF]</a></td>";
 echo '<td class="lista">'.$linha_tabela_pedido_contratacaopf['Nome'].         '</td> ';
 echo '<td class="lista">'.$linha_tabela_pedido_contratacaopf['Objeto'].         '</td> ';
 echo '<td class="lista">'.$linha_tabela_pedido_contratacaopf['LocalEspetaculo'].      '</td> ';
 echo '<td class="lista">'.$linha_tabela_pedido_contratacaopf['Periodo'].        '</td></tr>';
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