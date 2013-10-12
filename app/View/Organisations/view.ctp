<div class="organisations view">
<h2><?php  echo __('Organisation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organisation['Organisation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($organisation['Organisation']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($organisation['Organisation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($organisation['Organisation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Organisation'), array('action' => 'edit', $organisation['Organisation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Organisation'), array('action' => 'delete', $organisation['Organisation']['id']), null, __('Are you sure you want to delete # %s?', $organisation['Organisation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Organisations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organisation'), array('action' => 'add')); ?> </li>
	</ul>
</div>
