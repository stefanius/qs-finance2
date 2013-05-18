<div class="cleanform">
<?php echo $this->Form->create('Grootboek');?>
	<fieldset>
 		<legend><?php __('Nieuw Grootboek'); ?></legend>
	<?php
		echo $this->Form->input('nummer');
		echo $this->Form->input('omschrijving');
		echo $this->Form->input('debetcredit', 
			array('legend' => 'Rekening Type', 'type' => 'radio', 
				'options' => array( 'debet'=>'Balansrekening (Debet)', 'credit'=>'Balansrekening (Credit)' , 'result'=>'Resultatenrekening' )));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
