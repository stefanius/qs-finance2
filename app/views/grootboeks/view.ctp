<div class="balans">
<h2><?php  __('Grootboek '. $grootboek['Grootboek']['nummer']);?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grootboek['Grootboek']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nummer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grootboek['Grootboek']['nummer']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Omschrijving'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grootboek['Grootboek']['omschrijving']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rekeningtype'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grootboek['Grootboek']['rektype']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Balanszijde'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grootboek['Grootboek']['debetcredit']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php __('Related Calculations');?></h3>
	<?php if (!empty($grootboek['Calculation'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Grootboek Id'); ?></th>
		<th><?php __('Bookyear Id'); ?></th>
		<th><?php __('Omschrijving'); ?></th>
		<th><?php __('Boekdatum'); ?></th>
		<th><?php __('Debet'); ?></th>
		<th><?php __('Credit'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
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
				<?php echo $this->Html->link(__('View', true), array('controller' => 'calculations', 'action' => 'view', $calculation['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'calculations', 'action' => 'edit', $calculation['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'calculations', 'action' => 'delete', $calculation['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $calculation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Calculation', true), array('controller' => 'calculations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
