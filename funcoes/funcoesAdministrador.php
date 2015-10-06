<?php 
	//Verifica erro na string
	//$mysqlii = new mysqlii("localhost", "root", "lic54eca","igsis_beta");
	//if (!$mysqlii->query($sql_inserir)) {
    //printf("Errormessage: %s\n", $mysqlii->error);
	//}

// funções da aba ADICIONAR USUÁRIO

function acessoPerfilUser($tabela,$select,$instituicao){ //gera os options de um select
		$con = bancoMysqli();
		if($instituicao != ""){
		$sql = "SELECT * FROM $tabela WHERE idInstituicao = $instituicao OR idInstituicao = 999";
	}else{
		$sql = "SELECT * FROM ig_papelusuario WHERE idPapelUsuario >= '3'";
	}
	
	$query = mysqli_query($con,$sql);
	while($option = mysqli_fetch_row($query)){
		if($option[0] == $select){
			echo "<option value='".$option[0]."' selected >".$option[1]."</option>";	
		}else{
			echo "<option value='".$option[0]."'>".$option[1]."</option>";	
		}
	}
}

function instituicaoLocal($tabela,$select,$instituicao){ //gera os options de um select
	if($instituicao != ""){
		$sql = "SELECT * FROM $tabela WHERE idInstituicao = $instituicao OR idInstituicao = 999";
	}else{
		$sql = "SELECT * FROM $tabela";   // editar para só adicionar instituicao do LOCAL
	}
	
	$query = mysqli_query($sql);
	while($option = mysqli_fetch_row($query)){
		if($option[0] == $select){
			echo "<option value='".$option[0]."' selected >".$option[1]."</option>";	
		}else{
			echo "<option value='".$option[0]."'>".$option[1]."</option>";	
		}
	}
}

function listaUsuarioAdministrador($idUsuario){ 
	$con = bancoMysqli();
	$sql = "SELECT * FROM ig_usuario WHERE idInstituicao = '$idUsuario' AND publicado = '1'";
	$query = mysqli_query($con,$sql);
	echo "	
	<table class='table table-condensed'>	<div class='col-md-offset-2 col-md-8'>
					<thead>						<tr class='list_menu'> 
							<td>Nome Completo</td>
							<td>Nome Usuário</td>
  							<td>Email</td>
							<td></td>
							<td width='10%'></td>
							<td width='10%'></td>
						 </tr>	
					</thead>
					</div>
					<tbody>";
	while($campo = mysqli_fetch_array($query)){
			echo "<tr>";
			
			//echo "<td class='list_description'>".$campo['nomeCompleto']."</td>";
		//echo "<td class='list_description'>".recuperaIdDado("ig_usuario",$campo['ig_usuario_idUsuario'])."</td>";
			//echo "<td class='list_description'></td>";
			echo "<td class='list_description'>".$campo['nomeCompleto']."</td>";
			echo "<td class='list_description'>".$campo['nomeUsuario']."</td>";
			echo "<td class='list_description'>".$campo['email']."</td>";
			echo "<td class='list_description'></td>";
			echo "
			<td class='list_description'>
			<form method='POST' action='?perfil=administrador&p=novoUser'>
			<input type='hidden' name='carregar' value='".$campo['idUsuario']."' />
			<input type ='submit' class='btn btn-theme btn-block' value='Editar'></td></form>"	;
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

// FUNÇÕES DA ABA ESPAÇO

function geraEspaco($tabela,$select,$instituicao,$publicado){ //gera os options de um select  (( tirei o idInstituição)
	$con = bancoMysqli();
	if($publicado = "1"){
		$sql = "SELECT * FROM $tabela WHERE publicado = $publicado OR publicado = 1";
	}else{
		$sql = "SELECT * FROM ig_espaco";
	}
		$query = mysqli_query($con,$sql);
	while($option = mysqli_fetch_row($query)){
		if($option[0] == $select) {
			echo "<option value='".$option[0]."' selected >".$option[3]."</option>";	
		}else{
			echo "<option value='".$option[0]."'>".$option[3]."</option>";	
		}
	}
}
function espacoExistente ($idUsuario) {
	$con = bancoMysqli();
	$sql = "SELECT * FROM ig_espaco WHERE idEspaco AND publicado = 1";
	  $query = mysqli_query($con,$sql); 
	  	echo " 
		<table class='table table-condensed'>	<div class='col-md-offset-2 col-md-8'>
					<thead>						<tr class='list_menu'> 
							<td>Nome do Espaço</td>
  							<td></td>
							<td width='10%'></td>
							<td width='10%'></td>
					 </tr>	
					</thead>
					</div>
					<tbody>";
					
				echo "<tr>";
					
		while($campo = mysqli_fetch_array($query)){
			echo "<td class='list_description'>".$campo['espaco']."</td>";
			echo "
				<td class='list_description'>
			<form method='POST' action='?perfil=administrador&p=espacos'>
			<input type='hidden' name='apagar' value='".$campo['idEspaco']."' />
			<input type ='submit' class='btn btn-theme  btn-block' value='apagar'></td></form>"	;
			echo "</tr>";		
	  }
	  echo "	</tbody>
				</table>";
}

function listaEventosAdministrador($idUsuario){ 
	$con = bancoMysqli();
	$sql = "SELECT * FROM ig_evento WHERE idUsuario = $idUsuario AND publicado = 0";
	$query = mysqli_query($con,$sql);
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
	while($campo = mysqli_fetch_array($query)){
			echo "<tr>";
			echo "<td class='list_description'>".$campo['nomeEvento']."</td>";
		//	echo "<td class='list_description'>"("ig_tipo_evento",$campo['ig_tipo_evento_idTipoEvento'])."</td>";
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



function listaLogAdministrador($idUsuario){ 
	$con = bancoMysqli();
	$sql = "SELECT * FROM ig_log WHERE idLog";
	$query = mysqli_query($con,$sql);
	echo "<table class='table table-condensed'>
					<thead>
						<tr class='list_menu'>
							<td>Usuário</td>
							<td>Endereço de IP</td>
							<td>data</td>
  							<td>Descrição</td>
							<td></td>
							<td></td>
							<td width='10%'></td>
							<td width='10%'></td>
						</tr>
					</thead>
					<tbody>";
	while($campo = mysqli_fetch_array($query)){
			echo "<tr>";
			//echo "<td class='list_description'>".recuperaIdDado("ig_usuario",$campo['ig_usuario_idUsuario'])."</td>";
			echo "<td class='list_description'>".$campo['enderecoIP']."</td>";
			echo "<td class='list_description'>".$campo['dataLog']."</td>";
			echo "<td class='list_description'>".$campo['descricao']."</td>";
			echo "<td class='list_description'></td>";
			echo " 
			<td class='list_description'>
			<form method='POST' action='?perfil='>
			<input type='hidden' name='carregar' value='".$campo['idLog']."' />
			<input type ='submit' class='btn btn-theme btn-block' value='carregar'></td></form>" ;
			
		/*	echo "
			<td width='15%' class='list_description'>
			<form method='POST' action='?perfil='>
			<input type='hidden' name='apagar' value='".$campo['idLog']."' />
			<input type ='submit' class='btn btn-theme  btn-block' value='apagar'></td></form>"	;
			echo "</tr>";		*/
	}
					
					
		
	echo "	</tbody>
				</table>";
}

// AREA DE MENU'S

function menuLog ($idUsuario) {
?>
 <!-- Menu área !-->
 	<div class="menu-area">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?secao=inicio">Início</a></li>
							<li><a href="?secao=perfil">Perfil de acesso</a></li>
<?//Menu Administrativo!?> <li><a href="#lista"> Perfil Administrativo Local </a>
							<ul class="dl-submenu">
							<li><a href="?perfil=administrador">Voltar para Administrativo</a></li>
							<li><a href="?perfil=administrador&p=novoUser"> Adicionar Usuário</a></li>
							<li><a href="?perfil=administrador&p=users"> Listar Usuários</a></li>
							<li><a href="?perfil=administrador&p=novoEspaco"> Inserir Espaço</a></li>
							<li><a href="?perfil=administrador&p=espacos"> Listar Espaço</a></li>
							<li><a href="?perfil=administrador&p=eventos"> Listar Eventos</a></li>
							<li><a href="?perfil=administrador&p=alteracoes"> Alterações</a></li>
							</li> </ul> <!-- Fim Menu administrativo!--> 
							<li><a href="?secao=ajuda">Ajuda</a></li>
                            <li><a href="../include/logoff.php">Sair</a></li>
							
						</ul>
					</div><!-- /dl-menuwrapper -->
		</div><!-- fim Menu Área !-->
<?php }


function menuEventos ($idUsuario) {
	?>
 <!-- Menu área !-->
 	<div class="menu-area">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?secao=inicio">Início</a></li>
							<li><a href="?secao=perfil">Perfil de acesso</a></li>
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


function menuEspacos ($idUsuario) {
	?>
<!-- Menu área !-->
 	<div class="menu-area">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?secao=inicio">Início</a></li>
							<li><a href="?secao=perfil">Perfil de acesso</a></li>
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


function menuNovoEspaco ($idUsuario) { ?>
	<!-- Menu área !-->
 	<div class="menu-area">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?secao=inicio">Início</a></li>
							<li><a href="?secao=perfil">Perfil de acesso</a></li>
<?//Menu Administrativo!?> <li><a href="#lista"> Perfil Administrativo Local </a>
							<ul class="dl-submenu">
							<li><a href="?perfil=administrador">Voltar para Administrativo</a></li>
							<li><a href="?perfil=administrador&p=novoUser"> Adicionar Usuário</a></li>
							<li><a href="?perfil=administrador&p=users"> Listar Usuários</a></li>
							<li><a href="?perfil=administrador&p=espacos"> Listar Espaço</a></li>
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


function menuNovoUser ($idUsuario) { ?>
	<!-- Menu área !-->
 	<div class="menu-area">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?secao=inicio">Início</a></li>
							<li><a href="?secao=perfil">Perfil de acesso</a></li>
<?//Menu Administrativo!?> <li><a href="#lista"> Perfil Administrativo Local </a>
							<ul class="dl-submenu">
							<li><a href="?perfil=administrador">Voltar para Administrativo</a></li>
							<li><a href="?perfil=administrador&p=users"> Listar Usuários</a></li>
							<li><a href="?perfil=administrador&p=novoEspaco"> Inserir Espaço</a></li>
							<li><a href="?perfil=administrador&p=espacos"> Listar Espaço</a></li>
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

function menuUsers ($idUsuario) { ?>
<!-- Menu área !-->
 	<div class="menu-area">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?secao=inicio">Início</a></li>
							<li><a href="?secao=perfil">Perfil de acesso</a></li>
<?//Menu Administrativo!?> <li><a href="#lista"> Perfil Administrativo Local </a>
							<ul class="dl-submenu">
							<li><a href="?perfil=administrador">Voltar para Administrativo</a></li>
							<li><a href="?perfil=administrador&p=novoUser"> Adicionar Usuário</a></li>
							<li><a href="?perfil=administrador&p=novoEspaco"> Inserir Espaço</a></li>
							<li><a href="?perfil=administrador&p=espacos"> Listar Espaço</a></li>
							<li><a href="?perfil=administrador&p=eventos"> Listar Eventos</a></li>
							<li><a href="?perfil=administrador&p=logsLocais"> Logs Locais</a></li>
							<li><a href="?perfil=administrador&p=alteracoes"> Alterações</a></li>
							</li> </ul> <!-- Fim Menu administrativo!--> 
							<li><a href="?secao=ajuda">Ajuda</a></li>
                            <li><a href="../include/logoff.php">Sair</a></li>
							
						</ul>
					</div><!-- /dl-menuwrapper -->
		</div>
<!-- fim Menu Área !-->
<?php }

function menuInicio ($idUsuario) { ?>
<!-- Menu área !-->
	<div class="menu-area">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?secao=inicio">Início</a></li>
							<li><a href="?secao=perfil">Perfil de acesso</a></li>
<?//Menu Administrativo!?> <li><a href="#lista"> Perfil Administrativo Local </a>
							<ul class="dl-submenu">
							<li><a href="?perfil=administrador&p=novoUser"> Adicionar Usuário</a></li>
							<li><a href="?perfil=administrador&p=users"> Listar Usuários</a></li>
							<li><a href="?perfil=administrador&p=novoEspaco"> Inserir Espaço</a></li>
							<li><a href="?perfil=administrador&p=espacos"> Listar Espaço</a></li>
							<li><a href="?perfil=administrador&p=eventos"> Listar Eventos</a></li>
							<li><a href="?perfil=administrador&p=logsLocais"> Logs Locais</a></li>
							<li><a href="?perfil=administrador&p=alteracoes"> Alterações</a></li>
							</li> </ul> <!-- Fim Menu administrativo!--> 
							<li><a href="?secao=ajuda">Ajuda</a></li>
                            <li><a href="../include/logoff.php">Sair</a></li>
							
						</ul>
					</div><!-- /dl-menuwrapper -->
		</div>
<!-- fim Menu Área !-->
<?php }

function menuAlteracoes ($idUsuario) {
?> 
<!-- Menu área !-->
 	<div class="menu-area">
					<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="?secao=inicio">Início</a></li>
							<li><a href="?secao=perfil">Perfil de acesso</a></li>
<?//Menu Administrativo!?> <li><a href="#lista"> Perfil Administrativo Local </a>
							<ul class="dl-submenu">
							<li><a href="?perfil=administrador">Voltar para Administrativo</a></li>
							<li><a href="?perfil=administrador&p=novoUser"> Adicionar Usuário</a></li>
							<li><a href="?perfil=administrador&p=users"> Listar Usuários</a></li>
							<li><a href="?perfil=administrador&p=novoEspaco"> Inserir Espaço</a></li>
							<li><a href="?perfil=administrador&p=espacos"> Listar Espaço</a></li>
							<li><a href="?perfil=administrador&p=eventos"> Listar Eventos</a></li>
							<li><a href="?perfil=administrador&p=logsLocais"> Logs Locais</a></li>
							</li> </ul> <!-- Fim Menu administrativo!--> 
							<li><a href="?secao=ajuda">Ajuda</a></li>
                            <li><a href="../include/logoff.php">Sair</a></li>
							
						</ul>
					</div>//<!-- /dl-menuwrapper -->
		</div><!-- fim Menu Área !-->

<?php		}

?>

