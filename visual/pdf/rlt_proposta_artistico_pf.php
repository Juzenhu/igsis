<?php

// PRIMEIRAMENTE: INSTALEI A CLASSE NA PASTA FPDF DENTRO DE MEU SITE.
define('FPDF_FONTPATH','../lib/fpdf/font/'); 

// INSTALA AS FONTES DO FPDF
require('../lib/fpdf/fpdf.php'); 

// INSTALA A CLASSE FPDF
class PDF extends FPDF {

// CRIA UMA EXTENSÃO QUE SUBSTITUI AS FUNÇÕES DA CLASSE. 
// SOMENTE AS FUNÇÕES QUE ESTÃO DENTRO DESTE EXTENDS É QUE SERÃO SUBSTITUIDAS.


    function Header(){ //CABECALHO
        global $codigo; // EXEMPLO DE UMA VARIAVEL QUE TERÁ O MESMO VALOR EM QUALQUER ÁREA DO PDF.
        $l=5; // DEFINI ESTA VARIAVEL PARA ALTURA DA LINHA
        $this->SetXY(10,10); // SetXY - DEFINE O X E O Y NA PAGINA
        $this->Rect(10,10,190,280); // CRIA UM RETÂNGULO QUE COMEÇA NO X = 10, Y = 10 E 
                                    //TEM 190 DE LARGURA E 280 DE ALTURA. 
                                    //NESTE CASO, É UMA BORDA DE PÁGINA.

        $this->Image('../img/logo_dec.JPG',11,17,40); // INSERE UMA LOGOMARCA NO PONTO X = 11, Y = 11, E DE TAMANHO 40.
        $this->SetFont('Arial','B',8); // DEFINE A FONTE ARIAL, NEGRITO (B), DE TAMANHO 8

        $this->Cell(170,15,'INSIRA SEU TEXTO AQUI',0,0,'L'); 
        // CRIA UMA CELULA COM OS SEGUINTES DADOS, RESPECTIVAMENTE: 
        // LARGURA = 170, 
        // ALTURA = 15, 
        // TEXTO = 'INSIRA SEU TEXTO AQUI'
        // BORDA = 0. SE = 1 TEM BORDA SE 'R' = RIGTH, 'L' = LEFT, 'T' = TOP, 'B' = BOTTOM
        // QUEBRAR LINHA NO FINAL = 0 = NÃO
        // ALINHAMENTO = 'L' = LEFT

        $this->Image('../img/logo_smc.jpg',170,11); 
        // CRIA UMA CELULA DA MESMA FORMA ANTERIOR MAS COM ALTURA DEFINIDA PELA VARIAVEL $l E 
        // INSERINDO UMA VARIÁVEL NO TEXTO.

        $this->Ln(); // QUEBRA DE LINHA

        $this->Cell(190,10,'',0,0,'L');
        $this->Ln();
        $l = 17;
        $this->SetFont('Arial','B',12);
        $this->SetXY(10,15);
        $this->Cell(190,$l,'TITULO','B',1,'C');
        $l=5;
        $this->SetFont('Arial','B',10);
        $this->Cell(20,$l,'Dados 1:',0,0,'L');
        $this->Cell(100,$l,'','B',0,'L');
        $this->Cell(35,$l,'',0,0,'L');
        $this->Cell(15,$l,'Data:',0,0,'L');
        $this->Cell(20,$l,date('d/m/Y'),'B',0,'L'); // INSIRO A DATA CORRENTE NA CELULA

        $this->Ln();
        $this->Cell(20,$l,'Dados 2:',0,0,'L');
        $this->Cell(100,$l,'','B',0,'L');
        $this->Ln();
        $this->Cell(20,$l,'Dados 3:',0,0,'L');
        $this->Cell(100,$l,'','B',0,'L');
        $this->Cell(35,$l,'',0,0,'L');
        $this->Cell(15,$l,'Dados 4:',0,0,'L');
        $this->Cell(20,$l,'','B',0,'L');
        $this->Ln();

        //FINAL DO CABECALHO COM DADOS
        //ABAIXO É CRIADO O TITULO DA TABELA DE DADOS

        $this->Cell(190,2,'',0,0,'C'); 
        //ESPAÇAMENTO DO CABECALHO PARA A TABELA
        $this->Ln();

        $this->SetTextColor(255,255,255);
        $this->Cell(190,$l,'Titulo 1',1,0,'C',1);
        $this->Ln();

        //TITULO DA TABELA DE SERVIÇOS
        $this->SetFillColor(232,232,232);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',8);
        $this->Cell(10,$l,'Titulo 1',1,0,'L',1);
        $this->Cell(31,$l,'Titulo 2',1,0,'l',1);
        $this->Cell(70,$l,'Titulo 3',1,0,'L',1);
        $this->Cell(12,$l,'Titulo 4',1,0,'C',1);
        $this->Cell(12,$l,'Titulo 5',1,0,'C',1);
        $this->Cell(40,$l,'Titulo 6',1,0,'C',1);
        $this->Cell(15,$l,'Titulo 7',1,0,'C',1);
        $this->Ln();

    }

    function Footer(){ // CRIANDO UM RODAPE

        $this->SetXY(15,280);
        $this->Rect(10,270,190,20);
        $this->SetFont('Arial','',10);
        $this->Cell(70,8,'Assinatura ','T',0,'L');
        $this->Cell(40,8,' ',0,0,'L');
        $this->Cell(70,8,'Assinatura','T',0,'L'); 
        $this->Ln();
        $this->SetFont('Arial','',7);
        $this->Cell(190,7,'Página '.$this->PageNo().' de {nb}',0,0,'C');
  
    }


}

//CONECTE SE AO BANCO DE DADOS SE PRECISAR 
include("../conectar.php"); // A MINHA CONEXÃO FICOU EM CONFIG.PHP

$pdf=new PDF('P','mm','A4'); //CRIA UM NOVO ARQUIVO PDF NO TAMANHO A4
$pdf->AddPage(); // ADICIONA UMA PAGINA
$pdf->AliasNbPages(); // SELECIONA O NUMERO TOTAL DE PAGINAS, USADO NO RODAPE
$pdf->SetFont('Arial','',8);
$y = 59; // AQUI EU COLOCO O Y INICIAL DOS DADOS 

$sql = "select * from tabela"; //SELECAO DOS DADOS QUE IRÃO PRO PDF
$result = mysql_query($sql);
$l=5; // ALTURA DA LINHA
while($row = mysql_fetch_array($result)) {
// ENQUANTO OS DADOS VÃO PASSANDO, O FPDF VAI INSERINDO OS DADOS NA PAGINA

    $dados1 = $row["0"];
    $dados2 = utf8_decode($row["1"]); // NESTE CASO, EU DECODIFIQUEI OS DADOS, POIS É UM CAMPO DE     TEXTO.
    $dados3 = $row["2"];
    $dados4 = $row["3"];
    $dados5 = $row["4"];
    $dados6 = $row["5"];
    $dados7 = $row["6"];

    $l = 5 * contaLinhas($dados2,48); 
    // Eu criei a função "contaLinhas" para contar quantas linhas um campo pode conter se tiver largura = 48


    if($y + $l >= 230){           // 230 É O TAMANHO MAXIMO ANTES DO RODAPE

        $pdf->AddPage();   // SE ULTRAPASSADO, É ADICIONADO UMA PÁGINA
        $y=59;             // E O Y INICIAL É RESETADO

    }

    //DADOS
    $pdf->SetY($y);
    $pdf->SetX(10);
    $pdf->Rect(10,$y,70,$l);
    $pdf->MultiCell(70,6,$dados2,0,2); // ESTA É A CELULA QUE PODE TER DADOS EM MAIS DE UMA LINHA
    $pdf->SetFont('Arial','',6);
    $pdf->SetY($y);
    $pdf->SetX(20);
    $pdf->Rect(20,$y,31,$l);
    $pdf->MultiCell(31,6,$dados1,0,2);
    $pdf->SetY($y);
    $pdf->SetX(51);
    $pdf->Rect(51,$y,10,$l);
    $pdf->MultiCell(10,5,$dados3,0,2);
    $pdf->SetY($y);
    $pdf->SetX(121);
    $pdf->Rect(121,$y,12,$l);
    $pdf->MultiCell(12,6,$dados4,0,2,'C');
    $pdf->SetY($y);
    $pdf->SetX(133);
    $pdf->Rect(133,$y,12,$l);
    $pdf->MultiCell(12,6,$dados5,0,2,'C');
    $pdf->SetY($y);
    $pdf->SetX(145);
    $pdf->Rect(145,$y,40,$l);
    $pdf->MultiCell(40,6,$dados6,0,2,'C');
    $pdf->SetY($y);
    $pdf->SetX(185);
    $pdf->Rect(185,$y,15,$l);
    $pdf->MultiCell(15,6,$dados7,0,2,'C');
    $pdf->Ln();
    $y += $l;


}

mysql_close(); // FECHA A CONEXÃO COM MYSQL
$pdf->Output(); // IMPRIME O PDF NA TELA
Header('Pragma: public'); // ESTA FUNÇÃO É USADA PELO FPDF PARA PUBLICAR NO IE
?>