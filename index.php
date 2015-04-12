<?php 

/*
igSmc v0.1 - 2015
ccsplab.org - centro cultural são paulo
*/

// Esta é a página de login do usuário ou de contato com administrador do sistema.


if(isset($_POST['usuario'])){
	require "include/conecta_mysql.php";
	require "funcoes/funcoesGerais.php";
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	autenticaUsuario($usuario,$senha);	

}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IGSMC - v0.1 - 2015</title>
<link rel="stylesheet" href="visual/css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Engagement' rel='stylesheet' type='text/css'>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="visual/js/jquery.uniform.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
      $(function(){
        $("input:checkbox, input:radio, input:file, select").uniform();
      });
    </script>
</head>


<body>
    <div id="signup-form">
        <div id="signup-inner">
           	<div class="clearfix" id="header">
<center><img src="visual/images/logo.png" /></center>
<br />
<form method="post" action="index.php" >
		<p>
		<label name="usuario">Usuário</label>
		<input type="text" name="usuario" size="30" />
		</p>
        <p>
		<label name="usuario">Senha</label>
		<input type="password" name="senha" size="30"/>
		</p>
        <br />
        <p>
		<input type="submit" value="Entrar" />
		</p>
</form>
		</div>
	</div>
<center><img src="visual/images/rodape.png" /></center>
</div>

</body>
</html>
