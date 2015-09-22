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


function siscontratLista($tipoPessoa,$instituicao,$num_registro,$pagina,$ordem){
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
			"Justificativa" => $pedido['justificativa'] ,
			"ParecerTecnico" => $pedido['parecerArtistico'],
			"DataCadastro" => $evento['dataEnvio'],
			"Fiscal" => $fiscal['nomeCompleto'] ,
			"Suplente" => $suplente['nomeCompleto'],
			"Observacao"=> $pedido['observacao'], //verificar
			"NotaEmpenho" => "",
			"Horario" => "", //SPCultura
			"IdProponente" => $pedido['idPessoa'],
			"idRepresentante01" => $pedido['idRepresentante01'],
			"idRepresentante02" => $pedido['idRepresentante02'],
			"IdExecutante" => $pedido['IdExecutante'],
			"CargaHoraria" => "",
			"NumeroProcesso" => $pedido['NumeroProcesso'],
			"NotaEmpenho" => $pedido['NumeroNotaEmpenho'],
			"EmissaoNE" => $pedido['DataEmissaoNotaEmpenho'],
			"EntregaNE" => $pedido['DataEntregaNotaEmpenho'],
			"Status" => ""	
			);
		
		
		
	return $x;	
	}else{
		return "Erro";
	}
}

function siscontratDocs($idPessoa,$tipo){
	if($idPessoa == NULL){
		return NULL;	
	}else{	
	$con = bancoMysqli();
	switch($tipo){
		case 1: // Pessoa Física
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
				"Funcao" => $x['Funcao'],			
				"Representante01" => "",
				"Representante02" => ""


			);
			return $y;

		break;
		case 2: // Pessoa Jurídica
			$sql = "SELECT * FROM sis_pessoa_juridica WHERE Id_PessoaJuridica = '$idPessoa';";
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
				"Nacionalidade" => "" ,
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
				"Funcao" => "",
				"Representante01" => $x['IdRepresentanteLegal1'],
				"Representante02" => $x['IdRepresentanteLegal2']


			);
			return $y;	
		break;

		case 3: // Representante legal
			$sql = "SELECT * FROM sis_representante_legal WHERE Id_RepresentanteLegal = $idPessoa";
			$query = mysqli_query($con,$sql);
			$x = mysqli_fetch_array($query);
			//$endereco = retornaEndereco($x['CEP'],$x['Numero'],$x['Complemento']);
				$y = array(
				"Nome" => $x['RepresentanteLegal'],
				"NomeArtistico" => "" ,
				"IdEstadoCivil" =>  $x['IdEstadoCivil'] ,
				"EstadoCivil" => "" ,
				"DataNascimento" => "" ,
				"LocalNascimento" => "" ,
				"Naturalidade" => "" ,
				"DRT" =>"" ,
				"PIS" => "" ,
				"Observacao" => "" ,
				"RG" => $x['RG'] ,
				"CPF" => $x['CPF'],
				"CNPJ" => "",
				"CCM" => "",
				"OMB" => "",
				"Endereco" => "" ,
				"Telefones" => "",
				"INSS" => "" ,
				"Email" => "" ,
				"Funcao" => "",
				"Representante01" => $x['Id_RepresentanteLegal'],
				"Representante02" => ""

			);
			return $y;	
		break;		

	}
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


function listaArquivosPessoaSiscontrat($idPessoa,$tipo,$pedido,$form){
	$con = bancoMysqli();
	$sql = "SELECT * FROM igsis_arquivos_pessoa WHERE idPessoa = '$idPessoa' AND idTipoPessoa = '$tipo' AND publicado = '1'";
	$query = mysqli_query($con,$sql);
	echo "<table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td width='30%'>Tipo</td>
							<td>Nome do arquivo</td>
							<td width='10%'></td>
						</tr>
					</thead>
					<tbody>";
	while($campo = mysqli_fetch_array($query)){
		$tipoDoc = recuperaDados("igsis_upload_docs",$campo['tipo'],"idTipoDoc");
			echo "<tr>";
			echo "<td class='list_description'>".$tipoDoc['documento']."</td>";
			echo "<td class='list_description'><a href='../uploadsdocs/".$campo['arquivo']."' target='_blank'>".$campo['arquivo']."</a></td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=contratos&p=frm_arquivos&id=".$idPessoa."&tipo=".$tipo."'>
			<input type='hidden' name='idPessoa' value='".$idPessoa."' />
			<input type='hidden' name='tipoPessoa' value='".$tipo."' />
			<input type='hidden' name='$form' value='1' />
			
			<input type='hidden' name='apagar' value='".$campo['idArquivosPessoa']."' />
			<input type ='submit' class='btn btn-theme  btn-block' value='apagar'></td></form>"	;
			echo "</tr>";		
	}
					
						

                        

						
		
	echo "					</tbody>
				</table>";	
}
	
function buscaSiscontrat($busca,$tipo){



}


?>