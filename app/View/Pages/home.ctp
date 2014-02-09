<?php $openyears = $this->requestAction('/bookyears/getBookyear/0'); ?>
<?php $closedyears = $this->requestAction('/bookyears/getBookyear/1'); ?>

<div class="balans">

<h1>QS-Finance</h1>

<?php if(count($openyears) > 0): ?>
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
<?php else: ?>
	<h2>Begin een administratie</h2>
	<a href="/start-nieuw-bookjaar">Start een boekjaar</a>
<?php endif; ?>
</div>

