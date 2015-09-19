<?php
$conexao = bancoMysqli();
include 'includes/menu.php';
try{
$link1="m_contratos&p=rlt_pedido_contratacao_pf";
$url = urlAtual();
$server = $_SERVER['SERVER_NAME'];

$assinatura = $_POST['Id_Assinatura'];
$idUsuario = $_SESSION['idUsuario'];
$id_ped=$_GET['id_ped'];

$update = "UPDATE igsis_pedido_contratacao 
			SET
			
			idAssinatura = '$assinatura'
			WHERE IdPedidoContratacao = '$id_ped' ";

$stmt = mysqli_prepare($conexao,$update);

 if(mysqli_stmt_execute($stmt))
 	echo "<p>$url -  $server</p><br />";
	  echo "<p>&nbsp;</p><h4><center>Pedido alterado com sucesso</h4><br>";
	  echo "<br><br><h6>Deseja imprimir o Pedido de Contratação?</h6><br>
	  
	 <div class='form-group'>
            <div class='col-md-offset-2 col-md-8'>
	 <a href='http://$server/igsis/perfil/m_contratos/rlt_pedido_contratacao_pf.php?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Imprimir</a>
	 <br /></center>";
}
catch (Exception $e) {
    echo $e->getMessage();
}


?>