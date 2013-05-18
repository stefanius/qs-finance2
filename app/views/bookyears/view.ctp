<div class="balans">
<h2><?php  __('Boekjaar');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bookyear['Bookyear']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Startdatum'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bookyear['Bookyear']['startdatum']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Einddatum'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bookyear['Bookyear']['einddatum']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Omschrijving'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bookyear['Bookyear']['omschrijving']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bookyear['Bookyear']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bookyear['Bookyear']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php __('Verwante Journaalposten');?></h3>
	<?php if (!empty($bookyear['Calculation'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Boekingstuk'); ?></th>
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
		foreach ($bookyear['Calculation'] as $calculation):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $calculation['boekingstuk'];?></td>
			<td><?php echo $calculation['omschrijving'];?></td>
			<td><?php echo $calculation['boekdatum'];?></td>
			<td class="geld"><?php echo $calculation['debet'];?></td>
			<td class="geld"><?php echo $calculation['credit'];?></td>
			<td><?php echo $calculation['created'];?></td>
			<td><?php echo $calculation['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'calculations', 'action' => 'view', $calculation['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'calculations', 'action' => 'edit', $calculation['id'])); ?>
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
