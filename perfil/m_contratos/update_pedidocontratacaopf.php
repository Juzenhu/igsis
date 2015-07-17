<?php
require("../conectar.php");

$link1="#";
$link2="#";
$link3="#";


$objeto=$_POST['Objeto'];
$local=$_POST['LocalEspetaculo'];
$valor=$_POST['Valor'];
$valorPorExtenso=$_POST['ValorPorExtenso'];
$valorIndividual=$_POST['ValorIndividual'];
$valorIndividualPorExtenso=$_POST['ValorIndividualPorExtenso'];
$formaPagamento=$_POST['FormaPagamento'];
$periodo=$_POST['Periodo'];
$duracao=$_POST['Duracao'];
$cargaHoraria=$_POST['CargaHoraria'];
//$verba=$_POST['IdVerba'];
$justificativa=$_POST['Justificativa'];
$parecer=$_POST['ParecerTecnico'];
$fiscal=$_POST['Fiscal'];
$suplente=$_POST['Suplente'];
$observacao=$_POST['Observacao'];
$idUsuario=1;
$id_ped=$_GET['id_ped'];

$update = "UPDATE pedido_contratacao_pf 
			SET 
			Objeto = '$objeto',
			LocalEspetaculo = '$local',
			Valor = '$valor',
			ValorPorExtenso = '$valorPorExtenso',
			ValorIndividual = '$valorIndividual',
			ValorIndividualPorExtenso ='$valorIndividualPorExtenso',
			FormaPagamento = '$formaPagamento',
			Periodo = '$periodo',
			Duracao = '$duracao',
			CargaHoraria = '$cargaHoraria',
			Justificativa = '$justificativa',
			Fiscal = '$fiscal',
			Suplente = '$suplente',
			ParecerTecnico = '$parecer',
			Observacao = '$observacao'
			WHERE Id_PedidoContratacaoPF = '$id_ped' ";

$stmt = mysqli_prepare($conexao,$update);

 if(mysqli_stmt_execute($stmt))
	  echo "<br><br>Pedido alterado com sucesso<br>
	 <a href='$link1?id=$id_ped'><button>Artistico</button></a><br />
	 <a href='$link2?id=$id_ped'><button>Padrao</button></a><br />
	 <a href='$link3?id=$id_ped'><button>Vocacional</button></a><br />
	 <br /></center>";
 


?>