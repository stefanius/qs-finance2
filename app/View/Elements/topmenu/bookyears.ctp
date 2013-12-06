<?php if($this->Session->read('Auth.User.id') >= 1 ): ?>

<?php $openyears = $this->requestAction('/bookyears/getBookyear/0'); ?>
<?php $closedyears = $this->requestAction('/bookyears/getBookyear/1'); ?>
 <?php if(isset($grootboek) ): ?>
  <li class="menubar-item">
    <a class="menubar-item-target disabled" href="#">Boekjaren</a>
  </li>
 <?php else: ?>
  <li class="menubar-item">
    <a class="menubar-item-target enabled" href="#">Boekjaren</a>
    <ul class="menu">
      <?php foreach($openyears as $year): ?>
      
      <li class="menu-item">
          <?php echo $this->Html->link($year['Bookyear']['omschrijving'], '/balans/open/'.$year['Bookyear']['omschrijving'], array('class' => 'menu-item-target'));?>     
      </li>
      
      <?php endforeach; ?>
      
      
      <li class="menu-separator"></li>
      <?php foreach($closedyears as $year): ?>
      
      <li class="menu-item">
          <?php echo $this->Html->link($year['Bookyear']['omschrijving'], '/balans/open/'.$year['Bookyear']['omschrijving'], array('class' => 'menu-item-target'));?>     
      </li>
      
      <?php endforeach; ?>
      
    </ul>
  </li>
 <?php endif;?>  
<?php endif;?>  