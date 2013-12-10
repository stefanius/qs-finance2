<table>
	<?php if($side=='debet'): ?>
	    <tr><th class="debet" colspan="3">Debet</th></tr>
	<?php elseif($side=='credit'): ?>
	    <tr><th class="credit" colspan="3">Credit</th></tr>
        <tr>
            <td></td>
            <td>Eigen Vermogen</td>
            <td class="currency"><?php echo $this->Balans->currency($balans['ev']); ?></td>
        </tr>
	  					    
	<?php endif; ?>
	
	
	<?php foreach($balans[$side]['posten'] as $a): ?>
	
	<?php if($a['Grootboek']['omschrijving'] == '.'):?>
	    <tr>
	        <td class="number">&nbsp;</td>
	        <td>&nbsp;&nbsp;&nbsp;</td>
	        <td class="currency">&nbsp;</td>
    	</tr>	
	<?php else: ?>
	    <tr>
	        <td class="number"><?php echo $a['Grootboek']['nummer']?></td>
	        <td><?php echo $this->html->link(ucfirst($a['Grootboek']['omschrijving']), '/balans/'.$balans['Bookyear']['omschrijving'].'/rekening/'.$a['Grootboek']['nummer'])   ?></td>
	        <td class="currency"><?php echo $this->Balans->currency($a['Bedrag']['saldo']) ?></td>
    	</tr>
	
	<?php endif;?>
	<?php endforeach; ?>

	    <tr>
	        <td class="number"></td>
	        <td class="total">Totaal</td>
	        <td class="currency total"><?php echo $this->Balans->currency($balans[$side]['totaal']) ?></td>
    	</tr>	
</table>