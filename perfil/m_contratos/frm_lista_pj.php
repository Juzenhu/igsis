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

$consulta_tabela_pj = mysqli_query ($conexao,"SELECT * FROM sis_pessoa_juridica ORDER BY RazaoSocial");
$linha_tabela_pj= mysqli_fetch_assoc($consulta_tabela_pj);

$link="frm_edita_pj.php";

?>
	
<?php include 'includes/menu.php';?>
		
	  	  
	 <!-- inicio_list -->
	<section id="list_items">
		<div class="container">
			 <div class="sub-title">PESSOA JURÍDICA</div>
			<div class="table-responsive list_info">
				<table class="table table-condensed"><script type=text/javascript language=JavaScript src=../js/find2.js> </script>
					<thead>
						<tr class="list_menu">
							<td>Proponente</td>
							<td>CNPJ</td>
							<td>Telefone 1</td>
							<td>Telefone 2</td>
							<td>E-mail</td>
						</tr>
					</thead>
					<tbody>
<?php 					  
	do 
	{
	echo "<tr><td class='lista'> <a href='$link?id_pj=$linha_tabela_pj[Id_PessoaJuridica]'>$linha_tabela_pj[RazaoSocial]</a></td>";
	echo '<td class="lista">'.$linha_tabela_pj['CNPJ'].				'</td> ';
	echo '<td class="lista">'.$linha_tabela_pj['Telefone1'].		'</td> ';
	echo '<td class="lista">'.$linha_tabela_pj['Telefone2'].		'</td> ';
	echo '<td class="lista">'.$linha_tabela_pj['Email'].			'</td></tr>';
	}
	while($linha_tabela_pj = mysqli_fetch_assoc($consulta_tabela_pj));
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