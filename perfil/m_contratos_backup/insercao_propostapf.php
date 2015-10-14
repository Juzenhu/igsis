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
$link5="rlt_declaracao_dados_bancarios_pf.php";
$link6="rlt_declaracao_convenio500_pf.php";


$IdPedidoContratacaoPF=$_POST['Id_PedidoContratacaoPF'];
$IdUsuario=1;
$IdAssinatura=$_POST['Id_Assinatura'];

$id_ped=$_GET['id'];

$incluir = "INSERT INTO sis_contrato_pf
(
IdPedidoContratacaoPF,
IdUsuario,
IdAssinatura
)
Values
(
'$IdPedidoContratacaoPF',
'$IdUsuario',
'$IdAssinatura'
)";

$stmt = mysqli_prepare($conexao,$incluir);

if( mysqli_stmt_execute($stmt))
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
	 <br /></center>";
};


?>
