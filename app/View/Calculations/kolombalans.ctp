<table>

<?php
	echo "<tr>";
		echo '<th></th>';
		echo '<th></th>';
		echo '<th class="kolomkopl">Begin</th>';
		echo '<th class="kolomkopr">balans</th>';
		echo '<th class="kolomkopl">Proef</th>';
		echo '<th class="kolomkopr">balans</th>';
		echo '<th class="kolomkopl">Saldi</th>';
		echo '<th class="kolomkopr">balans</th>';
		echo '<th class="kolomkopl">Winst</th>';
		echo '<th class="kolomkopr">Verlies</th>';
		echo '<th class="kolomkopl">Eind</th>';
		echo '<th class="kolomkopr">balans</th>';
	echo "</tr>";

	echo "<tr>";
		echo '<th>Nummer</th>';
		echo '<th>Omschrijving</th>';
		echo '<th class="geld">Debet</th>';
		echo '<th class="geld">Credit</th>';
		echo '<th class="geld">Debet</th>';
		echo '<th class="geld">Credit</th>';
		echo '<th class="geld">Debet</th>';
		echo '<th class="geld">Credit</th>';
		echo '<th class="geld">Debet</th>';
		echo '<th class="geld">Credit</th>';
		echo '<th class="geld">Debet</th>';
		echo '<th class="geld">Credit</th>';
	echo "</tr>";

	echo "<tr>";
		echo '<td>----</td>';
		echo '<td>Eigen Vermogen</td>';
		echo '<td class="geld">-</td>';
		echo '<td class="geld">'.$this->Balans->currency($balans['beginbalans']['ev'],'').'</td>';
		echo '<td class="geld">-</td>';
		echo '<td class="geld">'.$this->Balans->currency($balans['proefbalans']['ev'],'').'</td>';	
		echo '<td class="geld">-</td>';
		echo '<td class="geld">'.$this->Balans->currency($balans['saldibalans']['ev'],'').'</td>';
		echo '<td class="geld">-</td>';
		echo '<td class="geld">-</td>';		
		echo '<td class="geld">-</td>';
		echo '<td class="geld">'.$this->Balans->currency($balans['eindbalans']['ev'], ' ').'</td>';	
	echo "</tr>";		


	foreach ($balans['posten']['balans'] as $balanspost){
		echo $this->Balans->toKolomBalansRij($balanspost['Grootboek'], $balans);
	}
	
	foreach ($balans['posten']['resultaat'] as $balanspost){
		echo $this->Balans->toKolomBalansRij($balanspost['Grootboek'], $balans);
	}
	
	//Totalen:
	$balanspost['Grootboek']['nummer'] = 'totaal';
	$balanspost['Grootboek']['omschrijving'] = 'TOTAAL';
	echo $this->Balans->toKolomBalansRij($balanspost['Grootboek'], $balans);
			
?>

</table>