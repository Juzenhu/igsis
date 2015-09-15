<?php
/* 

siscontrat 

*/


function siscontratLista($tipoPessoa,$instituicao,$registro,$pagina,$ordem){
	$con = bancoMysqli();
	$sql_lista = "SELECT * FROM igsis_pedido_contratacao WHERE tipoPessoa = '$tipoPessoa' AND instituicao = '$instituicao' ORDER BY idPedidoContratacao $ordem LIMIT $registro,$limite ";
	echo $sql_lista;
	$query_lista = mysqli_query($con,$sql_lista);
	$i = 0;
	while($pedido = mysqli_fetch_array($query_lista)){
		$evento = recuperaDados("ig_evento",$pedido['idEvento'],"idEvento"); //$tabela,$idEvento,$campo
		$usuario = recuperaDados("ig_usuario",$evento['idUsuario'],"idUsuario");
		$instituicao = recuperaDados("ig_instituicao",$usuario['idInstituicao'],"idInstituicao");
		$local = listaLocais($pedido['idEvento']);
		$periodo = retornaPeriodo($pedido['idEvento']);
		$duracao = retornaDuracao($pedido['idEvento']);
		$pessoa = recuperaPessoa($pedido['idPessoa'],$tipoPessoa);
		
		$x[$i] = array(
			"idSetor" => $usuario['idInstituicao'],
			"Setor" => $instituicao['instituicao']  ,
			"CategoriaContratacao" => $evento['ig_modalidade_IdModalidade'] , //precisa ver se retorna o id

			"Objeto" => retornaTipo($evento['ig_tipo_evento_idTipoEvento'])." - ".$evento['nomeEvento'] ,
			"Local" => substr($local,1) , //retira a virgula no começo da string
			"ValorGlobal" => $pedido['valor'],
			"ValorIndividual" => $pedido['valorIndividual'],
			"FormaPagamento" => $pedido['formaPagamento'],
			"Periodo" => $periodo, 
			"Duracao" => $duracao, 
			//"CargaHoraria" => $carga , //fazer a funcao
			"Proponente" => $pessoa['nome'],
			"Verba" => $pedido['idVerba'] ,
			"Justificativa" => $evento['justificativa'] ,
			"ParecerTecnico" => $evento['parecerArtistico'],
			"DataCadastro" => exibirDataBr($evento['dataEnvio']),
			"Fiscal" => $evento['idResponsavel'] ,
			"Suplente" => $evento['suplente'],
			"Observacao"=> $pedido['observacao'] //verificar
		);
		
		$i++;
	}
	return $x;
}


function siscontrat($idPedido){ 
	$con = bancoMysqli();
	if($idPedido != ""){ //retorna 1 array do pedido ['nomedocampo'];
		
		$pedido = recuperaDados("igsis_pedido_contratacao",$idPedido,"idPedidoContratacao");
		$evento = recuperaDados("ig_evento",$pedido['idEvento'],"idEvento"); //$tabela,$idEvento,$campo
		$usuario = recuperaDados("ig_usuario",$evento['idUsuario'],"idUsuario");
		$instituicao = recuperaDados("ig_instituicao",$usuario['idInstituicao'],"idInstituicao");
		$local = listaLocais($pedido['idEvento']);
		$periodo = retornaPeriodo($pedido['idEvento']);
		$duracao = retornaDuracao($pedido['idEvento']);
		$proponente = recuperaPessoa($pedido['idPessoa'],$pedido['tipoPessoa']);
		$fiscal = recuperaUsuario($evento['idResponsavel']);
		$suplente = recuperaUsuario($evento['suplente']);
		
		
		$x = array(
			"idSetor" => $usuario['idInstituicao'],
			"Setor" => $instituicao['instituicao']  ,

			"CategoriaContratacao" => $evento['ig_modalidade_IdModalidade'] , //precisa ver se retorna o id
			"Objeto" => retornaTipo($evento['ig_tipo_evento_idTipoEvento'])." - ".$evento['nomeEvento'] ,
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
			"Fiscal" => $fiscal['nomeCompleto'] ,
			"Suplente" => $suplente['nomeCompleto'],
			"Observacao"=> $pedido['observacao'], //verificar
			"DataCadastro"=> $evento['dataEnvio'],
			"Proponente"=> $proponente['nome'],
			//Horario SPCultura
			//DataCadastro
			"ProponenteTipoPessoa" =>  $proponente['tipo'],
			"ProponenteCNPJ_CPF" =>  $proponente['numero'],
			"ProponenteCCM" => $proponente['ccm'],
			"ProponenteEndereco" =>  $proponente['cep'],
			"ProponenteTelefones" =>  $proponente['telefones'],
			"ProponenteRepresentante01" => $proponente['represenante01'], //puxar da tabela pedido
			"ProponenteRepresentante02" => $proponente['represenante02'] //puxar da tabela pedido
			
				
		);
		
		
		
	return $x;	
	}else{
		return "Erro";
	}
}

function siscontratDeclaracao($idPessoa,$tipo){
	
/*
Indices da array

"Nome"
"RG"
"CPF"
"CCM"
"Endereco"
"Telefones"
"Nascimento"
"INSS"
"Email"



*/

}

function siscontratRecibo($idProcesso){

/*
Indices da array

"NotaEmpenho"
"RG"
"CPF"
"CCM"
"Endereco"
"Telefones"
"Nascimento"
"INSS"
"Email"



*/	
	
}
?>