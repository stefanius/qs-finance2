<?php if($this->Session->read('Auth.User.id') >= 1 && $this->Session->check('Bookyear.omschrijving')): ?>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Exporteren</a>
    <ul class="dropdown-menu">
      <li><a href="/balans/<?php echo $this->Session->read('Bookyear.omschrijving') ?>/export/excel/balans/">Balans (Excel)</a></li>
      <li><a href="/balans/<?php echo $this->Session->read('Bookyear.omschrijving') ?>/export/excel/kolombalans/">Kolombalans (Excel)</a></li>
    </ul>
  </li>
<?php endif; ?>