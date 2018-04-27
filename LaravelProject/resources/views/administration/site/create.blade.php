@extends('layouts.master')





@section ('content')


    <section class="add_site">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" align="center">


                        <h1 align="center">Ajouter un nouveau site</h1>
                        <br>



                        <form method="POST" action="/ajouter-un-site">
                            @csrf


                            <div class="form-group">
                                @if(!isset($errors))
                                    @include('layouts.succes')
                                @endif
                                @include('layouts.errors')
                            </div>




                            <input type="text" id="city" name="city" placeholder="Localisation du site" required>


                            @foreach($services as $service)
                                <select id="{{ $service->short_name }}" name="{{ $service->short_name }}" required>
                                    <option value="" disabled selected>{{ $service->service_name }}</option>
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                            @endforeach


                            @foreach($rooms as $room)
                                <input type="number" id="{{ $room->short_name }}" name="{{ $room->short_name }}" placeholder="Nombre de {{ lcfirst($room->room_name) }}" required>
                            @endforeach


                            @foreach($equipements as $equipement)
                                <input type="number" id="{{ $equipement->short_name }}" name="{{ $equipement->short_name }}" placeholder="Nombre d'{{ lcfirst($equipement->equipement_name) }}" required>
                            @endforeach


                            <textarea type="text" id="hours" name="hours" placeholder="Horaire du site" required></textarea>

                            <label class="upload">
                                Selectionnez l'image  à importer :
                                 <input type="file" name="file" id="file">
                            </label>

                            <button class="create_new_site" type="submit">Ajouter</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection