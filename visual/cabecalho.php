<?php
//iniciar session
/* Define o limitador de cache para 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* Define o limite de tempo do cache em 30 minutos */
session_cache_expire(30);
$cache_expire = session_cache_expire();




 session_start();
	if(!isset ($_SESSION['usuario']) == true) //verifica se há uma sessão, se não, volta para área de login
		{
			unset($_SESSION['usuario']);
			header('location:../index.php');
	}else{
		$logado = $_SESSION['usuario'];
	}
	

	?>

<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
    <title>IGSIS - Secretaria Municipal de Cultural - São Paulo</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
	<link href="color/default.css" rel="stylesheet" media="screen">


  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<?php include "../include/script.php"; ?>
      </head>
  <body>
  <div id="bar">
  <p id="p-bar"><img src="images/logo_pequeno.png" /><?php echo saudacao(); ?>, <?php echo $_SESSION['nomeCompleto']; ?> <?php if(isset($_SESSION['idEvento'])){verificaEdicao($_SESSION['idEvento']);} ?> </p>
  </div>
