<div class="balans">
	<h2><?php __('Overzicht Grootboekrekeningen');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php __('nummer');?></th>
			<th><?php __('omschrijving');?></th>
			<th><?php __('type');?></th>
			<th><?php __('balanszijde');?></th>
			<th class="actions"><?php __('Actions');?></th>
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
		<td><?php echo $grootboek['Grootboek']['nummer']; ?>&nbsp;</td>
		<td><?php echo $grootboek['Grootboek']['omschrijving']; ?>&nbsp;</td>
		<td><?php echo $grootboek['Grootboek']['rektype']; ?>&nbsp;</td>
		<td><?php echo $grootboek['Grootboek']['debetcredit']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $grootboek['Grootboek']['nummer'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $grootboek['Grootboek']['nummer'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $grootboek['Grootboek']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $grootboek['Grootboek']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>