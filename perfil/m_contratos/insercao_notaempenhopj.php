<?php
$conexao = bancoMysqli();
include 'includes/menu.php';
$server = $_SERVER['SERVER_NAME'];

$link1="http://$server/igsis/pdf/";
$link2="";
$link3="";

$numeroNE=$_POST['NumeroNotaEmpenho'];
$emissaoNE= $_POST['DataEmissaoNotaEmpenho'];
$entregaNE= $_POST['DataEntregaNotaEmpenho'];

$id_ped=$_GET['id'];
//$idContrato=$_GET['idContrato'];

$update1 = "UPDATE igsis_pedido_contratacao SET 
			NumeroNotaEmpenho = '$numeroNE',
			DataEmissaoNotaEmpenho = '$emissaoNE',
			DataEntregaNotaEmpenho = '$entregaNE'
			WHERE idPedidoContratacao = '$id_ped' ";

$stmt1 = mysqli_prepare($conexao,$update1);

 if(mysqli_stmt_execute($stmt1))
	  echo "<br><br>Qual modelo de documento deseja imprimir?<br>
	 <a href='$link1?id=$id_ped'><button>Artistico</button></a><br />
	 <a href='$link2?id=$id_ped'><button>Padrao</button></a><br />
	 <a href='$link3?id=$id_ped'><button>Vocacional</button></a><br />
	 <br /></center>";
 
 var_dump($_POST);

?>

