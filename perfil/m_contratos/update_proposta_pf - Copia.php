
<?php
include 'includes/menu.php';
$conexao = bancoMysqli();
$server = "http://".$_SERVER['SERVER_NAME']."/igsis/";
$http = $server."/pdf/";
$link1=$http."rlt_proposta_padrao_pf.php";
$link2=$http."rlt_proposta_artistico_pf.php";
$link3=$http."rlt_proposta_eventoexterno_pf.php";
$link4=$http."rlt_proposta_oficina_pf.php";
$link5=$http."rlt_declaracao_dados_bancarios_pf.php";
$link6=$http."rlt_declaracao_convenio500_pf.php";
$link7=$http."rlt_pedido_reserva_padrao_pf.php";
$link8=$http."rlt_pedido_reserva_fepac_pf.php";
$link9=$http."rlt_pedido_reserva_cooperativa_pf.php";
$link10=$http."rlt_recibo_ne_pf.php";



$assinatura = $_POST['Id_Assinatura'];
$idUsuario = $_SESSION['idUsuario'];
$id_ped=$_GET['id_ped'];

$update = "UPDATE igsis_pedido_contratacao 
			SET
			
			idAssinatura = '$assinatura'
			WHERE IdPedidoContratacao = '$id_ped' ";

$stmt = mysqli_prepare($conexao,$update);

 if(mysqli_stmt_execute($stmt))
{
 	echo"<p>&nbsp;</p><h4><center>Dados Inseridos com sucesso!</h4><br>";
	 $last_id = mysqli_insert_id($conexao);
	 echo "<br><br><h6>Qual modelo de documento deseja imprimir?</h6><br>
	 <div class='form-group'>
            <div class='col-md-offset-2 col-md-8'>
	 <a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Padrão</a>
	 <a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Artístico</a>
	 <a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Evento Externo</a>
	 <a href='$link4?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Oficina</a>
	 <a href='$link5?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração Dados Bancários</a>
	 <a href='$link6?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração Convênio 500</a>
	 <a href='$link7?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Padrão</a>
	 <a href='$link8?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva FEPAC</a>
	 <a href='$link9?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Cooperativas</a>
	 <a href='$link10?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Recibo de Entrega de Nota de Empenho</a>
	 <br /></center>";

}
?>


