<?php		
	if(isset($bookyear) && isset($grootboek)){
		if($bookyear != 0 && $grootboek != 0){
			echo "<h4>Nieuwe Boeking (".$grootboek['Grootboek']['nummer'].")</h4>";
			echo "<ul>";
			echo '<li>'.$this->Html->link('Boeking Debet', '/calculations/crossbooking/'.$bookyear['Bookyear']['omschrijving'].'/'.$grootboek['Grootboek']['nummer'].'/d').'</li>'; 
			echo '<li>'.$this->Html->link('Boeking Credit', '/calculations/crossbooking/'.$bookyear['Bookyear']['omschrijving'].'/'.$grootboek['Grootboek']['nummer'].'/c').'</li>'; 
			echo "</ul>";		
		}
	}
?>