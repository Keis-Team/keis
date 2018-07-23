<header class="header_area clearfix">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-12 h-100">
                <div class="menu_area h-100">
                    <nav class="navbar h-100 navbar-expand-lg align-items-center">
                        <a class="navbar-brand" href="{{  url() }}">{{  image("img/core-img/logo.png", "alt": "logo") }} </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mosh-navbar" aria-controls="mosh-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse justify-content-end" id="mosh-navbar">
                            <div class="search-form-area animated">
                                <form action="#" method="post">
                                    <input type="search" name="search" id="search" placeholder="Type keywords &amp; hit enter">
                                    <button type="submit" class="d-none">{{ image('img/core-img/search-icon.png','alt':"Search") }}</button>
                                </form>
                            </div>
                            <div class="search-button">
                                <a href="#" id="search-btn">{{ image('img/core-img/search-icon.png','alt':"Search") }}</a>
                            </div>
                            <div class="login-register-btn">
                                <ul class="nav pull-right">
                                    {%- if logged_in is defined and not(logged_in is empty) -%}
                                        <li>{{ link_to('users', 'Users Panel') }}</li> \
                                        <li>{{ link_to('session/logout', ' Logout') }}</li>
                                    {% else %}
                                        <li>{{ link_to('session/login', 'Login') }}</li> \
                                        <li>{{ link_to('session/signup', ' Register') }}</li>
                                    {% endif %}
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
