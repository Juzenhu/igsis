<?php

// Conexão de Banco MySQLi

// Cria conexao ao banco. Substitui o include "conecta_mysql.php" .
function bancoMysqli(){ 
	$servidor = 'localhost';
	$usuario = 'root';
	$senha = '';
	$banco = 'igsis';
	$con = mysqli_connect($servidor,$usuario,$senha,$banco); 
	mysqli_set_charset($con,"utf8");
	return $con;
}

// Cria conexao ao banco de CEPs.
function bancoMysqliCep(){ 
	$servidor = 'localhost';
	$usuario = 'root';
	$senha = '';
	$banco = 'cep';
	$con = mysqli_connect($servidor,$usuario,$senha,$banco); 
	mysqli_set_charset($con,"utf8");
	return $con;
}


?>