<?php

include "../include/conecta_mysql.php";
$get = $_GET['cli_codigo'];
$sql = "SELECT * FROM ig_responsavel WHERE nomeResponsavel ='$get'";
$query = mysql_query($sql);
$campo = mysql_fetch_array($query);

if($query){
echo "
 
          		<div class='col-md-offset-2 col-md-6'>
            		<label>Email</label>
            		<input type='text' name='emailResponsavel' class='form-control' id='' value='".$campo['emailResponsavel']."' />
           		</div>
            	<div class='col-md-6'>
            		<label>Telefone</label>
            		<input type='text' name='telResponsavel' class='form-control' id='".$campo['telResponsavel']."' />
            	</div>
 
";
}else{
echo "
          		<div class='col-md-offset-2 col-md-6'>
            		<label>Email</label>
            		<input type='text' name='emailResponsavel' class='form-control' id='' value='' />
           		</div>
            	<div class='col-md-6'>
            		<label>Telefone</label>
            		<input type='text' name='telResponsavel' class='form-control' id='' />
            	</div>
  

";
}

?>