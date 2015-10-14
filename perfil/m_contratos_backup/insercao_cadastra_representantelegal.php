<?php
require("../conectar.php");


$link2="frm_cadastra_producao.php";



$representanteLegal=$_POST['RepresentanteLegal'];
$rg=$_POST['RG'];
$cpf=$_POST['CPF'];
$nacionalidade=$_POST['Nacionalidade'];
$idEstadoCivil=$_POST['EstadoCivil'];





$incluir = "INSERT INTO representantelegal
		(
		RepresentanteLegal,
		RG,
		CPF,
		Nacionalidade,
		EstadoCivil
		)
		VALUES
		(
		'$representanteLegal',
		'$rg',
		'$cpf',
		'$nacionalidade',
		'$idEstadoCivil'
		)";
	
		
$stmt = mysqli_prepare($conexao,$incluir);

if( mysqli_stmt_execute($stmt))
{
	echo"<center>Dados Inseridos com sucesso";
};

?>