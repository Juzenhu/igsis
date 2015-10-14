<!-- para inserir -->

<?php
$conexao = bancoMysqli(); // conecta no banco

if(isset($_POST['enviar']))
{
	
$representanteLegal=$_POST['RepresentanteLegal'];
$rg=$_POST['RG'];
$cpf=$_POST['CPF'];
$nacionalidade=$_POST['Nacionalidade'];
$idEstadoCivil=$_POST['IdEstadoCivil'];





$incluir_tabela_representante_legal = "INSERT INTO sis_representante_legal
		(
		RepresentanteLegal,
		RG,
		CPF,
		Nacionalidade,
		IdEstadoCivil
		)
		VALUES
		(
		'$representanteLegal',
		'$rg',
		'$cpf',
		'$nacionalidade',
		'$idEstadoCivil'
		)";
	
//$stmt = mysqli_prepare($conexao,$incluir_tabela_representante_legal);		
//if (mysqli_stmt_execute($stmt)) { echo "Dados inseridos com sucesso";};


if(mysqli_query($conexao,$incluir_tabela_representante_legal)){
			$mensagem = "cadastrado com sucesso!";	
		}else{
			$mensagem = "Erro ao cadastrar! Tente novamente.";
		}
}
?>

<!-- MENU -->	
<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title"><h2>CADASTRO DE REPRESENTANTE LEGAL</h2>
					<h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5></div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=contratos&p=frm_cadastra_representantelegal" method="post">
				  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="RepresentanteLegal" name="RepresentanteLegal" placeholder="Representante Legal">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6">
					  <input type="text" class="form-control" id="RG" name="RG" placeholder="RG">
					</div>
					<div class="col-md-6">
					  <input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF">
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6">
					  <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" placeholder="Nacionalidade">
					</div>
					<div class="col-md-6">
					  <select class="form-control" id="IdEstadoCivil" name="IdEstadoCivil" >
					   <?php
						geraOpcao("sis_estado_civil","","");
						?>  
					  </select>
					</div>
				  </div>
                  
                  <!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <input type="submit" name="enviar" value="GRAVAR" class="btn btn-theme btn-lg btn-block">
					</div>
                    
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  



