<?php 
	$path =  explode('/',  $this->here); 

	if(strlen($this->Session->read('Bookyear.omschrijving')) > 0){
		$this->Html->addCrumb('Balans '.$this->Session->read('Bookyear.omschrijving'), '/balans/'.$this->Session->read('Bookyear.omschrijving'));
	}

	if(strlen($this->Session->read('Bookyear.omschrijving')) > 0 && isset($grootboek)){
		$this->Html->addCrumb($grootboek['Grootboek']['nummer'], '/grootboeks/open/'.$grootboek['Grootboek']['nummer']);
	}	
	//var_dump($bookyear);
?>



<div id="breadcrumb">
<?php 
    if(in_array('balans', $path) || in_array('grootboeks', $path) || count($path) == 2){
    	echo $this->Html->getCrumbs(' > ', 'Home');
    }

?>
</div>
