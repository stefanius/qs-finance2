
	  <h1>Balans: <?php echo $balans['Bookyear']['omschrijving']?></h1>
		
		<div id="datepicker-off">
			<a href="#" onmousedown="showdatefilter()">Tijdmachine</a>
		</div>
		
		<div id="datepicker-on">
			Selecteer een balansdatum: <input type="text" id="datepicker" value="<?php echo date('d-m-Y'); ?>">
		</div>	
		
      <div class="tablewrapper">


      <?php echo $this->element('balans', array('side' => 'debet')); ?>
      <?php echo $this->element('balans', array('side' => 'credit')); ?>

      </div>
      

<script>

function showdatefilter(){
	$('#datepicker-on').show();
	$('#datepicker-off').hide();
}


$(function() {
		$('#datepicker-on').hide();
		
	    $( "#datepicker" ).datepicker({
	    	dateFormat: 'dd-mm-yy'
	    });
	    
 });


</script>