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

$link1="rlt_reserva_padrao_pf.php";
$link2="rlt_reserva_fepac_pf.php";
$link3="rlt_reserva_cooperativa_pf.php";


$processo=$_POST['NumeroProcesso'];

$id_ped=$_GET['id'];
$idContrato=$_GET['idContrato'];

$incluir = "UPDATE sis_contrato_pf 
			SET NumeroProcesso = '$processo' 
			WHERE Id_contratoPF = '$idContrato' ";

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
	 <a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>FEPAC</a>
	 <a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Cooperativa</a>
	 <br /></center>";
};
?>