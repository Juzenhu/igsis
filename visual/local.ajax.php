<?php
//Imprime erros com o banco
//@ini_set('display_errors', '1');
//error_reporting(E_ALL);

//header( 'Cache-Control: no-cache' );
//header( 'Content-type: application/xml; charset="utf-8"', true );

include "../funcoes/funcoesConecta.php";
//mysqli_set_charset($con,"utf8");

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
		'espaco'			=> (($row['espaco'])),
	);
}

echo( json_encode( $cidades ) );

?>