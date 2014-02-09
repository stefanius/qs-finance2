<div class="col-md-8">
<?php echo $this->Form->create('Grootboek', array('class'=>'form-horizontal', 'role'=>'form'));?>

  <div class="form-group">
    <label class="col-sm-4 control-label">Nummer</label>
    <div class="col-sm-2">
    	<?php echo $this->Form->input('nummer', array('label'=>false, 'class'=>'form-control')); ?>
    </div>
  </div>

   <div class="form-group">
    <label class="col-sm-4 control-label">Omschrijving</label>
    <div class="col-sm-8">
    	<?php echo $this->Form->input('omschrijving', array('label'=>false, 'class'=>'form-control')); ?>
    </div>
  </div>
  
   <div class="form-group">
    <label class="col-sm-4 control-label">Soort rekening</label>
    <div class="col-sm-8">
		<select id="rektype" class="form-control" name="data[Grootboek][rektype]" data-validation="empty" data-error="U moet een keuze maken" onchange="checktype(this)" required>
		  <option value="">Maak een keuze</option>
		  <option value="0">Bezit (Debet-zijde)</option>
		  <option value="1">Schulden (Credit-zijde)</option>
		  <option value="2">Kosten/Baten (Resultaatrekening)</option>
		</select>
    </div>
  </div>  

   <div class="form-group">
    <label class="col-sm-4 control-label">Liquide</label>
    <div class="col-sm-8">
		<label class="checkbox-inline">
		  <?php echo $this->Form->input('liquide', array('label'=>false, 'div' => false)); ?>
		  <span class="help-inline">De markering Liquide is alleen van toepassing op rekeningen van bezit</span>
		</label> 
    </div>
  </div>  

   <div class="form-group">
    <label class="col-sm-4 control-label"></label>
    <div class="col-sm-8">
    	<?php echo $this->Form->submit(__('Opslaan'), array('class'=>'btn btn-success')); ?>
    </div>
  </div>    
</form>
</div>

<script>

	checktype($('#rektype'));
	
	function checktype(selectControl)
	{
		if($(selectControl).val() == '0'){
			$('#GrootboekLiquide').attr("disabled", false);
		}else{
			$('#GrootboekLiquide').attr("disabled", true);
			$('#GrootboekLiquide').prop("checked", false);
		}
	}
</script>