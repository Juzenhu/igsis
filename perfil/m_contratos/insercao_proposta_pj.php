<?php

include 'includes/menu.php';
$conexao = bancoMysqli();
$server = "http://".$_SERVER['SERVER_NAME']."/igsis/";
$http = $server."/pdf/";

$link1=$http."rlt_proposta_padrao_pj.php";
$link2=$http."rlt_proposta_artistico_pj.php";
$link3=$http."rlt_proposta_comunicado_001-15_pj.php";
$link4=$http."rlt_proposta_eventoexterno_pj.php";
$link5=$http."rlt_declaracao_dados_bancarios_1rep_pj.php";
$link6=$http."rlt_declaracao_dados_bancarios_2rep_pj.php";
$link7=$http."rlt_declaracao_convenio500_1rep_pj.php";
$link8=$http."rlt_declaracao_convenio500_2rep_pj.php";

	$id_ped = $_GET['id_ped'];
	$valor = $_POST['Valor']; 
	$valor_individual = $_POST['ValorIndividual'];
	$forma_pagamento = $_POST['FormaPagamento'];
	$verba = $_POST['Verba'];
	$justificativa = $_POST['Justificativa'];
	$fiscal = $_POST['Fiscal'];
	$suplente  = $_POST['Suplente'];
	$parecer = $_POST['ParecerTecnico'];
	$observacao = $_POST['Observacao'];
	$idUsuario = $_SESSION['idUsuario'];

	$sql_atualiza_pedido = "UPDATE igsis_pedido_contratacao SET
		valor = '$valor',
		valorIndividual = '$valor_individual',
		formaPagamento = '$forma_pagamento',
		idVerba = '$verba',
		justificativa = '$justificativa',
		observacao = '$observacao',
		parecerArtistico = '$parecer',
		IdUsuarioContratos = '$idUsuario',
		estado = 'Proposta'
		WHERE idPedidoContratacao = '$id_ped'";
	
	$stmt = mysqli_prepare($conexao,$sql_atualiza_pedido);

 if(mysqli_stmt_execute($stmt))
{
	echo"<p>&nbsp;</p><h4><center>Dados Inseridos com sucesso!</h4><br>";
	 $last_id = mysqli_insert_id($conexao);
	 echo "<br><br><h6>Qual modelo de proposta deseja imprimir?</h6><br>
	 <div class='form-group'>
            <div class='col-md-offset-2 col-md-8'>
	 <a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Padrão</a>
	 <a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Artistico</a>
	 <a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Comunicado</a>
	 <a href='$link4?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Proposta Evento Externo</a>
	 <a href='$link5?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração Dados Bancários - 01 Representante</a>
	 <a href='$link6?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração Dados Bancários - 02 Representantes</a>
	 <a href='$link7?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração Convênio 500 - 01 Representante</a>
	 <a href='$link8?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Declaração Convênio 500 - 02 Representantes</a>
	 <br /></div></div>";
};


?>