<?php 

/*
igSmc v0.1 - 2015
ccsplab.org - centro cultural são paulo
*/

	//Verifica erro na string
	//$mysqli = new mysqli("localhost", "root", "lic54eca","igsis_beta");
	//if (!$mysqli->query($sql_inserir)) {
    //printf("Errormessage: %s\n", $mysqli->error);
	//}

// Esta é a página para as funções gerais do sistema.

function autenticaUsuario($usuario, $senha){ //autentica usuario e cria inicia uma session
	
	$sql = "SELECT * FROM ig_usuario, ig_instituicao, ig_papelusuario WHERE ig_usuario.nomeUsuario = '$usuario' AND ig_instituicao.idInstituicao = ig_usuario.idInstituicao AND ig_papelusuario.idPapelUsuario = ig_usuario.ig_papelusuario_idPapelUsuario LIMIT 0,1"; //query que seleciona os campos que voltarão para na matriz
	if(mysql_query($sql)){ //verifica erro no banco de dados
	$query = mysql_query($sql);
		if(mysql_num_rows($query) > 0){ // verifica se retorna usuário válido
			$user = mysql_fetch_array($query);
				if($user['senha'] == md5($_POST['senha'])){ // compara as senhas
					session_start();
					$_SESSION['usuario'] = $user['nomeUsuario'];
					$_SESSION['perfil'] = $user['idPapelUsuario'];
					$_SESSION['instituicao'] = $user['instituicao'];
					$_SESSION['nomeCompleto'] = $user['nomeCompleto'];
					$_SESSION['idUsuario'] = $user['idUsuario'];
					$_SESSION['idInstituicao'] = $user['idInstituicao'];

					$log = "Fez login.";
					gravarLog($log);
					header("Location: visual/index.php"); 

				}else{
			echo "A senha está incorreta.";
			}
		}else{
			echo "O usuário não existe.";
		}
	}else{
		echo "Erro no banco de dados";
	}	
}

function exibirDataBr($data){ //retorna data d/m/y de mysql/date(a-m-d)
	$timestamp = strtotime($data); 
	return date('d/m/y', $timestamp);	
}

function retornaDataSemHora($data){
	$semhora = substr($data, 0, 10);
	return $semhora;
	
}
	
function exibirDataHoraBr($data){ //retorna data d/m/y de mysql/datetime(a-m-d H:i:s)
	$timestamp = strtotime($data); 
	return date('d/m/y - H:i:s', $timestamp);	
}

function exibirHora($data){
	$timestamp = strtotime($data); 
	return date('H:i', $timestamp);	
	
}

function exibirDataMysql($data){ //retorna data mysql/date (a-m-d) de data/br (d/m/a)
	list ($dia, $mes, $ano) = explode ('/', $data);
	$data_mysql = $ano.'-'.$mes.'-'.$dia;
	return $data_mysql;
}

function urlAtual(){ //retorna o endereço da página atual
	$dominio= $_SERVER['HTTP_HOST'];
	$url = "http://" . $dominio. $_SERVER['REQUEST_URI'];
	return $url;
}

function dinheiroDeBr($valor) { //retorna valor xxx,xx para xxx.xx
	$valor = str_ireplace(".","",$valor);
    $valor = str_ireplace(",",".",$valor);
    return $valor;
}

function dinheiroParaBr($valor) { //retorna valor xxx.xx para xxx,xx
    	$valor = number_format($valor, 2, ',', '.');
    	return $valor;
}

function _utf8_decode($string){ //use em problemas de codificacao utf-8
	$tmp = $string;
	$count = 0;
	while (mb_detect_encoding($tmp)=="UTF-8"){
    	$tmp = utf8_decode($tmp);
    	$count++;
  	}
	for ($i = 0; $i < $count-1 ; $i++){
	    $string = utf8_decode($string);
	}
	return $string;
}

function diasemana($data) { //retorna o dia da semana segundo um date(a-m-d)
	$ano =  substr("$data", 0, 4);
	$mes =  substr("$data", 5, -3);
	$dia =  substr("$data", 8, 9);

	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

	switch($diasemana) {
		case"0": $diasemana = "Domingo";       break;
		case"1": $diasemana = "Segunda-Feira"; break;
		case"2": $diasemana = "Terça-Feira";   break;
		case"3": $diasemana = "Quarta-Feira";  break;
		case"4": $diasemana = "Quinta-Feira";  break;
		case"5": $diasemana = "Sexta-Feira";   break;
		case"6": $diasemana = "Sábado";        break;
	}

	return "$diasemana";
}

function somarDatas($data,$dias){ //soma(+) ou substrai(-) dias de um date(a-m-d)
	$data_final = date('Y-m-d', strtotime("$dias days",strtotime($data)));	
	return $data_final;
	
}

function enviarEmail($conteudo_email, $instituicao, $subject, $email, $usuario ){ //envia um email pela conta igccsp2015@gmail.com é preciso que a classe phpmailer esteja instalada - vale dar uma revisada geral


	require_once('../include/phpmailer/class.phpmailer.php');
	//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

	$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

	$mail->IsSMTP(); // telling the class to use SMTP

	try {
	  //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
	  $mail->CharSet = 'UTF-8';
	  $mail->SMTPAuth   = true;                  // enable SMTP authentication
	  $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	  $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	  $mail->Username   = "igccsp2015@gmail.com";  // GMAIL username
	  $mail->Password   = "lic54eca";            // GMAIL password
	  $mail->AddReplyTo('igccsp2015@gmail.com', 'IGCCSP');
	
	  //criar laço com todos os interessados
		$sql_user = "SELECT * FROM ig_user WHERE receber_email = 2 AND id_grupos = '$instituicao'"; //mudar para 2
		$query_user = mysql_query($sql_user);
		while($campo_user = mysql_fetch_array($query_user)){
			
			$mail->AddAddress($campo_user['email'],$campo_user['nome']);
		}

		$mail->AddAddress($email,$usuario);
	
	
			
		
	  
	  //$mail->AddAddress(emailUserLogin($logado), nomeUserLogin($logado));
	
	
	  $mail->SetFrom('igccsp2015@gmail.com', 'IGCCSP');
	  $mail->AddReplyTo('igccsp2015@gmail.com', 'IGCCSP');
	
	  //assunto da IGCCSP 	
	  $mail->Subject = $subject;
	
	  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
		//	Criar uma variável com as informações
	  $mail->MsgHTML($conteudo_email);
	  $mail->Send();
	  echo "Um email foi enviado para seu endereço eletrônico cadastrado.</p>\n";
	} catch (phpmailerException $e) {
	  echo $e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
	  echo $e->getMessage(); //Boring error messages from anything else!
	}


}

function enviarEmailSimples($conteudo_email, $subject, $toEmail, $toUsuario, $fromEmail, $fromUsuario ){ //envia um email pela conta igccsp2015@gmail.com é preciso que a classe phpmailer esteja instalada - vale dar uma revisada geral


	require_once('../include/phpmailer/class.phpmailer.php');
	//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

	$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

	$mail->IsSMTP(); // telling the class to use SMTP

	try {
	  //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
	  $mail->CharSet = 'UTF-8';
	  $mail->SMTPAuth   = true;                  // enable SMTP authentication
	  $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	  $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	  $mail->Username   = "igccsp2015@gmail.com";  // GMAIL username
	  $mail->Password   = "lic54eca";            // GMAIL password
      $mail->AddAddress($toEmail,$toUsuario);
	  $mail->AddBcc("igccsp2015@gmail.com"); //hidden copy to igcssp2015
	
			
		
	  
	  //$mail->AddAddress(emailUserLogin($logado), nomeUserLogin($logado));
	
	
	  $mail->SetFrom($fromEmail, $fromUsuario);
	  $mail->AddReplyTo($fromEmail, $fromUsuario);
	
	  //assunto da IGCCSP 	
	  $mail->Subject = $subject;
	
	  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
		//	Criar uma variável com as informações
	  $mail->MsgHTML($conteudo_email);
	  $mail->Send();
	} catch (phpmailerException $e) {
	  echo $e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
	  echo $e->getMessage(); //Boring error messages from anything else!
	}


}

function gravarLog($log){ //grava na tabela ig_log os inserts e updates
	$logTratado = addslashes($log);
	$idUsuario = $_SESSION['idUsuario'];
	$ip = $_SERVER["REMOTE_ADDR"];
	$data = date('Y-m-d H:i:s');
	$sql = "INSERT INTO `ig_log` (`idLog`, `ig_usuario_idUsuario`, `enderecoIP`, `dataLog`, `descricao`) VALUES (NULL, '$idUsuario', '$ip', '$data', '$logTratado')";

	mysql_query($sql);


	
}

function saudacao(){ //saudacao inicial
	$hora = date('H');
	if(($hora > 12) AND ($hora <= 18)){
		return "Boa tarde";	
	}else if(($hora > 18) AND ($hora <= 23)){
		return "Boa noite";	
	}else if(($hora >= 0) AND ($hora <= 4)){
		return "Boa noite";	
	}else if(($hora > 4) AND ($hora <=12)){
		return "Bom dia";
	}
}

function geraOpcao($tabela,$select,$instituicao){ //gera os options de um select
	if($instituicao != ""){
		$sql = "SELECT * FROM $tabela WHERE idInstituicao = $instituicao OR idInstituicao = 999";
	}else{
		$sql = "SELECT * FROM $tabela";
	}
	
	$query = mysql_query($sql);
	while($option = mysql_fetch_row($query)){
		if($option[0] == $select){
			echo "<option value='".$option[0]."' selected >".$option[1]."</option>";	
		}else{
			echo "<option value='".$option[0]."'>".$option[1]."</option>";	
		}
	}
}
function recuperaModulo($pag){
	$sql = "SELECT * FROM ig_modulo WHERE pag = '$pag'";
	$query = mysql_query($sql);
	$modulo = mysql_fetch_array($query);
	return $modulo;
}
	
function listaModulos($perfil){ //gera as tds dos módulos a carregar

	// gera uma array com todos os módulos instalados no sistema


	// recupera quais módulos o usuário tem acesso
	$sql = "SELECT * FROM ig_papelusuario WHERE idPapelUsuario = $perfil"; 
	$query = mysql_query($sql);
	$campoFetch = mysql_fetch_array($query,MYSQL_BOTH); // retorna a array com resultados

	for($i = 1; $i < sizeof($campoFetch); $i++){
		if($campoFetch[$i] == 1){
			$k = mysql_field_name($query, $i);
			$descricao = recuperaModulo($k);
			echo "<tr>";
			echo "<td class='list_description'><b>".$descricao['nome']."</b></td>";
			echo "<td class='list_description'>".$descricao['descricao']."</td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=$k'>
			<input type ='submit' class='btn btn-theme btn-lg btn-block' value='carregar'></td></form>"	;
			echo "</tr>";
		}	
		
	}
		
/*	function retornaNomeModulo($pag){
		$sql = "SELECT * FROM ig_modulo WHERE pag = $pag";
		$query = mysql_query($sql);
		$campo = mysql_fetch_array($sql);
		return $campo;	
	}

	for($i = 1; $i <= $numCampos; $i++){
		if($campoFetch[$i] == 1){
			$pag = mysql_field_name($query, $i);
			$descricao = retornaNomeModulo($pag);
			echo "<td class='list_description'>".$descricao['nome']."</td>";
			echo "<td class='list_description'>".$descricao['descricao']."</td>";
			echo "<td class='list_description'><button type='button' class='btn btn-theme btn-lg btn-block'>carregar</button></td>";		
		} 	
		
	}
*/	

}
function verificaAcesso($usuario,$pagina){
	$sql = "SELECT * FROM ig_usuario,ig_papelusuario WHERE ig_usuario.idUsuario = $usuario AND ig_usuario.ig_papelusuario_idPapelUsuario = ig_papelusuario.idPapelUsuario LIMIT 0,1";
	$query = mysql_query($sql);
	$verifica = mysql_fetch_array($query);
	if($verifica["$pagina"] == 1){
		return 1;
	}else{
		return 0;
	}
}

function recuperaEvento($idEvento){
	$sql = "SELECT * FROM ig_evento WHERE idEvento = $idEvento LIMIT 0,1";
	$query = mysql_query($sql);
	$campo = mysql_fetch_array($query);
	return $campo;		
}	

function recuperaDados($tabela,$idEvento,$campo){
	$sql = "SELECT * FROM $tabela WHERE $campo = '$idEvento' LIMIT 0,1";
	$query = mysql_query($sql);
	$campo = mysql_fetch_array($query);
	return $campo;		
}




function opcaoUsuario($idInstituicao,$idUsuario){
	$sql = "SELECT DISTINCT * FROM ig_usuario,ig_papelusuario WHERE ig_usuario.ig_papelusuario_idPapelUsuario = ig_papelusuario.idPapelUsuario AND ig_papelusuario.evento = 1";
	$query = mysql_query($sql);
	while($campo = mysql_fetch_array($query)){
		if($campo['idUsuario'] == $idUsuario){
			echo "<option value=".$campo['idUsuario']." selected >".$campo['nomeCompleto']."</option>";
		}else{
			echo "<option value=".$campo['idUsuario']." >".$campo['nomeCompleto']."</option>";
			
		}
	}	
}

function verificaExiste($idTabela,$idCampo,$idDado,$st){
	if($st == 1){ // se for 1, é uma string
		$sql = "SELECT * FROM $idTabela WHERE $idCampo = '%$idDado%'";
	}else{
		$sql = "SELECT * FROM $idTabela WHERE $idCampo = '$idDado'";
	}
	$query = mysql_query($sql);
	$numero = mysql_num_rows($query);
	$dados = mysql_fetch_array($query);
	$campo['numero'] = $numero;
	$campo['dados'] = $dados;	
	return $campo;
}

function retornaUltimo($idTabela){

	$sql_ultimo = "SELECT * FROM $idTabela ORDER BY idEvento DESC LIMIT 1";
	$id_evento = mysql_query($sql_ultimo);
	$id = mysql_fetch_array($id_evento);
	$_SESSION['idEvento'] = $id['idEvento'];
}

function testaQuery($sql){
	$mysqli = new mysqli("localhost", "root", "lic54eca","igsis_beta");
	if (!$mysqli->query($sql)) {
    return printf("Errormessage: %s\n", $mysqli->error);
	}

}

function recuperaIdDado($tabela,$id){
	//recupera os nomes dos campos
	$sql = "SELECT * FROM $tabela";
	$query = mysql_query($sql);
	$campo01 = mysql_field_name($query, 0);
	$campo02 = mysql_field_name($query, 1);
	
	$sql = "SELECT * FROM $tabela WHERE $campo01 = $id";
	$query = mysql_query($sql);
	$campo = mysql_fetch_array($query);
	return $campo[$campo02];	
}

function recuperaProdutor($idProdutor){
	$sql = "SELECT * FROM ig_produtor WHERE idProdutor = $idProdutor";
	$query = mysql_query($sql);
	$campo = mysql_fetch_array($query);
	return $campo;	
}

function listaEventosGravados($idUsuario){ 
	$sql = "SELECT * FROM ig_evento WHERE idUsuario = $idUsuario AND publicado = 1";
	$query = mysql_query($sql);
	echo "<table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td>Nome do evento</td>
							<td>Tipo de evento</td>
  							<td>Data de início</td>
							<td width='10%'></td>
							<td width='10%'></td>
						</tr>
					</thead>
					<tbody>";
	while($campo = mysql_fetch_array($query)){
			echo "<tr>";
			echo "<td class='list_description'>".$campo['nomeEvento']."</td>";
			echo "<td class='list_description'>".recuperaIdDado("ig_tipo_evento",$campo['ig_tipo_evento_idTipoEvento'])."</td>";
			echo "<td class='list_description'></td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=evento&p=basica'>
			<input type='hidden' name='carregar' value='".$campo['idEvento']."' />
			<input type ='submit' class='btn btn-theme btn-block' value='carregar'></td></form>"	;
			
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=evento&p=carregar'>
			<input type='hidden' name='apagar' value='".$campo['idEvento']."' />
			<input type ='submit' class='btn btn-theme  btn-block' value='apagar'></td></form>"	;
			echo "</tr>";		
	}
					
						

                        

						
		
	echo "					</tbody>
				</table>";
}

function retornaInstituicao($local){
	$sql = "SELECT idInstituicao FROM ig_local WHERE idLocal = $local";
	$query = mysql_query($sql);
	$campo = mysql_fetch_array($query);
	return $campo['idInstituicao'];
}

function listaOcorrencias($idEvento){ 
	$sql = "SELECT * FROM ig_ocorrencia WHERE idEvento = '$idEvento' AND publicado = 1 ORDER BY dataInicio";
	$query = mysql_query($sql);
	echo "<table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td>Ocorrência</td>
							<td width='10%'></td>
							<td width='10%'></td>
							<td width='10%'></td>
						</tr>
					</thead>
					<tbody>";
	while($campo = mysql_fetch_array($query)){
			$tipo_de_evento = recuperaIdDado("ig_tipo_ocorrencia",$campo['idTipoOcorrencia']); // retorna o tipo de ocorrência
			if($campo['dataFinal'] == '0000-00-00'){
				$data = exibirDataBr($campo['dataInicio'])." - ".diasemana($campo['dataInicio']); //precisa tirar a hora para fazer a função funcionar
					$semana = "";
			}else{
				$data = "De ".exibirDataBr($campo['dataInicio'])." a ".exibirDataBr($campo['dataFinal']);
				if($campo['segunda'] == 1){$seg = "segunda";}else{$seg = "";}
				if($campo['terca'] == 1){$ter = "terça";}else{$ter = "";}
				if($campo['quarta'] == 1){$qua = "quarta";}else{$qua = "";}
				if($campo['quinta'] == 1){$qui = "quinta";}else{$qui = "";}
				if($campo['sexta'] == 1){$sex = " sexta";}else{$sex = "";}
				if($campo['sabado'] == 1){$sab = " sábado";}else{$sab = "";}
				if($campo['domingo'] == 1){$dom = " domingo";}else{$dom = "";}
				$semana = "(".$seg." ".$ter." ".$qua." ".$qui." ".$sex." ".$sab." ".$dom.")";	
			}
			
			if($campo['diaEspecial'] == 1){
				if($campo['libras'] == 1){$libras = "Tradução em libras";}else{$libras = "";}
				if($campo['audiodescricao'] == 1){$audio = "Audiodescrição";}else{$audio = "";}
				if($campo['precoPopular'] == 1){$popular = "Preço popular";}else{$popular = "";}
				
				$dia_especial =	" - Dia especial:".$libras." ".$audio." ".$popular;
			}else{
				$dia_especial = "";
			}
			
			//recuperaDados($tabela,$idEvento,$campo)
			$hora = exibirHora($campo['horaInicio']);
			$retirada = recuperaIdDado("ig_retirada",$campo['retiradaIngresso']);
			$valor = dinheiroParaBr($campo['valorIngresso']);
			$local = recuperaDados("ig_espaco",$campo['local'],"idEspaco");
			$espaco = $local['espaco'];
			$inst = recuperaDados("ig_instituicao",$local['ig_instituicao_idInstituicao'],"idInstituicao");
			$instituicao = $inst['instituicao'];
			$id = $campo['idOcorrencia'];
			
			
			$ocorrencia = "<div class='left'>$tipo_de_evento $dia_especial<br />
			
			Data: $data $semana <br />
			Horário: $hora<br />
			Local: $espaco - $instituicao<br />
			Retirada de ingresso: $retirada  - Valor: $valor <br /></br>";  
			
					
			echo "<tr>";
			echo "<td class='list_description'>".$ocorrencia."</td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=evento&p=ocorrencias&action=editar'>
			<input type='hidden' name='id' value='$id' />
			<input type ='submit' class='btn btn-theme btn-block' value='Editar'></td></form>"	;

			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=evento&p=ocorrencias&action=listar'>
			<input type='hidden' name='duplicar' value='".$campo['idOcorrencia']."' />
			<input type ='submit' class='btn btn-theme btn-block' value='Duplicar'></td></form>"	;
			
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=evento&p=ocorrencias&action=listar'>
			<input type='hidden' name='apagar' value='".$campo['idOcorrencia']."' />
			<input type ='submit' class='btn btn-theme  btn-block' value='Apagar'></td></form>"	;
			echo "</tr>";		
	}
					
						

                        

						
		
	echo "					</tbody>
				</table>";
}


function checar($id){
	if($id == 1){
		echo "checked";	
	}	
}

function listaArquivos($idEvento){
	$sql = "SELECT * FROM ig_arquivo WHERE 	ig_evento_idEvento = $idEvento AND publicado = 1";
	$query = mysql_query($sql);
	echo "<table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td>Nome do arquivo</td>
							<td width='10%'></td>
						</tr>
					</thead>
					<tbody>";
	while($campo = mysql_fetch_array($query)){
			echo "<tr>";
			echo "<td class='list_description'><a href='../uploads/".$campo['arquivo']."' target='_blank'>".$campo['arquivo']."</a></td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=evento&p=arquivos'>
			<input type='hidden' name='apagar' value='".$campo['idArquivo']."' />
			<input type ='submit' class='btn btn-theme  btn-block' value='apagar'></td></form>"	;
			echo "</tr>";		
	}
					
						

                        

						
		
	echo "					</tbody>
				</table>";	
}

function verificaSubEvento($idEvento){
	$sql = "SELECT * FROM ig_sub_evento WHERE ig_evento_idEvento = '$idEvento'";
	$query = mysql_query($sql);
	$num = mysql_num_rows($query);
	$subEvento['num'] = $num;
	if($num > 0){
		$subEvento = mysql_fetch_array($query);	
	}
	return $subEvento ;
}

function recuperaUsuario($idUsuario){
	$recupera = recuperaDados('ig_usuario',$idUsuario,'idUsuario');
	return $recupera;	
}


function descricaoEvento($idEvento){
	$evento = recuperaEvento($idEvento);
	$tipoEvento = recuperaDados('ig_tipo_evento',$evento['ig_tipo_evento_idTipoEvento'],'idTipoEvento');
	$programa = recuperaDados('ig_programa',$evento['ig_programa_idPrograma'],'idPrograma');
	$projetoEspecial = recuperaDados('ig_projeto_especial',$evento['projetoEspecial'],'idProjetoEspecial');
	$responsavel = recuperaUsuario($evento['idResponsavel']);
	$suplente = recuperaUsuario($evento['suplente']);
	$faixa = recuperaDados('ig_etaria',$evento['faixaEtaria'],'idIdade');

	//exibe as informações principais
	echo "<b>Tipo de evento:</b> ".$tipoEvento['tipoEvento']."<br />";
	if($evento['ig_programa_idPrograma'] != 0){ echo "<b>Programa especial:</b> ".$programa['programa']."<br />";}
	if($evento['projetoEspecial'] != 0){ echo "<b>Projeto especial:</b> ".$projetoEspecial['projetoEspecial']."<br />";}
	if($evento['projeto'] != ""){ echo "<b>Projeto:</b> ".$evento['projeto']."<br />";}
	echo "<br />";
	echo "<b>Responsável pelo evento:</b> ".$responsavel['nomeCompleto']."<br />";
	echo "<b>Suplente:</b> ".$suplente['nomeCompleto']."<br />";
	echo "<br />";
	echo "<b>Autor:</b><br />".$evento['autor']."<br /><br />";
	echo "<b>Ficha técnica:</b><br />".$evento['fichaTecnica']."<br /><br />";
	echo "<b>Faixa ou indicação etária:</b> ".$faixa['faixa']."<br /><br />";
	echo "<br /><br />";
	echo "<b>Sinopse:</b><br />".$evento['sinopse']."<br /><br />";
	echo "<b>Release:</b><br />".$evento['releaseCom']."<br /><br />";
	echo "<b>Parecer artístico:</b><br />".$evento['parecerArtistico']."<br /><br />";

}

function descricaoEspecificidades($idEvento,$tipo){
	//switch das áreas específicas
	switch($tipo){
	
	case 2: //artes visuais
	
	break;
	case 7: //teatro e dança
	case 8:
	case 14:
	case 15:
	case 16:
	case 17:
	
	
	
	break;
	case 4: //oficinas e paletras
	case 5:
		
	
	break;
	case 11: //música
	case 12:	
		
		
	break;
	case 1: //cinema
	
	break;
	}

	//sub-evento
	
}

function verificaEdicao($idEvento){
	if(isset($idEvento)){
		if($idEvento != ''){
		$campo = recuperaEvento($idEvento);
		echo "- Você está editando o evento <strong>'".$campo['nomeEvento']."'</strong>";	
		}
	}
}

function recuperaPessoa($id,$tipo){
	switch($tipo){
		case '1':
			$sql = "SELECT * FROM sis_pessoa_fisica WHERE Id_PessoaFisica = $id";
			$query = mysql_query($sql);
			$x = mysql_fetch_array($query);
			$y['nome'] = $x['Nome']; 
			$y['tipo'] = "Pessoa física";
			$y['numero'] = $x['CPF'];
			return $y;

		break;
		case '2':
			$sql = "SELECT * FROM sis_pessoa_juridica WHERE Id_PessoaJuridica = $id";
			$query = mysql_query($sql);
			$x = mysql_fetch_array($query);
			$y['nome'] = $x['RazaoSocial']; 
			$y['tipo'] = "Pessoa jurídica";
			$y['numero'] = $x['CNPJ'];	
						return $y;	
		break;
		case '3':
			$sql = "SELECT * FROM sis_representante_legal WHERE Id_RepresentanteLegal = $id";
			$query = mysql_query($sql);
			$x = mysql_fetch_array($query);
			$y['nome'] = $x['RepresentanteLegal']; 
			$y['tipo'] = "Representante legal";
			$y['numero'] = $x['CPF'];		
						return $y;
		break;		

	}
	
}

?>