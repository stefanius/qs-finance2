<div class="balans">
<?php
	if(isset($bookyear))
	{
		echo $this->Form->create('Calculation', array('type' => 'file'));
		echo "<fieldset>";	
		
			echo $this->Form->file('File.0');
			echo $this->Form->input('Bookyear.id', array('value' => $bookyear['Bookyear']['id']));
	
		echo "</fieldset>";
		echo $this->Form->end(__('Submit'));
	}else{
		echo $this->Html->link('Terug naar home', '/');
	}
?>
</div>