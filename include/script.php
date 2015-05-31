<script type="text/javascript" src="js/autocomplete.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="js/jquery.maskMoney.js" type="text/javascript"></script>
  <script>
  $(function() {
    $( "#datepicker01" ).datepicker();
    $( "#anim" ).change(function() {
      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
    });
  });
    $(function() {
    $( "#datepicker02" ).datepicker();
    $( "#anim" ).change(function() {
      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
    });
  });
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
 

