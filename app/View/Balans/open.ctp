<div class="balans">
	<?php echo $this->Balans->balansTitel($balans['Bookyear']);?>
	<div class="debet">
		<table cellpadding="0" cellspacing="0">
			<tr><th>Debet</th><th></th></tr>
			<?php
				foreach($balans['debet']['posten'] as $a){
					echo $this->Balans->balansRij($a, $balans['Bookyear']['omschrijving']);			
				}
				echo '<tr>';
				echo '<td><strong>TOTAAL</strong></td>';
				echo '<td class="geld"><strong>'.$this->Balans->currency($balans['debet']['totaal']).'</strong></td>';
				echo '</tr>';	
			?>				
		</table>
	</div>
	
	<div class="credit">
		<table cellpadding="0" cellspacing="0">
			<tr><th>Credit</th><th></th></tr>
			<?php			
				echo '<tr>';
				echo '<td><a href="'.$this->request->webroot.'grootboeks/overzicht/'.$balans['Bookyear']['omschrijving'].'/1">Eigen Vermogen</a></td>';
				echo '<td class="geld">'.$this->Balans->currency($balans['ev']).'</td>';
				echo '</tr>';	
					
				foreach($balans['credit']['posten'] as $a){
					echo $this->Balans->balansRij($a, $balans['Bookyear']['omschrijving']);			
				}
				
				echo '<tr>';
				echo '<td><strong>TOTAAL</strong></td>';
				echo '<td class="geld"><strong>'.$this->Balans->currency($balans['credit']['totaal']).'</strong></td>';
				echo '</tr>';	
			?>	
		</table>
	</div>
</div>
<div class="balansoptions">
	<?php echo '<a href="'.$this->request->webroot.'balans/exportbalans/'.$balans['Bookyear']['omschrijving'].'/balans">Download eenvoudige balans(excel)</a></br>'; ?>
	<?php echo '<a href="'.$this->request->webroot.'balans/exportbalans/'.$balans['Bookyear']['omschrijving'].'/kolombalans">Download Kolombalans(excel)</a></br>'; ?>
	<?php echo '<a href="'.$this->request->webroot.'calculations/import/'.$balans['Bookyear']['omschrijving'].'">Importeer Kwartaalfinanciën</a></br>'; ?>	
	<?php echo '<a href="'.$this->request->webroot.'balans/kolombalans/'.$balans['Bookyear']['omschrijving'].'">Kolombalans</a></br>'; ?>
	<?php echo '<a href="'.$this->request->webroot.'grootboeks/overzicht/'.$balans['Bookyear']['omschrijving'].'/0">Rekeningoverzicht Balansposten</a></br>'; ?>
	<?php echo '<a href="'.$this->request->webroot.'grootboeks/overzicht/'.$balans['Bookyear']['omschrijving'].'/1">Rekeningoverzicht Resultaatposten</a></br>'; ?>
</div>