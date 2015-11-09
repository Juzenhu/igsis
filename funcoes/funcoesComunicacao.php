<?php 

function listaCom($st,$intituicao,$num_registro,$pagina,$ordem){
	$con = bancoMysqli();

	//tratamento dos parametros
	$status = "";


	switch($st){
	case "todos":
		$status = "";
	break;
	case "editado":
		$status = " AND editado = '1' ";
	break;
	case "revisado":
		$status = " AND revisado = '1' ";
	break;
	case "site":
		$status = " AND site = '1' ";
	break;
	case "publicacao":
		$status = " AND publicacao = '1' ";
	break;
	}

	
	$sql_busca_dic = "SELECT * FROM ig_comunicacao WHERE ig_evento_idEvento IS NOT NULL $status ORDER BY idCom $ordem LIMIT 0,$num_registro";
	$query_busca_dic = mysqli_query($con,$sql_busca_dic);
	$i = 0;
		while($dic = mysqli_fetch_array($query_busca_dic)){ 
			$evento = recuperaDados("ig_evento",$evento['ig_evento_idEvento'],"idEvento");
			$usuario = recuperaUsuario($event['idUsuario']);
			
			$x[$i]['nomeEvento'] = $dic['nomeEvento'];
			$x[$i]['protocoloIg'] = retornaProtoEvento($dic['ig_evento_idEvento']);
			$x[$i]['idUsuario'] = $usuario['nomeCompleto'];
			$x[$i]['nomeEvento'] = retornaPeriodo($dic['ig_evento_idEvento']);
			$x[$i]['idEvento'] = $dic['idEvento'];
		}
	return $x;
}





?>

