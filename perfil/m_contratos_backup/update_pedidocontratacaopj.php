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

$link1="rlt_pedido_contratacao_pj.php";

$categoria=$_POST['Categoria'];
$objeto=$_POST['Objeto'];
$local=$_POST['LocalEspetaculo'];
$valor=$_POST['Valor'];
$formaPagamento=$_POST['FormaPagamento'];
$periodo=$_POST['Periodo'];
$duracao=$_POST['Duracao'];
$cargaHoraria=$_POST['CargaHoraria'];
$verba=$_POST['Verba'];
$justificativa=$_POST['Justificativa'];
$parecer=$_POST['ParecerTecnico'];
$fiscal=$_POST['Fiscal'];
$suplente=$_POST['Suplente'];
$observacao=$_POST['Observacao'];
$dataAtual=$_POST['DataAtual'];
$idUsuario=1;
$id_ped=$_GET['id_ped'];

$update = "UPDATE sis_pedido_contratacao_pj 
			SET 
			IdCategoria = '$categoria',
			Objeto = '$objeto',
			LocalEspetaculo = '$local',
			Valor = '$valor',
			FormaPagamento = '$formaPagamento',
			Periodo = '$periodo',
			Duracao = '$duracao',
			CargaHoraria = '$cargaHoraria',
			IdVerba = '$verba',
			Justificativa = '$justificativa',
			Fiscal = '$fiscal',
			Suplente = '$suplente',
			ParecerTecnico = '$parecer',
			Observacao = '$observacao',
			DataAtual = '$dataAtual'
			WHERE Id_PedidoContratacaoPJ = '$id_ped' ";

$stmt = mysqli_prepare($conexao,$update);

 if(mysqli_stmt_execute($stmt))
	  echo "<p>&nbsp;</p><h4><center>Pedido alterado com sucesso</h4><br>";
	  echo "<br><br><h6>Deseja imprimir o Pedido de Contratação?</h6><br>
	 <div class='form-group'>
            <div class='col-md-offset-2 col-md-8'>
	 <a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Imprimir</a>
	 <br /></center>";
 

?>