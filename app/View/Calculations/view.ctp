<div class="balans">
<h2><?php echo __('Journaalpost');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $calculation['Calculation']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Bookyear'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($calculation['Bookyear']['omschrijving'], array('controller' => 'bookyears', 'action' => 'view', $calculation['Bookyear']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Grootboek Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($calculation['Grootboek']['nummer'], array('controller' => 'grootboeks', 'action' => 'view', $calculation['Grootboek']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Grootboek Oms.'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($calculation['Grootboek']['omschrijving'], array('controller' => 'grootboeks', 'action' => 'view', $calculation['Grootboek']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Boekingstuk'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($calculation['Calculation']['boekingstuk'], array('controller' => 'calculations', 'action' => 'listbyboekingstuk', $calculation['Calculation']['boekingstuk'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Omschrijving'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $calculation['Calculation']['omschrijving']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Boekdatum'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $calculation['Calculation']['boekdatum']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Debet'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $calculation['Calculation']['debet']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Credit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $calculation['Calculation']['credit']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $calculation['Calculation']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $calculation['Calculation']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Calculation'), array('action' => 'edit', $calculation['Calculation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Calculation'), array('action' => 'delete', $calculation['Calculation']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $calculation['Calculation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Calculations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calculation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grootboeks'), array('controller' => 'grootboeks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grootboek'), array('controller' => 'grootboeks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bookyears'), array('controller' => 'bookyears', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bookyear'), array('controller' => 'bookyears', 'action' => 'add')); ?> </li>
	</ul>
</div>

-->
