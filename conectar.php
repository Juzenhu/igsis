<?php
/*DECLARAÇÃO DE VARIÁVEIS*/


$conexao = mysqli_connect("localhost","root","","igsis");
$conexao->set_charset('utf-8');

 //CONECTAR COM: servidor, usuario, senha, banco
//mysqli_query("SET NAMES 'utf8';");
//header('Content-Type: text/html; charset=utf-8');
//mysqli_query("SET NAMES 'utf8'");
//mysqli_query('SET character_set_connection=utf8');
//mysqli_query('SET character_set_client=utf8');
//mysqli_query('SET character_set_results=utf8');

/*TESTAR CONEXÃO*/	
	If(!$conexao)
	die ("Conexão Geral Falhou</br>".mysql_error());

?>
	