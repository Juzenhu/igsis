<?php

if(isset($_POST['finalizar'])){

	$con = bancoMysqli();
	$datetime = date("Y-m-d H:i:s");
	$idEvento = $_SESSION['idEvento'];
	$sql_atualiza_evento = "UPDATE ig_evento SET dataEnvio = '$datetime' WHERE idEvento = '$idEvento'";
	$query_atualiza_evento = mysqli_query($con,$sql_atualiza_evento);
		if($query_atualiza_evento){
			$sql_protocolo = "INSERT INTO `ig_protocolo` (`idProtocolo`, `ig_evento_idEvento`, `publicado`, `dataInsercao`) VALUES (NULL, '$idEvento', '1', '$datetime')";
			$query_protocolo = mysqli_query($con,$sql_protocolo);
			if($query_protocolo){
				$protocolo = recuperaUltimo("ig_protocolo");
				$mensagem = "O formulário de evento foi enviado com sucesso. O protocolo é IGSIS.E.".$protocolo['idProtocolo']." .";
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
								$protoPedido = recuperaUltimo("sis_protocolo");
								$pedidos[$i] = $protoPedido;
							
						} 
						
						
						}	
				}
				
					
			}else{
				$mensagem = "Erro ao gerar protocolo";
			}		
		}else{
				$mensagem = "Erro ao enviar formulário";	
		}


// Criar data para fechamento
// Criar Protocolo da IG
// Criar Protocolo dos Pedidos de Contratação
// Enviar e-mail para as áreas interessadas

// Verificar datas

	

}


?>

	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Teste Array Siscontrat</h3>
<p><?php //echo $endereco; ?></p>
<p><?php if(isset($mensagem)){echo $mensagem;} ?></p>


					</div>
				  </div>
			  </div>
			  
		</div>
	</section>