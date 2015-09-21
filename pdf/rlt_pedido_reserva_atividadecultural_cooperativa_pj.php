<?php 
   
   // INSTALAÇÃO DA CLASSE NA PASTA FPDF.
   require('../lib/fpdf/fpdf.php');
   
   //CONEXÃO COM BANCO DE DADOS 
   include("../conectar.php"); 
   

class PDF extends FPDF
{
	
// Page header
function Header()
{
    // Logo
    $this->Image('../img/logo_dec.JPG',20,20,40);
    // Move to the right
    $this->Cell(80);
    $this->Image('../img/logo_smc.jpg',170,10);
    // Line break
    $this->Ln(20);
}

}



//CONSULTA 
$id_ped=$_GET['id'];

$sql_query_tabela_pedcontpj ="
						SELECT 	sis_pedido_contratacao_pj.Id_PedidoContratacaoPJ,
								sis_pedido_contratacao_pj.Objeto,
								sis_pedido_contratacao_pj.LocalEspetaculo,
								sis_pedido_contratacao_pj.Valor,
								sis_pedido_contratacao_pj.FormaPagamento,
								sis_pedido_contratacao_pj.Periodo,
								sis_pedido_contratacao_pj.Duracao,
								sis_pedido_contratacao_pj.CargaHoraria,
								sis_pedido_contratacao_pj.Justificativa,
								sis_pedido_contratacao_pj.Fiscal,
								sis_pedido_contratacao_pj.Suplente,
								sis_pedido_contratacao_pj.ParecerTecnico,
								sis_pedido_contratacao_pj.Observacao,
								sis_categoria_contratacao.CategoriaContratacao
						FROM sis_pedido_contratacao_pj
						
						INNER JOIN sis_categoria_contratacao
							ON sis_pedido_contratacao_pj.IdCategoria = sis_categoria_contratacao.Id_CategoriaContratacao
						
						WHERE Id_PedidoContratacaoPJ = $id_ped
					";
					

$consulta_tabela_pedcontpj = mysqli_query($conexao,$sql_query_tabela_pedcontpj);
$linha_tabela_pedcontpj = mysqli_fetch_assoc ($consulta_tabela_pedcontpj);


//VARIÁVEIS PARA PEDIDO CONTRATAÇÃO

$codPed = $linha_tabela_pedcontpj["Id_PedidoContratacaoPJ"];
$Objeto = $linha_tabela_pedcontpj["Objeto"];
$Local = $linha_tabela_pedcontpj["LocalEspetaculo"];
$ValorGlobal = $linha_tabela_pedcontpj["Valor"];
$FormaPagamento = $linha_tabela_pedcontpj["FormaPagamento"];
$Periodo = $linha_tabela_pedcontpj["Periodo"];
$Duracao = $linha_tabela_pedcontpj["Duracao"];
$CargaHoraria = $linha_tabela_pedcontpj["CargaHoraria"];
$Justificativa = $linha_tabela_pedcontpj["Justificativa"];
$fiscal = $linha_tabela_pedcontpj["Fiscal"];
$suplente = $linha_tabela_pedcontpj["Suplente"];
$parecer = $linha_tabela_pedcontpj["ParecerTecnico"];
$observacao =$linha_tabela_pedcontpj["Observacao"];


//CONSULTA PARA PJ

$sql_query_tabelas_pj_pedcontratacao ="
						SELECT 	sis_pedido_contratacao_pj.Id_PedidoContratacaoPJ,
								sis_pessoa_juridica.RazaoSocial,
								sis_pessoa_juridica.CNPJ,
								sis_pessoa_juridica.CCM,
								sis_pessoa_juridica.Telefone1,
								sis_pessoa_juridica.Telefone2,
								sis_pessoa_juridica.Telefone3,
								sis_pessoa_juridica.Email
						FROM sis_pedido_contratacao_pj		
						INNER JOIN sis_pessoa_juridica
							ON sis_pedido_contratacao_pj.IdPessoaJuridica = sis_pessoa_juridica.Id_PessoaJuridica
						WHERE Id_PedidoContratacaoPJ = $id_ped
					";
					

$consulta_tabelas_pj_pedcontratacao = mysqli_query($conexao,$sql_query_tabelas_pj_pedcontratacao);
$linha_tabelas_pj_pedcontratacao = mysqli_fetch_assoc ($consulta_tabelas_pj_pedcontratacao);


//VARIÁVEIS PARA PJ

$Nome = $linha_tabelas_pj_pedcontratacao["RazaoSocial"];
$CCMPJ = $linha_tabelas_pj_pedcontratacao["CCM"];
$CNPJ = $linha_tabelas_pj_pedcontratacao["CNPJ"];
$telefone1PJ = $linha_tabelas_pj_pedcontratacao["Telefone1"];
$telefone2PJ = $linha_tabelas_pj_pedcontratacao["Telefone2"];
$telefone3PJ = $linha_tabelas_pj_pedcontratacao["Telefone3"];
$EmailPJ = $linha_tabelas_pj_pedcontratacao["Email"];


//CONSULTA PARA PF

$sql_query_tabelas_pf_pedcontratacao ="
						SELECT 	sis_pedido_contratacao_pj.Id_PedidoContratacaoPJ,
								sis_pessoa_fisica.*
						FROM sis_pedido_contratacao_pj		
						INNER JOIN sis_pessoa_fisica
							ON sis_pedido_contratacao_pj.IdPessoaFisica = sis_pessoa_fisica.Id_PessoaFisica
						WHERE Id_PedidoContratacaoPJ = $id_ped
					";
					

$consulta_tabelas_pf_pedcontratacao = mysqli_query($conexao,$sql_query_tabelas_pf_pedcontratacao);
$linha_tabelas_pf_pedcontratacao = mysqli_fetch_assoc ($consulta_tabelas_pf_pedcontratacao);



//VARIÁVEIS PARA PF

$Nome = $linha_tabelas_pf_pedcontratacao["Nome"];
$NomeArtistico = $linha_tabelas_pf_pedcontratacao["NomeArtistico"];
//$estadoCivil = $linha_tabelas_pf_pedcontratacao["EstadoCivil"];
$Nacionalidade = $linha_tabelas_pf_pedcontratacao["Nacionalidade"];
$RG = $linha_tabelas_pf_pedcontratacao["RG"];
$CPF = $linha_tabelas_pf_pedcontratacao["CPF"];
$CCM = $linha_tabelas_pf_pedcontratacao["CCM"];
$OMB = $linha_tabelas_pf_pedcontratacao["OMB"];
$DRT = $linha_tabelas_pf_pedcontratacao["DRT"];
$Funcao = $linha_tabelas_pf_pedcontratacao["Funcao"];
$numero = $linha_tabelas_pf_pedcontratacao["Numero"];
$complemento = $linha_tabelas_pf_pedcontratacao["Complemento"];
//$cep = $linha_tabelas_pf_pedcontratacao["CEP"];
$telefone1 = $linha_tabelas_pf_pedcontratacao["Telefone1"];
$telefone2 = $linha_tabelas_pf_pedcontratacao["Telefone2"];
$telefone3 = $linha_tabelas_pf_pedcontratacao["Telefone3"];
$Email = $linha_tabelas_pf_pedcontratacao["Email"];
$INSS = $linha_tabelas_pf_pedcontratacao["InscricaoINSS"];


$ano=date('Y');


// GERANDO O PDF:
$pdf = new PDF('P','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
$pdf->AliasNbPages();
$pdf->AddPage();

   
$x=20;
$l=6; //DEFINE A ALTURA DA LINHA   
   
   $pdf->SetXY( $x , 38 );// SetXY - DEFINE O X (largura) E O Y (altura) NA PÁGINA

   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(180,5,utf8_decode("Folha de Informação nº ___________"),0,1,'R');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(28,$l,utf8_decode("Do processo nº:"),0,0,'L');
   $pdf->Cell(30,$l,utf8_decode("variavel processo"),0,0,'L');
   $pdf->Cell(122,$l,"Data: _______ / _______ / " .$ano.".",0,1,'R');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(30,$l,'INTERESSADO:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($Nome));	
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(22,$l,'ASSUNTO:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($Objeto));
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(50,$l,utf8_decode("CHEFIA DE GABINETE"),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->Cell(50,$l,utf8_decode("Sr(a). Chefe de Gabinete,"),0,1,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(180,$l,utf8_decode("Encaminho o presente a Vossa Senhoria para a necessária reserva de recursos com transferência de valor que deverá onerar a dotação pertinente (programação de atividades culturais 25.10.13.392.3001.6354.3390.3900) mais o valor do INSS patronal."));
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Valor:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode("R$ ".$ValorGlobal));
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->MultiCell(180,$l,utf8_decode("Após, enviar para DEC/ ___________________________ para prosseguimento."));
   
   $pdf->Ln();
   $pdf->Ln();
  
   $pdf->SetX($x);
   $pdf->Cell(180,$l,utf8_decode("São Paulo, ________ de ____________________ de ".$ano."."),0,1,'C');
   
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(40,$l,'',0,0,'C');
   $pdf->Cell(100,$l,'VARIAVEL ASSINATURA',0,0,'C');
   $pdf->Cell(40,$l,'',0,1,'C');
   $pdf->SetX($x);
   $pdf->Cell(40,$l,'',0,0,'C');
   $pdf->Cell(100,$l,'VARIAVEL ASSINATURA-CARGO',0,0,'C');
   $pdf->Cell(40,$l,'',0,1,'C');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(50,$l,utf8_decode("SMC-CAF-SCO"),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->Cell(50,$l,utf8_decode("Sr(a). Supervidor,"),0,1,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->MultiCell(180,$l,utf8_decode("AUTORIZO, conforme solicitado."));
   
   $pdf->Ln();
   $pdf->Ln();
  
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(180,$l,utf8_decode("São Paulo, ________ de ____________________ de ".$ano."."),0,1,'C');

   
//RODAPÉ PERSONALIZADO
   $pdf->SetXY($x,260);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(40,$l,'',0,0,'C');
   $pdf->Cell(100,$l,'GUILHERME VARELLA',0,0,'C');
   $pdf->Cell(40,$l,'',0,1,'C');
   $pdf->SetX($x);
   $pdf->Cell(40,$l,'',0,0,'C');
   $pdf->Cell(100,$l,'Chefe de Gabinete - SMC',0,0,'C');
   $pdf->Cell(40,$l,'',0,1,'C');
     
   
   
$pdf->Output();


?>