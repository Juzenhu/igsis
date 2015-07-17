<?php
require("../conectar.php");

$link1="#";
$link2="#";
$link3="#";



$IdPedidoContratacaoPJ=$_POST['Id_PedidoContratacaoPJ'];
$IdUsuario=1;
$IdAssinatura=$_POST['Id_Assinatura'];


$incluir = "INSERT INTO contrato_pj
(
IdPedidoContratacaoPJ,
IdUsuario,
IdAssinatura
)
Values
(
'$IdPedidoContratacaoPJ',
'$IdUsuario',
'$IdAssinatura'
)";

$stmt = mysqli_prepare($conexao,$incluir);

if( mysqli_stmt_execute($stmt))
{
	echo"<center>Dados Inseridos com sucesso <br>";
	 $last_id = mysqli_insert_id($conexao);
	 echo "<br><br>Qual modelo de proposta deseja imprimir?<br><br>
	 <a href='$link1?id=$last_id'><button>Artistico</button></a><br /><br>
	 <a href='$link2?id=$last_id'><button>Padrao</button></a><br /><br>
	 <a href='$link3?id=$last_id'><button>Vocacional</button></a><br />
	 <br /></center>";
};

?>