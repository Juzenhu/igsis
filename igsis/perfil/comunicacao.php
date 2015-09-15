<?
//include para comunicação

 ?>
 
 	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="#enviar">Início</a> </li>
							<li><a href="#lista">Quadro geral</a></li>
                            <li><a href="#lista">Módulo Cinema</a></li>
                          		
                                 <!--<li><a href="#">Evento</a>
                                    <ul class="dl-submenu">
                                        <li><a href="#">Apresentação básica</a></li>
                                        <li><a href="#">Detalhamento</a></li>
                                        <li><a href="#">Ocorrências</a></li>
                                        <li><a href="#">Conteúdo</a></li>
                                        <li><a href="#">Serviços internos</a></li>
                                        <li><a href="#">Especificidades de área</a></li>
                                        <li><a href="#">Previsão de serviços externos</a></li>
                                    </ul>
                                </li>-->
   
							<li><a href="#enviar">Registro e documentação</a> </li>
                                <?php //criar um if para o módulo cinema ?>
                            <li><a href="#enviar">Relatório de alterações</a> </li>
                            <li><a href="#enviar">Sair</a> </li>
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
					  <select class="form-control" name="retiradaIngresso" id="inputSubject" ><?php echo geraOpcao("ig_local","","") ?></select>
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
      	<section id="list_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">List</li>
				</ol>
			</div>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Codigo do Pedido</td>
							<td>Proponente</td>
							<td>Objeto</td>
							<td>Local</td>
							<td> Periodo</td>
							<td>Status</td>
						</tr>
					</thead>

						<tr>
						  <td class="list_description">Texto</td>
						  <td class="list_description">Texto</td>
						  <td class="list_description">Texto</td>
						  <td class="list_description">Texto</td>
						  <td class="list_description">Texto</td>
						  <td class="list_description">Texto</td>
						</tr>
						<tr>
						  <td class="list_description">Texto</td>
						  <td class="list_description">Texto</td>
						  <td class="list_description">Texto</td>
						  <td class="list_description">Texto</td>
						  <td class="list_description">Texto</td>
						  <td class="list_description">Texto</td>
						</tr>
				</table>
			</div>
		</div>
	</section>