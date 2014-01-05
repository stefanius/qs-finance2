<?php if($this->Session->read('Auth.User.id') >= 1 && $this->Session->check('Bookyear.omschrijving')): ?>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Balans</a>
    <ul class="dropdown-menu">
      <li><a href="/balans/<?php echo $this->Session->read('Bookyear.omschrijving') ?>/saldo-overzicht/resultaatposten/">Saldo overzicht resultaatposten</a></li>
      <li><a href="/balans/<?php echo $this->Session->read('Bookyear.omschrijving') ?>/saldo-overzicht/balansposten/">Saldo overzicht balansposten</a></li>
      <li><a href="/balans/<?php echo $this->Session->read('Bookyear.omschrijving') ?>/kolombalans/">Kolombalans</a></li>
      <li><a href="/balans/<?php echo $this->Session->read('Bookyear.omschrijving') ?>/">Eenvoudige Balans</a></li>
    </ul>
  </li>
<?php endif; ?>