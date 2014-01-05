<?php if($this->Session->read('Auth.User.id') >= 1 ): ?> 

  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-th-list"></i></a>
    <ul class="dropdown-menu">
		<li><a href="/">Home<i class="fa fa-home"></i></a></li>
    </ul>
  </li>

<?php endif; ?>