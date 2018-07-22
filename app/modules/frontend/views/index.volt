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
</body>
</html>



