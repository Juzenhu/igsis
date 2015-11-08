

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>2015 @ Informações Gerais CCSP + Siscontrat DEC / Secretaria Municipal de Cultura / Prefeitura de São Paulo</p>
				</div>
				<div class="col-md-12">
					<?php
if($_SESSION['perfil'] == 1){
echo "<pre>", var_dump($_SESSION), "</pre>";
echo "<pre>", var_dump($_POST), "</pre>";
echo "<pre>", var_dump($_GET), "</pre>";
echo "O limitador de cache esta definido agora como $cache_limiter<br />"; 
echo "As sessões em cache irão expirar em $cache_expire minutos";
}

?>
				</div>
			</div>		
		</div>	
	</footer>
	 
	 <!-- js -->
    <!--<script src="js/jquery.js"></script>-->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.smooth-scroll.min.js"></script>
	<script src="js/jquery.dlmenu.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/custom.js"></script>
  	</body>
