<div class="bankaccounts index">
	<h2><?php echo __('Bankaccounts'); ?></h2>
	<table class="table table-striped table-bordered table-condensed"">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('maatschappij'); ?></th>
			<th><?php echo $this->Paginator->sort('iban'); ?></th>
			<th><?php echo $this->Paginator->sort('rekeningnummer'); ?></th>
			<th><?php echo $this->Paginator->sort('grootboek_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($bankaccounts as $bankaccount): ?>
	<tr>
		<td><?php echo h($bankaccount['Bankaccount']['id']); ?>&nbsp;</td>
		<td><?php echo h($bankaccount['Bankaccount']['maatschappij']); ?>&nbsp;</td>
		<td><?php echo h($bankaccount['Bankaccount']['iban']); ?>&nbsp;</td>
		<td><?php echo h($bankaccount['Bankaccount']['rekeningnummer']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bankaccount['Grootboek']['display_omschrijving'], array('controller' => 'grootboeks', 'action' => 'view', $bankaccount['Grootboek']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $bankaccount['Bankaccount']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bankaccount['Bankaccount']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $bankaccount['Bankaccount']['id']), null, __('Are you sure you want to delete # %s?', $bankaccount['Bankaccount']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>