<?php 

	if($this->Session->read('Auth.User.id') >= 1 ){
		//echo $this->element('system');
        echo $this->element('menu/export');
        echo $this->element('menu/import');
		echo $this->element('menu/bookyears');
		echo $this->element('menu/booking');
	}else{
		echo "<i>U moet inloggen om bewerkingen te kunnen uitvoeren in het systeem.</i>";
		echo "</BR>";
	}
	
	echo $this->element('userstatus');

?>
