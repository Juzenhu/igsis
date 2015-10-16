
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
				<a href="?perfil=administrador&p=listaprojetoespecial" class="btn btn-theme btn-lg btn-block">Listar Projeto especial</a>
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
		//$senha = MD5($_POST['senha']);
		$senha = MD5 ('igsis2015');
		$instituicao = $_POST['ig_instituicao_idInstituicao'];
		$telefone = $_POST['telefone'];
		$perfil = $_POST['papelusuario'];
		$email = $_POST['email'];
		$existe = verificaExiste("ig_usuario","email",$usuario,"0");
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
			$mensagem = "Usuário ou email já existente. Tente novamente.";
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
						<label>igsis2015</label>
               		</div> 	<!-- // Departamento !-->
					<div class="col-md-offset-2 col-md-8">	
                		<label>telefone:</label>
                		<input type="text" name="telefone" class="form-control"id="departamento" />
                	</div>  <!-- // Perfil de Usuario !-->
				<?php /*	<div class="col-md-offset-2 col-md-8">
                		<label>Instituição:</label>
                		<select name="ig_instituicao_idInstituicao" class="form-control"  >
						<?php instituicaoLocal("ig_instituicao","1",""); ?>
						</select>
                	</div> */?> <!-- // Perfil de Usuario !-->
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
break; // FIM INSERIR USUARIO
case "editarUser": // ATUALIZAR/EDITAR USUARIO 
if(isset($_POST['editarUser'])){
	$_SESSION['idUsuario'] = $_POST['editarUser'];
}
	if(isset($_POST['inserirUser'])){
		$nomeCompleto = $_POST['nomeCompleto'];
		$usuario = $_POST['usuario'];
		$existe = verificaExiste("ig_usuario","nomeUsuario",$usuario,"0");
		//$senha = MD5($_POST['senha']);
		$senha = MD5 ('igsis2015');
		$instituicao = $_POST['ig_instituicao_idInstituicao'];
		$telefone = $_POST['telefone'];
		$perfil = $_POST['papelusuario'];
		$email = $_POST['email'];
		$existe = verificaExiste("ig_usuario","email",$usuario,"0");
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
				$mensagem = "Usuário atualizado com sucesso";
			}else{
				$mensagem = "Erro ao editar. Tente novamente.";
			}
		}
		else{
			$mensagem = "Tente novamente.";
		}
	}
?>
<?php menuNovoUser($_SESSION['perfil']); //CHAMA O MENU ?> 
 
<section id="inserirUser" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="text-hide">
                    <h3>Editar Usuário</h3>
					<h3><?php if(isset($mensagem)){echo $mensagem;} ?></h3>
                </div>
            </div>
    	</div>
  <div class="row">
        <div class="col-md-offset-2 col-md-8">
	<form method="POST" action="?perfil=administrador&p=editarUser" class="form-horizontal" role="form">
               
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
						<input type="password" name="senha" class="form-control" id="senha" />
               		</div> 	<!-- // Departamento !-->
					<div class="col-md-offset-2 col-md-8">	
                		<label>telefone:</label>
                		<input type="text" name="telefone" class="form-control"id="departamento" />
                	</div>  <!-- // Perfil de Usuario !-->
					<div class="col-md-offset-2 col-md-8">
                		<label>Instituição:</label>
                		<select name="ig_instituicao_idInstituicao" class="form-control"  >
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
                		<input type="submit" class="btn btn-theme btn-lg btn-block" value="Atualizar Usuário"  />
					</div>
						        	
	</form>			
	</div>
	<form method="POST" action="?perfil=administrador&p=users" class="form-horizontal" >
				<div class="col-md-offset-2 col-md-8">
					<input type="submit" class="btn btn-theme btn-lg btn-blcok" value="Lista de Usuário" />
				</div>
		</div>
	</div>	
	</form>		  
	</div>    
</div>
</section>   

<?php
break; // FIM LISTA USUARIOS / INSERIR / ATUALIZAR
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
       <!-- // FIM DE INSERIR ESPACOS !-->
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
break; // FIM LISTA ESPACOS / INSERIR / ATUALIZAR
case "novoProjetoEspecial": // INSERIR NOVO PROJETO ESPECIAL 
if(isset($_POST['cadastrar'])){
	//$con = bancoMysqli();
	
		$projetoEspecial = $_POST['projetoEspecial'];	
			if($projetoEspecial == ''){  
			$mensagem = "<p>O campo projeto especial, está em branco e é obrigatório. Tente novamente.</a></p>"; 
							}
			else{
			$sqlverificar= "SELECT * FROM ig_projeto_especial WHERE projetoEspecial LIKE '$projetoEspecial'";
				$queryverificar= mysqli_query($con,$sqlverificar);
				$existe = mysqli_num_rows ($queryverificar);
				
				if ($existe == 0) // caso não esteja vazio
				{ //inserir no banco
					$sqlinserir= "INSERT INTO `ig_projeto_especial` (`idProjetoEspecial`,`projetoEspecial`,`publicado`) VALUES (NULL, '$projetoEspecial', 1)";
					$queryinserir= mysqli_query($con,$sqlinserir);
					if($queryinserir){
						$mensagem= "Inserido com sucesso.";
					}
					else { // erro ao inserir
						$mensagem= "Erro ao inserir.";
					}
				}
				else {  // espaço já existe retirado do comando $sqlverificar 
					$mensagem = "Projeto especial já existente.";
				}
		}					 
}
?>
<?php menuNovoProjetoEspecial($_SESSION['perfil']); //CHAMA O MENU ?> 
      
 <section id="inserirUser" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="text-hide">
                    <h3>Administrativo </h3> <h2> Inserir novo projeto especial</h3>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                </div>
            </div>
    	</div>
  <div class="row">
        <div class="col-md-offset-2 col-md-8">
		     <form method="POST" action="?perfil=administrador&p=novoProjetoEspecial" class="form-horizontal" role="form">
					<!-- // Espaço existente !-->
			<div class="col-md-offset-1 col-md-10">  
			    <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                		<label>Projeto especial existentes:</label>
					<select name="listaespaco" class="form-control"  >
						<?php geraProjetoEspecial("ig_projeto_especial",""); ?>
						</select>	
					</div>
                	<div class="col-md-offset-2 col-md-8">
                		<label>Adicionar novo projeto especial:</label>
                		<input type="text" name="projetoEspecial" class="form-control"id="espaco" value="" />
                	</div>  
				 <div class="col-md-offset-2 col-md-8"> 
				 <label></label> <!-- Adicionar novo espaço !-->
            		</div>
						<!-- Botão de gravar !-->
					<div class="col-md-offset-2 col-md-8">
                    	<input type="hidden" name="cadastrar" value="1"  />
                		<input type="submit" class="btn btn-theme btn-lg btn-block" value="Adcionar"  />
						         		</div>
			
			</div>
		</div>
		</form>
				<form method="POST" action="?perfil=administrador&p=listaprojetoespecial" class="form-horizontal"  role="form">
				<div class="col-md-offset-2 col-md-8">
				<input type="submit" class="btn btn-theme btn-lg btn-block" value="lista de projeto especial"/>
				</div></form>
</div>
  </div>
    </div>
       <!-- // FIM DE INSERIR !-->
	</section>
	
<?php
break; // FIM ADICIONAR NOVO PROJETO ESPECIAL
case "listaprojetoespecial": 

if(isset($_POST['apagar'])){
	$con = bancoMysqli();
	$idApagar = $_POST['apagar'];
	$sql_apagar_registro = "UPDATE `ig_projeto_especial` SET `publicado` = '0' WHERE idProjetoEspecial = $idApagar";
		if(mysqli_query($con,$sql_apagar_registro)){	
		$mensagem = "projeto especial apagado com sucesso!";
		gravarLog($sql_apagar_registro);
	}else{
		$mensagem = "Erro ao apagar o projeto especial...";	
	}
							}	
// EDITAR / APAGAR PROJETO ESPECIAL
?>
<?php menuListaProjetoEspecial($_SESSION['perfil']); //CHAMA O MENU ?> 
 		<section id="list_items" class="home-section bg-white">
		 <div class="form-group">
            <div class="col-md-offset-2 col-md-8">		
			<h2>Lista de projeto especial</h2>
				<a href="?perfil=administrador&p=novoProjetoEspecial" class="btn btn-theme btn-lg btn-block">Inserir novo projeto especial</a>
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
                         <?php projetoEspecialExistente ($_SESSION['perfil']); ?>
			</div>
		</div>
		
	</section> <!--/#list_items-->

<?php	
break; // FIM PROJETO ESPECIAL
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
			  
			  <section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Chamados</h2>
					<h4>Selecione o chamado para visualizar.</h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
					</div>
				  </div>
			  </div>  

			<div class="table-responsive list_info">
                         <?php listaAlteracoes($_SESSION['perfil']); ?>
			</div>
		</div>
	</section> <!--/#list_items-->
	
<?php	
	/*
	//para  inserir
	INSERT INTO `igsis`.`ig_alteracao` (`idAlteracao`, `ig_evento_idEvento`, `protocolo`, `usuario`, `dataAlteracao`, `assunto`, `descricao`, `justificativa`, `publicado`) VALUES (NULL, '170', '1', 'junior', '2015-10-16', 'Teste', 'Favor consertar o ar condicionado', 'precisamos do ar para melhor trabalho corporativo', '0');
	
	*/
	?>
	

<?php 

break;
} //fim da switch ?>

<?php var_dump ($_POST)
?>
