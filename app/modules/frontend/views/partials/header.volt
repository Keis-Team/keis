{#<nav class="navbar navbar-light bg-light static-top">
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
</nav>#}

<header class="header_area clearfix">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Menu Area Start -->
            <div class="col-12 h-100">
                <div class="menu_area h-100">
                    <nav class="navbar h-100 navbar-expand-lg align-items-center">
                        <!-- Logo -->
                        <a class="navbar-brand" href="{{  url() }}"><img src="img/core-img/logo.png" alt="logo"></a>

                        <!-- Menu Area -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mosh-navbar" aria-controls="mosh-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                        <div class="collapse navbar-collapse justify-content-end" id="mosh-navbar">
                            <ul class="navbar-nav animated" id="nav">
                                <li class="nav-item active"><a class="nav-link" href="{{  url() }}">Home</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="moshDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                                    <div class="dropdown-menu" aria-labelledby="moshDropdown">
                                        <a class="dropdown-item" href="index.html">Home</a>
                                        <a class="dropdown-item" href="about.html">About Us</a>
                                        <a class="dropdown-item" href="services.html">Services</a>
                                        <a class="dropdown-item" href="portfolio.html">Portfolio</a>
                                        <a class="dropdown-item" href="blog.html">Blog</a>
                                        <a class="dropdown-item" href="contact.html">Contact</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="elements.html">Elements</a>
                                    </div>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
                                <li class="nav-item"><a class="nav-link" href="portfolio.html">Portfolio</a></li>
                                <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                            </ul>
                            <!-- Search Form Area Start -->
                            <div class="search-form-area animated">
                                <form action="#" method="post">
                                    <input type="search" name="search" id="search" placeholder="Type keywords &amp; hit enter">
                                    <button type="submit" class="d-none"><img src="img/core-img/search-icon.png" alt="Search"></button>
                                </form>
                            </div>
                            <!-- Search btn -->
                            <div class="search-button">
                                <a href="#" id="search-btn"><img src="img/core-img/search-icon.png" alt="Search"></a>
                            </div>
                            <!-- Login/Register btn -->
                            <div class="login-register-btn">
                                <a href="{{  url('session/login') }}">Login</a>
                                <a href="{{  url('session/signup') }}">/ Register</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
