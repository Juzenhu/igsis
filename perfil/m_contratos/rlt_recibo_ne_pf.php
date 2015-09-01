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

// Page footer
/*
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
*/

//INSERIR ARQUIVOS

function ChapterBody($file)
{
    // Read text file
    $txt = file_get_contents($file);
    // Arial 10
    $this->SetFont('Arial','',10);
    // Output justified text
    $this->MultiCell(0,5,$txt);
    // Line break
    $this->Ln();
}

function PrintChapter($file)
{
    $this->ChapterBody($file);
}

}






//CONSULTA 
$id_ped=$_GET['id'];

$sql_query_tabelas ="
						SELECT 	sis_pedido_contratacao_pf.Id_PedidoContratacaoPF,
								sis_pedido_contratacao_pf.Objeto,
								sis_pedido_contratacao_pf.LocalEspetaculo,
								sis_pedido_contratacao_pf.Valor,
								sis_pedido_contratacao_pf.ValorPorExtenso,
								sis_pedido_contratacao_pf.FormaPagamento,
								sis_pedido_contratacao_pf.Periodo,
								sis_pedido_contratacao_pf.Duracao,
								sis_pedido_contratacao_pf.CargaHoraria,
								sis_pedido_contratacao_pf.Justificativa,
								sis_pedido_contratacao_pf.Fiscal,
								sis_pedido_contratacao_pf.Suplente,
								sis_pedido_contratacao_pf.ParecerTecnico,
								sis_pedido_contratacao_pf.Observacao,
								sis_setor.Setor,
								sis_categoria_contratacao.CategoriaContratacao,
								sis_verba.*,
								sis_pessoa_fisica.*
						FROM sis_pedido_contratacao_pf
						
						INNER JOIN sis_setor
							ON sis_pedido_contratacao_pf.IdSetor = sis_setor.Id_Setor
						INNER JOIN sis_categoria_contratacao
							ON sis_pedido_contratacao_pf.IdCategoria = sis_categoria_contratacao.Id_CategoriaContratacao
						INNER JOIN sis_verba 
							ON sis_pedido_contratacao_pf.IdVerba = sis_verba.Id_Verba
						INNER JOIN sis_pessoa_fisica
							ON sis_pedido_contratacao_pf.IdPessoaFisica = sis_pessoa_fisica.Id_PessoaFisica
						
						WHERE Id_PedidoContratacaoPF = $id_ped
					";
					

$consulta_tabelas = mysqli_query($conexao,$sql_query_tabelas);
$linha_tabelas = mysqli_fetch_assoc ($consulta_tabelas);


$codPed = $linha_tabelas["Id_PedidoContratacaoPF"];
$objeto = $linha_tabelas["Objeto"];
$local = $linha_tabelas["LocalEspetaculo"];
$valor = $linha_tabelas["Valor"];
$valorExtenso = $linha_tabelas["ValorPorExtenso"];
$formaPagamento = $linha_tabelas["FormaPagamento"];
$periodo = $linha_tabelas["Periodo"];
$duracao = $linha_tabelas["Duracao"];
$cargaHoraria = $linha_tabelas["CargaHoraria"];
$justificativa = $linha_tabelas["Justificativa"];
$fiscal = $linha_tabelas["Fiscal"];
$suplente = $linha_tabelas["Suplente"];
$parecer = $linha_tabelas["ParecerTecnico"];
$observacao = $linha_tabelas["Observacao"];

$nome = $linha_tabelas["Nome"];
$nomeArtistico = $linha_tabelas["NomeArtistico"];
$estadoCivil = $linha_tabelas["EstadoCivil"];
$nacionalidade = $linha_tabelas["Nacionalidade"];
$rg = $linha_tabelas["RG"];
$cpf = $linha_tabelas["CPF"];
$ccm = $linha_tabelas["CCM"];
$omb = $linha_tabelas["OMB"];
$drt = $linha_tabelas["DRT"];
$funcao = $linha_tabelas["Funcao"];
$numero = $linha_tabelas["Numero"];
$complemento = $linha_tabelas["Complemento"];
$cep = $linha_tabelas["CEP"];
$telefone1 = $linha_tabelas["Telefone1"];
$telefone2 = $linha_tabelas["Telefone2"];
$telefone3 = $linha_tabelas["Telefone3"];
$email = $linha_tabelas["Email"];
$inss = $linha_tabelas["InscricaoINSS"];

$ano=date('Y');


// GERANDO O PDF:
$pdf = new PDF('P','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
$pdf->AliasNbPages();
$pdf->AddPage();

   
$x=20;
$l=7; //DEFINE A ALTURA DA LINHA   
   
   $pdf->SetXY( $x , 45 );// SetXY - DEFINE O X (largura) E O Y (altura) NA PÁGINA

   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 14);
   $pdf->Cell(180,5,utf8_decode("RECIBO DE ENTREGA DE NOTA DE EMPENHO"),0,1,'C');
   
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 12);
   $pdf->MultiCell(180,$l,utf8_decode("Recebi, da Secretaria Municipal de Cultura / "."VARIAVEL UNIDADE"." - "."Contratos Artísticos a:"));
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(45,$l,utf8_decode('Nota de Empenho nº:'),0,0,'L');
   $pdf->SetFont('Arial','', 12);
   $pdf->Cell(60,$l,utf8_decode($email),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(25,$l,utf8_decode('Emitida em:'),0,0,'L');
   $pdf->SetFont('Arial','', 12);
   $pdf->Cell(60,$l,utf8_decode($email),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(55,$l,utf8_decode('Referente ao processo nº:'),0,0,'L');
   $pdf->SetFont('Arial','', 12);
   $pdf->Cell(60,$l,utf8_decode($email),0,1,'L');
   
   
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 12);
   $pdf->MultiCell(180,$l,utf8_decode("São Paulo, "."VARIAVEL DATA DO RECIBO"));
   
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(165,$l,utf8_decode($nome),'T',1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(10,$l,utf8_decode('RG:'),0,0,'L');
   $pdf->SetFont('Arial','', 12);
   $pdf->Cell(50,$l,utf8_decode($rg),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 12);
   $pdf->Cell(50,$l,utf8_decode($cpf),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(13,$l,utf8_decode('E-mail:'),0,0,'L');
   $pdf->SetFont('Arial','', 12);
   $pdf->Cell(60,$l,utf8_decode($email),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(18,$l,'Objeto:',0,0,'L');
   $pdf->SetFont('Arial','', 12);
   $pdf->MultiCell(170,$l,utf8_decode($objeto));
   
   
   
$pdf->Output();


?>