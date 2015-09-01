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

$link1="rlt_proposta_padrao_pf.php";
$link2="rlt_proposta_artistico_pf.php";
$link3="rlt_proposta_eventoexterno_pf.php";
$link4="rlt_proposta_oficina_pf.php";
$link5="#";
$link6="#";
$link7="#";
$link8="#";
$link9="#";
$link10="#";


$processo=$_POST['NumeroProcesso'];
$numeroNE=$_POST['NumeroNotaEmpenho'];
$emissaoNE=$_POST['DataEmissaoNotaEmpenho'];
$entregaNE=$_POST['DataEntregaNotaEmpenho'];
$idContrato=$_GET['idContrato'];

$update1 = "UPDATE sis_contrato_pf SET 
			NumeroProcesso = '$processo',
			NumeroNotaEmpenho = '$numeroNE',
			DataEmissaoNotaEmpenho = '$emissaoNE',
			DataEntregaNotaEmpenho = '$entregaNE'
			WHERE Id_contratoPF = '$idContrato' ";

$stmt1 = mysqli_prepare($conexao,$update1);

 if(mysqli_stmt_execute($stmt1))
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
};

?>