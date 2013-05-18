<div class="links form">
<?php echo $this->Form->create('Link');?>
	<fieldset>
 		<legend><?php __('Add Link'); ?></legend>
	<?php
		echo $this->Form->input('url');
		echo $this->Form->input('naam');
		echo $this->Form->input('omschrijving');
		echo $this->Form->input('Section');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Links', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Sections', true), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section', true), array('controller' => 'sections', 'action' => 'add')); ?> </li>
	</ul>
</div>