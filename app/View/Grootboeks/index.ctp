<div class="balans">
	<h2><?php echo __('Overzicht Grootboekrekeningen');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('nummer');?></th>
			<th><?php echo __('omschrijving');?></th>
			<th><?php echo __('type');?></th>
			<th><?php echo __('balanszijde');?></th>
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
		<td><?php echo $grootboek['Grootboek']['nummer']; ?>&nbsp;</td>
		<td><?php echo $grootboek['Grootboek']['omschrijving']; ?>&nbsp;</td>
		<td><?php echo $grootboek['Grootboek']['rektype']; ?>&nbsp;</td>
		<td><?php echo $grootboek['Grootboek']['debetcredit']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $grootboek['Grootboek']['nummer'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $grootboek['Grootboek']['nummer'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $grootboek['Grootboek']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $grootboek['Grootboek']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>