<?
require "../include/conecta_mysql.php"; //conecta no banco
require "../funcoes/funcoesGerais.php"; //carrega as funcoes gerais


 ?>

<? include "cabecalho.php" ?>

<? 
//include "../perfil/".$_SESSION['include'];
if(isset($_GET['perfil'])){
include "../perfil/".$_GET['perfil'].".php";	
	}else{
include "../perfil/inicio.php";
	}
?>

<? include "rodape.php" ?>
