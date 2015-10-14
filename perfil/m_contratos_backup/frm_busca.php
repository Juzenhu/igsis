<?php include 'includes/menu.php';?>

<?php
if(isset($_POST['busca'])){
$resultado = busca($_POST['busca'],2);
$mensagem = "Foram encontradas ".$resultado['numReg']." pessoas com o termo ".$_POST['busca'].".";
?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Busca por pessoas</h2>
                    

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?>
                   

            	</div>
             </div>
				<br />             
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
               <div class="left">
               <?php 
			   $link_pj="?perfil=contratos&p=frm_edita_pj&id_pj=";
			   $link_pf="?perfil=contratos&p=frm_edita_pf&id_pf=";
			   echo "<h5>Pessoa Física</h5>";
			   for($i = 0; $i < count($resultado['fisica']); $i++){
				   echo "<a href='".$link_pf.$resultado['fisica'][$i]['IdPessoa']."'>".$resultado['fisica'][$i]['Nome']." (".$resultado['fisica'][$i]['CPF'].")</a><br />";
			   }
			   ?>
               <br />
               <?php 
			   echo "<h5>Pessoa Jurídica</h5>";
			   for($i = 0; $i < count($resultado['juridica']); $i++){
				   echo "<a href='".$link_pj.$resultado['juridica'][$i]['IdPessoa']."'>".$resultado['juridica'][$i]['Nome']." (".$resultado['juridica'][$i]['CNPJ'].")</a><br />";
			   }
			   ?>               
               </div>
        	    	</div>
        	    </div>

            </div>
	</section>
<?php
}else{
?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Busca por pessoas</h2>
                    

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?>
                        <form method="POST" action="?perfil=contratos&p=frm_busca" class="form-horizontal" role="form">
            		<label>Busca por palavras</label>
                    
                    
            		<input type="text" name="busca" class="form-control" id="palavras" placeholder="" ><br />

            	</div>
             </div>
				<br />             
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
                	<input type="hidden" name="pesquisar" value="1" />
    		        <input type="submit" class="btn btn-theme btn-lg btn-block" value="Pesquisar">
                    </form>
        	    	</div>
        	    </div>

            </div>
	</section>
<?php } ?>

<?php if(isset($resultado)){var_dump($resultado);}?>