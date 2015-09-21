

<?php
include 'includes/menu.php';
$conexao = bancoMysqli();
$server = "http://".$_SERVER['SERVER_NAME']."/igsis/";
$http = $server."/pdf/";
$id_ped = $_GET['id_ped'];
$assinatura = $_POST['Id_Assinatura'];
$idUsuario = $_SESSION['idUsuario'];

$link1=$http."rlt_proposta_padrao_pj.php";
$link2=$http."rlt_proposta_artistico_pj.php";
$link3=$http."rlt_proposta_eventoexterno_pj.php";
$link4=$http."rlt_proposta_padrao_pf.php";

$update = "UPDATE igsis_pedido_contratacao 
			SET
			
			idAssinatura = '$assinatura'
			WHERE IdPedidoContratacao = '$id_ped' ";

$stmt = mysqli_prepare($conexao,$update);

if( mysqli_stmt_execute($stmt))
{
	echo"<p>&nbsp;</p><h4><center>Dados Inseridos com sucesso!</h4><br>";
	 $last_id = mysqli_insert_id($conexao);
	 echo "<br><br><h6>Qual modelo de proposta deseja imprimir?</h6><br>
	 <div class='form-group'>
            <div class='col-md-offset-2 col-md-8'>
	 <a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Padrão</a>
	 <a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Artístico</a>
	 <a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Evento Externo</a>
	 <a href='$link4?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Oficina</a>
	 <br /></center>";
};


?>