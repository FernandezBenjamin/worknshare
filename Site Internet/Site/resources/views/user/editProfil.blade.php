@extends('layouts.master')





@section ('content')


    <section class="add_site">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" align="center">


                        <h1 align="center">Editer mes informations</h1>
                        <br>



                        <form method="POST" action="/editer-mes-informations">
                            @csrf


                            <div class="form-group">
                                @if(!isset($errors))
                                    @include('layouts.notifications.succes')
                                @endif
                                @include('layouts.notifications.errors')
                            </div>



                            <div class="form-group edit-profile-form">
                                <label for="last_name" class="label-edit">Nom : </label>
                                <input type="text" id="last_name" name="last_name" placeholder="Nom" required value="{{ $user->last_name }}">


                                <label for="first_name" class="label-edit">Prénom : </label>
                                <input type="text" id="first_name" name="first_name" placeholder="Prénom" required value="{{ $user->first_name }}">

                                <label for="mail" class="label-edit">Mail : </label>
                                <input type="text" id="mail" name="mail" placeholder="Mail" required value="{{ $user->email }}">

                                <label for="password" class="label-edit">Mot de passe : </label>
                                <input type="password" id="password" name="password" placeholder="Mot de passe" required>




                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-4">
                                        <a class="btn btn-link" href="/mot-de-passe/{{ auth()->user()->getRememberToken() }}">
                                            Mot de passe oublié ?
                                        </a>
                                        <button type="submit" class="create_new_site">
                                            Enregistrer
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection