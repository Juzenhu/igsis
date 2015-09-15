<?
//include para comunicação

 ?>
<?php

// verifica se o usuário tem acesso a página
$verifica = verificaAcesso($_SESSION['idUsuario'],$_GET['perfil']); 
if($verifica == 1){
?>
<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
	                <h1>Parabéns, você tem acesso!</h1>
	               
                </div>
            </div>
        </div>
				<div class="table-responsive list_info">
                         <?php listaNaoRevisado($_SESSION['perfil']); ?>
			</div>
	</div>
</section> 
<?php }else{ //verificacao ?>

<section id="contact" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
	                <h1>Acesso negado.</h1>
	                <h2>Contacte o administração do sistema.</h2>
                </div>
            </div>
        </div>
	</div>
</section>                
<?php } ?>