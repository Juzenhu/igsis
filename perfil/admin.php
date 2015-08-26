<?php include "../include/menuEvento.php" ?>

<section id="inserir" class="home-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="text-hide">
                    <h3>Administração Geral do Sistema</h3>
                </div>
            </div>
    </div>
    
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
        <form method="POST" action="?perfil=evento&p=internos" class="form-horizontal" role="form">
           					<h5>Opções Gerais do Sistema</h5>
			                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
                    	<label>Habilitar notificação por e-mail</label>
                    	                		 <select class="form-control" name="ig_artesvisuais_identidadeVisual" id="inputSubject" >
                        <option value="0" <?php if(isset($artes)){if($artes['identidadeVisual'] == 0){echo "selected";}} ?> >Não</option>
                        <option value="1" <?php if(isset($artes)){if($artes['identidadeVisual'] == 1){echo "selected";}} ?>>Sim</option>
                        
                        </select>
                	</div>

               		<div class=" col-md-6">
                    	<label>Habilitar impressão em PDF</label>
                		 <select class="form-control" name="ig_artesvisuais_identidadeVisual" id="inputSubject" >
                        <option value="0" <?php if(isset($artes)){if($artes['identidadeVisual'] == 0){echo "selected";}} ?> >Não</option>
                        <option value="1" <?php if(isset($artes)){if($artes['identidadeVisual'] == 1){echo "selected";}} ?>>Sim</option>
                        
                        </select>
                	</div>
                </div>
				                <div class="form-group">
                	<div class="col-md-offset-2 col-md-6">
                    	<label>Habilitar gravação de log</label>
                    	 <select class="form-control" name="ig_artesvisuais_identidadeVisual" id="inputSubject" >
                        <option value="0" <?php if(isset($artes)){if($artes['identidadeVisual'] == 0){echo "selected";}} ?> >Não</option>
                        <option value="1" <?php if(isset($artes)){if($artes['identidadeVisual'] == 1){echo "selected";}} ?>>Sim</option>
                        
                        </select>
                	</div>
               		<div class=" col-md-6">
                    	<label>Importação de formulário externo</label>
                		 <select class="form-control" name="ig_artesvisuais_identidadeVisual" id="inputSubject" >
                        <option value="0" <?php if(isset($artes)){if($artes['identidadeVisual'] == 0){echo "selected";}} ?> >Não</option>
                        <option value="1" <?php if(isset($artes)){if($artes['identidadeVisual'] == 1){echo "selected";}} ?>>Sim</option>
                        
                        </select>
                	</div>
                </div>
                <div class="form-group">
                    
           			<h5>Pedido de documentação</h5>
	            	<div class="col-md-offset-2 col-md-8">

    		            <input type="checkbox" name="ig_comunicacao_registroFotografia" id="especial01" <?php checar($producao['registroFotografia']) ?> /><label  style="padding:0 10px 0 5px;">Fotografia</label>
           			    <input type="checkbox" name="ig_comunicacao_registroAudio" id="especial02" <?php checar($producao['registroAudio']) ?>/><label  style="padding:0 10px 0 5px;">Áudio</label>
            		    <input type="checkbox" name="ig_comunicacao_registroVideo" id="especial03" <?php checar($producao['registroVideo']) ?>/><label  style="padding:0 10px 0 5px;">Vídeo</label>
                	</div>                     
                </div>
            <div class="form-group">
	            <div class="col-md-offset-2 col-md-8">
                	<input type="hidden" name="atualizar" value="1" />
    		        <input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
            	</div>
            </div>
            </form>
        </div>
    </div>
</section>  