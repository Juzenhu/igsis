<?php 
   
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
    // Logo
    $this->Image('../visual/img/logo_dec.JPG',20,20,40);
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
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(180,5,utf8_decode("Folha de Informação nº ___________"),0,1,'R');
   
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(28,$l,utf8_decode("Do processo nº:"),0,0,'L');
   $pdf->Cell(30,$l,utf8_decode("variavel processo"),0,0,'L');
   $pdf->Cell(122,$l,"Data: _______ / _______ / " .$ano.".",0,1,'R');
   
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(30,$l,'INTERESSADO:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($nome));	
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(22,$l,'ASSUNTO:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($objeto));
   
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode("DEC - CONTABILIDADE"),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->Cell(50,$l,utf8_decode("Sr(a). Responsável"),0,1,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->MultiCell(180,$l,utf8_decode("Encaminho o presente a Vossa Senhoria para a necessária reserva de recursos no valor supra citado para o pagamento do cachê que deverá onerar a dotação do FEPAC."));
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,'Valor:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode("R$ ".$valor));
   
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->MultiCell(180,$l,utf8_decode("Após, enviar para DEC/ ___________________________ para prosseguimento."));
   
   $pdf->Ln();
   $pdf->Ln();
   $pdf->Ln();
  
   $pdf->SetX($x);
   $pdf->Cell(180,$l,utf8_decode("São Paulo, ________ de ____________________ de ".$ano."."),0,1,'C');
   
   $pdf->Ln();
   $pdf->Ln();
    
//RODAPÉ PERSONALIZADO
   $pdf->SetXY($x,260);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(40,$l,'',0,0,'C');
   $pdf->Cell(100,$l,'VARIAVEL ASSINATURA',0,0,'C');
   $pdf->Cell(40,$l,'',0,1,'C');
   $pdf->SetX($x);
   $pdf->Cell(40,$l,'',0,0,'C');
   $pdf->Cell(100,$l,'VARIAVEL ASSINATURA-CARGO',0,0,'C');
   $pdf->Cell(40,$l,'',0,1,'C');
     
   
   
$pdf->Output();


?>