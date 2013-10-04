<?php $years = $this->requestAction('/bookyears/getBookyear/0'); ?>
<ul>
	<?php if(count($years) > 0): ?>
		<strong>&nbsp;Open Boekjaren</strong>
		<?php
			foreach($years as $year) {
				echo '<li><a href="'.$this->request->webroot.'balans/open/'.$year['Bookyear']['omschrijving'].'">'.$year['Bookyear']['omschrijving'].'</a></li>';
			}			
		?>
	<?php endif; ?>
</ul>