<div class="boekingstukkens form">
<?php echo $this->Form->create('Boekingstukken');?>
	<fieldset>
		<legend><?php __('Add Boekingstukken'); ?></legend>
	<?php
		echo $this->Form->input('boekingstuk');
		echo $this->Form->input('omschrijving');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Boekingstukkens', true), array('action' => 'index'));?></li>
	</ul>
</div>