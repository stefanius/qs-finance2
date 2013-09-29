<div class="bankaccounts view">
<h2><?php  echo __('Bankaccount'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($bankaccount['Bankaccount']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Maatschappij'); ?></dt>
		<dd>
			<?php echo h($bankaccount['Bankaccount']['maatschappij']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Iban'); ?></dt>
		<dd>
			<?php echo h($bankaccount['Bankaccount']['iban']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rekeningnummer'); ?></dt>
		<dd>
			<?php echo h($bankaccount['Bankaccount']['rekeningnummer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grootboek'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bankaccount['Grootboek']['display_omschrijving'], array('controller' => 'grootboeks', 'action' => 'view', $bankaccount['Grootboek']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bankaccount'), array('action' => 'edit', $bankaccount['Bankaccount']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Bankaccount'), array('action' => 'delete', $bankaccount['Bankaccount']['id']), null, __('Are you sure you want to delete # %s?', $bankaccount['Bankaccount']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bankaccounts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bankaccount'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grootboeks'), array('controller' => 'grootboeks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grootboek'), array('controller' => 'grootboeks', 'action' => 'add')); ?> </li>
	</ul>
</div>
