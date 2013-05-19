<div class="boekingstukkens form">
<?php echo $this->Form->create('Boekingstukken');?>
	<fieldset>
		<legend><?php echo __('Add Boekingstukken'); ?></legend>
	<?php
		echo $this->Form->input('boekingstuk');
		echo $this->Form->input('omschrijving');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Boekingstukkens'), array('action' => 'index'));?></li>
	</ul>
</div>