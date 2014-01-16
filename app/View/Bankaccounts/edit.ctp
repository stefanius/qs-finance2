<div class="bankaccounts form">
<?php echo $this->Form->create('Bankaccount'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bankaccount'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('iban');
		echo $this->Form->input('grootboek_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>