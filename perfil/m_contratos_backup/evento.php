<?php

if(isset($_GET['id_ped'])){
$evento = recuperaDados("ig_evento",$_GET['id_ped'],"idEvento");
}


if(isset($_GET['action'])){
	$action = $_GET['action'];
}else{
	$action = "evento";
}
?>
 	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2><?php echo $evento['nomeEvento'] ?></h2>
					<h4></h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                 </div>
				  </div>
			  </div>  
<?php
switch($action){
case "evento":
 ?>
			  <h5>Dados do evento | <a href="?perfil=contratos&p=evento&action=servicos&id_ped=<?php echo $_GET['id_ped']; ?>">Solicitação de serviços</a> | <a href="?perfil=contratos&p=evento&action=pedidos&id_ped=<?php echo $_GET['id_ped']; ?>">Pedidos de contratação</a></h5>
			<div class="table-responsive list_info" >
            <h4></h4>
            <p align="left">
              <?php descricaoEvento($_GET['id_ped']); ?>
                  </p>      
            <h5>Ocorrências</h5>
            <?php echo resumoOcorrencias($_GET['id_ped']); ?><br /><br />
            <?php listaOcorrenciasTexto($_GET['id_ped']); ?>
			<h5>Especificidades</h5>
			<div class="left">
            <?php descricaoEspecificidades($_GET['id_ped'],$evento['ig_tipo_evento_idTipoEvento']); ?>
			</div>
			<?php
break;
case "pedidos":
$pedido = listaPedidoContratacao($_GET['id_ped']);
?>
			  <h5> <a href="?perfil=contratos&p=evento&action=pedidos&id_ped=<?php echo $_GET['id_ped']; ?>">Dados do evento </a>|<a href="?perfil=contratos&p=evento&action=servicos&id_ped=<?php echo $_GET['id_ped']; ?>">Solicitação de serviços</a> | Pedidos de contratação</h5>
			  <div class="table-responsive list_info" >
            <h4><?php echo $evento['nomeEvento'] ?></h4>

			  <?php for($i = 0; $i < count($pedido); $i++){
			$dados = siscontrat($pedido[$i]);
			$pessoa = siscontratDocs($dados['IdProponente'],$dados['TipoPessoa']);
			?>
            <p align="left">
			Nome ou Razão Social: <b><?php echo $pessoa['Nome'] ?></b><br />
			Tipo de pessoa: <b><?php echo retornaTipoPessoa($dados['TipoPessoa']);?></b><br />
			Dotação: <b><?php echo retornaVerba($dados['Verba']);?></b><br />
			Valor:<b>R$ <?php echo dinheiroParaBr($dados['ValorGlobal']);?></b><br />		
			 </p>      
<?php } // fechamento do for ?>

 
			<?php
break;
case "servicos":

?>    
			  <h5> <a href="?perfil=contratos&p=evento&action=pedidos&id_ped=<?php echo $_GET['id_ped']; ?>">Dados do evento </a>| Solicitação de serviços | <a href="?perfil=contratos&p=evento&action=pedidos&id_ped=<?php echo $_GET['id_ped']; ?>">Pedidos de contratação</a></h5>
			<div class="table-responsive list_info" >
            <h4><?php echo $evento['nomeEvento'] ?></h4>
            <div class="left">
            
            <h5>Previsão de serviços externos</h5>
            <?php listaServicosExternos($_GET['id_ped']); ?><br /><br />

			<h5>Serviços Internos</h5>
			<?php listaServicosInternos($_GET['id_ped']) ?>

            </div>
<?php
break;
 } // fecha a switch action ?>	



