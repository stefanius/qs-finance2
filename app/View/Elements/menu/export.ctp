<?php if(isset($bookyear) && strpos($this->here, '/balans/') !== false): ?>
    <h4>Export Excel <?php echo $bookyear['Bookyear']['omschrijving']; ?></h4>
    <ul>
        <li><?php echo $this->html->link("Balans", array("controller"=>"exportexcel", "action"=>"balans", $bookyear['Bookyear']['omschrijving']))?></li>
        <li><?php echo $this->html->link("Kolombalans", array("controller"=>"exportexcel", "action"=>"kolombalans", $bookyear['Bookyear']['omschrijving']))?></li>
    </ul>
<?php endif; ?>
