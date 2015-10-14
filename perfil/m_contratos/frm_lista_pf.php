<?php

$_SESSION['idPedido'] = "";
$con = bancoMysqli();
include 'includes/menu.php';
?>
		
	  	  

	<script src="jquery/jquery-2.1.4.js"></script>
	<script>
	$(document).ready(function(){
		$("#input").keydown(function(){
			var input = $("#input").val();
			$.ajax({
			  type: "POST",
			  url: "index.php?perfil=contratos&p=controller_pf",
			  data: { "input" : input },
			  success: function(res){
			  	$("#resposta").html(res);
			  }
			});
		});
	});
	</script>
 <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
				 <div class="col-md-offset-2 col-md-8"><strong>Insira o Nome ou o CPF: </strong>
				 <input type="text" id="input" />
                 </div>
			  </div>
		</div>
		<div id="resposta"></div>
</section>
