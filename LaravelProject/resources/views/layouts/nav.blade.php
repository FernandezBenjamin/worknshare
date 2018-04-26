
<!-- Navigation -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Work'n Share</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">


                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="login">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register">Inscription</a>
                    </li>
                @else

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Réservation
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                            <a class="dropdown-item" href="full-width.html">Full Width Page</a>
                            <a class="dropdown-item" href="sidebar.html">Sidebar Page</a>
                            <a class="dropdown-item" href="faq.html">FAQ</a>
                            <a class="dropdown-item" href="404.html">404</a>
                            <a class="dropdown-item" href="pricing.html">Pricing Table</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" >{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}</a>
                    </li>



                    @if(Auth::check() && auth()->user()->isAdmin )
                        <li class="nav-item">
                            <a class="nav-link" href="ajouter-un-site">Ajouter un site</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="administration">Administration</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="logout">Déconnexion</a>
                    </li>

                @endguest
                <li class="nav-item">
                    <a class="nav-link" href="contact">Contact</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
