
@if(auth()->user() == null || auth()->user()->subscriber == 0)
    <!-- Page Content -->
    <div class="container">

        <h1 class="my-4">Nos Offres</h1>

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h4 class="card-header">Sans Abonnement</h4>
                    <div class="card-body">
                        <p class="card-text">
                            Payez le temps passé sur place, les consommations sont incluses et à volonté !
                            <br>
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
                        Abonnement non nécéssaire.
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h4 class="card-header">Abonnement Simple</h4>
                    <div class="card-body">
                        <p class="card-text">
                            Rejoignez la communauté WORK'N SHARE et bénéficiez de tarifs préférentiels !

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
                            <b>Devenir membre sans engagement :</b>
                            <br>
                            24€ TTC/mois
                            <br>
                            <br>
                            <b>Devenir membre avec engagement 12 mois :</b>
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
                        <a href="/sabonner/2" class="btn btn-primary">S'abonner</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h4 class="card-header">Abonnement Résident</h4>
                    <div class="card-body">
                        <p class="card-text">
                            Rejoignez la communauté WORK'N SHARE et devenez résident !
                            <br>
                            <br>
                            <br>
                            <br>
                            <b>Bénéficiez d'un accès en illimité 7/7j</b>
                            <br>
                            <br>
                            <b>Devenir membre résident sans engagement :</b>
                            <br>
                            300€ TTC/mois
                            <br>
                            <br>
                            <b>Devenir membre résident avec engagement 8 mois :</b>
                            <br>
                            252€ TTC/mois
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="/sabonner/3" class="btn btn-primary">S'abonner</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <br>
        <br>
    </div>

@endif