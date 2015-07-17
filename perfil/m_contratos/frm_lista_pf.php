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

$consulta_tabela_pf = mysqli_query ($conexao,"SELECT * FROM pessoa_fisica ORDER BY Nome");
$linha_tabela_pf= mysqli_fetch_assoc($consulta_tabela_pf);

$link="frm_edita_pf.php";

?>
	
<?php //include 'includes/menu.php';?>
		
	  	  
	 <!-- inicio_list -->
	<section id="list_items">
		<div class="container">
			 <div class="sub-title">PESSOA FÍSICA</div>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Proponente</td>
							<td>CPF</td>
							<td>Telefone 1</td>
							<td>Telefone 2</td>
							<td>E-mail</td>
						</tr>
					</thead>
					<tbody>
<?php 					  
	do 
	{
	echo "<tr><td class='lista'> <a href='$link?id_pf=$linha_tabela_pf[Id_PessoaFisica]'>$linha_tabela_pf[Nome]</a></td>";
	echo '<td class="lista">'.$linha_tabela_pf['CPF'].				'</td> ';
	echo '<td class="lista">'.$linha_tabela_pf['Telefone1'].		'</td> ';
	echo '<td class="lista">'.$linha_tabela_pf['Telefone2'].		'</td> ';
	echo '<td class="lista">'.$linha_tabela_pf['Email'].			'</td></tr>';
	}
	while($linha_tabela_pf = mysqli_fetch_assoc($consulta_tabela_pf));
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