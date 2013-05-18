<div class="grootboek">
<h1>Boekingstuk: <?php echo $boekingstuk; ?> </h1>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th class="datum">Boekdatum</th>
			<th class="omschrijving">Omschrijving</th>
			<th class="geld">Debet</th>
			<th class="geld">Credit</th>
		</tr>

	<?php
		foreach($calculations as $calculation){
			echo $this->Balans->openGrootboekRij($calculation['Calculation']);		
		}	
	?>	
	
	</table>
</div>
