

<?php

include 'includes/menu.php';
$conexao = bancoMysqli();
$server = $_SERVER['SERVER_NAME'];
$link0="http://$server/igsis/pdf/";
$link1=$link0."rlt_reserva_padrao_pf.php";
$link2=$link0."rlt_reserva_fepac_pf.php";
$link3=$link0."rlt_reserva_cooperativa_pf.php";


$processo=$_POST['NumeroProcesso'];

$id_ped=$_GET['id'];
$idContrato=$_GET['idContrato'];

$incluir = "UPDATE igsis_pedido_contratacao 
			SET NumeroProcesso = '$processo' 
			WHERE idPedidoContratacao = '$id_ped' ";

//PREPARANDO A VARIAVEL DO UPDATE
$stmt = mysqli_prepare($conexao,$incluir);

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

