<?php
//include para contratos

if(isset($_GET['p'])){
	$p = $_GET['p'];	
}else{
	$p = "index";
	}
include "../funcoes/funcoesSiscontrat.php";	
include "m_contratos/".$p.".php";

?>