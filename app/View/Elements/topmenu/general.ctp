<?php if($this->Session->read('Auth.User.id') >= 1 ): ?> 

  <li class="menubar-item ">
    <a class="menubar-item-target enabled" href="#"><i class="fa fa-th-list"></i></a>
    <ul class="menu">
		<li class="menu-item"><a class="menu-item-target" href="/">Home<i class="fa fa-home"></i></a></li>
    </ul>
  </li>

<?php endif; ?>