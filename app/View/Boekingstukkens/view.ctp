<div class="boekingstukkens view">
<h2><?php echo __('Boekingstukken');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $boekingstukken['Boekingstukken']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Boekingstuk'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $boekingstukken['Boekingstukken']['boekingstuk']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Omschrijving'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $boekingstukken['Boekingstukken']['omschrijving']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Boekingstukken'), array('action' => 'edit', $boekingstukken['Boekingstukken']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Boekingstukken'), array('action' => 'delete', $boekingstukken['Boekingstukken']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $boekingstukken['Boekingstukken']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Boekingstukkens'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Boekingstukken'), array('action' => 'add')); ?> </li>
	</ul>
</div>
