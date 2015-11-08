<?php

function somaVerba($idInstituicao,$pessoa){
	$con = bancoMysqli();
	$sql = "SELECT * FROM sis_verba WHERE idInstituicao = '$idInstituicao' AND pai IS NOT NULL";
	$query = mysqli_query($con,$sql);
	$total = 0;
	while($valor = mysqli_fetch_array($query)){
		$total = $total + $valor[$pessoa];
	}
	return $total;		
	
}

function somaPedido($idInstituicao,$pessoa){
	$con = bancoMysqli();
	$sql = "SELECT * FROM igsis_pedido_contratacao,ig_evento,ig_usuario WHERE igsis_pedido_contratacao.idEvento = ig_evento.idEvento AND ig_evento.idUsuario = ig_usuario.idUsuario AND ig_usuario.idInstituicao = '$idInstituicao' AND igsis_pedido_contratacao.tipoPessoa = '$pessoa' AND igsis_pedido_contratacao.publicado = '1'"; //recupera todos os pedidos pessoa física
	$query = mysqli_query($con,$sql);
	$total = 0;
	while($valor = mysqli_fetch_array($query)){
		$total = $total + $valor['valor'];	
	}	
	return $total;
}

?>
