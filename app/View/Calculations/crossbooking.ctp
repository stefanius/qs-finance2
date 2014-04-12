<?php echo $this->Html->script('autocomplete');?>
<div class="grootboek">

  <?php echo $this->Form->create();?>
	<?php
		echo $this->Form->input('Calculation.0.grootboek_id', array('value' => $info['Grootboek']['id'], 'type' => 'hidden' ));
		echo $this->Form->input('Calculation.0.bookyear_id', array('value' =>  $info['Bookyear']['id'], 'type' => 'hidden' ));
	?>  
<table>
	<tr>
		<th class="omschrijving" colspan="3">Boeking: <?php echo $grootboek['Grootboek']['omschrijving']?></th>
	</tr>

    <tr>
        <td>Boekdatum</td>
        <td><?php echo $this->Form->input('Calculation.0.boekdatum', array('type' => 'text', 'label'=>false, 'class'=>'custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left ui-autocomplete-input'));?></td>
        <td></td>
    </tr>

    <tr>
        <td>Bedrag Debet</td>
        <td><?php echo $this->Form->input('Calculation.0.debet', 
        		array(  'label'=>false, 
        				'type' => 'text', 
        				'class'=>'ui-widget ui-widget-content ui-state-default ui-corner-left',
        				'placeholder' => 'Leeg in geval van bedrag Credit'));?></td>
        <td></td>
    </tr>  
        
    <tr>
        <td>Bedrag Credit</td>
        <td><?php echo $this->Form->input('Calculation.0.credit', 
        		array(  'label'=>false, 
        			    'type' => 'text', 
        				'class'=>'ui-widget ui-widget-content ui-state-default ui-corner-left',
        				'placeholder' => 'Leeg in geval van bedrag Debet'));?></td>
        <td></td>
    </tr>      
    
    <tr>
        <td>Tegenrekening</td>
        <td><?php echo $this->Form->input('Calculation.1.grootboek_id', array('label'=>false));?></td>
        <td></td>
    </tr>

    <tr>
        <td>Omschrijving</td>
        <td><?php echo $this->Form->input('Calculation.0.omschrijving', array('label'=>false, 'type'=>'textarea', 'class'=>'ui-widget ui-widget-content ui-state-default ui-corner-left')); ?></td>
        <td></td>
    </tr>

    <tr>
        <td></td>
        <td><?php echo $this->Form->submit(__('Opslaan'), array('class'=>'btn-success'));?></td>
        <td></td>
    </tr> 
        
</table>  
  
  <script>

  
  $(function() {
	    $( "#Calculation0Boekdatum" ).datepicker({
	    	dateFormat: 'dd-mm-yy'
	    });
	    $( "#Calculation1GrootboekId" ).combobox();
	    
   });

  
  $('#Calculation0Debet').keypress(function (){
        $('#Calculation0Credit').val('');
   });

  $('#Calculation0Credit').keypress(function (){
      $('#Calculation0Debet').val('');
 });

  $(function() {
	   
  });  


  </script>


	


  

</div>