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
$consulta_tabela_dotacao_orcamentaria = mysqli_query ($conexao,"SELECT * FROM dotacao_orcamentaria");
$linha_tabela_dotacao_orcamentaria= mysqli_fetch_assoc($consulta_tabela_dotacao_orcamentaria);

$consulta_tabela_assinatura = mysqli_query ($conexao,"SELECT * FROM assinatura");
$linha_tabela_assinatura= mysqli_fetch_assoc($consulta_tabela_assinatura);


$amparo="I – À vista dos elementos constantes do presente, em especial o parecer da comissão à fl. , diante da competência a mim delegada pela Portaria nº 19/2006-SMC/G, AUTORIZO, com fundamento no artigo 25, inciso III, da Lei Federal nº 8.666/93, a contratação nas condições abaixo estipuladas, observada a legislação vigente e demais cautelas legais:";

$final="II - Nos termos do art. 6º do Decreto nº 54.873/2014, designo o(a) servidor(a)  como fiscal do contrato e o(a)   como seu substituto.
III -  Autorizo a emissão da competente nota de empenho de acordo com o Decreto Municipal nº 55.839/2015 e demais normas de execução orçamentárias vigentes.
IV - Publique-se e encaminhe-se ao setor competente para as providências cabíveis.";


$id_ped=$_GET['id'];

$sql_query_tabelas ="
						
					";
					
$consulta_tabelas = mysqli_query($conexao,$sql_query_tabelas);
$linha_tabelas = mysqli_fetch_assoc ($consulta_tabelas);

?>

<!-- MENU -->	
<?php include 'includes/menu.html';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">DESPACHO DE PESSOA FÍSICA</div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" <?php echo "action='insercao_propostapf.php?id=$id_ped'"; ?> method="post">
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Código do Pedido de Contratação:</strong><br/>
					  <input  name="Id_PedidoContratacaoPF" type="text" class="form-control" id="Id_PedidoContratacaoPF" readonly <?php echo "value='$id_ped'"; ?> >
					</div>                    
                    <div class="col-md-6"><strong>Processo n°:</strong> 
					  <input type="text" class="form-control" readonly <?php echo "value='$linha_tabelas[NumeroProcesso]'";?>>
                    </div>
                  </div>
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Amparo:</strong><br/>
	                <textarea name="AmparoLegal" cols="40" rows="5"><?php echo "$amparo";?></textarea>
                    </div>
                  </div>  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Dotação Orcamentaria:</strong><br/>
					  <select class="form-control" name="Id_DotacaoOrcamentaria" id="Id_DotacaoOrcamentaria"><option>Selecione</option>
                      <?php
					  do
					  {
					  echo "<option value='$linha_tabela_dotacao_orcamentaria[Id_DotacaoOrcamentaria]'>$linha_tabela_dotacao_orcamentaria[DotacaoOrcamentaria]</option>";
					  }
					  while ($linha_tabela_assinatura = mysqli_fetch_assoc($consulta_tabela_assinatura))
					  ?>  
                      </select>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" name="ComplementoDotacaoOrcamentaria" class="form-control" id="ComplementoDotacaoOrcamentaria" placeholder="Complemento da Dotacao Orçamentaria">
					</div>
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Finalização:</strong><br/>
	                <textarea name="Finalizacao" cols="40" rows="5"><?php echo "$final";?></textarea>
                    </div>
                  </div> 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Detalhes do Pagamento:</strong><br/>
                    <input type="DetalhesPagamento" class="form-control" id="DetalhesPagamento" placeholder="Detalhes do Pagamento">
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