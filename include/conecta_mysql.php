<?php
// Conecta-se com o MySQL 
mysql_connect("localhost", "ccsplab", "ccsplab123"); 
// Converte caracteres utf8 para evitar erros no banco
mysql_query("SET NAMES 'utf8';");
// Seleciona banco de dados 
mysql_select_db("mydb"); 
// Assegura que as entradas e saídas sejam em utf-8
header('Content-Type: text/html; charset=utf-8');
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

?>
