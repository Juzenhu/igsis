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
$conta = recuperaUsuarioCompleto($_SESSION['idUsuario']);
 ?>
 	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="text-hide">
                <h2>Configuração de conta</h2>
					 <h5>Dados da conta</h5>
                     <h6><?php if(isset($mensagem)){echo $mensagem;} ?></h6>
					</div>
				  </div>
			  </div>

	  		<div class="row">
	  			<div class="left">
                <p>Usuário: <strong><?php echo $_SESSION['usuario']; ?></strong></p>
                <p>Nome completo: <strong><?php echo $conta['nomeCompleto']; ?></strong></p>
                <p>E-mail: <strong><?php echo $conta['email']; ?></strong></p> 
                <p>Notificação por e-mail: <strong><?php echo $conta['notificacao']; ?></strong></p> 
                <p>Instituição: <strong><?php echo $conta['instituicao']; ?></strong></p>
                <p>Perfil: <strong><?php echo $conta['perfil']; ?></strong></p>
                <p>Módulos: <strong><?php echo $conta['modulos']; ?></strong></p>
            </div>
			
				
	  		</div>
			

	  	</div>
	  </section>  
<?php

break;
}
 ?>