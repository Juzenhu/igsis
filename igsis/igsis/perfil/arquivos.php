	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li>
								<a href="#enviar">Enviar</a>
							</li>
							<li><a href="#lista">Arquivos anexados</a></li>
							<li><a href="#services">Services</a></li>
							<li><a href="#works">Works</a></li>
							<li><a href="#contact">Contact</a></li>
							<li>
								<a href="#">Sub Menu</a>
								<ul class="dl-submenu">
									<li><a href="#">Sub menu</a></li>
									<li><a href="#">Sub menu</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /dl-menuwrapper -->
	</div>	
    
    	 <section id="enviar" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Envio de Arquivos</h2>
<p>Nesta página, você envia os arquivos como o rider, mapas de cenas e luz, logos de parceiros, programação de filmes de mostras de cinema, etc. O tamanho máximo do arquivo deve ser 60MB.</p>
<p> Em caso de envio de fotografia, considerar as seguintes especificações técnicas:<br />
- formato: horizontal <br />
- tamanho: mínimo de 300dpi”</p>


<?php

if( isset( $_POST['enviar'] ) ) {

    $pathToSave = 'uploads/';

    // A variavel $_FILES é uma variável do PHP, e é ela a responsável
    // por tratar arquivos que sejam enviados em um formulário
    // Nesse caso agora, a nossa variável $_FILES é um array com 3 dimensoes
    // e teremos de trata-lo, para realizar o upload dos arquivos
    // Quando é definido o nome de um campo no form html, terminado por []
    // ele é tratado como se fosse um array, e por isso podemos ter varios
    // campos com o mesmo nome
    $i = 0;
    $msg = array( );
    $arquivos = array( array( ) );
    foreach(  $_FILES as $key=>$info ) {
        foreach( $info as $key=>$dados ) {
            for( $i = 0; $i < sizeof( $dados ); $i++ ) {
                // Aqui, transformamos o array $_FILES de:
                // $_FILES["arquivo"]["name"][0]
                // $_FILES["arquivo"]["name"][1]
                // $_FILES["arquivo"]["name"][2]
                // $_FILES["arquivo"]["name"][3]
                // para
                // $arquivo[0]["name"]
                // $arquivo[1]["name"]
                // $arquivo[2]["name"]
                // $arquivo[3]["name"]
                // Dessa forma, fica mais facil trabalharmos o array depois, para salvar
                // o arquivo
                $arquivos[$i][$key] = $info[$key][$i];
            }
        }
    }

    $i = 1;

    // Fazemos o upload normalmente, igual no exemplo anterior
    foreach( $arquivos as $file ) {

        // Verificar se o campo do arquivo foi preenchido
        if( $file['name'] != '' ) {
            $arquivoTmp = $file['tmp_name'];
            $arquivo = $pathToSave.$file['name'];
			$arquivo_base = $file['name'];
			if(file_exists($arquivo)){
				echo "O arquivo ".$arquivo_base." já existe! Renomeie e tente novamente<br />";
			}else{
			include "include/conecta_mysql.php";
			$sql = "INSERT INTO ig_arquivos (id_arquivos , nome , evento_id) VALUES( NULL , '$arquivo_base' , '$id_evento' );";
			mysql_query($sql);
			
            if( !move_uploaded_file( $arquivoTmp, $arquivo ) ) {
                $msg[$i] = 'Erro no upload do arquivo '.$i;
            } else {
                $msg[$i] = sprintf('Upload do arquivo %s foi um sucesso!',$i);
            }
			}
       } 
        $i++;
    }

    // Imprimimos as mensagens geradas pelo sistema

 foreach( $msg as $e ) {
	 	echo " <div id = 'mensagem_upload'>";
        printf('%s<br>', $e);
		echo " </div>";
    }

}

?>

<br />
<div class = "center">
<form method='POST' enctype='multipart/form-data'>
<p><input type='file' name='arquivo[]'></p>
<p><input type='file' name='arquivo[]'></p>
 <p><input type='file' name='arquivo[]'></p>
 <p><input type='file' name='arquivo[]'></p>
 <p><input type='file' name='arquivo[]'></p>
 <p><input type='file' name='arquivo[]'></p>
 <p><input type='file' name='arquivo[]'></p>
  <p><input type='file' name='arquivo[]'></p>
  <p><input type='file' name='arquivo[]'></p>
    <br>
    <input type='submit' value='Enviar' name='enviar'>
</form>
</div>


					</div>
				  </div>
			  </div>
			  
		</div>
	</section>

	 <section id="lista" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Arquivos anexados</h2>
<p>Se na lista abaixo, o seu arquivo começar com "http://", por favor, clique, grave em seu computador, faça o upload novamente e apague a ocorrência citada.</p>
    
   <?
if(isset($_POST['apagar'])){
//página 01
$id_arquivo = $_POST["id_arquivo"];
// query para atualizar dados  os dados da página 1 a 3
$ssql = "UPDATE  `ig_arquivos` SET  `evento_id` =  'NULL' WHERE  `ig_arquivos`.`id_arquivos` = '$id_arquivo';";
 
// executa a query
if(mysql_query($ssql)){
	echo "<span class='alerta'>Arquivo deletado!</span>";
	}

}
?> 
					</div>
				  </div>
			  </div>
			  
		</div>
	</section>


