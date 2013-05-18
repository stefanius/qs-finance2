<div class="calculations form">
<?php echo $this->Form->create('Calculation');?>
	<fieldset>
 		<legend><?php __('Edit Calculation'); ?></legend>
	<?php
		echo $this->Form->input('id');
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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Calculation.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Calculation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Calculations', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Grootboeks', true), array('controller' => 'grootboeks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grootboek', true), array('controller' => 'grootboeks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bookyears', true), array('controller' => 'bookyears', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bookyear', true), array('controller' => 'bookyears', 'action' => 'add')); ?> </li>
	</ul>
</div>