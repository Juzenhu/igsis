<?php

require ('../lib/fpdf/fpdf.php');
require ("../conectar.php");

$pdf=new FPDF ('P', 'cm', 'A4');
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$sql="SELECT * FROM pedido_contratacao_pf";

$conexao = mysqli_connect("localhost","root","felix171","siscontratweb");

	If(!$conexao)
	die ("Conexão Geral Falhou</br>".mysqli_error());


$exe_sql=mysqli_query($sql) or die (mysqli_error());

while($resultado=mysqli_fetch_array($exe_sql))
{
	$pdf->Cell($resultado['objeto']);
	$pdf->Cell($resultado['formapagamento']);
}
$pdf->Output();

?>