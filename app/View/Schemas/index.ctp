<div class="schemas index">
	<h2><?php echo __('Schemas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nummer');?></th>
			<th><?php echo $this->Paginator->sort('omschrijving');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($schemas as $schema):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $schema['Schema']['id']; ?>&nbsp;</td>
		<td><?php echo $schema['Schema']['nummer']; ?>&nbsp;</td>
		<td><?php echo $schema['Schema']['omschrijving']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $schema['Schema']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $schema['Schema']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $schema['Schema']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $schema['Schema']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Schema'), array('action' => 'add')); ?></li>
	</ul>
</div>