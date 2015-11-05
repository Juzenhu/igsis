<?php

function bancoImporta(){ 
	$servidor = 'localhost';
	$usuario = 'root';
	$senha = '';
	$banco = 'igsis';
	$con = mysqli_connect($servidor,$usuario,$senha,$banco); 
	mysqli_set_charset($con,"utf8");
	return $con;
}
$con = bancoImporta();

$sql_pesquisar = "SELECT * FROM ig_evento WHERE dataEnvio IS NOT NULL AND PUBLICADO = '1'";
$query = mysqli_query($con,$sql_pesquisar);
while($importa = mysqli_fetch_array($query)){
	$id = $importa['idEvento'];	
	$sql_importar = "INSERT INTO `igsis`.`ig_comunicacao` (`sinopse`, `fichaTecnica`, `autor`, `projeto`, `releaseCom`, `ig_evento_idEvento`, `nomeEvento`, `ig_tipo_evento_idTipoEvento`, `ig_programa_idPrograma`) SELECT `sinopse`, `fichaTecnica`, `autor`, `projeto`,`releaseCom`, `idEvento`, `nomeEvento`, `ig_tipo_evento_idTipoEvento`, `ig_programa_idPrograma` FROM `ig_evento` WHERE `idEvento` = '$id'";
	$query_importar = mysqli_query($con,$sql_importar);
	if($query_importar){
		echo "Evento ".$importa['nomeEvento']." importado com sucesso!<br />";	
	}else{
		echo "Erro ao importar Evento ".$importa['nomeEvento']."<br />";	
	}
}



?>