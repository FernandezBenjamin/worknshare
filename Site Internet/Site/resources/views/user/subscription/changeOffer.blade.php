@extends('layouts.master')



@section ('content')



    <section class="subscribe">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" align="center">


                        <h1 align="center">Changer d'offre</h1>
                        <br>


                        <div>
                            <form action="/changer-offre/{{ auth()->user()->getRememberToken() }}" method="POST">
                                @csrf


                                <div class="form-group">
                                    @if(!isset($errors))
                                        @include('layouts.notifications.succes')
                                    @endif
                                    @include('layouts.notifications.errors')
                                </div>

                                <div class="formule">

@if($offer == 2)
                                    <div class="col-md-12 col-sm-12 col-xs-12 card-offer">

                                        <i class="fas fa-question-circle" id="offerInfo2"></i>
                                        <a href="/changer-offre/{{ auth()->user()->getRememberToken() }}/3" class="card-link">

                                            Abonnement Simple



                                            <input type="radio" name="formule" id="offer2" value="2" @if($offer == 2) checked @endif>
                                        </a>

                                        <div id="offers-on-hover2" class="offers-on-hover hide">
                                            Tarifs membre par personne :<br>
                                            Première heure : 4€<br>
                                            1/2 heure suivante : 2€<br>
                                            Journée (5 heures et plus) : 20€<br>
                                            <br>
                                            <br>
                                            <b>Devenir membre sans engagement :</b><br>
                                            24€ TTC/mois<br>
                                            <b>Devenir membre avec engagement 12 mois :</b>
                                            <br>
                                            20€ TTC/mois
                                            <br>
                                            <br>
                                            Accès open space<br>
                                            Accès libre à tous les espaces<br>
                                            Accès premium au HUB
                                        </div>

                                    </div>


@elseif($offer == 3)

                                    <div class="col-md-12 col-sm-12 col-xs-12 card-offer">
                                        <i class="fas fa-question-circle" id="offerInfo3"></i>
                                        <a href="/changer-offre/{{ auth()->user()->getRememberToken() }}/3" class="card-link">


                                            Abonnement Résident


                                            <input type="radio" name="formule" id="offer3" value="3" @if($offer == 3) checked @endif>

                                        </a>
                                        <div id="offers-on-hover3" class="offers-on-hover hide">
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
                                        </div>
                                    </div>

@endif
                            </div>
                                @if(isset($offer))
                                    <div id="engagement" class="engagement">

                                        <div class="col-md-5 col-sm-5 col-xs-5 card-engagement">
                                            <a href="/changer-offre/{{ auth()->user()->getRememberToken() }}/{{ $offer }}/0" class="card-link-engagement">


                                                @if($offer == 2)
                                                    <b>Sans engagement</b><br>
                                                    <br>
                                                    24€ TTC/mois
                                                @elseif($offer == 3)
                                                    <b>Sans engagement</b><br>
                                                    <br>
                                                    300€ TTC/mois
                                                @endif


                                                <input type="radio" name="engagement" id="without-engagement" value="0" @if(!is_null($engagement) && $engagement == 0) checked @endif>
                                            </a>

                                        </div>


                                        <div class="spaceOffer">
                                        </div>

                                        <div class="col-md-5 col-sm-5 col-xs-5 card-engagement">
                                            <a href="/changer-offre/{{ auth()->user()->getRememberToken() }}/{{ $offer }}/1" class="card-link-engagement">

                                                @if($offer == 2)
                                                    <b>Avec engagement 12 mois</b><br>
                                                    <br>
                                                    20€ TTC/mois
                                                @elseif($offer == 3)
                                                    <b>Avec engagement 8 mois</b><br>
                                                    <br>
                                                    252€ TTC/mois
                                                @endif

                                                <input type="radio" name="engagement" id="with-engagement" value="1" @if(!is_null($engagement) && $engagement == 1) checked @endif>
                                            </a>
                                        </div>
                                    </div>


                                @endif


                                @if(!is_null($engagement))


                                    <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="{{ config('services.stripe.key') }}"
                                            data-amount="{{ $plans->amount }}"
                                            data-name="Work'n Share"
                                            data-description="{{ $plans->nickname }}"
                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                            data-label="S'abonner"
                                            data-email="{{ auth()->check()?auth()->user()->email: null}}"
                                            data-currency="eur"
                                            data-locale="fr">
                                    </script>
                                @endif



                            </form>

                        </form>





                    </div>
                </div>
            </div>
        </div>


    </section>



@endsection


