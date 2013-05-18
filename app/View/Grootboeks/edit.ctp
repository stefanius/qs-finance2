<div class="grootboeks form">
<?php echo $this->Form->create('Grootboek');?>
	<fieldset>
 		<legend><?php echo __('Edit Grootboek'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nummer');
		echo $this->Form->input('omschrijving');
		echo $this->Form->input('debetcredit');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Grootboek.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Grootboek.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Grootboeks'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Calculations'), array('controller' => 'calculations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calculation'), array('controller' => 'calculations', 'action' => 'add')); ?> </li>
	</ul>
</div>