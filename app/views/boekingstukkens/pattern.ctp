<div class="boekingstukkens index">
	<h2><?php __('Boekingstukkens');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('boekingstuk');?></th>
			<th><?php echo $this->Paginator->sort('omschrijving');?></th>
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
		<td><?php echo $boekingstukken['Boekingstukken']['id']; ?>&nbsp;</td>
		<td><?php echo $boekingstukken['Boekingstukken']['boekingstuk']; ?>&nbsp;</td>
		<td><?php echo $boekingstukken['Boekingstukken']['omschrijving']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $boekingstukken['Boekingstukken']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $boekingstukken['Boekingstukken']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $boekingstukken['Boekingstukken']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $boekingstukken['Boekingstukken']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Boekingstukken', true), array('action' => 'add')); ?></li>
	</ul>
</div>