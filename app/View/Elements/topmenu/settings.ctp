<?php if($this->Session->read('Auth.User.id') >= 1 ): ?>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
    <ul class="dropdown-menu">
      <li><a href="/instellingen/grootboek-rekeningen">Beheer grootboekrekeningen</a></li>     
      <li><a href="/bankaccounts/">Beheer bankrekeningen</a></li>
      <li><a href="/schemas/rekeningoverzicht">Rekeningschema</a></li>
       <?php if(isset($bookyear) ): ?>
          <li><a href="/calculations/search/<?php echo $bookyear['Bookyear']['omschrijving']; ?>">Journaal</a></li>      		
	   <?php endif;?>
    </ul>
  </li>
<?php endif; ?>