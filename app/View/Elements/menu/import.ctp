<?php if(isset($bookyear)): ?>
    <h4>Import <?php echo $bookyear['Bookyear']['omschrijving']; ?></h4>
    <ul>
        <li><?php echo $this->html->link("ING", array('controller' => 'calculations', 'action'=>'import',$bookyear['Bookyear']['omschrijving'], 'ing', 'csv')) ?></li>
        <li><?php echo $this->html->link("Rabobank", array('controller' => 'calculations', 'action'=>'import',$bookyear['Bookyear']['omschrijving'], 'rabo', 'csv')) ?></li>
    </ul>
<?php endif; ?>