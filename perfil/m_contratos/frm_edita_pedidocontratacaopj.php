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

$consulta_tabela_categoriacontratacao = mysqli_query ($conexao,"SELECT * FROM sis_categoria_contratacao");
$linha_tabela_categoriacontratacao= mysqli_fetch_assoc($consulta_tabela_categoriacontratacao);

$consulta_tabela_verba = mysqli_query ($conexao,"SELECT * FROM sis_verba");
$linha_tabela_verba= mysqli_fetch_assoc($consulta_tabela_verba);

$ano=date('Y');

$id_ped=$_GET['id_ped'];

$sql_query_tabelas_pedido_contratacao_pj ="
						SELECT 	sis_pedido_contratacao_pj.Id_PedidoContratacaoPJ,
								sis_pedido_contratacao_pj.Objeto,
								sis_pedido_contratacao_pj.LocalEspetaculo,
								sis_pedido_contratacao_pj.Valor,
								sis_pedido_contratacao_pj.FormaPagamento,
								sis_pedido_contratacao_pj.Periodo,
								sis_pedido_contratacao_pj.Duracao,
								sis_pedido_contratacao_pj.CargaHoraria,
								sis_pedido_contratacao_pj.Justificativa,
								sis_pedido_contratacao_pj.Fiscal,
								sis_pedido_contratacao_pj.Suplente,
								sis_pedido_contratacao_pj.ParecerTecnico,
								sis_pedido_contratacao_pj.Observacao,
								sis_pedido_contratacao_pj.DataAtual,
								sis_pedido_contratacao_pj.IdCategoria,
								sis_setor.Setor,
								sis_categoria_contratacao.CategoriaContratacao,
								sis_verba.*,
								sis_pessoa_juridica.RazaoSocial
						FROM sis_pedido_contratacao_pj
						
						INNER JOIN sis_setor
							ON sis_pedido_contratacao_pj.IdSetor = sis_setor.Id_Setor
						INNER JOIN sis_categoria_contratacao
							ON sis_pedido_contratacao_pj.IdCategoria = sis_categoria_contratacao.Id_CategoriaContratacao
						INNER JOIN sis_verba 
							ON sis_pedido_contratacao_pj.IdVerba = sis_verba.Id_Verba
						INNER JOIN sis_pessoa_juridica
							ON sis_pedido_contratacao_pj.IdPessoaJuridica = sis_pessoa_juridica.Id_PessoaJuridica
						
						WHERE Id_PedidoContratacaoPJ = $id_ped
					";
					
$consulta_tabelas = mysqli_query($conexao,$sql_query_tabelas_pedido_contratacao_pj);
$linha_tabelas = mysqli_fetch_assoc ($consulta_tabelas);

?>

<!-- MENU -->	
<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">PEDIDO DE CONTRTAÇÃO DE PESSOA JURÍDICA</div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" <?php echo "action='update_pedidocontratacaopj.php?id_ped=$id_ped'"; ?> method="post">
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Código do Pedido de Contratação:</strong><br/>
					  <input  name="Id_PedidoContratacaoPJ" readonly type="text" class="form-control" id="Id_PedidoContratacaoPJ" <?php echo "value='$ano-$id_ped'"; ?> >
					</div>
                  </div>
				  <div class="form-group">                    
                    <div class=" col-md-offset-2 col-md-6"><strong>Setor:</strong> 
					  <input type="text" readonly class="form-control" <?php echo "value='$linha_tabelas[Setor]'";?>>
                    </div>
                    <div class="col-md-6"><strong>Categoria da Contratação:</strong> 
                      <select class="form-control" name="Categoria" id="Categoria"><option value=<?php echo "$linha_tabelas[IdCategoria]" ?> ><?php echo "$linha_tabelas[CategoriaContratacao]";?></option>
                      <?php 
					  do
					  {
						  if($linha_tabela_categoriacontratacao[Id_CategoriaContratacao] <> $linha_tabelas[IdCategoria]){
					  		echo "<option value='$linha_tabela_categoriacontratacao[Id_CategoriaContratacao]'>$linha_tabela_categoriacontratacao[CategoriaContratacao]</option>";
						  }
					  }
					  while ($linha_tabela_categoriacontratacao = mysqli_fetch_assoc($consulta_tabela_categoriacontratacao))
					  ?>  
                      </select>
                      
                    </div>
                  </div>
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Proponente:</strong><br/>
					  <?php echo "<input type='text' readonly class='form-control' name='RazaoSocial' id='RazaoSocial' value='$linha_tabelas[RazaoSocial]'>";?>                    	
                    </div>
                  </div>  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Objeto:</strong><br/>
					  <input type="text" name="Objeto" class="form-control" <?php echo "value='$linha_tabelas[Objeto]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Local:</strong><br/>
					 <input type='text' name="LocalEspetaculo" class='form-control' <?php echo "value='$linha_tabelas[LocalEspetaculo]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Valor:</strong><br/>
					  <input type='text' name="Valor" class='form-control' <?php echo "value='$linha_tabelas[Valor]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Forma de Pagamento:</strong><br/>
                      <textarea name="FormaPagamento" cols="40" rows="5"><?php echo "$linha_tabelas[FormaPagamento]";?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Período:</strong><br/>
					   <input type='text' name="Periodo" class='form-control' <?php echo "value='$linha_tabelas[Periodo]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Duração: </strong>
					   <input type='text' name="Duracao" class='form-control' <?php echo "value='$linha_tabelas[Duracao]'";?>>
					</div>
					<div class="col-md-6"><strong>Carga Horária:</strong><br/>
					   <input type='text' name="CargaHoraria" class='form-control' <?php echo "value='$linha_tabelas[CargaHoraria]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Verba:</strong><br/>
					   <select class="form-control" name="Verba" id="Verba"><option value=<?php echo "$linha_tabelas[Id_Verba]" ?> ><?php echo "$linha_tabelas[Verba]";?></option>
                      <?php 
					  do
					  {
						  if($linha_tabela_verba[Id_Verba] <> $linha_tabelas[Id_Verba]){
					  		echo "<option value='$linha_tabela_verba[Id_Verba]'>$linha_tabela_verba[Verba]</option>";
						  }
					  }
					  while ($linha_tabela_verba = mysqli_fetch_assoc($consulta_tabela_verba))
					  ?>  
                      </select>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Justificativa:</strong><br/>
                      <textarea name="Justificativa" cols="40" rows="5"><?php echo "$linha_tabelas[Justificativa]";?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Fiscal:</strong>
					   <input type='text' name="Fiscal" class='form-control' <?php echo "value='$linha_tabelas[Fiscal]'";?>>
					</div>
					<div class="col-md-6"><strong>Suplente:</strong>
					   <input type='text' name="Suplente" class='form-control' <?php echo "value='$linha_tabelas[Suplente]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Parecer Técnico:</strong><br/>
					  <textarea name="ParecerTecnico" cols="40" rows="5"><?php echo "$linha_tabelas[ParecerTecnico]";?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					   <input type='text' name="Observacao" class='form-control' <?php echo "value='$linha_tabelas[Observacao]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Data do Cadastro:</strong><br/>
					   <input type='text' name="DataAtual" class='form-control' <?php echo "value='$linha_tabelas[DataAtual]'";?>>
					</div>
				  </div>
                  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
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