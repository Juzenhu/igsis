<?php

$_SESSION['idPedido'] = $_GET['id_ped'];

$ano=date('Y');
$id_ped = $_GET['id_ped'];	
$linha_tabelas = siscontrat($id_ped);
$fisico = siscontratDocs($linha_tabelas['IdProponente'],1);	

?>

<!-- MENU -->	
<?php include 'includes/menu.php';?>
	
    
  	
	  
	 <!-- Contact -->
<section id="contact" class="home-section bg-white">
	<div class="container">
		<div class="form-group"><h2>PROPOSTA DE PESSOA FÍSICA</h2></div>
		<div class="row">
	  		<div class="col-md-offset-1 col-md-10">
            <div class="col-md-offset-2 col-md-8">
            <div class="left">
                <p align="justify"><strong>Código do pedido de contratação:</strong> <?php echo $ano."-".$id_ped; ?></p>
				<p align="justify"><strong>Setor:</strong> <?php echo $linha_tabelas['Setor'];?></p>	
				<p align="justify"><strong>Proponente:</strong> <?php echo $fisico['Nome'];?></p>
                <p align="justify"><strong>Objeto:</strong> <?php echo $linha_tabelas['Objeto'];?></p>
                <p align="justify"><strong>Local:</strong> <?php echo $linha_tabelas['Local'];?></p>
                <p align="justify"><strong>Valor:</strong> R$ <?php echo dinheiroParaBr($linha_tabelas["ValorGlobal"]);?></p>
                <p align="justify"><strong>Forma de Pagamento:</strong> <?php echo $linha_tabelas["FormaPagamento"];?></p>
                <p align="justify"><strong>Data/Período:</strong> <?php echo $linha_tabelas['Periodo'];?></p>
                <p align="justify"><strong>Duração:</strong> <?php echo $linha_tabelas['Duracao'];?> minutos</p>
                <p align="justify"><strong>Carga Horária:</strong> <?php echo $linha_tabelas['CargaHoraria'];?></p>
                <p align="justify"><strong>Justificativa:</strong> <?php echo $linha_tabelas['Justificativa']; ?></p>
                <p align="justify"><strong>Fiscal:</strong> <?php echo $linha_tabelas['Fiscal'];?></p>
                <p align="justify"><strong>Suplente:</strong> <?php echo $linha_tabelas['Suplente'];?></p>
                <p align="justify"><strong>Parecer Técnico:</strong> <?php echo $linha_tabelas['ParecerTecnico']; ?></p>
                <p align="justify"><strong>Observação:</strong> <?php echo $linha_tabelas['Observacao'];?></p>
                <p align="justify"><strong>Data do Cadastro:</strong> <?php echo exibirDataBr($linha_tabelas['DataCadastro']);?></p>
                
			</div>
            </div>
            <div class="form-group">
                <form class="form-horizontal" role="form" action="?perfil=contratos&p=insercao_proposta_pf&id_ped=<?php echo $_SESSION['idPedido']; ?>" method="post">
					<div class="col-md-offset-2 col-md-8">
					 <input type="submit" class="btn btn-theme btn-lg btn-block" value="Gerar Proposta">
					</div>
                </form>   
				</div>
            </div>
         </div>
         </div>
</section>         