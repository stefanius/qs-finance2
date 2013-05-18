<h1>Select boekjaar</h1>
<?php
	$years = $this->requestAction('/bookyears/getBookyear');
?>
<ul>
	<?php
		foreach($years as $year) {
			echo '<li><a href="'.$this->request->webroot.'calculations/CalculateBalans/0/'.$year['Bookyear']['id'].'">'.$year['Bookyear']['omschrijving'].'</a></li>';
		}
	?>
</ul>