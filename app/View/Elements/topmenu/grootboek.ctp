<?php if($this->Session->read('Auth.User.id') >= 1 && strpos($this->here, '/balans/') !== false): ?>

 <?php if(isset($grootboek) && $this->Session->check('Bookyear')): ?>

  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Grootboek <?php echo $grootboek['Grootboek']['nummer'];?></a>
    <ul class="dropdown-menu">
      <li>
          <?php echo $this->Html->link('Journaal Overzicht', 
          			array(  "controller"=>"grootboeks", 
          				    "action"=>"open",
          				    $grootboek['Grootboek']['nummer']
          				 ), 
          			array('class' => '')); 
          ?>     
      </li>
    
      <li>
          <?php echo $this->Html->link('Nieuwe Boeking', '/balans/'.$bookyear['Bookyear']['omschrijving'].'/boeking/'.$grootboek['Grootboek']['nummer'].'/', array('class' => 'menu-item-target')); ?>     
      </li>
      
    </ul>
  </li>
 <?php endif;?>  
<?php endif;?>