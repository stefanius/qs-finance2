<div class=grootboek">
	<h2><?php __('Lijst van Boekingstukken');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php __('boekingstuk');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($boekingstukkens as $boekingstukken):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $boekingstukken['Calculation']['boekingstuk']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('controller' => 'calculations' , 'action' => 'listbyboekingstuk', $boekingstukken['Calculation']['boekingstuk'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
