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

$link1="rlt_proposta_padrao_pj.php";
$link2="rlt_proposta_artistico_pj.php";
$link3="rlt_proposta_eventoexterno_pj.php";
$link4="rlt_proposta_oficina_pj.php";



$IdPedidoContratacaoPJ=$_POST['Id_PedidoContratacaoPJ'];
$IdUsuario=1;
$IdAssinatura=$_POST['Id_Assinatura'];

$id_ped=$_GET['id'];


$incluir = "INSERT INTO sis_contrato_pj
(
IdPedidoContratacaoPJ,
IdUsuario,
IdAssinatura
)
Values
(
'$IdPedidoContratacaoPJ',
'$IdUsuario',
'$IdAssinatura'
)";

$stmt = mysqli_prepare($conexao,$incluir);

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