<div class="grootboeks form">
<?php echo $this->Form->create('Grootboek');?>
	<fieldset>
 		<legend><?php __('Edit Grootboek'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nummer');
		echo $this->Form->input('omschrijving');
		echo $this->Form->input('debetcredit');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Grootboek.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Grootboek.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Grootboeks', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Calculations', true), array('controller' => 'calculations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calculation', true), array('controller' => 'calculations', 'action' => 'add')); ?> </li>
	</ul>
</div>