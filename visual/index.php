<?php
//Imprime erros com o banco
@ini_set('display_errors', '1');
error_reporting(E_ALL);

//carrega as funcoes gerais
require "../funcoes/funcoesConecta.php";
require "../funcoes/funcoesGerais.php"; 

//carrega o cabeçalho
require "cabecalho.php"; 

// carrega o perfil
if(isset($_GET['perfil'])){ 
	include "../perfil/".$_GET['perfil'].".php";

}else{
	include "../perfil/inicio.php";
}

 //carrega o rodapé
include "rodape.php"; 

?>
