<?php
// Conecta-se com o MySQL 
mysql_connect("localhost", "root", "lic54eca"); 
// Converte caracteres utf8 para evitar erros no banco
mysql_query("SET NAMES 'utf8';");
// Seleciona banco de dados 
mysql_select_db("cep"); 
// Assegura que as entradas e saídas sejam em utf-8
header('Content-Type: text/html; charset=utf-8');
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

$cep = $_POST['cep'];
$cep_index = $parte = substr($cep, 0, 5);

$sql01 = "SELECT uf FROM cep_log_index WHERE cep5 = '$cep_index' LIMIT 0,1";
$query01 = mysql_query($sql01);
$campo01 = mysql_fetch_array($query);
$uf = $campo01['uf'];

$sql02 = "SELECT * FROM $uf WHERE cep = $cep";
$query02 = mysql_query($sql02);
$campo02 = mysql_fetch_array($query02);
 
$dados['sucesso'] = 1;
$dados['rua']     = $campo02['tp_logradouro']." ".$campo02['logradouro'];
$dados['bairro']  = $campo02['bairro'];
$dados['cidade']  = $campo02['cidade'];
$dados['estado']  = $campo01['uf'];
 
echo json_encode($dados);
 
?>