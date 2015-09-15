<?php

include "../include/conecta_mysql.php";
	$sql = "SELECT nomeUsuario FROM ig_usuario";
	$query = mysql_query($sql);
	$dados = mysql_fetch_array($query);
    echo json_encode($dados);
?>