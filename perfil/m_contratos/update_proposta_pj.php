
<?php
include 'includes/menu.php';
$conexao = bancoMysqli();
$server = "http://".$_SERVER['SERVER_NAME']."/igsis/";
$http = $server."/pdf/";
$link1=$http."rlt_proposta_padrao_pj.php";
$link2=$http."rlt_proposta_artistico_pj.php";
$link3=$http."rlt_proposta_comunicado_001-15_pj.php";
$link4=$http."rlt_proposta_eventoexterno_pj.php";
$link5=$http."rlt_declaracao_dados_bancarios_1rep_pj.php";
$link6=$http."rlt_declaracao_dados_bancarios_2rep_pj.php";
$link7=$http."rlt_declaracao_convenio500_1rep_pj.php";
$link8=$http."rlt_declaracao_convenio500_2rep_pj.php";
$link9=$http."rlt_pedido_reserva_padrao_pj.php";
$link10=$http."rlt_pedido_reserva_cooperativa_pj.php";
$link11=$http."rlt_pedido_reserva_fepac_pj.php";
$link12=$http."rlt_pedido_reserva_atividadecultural_pj.php";
$link13=$http."rlt_pedido_reserva_atividadecultural_cooperativa_pj.php";
$link14=$http."rlt_pedido_reserva_vocacional_pj.php";
$link15=$http."rlt_recibo_ne_1rep_pj.php";
$link16=$http."rlt_recibo_ne_2rep_pj.php";

$processo=$_POST['NumeroProcesso'];
$numeroNE=$_POST['NumeroNotaEmpenho'];
$emissaoNE= $_POST['DataEmissaoNotaEmpenho'];
$entregaNE= $_POST['DataEntregaNotaEmpenho'];
$assinatura = $_POST['Id_Assinatura'];
$idUsuario = $_SESSION['idUsuario'];
$id_ped=$_GET['id_ped'];

$update = "UPDATE igsis_pedido_contratacao 
			SET
			NumeroProcesso = '$processo',
			NumeroNotaEmpenho = '$numeroNE',
			DataEmissaoNotaEmpenho = '$emissaoNE',
			DataEntregaNotaEmpenho = '$entregaNE',
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
	 <a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Artistico</a>
	 <a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Comunicado</a>
	 <a href='$link4?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Evento Externo</a>
	 <a href='$link5?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração Dados Bancários - 01 Representante</a>
	 <a href='$link6?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração Dados Bancários - 02 Representantes</a>
	 <a href='$link7?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração Convênio 500 - 01 Representante</a>
	 <a href='$link8?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração Convênio 500 - 02 Representantes</a>
	 <a href='$link9?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Padrão</a>
	 <a href='$link10?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Cooperativa</a>
	 <a href='$link11?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva FEPAC</a>
	 <a href='$link12?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Programação de Atividade Cultural</a>
	 <a href='$link13?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Programação de Atividade Cultural - Cooperativa</a>
	 <a href='$link14?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Pedido de Reserva Vocacional</a>
	 <a href='$link15?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Recibo de Nota de Empenho - 01 Representante</a>
	 <a href='$link16?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Recibo de Nota de Empenho - 02 Representantes</a>
	 
	 <br /></center>";

}
?>


