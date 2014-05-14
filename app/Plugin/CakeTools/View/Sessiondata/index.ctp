<div class="sessionData index">
	<h2><?php echo __('Session Data'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('data'); ?></th>
			<th><?php echo $this->Paginator->sort('useragent'); ?></th>
			<th><?php echo $this->Paginator->sort('os'); ?></th>
			<th><?php echo $this->Paginator->sort('browser'); ?></th>
			<th><?php echo $this->Paginator->sort('browserversion'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('country'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('expires'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($Sessiondata as $data): ?>
	<tr>
		<td><?php echo h($data['Sessiondata']['id']); ?>&nbsp;</td>
		<td><?php echo h($data['Sessiondata']['data']); ?>&nbsp;</td>
		<td><?php echo h($data['Sessiondata']['useragent']); ?>&nbsp;</td>
		<td><?php echo h($data['Sessiondata']['os']); ?>&nbsp;</td>
		<td><?php echo h($data['Sessiondata']['browser']); ?>&nbsp;</td>
		<td><?php echo h($data['Sessiondata']['browserversion']); ?>&nbsp;</td>
		<td><?php echo h($data['Sessiondata']['city']); ?>&nbsp;</td>
		<td><?php echo h($data['Sessiondata']['country']); ?>&nbsp;</td>
		<td><?php echo h($data['Sessiondata']['state']); ?>&nbsp;</td>
		<td><?php echo h($data['Sessiondata']['expires']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $data['Sessiondata']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $data['Sessiondata']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $data['Sessiondata']['id']), null, __('Are you sure you want to delete # %s?', $data['Sessiondata']['id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Session Datum'), array('action' => 'add')); ?></li>
	</ul>
</div>
