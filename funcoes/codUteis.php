<? 
// Códigos Úteis

//Verifica erro na string
$mysqli = new mysqli("localhost", "root", "lic54eca","igsis_beta");
if (!$mysqli->query($sql_inserir)) {
printf("Errormessage: %s\n", $mysqli->error);
}

//Exibe erros PHP
@ini_set('display_errors', '1');
error_reporting(E_ALL); 


?>