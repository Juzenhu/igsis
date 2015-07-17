
<?php
/*
* Criando e exportando planilhas do Excel
* /
*/
//funções usadas
include "../funcoes/funcoesGerais.php";
function bancoIgccsp(){ // Cria conexao ao banco. Substitui o include "conecta_mysql.php" .
	$servidor = 'localhost';
	$usuario = 'root';
	$senha = '';
	$banco = 'igccspbeta';
	$con = mysqli_connect($servidor,$usuario,$senha,$banco); 
	mysqli_set_charset($con,"utf8");
	return $con;
}
$conn = bancoIgccsp();

function recuperaTipo($numero){
	$conn = bancoIgccsp();
	$sql = "SELECT * FROM ig_tipo_eventos WHERE id_eventos = '$numero'";
	$query = mysqli_query($conn,$sql);
	while($campo = mysqli_fetch_array($query)){
		$xis = $campo['tipo'];
		return $xis;
	}
}

function recuperaTotal($id_evento){
$conn = bancoIgccsp();	
$sql = "SELECT * FROM  `ig_valor` WHERE id_evento =  '$id_evento'";	
$query = mysqli_query($conn,$sql);
$tamanho = mysqli_num_rows($query);
			$i = 1;
			while($campo = mysqli_fetch_array($query)){
				$soma[$i] = $campo['valor'];
				$i++;
		}
			$total = 0;
			for($i = 1;$i <= $tamanho; $i++){
				$total = $total  + $soma[$i];
				
			}
		return $total;
}

function recuperaEmpresa($id){
	$conn = bancoIgccsp();
	$sql = "SELECT * FROM ig_contratado WHERE id_contratado = '$id'";
	$query = mysqli_query($conn,$sql);	
	$campo = mysqli_fetch_array($query);
	return $campo;
}

function recuperaCnpj($id_evento){
	$conn = bancoIgccsp();
	$sql = "SELECT * FROM ig_valor WHERE id_evento =  '$id_evento'";	
	$query = mysqli_query($conn,$sql);
	$tamanho = mysqli_num_rows($query);
			if($tamanho > 0){
			$i = 1;
			$valor = "";
			while($campo = mysqli_fetch_array($query)){
				$campo2 = recuperaEmpresa($campo['id_contratado']);
				$valor = $valor."CNPJ/CPF($i):".$campo2['cpf_cnpj']."<br />";
				$i++;
		}
	if(isset($valor)){	return $valor; }
			}else{
				return "Não há contratos";
			}
}

function recuperaNome($id_evento){
	$conn = bancoIgccsp();
	$sql = "SELECT * FROM ig_valor WHERE id_evento =  '$id_evento'";	
	$query = mysqli_query($conn,$sql);
	$tamanho = mysqli_num_rows($query);
			if($tamanho > 0){
			$i = 1;
			$valor = "";
			while($campo = mysqli_fetch_array($query)){
				$campo2 = recuperaEmpresa($campo['id_contratado']);
				$valor = $valor."($i):".$campo2['nome']."<br />";
				$i++;
		}
	if(isset($valor)){	return $valor; }
			}else{
				return "Não há contratos";
			}	
}

function recuperaEmail($id_evento){
	$conn = bancoIgccsp();
	$sql = "SELECT * FROM ig_valor WHERE id_evento =  '$id_evento'";	
	$query = mysqli_query($conn,$sql);
	$tamanho = mysqli_num_rows($query);
			if($tamanho > 0){
			$i = 1;
			$valor = "";
			while($campo = mysqli_fetch_array($query)){
				$campo2 = recuperaEmpresa($campo['id_contratado']);
				$valor = $valor."($i):".$campo2['email']."<br />";
				$i++;
		}
	if(isset($valor)){	return $valor; }
			}else{
				return "Não há contratos";
			}	
}

function recuperaTelefone($id_evento){
	$conn = bancoIgccsp();
	$sql = "SELECT * FROM ig_valor WHERE id_evento =  '$id_evento'";	
	$query = mysqli_query($conn,$sql);
	$tamanho = mysqli_num_rows($query);
			if($tamanho > 0){
			$i = 1;
			$valor = "";
			while($campo = mysqli_fetch_array($query)){
				$campo2 = recuperaEmpresa($campo['id_contratado']);
				$valor = $valor."($i):".$campo2['telefones']."<br />";
				$i++;
		}
	if(isset($valor)){	return $valor; }
			}else{
				return "Não há contratos";
			}	
}

// Definimos o nome do arquivo que será exportado
$arquivo = 'planilha.xls';

// Criamos uma tabela HTML com o formato da planilha
$html = '';
$html .= '<table>';
$html .= '<tr>';
$html .= '<td colspan="3">Planilha teste</tr>'; 
$html .= '</tr>';
$html .= '<tr>';



$html .= '<td><b>Nome da atração</b></td>'; //01
$html .= '<td><b>Programador</b></td>';//02
$html .= '<td><b>Recursos</b></td>'; //03
$html .= '<td><b>Cachê total</b></td>'; //03a
$html .= '<td><b>Status do Contrato</b></td>'; //04
$html .= '<td><b>Número de parcelas</b></td>';//05
$html .= '<td><b>Quantas vezes ocorrerá no 2 semestre</b></td>'; //06
$html .= '<td><b>Quais regiões</b></td>'; //07
$html .= '<td><b>Histórico do Artista</b></td>'; //08
$html .= '<td><b>Estilos e/ou Linguagem</b></td>'; //09
$html .= '<td><b>Número de pessoas envolvidas</b></td>'; //10

$html .= '<td><b>CNPJ</b></td>'; //11
$html .= '<td><b>Nome da Empresa</b></td>'; //12
$html .= '<td><b>Email da empresa</b></td>'; //13
$html .= '<td><b>Telefone da empresa</b></td>'; //14
$html .= '</tr>';


$sql = "SELECT DISTINCT * FROM ig_evento INNER JOIN ig_datas ON (ig_evento.id_evento = ig_datas.id_evento) WHERE ig_evento.autorizacao = '1' AND ig_datas.data_inicio > '2015-07-01' ORDER BY ig_evento.id_evento";
$query = mysqli_query($conn,$sql);
while($campo = mysqli_fetch_array($query)){ 
$html .= '<tr>';
$html .= "<td>".$campo['pg01_evento']." </td>"; //01
$html .= "<td>".$campo['pg01_resp_ccsp']." </td>"; //02
$html .= "<td> </td>"; //03
$total = recuperaTotal($campo['id_evento']);
$html .= "<td>".$total." </td>"; //03a
$html .= "<td></td>"; //04
$html .= "<td>1 parcela </td>"; //05
$html .= "<td>1 vez </td>"; //06
$html .= "<td>Paraíso - Centro </td>"; //07
$release = strip_tags(html_entity_decode($campo['pg03_release']));
$y = $campo['pg01_tipo'];
$tipo = recuperaTipo($y);
$html .= "<td>".$release." </td>"; //08
$html .= "<td>".$tipo." </td>"; //09
$html .= "<td>30 </td>"; //10
$cnpj = recuperaCnpj($campo['id_evento']);
$email = recuperaEmail($campo['id_evento']);
$telefone = recuperaTelefone($campo['id_evento']);
$nome = recuperaNome($campo['id_evento']);
$html .= "<td>".$cnpj."</td>"; //11
$html .= "<td>".$nome." </td>"; //12
$html .= "<td>".$email." </td>"; //13
$html .= "<td>".$telefone." </td>"; //14

$html .= '</tr>';
}


$html .= '</table>';

// Configurações header para forçar o download

header('Content-Type: text/html; charset=utf-8');
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
// Envia o conteúdo do arquivo
echo utf8_decode($html);
exit;
?>