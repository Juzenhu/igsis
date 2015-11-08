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

/*

MySQL - INNER JOIN com 3 tabelas
SELECT * 
FROM (
    tabela1 INNER JOIN tabela2 
    ON tabela1.coluna1 = tabela2.coluna1
) 
INNER JOIN tabela3 
ON tabela1.coluna2 = tabela3.coluna1


*/
?>