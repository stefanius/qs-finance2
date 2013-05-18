<h1>Open Boekjaren</h1>
<?php
	$years = $this->requestAction('/bookyears/getBookyear/0');
?>
<ul>
	<?php
		foreach($years as $year) {
			echo '<li><a href="'.$this->webroot.'balans/open/'.$year['Bookyear']['omschrijving'].'">'.$year['Bookyear']['omschrijving'].'</a></li>';
		}
	?>
</ul>