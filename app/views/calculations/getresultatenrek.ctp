<div class="resultaat">
<h1><?php echo 'Resultaten rekeningen'; ?></h1>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th class="omschrijving">Rekening</th>
			<th class="geld">Debet</th>
			<th class="geld">Credit</th>
			<th class="geld">Saldo</th>
		</tr>
<?php
	foreach($res_rek as $a){
		echo $this->Balans->toGrootboekOverzichtRij($a, $bookyear_id);
	}	
?>

</table>
</div>