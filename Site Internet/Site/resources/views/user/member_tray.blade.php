@extends('layouts.master')





@section ('content')


    <section class="add_site">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" align="center">


                        <h1 align="center">Commander un plateau repas</h1>
                        <br>



                        <form method="POST" action="/commander-un-plateau-repas">
                            @csrf


                            <div class="form-group">
                                @if(session('status'))
                                    @include('layouts.notifications.succes')
                                @endif
                                @include('layouts.notifications.errors')


                            </div>

                            @if(count($reservation) == 1)
                                <div class="form-group">
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>
                                                Vous avez déjà commandé votre plateaux pour demain. Pour l'annuler veuillez cliquer sur ce lien :<br>
                                                <a href="/annuler-un-plateau-repas/{{ $reservation->token }}">Annuler mon plateau repas</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @else

                                <div class="form-group">
                                    <select name="sites" id="sites" required onchange="reveleElem('sites')">
                                        <option value="null" disabled selected>Localisation du site</option>
                                        @foreach($sites as $site)
                                            <option value="{{ $site->id }}">{{ $site->city }}</option>
                                        @endforeach
                                    </select>



                                    <div id="revele" class="form-group" style="display: none;">



                                        <input type="date" id="reserveDate" name="reserveDate" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+1 day')); ?>" required>


                                        <input type="submit" id="command_member_tray" value="Louer">
                                    </div>
                                </div>

                            @endif


                        </form>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection