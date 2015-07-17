<?php
require("../conectar.php");

$link1="#";
$link2="#";
$link3="#";


$nome=$_POST['Nome'];
$nomeArtistico=$_POST['NomeArtistico'];
$rg=$_POST['RG'];
$cpf=$_POST['CPF'];
$ccm=$_POST['CCM'];
$idEstadoCivil=$_POST['IdEstadoCivil'];
$dataNascimento=$_POST['DataNascimento'];
$nacionalidade=$_POST['Nacionalidade'];
$numero=$_POST['Numero'];
$complemento=$_POST['Complemento'];
$telefone1=$_POST['Telefone1'];
$telefone2=$_POST['Telefone2'];
$telefone3=$_POST['Telefone3'];
$email=$_POST['Email'];
$drt=$_POST['DRT'];
$funcao=$_POST['Funcao'];
$inss=$_POST['InscricaoINSS'];
$omb=$_POST['OMB'];
$dataAtual=$_POST['DataAtualizacao'];
$observacao=$_POST['Observacao'];
$id_pf=$_GET['id_pf'];



$atualiza_tabela_pf = "UPDATE pessoa_fisica SET
		
		Nome = '$nome',
		NomeArtistico = '$nomeArtistico',
		RG = '$rg',
		CPF = '$cpf',
		CCM = '$ccm',
		
		DataNascimento = '$dataNascimento',
		Nacionalidade = '$nacionalidade',
		Numero = '$numero',
		Complemento = '$complemento',
		Telefone1 = '$telefone1',
		Telefone2 = '$telefone2',
		Telefone2 = '$telefone3',
		Email = '$email',
		DRT = '$drt',
		Funcao = '$funcao',
		InscricaoINSS = '$inss',
		OMB = '$omb',
		DataAtualizacao = '$dataAtual',
		Observacao = '$observacao'
		WHERE Id_PessoaFisica = $id_pf
		";
	
$stmt = mysqli_prepare($conexao,$atualiza_tabela_pf);		
if (mysqli_stmt_execute($stmt)) { echo "Dados inseridos com sucesso";};
 


?>