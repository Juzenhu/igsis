<?php
//include para contratos

if(isset($_GET['p'])){
	$p = $_GET['p'];	
}else{
	$p = "index";
	}
	
include "m_juridico/".$p.".php";

?>