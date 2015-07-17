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

$id_pf=$_GET['id_pf'];

$sql_query_tabelas_pf ="SELECT * FROM pessoa_fisica WHERE Id_PessoaFisica = $id_pf";

$consulta_tabelas = mysqli_query($conexao,$sql_query_tabelas_pf);
$linha_tabelas = mysqli_fetch_assoc ($consulta_tabelas);

//var_dump($atualiza_tabela_pf)


?>	

<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">CADASTRO DE PESSOA FÍSICA</div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" <?php echo "action='update_pessoafisica.php?id_pf=$id_pf'" ;?> method="post">
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Id Pessoa Física:</strong><br/>
					  <input type="text" class="form-control" id="Id_PessoaFisica"  name="Id_PessoaFisica" <?php echo "value='$id_pf'"; ?> >
					</div>
				  </div>
                  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Foto:</strong><br/>
					  <input type="text" class="form-control" id="Foto"  name="Foto" placeholder="Foto" <?php echo "value='$linha_tabelas[Foto]'";?>>
					</div>
				  </div>
				 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Nome:</strong><br/>
					  <input type="text" class="form-control" id="Nome" name="Nome" placeholder="Nome" <?php echo "value='$linha_tabelas[Nome]'";?>>
					</div>
				  </div>

                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Nome Artístico:</strong><br/>
					  <input type="text" class="form-control" id="NomeArtistico" name="NomeArtistico" placeholder="Nome Artístico" <?php echo "value='$linha_tabelas[NomeArtistico]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>RG:</strong><br/>
					  <input type="text" class="form-control" id="RG" name="RG" placeholder="RG" <?php echo "value='$linha_tabelas[RG]'";?>>
					</div>				  
					<div class=" col-md-6"><strong>CPF:</strong><br/>
					  <input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF" <?php echo "value='$linha_tabelas[CPF]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>CCM:</strong><br/>
					  <input type="text" class="form-control" id="CCM" name="CCM" placeholder="CCM" <?php echo "value='$linha_tabelas[CCM]'";?>>
					</div>				  
					<div class=" col-md-6"><strong>Estado Civil:</strong><br/>
					  <select class="form-control" id="IdEstadoCivil" name="IdEstadoCivil" <?php echo "value='$linha_tabelas[IdEstadoCivil]'";?> ><option>Estado Civil</option>
					   <?php
						do
						{
						echo "<option value='$linha_tabela_estado_civil[Id_EstadoCivil]'>$linha_tabela_estado_civil[EstadoCivil]</option>";
						}
						while ($linha_tabela_estado_civil = mysqli_fetch_assoc($consulta_tabela_estado_civil))
						?>  
					  </select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Data de Nascimento:</strong><br/>
					  <input type="text" class="form-control" id="DataNascimento" name="DataNascimento" placeholder="Data de Nascimento" <?php echo "value='$linha_tabelas[DataNascimento]'";?>>
					</div>				  
					<div class=" col-md-6"><strong>Nacioinalidade:</strong><br/>
					  <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" placeholder="Nacionalidade" <?php echo "value='$linha_tabelas[Nacionalidade]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>CEP:</strong><br/>
					  <input type="text" class="form-control" id="" name="" placeholder="CEP">
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
					<div class=" col-md-6"><strong>Complemento:</strong><br/>
					  <input type="text" class="form-control" id="Complemento" name="Complemento" placeholder="Complemento" <?php echo "value='$linha_tabelas[Complemento]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Bairro:</strong><br/>
					  <input type="text" class="form-control" id="" name="" placeholder="Bairro">
					</div>				  
					<div class=" col-md-6"><strong>Cidade:</strong><br/>
					  <input type="text" class="form-control" id="" name="" placeholder="Cidade">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone1" name="Telefone1" placeholder="Telefone" <?php echo "value='$linha_tabelas[Telefone1]'";?>>
					</div>				  
					<div class="col-md-6"><strong>Telefone:</strong><br/>
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
					<div class="col-md-offset-2 col-md-6"><strong>DRT:</strong><br/>
					  <input type="text" class="form-control" id="DRT" name="DRT" placeholder="DRT" <?php echo "value='$linha_tabelas[DRT]'";?>>
					</div>				  
					<div class=" col-md-6"><strong>Função:</strong><br/>
					  <input type="text" class="form-control" id="Funcao" name="Funcao" placeholder="Função" <?php echo "value='$linha_tabelas[Funcao]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Inscrição do INSS ou PIS/PASEP:</strong><br/>
					  <input type="text" class="form-control" id="InscricaoINSS" name="InscricaoINSS" placeholder="Inscrição no INSS ou PIS/PASEP" <?php echo "value='$linha_tabelas[InscricaoINSS]'";?>>
					</div>				  
					<div class=" col-md-6"><strong>OMB:</strong><br/>
					  <input type="text" class="form-control" id="OMB" name="OMB" placeholder="OMB" <?php echo "value='$linha_tabelas[OMB]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Data Atualização:</strong><br/>
					  <input type="text" class="form-control" id="DataAtualizacao" name="DataAtualizacao" placeholder="Data da Atualização do Cadastro" <?php echo "value='$linha_tabelas[DataAtualizacao]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					  <input type="text" class="form-control" id="Observacao" name="Observacao" placeholder="Observações" <?php echo "value='$linha_tabelas[Observacao]'";?>>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <input type="image" alt="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
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