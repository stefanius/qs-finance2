<div class="schemas form">
<?php echo $this->Form->create('Schema');?>
	<fieldset>
		<legend><?php __('Add Schema'); ?></legend>
	<?php
		echo $this->Form->input('nummer');
		echo $this->Form->input('omschrijving');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Schemas', true), array('action' => 'index'));?></li>
	</ul>
</div>