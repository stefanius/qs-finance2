<?php 
$tmp = array();
foreach ($calculations as $calculation){
	
	if($calculation['Calculation']['debet'] > $calculation['Calculation']['credit']){
		$tmp[$calculation['Calculation']['boekdatum'].'-'.$calculation['Calculation']['omschrijving'].'-'.$calculation['Calculation']['debet']]['debet'] = $calculation;
	}else{
		$tmp[$calculation['Calculation']['boekdatum'].'-'.$calculation['Calculation']['omschrijving'].'-'.$calculation['Calculation']['credit']]['credit'] = $calculation;
	}
}

$calculations = $tmp;

?>

<div class="grootboek">
	<h2><?php echo __('Journaal');?></h2>
	
	<?php foreach ($calculations as $calculation): ?>
		<p><?php echo $calculation['debet']['Calculation']['omschrijving']; ?></p>
		<table cellpadding="0" cellspacing="0">
		
		<?php foreach($calculation as $c):?>
			
			<tr>
		<td>
			<?php echo $this->Html->link($c['Grootboek']['omschrijving'], array('controller' => 'grootboeks', 'action' => 'view', $c['Grootboek']['id'])); ?>
		</td>
		<td>
  			<?php echo $this->Html->link($c['Bookyear']['omschrijving'], array('controller' => 'bookyears', 'action' => 'view', $c['Bookyear']['id'])); ?>
		</td>

		<td><?php echo $c['Calculation']['debet']; ?>&nbsp;</td>
		<td><?php echo $c['Calculation']['credit']; ?>&nbsp;</td>
		<td><?php echo $c['Calculation']['boekdatum']; ?></td>								
			</tr>
		<?php endforeach; ?>
		</table>



<?php endforeach; ?>

<?php echo $this->Html->link(__('Verwijder'), array('action' => 'deletebyhash', $hash), null, sprintf(__('Alle onderstaande boekingen worden verwijderd. Weet u het zeker?'))); ?>
</div>