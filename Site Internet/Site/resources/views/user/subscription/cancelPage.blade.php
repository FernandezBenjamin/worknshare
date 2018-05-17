@extends('layouts.master')


@section('content')


    <section class="subscribe">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" align="center">


                        <h1 align="center">Êtes-vous sûr de vouloir annuler votre abonnement ?</h1>
                        <br>


                        <div>
                            <form action="/desabonnement/{{$token}}" method="POST">
                                @csrf



                                <div class="col-md-5 col-sm-5 col-xs-5 card-engagement">
                                    <label for="cancel">Non</label>

                                    <input type="radio" name="cancel" value="0" >

                                </div>



                                <div class="spaceOffer">
                                </div>



                                <div class="col-md-5 col-sm-5 col-xs-5 card-engagement">
                                    <label for="cancel">Oui</label>
                                    <input type="radio" name="cancel" value="1" >
                                </div>

                                <input type="submit" value="Envoyer">

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>

@endsection