<?php 

function verificaAcesso($usuario,$pagina){
	$sql = "SELECT * FROM ig_usuario,ig_papelusuario WHERE ig_usuario.idUsuario = $usuario AND ig_usuario.ig_papelusuario_idPapelUsuario = ig_papelusuario.idPapelUsuario LIMIT 0,1";
	$query = mysql_query($sql);
	$verifica = mysql_fetch_array($query);
	if($verifica["$pagina"] == 1){
		return 1;
	}else{
		return 0;
	}
}

?>