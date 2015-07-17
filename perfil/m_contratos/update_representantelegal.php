<?php
require("../conectar.php");

$link1="#";
$link2="#";
$link3="#";


$representanteLegal=$_POST['RepresentanteLegal'];

$rg=$_POST['RG'];
$cpf=$_POST['CPF'];
$nacionalidade=$_POST['Nacionalidade'];
$idEstadoCivil=$_POST['IdEstadoCivil'];
$id_rep=$_GET['id_rep'];



$atualiza_tabela_representante_legal = "UPDATE representante_legal SET
		
		RepresentanteLegal = '$representanteLegal',
		RG = '$rg',
		CPF = '$cpf',
		
		Nacionalidade = '$nacionalidade'
		WHERE Id_RepresentanteLegal = $id_rep
		";
	
$stmt = mysqli_prepare($conexao,$atualiza_tabela_representante_legal);		
if (mysqli_stmt_execute($stmt)) { echo "Dados inseridos com sucesso";};
 

?>