<?php 
$tipo = $_GET['tipo'];
switch($tipo){

case 1:

   // INSTALAÇÃO DA CLASSE NA PASTA FPDF.
	require_once("../include/lib/fpdf/fpdf.php");
	
   //require '../include/';
   require_once("../funcoes/funcoesConecta.php");
   require_once("../funcoes/funcoesGerais.php");
   require_once("../funcoes/funcoesSiscontrat.php");

   //CONEXÃO COM BANCO DE DADOS 
   $conexao = bancoMysqli();



class PDF extends FPDF
{
// Page header
function Header()
{
	session_start();
	$inst = recuperaDados("ig_instituicao",$_SESSION['idInstituicao'],"idInstituicao");
	$logo = "../visual/img/".$inst['logo']; 
    // Logo
    $this->Image($logo,20,20,40);
    // Move to the right
    $this->Cell(80);
    $this->Image('../visual/img/logo_smc.jpg',170,10);
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
$valor = "R$".dinheiroParaBr($linha_tabelas["ValorGlobal"])."(".valorPorExtenso(dinheiroParaBr($linha_tabelas["ValorGlobal"])).")";
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
   
   
   $pdf->SetXY( $x , 40 );// SetXY - DEFINE O X (largura) E O Y (altura) NA PÁGINA

   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(180,5,utf8_decode('PEDIDO DE CONTRATAÇÃO DE PESSOA FÍSICA'),0,1,'C');
   
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(100,$l,"","R",0,'R');
   $pdf->Cell(70,5,utf8_decode("Código do Pedido de Contratação"),"T",0,'C');
   $pdf->Cell(10,$l,"","L",1,'R');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(100,$l,"","R",0,'R');
   $pdf->Cell(70,7,utf8_decode("$ano-$id_ped"),"B",0,'C');
   $pdf->Cell(10,$l,"","L",0,'R');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(30,$l,'Setor solicitante:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(150,$l,utf8_decode($setor));
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(12,$l,'Nome:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(168,$l,utf8_decode($nome));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($cpf),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(17,$l,utf8_decode('Telefone:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($telefone1),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(13,$l,utf8_decode('E-mail:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(60,$l,utf8_decode($email),0,1,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Objeto:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($objeto));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(27,$l,utf8_decode('Data / Período:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(153,$l,utf8_decode($periodo));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(82,$l,utf8_decode('Tempo Aproximado de Duração do Espetáculo:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(98,$l,utf8_decode($duracao));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(27,$l,utf8_decode('Carga Horária:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(180,$l,$cargaHoraria);
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Local:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($local));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Valor:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($valor));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(40,$l,'Forma de Pagamento:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(140,$l,utf8_decode($formaPagamento));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(25,$l,'Justificativa:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(155,$l,utf8_decode($justificativa));
   
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
    
//RODAPÉ PERSONALIZADO
   
   $pdf->SetXY($x,265);
   $pdf->SetFont('Arial','', 12);
   $pdf->Cell(80,$l,"Data: "."$dataAtual",0,0,'C');
   $pdf->Cell(10,$l,'',0,0,'C');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(80,$l,'ASSINATURA','T',0,'C');
     
   
ob_start ();   // Limpa o cachê antes de gerar o arquivo.
$pdf->Output();


//Pessoa Jurídica

break;
case 2:
   // INSTALAÇÃO DA CLASSE NA PASTA FPDF.
	require_once("../include/lib/fpdf/fpdf.php");
	
   //require '../include/';
   require_once("../funcoes/funcoesConecta.php");
   require_once("../funcoes/funcoesGerais.php");
   require_once("../funcoes/funcoesSiscontrat.php");

   

class PDF extends FPDF
{
// Page header
function Header()
{
	session_start();
	$inst = recuperaDados("ig_instituicao",$_SESSION['idInstituicao'],"idInstituicao");
	$logo = "../visual/img/".$inst['logo']; 
    // Logo
    $this->Image($logo,20,20,40);
    // Move to the right
    $this->Cell(80);
    $this->Image('../visual/img/logo_smc.jpg',170,10);
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
$valor = dinheiroParaBr($linha_tabelas["ValorGlobal"]);
$valorExtenso = valorPorExtenso($linha_tabelas["ValorGlobal"]);
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


$linha_tabelas_pessoa = siscontratDocs($linha_tabelas['IdProponente'],2);

$razaoSocial = $linha_tabelas_pessoa["Nome"];
$cpf = $linha_tabelas_pessoa["CPF"];
$cnpj = $linha_tabelas_pessoa["CNPJ"];
$telefone1 = $linha_tabelas_pessoa["Telefones"];
$email = $linha_tabelas_pessoa["Email"];

$setor = $linha_tabelas["Setor"];

$ano=date('Y');

// GERANDO O PDF:
$pdf = new PDF('P','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
$pdf->AliasNbPages();
$pdf->AddPage();

   
$x=20;
$l=7; //DEFINE A ALTURA DA LINHA   
   
   
   $pdf->SetXY( $x , 40 );// SetXY - DEFINE O X (largura) E O Y (altura) NA PÁGINA

   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(180,5,utf8_decode('PEDIDO DE CONTRATAÇÃO DE PESSOA JURÍDICA'),0,1,'C');
   
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(100,$l,"","R",0,'R');
   $pdf->Cell(70,5,utf8_decode("Código do Pedido de Contratação"),"T",0,'C');
   $pdf->Cell(10,$l,"","L",1,'R');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(100,$l,"","R",0,'R');
   $pdf->Cell(70,7,utf8_decode("$ano-$id_ped"),"B",0,'C');
   $pdf->Cell(10,$l,"","L",0,'R');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(30,$l,'Setor solicitante:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(150,$l,utf8_decode($setor));
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,utf8_decode('Razão Social:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(152,$l,utf8_decode($razaoSocial));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(13,$l,utf8_decode('CNPJ:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($cnpj),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(17,$l,utf8_decode('Telefone:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($telefone1),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(13,$l,utf8_decode('E-mail:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(60,$l,utf8_decode($email),0,1,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Objeto:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($objeto));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(27,$l,utf8_decode('Data / Período:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(153,$l,utf8_decode($periodo));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(82,$l,utf8_decode('Tempo Aproximado de Duração do Espetáculo:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(98,$l,utf8_decode($duracao));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(27,$l,utf8_decode('Carga Horária:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(180,$l,$cargaHoraria);
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Local:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($local));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Valor:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($valor." (".$valorExtenso." )"));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(40,$l,'Forma de Pagamento:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(140,$l,utf8_decode($formaPagamento));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(25,$l,'Justificativa:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(155,$l,utf8_decode($justificativa));
   
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
    
//RODAPÉ PERSONALIZADO
   
   $pdf->SetXY($x,265);
   $pdf->SetFont('Arial','', 12);
   $pdf->Cell(80,$l,"Data: "."$dataAtual",0,0,'C');
   $pdf->Cell(10,$l,'',0,0,'C');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(80,$l,'ASSINATURA','T',0,'C');
     
   
ob_start ();   // Limpa o cachê antes de gerar o arquivo.   
$pdf->Output();

break;


}
?>