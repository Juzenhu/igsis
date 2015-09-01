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

$consulta_tabela_representante_legal = mysqli_query ($conexao,"SELECT * FROM representante_legal ORDER BY RepresentanteLegal");
$linha_tabela_representante_legal = mysqli_fetch_assoc($consulta_tabela_representante_legal);

$link="frm_edita_representantelegal.php";

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
							<td>Representante Legal</td>
							<td>RG</td>
							<td>CPF</td>
						</tr>
					</thead>
					<tbody>
<?php        
  do 
 {
 echo "<tr><td class='lista'> <a href='$link?id_rep=$linha_tabela_representante_legal[Id_RepresentanteLegal]'>$linha_tabela_representante_legal[RepresentanteLegal]</a></td>";
 echo '<td class="lista">'.$linha_tabela_representante_legal['RG'].         '</td> ';
 echo '<td class="lista">'.$linha_tabela_representante_legal['CPF'].        '</td></tr>';
 }
 while($linha_tabela_representante_legal = mysqli_fetch_assoc($consulta_tabela_representante_legal));
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