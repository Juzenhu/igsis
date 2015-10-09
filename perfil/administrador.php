
<?php

//include para painel administração
require "../funcoes/funcoesadministrador.php"; //chamar funcoes do administrador

?>
<?php
@ini_set('display_errors', '1');
error_reporting(E_ALL);
$con = bancoMysqli();
if(isset($_GET['p'])){
	$p = $_GET['p'];	
}else{
	$p = "inicio";
}

switch($p){

case "inicio":
?>
<?php menuInicio($_SESSION['perfil']); //CHAMA O MENU ?> 
 
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
	            <a href="?perfil=administrador&p=users" class="btn btn-theme btn-lg btn-block">Listar usuários</a>
				<a href="?perfil=administrador&p=espacos" class="btn btn-theme btn-lg btn-block">Listar Espaços</a>
				<a href="?perfil=administrador&p=eventos" class="btn btn-theme btn-lg btn-block">Listar Eventos</a>
				<a href="?perfil=administrador&p=logsLocais" class="btn btn-theme btn-lg btn-block">Logs Locais</a>
				<a href="?perfil=administrador&p=alteracoes" class="btn btn-theme btn-lg btn-block">Alterações</a>
  	        </div>
          </div>
        </div>
    </div>
	</section>  
<?php
// LISTA DE USUARIOS 
break;
 case "users":
	
	if(isset($_POST['apagar'])){
	$idApagar = $_POST['apagar'];
	$sql_apagar_registro = "UPDATE ig_usuario SET publicado = 0	WHERE `idUsuario` = $idApagar";

	if(mysqli_query($sql_apagar_registro)){	
		$mensagem = "Usuário apagado com sucesso!";
		gravarLog($sql_apagar_registro);
	}else{
		$mensagem = "Erro ao apagar o usuário...";	
	}
		
}
	?> 
<?php menuUsers($_SESSION['perfil']); //CHAMA O MENU ?> 	

	<form method="POST" action="?perfil=administrador&p=users" class="form-horizontal" role="form">
	<section id="listarUser" class="home-section bg-white">
	 <div class="form-group">
            <div class="col-md-offset-2 col-md-8">		
		 <h2>Usuários Cadastrados</h2>
				<a href="?perfil=administrador&p=novoUser" class="btn btn-theme btn-lg btn-block">Inserir novo usuário</a>
  	        </div>
				</div> 
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">					
					<h4>Selecione o usuário para editar.</h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
					</div>
				  </div>
			  </div>  

			<div class="table-responsive list_info">
                         <?php listaUsuarioAdministrador($_SESSION['idInstituicao']); ?>
			</div>
	</form>
		</div>
	</section> 
<?php	
break; // FIM LISTA USUARIOS
case "novoUser": // INSERIR NOVO USUARIO 
	if(isset($_POST['inserirUser'])){
		$nomeCompleto = $_POST['nomeCompleto'];
		$usuario = $_POST['usuario'];
		$existe = verificaExiste("ig_usuario","nomeUsuario",$usuario,"0");
		$senha = MD5($_POST['senha']);
		$instituicao = $_POST['instituicao'];
		$telefone = $_POST['telefone'];
		$perfil = $_POST['papelusuario'];
		$email = $_POST['email'];
		$publicado = "1";
		if(isset($_POST['receberEmail'])){
			$receberEmail =	1;
		}else{
			$receberEmail =	0;
		}
			
	
		if($existe['numero'] == 0){
			$sql_inserir = "INSERT INTO `ig_usuario` (`idUsuario`, `ig_papelusuario_idPapelUsuario`, `senha`, `receberNotificacao`, `nomeUsuario`, `email`, `nomeCompleto`, `idInstituicao`, `telefone`, `publicado`) VALUES (NULL, '$perfil', '$senha', '$receberEmail', '$usuario', '$email', '$nomeCompleto', '$instituicao', '$telefone', '$publicado')";
			$query_inserir = mysqli_query($con,$sql_inserir);
			if($query_inserir){
				$mensagem = "Usuário inserido com sucesso";
			}else{
				$mensagem = "Erro ao inserir. Tente novamente.";
			}
		}
		else{
			$mensagem = "Usuário já existente. Utilize outro username.";
		}
	}
?>
<?php menuNovoUser($_SESSION['perfil']); //CHAMA O MENU ?> 
 
<section id="inserirUser" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="text-hide">
                    <h3>Inserir Usuário</h3>
					<h3><?php if(isset($mensagem)){echo $mensagem;} ?></h3>
                </div>
            </div>
    	</div>
  <div class="row">
        <div class="col-md-offset-2 col-md-8">
	<form method="POST" action="?perfil=administrador&p=novoUser" class="form-horizontal" role="form">
               
					<!-- // Usuario !-->
			<div class="col-md-offset-1 col-md-10">  
			    <div class="form-group">
				<div class="col-md-offset-2 col-md-8">
                		<label>Nome Completo:</label>
                		<input type="text" name="nomeCompleto" class="form-control"id="nomeCompleto" value="" />  </div> 
                	<div class="col-md-offset-2 col-md-8">
                		<label>Usuario:</label>
                		<input type="text" name="usuario" class="form-control"id="usuario" />
                	</div>  <!-- // SENHA !-->
                	<div class="col-md-offset-2 col-md-8">
                		<label>Senha:</label>
                		<input type="password" name="senha" class="form-control"id="senha" />
						<input type="checkbox" name="mostrarSenha" id="senha" action="$senha"/><label style="padding:0 10px 0 5px;"> Exibir Senha</label>
               		</div> <!-- // Departamento !-->
					<div class="col-md-offset-2 col-md-8">	
                		<label>telefone:</label>
                		<input type="text" name="telefone" class="form-control"id="departamento" />
                	</div>  <!-- // Perfil de Usuario !-->
					<div class="col-md-offset-2 col-md-8">
                		<label>Instituição:</label>
                		<select name="papelusuario" class="form-control"  >
						<?php instituicaoLocal("ig_instituicao","1",""); ?>
						</select>
                	</div>  <!-- // Perfil de Usuario !-->
					 <div class="col-md-offset-2 col-md-8">
					 <div class="col-md-offset-2 col-md-8">
                		<label>Acesso aos Perfil's :</label> </div>
						<select name="papelusuario" class="form-control"  >
						<?php acessoPerfilUser("ig_papelusuario","3",""); ?>
						</select>
					</div>  <!--  // Email !-->
					<div class="col-md-offset-2 col-md-8">  
					<label>Email para cadastro:</label>
					<input type="text" name="email" class="form-control" id="email" value=""/>
					</div>
		            <div class="col-md-offset-2 col-md-8"> <!-- // Confirmação de Recebimento de Email !-->
            		  <label style="padding:0 10px 0 5px;">Receber Email de atualizações: </label><input type="checkbox" name="receberEmail" id="diasemana01"/>
            		</div> <!-- Fim de Preenchemento !-->  
					<!-- Botão de Confirmar cadastro !-->
					<div class="col-md-offset-2 col-md-8">
                    	<input type="hidden" name="inserirUser" value="1"  />
                		<input type="submit" class="btn btn-theme btn-lg btn-block" value="Inserir Usuário"  />
						
						        		</div>
						</div>
				</div>
		</div>
	</form>
	<form method="POST" action="?perfil=administrador&p=users" class="form-horizontal"  role="form">
				<div class="col-md-offset-2 col-md-8">
					<input type="submit" class="btn btn-theme btn-lg btn-blcok" value="Lista de Usuário" />
					</div>
					</form>
					
			  
					  
					</div>
          
  </div>
</section>   
<?php
break; // FIM LISTA USUARIOS
case "novoEspaco": // INSERIR NOVO ESPACO 
if(isset($_POST['cadastrar'])){
	//$con = bancoMysqli();
	
		$espaco = $_POST['espaco'];	
			if($espaco == ''){  
			$mensagem = "<p>O campo espaco, está em branco e é obrigatório. Tente novamente.</a></p>"; 
							}
			else{
			$sqlverificar= "SELECT * FROM ig_espaco WHERE espaco LIKE '$espaco'";
				$queryverificar= mysqli_query($con,$sqlverificar);
				$existe = mysqli_num_rows ($queryverificar);
				
				if ($existe == 0) // caso não esteja vazio
				{ //inserir no banco
					$sqlinserir= "INSERT INTO `ig_espaco` (`idEspaco`,`espaco`,`publicado`) VALUES (NULL, '$espaco', 1)";
					$queryinserir= mysqli_query($con,$sqlinserir);
					if($queryinserir){
						$mensagem= "Inserido com sucesso.";
					}
					else { // erro ao inserir
						$mensagem= "Erro ao inserir.";
					}
				}
				else {  // espaço já existe retirado do comando $sqlverificar 
					$mensagem = "Espaço já existente.";
				}
		}					 
}
?>
<?php menuNovoEspaco($_SESSION['perfil']); //CHAMA O MENU ?> 
      
 <section id="inserirUser" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="text-hide">
                    <h3>Administrativo </h3> <h2> Inserir Novo Espaço</h3>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                </div>
            </div>
    	</div>
  <div class="row">
        <div class="col-md-offset-2 col-md-8">
		     <form method="POST" action="?perfil=administrador&p=novoEspaco" class="form-horizontal" role="form">
					<!-- // Espaço existente !-->
			<div class="col-md-offset-1 col-md-10">  
			    <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                		<label>Espaços Existentes:</label>
					<select name="listaespaco" class="form-control"  >
						<?php geraEspaco("ig_espaco",""); ?>
						</select>	
					</div>
                	<div class="col-md-offset-2 col-md-8">
                		<label>Adicionar novo Espaço:</label>
                		<input type="text" name="espaco" class="form-control"id="espaco" value="" />
                	</div>  
				 <div class="col-md-offset-2 col-md-8"> 
				 <label></label> <!-- Adicionar novo espaço !-->
            		</div>
						<!-- Botão de gravar !-->
					<div class="col-md-offset-2 col-md-8">
                    	<input type="hidden" name="cadastrar" value="1"  />
                		<input type="submit" class="btn btn-theme btn-lg btn-block" value="Inserir"  />
						         		</div>
			
			</div>
		</div>
		</form>
				<form method="POST" action="?perfil=administrador&p=espacos" class="form-horizontal"  role="form">
				<div class="col-md-offset-2 col-md-8">
				<input type="submit" class="btn btn-theme btn-lg btn-block" value="lista de espaço"/>
				</div></form>
</div>
  </div>
    </div>
       <!-- // FIM DE INSERIR USUARIO !-->
	</section>
	
<?php
break; // FIM ADICIONAR NOVO ESPACO
case "espacos": 

if(isset($_POST['apagar'])){
	$con = bancoMysqli();
	$idApagar = $_POST['apagar'];
	$sql_apagar_registro = "UPDATE ig_espaco SET publicado = 3 WHERE idEspaco = $idApagar";

	if(mysqli_query($con,$sql_apagar_registro)){	
		$mensagem = "Espaço apagado com sucesso!";
		gravarLog($sql_apagar_registro);
	}else{
		$mensagem = "Erro ao apagar o evento...";	
	}
		
}
// EDITAR / APAGAR ESPACOS
?>
<?php menuEspacos($_SESSION['perfil']); //CHAMA O MENU ?> 
 		<section id="list_items" class="home-section bg-white">
		 <div class="form-group">
            <div class="col-md-offset-2 col-md-8">		
			<h2>Lista de Espaços</h2>
				<a href="?perfil=administrador&p=novoEspaco" class="btn btn-theme btn-lg btn-block">Inserir novo espaço</a>
  	        </div>
				</div> 
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					
					</div> <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
					</div>
				  </div>
				  
			<div class="table-responsive list_info">
                         <?php espacoExistente ($_SESSION['perfil']); ?>
			</div>
		</div>
		
	</section> <!--/#list_items-->

<?php	
break; // FIM ESPACOS
case "eventos": // LISTAR NOVOS EVENTOS
if(isset($_POST['apagar'])){
	$idApagar = $_POST['apagar'];
	$sql_apagar_registro = "UPDATE ig_evento SET publicado = 3 WHERE idEvento = $idApagar";

	if(mysqli_query($con,$sql_apagar_registro)){	
		$mensagem = "Evento apagado com sucesso!";
		gravarLog($sql_apagar_registro);
	}else{
		$mensagem = "Erro ao apagar o evento...";	
	}
}
?>
<?php menuEventos ($_SESSION['perfil']); //CHAMA O MENU ?> 

	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Eventos excluidos</h2>
					<h4>Selecione o evento para recuperar ou editar.</h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
					</div>
				  </div>
			  </div>  

			<div class="table-responsive list_info">
                         <?php listaEventosAdministrador($_SESSION['perfil']); ?>
			</div>
		</div>
	</section> <!--/#list_items-->

		
<?php	
break; // FIM EVENTOS
case "logsLocais": // VISUALIZAR LOGS DE USUARIO
?>
<?php menuLog($_SESSION['perfil']);  //CHAMA O MENU ?>

		<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Logs de Usuários</h2>
					<h4>Selecione o Log recuperar ou editar.</h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
					</div>
				  </div>
			  </div>  

			<div class="table-responsive list_info">
                         <?php listaLogAdministrador($_SESSION['perfil']); ?>
			</div>
		</div>
	</section> <!--/#list_items-->		
		<?php	
break; // FIM LOGS LOCAIS
case "alteracoes": // INICIO DE ALTERAÇÕES
?>
              <?php menuAlteracoes ($_SESSION['perfil']); //CHAMA O MENU ?> 

<?php 

break;
} //fim da switch ?>

<?php var_dump ($_POST)
?>
