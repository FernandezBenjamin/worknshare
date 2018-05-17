
@extends('layouts.master')



@section('content')


    <section class="subscribe">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" align="center">


                        <h1 align="center">Mon abonnement</h1>
                        <br>


                        <div>

                            @include('user.subscription.myOfferChange')


                        </div>



                    </div>
                </div>
            </div>
        </div>


        @include('user.subscription.offers')



    </section>


@endsection