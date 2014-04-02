<?php if($this->Session->read('Auth.User.id') >= 1 ): ?> 

  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->Session->read('Auth.User.username') ?></a>
    <ul class="dropdown-menu">
      <li>
         <?php echo $this->Html->link('Wachtwoord wijzigen', '/instellingen/wachtwoord-wijzigen', array('class' => 'menu-item-target')); ?>
      </li>
      <li>
         <?php echo $this->Html->link('Uw systeeminfo', '/users/systeminfo', array('class' => 'menu-item-target')); ?>
      </li>
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