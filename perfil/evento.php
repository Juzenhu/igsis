<?php
@ini_set('display_errors', '1');
error_reporting(E_ALL);
?>
<h1>Este é o perfil de evento.</h1>


<h2>Apresentação Básica</h2>
                <p>* campos obrigatórios.</p>
<form method="post" action="evento.php?p=" >                
<label for="pg01_modalidade">Tipo de modalidade</label><br />
<select name="pg01_modalidade" id="pg01_modalidade">
<option value="1">1</option>
<option value="2" selected>2</option>
<option value="3">3</option>

</select>                
<br /><br />

<label for="pg01_programa">Nome do Programa</label><br />

 

<br /><br />

<label for="pg01_projeto_especial">Nome do Projeto Especial</label><br />
 <br /><br />
	
<label for="pg01_evento">Nome do Evento *</label><br />
<input name="pg01_evento" type="text" id="pg01_evento" size="80" />


<br /><br />
	
<label for="pg01_projeto">Nome do Projeto</label><br />
<input name="pg01_projeto" type="text" id="pg01_projeto" size="80" value=""/>

<br />  <br />
<label for="pg01_tipo_evento">Tipo de Evento *</label><br />
  <? // form_tipo_evento($id_evento); ?>
 

<br />  <br />
<label for="pg01_memorando">Memorando</label>
  <br />
  <input name="pg01_memorando" type="text" id="pg01_memorando" size="30" value=""/>
<br />  <br />
<label for="pg01_responsavel">Nome do Responsável pelo Evento no CCSP (responsável pelo contrato)* </label><br />
  <input name="pg01_responsavel" type="text" id="pg01_responsavel" size="50" value=""/><br /><br />
<label for="pg01_ramal">Telefone / Ramal do Responsável pelo Evento do CCSP * </label><br />
  <input name="pg01_ramal" type="text" id="pg01_ramal" size="50" value="" />
<br /><br />
<label for="pg01_email">E-mail do Responsável pelo Evento no CCSP *</label><br />
  <input name="pg01_email" type="text" id="pg01_email" size="50" value=""/>
<br /><br />
<label for="pg01_resp_ccsp02">Nome do 2º Responsável pelo Evento no CCSP (suplente do responsável pelo contrato) * </label><br />
  <input name="pg01_resp_ccsp02" type="text" id="pg01_resp_ccsp02" size="50" value=""/><br /><br />
<label for="pg01_email02">E-mail do 2º Responsável pelo Evento no CCSP *</label><br />
  <input name="pg01_email02" type="text" id="pg01_email02" size="50" value=""/>
<br /><br />
				  

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
