<?php if($this->Session->read('Auth.User.id') >= 1 ): ?>

 <?php if(isset($grootboek) && $this->Session->check('Bookyear')): ?>

  <li class="menubar-item">
    <a class="menubar-item-target enabled" href="#">Grootboek <?php echo $grootboek['Grootboek']['nummer'];?></a>
    <ul class="menu">
      <li class="menu-item">
          <?php echo $this->Html->link('Journaal Overzicht', 
          			array(  "controller"=>"grootboeks", 
          				    "action"=>"open",
          				    $grootboek['Grootboek']['nummer']
          				 ), 
          			array('class' => 'menu-item-target')); 
          ?>     
      </li>
    
      <li class="menu-item">
          <?php echo $this->Html->link('Nieuwe Boeking', '/calculations/crossbooking/'.$grootboek['Grootboek']['nummer'].'/', array('class' => 'menu-item-target')); ?>     
      </li>
      
    </ul>
  </li>
 <?php endif;?>  
<?php endif;?>  