	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li>
								<a href="?secao=inicio">Início</a>
							</li>
							<li><a href="?perfil=usuario&p=dados">Dados da conta</a></li>
							<li><a href="?perfil=usuario&p=senha">Mudança de senha</a></li>
                            <li><a href="../include/logoff.php">Sair do sistema</a></li>
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
                <h2>Configuração de conta</h2>
	                <h5>Escolha uma opção</h5>
                </div>
            </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?perfil=usuario&p=senha" class="btn btn-theme btn-lg btn-block">Mudança de senha</a>
	            <a href="?perfil=usuario&p=dados" class="btn btn-theme btn-lg btn-block">Dados da conta</a>
  	            
            </div>
          </div>
        </div>
    </div>
</section>   
<?php 
break;
case "senha":

if(isset($_POST['senha01'])){ //verifica se há um post
	if(($_POST['senha01'] != "") AND (strlen($_POST['senha01']) > 5)){
		if($_POST['senha01'] == $_POST['senha02']){ // verifica se a nova senha foi digitada corretamente duas vezes
			$senha = recuperaDados("ig_usuario",$_SESSION['usuario'],"nomeUsuario");
			if(md5($_POST['senha03']) == $senha['senha']){
				$usuario = $_SESSION['idUsuario'];
				$senha01 = $_POST['senha01'];
				$sql_senha = "UPDATE `ig_usuario` SET `senha` = '$senha01' WHERE `idUsuario` = '$senha01';";
				$query_senha = mysqli_query($con,$sql_senha);
				if($query_senha){
					$mensagem = "Senha alterada com sucesso!";	
				}else{
					$mensagem = "Não foi possível mudar a senha. Tente novamente.";	
				}
			}else{
					$mensagem = "Senha atual incorreta.";	
			}
		}else{ // caso não tenha digitado 2 vezes
			$mensagem = "As senhas não conferem. Tente novamente.";
		}
	
	}else{
		$mensagem = "A senha não pode estar em branco e deve conter mais de 5 caracteres";	
	}

}


?>
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="text-hide">
                <h2>Configuração de conta</h2>
					 <h5>Mudança de senha</h5>
                     <h6><?php if(isset($mensagem)){echo $mensagem;} ?></h6>
					</div>
				  </div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form method="POST" action="?perfil=usuario&p=senha"class="form-horizontal" role="form">
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><label>Nova senha</label>
					  <input type="password" name="senha01" class="form-control" id="inputName" placeholder="">
					</div>
				  
					<div class=" col-md-6"><label>Redigite a nova senha</label>
					  <input type="password" name="senha02" class="form-control" id="inputEmail" placeholder="">
					</div>
				  </div>

				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><label>Insira sua senha antiga para confirmar a mudança.</label>
					 <input type="password" name="senha03" class="form-control" id="inputName" placeholder="">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <button type="submit" class="btn btn-theme btn-lg btn-block">Mudar a senha</button>
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

<?php

break;
case "dados";

if(isset($_POST['atualizar'])){ //atualiza os dados
	$nome = $_POST['nome'];
	$email  = $_POST['email'];
	$telefone  = $_POST['telefone'];
	$notificacao  = $_POST['notificacao'];
	$idUsuario = $_SESSION['idUsuario'];

	$sql_atualiza_dados = "UPDATE `igsis`.`ig_usuario` SET `receberNotificacao` = '$notificacao', `nomeCompleto` = '$nome', `telefone` = '$telefone' WHERE `ig_usuario`.`idUsuario` = '$idUsuario';";
	
	$con = bancoMysqli();
	$query_atualiza_dados = mysqli_query($con, $sql_atualiza_dados);	
	if($query_atualiza_dados){
		$mensagem = "Dados atualizados!";
		gravarLog($sql_atualiza_dados);	
	}else{
		$mensagem = "Erro ao atualizar! Tente novamente.";	

	}

}


$conta = recuperaUsuarioCompleto($_SESSION['idUsuario']);
 ?>
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<h3>DADOS DO USUÁRIO</h3>
                    <p><?php if(isset($mensagem)){ echo $mensagem; } ?></p> 
                    <p>Se necessitar a edição de um campo não permitido neste formulário, contacte o administrador local.</p> 
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=usuario&p=dados" method="post">
				  
			  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Nome completo:</strong><br/>
					  <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $conta['nomeCompleto']; ?>" >
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Email:</strong><br/>
					  <input type="text"  class="form-control" id="email" name="email" value="<?php echo $conta['email']; ?>"  >
					</div>
					<div class="col-md-6"><strong>Usuário:</strong><br/>
					  <input type="text" readonly class="form-control" id="usuario" name="usuario" value="<?php echo $conta['nomeUsuario']; ?>" >
					</div>
				  </div>
				  
				  <div class="form-group">
                  					<div class="col-md-offset-2 col-md-6"><strong>Telefone</strong><br/>
					  <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $conta['telefone']; ?>" placeholder="(XX)XXXX-XXXX">
					</div>				  
					<div class=" col-md-6"><strong>Receber notificação por Email</strong><br/>
	              		 <select class="form-control" name="notificacao" id="inputSubject" >
                        <option value="0" <?php if($conta['receberNotificacao'] == 0){echo "selected";} ?> >Não</option>
                        <option value="1" <?php if($conta['receberNotificacao'] == 1){echo "selected";} ?> >Sim</option>
                        
                        </select>       
					</div>

				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Módulos habilitados</strong><br/>
					  	<textarea name="publico" readonly="readonly" class="form-control" rows="5" placeholder=""><?php echo $conta['modulos']; ?></textarea>
                      
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Perfil:</strong><br/>
					  <input type="text" readonly class="form-control" value="<?php echo $conta['perfil']; ?>">
					</div>				  
					<div class=" col-md-6"><strong>Instituicao:</strong><br/>
					  <input type="text" readonly class="form-control" value="<?php echo $conta['instituicao']; ?>">
					</div>
				  </div>
				  
				<!-- Botão Gravar -->	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                     <input type="hidden" name="atualizar" value="1" />
					 <input type="image" alt="GRAVAR" value="submit" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

<?php

break;
}
 ?>