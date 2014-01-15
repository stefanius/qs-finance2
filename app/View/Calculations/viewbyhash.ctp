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

	<h2><?php echo __('Boekingoverzicht');?></h2>
	
	<?php echo $this->Html->link(__('Verwijder'), array('action' => 'deletebyhash', $hash), array('role'=> 'button', 'class'=> 'btn btn-danger'), sprintf(__('Alle onderstaande boekingen worden verwijderd. Weet u het zeker?'))); ?>
	
	<?php foreach ($calculations as $calculation): ?>
		<p><?php echo $calculation['debet']['Calculation']['omschrijving']; ?></p>
		<table class="table table-striped table-bordered table-condensed">
		
		<?php foreach($calculation as $c):?>
			
			<tr>
		<td class='datum'>
			<?php echo date('d-m-Y', strtotime($c['Calculation']['boekdatum'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($c['Grootboek']['omschrijving'], array('controller' => 'grootboeks', 'action' => 'view', $c['Grootboek']['id'])); ?>
		</td>

		<td class="currency"><?php echo $c['Calculation']['debet']; ?>&nbsp;</td>
		<td class="currency"><?php echo $c['Calculation']['credit']; ?>&nbsp;</td>
										
			</tr>
		<?php endforeach; ?>
		</table>

<?php endforeach; ?>

