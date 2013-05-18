<div class="balans">
<?php echo $this->Form->create('Calculation');?>
	<fieldset>
 		<legend><?php __('Journaal Toevoegen'); ?></legend>
	<?php
		echo $this->Form->input('grootboek_id');
		echo $this->Form->input('bookyear_id');
		echo $this->Form->input('omschrijving');
		echo $this->Form->input('boekdatum');
		echo $this->Form->input('debet');
		echo $this->Form->input('credit');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>