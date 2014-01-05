<table class="table table-striped table-bordered table-condensed">
<?php

//print_r( $kolombalans['proefbalans']['credit']);

	echo "<tr>";
		echo '<th colspan=2></th>';

		echo '<th colspan=2>Beginbalans</th>';

		echo '<th colspan=2>Proefbalans</th>';

		echo '<th colspan=2>Saldibalans</th>';

		echo '<th colspan=2>Winst/verlies</th>';

		echo '<th colspan=2>Eindbalans</th>';

	echo "</tr>";

	echo "<tr>";
		echo '<th class="number">#</th>';
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
		echo '<td class="number">----</td>';
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