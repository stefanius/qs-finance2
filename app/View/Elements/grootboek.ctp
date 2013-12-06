<table>
	<tr>
		<th class="datum">Boekdatum</th>
		<th class="omschrijving">Omschrijving</th>
		<th class="currency">Debet</th>
		<th class="currency">Credit</th>
	</tr>
<?php foreach( $journals as $journal): ?>

    <tr>
        <td><?php echo $journal['Calculation']['boekdatum']; ?></td>
        <td><?php echo $journal['Calculation']['omschrijving']; ?></td>
        <td class="currency"><?php echo $this->Balans->currency($journal['Calculation']['debet']); ?></td>
        <td class="currency"><?php echo $this->Balans->currency($journal['Calculation']['credit']); ?></td>
    </tr>


<?php endforeach; ?>	
</table>


