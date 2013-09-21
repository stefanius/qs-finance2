<div class="balans">
<?php
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
	<table cellpadding="0" cellspacing="0">
            <tr>
                <th class="datum">Boekdatum</th>
                <th class="omschrijving">Omschrijving</th>
                <th class="omschrijving">Tegenrekening</th>
                <th class="geld">Debet</th>
                <th class="geld">Credit</th>
                
            </tr>
        <?php
            foreach($data as $d){
		echo "<tr>";
		echo '<td class="datum">'.$d['boekdatum']."</td>";;
		echo '<td class="omschrijving">'.$this->Form->input('Calculation.1.omschrijving', array('value'=>$d['omschrijving'], 'label' => false)).'</td>';
                echo '<td class="omschrijving">'. $this->Form->input('Calculation.1.grootboek_id', array('options' => $grootboeks, 'label' => false)).'</td>';
		echo '<td class="geld">'.$this->Form->input('Calculation.1.debet', array('value'=>$d['debet'], 'label' => false, 'type'=>'text'))."</td>";
		echo '<td class="geld">'.$this->Form->input('Calculation.1.credit', array('value'=>$d['credit'], 'label' => false,'type'=>'text'  ))."</td>";

                echo "</tr>";
            }	
        ?>	
        </table>
    <?php echo $this->Form->end(__('Submit'));?>
<?php endif; ?>    
</div>