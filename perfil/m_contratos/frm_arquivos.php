<?php
$con = bancoMysqli();
$idPessoa = $_REQUEST['idPessoa'];
$tipoPessoa = $_REQUEST['tipoPessoa'];

if(isset($_POST['executante'])){ 
	$form = "<form method='POST' action='?perfil=contratos&p=frm_edita_executante&id_pf=$idPessoa' />
			<input type='hidden' name='executante' value='1'>
	";
	$p = "executante";
	
}

if(isset($_POST['representante'])){ 
	$form = "<form method='POST' action='?perfil=contratos&p=frm_edita_representantelegal&id_rep=$idPessoa' />
				<input type='hidden' name='representante' value='1'>
";
	$p = "representante";

}

if(isset($_POST['fisica'])OR ($_GET['tipoPessoa'] == 1)){
	$form = "<form method='POST' action='?perfil=contratos&p=frm_edita_pf&id_pf=$idPessoa' />
				<input type='hidden' name='fisica' value='1'>
";
	$p = "fisica";

}

if(isset($_POST['juridica']) OR ($_GET['tipoPessoa'] == 2)){
	$form = "<form method='POST' action='?perfil=contratos&p=frm_edita_pj&id_pj=$idPessoa' />
				<input type='hidden' name='juridica' value='1'>
";
	$p = "juridica";

}



if(isset($_POST["enviar"])){

$sql_arquivos = "SELECT * FROM igsis_upload_docs";
$query_arquivos = mysqli_query($con,$sql_arquivos);
while($arq = mysqli_fetch_array($query_arquivos)){ 
	$y = $arq['idTipoDoc'];
	$x = $arq['sigla'];
	$nome_arquivo = $_FILES['arquivo']['name'][$x];
	if($nome_arquivo != ""){
	$nome_temporario = $_FILES['arquivo']['tmp_name'][$x];
    //$ext = strtolower(substr($nome_arquivo[$i],-4)); //Pegando extensão do arquivo
      $new_name = date("YmdHis")."_". $nome_arquivo; //Definindo um novo nome para o arquivo
	  $hoje = date("Y-m-d H:i:s");
      $dir = '../uploadsdocs/'; //Diretório para uploads
	  
      if(move_uploaded_file($nome_temporario, $dir.$new_name)){
		  
		$sql_insere_arquivo = "INSERT INTO `igsis_arquivos_pessoa` (`idArquivosPessoa`, `idTipoPessoa`, `idPessoa`, `arquivo`, `dataEnvio`, `publicado`, `tipo`) 
		VALUES (NULL, '$tipoPessoa', '$idPessoa', '$new_name', '$hoje', '1', '$y'); ";
		$query = mysqli_query($con,$sql_insere_arquivo);
		if($query){
		$mensagem = "Arquivo recebido com sucesso";
		}else{
		$mensagem = "Erro ao gravar no banco";
		}
		
		}else{
		 $mensagem = "Erro no upload"; 
		  
	  }
	}
	
}

}


if(isset($_POST['apagar'])){
	$idArquivo = $_POST['apagar'];
	$sql_apagar_arquivo = "UPDATE igsis_arquivos_pessoa SET publicado = 0 WHERE idArquivosPessoa = '$idArquivo'";
	if(mysqli_query($con,$sql_apagar_arquivo)){
		$arq = recuperaDados("igsis_arquivos_pessoa",$idArquivo,"idArquivosPessoa");
		$mensagem =	"Arquivo ".$arq['arquivo']."apagado com sucesso!";
		gravarLog($sql_apagar_arquivo);
	}else{
		$mensagem = "Erro ao apagar o arquivo. Tente novamente!";
	}
}
$campo = recuperaPessoa($_REQUEST['idPessoa'],$_REQUEST['tipoPessoa']); 

?>
<?php include 'includes/menu.php';?>

    
    	 <section id="enviar" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
                                        <h2><?php echo $campo["nome"] ?>  </h2>
                                        <p><?php echo $campo["tipo"] ?></p>
					 <h3>Envio de Arquivos</h3>
                     <p><?php if(isset($mensagem)){echo $mensagem;} ?></p>
<p>Nesta página, você envia documentos digitalizados. O tamanho máximo do arquivo deve ser 60MB.</p>
<p><b>Um nome de arquivo não pode conter nenhum dos seguintes caracteres: \ / | < > * : “ & ‘ @ { } [ ] , $ = ! – # ( ) % . + ~ ou qualquer tipo de acentuação: ^ ´ ` ' ¨ Ç </b></p>


<br />
<div class = "center">
<form method="POST" action="?perfil=contratos&p=frm_arquivos&id=<?php echo $idPessoa ?>&tipo=<?php echo $tipoPessoa; ?>" enctype="multipart/form-data">
<table>
<tr>
<td width="50%"><td>
</tr>
<?php 
$sql_arquivos = "SELECT * FROM igsis_upload_docs";
$query_arquivos = mysqli_query($con,$sql_arquivos);
while($arq = mysqli_fetch_array($query_arquivos)){ ?>

<tr>
<td><label><?php echo $arq['documento']?></label></td><td><input type='file' name='arquivo[<?php echo $arq['sigla']; ?>]'></td>
</tr>
	
<?php } ?>

  </table>
    <br>
    <input type="hidden" name="idPessoa" value="<?php echo $idPessoa; ?>"  />
    <input type="hidden" name="tipoPessoa" value="<?php echo $tipoPessoa; ?>"  />
	<input type='hidden' name='<?php echo $p; ?>' value='1' />
    <input type="hidden" name="enviar" value="1"  />
    <input type="submit" class="btn btn-theme btn-lg btn-block" value='Enviar'>
</form>
</div>
<br />
<div class="center">



<?php echo $form ?>	

    <input type="hidden" name="idPessoa" value="<?php echo $idPessoa; ?>"  />
    <input type="hidden" name="tipoPessoa" value="<?php echo $tipoPessoa; ?>"  />
    
    <input type="submit" class="btn btn-theme btn-block" value='Voltar ao Cadastro de Pessoa'>
</form>
</div>
<br />
<?php if($_SESSION['idPedido'] != ""){ ?>
<div class="center">
<?php 
if($_GET['tipoPessoa'] == 1){
?>
<form method="POST" action="?perfil=contratos&p=frm_edita_pedidocontratacaopf&id_ped=<?php echo $_SESSION['idPedido']; ?>" >
<?php }else{ ?>
<form method="POST" action="?perfil=contratos&p=frm_edita_pedidocontratacaopj&id_ped=<?php echo $_SESSION['idPedido']; ?>" >

<?php } ?>
    <input type="hidden" name="idPessoa" value="<?php echo $idPessoa; ?>"  />
    <input type="hidden" name="tipoPessoa" value="<?php echo $tipoPessoa; ?>"  />
    <input type="submit" class="btn btn-theme btn-block" value='Voltar ao Pedido'>
</form>
</div>
<?php } ?>


					</div>
				  </div>
                  
			  </div>
			  
		</div>
	</section>

	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
 <h2>Arquivos anexados</h2>
<h5>Se na lista abaixo, o seu arquivo começar com "http://", por favor, clique, grave em seu computador, faça o upload novamente e apague a ocorrência citada.</h5>
					</div>
			<div class="table-responsive list_info">
                         <?php listaArquivosPessoaSiscontrat($idPessoa,$tipoPessoa,$_SESSION['idPedido'],$p); ?>
			</div>
				  </div>
			  </div>  


		</div>
	</section>
