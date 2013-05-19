<div class="grootboek">
<?php echo $this->Balans->balansTitel($bookyear['Bookyear'], $grootboek['Grootboek']);
	echo '<p>Totaal Debet: '.$this->Balans->currency($grootboek['Bedrag']['debet']).'</p>';
        echo '<p>Totaal Credit: '.$this->Balans->currency($grootboek['Bedrag']['credit']).'</p>';
        echo '</BR>'; //Niet zo netjes, dit wordt opgelost in een volgende versie.
        echo '<p>Het saldo bedraagt: '.$this->Balans->currency($grootboek['Bedrag']['saldo']).'</p>';
	echo '</BR>'; //Niet zo netjes, dit wordt opgelost in een volgende versie.
?>        
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th class="datum">Boekdatum</th>
			<th class="omschrijving">Omschrijving</th>
			<th class="geld">Debet</th>
			<th class="geld">Credit</th>
		</tr>
<?php
	foreach( $grootboek['Journaal'] as $gbcalc){
		echo $this->Balans->openGrootboekRij($gbcalc['Calculation']);		
	}	
	//Totaal:
	echo $this->Balans->openGrootboekRij($grootboek['Bedrag'])
?>	
</table>
<?php
	echo 'Het saldo bedraagt: '.$this->Balans->currency($grootboek['Bedrag']['saldo']);
	echo '</BR>'; //Niet zo netjes, dit wordt opgelost in een volgende versie.
?>
<!-- Alleen als het boekjaar nog is geopend: -->
<?php
if($bookyear['Bookyear']['closed']==0){
	if($bookyear['Bookyear']['omschrijving']=='Initiation'){
		echo $this->Html->link('Bewerk Saldi (Debet)', '/calculations/newfact/'.$bookyear['Bookyear']['id'].'/'.$grootboek['Grootboek']['id'].'/d'); 
		echo $this->Html->link('Bewerk Saldi (Credit)', '/calculations/newfact/'.$bookyear['Bookyear']['id'].'/'.$grootboek['Grootboek']['id'].'/c'); 
	}else{
		echo $this->Html->link('Cross Boeking (Debet)', '/calculations/crossbooking/'.$bookyear['Bookyear']['omschrijving'].'/'.$grootboek['Grootboek']['nummer'].'/d'); 
		echo '</br>';
		echo $this->Html->link('Cross Boeking (Credit)', '/calculations/crossbooking/'.$bookyear['Bookyear']['omschrijving'].'/'.$grootboek['Grootboek']['nummer'].'/c'); 
		echo '</br>';
	}
}else{
	echo "Het maken van een boeking in dit boekjaar is niet meer mogelijk.";
}
?>
</div>