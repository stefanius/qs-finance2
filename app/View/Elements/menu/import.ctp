<?php if(isset($balans)): ?>
    <h4>Export Excel <?php echo $balans['Bookyear']['omschrijving']; ?></h4>
    <ul>
        <li><?php echo $this->html->link("Balans", array("controller"=>"exportexcel", "action"=>"balans", $balans['Bookyear']['omschrijving']))?></li>
        <li><?php echo $this->html->link("Kolombalans", array("controller"=>"exportexcel", "action"=>"kolombalans", $balans['Bookyear']['omschrijving']))?></li>
    </ul>
<?php endif; ?>