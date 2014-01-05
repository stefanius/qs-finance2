
	<h2><?php echo __('Overzicht Grootboekrekeningen');?></h2>
	<table class="table table-striped table-bordered table-condensed">
	<tr>
			<th><?php echo __('#');?></th>
			<th><?php echo __('Omschrijving');?></th>
			<th><?php echo __('Soort');?></th>
			<th><?php echo __('Zijde');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($grootboeks as $grootboek):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="number"><?php echo $grootboek['Grootboek']['nummer']; ?>&nbsp;</td>
		<td class="omschrijving"><?php echo $grootboek['Grootboek']['omschrijving']; ?>&nbsp;</td>
		<td><?php echo ucfirst($grootboek['Grootboek']['rektype']); ?>&nbsp;</td>
		<td><?php echo ucfirst($grootboek['Grootboek']['debetcredit']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Bekijk'), array('action' => 'view', $grootboek['Grootboek']['nummer'])); ?>
			<?php echo $this->Html->link(__('Bewerk'), array('action' => 'edit', $grootboek['Grootboek']['nummer'])); ?>
			<?php if(!in_array($grootboek['Grootboek']['id'], $usedGrootboeks)): ?>
				<?php echo $this->Html->link(__('Verwijderen'), array('action' => 'delete', $grootboek['Grootboek']['id']), null, sprintf(__('Weet je zeker dat je de post "%s" wilt verwijderen? \nDeze actie is onomkeerbaar!'), $grootboek['Grootboek']['omschrijving'])); ?>
			<?php endif; ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
