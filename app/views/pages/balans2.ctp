<?php echo $html->css('boekhouden', 'stylesheet')."\n"; ?>
<div class="balans">
	<div class="debet">
		<table cellpadding="0" cellspacing="0">
			<tr><th>Debet</th><th></th></tr>
			<?php
				//$bookjaar="4e2eff64-e02c-406c-b355-0c849d87f14d";$boekjaar
				$balansposten = $this->requestAction('/calculations/CalculateBalans/'.$boekjaar);
				$aantalRij=0;
				foreach($balansposten['debet'] as $a){
						$aantalRij++;
						echo "<tr>";
						echo '<td><a href="'.$this->webroot.'calculations/getCalculation/'.$boekjaar.'/'.$a['id'].'">('.$a['grootboeknummer'].') '.$a['omschrijving']."</a></td>";
						echo '<td class="geld">'.$a['waarde']."</td>";
						echo "</tr>";				
				}
				if($aantalRij < $balansposten['totalen']['aantalRij']['leeg']){ //Vergelijk met de Creditzijde
					for($i=0;$i<$balansposten['totalen']['aantalRij']['leeg'];$i++){
						echo "<tr>";
						echo "<td>.</td>";
						echo '<td class="geld">.</td>';
						echo "</tr>";					
					}
				}
				
				
				echo "<tr>";
				echo "<td>Totaal</td>";
				echo '<td class="geld">'.$balansposten['totalen']['debet']."</td>";
				echo "</tr>";	
			?>	
		</table>
	</div>
	
	<div class="credit">
		<table cellpadding="0" cellspacing="0">
			<tr><th>Credit</th><th></th></tr>	
			<?php
				echo "<tr>";
				echo "<td>(0000) Eigen Vermogen</td>";
				echo '<td class="geld">'.$balansposten['totalen']['ev']."</td>";
				echo "</tr>";		
				$aantalRij=1;//Er is al een rij E-V.						
				foreach($balansposten['credit'] as $a){
						$aantalRij++;
						echo "<tr>";
						echo '<td><a href="'.$this->webroot.'calculations/getCalculation/'.$boekjaar.'/'.$a['id'].'">('.$a['grootboeknummer'].') '.$a['omschrijving']."</a></td>";
						echo '<td class="geld">'.$a['waarde']."</td>";
						echo "</tr>";				
				}	
				if($aantalRij < $balansposten['totalen']['aantalRij']['leeg']){
					for($i=1;$i<$balansposten['totalen']['aantalRij']['leeg'];$i++){ //Start met '1' ipv '0' vanwege de post EV.
						echo "<tr>";
						echo "<td>.</td>";
						echo '<td class="geld">.</td>';
						echo "</tr>";					
					}
				}					
				echo "<tr>";
				echo "<td>Totaal</td>";
				echo '<td class="geld">'.$balansposten['totalen']['credit']."</td>";
				echo "</tr>";						
			?>	
		</table>
	</div>
</div>
