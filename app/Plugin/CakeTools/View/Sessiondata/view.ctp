<div class="sessionData view">
<h2><?php echo __('Session Datum'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($Sessiondata['Sessiondata']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($Sessiondata['Sessiondata']['data']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Useragent'); ?></dt>
		<dd>
			<?php echo h($Sessiondata['Sessiondata']['useragent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Os'); ?></dt>
		<dd>
			<?php echo h($Sessiondata['Sessiondata']['os']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Browser'); ?></dt>
		<dd>
			<?php echo h($Sessiondata['Sessiondata']['browser']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Browserversion'); ?></dt>
		<dd>
			<?php echo h($Sessiondata['Sessiondata']['browserversion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($Sessiondata['Sessiondata']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($Sessiondata['Sessiondata']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($Sessiondata['Sessiondata']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expires'); ?></dt>
		<dd>
			<?php echo h($Sessiondata['Sessiondata']['expires']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Session Datum'), array('action' => 'edit', $Sessiondata['Sessiondata']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Session Datum'), array('action' => 'delete', $Sessiondata['Sessiondata']['id']), null, __('Are you sure you want to delete # %s?', $Sessiondata['Sessiondata']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Session Data'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Session Datum'), array('action' => 'add')); ?> </li>
	</ul>
</div>
