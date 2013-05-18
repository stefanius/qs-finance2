<div class="resultaat">
<h1><?php echo 'Overzicht rekeningen'; ?></h1>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th class="omschrijving">Rekening</th>
			<th class="geld">Debet</th>
			<th class="geld">Credit</th>
			<th class="geld">Saldo</th>
		</tr>
<?php
	foreach($overzicht as $a){
		echo $this->Balans->toGrootboekOverzichtRij($a, $bookyear['Bookyear']['omschrijving']);
	}	
?>

</table>
</div>