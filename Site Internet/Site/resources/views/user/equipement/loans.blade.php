@extends('layouts.master')





@section ('content')


    <section class="add_site">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" align="center">


                        <h1 align="center">Louer un équipement</h1>
                        <br>



                        <form method="POST" action="/louer-un-equipement">
                            @csrf


                            <div class="form-group">
                                @if(!isset($errors))
                                    @include('layouts.notifications.succes')
                                @endif
                                @include('layouts.notifications.errors')
                            </div>


                            <div class="form-group">
                                <select name="sites" id="sites" required onchange="reveleElem('sites')">
                                    <option value="null" disabled selected>Localisation du site</option>
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->city }}</option>
                                    @endforeach
                                </select>



                                <div id="revele" class="form-group" style="display: none;">

                                    <select name="equipements" id="equipements" required onchange="checkEquipementBySite()">
                                        <option value="null" disabled selected>Equipement à louer</option>
                                        @foreach($equipements as $equipement)
                                            <option value="{{ $equipement->id }}">{{ $equipement->equipement_name }}</option>
                                        @endforeach
                                    </select>


                                    <input type="date" id="reserveDate" name="reserveDate" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+1 months')); ?>" required onchange="checkEquipementBySite()">


                                    <input type="submit" id="rent_equipement" value="Louer" style="display: none;">
                                </div>
                            </div>




                        </form>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection