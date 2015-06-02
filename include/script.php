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

  </script>
<script>
  $(function() {
    $('#duracao').maskMoney({thousands:'', decimal:'', allowZero:true, suffix: ''});
  })


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


