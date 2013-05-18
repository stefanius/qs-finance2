<?php		
		$list = $this->requestAction('/schemas/buildoverzicht');
		foreach ($list as $item){
			print("</br>------------------</br>");
			echo "<b>".$item['pattern']['omschrijving']."</b>";
			foreach ($item['items'] as $gb){
				print("</br>");
				echo $gb['grootboeks']['nummer'].': '.$gb['grootboeks']['omschrijving'].'  <i>*'.$gb['grootboeks']['type'].'*</i>';
			}
			print("</br>------------------</br>");
		}	
?>