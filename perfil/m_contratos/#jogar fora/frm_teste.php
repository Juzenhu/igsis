<?php
$con = bancoMysqli();


$pedido = recuperaDados("igsis_pedido_contratacao",$_SESSION['idPedido'],"idPedidoContratacao");
$pessoa = siscontratDocs($pedido['idPessoa'],$pedido['tipoPessoa']);
$k = "?perfil=contratados&p=representante";

 ?>
 
 
    <?php
	$busca = $_POST['busca'];
	$sql_busca = "SELECT * FROM sis_representante_legal WHERE CPF LIKE '%$busca%' ORDER BY RepresentanteLegal";
	$query_busca = mysqli_query($con,$sql_busca); 
	$num_busca = mysqli_num_rows($query_busca);
	?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
             <h2>CADASTRO DE REPRESENTANTE LEGAL</h2>
              <p>O sistema encontrou informações sobre representantes legais com referência a <br /><strong><?php echo $_POST['busca'] ?>". </strong><br /> </p>
 

					</div>
				  </div>
			  </div>
              	<section id="list_items" class="home-section bg-white">
		<div class="container">
<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Nome</td>
							<td>CPF</td>
							<td width="20%"></td>
  							<td width="20%"></td>
						</tr>
					</thead>
					<tbody>
                    <?php
				while($descricao = mysqli_fetch_array($query_busca)){			
			echo "<tr>";
			echo "<td class='list_description'><b>".$descricao['RepresentanteLegal']."</b></td>";
			echo "<td class='list_description'>".$descricao['CPF']."</td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=$k'>
			<input type='hidden' name='idPessoa' value='1'>
			<input type ='submit' class='btn btn-theme btn-md btn-block' value='detalhe'></td></form>"	;
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=?perfil=contratados&p=edicaoPedido'>
			<input type='hidden' name='inserirRepresentante' value='1'>
			<input type ='submit' class='btn btn-theme btn-md btn-block' value='inserir'></td></form>"	;

			echo "</tr>";
				
?>
						
					</tbody>
				</table>
                <?php var_dump($_SESSION); ?>
			</div>
            		</div>
	</section>