{{ get_doctype() }}
<html lang="en">
<head>
    {{ partial('main/meta_tags') }}
    {{ getTitle() }}
    {{ partial('main/fonts_and_css') }}
</head>
<body>
{{ partial('plugins/preloader') }}
{{ content() }}
{{ partial('main/library_and_js') }}
<script src='https://use.fontawesome.com/2188c74ac9.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>



</body>
</html>
