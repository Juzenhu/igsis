<?php 

/*
igSmc v0.1 - 2015
ccsplab.org - centro cultural são paulo
*/

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
					$_SESSION['include'] = $user['include'];
					$_SESSION['nomeCompleto'] = $user['nomeCompleto'];
					$_SESSION['idUsuario'] = $user['idUsuario'];

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
	
function exibirDataHoraBr($data){ //retorna data d/m/y de mysql/datetime(a-m-d H:i:s)
	$timestamp = strtotime($data); 
	return date('d/m/y - H:i:s', $timestamp);	
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

function gravarLog($log){ //grava na tabela ig_log os inserts e updates
	$idUsuario = $_SESSION['idUsuario'];
	$ip = $_SERVER["REMOTE_ADDR"];
	$data = date('Y-m-d H:i:s');
	$sql = "INSERT INTO `ig_log` (`idLog`, `ig_usuario_idUsuario`, `enderecoIP`, `dataLog`, `descricao`) VALUES (NULL, '$idUsuario', '$ip', '$data', '$log')";

	mysql_query($sql);
	
}

function saudacao(){
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

?>