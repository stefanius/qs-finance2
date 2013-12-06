<?php if($this->Session->read('Auth.User.id') >= 1 ): ?> 

  <li class="menubar-item">
    <a class="menubar-item-target enabled" href="#"><?php echo $this->Session->read('Auth.User.username') ?></a>
    <ul class="menu">
      <li>
         <?php echo $this->Html->link('Uitloggen', '/users/logout', array('class' => 'menu-item-target')); ?>
      </li>
    </ul>
  </li>
  <?php else: ?>
  <li class="menubar-item">
    <?php echo $this->Html->link('Inloggen', '/users/login', array('class' => 'menubar-item-target')); ?>
  </li>  

<?php endif; ?>