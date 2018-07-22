<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ getTitle() }}</title>
    <!-- Bootstrap core CSS -->
    {{ stylesheet_link('css/bootstrap.css') }}

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    {{ stylesheet_link('css/font-awesome.min.css') }}
    {{ stylesheet_link('css/simple-line-icons.css') }}
    {{ stylesheet_link('css/landing-page.min.css') }}
	</head>
	<body>

		{{ content() }}
        {{ javascript_include('js/jquery.js') }}
        {{ javascript_include('js/bootstrap.bundle.js') }}
	</body>
</html>







