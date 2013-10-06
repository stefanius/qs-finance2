<div class="grootboek">
<?php echo $this->Form->create();?>
	<fieldset>
 		<legend><?php echo __($info['header']); ?></legend>
	<?php
		echo $this->Form->text('Calculation.0.grootboek_id', array('value' => $info['Grootboek']['id'], 'type' => 'hidden' ));
		echo $this->Form->text('Calculation.0.bookyear_id', array('value' =>  $info['Bookyear']['id'], 'type' => 'hidden' ));
		echo $this->Form->input('Calculation.0.omschrijving');
		//echo $this->Form->input('Calculation.0.boekingstuk',  array('options' => $boekingstukken));
		echo $this->Form->input('Calculation.0.boekdatum', array('type' => 'date'));
		echo $this->Form->input('Calculation.0.debet', array('type' => $info['debetcredit']['d']));
		echo $this->Form->input('Calculation.0.credit', array('type' => $info['debetcredit']['c']));

		echo $this->Form->input('Calculation.1.grootboek_id', array('options' => $grootboeks));
		echo $this->Form->text('Calculation.1.bookyear_id', array('value' =>  $info['Bookyear']['id'],'type' => 'hidden' ));
		echo $this->Form->input('Calculation.1.omschrijving', array('type' => 'hidden'));
		echo $this->Form->input('Calculation.1.boekingstuk',  array('type' => 'hidden'));
		echo $this->Form->input('Calculation.1.boekdatum', array('type' => 'hidden'));
		echo $this->Form->input('Calculation.1.debet', array('type' => 'hidden'));
		echo $this->Form->input('Calculation.1.credit',array('type' => 'hidden'));
		
		echo $this->Form->input('DebetCredit',array('type' => 'hidden', 'value' => $info['debetcredit']['dc']));
				
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>