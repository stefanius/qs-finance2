<div class="balans">

	  <h1>Balans: <?php echo $balans['Bookyear']['omschrijving']?></h1>

      <div class="tablewrapper">

      <?php echo $this->element('balans', array('side' => 'debet')); ?>
      <?php echo $this->element('balans', array('side' => 'credit')); ?>

      </div>
</div>

<!--  
<div class="balansoptions">
        <?php echo $this->html->link("Download eenvoudige balans(excel)", array("controller"=>"exportexcel", "action"=>"balans", $balans['Bookyear']['omschrijving']))?>
        <br/>
        <?php echo $this->html->link("Download kolombalans(excel)", array("controller"=>"exportexcel", "action"=>"kolombalans", $balans['Bookyear']['omschrijving']))?>
        <br/>
</div>

-->