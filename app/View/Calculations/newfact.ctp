<div class="grootboek">
<?php echo $this->Form->create('Calculation');?>
	<fieldset>
 		<legend><?php echo __($info['header']); ?></legend>
	<?php
		echo $this->Form->text('grootboek_id', array('value' => $info['Grootboek']['id'], 'type' => 'hidden' ));
		echo $this->Form->text('bookyear_id', array('value' =>  $info['Bookyear']['id'], 'type' => 'hidden' ));
		echo $this->Form->input('omschrijving');
		echo $this->Form->input('boekdatum');
		echo $this->Form->input('debet', array('type' => $info['debetcredit']['d']));
		echo $this->Form->input('credit', array('type' => $info['debetcredit']['c']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>