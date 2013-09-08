<?php if(isset($balans)): ?>
    <h4>Import <?php echo $balans['Bookyear']['omschrijving']; ?></h4>
    <ul>
        <li><?php echo $this->html->link("ING", array()) ?></li>
        <li><?php echo $this->html->link("Rabobank", array())?></li>
    </ul>
<?php endif; ?>