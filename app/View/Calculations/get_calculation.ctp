<div class="grootboek">
<h1><?php echo 'Grootboek ('.$gbcalc['info'][0]['Grootboek']['nummer'].'): '.$gbcalc['info'][0]['Grootboek']['omschrijving']; ?></h1>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th class="omschrijving">Omschrijving</th>
			<th class="geld">Debet</th>
			<th class="geld">Credit</th>
		</tr>
<?php
	for($i=0;$i < count($gbcalc['calcs']);$i++){
		echo "<tr>";
		echo '<td class="omschrijving">'.$gbcalc['calcs'][$i]['Calculation']['omschrijving'].'</td>';
		echo '<td class="geld">'.$gbcalc['calcs'][$i]['Calculation']['debet']."</td>";
		echo '<td class="geld">'.$gbcalc['calcs'][$i]['Calculation']['credit']."</td>";
		echo "</tr>";	
	}	
	
?>
		<!-- PHP IF statement -->
		<?php if($gbcalc['rektype']=='balans'){ ?>
		<tr>
			<td class="omschrijving">Naar balans: </td>
			<td class="geld"><?php echo $gbcalc['naarbalans']['debet']; ?></td>
			<td class="geld"><?php echo $gbcalc['naarbalans']['credit']; ?></td>
		</tr>
		<?php } ?>
		<!-- EINDE PHP IF statement -->
		
		<tr>
			<td class="omschrijving">TOTAAL</td>
			<td class="geld"><?php echo $gbcalc['totaal']['debet'] ?></td>
			<td class="geld"><?php echo $gbcalc['totaal']['credit'] ?></td>
		</tr>
</table>
<!-- Alleen als het boekjaar nog is geopend: -->
<?php
if($bookyear['Bookyear']['closed']==0){
	if($bookyear['Bookyear']['omschrijving']=='Initiation'){
		echo $this->Html->link('Bewerk Saldi (Debet)', '/calculations/newfact/'.$gbcalc['bookyear'].'/'.$gbcalc['info'][0]['Grootboek']['id'].'/d'); 
		echo $this->Html->link('Bewerk Saldi (Credit)', '/calculations/newfact/'.$gbcalc['bookyear'].'/'.$gbcalc['info'][0]['Grootboek']['id'].'/c'); 
	}else{
		echo $this->Html->link('Cross Boeking (Debet)', '/calculations/crossbooking/'.$gbcalc['bookyear'].'/'.$gbcalc['info'][0]['Grootboek']['id'].'/d'); 
		echo '</br>';
		echo $this->Html->link('Cross Boeking (Credit)', '/calculations/crossbooking/'.$gbcalc['bookyear'].'/'.$gbcalc['info'][0]['Grootboek']['id'].'/c'); 
		echo '</br>';
	}
}else{
	echo "Het maken van een boeking in dit boekjaar is niet meer mogelijk.";
}
?>
</div>