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
											sis_pedido_contratacao_pf.Id_PedidoContratacaoPF, 
											sis_pessoa_fisica.Nome,
											sis_pedido_contratacao_pf.Objeto,
											sis_pedido_contratacao_pf.LocalEspetaculo,
											sis_pedido_contratacao_pf.Periodo,
											sis_contrato_pf.Id_ContratoPF
										FROM
											sis_pessoa_fisica 
										INNER JOIN sis_pedido_contratacao_pf 
										ON 
											(sis_pedido_contratacao_pf.IdPessoaFisica = 
											 sis_pessoa_fisica.Id_PessoaFisica)
                                        INNER JOIN sis_contrato_pf
										ON 
                                        (sis_pedido_contratacao_pf.Id_PedidoContratacaoPF =
											sis_contrato_pf.IdPedidoContratacaoPF)";
											 
$consulta_tabela_pedido_contratacaopf= mysqli_query($conexao, $sql__tabela_pedido_contratacaopf);
$linha_tabela_pedido_contratacaopf = mysqli_fetch_assoc($consulta_tabela_pedido_contratacaopf);

$link="frm_cadastra_notaempenhopf.php";

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
							<td>Periodo</td>
                            <td>Id Contratado</td>
						</tr>
					</thead>
					<tbody>
<?php        
 $data=date('Y');
 do 
 {
 echo "<tr><td class='lista'> <a href='$link?id=$linha_tabela_pedido_contratacaopf[Id_PedidoContratacaoPF]&idContrato=$linha_tabela_pedido_contratacaopf[Id_ContratoPF]'>$data-$linha_tabela_pedido_contratacaopf[Id_PedidoContratacaoPF]</a></td>";
 echo '<td class="lista">'.$linha_tabela_pedido_contratacaopf['Nome'].         '</td> ';
 echo '<td class="lista">'.$linha_tabela_pedido_contratacaopf['Objeto'].         '</td> ';
 echo '<td class="lista">'.$linha_tabela_pedido_contratacaopf['LocalEspetaculo'].      '</td> ';
  echo '<td class="lista">'.$linha_tabela_pedido_contratacaopf['Periodo'].      '</td> ';
 echo '<td class="lista">'.$linha_tabela_pedido_contratacaopf['Id_ContratoPF'].        '</td></tr>';
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