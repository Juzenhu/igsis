<?php

if(isset($_POST['finalizar'])){

	$con = bancoMysqli();
	$datetime = date("Y-m-d H:i:s");
	$instituicao = $_SESSION['idInstituicao'];
	$idEvento = $_SESSION['idEvento'];
	$sql_atualiza_evento = "UPDATE ig_evento SET dataEnvio = '$datetime' WHERE idEvento = '$idEvento'";
	$query_atualiza_evento = mysqli_query($con,$sql_atualiza_evento);
	if($query_atualiza_evento){
		gravarLog($sql_atualiza_evento);	
	}
	$sql_atualiza_pedido = "UPDATE `igsis`.`igsis_pedido_contratacao` SET 
	`estado` = 'publicado',
	 `instituicao` = '$instituicao'
	WHERE `igsis_pedido_contratacao`.`idEvento` = '$idEvento'";
	$query_atualiza_pedido = mysqli_query($con,$sql_atualiza_pedido);
		if($query_atualiza_evento){
			gravarLog($sql_atualiza_pedido);
			$sql_protocolo = "INSERT INTO `ig_protocolo` (`idProtocolo`, `ig_evento_idEvento`, `publicado`, `dataInsercao`) VALUES (NULL, '$idEvento', '1', '$datetime')";
			$query_protocolo = mysqli_query($con,$sql_protocolo);
			if($query_protocolo){
				gravarLog($sql_protocolo);
				$protocolo = recuperaUltimo("ig_protocolo");
				$mensagem = "O formulário de evento foi enviado com sucesso. O protocolo é IGSIS.".$protocolo." . <br />";
				$sql_recupera_pedidos = "SELECT * FROM igsis_pedido_contratacao WHERE idEvento = '$idEvento' AND publicado = '1'";
				$query_recupera_pedidos = mysqli_query($con,$sql_recupera_pedidos);
				$num_pedidos = mysqli_num_rows($query_recupera_pedidos);
				if($num_pedidos > 0){
					while($pedido = mysqli_fetch_array($query_recupera_pedidos)){
						$idPedido = $pedido['idPedidoContratacao'];
						$idUsuario = $_SESSION['idUsuario'];
						$sql_fecha_pedido = "INSERT INTO `sis_protocolo` (`idProtocolo`, `idPedido`, `data`, `userId`) VALUES (NULL, '$idPedido', '$datetime', '$idUsuario')";
						$query_fecha_pedido = mysqli_query($con,$sql_fecha_pedido);
						$i = 0;
						if($sql_fecha_pedido){
								gravarLog($sql_fecha_pedido);
								$protoPedido = recuperaUltimo("sis_protocolo");
								$pedidos[$i] = $protoPedido;
								$mensagem = $mensagem."Foi gerado um pedido de contratação com o Protocolo 2015.$protocolo.".$pedidos[$i].".<br />";
								$i++;
							
						} 
					}
					
				}
				
					
			}else{
				$mensagem = "Erro ao gerar protocolo";
			}		
		}else{
				$mensagem = "Erro ao enviar formulário";	
		}

// Gera um registro em ig_comunicacao
$sql_pesquisar = "SELECT * FROM ig_evento WHERE idEvento = '$idEvento'";
$query = mysqli_query($con,$sql_pesquisar);
while($importa = mysqli_fetch_array($query)){
	$sql_importar = "INSERT INTO `igsis`.`ig_comunicacao` (`sinopse`, `fichaTecnica`, `autor`, `projeto`, `releaseCom`, `ig_evento_idEvento`, `nomeEvento`, `ig_tipo_evento_idTipoEvento`, `ig_programa_idPrograma`, `idInstituicao`) 
	SELECT `sinopse`, `fichaTecnica`, `autor`, `projeto`,`releaseCom`, `idEvento`, `nomeEvento`, `ig_tipo_evento_idTipoEvento`, `ig_programa_idPrograma`, `idInstituicao` FROM `ig_evento` WHERE `idEvento` = '$idEvento'";
	$query_importar = mysqli_query($con,$sql_importar);
	if($query_importar){
		$mensagem_com = "Registro na Divisão de Comunicação e Informação efetuado com sucesso.";
	}else{
		$mensagem_com = "Erro ao registrar evento na Divisão de Comunicação e Informação.";
	}
}		
	
// Criar data para fechamento
// Criar Protocolo da IG
// Criar Protocolo dos Pedidos de Contratação
// Enviar e-mail para as áreas interessadas
// Fecha sessão
// Verificar datas

$_SESSION['idEvento'] = NULL;	

}


?>

	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Envio confirmado!</h3>
                     
<p><?php //var_dump($_SESSION); ?></p>
<p><?php if(isset($mensagem)){echo $mensagem;} ?></p>
<p><?php if(isset($mensagem_com)){echo $mensagem_com;} ?></p>
<p><a href="?p=inicio">Voltar ao início.</a></p>

					</div>
				  </div>
			  </div>
			  
		</div>
	</section>