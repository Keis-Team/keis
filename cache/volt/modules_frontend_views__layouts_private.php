<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <div class="container" style="width: auto;">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <?= $this->tag->linkTo([null, 'class' => 'brand', 'Vökuró']) ?>
        <div class="nav-collapse">

          <ul class="nav"><?php $menus = ['Home' => null, 'Users' => 'users', 'Profiles' => 'profiles', 'Permissions' => 'permissions']; ?><?php foreach ($menus as $key => $value) { ?>
              <?php if ($value == $this->dispatcher->getControllerName()) { ?>
              <li class="active"><?= $this->tag->linkTo([$value, $key]) ?></li>
              <?php } else { ?>
              <li><?= $this->tag->linkTo([$value, $key]) ?></li>
              <?php } ?><?php } ?></ul>

        <ul class="nav pull-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $this->auth->getName() ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><?= $this->tag->linkTo(['users/changePassword', 'Change Password']) ?></li>
            </ul>
          </li>
          <li><?= $this->tag->linkTo(['session/logout', 'Logout']) ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <?= $this->getContent() ?>
</div>