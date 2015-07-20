<?php 

/*
igSmc v0.1 - 2015
ccsplab.org - centro cultural são paulo
*/



// Esta é a página para as funções gerais do sistema.
function bancoMysqli(){ // Cria conexao ao banco. Substitui o include "conecta_mysql.php" .
	$servidor = 'localhost';
	$usuario = 'root';
	$senha = 'lic54eca';
	$banco = 'igsisbeta';
	$con = mysqli_connect($servidor,$usuario,$senha,$banco); 
	mysqli_set_charset($con,"utf8");
	return $con;
}
// Conecta-se ao banco de dados MySQL
function verificaMysql($sql_inserir){ 	//Verifica erro na string/query
	$mysqli = new mysqli("localhost", "root", "lic54eca","igsis");
	if (!$mysqli->query($sql_inserir)) {
    printf("Errormessage: %s\n", $mysqli->error);
	}
}


function autenticaUsuario($usuario, $senha){ //autentica usuario e cria inicia uma session
	$sql = "SELECT * FROM ig_usuario, ig_instituicao, ig_papelusuario WHERE ig_usuario.nomeUsuario = '$usuario' AND ig_instituicao.idInstituicao = ig_usuario.idInstituicao AND ig_papelusuario.idPapelUsuario = ig_usuario.ig_papelusuario_idPapelUsuario LIMIT 0,1";
	$con = bancoMysqli();
	$query = mysqli_query($con,$sql);
	 //query que seleciona os campos que voltarão para na matriz
	if($query){ //verifica erro no banco de dados
		if(mysqli_num_rows($query) > 0){ // verifica se retorna usuário válido
			$user = mysqli_fetch_array($query);
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
	return date('d/m/Y', $timestamp);	
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
		$mysqli = bancoMysqli();
	$mysqli->query($sql);


	
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
	$con = bancoMysqli();
	$query = mysqli_query($con,$sql);
	while($option = mysqli_fetch_row($query)){
		if($option[0] == $select){
			echo "<option value='".$option[0]."' selected >".$option[1]."</option>";	
		}else{
			echo "<option value='".$option[0]."'>".$option[1]."</option>";	
		}
	}
}
function recuperaModulo($pag){ 
	$sql = "SELECT * FROM ig_modulo WHERE pag = '$pag'";
	$con = bancoMysqli();
	$query = mysqli_query($con,$sql);
	$modulo = mysqli_fetch_array($query);
	return $modulo;
}
	
function listaModulos($perfil){ //gera as tds dos módulos a carregar
	// recupera quais módulos o usuário tem acesso
	$sql = "SELECT * FROM ig_papelusuario WHERE idPapelUsuario = $perfil"; 
	$con = bancoMysqli();
	$query = mysqli_query($con,$sql);
	$campoFetch = mysqli_fetch_array($query);
	while($fieldinfo = mysqli_fetch_field($query)){
		if(($campoFetch[$fieldinfo->name] == 1) AND ($fieldinfo->name != 'idPapelUsuario')){
			$descricao = recuperaModulo($fieldinfo->name);
			echo "<tr>";
			echo "<td class='list_description'><b>".$descricao['nome']."</b></td>";
			echo "<td class='list_description'>".$descricao['descricao']."</td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=$fieldinfo->name'>
			<input type ='submit' class='btn btn-theme btn-lg btn-block' value='carregar'></td></form>"	;
			echo "</tr>";
		}
	}
		
}
function verificaAcesso($usuario,$pagina){ //verifica se o usuário tem permissão de acesso a uma determinada página
	$sql = "SELECT * FROM ig_usuario,ig_papelusuario WHERE ig_usuario.idUsuario = $usuario AND ig_usuario.ig_papelusuario_idPapelUsuario = ig_papelusuario.idPapelUsuario LIMIT 0,1";
	$con = bancoMysqli();
	$query = mysqli_query($con,$sql);
	$verifica = mysqli_fetch_array($query);
	if($verifica["$pagina"] == 1){
		return 1;
	}else{
		return 0;
	}
}

function recuperaEvento($idEvento){ //retorna uma array com os dados da tabela ig_evento
	$con = bancoMysqli();
	$sql = "SELECT * FROM ig_evento WHERE idEvento = '$idEvento' LIMIT 0,1";
	$query = mysqli_query($con,$sql);
	$campo = mysqli_fetch_array($query);
	return $campo;		
}	

function recuperaDados($tabela,$idEvento,$campo){ //retorna uma array com os dados de qualquer tabela. serve apenas para 1 registro.
	$con = bancoMysqli();
	$sql = "SELECT * FROM $tabela WHERE ".$campo." = '$idEvento' LIMIT 0,1";
	$query = mysqli_query($con,$sql);
	$campo = mysqli_fetch_array($query);
	return $campo;		
}




function opcaoUsuario($idInstituicao,$idUsuario){ //cria as options com usuários de uma instituicao
	$sql = "SELECT DISTINCT * FROM ig_usuario,ig_papelusuario WHERE ig_usuario.ig_papelusuario_idPapelUsuario = ig_papelusuario.idPapelUsuario AND ig_papelusuario.evento = 1";
	$con = bancoMysqli();
	$query = mysqli_query($con,$sql);
	while($campo = mysqli_fetch_array($query)){
		if($campo['idUsuario'] == $idUsuario){
			echo "<option value=".$campo['idUsuario']." selected >".$campo['nomeCompleto']."</option>";
		}else{
			echo "<option value=".$campo['idUsuario']." >".$campo['nomeCompleto']."</option>";
			
		}
	}	
}

function verificaExiste($idTabela,$idCampo,$idDado,$st){ //retorna uma array com indice 'numero' de registros e 'dados' da tabela
	$con = bancoMysqli();
	if($st == 1){ // se for 1, é uma string
		$sql = "SELECT * FROM $idTabela WHERE $idCampo = '%$idDado%'";
	}else{
		$sql = "SELECT * FROM $idTabela WHERE $idCampo = '$idDado'";
	}
	$query = mysqli_query($con,$sql);
	$numero = mysqli_num_rows($query);
	$dados = mysqli_fetch_array($query);
	$campo['numero'] = $numero;
	$campo['dados'] = $dados;	
	return $campo;
}

function retornaUltimo($idTabela){ //retorna o id do ultimo dado inserido. em desuso e subsitutir por mysqli_insert_id()

	$sql_ultimo = "SELECT * FROM $idTabela ORDER BY idEvento DESC LIMIT 1";
	$id_evento = mysql_query($sql_ultimo);
	$id = mysql_fetch_array($id_evento);
	$_SESSION['idEvento'] = $id['idEvento'];
}


function recuperaIdDado($tabela,$id){ 
	$con = bancoMysqli();
	//recupera os nomes dos campos
	$sql = "SELECT * FROM $tabela";
	$query = mysqli_query($con,$sql);
	$campo01 = mysqli_field_name($query, 0);
	$campo02 = mysqli_field_name($query, 1);
	
	$sql = "SELECT * FROM $tabela WHERE $campo01 = $id";
	$query = mysql_query($sql);
	$campo = mysql_fetch_array($query);
	return $campo[$campo02];	
}

function recuperaProdutor($idProdutor){ //recupera dados da tabela produtor
	$con = bancoMysqli();
	$sql = "SELECT * FROM ig_produtor WHERE idProdutor = $idProdutor";
	$query = mysqli_query($con,$sql);
	$campo = mysqli_fetch_array($query);
	return $campo;	
}

function listaEventosGravados($idUsuario){ //tabela para gerenciar eventos em aberto
	$con = bancoMysqli();
	$sql = "SELECT * FROM ig_evento WHERE idUsuario = $idUsuario AND publicado = 1";
	$query = mysqli_query($con,$sql);
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
	while($campo = mysqli_fetch_array($query)){
			echo "<tr>";
			echo "<td class='list_description'>".$campo['nomeEvento']."</td>";
			echo "<td class='list_description'>".retornaTipo($campo['ig_tipo_evento_idTipoEvento'])."</td>";
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

function listaOcorrencias($idEvento){ //lista ocorrencias de determinado evento
	$sql = "SELECT * FROM ig_ocorrencia WHERE idEvento = '$idEvento' AND publicado = 1 ORDER BY dataInicio";
	$con = bancoMysqli();
	$query = mysqli_query($con,$sql);
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
	while($campo = mysqli_fetch_array($query)){
			$tipo_de_evento = retornaTipoOcorrencia($campo['idTipoOcorrencia']); // retorna o tipo de ocorrência
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
			$retirada = recuperaIngresso($campo['retiradaIngresso']);
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


function checar($id){ //funcao para imprimir checked do checkbox
	if($id == 1){
		echo "checked";	
	}	
}

function listaArquivos($idEvento){ //lista arquivos de determinado evento
	$con = bancoMysqli();
	$sql = "SELECT * FROM ig_arquivo WHERE 	ig_evento_idEvento = $idEvento AND publicado = 1";
	$query = mysqli_query($con,$sql);
	echo "<table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td>Nome do arquivo</td>
							<td width='10%'></td>
						</tr>
					</thead>
					<tbody>";
	while($campo = mysqli_fetch_array($query)){
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

function verificaSubEvento($idEvento){ //retorna os dados de um subevento
	$sql = "SELECT * FROM ig_sub_evento WHERE ig_evento_idEvento = '$idEvento'";
	$query = mysql_query($sql);
	$num = mysql_num_rows($query);
	$subEvento['num'] = $num;
	if($num > 0){
		$subEvento = mysql_fetch_array($query);	
	}
	return $subEvento ;
}

function recuperaUsuario($idUsuario){ //retorna dados do usuário
	$recupera = recuperaDados('ig_usuario',$idUsuario,'idUsuario');
	return $recupera;	
}


function descricaoEvento($idEvento){ //imprime dados de um evento
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

function verificaEdicao($idEvento){ //exibe o evento que está sendo editado.
	if(isset($idEvento)){
		if($idEvento != ''){
		$campo = recuperaEvento($idEvento);
		echo "- Você está editando o evento <strong>'".$campo['nomeEvento']."'</strong>";	
		}
	}
}

function recuperaPessoa($id,$tipo){ //recupera os dados de uma pessoa
	$con = bancoMysqli();
	switch($tipo){
		case '1':
			$sql = "SELECT * FROM sis_pessoa_fisica WHERE Id_PessoaFisica = $id";
			$query = mysqli_query($con,$sql);
			$x = mysqli_fetch_array($query);
			$y['nome'] = $x['Nome']; 
			$y['tipo'] = "Pessoa física";
			$y['numero'] = $x['CPF'];
			return $y;

		break;
		case '2':
			$sql = "SELECT * FROM sis_pessoa_juridica WHERE Id_PessoaJuridica = $id";
			$query = mysqli_query($con,$sql);
			$x = mysqli_fetch_array($query);
			$y['nome'] = $x['RazaoSocial']; 
			$y['tipo'] = "Pessoa jurídica";
			$y['numero'] = $x['CNPJ'];	
						return $y;	
		break;
		case '3':
			$sql = "SELECT * FROM sis_representante_legal WHERE Id_RepresentanteLegal = $id";
			$query = mysqli_query($con,$sql);
			$x = mysqli_fetch_array($query);
			$y['nome'] = $x['RepresentanteLegal']; 
			$y['tipo'] = "Representante legal";
			$y['numero'] = $x['CPF'];		
						return $y;
		break;		

	}
	
}



function geraOpcaoLegal($idEvento){ //gera options de representantes legais
	$sql = "SELECT * FROM igsis_pedido_contratacao WHERE idEvento = '$idEvento' AND tipoPessoa = '3'";
	$con = bancoMysqli();
	$query = mysqli_query($con,$sql);
	while($campo = mysqli_fetch_array($query)){
		$id = $campo['idPessoa'];	
		$nome = recuperaPessoa($id,3);
		$representante = $nome['nome'];
		echo "<option value='".$id."'>".$representante."</option>";
	}		
}

function valorPorExtenso($valor=0) { //retorna um valor por extenso
	$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
	$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
 
	$c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
	$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
	$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
	$u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
 
	$z=0;
 
	$valor = number_format($valor, 2, ".", ".");
	$inteiro = explode(".", $valor);
	for($i=0;$i<count($inteiro);$i++)
		for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
			$inteiro[$i] = "0".$inteiro[$i];
 
	// $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;) 
	$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
	for ($i=0;$i<count($inteiro);$i++) {
		$valor = $inteiro[$i];
		$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
		$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
		$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
	
		$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && $ru) ? " e " : "").$ru;
		$t = count($inteiro)-1-$i;
		$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
		if ($valor == "000")$z++; elseif ($z > 0) $z--;
		if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t]; 
		if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
	}
 
	return($rt ? $rt : "zero");
}

function recuperaModalidade($id){ //imprime a modalidade
	$con = bancoMysqli();
	$sql = "SELECT * FROM ig_modalidade WHERE idModalidade = '$id'";
	$query = mysqli_query($con,$sql);
	$campo = mysqli_fetch_array($query);
	echo $campo['modalidade'];	
}

function retornaTipo($id){ //retorna o tipo de evento
	$con = bancoMysqli();
	$sql = "SELECT * FROM ig_tipo_evento WHERE idTipoEvento = '$id'";
	$query = mysqli_query($con,$sql);
	$x = mysqli_fetch_array($query);		
	return $x['tipoEvento'];
}




function iniciaFormulario($idUsuario){ //inicia um evento zerado
	unset($_SESSION['idEvento']);

	// Query para inserir um registro em branco
	$sql_inicio = "INSERT INTO  `ig_evento` (

`idEvento` ,
`ig_produtor_idProdutor` ,
`ig_tipo_evento_idTipoEvento` ,
`ig_programa_idPrograma` ,
`projetoEspecial` ,
`nomeEvento` ,
`projeto` ,
`memorando` ,
`idResponsavel` ,
`suplente` ,
`autor` ,
`fichaTecnica` ,
`faixaEtaria` ,
`sinopse` ,
`releaseCom` ,
`parecerArtistico` ,
`confirmaFinanca` ,
`confirmaDiretoria` ,
`confirmaComunicacao` ,
`confirmaDocumentacao` ,
`confirmaProducao` ,
`numeroProcesso` ,
`publicado` ,
`idUsuario`
)
VALUES (
NULL ,  '',  '',  '',  '',  '', NULL , NULL ,  '',  '',  '',  '',  '',  '',  '',  '', NULL , NULL , NULL , NULL , NULL , NULL , NULL , $idUsuario
)
";
	// Executa a query
	$con = bancoMysqli();
	mysqli_query($con,$sql_inicio);
	
	// Retorna o ID gerado na tabela ig_evento
	$sql_ultimo = "SELECT * FROM ig_evento ORDER BY idEvento DESC LIMIT 1";
	$id_evento = mysqli_query($con,$sql_ultimo);
	$id = mysqli_fetch_array($id_evento);
	$_SESSION['idEvento'] = $id['idEvento'];
	
}

function recuperaResponsavel($nomeResponsavel){ //retorna um array com os dados do responsavel
	$sql = "SELECT * FROM ig_usuario WHERE nomeUsuario = '%$nomeResponsavel%'";
	$con = bancoMysqli();
	$query = mysqli_query($sql,$con);
	$num_resultado = mysql_num_rows($query);
	if($num_resultado = 0){
		$campo['existe'] = 0;
		$campo['idUsuario'] = 0;
		$campo['nomeUsuario'] = "";
		return $campo; // retorna uma array com ['existe'] e ['idResponsavel']

	}else if($num_resultado = 1){
		$id = mysql_fetch_array($query);
		$campo['existe'] = 1;
		$campo['idResponsavel'] = $id['idUsuario']; 
		$campo['nomeUsuario'] = $id['nomeUsuario']; 
		return $campo;
	}
	
}

function recuperaIngresso($id){ //retorna o tipo de retirada de ingresso
	$sql = "SELECT * FROM ig_retirada WHERE idRetirada = '$id'";
	$con = bancoMysqli();
	$query = mysqli_query($con,$sql);
	$campo = mysqli_fetch_array($query);
	return $campo['retirada'];	
}

function retornaTipoOcorrencia($id){ //retorna o tipo de ocorrencia
	$sql = "SELECT * FROM ig_tipo_ocorrencia WHERE idTipoOcorrencia = '$id'";
	$con = bancoMysqli();
	$query = mysqli_query($con,$sql);
	$campo = mysqli_fetch_array($query);
	return $campo['tipoOcorrencia'];	
}


function cadastroPessoa($idEvento,$doc,$tipo){ //cria um cadastro de pessoa zerado
	$con = bancoMysqli();
	switch($tipo){	
	case 1:	
		$sql = "INSERT INTO sis_pessoa_fisica (CPF,publicado,idEvento) VALUES ('$doc','0','idEvento')";
		break;
	
	case 2:	
		$sql = "INSERT INTO sis_pessoa_juridica (CNPJ,publicado,idEvento) VALUES ('$doc','0','idEvento')";
		break;
	
	case 3:
		$sql = "INSERT INTO sis_representante_legal (CPF,publicado,idEvento) VALUES ('$doc','0','idEvento')";
		break;
	}
	$query = mysqli_query($con,$sql); 
	$ultimo = mysqli_insert_id($query);
	return $ultimo;

}
function apagarRepresentante($pedido,$tipo,$evento){ //atualiza o publicado do representante para 0
	$con = bancoMysqli();
	$sql = "SELECT * FROM igsis_pedido_contratacao WHERE idPessoa = '$pedido' AND idEvento = '$evento' AND tipoPessoa = '3'  AND publicado = '1' LIMIT 0,1";
	$query = mysqli_query($con,$sql);
	$num_rows = mysqli_num_rows($query);
	if($num_rows > 0){
		while($campo = mysqli_fetch_array($query)){
			$sql_jur = "SELECT * FROM igsis_pedido_contratacao WHERE idEvento = '$evento' AND tipoPessoa = '2' AND publicado = '1'";
			$query_jur = mysqli_query($con,$sql_jur);
			while($campo_jur = mysqli_fetch_array($query_jur)){
				if(($campo_jur['idRepresentante01'] == $campo['idPessoa']) OR ($campo_jur['idRepresentante02'] == $campo['idPessoa'])){
					echo " disabled ";
				}else{
					echo " erro 1 ";
				}
			}
		}
	}
}

function listaArquivosPessoa($idPessoa,$tipo){
	$con = bancoMysqli();
	$sql = "SELECT * FROM igsis_arquivos_pessoa WHERE idPessoa = $idPessoa AND idTipoPessoa = $tipo AND publicado = 1";
	$query = mysqli_query($con,$sql);
	echo "<table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td>Nome do arquivo</td>
							<td width='10%'></td>
						</tr>
					</thead>
					<tbody>";
	while($campo = mysqli_fetch_array($query)){
			echo "<tr>";
			echo "<td class='list_description'><a href='../uploadsdocs/".$campo['arquivo']."' target='_blank'>".$campo['arquivo']."</a></td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=contratados&p=arquivos'>
			<input type='hidden' name='apagar' value='".$campo['idArquivosPessoa']."' />
			<input type ='submit' class='btn btn-theme  btn-block' value='apagar'></td></form>"	;
			echo "</tr>";		
	}
					
						

                        

						
		
	echo "					</tbody>
				</table>";	
}	

function listaLocais($idEvento){
	$con = bancoMysqli();
	$sql = "SELECT DISTINCT local FROM ig_ocorrencia WHERE idEvento = '$idEvento' AND publicado = '1'";
	$query = mysqli_query($con,$sql);	
	$locais = "";
	
	while($local = mysqli_fetch_array($query)){
		$sala = recuperaDados("ig_local",$local['local'],"idLocal");
		$instituicao = recuperaDados("ig_instituicao",$sala['idInstituicao'],"idInstituicao");
		$locais = $locais.", ".$sala['sala']." (".$instituicao['sigla'].")";
	}
	return $locais;

}

function retornaDuracao($idEvento){
	$con = bancoMysqli();
	$sql = "SELECT DISTINCT duracao FROM ig_ocorrencia WHERE idEvento = '$idEvento' AND publicado = '1' ORDER BY duracao DESC LIMIT 0,1";
	$query = mysqli_query($con,$sql);	
	$campo = mysqli_fetch_array($query);
	return $campo['duracao'];
	
}


function siscontrat($idPedido,$tipoPessoa,$instituicao){ 
	$con = bancoMysqli();
	if($instituicao != ""){
		$filtroInstituicao = " AND instituicao = '$instituicao' ";
	}else{
		$filtroInstituicao = "";
	}
	if($idPedido != ""){ //retorna 1 array do pedido ['nomedocampo'];
		
		$pedido = recuperaDados("igsis_pedido_contratacao",$idPedido,"idPedidoContratacao");
		$evento = recuperaDados("ig_evento",$pedido['idEvento'],"idEvento"); //$tabela,$idEvento,$campo
		$usuario = recuperaDados("ig_usuario",$evento['idUsuario'],"idUsuario");
		$instituicao = recuperaDados("ig_instituicao",$usuario['idInstituicao'],"idInstituicao");
		$local = listaLocais($pedido['idEvento']);
		$periodo = retornaPeriodo($pedido['idEvento']);
		$duracao = retornaDuracao($pedido['idEvento']);
		$x = array(
			"idSetor" => $usuario['idInstituicao'],
			"Setor" => $instituicao['instituicao']  ,
			"CategoriaContratacao" => $evento['ig_modalidade_IdModalidade'] , //precisa ver se retorna o id
			"Objeto" => $evento['ig_tipo_evento_idTipoEvento']." - ".$evento['nomeEvento'] ,
			"Local" => substr($local,1) , //retira a virgula no começo da string
			"ValorGlobal" => $pedido['valor'],
			"ValorIndividual" => $pedido['valorIndividual'],
			"FormaPagamento" => $pedido['formaPagamento'],
			"Periodo" => $periodo, 
			"Duracao" => $duracao, 
			//"CargaHoraria" => $carga , //fazer a funcao
			"Verba" => $pedido['idVerba'] ,
			"Justificativa" => $evento['justificativa'] ,
			"ParecerTecnico" => $evento['parecerArtistico'],
			"DataCadastro" => $evento['dataEnvio'],
			"Fiscal" => $evento['idResponsavel'] ,
			"Suplente" => $evento['suplente'],
			"Observacao"=> $pedido['observacao'] //verificar
			
			
		);
		
	return $x;	
	}else{
		return "Erro";
	}

	if($tipoPessoa != ""){ //retorna 1 arrey duas dimensões [$i]['nomedocampo']
		
	}
}

function retornaPeriodo($id){ //retorna o período
	$con = bancoMysqli();
	$sql_anterior = "SELECT * FROM ig_ocorrencia WHERE idEvento = '$id' AND publicado = '1' ORDER BY dataInicio ASC LIMIT 0,1"; //a data inicial mais antecedente
	$query_anterior = mysqli_query($con,$sql_anterior);
	$data = mysqli_fetch_array($query_anterior);
	$data_inicio = $data['dataInicio'];
	
	$sql_posterior01 = "SELECT * FROM ig_ocorrencia WHERE idEvento = '$id' AND publicado = '1' ORDER BY dataFinal DESC LIMIT 0,1"; //quando existe data final
	$sql_posterior02 = "SELECT * FROM ig_ocorrencia WHERE idEvento = '$id' AND publicado = '1' ORDER BY dataInicial DESC LIMIT 0,1"; //quando há muitas datas únicas
	
	$query_anterior01 = mysqli_query($con,$sql_posterior01);
	$data = mysqli_fetch_array($query_anterior01);
	$num = mysqli_num_rows($query_anterior01);
	if(($num > 0) AND ($data['dataFinal'] != '0000-00-00')){
		$dataFinal = $data['dataFinal'];	
	}else{
		$query_anterior02 = mysqli_query($con,$sql_posterior02);
		$data = mysqli_fetch_array($query_anterior02);
		$dataFinal = $data['dataFinal'];
				
	}

	if($data_inicio == $dataFinal){
		return exibirDataBr($data_inicio);
	}else{
		return "de ".exibirDataBr($data_inicio)." a ".exibirDataBr($dataFinal);
	}
	
}

?>
