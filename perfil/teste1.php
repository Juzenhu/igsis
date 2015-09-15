<?php 

if(($campo['ig_tipo_evento_idTipoEvento'] == 3) || 
		($campo['ig_tipo_evento_idTipoEvento'] == 7) ||
		($campo['ig_tipo_evento_idTipoEvento'] == 8) ||
		($campo['ig_tipo_evento_idTipoEvento'] == 14) ||
		($campo['ig_tipo_evento_idTipoEvento'] == 15) ||
		($campo['ig_tipo_evento_idTipoEvento'] == 16) ||
		($campo['ig_tipo_evento_idTipoEvento'] == 17))
{ //1

	$idTabela = "ig_teatro_danca";
	$idCampo = "ig_evento_idEvento";
	$idDado = $_SESSION['idEvento'];
	$st = 0;
	
	if(isset($_POST['atualizar'])){ //Atualizar 02		
		$ig_teatro_danca_estreia = $_POST['ig_teatro_danca_estreia'];
		$ig_teatro_danca_genero = $_POST['ig_teatro_danca_genero'];
		
		//verifica se existe um registro na tabela
		$ver = verificaExiste($idTabela,$idCampo,$idDado,$st);
		
			if($ver['numero'] == 0){ // insere um registro novo 03
				$sql_insere_teatro = "INSERT INTO  `ig_teatro_danca` (`idTeatro` ,`ig_evento_idEvento` ,`estreia` ,`genero`)VALUES (NULL ,  '$idDado',  '$ig_teatro_danca_estreia',  '$ig_teatro_danca_genero');";
				if(mysql_query($sql_insere_teatro)){ //04		
					$mensagem = "Atualizado com sucesso! ";	
					gravarLog($sql_insere_teatro); //grava log
				}else{ //04
					$mensagem = "Erro ao atualizar!";
				} //04
			}else{ //atualiza o registro existente 03
				$sql_atualiza_teatro = "UPDATE ig_teatro_danca SET estreia = '$ig_teatro_danca_estreia', genero = '$ig_teatro_danca_genero' WHERE ig_evento_idEvento = $idDado";
				if(mysql_query($sql_atualiza_teatro)){	//05	
					$mensagem = "Atualizado com sucesso! ";	
					gravarLog($sql_atualiza_teatro); //grava log
				}else{ //05
					$mensagem = "Erro ao atualizar!";
				} //05
			} //insere um novo registro 03
	} //Atualizar 02

$artes = recuperaDados($idTabela,$_SESSION['idEvento'],$idCampo);


?>
				<h3>Teatro / Dança</h3>
                <h4><? if(isset($mensagem)){echo $mensagem;} ?></h4>

                <div class="form-group">
                	<div class="col-md-offset-2 col-md-2">
                    	<label>Estréia?</label>
                		 <select class="form-control" name="ig_teatro_danca_estreia" id="inputSubject" >
                        <option value="1" <?php if(isset($artes)){if($artes['estreia'] == "1"){echo "selected";}} ?> >Sim</option>
                        <option value="0" <?php if(isset($artes)){if($artes['estreia'] == "0"){echo "selected";}} ?>>Não</option>
                        </select>
                	</div>
               		<div class=" col-md-6">
                    	<label>Gênero</label>
                    	<input type="text" class="form-control" name="ig_teatro_danca_genero" value="<?php if(isset($artes)){echo $artes['genero'];} ?>" id="" placeholder="">

                	</div>
                </div>

<?php } ?>