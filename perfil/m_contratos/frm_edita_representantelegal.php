<?php

$con = bancoMysqli(); // conecta no banco

$ultimo = $_GET['id_rep']; //recupera o id da pessoa


if(isset($_POST['idPedido'])){
	$id_pedido = $_POST['idPedido']; //recupera o id do pedido
	$mensagem = $id_pedido;
}

if($_GET['id_rep'] == "" OR $_GET['id_rep'] == NULL){
	$pagina = "busca";	
	if(isset($_POST['pesquisar'])){
		$pagina = "pesquisar";	
	}
}else{
	$pagina = "editar";
}


if(isset($_POST['atualizarRepresentante'])){
	$id_rep = $_GET['id_rep'];
	$RepresentanteLegal = $_POST['RepresentanteLegal'];
	$RG = $_POST['RG'];
	$CPF = $_POST['CPF'];
	$Nacionalidade = $_POST['Nacionalidade'];
	$IdEstadoCivil = $_POST['IdEstadoCivil'];
	$sql_atualiza_rep = "UPDATE sis_representante_legal SET
	RepresentanteLegal = '$RepresentanteLegal',
	RG = '$RG',
	CPF = '$CPF',
	Nacionalidade = '$Nacionalidade'
	WHERE Id_RepresentanteLegal = '$id_rep'";
	$query_atualiza_rep = mysqli_query($con,$sql_atualiza_rep);
	if($query_atualiza_rep){
		$mensagem = "Autalizado com sucesso";	
	}else{
		$mensagem = "Erro!";
	}
	
	
}


?>

<?php include 'includes/menu.php';?>



<?php

switch($pagina){

case "busca":
?>

	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>REPRESENTANTE LEGAL #01 </h2>
                    <p>Você está inserindo representante legal </strong></p>

<p></p>

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            
                        <form method="POST" action="?perfil=contratos&p=frm_edita_representantelegal&num=<?php echo $_GET['num'] ?>&id_rep=" class="form-horizontal" role="form">
            		<label>Insira o CPF</label>
            		<input type="text" name="busca" class="form-control" id="cpf" >
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

<?php 
break;
case "pesquisar":
?>
<?php
	$busca = $_POST['busca'];
	$sql_busca = "SELECT * FROM sis_representante_legal WHERE CPF = '$busca' ORDER BY RepresentanteLegal";
	$query_busca = mysqli_query($con,$sql_busca); 
	$num_busca = mysqli_num_rows($query_busca);
	if($num_busca > 0){ // Se exisitr, lista a resposta.
	?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Executante - Pessoa Física</h2>
                                          
<p></p>

					</div>
				  </div>
			  </div>
              	<section id="list_items" class="home-section bg-white">
		<div class="container">
<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Nome</td>
							<td>CPF</td>
							<td width="15%"></td>
                            
						</tr>
					</thead>
					<tbody>
                    <?php
				while($descricao = mysqli_fetch_array($query_busca)){			
			echo "<tr>";
			echo "<td class='list_description'><b>".$descricao['RepresentanteLegal']."</b></td>";
			echo "<td class='list_description'>".$descricao['CPF']."</td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=contratos&p=frm_cadastra_propostapj&id_ped=".$_SESSION['idPedido']."'>
			<input type='hidden' name='insereRepresentante' value='".$descricao['Id_RepresentanteLegal']."'>
			<input type='hidden' name='numero' value='".$_GET['num']."'>
			<input type ='submit' class='btn btn-theme btn-md btn-block' value='inserir'></td></form>"	;
			echo "</tr>";
			}
?>
						
					</tbody>
				</table>
			</div>
            		</div>
                    </div>
                    
	</section>

<?php
	}else{ // se não existir o cpf, imprime um formulário.
 ?>

	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
            
					<h3>CADASTRO DE REPRESENTANTE LEGAL</h3>
                    <p>Não foi encontrado nenhum registro com o CPF <?php echo $busca; ?>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=contratos&p=frm_cadastra_propostapj&id_ped=<?php echo $_SESSION['idPedido'] ?>" method="post">
				  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Representante legal: *</strong><br/>
					  <input type="text" class="form-control" id="RepresentanteLegal" name="RepresentanteLegal" placeholder="Representante Legal">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>RG: *</strong><br/>
					  <input type="text" class="form-control" id="RG" name="RG" placeholder="RG">
					</div>
					<div class="col-md-6"><strong>CPF: *</strong><br/>
					  <input type="text" readonly class="form-control" id="cpf" name="CPF" value="<?php echo $busca ?>" placeholder="CPF">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Nacionalidade: *</strong><br/>
					  <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" placeholder="Nacionalidade">
					</div>
					<div class="col-md-6"><strong>Estado Civil: *</strong><br/>
					  <select class="form-control" name="IdEstadoCivil" id="IdEstadoCivil"><option>Estado Civil</option>
                      <?php
					  geraOpcao("sis_estado_civil","","");
					  ?>  
                      </select>
					</div>
				  </div>
                  
                  <!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="cadastraRepresentante" value="1" />

                    <input type="hidden" name="numero" value="<?php echo $_GET['num']; ?>" />
					 <input type="submit" name="enviar" value="CADASTRAR" class="btn btn-theme btn-lg btn-block">
					</div>
                    
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  



<?php } ?> 


<?php 
break;
case "editar":



$representante = recuperaDados("sis_representante_legal",$_GET['id_rep'],"Id_RepresentanteLegal");
?>
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
            
					<h3>CADASTRO DE REPRESENTANTE LEGAL</h3>
                    <?php if(isset($mensagem)){ echo $mensagem; } ?>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=contratos&p=frm_edita_representantelegal&num=<?php echo $_GET['num'] ?>&id_rep=<?php echo $_GET['id_rep'] ?>" method="post">
				  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Representante Legal: *</strong>
					  <input type="text" class="form-control" id="RepresentanteLegal" name="RepresentanteLegal" placeholder="Representante Legal" value="<?php echo $representante['RepresentanteLegal']; ?>">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>RG: *</strong>
					  <input type="text" class="form-control" id="RG" name="RG" placeholder="RG" value="<?php echo $representante['RG']; ?>">
					</div>
					<div class="col-md-6"><strong>CPF: *</strong>
					  <input type="text" class="form-control" id="cpf" name="CPF" placeholder="CPF" value="<?php echo $representante['CPF']; ?>">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Nacionalidade: *</strong>
					  <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" placeholder="Nacionalidade" value="<?php echo $representante['Nacionalidade']; ?>">
					</div>
					<div class="col-md-6"><strong>Estado Civil: *</strong>
					  <select class="form-control" name="IdEstadoCivil" id="IdEstadoCivil"><option>Estado Civil</option>
                      <?php
					  geraOpcao("sis_estado_civil",$representante['IdEstadoCivil'],"");
					  ?>  
                      </select>
					</div>
				  </div>
                  
                  <!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="atualizarRepresentante" value="1" />
					 <input type="submit" name="enviar" value="Atualizar" class="btn btn-theme btn-lg btn-block">
					</div>
                    
				  </div>
				</form>
	
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
   <a href="?perfil=contratos&p=frm_cadastra_propostapj&id_ped=<?php echo $_SESSION['idPedido']; ?>"><input type="submit" value="Voltar ao pedido" class="btn btn-theme btn-block"></a> 
					</div>
				  </div>
                                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <br />
					</div>
				  </div>		
                
                <!-- Botão para verificar arquivos da pessoa -->
				  <div class="form-group">
                <!-- Botão para verificar arquivos da pessoa -->
				  <div class="form-group">
               	<div class="col-md-offset-2 col-md-8">
                <form class="form-horizontal" role="form" action="?perfil=contratos&p=frm_arquivos&idPessoa=<?php echo $_GET['id_rep']; ?>&tipoPessoa=3" method="post">
                    <?php if(isset($id_pedido)){ ?>
                   <input type="hidden" name="idPedido" value="<?php echo $id_pedido ?>" />
                   <input type="hidden" name="representante" value="1" />
                   <?php } ?>

                    <input type="hidden" name="Sucesso" id="Sucesso" />
					 <input type="submit" value="Anexos" class="btn btn-theme btn-block">
				</form>
					</div>
                    </div>
                 <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                  	  <br />
					</div>
				  </div>	
                    
					<div class="form-group">
               	<div class="col-md-offset-2 col-md-8">
                    <?php if(isset($id_pedido)){ ?>
                    
                     <a href="?perfil=contratos&p=frm_edita_representantelegal&num=<?php $_GET['num'] ?>&id_pf="><input type="submit" value="Mudar o executante" class="btn btn-theme btn-block"></a>
                   <?php } ?>

					</div>
				  </div>

    
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  
	  <?php
break;
} // fecha a switch
?>

