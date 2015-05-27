<?
//iniciar session
/* session_start();
	if(!isset ($_SESSION['usuario']) == true) //verifica se há uma sessão, se não, volta para área de login
		{
			unset($_SESSION['usuario']);
			header('location:../index.php');
	}else{
		$logado = $_SESSION['usuario'];
	}
	*/?>

<!DOCTYPE html>
<html>
  <head>
    <title>IGSIS - Secretaria Municipal de Cultural - São Paulo</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
	<link href="color/default.css" rel="stylesheet" media="screen">
	<script src="js/modernizr.custom.js"></script>

  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="js/jquery.maskMoney.js" type="text/javascript"></script>
  <script>
  $(function() {
    $( "#datepicker01" ).datepicker();
    $( "#anim" ).change(function() {
      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
    });
  });
    $(function() {
    $( "#datepicker02" ).datepicker();
    $( "#anim" ).change(function() {
      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
    });
  });
  $(function(){
	$( "#hora" ).mask("99:99");
  });

 
    $(function() {
    $('#valor').maskMoney({thousands:'', decimal:',', allowZero:true, suffix: ''});
  });

  </script>
<script>
  $(function() {
    $('#duracao').maskMoney({thousands:'', decimal:'', allowZero:true, suffix: ''});
  })
</script>
      </head>
  <body>
  <div id="bar">
  <p id="p-bar">Olá, visitante</p>
  </div>
