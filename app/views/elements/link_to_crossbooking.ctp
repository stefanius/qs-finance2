<?php		
	if(isset($bookyear) && isset($grootboek)){
		if($bookyear != 0 && $grootboek != 0){
			echo "<h1>Nieuwe Boeking ($grootboek)";
			echo '</br>';
			echo $this->Html->link('Cross Boeking (Debet)', '/calculations/crossbooking/'.$bookyear.'/'.$grootboek.'/d'); 
			echo '</br>';
			echo $this->Html->link('Cross Boeking (Credit)', '/calculations/crossbooking/'.$bookyear.'/'.$grootboek.'/c'); 
			echo '</br>';		
		}
	}
?>