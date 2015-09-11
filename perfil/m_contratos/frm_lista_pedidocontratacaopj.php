<?php
$dados =  siscontratLista(2,$_SESSION['idInstituicao'],3,1,"DESC");

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
for($x = 0; $x < count($dados); $x++){
	$idProponente = $dados[$x]['IdProponente'];
	$pessoa = siscontratDocs($idProponente,2);
?>
 					  
	<tr>
     <td class='lista'>00000</td>
	   <td class='lista'><?php echo $pessoa['Nome'] ?> </td>
	<td class="lista"><?php echo $dados[$x]['Objeto'] ?>				</td>
	<td class="lista"><?php echo $dados[$x]['Local'] ?></td>
    	<td class="lista"><?php echo $dados[$x]['Periodo'] ?></td>
	<td class="lista"> Indefinido		</td>
    </tr>
<?php 
} //fecha o for
?>
					
					</tbody>
				</table>
			</div>
		</div>
	</section>
<!--fim_list-->
