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
$consulta_tabela_assinatura = mysqli_query ($conexao,"SELECT * FROM assinatura");
$linha_tabela_assinatura= mysqli_fetch_assoc($consulta_tabela_assinatura);


$id_ped=$_GET['id_ped'];

$sql_query_tabelas_pedido_contratacao_pf ="
						SELECT 	pedido_contratacao_pf.Id_PedidoContratacaoPF,
								pedido_contratacao_pf.Objeto,
								pedido_contratacao_pf.LocalEspetaculo,
								pedido_contratacao_pf.Valor,
								pedido_contratacao_pf.ValorPorExtenso,
								pedido_contratacao_pf.ValorIndividual,
								pedido_contratacao_pf.ValorIndividualPorExtenso,
								pedido_contratacao_pf.FormaPagamento,
								pedido_contratacao_pf.Periodo,
								pedido_contratacao_pf.Duracao,
								pedido_contratacao_pf.CargaHoraria,
								pedido_contratacao_pf.Justificativa,
								pedido_contratacao_pf.Fiscal,
								pedido_contratacao_pf.Suplente,
								pedido_contratacao_pf.ParecerTecnico,
								pedido_contratacao_pf.Observacao,
								setor.Setor,
								categoria_contratacao.CategoriaContratacao,
								verba.*,
								pessoa_fisica.Nome
						FROM pedido_contratacao_pf
						
						INNER JOIN setor
							ON pedido_contratacao_pf.IdSetor = setor.Id_Setor
						INNER JOIN categoria_contratacao
							ON pedido_contratacao_pf.IdCategoria = categoria_contratacao.Id_CategoriaContratacao
						INNER JOIN verba 
							ON pedido_contratacao_pf.IdVerba = verba.Id_Verba
						INNER JOIN pessoa_fisica
							ON pedido_contratacao_pf.IdPessoaFisica = pessoa_fisica.Id_PessoaFisica
						
						WHERE Id_PedidoContratacaoPF = $id_ped
					";
					
$consulta_tabelas = mysqli_query($conexao,$sql_query_tabelas_pedido_contratacao_pf);
$linha_tabelas = mysqli_fetch_assoc ($consulta_tabelas);

?>

<!-- MENU -->	
<?php include 'includes/menu.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">PEDIDO DE CONTRTAÇÃO DE PESSOA FÍSICA</div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" <?php echo "action='update_pedidocontratacaopf.php?id_ped=$id_ped'"; ?> method="post">
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Código do Pedido de Contratação:</strong><br/>
					  <input  name="Id_PedidoContratacaoPF" readonly type="text" class="form-control" id="Id_PedidoContratacaoPF" <?php echo "value='$id_ped'"; ?> >
					</div>
                  </div>
				  <div class="form-group">                    
                    <div class=" col-md-offset-2 col-md-6"><strong>Setor:</strong> 
					  <input type="text" readonly class="form-control" <?php echo "value='$linha_tabelas[Setor]'";?>>
                    </div>
                    <div class="col-md-6"><strong>Categoria da Contratação:</strong> 
					  <input type="text" readonly class="form-control" <?php echo "value='$linha_tabelas[CategoriaContratacao]'";?>>
                    </div>
                  </div>
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Proponente:</strong><br/>
					  <?php echo "<input type='text' readonly class='form-control' name='nome' id='nome' value='$linha_tabelas[Nome]'>";?>                    	
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
					<div class="col-md-offset-2 col-md-6"><strong>Valor:</strong><br/>
					  <input type='text' name="Valor" class='form-control' <?php echo "value='R$ $linha_tabelas[Valor]'";?>>
					</div>
					<div class="col-md-6"><strong>Valor por Extenso:</strong><br/>
					  <input type='text' name="ValorPorExtenso" class='form-control' <?php echo "value='$linha_tabelas[ValorPorExtenso]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Valor Individual:</strong><br/>
					  <input type='text' name="ValorIndividual" class='form-control' <?php echo "value='R$ $linha_tabelas[ValorIndividual]'";?>>
					</div>
					<div class="col-md-6"><strong>Valor por Extenso:</strong><br/>
					  <input type='text' name="ValorIndividualPorExtenso" class='form-control' <?php echo "value='$linha_tabelas[ValorIndividualPorExtenso]'";?>>
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
					   <input type='text' class='form-control' readonly <?php echo "value='$linha_tabelas[Verba]'";?>>
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
					<div class="col-md-offset-2 col-md-8">
					 <input type="image" alt="GRAVAR" name="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
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