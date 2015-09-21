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


//CONSULTAS 

$id_ped=$_GET['id'];

function siscotrat(); //colocar os argumentos

function siscotratDocs(); //colocar os argumentos

// colocar função do dinheiro BR e por extenso

$ano=date('Y');


// GERANDO O PDF:
$pdf = new PDF('P','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
$pdf->AliasNbPages();
$pdf->AddPage();

   
$x=20;
$l=7; //DEFINE A ALTURA DA LINHA   
   
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
   $pdf->MultiCell(168,$l,utf8_decode($Nome));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,utf8_decode('Nome Artístico:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(152,$l,utf8_decode($NomeArtistico));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(23,$l,utf8_decode('Estado Civil:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode('estadoCivil'),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,utf8_decode('Nacionalidade:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(17,$l,utf8_decode($Nacionalidade),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(7,$l,utf8_decode('RG:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($RG),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(53,$l,utf8_decode($CPF),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CCM:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($CCM),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(12,$l,utf8_decode('OMB:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($OMB),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('DRT:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($DRT),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,utf8_decode('Função:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($Funcao),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(20,$l,utf8_decode('Endereço:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(160,$l,utf8_decode($Endereco));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(17,$l,utf8_decode('Telefone:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(75,$l,utf8_decode($Telefones),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(13,$l,utf8_decode('E-mail:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($Email),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(64,$l,utf8_decode('Inscrição no INSS ou nº PIS / PASEP:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($INSS),0,1,'L');
   
  
   
   $pdf->SetX($x);
   $pdf->Cell(180,5,'','B',1,'C');
   
   $pdf->Ln();
    
   
   
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
   $pdf->MultiCell(155,$l,utf8_decode($Nome));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CCM:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($CCM),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(12,$l,utf8_decode('CNPJ:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($CNPJ),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(20,$l,utf8_decode('Endereço:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(160,$l,utf8_decode($Endereco));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(17,$l,utf8_decode('Telefone:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(75,$l,utf8_decode($Telefones),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(13,$l,utf8_decode('E-mail:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($Email),0,1,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,'Representante:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(155,$l,utf8_decode($Nome));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(23,$l,utf8_decode('Estado Civil:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(67,$l,utf8_decode($EstadoCivil),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(27,$l,utf8_decode('Nacionalidade:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(16,$l,utf8_decode($Nacionalidade),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(8,$l,utf8_decode('RG:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(82,$l,utf8_decode($RG),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(48,$l,utf8_decode($CPF),0,1,'L');
   
   //$pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,7,'Representante:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(155,7,utf8_decode($Nome));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(23,$l,utf8_decode('Estado Civil:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(67,$l,utf8_decode($Nacionalidade),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(27,$l,utf8_decode('Nacionalidade:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(16,$l,utf8_decode($Nacionalidade),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(8,$l,utf8_decode('RG:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(82,$l,utf8_decode($RG),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(48,$l,utf8_decode($CPF),0,1,'L');
   
   
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
$pdf->PrintChapter('txt/proposta_eventoexterno_pj.txt');

    
   
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