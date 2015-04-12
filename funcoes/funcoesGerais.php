<?php 

/*
igSmc v0.1 - 2015
ccsplab.org - centro cultural são paulo
*/

// Esta é a página para as funções gerais do sistema.

function autenticaUsuario($usuario, $senha){ //autentica usuario e cria inicia uma session
	
	$sql = "SELECT * FROM ig_usuario, ig_instituicao, ig_papelusuario WHERE ig_usuario.nomeUsuario = '$usuario' AND ig_instituicao.idInstituicao = ig_usuario.instituicao AND ig_papelusuario.idPapelUsuario = ig_usuario.idPapelUsuario LIMIT 0,1"; //query que seleciona os campos que voltarão para na matriz
	if(mysql_query($sql)){ //verifica erro no banco de dados
	$query = mysql_query($sql);
		if(mysql_num_rows($query) > 0){ // verifica se retorna usuário válido
			$user = mysql_fetch_array($query);
				if($user['senha'] == md5($_POST['senha'])){ // compara as senhas
					session_start();
					$_SESSION['usuario'] = $user['nomeUsuario'];
					$_SESSION['perfil'] = $user['idPapelUsuario'];
					$_SESSION['instituicao'] = $user['instituicao'];
					$_SESSION['include'] = $user['include'];
					header("Location: visual/index.php"); 
				}else{
			echo "A senha está incorreta.";
			}
		}else{
			echo "O usuário não existe.";
		}
	}else{
		echo "Erro no banco de dados";
	}	
}



?>