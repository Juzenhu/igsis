<?php
//Imprime erros com o banco
@ini_set('display_errors', '1');
error_reporting(E_ALL);

// Conecta-se com o MySQL 
mysql_connect("localhost", "root", "lic54eca"); 
// Converte caracteres utf8 para evitar erros no banco
mysql_query("SET NAMES 'utf8';");
// Seleciona banco de dados 
mysql_select_db("igsis_beta"); 
// Assegura que as entradas e saídas sejam em utf-8
header('Content-Type: text/html; charset=utf-8');
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

$sql = "SELECT * FROM ig_local";
$query = mysql_query($sql);

while($campo = mysql_fetch_array($query)){
	$sala = $campo['sala'];
	$instituicao = $campo['idInstituicao'];
	$sql_inserir = "INSERT INTO ig_espaco (ig_instituicao_idInstituicao,espaco) VALUES('$instituicao','$sala')";
		if(mysql_query($sql_inserir)){
			echo "$sala inserido com sucesso";
		
		}else{
			echo "Erro ao inserir";
		}
		
	
	}


?>