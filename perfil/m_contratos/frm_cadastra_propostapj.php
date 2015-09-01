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
$consulta_tabela_assinatura = mysqli_query ($conexao,"SELECT * FROM sis_assinatura");
$linha_tabela_assinatura= mysqli_fetch_assoc($consulta_tabela_assinatura);


$id_ped=$_GET['id'];

$sql_query_tabelas_pj ="
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
					
$consulta_tabelas = mysqli_query($conexao,$sql_query_tabelas_pj);
$linha_tabelas = mysqli_fetch_assoc ($consulta_tabelas);

?>

<!-- MENU -->	
<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">CADASTRO DE PROPOSTA PESSOA JURÍDICA</div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" <?php echo "action='insercao_propostapj.php?id=$id_ped'"; ?> method="post">
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Código do Pedido de Contratação:</strong><br/>
					  <input  name="Id_PedidoContratacaoPJ" type="text" class="form-control" id="Id_PedidoContratacaoPJ" readonly <?php echo "value='$id_ped'"; ?> >
					</div>
                  </div>
				  <div class="form-group">                    
                    <div class=" col-md-offset-2 col-md-6"><strong>Setor:</strong> 
					  <input type="text" class="form-control" readonly <?php echo "value='$linha_tabelas[Setor]'";?>>
                    </div>
                    <div class="col-md-6"><strong>Categoria da Contratação:</strong> 
					  <input type="text" class="form-control" readonly <?php echo "value='$linha_tabelas[CategoriaContratacao]'";?>>
                    </div>
                  </div>
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Proponente:</strong><br/>
					  <?php echo "<input type='text' class='form-control' name='razaosocial' id='razaosocial' value='$linha_tabelas[RazaoSocial]'>";?>                    	
                    </div>
                  </div>  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Objeto:</strong><br/>
					  <input type="text" class="form-control" readonly <?php echo "value='$linha_tabelas[Objeto]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Local:</strong><br/>
					 <input type='text' class='form-control' readonly <?php echo "value='$linha_tabelas[LocalEspetaculo]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Valor:</strong><br/>
					  <input type='text' class='form-control' readonly <?php echo "value='$linha_tabelas[Valor]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Forma de Pagamento:</strong><br/>
                      <textarea name="FormaPagamento" cols="40" rows="5" readonly><?php echo "$linha_tabelas[FormaPagamento]";?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Período:</strong><br/>
					   <input type='text' class='form-control' readonly <?php echo "value='$linha_tabelas[Periodo]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Duração: </strong>
					   <input type='text' class='form-control' readonly <?php echo "value='$linha_tabelas[Duracao]'";?>>
					</div>
					<div class="col-md-6"><strong>Carga Horária:</strong><br/>
					   <input type='text' class='form-control' readonly <?php echo "value='$linha_tabelas[CargaHoraria]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Verba:</strong><br/>
					   <input type='text' class='form-control' readonly <?php echo "value='$linha_tabelas[Verba]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Justificativa:</strong><br/>
					  <textarea name="Justificativa" cols="40" rows="5" readonly><?php echo "$linha_tabelas[Justificativa]";?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Fiscal:</strong>
					   <input type='text' class='form-control' readonly <?php echo "value='$linha_tabelas[Fiscal]'";?>>
					</div>
					<div class="col-md-6"><strong>Suplente:</strong>
					   <input type='text' class='form-control' readonly <?php echo "value='$linha_tabelas[Suplente]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Parecer Técnico:</strong><br/>
					  <textarea name="ParecerTecnico" cols="40" rows="5" readonly><?php echo "$linha_tabelas[ParecerTecnico]";?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					   <input type='text' class='form-control' readonly <?php echo "value='$linha_tabelas[Observacao]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Assinatura:</strong><br/>
					  <select class="form-control" name="Id_Assinatura" id="Id_Assinatura"><option>Selecione</option>
                      <?php
					  do
					  {
					  echo "<option value='$linha_tabela_assinatura[Id_Assinatura]'>$linha_tabela_assinatura[Assinatura]</option>";
					  }
					  while ($linha_tabela_assinatura = mysqli_fetch_assoc($consulta_tabela_assinatura))
					  ?>  
                      </select>
					</div>
				  </div>
                  
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