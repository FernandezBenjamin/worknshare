

@extends ('layouts.master')



@section ('content')

    @include ('home.carroussel')
    @include ('home.offers')


    <h2>Nos différents sites</h2>

    <br>

    <div class="row">


    @foreach($sites as $site)
        @include ('home.sites')
    @endforeach

    </div>
    <!-- /.row -->
@endsection