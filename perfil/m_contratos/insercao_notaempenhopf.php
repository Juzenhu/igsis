<?php
require("../conectar.php");

$link1="#";
$link2="#";
$link3="#";



$numeroNE=$_POST['NumeroNotaEmpenho'];
$emissaoNE=$_POST['DataEmissaoNotaEmpenho'];
$entregaNE=$_POST['DataEntregaNotaEmpenho'];
$idContrato=$_GET['idContrato'];

$update1 = "UPDATE contrato_pf SET 
			NumeroNotaEmpenho = '$numeroNE',
			DataEmissaoNotaEmpenho = '$emissaoNE',
			DataEntregaNotaEmpenho = '$entregaNE'
			WHERE Id_contratoPF = '$idContrato' ";

$stmt1 = mysqli_prepare($conexao,$update1);

 if(mysqli_stmt_execute($stmt1))
	  echo "<br><br>Qual modelo de documento deseja imprimir?<br>
	 <a href='$link1?id=$last_id'><button>Artistico</button></a><br />
	 <a href='$link2?id=$last_id'><button>Padrao</button></a><br />
	 <a href='$link3?id=$last_id'><button>Vocacional</button></a><br />
	 <br /></center>";
 

?>