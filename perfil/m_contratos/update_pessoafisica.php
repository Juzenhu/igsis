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

$link1="frm_lista_propostapf.php";
$link2="index.php";


$nome=$_POST['Nome'];
$nomeArtistico=$_POST['NomeArtistico'];
$rg=$_POST['RG'];
$cpf=$_POST['CPF'];
$ccm=$_POST['CCM'];
$idEstadoCivil=$_POST['IdEstadoCivil'];
$dataNascimento=$_POST['DataNascimento'];
$nacionalidade=$_POST['Nacionalidade'];
$numero=$_POST['Numero'];
$complemento=$_POST['Complemento'];
$telefone1=$_POST['Telefone1'];
$telefone2=$_POST['Telefone2'];
$telefone3=$_POST['Telefone3'];
$email=$_POST['Email'];
$drt=$_POST['DRT'];
$funcao=$_POST['Funcao'];
$inss=$_POST['InscricaoINSS'];
$omb=$_POST['OMB'];
$dataAtual=$_POST['DataAtualizacao'];
$observacao=$_POST['Observacao'];
$id_pf=$_GET['id_pf'];



$atualiza_tabela_pf = "UPDATE sis_pessoa_fisica SET
		
		Nome = '$nome',
		NomeArtistico = '$nomeArtistico',
		RG = '$rg',
		CPF = '$cpf',
		CCM = '$ccm',
		IdEstadoCivil = '$idEstadoCivil',
		DataNascimento = '$dataNascimento',
		Nacionalidade = '$nacionalidade',
		Numero = '$numero',
		Complemento = '$complemento',
		Telefone1 = '$telefone1',
		Telefone2 = '$telefone2',
		Telefone2 = '$telefone3',
		Email = '$email',
		DRT = '$drt',
		Funcao = '$funcao',
		InscricaoINSS = '$inss',
		OMB = '$omb',
		DataAtualizacao = '$dataAtual',
		Observacao = '$observacao'
		WHERE Id_PessoaFisica = $id_pf
		";
	
$stmt = mysqli_prepare($conexao,$atualiza_tabela_pf);		
 if(mysqli_stmt_execute($stmt))
{
	echo"<p>&nbsp;</p><h4><center>Dados Inseridos com sucesso!</h4><br>";
	 $last_id = mysqli_insert_id($conexao);
	 echo "<br><br><h6>O que deseja fazer?</h6><br>
	 <div class='form-group'>
            <div class='col-md-offset-2 col-md-8'>
	 <a href='$link1' class='btn btn-theme btn-lg btn-block'>Alterar Proposta de Pessoa Física</a>
	 <a href='$link2' class='btn btn-theme btn-lg btn-block'>Voltar ao Início</a>
	 <br /></center>";
}


?>