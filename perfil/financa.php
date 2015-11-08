	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li>
								<a href="?perfil=financa&p=visaogeral">Visão Geral</a>
							</li>
							<li><a href="?perfil=financa&p=verbas">Valores de verbas</a></li>
							<li><a href="?perfil=financa&p=pedidos">Pedidos de contratação</a></li>
							<li><a href="?perfil=financa&p=relatorios">Relatórios</a></li>
   							<li><a href="?perfil=financa">Instituições, usuários e espaços</a></li>
                            <li><a href="../include/logoff.php">Sair</a></li>
							<!--<li>
								<a href="#">Sub Menu</a>
								<ul class="dl-submenu">
									<li><a href="#">Sub menu</a></li>
									<li><a href="#">Sub menu</a></li>
								</ul>
							</li>-->
						</ul>
					</div><!-- /dl-menuwrapper -->
	</div>	

<?php
require_once("../funcoes/funcoesVerifica.php");
require_once("../funcoes/funcoesSiscontrat.php");
require_once("../funcoes/funcoesFinanca.php");
$con = bancoMysqli();
if(isset($_GET['p'])){
	$p = $_GET['p'];	
}else{
	$p = "inicio";
}
switch($p){
case 'inicio':

?>



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
	            <a href="?perfil=financa&p=visaogeral" class="btn btn-theme btn-lg btn-block">Visão Geral</a>
   	            <a href="?perfil=financa&p=verbas" class="btn btn-theme btn-lg btn-block">Valores de verbas</a>
	            <a href="?perfil=financa&p=pedidos" class="btn btn-theme btn-lg btn-block">Pedidos de contratação</a>
   	            <a href="?perfil=financa&p=relatorios" class="btn btn-theme btn-lg btn-block">Relatórios</a>
            </div>
          </div>
        </div>
    </div>
</section>   
<?php 
break;
case 'pedidos':
?> 
<br />
<br />
<br />
	<section id="list_items">
		<div class="container">
             <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                <h2>Pedidos de contratação</h2>
	                <h5>Escolha uma opção</h5>
                </div>
            </div>
			<div class="table-responsive list_info">
				<table class="table table-condensed"><script type=text/javascript language=JavaScript src=../js/find2.js> </script>
					<thead>
						<tr class="list_menu">
							<td>Cod.</td>
   							<td>Tipo Pessoa</td>
							<td>Proponente</td>
							<td>Objeto</td>
							<td>Local/Periodo</td>
							<td>Verba</td>
							<td>Valor</td>

   							<td>Status</td>

						</tr>
					</thead>
					<tbody>
<?php
$idInstituicao = $_SESSION['idInstituicao'];
$sql = "SELECT idPedidoContratacao, tipoPessoa, idPessoa FROM igsis_pedido_contratacao WHERE publicado = '1' AND instituicao = '$idInstituicao'";
$query = mysqli_query($con,$sql);

$data=date('Y');
while($linha_tabela_pedido_contratacao = mysqli_fetch_array($query))
 {
	$pedido = siscontrat($linha_tabela_pedido_contratacao['idPedidoContratacao']);
	$pessoa = siscontratDocs($linha_tabela_pedido_contratacao['idPessoa'],$linha_tabela_pedido_contratacao['tipoPessoa']);
	echo "<tr><td class='lista'> <a href=''>".$linha_tabela_pedido_contratacao['idPedidoContratacao']."</a></td>";
	echo '<td class="list_description">'.retornaPessoa($pedido['TipoPessoa']).					'</td> ';
	echo '<td class="list_description">'.$pessoa['Nome'].						'</td> ';
	echo '<td class="list_description">'.$pedido['Objeto'].				'</td> ';
	echo '<td class="list_description">'.$pedido['Local'].						'</td> ';
	echo '<td class="list_description">'.retornaVerba($pedido['Verba']).						'</td> ';
	echo '<td class="list_description">'.dinheiroParaBr($pedido['ValorGlobal']).						'</td> ';

	echo '<td class="list_description">OK						</td> </tr>';
	}

?>
	
					
					</tbody>
				</table>
			</div>
		</div>
	</section>

   <?php 
   break;
   case "visaogeral":
   
?>

<section id="list_items">
		<div class="container">
             <div class="col-md-offset-2 col-md-8">
                
                <h2>Visão Geral de Gastos</h2>
	                <h6>Contratações artísticas</h6>
                    <p><?php if(isset($mensagem)){ echo $mensagem; } ?></p>
    
                </div>
			<div class="table-responsive list_info">
				<table class="table table-condensed"><script type=text/javascript language=JavaScript src=../js/find2.js> </script>
					<thead>
						<tr class="list_menu">
                        <td></td>
							<td>Orçamento</td>
							<td>Pedido</td>
							<td>Empenhado</td>
  							<td>Restante</td>
						</tr>
					</thead>
					<tbody>
<tr>
<td>Pessoa física</td>
<td><?php echo dinheiroParaBr(somaVerba($_SESSION['idInstituicao'],"pf")); ?></td>
<td><?php echo dinheiroParaBr(somaPedido($_SESSION['idInstituicao'],1)); ?></td>
<td>Empenhado</td>
<td><?php echo dinheiroParaBr(somaVerba($_SESSION['idInstituicao'],"pf") - somaPedido($_SESSION['idInstituicao'],1)) ?></td>

<tr>

<tr>
<td>Pessoa jurídica</td>
<td><?php echo dinheiroParaBr(somaVerba($_SESSION['idInstituicao'],"pj")); ?></td>
<td><?php echo dinheiroParaBr(somaPedido($_SESSION['idInstituicao'],2)); ?></td>
<td>Empenhado</td>
<td><?php echo dinheiroParaBr(somaVerba($_SESSION['idInstituicao'],"pj") - somaPedido($_SESSION['idInstituicao'],2)) ?></td>


<tr>

<tr>
<td>Prêmio</td>
<td><?php echo dinheiroParaBr(somaVerba($_SESSION['idInstituicao'],"premio")); ?></td>

<tr>
	
				
					</tbody>
				</table>

			</div>

            </div>            
		</div>
	</section>
    
   <?php 
   break;
   case "relatorios":
   
?>


	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<h2>Relatórios</h2>
                    <h5></h5>
			  </div>
<br />
<br />
	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=financa&p=planilha" method="post">
					  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Tipo de pessoa</strong><br/>
					            		
            		<select class="form-control" name="tipo_pessoa" id="inputSubject" >
						<option value="0">Pessoa física e jurídica</option>
						<option value="1">Somente pessoa física</option>
						<option value="2">Somente pessoa jurídica</option>
                        
                    </select>		
					</div>
				  </div>  
				  
				  <div class="form-group">
                  <h6>Período(data de envio dos pedidos de contratação)</h6>
					<div class="col-md-offset-2 col-md-6"><strong>Data inicial:</strong><br/>
					  <input type="text" class="form-control" id="datepicker01" name="data_inicial"  >
					</div>
					<div class="col-md-6"><strong>Data final:</strong><br/>
					  <input type="text" class="form-control" id="datepicker02" name="data_final" >
					</div>
				  </div>
                  <br />
				  <div class="form-group">
                  <h6>Valor do pedido</h6>

                  					<div class="col-md-offset-2 col-md-6"><strong>De</strong><br/>
					  <input type="text" class="form-control" id="valor" name="valor_de" >
					
					</div>				  
					<div class=" col-md-6"><strong>Até</strong><br/>
					  <input type="text" class="form-control" id="valor01" name="valor_ate" >
					</div>

				  </div>
				  <br />
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Tipo de Evento</strong><br/>
					            		
            		<select class="form-control" name="tipo_evento" id="inputSubject" >
						<option value="0">Todos os tipos de evento</option>
						<?php echo geraOpcao("ig_tipo_evento",$campo['ig_tipo_evento_idTipoEvento'],"") ?>
                    </select>		
					</div>
				  </div>
				           <div class="form-group">
	            <div class="col-md-offset-2 col-md-8">
    		        <label>Responsável</label>
						<select class="form-control" name="responsavel" id="inputSubject" >
                        <option value="0">Todos os usuários cadastrados da instituição</option>
						<?php echo opcaoUsuario($_SESSION['idInstituicao'],$campo['suplente']) ?>
                        </select>	
        		  </div>
            </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Verba</strong><br/>
					            		
            		<select class="form-control" name="verba" id="inputSubject" >
						<option value="0">Todos os tipos de verba</option>
						<?php echo geraOpcaoPai("sis_verba",$campo['Id_Verba'],$_SESSION['idInstituicao']) ?>
                    </select>		
					</div>
				  </div>				  				  

				  </div>
				  
				  
				<!-- Botão Gravar -->	
				  <div class="form-group">
                  <br />
                  <br />
					<div class="col-md-offset-2 col-md-8">
                     <input type="hidden" name="filtrar" value="1" />
					 <input type="image" alt="Filtrar" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

<?php 
   break;
   case "verbas":
   if(isset($_POST['atualizar'])){
		$idVerba = $_POST['idVerba'];		   
		$pj = dinheiroDeBr($_POST['pj']);		   
		$pf = dinheiroDeBr($_POST['pf']);		   
		$premio = dinheiroDeBr($_POST['premio']);
		$sql_atualiza_verba = "UPDATE sis_verba SET
		pf = '$pf',
		pj = '$pj',
		premio = '$premio'
		WHERE Id_Verba = '$idVerba'";
		$con = bancoMysqli();
		$query_atualiza_verba = mysqli_query($con,$sql_atualiza_verba);
		if($query_atualiza_verba){
			$mensagem = "Valores atualizados!";
		}else{
			$mensagem = "Erro ao atualizar valores.";	
		}		   

   }
   
?>
	<section id="list_items">
		<div class="container">
             <div class="col-md-offset-2 col-md-8">
                
                <h2>Valores de Verbas</h2>
	                <h6>Exercício 2016 em Reais</h6>
                    <p><?php if(isset($mensagem)){ echo $mensagem; } ?></p>
    
                </div>
			<div class="table-responsive list_info">
				<table class="table table-condensed"><script type=text/javascript language=JavaScript src=../js/find2.js> </script>
					<thead>
						<tr class="list_menu">
							<td>Verba</td>
							<td>Pessoa Física</td>
							<td>Pessoa Jurídica</td>
							<td>Prêmio</td>
							<td>Total</td>
  							<td></td>
						</tr>
					</thead>
					<tbody>
<?php
$idInstituicao = $_SESSION['idInstituicao'];
$sql = "SELECT * FROM sis_verba WHERE idInstituicao = '$idInstituicao' AND pai IS NOT NULL" ;
$query = mysqli_query($con,$sql);
while($verba = mysqli_fetch_array($query)){
?>

<tr>
<form action="?perfil=financa&p=verbas" method="post">
<td><?php echo $verba['Verba']; ?></td>
<td><input type="text" name="pf" class="valor" value="<?php echo dinheiroParaBr($verba['pf']); ?>"/></td>
<td><input type="text" name="pj" class="valor" value="<?php echo dinheiroParaBr($verba['pj']); ?>"/></td>
<td><input type="text" name="premio" class="valor" value="<?php echo dinheiroParaBr($verba['premio']); ?>"/></td>

<td><?php echo dinheiroParaBr($verba['premio'] + $verba['pj'] + $verba['pf']) ; ?></td>
<td>
<input type="hidden" name="idVerba" value="<?php echo $verba['Id_Verba']; ?>" />
<input type="hidden" name="atualizar" value="<?php echo $verba['Id_Verba']; ?>" />
<input type ='submit' class='btn btn-theme  btn-block' value='atualizar'></td>
</form>

</tr>
	
    <?php } ?>
<tr>
<td>Total:</td>    
<td><?php echo dinheiroParaBr(somaVerba($_SESSION['idInstituicao'],"pf")) ?></td>    
<td><?php echo dinheiroParaBr(somaVerba($_SESSION['idInstituicao'],"pj"))?></td>    
<td><?php echo dinheiroParaBr(somaVerba($_SESSION['idInstituicao'],"premio"))?></td>    
<td><strong><?php echo dinheiroParaBr(somaVerba($_SESSION['idInstituicao'],"pf") + somaVerba($_SESSION['idInstituicao'],"pj") + somaVerba($_SESSION['idInstituicao'],"premio")); ?></strong></td>
</tr>					
					</tbody>
				</table>

			</div>

            </div>            
		</div>
	</section>


<?php   
break;
case "planilha":

$tipo_pessoa = $_POST['tipo_pessoa']; 
if($tipo_pessoa == 0){
	$men_pessoa = "Pessoa: física e jurídica <br />";	
}else{
	$pessoa = " AND igsis_pedido_contratacao.tipoPessoa = '$tipo_pessoa' ";
	if($tipo_pessoa == 1){
		$men_pessoa = "Pessoa: física<br />";
	}else{
		$men_pessoa = "Pessoa: jurídica<br />";
		
	}
}

$data_final  = exibirDataMysql($_POST['data_final']);
$data_inicial  = exibirDataMysql($_POST['data_inicial']); 
if(($_POST['data_inicial'] != "") AND ($_POST['data_inicial'] != "")){
	$data = "BETWEEN ig_evento.dataEnvio = '$data_inicial' AND ig_evento.dataEnvio = '$data_final' ";
	$men_data = "Data de envio: entre ".exibirDataBr($data_inicial)." e ".exibirDataBr($data_final)."<br />";
}else{
	$men_data = "Data de envio: sem data definida.<br />";

}

//refazer	
  $valor_de  = dinheiroDeBr($_POST['valor_de']); 
  $valor_ate  = dinheiroDeBr($_POST['valor_ate']);
if((($valor_de != "") OR $valor_de != '0.00') AND (($data_ate != "") OR ($data_ate != '0.00'))){
	$valor = "AND igsis_pedido_contratacao.valor >= '$valor_de' AND igsis_pedido_contratacao.valor <= '$valor_ate' ";
	$men_valor = "Valores: entre ".dinheiroParaBr($valor_de)." e ".dinheiroParaBr($valor_ate)."<br />";
}else{
	$men_valor = "Valores: sem valores definidos.<br />";

}



  $tipo_evento = $_POST['tipo_evento'];
if($tipo_evento != "0"){
  $tipo = "AND ig_evento.ig_tipo_evento_idTipoEvento = '$tipo_evento' ";
  $men_tipo = "Tipo de vento: ".$tipo_evento;
}else{
  $men_tipo = "Tipo de evento: não definido.";
	
}

  $verba = $_POST['verba'];
if($tipo_evento != "0"){
  $responsavel = $_POST['responsavel'];
  $men_resp = "Responsável: ".$responsavel;
}else{
  $men_resp = "Responsável: não definido.";
	
}  
  

$sql_filtro = "SELECT * FROM igsis_pedido_contratacao, ig_evento WHERE ig_pedido_contratacao.idEvento = ig_evento.idEvento $valor $data $tipo";

?>
<br />
<br />
<br />
	<section id="list_items">
		<div class="container">
             <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                <h2>Relatório de Pedidos de contratação</h2>
	                <h6>Você filtrou por: <br /><?php echo $men_pessoa; echo $men_data; echo $men_valor; echo $men_tipo ?></h6>
                </div>
            </div>
			<div class="table-responsive list_info">
				<table class="table table-condensed"><script type=text/javascript language=JavaScript src=../js/find2.js> </script>
					<thead>
						<tr class="list_menu">
							<td>Cod.</td>
   							<td>Tipo Pessoa</td>
							<td>Proponente</td>
							<td>Objeto</td>
							<td>Local/Periodo</td>
							<td>Verba</td>
							<td>Valor</td>

   							<td>Status</td>

						</tr>
					</thead>
					<tbody>
<?php
$idInstituicao = $_SESSION['idInstituicao'];
$sql = "SELECT idPedidoContratacao, tipoPessoa, idPessoa FROM igsis_pedido_contratacao WHERE publicado = '1' AND instituicao = '$idInstituicao'";
$query = mysqli_query($con,$sql);

$data=date('Y');
while($linha_tabela_pedido_contratacao = mysqli_fetch_array($query))
 {
	$pedido = siscontrat($linha_tabela_pedido_contratacao['idPedidoContratacao']);
	$pessoa = siscontratDocs($linha_tabela_pedido_contratacao['idPessoa'],$linha_tabela_pedido_contratacao['tipoPessoa']);
	echo "<tr><td class='lista'> <a href=''>".$linha_tabela_pedido_contratacao['idPedidoContratacao']."</a></td>";
	echo '<td class="list_description">'.retornaPessoa($pedido['TipoPessoa']).					'</td> ';
	echo '<td class="list_description">'.$pessoa['Nome'].						'</td> ';
	echo '<td class="list_description">'.$pedido['Objeto'].				'</td> ';
	echo '<td class="list_description">'.$pedido['Local'].						'</td> ';
	echo '<td class="list_description">'.retornaVerba($pedido['Verba']).						'</td> ';
	echo '<td class="list_description">'.dinheiroParaBr($pedido['ValorGlobal']).						'</td> ';

	echo '<td class="list_description">OK						</td> </tr>';
	}

?>
	
					
					</tbody>
				</table>
			</div>
		</div>
	</section>
<?php var_dump($_POST); ?>
<?php var_dump($sql_filtro); ?>

<?php


}
   ?> 