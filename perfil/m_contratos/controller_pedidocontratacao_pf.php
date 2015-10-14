
    <section id="list_items">
		<div class="container">
			 <div class="sub-title"><h2>CADASTRO DE PESSOA FÍSICA</h2></div>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Nome</td>
							<td>CPF</td>
							<td>Telefone #1</td>
							<td>Telefone #2</td>
							<td>Email</td>
						</tr>
					</thead>
					<tbody>

<?php

$res = siscontratLista(1,5,10,1,"DESC"); //esse gera uma array com os pedidos

$link="index.php?perfil=contratos&p=frm_cadastra_propostapf&id_ped=";
	
if(isset($_POST['input'])){
	$input = $_POST['input'];
	@$con = bancoMysqli();
	if($con){
		$query = mysqli_query($con, "SELECT * FROM `igsis_pedido_contratacao` WHERE idPedidoContratacao LIKE '%$input%' OR NumeroProcesso LIKE '%$input%'");
		
		if($query){
			if(mysqli_num_rows($query) >= 1){
				while($res = mysqli_fetch_assoc($query)){
					echo "<tr><td class='lista'> <a href='$link&id_pf=$res[idPedidoContratacao]'>$res[idPedidoContratacao]</a></td>";
					echo '<td class="list_description">'.$res['NumeroProcesso'].'</td> ';
					echo '<td class="list_description">'.$res['Local'].'</td> ';
					echo '<td class="list_description">'.$res['Periodo'].'</td> ';
					echo '<td class="list_description">'.$res['Status'].'</td> </tr>';
				}
			}else{
				echo 'Sem dados para essa busca!';
			}
		}else{
			echo 'Ocorreu um erro na query!';
		}
	}else{	
		echo 'Ocorreu um erro na ligação à base de dados!';
	}

}else{
	echo 'Introduzir valor!';
}

?>
</tbody>
				</table>
			</div>
		</div>
	</section>
<!--fim_list-->