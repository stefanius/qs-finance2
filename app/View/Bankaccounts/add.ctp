<div class="bankaccounts form">
<?php echo $this->Form->create('Bankaccount', array('role'=>'form')); ?>

		<legend><?php echo __('Bankrekening koppelen'); ?></legend>
		
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Iban</label>
		    <div class="col-sm-10">
		      <?php echo $this->Form->input('iban', array('label'=>false, 'class'=>'form-control'));?>
		    </div>
		  </div>		

		  <div class="form-group">
		    <label class="col-sm-2 control-label">Balansrekening</label>
		    <div class="col-sm-10">
		      <?php echo $this->Form->input('grootboek_id', array('label'=>false, 'class'=>'form-control'));?>
		    </div>
		  </div>			  

		  <div class="form-group">
		    <label class="col-sm-2 control-label"></label>
		    <div class="col-sm-10">
		      <?php echo $this->Form->button(__('Submit'), array('class'=>'btn btn-lg btn-primary btn-block')); ?>
		    </div>
		  </div>
		  
<?php echo $this->Form->end(); ?>

</div>