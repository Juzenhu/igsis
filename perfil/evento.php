<?php
@ini_set('display_errors', '1');
error_reporting(E_ALL);
?>
	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li>		
								<a href="#enviar">Início</a> </li>
							
							<li><a href="#lista">Arquivos anexados</a></li>
							<li>
								<a href="#">Eventos</a>
								<ul class="dl-submenu">
									<li><a href="#">Inserir Evento</a></li>
									<li><a href="#">Listar Listar</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /dl-menuwrapper -->
	</div>	
<section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="text-hide">
					 <h2>Inserir Evento</h2>
					 <h1>Apresentação Básica</h1>
					 <p> </p>
					</div>
				  </div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form">
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><label>Tipo de modalidade </label><input type="text" name="dataInicio" class="form-control" id="datepicker01" placeholder="Name">
					</div>
				  
					<div class=" col-md-6"><label>Nome do Programao</label>
					  <input type="text" name="dataFinal" class="form-control" id="datepicker02" placeholder="Email">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <label>Nome do Projeto Especial </label>
                      <input type="checkbox" id="diaespecial" />
                      <div class='other' name='other' title='other' style='display:none;'>

						<input type="checkbox">
						<input type="checkbox">
					</div>
					</div>
				  </div>  
				  <div class="form-group">
                     
					<div class="col-md-offset-2 col-md-2">
               <label>Nome do Evento *</label>
					  <input type="text" name="hora" class="form-control"id="hora" />
            
					</div> 

				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><label>Nome do Projeto </label><input type="text" name="valorIngresso" class="form-control" id="valor" placeholder="Name">
					</div>
				  
					<div class=" col-md-6"><label>Tipo de Evento *</label>
					  <input type="email" id="duracao" name="duracao" class="form-control" id="" placeholder="Email">
					</div>
				  </div>
         
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <label>Memorando</label>
					  <select class="form-control" name="retiradaIngresso" id="inputSubject" ><option>Selecione</option></select>
					</div>
				  </div>
 <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <label>Nome do Responsável pelo Evento no CCSP (responsável pelo contrato)* </label>
					  <select class="form-control" name="instituicao" id="inputSubject" ><option>Selecione</option></select>
					</div>
				  </div>
 <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <label>Telefone / Ramal do Responsável pelo Evento do CCSP *</label>
					  <select class="form-control" name="local" id="inputSubject" ><option>Selecione</option></select>
					</div>
				  </div>	
                  			  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><label>E-mail do Responsável pelo Evento no CCSP *</label><input type="text" class="form-control" id="" placeholder="">
					</div>
				  
					<div class=" col-md-6"><label>Nome do 2º Responsável pelo Evento no CCSP (suplente do responsável pelo contrato) * </label>
					  <input type="email" class="form-control" id="" placeholder="">
					</div>
				  </div>
	

				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <button type="button" class="btn btn-theme btn-lg btn-block">E-mail do 2º Responsável pelo Evento no CCSP *</button>
					</div>
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  


				</li>

	<div class="gravar">
<input type="hidden" name="id_evento" value=""  />
<input type="hidden" name="pag" value=""  />

			
		
					<h3> <input type="submit" value="Gravar" id="gobutton" /> ATENÇÃO! Todas as informações inseridas sobre o evento só terão efetividade se forem gravadas a cada etapa.</h3>
                    

                    
                     
					  <br />


		  </form>
					
</div>		
			<!-- Fim: Conteúdo das abas -->
		
		</div>
