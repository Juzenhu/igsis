<?php
require_once("../funcoes/funcoesVerifica.php");
require_once("../funcoes/funcoesSiscontrat.php");
$con = bancoMysqli();
if(isset($_GET['p'])){
	$p = $_GET['p'];	
}else{
	$p = "inicio";
}
switch($p){
case 'inicio':

?>

	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li>
								<a href="?secao=inicio">Início</a>
							</li>
							<li><a href="?secao=perfil">Perfil de acesso</a></li>
							<li><a href="?secao=ajuda">Ajuda</a></li>
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
	            <a href="?perfil=financa" class="btn btn-theme btn-lg btn-block">Visão Geral</a>
	            <a href="?perfil=financa&p=pedidos" class="btn btn-theme btn-lg btn-block">Pedidos de contratação</a>
   	            <a href="?perfil=financa&p=relatorios" class="btn btn-theme btn-lg btn-block">Relatórios</a>
  	            <a href="?perfil=financa" class="btn btn-theme btn-lg btn-block">Instituições, usuários e espaços</a>
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
					            		
            		<select class="form-control" name="ig_tipo_evento_idTipoEvento" id="inputSubject" >
						<option value="0">Todos os tipos de evento</option>
						<?php echo geraOpcao("ig_tipo_evento",$campo['ig_tipo_evento_idTipoEvento'],"") ?>
                    </select>		
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Número *:</strong><br/>
					  <input type="text" class="form-control" id="Numero" name="Numero" placeholder="Numero">
					</div>				  
					<div class=" col-md-6"><strong>Complemento:</strong><br/>
					  <input type="text" class="form-control" id="Complemento" name="Complemento" placeholder="Complemento">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Bairro *:</strong><br/>
					  <input type="text" class="form-control" id="Bairro" name="Bairro" placeholder="Bairro">
					</div>				  
					<div class=" col-md-6"><strong>Cidade *:</strong><br/>
					  <input type="text" class="form-control" id="Cidade" name="Cidade" placeholder="Cidade">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone1" name="Telefone1" placeholder="Telefone">
					</div>				  
					<div class=" col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone2" name="Telefone2" placeholder="Telefone" >
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone:</strong><br/>
					  <input type="text" class="form-control" id="Telefone3" name="Telefone3" placeholder="Telefone">
					</div>				  
					<div class=" col-md-6"><strong>E-mail:</strong><br/>
					  <input type="text" class="form-control" id="Email" name="Email" placeholder="E-mail">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Representante Legal #1:</strong><br/>
					  <select class="form-control" id="IdRepresentanteLegal1" name="IdRepresentanteLegal1" >
					<?php geraOpcaoLegal($_SESSION['idEvento']); ?>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Representante Legal #2:</strong><br/>
					  <select class="form-control" id="IdRepresentanteLegal2" name="IdRepresentanteLegal2">
					<?php geraOpcaoLegal($_SESSION['idEvento']); ?>
					  </select>
					</div>
				  </div>
		  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observações:</strong><br/>
					 <textarea name="Observacao" class="form-control" rows="10" placeholder=""></textarea>
					</div>
				  </div>
				  
				  
				<!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                     <input type="hidden" name="cadastrarJuridica" value="1" />
					 <input type="image" alt="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

<?php   
}
   ?> 