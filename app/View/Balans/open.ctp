
	  <h1>Balans: <?php echo $balans['Bookyear']['omschrijving']?></h1>
	
      <div class="tablewrapper">
	  
      <?php echo $this->element('balans', array('side' => 'debet')); ?>
      <?php echo $this->element('balans', array('side' => 'credit')); ?>

      </div>


<script>

function showdatefilter(){
	
}

</script>