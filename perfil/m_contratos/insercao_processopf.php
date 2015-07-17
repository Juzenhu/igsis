<?php
require("../conectar.php");

$link1="#";
$link2="#";
$link3="#";


$processo=$_POST['NumeroProcesso'];
$idContrato=$_GET['idContrato'];

$incluir = "UPDATE contrato_pf 
			SET NumeroProcesso = '$processo' 
			WHERE Id_contratoPF = '$idContrato' ";

//PREPARANDO A VARIAVEL DO UPDATE
$stmt = mysqli_prepare($conexao,$incluir);

//EXECUTANDO A VARIAVEL DO UPDATE
if( mysqli_stmt_execute($stmt))
{
	echo"<center>Dados Inseridos com sucesso";
	 $last_id = mysqli_insert_id($conexao);
	 echo "<br><br>Qual modelo de documento deseja imprimir?<br>
	 <a href='$link1?id=$last_id'><button>Artistico</button></a><br />
	 <a href='$link2?id=$last_id'><button>Padrao</button></a><br />
	 <a href='$link3?id=$last_id'><button>Vocacional</button></a><br />
	 <br /></center>";
};
?>