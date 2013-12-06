<?php $openyears = $this->requestAction('/bookyears/getBookyear/0'); ?>
<?php $closedyears = $this->requestAction('/bookyears/getBookyear/1'); ?>

<div class="balans">

<h1>QS-Finance</h1>
<h2>Selecteer uw bookjaar</h2>
<ul>
      <?php foreach($openyears as $year): ?>
      
      <li>
          <?php echo $this->Html->link($year['Bookyear']['omschrijving'], '/balans/'.$year['Bookyear']['omschrijving']);?>     
      </li>
      
      <?php endforeach; ?>
</ul>

<ul>
      <?php foreach($closedyears as $year): ?>
      
      <li>
          <?php echo $this->Html->link($year['Bookyear']['omschrijving'], '/balans/'.$year['Bookyear']['omschrijving']);?>     
      </li>
      
      <?php endforeach; ?>
</ul>
</div>

