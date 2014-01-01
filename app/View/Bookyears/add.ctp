<div class="balans">
	<?php echo $this->Form->create('Bookyear');?>
		<fieldset>
	 		<legend><?php echo __('Nieuw boekjaar toevoegen'); ?></legend>
	 		
                        <div class="input text required">
                            <label for="BookyearStartdatum">Startdatum</label>
                            <input name="data[Bookyear][startdatum]" class="datepicker" type="text" id="startdatum" />
                        </div>                       

                        <div class="input text required">
                            <label for="BookyearEinddatum">Einddatum</label>
                            <input name="data[Bookyear][einddatum]" class="datepicker" type="text" id="einddatum"/>
                        </div>  
                        
		<?php
			$omschrijving = "".date("Y")-1;
			$omschrijving = $omschrijving."-".date("Y");
			echo $this->Form->input('omschrijving', array('value' => $omschrijving ));

		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
</div>

 <script>
  $(function() {
    $( "#startdatum" ).datepicker({
      showOn: "button",
      buttonImage: "/img/calendar.gif",
      dateFormat: 'yy-mm-dd'
    });

    $( "#einddatum" ).datepicker({
        showOn: "button",
        buttonImage: "/img/calendar.gif",
        dateFormat: 'yy-mm-dd'
      });    

  });
  </script>
  