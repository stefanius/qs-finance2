<?php if(isset($balans)): ?>
    <h4>Import <?php echo $balans['Bookyear']['omschrijving']; ?></h4>
    <ul>
        <li><?php echo $this->html->link("ING", array('controller' => 'calculations', 'action'=>'import',$balans['Bookyear']['omschrijving'], 'ing', 'csv')) ?></li>
        <li><?php echo $this->html->link("Rabobank", array('controller' => 'calculations', 'action'=>'import',$balans['Bookyear']['omschrijving'], 'rabo', 'csv')) ?></li>
    </ul>
<?php endif; ?>