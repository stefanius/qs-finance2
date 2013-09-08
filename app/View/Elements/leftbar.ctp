<?php 

	if($this->Session->read('Auth.User.id') >= 1 ){
		echo $this->element('system');
                echo $this->element('menu/export');
		echo $this->element('openbookyears');
		echo $this->element('closedbookyears');
		echo $this->element('link_to_crossbooking', array(	'bookyear' => $this -> Session -> read("bookyear"), 
															'grootboek' => $this -> Session -> read("grootboek") ));
	}else{
		echo "<i>U moet inloggen om bewerkingen te kunnen uitvoeren in het systeem.</i>";
		echo "</BR>";
	}
	
	echo $this->element('userstatus');

?>
