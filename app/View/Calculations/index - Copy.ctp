<div class="calculations index">
	<h2><?php echo __('Calculations');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('grootboek_id');?></th>
			<th><?php echo $this->Paginator->sort('bookyear_id');?></th>
			<th><?php echo $this->Paginator->sort('omschrijving');?></th>
			<th><?php echo $this->Paginator->sort('boekdatum');?></th>
			<th><?php echo $this->Paginator->sort('debet');?></th>
			<th><?php echo $this->Paginator->sort('credit');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
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
	<tr<?php echo $class;?>>
		<td><?php echo $calculation['Calculation']['id']; ?>&nbsp;</td>
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
		<td><?php echo $calculation['Calculation']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $calculation['Calculation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $calculation['Calculation']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $calculation['Calculation']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $calculation['Calculation']['id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Calculation'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Grootboeks'), array('controller' => 'grootboeks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grootboek'), array('controller' => 'grootboeks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bookyears'), array('controller' => 'bookyears', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bookyear'), array('controller' => 'bookyears', 'action' => 'add')); ?> </li>
	</ul>
</div>