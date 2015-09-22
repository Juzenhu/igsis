<?php 
  
   // INSTALAÇÃO DA CLASSE NA PASTA FPDF.
	require_once("../../include/lib/fpdf/fpdf.php");
	
   //require '../include/';
   require_once("../../funcoes/funcoesConecta.php");
   require_once("../../funcoes/funcoesGerais.php");
   require_once("../../funcoes/funcoesSiscontrat.php");

   //CONEXÃO COM BANCO DE DADOS 
   $conexao = bancoMysqli();


class PDF extends FPDF
{
// Page header
function Header()
{
	session_start(); 
	$inst = recuperaDados("ig_instituicao",$_SESSION['idInstituicao'],"idInstituicao");	
	$logo = "img/".$inst['logo']; // Logo
    $this->Image($logo,20,20,40);
    // Move to the right
    $this->Cell(80);
    $this->Image('img/logo_smc.jpg',170,10);
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

$linha_tabelas = siscontrat($id_ped);

$codPed = $id_ped;
$objeto = $linha_tabelas["Objeto"];
$local = $linha_tabelas["Local"];
$valor = $linha_tabelas["ValorGlobal"];
$formaPagamento = $linha_tabelas["FormaPagamento"];
$periodo = $linha_tabelas["Periodo"];
$duracao = $linha_tabelas["Duracao"];
$cargaHoraria = $linha_tabelas["CargaHoraria"];
$justificativa = $linha_tabelas["Justificativa"];
$fiscal = $linha_tabelas["Fiscal"];
$suplente = $linha_tabelas["Suplente"];
$parecer = $linha_tabelas["ParecerTecnico"];
$observacao = $linha_tabelas["Observacao"];
$dataAtual = date("d/m/Y");
$data_entrega_empenho = exibirDataBr($linha_tabelas['EntregaNE']);
$data_emissao_empenho = exibirDataBr($linha_tabelas['EmissaoNE']);


$linha_tabelas_pessoa = siscontratDocs($linha_tabelas['IdProponente'],1);

$nome = $linha_tabelas_pessoa["Nome"];
$cpf = $linha_tabelas_pessoa["CPF"];
$telefone1 = $linha_tabelas_pessoa["Telefones"];
$telefone2 = $linha_tabelas_pessoa["Telefones"];
$telefone3 = $linha_tabelas_pessoa["Telefones"];
$email = $linha_tabelas_pessoa["Email"];

$setor = $linha_tabelas["Setor"];

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
   $pdf->Cell(60,$l,utf8_decode($numero_empenho),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(25,$l,utf8_decode('Emitida em:'),0,0,'L');
   $pdf->SetFont('Arial','', 12);
   $pdf->Cell(60,$l,utf8_decode($data_emissao_empenho),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(55,$l,utf8_decode('Referente ao processo nº:'),0,0,'L');
   $pdf->SetFont('Arial','', 12);
   $pdf->Cell(60,$l,utf8_decode($numero_processo ),0,1,'L');
   
   
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 12);
   $pdf->MultiCell(180,$l,utf8_decode("São Paulo, ".$data_entrega_empenho));
   
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
   
   
ob_start ();   // Limpa o cachê antes de gerar o arquivo.   
$pdf->Output();


?>