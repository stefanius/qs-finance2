<div class="balans">
<?php if(isset($balansposten)): ?>
<h1><?php echo 'Balans: '.$balansposten['boekjaar']['omschrijving']; ?></h1>
<h1><?php echo '<a href="'.$balansposten['changebalansurl'].'">Per: '.$balansposten['datum'].'</a>'; ?></h1>
	<div class="debet">
		<table cellpadding="0" cellspacing="0">
			<tr><th>Debet</th><th></th></tr>
			<?php
				$boekjaar =$balansposten['boekjaar']['id'];
				$aantalRij=0;
				foreach($balansposten['debet'] as $a){
						$aantalRij++;
						echo "<tr>";
						echo '<td><a href="'.$this->request->webroot.'calculations/getCalculation/'.$boekjaar.'/'.$a['id'].'">('.$a['grootboeknummer'].') '.$a['omschrijving']."</a></td>";
						echo '<td class="geld">'.$this->Balans->currency($a['waarde'])."</td>";
						echo "</tr>";				
				}
				if($aantalRij < $balansposten['totalen']['aantalRij']['credit']){ //Vergelijk met de Creditzijde
					for($i=0;$i<$balansposten['totalen']['aantalRij']['leeg'];$i++){
						echo "<tr>";
						echo "<td>.</td>";
						echo '<td class="geld">.</td>';
						echo "</tr>";					
					}
				}
				
				
				echo "<tr>";
				echo "<td>Totaal</td>";
				echo '<td class="geld">'.$this->Balans->currency($balansposten['totalen']['debet'])."</td>";
				echo "</tr>";	
			?>	
		</table>
	</div>
	
	<div class="credit">
		<table cellpadding="0" cellspacing="0">
			<tr><th>Credit</th><th></th></tr>	
			<?php
				echo "<tr>";
				echo '<td><a href="'.$this->request->webroot.'calculations/rekeningoverzicht/'.$boekjaar.'/1">(----) Eigen Vermogen</a></td>';
				echo '<td class="geld">'.$this->Balans->currency($balansposten['totalen']['ev'])."</td>";
				echo "</tr>";		
				$aantalRij=1;//Er is al een rij E-V.						
				foreach($balansposten['credit'] as $a){
						$aantalRij++;
						echo "<tr>";
						echo '<td><a href="'.$this->request->webroot.'calculations/getCalculation/'.$boekjaar.'/'.$a['id'].'">('.$a['grootboeknummer'].') '.$a['omschrijving']."</a></td>";
						echo '<td class="geld">'.$this->Balans->currency($a['waarde'])."</td>";
						echo "</tr>";				
				}
				if($aantalRij < $balansposten['totalen']['aantalRij']['debet']){
					for($i=1;$i<$balansposten['totalen']['aantalRij']['leeg'];$i++){ //Start met '1' ipv '0' vanwege de post EV.
						echo "<tr>";
						echo "<td>.</td>";
						echo '<td class="geld">.</td>';
						echo "</tr>";					
					}
				}					
				echo "<tr>";
				echo "<td>Totaal</td>";
				echo '<td class="geld">'.$this->Balans->currency($balansposten['totalen']['credit'])."</td>";
				echo "</tr>";						
			?>	
		</table>
	</div>
	<?php endif; ?>
</div>

<?php if(isset($balansposten)): ?>
	<?php echo '<a href="'.$this->request->webroot.'calculations/ExportExcel/'.$boekjaar.'">Download eenvoudige balans(excel)</a></br>'; ?>
	<?php echo '<a href="'.$this->request->webroot.'calculations/ExportKolomBalans/'.$boekjaar.'">Download Kolombalans(excel)</a></br>'; ?>
	<?php echo '<a href="'.$this->request->webroot.'calculations/kolombalans/'.$boekjaar.'">Kolombalans</a></br>'; ?>
<?php endif; ?>
