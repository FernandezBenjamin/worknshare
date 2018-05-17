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
                <li class="breadcrumb-item active">Ajouter un service</li>
            </ol>


            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" align="center">
                        <h1 align="center">Ajouter un nouveau service</h1>
                        <br>



                        <form method="POST" action="/administration/ajouter-un-service">
                            @csrf


                            <div class="form-group">
                                @if(session('status'))
                                    @include('layouts.notifications.succes')
                                @endif
                                @include('layouts.notifications.errors')
                            </div>


                            <p>Sur quel site souhaitez-vous ajouter ce service ?</p>
                            @foreach($sites as $site)
                                <label for="checkboxSite{{ $site->id }}">{{ $site->city }}</label>
                                <input type="checkbox" class="checkboxSite" id="checkboxSite{{ $site->id }}" name="checkboxSite{{ $site->id }}" value="{{ $site->id }}">
                            @endforeach


                            <input type="text" id="service_name" name="service_name" placeholder="Nom du service" required onchange="checkService()">

                            <textarea id="description" name="description" placeholder="Description du service" required onchange="checkService()"></textarea>

                            <input type="text" id="short_name" name="short_name" placeholder="Nom court du service (sans espace ni caractères spéciaux)" required onchange="checkService()">


                            <input type="submit" id="add_service" style="display: none;" class="btn btn-primary" value="Ajouter le service">


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
