<?php 

function bancoExporta(){ 
	$servidor = 'localhost';
	$usuario = 'root';
	$senha = '';
	$banco = 'igccspbeta';
	$con = mysqli_connect($servidor,$usuario,$senha,$banco); 
	mysqli_set_charset($con,"utf8");
	return $con;
}

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




$sql_pesquisar = "SELECT * FROM ig_user";
$query = mysqli_query($con,$sql_pesquisar);
while($importa = mysqli_fetch_array($query)){
	$id = $importa['id_user'];	
	$sql_importar = "INSERT INTO ig_usuario2 (`senha`,  `ig_papelusuario_idPapelUsuario`, `receberNotificacao`, `nomeUsuario`, `email`, `nomeCompleto`, `idInstituicao`,  `rf`) SELECT `senha`, `tipo_autorizacao`, `receber_email`, `user`, `email`, `nome`, `id_grupos`,`rf` FROM ig_user WHERE id_user = '$id'";
	$query_importar = mysqli_query($con,$sql_importar);
	if($query_importar){
		echo "Usuário ".$importa['user']." importado com sucesso!<br />";	
	}else{
		echo "Erro ao importar usuário ".$importa['user']."<br />";	
	}
}


/*
RF

*/       


?>
