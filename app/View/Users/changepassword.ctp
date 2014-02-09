<div class="col-md-8">
<?php echo $this->Form->create('User', array('class'=>'form-horizontal', 'role'=>'form'));?>

  <div class="form-group">
    <label class="col-sm-4 control-label">Nieuw wachtwoord</label>
    <div class="col-sm-8">
    	<input name="data[User][password]" class="form-control" type="password" required="required">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Herhaal wachtwoord</label>
    <div class="col-sm-8">
    	<input name="data[User][password_retype]" class="form-control" type="password" required="required">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label"></label>
    <div class="col-sm-8">
    	<?php echo $this->Form->submit(__('Wachtwoord aanpassen'), array('class'=>'btn btn-success')); ?>
    </div>
  </div>   
</div>