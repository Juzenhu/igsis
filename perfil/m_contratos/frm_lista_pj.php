
<?php
$dados =  siscontratLista(2,$_SESSION['idInstituicao'],3,1,"DESC");
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
							<td>E-mail</td>
						</tr>
					</thead>
					<tbody>
<?php 
for($x = 0; $x < count($dados); $x++){
	$pessoa = siscontratDocs($dados[$x],2);
?>
 					  
	<tr><td class='lista'><?php echo $pessoa['Nome'] ?> </td>
	<td class="lista"><?php echo $pessoa['CNPJ'] ?>				</td>
	<td class="lista"><?php echo $pessoa['Telefones'] ?></td>
	<td class="lista">	<?php echo $pessoa['Email'] ?>		</td></tr>
<?php 
} //fecha o for
?>
					
					</tbody>
				</table>
			</div>
		</div>
	</section>
