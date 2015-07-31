<?php
	include "../funcoes/funcoesGerais.php";
	$con = bancoMysqli();
	ini_set('display_errors', true);
	error_reporting(E_ALL);
 
	if( isset( $_GET['status'] ) )
	{
		$status = 1;
		$id = $_GET['id'];
		$sql = 'UPDATE `igsis_arquivos_pessoa` SET `3x4` = '.$status.' WHERE `idArquivosPessoa` = '.$id;
 		$query = mysqli_query($con,$sql);
		
	}
 		
	
	
	
?>