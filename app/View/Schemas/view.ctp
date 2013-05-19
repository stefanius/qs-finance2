<div class="schemas view">
<h2><?php echo __('Schema');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $schema['Schema']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Nummer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $schema['Schema']['nummer']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Omschrijving'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $schema['Schema']['omschrijving']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Schema'), array('action' => 'edit', $schema['Schema']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Schema'), array('action' => 'delete', $schema['Schema']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $schema['Schema']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Schemas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schema'), array('action' => 'add')); ?> </li>
	</ul>
</div>
