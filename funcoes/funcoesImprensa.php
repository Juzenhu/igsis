<?php 
	//Verifica erro na string
	//$mysqli = new mysqli("localhost", "root", "lic54eca","igsis_beta");
	//if (!$mysqli->query($sql_inserir)) {
    //printf("Errormessage: %s\n", $mysqli->error);
	//}

// funções da aba ADICIONAR USUÁRIO

function listaNaoRevisado($idUsuario){ 
	$sql = "SELECT * FROM ig_usuario WHERE idInstituicao = '$idUsuario' AND publicado = '1'";
	$query = mysql_query($sql);
	echo "<table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td>Cod. Igsis</td>
							<td>Nome do Evento</td>
  							<td>Enviado Por</td>
							<td>Data Inicio</td>
							<td width='10%'></td>
							<td width='10%'></td>
						</tr>
					</thead>
					<tbody>";
	while($campo = mysql_fetch_array($query)){
			echo "<tr>";
			
			echo "<td class='list_description'>".$campo['nomeEvento']."</td>";
			echo "<td class='list_description'>".recuperaIdDado("ig_usuario",$campo['ig_usuario_idUsuario'])."</td>";
			echo "<td class='list_description'></td>";
			echo "<td class='list_description'>".$campo['nomeCompleto']."</td>";
			echo "<td class='list_description'>".$campo['nomeUsuario']."</td>";
			echo "<td class='list_description'>".$campo['email']."</td>";
			echo "<td class='list_description'></td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=administrador&p=novoUser'>
			<input type='hidden' name='carregar' value='".$campo['idUsuario']."' />
			<input type ='submit' class='btn btn-theme btn-block' value='recuperar'></td></form>"	;
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=administrador&p=users'>
			<input type='hidden' name='apagar' value='".$campo['idUsuario']."' />
			<input type ='submit' class='btn btn-theme  btn-block' value='apagar'></td></form>"	;
			echo "</tr>";		
	}
			echo " </tbody>
				</table>"; 
}

function listaEditadoNaoRevisado($idUsuario){ 
	$sql = "SELECT * FROM ig_usuario WHERE idInstituicao = '$idUsuario' AND publicado = '1'";
	$query = mysql_query($sql);
	echo "<table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td>Cod</td>
							<td>Nome do Evento</td>
  							<td>Enviado Por</td>
							<td>Data Inicio</td>
							<td width='10%'></td>
							<td width='10%'></td>
						</tr>
					</thead>
					<tbody>";
	while($campo = mysql_fetch_array($query)){
			echo "<tr>";
			
			echo "<td class='list_description'>".$campo['nomeEvento']."</td>";
			echo "<td class='list_description'>".recuperaIdDado("ig_usuario",$campo['ig_usuario_idUsuario'])."</td>";
			echo "<td class='list_description'></td>";
			echo "<td class='list_description'>".$campo['nomeCompleto']."</td>";
			echo "<td class='list_description'>".$campo['nomeUsuario']."</td>";
			echo "<td class='list_description'>".$campo['email']."</td>";
			echo "<td class='list_description'></td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=administrador&p=novoUser'>
			<input type='hidden' name='carregar' value='".$campo['idUsuario']."' />
			<input type ='submit' class='btn btn-theme btn-block' value='recuperar'></td></form>"	;
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=administrador&p=users'>
			<input type='hidden' name='apagar' value='".$campo['idUsuario']."' />
			<input type ='submit' class='btn btn-theme  btn-block' value='apagar'></td></form>"	;
			echo "</tr>";		
	}
			echo " </tbody>
				</table>"; 
}

function listaev($idUsuario){ 
	$sql = "SELECT * FROM ig_evento WHERE idUsuario = $idUsuario AND publicado = 0";
	$query = mysql_query($sql);
	echo "<table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td>Nome do evento</td>
							<td>Tipo de evento</td>
  							<td></td>
							<td width='10%'></td>
							<td width='10%'></td>
						</tr>
					</thead>
					<tbody>";
	while($campo = mysql_fetch_array($query)){
			echo "<tr>";
			echo "<td class='list_description'>".$campo['nomeEvento']."</td>";
			echo "<td class='list_description'>".recuperaIdDado("ig_tipo_evento",$campo['ig_tipo_evento_idTipoEvento'])."</td>";
			echo "<td class='list_description'></td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=evento&p=basica'>
			<input type='hidden' name='carregar' value='".$campo['idEvento']."' />
			<input type ='submit' class='btn btn-theme btn-block' value='recuperar'></td></form>"	;
			
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=administrador&p=eventos'>
			<input type='hidden' name='apagar' value='".$campo['idEvento']."' />
			<input type ='submit' class='btn btn-theme  btn-block' value='apagar'></td></form>"	;
			echo "</tr>";		
	}
	echo "					</tbody>
				</table>";
}




// AREA DE MENU'S

function menuRelatorioAlteracoes ($idUsuario) {
?>
 <!-- Menu área !-->
 	<div class="menu-area">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?secao=inicio">Início</a></li>
							<li><a href="?secao=perfil">Perfil de acesso</a></li>
<?//Menu Administrativo!?> <li><a href="#lista"> Comunicação </a>
							<ul class="dl-submenu">
							<li><a href="?perfil=comunicao&p=aquicolocaracase"> Relatório de Alterações </a></li>
							<li><a href="?perfil=comunicao&p=aquicolocaracase"> Módulo Cinema</a></li>
							<li><a href="?perfil=comunicao&p=aquicolocaracase"> Registro / Documentação </a></li>
							</li> </ul> <!-- Fim Menu administrativo!--> 
							<li><a href="?secao=ajuda">Ajuda</a></li>
                            <li><a href="../include/logoff.php">Sair</a></li>
							
						</ul>
					</div><!-- /dl-menuwrapper -->
		</div><!-- fim Menu Área !-->
<?php }


function menuModoCinema ($idUsuario) {
	?>
 <!-- Menu área !-->
 	<div class="menu-area">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?secao=inicio">Início</a></li>
<?//Menu Administrativo!?> <li><a href="#lista"> Perfil Administrativo Local </a>
							<ul class="dl-submenu">
							<li><a href="?perfil=administrador">Voltar para Administrativo</a></li>
							<li><a href="?perfil=administrador&p=novoUser"> Adicionar Usuário</a></li>
							<li><a href="?perfil=administrador&p=users"> Listar Usuários</a></li>
							<li><a href="?perfil=administrador&p=novoEspaco"> Inserir Espaço</a></li>
							<li><a href="?perfil=administrador&p=espacos"> Listar Espaço</a></li>
							<li><a href="?perfil=administrador&p=logsLocais"> Logs Locais</a></li>
							<li><a href="?perfil=administrador&p=alteracoes"> Alterações</a></li>
							</li> </ul> <!-- Fim Menu administrativo!--> 
							<li><a href="?secao=ajuda">Ajuda</a></li>
                            <li><a href="../include/logoff.php">Sair</a></li>
							
						</ul>
					</div><!-- /dl-menuwrapper -->
		</div><!-- fim Menu Área !-->	
<?php }


function menuRegistroDocumentacao ($idUsuario) {
	?>
<!-- Menu área !-->
 	<div class="menu-area">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?secao=inicio">Início</a></li>
<?//Menu Administrativo!?> <li><a href="#lista"> Perfil Administrativo Local </a>
							<ul class="dl-submenu">
							<li><a href="?perfil=administrador">Voltar para Administrativo</a></li>
							<li><a href="?perfil=administrador&p=novoUser"> Adicionar Usuário</a></li>
							<li><a href="?perfil=administrador& p=users"> Listar Usuários</a></li>
							<li><a href="?perfil=administrador&p=novoEspaco"> Inserir Espaço</a></li>
							<li><a href="?perfil=administrador&p=eventos"> Listar Eventos</a></li>
							<li><a href="?perfil=administrador&p=logsLocais"> Logs Locais</a></li>
							<li><a href="?perfil=administrador&p=alteracoes"> Alterações</a></li>
							</li> </ul> <!-- Fim Menu administrativo!--> 
							<li><a href="?secao=ajuda">Ajuda</a></li>
                            <li><a href="../include/logoff.php">Sair</a></li>
							
						</ul>
					</div><!-- /dl-menuwrapper -->
		</div><!-- fim Menu Área !-->
<?php }

function listaComunicacao($orderCampo,$sentido,$pagina,$limite){
	if($orderCampo != ""){
		$order = "ORDER BY ".$ordemCampo." ".$sentido; //ORDER BY 
	}else{
		$order = "";
	}
	
	$regInicial = ($pagina - 1)*$limite;
	$limit = " LIMIT ".$reginicial.",".$limite;
	
	// LIMIT $regInicial,$limite
	$sql = "SELECT * FROM ig_comunicacao $order $limit";
	
		
	
}

?>

