<div class="bookyears form">
<?php echo $this->Form->create('Bookyear');?>
	<fieldset>
 		<legend><?php echo __('Edit Bookyear'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('startdatum');
		echo $this->Form->input('einddatum');
		echo $this->Form->input('omschrijving');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Bookyear.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Bookyear.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Bookyears'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Calculations'), array('controller' => 'calculations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calculation'), array('controller' => 'calculations', 'action' => 'add')); ?> </li>
	</ul>
</div>