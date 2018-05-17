

@extends('layouts.master')





@section ('content')


    <section class="add_site">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" align="center">


                        <h1 align="center">Réserver un espace de travail</h1>
                        <br>



                        <form method="POST" action="/reserver-un-espace">
                            @csrf


                            <div class="form-group">
                                @if(session('status'))
                                    @include('layouts.notifications.succes')
                                @endif
                                @include('layouts.notifications.errors')
                            </div>

                            <select name="sites" id="sites" onchange="revele()">
                                <option value="null" disabled selected>Localisation du site</option>
                                @foreach($sites as $site)
                                    <option value="{{ $site->id }}">{{ $site->city }}</option>
                                @endforeach
                            </select>


                            <div id="revele" style="display: none;">

                                <select name="rooms" id="rooms" onchange="checkHours()">
                                    <option value="null" disabled selected>Salle à réserver</option>
                                    @foreach($site->rooms as $room)
                                        @if(strpos($room->room_name,'réservables'))
                                            <option value="{{ $room->pivot->rooms_id }}">{{ $room->room_name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                <input type="date" id="reserveDate" name="reserveDate" required onchange="checkHours()">

                                <select name="reservationStart" id="reservationStart" onchange="checkHours()" required>
                                    <option value="null" disabled selected>Heure de début</option>
                                    @for($heures = 8; $heures <= 19; $heures++)
                                        <option value="<?php if ($heures<10) { echo 0;}?>{{$heures}}:00">{{$heures}}:00</option>
                                    @endfor
                                </select>

                                <select name="reservationEnd" id="reservationEnd" onchange="checkHours()" required>
                                    <option value="null" disabled selected>Heure de fin</option>
                                    @for($heures = 8; $heures <= 20; $heures++)
                                        <option value="<?php if ($heures<10) { echo 0;}?>{{$heures}}:00">{{$heures}}:00</option>
                                    @endfor
                                </select>

                                <p id="text-hours-error" style="display: none;">L'heure ou la date demandé sont déjà réservé. Merci de sélectionner un autre horaire ou un autre jour.</p>



                                <input type="submit" id="reserveSpace" style="display: none;" class="btn" value="Réserver">

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection


