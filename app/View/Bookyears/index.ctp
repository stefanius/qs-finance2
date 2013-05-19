<div class="balans">
	<h2><?php echo __('Boekjaren');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('startdatum');?></th>
			<th><?php echo $this->Paginator->sort('einddatum');?></th>
			<th><?php echo $this->Paginator->sort('omschrijving');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($bookyears as $bookyear):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $bookyear['Bookyear']['startdatum']; ?>&nbsp;</td>
		<td><?php echo $bookyear['Bookyear']['einddatum']; ?>&nbsp;</td>
		<td><?php echo $bookyear['Bookyear']['omschrijving']; ?>&nbsp;</td>
		<td><?php echo $bookyear['Bookyear']['created']; ?>&nbsp;</td>
		<td><?php echo $bookyear['Bookyear']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $bookyear['Bookyear']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bookyear['Bookyear']['id'])); ?>
			<?php
				if ($bookyear['allowDelete']==1){
					echo $this->Html->link(__('Delete'), array('action' => 'delete', $bookyear['Bookyear']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $bookyear['Bookyear']['omschrijving'])); 
				}
			?>
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