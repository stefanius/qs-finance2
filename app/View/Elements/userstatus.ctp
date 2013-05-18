<?php 

	if($this->Session->read('Auth.User.id') >= 1 ){
		echo $this->Html->link('Uitloggen', '/users/logout', array('class' => 'button'));
	}else{
		echo $this->Html->link('Inloggen', '/users/login', array('class' => 'button'));
	}

?>
