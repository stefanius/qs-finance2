<div class="col-md-12">
	<h1>Balans: <?php echo $balans['Bookyear']['omschrijving']?></h1>
	
	
	<form class="form-horizontal" role="form">
		<div class="form-group" id="datepicker-off">
			<div class="col-sm-12">
				<a href="#" onmousedown="showdatefilter()">Tijdmachine</a>
			</div>
		</div>	
		
		<div class="form-group" id="datepicker-on">
			<div class="col-sm-4">
				<span>Selecteer een balansdatum: (<a onmousedown="removedatefilter()">verbergen</a>)</span>
			</div>
		
			<div class="col-sm-2">
				<input type="text" id="datepicker" class="form-control" value="<?php echo $timemachine_date; ?>">
			</div>
			
			<div class="col-sm-6">
			</div>
		</div>	
	</form>	
	<div class="tablewrapper">
		<?php echo $this->element('balans', array('side' => 'debet')); ?>
		<?php echo $this->element('balans', array('side' => 'credit')); ?>	
	</div>
      
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

function removedatefilter(){
	window.location = "?date=false";
}

</script>