<?php echo $this->Html->script('autocomplete');?>+
<div class="import">
<?php
	if(isset($bankpost)){
		echo '<h2>CSV van bank: '.$bankpost['Bankaccount']['maatschappij'].' ('.$bankpost['Bankaccount']['iban'].')</h2>';
		echo '<h3>Grootboek: '.$bankpost['Grootboek']['display_omschrijving'].'</h3>';		
	}


	if(isset($bookyear) && !isset($data))
	{
		echo $this->Form->create('Calculation', array('type' => 'file'));
		echo "<fieldset>";	
		
			echo $this->Form->file('File.0');
			echo $this->Form->input('Bookyear.id', array('value' => $bookyear['Bookyear']['id']));
	
		echo "</fieldset>";
		echo $this->Form->end(__('Submit'));
	}else{
		echo $this->Html->link('Terug naar home', '/');
	}
?>
<?php if(isset($bookyear) && isset($data)): ?>
    <?php echo $this->Form->create('Calculation');?>
    <?php echo $this->Form->input('Grootboek.id', array('value'=>$bankpost['Grootboek']['id'], 'type' => 'hidden', 'label'=>false)); ?>
    <?php $i=1; ?>
	<div id="accordion">

        <?php foreach($data as $d): ?>

            	<h3><?php echo $i;?>: <?php echo $d['omschrijving'];?></h3>
            	<div class="grootboek">
            	    <?php echo $this->Form->checkbox('Calculation.'.$i.'.process', array('checked'=>true, 'hidden'=>false))?>
					<table cellpadding="0" cellspacing="0">
				            <tr>
				                <th class="omschrijving">Omschrijving</th>				               
				                <th class="geld">Debet (bij)</th>
				                <th class="geld">Credit (af)</th>
				                
				            </tr>            	
            	<?php 
            	
				echo "<tr>";
				//echo '<td class="checkbox">'.$this->Form->checkbox('Calculation.'.$i.'.process', array('checked'=>true, 'hidden'=>false)).'</td>';
			//	echo '<td class="datum">'.$this->Form->input('Calculation.'.$i.'.boekdatum', array('value'=>$d['boekdatum'], 'label' => false, 'type' => 'text'))."</td>";
				echo '<td class="omschrijving">'.$this->Form->textarea('Calculation.'.$i.'.omschrijving', array('class'=>'omschrijving', 'value'=>$d['omschrijving'], 'label' => false)).'</td>';
		        //echo '<td class="omschrijving">'. $this->Form->input('Calculation.'.$i.'.grootboek_id', array('options' => $grootboeks, 'label' => false)).'</td>';
				echo '<td class="geld">'.$this->Form->input('Calculation.'.$i.'.debet', array('value'=>$d['debet'], 'label' => false, 'type'=>'text'))."</td>";
				echo '<td class="geld">'.$this->Form->input('Calculation.'.$i.'.credit', array('value'=>$d['credit'], 'label' => false,'type'=>'text'  ))."</td>";
		
		        echo "</tr>";
		       
		        ?>
					<table cellpadding="0" cellspacing="0">
				            <tr>
				                <th class="datum">Boekdatum</th>
				                <th class="omschrijving">Tegenrekening</th>				               
				                
				            </tr>    		        
		        <?php 
		        echo "<tr>";
		        echo '<td class="datum">'.$this->Form->input('Calculation.'.$i.'.boekdatum', array('value'=>$d['boekdatum'], 'label' => false, 'type' => 'text'))."</td>";
		    //    echo '<td class="omschrijving">'.$this->Form->textarea('Calculation.'.$i.'.omschrijving', array('value'=>$d['omschrijving'], 'label' => false)).'</td>';
		        echo '<td class="omschrijving">'. $this->Form->input('Calculation.'.$i.'.grootboek_id', array('class'=>'tegenrekening', 'options' => $grootboeks, 'label' => false)).'</td>';

		        echo "</tr>";		        
		        $i++;
         ?>
         </table>
        	</div>
        <?php endforeach; ?>	
        </div> 
        
    <?php echo $this->Form->end(__('Submit'));?>
<?php endif; ?>    
</div>



  <script>
  $(function() {
    $( ".tegenrekening" ).combobox();
    var icons = {
      header: "ui-icon-circle-arrow-e",
      activeHeader: "ui-icon-circle-arrow-s"
    };
    $( "#accordion" ).accordion({
      icons: icons
    });
    $( "#toggle" ).button().click(function() {
      if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
        $( "#accordion" ).accordion( "option", "icons", null );
      } else {
        $( "#accordion" ).accordion( "option", "icons", icons );
      }
    });
  });
  </script>