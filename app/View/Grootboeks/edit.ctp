<div class="col-md-8">
<?php echo $this->Form->create('Grootboek', array('class'=>'form-horizontal', 'role'=>'form'));?>

	<?php
		echo $this->Form->input('id');
	?>

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
		<select class="form-control" name="data[Grootboek][rektype]">
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
		</label> 
    </div>
  </div>  
  
<?php echo $this->Form->end(__('Submit'));?>
  
</form>
</div>