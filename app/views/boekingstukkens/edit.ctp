<div class="boekingstukkens form">
<?php echo $this->Form->create('Boekingstukken');?>
	<fieldset>
		<legend><?php __('Edit Boekingstukken'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('boekingstuk');
		echo $this->Form->input('omschrijving');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Boekingstukken.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Boekingstukken.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Boekingstukkens', true), array('action' => 'index'));?></li>
	</ul>
</div>