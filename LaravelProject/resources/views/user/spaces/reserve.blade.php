@guest

    <?php
            
    ?>

@endguest

    @extends('layouts.master')





    @section ('content')


        <section class="add_site">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" align="center">


                            <h1 align="center">Réserver un espace de travail</h1>
                            <br>



                            <form method="POST" action="/reserver-un-site">
                                @csrf


                                <div class="form-group">
                                    @if(!isset($errors))
                                        @include('layouts.succes')
                                    @endif
                                    @include('layouts.errors')
                                </div>

                                <select name="sites" id="sites" onchange="revele()">
                                    <option value="" disabled selected>Localisation du site</option>
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->city }}</option>
                                    @endforeach
                                </select>


                                <div id="revele" style="display: none;">
                                    <input type="date" id="reserveDate" name="date" required onchange="checkDate()">

                                    <select name="sites" id="rooms">
                                        <option value="" disabled selected>Salle à réserver</option>
                                        @foreach($site->rooms as $room)
                                            @if(strpos($room->room_name,'réservables'))
                                                <option value="{{ $room->id }}">{{ $room->room_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </section>
    @endsection


