<?php


require "../funcoes/funcoesConecta.php";
$con = bancoMysqli();


$cod = mysqli_real_escape_string( $con,$_GET['instituicao'] );

$cidades = array();

$sql = "SELECT *
		FROM ig_espaco
		WHERE ig_instituicao_idInstituicao = '$cod'
		ORDER BY espaco";
$res = mysqli_query($con,$sql);

while ( $row = mysqli_fetch_array( $res ) ) {
	$cidades[] = array(
		'idEspaco'	=> $row['idEspaco'],
		'espaco'			=> ($row['espaco']),
	);
}

echo( json_encode( $cidades ) );

?>