<?
//include para comunicação
require "../funcoes/funcoesComunicacao.php";
 ?>
<?php

// verifica se o usuário tem acesso a página
$verifica = verificaAcesso($_SESSION['idUsuario'],$_GET['perfil']); 
if($verifica == 1){

	if(isset($_GET['p'])){
		$p = $_GET['p'];	
	}else{
		$p = "inicial";
	}

	switch($p){
	
	case "inicial":

	if(isset($_GET['order'])){
		$order = $_GET['order'];
	}else{
		$order = "";
	}
	
	if(isset($_GET['sentido'])){
		$sentido = $_GET['sentido'];
		if($sentido == "ASC"){
			$invertido = "DESC";
		}else{
			$invertido = "ASC";
		}
	}
	
	
	
	?>
	<section id="list_items">
		<div class="container">
		<label></label>
		
			 <h3>Página Inicial - Comunicação</h3>
			 <h3><?php 
			$linha = listarComunicacao($order,$sentido);
			 ?></h3>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td width="10%"><a href="?perfil=comunicacao&order=idCom&sentido=<?php echo $invertido ?>">Codigo IGSIS</a></td>
							<td width="20%">Evento</td>
							<td width="20%">Enviado por</td>
							<td width="15%">Data de envio</td>

						</tr>
					</thead>
					<tbody>
<?php
for($i = 1; $i <= sizeof($linha); $i++){
//	$proponente = recuperaUsuario($linha_tabela_pedido_contratacaopf[$i]['Fiscal']);
?>
<tr>
<td class="list_description"><?php echo $linha[$i]['codigo']; ?></td>
<td class="list_description"><?php echo $linha[$i]['evento']; ?></td>
<td class="list_description"><?php echo $linha[$i]['enviadoPor']; ?></td>
<td class="list_description"><?php echo exibirDataBr($linha[$i]['dataEnvio']); ?></td>


<?php
}
?>
	
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<?php
	
	
	break;
	case "filtro":
	
		?>
	<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
		    <h1>Página Filtro - Comunicação</h1>
			
	</div>
</section> 
	<?php
	break;
	case "busca": ?>
	<?php
	if(isset($_POST['busca'])){
		$busca = $_POST['busca'];
		if(strlen(trim($busca)) < 3){
			$mensagem = "A busca deve conter mais de 3 caracteres. Tente novamente.";
			$buscaok = 0;
		}else{
			$buscaok = 1;
		$mensagem = "Você está buscando por ".$_POST['busca'];
		$con = bancoMysqli();	
		$sql_busca = "SELECT * FROM ig_evento JOIN ig_comunicacao ON  ig_evento.idEvento = ig_comunicacao.ig_evento_idEvento WHERE ig_evento.nomeEvento LIKE '%$busca%' OR ig_evento.sinopse LIKE '%$busca%'";
		$query_busca = mysqli_query($con,$sql_busca);
		
		}
	
		?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Busca - Comunicação</h2>
					 <p><?php if(isset($mensagem)){echo $mensagem;} ?></p>
  					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            
                        <form method="POST" action="?perfil=comunicacao&p=busca" class="form-horizontal" role="form">
          		<input type="text" name="busca" class="form-control" id="" placeholder="Digite uma expressão, palavra ou parte de palavra... mínimo de 3 letras">
            	</div>
             </div>
				<br />             
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
                	<input type="hidden" name="pesquisar" value="1" />
    		        <input type="submit" class="btn btn-theme btn-lg btn-block" value="Pesquisar">
                    </form>
        	    	</div>
        	    </div>
				
	        <div class="row">
            <div class="form-group">
			<?php 
		if($buscaok == 1){
			while($busca = mysqli_fetch_array($query_busca)){
			?>
			<p><?php echo $busca['nomeEvento'] ?></p>
	<?php } }?>
        	    	</div>
        	    </div>
				
            </div>
	</section>
	
	<?php
	}
	
	break;
	

		
	}
	
 }else{ ?>

<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
		    <h1>Você não tem acesso. Por favor, contacte o administrador do sistema.</h1>
		</div>
	</div>
</section>  
	 
 <?php } ?>