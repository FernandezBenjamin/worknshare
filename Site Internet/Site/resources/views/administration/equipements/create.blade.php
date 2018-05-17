@extends('administration.layout.master')



@section('content')




    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Tableau de bord</a>
                </li>
                <li class="breadcrumb-item active">Work'n Share</li>
                <li class="breadcrumb-item active">Ajouter un équipement</li>
            </ol>


            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" align="center">
                        <h1 align="center">Ajouter un nouvel équipement</h1>
                        <br>



                        <form method="POST" action="/administration/ajouter-un-equipement">
                            @csrf


                            <div class="form-group">
                                @if(session('status'))
                                    @include('layouts.notifications.succes')
                                @endif
                                @include('layouts.notifications.errors')
                            </div>

                            <div class="checkbox">

                                <p>Sur quel site souhaitez-vous ajouter ce service ?</p>
                                @foreach($sites as $site)
                                    <label for="checkboxSite{{ $site->id }}">{{ $site->city }}</label>
                                    <input type="checkbox" class="checkboxSite" id="checkboxSite{{ $site->id }}" name="checkboxSite{{ $site->id }}" value="{{ $site->id }}" onclick="displayCounter({{ $site->id }})">
                                @endforeach
                            </div>

                            @foreach($sites as $site)
                                <input type="number" style="display: none;" class="counterSite" id="counterSite{{ $site->id }}" name="counterSite{{ $site->id }}" placeholder="{{ $site->city }}">
                            @endforeach

                            <input type="text" id="equipement_name" name="equipement_name" placeholder="Nom du nouvel équipement" required onchange="checkEquipement()">

                            <textarea id="description" name="description" placeholder="Description de l'équipement" required onchange="checkEquipement()"></textarea>

                            <input type="text" id="short_name" name="short_name" placeholder="Nom court de l'equipement (sans espace ni caractères spéciaux)" required onchange="checkEquipement()">


                            <input type="submit" id="add_equipement" style="display: none;" class="btn btn-primary" value="Ajouter le service">


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
