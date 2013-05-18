<div class="schemas form">
<?php echo $this->Form->create('Schema');?>
	<fieldset>
		<legend><?php __('Edit Schema'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nummer');
		echo $this->Form->input('omschrijving');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Schema.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Schema.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Schemas', true), array('action' => 'index'));?></li>
	</ul>
</div>