@if(is_null($subscribers))

    <div class="card h-100">
        <h4 class="card-header">Mon offre : Sans Abonnement</h4>
        <div class="card-body">
            <p class="card-text">
                Payez le temps passé sur place, les consommations sont incluses et à volonté !
                <br>
                <br>
                <b>Accessible sans réservation ou abonnement.</b>
                <br>
                <br>

            <p class="center">
                <b>
                    Tarifs par personne :
                </b>
                <br>
                Première heure : 5€
                <br>
                1/2 heure suivante : 2,5€
                <br>
                Journée (5 heures et plus) : 24€
                <br>
                <br>
                <b>Réduction étudiante :</b>
                <br>
                Journée (5 heures et plus) : 20€


            </p>
            <br>
            <br>
            Accès open space (sans possibilité de changer d'adresse)
            <br>
            Wifi
            <br>
            Snacking & boissons à volonté
            <br>
            Cabines téléphonique


            </p>




        </div>
        <div class="card-footer">
            <a href="/sabonner" class="btn btn-primary">Souscrire un abonnement</a>
        </div>
    </div>
    </div>

@elseif($subscribers->name == "simple-with-engagement")


        <div class="card h-100">
            <h4 class="card-header">Mon offre :  {{ $plan->nickname }}</h4>
            <div class="card-body">
                <p class="card-text">

                    <br>
                    <br>

                <p class="center">
                    <b>
                        Tarifs membre par personne :
                    </b>
                    <br>
                    Première heure : 4€
                    <br>
                    1/2 heure suivante : 2€
                    <br>
                    Journée (5 heures et plus) : 20€
                    <br>
                    <br>
                    <b>Tarif avec engagement 12 mois :</b>
                    <br>
                    20€ TTC/mois


                </p>
                <br>
                <br>
                <br>
                Accès open space
                <br>
                Wifi
                <br>
                Snacking & boissons à volonté
                <br>
                Cabines téléphonique
                <br>
                Accès libre à tous les espaces
                <br>
                Accès premium au HUB


                </p>
            </div>
            <div class="card-footer">
                @if(isset($status))
                    Impossible de changer d'offre car vous êtes encore engagé
                @else
                    <a href="/changer-d-offre/{{ auth()->user()->remember_token }}" class="btn btn-primary">Changer d'offre</a>
                    <a href="/desabonnement/{{ auth()->user()->remember_token }}" class="btn btn-primary">Me désabonner</a>
                @endif
            </div>
        </div>


@elseif($subscribers->name == "simple-without-engagement")
        <div class="card h-100">
            <h4 class="card-header">Mon offre :  {{ $plan->nickname }}</h4>
            <div class="card-body">
                <p class="card-text">

                    <br>
                    <br>

                <p class="center">
                    <b>
                        Tarifs membre par personne :
                    </b>
                    <br>
                    Première heure : 4€
                    <br>
                    1/2 heure suivante : 2€
                    <br>
                    Journée (5 heures et plus) : 20€
                    <br>
                    <br>
                    <b>Tarif sans engagement :</b>
                    <br>
                    24€ TTC/mois


                </p>
                <br>
                <br>
                <br>
                Accès open space
                <br>
                Wifi
                <br>
                Snacking & boissons à volonté
                <br>
                Cabines téléphonique
                <br>
                Accès libre à tous les espaces
                <br>
                Accès premium au HUB


                </p>
            </div>
            <div class="card-footer">
                <a href="/changer-d-offre/{{ auth()->user()->remember_token }}" class="btn btn-primary">Changer d'offre</a>
                <a href="/desabonnement/{{ auth()->user()->remember_token }}" class="btn btn-primary">Me désabonner</a>
            </div>
        </div>

@elseif($subscribers->name == "resident-without-engagement")


        <div class="card h-100">
            <h4 class="card-header">Mon offre :  {{ $plan->nickname }}</h4>
            <div class="card-body">
                <p class="card-text">


                    <br>
                    <b>Bénéficiez d'un accès en illimité 7/7j</b>
                    <br>
                    <br>
                    <b>Membre résident sans engagement :</b>
                    <br>
                    300€ TTC/mois
                    <br>
                    <br>
                </p>
            </div>
            <div class="card-footer">
                <a href="/changer-d-offre/{{ auth()->user()->remember_token }}" class="btn btn-primary">Changer d'offre</a>
                <a href="/desabonnement/{{ auth()->user()->remember_token }}" class="btn btn-primary">Me désabonner</a>

            </div>
        </div>


@elseif($subscribers->name == "resident-with-engagement")


        <div class="card h-100">
            <h4 class="card-header">Mon offre :  {{ $plan->nickname }}</h4>
            <div class="card-body">
                <p class="card-text">


                    <br>
                    <b>Bénéficiez d'un accès en illimité 7/7j</b>
                    <br>
                    <br>
                    <b>Membre résident sans engagement :</b>
                    <br>
                    300€ TTC/mois
                    <br>
                    <br>
                </p>
            </div>
            <div class="card-footer">
                @if(isset($status))
                    Impossible de changer d'offre car vous êtes encore engagé
                @else
                    <a href="/changer-d-offre/{{ auth()->user()->remember_token }}" class="btn btn-primary">Changer d'offre</a>
                    <a href="/desabonnement/{{ auth()->user()->remember_token }}" class="btn btn-primary">Me désabonner</a>
                @endif
            </div>
        </div>

@endif
