<?php
/* 

siscontrat 

Pedido de Contratação de PF e PJ
·         Data no formato dd/mm/aaaa

·         Formatar campo valor (tela de edição e relatório)

·         Nos relatórios adicionar valor por extenso

 
Edição PF
·         Campo foto (criar)

·         Campo CEP, Endereço e afins

·         Colocar máscara no campo telefone

·         Data no formato dd/mm/aaaa

 
Edição PJ
·         Campo CEP, Endereço e afins

·         Colocar máscara no campo telefone

·         Fazer combobox para os representantes legal

·         Data no formato dd/mm/aaaa

·         Update com erro (descobrir)

 
Representante Legal
·         Corrigir nome das tabelas para “sis_” e verificar funcionamento

 
Proposta PF e PJ
·         Fazer relatórios faltantes

·         Fazer o campo Assinatura de acordo com o Departamento

 
Processo PF
·         Máscara para processo

·         Relatório de reserva com defeito

 
Processo PJ
·         Máscara para processo

·         Update com defeito

·         Relatório de reserva (fazer)

 
Nota de Empenho
·         Fazer o campo de data em javascript

·         Ver erro no update do PJ

·         Corrigir relatório do recibo

 



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
			"Proponente"=> $proponente['nome']
			//Horario SPCultura
			//DataCadastro
			
		);
		
	return $x;	
	}else{
		return "Erro";
	}

}

?>