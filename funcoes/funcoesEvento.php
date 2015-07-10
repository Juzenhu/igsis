<?php 
/* Funções para o módulo evento

*/

function iniciaFormulario($idUsuario){
	unset($_SESSION['idEvento']);

	// Query para inserir um registro em branco
	$sql_inicio = "INSERT INTO  `ig_evento` (

`idEvento` ,
`ig_produtor_idProdutor` ,
`ig_tipo_evento_idTipoEvento` ,
`ig_programa_idPrograma` ,
`projetoEspecial` ,
`nomeEvento` ,
`projeto` ,
`memorando` ,
`idResponsavel` ,
`suplente` ,
`autor` ,
`fichaTecnica` ,
`faixaEtaria` ,
`sinopse` ,
`releaseCom` ,
`parecerArtistico` ,
`confirmaFinanca` ,
`confirmaDiretoria` ,
`confirmaComunicacao` ,
`confirmaDocumentacao` ,
`confirmaProducao` ,
`numeroProcesso` ,
`publicado` ,
`idUsuario`
)
VALUES (
NULL ,  '',  '',  '',  '',  '', NULL , NULL ,  '',  '',  '',  '',  '',  '',  '',  '', NULL , NULL , NULL , NULL , NULL , NULL , NULL , $idUsuario
)
";
	// Executa a query
	$con = bancoMysqli();
	mysqli_query($con,$sql_inicio);
	
	// Retorna o ID gerado na tabela ig_evento
	$sql_ultimo = "SELECT * FROM ig_evento ORDER BY idEvento DESC LIMIT 1";
	$id_evento = mysqli_query($con,$sql_ultimo);
	$id = mysqli_fetch_array($id_evento);
	$_SESSION['idEvento'] = $id['idEvento'];
	
}

function recuperaResponsavel($nomeResponsavel){
	$sql = "SELECT * FROM ig_usuario WHERE nomeUsuario = '%$nomeResponsavel%'";
	$con = bancoMysqli();
	$query = mysqli_query($sql,$con);
	$num_resultado = mysql_num_rows($query);
	if($num_resultado = 0){
		$campo['existe'] = 0;
		$campo['idUsuario'] = 0;
		$campo['nomeUsuario'] = "";
		return $campo; // retorna uma array com ['existe'] e ['idResponsavel']

	}else if($num_resultado = 1){
		$id = mysql_fetch_array($query);
		$campo['existe'] = 1;
		$campo['idResponsavel'] = $id['idUsuario']; 
		$campo['nomeUsuario'] = $id['nomeUsuario']; 
		return $campo;
	}
	
}

?>
