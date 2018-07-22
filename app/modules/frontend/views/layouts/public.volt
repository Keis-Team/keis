<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <div class="nav-collapse">
            <ul class="nav">

                {%- set menus = [
                    'Home': 'index',
                    'About': 'about'
                ] -%}

                {%- for key, value in menus %}
                    {% if value == dispatcher.getControllerName() %}
                        <li class="active">{{ link_to(value, key) }}</li>
                    {% else %}
                        <li>{{ link_to(value, key) }}</li>
                    {% endif %}
                {%- endfor -%}

            </ul>

            <ul class="nav pull-right">
                {%- if logged_in is defined and not(logged_in is empty) -%}
                    <li>{{ link_to('users', 'Users Panel') }}</li>
                    <li>{{ link_to('session/logout', 'Logout') }}</li>
                {% else %}
                    <li>{{ link_to('session/login', 'Login') }}</li>
                {% endif %}
            </ul>
        </div>
        {{ link_to('session/signup', '<i class="icon-ok icon-white"></i> Create an Account', 'class': 'btn btn-primary btn-large') }}
    </div>
</nav>
{{ content() }}

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
                        {{ link_to("terms", "Terms") }}
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        {{ link_to("privacy", "Privacy Policy") }}
                    </li>
                </ul>
                <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website {{ date("Y") }}. All Rights Reserved.</p>
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
