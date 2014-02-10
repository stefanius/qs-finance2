<div class=" col-md-6">      
<table class="table table-striped table-bordered table-condensed">
	<?php if($side=='debet'): ?>
	    <tr><th class="debet" colspan="3">Debet</th></tr>
	<?php elseif($side=='credit'): ?>
	    <tr><th class="credit" colspan="3">Credit</th></tr>
        <tr>
            <td></td>
            <td class="omschrijving">Eigen Vermogen</td>
            <td class="currency"><?php echo $this->Balans->currency($balans['ev']); ?></td>
        </tr>
	  					    
	<?php endif; ?>
	
	<?php if(is_array($balans) && is_array($balans[$side]) && array_key_exists('posten', $balans[$side])):?>
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
		        <td class="omschrijving"><?php echo $this->html->link(ucfirst($a['Grootboek']['omschrijving']), '/balans/'.$balans['Bookyear']['omschrijving'].'/rekening/'.$a['Grootboek']['nummer'])   ?></td>
		        <td class="currency"><?php echo $this->Balans->currency($a['Bedrag']['saldo']) ?></td>
	    	</tr>
		
		<?php endif;?>
		<?php endforeach; ?>
	<?php endif; ?>
	    <tr>
	        <td class="number"></td>
	        <td class="total">Totaal</td>
	        <td class="currency total neg"><?php echo $this->Balans->currency($balans[$side]['totaal']) ?></td>
    	</tr>	
</table>
</div>