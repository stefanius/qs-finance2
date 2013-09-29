<div class="bankaccounts form">
<?php echo $this->Form->create('Bankaccount'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bankaccount'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('maatschappij');
		echo $this->Form->input('iban');
		echo $this->Form->input('rekeningnummer');
		echo $this->Form->input('grootboek_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Bankaccount.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Bankaccount.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Bankaccounts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Grootboeks'), array('controller' => 'grootboeks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grootboek'), array('controller' => 'grootboeks', 'action' => 'add')); ?> </li>
	</ul>
</div>
