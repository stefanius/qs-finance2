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
        <?php if(strlen($journal['Calculation']['hash']) > 1 ): ?>
        	<td class="omschrijving"><?php echo $this->Html->link(__($journal['Calculation']['omschrijving']), '/balans/'.$this->Session->read('Bookyear.omschrijving').'/journaal/'.$journal['Calculation']['hash']); ?></td>
        <?php else: ?>
        	<td class="omschrijving"><?php echo $journal['Calculation']['omschrijving']; ?></td>
        <?php endif; ?>
        
        <td class="currency"><?php echo $this->Balans->currency($journal['Calculation']['debet']); ?></td>
        <td class="currency"><?php echo $this->Balans->currency($journal['Calculation']['credit']); ?></td>
    </tr>


<?php endforeach; ?>	
</table>


