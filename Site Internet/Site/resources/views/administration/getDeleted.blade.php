@if(Auth::check() && auth()->user()->isAdmin )

    @extends('administration.layout.master')



@section('content')


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
                                <th>Mail</th>
                                <th>Anniversaire</th>
                                <th>Date d'ajout</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="user_admin">


                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                    <td>{{ date('d/m/Y', strtotime($user->birthdate)) }}</td>
                                    <td>{{ date('H:i:s d/m/Y', strtotime( $user->created_at )) }}</td>
                                    <td><a href="/administration/rU/{{$user->id}}"><button class="btn btn-success">Réactiver</button></a></td>
                                </tr>

                            @endforeach


                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Mail</th>
                                <th>Anniversaire</th>
                                <th>Date d'ajout</th>
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