<? 
// Códigos Úteis

//Verifica erro na string
$mysqli = new mysqli("localhost", "root", "lic54eca","igsis_beta");
if (!$mysqli->query($sql_inserir)) {
printf("Errormessage: %s\n", $mysqli->error);
}

//Exibe erros PHP
@ini_set('display_errors', '1');
error_reporting(E_ALL); 


/* se o parametro $idPedido estiver preenchido, ele só retornará uma array
com os dados do pedido específico - ['nomedocampo'] . 
se o parametro $tipoPessoa estiver preenchido,
ele retornar uma array de duas dimensões do tipo [$i]['nomedocampo'];
Setor [instituição]
Categoria da Contratação [tipo de contração]
Objeto [nome do evento] - [tipo de evento]
Local(is) - [Ocorrências]
Valor Global - [Valor total]
Valor Individual [ Valor individual]
Forma de Pagamento [forma de pagamento]
Período [Ocorrências]
Duração [Ocorrencia - duração]
Carga Horária [Carga Horária]
Verba [verba]
Justificativa [parecer artístico]
Parecer Técnico [parecer técnico]
Data do cadastro [data da igsis]
Fiscal [Primeiro fiscal]
Suplente [Segundo fiscal]
Observação [observação]

*/
function siscontrat($idPedido,$tipoPessoa,$instituicao){ 
	$con = bancoMysqli();
	$filtroInstituicao = " AND instituicao = '$instituicao' ";
	if($idPedido != ""){ //retorna 1 array do pedido ['nomedocampo'];
		$sql = "SELECT * FROM igsis_pedido_contratacao WHERE idPedidoContratacao = '$idPedido'".$filtroInstituicao ;	
		$query = mysqli_query($con,$sql);
		$campo = mysqli_fetch_array($query);
		
		$evento = recuperaDados("ig_evento",$campo['idEvento'],"idEvento");
		$usuario = recuperaDados("ig_usuario",$campo['idUsuario'],"idUsuario");
		$instituicao = recuperaDAdos("ig_instituicao",$usuario['idInstituicao'],"idInstituicao");
		
		$x = array(
			"idSetor" => $evento['instituicao'],
			"Setor" => $instituicao['instituicao']  ,
			"CategoriaContratacao" => $campo['ig_modalidade_IdModalidade'] , //precisa ver se retorna o id
			"Objeto" => $campo['ig_tipo_evento_idTipoEvento']." - ".$campo['nomeEvento'] ,
			"Local" => $local, //fazer a funcao
			"ValorGlobal" => $campo['valor'],
			"ValorIndividual" => $campo['valorIndividual'],
			"FormaPagamento" => $campo['formaPagamento'],
			"Periodo" => $periodo, //fazer a funcao
			"Duracao" => $duracao, //fazer a funcao
			"CargaHoraria" => $carga , //fazer a funcao
			"Verba" => $campo['verba'] ,
			"Justificativa" => $justificativa ,
			"ParecerTecnico" => $parecertecnico,
			"DataCadastro" => $evento['dataEnvio'],
			"Fiscal" => $evento['idResponsavel'] ,
			"Suplente" => $evento['suplente'],
			"Observacao"=> $observacao //verificar
			
			
		);
		
		
	}
	if($tipoPessoa != ""){ //retorna 1 arrey duas dimensões [$i]['nomedocampo']
		
	}
	
}

?>