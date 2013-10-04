<?php 

	if($this->Session->read('Auth.User.id') >= 1 ){
		echo $this->element('menu/bookyears');
		//echo $this->element('system');
        echo $this->element('menu/export');
        echo $this->element('menu/import');
		//echo $this->element('menu/booking');
	}
	
	echo $this->element('userstatus');

?>
