

<?php



/* 
require("../conectar.php");
$conexao = bancoMysqli(); //conecta ao banco unificado
$consulta_tabela_assinatura = mysqli_query ($conexao,"SELECT * FROM sis_assinatura");
$linha_tabela_assinatura= mysqli_fetch_assoc($consulta_tabela_assinatura);

$consulta_tabela_categoriacontratacao = mysqli_query ($conexao,"SELECT * FROM sis_categoria_contratacao");
$linha_tabela_categoriacontratacao= mysqli_fetch_assoc($consulta_tabela_categoriacontratacao);

$consulta_tabela_verba = mysqli_query ($conexao,"SELECT * FROM sis_verba");
$linha_tabela_verba= mysqli_fetch_assoc($consulta_tabela_verba);

$ano=date('Y');

$id_ped=$_GET['id_ped'];

$sql_query_tabelas_pedido_contratacao_pf ="
						SELECT 	sis_pedido_contratacao_pf.Id_PedidoContratacaoPF,
								sis_pedido_contratacao_pf.Objeto,
								sis_pedido_contratacao_pf.LocalEspetaculo,
								sis_pedido_contratacao_pf.Valor,
								sis_pedido_contratacao_pf.ValorIndividual,
								sis_pedido_contratacao_pf.FormaPagamento,
								sis_pedido_contratacao_pf.Periodo,
								sis_pedido_contratacao_pf.Duracao,
								sis_pedido_contratacao_pf.CargaHoraria,
								sis_pedido_contratacao_pf.Justificativa,
								sis_pedido_contratacao_pf.Fiscal,
								sis_pedido_contratacao_pf.Suplente,
								sis_pedido_contratacao_pf.ParecerTecnico,
								sis_pedido_contratacao_pf.Observacao,
								sis_pedido_contratacao_pf.DataAtual,
								sis_pedido_contratacao_pf.IdCategoria,
								sis_setor.Setor,
								sis_categoria_contratacao.CategoriaContratacao,
								sis_verba.*,
								sis_pessoa_fisica.Nome
						FROM sis_pedido_contratacao_pf
						
						INNER JOIN sis_setor
							ON sis_pedido_contratacao_pf.IdSetor = sis_setor.Id_Setor
						INNER JOIN sis_categoria_contratacao
							ON sis_pedido_contratacao_pf.IdCategoria = sis_categoria_contratacao.Id_CategoriaContratacao
						INNER JOIN sis_verba 
							ON sis_pedido_contratacao_pf.IdVerba = sis_verba.Id_Verba
						INNER JOIN sis_pessoa_fisica
							ON sis_pedido_contratacao_pf.IdPessoaFisica = sis_pessoa_fisica.Id_PessoaFisica
						
						WHERE Id_PedidoContratacaoPF = $id_ped
					";
					
$consulta_tabelas = mysqli_query($conexao,$sql_query_tabelas_pedido_contratacao_pf);
$linha_tabelas = mysqli_fetch_assoc ($consulta_tabelas);


			"idSetor" => $usuario['idInstituicao'],
			"Setor" => $instituicao['instituicao']  ,
			"CategoriaContratacao" => $evento['ig_modalidade_IdModalidade'] , //precisa ver se retorna o id
			"Objeto" => $evento['ig_tipo_evento_idTipoEvento']." - ".$evento['nomeEvento'] ,
			"Local" => substr($local,1) , //retira a virgula no começo da string
			"ValorGlobal" => $pedido['valor'],
			"ValorIndividual" => $pedido['valorIndividual'],
			"FormaPagamento" => $pedido['formaPagamento'],
			"Periodo" => $periodo, 
			"Duracao" => $duracao, 
			//"CargaHoraria" => $carga , //fazer a funcao
			"Verba" => $pedido['idVerba'] ,
			"Justificativa" => $evento['justificativa'] ,
			"ParecerTecnico" => $evento['parecerArtistico'],
			"DataCadastro" => $evento['dataEnvio'],
			"Fiscal" => $evento['idResponsavel'] ,
			"Suplente" => $evento['suplente'],
			"Observacao"=> $pedido['observacao'] //verificar
			*/
$ano=date('Y');
$id_ped=$_GET['id_ped'];	
$linha_tabelas = siscontrat($id_ped);
		
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
					  <input  name="Id_PedidoContratacaoPF" readonly type="text" class="form-control" id="Id_PedidoContratacaoPF" value="<?php echo $ano."-".$id_ped; ?>" >
					</div>
                  </div>
				  <div class="form-group">                    
                    <div class=" col-md-offset-2 col-md-6"><strong>Setor:</strong> 
					  <input type="text" readonly class="form-control" value="<?php echo $linha_tabelas['Setor'];?>">
                    </div>
                    <div class="col-md-6"><strong>Categoria da Contratação:</strong> 
                      <select class="form-control" name="Categoria" id="Categoria">
                      <?php 
					  geraOpcao("ig_modalidade",$linha_tabelas['CategoriaContratacao'],"")
					  ?>
                     </select> 
                      
                    </div>
                  </div>
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Proponente:</strong><br/>
					  <input type='text' readonly class='form-control' name='nome' id='nome' value='<?php echo $linha_tabelas['Proponente'];?>'>                    	
                    </div>
                  </div>  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Objeto:</strong><br/>
					  <input type="text" name="Objeto" class="form-control" <?php echo "value='$linha_tabelas[Objeto]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Local:</strong><br/>
					 <input type='text' name="LocalEspetaculo" class='form-control' value="<?php echo $linha_tabelas['Local'];?>">
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Valor Global:</strong><br/>
					  <input type='text' name="Valor" class='form-control' id='valor' value='<?php echo dinheiroParaBr($linha_tabelas['ValorGlobal']);?>'>
					</div>
					<div class="col-md-6"><strong>Valor Individual:</strong><br/>
					  <input type='text' name="ValorIndividual" class='form-control' id='valor' value='<?php echo dinheiroParaBr($linha_tabelas['ValorIndividual']);?>'>
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
					   <input type='text' name="CargaHoraria" class='form-control' <?php //echo "value='$linha_tabelas[CargaHoraria]'";?>>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Verba:</strong><br/>
					   <select class="form-control" name="Verba" id="Verba">
                       <?php geraOpcao("sis_verba",$linha_tabelas['Verba'],"") ?>
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
					   <input type='text' name="Fiscal" class='form-control' value="<?php echo $linha_tabelas['Fiscal'];?>">
					</div>
					<div class="col-md-6"><strong>Suplente:</strong>
					   <input type='text' name="Suplente" class='form-control' value="<?php echo $linha_tabelas['Suplente'];?>">
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
					   <input type='text' name="DataAtual" class='form-control' value="<?php echo $linha_tabelas['DataCadastro'];?>">
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
<?php print_r($linha_tabelas); ?>
