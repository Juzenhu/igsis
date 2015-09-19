<?php
$conexao = bancoMysqli();
include 'includes/menu.php';
$server = $_SERVER['SERVER_NAME'];

$link1="http://$server/igsis/perfil/m_contratos/rlt_recibo_ne_pf.php";


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
{
		
	echo"<p>&nbsp;</p><h4><center>Dados Inseridos com sucesso!</h4><br>";
	 $last_id = mysqli_insert_id($conexao);
	 echo "<br><br><h6>Qual modelo de Recibo deseja imprimir?</h6><br>
	 <div class='form-group'>
            <div class='col-md-offset-2 col-md-8'>
	 <a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Padrão</a>
	 <br /></center>";
};
 var_dump($_POST);

?>