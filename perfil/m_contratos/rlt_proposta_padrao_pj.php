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


//CONSULTA PARA PEDIDO CONTRATAÇÃO
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
$objeto = $linha_tabela_pedcontpj["Objeto"];
$local = $linha_tabela_pedcontpj["LocalEspetaculo"];
$valor = $linha_tabela_pedcontpj["Valor"];
$valorExtenso = $linha_tabela_pedcontpj["ValorPorExtenso"];
$formaPagamento = $linha_tabela_pedcontpj["FormaPagamento"];
$periodo = $linha_tabela_pedcontpj["Periodo"];
$duracao = $linha_tabela_pedcontpj["Duracao"];
$cargaHoraria = $linha_tabela_pedcontpj["CargaHoraria"];
$justificativa = $linha_tabela_pedcontpj["Justificativa"];
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

$razaoSocial = $linha_tabelas_pj_pedcontratacao["RazaoSocial"];
$ccmPJ = $linha_tabelas_pj_pedcontratacao["CCM"];
$cnpj = $linha_tabelas_pj_pedcontratacao["CNPJ"];
$telefone1PJ = $linha_tabelas_pj_pedcontratacao["Telefone1"];
$telefone2PJ = $linha_tabelas_pj_pedcontratacao["Telefone2"];
$telefone3PJ = $linha_tabelas_pj_pedcontratacao["Telefone3"];
$emailPJ = $linha_tabelas_pj_pedcontratacao["Email"];


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

$nome = $linha_tabelas_pf_pedcontratacao["Nome"];
$nomeArtistico = $linha_tabelas_pf_pedcontratacao["NomeArtistico"];
$estadoCivil = $linha_tabelas_pf_pedcontratacao["EstadoCivil"];
$nacionalidade = $linha_tabelas_pf_pedcontratacao["Nacionalidade"];
$rg = $linha_tabelas_pf_pedcontratacao["RG"];
$cpf = $linha_tabelas_pf_pedcontratacao["CPF"];
$ccm = $linha_tabelas_pf_pedcontratacao["CCM"];
$omb = $linha_tabelas_pf_pedcontratacao["OMB"];
$drt = $linha_tabelas_pf_pedcontratacao["DRT"];
$funcao = $linha_tabelas_pf_pedcontratacao["Funcao"];
$numero = $linha_tabelas_pf_pedcontratacao["Numero"];
$complemento = $linha_tabelas_pf_pedcontratacao["Complemento"];
$cep = $linha_tabelas_pf_pedcontratacao["CEP"];
$telefone1 = $linha_tabelas_pf_pedcontratacao["Telefone1"];
$telefone2 = $linha_tabelas_pf_pedcontratacao["Telefone2"];
$telefone3 = $linha_tabelas_pf_pedcontratacao["Telefone3"];
$email = $linha_tabelas_pf_pedcontratacao["Email"];
$inss = $linha_tabelas_pf_pedcontratacao["InscricaoINSS"];


//CONSULTA PARA REPRESENTANTE LEGAL

$sql_query_tabelas_representantelegal_pedcontratacao ="
						SELECT 	sis_pedido_contratacao_pj.Id_PedidoContratacaoPJ,
								sis_representante_legal.*
						FROM sis_pedido_contratacao_pj		
						INNER JOIN sis_representante_legal
							ON sis_pedido_contratacao_pj.IdRepresentanteLegal1 = sis_pessoa_fisica.Id_RepresentanteLegal
						WHERE Id_PedidoContratacaoPJ = $id_ped
					";
					

$consulta_tabelas_representantelegal_pedcontratacao = mysqli_query($conexao,$sql_query_tabelas_representantelegal_pedcontratacao);
$linha_tabelas_representantelegal_pedcontratacao = mysqli_fetch_assoc ($consulta_tabelas_representantelegal_pedcontratacao);



//VARIÁVEIS PARA REPRESENTANTE LEGAL

$representante = $linha_tabelas_representantelegal_pedcontratacao["RepresentanteLegal"];
$estadoCivilREP = $linha_tabelas_representantelegal_pedcontratacao["EstadoCivil"];
$nacionalidadeREP = $linha_tabelas_representantelegal_pedcontratacao["Nacionalidade"];
$rgREP = $linha_tabelas_representantelegal_pedcontratacao["RG"];
$cpfREP = $linha_tabelas_representantelegal_pedcontratacao["CPF"];



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
   $pdf->Cell(15,$l,'Nome:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(165,$l,utf8_decode($nome));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(30,$l,utf8_decode('Nome Artístico:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(150,$l,utf8_decode($nomeArtistico));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(25,$l,utf8_decode('Estado Civil:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($nacionalidade),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,utf8_decode('Nacionalidade:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(15,$l,utf8_decode($nacionalidade),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('RG:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($rg),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($cpf),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CCM:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($ccm),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(12,$l,utf8_decode('OMB:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($omb),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('DRT:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($drt),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(15,$l,utf8_decode('Função:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($funcao),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(20,$l,utf8_decode('Endereço:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(160,$l,utf8_decode($nomeArtistico));
   
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
   $pdf->Cell(60,$l,utf8_decode($email),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(64,$l,utf8_decode('Inscrição no INSS ou nº PIS / PASEP:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(45,$l,utf8_decode($inss),0,1,'L');
   
  
   
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
   $pdf->MultiCell(155,$l,utf8_decode($razaoSocial));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CCM:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($ccmPJ),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(12,$l,utf8_decode('CNPJ:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($cnpj),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(20,$l,utf8_decode('Endereço:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(160,$l,utf8_decode($nomeArtistico));
   
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
   $pdf->Cell(65,$l,utf8_decode($telefone1PJ." / ".$telefone2PJ." / ".$telefone3PJ),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(13,$l,utf8_decode('E-mail:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(60,$l,utf8_decode($email),0,1,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,'Representante:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(155,$l,utf8_decode($representante));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(25,$l,utf8_decode('Estado Civil:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($estadoCivilREP),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,utf8_decode('Nacionalidade:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(15,$l,utf8_decode($nacionalidadeREP),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(8,$l,utf8_decode('RG:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(80,$l,utf8_decode($rgREP),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($cpfREP),0,1,'L');
   
   $pdf->Ln();
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,'Representante:',0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->MultiCell(155,$l,utf8_decode($nome));
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(25,$l,utf8_decode('Estado Civil:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(65,$l,utf8_decode($nacionalidade),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(28,$l,utf8_decode('Nacionalidade:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(15,$l,utf8_decode($nacionalidade),0,1,'L');
   
   $pdf->SetX($x);
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(8,$l,utf8_decode('RG:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(80,$l,utf8_decode($rg),0,0,'L');
   $pdf->SetFont('Arial','B', 10);
   $pdf->Cell(10,$l,utf8_decode('CPF:'),0,0,'L');
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(50,$l,utf8_decode($cpf),0,1,'L');
   
   
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
$pdf->PrintChapter('penalidades.txt');

   
   $pdf->SetX($x);
   $pdf->Cell(180,1,'','T',1,'C');
   
   $pdf->Ln();
    
   
   	$pdf->SetX($x);
   	$pdf->MultiCell( 180, 6,
      utf8_decode(
      "DECLARO ESTAR CIENTE DA PENALIDADE PREVISTA NO CAMPO (C).  \n".
      "TODAS AS INFORMAÇÕES PRECEDENTES SÃO FIRMADAS SOB AS PENAS DA LEI.")
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
   $pdf->Ln();
   $pdf->Ln();

   $pdf->SetX($x);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(40,$l,'',0,0,'L');
   $pdf->Cell(90,$l,'ASSINATURA','T',0,'C');
   $pdf->Cell(40,$l,'',0,0,'L');

   $pdf->Ln();
   
   //RODAPÉ PERSONALIZADO
   $pdf->SetXY($x,265);
   $pdf->SetFont('Arial','', 10);
   $pdf->Cell(80,$l,'Carimbo e Assinatura do(a) Fiscal do Contrato','T',0,'C');
   $pdf->Cell(10,$l,'',0,0,'C');
   $pdf->Cell(80,$l,'Carimbo e Assinatura do(a) Suplente do Fiscal','T',0,'C');

//for($i=1;$i<=20;$i++)
   // $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();


?>