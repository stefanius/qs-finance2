<div class="grootboeks view">
<h2><?php echo __('Grootboek');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grootboek['Grootboek']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Nummer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grootboek['Grootboek']['nummer']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Omschrijving'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grootboek['Grootboek']['omschrijving']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Debetcredit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grootboek['Grootboek']['debetcredit']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Grootboek'), array('action' => 'edit', $grootboek['Grootboek']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Grootboek'), array('action' => 'delete', $grootboek['Grootboek']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $grootboek['Grootboek']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Grootboeks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grootboek'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Calculations'), array('controller' => 'calculations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calculation'), array('controller' => 'calculations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Calculations');?></h3>
	<?php if (!empty($grootboek['Calculation'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Grootboek Id'); ?></th>
		<th><?php echo __('Bookyear Id'); ?></th>
		<th><?php echo __('Omschrijving'); ?></th>
		<th><?php echo __('Boekdatum'); ?></th>
		<th><?php echo __('Debet'); ?></th>
		<th><?php echo __('Credit'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($grootboek['Calculation'] as $calculation):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $calculation['id'];?></td>
			<td><?php echo $calculation['grootboek_id'];?></td>
			<td><?php echo $calculation['bookyear_id'];?></td>
			<td><?php echo $calculation['omschrijving'];?></td>
			<td><?php echo $calculation['boekdatum'];?></td>
			<td><?php echo $calculation['debet'];?></td>
			<td><?php echo $calculation['credit'];?></td>
			<td><?php echo $calculation['created'];?></td>
			<td><?php echo $calculation['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'calculations', 'action' => 'view', $calculation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'calculations', 'action' => 'edit', $calculation['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'calculations', 'action' => 'delete', $calculation['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $calculation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Calculation'), array('controller' => 'calculations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
