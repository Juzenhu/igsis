<?php 
   
   // INSTALAÇÃO DA CLASSE NA PASTA FPDF.
	require_once("../include/lib/fpdf/fpdf.php");
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


//CONSULTA  (copia inteira em todos os docs)
$id_ped=$_GET['id'];

$ano=date('Y');

$pedido = siscontrat($id_ped);
$pj = siscontratDocs($pedido['IdProponente'],2);
$ex = siscontratDocs($pedido['IdExecutante'],1);
$rep01 = siscontratDocs($pedido['idRepresentante01'],1);
$rep02 = siscontratDocs($pedido['idRepresentante02'],1);

$Objeto = $pedido["Objeto"];
$Periodo = $pedido["Periodo"];
$Duracao = $pedido["Duracao"];
$CargaHoraria = $pedido["CargaHoraria"];
$Local = $pedido["Local"];
$ValorGlobal = dinheiroParaBr($pedido["ValorGlobal"]);
$ValorPorExtenso = valorPorExtenso($pedido["ValorGlobal"]); //VER COMO ESCREVER ISSO
$FormaPagamento = $pedido["FormaPagamento"];
$Justificativa = $pedido["Justificativa"];
$Fiscal = $pedido["Fiscal"];
$Suplente = $pedido["Suplente"];

//PessoaJuridica

$pjRazaoSocial = $pj["Nome"];
$pjNomeArtistico = $pj["NomeArtistico"];
$pjEstadoCivil = $pj["EstadoCivil"];
$pjNacionalidade = $pj["Nacionalidade"];
$pjRG = $pj["RG"];
$pjCPF = $pj["CPF"];
$pjCCM = $pj["CCM"];
$pjOMB = $pj["OMB"];
$pjDRT = $pj["DRT"];
$pjFuncao = $pj["Funcao"];
$pjEndereco = $pj["Endereco"];
$pjTelefones = $pj["Telefones"];
$pjEmail = $pj["Email"];
$pjINSS = $pj["INSS"];
$pjCNPJ = $pj['CNPJ'];

$codPed = "";

// Executante

$exNome = $ex["Nome"];
$exNomeArtistico = $ex["NomeArtistico"];
$exEstadoCivil = $ex["EstadoCivil"];
$exNacionalidade = $ex["Nacionalidade"];
$exRG = $ex["RG"];
$exCPF = $ex["CPF"];
$exCCM = $ex["CCM"];
$exOMB = $ex["OMB"];
$exDRT = $ex["DRT"];
$exFuncao = $ex["Funcao"];
$exEndereco = $ex["Endereco"];
$exTelefones = $ex["Telefones"];
$exEmail = $ex["Email"];
$exINSS = $ex["INSS"];

// Representante01

$rep01Nome = $rep01["Nome"];
$rep01NomeArtistico = $rep01["NomeArtistico"];
$rep01EstadoCivil = $rep01["EstadoCivil"];
$rep01Nacionalidade = $rep01["Nacionalidade"];
$rep01RG = $rep01["RG"];
$rep01CPF = $rep01["CPF"];
$rep01CCM = $rep01["CCM"];
$rep01OMB = $rep01["OMB"];
$rep01DRT = $rep01["DRT"];
$rep01Funcao = $rep01["Funcao"];
$rep01Endereco = $rep01["Endereco"];
$rep01Telefones = $rep01["Telefones"];
$rep01Email = $rep01["Email"];
$rep01INSS = $rep01["INSS"];


// Representante02

$rep02Nome = $rep02["Nome"];
$rep02NomeArtistico = $rep02["NomeArtistico"];
$rep02EstadoCivil = $rep02["EstadoCivil"];
$rep02Nacionalidade = $rep02["Nacionalidade"];
$rep02RG = $rep02["RG"];
$rep02CPF = $rep02["CPF"];
$rep02CCM = $rep02["CCM"];
$rep02OMB = $rep02["OMB"];
$rep02DRT = $rep02["DRT"];
$rep02Funcao = $rep02["Funcao"];
$rep02Endereco = $rep02["Endereco"];
$rep02Telefones = $rep02["Telefones"];
$rep02Email = $rep02["Email"];
$rep02INSS = $rep02["INSS"];

// GERANDO O PDF:
$pdf = new PDF('P','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
$pdf->AliasNbPages();
$pdf->AddPage();

   
$x=20;
$l=7; //DEFINE A ALTURA DA LINHA   

	//Executante
   
   $pdf->SetXY( $x , 40 );// SetXY - DEFINE O X (largura) E O Y (altura) NA PÁGINA

   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(10,5,'(A)',0,0,'L');
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(170,5,'CONTRATADO',0,1,'C');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','I', 10);
   $pdf->Cell(10,10,utf8_decode('(Quando se tratar de grupo, o líder do grupo)'),0,0,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(12,$l,'Nome:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(168,$l,utf8_decode($exNome));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,utf8_decode('Nome Artístico:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(152,$l,utf8_decode($exNomeArtistico));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(23,$l,utf8_decode('Estado Civil:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($exEstadoCivil),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,utf8_decode('Nacionalidade:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(17,$l,utf8_decode($exNacionalidade),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(7,$l,utf8_decode('RG:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($exRG),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(53,$l,utf8_decode($exCPF),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CCM:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($exCCM),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(12,$l,utf8_decode('OMB:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($exOMB),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('DRT:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($exDRT),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,utf8_decode('Função:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($exFuncao),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(20,$l,utf8_decode('Endereço:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(160,$l,utf8_decode($exEndereco));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(17,$l,utf8_decode('Telefone:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(75,$l,utf8_decode($exTelefones),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(13,$l,utf8_decode('E-mail:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($exEmail),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(64,$l,utf8_decode('Inscrição no INSS ou nº PIS / PASEP:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($exINSS),0,1,'L');
   
  
   
   $pdf->SetX($x);
   $pdf->Cell(180,5,'','B',1,'C');
   
   $pdf->Ln();
    
   
	// Proposta   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(10,10,'(B)',0,0,'L');
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(160,10,'PROPOSTA',0,0,'C');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(10,10,$ano."-".$codPed,0,1,'R');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Objeto:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($Objeto));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(27,$l,utf8_decode('Data / Período:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(153,$l,utf8_decode($Periodo));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(82,$l,utf8_decode('Tempo Aproximado de Duração do Espetáculo:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(98,$l,utf8_decode($Duracao));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(27,$l,utf8_decode('Carga Horária:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(180,$l,$CargaHoraria);
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Local:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($Local));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Valor:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($ValorGlobal));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(40,$l,'Forma de Pagamento:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(140,$l,utf8_decode($FormaPagamento));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(25,$l,'Justificativa:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(155,$l,utf8_decode($Justificativa));


//RODAPÉ PERSONALIZADO
   $pdf->SetXY($x,265);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,'Rubrica do Contratato','T',0,'C');
   $pdf->Cell(10,$l,'',0,0,'C');
   $pdf->Cell(50,$l,'Fiscal','T',0,'C');
   $pdf->Cell(10,$l,'',0,0,'C');
   $pdf->Cell(50,$l,'Suplente','T',0,'C');
   

//	QUEBRA DE PÁGINA
$pdf->AddPage('','');

$pdf->SetXY( $x , 35 );// SetXY - DEFINE O X (largura) E O Y (altura) NA PÁGINA

$l=5; //DEFINE A ALTURA DA LINHA  

	//Pessoa Jurídica

$pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(10,5,'(C)',0,0,'L');
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(170,5,utf8_decode('PESSOA JURÍDICA'),0,1,'C');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','I', 9);
   $pdf->Cell(10,10,utf8_decode('(empresário exclusivo SE FOR O CASO)'),0,0,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(33,$l,'Nome da empresa:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(155,$l,utf8_decode($pjRazaoSocial));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CCM:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($pjCCM),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(12,$l,utf8_decode('CNPJ:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($pjCNPJ),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(20,$l,utf8_decode('Endereço:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(160,$l,utf8_decode($pjEndereco));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(17,$l,utf8_decode('Telefone:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(75,$l,utf8_decode($pjTelefones),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(13,$l,utf8_decode('E-mail:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($pjEmail),0,1,'L');
   
   $pdf->Ln();

	//Representante01
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,'Representante:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(155,$l,utf8_decode($rep01Nome));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(23,$l,utf8_decode('Estado Civil:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(67,$l,utf8_decode($rep01EstadoCivil),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(27,$l,utf8_decode('Nacionalidade:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(16,$l,utf8_decode($rep01Nacionalidade),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(8,$l,utf8_decode('RG:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(82,$l,utf8_decode($rep01RG),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(48,$l,utf8_decode($rep01CPF),0,1,'L');
   
   //$pdf->Ln();

	// Representante02
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,7,'Representante:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(155,7,utf8_decode($rep02Nome));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(23,$l,utf8_decode('Estado Civil:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(67,$l,utf8_decode($rep02EstadoCivil),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(27,$l,utf8_decode('Nacionalidade:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(16,$l,utf8_decode($rep02Nacionalidade),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(8,$l,utf8_decode('RG:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(82,$l,utf8_decode($rep02RG),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(48,$l,utf8_decode($rep02CPF),0,1,'L');
   
   
   $pdf->SetX($x);
   $pdf->Cell(180,5,'','B',1,'C');
   
   $pdf->Ln();


$pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(10,5,'(D)',0,0,'L');
   $pdf->SetFont('Arial','B', 12);
   $pdf->Cell(170,5,'PENALIDADES',0,1,'C');
   
   $pdf->Ln();

$pdf->SetX($x);
$pdf->PrintChapter('txt/proposta_padrao_pj.txt');

    
   
   	$pdf->SetX($x);
   	$pdf->MultiCell( 180, 5,
      utf8_decode(
      "DECLARO ESTAR CIENTE DA PENALIDADE PREVISTA NO CAMPO (D).  \n".
      "TODAS AS INFORMAÇÕES PRECEDENTES SÃO FIRMADAS SOB AS PENAS DA LEI."),'T'
   );

   $pdf->Ln();


   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(180,$l,"Data: _________ / _________ / "."$ano".".",0,0,'L');
   
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();

   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(40,$l,'',0,0,'L');
   $pdf->Cell(90,$l,'ASSINATURA','T',0,'C');
   $pdf->Cell(40,$l,'',0,0,'L');

   $pdf->Ln();
   
   //RODAPÉ PERSONALIZADO
   $pdf->SetXY($x,270);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(80,$l,'Carimbo e Assinatura do(a) Fiscal do Contrato','T',0,'C');
   $pdf->Cell(10,$l,'',0,0,'C');
   $pdf->Cell(80,$l,'Carimbo e Assinatura do(a) Suplente do Fiscal','T',0,'C');

//for($i=1;$i<=20;$i++)
   // $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();


?>