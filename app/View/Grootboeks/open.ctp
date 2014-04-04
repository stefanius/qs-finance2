<?php echo $this->element('totals-summary', array('summary' => $grootboek['Bedrag']), array('cache' => false)); ?>

<div class="grootboek">
<?php // $grootboek['Bedrag']['debet'] - $grootboek['Bedrag']['saldo']?>

<h1>Grootboek: <?php echo $grootboek['Grootboek']['nummer']; ?> - <?php echo $grootboek['Grootboek']['omschrijving']; ?></h1>
<h2>Boekjaar: <?php echo $this->Html->link($bookyear['Bookyear']['omschrijving'] , array('controller'=>'balans','action' => '/', $bookyear['Bookyear']['omschrijving'] ));?></h2>

<?php echo $this->element('grootboek', array('journals' => $grootboek['Journaal'])); ?>

<p>Het saldo bedraagt: <?php echo $this->Balans->currency($grootboek['Bedrag']['saldo']);?></p>


</div>