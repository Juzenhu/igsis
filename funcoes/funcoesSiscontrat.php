<?php
/* 

siscontrat 

	$x = array(

		"Nome" => "",
		"NomeArtistico" => "",
		"EstadoCivil" => "",
		"DataNascimento" => "",
		"LocalNascimento" => "",
		"Naturalidade" => "",
		"DRT" => "",
		"PIS" => "",
		"Observacao" => "",
		"RG" => "",
		"CPF" => "",
		"CNPJ" => "",
		"CCM" => "",
		"OMB" => "",
		"Endereco" => "",
		"Telefones" => "",
		"INSS" => "",
		"Email" => "",
		"Representante01" => "",
		"Representante02" => ""

	
	);

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
			"CargaHoraria" => $carga , //fazer a funcao
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
			"TipoPessoa" => $pedido['tipoPessoa'],
			"CategoriaContratacao" => $evento['ig_modalidade_IdModalidade'] , //precisa ver se retorna o id
			"Objeto" => retornaTipo($evento['ig_tipo_evento_idTipoEvento'])." - ".$evento['nomeEvento'] ,
			"Local" => substr($local,1) , //retira a virgula no começo da string
			"ValorGlobal" => $pedido['valor'],
			"ValorIndividual" => $pedido['valorIndividual'],
			"FormaPagamento" => $pedido['formaPagamento'],
			"Periodo" => $periodo, 
			"Duracao" => $duracao, 
			"Verba" => $pedido['idVerba'] ,
			"Justificativa" => $evento['justificativa'] ,
			"ParecerTecnico" => $evento['parecerArtistico'],
			"DataCadastro" => $evento['dataEnvio'],
			"Fiscal" => $fiscal['nomeCompleto'] ,
			"Suplente" => $suplente['nomeCompleto'],
			"Observacao"=> $pedido['observacao'], //verificar
			"NotaEmpenho" => "",
			"Horario" => "", //SPCultura
			"IdProponente" => $pedido['idPessoa'],
			"NumeroProcesso" => "",
			"EmissaoNE" => "",
			"EntregaNE" => ""
	
			);
		
		
		
	return $x;	
	}else{
		return "Erro";
	}
}

function siscontratDocs($idPessoa,$tipo){
	$con = bancoMysqli();
	switch($tipo){
		case '1': // Pessoa Física
			$sql = "SELECT * FROM sis_pessoa_fisica WHERE Id_PessoaFisica = $idPessoa";
			$query = mysqli_query($con,$sql);
			$x = mysqli_fetch_array($query);
			$estadoCivil = recuperaEstadoCivil($x['IdEstadoCivil']);
			$endereco = retornaEndereco($x['CEP'],$x['Numero'],$x['Complemento']);
				$y = array(
				"Nome" => $x['Nome'],
				"NomeArtistico" => $x['NomeArtistico'] ,
				"IdEstadoCivil" => $x['IdEstadoCivil'] ,
				"EstadoCivil" => $estadoCivil['EstadoCivil'] ,
				"DataNascimento" => $x['DataNascimento'] ,
				"LocalNascimento" => $x['LocalNascimento'] ,
				"Nacionalidade" => $x['Nacionalidade'] ,
				"DRT" => $x['DRT'] ,
				"PIS" => $x['Pis'] ,
				"Observacao" => $x['Observacao'] ,
				"RG" => $x['RG'] ,
				"CPF" => $x['CPF'],
				"CNPJ" => "",
				"CCM" => $x['CCM'],
				"docCCM" => "nomedoarquivo",
				"OMB" => $x['OMB'] ,
				"Endereco" => $endereco ,
				"Telefones" => $x['Telefone1']." / ".$x['Telefone2']." / ".$x['Telefone3'],
				"INSS" => $x['InscricaoINSS'] ,
				"Email" => $x['Email'] ,				
				"Representante01" => "",
				"Representante02" => ""

			);
			return $y;

		break;
		case '2': // Pessoa Jurídica
			$sql = "SELECT * FROM sis_pessoa_juridica WHERE Id_PessoaJuridica = $idPessoa";
			$query = mysqli_query($con,$sql);
			$x = mysqli_fetch_array($query);
			$endereco = retornaEndereco($x['CEP'],$x['Numero'],$x['Complemento']);
				$y = array(
				"Nome" => $x['RazaoSocial'],
				"NomeArtistico" => "" ,
				"IdEstadoCivil" => "" ,
				"EstadoCivil" => "" ,
				"DataNascimento" => "" ,
				"LocalNascimento" => "" ,
				"Naturalidade" => "" ,
				"DRT" =>"" ,
				"PIS" => "" ,
				"Observacao" => $x['Observacao'] ,
				"RG" => "" ,
				"CPF" => "",
				"CNPJ" => $x['CNPJ'],
				"CCM" => "",
				"OMB" => "",
				"Endereco" => $endereco ,
				"Telefones" => $x['Telefone1']." / ".$x['Telefone2']." / ".$x['Telefone3'],
				"INSS" => "" ,
				"Email" => $x['Email'] ,
				"Representante01" => $x['IdRepresentanteLegal1'],
				"Representante02" => $x['IdRepresentanteLegal2'],
				"NumeroProcesso" => "",
				"EmissaoNE" => "",
				"EntregaNE" => ""
			);
			return $y;	
		break;

		case '3': // Representante legal
			$sql = "SELECT * FROM sis_representante_legal WHERE Id_RepresentanteLegal = $idPesso";
			$query = mysqli_query($con,$sql);
			$x = mysqli_fetch_array($query);
			$endereco = retornaEndereco($x['CEP'],$x['Numero'],$x['Complemento']);
				$y = array(
				"Nome" => $x['RazaoSocial'],
				"NomeArtistico" => "" ,
				"IdEstadoCivil" => "" ,
				"EstadoCivil" => "" ,
				"DataNascimento" => "" ,
				"LocalNascimento" => "" ,
				"Naturalidade" => "" ,
				"DRT" =>"" ,
				"PIS" => "" ,
				"Observacao" => $x['Observacao'] ,
				"RG" => "" ,
				"CPF" => "",
				"CNPJ" => $x['CNPJ'],
				"CCM" => "",
				"OMB" => "",
				"Endereco" => $endereco ,
				"Telefones" => $x['Telefone1']." / ".$x['Telefone2']." / ".$x['Telefone3'],
				"INSS" => "" ,
				"Email" => $x['Email'] ,
				"Representante01" => $x['IdRepresentanteLegal1'],
				"Representante02" => $x['IdRepresentanteLegal2'],
				"NumeroProcesso" => "",
				"EmissaoNE" => "",
				"EntregaNE" => ""
			);
			return $y;	
		break;		

	}

}
function listaPedidoContratacao($idEvento){
	$con = bancoMysqli();
	$sql = "SELECT * FROM igsis_pedido_contratacao WHERE idEvento = '$idEvento' AND publicado = '1'";
	$query = mysqli_query($con,$sql);
	$i = 0;
	while($pedido = mysqli_fetch_array($query)){
		$x[$i] = $pedido['idPedidoContratacao'];
		$i++;	
		
	}	
	return $x;
}	



	


>>>>>>> 0afce3b



?>
