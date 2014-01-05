   <div class="col-md-4 col-md-offset-4">
   	  <?php echo $this->Form->create('User', array('class'=>'form-signin', 'role'=>'form', 'url' => array('controller' => 'users', 'action' =>'login')));?>
        <h2 class="form-signin-heading">Inloggen</h2>
        <?php echo $this->Form->input('User.username', array('label'=>false, 'class'=>'form-control', 'placeholder'=>'Gebruikersnaam', 'required'=>'required', 'autofocus'=>'autofocus'));?>
        <?php echo $this->Form->input('User.password', array('label'=>false, 'class'=>'form-control', 'placeholder'=>'Wachtwoord', 'required'=>'required'));?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Inloggen</button>
      </form>
	</div>