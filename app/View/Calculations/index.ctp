<div class="balans">
	<h2><?php echo __('Journaal');?></h2>
	<table class="table table-striped table-bordered table-condensed">
	<tr>
			<th><?php echo $this->Paginator->sort('grootboek_id');?></th>
			<th><?php echo $this->Paginator->sort('bookyear_id');?></th>
			<th><?php echo $this->Paginator->sort('omschrijving');?></th>
			<th><?php echo $this->Paginator->sort('boekdatum');?></th>
			<th><?php echo $this->Paginator->sort('debet');?></th>
			<th><?php echo $this->Paginator->sort('credit');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($calculations as $calculation):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr>
		<td>
			<?php echo $this->Html->link($calculation['Grootboek']['omschrijving'], array('controller' => 'grootboeks', 'action' => 'view', $calculation['Grootboek']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($calculation['Bookyear']['omschrijving'], array('controller' => 'bookyears', 'action' => 'view', $calculation['Bookyear']['id'])); ?>
		</td>
		<td><?php echo $calculation['Calculation']['omschrijving']; ?>&nbsp;</td>
		<td><?php echo $calculation['Calculation']['boekdatum']; ?>&nbsp;</td>
		<td><?php echo $calculation['Calculation']['debet']; ?>&nbsp;</td>
		<td><?php echo $calculation['Calculation']['credit']; ?>&nbsp;</td>
		<td><?php echo $calculation['Calculation']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $calculation['Calculation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $calculation['Calculation']['id'])); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>