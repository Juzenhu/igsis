<script type="text/javascript" src="js/autocomplete.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="js/jquery.maskMoney.js" type="text/javascript"></script>
  <script>

  $(function(){
	$( "#hora" ).mask("99:99");
  });

 
    $(function() {
    $('#valor').maskMoney({thousands:'', decimal:',', allowZero:true, suffix: ''});
  });

  $(function() {
    $('#duracao').maskMoney({thousands:'', decimal:'', allowZero:true, suffix: ''});
  })
  $(function(){
	$("#CEP").mask("99999-999");
  });



</script>

<script type="text/javascript">
	$(document).ready(function(){	$("#CNPJ").mask("99.999.999/9999-99");});
</script>

    <script type="text/javascript">
	$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#CEP').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'ajax_cep.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'CEP=' + $('#CEP').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#Endereco').val(data.rua);
                        $('#Bairro').val(data.bairro);
                        $('#Cidade').val(data.cidade);
                        $('#Estado').val(data.estado);
						$('#Sucesso').val(data.sucesso);
 
                        $('#Numero').focus();
                    }else{
						$('#Sucesso').val(0);
					}
                }
           });   
   return false;    
   })
});
	</script>

 <script type="text/javascript"> 	
 	$(document).ready(function(){
    $('#diaespecial').change(function(){
        var checked = $(this).attr('checked');
        if (checked) { 
           $('.other').show();             
        } else {
            $('.other').hide();
        }
    });        
})
 </script>
 
	<script>
	//funções para calendário	
	  $(function() {
    $( "#datepicker01" ).datepicker({ 
      changeMonth: true,
      changeYear: true
    });
  });

  $(function() {
    $( "#datepicker02" ).datepicker({ 
      changeMonth: true,
      changeYear: true
    });
  });

  $(function() {
    $( "#datepicker03" ).datepicker({ 
      changeMonth: true,
      changeYear: true
    });
  });

  $(function() {
    $( "#datepicker04" ).datepicker({ 
      changeMonth: true,
      changeYear: true
    });
  });

  $(function() {
    $( "#datepicker05" ).datepicker({ 
      changeMonth: true,
      changeYear: true
    });
  });

	//funções para mostrar/esconder
	$('#toggle1').click(function() {
		$('.toggle1').slideToggle('slow');
		return false;
	});	

	$('#toggle2').click(function() {
		$('.toggle2').slideToggle('slow');
		return false;
	});	
	$('#toggle3').click(function() {
		$('.toggle3').slideToggle('slow');
		return false;
	});	
	$('#toggle4').click(function() {
		$('.toggle4').slideToggle('slow');
		return false;
	});	
	$('#toggle5').click(function() {
		$('.toggle5').slideToggle('slow');
		return false;
	});	
  
  </script>



