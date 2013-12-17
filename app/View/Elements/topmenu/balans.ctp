<?php if($this->Session->read('Auth.User.id') >= 1 && $this->Session->check('Bookyear.omschrijving')): ?>
  <li class="menubar-item ">
    <a class="menubar-item-target enabled" href="#">Balans</a>
    <ul class="menu">
      <li class="menu-item"><a class="menu-item-target" href="/balans/<?php echo $this->Session->read('Bookyear.omschrijving') ?>/saldo-overzicht/resultaatposten/">Saldo overzicht resultaatposten</a></li>
      <li class="menu-item"><a class="menu-item-target" href="/balans/<?php echo $this->Session->read('Bookyear.omschrijving') ?>/saldo-overzicht/balansposten/">Saldo overzicht balansposten</a></li>
    </ul>
  </li>
<?php endif; ?>