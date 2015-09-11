<?php
/* 



> Campos obrigatórios
	+ eventos
	+ pedidos de contratação
	
> Ocorrências obrigatórias
	+ eventos
	+ cinema
	
> Comparação de datas
	+ não permitir datas
	+ deadlines
	
 
*/

function verificaCampos($idEvento){
	$con = bancoMysqli(); //abre o banco
	$sql = "SELECT * FROM igsis_opcoes WHERE opcao = 'campos' AND valor =  '1'"; //vai até o banco e pega os campos obrigatórios
	$query = mysqli_query($con,$sql); // executa a query
	$num = mysqli_num_rows($query); // recebe o número de campos a se verificar;
	$total = 0;
	if($num > 0){ // começa a verificação
		while($x = mysqli_fetch_array($query)){ // roda os campos
			$y = explode('.',$x['codigo']); // separa a tabela do campo
			$tabela = $y[0];
			$campo = $y[1];
			$campoEvento = $y['2'];
			$sql_verifica = "SELECT * FROM $tabela WHERE $campoEvento = '$idEvento' LIMIT 0,1"; //gera a query e retorna 1 registro
			$query_verifica = mysqli_query($con,$sql_verifica);
			$campoRecuperado = mysqli_fetch_array($query_verifica);
			if(
				($campoRecuperado[$campo] == "") OR //verifica se o campo está vazio
				($campoRecuperado[$campo] == NULL) //verifica se o campo é nulo
			)
			{
				$z[$tabela][$campo] = 0;
				$total++;
			}else{
				$z[$tabela][$campo] = 1;
	
			}
		} // fecha o while
		
	}
	$z['total'] = $total;
	return $z;
	
}

function verificaOcorrencias($idEvento){
	$evento = recuperaDados("ig_evento",$idEvento,"idEvento");
	$con = bancoMysqli();
	$num = 0;
	if($evento['ig_tipo_evento_idTipoEvento'] != 1){
		$sql = "SELECT * FROM ig_ocorrencia WHERE idEvento = '$idEvento' AND publicado = '1'";
		$query = mysqli_query($con,$sql);
		$num = mysqli_num_rows($query);
	}else{
		$sql = "SELECT * FROM ig_ocorrencia WHERE idEvento = '$idEvento' AND publicado = '1' AND idTipoOcorrencia = '5'"; //sessoes de cinema
		$query = mysqli_query($con,$sql);
		$num = mysqli_num_rows($query);
	}
	return $num;
}



function prazoContratos($idEvento){ //deixar mais redondo.
	$data = retornaDatas($idEvento);
	$opcoes = recuperaDados("igsis_opcoes","dataContrato","opcao");
	if($opcoes['valor'] == 1){	
		$y = explode('.',$opcoes['codigo']); // separa a tabela do campo
		$data_inicio = $data['dataInicio'];
		$data_final = somarDatas($data_inicio,$y[1]);
		$hoje = date("Y-m-d");
		if($data_final >= $hoje){
			$prazo = substr($y[1], 1);
			echo "Hoje é ".exibirDataBr($hoje).".<br />
			O seu evento se inicia em ".exibirDataBr($data['dataInicio'])." .<br />
			O prazo para contratos é de $prazo dias.<br />
			Você está no prazo de contratos.";
		}else{
			$prazo = substr($y[1], 1);
			echo "Hoje é ".exibirDataBr($hoje).".<br />
			O seu evento se inicia em ".exibirDataBr($data['dataInicio'])." .<br />
			O prazo para contratos é de $prazo dias.<br />
			Você está fora do prazo de contratos.";
		}
	}

}

function prazoEmCartaz($idEvento){ //deixar mais redondo.
	$data = retornaDatas($idEvento);
	$opcoes = recuperaDados("igsis_opcoes","dataEmCartaz","opcao");
	if($opcoes['valor'] == 1){	
		$data_final = $opcoes['codigo'];
		$hoje = date("Y-m-d");
		if($data_final >= $hoje){
			echo "Hoje é ".exibirDataBr($hoje).".<br />
			O seu evento se inicia em ".exibirDataBr($data['dataInicio'])." .<br />
			O prazo para a revista Em Cartaz é ".exibirDataBr($data_final).".<br />
			Você está no prazo.";
		}else{
			echo "Hoje é ".exibirDataBr($hoje).".<br />
			O seu evento se inicia em ".exibirDataBr($data['dataInicio'])." .<br />
			O prazo para contratos é de $prazo dias.<br />
			O prazo para a revista Em Cartaz é ".exibirDataBr($data_final).".<br />
			Você está fora do prazo.";
		}
	}

}

function verificaPendencias($idEvento){

	return '0';

	
}

?>
