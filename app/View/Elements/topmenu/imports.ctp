<?php if($this->Session->read('Auth.User.id') >= 1 && $this->Session->check('Bookyear.omschrijving')): ?>
  <li class="menubar-item ">
    <a class="menubar-item-target enabled" href="#">Importeren</a>
    <ul class="menu">
      <li class="menu-item"><a class="menu-item-target" href="/balans/<?php echo $this->Session->read('Bookyear.omschrijving') ?>/import/ing/csv">Afschrift ING (CSV)</a></li>
      <li class="menu-item"><a class="menu-item-target" href="/balans/<?php echo $this->Session->read('Bookyear.omschrijving') ?>/import/rabo/csv">Afschrift Rabobank (CSV)</a></li>
      <li class="menu-separator"></li>
      <li class="menu-item"><a class="menu-item-target" href="#">Afrekening Activiteit (Excel)</a></li>
      <li class="menu-item"><a class="menu-item-target" href="#">Afrekening Kamp (Excel)</a></li>
    </ul>
  </li>
<?php endif; ?>