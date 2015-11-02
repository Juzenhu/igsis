<?php
require_once("../funcoes/funcoesVerifica.php");
require_once("../funcoes/funcoesSiscontrat.php");
if(isset($_GET['idEvento'])){
	$evento = verificaCampos($_GET['idEvento']);
	$ocorrencia = verificaOcorrencias($_GET['idEvento']);	
}



?>



<?php 
if(isset($_GET['p'])){
	$p = $_GET['p'];	
}else{
	$p = "inicio";
}
switch($p){
case 'inicio':

?>
<?php include "../include/menuBusca.php"; ?>

<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                <h2>Buscas e pesquisas</h2>
	                <h5>Escolha uma opção</h5>
                </div>
            </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?perfil=busca&p=eventos" class="btn btn-theme btn-lg btn-block">Eventos</a>
	            <!--<a href="?perfil=busca&p=pedidos" class="btn btn-theme btn-lg btn-block">Pedidos de contratação</a>-->
	            <a href="?perfil=busca&p=pessoa" class="btn btn-theme btn-lg btn-block">Pessoa física / Pessoa Jurídica</a>                
  	            <a href="?perfil=busca&p=igsis" class="btn btn-theme btn-lg btn-block">Instituições, usuários e espaços</a>
            </div>
          </div>
        </div>
    </div>
</section>    

<?php
break;
case "eventos":
?>
<?php include "../include/menuBusca.php"; ?>
<?php
if(isset($_POST['pesquisa']) AND strlen($_POST['pesquisa']) > 2 ){
$resultado = busca($_POST['pesquisa'],1);
$mensagem = "Foram encontradas ".$resultado['numReg']." eventos com o termo '".$_POST['pesquisa']."'.";
?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Busca por Evento</h3>
                    

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?>
                   

            	</div>
             </div>
				<br />             
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
               <div class="left">
               <?php 
			   $link_evento="?perfil=busca&p=detalhe&evento=";
			   echo "<h5>Evento</h5>";
			   if($resultado['numReg'] > 0){
				   for($i = 0; $i < $resultado['numReg']; $i++){
					   echo "<p><a href='".$link_evento.$resultado[$i]['idEvento']."' target='_blank'>".$resultado[$i]['nomeEvento']." (".retornaTipo($resultado[$i]['tipo']).")</a><br />";
						echo "Responsável: ".$resultado[$i]['responsavel']." (".$resultado[$i]['instituicao'].")  - enviado em ".exibirDataBr($resultado[$i]['dataEnvio'])."</p>";
							
				   }
			   }else{
					echo "Não foram encontrados eventos com o termo de pesquisa.";
			   }
			   ?>
               <br />
          
               </div>

		            
        	    	</div>
<div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	           <br /><br />            
            </div>
          </div>    

				<div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?perfil=busca&p=eventos" class="btn btn-theme btn-lg btn-block">Fazer outra busca eventos</a>                
            </div>
          </div>           	    </div>

            </div>
	</section>


<?php
}else{
?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Busca por Evento</h2>
                     <p>Os campos em que ocorrerá a busca são: Nome do Evento, Autor, Ficha técnica, Sinopse, Release e Projeto.</p>
                     <p>É possível pesquisar por parte da palavra. Deve-se ter pelo menos 3 caracteres para busca.</p>
                    

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?>
                        <form method="POST" action="?perfil=busca&p=eventos" class="form-horizontal" role="form">
            		<label>Busca por palavras</label>
                    
                    
            		<input type="text" name="pesquisa" class="form-control" id="palavras" placeholder="" ><br />

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

            </div>
	</section>
    <?php } ?>


<?php
break;
case "pedidos":

?>
<?php include "../include/menuBusca.php"; ?>

<?php
break;
case "pessoa":
?>
<?php include "../include/menuBusca.php"; ?>
<?php
if(isset($_POST['pesquisa']) AND strlen($_POST['pesquisa']) > 2 ){
$resultado = busca($_POST['pesquisa'],2);
$mensagem = "Foram encontradas ".$resultado['numReg']." pessoas com o termo '".$_POST['pesquisa']."'.";
?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Busca por Pessoa Física ou Jurídica</h3>
                    

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?>
                   

            	</div>
             </div>
				<br />             
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
               <div class="left">
               <?php 
			   $link_pj="?perfil=busca&p=detalhe&id_pj=";
			   $link_pf="?perfil=busca&p=detalhe&id_pf=";
			   echo "<h5>Pessoa Física</h5>";
			   if($resultado['numPf'] > 0){
				   for($i = 0; $i < $resultado['numPf']; $i++){
					   echo "<a href='".$link_pf.$resultado['fisica'][$i]['IdPessoa']."' target='_blank'>".$resultado['fisica'][$i]['Nome']." (".$resultado['fisica'][$i]['CPF'].")</a><br />";
				   }
			   }else{
					echo "Não foram encontradas pessoas físicas.";
			   }
			   ?>
               <br />
               <?php 
			   echo "<h5>Pessoa Jurídica</h5>";
			   if($resultado['numPj'] > 0){
				   for($i = 0; $i < $resultado['numPj']; $i++){
					   echo "<a href='".$link_pj.$resultado['juridica'][$i]['IdPessoa']."'target='_blank'>".$resultado['juridica'][$i]['Nome']." (".$resultado['juridica'][$i]['CNPJ'].")</a><br />";
				   }
			   }else{
					echo "Não foram encontradas pessoas jurídicas.";
				   
				}
			   ?>               
               </div>

		            
        	    	</div>
<div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	           <br /><br />            
            </div>
          </div>    

				<div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?perfil=busca&p=pessoa" class="btn btn-theme btn-lg btn-block">Fazer outra busca por Pessoa física / Pessoa Jurídica</a>                
            </div>
          </div>           	    </div>

            </div>
	</section>


<?php
}else{
?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Busca por pessoas</h2>
                     <p>Os campos em que ocorrerá a busca são: Nome Completo, Nome artístico, Função, Nacionalidade, Razão Social</p>
                     <p>É possível pesquisar por parte da palavra. Deve-se ter pelo menos 3 caracteres para busca.</p>
                    

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?>
                        <form method="POST" action="?perfil=busca&p=pessoa" class="form-horizontal" role="form">
            		<label>Busca por palavras</label>
                    
                    
            		<input type="text" name="pesquisa" class="form-control" id="palavras" placeholder="" ><br />

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

            </div>
	</section>
    <?php } ?>

<?php
break;
case "igsis":
?>
<?php include "../include/menuBusca.php"; ?>

<?php
if(isset($_POST['pesquisa']) AND strlen($_POST['pesquisa']) > 2 ){
$resultado = busca($_POST['pesquisa'],3);
$mensagem = "Foram encontradas ".$resultado['numReg']." eventos com o termo '".$_POST['pesquisa']."'.";
?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Busca por instituições, usuários e espaços</h3>
                    

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?>
                   

            	</div>
             </div>
				<br />             
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
               <div class="left">
               <?php 
			   $link_instituicao="?perfil=busca&p=detalhe&evento=";
			   echo "<h5>Instituições</h5>";
			   if($resultado['num_instituicao'] > 0){
				   for($i = 0; $i < $resultado['num_instituicao']; $i++){
					   echo "<p><strong>".$resultado['instituicao'][$i]['nome']." (".$resultado['instituicao'][$i]['sigla'].")</strong><br />";
					
							
				   }
			   }else{
					echo "Não foram encontradas instituições com o termo de pesquisa.";
			   }
			   ?>
               <br />
               <br />
               <?php 
			   $link_usuario="?perfil=busca&p=detalhe&evento=";
			   echo "<h5>Usuários</h5>";
			   if($resultado['num_usuario'] > 0){
				   for($i = 0; $i < $resultado['num_usuario']; $i++){
					   echo "<p><strong>".$resultado['usuario'][$i]['nome']." (".$resultado['usuario'][$i]['instituicao'].")</strong><br />";
						echo "Email: ".$resultado['usuario'][$i]['email']."  - Telefone: ".$resultado['usuario'][$i]['telefone']."</p>";
							
				   }
			   }else{
					echo "Não foram encontrados usuários com o termo de pesquisa.";
			   }
			   ?>
               <br />
               <br />
                <?php 
			   $link_local="?perfil=busca&p=detalhe&evento=";
			   echo "<h5>Espaços</h5>";
			   if($resultado['num_local'] > 0){
				   for($i = 0; $i < $resultado['num_local']; $i++){
					  echo "<p><strong>".$resultado['local'][$i]['nome']."  (".$resultado['local'][$i]['instituicao'].")</strong><br />";
							
				   }
			   }else{
					echo "Não foram encontrados espaços com o termo de pesquisa.";
			   }
			   ?>    
               <br />
               <br />                    
               </div>

		            
        	    	</div>
<div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	           <br /><br />            
            </div>
          </div>    

				<div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?perfil=busca&p=igsis" class="btn btn-theme btn-lg btn-block">Fazer outra busca</a>                
            </div>
          </div>           	    </div>

            </div>
	</section>


<?php
}else{
?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Busca por instituições, usuários e espaços</h2>
                     <p>Os campos em que ocorrerá a busca são: nome do instituição, nome do usuário, salas e espaços</p>
                     <p>É possível pesquisar por parte da palavra. Deve-se ter pelo menos 3 caracteres para busca.</p>
                    

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?>
                        <form method="POST" action="?perfil=busca&p=igsis" class="form-horizontal" role="form">
            		<label>Busca por palavras</label>
                    
                    
            		<input type="text" name="pesquisa" class="form-control" id="palavras" placeholder="" ><br />

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

            </div>
	</section>
    <?php } ?>

<?php
break;
case "detalhe":
	if(isset($_GET['evento'])){
		$evento = recuperaDados('ig_evento',$_GET['evento'],'idEvento');
?>

	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					                     

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
			<div class="table-responsive list_info" >
            <h4><?php echo $evento['nomeEvento'] ?></h4>
            <p align="left">
              <?php descricaoEvento($_GET['evento']); ?>
                  </p>      
            <h5>Ocorrências</h5>
            <?php echo resumoOcorrencias($_GET['evento']); ?><br /><br />
            <?php listaOcorrenciasTexto($_GET['evento']); ?>
			<h5>Especificidades</h5>
			<div class="left">
            <?php descricaoEspecificidades($_GET['evento'],$evento['ig_tipo_evento_idTipoEvento']); ?>
			</div>

			<?php
//require "../funcoes/funcoesSiscontrat.php";
$pedido = listaPedidoContratacao($_GET['evento']);
?>
			  <div class="table-responsive list_info" >
<?php if($pedido != NULL){ ?>

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
<?php } // fechamento do for 

}else{ ?>
	<h5> Não há pedidos de contratação. </h5>
<?php	
}
?>
			<div class="table-responsive list_info" >
            <h4></h4>
            <div class="left">
            
            <h5>Previsão de serviços externos</h5>
            <?php listaServicosExternos($_GET['evento']); ?><br /><br />

			<h5>Serviços Internos</h5>
			<?php listaServicosInternos($_GET['evento']) ?>

</div>
</div>
            </div>
</section>

<?php
}
if(isset($_GET['id_pf'])){
$pessoa = recuperaPessoa($_GET['id_pf'],1);
$idPessoa = $_GET['id_pf'];
?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
			<h3><?php echo $pessoa['nome'] ?></h3><br />
					 <div align="left">

			CPF: <b><?php echo $pessoa['numero'];?></b><br />
			Email: <b><?php echo $pessoa['email'];?></b><br />
			Telefones: <b> <?php echo $pessoa['telefones'];?></b><br />
             </div>                     

					</div>
                    <h5>Pedidos de contratação</h5>
                   <div class="left">
				   <?php
				   $con = bancoMysqli();
				   $sql_lista_pedido = "SELECT * FROM igsis_pedido_contratacao WHERE idPessoa = '$idPessoa' AND tipoPessoa = '1' AND publicado ='1'";
				    $query_lista_pedido = mysqli_query($con,$sql_lista_pedido);
					while($pedido = mysqli_fetch_array($query_lista_pedido)){
						
						echo $pedido['idPedidoContratacao']."<br />";	
					}
				    ?> 
                    </div>
				  </div>
			  </div>
			  
	        <div class="row">
			<div class="table-responsive list_info" >
 
			</div>
            </div>
</div>
</section>

<?php
}
?>
<?php
if(isset($_GET['id_pj'])){
$pessoa = recuperaPessoa($_GET['id_pj'],2);
$idPessoa = $_GET['id_pj'];
?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
			<h3><?php echo $pessoa['nome'] ?></h3><br />
					 <div align="left">

			CPF: <b><?php echo $pessoa['numero'];?></b><br />
			Email: <b><?php echo $pessoa['email'];?></b><br />
			Telefones: <b> <?php echo $pessoa['telefones'];?></b><br />
             </div>                     

					</div>
                    <h5>Pedidos de contratação</h5>
                   <div class="left">
				   <?php
				   $con = bancoMysqli();
				   $sql_lista_pedido = "SELECT * FROM igsis_pedido_contratacao WHERE idPessoa = '$idPessoa' AND tipoPessoa = '2' AND publicado ='1'";
				    $query_lista_pedido = mysqli_query($con,$sql_lista_pedido);
					while($pedido = mysqli_fetch_array($query_lista_pedido)){
						
						echo $pedido['idPedidoContratacao']."<br />";	
					}
				    ?> 
                    </div>
				  </div>
			  </div>
			  
	        <div class="row">
			<div class="table-responsive list_info" >
 
			</div>
            </div>
</div>
</section>
<?php
}
?>
<?php
break;
}

 ?>