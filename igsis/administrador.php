<?php
//include para painel administração

/*
+ administração de usuários
+ administração de locais
+ administração de api do SPCultura
+ recuperação de eventos deletados
+ manipulação de logs
*/
?>
<?php
@ini_set('display_errors', '1');
error_reporting(E_ALL);

if(isset($_GET['p'])){
	$p = $_GET['p'];	
}else{
	$p = "inicio";
}

switch($p){

case "inicio":
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
	                <h4>Escolha uma opção</h4>
                </div>
            </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?perfil=administrador&p=novoUser" class="btn btn-theme btn-lg btn-block">Inserir um novo Usuario</a>
	            <a href="?perfil=administrador&p=listarUser" class="btn btn-theme btn-lg btn-block">Listar usuários</a>
  	        </div>
          </div>
        </div>
    </div>
	</section>  
<?php
// LISTA DE USUARIOS 
break;
	case "listarUser":
	
	if(isset($_POST['apagar'])){
	$idApagar = $_POST['apagar'];
	$sql_apagar_registro = "UPDATE ig_evento SET publicado = 0 WHERE idEvento = $idApagar";

	if(mysql_query($sql_apagar_registro)){	
		$mensagem = "Evento apagado com sucesso!";
		gravarLog($sql_apagar_registro);
	}else{
		$mensagem = "Erro ao apagar o evento...";	
	}
}
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
	<form method="POST" action="?perfil=evento&p=listarUser" class="form-horizontal" role="form">
	<section id="listarUser" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Usuários Cadastrados</h2>
					<h4>Selecione o usuário para editar.</h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
					</div>
				  </div>
			  </div>  

			<div class="table-responsive list_info">
                         <?php listaUsers($_SESSION['perfil']); ?>
			</div>
	</form>
		</div>
	</section> <!--/#list_items-->
<?	
// FIM LISTA USUARIOS
break;
case "novoUser":
// INSERIR USUARIO 
?>
<section id="inserirUser" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-8">
                <div class="text-hide">
                    <h3>Administrativo - Inserir Usuário</h3>
          <!--   //Campo para inserir usuario  !--> <h1>  <?php // echo $campo["User"] ?><? // echo $idUser; ?></h1>
                    <p><?php if(isset($mensagem)){echo $mensagem;} ?></p>
                </div>
            </div>
    	</div>
	
        <div class="row">
            <div class="col-md-offset-1 col-md-8">
            <form method="POST" action="?perfil=evento&p=inserirUser" class="form-horizontal" role="form">
               
					<!-- // Usuario e Senha !-->
			    <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
                		<label>Usuario:</label>
                		<input type="text" name="usuario" class="form-control"id="usuario" />
                	</div> 
                	<div class="col-md-offset-2 col-md-6"> <!-- // SENHA !-->
                		<label>Senha:</label>
                		<input type="text" name="senha" class="form-control"id="senha" />
               		</div>
             	</div>
            </div>		
					<!-- //Departamento !-->
			 <div class="form-group">
					<div class="col-md-offset-2 col-md-7">
                		<label>Departamento:</label>
                		<input type="text" name="departamento" class="form-control"id="departamento" />
                	</div> 
					 <div class="col-md-offset-2 col-md-7">
					 <input type="checkbox" name="contratos" id="diasemana01" disabled="disabled"/><label style="padding:0 10px 0 5px;"> Contratos</label>
    		            <input type="checkbox" name="documentacao" id="diasemana01" disabled="enable" /><label style="padding:0 10px 0 5px;"> Documentação</label>
						<input type="checkbox" name="documentacao" id="diasemana01" disabled="enable" /><label style="padding:0 10px 0 5px;"> Eventos</label>
						<input type="checkbox" name="documentacao" id="diasemana01" disabled="enable" /><label style="padding:0 10px 0 5px;"> Finanças</label>
						<input type="checkbox" name="documentacao" id="diasemana01" disabled="enable" /><label style="padding:0 10px 0 5px;"> Jurídico</label>
						<input type="checkbox" name="documentacao" id="diasemana01" disabled="enable" /><label style="padding:0 10px 0 5px;"> Contabilidade</label>
					</div>   
			</div> 
			
			
					<!--  // Email !-->
  <div class="col-md-offset-1 col-md-10">  
			<div class="form-group"> 
            	<div class="col-md-offset-2 col-md-8">
            		<label>Email:</label>
            		<input type="text" name="ig_produtor_email" class="form-control" id="inputSubject" value="<?php echo $produtor['email'] ?>"/>
            	</div> 
            </div>  <!-- // Confirmação de Recebimento de Email !-->
                <div class="form-group">
	                <div class="col-md-offset-2 col-md-8">
    		            <input type="checkbox" name="sim" id="diasemana01" disabled="disabled" <?php checar($ocor['sim']) ?> /><label style="padding:0 10px 0 5px;"> Receber Email:</label>
					</div>                     
                </div>
           <!--         // Inserir Usuário !-->
                <div class="form-group">
                	<div class="col-md-offset-2 col-md-8">
                    	<input type="hidden" name="inserirUser" value="1"  />
                		<input type="submit" class="btn btn-theme btn-lg btn-block" value="Inserir Usuário"  />
               		</div>
                </div>          
	   </form>
 </div>
            </div>
        </div>
	</div>
</section>   

<?php 
// FIM DE INSERIR USUARIO
break;
} //fim da switch ?>


