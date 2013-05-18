<div class="balans">
<?php echo $this->Form->create('Bookyear');?>
	<fieldset>
 		<legend><?php __('Add Bookyear'); ?></legend>
	<?php
		$omschrijving = "".date("Y")-1;
		$omschrijving = $omschrijving."-".date("Y");
		echo $this->Form->input('startdatum', array('selected' => array('month' => '9', 'year' => date("Y")-1, 'day' => '1')));
		echo $this->Form->input('einddatum', array('selected' => array('month' => '9', 'year' => date("Y"), 'day' => '1')));
		echo $this->Form->input('omschrijving', array('value' => $omschrijving ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>