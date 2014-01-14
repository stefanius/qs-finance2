<h1>Balans: <?php echo $balans['Bookyear']['omschrijving']?></h1>

<div id="datepicker-off">
	<a href="#" onmousedown="showdatefilter()">Tijdmachine</a>
</div>

<div id="datepicker-on">
	Selecteer een balansdatum: <input type="text" id="datepicker" value="<?php echo $timemachine_date; ?>">
		</div>	
		
      <div class="tablewrapper">


      <?php echo $this->element('balans', array('side' => 'debet')); ?>
      <?php echo $this->element('balans', array('side' => 'credit')); ?>

      </div>
      

<script>

$(function() {
	
    $( "#datepicker" ).datepicker({
    	dateFormat: 'dd-mm-yy',
    	onSelect: function() {
    			   window.location = "?date="+$("#datepicker").val();
    			  }
    });

    <?php if($open_timemachine): ?>
    	showdatefilter();
    <?php else: ?>
    	hidedatefilter();
    <?php endif; ?>
 });

function showdatefilter(){
	$('#datepicker-on').show();
	$('#datepicker-off').hide();
} 

function hidedatefilter(){
	$('#datepicker-on').hide();
	$('#datepicker-off').show();
}

 function gotoPast(){
	
 }


</script>