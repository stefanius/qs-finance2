<?php if($this->Session->read('Auth.User.id') >= 1 ): ?>
  <li class="menubar-item ">
    <a class="menubar-item-target enabled" href="#"><i class="fa fa-wrench"></i></a>
    <ul class="menu">
      <li class="menu-item"><a class="menu-item-target" href="/schemas/rekeningoverzicht">Rekeningschema</a></li>
       <?php if(isset($bookyear) ): ?>
          <li class="menu-item"><a class="menu-item-target" href="/calculations/search/<?php echo $bookyear['Bookyear']['omschrijving']; ?>">Journaal</a></li>      		
	   <?php endif;?>
    </ul>
  </li>
<?php endif; ?>