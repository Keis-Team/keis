<?= $this->getContent() ?>

<div align="right">
    <?= $this->tag->linkTo(['users/create', '<i class=\'icon-plus-sign\'></i> Create Users', 'class' => 'btn btn-primary']) ?>
</div>

<form method="post" action="<?= $this->url->get('users/search') ?>" autocomplete="off">

    <div class="center scaffold">

        <h2>Search users</h2>

        <div class="clearfix">
            <label for="id">Id</label>
            <?= $form->render('id') ?>
        </div>

        <div class="clearfix">
            <label for="name">Name</label>
            <?= $form->render('name') ?>
        </div>

        <div class="clearfix">
            <label for="email">E-Mail</label>
            <?= $form->render('email') ?>
        </div>

        <div class="clearfix">
            <label for="profilesId">Profile</label>
            <?= $form->render('profilesId') ?>
        </div>

        <div class="clearfix">
            <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-primary']) ?>
        </div>

    </div>

</form>