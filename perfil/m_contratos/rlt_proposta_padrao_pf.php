<?php

// Início Detalhes do relatório

require("../conectar.php");

$key=$_GET['key'];

$consulta_tabelas_rlt = mysqli_query ($conexao,
"SELECT pedido_contratacao_pf.*, pessoa_fisica.*, setor.*, categoria_contratacao.*, verba.*
FROM pedido_contratacao_pf 
	INNER JOIN pessoa_fisica 
			ON pedido_contratacao_pf.IdPessoaFisica = pessoa_fisica.Id_PessoaFisica
	INNER JOIN setor
			ON pedido_contratacao_pf.IdSetor = setor.Id_Setor
	INNER JOIN categoria_contratacao
			ON pedido_contratacao_pf.IdCategoria = categoria_contratacao.Id_CategoriaContratacao
	INNER JOIN verba
			ON  pedido_contratacao_pf.IdVerba = verba.Id_Verba
WHERE Id_PedidoContratacaoPF = $key");

$linha_tabelas_rlt= mysqli_fetch_assoc($consulta_tabelas_rlt);

$consulta_tabela_assinatura = mysqli_query ($conexao, "SELECT Assinatura from assinatura");
$linha_tabela_assinatura = mysqli_fetch_assoc($consulta_tabela_assinatura);

// Fim dos detalhes


include("../lib/mpdf/mpdf.php");

$mpdf=new mPDF('c','A4','','',32,25,40,35,10,10); 

$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins

$header = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="33%" align="left"><img src="../img/logo_dec.jpg" /></td>
<td width="33%" align="center"></td>
<td width="33%" align="right"><img src="../img/logo_smc.jpg" /></td>
</tr></table>
';
$headerE = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="33%" align="left"><img src="../img/logo_dec.jpg" /></td>
<td width="33%" align="center"></td>
<td width="33%" align="right"><img src="../img/logo_smc.jpg" /></td>
</tr></table>
';

$footer = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="33%" align="center">Rubrica do Contratato</td>
<td width="33%" align="center">Fical</td>
<td width="33%" align="center">Suplente</td>
</tr></table>
';
$footerE = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="50%" align="center">Carimbo e Assinatura do(a) Fiscal do Contrato</td>
<td width="50%" align="center">Carimbo e Assinatura do(a) Suplente do Fiscal</td>
</tr></table>
';


$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLHeader($headerE,'E');
$mpdf->SetHTMLFooter($footer);
$mpdf->SetHTMLFooter($footerE,'E');


$html = '
<p>(A)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>CONTRATADO</strong></p>
        <p><font size="-1">(Quando se tratar de grupo, o líder do grupo)</font></p>
        <p><strong>Nome:</strong> </p>
        <p><strong>Nome Artístico:</strong> </p>
        <p><strong>Estado Civil:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <strong>Nacionalidade:</strong> </p>
        <p><strong>RG:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <strong>CPF:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <strong>CCM:</strong> </p>
        <p><strong>OMB:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <strong>DRT:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <strong>Função:</strong> </p>
        <p><strong>Endereço:</strong> </p>
        <p><strong>Bairro:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <strong>Cidade:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <strong>Estado:</strong> </p>
        <p><strong>CEP:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <strong>Telefone:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <strong>E-mail:</strong> </p>
        <p><strong>Inscrição no INSS ou nº PIS / PASEP:</strong> </p>
        
        <hr/>
        
<p>(B)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>PROPOSTA</strong></p>
        <p><strong>Objeto:</strong> </p>
        <p><strong>Data/Período:</strong> </p>
        <p><strong>Tempo Aproximado de Duração do Espetáculo:</strong> </p>
        <p><strong>Carga Horária:</strong> </p>
        <p><strong>Local:</strong> </p>
        <p><strong>Valor:</strong> </p>
        <p><strong>Forma de Pagamento:</strong> </p>
        <p><strong>Justificativa:</strong> </p>        

        
<!-- Fim da Primeira Página-->

<pagebreak />

<!-- Início da Segunda Página -->

<p>(C)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>PENALIDADES</strong></p>
<p align="justify">O CONTRATADO INCORRERÁ EM MULTA DE: </p>
<p align="justify">5% (CINCO POR CENTO) PARA CASOS DE INFRAÇÃO DE CLÁUSULA CONTRATUAL COMO DESOBEDECER ÀS DETERMINAÇÕES DA FISCALIZAÇÃO OU DESRESPEITAR MUNÍCIPES OU FUNCIONÁRIOS MUNICIPAIS.</p>
<p align="justify">10% (DEZ POR CENTO) PARA CASOS DE INEXECUÇÃO PARCIAL </p>
<p align="justify">20 % (VINTE POR CENTO) PARA CASOS DE INEXECUÇÃO TOTAL.</p>
<p align="justify">O VALOR DA MULTA SERÁ CALCULADO SOBRE O VALOR DO CONTRATO OU NOTA DE EMPENHO, QUANDO ESTA O SUBSTITUIR.</p>
                <hr/>
                <p align="justify">DECLARO ESTAR CIENTE DA PENALIDADE PREVISTA NO CAMPO (C)<br/>
TODAS AS INFORMAÇÕES PRECEDENTES SÃO FIRMADAS SOB AS PENAS DA LEI</p>
                <p align="justify">&nbsp;</p>
                <p align="justify">&nbsp;</p>
                <p align="justify">DATA: _______ / _______ / _______.</p>
                <p align="justify">&nbsp;</p>
                <p align="justify">&nbsp;</p>
                <p align="justify">&nbsp;</p>
                <p align="justify">&nbsp;</p>
<p align="center">ASSINATURA</p>

<!--Fim da Segunda Página-->
';


$mpdf->WriteHTML($html);

$mpdf->Output();
exit;

?>