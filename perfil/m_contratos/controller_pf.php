
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

$link="?perfil=contratos&p=frm_edita_pf&";
	
if(isset($_POST['input'])){
	$input = $_POST['input'];
	@$con = bancoMysqli();
	if($con){
		$query = mysqli_query($con, "SELECT * FROM `sis_pessoa_fisica` WHERE Nome LIKE '%$input%' OR CPF LIKE '%$input%'");
		if($query){
			if(mysqli_num_rows($query) >= 1){
				while($res = mysqli_fetch_assoc($query)){
					echo "<tr><td class='lista'> <a href='$link&id_pf=$res[Id_PessoaFisica]'>$res[Nome]</a></td>";
					echo '<td class="list_description">'.$res['CPF'].'</td> ';
					echo '<td class="list_description">'.$res['Telefone1'].'</td> ';
					echo '<td class="list_description">'.$res['Telefone2'].'</td> ';
					echo '<td class="list_description">'.$res['Email'].'</td> </tr>';
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