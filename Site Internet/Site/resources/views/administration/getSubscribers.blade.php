@if(Auth::check() && auth()->user()->isAdmin )

    @extends('administration.layout.master')



    @section('content')

        <?php
            date_default_timezone_set ( "Europe/Paris" );
        ?>


        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Tableau de bord</a>
                    </li>
                    <li class="breadcrumb-item active">Clients</li>
                </ol>
                <!-- Example DataTables Card-->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Liste des clients</div>
                    @if(session('status'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{{ session('status') }}</li>
                            </ul>
                        </div>

                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Formule choisie</th>
                                    <th>Date de fin de l'abonnement</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="user_admin">


                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $stripe_plan[$subscibers[$key]->stripe_plan]->nickname }}</td>
                                            <td>{{ date('H:i:s d/m/Y', strtotime( $subscibers[$key]->ends_at )) }}</td>
                                            <td><a href="/administration/annuler-abonnement/{{ $subscibers[$key]->id }}/{{ $user->id }}"><button class="btn btn-danger">Annuler l'abonnement</button></a></td>
                                        </tr>

                                    @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Formule choisie</th>
                                    <th>Date de fin de l'abonnement</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                    <div class="card-footer small text-muted">Mis à jour <?= date("H:i:s") ?></div>
                </div>
            </div>
    @endsection
@endif