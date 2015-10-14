<?php

include 'includes/menu.php';
$conexao = bancoMysqli();
$server = $_SERVER['SERVER_NAME'];
$http="http://$server/igsis/pdf/";
$link1=$http."rlt_pedido_reserva_padrao_pj.php";
$link2=$http."rlt_pedido_reserva_cooperativa_pj.php";
$link3=$http."rlt_pedido_reserva_fepac_pj.php";
$link4=$http."rlt_pedido_reserva_atividadecultural_pj.php";
$link5=$http."rlt_pedido_reserva_vocacional_pj.php";

$processo=$_POST['NumeroProcesso'];

$id_ped=$_GET['id'];

$incluir = "UPDATE igsis_pedido_contratacao 
			SET NumeroProcesso = '$processo',
				estado = 'Processo'			 
			WHERE idPedidoContratacao = '$id_ped' ";

//PREPARANDO A VARIAVEL DO UPDATE
$stmt = mysqli_prepare($conexao,$incluir);

//EXECUTANDO A VARIAVEL DO UPDATE
if( mysqli_stmt_execute($stmt))
{
	echo"<p>&nbsp;</p><h4><center>Dados Inseridos com sucesso!</h4><br>";
	 $last_id = mysqli_insert_id($conexao);
	 echo "<br><br><h6>Qual modelo de Pedido de Reserva deseja imprimir?</h6><br>
	 <div class='form-group'>
            <div class='col-md-offset-2 col-md-8'>
	 <a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Padrão</a>
	 <a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Cooperativa</a>
	 <a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>FEPAC</a>
	 <a href='$link4?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Programação de Atividade Cultural</a>
	 <a href='$link5?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Vocacional</a>
	 <br /></div></div>";
};
?>

