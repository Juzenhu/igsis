﻿<?php
	$servidor = 'localhost';
	$usuario = 'root';
	$senha = 'lic54eca';
	$banco = 'cep';
	$con = mysqli_connect($servidor,$usuario,$senha,$banco); 
	mysqli_set_charset($con,"utf8");

if(isset($_GET['cep'])){
	$cep = $_GET['cep'];	
}else{
$cep = $_POST['CEP'];
}
$cep_index = substr($cep, 0, 5);

$sql01 = "SELECT * FROM cep_log_index WHERE cep5 = '$cep_index' LIMIT 0,1";
$query01 = mysqli_query($con,$sql01);
$campo01 = mysqli_fetch_array($query01);
$uf = $campo01['uf'];

$sql02 = "SELECT * FROM $uf WHERE cep = '$cep'";
$query02 = mysqli_query($con,$sql02);
$campo02 = mysqli_fetch_array($query02);
$res = mysql_num_rows($query02);
 if($res > 0){
$dados['sucesso'] = 1;
 }else{
$dados['sucesso'] = 0;
 
 }
$dados['rua']     = $campo02['tp_logradouro']." ".$campo02['logradouro'];
$dados['bairro']  = $campo02['bairro'];
$dados['cidade']  = $campo02['cidade'];
$dados['estado']  = $campo01['uf'];
 
echo json_encode($dados);
 
?>