<?php
/* 

siscontrat 

Exemplo de uso:

require "../funcoes/funcoesSiscontrat.php";

$contrato = siscontrat($idPedido);
$pj = siscontratDocs($contrato['IdProponente'],$contrato['TipoPessoa']);
$representante01 = siscontratDocs($pj['Representante01'],3);
$representante02 = siscontratDocs($pj['Representante02'],3);
$executante = siscontratDocs($contrato['executante'],1);

$conectar = bancoMysqli(); //cria conexão
$sql = "SELECT * FROM ig_evento WHERE idEvento = '$idEvento' LIMIT 0,10";
while($pedido = mysqli_fetch_array(mysqli_query($conectar,$sql))){
	$nome_do_evento = $pedido['nomeEvento'];
		
} //executa query

 
*/


function siscontratLista(){
	$con = bancoMysqli();

	
	$sql_lista_total = "SELECT * FROM igsis_pedido_contratacao WHERE tipoPessoa = '$tipoPessoa' AND publicado = '1' AND instituicao = '$instituicao' ORDER BY idPedidoContratacao $ordem ";
	$query_lista_total = mysqli_query($con,$sql_lista_total);
	$total_registros = mysqli_num_rows($query_lista_total);
	$pag = $pagina - 1;
	$registro_inicial = $num_registro * $pag;
	$total_paginas = $total_registros / $num_registro; // gera o número de páginas
	$sql_lista_pagina = "SELECT * FROM igsis_pedido_contratacao WHERE tipoPessoa = '$tipoPessoa' AND publicado = '1' AND instituicao = '$instituicao' ORDER BY idPedidoContratacao $ordem LIMIT $registro_inicial,$num_registro";
		$query_lista_pagina = mysqli_query($con,$sql_lista_pagina);
	//$x = $sql_lista_pagina;
	$i = 0;
	while($pedido = mysqli_fetch_array($query_lista_pagina)){
		$evento = recuperaDados("ig_evento",$pedido['idEvento'],"idEvento"); //$tabela,$idEvento,$campo
		$usuario = recuperaDados("ig_usuario",$evento['idUsuario'],"idUsuario");
		$instituicao = recuperaDados("ig_instituicao",$usuario['idInstituicao'],"idInstituicao");
		$local = listaLocais($pedido['idEvento']);
		$periodo = retornaPeriodo($pedido['idEvento']);
		$duracao = retornaDuracao($pedido['idEvento']);
		$pessoa = recuperaPessoa($pedido['idPessoa'],$tipoPessoa);
		$fiscal = recuperaUsuario($evento['idResponsavel']);
		$suplente = recuperaUsuario($evento['suplente']);
		$protocolo = ""; //recuperaDados("sis_protocolo",$pedido['idEvento'],"idEvento");
				
		$x[$i] = array(
		    "idPedido" => $pedido['idPedidoContratacao'],
			"idEvento" => $pedido['idEvento'], 
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
			"Horario" => "", //SPCultura
			"IdProponente" => $pedido['idPessoa'],
			"ProtocoloSIS" => '', //$protocolo['idProtocolo'],
			"NumeroProcesso" => $pedido['NumeroProcesso'],
			"NotaEmpenho" => $pedido['NumeroNotaEmpenho'],
			"EmissaoNE" => $pedido['DataEmissaoNotaEmpenho'],
			"EntregaNE" => $pedido['DataEntregaNotaEmpenho'],
			"Status" => ""
		);
		
		$i++;
	}
	return $x;


?>