<div class="grootboek">
<h1><?php echo 'Overzicht rekeningen'; ?></h1>
	<table class="table table-striped table-bordered table-condensed">
		<tr>
			<th class="omschrijving">Rekening</th>
			<th class="currency">Debet</th>
			<th class="currency">Credit</th>
			<th class="currency">Saldo</th>
		</tr>
<?php
	foreach($overzicht as $a){
		echo $this->Balans->toGrootboekOverzichtRij($a, $bookyear['Bookyear']['omschrijving']);
	}	
?>

</table>
</div>