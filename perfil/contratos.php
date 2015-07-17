<?php
//include para contratos

if(isset($_GET['p'])){
	$p = $_GET['p'];	
}else{
	$p = "index";
	}
	
include "m_contratos/".$p.".php";

?>