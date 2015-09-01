<!DOCTYPE html>
<html>
  <head>
    <title>IGSIS</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/style.css" rel="stylesheet" media="screen">
	<link href="../color/default.css" rel="stylesheet" media="screen">
	<script src="../js/modernizr.custom.js"></script>
      </head>
  <body>

<?php
require("../conectar.php");
include 'includes/menu.php';

$link1="rlt_recibo_ne_pf.php";



$numeroNE=$_POST['NumeroNotaEmpenho'];
$emissaoNE=$_POST['DataEmissaoNotaEmpenho'];
$entregaNE=$_POST['DataEntregaNotaEmpenho'];

$id_ped=$_GET['id'];
$idContrato=$_GET['idContrato'];

$update1 = "UPDATE sis_contrato_pf SET 
			NumeroNotaEmpenho = '$numeroNE',
			DataEmissaoNotaEmpenho = '$emissaoNE',
			DataEntregaNotaEmpenho = '$entregaNE'
			WHERE Id_contratoPF = '$idContrato' ";

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
 

?>