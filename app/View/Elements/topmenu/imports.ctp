<?php if($this->Session->read('Auth.User.id') >= 1 && $this->Session->check('Bookyear.omschrijving') && strpos($this->here, '/balans/') !== false): ?>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Importeren</a>
    <ul class="dropdown-menu">
      <li><a href="/balans/<?php echo $this->Session->read('Bookyear.omschrijving') ?>/import/ing/csv">Afschrift ING (CSV)</a></li>
      <li><a href="/balans/<?php echo $this->Session->read('Bookyear.omschrijving') ?>/import/rabo/csv">Afschrift Rabobank (CSV)</a></li>
      <li></li>
      <li><a href="#">Afrekening Activiteit (Excel)</a></li>
      <li><a href="#">Afrekening Kamp (Excel)</a></li>
    </ul>
  </li>
<?php endif; ?>