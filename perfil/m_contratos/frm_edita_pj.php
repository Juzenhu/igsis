<!DOCTYPE html>
<html>
  <head>
    <title>IGSIS</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/style.css" rel="stylesheet" media="screen">
	<link href="../color/default.css" rel="stylesheet" media="screen">
	<script src="../js/modernizr.custom.js"></script>
      </head>
  <body>
<?php
require("../conectar.php");

$id_pj=$_GET['id_pj'];

$sql_query_tabelas_pj ="SELECT * FROM sis_pessoa_juridica 
							
							WHERE Id_PessoaJuridica = $id_pj";

$consulta_tabelas = mysqli_query($conexao,$sql_query_tabelas_pj);
$linha_tabelas = mysqli_fetch_assoc ($consulta_tabelas);


$consulta_tabela_representante_legal = mysqli_query ($conexao,"SELECT * FROM sis_representante_legal");
$linha_tabela_representante_legal= mysqli_fetch_assoc($consulta_tabela_representante_legal);

?>	
    	<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">CADASTRO DE PESSOA JURÍDICA</div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" <?php echo "action='update_pessoajuridica.php?id_pj=$id_pj'" ;?> method="post">
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Id:</strong><br/>
					  <input type="text" class="form-control" id="Id_PessoaJuridica"  name="Id_PessoaJuridica" <?php echo " value='$id_pj' ";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Razão Social:</strong><br/>
					  <input type="text" class="form-control" id="RazaoSocial" name="RazaoSocial" placeholder="RazaoSocial" <?php echo "value='$linha_tabelas[RazaoSocial]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>CNPJ:</strong><br/>
					  <input type="text" class="form-control" id="CNPJ" name="CNPJ" placeholder="CNPJ" <?php echo "value='$linha_tabelas[CNPJ]'";?>>
					</div>
					<div class="col-md-6"><strong>CCM:</strong><br/>
					  <input type="text" class="form-control" id="CCM" name="CCM" placeholder="CCM" <?php echo "value='$linha_tabelas[CCM]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>CEP:</strong><br/>
					  <input type="text" class="form-control" id="IdEndereco" name="IdEndereco" placeholder="CEP">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Endereço:</strong><br/>
					  <input type="text" class="form-control" id="" name="" placeholder="Endereço">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Número:</strong><br/>
					  <input type="text" class="form-control" id="Numero" name="Numero" placeholder="Numero" <?php echo "value='$linha_tabelas[Numero]'";?>>
					</div>
					<div class="col-md-6"><strong>Complemento:</strong><br/>
					  <input type="text" class="form-control" id="Complemento" name="Complemento" placeholder="Complemento" <?php echo "value='$linha_tabelas[Complemento]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone1" name="Telefone1" placeholder="Telefone" <?php echo "value='$linha_tabelas[Telefone1]'";?>>
					</div>				  
					<div class=" col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone2" name="Telefone2" placeholder="Telefone" <?php echo "value='$linha_tabelas[Telefone2]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone3" name="Telefone3" placeholder="Telefone" <?php echo "value='$linha_tabelas[Telefone3]'";?>>
					</div>				  
					<div class=" col-md-6"><strong>E-mail:</strong><br/>
					  <input type="text" class="form-control" id="Email" name="Email" placeholder="E-mail" <?php echo "value='$linha_tabelas[Email]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Representante Legal:</strong><br/>
					  <select class="form-control" id="IdRepresentanteLegal1" name="IdRepresentanteLegal1" > <option>Selecione</option>
					 <!-- Código do combobox aqui -->
					  </select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Representante Legal:</strong><br/>
					  <select class="form-control" id="IdRepresentanteLegal2" name="IdRepresentanteLegal2" ><option>Selecione</option>
					  <!-- Código do combobox aqui -->
					  </select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Data da Atualização do Cadastro:</strong><br/>
					  <input type="text" class="form-control" id="DataAtualizacao" name="DataAtualizacao" placeholder="Data da Atualização do Cadastro" <?php echo "value='$linha_tabelas[DataAtualizacao]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observações:</strong><br/>
					  <input type="text" class="form-control" id="Observacao" name="Observacao" placeholder="Observações" <?php echo "value='$linha_tabelas[Observacao]'";?>>
					</div>
				  </div>
				  
				  
				<!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <input type="submit" value="GRAVAR" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  





<!--footer -->
<?php include 'includes/footer.html';?>

  	
</html>