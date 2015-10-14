
<?php

$conexao = bancoMysqli(); // conecta no banco

$consulta_tabela_representante_legal = mysqli_query ($conexao,"SELECT * FROM sis_representante_legal ORDER BY RepresentanteLegal");
$linha_tabela_representante_legal = mysqli_fetch_assoc($consulta_tabela_representante_legal);

$link="index.php?perfil=contratos&p=frm_edita_representantelegal";

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
