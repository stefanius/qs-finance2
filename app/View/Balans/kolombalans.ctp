<div class="grootboek">

<table>
<?php

//print_r( $kolombalans['proefbalans']['credit']);

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
		echo '<th class="geld debet">Debet</th>';
		echo '<th class="geld">Credit</th>';
		echo '<th class="geld debet">Debet</th>';
		echo '<th class="geld">Credit</th>';
		echo '<th class="geld debet">Debet</th>';
		echo '<th class="geld">Credit</th>';
		echo '<th class="geld debet">Debet</th>';
		echo '<th class="geld">Credit</th>';
		echo '<th class="geld debet">Debet</th>';
		echo '<th class="geld">Credit</th>';
	echo "</tr>";

	echo "<tr>";
		echo '<td>----</td>';
		echo '<td>Eigen Vermogen</td>';
		echo '<td class="geld debet">-</td>';
		echo '<td class="geld">'.$this->Balans->currency($kolombalans['beginbalans']['ev'],'').'</td>';
		echo '<td class="geld debet">-</td>';
		echo '<td class="geld">'.$this->Balans->currency($kolombalans['proefbalans']['ev'],'').'</td>';	
		echo '<td class="geld debet">-</td>';
		echo '<td class="geld">'.$this->Balans->currency($kolombalans['saldibalans']['ev'],'').'</td>';
		echo '<td class="geld debet">-</td>';
		echo '<td class="geld">-</td>';		
		echo '<td class="geld debet">-</td>';
		echo '<td class="geld">'.$this->Balans->currency($kolombalans['eindbalans']['ev'], ' ').'</td>';	
	echo "</tr>";		


	foreach ($kolombalans['posten']['balans'] as $balanspost){
		echo $this->Balans->toKolomBalansRij2($balanspost['Grootboek'], $kolombalans);
	}



	foreach ($kolombalans['posten']['resultaat'] as $balanspost){
		echo $this->Balans->toKolomBalansRij2($balanspost['Grootboek'], $kolombalans);
	}
	
	//Totalen:
//	$balanspost['Grootboek']['nummer'] = 'totaal';
	//$balanspost['Grootboek']['omschrijving'] = 'TOTAAL';
	//echo $this->Balans->toKolomBalansRij2($balanspost['Grootboek'], $balans);
			
?>
</table>

</div>