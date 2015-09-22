<?php

$_SESSION['idPedido'] = "";

$con = bancoMysqli();
$sql_lista = "SELECT * FROM sis_pessoa_fisica ORDER BY Nome";
$query_lista = mysqli_query($con,$sql_lista);

$link="?perfil=contratos&p=frm_edita_pf&";

?>
	
    	<?php include 'includes/menu.php';?>
		
	  	  
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
	while($linha_tabela_pf = mysqli_fetch_assoc($query_lista)){
	echo "<tr><td class='lista'> <a href='$link&id_pf=$linha_tabela_pf[Id_PessoaFisica]'>$linha_tabela_pf[Nome]</a></td>";
	echo '<td class="lista">'.$linha_tabela_pf['CPF'].				'</td> ';
	echo '<td class="lista">'.$linha_tabela_pf['Telefone1'].		'</td> ';
	echo '<td class="lista">'.$linha_tabela_pf['Telefone2'].		'</td> ';
	echo '<td class="lista">'.$linha_tabela_pf['Email'].			'</td></tr>';
	}
	
?>
					
					</tbody>
				</table>
			</div>
		</div>
	</section>
<!--fim_list-->
