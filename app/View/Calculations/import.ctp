<div class="balans import">
<?php
	if(isset($bankpost)){
		echo '<h2>CSV van bank: '.$bankpost['Bankaccount']['maatschappij'].' ('.$bankpost['Bankaccount']['iban'].')</h2>';
		echo '<h3>Grootboek: '.$bankpost['Grootboek']['display_omschrijving'].'</h3>';		
	}


	if(isset($bookyear) && !isset($data))
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
<?php if(isset($bookyear) && isset($data)): ?>
    <?php echo $this->Form->create('Calculation');?>
    <?php echo $this->Form->input('Grootboek.id', array('value'=>$bankpost['Grootboek']['id'], 'type' => 'hidden', 'label'=>false)); ?>

	<table cellpadding="0" cellspacing="0">
            <tr>
            	<th class="checkbox"></th>
                <th class="datum">Boekdatum</th>
                <th class="omschrijving">Omschrijving</th>
                <th class="post">Post</th>
                <th class="geld">Debet (bij)</th>
                <th class="geld">Credit (af)</th>
                
            </tr>
        <?php
        	$i=1;
            foreach($data as $d){
				echo "<tr>";
				echo '<td class="checkbox">'.$this->Form->checkbox('Calculation.'.$i.'.process', array('checked'=>true, 'hidden'=>false)).'</td>';
				echo '<td class="datum">'.$this->Form->input('Calculation.'.$i.'.boekdatum', array('value'=>$d['boekdatum'], 'label' => false, 'type' => 'text'))."</td>";
				echo '<td class="omschrijving">'.$this->Form->textarea('Calculation.'.$i.'.omschrijving', array('value'=>$d['omschrijving'], 'label' => false)).'</td>';
		        echo '<td class="omschrijving">'. $this->Form->input('Calculation.'.$i.'.grootboek_id', array('options' => $grootboeks, 'label' => false)).'</td>';
				echo '<td class="geld">'.$this->Form->input('Calculation.'.$i.'.debet', array('value'=>$d['debet'], 'label' => false, 'type'=>'text'))."</td>";
				echo '<td class="geld">'.$this->Form->input('Calculation.'.$i.'.credit', array('value'=>$d['credit'], 'label' => false,'type'=>'text'  ))."</td>";
		
		        echo "</tr>";
		        $i++;
            }	
        ?>	
        </table>
    <?php echo $this->Form->end(__('Submit'));?>
<?php endif; ?>    
</div>