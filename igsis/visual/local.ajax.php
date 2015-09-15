<?php
//Imprime erros com o banco
@ini_set('display_errors', '1');
error_reporting(E_ALL);

//header( 'Cache-Control: no-cache' );
//header( 'Content-type: application/xml; charset="utf-8"', true );

$con = mysql_connect( 'localhost', 'root', 'lic54eca' ) ;
mysql_select_db( 'igsis_beta', $con );

$cod = mysql_real_escape_string( $_GET['instituicao'] );

$cidades = array();

$sql = "SELECT idEspaco, espaco
		FROM ig_espaco
		WHERE ig_instituicao_idInstituicao= '$cod'
		ORDER BY espaco";
$res = mysql_query( $sql );
while ( $row = mysql_fetch_assoc( $res ) ) {
	$cidades[] = array(
		'idEspaco'	=> $row['idEspaco'],
		'espaco'			=> (utf8_encode($row['espaco'])),
	);
}

echo( json_encode( $cidades ) );

?>