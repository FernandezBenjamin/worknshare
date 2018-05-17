

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
                        <a class="nav-link" href="connexion">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inscription">Inscription</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="contact">Contact</a>
                    </li>

                @else



                    @if(auth()->user()->subscriber == 0)

                        <li class="nav-item">
                            <a class="nav-link" href="/sabonner">S'abonner</a>
                        </li>

                    @endif

                    @if(auth()->user()->subscriber == 1 || auth()->user()->isAdmin == 1)


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropreservation" href="#" id="navbarDropdownReservation" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Réservation
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownReservation" id="dropDownReservation">
                                <a class="dropdown-item" href="/reserver-un-espace">Reserver un espace</a>
                                <a class="dropdown-item" href="/louer-un-equipement">Louer un équipement</a>
                                <a class="dropdown-item" href="/commander-un-plateau-repas">Commander un plateau repas</a>
                            </div>
                        </li>
                    @endif


                    @if(Auth::check() && auth()->user()->isAdmin )
                        <li class="nav-item">
                            <a class="nav-link" href="administration">Administration</a>
                        </li>
                    @endif


                    <li class="nav-item">
                        <a class="nav-link" href="contact">Contact</a>
                    </li>


                    <li class="nav-item dropdown ">
                        <div class="nav-link dropdown-toggle dropuser" id="navbarDropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img id="navbarDropdownUserImage"  src="/images/user.png">
                        </div>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownUser" id="dropDownUser">
                            <a class="dropdown-item" >{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}</a>
                            <a class="dropdown-item" href="/editer-mes-informations">Editer mes informations</a>
                            <a class="dropdown-item" href="/abonnement">Mon abonnement</a>
                            <a class="dropdown-item" href="/mes-reservations">Mes réservations</a>
                            <a class="dropdown-item" href="/facture">Facture</a>
                            <a class="dropdown-item" href="/logout">Déconnexion</a>
                        </div>
                    </li>



                @endguest
            </ul>
        </div>
    </div>
</nav>
