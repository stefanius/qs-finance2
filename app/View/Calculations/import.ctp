<?php echo $this->Html->script('autocomplete');?>
<?php echo $this->Html->script('switchbutton');?>
<?php //http://stackoverflow.com/questions/4681320/can-i-expand-collapse-content-of-jquery-ui-accordion-by-click-another-elements-t?>
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
	<?php 
	if($possibleDuplicates > 0){
		$percentage = ($possibleDuplicates / count($data)) *100;
		
		echo '<br/><br/><p><strong>Er zijn '.$possibleDuplicates.' mogelijke duplicaten gevonden ('.$percentage.'%) in de boekhouding. Weet u zeker dat u deze CSV niet al eerder hebt geimporteerd?</strong></p><br/>';
		
		if($percentage > 60){
			echo '<br/><p><em><strong>LET OP! Het duplicaat-percentage bedraagt meer dan 60%! Om precies te zijn: '.$percentage.'%</strong></em></p><br/><br/>';
		}
	}
	?>
    <?php echo $this->Form->create('Calculation');?>
    <?php echo $this->Form->input('Grootboek.id', array('value'=>$bankpost['Grootboek']['id'], 'type' => 'hidden', 'label'=>false)); ?>
    <?php $i=1; ?>
	<div id="accordion">

        <?php foreach($data as $d): ?>
				
            	<h3><?php echo $i;?>: <?php echo $d['omschrijving'];?></h3>
            	
            	<div class="data-container">
            	    <?php echo $this->Form->checkbox('Calculation.'.$i.'.process', array('checked'=>true, 'hidden'=>false, 'class'=>'switchButton'))?>
					<table class="col-md-12">
				            <tr>
				                <th class="col-md-12">Omschrijving</th>				               
				               <!--  <th class="geld">Debet (bij)</th>
				                <th class="geld">Credit (af)</th> --> 
				                
				            </tr>            	
            	<?php 
            	
				echo "<tr>";
				echo '<td class="col-md-12">'.$this->Form->textarea('Calculation.'.$i.'.omschrijving', array('class'=>'col-md-12', 'value'=>$d['omschrijving'], 'label' => false)).'</td>';
		        echo "</tr>";
		       
		        ?>
					<table class="col-md-12">
				            <tr>
				            	<th class="col-md-6">Tegenrekening</th>
				                <th class="col-md-3">Bedrag</th>		
				                <th class="col-md-3">Boekdatum</th>		                
				            </tr>    		        
		        <?php 
		        echo "<tr>";
		        echo '<td class="col-md-6">'. $this->Form->input('Calculation.'.$i.'.grootboek_id', array('empty'=>'None', 'class'=>'tegenrekening', 'options' => $grootboeks, 'label' => false)).'</td>';
		       
		        if($d['debet'] > $d['credit']){
		        	echo '<td class="col-md-3">'.$this->Form->input('Calculation.'.$i.'.debet', array('class'=>'col-md-6', 'value'=>$d['debet'], 'label' => '&nbsp;&nbsp;bij', 'type'=>'text'))."";
		        	echo $this->Form->input('Calculation.'.$i.'.credit', array('value'=>$d['credit'], 'label' => false,'type'=>'hidden'  ))."</td>";		    
		        }else{
		        	echo '<td class="col-md-3">'.$this->Form->input('Calculation.'.$i.'.debet', array('value'=>$d['debet'], 'label' => false, 'type'=>'hidden'))."";
		        	echo $this->Form->input('Calculation.'.$i.'.credit', array('class'=>'col-md-6', 'value'=>$d['credit'], 'label' => '&nbsp;&nbsp;af','type'=>'text'))."</td> ";		        	 
		        }
		        echo '<td class="col-md-3">'.$this->Form->input('Calculation.'.$i.'.boekdatum', array('value'=>$d['boekdatum'], 'label' => false, 'type' => 'text'))."</td>";
		        echo "</tr>";		        
		        $i++;
         ?>
         </table>
         <table class="col-md-12">
         	<tr class="col-md-12"><td class="col-md-10"> <a class="btn btn-success col-md-6 nextbutton" onclick="next()">Volgende</a></td></tr>
         </table>
         
        	</div>
        <?php endforeach; ?>	

            	<h3>Klaar?</h3>
            	
            	<div class="grootboek">
            	<label>Totaal aantal boekingen:</label><span id="totalBookings"><?php echo ($i-1); ?></span>
            	<label>Totaal gecontrolleerd:</label><span id="checkedBookings">0</span>
        <?php 
        
        echo $this->Form->submit(__('Opslaan'), array('class'=>'submit2'));
        ?>
        
        </div> 
        
    <?php echo $this->Form->end();?>
<?php endif; ?>    
</div>



  <script>  

  $("input.custom-combobox-input.ui-widget.ui-widget-content.ui-state-default.ui-corner-left.ui-autocomplete-input").keydown(function( event ) {
	  if ( event.which == 13 ) {
		  event.preventDefault();
		  }
  });
  
  $(function() {

    $( ".tegenrekening" ).combobox();
    $(".submit2").hide();

    $("input.custom-combobox-input.ui-widget.ui-widget-content.ui-state-default.ui-corner-left.ui-autocomplete-input").css('width','100%');
    
    var icons = {
      header: "ui-icon-circle-arrow-e",
      activeHeader: "ui-icon-circle-arrow-s"
    };
    $( "#accordion" ).accordion({
      icons: icons
    });
	 $('.custom-combobox-input.ui-widget.ui-widget-content.ui-state-default.ui-corner-left.ui-autocomplete-input:first').focus();
    $( "#toggle" ).button().click(function() {
      if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
        $( "#accordion" ).accordion( "option", "icons", null );
      } else {
        $( "#accordion" ).accordion( "option", "icons", icons );
      }
    });

    $(".data-container").on('keydown', function(e) { 
    	  var keyCode = e.keyCode || e.which; 
    	  
    	  if (keyCode == 9) { 
    	    e.preventDefault(); 
    	    nextbutton = $( this).find( '.nextbutton' );
    	    nextbutton.click();
    	    
    	  } 
    	});
/**
 * checked: undefined        // State of the switch

 show_labels: true         // Should we show the on and off labels?
 labels_placement: "both"  // Position of the labels: "both", "left" or "right"
 on_label: "ON"            // Text to be displayed when checked
 off_label: "OFF"          // Text to be displayed when unchecked

 width: 25                 // Width of the button in pixels
 height: 11                // Height of the button in pixels
 button_width: 12          // Width of the sliding part in pixels

 clear: true               // Should we insert a div with style="clear: both;" after the switch button?
 clear_after: null         // Override the element after which the clearing div should be inserted (null > right after the button)
 */
    var options = 
    {
		 show_labels: true,    
		 labels_placement: "both" , // Position of the labels: "both", "left" or "right"
		 on_label: "INBOEKEN",            // Text to be displayed when checked
		 off_label: "UITSLUITEN",          // Text to be displayed when unchecked

		 width: 25,                 // Width of the button in pixels
		 height: 11,                // Height of the button in pixels
		 button_width: 12,          // Width of the sliding part in pixels

		 clear: true,               // Should we insert a div with style="clear: both;" after the switch button?
		 clear_after: null         // Override the element after which the clearing div should be inserted (null > right after the button)
	};
    $("input.switchButton").switchButton(options);
    
  });

  function next() {
      var accordion = $("#accordion").accordion();
      var currentId = accordion.accordion("option", "active");          

      cAccordioPanel = $('#ui-accordion-accordion-panel-'+currentId);
      currentGrootboekSelector = cAccordioPanel.find('.custom-combobox-input');

      if(currentGrootboekSelector.val().length){
    	  maximum = accordion.find("h3").length;
		  nextId = currentId + 1;
		  accordion.accordion( "option", "active", nextId );

	      $('html, body').animate({
	           scrollTop: $("#ui-accordion-accordion-panel-"+currentId).offset().top-200
	       }, 500);
	         	
	       titleBar = $("#ui-accordion-accordion-header-"+currentId);
	       checkbox = $("#Calculation"+(currentId+1)+"Process");

	       titleBar.addClass( "booking-checked" );
	      
           checkedBookings = $('.booking-checked').length;
	       totalBookings = Number($("#totalBookings").text());
	       $("#checkedBookings").text(checkedBookings);
	       
	       if(checkedBookings >= totalBookings){
	    	   $(".submit2").show();
	       }
	       
	       if(checkbox.is(':checked')){
	    	   titleBar.css( "background", "#dff0d8" );
	       }else{
	    	   titleBar.css( "background", "#f2dede" );
	       } 
	       
	       $("#ui-accordion-accordion-panel-"+nextId).find('.custom-combobox-input.ui-widget.ui-widget-content.ui-state-default.ui-corner-left.ui-autocomplete-input').focus();	  
	  		  
      }else{
    	  alert('U moet een tegenrekening (grootboek) selecteren!');
      }      
 	}
  </script>