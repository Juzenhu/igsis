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
						SELECT 	pedido_contratacao_pf.Id_PedidoContratacaoPF,
								pedido_contratacao_pf.Objeto,
								pedido_contratacao_pf.LocalEspetaculo,
								pedido_contratacao_pf.Valor,
								pedido_contratacao_pf.ValorPorExtenso,
								pedido_contratacao_pf.FormaPagamento,
								pedido_contratacao_pf.Periodo,
								pedido_contratacao_pf.Duracao,
								pedido_contratacao_pf.CargaHoraria,
								pedido_contratacao_pf.Justificativa,
								pedido_contratacao_pf.Fiscal,
								pedido_contratacao_pf.Suplente,
								pedido_contratacao_pf.ParecerTecnico,
								pedido_contratacao_pf.Observacao,
								setor.Setor,
								categoria_contratacao.CategoriaContratacao,
								verba.*,
								pessoa_fisica.*
						FROM pedido_contratacao_pf
						
						INNER JOIN setor
							ON pedido_contratacao_pf.IdSetor = setor.Id_Setor
						INNER JOIN categoria_contratacao
							ON pedido_contratacao_pf.IdCategoria = categoria_contratacao.Id_CategoriaContratacao
						INNER JOIN verba 
							ON pedido_contratacao_pf.IdVerba = verba.Id_Verba
						INNER JOIN pessoa_fisica
							ON pedido_contratacao_pf.IdPessoaFisica = pessoa_fisica.Id_PessoaFisica
						
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
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(180,5,utf8_decode("São Paulo, ________ de ____________________ de ".$ano."."),0,1,'R');
   
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(165,$l,utf8_decode("Memorando nº                  / ".$ano."-"."DEC"),0,1,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode("S.M.C. - SETOR DE AUTUAÇÃO"),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->Cell(50,$l,utf8_decode("Sr(a). Encarregado(a)"),0,1,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->MultiCell(180,$l,utf8_decode("Nos termos da Portaria nº 50/87 - S.M.A. (DOM de 27.08.87), solicitamos a Vossa Senhoria autuar o presente expediente, fornecendo para tanto os seguintes dados:"));
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(25,$l,'Interessado:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($nome));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('RG:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($rg),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($cpf),0,1,'L');
   $pdf->SetFont('Arial','B', 10);
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(20,$l,utf8_decode('Endereço:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(150,$l,utf8_decode($nomeArtistico));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,utf8_decode('Bairro:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($omb),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,utf8_decode('Cidade:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($drt),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,utf8_decode('Estado:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(15,$l,utf8_decode($funcao),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CEP:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(20,$l,utf8_decode($cep),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(17,$l,utf8_decode('Telefone:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($telefone1." / ".$telefone2." / ".$telefone3),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(13,$l,utf8_decode('E-mail:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(60,$l,utf8_decode($email),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(18,$l,'Assunto:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($objeto));
   
   $pdf->Ln();
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->MultiCell(180,$l,utf8_decode("Após autuação, pedimos a Vossa Senhoria, seja o processo encaminhado ao DEC-G/Contratos."));
   
   $pdf->Ln();
   $pdf->Ln();
  
   $pdf->SetX($x);
   $pdf->Cell(180,$l,utf8_decode("Atenciosamente,"),0,1,'C');
   
   $pdf->Ln();
   $pdf->Ln();
    
   $pdf->SetX($x);
   $pdf->Cell(40,5,'',0,0,'C');
   $pdf->Cell(100,5,'','B',0,'C');
   $pdf->Cell(40,5,'',0,1,'C');
   
   $pdf->Ln();
     
   
   
$pdf->Output();


?>