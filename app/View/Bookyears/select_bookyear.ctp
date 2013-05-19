
	
<?php echo $this->Form->create('Calculation', array('action' => 'CalculateBalans')); ?>
	<fieldset>
 		<legend><?php echo __('Select Boekjaar'); ?></legend>
	<?php
		echo $this->Form->input('bookyear_id',array('type'=>'select'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Open Balans'));?>	

