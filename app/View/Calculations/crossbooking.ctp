<div class="grootboek">
<div id="tabs">
  <ul>
    <li><a href="#debet-tab" id="debet-tab-link">Debet</a></li>
    <li><a href="#credit-tab" id="credit-tab-link">Credit</a></li>
  </ul>
  <?php echo $this->Form->create();?>
  
  <div id="debet-tab">
      <fieldset><legend><?php echo __($info['Grootboek']['display_omschrijving']); ?> :: Debet</legend></fieldset>
	  <?php echo $this->Form->input('Calculation.0.debet',  array('type' => 'text')); ?>
  </div>
  <div id="credit-tab">
      <fieldset><legend><?php echo __($info['Grootboek']['display_omschrijving']); ?> :: Credit</legend></fieldset>    
	  <?php echo $this->Form->input('Calculation.0.credit',  array('type' => 'text')); ?>
  </div>

	<?php
		echo $this->Form->input('Calculation.0.grootboek_id', array('value' => $info['Grootboek']['id'], 'type' => 'hidden' ));
		echo $this->Form->input('Calculation.0.bookyear_id', array('value' =>  $info['Bookyear']['id'], 'type' => 'hidden' ));
		echo $this->Form->input('Calculation.0.omschrijving');
		echo $this->Form->input('Calculation.0.boekdatum', array('type' => 'date'));
		echo $this->Form->input('Calculation.1.grootboek_id');
	?>

  <?php echo $this->Form->end(__('Opslaan'));?>
</div>

  <script>
  $(function() {
    $( "#tabs" ).tabs({

    });
  });
  
  $("#debet-tab-link").click(function (){
        $('#Calculation0Debet').val('');
   });
  
  </script>


	



</div>