<?php
require("../conectar.php");




$razaoSocial=$POST['RazaoSocial'];
$cnpj=$POST['CNPJ'];
$ccm=$POST['CCM'];
$numero=$_POST['Numero'];
$complemento=$_POST['Complemento'];
$telefone1=$_POST['Telefone1'];
$telefone2=$_POST['Telefone2'];
$telefone3=$_POST['Telefone3'];
$email=$_POST['Email'];
$replegal1=$POST['IdRepresentanteLegal1'];
$replegal2=$POST['IdRepresentanteLegal2'];
$dataAtual=$_POST['DataAtualizacao'];
$observacao=$_POST['Observacao'];
$id_pj=$_GET['id_pj'];



$atualiza_tabela_pj = "UPDATE pessoa_juridica SET
		
		RazaoSocial ='$razaoSocial',
		CNPJ = '$cnpj',
		CCM = '$ccm',
		Numero = '$numero',
		Complemento = '$complemento',
		Telefone1 = '$telefone1',
		Telefone2 = '$telefone2',
		Telefone2 = '$telefone3',
		Email = '$email',
		
		
		DataAtualizacao = '$dataAtual',
		Observacao = '$observacao'
		WHERE Id_PessoaJuridica = $id_pj
		";
	
$stmt = mysqli_prepare($conexao,$atualiza_tabela_pj);		
if (mysqli_stmt_execute($stmt)) { echo "Dados inseridos com sucesso";};
}

?>