<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <div class="nav-collapse">
            <ul class="nav"><?php $menus = ['Home' => 'index', 'About' => 'about']; ?><?php foreach ($menus as $key => $value) { ?>
                    <?php if ($value == $this->dispatcher->getControllerName()) { ?>
                        <li class="active"><?= $this->tag->linkTo([$value, $key]) ?></li>
                    <?php } else { ?>
                        <li><?= $this->tag->linkTo([$value, $key]) ?></li>
                    <?php } ?><?php } ?></ul>

            <ul class="nav pull-right"><?php if (isset($logged_in) && !(empty($logged_in))) { ?><li><?= $this->tag->linkTo(['users', 'Users Panel']) ?></li>
                    <li><?= $this->tag->linkTo(['session/logout', 'Logout']) ?></li>
                <?php } else { ?>
                    <li><?= $this->tag->linkTo(['session/login', 'Login']) ?></li>
                <?php } ?>
            </ul>
        </div>
        <?= $this->tag->linkTo(['session/signup', '<i class="icon-ok icon-white"></i> Create an Account', 'class' => 'btn btn-primary btn-large']) ?>
    </div>
</nav>
<?= $this->getContent() ?>

<footer class="footer bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                <ul class="list-inline mb-2">
                    <li class="list-inline-item">
                        <a href="#">About</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="#">Contact</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <?= $this->tag->linkTo(['terms', 'Terms']) ?>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <?= $this->tag->linkTo(['privacy', 'Privacy Policy']) ?>
                    </li>
                </ul>
                <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website <?= date('Y') ?>. All Rights Reserved.</p>
            </div>
            <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item mr-3">
                        <a href="#">
                            <i class="fa fa-facebook fa-2x fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="#">
                            <i class="fa fa-twitter fa-2x fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fa fa-instagram fa-2x fa-fw"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
