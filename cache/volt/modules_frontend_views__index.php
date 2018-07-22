<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $this->tag->gettitle() ?></title>
    <!-- Bootstrap core CSS -->
    <?= $this->tag->stylesheetLink('css/bootstrap.css') ?>

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <?= $this->tag->stylesheetLink('css/font-awesome.min.css') ?>
    <?= $this->tag->stylesheetLink('css/simple-line-icons.css') ?>
    <?= $this->tag->stylesheetLink('css/landing-page.min.css') ?>
	</head>
	<body>

		<?= $this->getContent() ?>
        <?= $this->tag->javascriptInclude('js/jquery.js') ?>
        <?= $this->tag->javascriptInclude('js/bootstrap.bundle.js') ?>
	</body>
</html>







